<?php
// SPDX-License-Identifier: BSD-3-Clause
?>

<table cellpadding="5" cellspacing="0" width="85%" border="0" align="center">
  <tr>
    <td align="left">
      <?php
      //$url = ereg_replace("scry/", "", $CFG_url_scry);
      $url = preg_replace("/scry\//", "", $CFG_url_scry);
      echo "back to <a href=\"{$url}\">home page</a>";
      ?>
    </td>
    <td align="right">
      Powered by <a href="https://github.com/jonsnow1357/scry">Scry</a>
    </td>
  </tr>
</table>

</body>
</html>
