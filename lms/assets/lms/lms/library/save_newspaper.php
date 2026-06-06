<HTML>
<HEAD>
<?php
require("../db.php");
if(($dd !="00")||($mm !="00")||($yy !="0000"))
{
	if(!checkdate($mm,$dd,$yy))
	{
		echo "<font color=royalblue;><b>Invalid Date.</b> </font>";
		die("</td></tr></table>");
	}
}
$newspaper_date = "$yy-$mm-$dd";
?>
</HEAD>
<BODY>
<form>
<?php
$sql2="select * from lib_newspaper_det where title='$title' and newspaper_date='$newspaper_date'";
$rs2=execute($sql2);
if(rowcount($rs2)==0)
{
	$sql="insert  into lib_newspaper_det ( title,newspaper_date,";
	$sql.=" language,amount,register,library,remarks)";
	$sql.=" values ('$title','$newspaper_date','$language',";
	$sql.=" '$amount','$register1', $library ,'$remarks')";
	execute($sql);
	$master_id=fetchInsertId();
	if($master_id < 10)
	{
		$j="0000".$master_id;
	}
	elseif($master_id <100)
	{
		$j="000".$master_id;
	}
	elseif($master_id <1000)
	{
		$j="00".$master_id;
	}
	elseif($master_id <10000)
	{
		$j="0".$master_id;
	}
	else
	{
		$j=$master_id;
	}
	$newspaper_id=$register."03".$j;
	$sql="update lib_newspaper_det set newspaper_no='$newspaper_id' where id=$master_id";
	//echo $sql;
	execute($sql);
}
echo "<font color='blue'><b>Updated Successfully.</b></font>";
//echo "<a href=../library/add_newspaper.php?library=$library><b>Go Back</b></a></div></td>";
?>
</form>
</BODY>
</HTML>