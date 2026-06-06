<html>
<head><?php
session_start();
$Sel=$_POST['Sel'];
$SubName=$_POST['SubName'];
$newYear=$_POST['newYear'];
$yname=$_POST['yname'];
$Type=$_REQUEST['Types'];
$type=$_POST['type'];
$short_name=$_POST['short_name'];
require("../db.php");

if(trim($Type) == "Mod")
{
	while( list(,$Value) = each($Sel) )
	{

		$SubNameField = $_POST['yr'.$Value];
		$short_name= $_POST['short_name'.$Value];
		$SubName = trim($SubNameField);
		$type = $_POST['Ctype'.$Value];
		$type = trim($type);
		
		$sql=execute("select * from course_year where year_name='$SubName' and head_id='$type'");
	
		if(rowcount($sql)==1)
		{
			$flag123=1;
					
		}
		else
		{
			$sqlstr="Update course_year Set year_name='" . $SubName ."' , short_name='$short_name'where year_id=" . $Value;
	
		execute($sqlstr) or die(mysql_error());
			$flag123=0;
			
		}
	}
	if($flag123==1)
	{
			?>
			<SCRIPT LANGUAGE ="JavaScript">
			alert("Duplicate Class Name !!");
			</script>
			<?php
		
	}
	else
	{
		?>
			<SCRIPT LANGUAGE ="JavaScript">
                alert("Updated Successfully!!");
            </script>
		 <?php
	}
	
}

elseif(trim($Type) == "Del")
	{
	while( list(,$Value) = each($Sel) )
	{

		$SubNameField =  $_POST['yr'.$Value];
		$SubName = trim($SubNameField);

		$sqlstr="Update course_year Set status=0 where year_id=" . $Value;
		echo($sqlstr);
		execute($sqlstr) or die(mysql_error());
		?>
		<SCRIPT LANGUAGE ="JavaScript">
		alert("Deleted  Successfully");
	 	</script>
     	<?php

	}

	
	}
elseif(trim($Type) == "Add")
	{
	if($newYear == "")
	{
	?>
		<SCRIPT LANGUAGE ="JavaScript">
		alert("Data could not be updated since year name is *NOT* mentioned");
	 	</script>
     <?php
	 }
	
	$sql=execute("select * from course_year where year_name='$newYear' and head_id='$type'") or die(error_description());

	if(rowcount($sql)>=1)
	{
	//	echo "<font color=red><b> </b></font><br>";
		//echo "<font color=red><b><a href=yearadd.php> << Back </a></b></font>";
		?>
	<SCRIPT LANGUAGE ="JavaScript">
		alert("Duplicate Class Name !!");
	 </script>
     <?php
	}
	else
	{

		$sqlstr="Insert Into course_year(year_name,head_id,short_name) VALUES('$newYear','$type', '$short_name')";
		execute($sqlstr);
		?>
	<SCRIPT LANGUAGE ="JavaScript">
		alert("Updated Successfully!!");
	 </script>
     <?php

	}

	}


elseif(trim($Type) == "Act")
{
	if(is_array($yname))
	{
		while( list(,$Value) = each($yname) )

		{

			$sqlstr="Update course_year Set status=1 where year_id=" . $Value;
			execute($sqlstr) or die(mysql_error());
	?>
	<SCRIPT LANGUAGE ="JavaScript">
		alert("Updated Successfully!!");
	 </script>
     <?php
		}
		
	}
}
?><SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    	
		document.form1.action="yearadd.php";
	 	document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>