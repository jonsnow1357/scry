<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: list.php,v 1.1 2004/02/05 06:54:40 jbyers Exp $
//

///////////////////////////////////////////////////////////////////////////////
// list view
//   $VARS[0] -> page N of listings, based on $CFG_max_thumbs
//

// build directory, file list
//
$file_count = 0;
if ($h_dir = opendir("$CFG_path_images/$IMAGE_DIR")) {
  while (false !== ($filename = readdir($h_dir))) { 
    if ($filename != '.' && $filename != '..') { 
      if ($IMAGE_DIR == '') {
        $path = $filename;
      } else {
        $path = "$IMAGE_DIR/$filename";
      }
      
      if (is_file("$PATH_BASEDIR/$filename") && eregi($CFG_image_valid, $filename)) {
        $file_list[] = array('path'  => $path,
                             'url'   => "$CFG_url_album/view/$file_count/$path",
                             'name'  => $filename);
        $file_count++;
      } else if (is_dir("$PATH_BASEDIR/$filename")) {
        $dir_list[] = array('path'  => $path,
                            'url'   => "$CFG_url_album/list/0/$path",
                            'name'  => $filename);
      } // if ... else is_file or is_dir
    } // if
  } // while
  closedir($h_dir);
} // if opendir

// build path list
//
$image_subdir_parts = array();
if ($IMAGE_DIR != '') {
  $image_subdir_parts = explode('/', $IMAGE_DIR);
}

$path_list[] = array('url'  => $CFG_url_album,
                     'name' => $CFG_album_name_short);

for ($i = 0; $i < count($image_subdir_parts); $i++) {
  list($k, $v) = each($image_subdir_parts);
  $path_list[] = array('url'  => "$CFG_url_album/list/0/" . implode('/', array_slice($image_subdir_parts, 0, $i + 1)),
                       'name' => $image_subdir_parts[$i]);
} // for

// assign, display templates
//
$T['dirs']  =& $dir_list; 
$T['files'] =& $file_list; 
$T['path']  =& $path_list; 
debug('T', $T);

include("$CFG_path_template/header.tpl");
include("$CFG_path_template/list.tpl");
include("$CFG_path_template/footer.tpl");

?>
