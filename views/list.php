<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: list.php,v 1.5 2004/09/30 20:09:58 jbyers Exp $
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
// list view
//   $INDEX -> page N of listings, based on $CFG_max_thumbs
//

// fetch directory listing
//
$data = directory_data($PATH, "$IMAGE_DIR$IMAGE_FILE"); // FS SEE FUNCTION

// assign, display templates
//
$T['dirs']  =& $data['directories']; 
$T['files'] =& $data['files']; 
$T['path']  =& path_list($IMAGE_DIR); 
debug('T', $T);

include("$CFG_path_template/header.tpl"); // FS READ
include("$CFG_path_template/list.tpl");   // FS READ
include("$CFG_path_template/footer.tpl"); // FS READ

?>
