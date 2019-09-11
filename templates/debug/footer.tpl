<?php
// SPDX-License-Identifier: BSD-3-Clause

////////////////////////////////////////////////////////////////////////////////
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
