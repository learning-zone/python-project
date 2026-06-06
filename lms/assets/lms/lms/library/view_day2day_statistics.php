<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
require_once("../db.php");

$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$TYear=$_POST['TYear'];
$FYear=$_POST['FYear'];
$media=$_POST['media'];
$ndate=$_POST['ndate'];
$library=$_POST['library'];
$issue_date=$_POST['issue_date'];

if(!checkdate($FMon,$FDay,$FYear))
{
	echo "Invalid From Date. ";
	die("</td></tr></table>");
}
$from_date = "$FYear-$FMon-$FDay";

if(!checkdate($TMon,$TDay,$TYear))
{
	echo "Invalid To Date. ";
	die("</td></tr></table>");
}
$to_date = "$TYear-$TMon-$TDay";

?>
<HTML>
<HEAD>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = "";
}
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=650,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<body>
<FORM NAME="frm" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="issue_date" VALUE="<?php echo $issue_date;?>">
<INPUT TYPE="HIDDEN" NAME="TYear" VALUE="<?php echo $TYear;?>">
<INPUT TYPE="HIDDEN" NAME="TMon" VALUE="<?php echo $TMon;?>">
<INPUT TYPE="HIDDEN" NAME="TDay" VALUE="<?php echo $TDay;?>">
<INPUT TYPE="HIDDEN" NAME="FYear" VALUE="<?php echo $FYear;?>">
<INPUT TYPE="HIDDEN" NAME="FMon" VALUE="<?php echo $FMon;?>">
<INPUT TYPE="HIDDEN" NAME="FDay" VALUE="<?php echo $FDay;?>">
<INPUT TYPE="HIDDEN" NAME="media" VALUE="<?php echo $media;?>">
<INPUT TYPE="HIDDEN" NAME="ndate" VALUE="<?php echo $ndate;?>">
<?php
/*
<INPUT TYPE="HIDDEN" NAME="library" VALUE="<?php echo $library;?>">
*/
?>
<INPUT TYPE="HIDDEN" NAME="library" VALUE="1">
<table width='90%' align='center' border='1'>
<!--<tr><td align='center' class='head'><?php echo  collegename(); ?></td></tr>-->
<tr><td align='center' class='rowpic'>Day To Day Transaction Report</td></tr>
<tr><td align='center'>From : <?php echo date('d-m-Y',strtotime($from_date))?>&nbsp;&nbsp;
To : <?php echo date('d-m-Y',strtotime($to_date))?></td></tr>
<?php
$library=1;
if($media=='0')
	$medname="( All Media )";
else
{
	$r123=fetcharray(execute("select name from lib_mediatype where id='$media'"));
	$medname="( ".$r123[name]." )";
}
if($library=='0')
	$rs_sqll=execute("select id,name from library_name order by id ");
else
	$rs_sqll=execute("select id,name from library_name where id='$library'");
	//echo "hello";
	//die();
while($rr=fetcharray($rs_sqll))
{
	//echo "<br>";
	//echo "inside while";
	//die();
	?>
	<tr><td><table width='100%' border=1 cellspacing=0 class=forumline align='center'>
	<tr><td align='center' class='head' colspan='6'><?=$rr[name]?> <?=$medname?></td></tr>
	<td align='center' class=rowpic>Issued</td >
	<td align='center' class=rowpic>Returned</td>
	<td align='center' class=rowpic>Renewed</td>
	<td align='center' class=rowpic>Reserved</td></tr>
	<?php
	//$diff_date=date_diff($to_date,$from_date,d);
	//echo "diff_date :".$diff_date;
	$count=1;
	$total_issue  = 0;
	$total_return  = 0;
	$total_reserved  = 0;
	$total_renewal  = 0;
	//for($i=0; $i <=$diff_date; $i++)
	//{	
		$ndate= date("Y-m-d",mktime(0,0,0,$FMon,$FDay + $i,$FYear));
		//echo "ndate :".$ndate;
		$issue=0;
		/*************************************   NUMBER OF ISSUE  *************************************/
		if($media=='0') //ALL 
		{
			
			$rs_sqlM=execute("select count(a.id) as no_issue from lib_circulation_m a where a.issue_date >='$from_date' and a.issue_date<='$to_date' and library='$rr[0]' ORDER BY acc_id");
			
			$rs_sqlR=execute("select count(a.id) as no_issue from lib_circulation_r a where a.issue_date >='$from_date' and a.issue_date<='$to_date' and library='$rr[0]' ORDER BY acc_id");
			
			$r_sqlM=fetcharray($rs_sqlM);
			$r_sqlR=fetcharray($rs_sqlR);
			$issue=$r_sqlM["no_issue"] + $r_sqlR["no_issue"];
			mysql_free_result($rs_sql);
			
		}
		else
		{
			 			 
			$rs_sqlM=execute("select count(a.id) as no_issue from lib_circulation_m a where a.issue_date >='$from_date' and a.issue_date<='$to_date' and library='$rr[0]' and a.media_type='$media' ORDER BY acc_id");
			
			$rs_sqlR=execute("select count(a.id) as no_issue from lib_circulation_r a where a.issue_date >='$from_date' and a.issue_date<='$to_date' and library='$rr[0]' and a.media_type='$media' ORDER BY acc_id");
			
			$r_sqlM=fetcharray($rs_sqlM);
			$r_sqlR=fetcharray($rs_sqlR);
			$issue=$r_sqlM["no_issue"] + $r_sqlR["no_issue"];
			mysql_free_result($rs_sql);
			//mysql_free_result($rs_sql1);
		}
		/****************************************  RETURNED  ***********************************/
		if($media=='0')//ALL
		{
			$sqlReturn=execute("select count(a.id) as no_return from lib_circulation_r a where a.return_date >='$from_date' and a.return_date<='$to_date' and library='$rr[0]' ORDER BY acc_id");
		}
		else
		{
			$sqlReturn=execute("select count(a.id) as no_return from lib_circulation_r a where a.return_date >='$from_date' and a.return_date<='$to_date' and library='$rr[0]' and a.media_type='$media' ORDER BY acc_id");
		}
		if(rowcount($sqlReturn)>0)
		{
			$r_sqlReturn=fetcharray($sqlReturn);
			$return=$r_sqlReturn["no_return"];
		}
		else
		{
			$return=0;
		}
		mysql_free_result($rs_sql);
		
		/*********************************  RENEWED  *********************************/
		$renewal=0;
		if($media=='0')//ALL
		{
			$rs_sqlRenewM=execute("select count(a.id) as no_renewal from lib_circulation_m a where a.issue_date >='$from_date' and a.issue_date<='$to_date' and library='$rr[0]' and renews!=0 ORDER BY acc_id");
			
			$rs_sqlRenewR=execute("select count(a.id) as no_renewal from lib_circulation_r a where a.issue_date >='$from_date' and a.issue_date<='$to_date' and library='$rr[0]' and renews!=0 ORDER BY acc_id");
			
			$r_sqlRenewM=fetcharray($rs_sqlRenewM);
			$r_sqlRenewR=fetcharray($rs_sqlRenewR);
			$renewal=$r_sqlRenewM["no_renewal"] + $r_sqlRenewR["no_renewal"];
			mysql_free_result($rs_sqlRenewM);
			mysql_free_result($rs_sqlRenewR);
		}
		else
		{
			$rs_sqlRenewM=execute("select count(a.id) as no_renewal from lib_circulation_m a where a.issue_date >='$from_date' and a.issue_date<='$to_date' and library='$rr[0]' and renews!=0 and a.media_type='$media' ORDER BY acc_id");
			
			$rs_sqlRenewR=execute("select count(a.id) as no_renewal from lib_circulation_r a where a.issue_date >='$from_date' and a.issue_date<='$to_date' and library='$rr[0]' and renews!=0 and a.media_type='$media' ORDER BY acc_id");
			
			$r_sqlRenewM=fetcharray($rs_sqlRenewM);
			$r_sqlRenewR=fetcharray($rs_sqlRenewR);
			$renewal=$r_sqlRenewM["no_renewal"] + $r_sqlRenewR["no_renewal"];
			mysql_free_result($rs_sqlRenewM);
			mysql_free_result($rs_sqlRenewR);
		}
		/*****************************  RESERVED  **************************/
		if($register==0)
		{
			$rs_sql=execute("select count(a.id) as no_reserved from lib_reservation_temp a where a.resdate='$ndate' and l_id='$rr[0]'");
		}
		else
		{
			$rs_sql=execute("select count(a.id) as no_reserved from lib_reservation_temp a where a.resdate='$ndate' and l_id='$rr[0]' and a.media_type='$media'");
		}
		if(rowcount($rs_sql)>0)
		{
			$r_sql=fetcharray($rs_sql);
			$reserved=$r_sql["no_reserved"];
		}
		else
		{
			$reserved=0;
		}
		if(($issue !=0) || ($return !=0) || ($renewal !=0) || ($reserved !=0))
		{
			if($count<10)
				$count="0".$count;
			?>
			<tr height='30'>
			<? if($issue>0){
			?>
			<td align='center'><a href="javascript:OpenWind('dtodreport.php?library=<?=$rr[0]?>&media=<?=$media?>&from_date=<?=$from_date?>&to_date=<?=$to_date?>&rtp=1');"><?php echo $issue; ?></a></td>
			<? } 
			else
				echo"<td align='center'>$issue</td>";
			?>
			
			<? if($return>0){?>
				<td align='center'><a href="javascript:OpenWind('dtodreport.php?library=<?=$rr[0]?>&media=<?=$media?>&from_date=<?=$from_date?>&to_date=<?=$to_date?>&rtp=2');"><?php echo $return; ?></a></td>
			<? }
			else
				echo "<td align='center'>$return</td>" ;
			?>
		   <? if($renewal>0){?> 
			<td align='center'><a href="javascript:OpenWind('dtodreport.php?library=<?=$rr[0]?>&media=<?=$media?>&from_date=<?=$from_date?>&to_date=<?=$to_date?>&rtp=3');"><?php echo $renewal; ?></a></td>
			<?php
			}
			else 
			echo "<td align='center'>$renewal</td>" ;
			?>
		
			<? if($reserved>0){?> 
			<td align='center'><a href="javascript:OpenWind('dtodreport.php?library=<?=$rr[0]?>&media=<?=$media?>&from_date=<?=$from_date?>&to_date=<?=$to_date?>&rtp=4');"><?php echo $reserved; ?></a></td>
			<? }
			else
			echo "<td align='center'>$reserved</td>" ;
			?>
			</tr>
			<?php
			$count=$count+1;
			$total_issue  = $total_issue + $issue;
			$total_return  =$total_return + $return;
			$total_reserved = $total_reserved + $reserved;
			$total_renewal = $total_renewal + $renewal;
		}
	//}
	?>
    <!--
	<tr height='30'><td colspan=2 align='right'>Total&nbsp;&nbsp;</td>
	<?php if($total_issue>0)
	{
	?>
	<td align='center'><a href="javascript:OpenWind('dtodreport.php?library=<?=$rr[0]?>&media=<?=$media?>&rtp=1&fdt=<?=$from_date?>&edt=<?=$to_date?>');"><?php echo $total_issue;?></a></td>
	<?
	}
	else
	 echo"<td align='center'>$total_issue</td>";
	 ?>
	<?php if($total_return>0)
	{
	?>
	<td align='center'><a href="javascript:OpenWind('dtodreport.php?library=<?=$rr[0]?>&media=<?=$media?>&rtp=2&fdt=<?=$from_date?>&edt=<?=$to_date?>');"><?php echo $total_return?></a></td>
	<?
	}
	else 
		echo"<td align='center'>$total_return</td>";
	?>
	<?php if($total_renewal>0)
	{
	?>
	<td align='center'><a href="javascript:OpenWind('dtodreport.php?library=<?=$rr[0]?>&media=<?=$media?>&rtp=3&fdt=<?=$from_date?>&edt=<?=$to_date?>');"><?php echo $total_renewal?></a></td>
	<?
	}
	else
		echo "<td align='center'>$total_renewal</td>";
	if($total_reserved>0)
	{
		?>
		<td align='center'><a href="javascript:OpenWind('dtodreport.php?library=<?=$rr[0]?>&media=<?=$media?>&rtp=4&fdt=<?=$from_date?>&edt=<?=$to_date?>');"><?=$total_reserved?></td>
		<?php
	}
	else
		echo "<td align='center'>$total_reserved</td>";
	?>
	</tr>
	</table>-->
	<?php
}
mysql_free_result($rs_sql);
?>
</tr>
</table>
</table>
<br><div id='prn' align='center'>
<p align="center"><input type='button' name='print' value='<<  Print  >>' class='bgbutton' onclick='printReport()'>
</div>
</body>
</html>