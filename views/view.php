<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: view.php,v 1.3 2004/02/10 21:16:54 jbyers Exp $
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
//   $VARS[0] -> index of image in directory file list
//

// fetch directory listing
//
$data = directory_data($PATH_BASEDIR, $IMAGE_DIR); // FS SEE FUNCTION

// assign, display templates
//
$T['current'] =& $data['files'][$VARS[0]]; 
$T['next']    =& $data['files'][($VARS[0] + 1)]; 
$T['prev']    =& $data['files'][($VARS[0] - 1)]; 
$T['path']    =  path_list($IMAGE_DIR); 
debug('T', $T);

include("$CFG_path_template/header.tpl"); // FS READ
include("$CFG_path_template/view.tpl");   // FS READ
include("$CFG_path_template/footer.tpl"); // FS READ

?>
