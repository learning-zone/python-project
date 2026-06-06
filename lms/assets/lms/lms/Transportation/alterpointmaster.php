<?php
session_start();
require("../db.php");

$mid = $_POST['mid'];

$details = $_POST['details'];

$PName = $_POST['PName'];

$Pdist = $_POST['Pdist'];
$Platitude = $_POST['Platitude'];
$Plongitude = $_POST['Plongitude'];


$Types = $_REQUEST['Types'];



while( list(,$value) = each($mid))

{

	if(strtoupper($Types) == "MOD")

	{

		$sql = "Update trans_point_master set dist='$Pdist[$value]', point_name='$PName[$value]',details='$details[$value]',dist='$Pdist[$value]',latitude='$Platitude[$value]',longitude='$Plongitude[$value]' where id=$value";

		execute($sql);

	}
		
		if(strtoupper($Types) == "DEL")

	{

		$sql1 = "INSERT into trans_point_master_delete SELECT * from trans_point_master WHERE id=$value";
		execute($sql1);
		$sql2 = "delete from trans_point_master where id=$value";
		
		/*$sql1.  = "  AND delete from route_master where id=2";*/

		execute($sql2);
	}
	
}
		?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Deleted Sudccessfully");

        </script>

        <?php

	



//header("Location: add_points_master.php?msg=Updated details...");

?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {

        document.form1.action="add_points_master.php";

        document.form1.submit();

    }

     </script>
</head>

<body onLoad="reload1()">

 <form name="form1" method="post">

     </form>

     </body>

     </html>

