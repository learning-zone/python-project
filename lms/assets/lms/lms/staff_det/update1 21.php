<html>
 <?php
	session_start();
	include("../db.php");
	//print_r($_POST);
	$id=$_REQUEST['id'];
	
	?>
<head>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<script>
function reloadme()
	{
		document.frm.action="update1.php";
		document.frm.submit();
	}
</script>
</head>
<body>
<form Name="frm"  method="post">
<br>  
<fieldset style="height:auto"> 
<legend>Applied Leave</legend>  
<table  align='center' border="0" width="100%" cellpadding="5" cellspacing="0">
	<?php
	$r5=mysql_fetch_array(mysql_query("select id,type,f_date,t_date,backup,days,reason from staff_leave where user='$user' and status=1 and id='$id'"));
		$tfdate1=explode('-',$r5[2]);
		$fdate1=$tfdate1[2]."-".$tfdate1[1]."-".$tfdate1[0];
		$ttdate1=explode('-',$r5[3]);
		$tdate1=$ttdate1[2]."-".$ttdate1[1]."-".$ttdate1[0];
	?>
	<tr>
	<td>&nbsp;Leave Type*</td>
	<td><input type="text" name="manager" value="<?=$r5[1]?>"  readonly style="background-color: #FFFFCC">
    </td>
    </tr>
    <tr>
	<td>&nbsp;Leave Duration*</td>
	<td> <input type="text" readonly name="adate" value="<?=$fdate1?>" size="10" style="background-color: #FFFFCC" required> &nbsp;
     <a href="javascript:showCal('Calendar1')"><img src="Calendar.gif" align="absmiddle"></a></td>
    </tr>
    <tr>
	<td>&nbsp;To Date*</td>
	<td> <input type="text" readonly name="bdate" value="<?=$tdate1?>" size="10" style="background-color: #FFFFCC" required> &nbsp;
     <a href="javascript:showCal('Calendar2')"><img src="Calendar.gif" align="absmiddle"></a></td>
    </tr>
    <tr>
	<td>&nbsp;No. Of Days</td>
	<td><input type="text" name="manager" value="<?=$r5[5]?>"  readonly style="background-color: #FFFFCC"></td>
    </tr>
      <tr>
	<td>&nbsp;Reason*</td>
	<td><input type="text" name="manager" value="<?=$r5[6]?>"  readonly style="background-color: #FFFFCC"></td>
    </tr>
</table>
</fieldset>
<br>
<div align='center'><input type='submit' name='subn' value='Update' class='bgbutton'></div>
<br>
</form>
</BODY>
</HTML>
