<?php
	session_start();
	include("../db.php");
	if($_FILES['uploadedfile']['tmp_name'] != null)
	{
		$target_path = basename( $_FILES['uploadedfile']['name']);
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			
			if (($handle = fopen($target_path, "r")) !== FALSE) 
			{
				
				execute("truncate lunch_menu_master_temp");
				while (($data = fgetcsv($handle)) !== FALSE) 
				{   
					// Craft your SQL insert statement such as:
					$query = "INSERT INTO lunch_menu_master_temp (`sr_number`, `date_det`, `day`, `Breakfast_Menu`, `Lunch_Menu`) VALUES ('{$data[0]}','{$data[1]}','{$data[2]}','{$data[3]}','{$data[4]}')";
					// Use the appropriate backend functions depending on your DB, mysql, postgres, etc.
					 $result=execute($query);
					 
					
				}
				
			}	
			
		}
		$sql=execute("select * from lunch_menu_master_temp");
		 while($r=fetcharray($sql))
		 {
			$sdate=trim($r[1]);
			execute("delete from `lunch_menu_master` where `menu_date`='$sdate'");
			$n="INSERT INTO `lunch_menu_master` (`day_det`, `menu_date`, `order_id`, `Breakfast_Menu`, `Lunch_Menu`) VALUES ('".trim($r[2])."', '".trim($r[1])."', '".trim($r[0])."', '".trim($r[3])."', '".trim($r[4])."')";
			execute($n);
			
		 }
		 
		 ?>
         <script language="javascript">
		 alert("File Successfully Uploaded");
         </script>
         <?php
	}

?>
<html>
<head>
</head>
<body>
<form name='frm' method='post' ENCTYPE='multipart/form-data' action="">
<br>
<br>
<table align="center" width="50%" border="1">
	<tr>
    <td align="center" class="head">
    	Lunch Calendar
    </td>
    </tr>
    <tr height="50">
    <td valign="middle" align="center">    
        <input type='FILE' name='uploadedfile' value='' size='15' >
	</td>
    </tr>
    </table>
    <br>
    <div align="center">	
        <input type="submit" name="Upload" value="Upload" class="bgbutton">
</div>
</form>
</body>
</html>
