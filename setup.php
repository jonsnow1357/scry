<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: setup.php,v 1.3 2004/02/08 08:50:25 jbyers Exp $
//

//////////////////////////////////////////////////////////////////////////////
// configuration
//

// paths without trailing slashes
//
$CFG_url_album     = 'http://jbyers.com/scry/index.php';

$CFG_path_images   = '/var/www/jbyers.com/docroot/photos';
$CFG_path_cache    = '/var/www/jbyers.com/docroot/scry/cache';
$CFG_path_template = '/var/www/jbyers.com/docroot/scry/templates/default';

$CFG_url_images    = 'http://jbyers.com/photos';
$CFG_url_cache     = 'http://jbyers.com/scry/cache';
$CFG_path_template = 'http://jbyers.com/scry/templates/default';

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
