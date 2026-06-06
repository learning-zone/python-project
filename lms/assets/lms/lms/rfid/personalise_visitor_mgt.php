<?php

	session_start();
	include("../db.php");
	$id=$_REQUEST['id'];
	$schoolid=$_SESSION['schoolid'];
	$user=$_SESSION['user'];
	$sem=$_REQUEST['sem'];
	$StudID=$_REQUEST['StudID'];
	$app_nu=$_REQUEST['app_nu'];
	$branch=$_REQUEST['branch'];
	$a_year=$_REQUEST['a_year'];
	$studfname=$_REQUEST['studfname'];
	
	$controllerip1=$_POST['controllerip1'];
	$readerno1=$_POST['readerno1'];
	$rfidno1=$_POST['rfidno1'];
	$att_date1=$_POST['att_date1'];
	$att_time1=$_POST['att_time1'];
	$accesstrs=$_POST['accesstrs'];
	$accesscaf=$_POST['accesscaf'];


	$fd=$_POST['fd'];
	$fm=$_POST['fm'];
	$fy=$_POST['fy'];
	$td=$_POST['td'];
	$tm=$_POST['tm'];
	$ty=$_POST['ty'];
	$fromd="$fy-$fm-$fd";
	$tod="$ty-$tm-$td";
	$visitor_det=fetcharray(execute("select * from visitor_mgt where id='$id'"));
	if($_POST['update'])

{

	

	$val=fetchrow(execute("select id from visitor_mgt where id='$id'"));

	if($val[0])

	{

		?>

        <script>

		alert("Another card active for same user");

		</script>

        <?php	

	}
	else
	{

 			execute("INSERT INTO `rfid_user_access` (`user_type`, `userid`, `food`, `trans`, `status`) VALUES ( '9', '$id', '$accesscaf', '$accesscaf', '1')");



		?>

        <script>

		alert("Updated Successfully");

		</script>

        <?php	

	}

}

	

if($_POST['save'])
{
	$Sql66=execute("select id from rfid_enrolment_user where user='$id' and status='1' and user_type=9");
	if(rowcount($Sql66)>0)
	{
		?>
        <script>
		alert("Another Card active for same user");
		</script>
        <?php	
    }
	else
	{
		   $sql33="INSERT INTO `rfid_enrolment_user` (`rfid`, `user`, `user_type`, `add_date`, `end_date`, `status`) VALUES ('$rfidno1', '$id', '9', '$fromd', '$tod', '1')";

		//  execute("delete from rfidupdate where id='$masterdelete'");
	 		execute($sql33);
			?>
			<Script language="JavaScript">
			alert("Updated successfully");
			</Script>
			<?



		//$sql33="INSERT INTO rfid_stud (`controllerip`, `readerno`, `rfidno`, `att_date`, `att_time`, `studid`,to_day_date,delt) VALUES ( '$controllerip1', '$readerno1', '$rfidno1', '$att_date1', '$att_time1','$StudID','$bdate','N')";

	}

}

$sel=$_POST['sel'];

if($_POST['delete'])

{

	for($i=0;$i<sizeof($sel);$i++)

	{

		$k=$sel[$i];

		$rfsdet=execute("update rfid_enrolment_user set `active`='N', rfidAccess='N' , status='0' where id='$k'");

	}

			?>

			<Script language="JavaScript">

			alert("Deleted successfully");

			</Script>

			<?

	

}

if($_POST['inactive'])

{

	for($i=0;$i<sizeof($sel);$i++)

	{

		$k=$sel[$i];

		$rfsdet=execute("update rfid_enrolment_user set status='0',rfidAccess='N' where id='$k'");

	}

			?>

			<Script language="JavaScript">

			alert("Deactivated successfully");

			</Script>

			<?

	

}

if($_POST['active'])

{

	for($i=0;$i<sizeof($sel);$i++)

	{

		$k=$sel[$i];

		$rfsdet=execute("update rfid_enrolment_user set status='1',rfidAccess='N' where id='$k'");

	}

			?>

			<Script language="JavaScript">

			alert("Activated successfully");

			</Script>

			<?

	

}







?>





<html>

<head>

</head>



<form name="frm" action="" method="post">

<table align='center' cellpadding="5" class='forumline' width='80%' border="1" >

<tr><td colspan=3 align='center' class='head'>Visitor Details</td></tr>

<tr>

<td align="left"><b>Name </b></td>

<td align="left">&nbsp;<?=$visitor_det[visitor_name]?> &nbsp;&nbsp;</td>

<td align="center" rowspan="3"><img src="<?=$imagesst[0]?>" width="100" height='100'></td>

</tr>

<tr >

<td align="left"><b>Appointment ID </b></td>

<td align="left">&nbsp;<?=$visitor_det[id]?></td>

</tr>

<tr class="curved">

<?php

$d=date("d");

$m=date("m");

$y=date("Y");

?><td align="left" ><strong>From</strong></td>

<td align="left" colspan="2" >

<select name="fd" title="From Day">

<?php

for($i=1;$i<32;$i++)

{

	if($i==$d)

	echo "<option value='$i' selected>$i</option>";

	else

	echo "<option value='$i'>$i</option>";

}

?>

</select>

<select name="fm" title="From Month">

<?php

for($i=1;$i<13;$i++)

{

	if($i==$m)

	echo "<option value='$i' selected>$i</option>";

	else

	echo "<option value='$i'>$i</option>";

}

?>

</select>

<select name="fy" title="From Year">

<?php

for($i=date('Y');$i<(date('Y')+2);$i++)

{

	if($i==$y)

	echo "<option value='$i' selected>$i</option>";

	else

	echo "<option value='$i'>$i</option>";

}

?>

</select>



</td>

</tr>

<?php



?>

<tr class="curved">

<td align="left" ><strong>To</strong></td>

<td align="left" colspan="2" >

<select name="td" title="To Day">

<?php

for($i=1;$i<32;$i++)

{

	if($i==$d)

	echo "<option value='$i' selected>$i</option>";

	else

	echo "<option value='$i'>$i</option>";



}

?>

</select>

<select name="tm" title="To Month">

<?php

for($i=1;$i<13;$i++)

{

	if($i==$m)

	echo "<option value='$i' selected>$i</option>";

	else

	echo "<option value='$i'>$i</option>";



}

?>

</select>

<select name="ty" title="To Year">

<?php

for($i=date('Y');$i<(date('Y')+2);$i++)

{

	if($i==$y)

	echo "<option value='$i' selected>$i</option>";

	else

	echo "<option value='$i'>$i</option>";



}

?>

</select>



</td></tr>

<!--<tr >

<td align="left"><b>&nbsp;Access :</b></td>

<td align="left" colspan="2" nowrap>

<?php

$val=fetchrow(execute("select food,trans from rfid_user_access where userid='$id' and user_type=9"));

if($val[0])

$accesscaf1='checked';

else

$accesscaf1='';

if($val[1])

$accesstrs1='checked';

else

$accesstrs1='';



?>

&nbsp;<input type="checkbox" value="1" name="accesstrs" <?=$accesstrs1?>>&nbsp;Transport

&nbsp;<input type="checkbox" value="1" name="accesscaf" <?=$accesscaf1?>>&nbsp;Cafeteria

</td>

</tr>-->

</table>

<br>

<!-- <div align="center">

<input type="submit" name="update" value="Update" class="bgbutton"></div>

<br>-->

<table align='center' cellpadding="5" class='forumline' width='80%' border="1" >

<tr>

<td align='center' class='head' nowrap>Controller ID</td>

<td align='center' class='head' nowrap>Reader No</td>

<td align='center' class='head' nowrap>RFID No</td>

<td align='center' class='head'>Date</td>

<td align='center' class='head'>Time</td>

<td align='center' class='head'>Status</td>

</tr>

<?php



$rfids=fetcharray(execute("select a.controllerip, a.readerno, a.rfidno, a.att_date, a.att_time , a.id from rfidupdate a, rfid_reader_master b where a.status='0' and b.readerip=a.controllerip and b.type=2 and a.readerno=b.turnstile  order by a.id desc LIMIT 1"));
$val=fetchrow(execute("select id from `rfid_enrolment_user` where rfid='$rfids[2]' and active='Y'"));	

if($val[0])

$avail='<font color="#FF0000">Already Assigned</font>';

else

$avail='<font color="#009900">Available</font>';



	$datesss=explode('-',$rfids[3]);

	$yy11=$datesss[0];

	$mm11=$datesss[1];

	$dd11=$datesss[2];

	$dates11="$dd11-$mm11-$yy11";



?>

<input type="hidden" value="<?=$rfids[0]?>" name="controllerip1">

<input type="hidden" value="<?=$rfids[1]?>" name="readerno1">

<input type="hidden" value="<?=$rfids[2]?>" name="rfidno1">

<input type="hidden" value="<?=$rfids[3]?>" name="att_date1">

<input type="hidden" value="<?=$rfids[4]?>" name="att_time1">

<input type="hidden" value="<?=$rfids[5]?>" name="masterdelete">





<td align='center'><?=$rfids[0]?></td>

<td align='center'><?=$rfids[1]?></td>

<td align='center'><?=$rfids[2]?></td>

<td align='center'><?=$dates11?></td>

<td align='center'><?=$rfids[4]?></td>

<td align='center'><b><?=$avail?></b></td>

</tr>

</table>

<br>

 <div align="center">

 <?php

 if(!$val[0])

{

	?>

    <input type="submit" name="save" value="Assign To User" class="bgbutton">

    <?php

}

?>

</div>



<br>

<?

$studact=fetcharray(execute("select rfid, add_date, status from rfid_enrolment_user where user='$id' and active='Y' and user_type=9"));

if($studact[0])

{

	?>

<table align='center' cellpadding="5" class='forumline' width='80%' border="1" >

<tr>

<td align='center' class='head' colspan="4">Assigned RFID Details</td>

</tr>

<tr>

<td align='center' class='head' nowrap>Sel</td>

<td align='center' class='head' nowrap>RFID No</td>

<td align='center' class='head'>Date</td>

<td align='center' class='head'>Status</td>

</tr>

<?php

$studeat=execute("select rfid, add_date,end_date, status,id from rfid_enrolment_user where user='$id' and active='Y' and user_type=9");

while($studetails=fetcharray($studeat))

{

	if($studetails[3])

	$dis='<font color="#006600">Active</font>';

	else

	$dis='<font color="#0000FF">Inactive</font>';

	

	$stdut=explode('-',$studetails[1]);

	$yr=$stdut[0];

	$mth=$stdut[1];

	$dy=$stdut[2];

	$fullday="$dy-$mth-$yr";

	$stdut=explode('-',$studetails[2]);

	$yr=$stdut[0];

	$mth=$stdut[1];

	$dy=$stdut[2];

	$fullday1="$dy-$mth-$yr";



?>

<tr>

<td align='center'>

<input type="checkbox" name="sel[]" value="<?=$studetails[4]?>"></td>

<td align='center'><?=$studetails[0]?></td>

<td align='center'><?=$fullday?> To <?=$fullday1?></td>

<td align='center'><?=$dis?></td>

</tr>

<?	

}

?>

</table>

<br>

 <div align="center">

<input type="submit" name="active" value="Activate" class="bgbutton">&nbsp;&nbsp;

<input type="submit" name="inactive" value="Deactivate" class="bgbutton">&nbsp;&nbsp;

<input type="submit" name="delete" value="delete" class="bgbutton"></div>

<?

}

?>

<input type="hidden" value="<?=$id?>" name="id">

</form>

</body>

</html>



