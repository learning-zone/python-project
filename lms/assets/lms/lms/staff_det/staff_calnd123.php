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
	$bdate=$_REQUEST['bdate'];
	$ename=$_REQUEST['ename'];
	$type=$_REQUEST['type'];
	$mon=$_REQUEST['mon'];
	$yer=$_REQUEST['yer'];
	$day=$_REQUEST['day'];
	$adate=$_REQUEST['adate'];
	
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
	$ename=$_POST['ename'];
	$type=$_POST['type'];
	$mon=$_POST['mon'];
	$yer=$_POST['yer'];
	$day=$_POST['day'];
	$adate=$_POST['adate'];
}
if($day)
{
	$adate="$day/$mon/$yer";
}



	$date1 = date("d/m/Y");
	$sysdate="$yer-$mon-$day";	
?>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="staff_calnd123.php";
	document.frm.submit();
}


</SCRIPT>
<BODY>
<title>Add Staff Calendar</title>
<?php
$save=$_REQUEST['save'];
$delete=$_POST['delete'];
if(($delete))
{
	$editid=$_POST['editid'];
	execute("update staff_calenders set status=0 where id='$editid' ");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Deleted successfully");
	window.opener.location.href='staff_calnd.php?tab=3&adate='+"<?=$adate?>";
		
	</script>
	<?php
}


if($update)
{
	$editid=$_POST['editid'];
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
execute("update staff_calenders set  title='$ename', description='$descr' where id='$editid' ");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated successfully");
	window.opener.location.href='staff_calnd.php?tab=3&adate='+"<?=$adate?>";
		
	</script>
	<?php
	
}
?>
<Script language="JavaScript">	
function OpenWind2(k)
{
	var finalVar;
	finalVar=k;
	
	window.open(finalVar,'Stud','height=400,width=500,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
<link rel="stylesheet" type="text/css" href="css/tab.css" />

<!--<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>
<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>
<li class="currentBtn"><a href="staff_calnd123.php?tab=3" >Staff Calendar</a></li>
<li><a href="staff_time.php?tab=4" >Staff Timing</a></li>
</ul>
</div>
</div>-->
<?
if($stu_id!='')
{
	
	
?>
	<FORM NAME='frm' METHOD=POST >
        <input type="hidden" name='stu_id' value="<?=$stu_id?>">
        <input type="hidden" name='adate' value="<?=$adate?>">
	<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td class="head" align="center" colspan="2">Modify Calender</td>
	</tr>
	<tr >
        <td>&nbsp;&nbsp;Staff Type</td>
        <td >&nbsp;&nbsp;
        <?php
		$tfdate=explode('-',$adate);
		$adate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
		$ttdate=explode('-',$bdate);
		$bdate=$ttdate[2]."/".$ttdate[1]."/".$ttdate[0];

		$temsql3=execute("select * from staff_calenders where  id=$stu_id");
	while($r=fetcharray($temsql3))
	{
		$editid=$r['id'];
		$classid=$r['staff_typ'];
		$ename=$r['title'];
		$descr=$r['description'];
		$adate=$r['fromdate'];
		$tfdate=explode('-',$adate);
		$adate=$tfdate[2]."/".$tfdate[1]."/".$tfdate[0];
	}        
	
			$semname =fetcharray(execute("select id,name from staff_group where status=1 and id='$classid'"));
			
		?>
        <?=$semname[1]?>&nbsp;&nbsp;<?=$adate?>
        </td>
    </tr>
<input type="hidden" name="editid" value="<?=$editid?>"/>
     <input type="hidden" name='day' value="<?=$day?>">
      <input type="hidden" name='mon' value="<?=$mon?>">
       <input type="hidden" name='yer' value="<?=$yer?>">
    <input type="hidden" name='adate' value="<?=$adate?>">

	<!--  <tr>
	    <td nowrap>&nbsp;&nbsp;Date</td>
	    <td colspan="2" nowrap>&nbsp;
	      <input type="text" readonly name="adate" id="adate2" value="<?$adate1?>">
	      &nbsp;&nbsp; <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
      </tr>-->
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
	  <a href="staff_calnd123.php?adate=<?=$adate?>" class='topictitle1'><input type="button" name="Add New" value="Add New" class="bgbutton">
   </a></div>
</FORM>
	<?php
}

if($_POST['save'])
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	
if($ename)
{
		execute("insert into staff_calenders (staff_typ,username,fromdate,title,description,status,acc_year) values('$sem','$user','$fdate','{$ename}','{$descr}', 1,'$a_year')");
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Added successfully");
		window.opener.location.href='staff_calnd.php?tab=3&adate='+"<?=$adate?>";
		
		</script>
		<?php
		}
		else
		{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Please Enter Title");
		
		</script>
		<?
		}
}
if($action=='' and $stu_id=='') 
{
	?>
        <FORM NAME='frm' METHOD=POST >
        <input type="hidden" name='day' value="<?=$day?>">
        <input type="hidden" name='mon' value="<?=$mon?>">
        <input type="hidden" name='yer' value="<?=$yer?>">
        <input type="hidden" name='adate' value="<?=$adate?>">
<br>
	<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Declare Calender</td>
	</tr>
 	  <tr>
	<td>&nbsp;&nbsp;Staff Type</td>
	<td colspan="2">&nbsp;
	<select name="sem" >
	<?php
	$sql21=execute("select id,name from staff_group where status=1");
		while($r2=fetcharray($sql21))
		{
			if($sem==$r2[0])
			echo "<option value='$r2[0]' selected>$r2[1]</option>";
			else
			echo "<option value='$r2[0]'>$r2[1]</option>";
		}
	
	?> </select><!--&nbsp;<a href="javascript:void(0);" onClick ="OpenWind2('add_staf_ty.php?adate=<?=$adate?>', 'OpenWind2',500,400)">
<img src="button-add.png" align="top" title="Add Leave Type"  height="25" width="25"></a>--></td>
</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;Date</td>
		<td colspan="2" nowrap>&nbsp;
		<input type="text" readonly name="adate" id="adate1" value="<?=$adate?>">&nbsp;&nbsp;
        </td>
		</tr>
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
		  <input type="submit" name="save" value="Save"  class='bgbutton'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </div>

</FORM>
	<?php
}

$vwadtae=explode("/",$adate);
$vwadtae[0];
$vwadtae[1];
$vwadtae[2];
$vwadtae1=$vwadtae[2]."-".$vwadtae[1]."-".$vwadtae[0];
$temsql3=execute("select * from staff_calenders where status='1' and fromdate='$vwadtae1'");
if(mysql_num_rows($temsql3)>=1)
{	
?>
<br>
    <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="5" class="head" align="center">Modify Calender</td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic">Sl.No.</td>
    <td align="center" class="rowpic">Title</td>
    <td align="center" class="rowpic">Staff Type</td>
    <td align="center" class="rowpic">Date</td>
    <td align="center" class="rowpic">Action</td>
  </tr>
  <?
	$inc=1;
	
	while($r=fetcharray($temsql3))
	{
		$yrnamess =fetcharray(execute("select id,name from staff_group where status=1 and id='$r[staff_typ]'"));
		echo "
		<tr height='25'>
			<td align='center'>$inc</td>
			<td nowrap>&nbsp;&nbsp;
			$r[title]</td>
			<td align='center' nowrap>$yrnamess[1]
			</td>
			<td align='center' nowrap>";
			echo date("d-m-Y",strtotime($r['fromdate']));
			echo "</td>
			<td align='center'>
			<a href='staff_calnd123.php?stu_id=$r[id]&adate=$r[fromdate]'>
			Modify</a></td>
			</tr>";
  $inc++;
	}
}
	?>
	</table>
</BODY>
</HTML>