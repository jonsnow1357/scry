<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.sourceforge.net
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: list.tpl,v 1.4 2004/09/29 01:43:35 jbyers Exp $
//
?>

<table cellpadding="5" cellspacing="0" width="85%" border="0" align="center">
<?php if (@count($T['dirs'])) { ?>
  <tr>
    <td width="100%" id="t_main" align="center">

<?php
while(list($k, $d) = @each($T['dirs'])) { 
  print('<div class="folder"><a href="' . $d['list_url'] . '"><img src="' . $CFG_url_template . '/folder.png" alt="'. $d['name'] . '" width="72" height="72" border="0" /><br />' . $d['name'] . "</a></div>\n");
}
?>

    </td>
  </tr>
<?php } // if ?>

<?php if (@count($T['files'])) { ?>
  <tr>
    <td id="t_main" width="100%">
      <div class="images">

<?php
while(list($k, $f) = @each($T['files'])) { 
  print('<a href="' . $f['view_url'] . '"><img src="' . $f['thumb_url'] . '" alt="' . $f['name'] . '" border="0"' . " /></a>\n");
}
?>

      </div>
    </td>
  </tr>
<?php } // if ?>
</table>