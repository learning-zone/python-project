<html>
<head>
<?php
session_start();
require("../db.php");
$Type=$_REQUEST['Type'];
$Sel=$_POST['Sel'];
$newsubtype=$_POST['newsubtype'];
if(trim($Type) == "Mod")
{
	while( list(,$Value) = each($Sel) )
	{

		$SubName = $_REQUEST['subtype'.$Value];
		$sqlstr="Update subjecttype Set subtype_name='" . $SubName ."' where subtype_id=" . $Value;
		execute($sqlstr)
		or die(mysql_error());
	}
		?>
        <SCRIPT LANGUAGE ="JavaScript">
			alert("Updated Successfully");
		</script>
        <?php
}
elseif(trim($Type) == "Add")
{
	if($newsubtype == "")
	{
		?>
        <SCRIPT LANGUAGE ="JavaScript">
			alert("Data could not be updated since subject type name is *NOT* mentioned");
		</script>
        <?php
	 
	}

	$sql=execute("select * from subjecttype where subtype_name='$newsubtype'") or die(error_description());

	if(rowcount($sql)==1)
	{
		?>
        <SCRIPT LANGUAGE ="JavaScript">
			alert("Duplicate Subject Type !! ");
		</script>
        <?php
	}
	else
	{
	$sqlstr="Insert Into subjecttype(subtype_name) VALUES('$newsubtype')";

	execute($sqlstr);
		?>
        <SCRIPT LANGUAGE ="JavaScript">
			alert("Updated Successfully");
		</script>
        <?php
	
	}
}

?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
		document.form1.action="subtypeadd.php";
		document.form1.submit();
	}
	 </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>
