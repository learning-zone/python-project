<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user_name = $_SESSION['user'];
if($_GET)
{
	$p = $_REQUEST['token'];
	$tab_id = $_REQUEST['tab_id'];
}
if($_POST)
{
	$id=$_POST['id'];
	$submit=$_POST['submit'];	
	$tab_name = $_POST['tab_name'];
	$description=$_POST['description'];	
}
if($submit == 'Add')
{

	$sql="INSERT INTO `student_m_tab` (`tab_name`, `description`, `inserted_date`) 
		  VALUES ('$tab_name', '$description', CURDATE())";
		
	//echo "<br>".$sql;  
	$result = execute($sql) or die(mysql_error());
	if($result){
		?>
        	<script type="text/javascript">
			 	window.opener.location.reload();
			 	window.close();
			</script>
        <?
	}
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form  name="frm" action="add_tab.php" method="post"><BR>
<table class="forumline"  align="center" width="90%" >
    <tr>
        <td class="head" align="center" colspan="4">ADD NEW TAB</td>
    </tr>
    <tr>
        <td align="center">Tab Name</td>
        <td ><input type="text" name="tab_name" value="" size="40"></td>
    </tr>
    <tr>
        <td align="center">Description</td>
        <td ><textarea name="description" value="" rows="2" cols="29"></textarea></td>
    </tr>
</table>
<p align="center"><input type="submit" name="submit" class="bgbutton" value="Add" style="width:60px; height:22px"></p>

</form>
</body>
</html>