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
	$tab_id = $_POST['tab_id'];
	$firstname=$_POST['firstname'];
	$display_name=$_POST['display_name'];
	
}
if($submit == 'Add')
{
	$maxID=fetcharray(execute("SELECT MAX(id) FROM `student_m_field` WHERE `tab_id`='$tab_id' AND status=1"));
	$field_details=fetcharray(execute("SELECT * FROM `student_m_field` WHERE `id` = '$maxID[0]'"));
	$order = $field_details['order'];
	if($order!=''){
		$order = $order + 1;
	}
	
	$field_name=str_replace(' ', '_', $display_name);
	
	$sql="INSERT INTO `student_m_field` (`tab_id`, `order`, `user_name`, `field_name`, `display_name`, `inserted_date`) 
		  VALUES ('$tab_id', '$order', '$user_name', '$field_name', '$display_name', NOW())";
		
	//echo "<br>".$sql;  
	$result = execute($sql) or die(mysql_error());
	
	if($result)
	{
	    $field = $field_name.'_'.$tab_id;
		$sqlAlter="ALTER TABLE student_m_flexi ADD $field VARCHAR(100) DEFAULT NULL";
	
		//echo "<br>".$sqlAlter; 
		$resultAlter = execute($sqlAlter) or die(mysql_error());
	}
	 
	if($result){
		?>
        	<script type="text/javascript">
			 	window.opener.location.reload();
			 	window.close();
			</script>
        <?
	}
}
$one='';
$two='';
$three='';
$four='';
$five='';
?>
<!DOCTYPE html>
<html>
<head>
<script language="javascript">
  function reloadMe()
  {	  
	  document.frm.action="add_field.php";
	  document.frm.submit();
  }
</script>
</head>
<body>
<form action="add_field.php" method="post" name="frm"><BR>
<input type="hidden" name="tab_id" value="<?=$tab_id?>">
<table class="forumline"  align="center" width="50%" >
    <tr>
        <td class="head" align="center" colspan="4">ADD NEW FIELD</td>
    </tr>
    <tr height="25">
        <td align="right" nowrap>Field Type &nbsp;&nbsp;</td>
        <td><select name="field_type" onChange="reloadMe()">
                 <option value="">-------  Select   -------</option>
                 <?
					 if($field_type=='int'){
						 $one="selected";
					 }elseif($field_type=='varchar'){
						 $two="selected";
					 }elseif($field_type=='date'){
						 $three="selected";
					 }elseif($field_type=='checkbox'){
						 $four="selected";
					 }elseif($field_type=='radio'){
						 $five="selected";
					 }elseif($field_type=='password'){
						 $six="selected";
					 }elseif($field_type=='text'){
						 $seven="selected";
					 }
		
				 ?> 
          		 <option value="int" <?=$one?>>Number</option>
                 <option value="varchar" <?=$two?>>Text</option>
                 <option value="date" <?=$three?>>Date</option>
                 <option value="checkbox" <?=$four?>>CheckBox</option>
                 <option value="radio" <?=$five?>>RadioButton</option>
                 <option value="password" <?=$five?>>Password</option>
                 <option value="email" <?=$six?>>Email</option>
                 <option value="text" <?=$seven?>>Address</option>                                            
              </select></td>
         </tr>
         <tr height="25">
              <td align="right" nowrap>Field Name &nbsp;&nbsp;</td>
              <td><input type="text" name="" value=""></td>
   		 </tr>
</table>
<p align="center"><input type="submit" name="submit" class="bgbutton" value="Add" style="width:60px; height:22px"></p>
</form>
</body>
</html>