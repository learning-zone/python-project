<?php
session_start();
require("../db.php");

$route2= $_POST['route2'];
$mid = $_POST['mid'];
$vechile2 = $_POST['vechile2'];
$driver2 = $_POST['driver2'];

while( list(,$value) = each($mid))
{
	$sql = "Update trans_route_vechile_details set route_id=$route2[$value],vechile_id=$vechile2[$value],driver_id=$driver2[$value] where id=$value";
	execute($sql);
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Updated Successfully");
        </script>
        <?php
	//echo $sql;
	//echo"sucess";
}
//header("Location: applyvechile.php");
?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="applyvechile.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>