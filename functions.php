<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: functions.php,v 1.2 2004/02/08 07:39:02 jbyers Exp $
//

// function parse_resolution(string $res)
//
// converts a string dimension (800x600, 800X600, 800 x 600, 800 X 600) 
// to a two-element array
//
function parse_resolution($res) {
  return(explode('x', str_replace(' ', '', strtolower($res))));
} // function parse_resolution

// function cache_test(string $url, int $x, int $y) {
// 
// creates the file's cache path and tests for existance in the cache:
//
// array(
//   name,
//   path,
//   is_cached,
//   cache_url
// )
//
function cache_test($url, $x, $y) {
  global $CFG_cache_enable, $CFG_path_cache, $CFG_url_cache;
  
  $result              = array();
  $clean_url           = eregi_replace('[^a-zA-Z0-9\._-]', '_', $url);
  $result['name']      = $x . 'x' . $y . '_' . str_replace('/', '_', $clean_url);
  $result['path']      = $CFG_path_cache . '/' . $result['name'];
  $result['is_cached'] = false;
  $result['cache_url'] = $CFG_url_cache . '/' . $result['name'];

  if ($CFG_cache_enable && is_file($result['path']) && is_readable($result['path'])) {
    $result['is_cached'] = true;
  }

  return $result;
} // function cache_test

// function directory_data(string $path, string $url_path)
// 
// walks the specified directory and returns an array containing image file
// and directory details:
//
// array(
//   files => array(
//     name,
//     index,
//     image_size,
//     thumb_url,
//     view_url
//   ),
//   directories => array(
//     name,
//     index,
//     list_url
//   )
// )
//
// note: only files with extensions matching $CFG_image_valid are included
//       '.' and '..' are not referenced in the directory array
//
function directory_data($path, $url_path) {
  global $CFG_image_valid, $CFG_url_album, $CFG_thumb_width, $CFG_thumb_height, $CFG_view_width, $CFG_view_height;

  // load raw directory first, sort, and reprocess
  //
  $files_raw = array();
  $dirs_raw  = array();
  if ($h_dir = opendir($path)) {
    while (false !== ($filename = readdir($h_dir))) { 
      if ($filename != '.' && $filename != '..') { 
        // set complete url
        //
        if ($url_path == '') {
          $url = $filename;
        } else {
          $url = "$url_path/$filename";
        }

        if (is_file("$path/$filename") && eregi($CFG_image_valid, $filename)) {
          $files_raw[] = array('name' => $filename,
                               'url'  => $url);
        } else if (is_dir("$path/$filename")) {
          $dirs_raw[]  = array('name' => $filename,
                               'url'  => $url);
        } // if ... else is_file or is_dir
      } // if
    } // while
    closedir($h_dir);
  } // if opendir

  // sort directory arrays by filename
  //
  function cmp($a, $b) {
    return strcasecmp($a['name'], $b['name']);
  } // function cmp
  @usort($dirs_raw,  'cmp');
  @usort($files_raw, 'cmp');

  // reprocess arrays
  //
  $files = array();
  $dirs  = array();
  $file_count = 0;
  $dir_count  = 0;
  while (list($k, $v) = each($files_raw)) {
    // set thumbnail cached vs. not
    //
    $thumb = cache_test($v['url'], $CFG_thumb_width, $CFG_thumb_height);
    $image = cache_test($v['url'], $CFG_view_width, $CFG_view_height);

    if ($thumb['is_cached']) {
      $thumb_url = $thumb['cache_url'];
    } else {
      $thumb_url = "$CFG_url_album/image/$CFG_thumb_width" . "x$CFG_thumb_height/" . $v['url'];
    }

    if ($image['is_cached']) {
      $image_url = $image['cache_url'];
    } else {
      $image_url = "$CFG_url_album/image/$CFG_view_width" . "x$CFG_view_height/" . $v['url'];
    }

    $image_size = getimagesize("$path/$v[name]");

    $files[] = array('name'       => $v['name'],
                     'index'      => $file_count,
                     'image_size' => "$image_size[0]x$image_size[1]",
                     'thumb_url'  => $thumb_url,
                     'image_url'  => $image_url,
                     'view_url'   => "$CFG_url_album/view/$file_count/" . $v['url']);
    $file_count++;
  }

  while (list($k, $v) = each($dirs_raw)) {
    $dirs[] = array('name'     => $v['name'],
                    'index'    => $dir_count,
                    'list_url' => "$CFG_url_album/list/0/" . $v['url']);
    $dir_count++;
  }

  return(array('files' => $files, 'directories' => $dirs));
} // function directory_data

// function path_list(string $path)
//
// return list of path parts and URLs in an array:
//
// array(
//   url,
//   name
// )
//
function path_list($path) {
  global $CFG_url_album, $CFG_album_name_short;

  $image_subdir_parts = array();
  if ($path != '') {
    $image_subdir_parts = explode('/', $path);
  }
  
  $path_list[] = array('url'  => $CFG_url_album,
                       'name' => $CFG_album_name_short);
  
  for ($i = 0; $i < count($image_subdir_parts); $i++) {
    list($k, $v) = each($image_subdir_parts);
    $path_list[] = array('url'  => "$CFG_url_album/list/0/" . implode('/', array_slice($image_subdir_parts, 0, $i + 1)),
                         'name' => $image_subdir_parts[$i]);
  } // for

  return $path_list;
} // function path_data

// function debug(string $type[, string $message])
//
// sets an entry in global DEBUG_MESSAGES
//
function debug($type, $message = '') {
  global $DEBUG_MESSAGES;

  if ($message == '') {
    $message = $type;
    $type = 'debug';
  } // if
  
  if (is_array($message) || is_object($message)) {
    $message = var_export($message, true);
  } // if

  $DEBUG_MESSAGES[] = "[$type]: $message";
} // function debug

?>
