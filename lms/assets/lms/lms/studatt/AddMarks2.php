<?php
include("../db.php");
//$qry=execute("select Sessional_ID from sessional_master where Sessional_Name='$test'");
//$rw=fetcharray($qry);
//$session=explode('SL',$rw[0]);
//$s=$session[1];
if(date('m')<6)
{
	$accyear=1-date('Y');
}
else
$accyear=date('Y');
$s=$test;
if($course>0)
{
	$table = "marks_".$course."_".$sem;
	
}
$i=0;
while(list (,$value)=each($att))
{
	
	$str=execute("select * from $table  where studid='$value' and subid='$subj_id' and accyr='$accyear'");
	if(rowcount($str)<=0)
	{
		$var = "mark".$value;
		$obt_mark = $$var;
		
		$fim=$obt_mark/2;
		$var3 = "insert into $table(studid,secid,subid,bid,accyr,assmk1,fintmk) values('$value','$section','$subj_id','$course','$accyear','$obt_mark','$fim')";
	}
	else
	{
		$var = "mark".$value;
		$obt_mark = $$var;
		$qr=execute("select assmk1,assmk2,assmk3,assmk4,assmk5, GREATEST(assmk1,assmk2,assmk3,assmk4,assmk5) as lr from $table  where studid='$value' and subid='$subj_id' and accyr='$ayear'");
		$result=fetcharray($qr);
		$lar=$result[lr];
		if($result[assmk1]==$lar)
			$sel='GREATEST(assmk2,assmk3)';
		else
				if($result[assmk2]==$lar)
		$sel='GREATEST(assmk1,assmk3)';
		else
				if($result[assmk3]==$lar)
			$sel='GREATEST(assmk2,assmk1)';
		else
				if($result[assmk4]==$lar)
			$sel='GREATEST(assmk2,assmk3,assmk1,assmk5)';
		else
				if($result[assmk5]==$lar)
			$sel='GREATEST(assmk2,assmk3,assmk4,assmk1)';
		$qr1=execute("select $sel from $table  where studid='$value' and subid='$subj_id' and accyr='$ayear'");
		$result1=fetcharray($qr1);
		$slar=$result1[0];	
		$finm=($lar+$slar)/2;
		 $var3 = "update $table set studid='$value',secid='$section',subid='$subj_id',bid='$course',accyr='$ayear',$x='$obt_mark',fintmk='$finm' where studid='$value' and subid='$subj_id' and accyr='$ayear'";
		echo "<br>";
	
}
$res3 = execute($var3) or die(mysql_error());
	
}
header('Location:AddMarks1.php?course='.$course.'&subj_id='.$subj_id.'&sem='.$sem.'&section='.$section.'&elective='.$elective.'&cycle='.$cycle.'&type='.$type.'&batch='.$batch.'&test='.$test.'&ayear='.$ayear);
?>