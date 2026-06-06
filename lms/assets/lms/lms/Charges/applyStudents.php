<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='applyStudents.php';
	document.frm.submit();
	
}
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}	
</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");

if($_POST)
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}
else
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$a_year=$_SESSION['AcademicYear'];
}
$charges_group_id=$_POST['charges_group_id'];
$class_section_id=$_POST['class_section_id'];
$sess=$_POST['sess'];
$tablename="charges_student_group";
$sysdate=date("Y-m-d");
if($_POST['open'])
{
	$check=$_POST['check'];
	$studentid=$_POST['studentid'];
	for($i=0;$i<sizeof($studentid);$i++)
	{
		$sql1='';
		$tt=0;
		for($j=0;$j<sizeof($check);$j++)
		{
			if($check[$j]==$studentid[$i])
			$tt=1;
		}
		
		$sql5=execute(" select id from $tablename where charge_group_id='$charges_group_id' and student_id='$studentid[$i]' ");
		if(rowcount($sql5)>0)
		{

			$sql1="update $tablename set status='$tt' where charge_group_id='$charges_group_id' and student_id='$studentid[$i]' ";
						
		}
		else
		{
			if($tt==1)
			{
				$sql1="insert into $tablename(charge_group_id, student_id, status) values('$charges_group_id', '$studentid[$i]', 1)";
			}
		}		
	execute($sql1);	
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Successfully Updated");
	</SCRIPT>
	<?php
}
	

?>		<form name="frm" action="" method="post" >
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Apply Students to Group</td>
    </tr>
     
  <tr>
    <td>&nbsp;&nbsp;School Division</td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------Select-----</option>
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
   <td>&nbsp;&nbsp;Class </td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value='0'>-----Select----</option>
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

  <tr>
  <td height="28">&nbsp;&nbsp;Section</td><td>&nbsp;<select name='class_section_id'  onChange="reload()">
<?
$rs_section=execute("select * from class_section");
echo "<option value=''>--Select--</option>";
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
 <tr>
  <td height="28">&nbsp;&nbsp;Group</td><td>&nbsp;<select name='charges_group_id'  onChange="reload()">
<?
$rs_section=execute("select * from charges_group");
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($charges_group_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[name]</option>";

}
?>
</select>
</td>
  </tr> 
</table>
<br>
<div align="center"><input type="submit" name="open" value="UPDATE" class="bgbutton"></div><br>
  <?php
  	//if($branch=='0')
	//die();
	//if($sem=='0')
	//die();
	//	if($class_section_id=='')
	//die();
   $sql123="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'";
	if($branch!=0)
	{
	 	$sql123.=" and course_admitted=$branch";
	}
	if($sem!=0 and $sem!='')
	{
		$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='-1' and $class_section_id!='')
	{
		$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	 $sql123.=" order by first_name";
	
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
    <td width="10%" class="row3">Sl No.</td>
    <td width="40%" align="center" class="row3">Name</td>
    <td width="20%" align="center" class="row3">Student Id</td>
    <!--<td width="23%" align="center">Action</td>-->
    <td width="7%" align="center" class="row3" nowrap><div id="checkSelect" onMouseOver="this.style.backgroundColor='blue';
this.style.cursor='hand';this.style.color='white'"
onMouseOut="this.style.backgroundColor='';this.style.cursor='default';this.style.color='black'"
onClick="selectMe()" Title="Click to Select Select Students"><b>Select Select</b></div></td>

  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  	$rownameid='status';
	$sql5=execute("select $rownameid from $tablename where charge_group_id='$charges_group_id' and student_id='$r1[id]'");
  $checkiddet=fetchrow($sql5);
  if($checkiddet[0]==1)
  $statuschek='checked';
  else
  $statuschek='';
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    ";
	?>
	  <td align="center">
	<input type="checkbox" name="check[]" value="<?php echo $r1[id]; ?>" <?php echo $statuschek; ?> >
    <input type="hidden" name="studentid[]" value="<?php echo $r1[id]; ?>" >
    </td>
  </tr><?php
$i++;  }
  ?>
  
</table>
				
</form>	
</body>
</html>