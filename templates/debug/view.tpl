<?php
//
// Note: Debug is a specialized template set designed for debugging
//       purposes This theme does not display any images.
//

print('<p>Path:<br>');
while(list($k, $p) = @each($T['path'])) { 
  print(' <a href="' . $p['url'] . '">' . $p['name'] . '</a> / ');
}
?>

<p>
current image:<br>
<?php print("<a href=\"" . $T['current']['view_url'] . "\">" . $T['current']['view_url'] . "</a><br><a href=\"" . $T['current']['thumb_url'] . "\">" . $T['current']['thumb_url'] . "</a><br>" . $T['current']['name']); ?>

<p>
next image:<br>
<?php print("<a href=\"" . $T['next']['view_url'] . "\">" . $T['next']['view_url'] . "</a><br><a href=\"" . $T['next']['thumb_url'] . "\">" . $T['next']['thumb_url'] . "</a><br>" . $T['next']['name']); ?>


<p>
prev image:<br>
<?php print("<a href=\"" . $T['prev']['view_url'] . "\">" . $T['prev']['view_url'] . "</a><br><a href=\"" . $T['prev']['thumb_url'] . "\">" . $T['prev']['thumb_url'] . "</a><br>" . $T['prev']['name']); ?>
