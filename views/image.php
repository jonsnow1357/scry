<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: image.php,v 1.2 2004/02/08 07:39:02 jbyers Exp $
//

///////////////////////////////////////////////////////////////////////////////
// image view
//   $VARS[0] -> image width x image height
//

list($x, $y) = parse_resolution($VARS[0]);

// fetch image properties
//
$image_props = GetImageSize($PATH);

if (!is_array($image_props)) {
  die('bad props');
} 

// width and height may be inverted; if input x > y && image x < y, invert input x and y
// 
$aspect_ratio   = (float)($image_props[0] / $image_props[1]);
$resize_x = $x;
$resize_y = $y;

if (($x > $y && $image_props[0] < $image_props[1]) || ($x < $y && $image_props[0] > $image_props[1])) {
  $resize_x = (int)($resize_y * $aspect_ratio);
}

// if caching enabled and file exists, redirect
//
$cache = cache_test("$IMAGE_DIR/$IMAGE_FILE", $resize_x, $resize_y);
//$cache_file = $CFG_path_cache . '/' . $resize_x . 'x' . $resize_y . '_' . str_replace('/', '_', $IMAGE_DIR . '/' . $IMAGE_FILE);
//$cache_url  = $CFG_url_cache  . '/' . $resize_x . 'x' . $resize_y . '_' . str_replace('/', '_', $IMAGE_DIR . '/' . $IMAGE_FILE);

debug('aspect_ratio', $aspect_ratio);
debug('resize_x',     $resize_x);
debug('resize_y',     $resize_y);
debug('image_x',      $image_props[0]);
debug('image_y',      $image_props[1]);
debug('cache',        $cache);

if (!$CFG_debug_image) {
  // redirect to or load image inline if cache hit
  //
  if ($cache['is_cached']) {
    if ($CFG_cache_outside_docroot) {
      header('Content-Type: image/jpeg');
      readfile($cache['path']);
      exit();
    } else {
      header('Location: ' . $cache['cache_url']);
      exit();
    }
  } else {
    if ($resize_x == $image_props[0] && $resize_y == $image_props[1]) {
      // show native image
      //
      header("Location: $CFG_path_images/$IMAGE_SUBDIR/$IMAGE_FILE");
      exit();
    } else {
      // resample image, saving to disk if caching enabled
      //
      $new_image = ImageCreateTrueColor($resize_x, $resize_y);
      $src_image = ImageCreateFromJPEG($PATH);
      ImageCopyResampled($new_image, 
                         $src_image, 
                         0, 0, 0, 0, 
                         $resize_x,
                         $resize_y,
                         $image_props[0],
                         $image_props[1]);
      
      if ($CFG_cache_enable && is_writable($CFG_path_cache)) {
        ImageJPEG($new_image, $cache['path']);
        header('Location: '. $cache['cache_url']);
        exit();
      } else {
        header('Content-Type: image/jpeg');
        ImageJPEG($new_image);
        exit();
      } // if cache write
    } // if image native size
  } // if cache
} else {
  print('<p>' . implode('<br>', $DEBUG_MESSAGES));
} // if debug mode

?>
