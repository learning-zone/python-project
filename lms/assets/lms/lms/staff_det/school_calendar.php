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
	
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$a_year=$_SESSION['AcademicYear'];

$sql = execute("SELECT * FROM users WHERE username='$user'") or die(error_description());
$rs=fetcharray($sql);
$UserId=$rs[id];
?>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="school_calendar.php";
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
				document.frm.action="school_calendar.php?save=save";
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
				document.frm.action="school_calendar.php?save=save";
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
	
mysql_query("update announcement_call set status=0 where id='$stu_id'  and acc_year='$a_year'");
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
	<td colspan="5" class="head" align="center">Modify Calendar</td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic">No.</td>
    <td align="center" class="rowpic">Title</td>
    <td align="center" class="rowpic"><?php echo $_SESSION['semname']; ?></td>
    <td align="center" class="rowpic">From Date</td
    >
    <td align="center" class="rowpic">To From</td>
  </tr>
  <?
  
	$inc=1;
	$temsql3=mysql_query("select * from announcement_call where status=1  and acc_year='$a_year' order by todate,fromdate desc"); 
	while($r=mysql_fetch_array($temsql3))
	{
		echo "
		<tr >
			<td align='center'>$inc</td>
			<td align='justify'>&nbsp;&nbsp;
			<a href='school_calendar.php?stu_id=$r[id]'>
			$r[title]</a></td>";
			
			echo "<td align='center'>";
			if($r['grade']=="" OR $r['grade']==0)
				echo "ALL";
			else
			{
				$rs=execute("select * from course_year where year_id='$r[grade]'");
				//$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$r[grade]'");
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r2=mysql_fetch_array($rs);				  
					//if($r2['year_name']=="")
						//echo "ALL";
					//else
						echo " $r2[year_name]";	
				}
			}
			echo "</td>";
			
			echo "<td align='center' nowrap>";
			echo date("d-m-Y",strtotime($r['fromdate']));
			echo "</td><td align='center' nowrap>";
			
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
    <br><div class="diva1" align="center"><a href="school_calendar.php" class='topictitle1'><input type="button" name="Add New" value="Add New" class="bgbutton"></a></div><br>
    <?
}
if($update)
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];
mysql_query("update announcement_call set  fromdate='$fdate', todate='$tdate' ,title='$ename', description='$descr' where id='$stu_id'  and acc_year='$a_year'");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated successfully");
	</script>
	<?php
	
}

if($stu_id!='')
{
	$temsql4=mysql_query("select * from exam_m where id='$stu_id'");
	while($r1=mysql_fetch_array($temsql4))
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
	<td class="head" align="center" colspan="2">Modify Calendar</td>
	</tr>


	<?php
	
	$temsql3=mysql_query("select * from announcement_call where  id=$stu_id  and acc_year='$a_year'");
	while($r=mysql_fetch_array($temsql3))
	{
		$type=$r['type'];
		$ename=$r['title'];
		$descr=$r['description'];
		$adate=$r['fromdate'];
		$bdate=$r['todate'];
		$division=$r['division'];
		$grade=$r['grade'];
		
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
	  <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	  <td>
	  <?php
		if($grade=="" OR $grade==0)
			echo "&nbsp;&nbsp;ALL";
		else
		{
			$rs=execute("select * from course_year where year_id='$grade'");
			for($i=0;$i<rowcount($rs);$i++)
			{
			  $r2=mysql_fetch_array($rs);
			  echo "&nbsp;&nbsp;$r2[year_name] ";			
			}
		}
	  ?>
	  </td>
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
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="school_calendar.php" class='topictitle1'><input type="button" name="Add New" value="Add New" class="bgbutton">
   </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="school_calendar.php?action=mod" class='topictitle1'><input type="button" name="Modify" value="Cancel" class="bgbutton" ></a></div>
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
	
	$sem=$_POST['sem'];
	if($sem)
	{
		while( list(,$value) = each($sem))
		{
			
			if($branch==0)
				$branch="0";
			
			$sql="insert into announcement_call (`type`, `fromdate`, `todate`, `title`, `description`, `division`, `grade`, `status`,`acc_year`) values ('$type', '$fdate', '$tdate', '$ename', '$descr', '$branch', '$value',1,'$a_year')";
			execute($sql);
		}
	}
	else
	{
		$value=0;
		$sql="insert into announcement_call (`type`, `fromdate`, `todate`, `title`, `description`, `division`, `grade`, `status`,`acc_year`) values ('$type', '$fdate', '$tdate', '$ename', '$descr', '$branch', '$value',1,'$a_year')";
			execute($sql);
		
	}
?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Added Successfully");
		</script>
<?php	
	$temsql=mysql_query("select * from announcement_call where title='$ename' and class='$FromYear' and fromdate='$fdate' and todate='$tdate' and acc_year='$a_year'");
	if(mysql_num_rows($temsql)>0)
		echo "<font color='#FF0000'>Duplicate entry not allowed</font> <br>";
	else
	{
		
			
		//mysql_query("insert into school_calendar (type,fromdate,todate,title,description,division,grade) values('$type','$fdate','$tdate','$ename','$descr','$branch','$sem')");
?>
		<SCRIPT LANGUAGE="JavaScript">
		// alert("Added successfully");
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
	<td colspan="2" class="head" align="center">Declare Calendar</td>
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
		<input type="text" readonly name="adate" id="adate1" value="<?=$adate?>">&nbsp;&nbsp;
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
			<input type="text" readonly name="bdate" id="bdate1" value="<?=$bdate?>">&nbsp;&nbsp;
			<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
			</td>
			</tr>
		<?php
		}
		?>
		<tr>
		<td>&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td>&nbsp;&nbsp;<select name="branch" onChange="go()">
			<option value="0">------All-----</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=mysql_fetch_array($rs);

						if($branch==$r[course_id])
						{
							?>
							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
							<?php
						}
						else
						{
							?>
							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
							<?php
						}
					}
				?>
			</select>
			</td>

		</tr>
		<tr>
		<td>&nbsp;<?php echo $_SESSION['semname']; ?></td>
		<td>&nbsp;&nbsp;<select name="sem[]" style="width:120px;height:90px" multiple>
			<!-- <option value='0'>--SELECT--</option> -->
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
			?>
			</select>

		</td>
		</tr>
<!--
		<tr>
		<td height="28">&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="go()">
		<?
		$rs_section=execute("select * from class_section");
		echo "<option value='-1'>--Select--</option>";
		for($i=0;$i<rowcount($rs_section);$i++)
		{
		$r_section=fetcharray($rs_section,$i);
		if($class_section_id==$r_section[id])
		echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";
		else
		echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

		}
		?>
		</select>
		</td>
		</tr>
-->
        <tr>
		<td nowrap>&nbsp;&nbsp;Title</td>
		<td colspan='2' nowrap>&nbsp;
		<input type="text" name="ename" id="ename" value="" size='40' >&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
        <tr>
		<td nowrap>&nbsp;&nbsp;Description</td>
		<td colspan='2' nowrap>&nbsp;
		<textarea name="descr" rows="3" cols="50"></textarea></td>
		</tr>
		
		</table>
	<br>
	  <div align="center">
		<input class="bgbutton" type="button" onClick="addnew()" name="save" value="SAVE">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="school_calendar.php?action=mod" class='topictitle1'><input type="button" name="Modify" value="Modify" class="bgbutton" ></a>
	  </div>

</FORM>
	<?php
}
?>

</BODY>
</HTML>