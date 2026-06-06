<?php
session_start();
include("../db.php");
$cyr=$curyr1;
if(trim($Type) == "Add")
{
	if($ass == "" or $ass_max == "" or $ass_wt == "")
	{
		echo "<b><font color=red>Data could not be updated...!!<br>Assesment Name, Max Marks & Wieghtage are mendotary fields..</font><b>";
		echo "<br><b><a href=des_assesment.php?prm=$prm&sem=$sem&secid=$secid&subn=$subn><< BACK >></a></b>";
	}
	else
	{
		$ass_dt=$ass_dty."-".$ass_dtm."-".$ass_dtd;
		$sql23="select * from cie_det where accyr=$cyr and c_id=$prm and sem_id=$sem and sec_id=$secid and sub_id=$subn";
		$rs23=execute($sql23);
		$rn=rowcount($rs23);
		if($rn > 0)
		{
			$sqlstr="update cie_det set num_cie=$num_cie,ass".$num_cie."='$ass',ass_dt".$num_cie."='$ass_dt', "; 
			$sqlstr.="ass_max".$num_cie."=$ass_max,ass_wt".$num_cie."=$ass_wt where ";
			$sqlstr.="accyr=$cyr and c_id=$prm and sem_id=$sem and sec_id=$secid and sub_id=$subn";
		}
		else
		{
			$sqlstr="insert into cie_det (c_id,sem_id,sec_id,sub_id,num_cie,accyr,ass1,ass_dt1,ass_max1,ass_wt1) ";
			$sqlstr.= "values ($prm,$sem,$secid,$subn,$num_cie,$cyr,'$ass','$ass_dt',$ass_max,$ass_wt)";	
		}
		echo $sqlstr;
		execute($sqlstr) or die("Error...1");
		header("Location:des_assesment1.php?prm=$prm&sem=$sem&secid=$secid&subn=$subn ");
	}
}
elseif(trim($Type) == "Mod")
{
	while( list(,$Value) = each($Sel) )
	{
		$assn = "ass".$Value;
		$ass = trim($$assn);
		$ass_maxn = "ass_max".$Value;
		$ass_max = trim($$ass_maxn);
		$ass_wtn = "ass_wt".$Value;
		$ass_wt = trim($$ass_wtn);
		$ass_dtdn = "ass_dtd".$Value;
		$ass_dtd = trim($$ass_dtdn);
		$ass_dtmn = "ass_dtm".$Value;
		$ass_dtm = trim($$ass_dtmn);
		$ass_dtyn = "ass_dty".$Value;
		$ass_dty = trim($$ass_dtyn);
		$ass_dtn="ass_dt".$Value;
		$ass_dt=$ass_dty."-".$ass_dtm."-".$ass_dtd;
		$sqlstr="update cie_det set $assn='$ass',$ass_dtn='$ass_dt',$ass_maxn=$ass_max,$ass_wtn=$ass_wt where "; 
		$sqlstr.="accyr=$cyr and c_id=$prm and sem_id=$sem and sec_id=$secid and sub_id=$subn";
		execute($sqlstr) or die("Error...2");
	}	
	header("Location:des_assesment1.php?prm=$prm&sem=$sem&secid=$secid&subn=$subn");
}
?>
