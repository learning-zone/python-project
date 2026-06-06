<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=salaryslip.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b><table border=1>
  <tr>
    <td height=66 colspan=2>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=2></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
</table></body></html>";
?>