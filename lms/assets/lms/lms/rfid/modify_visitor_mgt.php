<?php
require_once('../db.php');
$id=$_REQUEST['id'];
$visitor_name=$_REQUEST['visitor_name'];
if($_POST['Submit'])
{
$username_id=$_POST['username_id'];
$adate=$_POST['adate'];

$today = date('Y-m-d H:i:s');	
$type=$_POST['type'];
$add_prsn=$_POST['add_prsn'];
$penal_hr = $_POST['penal_hr'];
$penal_sec = $_POST['penal_sec'];
$ams = $_POST['ams'];
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
 $query="UPDATE `visitor_mgt` SET `username` = '$username_id',`d_date` = '$From_date',`time_2` = '$timr',`time_1` = '$timr1',`visitor_name` = '$visitor_name',`add_prsn` = '$add_prsn',
`company_frm` = '$company_frm',`address` = '$address',`city` = '$city',`mobile` = '$mobile',`email` = '$email',`purpose` = '$purpose',`add_person` = '$add_person',`in_time`='$today' WHERE `id` ='$id'";
	

$result=execute($query);
if($result) 
{

		?>

        <script language="javascript">

		alert("Updated Sucessfully");
		window.opener.location.href='visitor_mgt.php';
		window.close();

        </script>

        <?php
}
}
//data fetching 
$quer1=execute("select * FROM `visitor_mgt` where id='$id'");
$quer=fetcharray($quer1);
?>
<html>
<head>
<script language="JavaScript">
function reload()
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
<div id=123A style="float: center; text-align: center;"><b>Modify Visitor Details</b></div></td></tr>
<tr><td>&nbsp;&nbsp;Appointment ID</td>
<td width="20"><?=$quer[0]?></td><td colspan="2"></td></tr>
<tr><td>&nbsp;&nbsp;Staff Name</td>
<td>
<select name="username_id">
<option value="0">----Select----</option>
<?php
	$sql="SELECT a.username, b.f_name, b.s_name,b.slno,a.id,a.srid,b.id FROM users a, staff_det b WHERE a.Activated='On' and a.username!='administrator' and a.srid=b.id order by a.username";
	$rs=execute($sql);
	for($i=0;$i<rowcount($rs);$i++)
	{
	  $r=fetcharray($rs);
      if($quer[username]==$r[srid])
    	{
						?>
						<option value="<?=$r[srid]?>" selected><?php echo $r['f_name']." ".$r['s_name']."(".$r['slno'].")" ?></option>
					<?php

					}

					else

					{

						?>

						<option value="<?php echo $r[srid] ?>"><?php echo $r['f_name']." ".$r['s_name']."(".$r['slno'].")" ?></option>

						<?php

					}

				}

			?>

		</select>


          </td><td colspan="2"></td>
</tr>
<tr>
<tr>
<td>&nbsp;&nbsp;To Date</td>
 <?

		if($quer[d_date]!='0000-00-00')

		{

			$var123 = explode('-',$quer[d_date]);

			if($adate=="")

				$adate= $var123[2]."/".$var123[1]."/".$var123[0];

		}

		?>
<td>
   <input type="text" name="adate" value="<?php if($adate==""){$adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
		</td>
        <td colspan="3">
         <?php
  if($quer[type]=='yes')
  $check='checked';
  else
  $check1='checked';
  ?>
         <input type="radio"  name="type" value="official" <?=$check?>>Official Visit
 <input type="radio" name="type"  value="personal" <?=$check1?>>Personal Visit</td></tr>
<tr>
<?php

     $dm=explode("-",$quer['time_2']);
	 //echo "hai".$dm[1];

?>
<td>&nbsp;Expected In Time</td>
<td nowrap><select name="penal_hr">
<?php
   for($il='1';$il<=12;$il++)
  {
	  if($il<10)
	{
	  $il='0'.$il;
	}
	if($dm[0]=='' || $dm[0]=='0')
	{
	  $p=$il;
	}
	else
	{
	  $p=$dm[0];
	}
	if($p==$il)
	{
			       echo "<option value='$il' selected >$il</option>";
	}
	else
	{
	       echo "<option value=$il>$il</option>";

	} 

 }

?>

</select>

<select name="penal_sec">

<?php
	 $qq=$dm[1];
for($is1=0;$is1<=59;$is1++)
{    if($is1<10)
	{
	  $is1='0'.$is1;
	}
	
/*	if($dm[1]=='' || $dm[1]=='0')
	{  

	  $qq=$is1;
	}
	else
	{
	  $qq=$dm[1];
	}*/
	$sel='';
	
	if($qq==$is1)
	{
	 $sel='selected';
	 echo "<option value='$is1' $sel>$is1</option>";
	}
	else
	{
	  echo "<option value='$is1'>$is1</option>";
	} 
}
?>

</select>

<select name='ams'>

<?php

if($dm[2]=="AM")

{

	$sj="selected";

	$sk="";

}

if($dm[2]=="PM")

{

	$sk="selected";

	$sj="";

}

?>

<option value="AM" <?php echo $sj?>>AM</option>

<option value="PM" <?php echo $sk?>>PM</option>

</select>
</td>
<?php

     $dm1=explode("-",$quer['time_1']);

?>
<td>&nbsp;Expected Out Time</td>
<td nowrap><select name="penal_hr1">
<?php
   for($i2='0';$i2<=12;$i2++)
  {
	  if($i2<10)
	{
	  $i2='0'.$i2;
	}
	if($dm1[0]=='' || $dm1[0]=='0')
	{
	  $p1=$i2;
	}
	else
	{
	  $p1=$dm1[0];
	}
	if($p1==$i2)
	{
			       echo "<option value='$i2' selected >$i2</option>";
	}
	else
	{
	       echo "<option value=$i2>$i2</option>";

	} 

 }

?>

</select>
<select name="penal_sec1">
<?php
 $qq1=$dm1[1];
for($is2=0;$is2<=59;$is2++)
{    if($is2<10)
	{
	  $is2='0'.$is2;
	}

	/*if($dm1[1]=='' || $dm1[1]=='0')
	{  

	  $qq1=$is2;
	}
	else
	{
	  $qq1=$dm1[1];
	}*/
	$sel='';
	if($qq1==$is2)
	{
	 $sel='selected';
	 echo "<option value='$is2' $sel>$is2</option>";
	}
	else
	{
	  echo "<option value='$is2'>$is2</option>";
	} 
}
?>

</select>

<select name='ams1'>

<?php

if($dm1[2]=="AM")

{

	$sj1="selected";

	$sk1="";

}

if($dm1[2]=="PM")

{

	$sk1="selected";

	$sj1="";

}

?>

<option value="AM" <?php echo $sj1?>>AM</option>

<option value="PM" <?php echo $sk1?>>PM</option>

</select>
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;Name Of The Visitor</td>
  <td>&nbsp;&nbsp;<input type="text" name="visitor_name" size="20" value="<?=$quer[visitor_name]?>" ></td><td colspan="2"></td></tr>
<tr>
<td>&nbsp;&nbsp;Gender</td>
<?php
  if($quer[type1]=='male')
  $check='checked';
  else
  $check1='checked';
  ?>
<td>
<input type="radio" name="type1" value="male" <?=$check1?>>Male
 <input type="radio" name="type1"  value="female" <?=$check?>>Female</td>
 <td>&nbsp;&nbsp;Additional Person </td>
<td><input type="text" name="add_prsn" size="5" value="<?=$quer[add_prsn]?>" ></td>
 </tr>
<tr>
<td>&nbsp;&nbsp;Company From</td>
<td><input type="text" name="company_frm" size="20" value="<?=$quer[company_frm]?>" ></td><td colspan="2"></td></tr>
<tr><td>&nbsp;&nbsp;Address</td><td><textarea rows="4" cols="30" name='address'> <?=$quer[address]?></textarea></td><td colspan="2"></td>
</tr>
<tr>
<td>&nbsp;&nbsp;City</td>
<td><input type="text" name="city" value="<?php echo $quer[city]?>"></td><td colspan="2"></td></tr>
<tr> <td>&nbsp;&nbsp;Phone number</td>
<td><input type="text" name="mobile" value="<?php echo $quer[mobile]?>" maxlength="10" > </td><td colspan="2"></td></tr>
<tr>
<td nowrap>&nbsp;&nbsp;E-Mail ID</td>
<td><input type="text" name="email" onChange="validateForm(this.name)"  value="<?=$quer[email]?>" size='40'></td><td colspan="2"></td></tr>
<tr><td>&nbsp;&nbsp;Purpose To Meet</td><td><select name="purpose" onChange="RefreshMe(0)"><option>-------Select-----</option>
          <?php
			   $res = execute("select * from purpose_to_meet");
			   while($row = fetcharray($res))
			   {
				   if($row[id]==$quer[purpose])
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
 
<tr><td></td>
<td><textarea rows="4" cols="30" name='other_purpose'><?=$quer[other_purpose]?></textarea></td><td></td><td></td></tr>

</tr>
<tr><td align="center" colspan="4">&nbsp;&nbsp;Additional Person(s)</td></tr>
<tr><td align="center" colspan="4">&nbsp;&nbsp;<textarea rows="6" cols="80" name='add_person'><?=$quer[add_person]?></textarea></td></tr>
<br>
 </table><br>
 <div align="center">
 <input name="Submit" type="submit" width="30" height="8" class="bgbutton" value=" Update " /> 
 </div>
</form>


</body>
</html>