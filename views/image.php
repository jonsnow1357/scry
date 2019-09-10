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

// script must continue on user abort
//
ignore_user_abort(true);

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
list($resize_x, $resize_y) = calculate_resize($image_props[0], $image_props[1], $x, $y);

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

    switch ($image_props[2]) {
      case 1: $src_image = ImageCreateFromGIF($PATH); break;// FS READ
      case 2: $src_image = ImageCreateFromJPEG($PATH); break;// FS READ
      case 3: $src_image = ImageCreateFromPNG($PATH); break;// FS READ
      default: die("Incorrect image type ...");
    }

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
      if (($image_props[2] == 1) OR ($image_props[2] == 3)) {
        ImageAlphaBlending($new_image, false);
        ImageSaveAlpha($new_image, true);
        $transparent = ImageColorAllocateAlpha($new_image, 255, 255, 255, 127);
        ImageFilledRectangle($new_image, 0, 0, $resize_x, $resize_y, $transparent);
      }
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
      ImageJPEG($new_image, $cache['path'], $CFG_jpeg_compression); // FS WRITE
      header('Location: '. $cache['cache_url']);
      exit();
    } else {
      header('Content-Type: image/jpeg');
      ImageJPEG($new_image, '', $CFG_jpeg_compression);
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
