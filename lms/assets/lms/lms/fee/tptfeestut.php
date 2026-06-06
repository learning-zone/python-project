<html>
<?php
session_start();
include("../db.php");
if($_POST)
{
	$cyr=$_POST['cyr'];
	$route=$_POST['route'];
}
else
{
	$cyr=$_SESSION['AcademicYear'];
}
?>

<head>
<script language='javascript'>
function reloadMe()
{
	document.frm.action="tptfeestut.php";
	document.frm.submit();
}
</script>
<style>
	.text{text-align:right;}
</style>
</head>
<body>
 <form name="frm" method="post" action="tptfeestut.php">
 <input type='hidden' name='cyr' value='<?=$cyr?>'>
 <?php
 if(isset($_POST['fadd']))
 {
	$rids=$_POST['rids'];
	while (list($key, $value) = each($rids))
	{
		$famt=$_POST["cha".$value];
		
		
		$sql=execute("select id from tptfeehead where route='$route' and point_id='$value' and accyr='$cyr'");		
		if(rowcount($sql)>0)
			$fsql="update tptfeehead set amount='$famt' where route='$route' and point_id='$value' and accyr='$cyr'";
		else
			$fsql="insert into tptfeehead (route,point_id,amount,accyr) values ('$route','$value','$famt','$cyr')";

		execute($fsql) or die("<font color=''><b>Failed to update information ...!!</b></font>");		
	}
	?>
	<script language="javascript">
    alert("Transportation Fee Details updated successfully ");
	</script>
<?php
 }
 

	$rname=fetcharray(execute("select route_code,route_name from route_master where id='$route'"));
	?>
 	<table class='forumline' align='center' border="0" width='60%'>
	<tr><td Class="head" align='center' colspan='4'>Manage Transportation Fee Structure</td></tr>
	<tr></td><td nowrap align='right'>Academic Year&nbsp;&nbsp;</td>
	<td><select name="cyr" onChange="reloadMe()">
	<option value=''>--- Select ----</option>
	<?php
	
	$fmyr=date("Y")-2;
	$toyr=date("Y")+2;
	for($i=$fmyr;$i<=$toyr;$i++)
	{
		$y=$i+1;
		if($cyr==$i)
			echo "<option value=$i selected>&nbsp;&nbsp;$i-$y</option>";
		else
			echo "<option value=$i>&nbsp;&nbsp;$i-$y</option>";
	}
	?>
	</select></td>
	<td align='center'>Bus Route</td>
	<td align='center'><select name="route" onChange="reloadMe()">
	<option value="">Select Route</option>
	<?php
	$sql="select * from route_master order by route_code";
	$rs=execute($sql);
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs);
		if($r["id"]==$route)
		{
			echo "<option value=$r[id] selected> $r[route_code] - $r[route_name]</option>";
		}
		else
		{
			echo "<option value=$r[id] > $r[route_code] - $r[route_name]</option>";
		}
	}
	?>
	</select>
	</td></tr></table>   
<br>    
    
   <?php
   if($cyr=='' or $route=='')
	die();
   ?> 
	<Table class='forumline' width='60%' align='center' border='0'>
	<TR><TD class='head' colspan='4' align='center'>Manage Transportation Fee Structure for <?=$cyr?>-<?=($cyr+1)?></td></tr>
	<TR><TD colspan='4' align='center'><font color='' size='4'>Bus Route : <?=$rname[0]?> - <?=$rname[1]?></font></td></tr>
	<?php
	$sql1="select * from point_details where route_id=$route order by pick_t desc";
	$rs1=execute($sql1) or die(error_description());
	if(rowcount($rs1)>0)
	{
		
		?><tr><td Class='rowpic' align=center>Sl.No</td><td Class='rowpic' align=center>Pickup Point</td><td align=center Class='rowpic'>Distance in Kms</td><td align=center Class='rowpic'>Monthly Charge</td></tr>
		<?php
        $sno=1;
		for($k=0;$k<rowcount($rs1);$k++)
		{
			$r1=fetcharray($rs1);
			$ss=fetcharray(execute("select point_name,dist from point_master where id='$r1[point_id]'"));
			if($sno<10)
				$sno="0".$sno;
			echo "<tr><td align='center'>$sno<input type=hidden name=rids[] value=$r1[point_id]></td>";
			echo "<td>&nbsp;&nbsp;&nbsp;$ss[0]</td>";
			echo "<td align='center'>$ss[1]</td>";
			$sss=execute("select amount from tptfeehead where route='$route' and point_id='$r1[point_id]' and accyr='$cyr'");
			if(rowcount($sss)>0)
			{
				$sssamt=fetcharray($sss);
				$amt=$sssamt[0];
			}
			else
				$amt=0;
			echo "<td align='center'><input type='text' class='text' name='cha".$r1[point_id]."' value='$amt' size='5'></td>";
			echo "</tr>";
			$sno++;
		}
		?></table>
		<br>
        <div align='center'><input type='submit' class='bgbutton' name='fadd' value='Update Details'></div>
<?php
	}
	else
		echo "<div><font color=''><b>Pickup Points not applied to the selected Route ...</b></font></div>";
	echo "</table>";

	

?>
</form>
</html>