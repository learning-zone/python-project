<?php

session_start();

require("../db.php");





$Types = $_REQUEST['Types'];



$mid = $_POST['mid'];

$DName = $_POST['DName'];

$dpdet = $_POST['dpdet'];

$jday = $_POST['jday'];

$jmnth = $_POST['jmnth'];

$jyear = $_POST['jyear'];

$add = $_POST['add'];

$exp = $_POST['exp'];

$ldet = $_POST['ldet'];

$redet = $_POST['redet'];



while( list(,$value) = each($mid)){



$doj1="$jyear[$value]-$jmnth[$value]-$jday[$value]";





	if(strtoupper($Types) == "MOD"){

		$sql = "Update trans_driver_master set driver_name='$DName[$value]',personal_details='$dpdet[$value]',date_of_join='$doj1',address='$add[$value]',experiance_yrs=$exp[$value],licence_det='$ldet[$value]',reneval_det='$redet[$value]' where id=$value";	}


	execute($sql);

	?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Updated Successfully");

        </script>

        <?php

}



//header("Location: add_driver_master.php");



?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">

    function reload1()

    {

        document.form1.action="add_driver_master.php";

        document.form1.submit();

    }

     </script>

</head>

<body onLoad="reload1()">

 <form name="form1" method="post">

     </form>

     </body>

     </html>







