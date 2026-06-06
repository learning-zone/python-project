<?php

session_start();
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];

?>
<HTML>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
<title>Newsletter
</title>
</head>
<?php

$sql=execute("select a.year_id, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID order by a.course_id, a.year_id, a.subject_id");
while($r12=fetcharray($sql))
{
	$yearname1[]=$r12[0];
	$sectionname[]=$r12[1];

}

if(!$_POST and !$_REQUEST)
{
	$branch=$_SESSION['branch'];	// division
	$sem=$_SESSION['sem'];			// class / grade
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
	$caption=$_REQUEST['caption'];
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
	$caption=$_POST['caption'];
	$type=$_POST['type'];
	$import_file=$_POST['import_file'];
}
$date1 = date("d/m/Y");
$sql = execute("SELECT * FROM users WHERE username='$user'") or die(error_description());
$rs=fetcharray($sql);
$UserId=$rs[id];
?>
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="class_newsletter.php";
	document.frm.submit();
}

function addnew()
{
		
		//alert("Save");
		
		// var tval=document.getElementById("type").value;
		// if(tval==1)
		{
			var adate=document.getElementById("import_file").value;
			
			var caption=document.getElementById("caption").value;
			if(adate=='' || caption=='')
			{
				if(caption=='' && adate!='')
					var msg="Enter the Title ";
				if(caption!='' && adate=='')
					var msg="Upload the File ";
				if(adate=='' && caption=='')
					var msg="Upload the file and give a Caption";
				
				alert(msg);
			}
			else
			{
				document.frm.action="class_newsletter.php?save=save";
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
	execute("update newslatter_class_call set status=0 where id='$editid' ");
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
	
	
	$target_path = "newsletter/";
	$fext=basename($_FILES['import_file']['name']);
	$fext1=explode(".",$fext);
	$fexn=$newname.".".$fext1[1];
	$target_path = $target_path.$fext;

	
	execute("update newslatter_class_call set caption='$caption' where id='$editid' ");
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
		$caption=$r1['exam_name'];
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
	<FORM NAME='frm' METHOD='POST'>
    <input type="hidden" name='stu_id' value="<?=$stu_id?>">
	<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td class="head" align="center" colspan="2">Modify Newsletter  </td>
	</tr>
	<tr >
        <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
        <td >&nbsp;&nbsp;
        <?php
	
		$temsql3=execute("select * from newslatter_class_call where  id=$stu_id");
	while($r=fetcharray($temsql3))
	{
		$editid=$r['id'];
		$classid=$r['class'];
		$type=$r['type'];
		$caption=$r['caption'];
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
<!--
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
-->
	  <tr>
	    <td nowrap>&nbsp;&nbsp;Caption</td>
	    <td colspan='2' nowrap>&nbsp;
	      <input type="text" name="caption" id="caption" value="<?php echo $caption; ?>" size='40' >
	      &nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
<!--
	  <tr>
	    <td nowrap>&nbsp;&nbsp;Description</td>
	    <td colspan='2' nowrap>&nbsp;
	      <textarea name="descr" rows="3" cols="50"><?php echo $descr; ?></textarea></td>
      </tr>
-->
	  </table>
<br>
	<div align="center">
		<input class="bgbutton" type="submit" name="update" value="UPDATE">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="bgbutton" type="submit" name="delete" value="DELETE">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="class_newsletter.php" class='topictitle1'>
	  <input type="button" name="Add New" value="Add New" class="bgbutton">
	</a>
   </div>
</FORM>
	<?php
}	// end of update

if($save=='save')
{
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
	$ttdate=explode('/',$bdate);
	$tdate=$ttdate[2]."-".$ttdate[1]."-".$ttdate[0];

	
	$yearname2=$_POST['yearname2']; 
	$sectname2=$_POST['sectname2'];
	$secid=$sectname2[$sem];
	$gradeid=$yearname2[$sem];
	

	/*
		$name = $_FILES['import_file']['name'];
		$tmp_name = $_FILES['import_file']['tmp_name'];
		$type = $_FILES['import_file']['type'];
		$size = $_FILES['import_file']['size'];		
		$file = $_FILES['import_file']['tmp_name'];
		
	*/
	$newname=date("YmdHis");
	$target_path = "newsletter/";
	$fext=basename($_FILES['import_file']['name']);
	$fext1=explode(".",$fext);
	$fexn=$newname.".".$fext1[1];
	$target_path = $target_path.$fexn;

	if(move_uploaded_file($_FILES['import_file']['tmp_name'], $target_path))
		$file_loc = $target_path;
	else
		$file_loc ='';
	

	// $file_loc="newsletter/".$name;
		//execute("insert into newslatter_class_call (`username`,`status`,`division`,`grade`,`file_name`,`caption`) values('$user', 1, '$branch', '$sem', '$file_loc', '$caption')");
		
	$sem=$_POST['sem'];
	if($sem)
	{
		
		while( list(,$value) = each($sem))
		{
			//execute("insert into newslatter_class_call (`username`,`status`,`division`,`grade`,`file_name`,`caption`) values('$user', 1, '$branch', '$value', '$secid', '$file_loc', '$caption')");
			
			$sql="insert into newslatter_class_call (`username`,`status`,`grade`,`file_name`,`caption`) values ('$user', 1,'$value','$file_loc', '$caption')";
			execute($sql);
		}
	}
	if($branch==0)
	{
		//$value=0;
		$sql="insert into newslatter_class_call (`username`,`status`,`grade`,`file_name`,`caption`) values ('$user', 1, '$sem','$file_loc', '$caption')";
			execute($sql);
	
	}
		
	?>
		<SCRIPT LANGUAGE="JavaScript">
			alert("Added successfully");
		</script>
	<?php
}
if($action=='' and $stu_id=='') 
{
	?>
	<FORM NAME='frm' METHOD='POST' ENCTYPE='multipart/form-data'>
	<br>
	<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" class="head" align="center">Create Newsletter</td>
	</tr>

    <?php
		if($type==2)
		$type2="selected";
		else
		$type1='selected';
		
	?>
<!--
 	  <tr>
     <?php
			for($j=0;$j<sizeof($yearname1);$j++)
			{	  
				echo "<input type='hidden' name='yearname2[]' value='$yearname1[$j]'>
				<input type='hidden' name='sectname2[]' value='$sectionname[$j]'>";
			}
	?>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; 
		?></td>
	<td>&nbsp;
	<?php
		//echo "sem = $sem";
	?>
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

	?> </select> </td>
	</tr>
-->

		<tr>
		<td>&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td>&nbsp;<select name="branch" onChange="go()">
			<option value="0">--ALL--</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=fetcharray($rs);

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
		<?php
			if($branch=="")
			{
				$branch=0;
			}
			else
			{
		?>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
		<td>&nbsp;<select name="sem[]" multiple size="7">
			<!-- <option value='0'>-----Select----</option>	-->
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
		<?php
			}
		?>
		</tr>

<!--
    <tr>
        <td>&nbsp;&nbsp;Type</td>
        <td >&nbsp;&nbsp;<select name="type" id="type" onChange="go()">
                <option value="1" <?php echo $type1; ?>>Single Day</option>
                <option value="2" <?php echo $type2; ?>>Multiple Day</option>
            </select>
        </td>
	</tr>
-->

<!--
		<tr>
		<td nowrap>&nbsp;&nbsp;Date</td>
		<td colspan="2" nowrap>&nbsp;
		<input type="text" readonly name="adate" id="adate1" value="">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
-->

<!--
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
-->
		<tr>
		<td nowrap>&nbsp;&nbsp;File</td>
		<td colspan='2' nowrap>
		<input  type='FILE' name='import_file' id='import_file'>
		</td>
		</tr>
        <tr>
		<td nowrap>&nbsp;&nbsp;Caption</td>
		<td colspan='2' nowrap>
		<input type="text" name="caption" id="caption" value="<?=$caption?>">&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		</tr>
<!--       
	   <tr>
		<td nowrap>&nbsp;&nbsp;Description</td>
		<td colspan='2' nowrap>&nbsp;
		<textarea name="descr" rows="3" cols="50"></textarea></td>
		</tr>
-->	
	</table>
   	<br>
	  <div align="center">
		<input class="bgbutton" type="button" onClick="addnew()" name="save" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </div>

</FORM>
	<?php
}
?>
<br>
    <table  class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="6" class="head" align="center">Edit Newsletter</td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic" nowrap="nowrap">No.</td>
    <td width="10%" align="center" class="rowpic" nowrap="nowrap">Action</td>
    <!-- <td align="center" class="rowpic">Contents</td> -->
    <td align="center" class="rowpic">Download</td>
    <td align="center" class="rowpic">Caption</td>
    <!-- <td align="center" class="rowpic"><?php echo $_SESSION['branchname']; ?></td>	-->
    <td align="center" class="rowpic"><?php echo $_SESSION['semname']; ?></td>
  </tr>
  <?
	$inc=1;
	$temsql3=execute("select * from newslatter_class_call where status=1 and username='$user'");
	while($r=fetcharray($temsql3))
	{
		echo "<tr height='25'>";
			echo "<td align='center'>$inc</td>";
			echo "<td align='center' nowrap>
			<a href='class_newsletter.php?stu_id=$r[id]' title='Click here to Edit'>
			Edit</a></td>";
			
			$temppath=$r['file_name'];
			// echo "<td><iframe src='http://docs.google.com/gview?url=http://demo.myschoolone.com/renew/Calendar/$temppath&embedded=true' style='width:480px; height:320px;' frameborder='0'></iframe></td>";
			
			echo "<td align='center' nowrap>&nbsp;&nbsp;";
			
			$file_name=explode("/",$r[file_name]);
			echo "<a href='$r[file_name]' title='Click here to Download the file'>Download</a>";
			
			//echo date("d-m-Y",strtotime($r['fromdate']));
			echo "</td>";
		echo "<td  nowrap>&nbsp;&nbsp;$r[caption]</td>";
		
		/*
			
			echo "<td align='center' nowrap>$r[division]</td>";		// branch
			echo "<td align='center' nowrap>$r[grade]</td>";		// grade sem
		*/
		
		/*
				echo "<td align='center'>";
				if($r['division']=="" OR $r['division']==0)
				{
					echo "&nbsp;&nbsp;ALL";
				}
				else
				{
					$rs=execute("SELECT * FROM course_m where course_id='$r[division]'");
					while($r1=fetcharray($rs))
					{
						echo " $r1[coursename] ";
					}
				}
				echo "</td>";
			*/
				echo "<td >&nbsp;&nbsp;";
				if($r['grade']=="" OR $r['grade']==0)
				{
					echo "&nbsp;&nbsp;ALL";
				}
				else
				{
					$rs=execute("select * from course_year where year_id='$r[grade]'");
					//$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$r[grade]'");
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r2=fetcharray($rs);
					  echo " $r2[year_name] ";			
					}
				}
				echo "</td>";
			
			
			/*
			if($r[todate]=='0000-00-00')
			{
				echo date("d-m-Y",strtotime($r['fromdate']));
			}
			else
				echo date("d-m-Y",strtotime($r['todate']));
			*/
			
			echo "</tr>";
  $inc++;
	}

/*
ALTER TABLE `newslatter_class_call` ADD `file_name` VARCHAR( 255 ) NULL ,
ADD `caption` VARCHAR( 255 ) NULL 
*/

/*
INSERT INTO `links` (`module`, `submodule`, `linkname`, `linkpath`, `id`, `parameter`, `Display_name`) VALUES ('Newsletter', 'Newsletters', 'View Newsletters', '/renew/Calendar/view_newsletter.php', NULL, NULL, 'View Newsletters'), ('Newsletter', 'Newsletters', 'Create Newsletter', '/renew/Calendar/class_newsletter.php', NULL, NULL, 'Create Newsletter');

INSERT INTO `links_p` (`module`, `submodule`, `linkname`, `linkpath`, `id`, `parameter`, `Display_name`) VALUES ('Parents Web', 'Reports', 'View Newsletters', '/renew/Calendar/view_newsletter.php', NULL, NULL, 'View Newsletters');

*/

/*

INSERT INTO `thebpm_bpm`.`modules` (
`module` ,
`id`
)
VALUES (
'Newsletter', NULL
);

*/


/*

INSERT INTO `thebpm_bpm`.`submodules` (
`module` ,
`submodule` ,
`id`
)
VALUES (
'Newsletter', 'Newsletters', NULL
);

*/
	
/*
INSERT INTO `thebpm_bpm`.`links` (`module`, `submodule`, `linkname`, `linkpath`, `id`, `parameter`, `Display_name`) VALUES ('Main', 'Main', 'Newsletter', '/renew/menu/newsletter.php', NULL, NULL, 'Newsletter');
*/
?>
	</table>
</BODY>
</HTML>