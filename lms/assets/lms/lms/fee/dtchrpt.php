<?php
session_start();
include("../db.php");
?>
<html>
<head><LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<title>Fee Summary</title>
</head>
<body>
<script LANGUAGE="JavaScript">
function send()
{

	document.frm.action='feecol1.php';
	document.frm.submit();
}
function frm_reload()
{
	document.frm.action='feecol5.php';
	document.frm.submit();
} 
</script>

	<form name="frm" method='post'>
    <input type="hidden" name="financial" value="Financial" >
    <table class='forumline' align='center' width="90%" >
    <tr>
    	<td Class="head" colspan='2' align='center'>
        Financial-Year Wise Fee Report</td>
    </tr>
        <tr>
      <td>&nbsp;&nbsp;Financial-Year   </td>
      <td align=''>
        <select name="a_year" id="a_year" >
          <option value='0'>Select Year</option>
          <?php
				   $MyYear=date('Y')-10;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
          <option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
          <?php
					 }
						   ?>
          </select>
    </tr>
</table>
<br>
<div align="center">
<input type="button" name="search" value="Search" onClick="frm_reload()" class="bgbutton">
</div>
</form></body>
</html>