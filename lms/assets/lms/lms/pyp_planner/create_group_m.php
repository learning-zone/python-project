<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$a_year=$_SESSION['AcademicYear'];
if($_GET)
{	
	$Type=$_REQUEST['Type'];
	$grade=$_REQUEST['grade'];	
}
if($_POST)
{
	$grade=$_POST['grade'];
	$group_name=$_POST['group_name'];
	$description=$_POST['description'];
}
if($Type == "Add")
{
		$sql="INSERT INTO `pyp_group_m` (`group_name`, `description`, `grade`, `a_year`) 
		VALUES ('$group_name', '$description', '$grade', '$a_year')";
		
		$result = execute($sql) or die(mysql_error());
		
		if($result)
		{
			?>
    		  <script language="javascript">
				alert("Records Added");
				window.opener.location.reload();
				window.close();
    		 </script>
			<?
		}
}
if($grade=='')
{
	?>
    	<script type="text/javascript">
		   alert('Please select Grade');
		   window.close();
		</script>
    <?
	
}
?>
<html>
<head>
<script language="JavaScript">
  function adds_onclick()
  {
	  document.frm.action="create_group_m.php?Type=Add";
	  document.frm.submit();
  }
  function WindowClose()
  {
	  window.close();
  }
</script>
</head>
<title>Add Category</title>
<body>
<form method="post" name="frm" action="create_group_m.php">
<input type="hidden" name="grade" value="<?=$grade?>"><BR>
<table align='center' class='forumline' width='90%'>
<tr>
	<td class="head" colspan="4" align="center">GROUP NAME</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Group Name</td>
    <td><input type="text" name="group_name" value="" size="30"></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Description</td>
    <td ><textarea rows="4" cols="30" name="description"></textarea></td>
</tr>
</table>
<p align="center"><input type="button"  value="Save"  style="width:86px; height:22px" onClick="adds_onclick()" class="bgbutton">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button"  value="Exit"  style="width:86px; height:22px" onClick="WindowClose()" class="bgbutton"></p>
 </form>
 </body>
</html>
