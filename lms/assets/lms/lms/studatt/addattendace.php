<html>
<HEAD>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>

<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='addattendace.php';
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

	$a_year=$_SESSION['AcademicYear'];

	$user=$_SESSION['user'];

	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$class_section_id=$_REQUEST['class_section_id'];
	if($_REQUEST['subject'])
	$subject=$_REQUEST['subject'];
	else
	$subject=0;
	$subject_type=$_REQUEST['subject_type'];
	$subname=$_REQUEST['subname'];
	$sess=$_REQUEST['sess'];
$user=$_SESSION['user'];
$tablename="att_".$sem;
if($_POST['adate'])
{
	$adate=$_POST['adate'];
	$adate1=explode('/', $adate);
	$sysdate=$adate1[2]."-".$adate1[1]."-".$adate1[0];	
}
else
{
	$adate=date("d/m/Y");
	$sysdate=date("Y-m-d");
}

$disweekday=array('','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
$old_date = $sysdate; // returns Saturday, January 30 10 02:06:34
$old_date_timestamp = strtotime($old_date);
$new_date = date('N', $old_date_timestamp);

if(!$_POST)
{
	execute("CREATE TABLE IF NOT EXISTS `$tablename` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject_id` int(2) NOT NULL,
  `username` varchar(100) NOT NULL,
  `att_date` date NOT NULL,
  `stu_id` bigint(20) NOT NULL,
  `sec` int(1) NOT NULL,
  `mor` int(1) NOT NULL,
  `after` int(1) NOT NULL,
  `att_desc` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
}
$sql21=execute("select a.curri_type, a.grade,	a.sect from class_teacher a,users b where b.username='$user' and a.teacher=b.srid");
while($r12=fetcharray($sql21))
{
	$branch1=$r12[0];
	$sem1=$r12[1];
	$class_section_id1=$r12[2];
}

if($_POST['delete'])
{
	$d_att="d_att_".$sem;

	execute("CREATE TABLE IF NOT EXISTS $d_att select * from $tablename where att_date='$sysdate' and sec='$class_section_id' and subject_id='$subject'");
	execute("delete from $tablename where att_date='$sysdate' and sec='$class_section_id' and subject_id='$subject'");
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Attendance deleted Successfully");
	</SCRIPT>
	<?php
}

if($_POST['open'])
{
	$check=$_POST['check'];
	$studentid=$_POST['studentid'];
	for($i=0;$i<sizeof($studentid);$i++)
	{
		$temp1=$studentid[$i];
		$tt=$_POST['rid'.$temp1];
		$desc=$_POST['desc'.$temp1];
			
		$sql5=execute(" select id from $tablename where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and subject_id='$subject'");
		if(rowcount($sql5)>0)
		{
			if($sess=='m')
			{
				$sql1="update $tablename set mor='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and subject_id='$subject'";
			}
			elseif($sess=='n')
			{
				$sql1="update $tablename set after='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and subject_id='$subject'";
			}	
			else
			{
				$sql1="update $tablename set mor='$tt', after='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' and subject_id='$subject' ";
			}			
		}
		else
		{
			if($sess=='m')
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, mor, att_desc, username, subject_id) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$desc', '$user', '$subject')";
			}
			elseif($sess=='n')
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, after, att_desc, username, subject_id) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$desc', '$user', '$subject')";
			}	
			else
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, mor, after, att_desc, username, subject_id) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$tt', '$desc', '$user', '$subject')";
			}
		}		
	execute($sql1);	
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Attendance Updated Successfully");
	</SCRIPT>
	<?php
}
 ?>		<form name="frm" action="" method="post" >
<input type="hidden" name="subname" value="<?=$subname?>">
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="sess" value="<?=$sess?>">
<br>
<?
$sectname=fetchrow(execute("SELECT codename,section_name FROM `class_section` WHERE id='$class_section_id'"));
?>
<div align="center"><font style="font-size:20px"><b>Class : <?=$sectname[0]?>-<?=$sectname[1]?></b></font></div>
  <?php
 	// if($branch=='0')
	//die();
	//if($sem=='0')
	//die();
	if($class_section_id=='')
	die();
   $sql123="select b.id,b.student_id,b.first_name,b.last_name,b.admission_id from student_course a,student_m b where a.acc_year='$a_year' and a.stu_id=b.id and a.sub='$subject' and b.archive='N' and a.sub_sec='$class_section_id' group by a.stu_id order by b.first_name";	
	$rs=execute($sql123);
  ?><br> 
      <?php
	
	$calinfo=fetcharray(execute("select title, description from announcement_call where status=1 and (fromdate='$sysdate' or ( '$sysdate' between fromdate and todate))"));
	if($calinfo[0])
		{
		?>
        <div align="center">
            	<font style='font-size:20px; font-weight:bold' color='#FFFFFF' title='<?=$calinfo[1]?>'>
                Today's Event : <?=$calinfo[0]?>
               	</font>
         </div>   
		<?php
        }
	?>
  <br>
   <table width="70%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
    <tr height="25">
    <td colspan="8" align="center" class="head" nowrap><?=$subname?> 

    ATTENDANCE FOR &nbsp;<input type="text" name="adate" value="<?php echo $adate?>" width="10" size="10" onFocus="reload()" >&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a> <input type="button" name="go" value="Go" onClick="reload()" class="bgbutton">&nbsp;&nbsp;&nbsp;
          <?php
		
		if($new_date==6 or $new_date==7)
        echo "<blink><font style='font-size:14px' color='#FFFFFF'>$disweekday[$new_date]</font></blink>";
		else
		echo $disweekday[$new_date];
		?>
        </td>
  </tr>
  <tr>
    <td width="5%" class="head" nowrap>Sl No.</td>
    <td width="20%" align="center" class="head" nowrap>Name</td>
    <td width="10%" align="center" class="head" nowrap>Student Id</td>
    <!--<td width="23%" align="center">Action</td>-->
   <td width="" align="center" class="head" nowrap>
 Attendance Code
 </td>
 <td width="" align="center" class="head" nowrap>
Status
 </td>
 <?php
 $hrstvs=fetcharray(execute("select sub_type from subject_m where subject_id='$subject'"));
 if($hrstvs[0]!=2)
 {
 ?>
 <td width="" align="center" class="head" nowrap>
HR Status
 </td>
<!--  <td width="" align="center" class="head" nowrap>
Time
 </td>-->
 <?
 }
 ?>
 <td width="" align="center" class="head" nowrap>
 Comments
 </td>
  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  $flag1=1;
 
  if($flag1==1)
  {
		if($sess=='n')
		$rownameid='after';
		else
		$rownameid='mor';

		$sql5=execute("select $rownameid from $tablename where att_date='$sysdate' and stu_id='$r1[id]' and sec='$class_section_id'  and subject_id='$subject'");
		$checkiddet=fetchrow($sql5);
		if($checkiddet[0]==1)
		$statuschek='checked';
		else
		$statuschek='';
		echo "<tr>
		<td nowrap>&nbsp;$i</td>
		<td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
		<td nowrap align='center'>&nbsp;$r1[student_id]</td>
		";
		?>
		<td  nowrap>
		<input type="hidden" name="studentid[]" value="<?php echo $r1[id]; ?>" >
		
		<?php
		$flag=1;
		$attst=execute("SELECT order_id, Short_name FROM `attendance_points` order by id ");
		while($nr=fetcharray($attst))
		{      
		if(rowcount($sql5))        
		{
		if($checkiddet[0]==$nr[0])
		{
		$statuschek='checked';
		$naval=$nr[1];
		}
		else
		$statuschek='';
		}
		else
		{
		if($flag==1)
		{
		$flag=0;
		$statuschek='checked';
		}
		else
		$statuschek='';
		
		}
		echo "&nbsp;$nr[1]&nbsp;<input type='radio' value='$nr[0]' name='rid".$r1['id']."' id='rid".$r1['id']."' $statuschek>&nbsp;&nbsp;&nbsp;";
		$statuschek='';
		}
		?>
		</td>
		<td align="center" class="row3">
		<div id="dis<?=$r1[id]?>" >
		<b><?=$naval?></b>
		</div>
		</td>
		<?php
		 $prst='';
		$hrstvst=fetcharray(execute("select $rownameid,stu_id from $tablename a,subject_m b where a.att_date='$sysdate'  and a.subject_id=b.subject_id and b.sub_type=2 and a.stu_id='$r1[id]'"));
		$prst=fetcharray(execute("SELECT Short_name FROM `attendance_points` where order_id='$hrstvst[0]' order by id "));
		if($hrstvst[0]=='')
		{
		$prst[0]='';
		}
        $hrstvs33=fetcharray(execute("select sub_type from subject_m where subject_id='$subject'"));
        if($hrstvs33[0]!=2)
        {
        ?>
        <td width="" align="center"  nowrap><b>
        <?=$prst[0]?></b>
        </td>
        <? 
       
	 // $attnvars=execute("select att_desc  from $tablename a,subject_m b where att_date='$sysdate' and a.stu_id='$r1[id]' and a.subject_id=b.subject_id and sub_type=2");
	//	$attnvars33=fetchrow($attnvars);
		?>
      <!-- <td width="" align="center" nowrap>
        <?=$attnvars33[0]?>
        </td>-->
        <?
        }
        ?>
		<td align="center" nowrap>
		<?php
		$naval='';
		$sql8=execute("select att_desc  from $tablename where att_date='$sysdate' and stu_id='$r1[id]' and sec='$class_section_id' and subject_id='$subject' ");
		$att_desc=fetchrow($sql8);
		
		?>	<input type="text" size="50" name="desc<?=$r1[id]?>" value="<?=$att_desc[0]?>" >
		</td>
		</tr><?php
	$i++;
  }
}
  ?>
</table>
<br>				
<div align="center">
<?php
 		echo '<input type="submit" name="open" value="Update Attendance" class="bgbutton" >&nbsp;&nbsp;&nbsp;&nbsp;';
 		echo '<input type="submit" name="delete" value="Delete Attendance" class="bgbutton" >';
	
?>

</div><br>
</form>	
</body>
</html>