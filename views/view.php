<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//

//////////////////////////////////////////////////////////////////////////////
// Security
//
// include calls are based on static variables
// file and image size are read from the filesystem; see FS READ
//

///////////////////////////////////////////////////////////////////////////////
// detail view
//   $INDEX -> index of image in directory file list
//

// fetch directory listing
//
$data = directory_data($PATH_BASEDIR, $IMAGE_DIR); // FS SEE FUNCTION

// fetch size (file and image), exif data on current image
//
$image_size = getimagesize($data['files'][$INDEX]['path']); // FS READ
$file_size  = filesize($data['files'][$INDEX]['path']); // FS READ

// optionally fetch exifer data
//
if ($CFG_use_exifer) {
  include_once('exif.php');
  $exif_data = read_exif_data_raw($data['files'][$INDEX]['path'], 0);
}

//////////////////////////////////////////////////////////////////////////////
// assign, display templates
//
$T['current']                = $data['files'][$INDEX];
$T['current']['image_size']  = $image_size;
$T['current']['view_size']   = calculate_resize($image_size[0], $image_size[1], $CFG_image_width, $CFG_image_height);
$T['current']['file_size']   = round($file_size / 1024, 0) . ' KB';
if ($CFG_use_exifer) {
  $T['current']['exif_data'] = $exif_data;
}

$T['next']    = $data['files'][($INDEX + 1)];
$T['prev']    = $data['files'][($INDEX - 1)];
$T['path']    =  path_list($IMAGE_DIR);
debug('T', $T);

include("$CFG_path_template/header.tpl"); // FS READ
include("$CFG_path_template/view.tpl");   // FS READ
include("$CFG_path_template/footer.tpl"); // FS READ

?>
