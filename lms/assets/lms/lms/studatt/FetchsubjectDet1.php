<html>
<HEAD>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
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
	document.frm.action='FetchsubjectDet1.php';
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
function checkop(msg)
{
	var m=document.getElementById(msg).checked;
	if(!m)
	{
		//document.getElementById("d"+msg).innerHTML="AB";
		document.getElementById("opp"+msg).disabled = false;
	}
	else
	{
		document.getElementById("opp"+msg).disabled = true;
		//document.getElementById("d"+msg).innerHTML="PR";
	}
}
</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];

if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];	
}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}
$examname=$_POST['examname'];
$class_section_id=$_POST['class_section_id'];
$sess=$_POST['sess'];
$tablename="att_".$sem;
$adate=$_POST['adate'];
$adate1=explode('/', $adate);
if($_POST['adate'])
{
$sysdate=$adate1[2]."-".$adate1[1]."-".$adate1[0];	
}
else
{
	$adate=date("d/m/Y");
	$sysdate=date("Y-m-d");
}
if($_POST['open'])
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
	
	$check=$_POST['check'];
	$studentid=$_POST['studentid'];
	for($i=0;$i<sizeof($studentid);$i++)
	{

			$temp1=$studentid[$i];
			$tt=$_POST['rid'.$temp1];
			$desc=$_POST['desc'.$temp1];
			
			
		$sql5=execute(" select id from $tablename where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id'");
		if(rowcount($sql5)>0)
		{
			if($sess=='m')
			{
				$sql1="update $tablename set mor='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' ";
			}
			elseif($sess=='n')
			{
				$sql1="update $tablename set after='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' ";
			}	
			else
			{
				$sql1="update $tablename set mor='$tt', after='$tt', att_desc='$desc' ,username='$user' where att_date='$sysdate' and stu_id='$studentid[$i]' and sec='$class_section_id' ";
			}			
		}
		else
		{
			if($sess=='m')
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, mor, att_desc, username) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$desc', '$user')";
			}
			elseif($sess=='n')
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, after, att_desc, username) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$desc', '$user')";
			}	
			else
			{
				$sql1="insert into $tablename(att_date, stu_id, sec, mor, after, att_desc, username) values('$sysdate', '$studentid[$i]', '$class_section_id', '$tt', '$tt', '$desc', '$user')";
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
<table width="90%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">DAILY ATTENDANCE</td>
    </tr>
   <tr>
		<td>&nbsp;&nbsp;Date</td>
		<td nowrap>&nbsp;<input type="text" readonly="" name="adate" value="<?php echo $adate?>" onBlur="reload()">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>  
  <tr>
    <td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
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
   <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
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
  </tr><!--
 <tr>
  <td height="28">&nbsp;&nbsp;Session</td><td>&nbsp;<select name='sess'  onChange="reload()">
<?
if($sess=='m')
$bbbb='selected';
elseif($sess=='n')
$nnnn='selected';
echo "<option value='b' >--BOTH--</option>";
echo "<option value='m' $bbbb>--MORNING--</option>";
echo "<option value='n' $nnnn>--NOON--</option>";

?>
</select>
<input type="hidden" name="sess" value="b">
</td>
  </tr> 
-->
<input type="hidden" name="sess" value="b">

</table>
  <?php
  if($branch=='0')
	die();
	if($sem=='0')
	die();
	if($class_section_id=='')
	die();


   $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N' and academic_year='$academic_year' ";
	//if($branch!=0)
	//{
	//$sql123.=" and course_admitted=$branch";
	//}
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='-1')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	 $sql123.=" order by first_name";
	
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table width="90%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
    <td width="5%" class="head" nowrap>Sl No.</td>
    <td width="20%" align="center" class="head" nowrap>Name</td>
    <td width="10%" align="center" class="head" nowrap>Student Id</td>
    <!--<td width="23%" align="center">Action</td>-->
   <td width="" align="center" class="head" nowrap>
 Attendance Code
 </td>
  </td>
 <td width="" align="center" class="head" nowrap>
Status
 </td>
 <td width="" align="center" class="head" nowrap>
 Comments
 </td>
  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  if($sess=='n')
  $rownameid='after';
  else
  $rownameid='mor';
  $sql5=execute("select $rownameid  from $tablename where att_date='$sysdate' and stu_id='$r1[id]' and sec='$class_section_id'");
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
        }
        ?>
    </td>
    <td align="center" class="row3">
    <div id="dis<?=$r1[id]?>" >
    <b><?=$naval?></b>
    </div>
    </td>
    <td align="center" nowrap>
<?php
  $sql8=execute("select att_desc  from $tablename where att_date='$sysdate' and stu_id='$r1[id]' and sec='$class_section_id'");
  $att_desc=fetchrow($sql8);

?>	<input type="text" size="50" name="desc<?=$r1[id]?>" value="<?=$att_desc[0]?>" >
    </td>
  </tr><?php
$i++;  }
  ?>
  
</table>
				
                <br>
<div align="center"><input class="bgbutton" type="submit" name="open" value="Update Attendance" ></div>
</form>	
</body>
</html>