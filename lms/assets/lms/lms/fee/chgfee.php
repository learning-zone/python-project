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
	document.frm.action="chgfee.php";
	document.frm.submit();
}
</script>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
</head>
<body>
 <form name="frm" method="post" action="chgfee.php">
 <?php
 if(isset($applyfee))
 {
	$cyr=date("Y");
	$sql=execute("select id from fee_master where pid='$course' and sid='$year1' and admid='$feehead' and accyr='$cyr'");
	for($i=0;$i<rowcount($sql);$i++)
	{
		$rs=fetcharray($sql);
		
		$sql2=execute("select fid,amount from fee_head where course_id='$course' and year_id='$year1' and admission_type='$feehead' and accyr='$cyr' order by fid");
		
		if(rowcount($sql2)>0)
		{
			while($r=fetcharray($sql2))
			{
				$sql1=execute("select * from fee_master where id='$rs[id]'");
				$rs1=fetcharray($sql1);

				$a1="dfee".$r[fid];
				$a=$rs1[$a1];
				$c1="pfee".$r[fid];
				$c=$rs1[$c1];
				$b=$r[amount]-$a;
				
				if($b > 0)
				{
					$balamt=$rs1[balamt]+$b;
					if($rs1[exeamt]>0)
					{
						$exeamt=$rs1[exeamt]-$balamt;
						if($exeamt<0)
						{
							$balamt=$balamt-$rs1[exeamt];
							$exeamt=0;
						}
						else
							$balamt=0;
					}
					else
						$exeamt=0;
					if($balamt>0)
						$pstatus=1;
					else
						$pstatus=0;
					$sql3=execute("update fee_master set $a1=$r[amount],balamt='$balamt',exeamt='$exeamt',pstatus='$pstatus' where id='$rs1[id]'");
				}
				elseif($b < 0)
				{
					$b=$a-$r[amount];
					$exeamt=$rs1[exeamt]+$b;
					if($rs1[balamt]>0)
					{
						$balamt=$rs1[balamt]-$exeamt;
						if($balamt<0)
						{
							$exeamt=$exeamt-$rs1[balamt];
							$balamt=0;
						}
						else
							$exeamt=0;
					}
					else
						$balamt=0;
					if($balamt>0)
						$pstatus=1;
					else
						$pstatus=0;
					if($c>$r[amount])
						$c=$r[amount];
					$sql3=execute("update fee_master set $a1=$r[amount],$c1=$c,balamt='$balamt',exeamt='$exeamt',pstatus='$pstatus' where id='$rs1[id]'");
				}
			}
		}
	}
	echo "<font color='Blue'><b>Fee Details updated ...!!</b></font>";
	die();
 }
 ?>
<table class='forumline' align='center' border="0" width='70%'>
<tr><td Class="head" align='center' colspan=4 >Apply Changed Fee Structure for <?=$cyr?>-<?=($cyr+1)?></td></tr>
<tr height='25'><td align='center' colspan=2>Program</td><td align='center'>Year</td><td align='center'>Admission Type</td></tr>
<tr><td align='center' colspan=2><select name="course" onchange="reloadMe()" >
<option value='0'>Select Program</option>
<?php
$sql="select * from course_m where status=1";
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
</select></td>
<td align='center'><select name="year1" onchange="reloadMe()">
<option value='0'>-- Select --</option>
<?php
$sq=fetcharray(execute("select head_id from course_m where course_id='$course'"));
if($course==1)
	$sql=execute("select year_id,year_name from course_year where head_id='$sq[0]' and status=1 and year_id in(1,3)");
else
	$sql=execute("select year_id,year_name from course_year where head_id='$sq[0]' and status=1 and year_id in(5,8)");
for($i=1;$i<=rowcount($sql);$i++)
{
	$r=fetcharray($sql);
	if($year1==$r[0])
	{
		echo "<option value='$r[0]' selected>$r[1]</option>";
	}
	else
	{
		echo "<option value='$r[0]'>$r[1]</option>";
	}
}
?>
</select></td>
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
</select></td></tr>
<?php
if($course!=0 && $year1!=0 && $feehead!=0)
{
	?>
	</tr><tr height='30'><td colspan='4' valign="bottom" align='center'><input type='submit' class='bgbutton' name='applyfee' value='Apply Changed Fee Structure'></td></tr>
	<?php
}
?>
</table>
</form>
</html>