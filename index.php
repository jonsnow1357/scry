<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: index.php,v 1.2 2004/02/08 07:39:02 jbyers Exp $
//
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!                                                            !!
// !! NOTE - this file does not need to be edited; see setup.php !!
// !!                                                            !!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//

// high error notification level; if you see any displayed error, file a bug!
//
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('setup.php');
require_once('functions.php');

//////////////////////////////////////////////////////////////////////////////
// global variable, template initialization, headers
//

$URL_PARTS     = array(); // URL parts
$URL_OFFSET    = 0;       // $URL offset of view name
$VARS          = array(); // URL variables
$T             = array(); // template variables
$VIEW          = '';      // view name
$IMAGE_FILE    = '';      // image filename ('IMG20040201.jpg')
$IMAGE_DIR     = '';      // image directory under $CFG_path_images ('Family/2003')
$PATH          = '';      // full filesystem path to directory / image
$PATH_BASEDIR  = '';      // filesystem path to directory / image without filename

header('X-Powered-By: Scry 1.0 - http://scry.sourceforge.net');

//////////////////////////////////////////////////////////////////////////////
// parse URL
//

$URL_PARTS  = explode('/', trim(addslashes(urldecode($_SERVER['REQUEST_URI'])), '/'));
$URL_OFFSET = array_search('index.php', $URL_PARTS, true) + 1;

// set up view state
//
switch ($URL_PARTS[$URL_OFFSET]) {

 case 'list':
   $VARS[0]   = $URL_PARTS[$URL_OFFSET + 1]; // page number
   $IMAGE_DIR = implode('/', array_slice($URL_PARTS, $URL_OFFSET + 2));
   $VIEW      = 'list';
   break;

 case 'view':
   $VARS[0]          = $URL_PARTS[$URL_OFFSET + 1]; // image index
   $IMAGE_DIR        = implode('/', array_slice($URL_PARTS, $URL_OFFSET + 2, -1));
   list($IMAGE_FILE) = array_slice($URL_PARTS, -1);
   $VIEW             = 'view';
   break;

 case 'image':
   $VARS[0]          = $URL_PARTS[$URL_OFFSET + 1]; // image width
   $IMAGE_DIR        = implode('/', array_slice($URL_PARTS, $URL_OFFSET + 2, -1));
   list($IMAGE_FILE) = array_slice($URL_PARTS, -1);
   $VIEW             = 'image';
   break;

 default:
   header("Location: $CFG_url_album/list/");
   exit();

} // switch $VIEW

//////////////////////////////////////////////////////////////////////////////
// verify path
//

if ($IMAGE_FILE != '' && $IMAGE_DIR != '') {
  $PATH         = "$CFG_path_images/$IMAGE_DIR/$IMAGE_FILE";
  $PATH_BASEDIR = "$CFG_path_images/$IMAGE_DIR";
} else if ($IMAGE_FILE == '' && $IMAGE_DIR != '') {
  $PATH         = "$CFG_path_images/$IMAGE_DIR";
  $PATH_BASEDIR = "$CFG_path_images/$IMAGE_DIR";
} else {
  $PATH         = $CFG_path_images;
  $PATH_BASEDIR = $CFG_path_images;
}

if (!is_readable($PATH)) {
  die("$PATH does not exist or is not readable by the webserver");
} else if (($VIEW == 'image' || $VIEW == 'view') && !is_file($PATH)) {
  die("$PATH is not an image file");
} else if ($VIEW == 'list' && !is_dir($PATH)) {
  die("$PATH is not a directory");
}

//////////////////////////////////////////////////////////////////////////////
// debugging
//

debug('URL_PARTS',    $URL_PARTS);
debug('URL_OFFSET',   $URL_OFFSET);
debug('VARS',         $VARS);
debug('VIEW',         $VIEW);
debug('IMAGE_FILE',   $IMAGE_FILE);
debug('IMAGE_DIR',    $IMAGE_DIR);
debug('PATH',         $PATH);
debug('PATH_BASEDIR', $PATH_BASEDIR);

//////////////////////////////////////////////////////////////////////////////
// punt to view
//

require_once('views/' . $VIEW . '.php');

?>
