<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: view.tpl,v 1.4 2004/09/30 20:12:44 jbyers Exp $
//
?>

<table cellpadding="5" cellspacing="0" width="85%" border="0" align="center">
  <tr>
    <td align="center" id="t_main" width="100%">

      <table align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td width="100%" colspan="3" align="center">
            <div class="images">
            <img src="<?php print $T['current']['image_url']; ?>" alt="<?php print $T['current']['name']; ?>" />
            <br />
            <?php print $T['current']['name']; ?> 
            <br />
            <a href="<?php print($T['current']['raw_url']); ?>"><?php print($T['current']['image_size'] . ', ' . $T['current']['file_size']); ?></a> 
            </div>
          </td>
        </tr>

        <tr>
          <td width="30%" align="left" valign="bottom">
            <div class="images">
<?php 
if (is_array($T['prev'])) {
  print('<a href="' . $T['prev']['view_url'] . '"><img src="' . $T['prev']['thumb_url'] . '" alt="previous" /></a><br />previous'); 
} else {
  print("&nbsp;");
}
?>
            </div>
          </td>
          <td width="40%" align="middle" valign="bottom">
             <?php // print_r($T['current']['exif_data']); ?>
          </td>
          <td width="30%" align="right" valign="bottom">
            <div class="images">
<?php 
if (is_array($T['next'])) {
  print('<a href="' . $T['next']['view_url'] . '"><img src="' . $T['next']['thumb_url'] . '" alt="next" /></a><br />next'); 
} else {
  print("&nbsp;");
}
?>
            </div>
          </td>
        </tr>
      </table>

    </td>
  </tr>
</table>

