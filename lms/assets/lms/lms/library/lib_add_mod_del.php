<?php
require_once("../db.php");
$Sel=$_POST['Sel'];
$Type=$_REQUEST['Type'];
$na=$_POST['na'];
$ad=$_POST['ad'];
$ph=$_POST['ph'];
$em=$_POST['em'];
$re=$_POST['re'];
	
	if($Type == "add")
	{		
			$sql=execute("INSERT INTO library_name(name,address,phone,email,remark) VALUES('$na','$ad','$ph','$em','$re')");
			//echo "<META HTTP-EQUIV='Refresh' Content='0;URL=view_lib_add_mod_del.php>";
			$msg="Records are successfully added";
	$act=1;
			
	}
	if($Type == "modify")
	{
			
			$Sel=$_POST['Sel'];
			
			while( list(,$Value) = each($Sel) )
			{
					
					$Nname =$_POST["na".$Value];
					$address = $_POST["ad".$Value]; 
					$phone =$_POST["ph".$Value];
					$email =$_POST["em".$Value];
					$remark = $_POST["re".$Value];
	
				   $sql=execute("UPDATE library_name SET name='$Nname',address='$address',phone='$phone',email='$email',remark='$remark' WHERE id='$Value'"); 
				   						
			}
			      //header("Location:view_lib_add_mod_del.php");
			/* echo '<p>Records are successfully Updated</p>';
			 echo '<a href="view_lib_add_mod_del.php">Back</a>';*/
			 $msg="Records are successfully Updated";
			$act=2;
			
	}
	if($Type == "delete")
	{
			while( list(,$Value) = each($Sel) )
			{
					$sql =execute("DELETE FROM library_name WHERE id='$Value'");
			}
			
			//header("Location:view_lib_add_mod_del.php");
			 $msg="Records are successfully deleted";
			$act=3;
	}
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=view_lib_add_mod_del.php?msg=$msg&act=$act'>";
?>
