<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// Note: debug is a specialized template set designed for debugging
//       purposes. This template does not display any images.
//

print('<p>Path:<br>');
while(list($k, $p) = @each($T['path'])) {
  print(' <a href="' . $p['url'] . '">' . $p['name'] . '</a> / ');
}

print('<p>Directories:<br><table>');
while(list($k, $d) = @each($T['dirs'])) {
  print('<tr><td>' . $d['name'] . '</td><td><a href="' . $d['list_url'] . '">' . $d['list_url'] . '</a></td></tr>');
}
print('</table>');

print('<p>Files:<br><table>');
while(list($k, $f) = @each($T['files'])) {
  print('<tr><td>' . $f['name'] . '</td><td><a href="' . $f['view_url'] . '">' . $f['view_url'] . '</a><br>' . $f['thumb_url'] . '</td></tr>');
}
print('</table>');

?>
