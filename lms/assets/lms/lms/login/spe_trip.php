<?php
session_start();
require("../db.php");
$dd=execute("select * from student_m where student_id='$user'");
$hh=fetcharray($dd);
if(rowcount($dd)>0)
{
?>
<html>
<head>
<script src="Scripts/datevalidation.js"></script>

<script language="javascript">
function printReport()
{
	prn.style.display='none';
	print(this.form);
}

function reload()
{
	document.forms[0].submit();
}
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display=='';
}
</script>
</head>
<body>
<?php
         echo "<form action=spe_trip.php method=post>";
         echo "<table align=center class='forumline'>";
         echo "<tr><td colspan=4 class=head align=center><font face='Lucida Sans' size='2.5'>Special Trip Report</font></td></tr>";
         echo "<tr>";
	echo "<td align='right'>select Vehicle</td>";
	echo "<td>";
	echo "<select name=vechilename>";
		echo "<option value=''>Select Vechile</option>";
		$qry="select * from vechile_master";
		$rs = execute($qry);
		if($rs)
		{
			if(rowcount($rs)>0)
			{
				while($row=fetcharray($rs))
				{
					$sel="";
					if($vechilename==$row[id])
						$sel="selected";

						echo "<option value='$row[id]' $sel>$row[vechile_mod_no]</option>";

				}

			}

		}
	echo "</select></td>";
	echo "</tr>";
	?>
	<tr><td><b>From</b></td>
<td>
<select name="dd_from" id="dd_from">
<? $id=date("d");
   for($i=1;$i<=31;$i++)
   {?> 
   <option value="<?=$i?>" <? if($id==$i){ echo "selected"; }?>><?=$i?></option><? }?>
 </select> <select name="mm_from" id="mm_from">
				<?php 
				$im=date("m");
				for($i=1;$i<=12;$i++)
				{?> 
					<option value="<?=$i?>" <? if($im==$i){ echo "selected"; }?>><?=$i?></option>
				<?php
				 }?>
			  </select>
                                  <select name="yy_from" id="yy_from" onChange="vaidateDate('dd_from','mm_from','yy_from')">
				  <?php 
				  $y=date("Y");
				  for($i=$y+1;$i>=1990;$i--)
				  {?> 
					<option value="<?=$i?>" <? if($y==$i){ echo "selected"; }?>><?=$i?></option>
				  <?php
				  }?>
			 </select>

</td></tr>
<tr><td ><b>To</b></td>
<td><select name="dd_to" id="dd_to" class="row">
<?php
 $id=date("d");
   for($i=1;$i<=31;$i++)
   {?> 
   <option value="<?=$i?>" <? if($id==$i){ echo "selected"; }?>><?=$i?></option>
   <?php
   }?>
 </select>
 <select name="mm_to" id="mm_to">
 <?php
  $im=date("m");
	for($i=1;$i<=12;$i++)
	{?> 
	<option value="<?=$i?>" <? if($im==$i){ echo "selected"; }?>><?=$i?></option>
	<?php
	 }?>
			  </select>
		<select name="yy_to" id="yy_to" onChange="vaidateDate('dd_to','mm_to','yy_to')">
				  <?php 
				  $y=date("Y");
				  for($i=$y+1;$i>=1990;$i--)
				  {?> 
					<option value="<?=$i?>" <? if($y==$i){ echo "selected"; }?>><?=$i?></option>
				  <?php }?>
			 </select>

</td></tr>
<tr><td colspan='2' align='center'><input type='submit' name='submit' value='<<Submit>>' class='bgbutton'></td></tr>
<?php
echo "</table>";
echo "</form>";
$from="$yy_from-$mm_from-$dd_from";
 $to="$yy_to-$mm_to-$dd_to";
echo "</table>";

if($vechilename!="")
{
$count=1;
$sql = "SELECT * FROM special_trip_entry where vechile_name=$vechilename and date between '$from' and '$to' group by date";

$rs = execute($sql);

$num = rowcount($rs);


if($num==0)
{

echo "<br><br>";
echo "<div align=center><font color=red><b>NO DATA FOUND </b></font></div>";
die();
}


?>


  <table width="650" class='forumline' align='center'>
  <?php
  	$sql6=execute("select * from vechile_master where id=$vechilename");
  	$s=fetcharray($sql6);
  	?>
  <tr><td class="head" colspan=10 align=center><b>Special Trip Report of  :<?=$s[vehicle_mod_no]?>  Registration No:<?=$s[registration_no]?></b></td></tr>
  <tr><td class="row3">Sl No</td><td class="row3"><b>Requistion Given By</b></td><td class="row3"><b>Trip Date</b></td><td class="row3"><b>Trip Details</b></td><td class="row3"><b>Pick Up Time</b></td><td class="row3"><b>Departure Time</b></td>
  <td class="row3"><b>Name of the Driver</b></td> <td class="row3"><b>Mobile number of Driver</b></td> <td class="row3"><b>Name of the Bus Teacher</b></td> <td class="row3"><b>Bus Teacher Mobile Number</b></td>
  <!-- <td class="row3"><b>Name of the helper</b></td> -->
  </tr>

<?php
	for($i=0;$i<$num;$i++)
	{

		$r = fetcharray($rs,$i);
?>


  <tr>
 <td class="CBody">
  <?=$count?>
  </td>
    <td class="CBody" align='center'>
    <?=$r[req_given_by]?>
    </td>

   <td class="CBody" align='center'>
   <?=date('d-m-Y',strtotime($r[date]))?>
   </td>
    <td class="CBody" align='center'>
    <?=$r[trip_details]?>
    </td>
    <td class="CBody" align='center'>
    <?=$r[pick_up_time]?>
    </td>
    <td class="CBody" align='center'>
    <?=$r[departure_time]?>
    </td>
    <td class="CBody" align='center'>
    <?=$r[Driver_name]?>
    </td>
    <!-- <td class="CBody" align='center'>
    <?=$r[helper_name]?>
    </td> -->
	<td class="CBody" align='center'>
    <?=$r[driver_mobile]?>
    </td>
	<td class="CBody" align='center'>
    <?=$r[bus_teach]?>
    </td>
	<td class="CBody" align='center'>
    <?=$r[bus_mobile]?>
    </td>
    </tr>
<?php
$count++;
	}
	}
	if($submit)
	{
?>
<?php
	}
?>

</form>

</table>
<br>
<div id='prn' align=center colspan=5>
<center><input type=button name='prn' value="PRINT" class='bgbutton' onClick="printReport()"></center>
<?
}

else
die("<font color='red'>This link is only for Students </font>");
?>

</body>
</html>
