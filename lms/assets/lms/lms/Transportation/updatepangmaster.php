<?php

session_start();

$academic_year=$_SESSION['AcademicYear'];



require("../db.php");

	$type = $_POST['type'];
	
	$routename = $_POST['routename'];
	
	$pointname = $_POST['pointname'];
	
	$wdt = $_POST['wdt'];
	
	$wmn = $_POST['wmn'];
	
	$wyr = $_POST['wyr'];
	
	$mid = $_POST['mid'];

?>
<html>

<head>
</head>

<body>

<?php
if(is_array($mid))
{

	while(list(,$value) = each($mid))
	{

		$SourcePoint = $_POST["pointname".$value];
		$dt = $_POST["wdt".$value];
		$dm = $_POST["wmn".$value];
		$dy = $_POST["wyr".$value];
		$wefdt=$dy."-".$dm."-".$dt;

        if($SourcePoint!='')
		{

			$sql = "insert into trans_pasng_route_master(p_type,pasng_id,route_id,source_pt,wefdt,accyear) values('$type','$value','$routename','$SourcePoint','$wefdt','$academic_year')";

			execute($sql);


			?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Details Updated ..");

        </script>

        <?php

		}

		else

		{

			?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Please select Pickup Point..");

        </script>

        <?php

			//echo "<div><font color='brown'><b>Please select Pickup Point..</b></font></div><br>";

		}

	}

}

else

{

	?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Please select checkbox");

        </script>

        <?php

        //die("<div><font color='brown'><b>Please select checkbox</b></font></div>");

}

?>

<SCRIPT LANGUAGE ="JavaScript">

    function reload1()

    {

        document.form1.action="passengermaster.php";

        document.form1.submit();

    }

     </script>

</head>

<body onLoad="reload1()">

 <form name="form1" method="post">



<input type="hidden" name="routename" value="<?php echo $routename; ?>">

<input type="hidden" name="pointname" value="<?php echo $pointname; ?>">

     </form>

     </body>

     </html>