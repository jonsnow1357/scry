<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: list.tpl,v 1.1 2004/02/08 07:40:21 jbyers Exp $
//
?>

<table cellpadding="5" cellspacing="0" width="85%" border="1">
  <tr>
    <td width="100%">
<div>
<?php
while(list($k, $d) = @each($T['dirs'])) { 
  print('<div class="folder"><a href="' . $d['view_url'] . '"><img src="/scry/templates/default/folder.png" alt="TODO" width="72" height="72" /><br />' . $d['name'] . "</a></div>\n");
}
?>
</div>
    </td>
  </tr>
<?php if (@count($T['files'])) { ?>
  <tr>
    <td id="t_main" width="100%">
      <div class="images">
<?php
while(list($k, $f) = @each($T['files'])) { 
  print('<a href="' . $f['view_url'] . '"><img src="' . $f['thumb_url'] . '" alt="TODO" border="0"' . " /></a>\n");
}
?>
      </div>
    </td>
  </tr>
<?php } // if ?>
</table>