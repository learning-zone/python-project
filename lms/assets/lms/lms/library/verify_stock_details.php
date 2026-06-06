<?php

session_start();
require_once("../db.php");


/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/


$lib = $_POST['lib'];
$regt = $_POST['regt'];
$mode = $_POST['mode'];
$mtype = $_POST['mtype'];
$media=$_REQUEST['media'];
$_NUMREC_ = 15; // Number of result per page;
//Set the initial seek position
if(empty($SeekPos))
{
        $SeekPos = 0;
}
if($Seek_Val !="")
{
	$SeekPos=$Seek_Val;
}
$todt=date("d-m-Y");
?>
<HTML>
<HEAD>
<script language="javascript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=1000,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function prndata()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = " ";
}
</script>
</HEAD><body>
<form method="POST" name="form1" >
<input type=hidden name=media value=$media>
<?php

$sql=execute("SELECT id,register,library FROM lib_register ORDER BY library,register,id");
if($media==1)
{
	$tble1="lib_acc_details";
	$tble2="lib_book_details";
	$med_name="Books";
	$med_type="book_type";
}
elseif($media==2)
{
	$tble1="lib_cd_acc_det";
	$tble2="lib_cd_det";
	$med_name="Book CD/DVDs";
	$med_type="cd_type";
}
elseif($media==3)
{
	$tble1="lib_floppy_acc_det";
	$tble2="lib_floppy_det";
	$med_name="Audio Cassettes";
	$med_type="floppy_type";
}
elseif($media==4)
{
	$tble1="lib_cd_acc_det";
	$tble2="lib_cd_det";
	$med_name="Other CD/DVDs";
	$med_type="cd_type";
}
elseif($media==5)
{
	$tble1="lib_proj_acc_det";
	$tble2="lib_project_report_det";
	$med_name="Project Reports";
	$med_type="book_type";
}
?>
<table border=1 align=center width=80% cellspacing=0 cellpadding=1>
<tr><td class="head" align=center colspan=5>Stock Verification Report : <?php echo $todt ?></td></tr>
<tr><td rowspan=2 class=row2 align=center>Details</td>
<td colspan=2 class=row2 align=center>Media Type</td>
<td rowspan=2 class=row2 align=center>Total</td>
<td rowspan=2 class=row2 align=center>Total Cost</td></tr>
<tr><td class=row2 align=center>Issue</td>
<td class=row2 align=center>Reference</td></tr>
<?php
while ($rs=fetcharray($sql))
{
	$lib_n = execute("SELECT name FROM library_name WHERE id='$rs[library]'");
	$lib_r = fetcharray($lib_n);

?>
<tr><td class=row3 align=left colspan=5><?php echo $lib_r[name] ?> : <?php echo $rs[register]?></td></tr>
<tr><td class=row2 align=center>Total <?php echo $med_name?> in Library</td>
<?php
	$sql1=execute("SELECT count(*) FROM $tble1 WHERE media_type='$media' AND $med_type='I' AND register='$rs[id]' AND mode !='W' ");
	$rs1=fetcharray($sql1);
	$cnt1=$rs1[0];
	$gttl1=$gttl1 + $cnt1;
	$sql2=execute("SELECT count(*) FROM $tble1 WHERE media_type='$media' AND $med_type='R' AND register='$rs[id]' AND mode !='W' ");
	$rs2=fetcharray($sql2);
	$cnt2=$rs2[0];
	$gttl2=$gttl2 + $cnt2;
	$cnt3=$cnt1 + $cnt2;
	$gttl3=$gttl3 + $cnt3;
	$csql1=execute("SELECT sum(a.price) FROM $tble2 a,$tble1 b WHERE a.id=b.master_id AND b.media_type='$media' AND b.register='$rs[id]' AND b.mode !='W' ");
	$crs1=fetcharray($csql1);
	$cct1=$crs1[0];
	if($cct1=='')
		$cct1=0;
	$gttl4=$gttl4 + $cct1;
?>
	<td class="row2" align=right>
	<?php
	if($cnt1>0) // TOTAL BOOKS IN LIBRARY
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=I&mode=A');"><?=$cnt1?></A></td>
	<?
	}
	else
	{
		echo $cnt1;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt2>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=R&mode=A');"><?=$cnt2?></A></td>
		<?
	}
	else
	{
		echo $cnt2;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt3>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=A&mode=A');"><?=$cnt3?></A></td>
		<?
	}
	else
	{
		echo $cnt3;
		echo "</td>";
	}
	?>
	<td class=row2 align=right><?php echo number_format($cct1,2)?></td></tr>
	<tr><td class=row2 align=center>Total Damaged <?php echo $med_name?></td>
<?php
	$sql3=execute("SELECT count(*) FROM $tble1 WHERE media_type='$media' AND $med_type='I' AND register='$rs[id]' AND mode='D' ");
	$rs3=fetcharray($sql3);
	$cnt4=$rs3[0];
	$gttl5=$gttl5 + $cnt4;
	$sql4=execute("SELECT count(*) FROM $tble1 WHERE media_type='$media' AND $med_type='R' AND register='$rs[id]' AND mode='D' ");
	$rs4=fetcharray($sql4);
	$cnt5=$rs4[0];
	$gttl6=$gttl6 + $cnt5;
	$cnt6=$cnt4 + $cnt5;
	$gttl7=$gttl7 + $cnt6;
	$csql2=execute("SELECT sum(a.price) FROM $tble2 a,$tble1 b WHERE a.id=b.master_id AND b.media_type='$media' AND b.register='$rs[id]' AND b.mode='D' ");
	$crs2=fetcharray($csql2);
	$cct2=$crs2[0];
	if($cct2=='')
		$cct2=0;
	$gttl8=$gttl8 + $cct2;
?>
	<td class=row2 align=right>
	<?php
	if($cnt4>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=I&mode=D');"><?=$cnt4?></A></td>
		<?
	}
	else
	{
		echo $cnt4;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt5>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=R&mode=D');"><?=$cnt5?></A></td>
		<?
	}
	else
	{
		echo $cnt5;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt6>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=A&mode=D');"><?=$cnt6?></A></td>
		<?
	}
	else
	{
		echo $cnt6;
		echo "</td>";
	}
	?>
	<td class=row2 align=right><?php echo number_format($cct2,2)?></td></tr>
	<tr><td class=row2 align=center>Total Missing <?php echo $med_name?></td>
<?php
	$sql5=execute("SELECT count(*) FROM $tble1 WHERE media_type='$media' AND $med_type='I' AND register='$rs[id]' AND mode='M' ");
	$rs5=fetcharray($sql5);
	$cnt7=$rs5[0];
	$gttl9=$gttl9 + $cnt7;
	$sql6=execute("SELECT count(*) FROM $tble1 WHERE media_type='$media' AND $med_type='R' AND register='$rs[id]' AND mode='M' ");
	$rs6=fetcharray($sql6);
	$cnt8=$rs6[0];
	$gttl10=$gttl10 + $cnt8;
	$cnt9=$cnt7 + $cnt8;
	$gttl11=$gttl11 + $cnt9;
	$csql3=execute("SELECT sum(a.price) FROM $tble2 a,$tble1 b WHERE a.id=b.master_id AND b.media_type='$media' AND b.register='$rs[id]' AND b.mode='M' ");
	$crs3=fetcharray($csql3);
	$cct3=$crs3[0];
	if($cct3=='')
		$cct3=0;
	$gttl12=$gttl12 + $cct3;
?>
	<td class=row2 align=right>
	<?php
	if($cnt7>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=I&mode=M');"><?=$cnt7?></A></td>
		<?
	}
	else
	{
		echo $cnt7;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt8>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=R&mode=M');"><?=$cnt8?></A></td>
		<?
	}
	else
	{
		echo $cnt8;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt9>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=A&mode=M');"><?=$cnt9?></A></td>
		<?
	}
	else
	{
		echo $cnt9;
		echo "</td>";
	}
	?>
	<td class=row2 align=right><?php echo number_format($cct3,2)?></td></tr>
	<tr><td class=row2 align=center>Total <?php echo $med_name?> Available for Circulation</td>
<?php
	$cnt10=$cnt1 - $cnt4 - $cnt7;
	$gttl13=$gttl13 + $cnt10;
	$cnt11=$cnt2 - $cnt5 - $cnt8;
	$gttl14=$gttl14 + $cnt11;
	$cnt12=$cnt10 + $cnt11;
	$gttl15=$gttl15 + $cnt12;
	$cct4=$cct1 - $cct2 - $cct3;
	$gttl16=$gttl16 + $cct4;
?>
	<td class=row2 align=right>
	<?php
	if($cnt10>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=I&mode=C');"><?=$cnt10?></A></td>
		<?
	}
	else
	{
		echo $cnt10;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt11>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=R&mode=C');"><?=$cnt11?></A></td>
		<?
	}
	else
	{
		echo $cnt11;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt12>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=A&mode=C');"><?=$cnt12?></A></td>
		<?
	}
	else
	{
		echo $cnt12;
		echo "</td>";
	}
	?>
	<td class=row2 align=right><?php echo number_format($cct4,2)?></td></tr>
	<tr><td class=row2 align=center>Total <?php echo $med_name?> Issued</td>
<?php

	//$sql7=execute("SELECT count(a.id) FROM $tble1 a, lib_circulation_m b WHERE a.media_type = '$media' AND a.$med_type = 'I' AND a.register='$rs[id]' AND a.mode='A' AND a.flag>0 AND a.acc_no = b.acc_id");
	//echo "SELECT count(*) FROM $tble1 WHERE media_type='$media' AND $med_type='I' AND register='$rs[id]' AND mode='A' AND flag=1 <br>";
	$sql7=execute("SELECT count(*) FROM lib_circulation_m WHERE m_id='$media' AND register='$rs[id]'");
	
	$rs7=fetcharray($sql7);
	$cnt13=$rs7[0];

	$gttl17=$gttl17 +$cnt13;
	$sql8=execute("SELECT count(*) FROM $tble1 WHERE media_type='$media' AND $med_type='R' AND register='$rs[id]' AND mode='A' AND flag=1");
	$rs8=fetcharray($sql8);
	$cnt14=$rs8[0];
	$gttl18=$gttl18 + $cnt14;
	$cnt15=$cnt13 + $cnt14;
	$gttl19=$gttl19 + $cnt15;
?>
	<td class=row2 align=right>
	<?php
	if($cnt13>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=I&mode=I');"><?=$cnt13?></A></td>
		<?
	}
	else
	{
		echo $cnt13;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt14>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=R&mode=I');"><?=$cnt14?></A></td>
		<?
	}
	else
	{
		echo $cnt14;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt15>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=A&mode=I');"><?=$cnt15?></A></td>
		<?
	}
	else
	{
		echo $cnt15;
		echo "</td>";
	}
	?>
	<td class=row2 align=center>----</td></tr>
	<tr><td class=row2 align=center>Total <?php echo $med_name?> Available for Issue</td>
<?php
	$cnt16=$cnt10 - $cnt13;
	$gttl20=$gttl20 + $cnt16;
	$cnt17=$cnt11 - $cnt14;
	$gttl21=$gttl21 + $cnt17;
	$cnt18=$cnt16 + $cnt17;
	$gttl22=$gttl22 + $cnt18;
?>
	<td class=row2 align=right>
	<?php
	if($cnt16>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=I&mode=P');"><?=$cnt16?></A></td>
		<?
	}
	else
	{
		echo $cnt16;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt17>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=R&mode=P');"><?=$cnt17?></A></td>
		<?
	}
	else
	{
		echo $cnt17;
		echo "</td>";
	}
	?>
	<td class=row2 align=right>
	<?php
	if($cnt18>0)
	{
		?>
		<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=<?=$rs[library]?>&regt=<?=$rs[id]?>&mtype=A&mode=P');"><?=$cnt18?></A></td>
		<?
	}
	else
	{
		echo $cnt18;
		echo "</td>";
	}
	?>
	<td class=row2 align=center>----</td></tr>
<?php	
}
?>
<tr><td class=row3 align=center colspan=5>Grand Total Information</td></tr>
<tr><td class=row2 align=center>Grnad Total <?php echo $med_name?> in Library</td>
<td class=row2 align=right>
<?php
if($gttl1>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=I&mode=A');"><?=$gttl1?></A></td>-->
    <?=$gttl1?></td>
	<?
}
else
{
	echo $gttl1;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl2>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=R&mode=A');"><?=$gttl2?></A></td>-->
    <?=$gttl2?></td>
	<?
}
else
{
	echo $gttl2;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl3>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=A&mode=A');"><?=$gttl3?></A></td>-->
    <?=$gttl3?></td>
	<?
}
else
{
	echo $gttl3;
	echo "</td>";
}
?>
<td class=row2 align=right><?php echo number_format($gttl4,2)?></td></tr>
<tr><td class=row2 align=center>Grand Total Damaged <?php echo $med_name?></td>
<td class=row2 align=right>
<?php
if($gttl5>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=I&mode=D');"><?=$gttl5?></A></td>-->
    <?=$gttl5?></td>
	<?
}
else
{
	echo $gttl5;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl6>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=R&mode=D');"><?=$gttl6?></A></td>-->
    <?=$gttl6?></td>
	<?
}
else
{
	echo $gttl6;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl7>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=A&mode=D');"><?=$gttl7?></A></td>-->
    <?=$gttl7?></td>
	<?
}
else
{
	echo $gttl7;
	echo "</td>";
}
?>
<td class=row2 align=right><?php echo number_format($gttl8,2)?></td></tr>
<tr><td class=row2 align=center>Grand Total Missing <?php echo $med_name?></td>
<td class=row2 align=right>
<?php
if($gttl9>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=I&mode=M');"><?=$gttl9?></A></td>-->
	<?php
	echo $gttl9;
	echo "</A></td>";
}
else
{
	echo $gttl9;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl10>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=R&mode=M');"><?=$gttl10?></A></td>-->
    <?=$gttl10?></td>
	<?
}
else
{
	echo $gttl10;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl11>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=A&mode=M');"><?=$gttl11?></A></td>-->
    <?=$gttl11?></td>
	<?
}
else
{
	echo $gttl11;
	echo "</td>";
}
?>
<td class=row2 align=right><?php echo number_format($gttl12,2)?></td></tr>
<tr><td class=row2 align=center>Grand Total <?php echo $med_name?> Available for Circulation</td>
<td class=row2 align=right>
<?php
if($gttl13>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=I&mode=C');"><?=$gttl13?></A></td>-->
    <?=$gttl13?></td>
	<?
}
else
{
	echo $gttl13;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl14>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=R&mode=C');"><?=$gttl14?></A></td>-->
    <?=$gttl14?></td>
	<?
}
else
{
	echo $gttl14;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl15>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=A&mode=C');"><?=$gttl15?></A></td>-->
    <?=$gttl15?></td>
	<?
}
else
{
	echo $gttl15;
	echo "</td>";
}
?>
<td class=row2 align=right><?php echo number_format($gttl16,2)?></td></tr>
<tr><td class=row2 align=center>Grand Total <?php echo $med_name?> Issued</td>
<td class=row2 align=right>
<?php
if($gttl17>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=I&mode=I');"><?=$gttl17?></A></td>-->
    <?=$gttl17?></td>
	<?
}
else
{
	echo $gttl17;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl18>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=R&mode=I');"><?=$gttl18?></A></td>-->
    <?=$gttl18?></td>
	<?
}
else
{
	echo $gttl18;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl19>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=A&mode=I');"><?=$gttl19?></A></td>-->
    <?=$gttl19?></td>
	<?
}
else
{
	echo $gttl19;
	echo "</td>";
}
?>
<td class=row2 align=center>----</td></tr>
<tr><td class=row2 align=center>Grand Total <?php echo $med_name?> Available for Issue</td>
<td class=row2 align=right>
<?php
if($gttl20>0)
{

	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=I&mode=P');"><?=$gttl20?></A></td>-->
    <?=$gttl20?></td>
	<?
}
else
{
	echo $gttl20;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl21>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=R&mode=P');"><?=$gttl21?></A></td>-->
    <?=$gttl21?></td>
	<?
}
else
{
	echo $gttl21;
	echo "</td>";
}
?>
<td class=row2 align=right>
<?php
if($gttl22>0)
{
	?>
	<!--<A HREF="javascript:OpenWind('detailedreport.php?media=<?php echo $media?>&lib=0&regt=0&mtype=A&mode=P');"><?=$gttl22?></A></td>-->
    <?=$gttl22?></td>
	<?
}
else
{
	echo $gttl22;
	echo "</td>";
}
?>
<td class=row2 align=center>----</td></tr>
</table>
<br>
<br>
<div align='center' id='prn'>
<input type="button" name="versubmit" value=" Print " onClick="prndata()" class="bgbutton">
</div>
</form>
</body>
</html>