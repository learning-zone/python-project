<?php
session_start();
include("../db.php");
$q=$_GET["q"];
$type=$q;
if($type==1)
{
	
}
if($type==2)
{

$pchecked="";
	$achecked="";
	$wochecked="";
	$hchecked="";
	$lchecked="";
	$fhlchecked="";
	$shlchecked="";
	$lwpchecked="";
	$peechecked="";
	$plcchecked="";
	$pqdchecked="";
	$podchecked="";
	$dchecked="";
	if($p_leave==1)
	{
		$pchecked="checked";
	}
	if($a_leave==2)
	{
		$achecked="checked";
	}
	if($wo_leave==3)
	{
		$wochecked="checked";
	}
	if($h_leave==4)
	{
		$hchecked="checked";
	}
	if($l_leave==5)
	{
		$lchecked="checked";
	}
	if($fhl_leave==6)
	{
		$fhlchecked="checked";
	}
	if($shl_leave==7)
	{
		$shlchecked="checked";
	}
	if($lwp_leave==8)
	{
		$lwpchecked="checked";
	}
	if($pee_leave==9)
	{
		$peechecked="checked";
	}
	if($plc_leave==10)
	{
		$plcchecked="checked";
	}
	if($pqd_leave==11)
	{
		$pqdchecked="checked";
	}
	if($dft_leave==12)
	{
		$dchecked="checked";
	}
	if($pod_leave==13)
	{
		$podchecked="checked";
	}
	?>
    <b>Leave Points : </b>
    <input type="checkbox" name="dft_leave" value="12" <?=$dchecked?> />&nbsp;Default
    <input type="checkbox" name="p_leave" value="1" <?=$pchecked?>  />&nbsp;P
    <input type="checkbox" name="a_leave" value="2" <?=$achecked?> />&nbsp;A
    <input type="checkbox" name="wo_leave" value="3" <?=$wochecked?> />&nbsp;WO
    <input type="checkbox" name="h_leave" value="4" <?=$hchecked?> />&nbsp;H
    <input type="checkbox" name="l_leave" value="5" <?=$lchecked?> />&nbsp;L
    <input type="checkbox" name="fhl_leave" value="6" <?=$fhlchecked?>  />&nbsp;FHL
    <input type="checkbox" name="shl_leave" value="7" <?=$shlchecked?> />&nbsp;SHL
    <input type="checkbox" name="lwp_leave" value="8" <?=$lwpchecked?> />&nbsp;LWP
    <input type="checkbox" name="pee_leave" value="9" <?=$peechecked?> />&nbsp;P(EE)
    <input type="checkbox" name="plc_leave" value="10" <?=$plcchecked?> />&nbsp;P(LC)
    <input type="checkbox" name="pqd_leave" value="11" <?=$pqdchecked?>  />&nbsp;P(QD)
    <input type="checkbox" name="pod_leave" value="13" <?=$podchecked?>  />&nbsp;P(OD)

<?php
}
?>