<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: image.php,v 1.13 2004/10/02 01:32:36 jbyers Exp $
//

//////////////////////////////////////////////////////////////////////////////
// Security
//
// Three variables are used in filesystem reads and writes (search for "FS" in
// this file):
//
//   $PATH            validated in index.php
//   $cache['path']   validated in functions.php/cache_test()
//   $CFG_cache_path  static in setup.php
//

///////////////////////////////////////////////////////////////////////////////
// image view
//   $INDEX -> image width x image height or 0 for raw image display
//

// fetch image properties
//
list($x, $y) = parse_resolution($INDEX);
$image_props = getimagesize($PATH); // FS READ

if (!is_array($image_props)) {
  die('bad props');
} 

// 0 INDEX or original size image: redirect or load image
//
if ('0' == $INDEX ||
    ($x == $image_props[0] &&
     $y == $image_props[1])) {
  // show raw image via readfile or redirect
  //
  if ($CFG_images_outside_docroot) {
    header('Content-Type: image/jpeg');
    readfile("$CFG_path_images/$IMAGE_DIR/$IMAGE_FILE");
  } else {
    header("Location: $CFG_url_images$IMAGE_DIR/$IMAGE_FILE");
  } // if image outside docroot
  exit();
} // if raw image display

// calculate resize, bounded by $INDEX resolution
//
(int)$resize_x = ($image_props[0] <= $image_props[1]) ? round(($image_props[0] * $y)/$image_props[1]) : $x;
(int)$resize_y = ($image_props[0] > $image_props[1]) ? round(($image_props[1] * $x)/$image_props[0]) : $y;

// if caching enabled and file exists, redirect
//
$cache = cache_test("$IMAGE_DIR/$IMAGE_FILE", $resize_x, $resize_y); // FS SEE FUNCTION

if (!$CFG_debug_image) {
  // redirect to or load image inline if cache hit
  //
  if ($cache['is_cached']) {
    if ($CFG_cache_outside_docroot) {
      header('Content-Type: image/jpeg');
      readfile($cache['path']);  // FS READ
      exit();
    } else {
      header('Location: ' . $cache['cache_url']);
      exit();
    }
  } else {
    // resample image, saving to disk if caching enabled
    // note: function_exists is a poor test for GD functions
    //
    if ($CFG_use_old_gd) {
      $new_image = ImageCreate($resize_x, $resize_y);
    } else {
      $new_image = ImageCreateTrueColor($resize_x, $resize_y);
    }
    
    $src_image = ImageCreateFromJPEG($PATH); // FS READ

    // choose function based on fast mode and availability
    // note: function_exists is a poor test for GD functions
    //
    if ($CFG_resize_fast ||
        $CFG_use_old_gd) {
      ImageCopyResized($new_image,
                       $src_image,
                       0, 0, 0, 0,
                       $resize_x,
                       $resize_y,
                       $image_props[0],
                       $image_props[1]);
    } else {     
      ImageCopyResampled($new_image,
                         $src_image,
                         0, 0, 0, 0,
                         $resize_x,
                         $resize_y,
                         $image_props[0],
                         $image_props[1]);
    }

    // verify cache enabled, path writable, and target size OK to be cached
    // 
    if ($CFG_cache_enable && 
        is_writable($CFG_path_cache) && // FS READ
        (($x == $CFG_thumb_width && 
          $y == $CFG_thumb_height) ||
         ($x == $CFG_image_width && 
          $y == $CFG_image_height))) {
      ImageJPEG($new_image, $cache['path']); // FS WRITE
      header('Location: '. $cache['cache_url']);
      exit();
    } else {
      header('Content-Type: image/jpeg');
      ImageJPEG($new_image);
      exit();
    } // if cache write
  } // if cached
} else {
  debug('resize_x',     $resize_x);
  debug('resize_y',     $resize_y);
  debug('image_x',      $image_props[0]);
  debug('image_y',      $image_props[1]);
  debug('cache',        $cache);
  print('<p>' . implode('<br>', $DEBUG_MESSAGES));
} // if debug mode

?>
