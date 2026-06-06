<?php
$media=$_REQUEST['media'];
$title=$_POST['title'];
$author=$_POST['author'];
$college=$_POST['college'];
$keywords=$_POST['keywords'];
$course=$_POST['course'];
$acc_no=$_POST['acc_no'];

if($media !='True')
{
	header("Location:advance_opac_search.php");
}
?>
<?php
require_once("../db.php");
?>
<html>
<head>
<title>Opac Search For Project Report</title>
<script language="javascript">
function frm_submit()
{
	if((document.frm.title.value !="")||(document.frm.author.value !="")||(document.frm.college.value !="")|| (document.frm.course.value !="")||(document.frm.subject.value !="")||(document.frm.keywords.value !="")||(document.frm.acc_no.value !=""))
	{
		document.frm.submit();

	}
	else
	{
		alert ("Enter the search criteria");

	}

}
</script>
</head>
<body><br/>
<form name="frm" method="POST" action="view_opac_project_search.php" style="background-image: url('../images/Mouse1.gif')">
  <center>
  <table class='forumline' width="60%" colspan='2'>
  <tr><td align='center' Class='head' align='center' colspan='4'>Advance OPAC Search for Project Repor</td></tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;Title</td>
      <td><input type="text" name="title" value="<?=$title?>"></td>
      <td>Author</td>
      <td><input type="text" name="author" value="<?$author?>"></td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;College</td>
	  <td><input type="text" name="college"  value="<?=$college?>"></td>
	  <td>Keywords</td>
      <td><input type="text" name="keywords" value="<?=$keyword?>"></td>
	</tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;Course</td>
	  <td><input type="text" name="course" value="<?=$course?>"><!-- <font color='red'>&nbsp;or&nbsp; --></td>
      <td>Accession No.</td>
	  <td><input type="text" name="acc_no" value="<?=$acc_no?>"></td>
    </tr>
    <tr>
      
    </tr>
	</table>
    <br>
    <div align='center'><input type="submit" name="search" value="Search" class='bgbutton' onClick="frm_submit()"></div>
	</center>
	<p align="center">
    Note: In order to make search accurate and faster please key as many keywords as posible.
</p>
	<p align="left">&nbsp;</p>
	</form>
<!--<table align='right'>
<tr><td>
<div align='right'>
<a href="advance_opac_search.php" >Home</a>
<div>
</td>
</tr>
</table>-->
</body>
</html>