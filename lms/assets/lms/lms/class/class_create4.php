<?php
session_start();
include("../db.php");
//print_r($_POST);
//print_r($_GET);

$academic_year=$_SESSION['AcademicYear'];
if($_GET)
{
	$sem=$_GET['sem'];	
	$subject=$_GET['subject'];	
	$section=$_GET['section'];
}
if($_POST)
{		
	$sem=$_POST['sem'];
	$subject=$_POST['subject'];
	$section=$_POST['section'];
	$sub_teacher=$_POST['sub_teacher'];
	$class_teacher=$_POST['class_teacher'];
	$home_teacher=$_POST['home_teacher'];
}
$type=$_REQUEST['type'];
if($type=="secl")
{
	$section='';
}
?>

<?
if($_POST['save'])
{
			
	if($sem=='')
	{
$mgl21=fetcharray(execute("select course_year_id from subject_m  where subject_id='$subject'"));
	$sem=$mgl21[0];
	}
	$subtype=fetcharray(execute("select sub_type from subject_m  where subject_id='$subject'"));

	
		//$Sql66=execute("select id from student_integrat where school_div='$branch' and acc_year='$acc_year' and sec='$class_section_id' and class='$id' and sports_id='$staffcoach' and coach_id='$coacid'");
//		if(rowcount($Sql66)>0)
//		{
//
//			$sql33="update student_integrat set `sports_id`='$staffcoach' ,`subtype_id`='$subtypes' , `batch_id`='$batchs' ,`coach_id`='$coacid' where school_div='$branch' and acc_year='$acc_year' and sec='$class_section_id' and class='$id' and sports_id='$staffcoach'";
//			execute($sql33);
//		}
//		else
//		{
	
			execute("INSERT INTO `all_teachers` (`class`, `user`, `sub`, `section`, `class_teac`, `sub_teac`, `home_teac`,`sub_type`,`acc_year`) VALUES ('$sem', '$user', '$subject','$section','$class_teacher','$sub_teacher', '$home_teacher','$subtype[0]','$academic_year')");
		//}
		
	
	 ?>
         <script language="javascript">
		 alert("Inserted Sucessfully");
         </script>
         <?php
}
?>
<html>
<head>
<script type="text/javascript">
	function Reload(token)
	{
	document.frm.action="class_create.php?sem="+token;
	document.frm.submit();
	}
</script>

<script type="text/javascript">
	function ReloadSubject(tokenSec)
	{
	document.frm.action="class_create.php?type=secl";	
	document.frm.submit();
	}
</script>

<script type="text/javascript">
	function reloadme()
	{
	document.frm.action="class_create.php";
	document.frm.submit();
	}
</script>

<Script language="JavaScript">	
	function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script>

<Script language="JavaScript">	
	function OpenWind3(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
</head>
<body>

<form Name="frm" action="class_create.php" method="post">   
<input type="hidden" name="sem" value="<?=$sem?>"/>
<input type="hidden" name="subject" value="<?=$subject?>"/>
<!--<input type="hidden" name="section" value="<?=$section?>"/>
--><input type="hidden" name="home_teacher" value="<?=$home_teacher?>"/>
<input type="hidden" name="class_teacher" value="<?=$class_teacher?>"/>
<input type="hidden" name="sub_teacher" value="<?=$sub_teacher?>"/>

<table class='forumline' align='center' border="0" width="100%">
<tr><td Class="head" align='center' colspan="4">Create Class</td></tr>
<tr>
 <td valign="top" width="20%" nowrap><b>Grade</b><br>
    <select name="sem" STYLE="width:175px;height:80px" onClick="Reload(this.value)" multiple>
    <?
    if($sem=='')
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
    &nbsp;
    <a href="javascript:void(0);" onClick ="OpenWind3('add_grade.php?', 'OpenWind3',800,500)">
    <img src="button-add.png" align="top" title="Add Grade"></a>&nbsp;
    </td>
     <?
	if($subject!='')
        {
	?>
    <td valign="top" width="15%"  nowrap>
    <b>Section</b><br>
    <select name="section"  onChange="reloadme()" multiple STYLE="width:150px;height:80px">
		<?
        $sect12.="select id,section_name from class_section where sub='$subject'"; 
		if($sem!='')
		{
		$sect12.="  and grade='$sem'";
		}
		$rs_section=execute($sect12);
		
        for($i=0;$i<rowcount($rs_section);$i++)
        {
            $r_section=fetcharray($rs_section,$i);
            if($section==$r_section[0])
            echo "<option value='$r_section[0]' selected>$r_section[1]</option>";
            else
            echo "<option value='$r_section[0]' >$r_section[1]</option>";
        
        }
        ?>
</select>
</td>
<td valign="top"  nowrap>
   <br> &nbsp;
    <a href="javascript:void(0);" onClick ="OpenWind3('add_section.php?subj=<?=$subject?>&sem=<?=$sem?>&class_section=<?=$section?>', 'OpenWind3',500,400)">
    <img src="button-add.png" align="top" title="Add Section"></a>
		<?
        }
		if($subject=='')
        {
			?>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <?
		}

		if($section!='' && $subject!='')
        {
        ?>
      <br> 
      <br>&nbsp;
    <a href="javascript:void(0);" onClick ="OpenWind2('enroll.php?sem=<?=$sem?>&subj=<?=$subject?>&class_section=<?=$section?>', 'OpenWind3',470,500)">
   <input type='button' name='enroll' value='Enroll' class='bgbutton' title="Enroll"></a>
		<?
        }
        ?> 
        </td> 
        
<td width="100%">
<?
$view_nulls=fetcharray(execute("select id from student_course where acc_year='$academic_year' and sub='$subject' and sub_sec='$section'"));
if($view_nulls[0]!='')
{
?>
<div align="center"><b>Enrolled Student List</b></div>
<div style="overflow: auto;height:100px; width:550px;" align="center">
    <table align='center' border="1" width="100%">
    <tr>
    <td align='center' Class="head"  nowrap>Name</td>
    <td align='center' Class="head"  nowrap>Student Id</td>
    <td align='center' Class="head"  nowrap>Section</td>
    <td align='center' Class="head"  nowrap>Subject</td>
     <td align='center' Class="head"  nowrap>Elective</td>
    <td align='center' Class="head"  nowrap>Subject Type</td>
    </tr>
    <?php
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
  ?>
     <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 

$sql5=execute("select id,sub,sub_sec from student_course where acc_year='$academic_year' and stu_id='$r1[id]' and sub='$subject' and sub_sec='$section'");
  $checkiddet=fetchrow($sql5);
  if($checkiddet[0]!='' or $checkiddet[0]!=0)
  {
	  	$subjct_info=fetchrow(execute("select subject_name,sub_type,elective from subject_m where subject_id='$subject'"));
		$section_info=fetchrow(execute("select section_name from class_section where sub='$subject'"));
		$subjct_type=fetchrow(execute("select subtype_name from subjecttype where subtype_id='$subjct_info[1]'"));
  ?>
 <tr>
    <td nowrap>&nbsp;<?=$r1[first_name]?>&nbsp;<?=$r1[last_name]?></td>
    <td nowrap align='center'>&nbsp;<?=$r1[student_id]?></td>
	<td align="center"><?=$section_info[0]?></td>
    <td align="center"><?=$subjct_info[0]?></td>
    <td align="center"><?=$subjct_info[2]?></td>
	<td align="center"><?=$subjct_type[0]?></td>
  </tr><?php
  }
$i++;  
}
  ?>
    </table>
    </div>
    <?
}
	?>
</td>  
    </tr>
<tr>
 <td valign="top" width="20%" nowrap><b>Subject</b><br>
    <select name="subject" STYLE="width:175px;height:400px" onClick="ReloadSubject(this.value)" multiple>
    <?
		if($sem=="")
		{
        	$rs_sub=execute("select * from subject_m a,course_year b where a.course_year_id=b.year_id and a.status=1 group by a.subject_id order by year_id");
		}
		else
		{
        	$rs_sub=execute("select * from subject_m a,course_year b where a.course_year_id='$sem' and b.year_id='$sem' and a.status=1 group by a.subject_id order by b.year_id");
		}
        while($r_sub=fetcharray($rs_sub))
        {
            if($subject==$r_sub[subject_id])
            	echo "<option value='$r_sub[subject_id]' selected>$r_sub[subject_name]-$r_sub[year_name]</option>";
            else
            	echo "<option value='$r_sub[subject_id]'>$r_sub[subject_name]-$r_sub[year_name]</option>";
		}
    ?>
    </select>
    &nbsp;
    <?
	if($subject!='')
	{
	?>
    <a href="javascript:void(0);" onClick ="OpenWind3('add_sub.php?grades=<?=$sem?>&subj=<?=$subject?>&class_section=<?=$section?>', 'OpenWind3',800,500)">
    <img src="button-add.png" align="top" title="Add Subject"></a>&nbsp;
    <?
	}
	?>
    </td>
    <td valign="top" nowrap>
    <?
	if($section!='')
	{
		$class_teacher='';
		$sub_teacher='';
		$home_teacher='';
		
		$vasteac=execute("select class_teac,sub_teac,home_teac 	from all_teachers where sub='$subject' and section='$section' and acc_year='$academic_year'");
		while($vateacs=fetcharray($vasteac))
		{
			$class_teacher=$vateacs[0];
			$sub_teacher=$vateacs[1];
			$home_teacher=$vateacs[2];
		
		}
	?>
    <b>Apply Subject Teacher</b>&nbsp;<br><select name="sub_teacher" STYLE="width:150px;">
    	<option value="">Subject Teacher</option>
	<?php
	
	$dd1=execute("select a.id, a.f_name,a.s_name from staff_det a,users b where  b.srid=a.id order by a.f_name");
	$countBR1=rowcount($dd1);
	for($i1=0;$i1<$countBR1;$i1++)
	{
		$rBR1 = fetcharray($dd1);
		if($sub_teacher==$rBR1[id])
		{
			echo("<option value='$rBR1[id]' selected>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
			else
		{
			echo("<option value='$rBR1[id]'>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
	}
	?>
	</select>
    <?
	}
	?>
    <br>
    <br>
     <?
	if($section!='')
	{
	?>
    <b>Apply Class Teacher</b>&nbsp;<br><select name="class_teacher" STYLE="width:150px;">
        	<option value="">Class Teacher</option>
	<?php
	
	$dd1=execute("select a.id, a.f_name,a.s_name from staff_det a,users b where  b.srid=a.id order by a.f_name");
	$countBR1=rowcount($dd1);
	for($i1=0;$i1<$countBR1;$i1++)
	{
		$rBR1 = fetcharray($dd1);
		if($class_teacher==$rBR1[id])
		{
			echo("<option value='$rBR1[id]' selected>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
			else
		{
			echo("<option value='$rBR1[id]'>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
	}
	?>
	</select>
    <br>
    <br>
    <b>Apply Homeroom Teacher</b>&nbsp;<br><select name="home_teacher" STYLE="width:150px;">
        	<option value="">Home Teacher</option>
	<?php
	
	$dd1=execute("select a.id, a.f_name,a.s_name from staff_det a,users b where  b.srid=a.id order by a.f_name");
	$countBR1=rowcount($dd1);
	for($i1=0;$i1<$countBR1;$i1++)
	{
		$rBR1 = fetcharray($dd1);
		if($home_teacher==$rBR1[id])
		{
			echo("<option value='$rBR1[id]' selected>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
			else
		{
			echo("<option value='$rBR1[id]'>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
	}
	?>
	</select>
    <?
	}
	?>
    </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
</tr>
</table>
<br>
<div align='center'><input type='submit' name='save' value='Submit' class='bgbutton'></div>

</form>
</BODY>
</HTML>
