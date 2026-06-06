<?php
session_start();
require("../db.php");
$sid = $_REQUEST['sid'];
$rid = $_REQUEST['rid'];
$bid = $_REQUEST['bid'];
$hid = $_REQUEST['hid'];
$college = $_REQUEST['college'];

//echo $college;
switch($college)
{
	case -1:
		$sel1 = "SELECTED";
		$sel2 = "";
		$sel3 = "";
		break;
	case -2:
		$sel1 = "";
		$sel2 = "SELECTED";
		$sel3 = "";
		break;
	case -3:
		$sel1 = "";
		$sel2 = "";
		$sel3 = "SELECTED";
		break;
	default:
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		break;
}

$delr=execute("update h_room_m set occupant=occupant-1 where h_id=$hid and room_no='$rid' and bid='$bid'") or die("Cant Delete");
//echo "update $data_base.h_room_m set occupant=occupant-1 where h_id=$hid and room_no='$rid' and bid='$bid'";
$del=execute("delete from h_stud_m where s_id='$sid'") or die("could not delete");
//echo "delete from $data_base.h_stud_m where s_id='$sid'";

header("Location:search_hostel2.php?hname=$hid&blkname=$bid");
?>
