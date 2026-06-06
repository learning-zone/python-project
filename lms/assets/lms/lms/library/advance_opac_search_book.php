<?php
session_start();
require_once("../db.php");

$media=$_REQUEST['media'];
if($_POST)
{
	$title=$_POST['title'];
	$author=$_POST['author'];
	$acc_no=$_POST['acc_no'];
	$classno=$_POST['classno'];
	$subject=$_POST['subject'];
	$publisher=$_POST['publisher'];
}

if($media !='True')
{
	header("Location:advance_opac_search.php");
}
?>
<html>
<head>
<title>Opac Search For Books</title>
<script language="javascript">
function frm_submit()
{
	if((document.frm.title.value !="")||(document.frm.subject.value =="")||(document.frm.subject.value !="")||(document.frm.author.value !="")||(document.frm.publisher.value !="")||(document.frm.acc_no.value !=""))
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
<p align="center">		
<form name="frm" method="POST" action="view_opac_book_search.php" style="background-image: url('../images/Mouse1.gif')">
  <table class='forumline' width="60%" colspan='2' align='center'><br/>
  <tr><td align='center' Class='head' colspan='2'>ADVANCE OPAC SEARCH FOR BOOKS</td></tr>
    <tr>
      <td align="right">Title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td><input type="text" name="title" value="<?=$title?>"></td>
	</tr>
    <tr>
      <td align="right">Author&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td><input type="text" name="author"  value="<?=$author?>"></td>
    </tr>
    <tr>
      <td align="right">Class No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td><input type="text" name="classno"  value="<?=$classno?>"></td>
    </tr>
    <tr>
      <td align="right">Publisher&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  <td><input type="text" name="publisher"  value="<?=$publisher?>"></td>
    </tr>
    <tr>
      <td align="right">Subject&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td><select name='subject'>
	  <option value="0">Select Subject</option>
      <?php	
	     $rs_sql=execute("SELECT DISTINCT(subject) FROM lib_book_details WHERE `subject`!='' ORDER BY subject");
		 for($i=0;$i<rowcount($rs_sql);$i++)
		  {
			$r_sql=fetcharray($rs_sql);
			echo "<option value='$r_sql[0]'>$r_sql[0]</option>";
		  }
      ?>
      </select></td>
   </tr>
   <tr>
      <td align="right">Accession No.&nbsp;&nbsp;</td>
	  <td><input type="text" name="acc_no"  value="<?=$acc_no?>"></td>
  </tr>
  <tr>
      </tr>
  </table>
  <br>
  <div align='center'><input type="button" name="search" value="Search" class='bgbutton' onClick="frm_submit()"></div><br/>
  <p align="center">
  --: Note :--<br> 1) In order to make search accurate and faster please key as many keywords as posible.<br>
  2) You Can Use % before typing the book title.</p>
</form>
</body>
</html>