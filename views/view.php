<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: view.php,v 1.2 2004/02/08 07:39:02 jbyers Exp $
//

///////////////////////////////////////////////////////////////////////////////
// detail view
//   $VARS[0] -> index of image in directory file list
//

// fetch directory listing
//
$data = directory_data($PATH_BASEDIR, $IMAGE_DIR);

// assign, display templates
//
$T['current'] =& $data['files'][$VARS[0]]; 
$T['next']    =& $data['files'][($VARS[0] + 1)]; 
$T['prev']    =& $data['files'][($VARS[0] - 1)]; 
$T['path']    =  path_list($IMAGE_DIR); 
debug('T', $T);

include("$CFG_path_template/header.tpl");
include("$CFG_path_template/view.tpl");
include("$CFG_path_template/footer.tpl");

?>
