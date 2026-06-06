<html>
<?php
session_start();
include("../urlaccess.php");
include("../db.php");
$cyr=date("Y");
?>
<head>
<script language='javascript'>
function reloadMe()
{
	document.frm.action="feestut.php";
	document.frm.submit();
}
function amtttl()
{
	i = document.frm.length;
	var total = 0;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].type == "checkbox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = flag;
			if(document.frm[j].checked)
			{
				tot = parseInt(eval("document.frm.feeamt" + document.frm[j].value + ".value"));
				total += parseInt(tot);
			}
		}
	}
	document.frm.tfeeamt.value = total;
}
function changeMs(i)
{
	if(i)
	{
		document.all.sl.style.color='blue'
	}
	else
	{
		document.all.sl.style.color='brown'
	}
}
function selectMe()
{
	i = document.frm.length;
	var total = 0;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].type == "checkbox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
			if(document.frm[j].checked)
			{
				tot = parseInt(eval("document.frm.feeamt" + document.frm[j].value + ".value"));
				total += parseInt(tot);
			}
		}
	}
	document.frm.tfeeamt.value = total;
}
</script>
<style>
	.text{text-align:right;}
</style>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
</head>
<body>
 <form name="frm" method="post" action="feestut.php">
 <?php
 if(isset($fadd))
 {
	while(list($key,$Value) = each($sid))
	{
		$slno1[$key+1]=$Value;
	}
	while (list($key, $value) = each($pid))
	{
		$famt="feeamt".$value;
		$famt=$$famt;
		
		$slno2[$key+1] = $value;
		$stfee[$key+1] = $famt;
	}
	$size_first = sizeof($sid);
	$size_second = sizeof($pid);
	$no_flag = "On";
	for($jj=1;$jj<=$size_first;$jj++)
	{
		for ($kk=1;$kk<=$size_second;$kk++)
		{
			if ($slno1[$jj] == $slno2[$kk])
			{
				$no_flag = "Off";

				$sql=execute("select id from fee_head where course_id='$course' and year_id='$year1' and admission_type='$feehead' and accyr='$cyr' and fid='$slno1[$jj]'");
				
				if(rowcount($sql)>0)
					$fsql="update fee_head set amount='$stfee[$kk]',status=1 where course_id='$course' and year_id='$year1' and admission_type='$feehead' and accyr='$cyr' and fid='$slno1[$jj]'";
				else
					$fsql="insert into fee_head (course_id,year_id,admission_type,amount,fid,accyr) values ('$course','$year1','$feehead','$stfee[$kk]','$slno1[$jj]','$cyr')";

				execute($fsql) or die("<font color='red'><b>Failed to update information ...!!</b></font>");
				break;
			}
			else
				$no_flag = "On";
		}
		if ($no_flag == "On")
		{
			$sql=execute("select id from fee_head where course_id='$course' and year_id='$year1' and admission_type='$feehead' and accyr='$cyr' and fid='$slno1[$jj]'");

			if(rowcount($sql)>0)
			{
				$fsql="update fee_head set status=0 where course_id='$course' and year_id='$year1' and admission_type='$feehead' and accyr='$cyr' and fid='$slno1[$jj]'";
				execute($fsql) or die("<font color='red'><b>Failed to update information ...!!</b></font>");
			}
		}
	}
	echo "<font color='Blue'><b>Fee Structure update ...!!</b></font>";
 }
 ?>
	<table class='forumline' align='center' border="0" width='70%'>
	<tr><td Class="head" align='center' colspan=4 >Add/Modify Fee Structure for <?=$cyr?>-<?=($cyr+1)?></td></tr>
	<tr height='25'>
		<td align='center' colspan=2>Program</td>
		<td align='center'>Year</td>
		<td align='center'>Admission Type</td>
	</tr>
	<tr>
	 <td align='center' colspan=2>
	 <select name="course" onchange="reloadMe()" >
	 <option value='0'>Select Program</option>
	 <?php
	 	$sql="select * from course_m ";
	 	$rs=execute($sql) or die(error_description());
	 	for($i=0;$i<rowcount($rs);$i++)
	 	{
	 		$r1=fetchrow($rs);
	  		if($course==$r1[0])
	 		{
				?>
	 			<option value="<?php echo $r1[0]?>" selected><?php echo $r1[1]?></option>
				<?php
	 		}
	 		else
	 		{
				?>
	 			<option value="<?php echo $r1[0]?>"><?php echo $r1[1]?></option>
				<?php
	 		}
	 	}
	 ?>
	 </select>
	</td>
	 <td align='center'>
	 <select name="year1">
	 <?php
	    if($year1==1)
		{
			$sel1='selected';
		}
		if($year1==2)
		{
			$sel2='selected';
		}
	 ?>
	 <option value='0'>------ Select Year ------</option>
	 <option value='1' <?php echo $sel1?>>1st Year</option>
	 <option value='2' <?php echo $sel2?>>2nd Year</option>
	 </select>
	</td>
	 <td align='center'><select name="feehead" onchange="reloadMe()" >
	 <option value='0'>Select admission type</option>
	 <?php
	 	$sql2="select * from admission ";
	 	$rs2=execute($sql2) or die(error_description());
	 	for($i=0;$i<rowcount($rs2);$i++)
	 	{
	 		$r2=fetchrow($rs2);
	  		if($feehead==$r2[0])
	 		{
				?>
	 			<option value="<?php echo $r2[0]?>" selected><?php echo $r2[1]?></option>
				<?php
	 		}
	 		else
	 		{
				?>
	 			<option value="<?php echo $r2[0]?>"><?php echo $r2[1]?></option>
				<?php
	 		}
	 	}
	 ?>
	 </select>
</td>
</tr>
<?php
 if($course!=0 && $year1!=0 && $feehead!=0)
 {
	 ?>
		<tr><td Class="head" align='center' colspan=4>&nbsp;</td></tr>
		<tr>
			<td align='center'><div id="sl" onClick="selectMe()" onMouseOver="changeMs(1)" onMouseOut="changeMs(0)"><font size='2.5'><b>Select</b></font></div></td>
			<td align='center'>Fee Name </td>
			<td align='center'>Fee Amount</td>
			<td align='center'>Refundable</td>
		</tr>
<?php
	$sql=execute("select fee_id,fee_name,refund from fee_type where status=1 order by fee_name");
	if(rowcount($sql)==0)
	{
		echo "<br><font color='blue'><b>Fee Details not defined...!!</b></font>";
		die();
	}
	else
	{
		$tfeeamt=0;
		while($rs=fetcharray($sql))
		{
			if($rs[refund]==0)
				$rfd="NO";
			else
				$rfd="YES";
			$var = execute("select id,amount from fee_head where course_id='$course' and year_id='$year1' and admission_type='$feehead' and accyr='$cyr' and fid=$rs[fee_id] and status=1");
			if(rowcount($var)>0)
			{
				$r=fetcharray($var);
				$chk="checked";
				$famt=$r[amount];
				$tfeeamt+=$famt;
			}
			else
			{
				$chk="";
				$famt=0;
			}
			?>
			<tr><td align='center'><input type='hidden' name='sid[]' value='<?=$rs[fee_id] ?>'>
			<input type='checkbox' name='pid[]' value='<?php echo $rs[fee_id] ?>' <?=$chk?> onclick="amtttl()"></td>
			<td align='left'>&nbsp;&nbsp;&nbsp;<?php echo $rs[fee_name] ?></td>
			<td align='center'><input type='text' class='text' name='feeamt<?php echo $rs[fee_id] ?>' value='<?php echo $famt ?>' onchange="amtttl()"></td>
			<td align='center'><?php echo $rfd ?></td></tr>
			<?php
		}
		?>
		<tr><td align='right' colspan=2>Total Amount&nbsp;&nbsp;&nbsp;</td><td align="center"><input type='text' class='text' name='tfeeamt' value=<?=$tfeeamt?>></td><td></td></tr>
		<tr height='30'><td colspan='4' valign="bottom" align='center'><input type='submit' class='bgbutton' name='fadd' value='Update Details'></td>
		</tr>
		<?php
	}
}
?>
</form>
</html>