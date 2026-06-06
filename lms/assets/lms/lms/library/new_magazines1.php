<?php
session_start();
require_once("../db.php");


if($_GET)
{
	$jmsub=$_REQUEST['jmsub'];
	$actn=$_REQUEST['actn'];
	
}
if($_POST)
{
$magazine_sub_no=$_POST['magazine_sub_no'];
$jmsub=$_POST['jmsub'];
$act=$_POST['act'];
$newid=$_POST['newid'];
$library=$_POST['library'];
$register1=$_POST['register1'];
$magazine_no=$_POST['magazine_no'];
$l_name=$_POST['l_name'];
$r_name=$_POST['r_name'];
$title=$_POST['title'];
$language=$_POST['language'];
$source=$_POST['source'];
$subject=$_POST['subject'];
$dd=$_POST['dd'];
$mm=$_POST['mm'];
$yy=$_POST['yy'];
$month=$_POST['month'];
$year=$_POST['year'];
$issue=$_POST['issue'];
$issn=$_POST['issn'];
$volume=$_POST['volume'];
$no_of_pages=$_POST['no_of_pages'];
$rack=$_POST['rack'];
$price=$_POST['price'];
$keywords=$_POST['keywords'];
$articles1=$_POST['articles1'];
$articles2=$_POST['articles2'];
$remarks=$_POST['remarks'];
$idttl=$_POST['idttl'];
$du_dd=$_POST['du_dd'];
$du_mm=$_POST['du_mm'];
$du_yy=$_POST['du_yy'];
$su_dd=$_POST['su_dd'];
$su_mm=$_POST['su_mm'];
$su_yy=$_POST['su_yy'];
}

$mag_date = "$yy-$mm-$dd";
$sub_date = "$du_yy-$du_mm-$du_dd";
 $due_date = "$su_yy-$su_mm-$su_dd";
//add
if($actn==1)
{
	$sql2="select * from lib_magazine where magazine_sub_no='$magazine_sub_no' and magazine_date='$mag_date' and ssp_type='$jmsub' and subscription_date='$sub_date' and due_date='$due_date'";
	
	$rs2=execute($sql2);
	//echo $sql2;
	if(rowcount($rs2)==0)
	{
		$sql="insert  into lib_magazine (magazine_sub_no,library,register,title,language,";
		$sql.="source,subject,magazine_date,month,year,issue,issn,volume,magazine_no,";
		$sql.="no_of_pages,rack,amount,keywords,articles1,articles2,remarks,ssp_type,subscription_date,due_date)";
		$sql.=" values ('$magazine_sub_no','$library','$register1','$title','$language',";
		$sql.="'$source','$subject','$mag_date','$month','$year','$issue','$issn','$volume','$magazine_no',";
		$sql.="'$no_of_pages','$rack','$price','$keywords','$articles1','$articles2','$remarks','$jmsub','$sub_date','$due_date')";
		$result=execute($sql)or die("Could not add details");
		echo $sql;
		if($result)
		{
			$msg='Records Inserted';
		    echo "<META HTTP-EQUIV='Refresh' Content='0;URL=new_magazines.php?msg=$msg&jmsub=$jmsub&act=$act'>";
		}
		else
		{
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=new_magazines.php?msg=$msg&jmsub=$jmsub&act=$act'>";
		}
	}
	else
	{
		echo "<a href=../library/new_magazines.php>Go Back</a></td>";
		echo "<br>";
		die("Duplicate Entry");
	}
}
//modify
elseif($actn==2)
{
	$sql="update lib_magazine set subject='$subject',magazine_date='$mag_date',month='$month',";
	$sql.="year='$year',issue='$issue',issn='$issn',volume='$volume',";
	$sql.="no_of_pages='$no_of_pages',rack='$rack',amount='$price',keywords='$keywords',";
	$sql.="articles1='$articles1',articles2='$articles2',remarks='$remarks',subscription_date='$sub_date',due_date='$due_date'  where id='$newid'";
	//echo "<br>".$sql;
	
	$result=execute($sql) or die("Could not update details");
	if($result)
	{
		$msg='Records Updated';
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=new_magazines.php?msg=$msg&jmsub=$jmsub&act=$act'>";
	}
	else
	{
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=new_magazines.php?msg=$msg&jmsub=$jmsub&act=$act'>";
	}
}

//Inactive

elseif($actn==3)
{
	$sql="update lib_magazine set stts=0 where id='$newid' ";
	$result=execute($sql) or die("Could not update details");
	if($result)
	{
		$msg='Records Updated';
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=new_magazines.php?msg=$msg&jmsub=$jmsub&act=$act'>";
	}
	else
	{
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=new_magazines.php?msg=$msg&jmsub=$jmsub&act=$act'>";
	}
}
?>
