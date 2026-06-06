<HTML>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
</HEAD>
<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];

$sql=execute("select a.year_id, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID order by a.course_id, a.year_id, a.subject_id , a.class_section_id");
while($r12=fetcharray($sql))
{
	if($a!=$r12[0] or $b!=$r12[1])
	{
		$yearname1[]=$r12[0];
		$sectionname[]=$r12[1];
	}
	$a=$r12[0];
	$b=$r12[1];

}

if(!$_POST and !$_REQUEST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
elseif(!$_POST and $_REQUEST)
{
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$stu_id=$_REQUEST['stu_id'];
	$action=$_REQUEST['action'];
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$update=$_REQUEST['update'];
	$save=$_REQUEST['save'];
	$subid=$_REQUEST['subid'];
	$rcot=$_REQUEST['rcot'];
	$descr=$_REQUEST['descr'];
	$date3=$_REQUEST['date3'];
	$adate=$_REQUEST['adate'];
	$bdate=$_REQUEST['bdate'];
	$ename=$_REQUEST['ename'];
	$type=$_REQUEST['type'];

}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$update=$_POST['update'];
	$save=$_POST['save'];
	$subid=$_POST['subid'];
	$rcot=$_POST['rcot'];
	$descr=$_POST['descr'];
	$date3=$_POST['date3'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$ename=$_POST['ename'];
	$type=$_POST['type'];
}
$date1 = date("d/m/Y");
$sql = execute("SELECT * FROM users WHERE username='$user'") or die(error_description());
$rs=fetcharray($sql);
$UserId=$rs[id];
?>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="announcement.php";
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
				document.frm.action="announcement.php?save=save";
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
				document.frm.action="announcement.php?save=save";
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
	$editid=$_POST['editid'];
	execute("update announcement_class set status=0 where id='$editid' ");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Deleted successfully");
	</script>
	<?php
}


if($update)
{
	$editid=$_POST['editid'];
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
execute("update announcement_class set  fromdate='$fdate', todate='$tdate' ,title='$ename', description='$descr' where id='$editid' ");
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
		$branch=$r1['curriculam'];
		$sem=$r1['class'];
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
	<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td class="head" align="center" colspan="2">Modify Announcement  </td>
	</tr>
	<tr >
        <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
        <td >&nbsp;&nbsp;
        <?php
	
		$temsql3=execute("select * from announcement_class where  id=$stu_id");
	while($r=fetcharray($temsql3))
	{
		$editid=$r['id'];
		$classid=$r['class'];
		$type=$r['type'];
		$ename=$r['title'];
		$descr=$r['description'];
		$adate=$r['fromdate'];
		$bdate=$r['todate'];
		$tfdate=explode('-',$adate);
		$adate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
		$ttdate=explode('-',$bdate);
		$bdate=$ttdate[2]."/".$ttdate[1]."/".$ttdate[0];	
		$gradeinf=$r['grade'];
		$section_idinf=$r['section_id'];
	}        
		
		$sectname=fetchrow(execute("SELECT section_name FROM `class_section` where id='$section_idinf'"));
		$semname =fetchrow(execute("SELECT year_name FROM course_year where year_id='$gradeinf' "));
		echo $semname[0].' '.$sectname[0];
		?></td>
    </tr>
<input type="hidden" name="editid" value="<?=$editid?>"/>

	  <tr >
	    <td>&nbsp;&nbsp;Type</td>
	    <td >&nbsp;&nbsp;<?php
        if($type==2)
		echo $type2="Multiple day";
		else
		echo $type1='Single day';
	    ?> </td>
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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="announcement.php" class='topictitle1'><input type="button" name="Add New" value="Add New" class="bgbutton">
   </a></div>
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
	
/*	$temsql=execute("select * from announcement_class where title='$ename' and class='$sem' and fromdate='$fdate' and todate='$tdate'");

	if(rowcount($temsql)>0)
		echo "<font color='#FF0000'>Duplicate entry not allowed</font> <br>";
	else
	{
		*/
		$yearname2=$_POST['yearname2']; 
		$sectname2=$_POST['sectname2'];
		$secid=$sectname2[$sem];
		$gradeid=$yearname2[$sem];

		execute("insert into announcement_class (class,username,type,fromdate,todate ,title,description,status,grade ,section_id) values('$sem','$user','$type','$fdate','$tdate','$ename','$descr', 1,'$gradeid', '$secid')");
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Added successfully");
		</script>
		<?php
		
	//}
}
if($action=='' and $stu_id=='') 
{
	?>
	<FORM NAME='frm' METHOD=POST ><br>
	<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Declare Announcement </td>
	</tr>

        <?php
	if($type==2)
	$type2="selected";
	else
	$type1='selected';
	
		?>
 	  <tr>
      <?php
for($j=0;$j<sizeof($yearname1);$j++)
{	  
	echo "<input type='hidden' name='yearname2[]' value='$yearname1[$j]'>
	<input type='hidden' name='sectname2[]' value='$sectionname[$j]'>";
}
	?><td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; 
		?></td>
	<td colspan="2">&nbsp;
	<select name="sem" OnChange=go()>
	<option value=''>-- Select --</option>
	<?php
	for($j=0;$j<sizeof($yearname1);$j++)
	{
		$sectname=fetchrow(execute("SELECT section_name FROM `class_section` where id='$sectionname[$j]'"));
		$semname =fetchrow(execute("SELECT year_name FROM course_year where year_id='$yearname1[$j]' "));
		if($sem==$j)
		echo "<option value='$j' selected>$semname[0] $sectname[0]</option>";
		else
		echo "<option value='$j'>$semname[0] $sectname[0]</option>";
	}


	
	?> </select> </td></tr>

    <tr>
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
		<input class="bgbutton" type="button" onClick="addnew()" name="save" value="SAVE">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </div>

</FORM>
	<?php
}
?>
<br>
    <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="4" class="head" align="center">Modify Aannouncement  </td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic">Sl.No.</td>
    <td align="center" class="rowpic">Title</td>
    <td align="center" class="rowpic">From Date</td>
    <td align="center" class="rowpic">To From</td>
  </tr>
  <?
	$inc=1;
	$temsql3=execute("select * from announcement_class where status=1 and username='$user' and grade!='0'");
	while($r=fetcharray($temsql3))
	{
		echo "
		<tr height='25'>
			<td align='center'>$inc</td>
			<td nowrap>&nbsp;&nbsp;
			<a href='announcement.php?stu_id=$r[id]'>
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
</BODY>
</HTML>