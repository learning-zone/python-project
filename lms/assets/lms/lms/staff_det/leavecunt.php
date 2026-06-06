<?php
session_start();
include("../db.php");
$q=$_GET["q"];
$type=$q;

$staff_id_us=fetcharray(execute("SELECT srid FROM users where username='$user'"));

$daysvat=fetcharray(execute("select days from leave_staff_day  where status=1 and leave_type='$type'"));

$daycount=fetcharray(execute("select days from staff_leave where staff_id='$staff_id_us[0]' and type='$type'  and status=1 and reject='0'"));



$alltot=$daysvat[0]-$daycount[0];
	if($alltot>0)
	{
		$alltot1=$alltot;
	}
	if($alltot<=0)
	{
		$alltot1=0;
	}
	$daydisp=fetcharray(execute("select lv_ty from staff_leave_type where  id='$type'  and status=1"));

if($type!='')
{
	if(!$daydisp[0])
	{

$alltot1
?>   
       
     <!-- Available&nbsp;<input type="text" name="daysval" value="<?=$alltot1?>"  readonly style="background-color: #FFFFCC" size="3">-->
  
        <?
	}
}
		?>
