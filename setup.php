<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: setup.php,v 1.1 2004/02/05 06:54:40 jbyers Exp $
//

//////////////////////////////////////////////////////////////////////////////
// configuration
//

// paths without trailing slashes
//
$CFG_path_images   = '/CHANGEME/scry/photos';
$CFG_path_cache    = '/CHANGEME/scry/cache';
$CFG_path_template = '/CHANGEME/scry/templates/default';

$CFG_url_images    = 'http://CHANGEME/scry/photos';
$CFG_url_cache     = 'http://CHANGEME/scry/cache';
$CFG_url_album     = 'http://CHANGEME/scry/index.php';

// are the cache and images directories outside the webserver's docroot?
//
$CFG_cache_outside_docroot  = false;
$CFG_images_outside_docroot = false;

// default image sizes for thumbnails and image view page
//
$CFG_thumb_width   = 100;
$CFG_thumb_height  = 75;

$CFG_view_width    = 640;
$CFG_view_height   = 480;

// page titles
//
$CFG_album_name       = 'photo album';
$CFG_album_name_short = 'photos';

// image display and resizing settings
//
$CFG_image_valid = "(.jpg|.jpeg)$";
$CFG_image_sizes = array('640x480',
                         '800x600',
                         '1024x768',
                         '1280x1024',
                         '2048x1536');

// image cache settings
//
$CFG_cache_enable    = true;
$CFG_cache_allowed   = array('100x75', '640x480');

// turn on for debugging output on the image view
//
$CFG_debug_image = false;

?>
