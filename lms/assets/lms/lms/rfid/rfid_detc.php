<?php
	session_start();

	include("../db.php");
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

if($_POST['update'])
{
	
	$val=fetchrow(execute("select id from rfid_user_access where userid='$StudID' and user_type=5 and status=1"));
	if($val[0])
	{
		?>
        <script>
		alert("Another car active for same user");
		</script>
        <?php	
	}
	else
	{
 			execute("INSERT INTO `rfid_user_access` (`user_type`, `userid`, `food`, `trans`, `status`) VALUES ( '5', '$StudID', '$accesscaf', '$accesscaf', '1')");

		?>
        <script>
		alert("Updated Successfully");
		</script>
        <?php	
	}
}
	
if($_POST['save'])
{
	$Sql66=execute("select id from rfid_enrolment_user where user='$StudID' and status='1' and user_type=5");
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
		   $sql33="INSERT INTO `rfid_enrolment_user` (`rfid`, `user`, `user_type`, `add_date`, `end_date`, `status`) VALUES ('$rfidno1', '$StudID', '5', '$fromd', '$tod', '1')";
		//  execute("delete from rfidupdate where rfidno='$rfidno1'");
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
		$rfsdet=execute("update rfid_enrolment_user set `active`='N', rfidAccess='N', status='0' where id='$k'");
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
		
	

$stname=fetcharray(execute("select first_name,last_name from student_m where id='$StudID'"));

$stgrd=fetcharray(execute("select course_yearsem from student_m where id='$StudID'"));

$stsection=fetcharray(execute("select class_section_id from student_m where id='$StudID'"));

$stgrdname=fetcharray(execute("select year_name from course_year where year_id='$stgrd[0]'"));

$stsectionname=fetcharray(execute("select section_name from class_section where id='$stsection[0]'"));

$stadmit=fetcharray(execute("select admission_id from student_m where id='$StudID'"));

$ststudid=fetcharray(execute("select student_id from student_m where id='$StudID'"));

$imagesst=fetcharray(execute("select img_source from student_m where id='$StudID'"));


?>
<html>
<head>
</head>
<style type="text/css">
table.curvedEdges 
{ 
  font-family: Calibri;
  border-radius:13px;
}
</style>

<style type="text/css">
table tr.curved 
{ 
  font-family: Calibri;
  font-size:13px;
}
</style>

<style type="text/css">
table td.ftsize 
{ 
  font-family: Calibri;
  font-size:14px;
}
</style>

<style type="text/css">
	p.vertical
	 {
		   writing-mode:tb-lr;
		   -webkit-transform:rotate(270deg);
		   -moz-transform:rotate(270deg);
		   -o-transform: rotate(270deg);
		   white-space:nowrap;
		   display:block;
		   bottom:0;
		   width:10px;
		   height:40px; 
		   position:relative;
		   left:20px;
		   top:28px;
	}
</style>
<?php
$dstuds=fetchrow(execute("select parent_name,parent_username from student_m where id='$StudID'"));
$dgrdes=fetchrow(execute("select f_photo from student_photo where studid='$StudID'"));
$fullnamess=fetchrow(execute("select first_name,last_name from student_m where id='$StudID'"));
$id=$StudID;
?>
<form name="frm" action="" method="post">
<table border="0" width='403px' height="210px" align="center"  cellpadding="0" cellspacing="0" class="curvedEdges">

<tr>
<?php
$stafffsid=fetchrow(execute("select g_id from additional_info2 where student_id='$id'"));

$dstuds=fetchrow(execute("select g_name,parent_username from student_m where id='$id'"));
$dgrdes=fetchrow(execute("select g_photo from student_photo where studid='$id'"));
$fullnamess=fetchrow(execute("select first_name,last_name from student_m where id='$id'"));
?>
<td align="left" style="font-size:16px" colspan="3"  background="green.png"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF"><?=$dstuds[0]?></font></b></td>
<td background="green.png"></td>
</tr>
<tr>
<td align="center" rowspan="7" width="10"></td>
<td align="center" rowspan="7" background="green.png" width="120"><img src="<?php echo $dgrdes[0]?>"  height='100'></td>
<td colspan="3" align="left" background="green.png" class="ftsize" style="border-bottom-right-radius:20px" ><font color="#FFFFFF">&nbsp;&nbsp;&nbsp;<?=$stafffsid[0]?></font><b><font color="#0A4A42" style="font-family:calibri">GUARDIAN</font></b></td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
<td align="center" colspan="3"><b><font color="#0389C6" style="font-family:calibri"><?=$grdes[0]?></font></b></td>
</tr>
<?
$fmcode2=execute("SELECT family_code FROM `stud_sibling` where `stud`='$id' and `status`=1");
if(rowcount($fmcode2)>0)
{
?>    
<tr>
<td align="left" colspan="3" height="30px"  valign="top"><font  style="font-size:13px"><b>&nbsp;
<?
}
else
{
?>
<tr>
<td align="left" colspan="3"  height="30px" valign="top"><font  style="font-size:14px"><b>&nbsp;<b><?=$fullnamess[0]?>&nbsp;<?=$fullnamess[1]?>
<?
}
?>
<?php
$i=0;
$count=0;
$fmcodes=fetcharray(execute("SELECT family_code FROM `stud_sibling` where `stud`='$id' and `status`=1"));
$fanilyname=execute("SELECT b.first_name,b.last_name FROM stud_sibling a,student_m b where a.family_code='$fmcodes[0]' and a.status=1 and b.id=a.stud order by b.course_yearsem");
$count=rowcount($fanilyname);
$n=$count;
$flag=0;
while($familnms=fetcharray($fanilyname))
{
	if($n<3)
	{
		if($flag)
		echo ",&nbsp;".$familnms[0]."&nbsp;".$familnms[1];
		else
		echo $familnms[0]."&nbsp;".$familnms[1];
		$flag=1;
	}
	else
	{	
		if($flag)
		echo ",&nbsp;".$familnms[0];
		else
		echo $familnms[0];
		$flag=1;
	}
}
?>
</b>
</font>
</td>
<td rowspan="4" class="ftsize"  background="buledark.PNG" width="8%"><p class="vertical"><font color="#FFFFFF"><b><?=$accyeardet?>&nbsp;-&nbsp;<?=$accyeardet+1?></b></font></p></td>
</tr>
<tr class="curved">
<td align="left" colspan="3" height="0px"><b>&nbsp;</b></td>
</tr>
<tr class="curved">
<td align="left" >From</td>
<td align="left" colspan="3" nowrap >
<select name="fd" title="From Day">
<?php
for($i=1;$i<32;$i++)
{
	echo "<option value='$i'>$i</option>";
}
?>
</select>
<select name="fm" title="From Month">
<?php
for($i=1;$i<13;$i++)
{
	echo "<option value='$i'>$i</option>";
}
?>
</select>
<select name="fy" title="From Year">
<?php
for($i=date('Y');$i<(date('Y')+2);$i++)
{
	echo "<option value='$i'>$i</option>";
}
?>
</select>

</td>
</tr>
<tr class="curved">
<td align="left"  >To</td>
<td align="left" colspan="4" nowrap>
<select name="td" title="To Day">
<?php
for($i=1;$i<32;$i++)
{
	echo "<option value='$i'>$i</option>";
}
?>
</select>
<select name="tm" title="To Month">
<?php
for($i=1;$i<13;$i++)
{
	echo "<option value='$i'>$i</option>";
}
?>
</select>
<select name="ty" title="To Year">
<?php
for($i=date('Y');$i<(date('Y')+2);$i++)
{
	echo "<option value='$i'>$i</option>";
}
?>
</select>

</td></tr>
</table>


<br>
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

$rfids=fetcharray(execute("select a.controllerip, a.readerno, a.rfidno, a.att_date, a.att_time from rfidupdate a, rfid_reader_master b where a.status='0' and b.readerip=a.controllerip and b.type=2 and a.readerno=b.turnstile  order by a.id desc LIMIT 1"));

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
$studact=fetcharray(execute("select rfid, add_date, status from rfid_enrolment_user where user='$StudID' and active='Y' and user_type=5"));
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
$studeat=execute("select rfid, add_date,end_date, status,id from rfid_enrolment_user where user='$StudID' and active='Y' and user_type=5");
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
<input type="hidden" value="<?=$StudID?>" name="StudID">

</form> 

</body>
</html>

