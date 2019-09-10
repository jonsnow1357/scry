<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
?>

<table cellpadding="5" cellspacing="0" width="85%" border="0" align="center">
<?php
if (@count($T['dirs'])) {
?>
  <tr>
    <td width="100%" id="t_slim" align="center" colspan="2">

<?php
while(list($k, $d) = @each($T['dirs'])) {
  print('<div class="folder"><a href="' . $d['list_url'] . '"><img src="' . $T['template_url'] . '/folder.png" alt="'. $d['name'] . '" width="72" height="72" border="0" /><br />' . $d['name'] . "</a></div>\n");
}
?>

    </td>
  </tr>

<?php
} // if dirs
if (@count($T['files'])) {
?>

  <tr>
    <td id="t_main" width="100%" colspan="2">
      <div class="images">

<?php
while(list($k, $f) = @each($T['files'])) {
  print('<a href="' . $f['view_url'] . '"><img src="' . $f['thumb_url'] . '" alt="' . $f['name'] . '" border="0"' . " /></a>\n");
} // while
?>

      </div>
    </td>
  </tr>
  <tr>
    <td align="left"><?php if ($T['offset_prev'] != -1) print('<a href="' . $T['offset_prev_url'] . '">&lt; previous page</a>'); ?></td>
    <td align="right"><?php if ($T['offset_next'] != -1) print('<a href="' . $T['offset_next_url'] . '">next page &gt;</a>'); ?></td>
  </tr>
<?php

} // if files

if (!@count($T['dirs']) && !@count($T['files'])) {

?>

  <tr>
    <td id="t_main" width="100%" colspan="2">
      <div class="images">
        <p align="center">No photos or folders found</p>
      </div>
    </td>
  </tr>

<?php } // if no dirs or files ?>

</table>
