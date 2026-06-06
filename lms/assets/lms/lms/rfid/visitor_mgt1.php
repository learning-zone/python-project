<?php
require_once('../db.php');
$username_id=$_POST['username_id'];
$adate=$_POST['adate'];
$today = date('Y-m-d H:i:s');	
$type=$_POST['type'];
$add_prsn=$_POST['add_prsn'];
$penal_hr = $_POST['penal_hr'];
$penal_sec = $_POST['penal_sec'];
$ams = $_POST['ams'];
$other_purpose = $_POST['other_purpose'];
$in_time=$_POST['in_time'];
$penal_hr1 = $_POST['penal_hr1'];
$penal_sec1 = $_POST['penal_sec1'];
$ams1 = $_POST['ams1'];
$visitor_name=$_POST['visitor_name'];
$type1=$_POST['type1'];
$company_frm=$_POST['company_frm'];
$address=$_POST['address'];
$city=$_POST['city'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];	
$purpose=$_POST['purpose'];
$add_person=$_POST['add_person'];
$ti=$_POST['penal_hr'];
$tim=$_POST['penal_sec'];
$tims=$_POST['ams'];
$timr=$ti."-".$tim."-".$tims;
$ti1=$_POST['penal_hr1'];
$tim1=$_POST['penal_sec1'];
$tims1=$_POST['ams1'];
$timr1=$ti1."-".$tim1."-".$tims1;
if($adate!='')
{
	$date1 = date('Y-m-d', $adate);
	$from = (explode(" ",$adate));
	$from_date = (explode("/",$from[0]));
	$From_date = $from_date[2]."-".$from_date[1]."-".$from_date[0];
}
if($_POST['Submit'])
{


$quer3=fetchrow(execute("select id FROM `visitor_mgt` where id='$id'"));
if($quer3[0])
{
 $query="UPDATE `visitor_mgt` SET `username` = '$username_id',`d_date` = '$From_date',`time_2` = '$timr',`time_1` = '$timr1',`visitor_name` = '$visitor_name',`add_prsn` = '$add_prsn',
`company_frm` = '$company_frm',`address` = '$address',`city` = '$city',`mobile` = '$mobile',`email` = '$email',`purpose` = '$purpose',`add_person` = '$add_person',`type`='$type',`type1`='$type1',`other_purpose`='$other_purpose' WHERE `id` ='$id'";
	
}
else
{
    $query="INSERT INTO `visitor_mgt`(`username`, `d_date`, `time_2`, `time_1`, `visitor_name`, `add_prsn`, `company_frm`, `address`, `city`, `mobile`, `email`, `purpose`, `add_person`,`in_time`,`type`,`type1`,`other_purpose`) VALUES ('$username_id', '$From_date', '$timr', '$timr1', '$visitor_name','$add_prsn', '$company_frm', '$address', '$city', '$mobile','$email', '$purpose','$add_person','$today','$type','$type1','$other_purpose')";

}
$result=execute($query);
if($result) 
{

		?>

        <script language="javascript">

		alert("Updated Sucessfully");

        </script>

        <?php
}
}

//data fetching 
$quer=fetchrow(execute("select * FROM `visitor_mgt` where id='$id'"));

	while($row5=fetcharray($quer))
	{
		
		
	}
?>
<html>
<head>
<script language="JavaScript">
function reload()
{
		document.frm.action="visitor_mgt1.php";
		document.frm.submit();

}
function RefreshMe(val)
{
	document.frm.action="visitor_mgt1.php";
	document.frm.submit();
}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
</head>
<body>
<form  name="frm" method="POST">
<table border="1" cellpadding="0" cellspacing="0" width="700" align="center">
<tr height="25"><td class="submenu" colspan="4" nowrap>
<div id=123A style="float: center; text-align: center;"><b>Add Visitor Details</b></div></td></tr>
<?php
$q3=fetchrow(execute("SELECT max(id) FROM visitor_mgt"));
?>
<tr><td>&nbsp;&nbsp;Appointment ID</td>
<td width="20"><?=$q3[0]?></td><td colspan="2"></td></tr>
<tr><td>&nbsp;&nbsp;Staff Name</td>
<td><select name="username_id" onChange="RefreshMe(0)">
<option value=''>-- Select --</option>
<?php
	$sql="SELECT a.username, b.f_name, b.s_name,b.slno,a.id,a.srid,b.id FROM users a, staff_det b WHERE a.Activated='On' and a.username!='administrator' and a.srid=b.id order by a.username";
	$rs=execute($sql);
	for($i=0;$i<rowcount($rs);$i++)
	{

		$r=fetcharray($rs);
		if($username_id==$r[srid])
		{
			?>
<option value="<?=$r['srid']?>" selected><?php echo $r['f_name']." ".$r['s_name']."(".$r['slno'].")"; ?></option>
<?php
		
	}
else
{
?>

<option value="<?php echo $r[srid] ?>">
 <?php echo $r['f_name']." ".$r['s_name']."(".$r['slno'].")"; ?>
</option>
<?php
}
}
?>
</select></td><td colspan="2"></td>
</tr>
<tr>
<tr>
<td>&nbsp;&nbsp;To Date</td>
<td>
   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
		</td>
        <td colspan="3">
         <input type="radio" name="type" value="official">Official Visit
 <input type="radio" name="type"  value="personal">Personal Visit</td></tr>
<tr>
<td>&nbsp;Expected In Time</td>
<td><select name="penal_hr">
  <?php
    
    for($i='1';$i<=12;$i++)
  {
        if($i<10)
	{
	  $i='0'.$i;
	}
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
 }
?>
</select>
<select name="penal_sec">
<?php
for($i='0';$i<=59;$i++)
{
        if($i<10)
	{
	  $i='0'.$i;
	}
	
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";

}
?>
</select>
<select name='ams'>
<option>AM</option>
<option>PM</option>
</select>
</td>
<td>&nbsp;Expected Out Time</td>
<td nowrap><select name="penal_hr1">
  <?php
    
    for($i='1';$i<=12;$i++)
  {
        if($i<10)
	{
	  $i='0'.$i;
	}
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
 }
?>
</select>
<select name="penal_sec1">
<?php
for($i='0';$i<=59;$i++)
{
        if($i<10)
	{
	  $i='0'.$i;
	}
	
	$sel='selected';
	echo "<option value=$i $sel >$i</option>";
}
?>
</select>
<select name='ams1'>
<option>AM</option>
<option>PM</option>
</select>
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;Name Of The Visitor*</td>
  <td>&nbsp;&nbsp;<input type="text" name="visitor_name" size="20" value="<?=$visitor_name?>" required></td><td colspan="2"></td></tr>
<tr>
<td>&nbsp;&nbsp;Gender</td>
<td>
<input type="radio" name="type1" value="male" onChange="reload2()">Male
 <input type="radio" name="type1"  value="female" onChange="reload2()">Female</td>
 <td>&nbsp;&nbsp;Additional Person </td>
<td><input type="text" name="add_prsn" size="5" value="<?=$add_prsn?>" ></td>
 </tr>
<tr>
<td>&nbsp;&nbsp;Company From</td>
<td><input type="text" name="company_frm" size="20" value="<?=$company_frm?>" ></td><td colspan="2"></td></tr>
<tr><td>&nbsp;&nbsp;Address</td><td><textarea rows="4" cols="30" name='address'> <?=$address?></textarea></td><td colspan="2"></td>
</tr>
<tr>
<td>&nbsp;&nbsp;City</td>
<td><input type="text" name="city" value="<?php echo $city?>"></td><td colspan="2"></td></tr>
<tr> <td>&nbsp;&nbsp;Phone number*</td>
<td><input type="text" name="mobile" value="<?php echo $mobile; ?>" maxlength="10" required> </td><td colspan="2"></td></tr>
<tr>
<td nowrap>&nbsp;&nbsp;E-Mail ID</td>
<td><input type="email" name="email" onChange="validateForm(this.name)"  value="<?=$email?>" size='40'></td><td colspan="2"></td></tr>
<tr><td>&nbsp;&nbsp;Purpose To Meet</td><td><select name="purpose" onChange="RefreshMe(0)"><option>-------Select-----</option>
          <?php
			   $res = execute("select * from purpose_to_meet");
			   while($row = fetcharray($res))
			   {
				   if($purpose==$row[id])
					{
						
						echo "<option value='$row[id]' selected>&nbsp;&nbsp;$row[purpose]</option>";
					}
					else
					{
						echo "<option value='$row[id]'>&nbsp;&nbsp;$row[purpose]</option>";
					}				  

			   }
			?>
        </select>
</td><td colspan="2"></td>
  <?
if($purpose=='5')
{
?>  
<tr><td></td>
<td><textarea rows="4" cols="30" name='other_purpose' value="<?=$other_purpose?>"></textarea></td><td></td><td></td></tr>
<?
}
?>
</tr>
<tr><td align="center" colspan="4">&nbsp;&nbsp;Additional Person(s)</td></tr>
<tr><td align="center" colspan="4">&nbsp;&nbsp;<textarea rows="6" cols="80" name='add_person' value="<?=$add_person?>"></textarea></td></tr>
<br>
 </table><br>
 <div align="center">
 <input name="Submit" type="submit" width="30" height="8" class="bgbutton" value=" Update " /> 
 </div>
</form>


</body>
</html>