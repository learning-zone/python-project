
<html>
<head>
<?php
session_start();
require("../db.php");

$stype = $_POST['stype'];
$type_code = $_POST['type_code'];
$sgroup = $_POST['sgroup'];
$priority = $_POST['priority'];
$sql1=execute("select * from staff_des where d_name='$stype' or d_code='$type_code'"); 
//or die(error_description());
if(rowcount($sql1)>=1)
{
	//$msg='Duplicate Staff Designation/priority/Designation Code !! Cannot Save Details';
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Duplicate Staff Designation/priority/Designation Code ");
        </script>
        <?php
}
else
{
	$sql = "INSERT INTO staff_des (d_name,d_code,group_id,priority) VALUES ('$stype','$type_code',$sgroup,$priority)";
	if($stype != "")
	{
		execute($sql);	
		 ?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Updated Successfully");
        </script>
        <?php
	}
	else
	{
		//$msg="***Please Fill the blank Fields***";
		 ?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Please Fill the blank Fields");
        </script>
        <?php
	}
}
//header("Location: staffdesadd.php?msg=$msg");
?>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="staffdesadd.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>
