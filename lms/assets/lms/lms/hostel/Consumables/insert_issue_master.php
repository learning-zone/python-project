<html>
<body>
<?php
session_start();
include("../../db.php");
if(isset($_POST['dept']))
{
	//$FDay=$_POST['PurDay'];
	//$FMon=$_POST['PurMonth'];
	//$FYear=$_POST['PurYear'];
	$date3 = $_POST['date3'];
	$issued_date=$date3;
	$college=$_POST['college'];
	$dept=$_POST['dept'];
	$IssuedBy=$_POST['IssuedBy'];
	$comments=$_POST['comments'];
	$sql="select * from users where username='$IssuedBy'";
	$res=execute($sql);
while($usn=fetcharray($res))
	{
		$userid=$usn[0];
	}
	$query_temp="select * from h_temp_issue_consumable";
	$result_temp=execute($query_temp);
while($q=fetcharray($result_temp))
	{
		$issue_id=$q[0];
		$itemname_id=$q[1];
		$issued_qty=$q[2];
		$issued_to=$q[3];
		$query_per="insert into h_issue_consumable values('','$college','$dept','$issued_date','$itemname_id','$issued_qty','$userid','$issued_to','$comments')";
		$result_per=execute($query_per);
		$query_iqty=fetcharray(execute("select issued_qty from h_temp_issue_consumable where itemname_id='$itemname_id'"));
		$query_rqty=fetcharray(execute("select stock from h_item_master where id='$itemname_id'"));
		$a=$query_iqty[issued_qty];
		$b=$query_rqty[stock];
		$stk_in_hand=$b-$a;
		$query_update="update h_item_master set stock='$stk_in_hand' where id='$itemname_id'";
		$result_update=execute($query_update);
	}
	echo "Inserted Successfuly...!<br>";
	$query_del="delete from h_temp_issue_consumable";
	$result_del=execute($query_del);
	echo "<b><a href=IssueMaster.php><u>Back</u></a></b>";
}
?>
</body></html>