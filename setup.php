<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: setup.php,v 1.9 2004/09/30 20:51:23 jbyers Exp $
//
 
/***************************************************************************
 *                                                                         *
 * The first five values must be set to install Scry.  See README.         *
 *                                                                         *
 ***************************************************************************/

$CFG_url_scry    = 'http://jbyers.com/scry/';
$CFG_url_images  = 'http://jbyers.com/photos-nopub/';

$CFG_path_scry   = '/var/www/jbyers.com/docroot/scry';
$CFG_path_images = '/var/www/jbyers.com/docroot/photos-nopub';

$CFG_template    = 'debug';

$CFG_album_title = 'photo album';
$CFG_album_name  = 'photos';

/***************************************************************************
 *                                                                         *
 * No further configuration changes are needed for a standard Scry setup.  *
 *                                                                         *
 ***************************************************************************/

// URL variable mode, see DESIGN for details; if in doubt, use 'get'
//   'get'  for GET variables
//   'path' for path parsing
//   
$CFG_variable_mode = 'get';

// default image sizes for thumbnails and image view page
//
$CFG_thumb_width   = 100;
$CFG_thumb_height  = 75;

$CFG_image_width   = 640;
$CFG_image_height  = 480;

// valid file extensions - case insensitive (jpg will also match JPG)
//
$CFG_image_valid = array("jpg", "jpeg");

// are the cache and images directories outside the webserver's docroot?
//
$CFG_cache_outside_docroot  = false;
$CFG_images_outside_docroot = false;

// enable resized image cache in cache directory / directories
//
$CFG_cache_enable = false;

// CFG_resize_fast set to true will make photo resizing faster but lower quality
// CFG_use_old_gd  will use GD 1.6 functions instead of 2.0 functions
//
$CFG_resize_fast     = false;
$CFG_use_old_gd      = false;

// if CFG_resize_external is set, scry will use this external command for image
// resizing instead of internal GD, removing the GD dependency entirely
// the following variables are replaced in the string:
//
//   name            purpose                 example
//   -----           --------                --------
//   %WIDTH%         target width            800
//   %HEIGHT%        target height           600
//   %SRC%           full source image path  /var/www/photos/album/image1.jpg
//   %DEST%          full destination path   /var/www/scry/cache/800x600_album_image1.jpg
//
// example: ImageMagick convert
//
//$CFG_resize_external = '/usr/bin/convert -resize %WIDTH%x%HEIGHT% %SRC% %DEST%';

// turn on for debugging output on the image view
// note: when on, images will appear broken and output text
//
$CFG_debug_image = false;

// derived URLs and paths
//
$CFG_url_album     = rtrim($CFG_url_scry, '/')  . '/index.php';
$CFG_path_cache    = rtrim($CFG_path_scry, '/') . '/cache';
$CFG_path_template = rtrim($CFG_path_scry, '/') . '/templates/' . $CFG_template;
$CFG_url_cache     = rtrim($CFG_url_scry, '/')  . '/cache';
$CFG_url_template  = rtrim($CFG_url_scry, '/')  . '/templates/' . $CFG_template;

?>
