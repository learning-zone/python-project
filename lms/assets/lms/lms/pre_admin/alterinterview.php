<html>
<head>
<?php
session_start();
require("../db.php");
$id = $_POST['id'];
$name1 = $_POST['name1'];
$mark1 = $_POST['mark1'];
$description1 = $_POST['description1'];

if($id)
{
	while( list(,$Value) = each($id) )
	{
		$name1 = $_POST["name1" . $Value];
		$mark1 = $_POST["mark1" . $Value];
		$description1 = $_POST["description1" . $Value];
		
		$sqlstr="Update interview set name='" . trim($name1) . "',mark='" . trim($mark1) . "', 
		description ='" . trim($description1) . "' where id=$Value" ;
		execute($sqlstr) or die(mysql_error());
	}
	 ?>
     <SCRIPT LANGUAGE ="JavaScript">
	 alert("Updated Successfully");
     </script>
     <?php
}
else
{
	?>
     <SCRIPT LANGUAGE ="JavaScript">
	 alert("Please select a Checkbox and then modify");
     </script>
     <?php
}
?>

<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="interview.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>