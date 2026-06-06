<?php
include("../db.php");
$qry=execute("select Sessional_ID from sessional_master where Sessional_Name='$test'");
$rw=fetcharray($qry);
$session=explode('SL',$rw[0]);
if($course>0)
{
	$table = "marks_".$course."_".$sem;
}
$i=0;
while(list (,$value)=each($att))
{
	
	$str=execute("select * from $table  where studid='$value' and subid='$subj_id' and accyr='$ayear'");
	if(rowcount($str)<=0)
	{
	$var3 = "insert into $table(studid,secid,subid,bid,accyr,remks) values('$value','$section','$subj_id','$course','$ayear','$remks[$i]')";
	}
	else
	{
		
	    $qr1=execute("select $sel from $table  where studid='$value' and subid='$subj_id' and accyr='$ayear'");

		$result1=fetcharray($qr1);
		
	   $var3 = "update $table set remks='$remks[$i]' where studid='$value' and subid='$subj_id' ";
		echo "<br>";
		
	
}

$res3 = execute($var3) or die(mysql_error());
$i++;
	
}
header('Location:AddreMarks1.php?course='.$course.'&subj_id='.$subj_id.'&sem='.$sem.'&section='.$section.'&elective='.$elective.'&cycle='.$cycle.'&type='.$type.'&batch='.$batch.'&test='.$test.'&ayear='.$ayear);
?>