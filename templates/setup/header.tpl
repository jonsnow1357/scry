<?php
// SPDX-License-Identifier: BSD-3-Clause

////////////////////////////////////////////////////////////////////////////////
// Note: setup is a specialized template for setup only.  See the
//       default template for a working example.
//

// force all pages to list view
//
if ($VIEW != 'list') {
  header('Location: ' . build_url('list', 0, ''));
  exit();
} // if

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>Scry: Simple PHP Photo Album</title>
  <link rel="stylesheet" href="<?php print $T['template_url']; ?>/scry.css" />
</head>
<body>

<table align="center" width="85%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td>

<div class="header">
  Scry: Simple PHP Photo Album
</div>

    </td>
    <td align="right">

<img src="<?php print $T['template_url']; ?>/icon.png" width="10%" height="10%">

    </td>
  </tr>

  <tr>
    <td colspan="2">

<div class="body">
