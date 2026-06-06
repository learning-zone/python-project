<?php
require_once("../db.php");
$register=$_POST['register'];
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
</script>
</HEAD>
<BODY>
<table width='90%' align='center' class=forumline>
<div id='main_header'>
<tr height='20'>
<?php
/*
<td align='left' class='rowpic'>Register:
<?
if($register!="0")
{
	$rs_sql=execute("select * from lib_register where id=$register");
	$r_sql=fetcharray($rs_sql);
	echo "$r_sql[register]";
}
else
{
	echo "All Register";
}
?>
</td>
*/
	$Register=1;
?>

<td align='center' class='head'>As On: <?=date('d-m-Y');?>
</td>
</tr>
</table>
<br>
<table align="center" border =1 cellspacing=0 class=forumline width="90%">
<tr><td align="center" Class="head" colspan=7>Library Stock Verification Report </td></tr>
<tr>
<td align="center" >Sl.No</td>
<td align="center" >Media</td>
<td align="center" >Total Copies</td>
<td align="center" >Copies Missing</td>
<td align="center" >Copies Damaged</td>
<td align="center" >Copies Issued</td>
<td align="center" >Copies in Hand</td>
</tr>
<?php
$total=0;
$outno=0;
$inhand=0;
$missing=0;
$damaged=0;
$sql="select * from lib_mediatype ";
$rs=execute($sql);
$i=1;
$register=1;
while($r=fetcharray($rs))
{
	if($r[0]==1)
	{
		if($register!="0")//total copies//
		{
			$sql1="select count(*) as total_media from lib_acc_details where media_type=$r[0] and register=$register and book_status='1'";
		}
		else
		{
			$sql1="select count(*) as total_media from lib_acc_details where media_type=$r[0] and book_status='1'";
		}
		$rs1=execute($sql1);
		$r1=fetcharray($rs1);
		if($register!="0")//missing copies//
		{
			$sql2="select count(*) as total_media from lib_acc_details where media_type=$r[0] and register=$register and book_status='1' and mode='M'";
		}
		else
		{
			$sql2="select count(*) as total_media from lib_acc_details where media_type=$r[0] and book_status='1' and mode='M'";
		}
		$rs2=execute($sql2);
		$r2=fetcharray($rs2);
		if($register!="0")//damaged copies//
		{
			$sql3="select count(*) as total_media from lib_acc_details where media_type=$r[0] and register=$register and book_status='1' and mode='D'";
		}
		else
		{
			$sql3="select count(*) as total_media from lib_acc_details where media_type=$r[0] and book_status='1' and mode='D'";
		}
		$rs3=execute($sql3);
		$r3=fetcharray($rs3);
		if($register!="0")//issued copies//
		{
			$abc="select count(a.id) as total_media from `lib_acc_details` a, `lib_circulation_m` b where a.media_type=$r[0] and a.register=$register and a.book_status='1' and a.flag=1 AND a.acc_no = b.acc_id";
			//echo "<br>".$abc;
		}
		else
		{
			$abc="select count(a.id) as total_media from `lib_acc_details` a, `lib_circulation_m` b where a.media_type=$r[0] and a.book_status='1' and a.flag=1 AND a.acc_no = b.acc_id";
			//echo "<br>".$abc;
		}
		$abc1=execute($abc);
		$abc2=fetcharray($abc1);
	}
	else if($r[0]==2)
	{
		if($register!="0")//total cds//
		{
			$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1'";
		}
		else
		{
			$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and cd_status='1'";
		}
		$rs1=execute($sql1);
		$r1=fetcharray($rs1);
		if($register!="0")//missing cds//
		{
			$sql2="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and mode = 'M'";
		}
		else
		{
			$sql2="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and cd_status='1' and mode = 'M'";
		}
		$rs2=execute($sql2);
		$r2=fetcharray($rs2);
		if($register!="0")//damaged cds//
		{
			$sql3="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and mode='D'";
		}
		else
		{
			$sql3="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and  cd_status='1' and mode='D'";
		}
		$rs3=execute($sql3);
		$r3=fetcharray($rs3);
		if($register!="0")//issued cds//
		{
			$abc="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and flag=1";
		}
		else
		{
			$abc="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and cd_status='1' and flag=1";
		}
		$abc1=execute($abc);
		$abc2=fetcharray($abc1);
	}
	else if($r[0]==3)
	{
		if($register!="0")//total floppy//
		{
			$sql1="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and register=$register and floppy_status='1'";
		}
		else
		{
			$sql1="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and floppy_status='1'";
		}
		$rs1=execute($sql1);
		$r1=fetcharray($rs1);
		if($register!="0")//missing floppy//
		{
			$sql2="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and register=$register and floppy_status='1' and mode='M'";
		}
		else
		{
			$sql2="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and floppy_status='1' and mode='M'";
		}
		$rs2=execute($sql2);
		$r2=fetcharray($rs2);
		if($register!="0")//damaged floppy//
		{
			$sql3="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and register=$register and floppy_status='1' and mode='D'";
		}
		else
		{
			$sql3="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and floppy_status='1' and mode='D'";
		}
		$rs3=execute($sql3);
		$r3=fetcharray($rs3);
		if($register!="0")//issued floppy//
		{
			$abc="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and register=$register and floppy_status='1' and flag=1";
		}
		else
		{
			$abc="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and floppy_status='1' and flag=1";
		}
		$abc1=execute($abc);
		$abc2=fetcharray($abc1);
	}
	else if($r[0]==4)
	{
		if($register!="0")//total other cds//
		{
			$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1'";
		}
		else
		{
			$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and cd_status='1'";
		}
		$rs1=execute($sql1);
		$r1=fetcharray($rs1);
		if($register!="0")//missing other cds//
		{
			$sql2="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and mode='M'";
		}
		else
		{
			$sql2="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and cd_status='1' and mode='M'";
		}
		$rs2=execute($sql2);
		$r2=fetcharray($rs2);
		if($register!="0")//damaged other cds//
		{
			$sql3="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and mode='D'";
		}
		else
		{
			$sql3="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0]  and cd_status='1' and mode='D'";
		}
		$rs3=execute($sql3);
		$r3=fetcharray($rs3);
		if($register!="0")//issued other cds//
		{
			$abc="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and flag=1";
		}
		else
		{
			$abc="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and cd_status='1' and flag=1";
		}
		$abc1=execute($abc);
		$abc2=fetcharray($abc1);
	}
	elseif($r[0]==5)
	{
		if($register!="0")//total project//
		{
			$sql1="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and register=$register and book_status='1'";
		}
		else
		{
			$sql1="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and book_status='1'";
		}
		$rs1=execute($sql1);
		$r1=fetcharray($rs1);
		if($register!="0")//missing project//
		{
			$sql2="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and register=$register and book_status='1' and mode='M'";
		}
		else
		{
			$sql2="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and book_status='1' and mode='M'";
		}
		$rs2=execute($sql2);
		$r2=fetcharray($rs2);
		if($register!="0")//damaged projects//
		{
			$sql3="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and register=$register and book_status='1' and mode='D'";
		}
		else
		{
			$sql3="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and book_status='1' and mode='D'";
		}
		$rs3=execute($sql3);
		$r3=fetcharray($rs3);
		if($register!="0")//issued projects//
		{
			$abc="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and register=$register and book_status='1' and flag=1";
		}
		else
		{
			$abc="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and book_status='1' and flag=1";
		}
		$abc1=execute($abc);
		$abc2=fetcharray($abc1);
	}
	elseif($r[0]==6)
	{
		if($register!="0")//total bound//
		{
			$sql1="select count(*) as total_media from lib_bound_acc_det where register=$register and bound_status='1'";
		}
		else
		{
			$sql1="select count(*) as total_media from lib_bound_acc_det where bound_status='1'";
		}
		$rs1=execute($sql1);
		$r1=fetcharray($rs1);
		if($register!="0")//missing bound//
		{
			$sql2="select count(*) as total_media from lib_bound_acc_det where register=$register and bound_status='1' and mode='M'";
		}
		else
		{
			$sql2="select count(*) as total_media from lib_bound_acc_det where bound_status='1' and mode='M'";
		}
		$rs2=execute($sql2);
		$r2=fetcharray($rs2);
		if($register!="0")//damaged bound//
		{
			$sql3="select count(*) as total_media from lib_bound_acc_det where register=$register and bound_status='1' and mode='D'";
		}
		else
		{
			$sql3="select count(*) as total_media from lib_bound_acc_det where bound_status='1' and mode='D'";
		}
		
		$rs3=execute($sql3);
		$r3=fetcharray($rs3);
		if($register!="0")//issued bound//
		{
			$abc="select count(*) as total_media from lib_bound_acc_det where register=$register and bound_status='1' and flag=1";
		}
		else
		{
			$abc="select count(*) as total_media from lib_bound_acc_det where bound_status='1' and flag=1";
		}
		$abc1=execute($abc);
		$abc2=fetcharray($abc1);
	}
	?>
	<tr>
	<td align="center"><?php echo $i?></td>
	<td><?php echo $r["name"]?></td>
	<td align='right'><?php echo $r1[0]?></td>
	<td align='right'><?php echo $r2[0]?></td>
	<td align='right'><?php echo $r3[0]?></td>
	<td align='right'><?php echo $abc2[0]?></td>
	<td align='right'><?=intval($r1[0]) - intval($r2[0]) - intval($r3[0]) - intval($abc2[0])?></td>
	</tr>
	<?php
	$total = $total + $r1[0];
	$missing=$missing + $r2[0];
	$damaged=$damaged + $r3[0];
	$outno=$outno + $abc2[0];
	$inhand=$inhand+ ($r1[0]- $r2[0]- $r3[0]- $abc2[0]);
	
	$i=$i+1;
}
?>
<tr>
<td align="right" colspan=2>Total</td>
<td align="right" ><?php echo $total?></td>
<td align="right" ><?php echo $missing?></td>
<td align="right" ><?php echo $damaged?></td>
<td align="right" ><?php echo $outno?></td>
<td align="right" ><?php echo $inhand?></td>
</tr>
</table>
<br>
<div id='prn' align='center'>
<input type="button" value="   Print   " name="B1"  onClick="printReport()" class=bgbutton>
</div>
</BODY>
</HTML>