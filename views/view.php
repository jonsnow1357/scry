<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: view.php,v 1.5 2004/09/30 20:10:20 jbyers Exp $
//

//////////////////////////////////////////////////////////////////////////////
// Security
//
// include calls are based on static variables.
//
// No other filesystem calls take place in this view.  See 
// functions.php/directory_data() for directory listing validation.
//

///////////////////////////////////////////////////////////////////////////////
// detail view
//   $INDEX -> index of image in directory file list
//

// fetch directory listing
//
$data = directory_data($PATH_BASEDIR, $IMAGE_DIR); // FS SEE FUNCTION

// TODO supplement current with image_size, etc.
//     $image_size = getimagesize("$path/$v[name]"); // FS READ
//     $file_size = filesize("$path/$v[name]"); // FS READ
//    $exif_data = array();
//                     'file_size'  => round($file_size / 1024, 0) . ' KB',
//                     'image_size' => "$image_size[0]x$image_size[1]",
//                     'exif_data'  => $exif_data);

// assign, display templates
//
$T['current'] =& $data['files'][$INDEX]; 
$T['next']    =& $data['files'][($INDEX + 1)]; 
$T['prev']    =& $data['files'][($INDEX - 1)]; 
$T['path']    =  path_list($IMAGE_DIR); 
debug('T', $T);

include("$CFG_path_template/header.tpl"); // FS READ
include("$CFG_path_template/view.tpl");   // FS READ
include("$CFG_path_template/footer.tpl"); // FS READ

?>
