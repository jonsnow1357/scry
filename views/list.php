<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: list.php,v 1.2 2004/02/08 07:39:02 jbyers Exp $
//

///////////////////////////////////////////////////////////////////////////////
// list view
//   $VARS[0] -> page N of listings, based on $CFG_max_thumbs
//

// fetch directory listing
//
$data = directory_data($PATH, "$IMAGE_DIR$IMAGE_FILE");

// assign, display templates
//
$T['dirs']  =& $data['directories']; 
$T['files'] =& $data['files']; 
$T['path']  =& path_list($IMAGE_DIR); 
debug('T', $T);

include("$CFG_path_template/header.tpl");
include("$CFG_path_template/list.tpl");
include("$CFG_path_template/footer.tpl");

?>
