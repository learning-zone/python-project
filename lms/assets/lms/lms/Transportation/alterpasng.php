<?php
	session_start();
	require("../db.php");

	$pasng_id = $_POST['pasng_id'];
	
	$routename = $_POST['routename'];
	
	$pickuppoint = $_POST['pickuppoint'];
	
	$FMon = $_POST['FMon'];
	
	$FYear = $_POST['FYear'];

?>
<html>
<head>
</head>
<body>
</body>

<?php

if($del)

{

	$sql = "update trans_pasng_route_master set sts=1 where id='$pasng_id'";

	execute($sql) or die(mysql_error());

	?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Deleted Successfully");

        </script>

        <?php

}

elseif($mod)

{	

	$sql = "update trans_pasng_route_master set route_id=$routename,source_pt=$pickuppoint,val_mon='$FMon',val_yr='$FYear' where id='$pasng_id'";

	execute($sql) or die(mysql_error());

	?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Modified Successfully");

        </script>

        <?php

}

?>



<SCRIPT LANGUAGE ="JavaScript">

    function reload1()

    {

        document.form1.action="viewpasngr.php";

        document.form1.submit();

    }

     </script>

</head>

<body onLoad="reload1()">

 <form name="form1" method="post">

     </form>

     </body>

     </html>

</html>