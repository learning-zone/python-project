<html>
<head>
<script  LANGUAGE="JavaScript">
function reloadme()
	{
		document.frm.action="enroll.php";
		document.frm.submit();
	}
</script>
<SCRIPT LANGUAGE="JavaScript">
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
<SCRIPT LANGUAGE="JavaScript">
function ReloadMe()
{
	document.frm.action="enroll.php?open=UPDATE";
	document.frm.submit();

}	
</SCRIPT>
</head>
 <?php
	session_start();
	include("../db.php");
	//print_r($_POST);
	$academic_year=$_SESSION['AcademicYear'];
	$subj=$_REQUEST['subj'];
	$idsnames=$_REQUEST['idsnames'];
	$class_section=$_REQUEST['class_section'];
	$sem=$_REQUEST['sem'];
	$grdes=$_POST['grdes'];
	$test=$_POST['test'];

	?>
  <?
  if($sem=='')
	{
$mgl21=fetcharray(execute("select course_year_id from subject_m  where subject_id='$subj'"));
	$sem=$mgl21[0];
	}
if($_REQUEST['open']=='UPDATE')
{
	$check=$_POST['check'];
	$studentid=$_POST['studentid'];
	$arraySize=sizeof($studentid);
	for($i=0;$i<$arraySize;++$i)
	{
		$tt=0;
		$checkSize=sizeof($check);
		for($j=0;$j<$checkSize;++$j)
		{
			if($check[$j]==$studentid[$i])
			$tt=1;
		}
		$sql5=execute(" select sub_sec from student_course where acc_year='$academic_year' and stu_id='$studentid[$i]' and sub='$subj'");
		if(rowcount($sql5)>0)
		{
			if($tt==1)
			{
				
				$sql1="update student_course set `sub_sec`='$class_section' where acc_year='$academic_year' and stu_id='$studentid[$i]' and sub='$subj'";
			}
			else
			{
				$rowcountdet=fetchrow($sql5);
				if($rowcountdet[0]==$class_section)
				{
				$sql1="delete  from student_course  where acc_year='$academic_year' and stu_id='$studentid[$i]' and sub='$subj' ";
				}
			}
		}
		else
		{
			
			if($tt==1)
			{
				$sql1="insert into student_course (`div`, `class`, `sub`, `sub_sec`, `acc_year`, `stu_id`) values('$branch', '$sem', '$subj' , '$class_section','$academic_year', '$studentid[$i]')";
			}
		}	
		
	execute($sql1);	
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated Successfully");
	window.opener.location.href='class_create.php?id=1&sem='+"<?=$sem?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
		
	</SCRIPT>
	<?php
}
	
?>	
<body>
<form Name="frm"  method="post">     
<input type="hidden" name="subj" value="<?=$subj?>"/>
<input type="hidden" name="sem" value="<?=$sem?>"/>
<input type="hidden" name="class_section" value="<?=$class_section?>"/>
<input type="hidden" name="test" value="<?=$test?>"/>
<input type="hidden" name="idsnames" value="<?=$idsnames?>"/>
<table width="35%" border="1" cellspacing="0"  align="center" cellpadding="0">
<tr>
<td align="center">
<fieldset style="border: groove; border-width:1px; width: 150px; align:center;">
<legend><b>Filter</b></legend>
            <?
				
				if($grdes=='1')
				{
					$first='checked';
				}
				else
				{
					$first='checked';
				}
				if($grdes=='2'){
					$second='checked';
				}
				
			?>
        	<p align="left"><input type="radio" name="grdes" value="1" required <?=$first?> onClick="reloadme()">&nbsp;Course Wise</p>
            <p align="left"><input type="radio" name="grdes" value="2" required <?=$second?> onClick="reloadme()">&nbsp;Class wise</p>
        </fieldset></td>
        
        <?
        if($idsnames)
	  {
if($grdes!='2')
{ 
?>
    <td>
    <select name="sem" STYLE="width:175px;height:100px" onClick="reloadme()" multiple>
    <?
    if($sem==''  || $sem=="0")
    $check='selected';
    else
    $check='';
    ?>
    <option value='' <?=$check?>>All</option>
    <?php
    $rs=execute("select year_name,year_id from course_year order by year_id");
    while($r=fetcharray($rs))
    {
		if($sem==$r[year_id])
		{
			echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
		}
		else
		{
			echo "<option value='$r[year_id]'>$r[year_name]</option>";
		}
    }
    ?>
    </select>
    </td>
<?
}
}
?>

        
        <?
		if($grdes=='2')
		{ 
		?>
<td>
<div align='center'>
<fieldset style="border: groove; border-width:1px; width: 150px; align:center;">
<legend><b>Class</b></legend>

<select name="test" STYLE="width:120px;height:80px" multiple onChange="reloadme()">
   <?php
   	if($idsnames)
	  {
	   $rs=execute("select * from class_section a,subject_m b where a.sub=b.subject_id and a.status=1 group by a.id order by b.course_year_id");
	  }
	  else
	  {
    $rs=execute("select * from class_section a,subject_m b where a.grade='$sem' and  b.sub_type=2   and a.sub=b.subject_id and b.course_year_id=a.grade and a.status=1 group by a.id  order by b.course_year_id");
    }
    while($r=fetcharray($rs))
    {
        if($test==$r[id])
        {
            echo "<option value='$r[id]' selected> $r[codename] $r[section_name]</option>";
        }
            else
        {
            echo "<option value='$r[id]'> $r[codename] $r[section_name]</option>";
        }
    }
    ?>
    </select>
    </fieldset>
        </div>
</td>
<?
}
?>
</tr>
</table>
  <?php
 
  if($grdes=='2')
{ 
$savats=execute("select sub_type from subject_m where subject_id='$subj'");
$savats1=fetcharray($savats);

	$sql123.="select a.id,a.student_id,a.first_name,a.last_name,a.admission_id from student_m a,student_course b where b.stu_id=a.id and b.sub_sec='$test' and a.archive='N'  and b.acc_year='$academic_year' ";
	
	 $sql123.=" group by b.stu_id order by a.first_name";
	
	$rs=execute($sql123) or die(mysql_error());

}
else
{
   $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N' and academic_year='$academic_year' ";
	
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by first_name";
	
	$rs=execute($sql123) or die(mysql_error());
}
  ?>
  <br>
<table width="30%" border="1" cellspacing="0"  align="center" cellpadding="0">
<tr>
<td width="100%">
  <div style="overflow: auto;height:400px; width:450px;" align="center">
<table width="100%" border="1" cellspacing="0"  align="center" cellpadding="0">
<tr>
    <td width="10%"  class="head"  nowrap>Sl No.</td>
    <td width="10%" class="head"  align="center"  nowrap>Name</td>
    <td  width="10%" class="head"  align="center" nowrap>Student Id</td>
    <td width="10%" class="head"  align="center" nowrap><div id="checkAll" onMouseOver="this.style.backgroundColor='blue';
this.style.cursor='hand';this.style.color='white'"
onMouseOut="this.style.backgroundColor='';this.style.cursor='default';this.style.color='black'"
onClick="selectMe()" Title="Click to Select all Students"><b>Select All</b></div></td>
    </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
 if($savats1[0]==2)
 {

$sql5=execute("select id from student_course where acc_year='$academic_year' and stu_id='$r1[id]' and sub='$subj' and sub_sec='$test'");
}
else
{
$sql5=execute("select id from student_course where acc_year='$academic_year' and stu_id='$r1[id]' and sub='$subj' and sub_sec='$class_section'");
}
  $checkiddet=fetchrow($sql5);
  if($checkiddet[0]!='' or $checkiddet[0]!=0)
  $statuschek='checked';
  else
  $statuschek='';
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
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
</div>
</td>
  </tr>
  </table>
<br>
<div align="center"><input type="button" name="open" value="UPDATE" class="bgbutton" onClick="ReloadMe()" ></div><br>
</form>
</BODY>
</HTML>
