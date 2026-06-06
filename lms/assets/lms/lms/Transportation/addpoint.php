<?php
session_start();

require("../db.php");


$pointcode = $_POST['pointcode'];

$pointname = $_POST['pointname'];

$pointdist = $_POST['pointdist'];

$details = $_POST['details'];

$latitude = $_POST['latitude'];

$longitude = $_POST['longitude'];

$sql=fetchrow(execute("select id from trans_point_master where point_name='$pointname'"));

if($sql[0])

{

?>

	<SCRIPT LANGUAGE ="JavaScript">

	alert("Duplicate Entry");

	</script>

<?php

}

else

{

	$sql = "INSERT INTO trans_point_master(point_name,details,dist,latitude,longitude) VALUES ('$pointname','$pointcode','$pointdist','$latitude','$longitude')" ;

	execute($sql);

	?>

		<SCRIPT LANGUAGE ="JavaScript">

		alert("Updated Successfully");

		</script>

	<?php

}

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



 