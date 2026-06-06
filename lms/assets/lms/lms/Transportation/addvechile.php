<?php
session_start();
include("../db.php");

$vechilename = $_POST['vechilename'];
$reader_id = $_POST['reader_id'];
$driver_id = $_POST['driver_id'];

$gps = $_POST['gps'];
$puc_certificate = $_POST['puc_certificate'];
$regstnno = $_POST['regstnno'];

$yearofmfg= $_POST['yearofmfg'];

$regdet=  $_POST['regdet'];

$transtype = $_POST['transtype'];

$leasedetails =$_POST['leasedetails'];

$asd = $_POST['asd'];

$def = $_POST['def'];

$adate = $_POST['adate'];

$bdate = $_POST['bdate'];

$date3 = $_POST['date3'];

$date4 = $_POST['date4'];

$Types = $_REQUEST['Types'];



if($Types=='Add')

{

	if($vechilename == "" or $regstnno == "")

	{

		?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("PLEASE FILL DETAILS");

        </script>

        <?php

	}

	else

	{

        $var123 = str_replace('/','-',$adate);

		$date= Date("Y-m-d",strtotime($var123));

		$var123 = str_replace('/','-',$bdate);

		$date1= Date("Y-m-d",strtotime($var123));

		$var123= str_replace('/','-',$date3);

		$date2= Date("Y-m-d",strtotime($var123));

		$var123= str_replace('/','-',$date4);

		$date3= Date("Y-m-d",strtotime($var123));

		

		$Sql="Insert into trans_vechile_master(registration_no,vechile_mod_no,year_of_mfg, registration_details,trans_type,lease_det,	passng_capacity_sch,passng_capacity_col,fittness_date,insurance_date,road_tax_date ,permit,reader_id,gps,driver_id,puc_certificate) values('$vechilename','$regstnno','$yearofmfg','$regdet','$transtype','$leasedetails','$asd','$def','$date','$date1','$date2','$date3','$reader_id','$gps','$driver_id','$puc_certificate')";

	

execute($Sql);

	

					

//echo "Added SuccessFully!!";

?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Added Successfully");

        </script>

        <?php



}

}

?>
<html>

<head>
<SCRIPT LANGUAGE ="JavaScript">

    function reload1()

    {

        document.form1.action="add_vechile_master.php";

        document.form1.submit();

    }

     </script>

</head>

<body onLoad="reload1()">

 <form name="form1" method="post">

     </form>

     </body>

     </html>

