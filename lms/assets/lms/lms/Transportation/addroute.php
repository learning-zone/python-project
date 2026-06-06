<?php

session_start();
require("../db.php");



$routecode = $_POST['routecode'];

$routename = $_POST['routename'];

$distance = $_POST['distance'];





$sql = "INSERT INTO trans_route_master(route_code,route_name,distance) VALUES ('$routecode','$routename','$distance')" ;

//echo $sql;

execute($sql);

?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Added Sudccessfully");

        </script>

        <?php

//header("Location: add_route_master.php?msg=Details Added Successfully...");

?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">

    function reload1()

    {

        document.form1.action="add_route_master.php";

        document.form1.submit();

    }

     </script>

</head>

<body onLoad="reload1()">

 <form name="form1" method="post">

     </form>

     </body>

     </html>

	 





