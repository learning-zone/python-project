<?php
session_start();
require("../db.php");

$row = $_POST['row'];
$college = $_POST['college'];
$hname = $_POST['hname'];
$bname = $_POST['bname'];
$rnumber = $_POST['rnumber'];
$bldgrp = $_POST['bldgrp'];
$padd = $_POST['padd'];
$pphone = $_POST['pphone'];
$lgname = $_POST['lgname'];
$lgrelation = $_POST['lgrelation'];
$lgadd = $_POST['lgadd'];
$lgphone = $_POST['lgphone'];
$adate = $_POST['adate'];
$bdate = $_POST['bdate'];
$empname = $_POST['empname'];
$empdept = $_POST['empdept'];
$st_id = $_POST['st_id'];

$studFName = $_REQUEST['studFName'];
?>
<HTML>
<HEAD>
<TITLE>INSERTING THE STUDENT DETAILS IN HOSTEL</TITLE>
</HEAD>
<BODY>
<CENTER>
<?
/*if(!checkdate($jmon,$jday,$jyr))
{
	echo "Invalid Join Date!";
	die();
}*/

if(empty($college))
{
	$college = -1;
}


//echo $studFName;
$rs_sql = execute("SELECT * FROM h_stud_m WHERE s_id='$st_id' AND archive='N'");
	if(rowcount($rs_sql) > 0)
	{
		echo "<DIV ALIGN='CENTER'>";
		echo "This Student Allready Admitted to the Hostel.</DIV>";
		?>
        <CENTER>
		<a href="doSearch.php"><u>Back</u></a>		
        </CENTER>
        <?php
		die();
	}
	else
	{
	$sql1="INSERT INTO h_stud_m(domain,archive,bid,s_id,h_id,lg_name,relation,lg_add,room_no,phone,emp_n,dept,
	j_date,l_date,p_add,p_phone,blood,first_name)";
	
	$sql2  = "VALUES ('$college','N','$bname','$st_id','$hname','$lgname','$lgrelation','$lgadd','$rnumber',
	'$lgphone','$empname','$empdept','$adate','$bdate','$padd','$pphone','$bldgrp','$studFName')";
	
	$sql = $sql1 . $sql2;

	//echo "$sql";
    //$res=execute($sql) or die(mysql_error());
	
	$sql3 = "SELECT * FROM h_room_m WHERE id=".$rnumber;
	$rs3 = execute($sql3) or die();
	$row = rowcount($rs3);
	$r3 = fetcharray($rs3,0);
	if(($r3["capacity"]) == ($r3["occupant"]))
	{
		echo "<DIV ALIGN='CENTER'>";
		echo "Room Number $r3[room_no] is Full !!</DIV>";
		?>
        <CENTER>
		<a href="doSearch.php"><u>Back</u></a>		
        </CENTER>
        <?php
		die();
	}
	else
	{
		$occ = $r3["occupant"]+1;
		execute($sql) or die("QUERY $sql " . error_description());
		$sql4 = "UPDATE h_room_m SET occupant=".$occ." WHERE id=".$rnumber;
		execute($sql4) or die(error_description());
	}
	}

	?>
	<DIV ALIGN="CENTER">
   Student Detail is successfully added to the Hostel Database!!
  <br>
  <a href="doSearch.php"><u>Back</u></a>
  </DIV>

</BODY>
</HTML>