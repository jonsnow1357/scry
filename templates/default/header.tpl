<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title><?php print $CFG_album_name; ?></title>
  <link rel="stylesheet" href="/scry/templates/default/scry.css" />
</head>
<body>

<p id="path">
<?php
while(list($k, $p) = @each($T['path'])) { 
  print(" <a href=\"$p[url]\">$p[name]</a> / ");
}

if ($IMAGE_FILE != '') {
  print $IMAGE_FILE;
}

?>
</p>