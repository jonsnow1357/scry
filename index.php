<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: index.php,v 1.15 2004/11/06 07:14:33 jbyers Exp $
//
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!                                                            !!
// !! NOTE - this file does not need to be edited; see setup.php !!
// !!                                                            !!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//

//////////////////////////////////////////////////////////////////////////////
// Security
//
// require_once calls are based only on static variables or constants.
//
// One variable is used in filesystem reads (search for "FS" in this
// file):
//
//   $PATH  validated below, before FS calls
//

define('SCRY_VERSION', 1.2);

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

require_once('setup.php');
require_once('functions.php');

// remove slashes from $_GET
//
if (get_magic_quotes_gpc()) {
  function stripslashes_deep($value)
    {
      $value = is_array($value) ?
        array_map('stripslashes_deep', $value) :
        stripslashes($value);

      return $value;
    }
  $_GET = array_map('stripslashes_deep', $_GET);
} // if magic_quotes

//////////////////////////////////////////////////////////////////////////////
// global variable, template initialization, headers
//

$T             = array(); // template variables
$VIEW          = '';      // view name
$INDEX         = '';      // index variable (offset or image dimension)
$IMAGE_FILE    = '';      // image filename ('IMG20040201.jpg')
$IMAGE_DIR     = '';      // image directory under $CFG_path_images ('Family/2003')
$PATH          = '';      // full filesystem path to directory / image
$PATH_BASEDIR  = '';      // filesystem path to directory / image without filename

header('X-Powered-By: Scry ' . SCRY_VERSION . ' - http://scry.org');

//////////////////////////////////////////////////////////////////////////////
// parse URL or GET parameters
//

$url_parts     = array(); // URL or path parts
$url_offset    = 0;       // view offset in $URL

// set URL parts, view, index
//
if ($CFG_variable_mode == 'path') {
  $url_parts  = explode('/', trim(urldecode($_SERVER['REQUEST_URI']), '/'));
  $url_offset = array_search('index.php', $url_parts, true) + 1;
  @$VIEW      = $url_parts[$url_offset];
  @$INDEX     = $url_parts[$url_offset + 1];
} else {
  $url_parts  = explode('/', trim(urldecode($_GET['p']), '/'));
  @$VIEW      = $_GET['v'];
  @$INDEX     = $_GET['i'];
} // if path mode

// redirect bad action to root list
//
if (!ereg('^(image|list|view)$', $VIEW)) {
   if ($CFG_variable_mode == 'path') {
     header("Location: $CFG_url_album/list/");
   } else {
     header("Location: $CFG_url_album?v=list");
   }
   exit();
} // if bad action

// set image directory, paths based on view
//
if ($CFG_variable_mode == 'path') {
  if ($VIEW == 'list') {
    $IMAGE_DIR = implode('/', array_slice($url_parts, $url_offset + 2));
  } else {
    $IMAGE_DIR        = implode('/', array_slice($url_parts, $url_offset + 2, -1));
    list($IMAGE_FILE) = array_slice($url_parts, -1);    
  } // if
} else {
  if ($VIEW == 'list') {
    $IMAGE_DIR = $_GET['p'];
  } else {
    $IMAGE_DIR        = implode('/', array_slice($url_parts, 0, -1));
    list($IMAGE_FILE) = array_slice($url_parts, -1);
  } // if
} // if path mode

//////////////////////////////////////////////////////////////////////////////
// set up path derivative variables
// test $PATH for security compliance; must be below $CFG_path_images
//

if ($IMAGE_FILE != '' && $IMAGE_DIR != '') {
  $PATH         = "$CFG_path_images/$IMAGE_DIR/$IMAGE_FILE";
  $PATH_BASEDIR = "$CFG_path_images/$IMAGE_DIR";
} else if ($IMAGE_FILE == '' && $IMAGE_DIR != '') {
  $PATH         = "$CFG_path_images/$IMAGE_DIR";
  $PATH_BASEDIR = "$CFG_path_images/$IMAGE_DIR";
} else if ($IMAGE_FILE != '' ) {
  $PATH         = "$CFG_path_images/$IMAGE_FILE";
  $PATH_BASEDIR = $CFG_path_images;
} else {
  $PATH         = $CFG_path_images;
  $PATH_BASEDIR = $CFG_path_images;
}

path_security_check($PATH, $CFG_path_images);

if (!is_readable($PATH)) { // FS READ
  die("$PATH does not exist or is not readable by the webserver - please verify settings in setup.php");
} else if (($VIEW == 'image' || $VIEW == 'view') && !is_file($PATH)) { // FS READ
  die("$PATH is not a valid image file or cannot be read");
} else if ($VIEW == 'list' && !is_dir($PATH)) { // FS READ
  die("$PATH is not a directory or cannot be read");
}

//////////////////////////////////////////////////////////////////////////////
// debugging
//

debug('url_parts',    $url_parts);  unset($url_parts);
debug('url_offset',   $url_offset); unset($url_offset);

debug('GET',          $_GET);
debug('VIEW',         $VIEW);
debug('INDEX',        $INDEX);
debug('IMAGE_FILE',   $IMAGE_FILE);
debug('IMAGE_DIR',    $IMAGE_DIR);
debug('PATH',         $PATH);
debug('PATH_BASEDIR', $PATH_BASEDIR);

//////////////////////////////////////////////////////////////////////////////
// assign global template variables; delegate to view
//

$T['title']        = $CFG_album_title;
$T['template']     = $CFG_template;
$T['template_url'] = $CFG_url_template;

require_once('views/' . $VIEW . '.php');

?>
