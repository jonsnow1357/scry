<?php
//
// Scry - Simple PHP Photo Album
// Copyright 2004 James Byers <jbyers@users.sf.net>
// http://scry.org
//
// Scry is distributed under a BSD License.  See LICENSE for details.
//
// $Id: footer.tpl,v 1.4 2004/09/30 20:17:05 jbyers Exp $
//
// Note: debug is a specialized template set designed for debugging
//       purposes This theme does not display any images. 
//
?>

<p>
Debug variables:

<pre>
<?php

print(implode('\n', $DEBUG_MESSAGES));

?>
</pre>


