<?php

session_start();

include("../db.php");

if($_POST)

{

$vechilename = $_POST['vechilename'];

$regstnno = $_POST['regstnno'];

$yearofmfg= $_POST['yearofmfg'];

$regdet=  $_POST['regdet'];

$transtype = $_POST['transtype'];

$leasedetails =$_POST['leasedetails'];

$asd = $_POST['asd'];

$def = $_POST['def'];

$adate = $_POST['adate'];

$adate = date("Y-m-d", strtotime($adate));

$bdate = $_POST['bdate'];

$bdate = date("Y-m-d", strtotime($bdate));

$date3 = $_POST['date3'];

$date3 = date("Y-m-d", strtotime($date3));

$date4 = $_POST['date4'];

$date4  = date("Y-m-d", strtotime($date4));

$id = $_POST['id'];

$reader_id = $_POST['reader_id'];
$gps = $_POST['gps'];
$driver_id = $_POST['driver_id'];

}

if($_REQUEST)

{

	$Types = $_REQUEST['Types'];

}

if($Types='MOD'){

   {

   $var123 = str_replace('/','-',$adate);

		$date= Date("Y-m-d",strtotime($var123));

		$var123 = str_replace('/','-',$bdate);

		$date1= Date("Y-m-d",strtotime($var123));

		$var123= str_replace('/','-',$date3);

		$date2= Date("Y-m-d",strtotime($var123));

		$var123= str_replace('/','-',$date4);

		$date3= Date("Y-m-d",strtotime($var123));

		

   $SqlUpDate="Update trans_vechile_master set 	registration_no='$vechilename',vechile_mod_no='$regstnno',year_of_mfg='$yearofmfg',registration_details='$regdet',";

  $SqlUpDate.="trans_type='$transtype',lease_det='$leasedetails',passng_capacity_sch='$asd',passng_capacity_col='$def',fittness_date='$date',	insurance_date='$date1',road_tax_date='$date2',permit='$date3',reader_id='$reader_id',gps='$gps',driver_id='$driver_id' where id='$id'";

 // echo $SqlUpDate;

execute($SqlUpDate); 

 

//   echo "Updated SuccessFully!!";

?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Updated Successfully");

        </script>

        <?php

    

  }}

?>

<html>

<head>

<SCRIPT LANGUAGE ="JavaScript">

    function reload1()

    {

        document.form1.action="vech_mod.php";

        document.form1.submit();

    }

     </script>

</head>

<body onLoad="reload1()">

 <form name="form1" method="post">

     </form>

     </body>

     </html>

