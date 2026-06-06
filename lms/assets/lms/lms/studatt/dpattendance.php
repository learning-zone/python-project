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
	document.frm.action='dpattendance.php';
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
<form name="frm" action="" method="post">
<?php
	session_start();
	require("../db.php");
	$user=$_SESSION['user'];
if(!$_POST and !$_REQUEST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];	
}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}
	$subject=$_POST['subject'];
	$examname=$_POST['examname'];
	$accyeardet=$temp_year_detalis;
	$tablename="satt_".$branch."_".$sem;
	$sysdate=date("Y-m-d");

$class_section_id=$_POST['class_section_id'];
//update
if($_POST['open'])
{
	$check=$_POST['check'];
	$studentid=$_POST['studentid'];
	$sub_id=$_POST['sub_id'];
	for($i=0;$i<sizeof($studentid);$i++)
	{
		$tt=0;
		for($j=0;$j<sizeof($check);$j++)
		{
			if($check[$j]==$studentid[$i])
			$tt=1;
		}
		$sql5=execute(" select id from $tablename where satt_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and acc_year='$accyeardet' and sub_id='$sub_id'");
		if(rowcount($sql5)>0)
		{
			$sql1="update $tablename set present='$tt' where satt_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and acc_year='$accyeardet' and sub_id='$sub_id'";		
		}
		else
		{
			$sql1="insert into $tablename(satt_date, stu_id, sec, present, acc_year, sub_id) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$accyeardet', '$sub_id')";
			
		}		
	execute($sql1);	
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Attendance Updated Successfully");
	</SCRIPT>
	<?php
}
//end
$sql21=execute("select a.course_id, a.year_id,	a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID=b.S_ID");
while($r12=fetcharray($sql21))
{
	$branch1=$r12[0];
	$sem1=$r12[1];
	$class_section_id1=$r12[2];
}
if(rowcount($sql21)==0)
{
	echo "<blink><b><font color='red'>Only class teacher can Enter Marks  !!!!</font></blink></b><br>";
	die();
}
?>		<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Add Attendance</td>
    </tr>
     
  <tr>
    <td>&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------Select-----</option>
				<?php
					$sql="select a.course_id,a.coursename from course_m a where a.course_id='$branch1'";
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
   <td>&nbsp;<?php echo $_SESSION['semname']; ?></td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value='0'>-----Select----</option>
			<?php		
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b,staff_rights e,users f where a.head_id=b.head_id and b.course_id='$branch'  and a.year_id=e.year_id and  f.username='$user' and e.StaffID=f.S_ID group by e.year_id");
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
  <td height="28">&nbsp;Subject</td><td>&nbsp;<select name='subject'  onChange="reload()">
<?
$rs_section=execute("select e.id, a.subject_name,  b.section_name from subject_m a,class_section b, staff_rights e,users f  where f.username='$user' and e.StaffID=f.S_ID and e.year_id='$sem'  and a.subject_id=e.subject_id and b.id=e.class_section_id group by e.class_section_id , e.subject_id ");
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($subject==$r_section[0])
	echo "<option value='$r_section[0]' selected>$r_section[section_name]-$r_section[1]</option>";
	else
	echo "<option value='$r_section[0]'>$r_section[section_name]-$r_section[1]</option>";

}
?>
</select>
</td>
  </tr>

</table>
<?php  

$rs1=execute("select sub_id from exam_m where id='$examname'"); 
while($ner1=fetcharray($rs1))
{
	$sub_id=$ner1['sub_id'];
}
$newsubid=explode(',',$sub_id);
   $rs=execute("select subject_id , class_section_id from staff_rights where id='$subject'"); 
while($ner=fetcharray($rs))
{
	$sel_subject_id=$ner['subject_id'];
	$sel_class_section_id=$ner['class_section_id'];	  
}
echo "	<input type='hidden' name='sub_id' value='$sel_subject_id'>
		<input type='hidden' name='class_section_id' value='$sel_class_section_id'>";
$flag=0;
for($i=0;$i<sizeof($newsubid);$i++)
{
	if($newsubid[$i]==$sel_subject_id)
	$flag=1;	
}

  if($subject=='-1')
  die();
    if($subject=='')
  die();

  $sql123.="select a.id, a.student_id, a.first_name, a.last_name from student_m a,student_course b where a.id is not null and a.archive='N' and a.id=b.stu_id and b.acc_year='$temp_year_detalis' and  b.sub='$sel_subject_id' and b.sub_sec='$sel_class_section_id'";
	if($branch!=0)
	{
	$sql123.=" and a.course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql123.=" and a.course_yearsem=$sem";
	}	
	$sql123.=" group by b.stu_id order by a.gender desc,a.first_name ";
	$rs=execute($sql123) or die(mysql_error());
  ?><br>
<div align="center"><input type="submit" name="open" value="UPDATE" class="bgbutton" ></div><br>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
    <td width="10%" class="head">Sl No.</td>
    <td width="40%" align="center" class="head">Name</td>
    <td width="20%" align="center" class="head">Student Id</td>
    <!--<td width="23%" align="center">Action</td>-->
    <td width="7%" align="center" class="head" nowrap><div id="checkAll" onMouseOver="this.style.backgroundColor='blue';
this.style.cursor='hand';this.style.color='white'"
onMouseOut="this.style.backgroundColor='';this.style.cursor='default';this.style.color='black'"
onClick="selectMe()" Title="Click to Select all Students"><b>Select All</b></div></td>

  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
$sql5=execute("select present from $tablename where satt_date='$sysdate' and stu_id='$r1[id]' and sec='$class_section_id' and acc_year='$accyeardet' and sub_id='$sel_subject_id'");
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
