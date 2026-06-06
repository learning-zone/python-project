<?php

session_start();

session_unset();

include ("db1.php");

$username = $_POST['username'];

$password = $_POST['password'];

if ($password != '12345')

	header("Location: ../adminpanel.php");

$date1 = date("Y-m-d");

$sql_id = mysql_fetch_row(mysql_query("select acc_year from academic_year where  status=1 and ( '$date1' Between from_date and to_date )"));

$_SESSION['AcademicYear'] = $sql_id[0];

$user = $username;

$_DATABASE_ = "localhost_imp";

$per00 = 1;

$_SESSION["user"] = $user;

$_SESSION["per00"] = $per00;

$_SESSION["_DATABASE_"] = $_DATABASE_;

$_SESSION['branchname'] = 'School Division';

$_SESSION['semname'] = 'Grade';

//adresss

$name = mysql_query("SELECT *  FROM college");

while ($rc = mysql_fetch_array($name)) {

	$_SESSION['SchoolName'] = $rc['col_name'];

	$_SESSION['SchoolCode'] = $rc['col_code'];

	$_SESSION['SchoolAddress'] = $rc['col_addr'] . " " . $rc['col_city'] . " " . $rc['col_state'] . " Pin : " . $rc['col_pin'];

}

//

//accounts session

$_SESSION['name'] = 'master';

$_SESSION['pass'] = 'master!@#';

$_SESSION['type'] = 'a';

//account session

header("Location:Frame.php");
?>