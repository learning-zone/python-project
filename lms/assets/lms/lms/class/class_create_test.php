<?php
session_start();
include("../db.php");

echo "<pre>";
//print_r($_GET);
print_r($_POST);
echo "</pre>";

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
	$save=$_POST['save'];
	$iflag=$_POST['iflag'];
	$subject=$_POST['subject'];
	$section=$_POST['section'];
	$sub_teacher=$_POST['sub_teacher'];	
	$home_teacher=$_POST['home_teacher'];
	$class_teacher=$_POST['class_teacher'];
	
}
$type=$_REQUEST['type'];
if($type=="secl")
{
	$section='';
}

if($_POST)
{
	$prm=$_POST['prm'];
	$bid=$_POST['bid'];
	$prd=$_POST['prd'];
	$day=$_POST['day'];
	$act=$_POST['act'];
	$rsid=$_POST['rsid'];
	$semid=$_POST['sem'];
	$secid=$_POST['section'];
	$hallno=$_POST['hallno'];
	$subcode=$_POST['subcode'];
	$subname=$_POST['subname'];
	$head_id=$_POST['head_id'];

}

//$prm=$semid=$secid=1;

if($_POST['save'])
{
	if($subject!='')
	{
		if($section!='')
		{
			if($sub_teacher!='' || $class_teacher!='' || $home_teacher!='')
			{
				if($sem=='')
				{
					$mgl21=fetcharray(execute("select course_year_id from subject_m  where subject_id='$subject'"));
					$sem=$mgl21[0];
				}
					$subtype=fetcharray(execute("select sub_type from subject_m  where subject_id='$subject'"));
					$Sql66=execute("select id from all_teachers where  acc_year='$academic_year' and section='$section' and class='$sem'");
				if(rowcount($Sql66)>0)
				{
				echo "update all_teachers set `sub_teac`='$sub_teacher',home_teac='$home_teacher',sub_teac2='$class_teacher' where acc_year='$academic_year' and section='$section' and class='$sem'";
					//$sql33="update all_teachers set `sub_teac`='$sub_teacher',home_teac='$home_teacher',sub_teac2='$class_teacher' where acc_year='$academic_year' and section='$section' and class='$sem'";
					execute($sql33);
				}
				else
				{
					//execute("INSERT INTO `all_teachers` (`class`, `user`, `sub`, `section`, `sub_teac2`, `sub_teac`, `home_teac`,`sub_type`,`acc_year`) VALUES ('$sem', '$user', '$subject','$section','$class_teacher','$sub_teacher', '$home_teacher','$subtype[0]','$academic_year')");
				}
			}
			else
			{
			?>
			<script type="text/javascript">
			alert("Please Select Faculty!");
			</script>
			<?
			}
		}
		else
		{
		?>
		<script type="text/javascript">
		alert("Please Select Section!");
		</script>
		<?
		}
	}
	else
	{
	?>
	<script type="text/javascript">
	alert("Please Select Subject!");
	</script>
	<?
	}	
}
?>
<html>
<head>
<script type="text/javascript">
	function Reload(token)
	{
	document.frm.action="class_create_test.php?sem="+token;
	document.frm.submit();
	}
</script>
<script type="text/javascript">
	function ReloadSubject(tokenSec)
	{
	document.frm.action="class_create_test.php?type=secl";	
	document.frm.submit();
	}
</script>
<script type="text/javascript">
	function reloadme()
	{
	document.frm.action="class_create_test.php";
	document.frm.submit();
	}
</script>
<Script language="JavaScript">	
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script>
<Script language="JavaScript">	
function OpenWind3(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}

function subjectnot()
{
	alert("Please Select Grade!");
}

function sectionnot()
{
	alert("Please Select Course!");
}

function enrollnot()
{
	alert("Please Select Section!");
}

</script>
</head>
<body>

<form Name="frm" action="class_create_test.php" method="post">   
<input type="hidden" name="sem" value="<?=$sem?>"/>
<input type="hidden" name="subject" value="<?=$subject?>"/>
<!--<input type="hidden" name="section" value="<?=$section?>"/>
--><input type="hidden" name="home_teacher" value="<?=$home_teacher?>"/>
<input type="hidden" name="class_teacher" value="<?=$class_teacher?>"/>
<input type="hidden" name="sub_teacher" value="<?=$sub_teacher?>"/>

<table class='forumline' align='center' border="0" width="100%">
<tr>
<td Class="head" align='center' colspan="4">Create Class</td>
</tr>
<tr>
 <td valign="top" width="20%" nowrap rowspan="2"><b>Course</b><br>
    <select name="subject" STYLE="width:175px;height:350px" onClick="ReloadSubject(this.value)" multiple>
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
            	echo "<option value='$r_sub[subject_id]' selected>$r_sub[subject_code] - $r_sub[subject_name]</option>";
            else
            	echo "<option value='$r_sub[subject_id]'>$r_sub[subject_code] - $r_sub[subject_name]</option>";
		}
    ?>
    </select>
    &nbsp;
    <?
	if($sem!='' || $subject!='')
	{
	?>
    <a href="javascript:void(0);" onClick ="OpenWind3('add_sub.php?grades=<?=$sem?>&subj=<?=$subject?>&class_section=<?=$section?>', 'OpenWind3',800,500)">
    <img src="button-add.png" align="top" title="Add Course" height="25" width="25"></a>&nbsp;
    <?
	}
	else
	{
	?>
    <img src="button-add.png" align="top" title="Add Course" height="25" width="25" onClick="subjectnot()">&nbsp;
    <?
	}
	?>
    </td>
    <td valign="top" width="15%"  nowrap>
    <b>Section</b><br>
    <select name="section"  onChange="reloadme()" multiple STYLE="width:150px;height:150px">
		<?
       echo  $sect12.="select id,section_name,codename from class_section where sub='$subject'"; 
		if($sem!='')
		{
		$sect12.="  and grade='$sem'";
		}
		$sect12.="  and status='1'";
		$sect12.="  order by section_name";
		$rs_section=execute($sect12);
		
        for($i=0;$i<rowcount($rs_section);$i++)
        {
            $r_section=fetcharray($rs_section,$i);
            if($section==$r_section[0])
            echo "<option value='$r_section[0]' selected>$r_section[2]-$r_section[1]</option>";
            else
            echo "<option value='$r_section[0]'>$r_section[2]-$r_section[1]</option>";
        
        }
        ?>
</select>
</td>
<td valign="top"  nowrap rowspan="3">
   <br> &nbsp;
   <?php
   if($subject!='')
   {
   ?>
    <a href="javascript:void(0);" onClick ="OpenWind3('add_section.php?subj=<?=$subject?>&sem=<?=$sem?>&class_section=<?=$section?>', 'OpenWind3',500,400)">
    <img src="button-add.png" align="top" title="Add Section" height="25" width="25"></a>
    <?
   }
   else
   {
	?>
    <img src="button-add.png" align="top" title="Add Section" height="25" width="25"  onClick="sectionnot()">
    <?
   }
	?>
      <br> 
      <br>&nbsp;
      <?php
	  if($section!='')
	  {
	  ?>
    <a href="javascript:void(0);" onClick ="OpenWind2('enroll.php?sem=<?=$sem?>&subj=<?=$subject?>&class_section=<?=$section?>', 'OpenWind3',490,500)">
   <input type='button' name='enroll' value='Enroll' class='bgbutton' title="Enroll"></a>
   <?
	  }
	  else
	  {
   ?>
   <input type='button' name='dmenroll' value='Enroll' class='bgbutton' title="Enroll"  onClick="enrollnot()">
       <?
	  }
	   ?>
        </td> 
  
  
  <td width="100%" valign="top">
<table align='center' border="1" width="100%">
 <tr>
<td align='center' valign="top" width="100%">
<div align="center"><b>Enrolled Student List</b>
&nbsp;
<a href="javascript:void(0);" onClick ="OpenWind3('student_reports_print.php?sem=<?=$sem?>&subject=<?=$subject?>&class_section_id=<?=$section?>', 'OpenWind3',800,500)">
<INPUT TYPE="button" class="bgbutton"  VALUE="Print"></a>
</div>
<div style="overflow: auto;height:200px; width:550px;" align="center">
    <table align='center' border="1" width="100%">
    <tr>
    <td align='center' Class="head" width="5%"  nowrap>Sl</td>
    <td align='center' Class="head"  nowrap>Name</td>
    <td align='center' Class="head"  nowrap>Student Id</td>
    <td align='center' Class="head"  nowrap>Section</td>
    <td align='center' Class="head"  nowrap>Course</td>
     <td align='center' Class="head"  nowrap>Elective</td>
    <td align='center' Class="head"  nowrap>Course Type</td>
    </tr>
    <?php
	$sql123="select a.id,a.sub,a.sub_sec,b.id,b.student_id,b.first_name,b.last_name from student_course a,student_m b where a.acc_year='$academic_year' and a.stu_id=b.id and a.sub='$subject' and a.sub_sec='$section' group by a.stu_id order by b.first_name";	
	$rs=execute($sql123);
  ?>
     <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
	  	$subjct_info=fetchrow(execute("select subject_name,sub_type,elective from subject_m where subject_id='$subject'"));
		$section_info=fetchrow(execute("select section_name,codename from class_section where sub='$subject' and id='$section' and status=1"));
		$subjct_type=fetchrow(execute("select subtype_name from subjecttype where subtype_id='$subjct_info[1]'"));
  ?>
 <tr>
	<td align="center" nowrap><?=$i?></td>
    <td nowrap>&nbsp;<?=$r1[first_name]?>&nbsp;<?=$r1[last_name]?></td>
    <td  align='center' nowrap>&nbsp;<?=$r1[student_id]?></td>
	<td align="center" nowrap><?=$section_info[1]?>-<?=$section_info[0]?></td>
    <td align="center" nowrap><?=$subjct_info[0]?></td>
    <td align="center" nowrap><?=$subjct_info[2]?></td>
	<td align="center" nowrap><?=$subjct_type[0]?></td>
  </tr><?php
 
$i++;  
}
  ?>
    </table>
    </div>
    </td>
    </tr>
    </table>
</td>  

  
</tr>
<tr>
<td>
    <?
		if($sem=='')
		{
		$se33=fetcharray(execute("select course_year_id from subject_m  where subject_id='$subject'"));
		$sem56=$se33[0];
		}
		else
		{
			$sem56=$sem;
		}
		$class_teacher='';
		$sub_teacher='';
		$home_teacher='';
		
		$vasteac=execute("select sub_teac2,sub_teac,home_teac from all_teachers where sub='$subject' and section='$section' and acc_year='$academic_year' and class='$sem56'");
		while($vateacs=fetcharray($vasteac))
		{
			$class_teacher=$vateacs[0];
			$sub_teacher=$vateacs[1];
			$home_teacher=$vateacs[2];
		
		}
	?>
    <b>Faculty 1</b>&nbsp;<br>
    <select name="sub_teacher" STYLE="width:150px;">
    	<option value="">---  Assign Faculty  ---</option>
	<?php
	$iflag=1;
	$dd1=execute("select id, f_name,s_name from staff_det where group_id=1 and active='YES' order by f_name");
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
    <br>
    <br>
    <b>Faculty 2</b>&nbsp;<br><select name="class_teacher" STYLE="width:150px;" >
        	<option value="">---  Assign Faculty  ---</option>
	<?php
	
	$dd1=execute("select id, f_name,s_name from staff_det where group_id=1 and active='YES' order by f_name");
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
    <b>Homeroom Teacher</b>&nbsp;<br><select name="home_teacher" STYLE="width:150px;" >
        	<option value="">---  Assign Faculty  ---</option>
	<?php
	
	$dd1=execute("select id, f_name,s_name from staff_det where group_id=1 and active='YES' order by f_name");
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
	<br>
<div align='center'><input type='submit' name='save' value='Save' class='bgbutton'></div>

</td>
<td rowspan="2" width="100%"  valign="top">
<br>
<? 
		$sql=execute("SELECT * FROM `timetable` WHERE  sem_id='$sem' AND sec_id='$section'");
	    $rowcount=rowcount($sql);

	if($rowcount){ ?>
<table align='right' border='1' class='forumline'  width="100%">
	<tr>
    	<td colspan='30' class='head' align='center'>TIME TABLE</td>
	</tr>
  <tr>
    <td class="row3" align="center" nowrap>&nbsp;</td>
    <td class="row3" align="center" nowrap>Monday</td>
    <td class="row3" align="center" nowrap>Tuesday</td>
    <td class="row3" align="center" nowrap>Wednesday</td>
    <td class="row3" align="center" nowrap>Thursday</td>
    <td class="row3" align="center" nowrap>Friday</td>
    <td class="row3" align="center" nowrap>Saturday</td>
  </tr>
 <tr>
</tr>
<?php
  
  $no_of_days=6;
   	
	$sql=execute("SELECT * FROM classtime WHERE grade='$semid'");
	$rowcount=rowcount($sql);
	$r=fetcharray($sql);
  
  	for($i=1;$i<=$r['nopd'];$i++) //FOR NO OF PERIODS
	{
			$fmp="fmp".$i; $top="top".$i; $am="p".$i;
			$am=$r[$am];

					if($am==0)
						$am="AM";
					elseif($am==1)
						$am="PM";

			$p=$r[$fmp]." to ".$r[$top]." ".$am;
			
		for($j=1;$j<=$no_of_days;$j++) //FOR NO OF DAYS
		{
			
			$field_name="type".$i;
			$type=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
				
			$details=fetcharray(execute("SELECT `subname`,`staffname`,`hallno` FROM `timetable` WHERE `sem_id`='$semid' AND `weekday`='$j' AND `pid`='$i'"));
			
			$hall=fetcharray(execute("SELECT `hall_no` FROM `hallno` WHERE `id`='$details[hallno]'"));
				
			if($j==1){
				?>
					<td class="row3" align="center" title="<?=$p?>">Periods <?=$i?></td>
                <?	}
				
			    if($type[0]==1)
				{
$title=
"Hall No : ".$hall['hall_no']."\n".
"Subject : ".$details['subname']."\n".
"Teacher : ".$details['staffname'];
				?>
		<td  align="center" nowrap title="<?=$title?>">
        <!--<a href="javascript:void(0);" onClick ="OpenWind2('timeTable_edt.php?day=<?=$j?>&period=<?=$i?>', 'OpenWind2',400,200)"><?=$hall['hall_no']?></a></td>-->
        <?=$hall['hall_no']?></td>
         <?
		 	}else{ //FOR BREAK CONDITIONS
					
				$field_name="desc".$i;
				$description=fetcharray(execute("SELECT $field_name FROM `classtime` WHERE grade='$semid'"));
								
					?>
					     <td align='center' nowrap><?=$description[0]?></td>
                    <?
				}
		} //FOR NO OF DAYS LOOP CLOSED
			echo "</tr>";
	} //FOR NO OF PERIODS LOOP CLOSED
?>
 </tr>
</table>
<? } ?>
</td>
</tr>
    <tr>
<td valign="top" width="20%" nowrap colspan="2"><b>Grade</b><br>
    <select name="sem" STYLE="width:175px;height:130px" onClick="Reload(this.value)" multiple>
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
    <img src="button-add.png" align="top" title="Add Grade" height="25" width="25"></a>&nbsp;
    </td>
    </tr>
</table>

</form>
</BODY>
</HTML>