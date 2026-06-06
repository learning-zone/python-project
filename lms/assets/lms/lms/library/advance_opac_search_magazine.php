<?php
$media=$_REQUEST['media'];
$media_type=$_POST['media_type'];
$type=$_REQUEST['type'];
$type1=$_POST['type1'];
$title=$_POST['title'];
$subject=$_POST['subject'];
$keywords=$_POST['keywords'];
$volume=$_POST['volume'];
$issue=$_POST['issue'];
$articles=$_POST['articles'];
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
<title>Opac Search For Journal</title>
<script language="javascript">
function frm_submit()
{
	if((document.frm.title.value !="")|| (document.frm.articles.value !="") || (document.frm.subject.value !="")||(document.frm.keywords.value !="")||(document.frm.volume.value !="")||(document.frm.issue.value !="")||(document.frm.month.value !="")||(document.frm.year.value !="")||(document.frm.acc_no.value !=""))
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
if($type=="M")
 {
   $tp="M";
   ?>
   <br/>
    <table  width="60%" class='forumline' align="center" colspan='4'>
	<tr><td align='center' Class='head' colspan='4'>OPAC Search for Magazine</td></tr>
   <?
 }
  if($type=="J")
 {
   $tp="J";
   ?>
<br/><table  width="60%" class='forumline' align="center" colspan='4'>
<tr><td align='center' Class='head' colspan='4'>OPAC Search for Journal</td></tr>

<p align="center">&nbsp;</p>
   <?

  }
?>

<form name="frm" method="POST" action="view_opac_magazine_search.php" style="background-image: url('../images/Mouse1.gif')">
<input type="hidden" name="media_type" value="<?=$media_type?>">
<input type="hidden" name="type1" value="<?=$tp?>">
  <center>
 <!-- <table  width="60%" class='forumline' colspan='4'>-->
    <tr>
      <td>&nbsp;&nbsp;&nbsp;Title</td>
	  <td><input type="text" name="title"  value="<?=$title?>"></td>
      <td>Subject</td>
      <td><select name='subject' onFocus="this.style.backgroundColor='#7E93EF';this.style.cursor='hand';this.style.color='white'"
	  	  		onBlur="this.style.backgroundColor='white';this.style.cursor='default';this.style.color='black'">
	  	  <option value="">Select Subject</option>
	        <?
		if($type=="J")
 		{
	  		$rs_sql=execute("select distinct(subject) from lib_magazine where magazine_no like 'J%' order by subject");
		}
		elseif($type=="M")
 
			{
				$rs_sql=execute("select distinct(subject) from lib_magazine where magazine_no like 'M%' order by subject");
			}
		
	  		for($i=0;$i<rowcount($rs_sql);$i++)
	  		{
	  			$r_sql=fetcharray($rs_sql,$i);
	  			echo "<option value='$r_sql[0]'>$r_sql[0]</option>";
				}


	        ?>
      </select>
      </td>
	  </tr>
	  <tr>
      <td>&nbsp;&nbsp;&nbsp;Keywords</td>
      <td><input type="text" name="keywords"  value="<?=$keyword?>"></td> 
	  <td>Volume No</td>
	  <td><input type="text" name="volume" value="<?=$volumen?>"></td>
    </tr>
	<tr>
	  <td>&nbsp;&nbsp;&nbsp;Issue No.</td>
	  <td><input type="text" name="issue"  value="<?=$issue?>"></td>
	  <td>Articles</td>
      <td><input type="text" name="articles"  value="<?=$articles?>"></td>
    </tr>
    <tr>
	   <td>&nbsp;&nbsp;&nbsp;Month</td>
	   <td><input type="text" name="month"  value="<?=$month?>" size="6" maxlength="2"></td>
       <td>Year</td>
	   <td><input type="text" name="year"  value="<?=$year?>" size="6" maxlength="4"></td>
   </tr>
   <!-- <tr>
      <td colspan='4' align="center">Or</td>
   </tr> -->
   <tr>
      <td>&nbsp;&nbsp;&nbsp;Accession No.</td>
	  <td colspan="3"><input type="text" name="acc_no"  value="<?=$acc_no?>"></td>
  </tr>
    <tr>
       
    </tr>
</table>
<br>
<div align='center'><input type="button" name="search" value="Search" class='bgbutton' onClick="frm_submit()"></div>
  </center><br/><center>
    Note: In order to make search accurate and faster please key as many keywords as posible.</center>
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