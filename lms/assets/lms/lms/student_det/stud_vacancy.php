<html>
<head>
<?php
session_start();
include("../db.php");
include("../urlaccess.php");
if($user=='')
{
	header("Location:login.php");
}
else
{
	$p_th=$_SERVER['SCRIPT_NAME'];
	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");
	if(rowcount($qry)==0)
	{
		header("Location:login.php");
	}
}
?>
<script language="javascript">
function excelrpt()
{
	document.frm.action="excelvacancy.php";
	document.frm.submit();
}
function htmlrpt()
{
	document.frm.action="htmlvacancy.php";
	document.frm.submit();
}
function reload()
{
	document.frm.action='stud_vacancy.php';
	document.frm.submit();
}
</script>
</head>
<body>
<form Name="frm"  method="Post">
<?php
$rs1 = execute("SELECT * FROM admission");
$row1 = rowcount($rs1);
if($row1 == 0)
{
	echo("<div class='label'>No Admission Type Details...</div>");
}
?>
<table class='forumline' width="400" align=center>
<tr><td class='head'align=center colspan=2><b>Vacancy Statement</b></td></tr>
<tr><td align="right"><b>Course Head :</b><font color=Red>*</font></td>
<td><select name="ctype" onchange='reload()'>
<option value=''>Select Course Head</option>
<?php
$cor_hea = execute("SELECT * FROM coursehead");
$cor_num = rowcount($cor_hea);
for($i=0;$i<$cor_num;$i++)
{
	$cor_rs = fetcharray($cor_hea,$i);
	if($cor_rs[0]==$ctype)
	{
		echo("<option value='$cor_rs[0]' selected>$cor_rs[1]</option>\n");
	}
	else
	{
		echo("<option value='$cor_rs[0]'>$cor_rs[1]</option>\n");
	}
}
?>
</select></td></tr>
<?php
if($ctype !='')
{
	?>
	
	<tr><td align=right >Academic Year : <font color=Red>*</font></td>
	<td><SELECT name="acayr">
	<OPTION selected value=-1>Select</option>
	<?php
	$tempyear1=date("Y");
	$tempyear1=$tempyear1-5;
	$ar = date("Y");
	for($i=$tempyear1;$i<=$ar;$i++)
	{
		$j=$i+1;
		if($acayr==$i)
			echo "<OPTION value=$i selected>$i-$j</option>";
		else
			echo "<OPTION value=$i>$i-$j</option>";
	}
	?>
	</SELECT></td></tr>
	<tr><td align=right nowrap>Admission Type : <font color=Red>*</font></td>
	<td><select name="AdmName" onchange='reload()'>
	<OPTION selected value=-1>Select Admission Type </option>
	<?php
	for($i=0;$i<$row1;$i++)
	{
		$r1 = fetcharray($rs1,$i);
		if($AdmName==$r1["id"])
			echo "<option value=$r1[id] selected>$r1[name]</option>";
		else
			echo "<option value=$r1[id]>$r1[name]</option>";
	}
	?>
	</select></td></tr>
	</table><br></br>
	<?php
}
	if($AdmName!=-1 && $AdmName!='')
	{
		?>
		<div align="center"><input class=bgbutton type="button" value=" HTML Report " onclick='htmlrpt()'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input class=bgbutton type="button" value=" EXCEL Report " onclick='excelrpt()'></div>
		<?php
	}
?>
</form>
</body>
</html>