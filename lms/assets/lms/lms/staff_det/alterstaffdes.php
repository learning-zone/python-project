<html>
<head>
<?php
session_start();
require("../db.php");
$sid = $_POST['sid'];
$stafftype = $_POST['stafftype'];
$typecode = $_POST['typecode'];
$sgroup = $_POST['sgroup'];
$priority = $_POST['priority'];

$Types = $_REQUEST['Types'];
if(is_array($sid))
{
	while(list(,$Value) = each($sid))
	{
		if($Types == "Mod")
		{
			//$temp1 = "stafftype$Value";
			// $stafftype=$$temp1;
			$stafftype = $_POST["stafftype".$Value];
			
			//$temp2 = "sgroup$Value";
			//$sgroup=$$temp2;
			$sgroup = $_POST["sgroup".$Value];
			
			//$temp3= "typecode$Value";
			//$typec=$$temp3;
			$typec = $_POST["typecode".$Value];
			
			//$prior="priority$Value";
			//$priority=$$prior;
			$priority = $_POST["priority".$Value];
			
			$sql = "Update staff_des set d_name='".$stafftype."',group_id=" .$sgroup.",d_code='".$typec."',priority='".$priority."' where d_id=$Value";
			execute($sql);
			 ?>
        	<SCRIPT LANGUAGE ="JavaScript">
            alert("Updated Successfully");
        	</script>
        	<?php
		}
		else
		{
			$sql = "Delete FROM staff_des where d_id=$Value";
			execute($sql);
		}
	}
	//$msg='Updated Successfully....';
	//header("Location:staffdesadd.php?msg=$msg");
}else
{
	?>
        	<SCRIPT LANGUAGE ="JavaScript">
            alert("cannot modify");
        	</script>
        	<?php
	//header("Location:staffdesadd.php?msg=$msg");
}

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
