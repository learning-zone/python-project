<?php

session_start();

require("../db.php");



$drivername = $_POST['drivername'];

$perdet = $_POST['perdet'];

$djday = $_POST['djday'];

$djmnth = $_POST['djmnth'];

$djyear = $_POST['djyear'];

$add = $_POST['add'];

$years = $_POST['years'];

$licdet = $_POST['licdet'];

$redet = $_POST['redet'];

$adate = $_POST['adate'];

$tfdate=explode('/',$adate);
$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];



$DOJ = date("Y-m-d", strtotime($adate));





$sql = "INSERT INTO trans_driver_master(driver_name,personal_details,date_of_join,address,experiance_yrs,licence_det,reneval_det) VALUES ('$drivername','$perdet','$fdate','$add','$years','$licdet','$redet')" ;


execute($sql);
?>

 <SCRIPT LANGUAGE ="JavaScript">

            alert("Added Successfully");

        </script>
        <?php
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=add_driver_master.php'>";
?>

