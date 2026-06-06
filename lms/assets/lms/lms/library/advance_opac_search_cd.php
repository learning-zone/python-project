<?php
$id=$_POST['id'];
$media=$_REQUEST['media'];
$media_type=$_REQUEST['media_type'];
$title=$_POST['title'];
$author=$_POST['author'];
$source_acc_no=$_POST['source_acc_no'];
$volume=$_POST['volume'];
$issue=$_POST['issue'];
$source=$_POST['source'];
$month=$_POST['month'];
$year=$_POST['year'];
$acc_no=$_POST['acc_no'];

if($media=='False')
{
	header("Location:advance_opac_search.php");
}
?>
<?php
require_once("../db.php");
?>
<html>
<head>
<title>Opac Search For CD</title>
<script language="javascript">
function frm_submit()
{
	if((document.frm.source.value !="")||(document.frm.source_acc_no.value !="")||(document.frm.title.value !="")||(document.frm.author.value !="")||(document.frm.acc_no.value !="")||(document.frm.volume.value !="")||(document.frm.issue.value !="")||(document.frm.month.value !="")||(document.frm.year.value !=""))
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
<body>
<?php
if($media_type=="2")
{
?>
<table  width="60%" class='forumline' align='center' colspan='4'>
<tr><td align='center' Class='head' colspan='2'>Advance OPAC Search for CD/DVD</td></tr>
<p align="center">&nbsp;</p>
<p>
  <?
}
else
{
?>
</p>
<p>&nbsp; </p>
<h4 align="center">OPAC Search for CD's</h4>
<?
}
?>
<form name="frm" method="POST" action="view_opac_cd_search.php" style="background-image: url('../images/Mouse1.gif')">
<input type="hidden" name="media_type" value="<?php echo $media_type?>">

<!--<table  width="60%" class='forumline' align='center' colspan='4'>-->
<tr>
  <td align="right">Title&nbsp;&nbsp;&nbsp;</td>
  <td width="57%"><input type="text" name="title"  value="<?php echo $title?>"></td>
 </tr>
 <tr>
  <td align="right">Author&nbsp;&nbsp;&nbsp;</td>
  <td><input type="text" name="author"  value="<?$author?>"></td>
</tr>
<tr>
<?
if($media_type=="2")
	{
	?>
	   
	      <td align="right">Source No&nbsp;&nbsp;&nbsp;</td>
		  <td><input type="text" name="source_acc_no"  value="<?php echo $source_acc_no?>"></td>
		  
	</tr>
	<?
		echo "<input type='hidden' name='volume'>";
		echo "<input type='hidden' name='issue'>";
		echo "<input type='hidden' name='month'>";
		echo "<input type='hidden' name='year'>";
		echo "<input type='hidden' name='source'>";
	}
	else
	{
		echo "<input type='hidden' name='source_acc_no'>";
	?>
	 <tr>
	   <td width="17%">Volume No</td>
	   <td colspan="3"><input type="text" name="volume"  value="<?php echo $volume?>"></td>
	 </tr>
	 <tr>
	   <td>Issue No.</td>
	   <td><input type="text" name="issue"  value="<?php echo $issue?>"></td>
	   <td width="6%">Source</td>
	   <td width="20%"><input type="text" name="source"  value="<?php echo $source?>"></td>
  </tr>
	   <tr>
       <td>Month</td>
	   <td><input type="text" name="month"  value="<?php echo $month?>" size="6" maxlength="2"></td>
	   <td>Year</td>
	   <td><input type="text" name="year"  value="<?php echo $year?>" size="6" maxlength="4"></td>
   </tr>
<?
}
?>
<tr>
     <td align="right">Accession No.&nbsp;&nbsp;&nbsp;</td>
	 <td colspan='3'><input type="text" name="acc_no"  value="<?php echo $acc_no?>"></td>
</tr>
<tr>
 </tr>
 </table>
 <br>
 <div align='center'><input type="button" name="search" value="Search" class='bgbutton' onClick="frm_submit()"></div>
  <br/><center>Note: In order to make search accurate and faster please key as many keywords as posible.</center>
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