<html>
<head>
<?php
session_start();
require("../db.php");
$Types = $_REQUEST['Types'];
$sgid = $_POST['sgid'];
$sgName = $_POST['sgName'];
if($Types=="Mod" || $Types=="Del")
{
	//echo "aaaa";
	while(list(,$Value) = each($sgid))	
	{
		//$mnamem = "sgName$Value";
		//$mNamem = $$mnamem;
		$mNamem = $_POST["sgName".$Value];
		
		if($Types == "Mod")
		{
			if(empty($mNamem))
			{
				//echo "<script language='JavaScript'>alert('Enter the Type Name')</script>";
				?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Enter the Type Name");
        </script>
        <?php
			}
			else
			{
				//echo("select * from staff_status where Name='$mNamem'");
				$tt=execute("select * from staff_status where Name='$mNamem'");
				if(rowcount($tt)>=1)
				{
					//echo "<font color=red><b>Duplicate Staff Type !! Cannot Save Details</b></font><br>";
					//echo "<font color=red><b><a href=stafftypeadd.php>Back to Add Staff Type Form</a></b></font>";
					//die();
					 
				}
				else
				{
					$sql="Update staff_status set Name ='$mNamem' where id=$Value";
				}
			}
		}
		elseif($Types="Del")
		{
			$sql = "update staff_status set status=0 where id=$Value";
		}
		execute($sql);
	}
	if(mysql_affected_rows($con)>0){
	//header('Location:stafftypeadd.php?msg_upd=ok');
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("updated successfully !!");
        </script>
        <?php
	}
	else{
		?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("updated successfully !!");
        </script>
        <?php
//	header('Location:stafftypeadd.php');
	}
	//die();
}

elseif($Types=="Act")
{
	while(list(,$Value) = each($stname))
	{
		$yy=execute("select * from staff_status");
		while($yy2=fetcharray($yy))
		{
			$tt=execute("select * from staff_status where id=$Value");
			$tt2=fetcharray($tt);
			if($tt2[Name]==$yy2[Name])
			{
				//echo "<font color=red><b>Duplicate Staff Type !! Cannot Save Details</b></font><br>";
				//echo "<font color=red><b><a href=stafftypeadd.php>Back to Add Staff Type Form</a></b></font>";
				//die();	
				 
			}
			else
			{
				$sql = "update staff_status set status=1 where id=$Value";
				execute($sql);
				?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("updated Successfully");
        </script>
        <?php
			}
		}
	}
	//header('Location:stafftypeadd.php');
	//die();
}
?>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="stafftypeadd.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>
