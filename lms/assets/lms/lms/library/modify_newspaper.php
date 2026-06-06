<html>
<HEAD>
</HEAD>
<BODY>
<?php
require("../db.php");
$library_id = $library;
$accNo = $accNo;
if($register1!='')
{
	$register=$register1;
}
if($type=='mod')
{
	if(($dd !="00")||($mm !="00")||($yy !="0000"))
	{
		if(!checkdate($mm,$dd,$yy))
		{
			echo "<font color=royalblue;><b>Invalid Date.</b> </font>";
			die("</td></tr></table>");
		}
	}
	$newspaper_date="$yy-$mm-$dd";

	$sql="update lib_newspaper_det set ";
	$sql.=" title='$title',";
	$sql.=" newspaper_date='$newspaper_date',";
	$sql.=" language='$language',";
	$sql.=" amount='$amount',";
	$sql.=" register='$register',";
	$sql.=" library='$library',";
	$sql.=" remarks='$remarks'";
	$sql.=" where id=$id";

	execute($sql);


	header("Location:add_newspaper.php?SeekPos=$SeekPos");
}
elseif($type=='del')
{
	$rs_qry=execute("select * from lib_newspaper_det");
	if(rowcount($rs_qry)>1)
	{

		execute("delete from lib_newspaper_det where id=$id");
		echo "<font color='blue'><b>Deleted Successfully.</b></font>";
	}
	else
	{
			echo "<font color='red'><b>You Can't Delete All The Records.</b></font>";

	}
	echo "<a href=../library/add_newspaper.php?library=$library><b>Go Back</b></a></div></td>";



}
?>
</BODY>
</HTML>

