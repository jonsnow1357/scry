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
  <tr>
    <td align="center" id="t_main" width="100%">

      <table align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td width="100%" colspan="3" align="center">
            <div class="images">
            <img src="<?php print $T['current']['image_url']; ?>" alt="<?php print $T['current']['name']; ?>" width="<?php print $T['current']['view_size'][0]; ?>" height="<?php print $T['current']['view_size'][1]; ?>" />
            <br />
            <?php print $T['current']['name']; ?>
            <br />
            <a href="<?php print($T['current']['raw_url']); ?>"><?php print($T['current']['image_size'][0] . 'x' . $T['current']['image_size'][1] . ', ' . $T['current']['file_size']); ?></a>
            </div>
          </td>
        </tr>

        <tr>
          <td width="30%" align="left" valign="bottom">
            <div class="images">

<?php
if (is_array($T['prev'])) {
  print('<a style="text-decoration: none;" href="' . $T['prev']['view_url'] . '"><img src="' . $T['prev']['thumb_url'] . '" alt="previous" /><br />&lt; previous</a>');
} else {
  print("&nbsp;");
}
?>

            </div>
          </td>
          <td width="40%" align="center" valign="bottom">
            <p>

<?php
if (is_array($T['current']['exif_data'])) {
  // there are hundreds of exif tags; this is just a sample based images from a Canon S30
  // see exif.php for more details
  //
  //print(eregi_replace('[^a-z0-9 /-_]', '', $T['current']['exif_data']['IFD0']['Model']) . "<br />");
  //print(eregi_replace('[^a-z0-9 /-_]', '', $T['current']['exif_data']['IFD0']['DateTime']) . "<br />");
  //print(eregi_replace('[^a-z0-9 /-_]', '', $T['current']['exif_data']['SubIFD']['ExposureTime']) . " - ");
  //print(eregi_replace('[^a-z0-9 /-_]', '', $T['current']['exif_data']['SubIFD']['FNumber']) . " - ");
  //print(eregi_replace('[^a-z0-9 /-_]', '', $T['current']['exif_data']['SubIFD']['Flash']) . "<br />");
  print(preg_replace('/[^a-z0-9 /-_]/', '', $T['current']['exif_data']['IFD0']['Model']) . "<br />");
  print(preg_replace('/[^a-z0-9 /-_]/', '', $T['current']['exif_data']['IFD0']['DateTime']) . "<br />");
  print(preg_replace('/[^a-z0-9 /-_]/', '', $T['current']['exif_data']['SubIFD']['ExposureTime']) . " - ");
  print(preg_replace('/[^a-z0-9 /-_]/', '', $T['current']['exif_data']['SubIFD']['FNumber']) . " - ");
  print(preg_replace('/[^a-z0-9 /-_]/', '', $T['current']['exif_data']['SubIFD']['Flash']) . "<br />");
}
?>
            </p>
          </td>
          <td width="30%" align="right" valign="bottom">
            <div class="images">

<?php
if (is_array($T['next'])) {
  print('<a style="text-decoration: none;" href="' . $T['next']['view_url'] . '"><img src="' . $T['next']['thumb_url'] . '" alt="next" /><br />next &gt;</a>');
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
