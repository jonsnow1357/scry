<?php
// SPDX-License-Identifier: BSD-3-Clause

////////////////////////////////////////////////////////////////////////////////
// Note: setup is a specialized template for setup only.  See the
//       default template for a working example.
//
?>

<p id="title">Setup</p>

<p>If you're reading this, you're looking at a fresh installation of
<a href="http://scry.org">Scry</a>.  On this page, we'll verify that
everything is set up correctly before you turn Scry on.  Follow any
instructions in red and reload the page until everything is green.<p>

<p id="title">1. PHP and GD</p>

<table width="100%">
  <tr>
    <td width="33%">PHP version</td>
    <td>
<?php
  $version_parts = explode('.', PHP_VERSION);

if ($version_parts[0] < 4 ||
    ($version_parts[0] == 4 &&
     $version_parts[1] == 0)) {
  print('<big><strong><font color="#990000">PHP version <?php print PHP_VERSION; ?> installed</font></strong></big><br />Please install PHP version 4.0.6 or newer to use Scry.  PHP is available at <a href="http://php.net">http://php.net</a>.');
} else {
  print('<big><strong><font color="#009900">OK </font></strong></big>');
}
?>
    </td>
  </tr>
  <tr>
    <td width="33%">GD version</td>
    <td>
<?php
if ((!function_exists('ImageCopyResampled') &&
     !function_exists('ImageCopyResized')) ||
    !function_exists('ImageJPEG')) {
  print('<big><strong><font color="#990000">GD does not appear to be installed or does not support JPEG</font></strong></big><br />Please install GD version 2.0 or newer with JPEG support as a PHP module.  Instructions on adding modules to PHP can be found in the installation documentation at <a href="http://php.net">http://php.net</a>');
} else {
  print('<big><strong><font color="#009900">OK</font></strong></big>');
}
?>
    </td>
  </tr>
</table>

<p id="title">2. Photo Directory</p>

<table width="100%">
  <tr>
    <td width="33%">Valid?</td>
    <td>
<?php
if (!is_dir($CFG_path_images)) {
  print('<big><strong><font color="#990000">The photo directory does not appear to be valid</font></strong></big>');
} else {
  print('<big><strong><font color="#009900">OK</font></strong></big>');
}
?>
    </td>
  </tr>
  <tr>
    <td width="33%">Readable?</td>
    <td>
<?php
if (!is_readable($CFG_path_images)) {
  print('<big><strong><font color="#990000">Scry cannot read the photo directory</font></strong></big>');
} else {
  print('<big><strong><font color="#009900">OK</font></strong></big>');
}
?>
    </td>
  </tr>
</table>

<p id="title">3. Cache Directory</p>

<table width="100%">
  <tr>
    <td width="33%">Valid?</td>
    <td>
<?php
if (!is_dir($CFG_path_cache)) {
  print('<big><strong><font color="#990000">The cache directory does not appear to be valid</font></strong></big>');
} else {
  print('<big><strong><font color="#009900">OK</font></strong></big>');
}
?>
    </td>
  </tr>
  <tr>
    <td width="33%">Writable?</td>
    <td>
<?php
if (!is_writable($CFG_path_cache)) {
  print('<big><strong><font color="#990000">Scry cannot write to the cache directory</font></strong></big>');
} else {
  print('<big><strong><font color="#009900">OK</font></strong></big>');
}
?>
    </td>
  </tr>
</table>

<p id="title">4. Almost Done</p>

There's one last step to switch Scry on.  In setup.php, change <i><b>$CFG_template</b></i> to <i><b>'default'</b></i>.  This will switch on your photo album and you will no longer see this setup screen.  Any photos and folders you then place in your images Enjoy!

<p id="title">Troubleshooting</p>

If you're unable to get Scry to work, please visit the troubleshooting section of <a href="http://scry.org">http://scry.org</a>.  To help us understand your server environment better, please include the following text in any correspondence (email, mailing list message, bug report).  It will help us tremendously.

<?php
// GD
//
$gd_version = 'unknown';
if (function_exists('gd_info')) {
  $gd_info    = gd_info();
  $gd_version = $gd_info['GD Version'];
} // if
?>

<small><pre>

scry[<?php print SCRY_VERSION; ?>]_php[<?php print PHP_VERSION; ?>]_gd[<?php print $gd_version; ?>]
serversig[<?php print $_SERVER['SERVER_SIGNATURE'];?>]_serversoft[<?php print $_SERVER['SERVER_SOFTWARE'];?>]
docroot[<?php print $_SERVER['DOCUMENT_ROOT']; ?>]
script_file[<?php print $_SERVER['SCRIPT_FILENAME'];?>]
script_uri[<?php print $_SERVER['SCRIPT_URI'];?>]

</pre></small>
