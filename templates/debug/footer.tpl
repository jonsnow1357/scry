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
?>

<p>
Debug variables:

<pre>
<?php

print(htmlentities(implode("\n", $DEBUG_MESSAGES)));

?>
</pre>
