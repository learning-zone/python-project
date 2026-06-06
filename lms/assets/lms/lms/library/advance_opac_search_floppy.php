<html>
<head>
<?php
include_once("../db.php");
if($media=='False')
{
	header("Location:advance_opac_search.php");
}
?>
<script language="javascript">
function frm_submit()
{
	if((document.frm.source_acc_no.value !="")||(document.frm.title.value !="")||(document.frm.author.value !="")||(document.frm.keywords.value !="")||(document.frm.acc_no.value !=""))
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
if($media_type=="3")
{
?>
	<h2 align="center"><b><font color="#000099" size="5">OPAC Search for Book Floppy's</font></b></h2>
<?php
}
?>
<form name="frm" method="POST" action="view_opac_floppy_search.php" style="background-image: url('../images/Mouse1.gif')">
<input type="hidden" name="media_type" value="<?=$media_type?>">

  <table  width="50%" class='forumline' align='center'>
  <tr>
     <td><font color="#000099">Title</font></td>
     <td><input type="text" name="title" value="<?=$title?>"></td>
  </tr>
  <tr>
     <td><font color="#000099">Author</font></td>
     <td><input type="text" name="author" value="<?$author?>"></td>
  </tr>
  <tr>
     <td><font color="#000099">Keywords</font></td>
	 <td><input type="text" name="keywords"  value="<?=$keyword?>"></td>
 </tr>
<?
if($media_type=="3")
	{
	?>
	    <tr>
	      <td><font color="#000099">Source No</font></td>
		  <td><input type="text" name="source_acc_no"  value="<?=$source_acc_no?>"></td>
		</tr>
		<!-- <tr>
          <td colspan="2" align="center"><font color="red">Or</font></td>
        </tr> -->
        <tr>
           <td><font color="#000099">Accession No.</font></td>
		   <td><input type="text" name="acc_no"  value="<?=$acc_no?>"></td>
       </tr>

  <?php
	}
  ?>
   <tr>
      <td colspan="4" align='center'><font size="3"><input type="button" name="search" value="Search" style="color: #FFFFFF; text-align: Center; background-color: #7E93EF; font-size: 12pt; font-weight: bold; margin-left: 0; margin-top: 0" onClick="frm_submit()"></font></td>
 </tr>
  </table>
  <td align='center'>
    <font color="red">Note: In order to make search accurate and faster please key as many keywords as posible.</font></td>
</form>
<table align='right'>
<tr><td>
<div align='right'>
<a href="advance_opac_search.php" ><b><font face="Times New Roman" size="5" color="#8572D3">Home</font></b></a>
<div>
</td>
</tr>
</table>
</body>
</html>