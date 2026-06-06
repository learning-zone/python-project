<html>
<head>
<?php
session_start();
require("../db.php");
$sdept = $_POST['sdept'];
$dcode = $_POST['dcode'];
$sgid = $_POST['sgid'];
$sgName = $_POST['sgName'];
$DCode = $_POST['DCode'];
$sql2=execute("select * from dept_no where dept_code='$dcode' or Dept='".strtoupper($sdept)."'" ) or die(error_description());
//echo "select * from dept_no where dept_code='$dcode' or Dept='".strtoupper($sdept)."'" ;
if (rowcount($sql2)>=1)
{
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Duplicate Department Entered !! ");
        </script>
        <?php
}
else
{
	$sql = "INSERT INTO dept_no (Dept,dept_code) VALUES ('".strtoupper($sdept)."','".strtoupper($dcode)."')" ;
//	echo $sql;
	if($sdept = "" && $sdept = null)
	{
		?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Please Fill the blank Fields!!");
        </script>
        <?php
		//$msg="Please Fill the blank Fields!!";
	}
	else
	{
		execute($sql);
		//$msg="Data inserted Successfully !!";
		?>		
		<SCRIPT LANGUAGE ="JavaScript">
            alert("Updated Successfully");
        </script>
        <?php

	}
	
	//header("Location:departmentadd.php?msg=$msg");
}
?>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="departmentadd.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>

