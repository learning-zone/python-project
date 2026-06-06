<?php
require_once("../db.php");
$media=$_POST['media'];
$stype = $_POST['stype'];

//print_r($_GET);
?>
<html>
<head>
<script type="text/javascript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=550,width=900,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}

function reload()
{
	document.frm.action="phystkver.php";
	document.frm.submit();
}
function printReport()
{
	prn.style.display="none";
	print(this.form);
	prn.style.display="";
}
</script>
</head>
<body>
<form name="frm" action="phystkver.php" method="post">
<?php
if($media=="")
{
	$sql=execute("SELECT mtype from phy_lib_stock group by mtype");
	if(rowcount($sql))
	{
	?>
	<table align="center" class="forumline" cellpadding="0" cellspacing="0" width="47%">
	<tr><td colspan="3" align="center" class="head">Physical Stock Report</td></tr>
	<tr><td align="right">Media Type&nbsp;:</td>
	<td><select name="media" onChange="reload()">
	<option value="">Select</option>
	<?php
	while($rs=fetcharray($sql))
	{
		echo "<option value='$rs[0]'>$rs[0]</option>";
	}
	?>
	</select></td></tr>
	</table>
<?php
}
else
echo "No Stock Found";
}
else
{
	$sdate=date('d-m-Y');
	$mqry=fetcharray(execute("select id from lib_mediatype where name='$media'"));
	$mid=$mqry[id];
	$st=execute("select * from phy_lib_stock where mtype='$media'");
	$pc=rowcount($st);
	if($pc>0)
	{
		$sql2=execute("select acc_no from lib_acc_details where mode='D' and media_type='$mid'");
		$damc=rowcount($sql2);
		while($d=fetcharray($sql2))
		{
			$dam_accd.=$d[acc_no];
		}
		$damacc=substr($dam_accd, 0, strlen($dam_accd)-1);
		$sql3=execute("select * from lib_acc_details where flag='1' and media_type='$mid'");
		$issc=rowcount($sql3);
		while($i=fetcharray($sql3))
		{
			$iss_acci.=$i[acc_no].",";
		}
		$issacc=substr($iss_acci, 0, strlen($iss_acci)-1);
		$str=execute("select count(*) from lib_acc_details where flag='0' and media_type='$mid'");
		$total=fetcharray($str);
		$str1=execute("select b.acc_no from lib_acc_details a,stock b where b.acc_no=a.acc_no and  a.media_type='$mid' and a.flag='0'");
		$matc=0;
		while($rs=fetcharray($str1))
		{
			$matc++;
			$matchedacc1.=$rs[0].",";
			$matchedacc2.="'".$rs[0]."',";
		}
		$matchedacc = substr($matchedacc1, 0, strlen($matchedacc1)-1); 
		$matchedacc3 = substr($matchedacc2, 0, strlen($matchedacc2)-1); 
		if($matchedacc3=='')
		$matchedacc3="''";
		$misstr="select acc_no from lib_acc_details a,lib_book_details c where media_type='$mid' and flag='0' and c.id=a.master_id and acc_no not in(".$matchedacc3.")";
		$str2=execute($misstr);
		$misc=0;
		while($rs1=fetcharray($str2))
		{
			$misc++;
			$misedacc1.=$rs1[0].",";
			$misedacc2.="'".$rs1[0]."',";
		}
		$misedacc = substr($misedacc1, 0, strlen($misedacc1)-1); 
		$misedacc3 = substr($misedacc2, 0, strlen($misedacc2)-1); 
	
		if($misedacc3=='')
		$misedacc3="''";
		$_SESSION['matchedacc3']=$matchedacc3;
		$_SESSION['misedacc3']=$misedacc3;
		
		$extstr="select acc_no from phy_lib_stock where acc_no not in (".$matchedacc3.",".$misedacc3.")";
		$str3=execute($extstr);
		$ext=0;
		while($rs2=fetcharray($str3))
		{
			$ext++;
			$extacc1.=$rs2[0].",";
		}
		$extacc = substr($extacc1, 0, strlen($extacc1)-1); 
		$insqry="insert into lib_phy_stkrep (mat_acc,mis_acc,ext_acc,sdate,matc,misc,extc,iss_acc,dam_acc,issc,damc,media) values('$matchedacc','$misedacc','$extacc','$sdate','$matc','$misc','$extc','$iss_acc','$dam_acc','$issc','$damc','$mid')";
		$sql=execute($insqry);
		$sql1=execute("delete from phy_lib_stock where mtype='$media'");
		?>
		
		<input type="hidden" name="mid" value="<?=$mid?>">
		<input type="hidden" name="mat_acc" value="<?=$matchedacc?>">
		<input type="hidden" name="mis_acc" value="<?=$misedacc?>">
		<input type="hidden" name="ext_acc" value="<?=$extacc?>">
		<input type="hidden" name="misc" value="<?=$misc?>">
		<input type="hidden" name="matc" value="<?=$matc?>">
		<input type="hidden" name="extc" value="<?=$ext?>">
		<input type="hidden" name="iss_acc" value="<?=$issacc?>">
		<input type="hidden" name="dam_acc" value="<?=$damacc?>">
		<input type="hidden" name="issc" value="<?=$issc?>">
		<input type="hidden" name="damc" value="<?=$damc?>">
		<input type="hidden" name="sdate" value="<?=date('d-m-Y')?>">
		<table align="center" class="forumline" cellpadding="0" cellspacing="0" width="75%" border="1">
		<tr>
		<td colspan="7" style="padding:5px" align="center" class="head">
		Stock Verification Report </td></tr>
		<tr>
		<td colspan="7" align="center"><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
		<td nowrap>&nbsp;&nbsp;Media Type&nbsp;&nbsp;:&nbsp;&nbsp;<?=$media?></td><td align="right" colspan="6"><?=date('d-m-Y')?></td>
		</tr></table></td>
		</tr>
		<tr >
		<td align="center" class='rowpic'>Phy Avail</td>
		<td align="center" class='rowpic'>Status Avail</td>
		<td align="center" ><table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr><td align="center" class='rowpic' colspan="2">Mis Match</td>
		
		</tr>
		<tr>
		<td align="center" class='rowpic'>Missing</td>
		<td align="center" class='rowpic'>Extra </td>
		</tr>
		</table></td>
		<td align="center" class="rowpic">Issued</td>
		<td align="center" class="rowpic">Damaged</td>
		</tr>
		<tr>
		<td align="center">&nbsp;&nbsp;<?=$pc?></td>
		<td align="center">&nbsp;&nbsp;<?=$total[0]?></td>
		<td align="center"><table  width="100%"><tr>
		<?php
		if($misc==0)
		{
		?>
		<td align="center">&nbsp;&nbsp;<?=$misc?></td>
		<?php
		}
		else
		{
		?>
		<td align="center">&nbsp;&nbsp;<a href="javascript:OpenWind('viewstkrep.php?stype=mis&media=<?=$mid?>')"><?=$misc?></a></td>
		<?php
		}
		if($ext==0)
		{
		?>
		<td align="center">&nbsp;&nbsp;<?=$ext?></td>
		<?php
		}
		else
		{
		?>
		<td align="center">&nbsp;&nbsp;<a href="javascript:OpenWind('viewstkrep.php?stype=ext&media=<?=$mid?>')"><?=$ext?></a></td>
		<?php
		}
		?>
		</tr>
		</table></td>
		<?php
		if($issc==0)
		{
		?>
		<td align="center">&nbsp;&nbsp;<?=$issc?></td>
		<?php
		}
		else
		{
		?>
		<td align="center">&nbsp;&nbsp;<a href="javascript:OpenWind('viewstkrep.php?stype=issue&media=<?=$mid?>')"><?=$issc?></a></td>
		<?php
		}
		if($damc==0)
		{
		?>
		<td align="center">&nbsp;&nbsp;<?=$damc?></td>
		<?php
		}
		else
		{
		?>
		<td align="center">&nbsp;&nbsp;<a href="javascript:OpenWind('viewstkrep.php?stype=dam&media=<?=$mid?>')"><?=$damc?></a></td>
		<?php
		}
		?>
		</tr>
		</table>
		<br>
		<div id='prn' align='center'>
			<INPUT TYPE="button" class='bgbutton' NAME="print" VALUE="PRINT" onClick="printReport()"></div>
		</form>
		
		<?php
		}
		else
		echo "Add Accession No To Stock";
}
		?>
</body>
</html>
