<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: view.php,v 1.1 2004/02/05 06:54:40 jbyers Exp $
//

///////////////////////////////////////////////////////////////////////////////
// detail view
//

// build file list
//
$file_count = 0;
if ($h_dir = opendir("$CFG_path_images/$IMAGE_DIR")) {
  while (false !== ($filename = readdir($h_dir))) { 
    if ($IMAGE_DIR == '') {
      $path = $filename;
    } else {
      $path = "$IMAGE_DIR/$filename";
    }
      
    if (is_file("$PATH_BASEDIR/$filename") && eregi($CFG_image_valid, $filename)) {
      $file_list[] = array('url'   => "$CFG_url_album/image/$CFG_view_width/$CFG_view_height/$path",
                           'thumb' => "$CFG_url_album/image/$CFG_thumb_width/$CFG_thumb_height/$path",
                           'name'  => $filename);
      $file_count++;
    } // if file
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
$T['current'] =& $file_list[$VARS[0]]; 
$T['next']    =& $file_list[($VARS[0] + 1)]; 
$T['prev']    =& $file_list[($VARS[0] - 1)]; 
$T['path']    =& $path_list; 
debug('T', $T);

include("$CFG_path_template/header.tpl");
include("$CFG_path_template/view.tpl");
include("$CFG_path_template/footer.tpl");

?>
