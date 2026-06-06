<?php
header('Location: school_calendar.php');
?><HTML>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</HEAD>
<?php
session_start();
include("../db.php");
$action=$_REQUEST['action'];
$update=$_POST['update'];
$course=$_POST['course'];
$FromYear=$_POST['FromYear'];
$save=$_POST['save'];
$stu_id=$_REQUEST['stu_id'];
$subid=$_POST['subid'];
$rcot=$_POST['rcot'];
$descr=$_POST['descr'];
$date1 = date("d/m/Y");
$date3=$_POST['date3'];
$adate=$_POST['adate'];
$bdate=$_POST['bdate'];
$ename=$_POST['ename'];
$type=$_POST['type'];
$sql = execute("SELECT * FROM users WHERE username='$user'") or die(error_description());
$rs=fetcharray($sql);
$UserId=$rs[id];
?>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="scannouncement_call.php";
	document.frm.submit();
}

function addnew()
{
		var tval=document.getElementById("type").value;
		if(tval==1)
		{
			var adate=document.getElementById("adate1").value;
			
			var ename=document.getElementById("ename").value;
			if(adate=='' || ename=='')
			{
				if(ename=='' && adate!='')
				var msg="Enter the Title ";
				if(ename!='' && adate=='')
				var msg="Enter the date ";
				if(adate=='' && ename=='')
				var msg="Enter the date and Title";
				alert(msg);
			}
			else
			{
				document.frm.action="scannouncement_call.php?save=save";
				document.frm.submit();
			}
			

		}
		else
		{
			var adate=document.getElementById("adate1").value;
			var bdate=document.getElementById("bdate1").value;
			var ename=document.getElementById("ename").value;
			if(adate=='' || adate=='' || ename=='')
			{
				if(ename=='' && (adate!='' && bdate!=''))
				var msg="Enter the Title ";
				if(ename!='' && (adate=='' || bdate==''))
				var msg="Enter the date ";
				if(adate=='' && (adate=='' || bdate==''))
				var msg="Enter the date and Title";
				alert(msg);

			}
			else
			{
				document.frm.action="scannouncement_call.php?save=save";
				document.frm.submit();
			}
		
		}
		
}

</SCRIPT>
<BODY>

<?php
$save=$_REQUEST['save'];
$delete=$_POST['delete'];
if(isset($delete))
{
	
execute("update announcement_call set status=0 where id='$stu_id' ");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Deleted successfully");
	</script>
	<?php
	$action='mod';
	$stu_id='';
	
}


if($action=='mod' and $stu_id=='') 
{?>
    
    <?php
	$sytemdate=date("Y-m-d");
	?><br>
    <table  class='forumline' align='center' width="60%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="4" class="head" align="center">Modify <strong>Calendar</strong></td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic">Sl.No.</td>
    <td align="center" class="rowpic">Title</td>
    <td align="center" class="rowpic">From Date</td
    >
    <td align="center" class="rowpic">To From</td>
  </tr>
  <?
	$inc=1;
	$temsql3=execute("select * from announcement_call where status=1");
	while($r=fetcharray($temsql3))
	{
		echo "
		<tr >
			<td align='center'>$inc</td>
			<td nowrap>&nbsp;&nbsp;
			<a href='scannouncement_call.php?stu_id=$r[id]'>
			$r[title]</a></td>
			<td align='center' nowrap>";
			echo date("d-m-Y",strtotime($r['fromdate']));
			echo "</td>
			<td align='center' nowrap>";
			
			if($r[todate]=='0000-00-00')
			{
				echo date("d-m-Y",strtotime($r['fromdate']));
			}
			else
			echo date("d-m-Y",strtotime($r['todate']));
			
			
			echo "</td>
		</tr>";
  $inc++;
	}
	
	?>
	</table>
    <br><div class="diva1" align="center"><a href="scannouncement_call.php" class='topictitle1'><input type="button" name="Add New" value="Add New" class="bgbutton"></a></div><br>
    <?
}
if($update)
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
execute("update announcement_call set  fromdate='$fdate', todate='$tdate' ,title='$ename', description='$descr' where id='$stu_id' ");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated successfully");
	</script>
	<?php
	
}

if($stu_id!='')
{
	$temsql4=execute("select * from exam_m where id='$stu_id'");
	while($r1=fetcharray($temsql4))
	{
		$course=$r1['curriculam'];
		$FromYear=$r1['class'];
		$adate=$r1['f_date'];
		$bdate=$r1['t_date'];
		$ename=$r1['exam_name'];
		$descr=$r1['descr'];
		$maxmark=$r1['max_mark'];
		$exam_count=$r1['exam_count'];
		$sub_id12=$r1['sub_id']; 
	}
	$tfdate=explode('-',$adate);
	$adate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
	$ttdate=explode('-',$bdate);
	$bdate=$ttdate[2]."/".$ttdate[1]."/".$ttdate[0];
	
	
?>
	<FORM NAME='frm' METHOD=POST >
    <input type="hidden" name='stu_id' value="<?=$stu_id?>">
	<table class='forumline' align='center' width="40%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td class="head" align="center" colspan="2">Modify <strong>Calendar</strong></td>
	</tr>


	<?php
	
		$temsql3=execute("select * from announcement_call where  id=$stu_id");
	while($r=fetcharray($temsql3))
	{
		$type=$r['type'];
		$ename=$r['title'];
		$descr=$r['description'];
		$adate=$r['fromdate'];
		$bdate=$r['todate'];
	$tfdate=explode('-',$adate);
	$adate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
	$ttdate=explode('-',$bdate);
	$bdate=$ttdate[2]."/".$ttdate[1]."/".$ttdate[0];
		
	}
	
	
	?>
	  <tr >
	    <td>&nbsp;&nbsp;Type</td>
	    <td >&nbsp;&nbsp; <?php
        if($type==2)
		echo $type2="Multiple day";
		else
		echo $type1='Single day';
	    ?>  </td>
      </tr>
	  <tr>
	    <td nowrap>&nbsp;&nbsp;From</td>
	    <td colspan="2" nowrap>&nbsp;
	      <input type="text" readonly name="adate" id="adate2" value="<?php echo $adate; ?>">
	      &nbsp;&nbsp; <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
      </tr>
	  <?php
		if($type==2)
		{
			?>
	  <tr>
	    <td nowrap>&nbsp;&nbsp;To</td>
	    <td colspan="2" nowrap>&nbsp;
	      <input type="text" readonly name="bdate" id="bdate2" value="<?php echo $bdate; ?>">
	      &nbsp;&nbsp; <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
      </tr>
	  <?php
		}
		?>
	  <tr>
	    <td nowrap>&nbsp;&nbsp;Title</td>
	    <td colspan='2' nowrap>&nbsp;
	      <input type="text" name="ename" id="ename1" value="<?php echo $ename; ?>" size='40' >
	      &nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
	  <tr>
	    <td nowrap>&nbsp;&nbsp;Description</td>
	    <td colspan='2' nowrap>&nbsp;
	      <textarea name="descr" rows="3" cols="50"><?php echo $descr; ?></textarea></td>
      </tr>
	  </table>
<br>
	  <div align="center">
		<input class="bgbutton" type="submit" name="update" value="UPDATE">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="bgbutton" type="submit" name="delete" value="DELETE">
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="scannouncement_call.php" class='topictitle1'><input type="button" name="Add New" value="Add New" class="bgbutton">
   </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="scannouncement_call.php?action=mod" class='topictitle1'><input type="button" name="Modify" value="Cancel" class="bgbutton" ></a></div>
</FORM>
	<?php
}

if($save=='save')
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];

	if($type==1)
	$tdate='0000-00-00';
	
	$temsql=execute("select * from announcement_call where title='$ename' and class='$FromYear' and fromdate='$fdate' and todate='$tdate'");

	if(rowcount($temsql)>0)
		echo "<font color='#FF0000'>Duplicate entry not allowed</font> <br>";
	else
	{
		execute("insert into announcement_call (type,fromdate,todate ,title,description,status) values('$type','$fdate','$tdate','$ename','$descr', 1)");
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Added successfully");
		</script>
		<?php
		
	}
}
if($action=='' and $stu_id=='') 
{
	?>
	<FORM NAME='frm' METHOD=POST >
    <br>
	<table class='forumline' align='center' width="50%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Declare <strong>Calendar</strong></td>
	</tr>

        <?php
	if($type==2)
	$type2="selected";
	else
	$type1='selected';
	
	
	?>
    <tr >
        <td>&nbsp;&nbsp;Type</td>
        <td >&nbsp;&nbsp;<select name="type" id="type" onChange="go()">
                <option value="1" <?php echo $type1; ?>>Single day</option>
                <option value="2" <?php echo $type2; ?>>Multiple day</option>
            </select>
        </td>
	</tr>


		<tr>
		<td nowrap>&nbsp;&nbsp;From</td>
		<td colspan="2" nowrap>&nbsp;
		<input type="text" readonly name="adate" id="adate1" value="">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
        <?php
		if($type==2)
		{
			?>
			<tr>
			<td nowrap>&nbsp;&nbsp;To</td>
			<td colspan="2" nowrap>&nbsp;
			<input type="text" readonly name="bdate" id="bdate1" value="">&nbsp;&nbsp;
			<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
			</td>
			</tr>
		<?php
		}
		?>
        <tr>
		<td nowrap>&nbsp;&nbsp;Title</td>
		<td colspan='2' nowrap>&nbsp;
		<input type="text" name="ename" id="ename" value="" size='40' >&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
        <tr>
		<td nowrap>&nbsp;&nbsp;Description</td>
		<td colspan='2' nowrap>&nbsp;
		<textarea name="descr" rows="3" cols="50"></textarea></td>
		</tr></table>
	<br>
	  <div align="center">
		<input class="bgbutton" type="button" onClick="addnew()" name="save" value="SAVE">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="scannouncement_call.php?action=mod" class='topictitle1'><input type="button" name="Modify" value="Modify" class="bgbutton" ></a>
	  </div>

</FORM>
	<?php
}
?>

</BODY>
</HTML>