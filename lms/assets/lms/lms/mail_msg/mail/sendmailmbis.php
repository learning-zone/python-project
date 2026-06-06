<?php
  session_start();
  require_once ("../../db.php");
  
	echo "<pre>";
	//print_r($_GET);
	//print_r($_POST);
	echo "</pre>";
	
	if(!$_REQUEST['store_stud'])
	{
		$store_stud=date("his");
	}
	else
	{
		$store_stud=$_REQUEST['store_stud'];
	}
	
	$staffrigtss=fetcharray(execute("SELECT groupname FROM `users` where username='$user'"));
	
	
	//print_r($_SESSION);
$subject=$_POST['subject'];
$editor1=$_POST['editor1'];	

$user=$_SESSION['user'];
$sem=$_SESSION['semname'];
$branch=$_SESSION['branchname'];
$a_year=$_SESSION['AcademicYear'];
$sendto0=$_REQUEST['sendto0'];

$sendto1=$_REQUEST['sendto1'];
$sendto2=$_REQUEST['sendto2'];
$sendto3=$_REQUEST['sendto3'];
$sendto4=$_REQUEST['sendto4'];
$sendto5=$_REQUEST['sendto5'];
$sendto6=$_REQUEST['sendto6'];

$staff_dd2=$_REQUEST['staff_dd2'];
$staff_dd1=$_REQUEST['staff_dd1'];

$selected_student1=$_REQUEST['selected_student1'];


if($_POST)
{
	$by=$_POST['by'];
	$class=$_POST['class'];
	$person_type=$_POST['person_type'];
	$student_type=$_POST['student_type'];
	
	$teacher=$_POST['teacher'];
	$staff_types=$_POST['staff_types'];
	$subject=$_POST['subject'];
	$groupname=$_POST['groupname'];
}
if($person_type=='')
{
	$person_type='student';
}
if($by=='')
{
	$by='status';
}
if($student_type=='')
{
	$student_type='enrolled';
}
if($staff_types=='')
{
	$staff_types='1';
}
$one="";
$two="";
$three="";
				
	$adminvats=fetcharray(execute("SELECT srid FROM `users` WHERE `username`='$user'"));
			
	$emailID=fetcharray(execute("SELECT `email` FROM `staff_det` WHERE f_name like '%$user%' LIMIT 1"));
?>   

<?
// SUBJECT RIGHTS STARTS
	$user=$_SESSION['user'];
	
$sql21=execute("select a.curri_type, a.grade,	a.sect from class_teacher a,users b where b.username='$user' and a.teacher=b.srid order by a.curri_type, a.grade");

$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID order by a.course_id, a.year_id, a.subject_id");
	
if(rowcount($sql21)!=0)
{
	while($r12=fetcharray($sql21))
	{
		$branch1[]=$r12[0];
		$br=$r12[0];
		$yearname1[]=$r12[1];
		$sm1=$r12[1];
		$sql5=execute("select subject_id from subject_m where course_id='$br' and course_year_id='$sm1' and	status=1 order by sub_pre");
		while($r=fetcharray($sql5))
		{
			$subject_id[]=$r[0];
		}
	}
}

$sql=execute("select a.course_id, a.subject_id, a.year_id, a.subject_type, a.class_section_id from staff_rights a,users b where b.username='$user' and a.StaffID =b.S_ID order by a.course_id, a.year_id, a.subject_id");
if(rowcount($sql)!=0)
{
	while($r12=fetcharray($sql))
	{
		$branch1[]=$r12[0];
		$yearname1[]=$r12[2];
		$subject_id[]=$r12[1];
	}
}

$branch2=array_unique($branch1);
$yearname2=array_unique($yearname1);
asort($yearname2);
$subject_id2=array_unique($subject_id);

//SUBJECT RIGHTS ENDS

?>



<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
function ReloadMe()
{
  document.frm.action="sendmailmbis.php";
  document.frm.submit();
}
function ReloadMe1(sel)
{
  document.frm.action="sendmailmbis.php?sendto="+sel;
  document.frm.submit();
}
function redirectnew()
{
  document.frm.action="sendmailgroup.php";
  document.frm.submit();
}
function redirectstaff()
{
  document.frm.action="sendmailgroup_staff.php";
  document.frm.submit();
}
function OpenWind3(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}

</script>
</head>
<body>
<form Name="frm" action="" method="post"> 
<input type="hidden" name="store_stud" value="<?=$store_stud?>"/>
    
<table class='forumline' align='center' border="1" width="90%">
<tr>
	<td Class="head" align='center' colspan="15">MAILING SETUP</td>
</tr>
<tr>
	<td align="left" valign="top" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;Person Type<br>
    <select name="person_type" onChange="ReloadMe()" style="width:120px;">
         <?
             if($person_type=='student'){
                 $one="selected";$two='';$three='';
			 }elseif($person_type=='staff'){
                 $one='';$two='';$three="selected";
			 }
         ?> 
         <option value="student" <?=$one?>>Student</option>
         <option value="staff" <?=$three?>>Staff</option>                 
      </select><BR>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By<br>
      <select name="by" style="width:120px;" onChange="ReloadMe()">
         <?
             if($by=='status')
			 {
                 $four="selected";
			 }
			 if($by=='class')
			 {
                 $six="selected";
			 }
			 if($by=='homeroom')
			 {
                 $seven="selected";
			 }


         ?>
         <option value="status" <?=$four?>>Status</option>
			
      </select>
      </div>
      
    </td>
   
    <td align="left" colspan="4" rowspan="2" valign="top">
					<?
		if ($person_type!='staff')
		
		{
		if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin' || $staffrigtss[0]=='ADMISSION' || $staffrigtss[0]=='SECRETARIAL DEPT' || $staffrigtss[0]=='STAFF MANAGEMENT' || $user=='eyinfo')
		{
                    if($by=='status')
                    {
                    ?>
                    <select name="student_type" multiple style="height:100px; width:160px;" onClick="ReloadMe()">

                 <?
             if($student_type=='enrolled'){
                 $nine="selected";$ten='';$eleven='';$twelve='';$thirteen='';$fourteen='';
			 }elseif($student_type=='graduate'){
                 $nine='';$ten="selected";$eleven='';$twelve='';$thirteen='';$fourteen='';
			 }elseif($student_type=='pre-Enrolled'){
                 $nine='';$ten='';$eleven="selected";$twelve='';$thirteen='';$fourteen='';
			 }elseif($student_type=='withdrawn'){
                 $nine='';$ten='';$eleven='';$twelve="selected";$thirteen='';$fourteen='';
			 }elseif($student_type=='inactive'){
                 $nine='';$ten='';$eleven='';$twelve='';$thirteen="selected";$fourteen='';
			 }elseif($student_type=='all'){
                 $nine='';$ten='';$eleven='';$twelve='';$thirteen='';$fourteen="selected";
		}	 
         ?> 
         <option value="enrolled" <?=$nine?>>Enrolled</option>
         <option value="graduate" <?=$ten?>>Graduate</option>
         <option value="pre-Enrolled" <?=$eleven?>>Pre-Enrolled</option>
         <option value="withdrawn" <?=$twelve?>>Withdrawn</option>
         <option value="inactive" <?=$thirteen?>>Inactive</option>
      </select>
      <?
	 }
		}					
	  ?>
     
      <?
	   if($by=='class')
	   {
	  ?>
      <select name="class" multiple style="height:150px; width:160px;" onClick="ReloadMe()">
        <?php
         if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin' || $staffrigtss[0]=='ADMISSION'  ||  $staffrigtss[0]=='SECRETARIAL DEPT'  || $staffrigtss[0]=='STAFF MANAGEMENT' || $user=='eyinfo')
	{
   $sqlClass=execute("select * from class_section a,subject_m b where b.sub_type!=2 and a.sub=b.subject_id and b.course_year_id=a.grade and a.status=1 group by a.id order by  b.course_year_id,a.section_name");
    while($rC=fetcharray($sqlClass))
          {
               if($class==$rC[id])
                  echo "<option value=$rC[id] selected>$rC[codename]-$rC[section_name]</option>";
              else
                  echo "<option value=$rC[id]>$rC[codename]-$rC[section_name]</option>";
          }
   }
   else
   		{
   	$sqlClass_rs1=execute("select * from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type!=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and b.srid IN ( sub_teac2, sub_teac, home_teac) order by a.class, a.section");
		while($rC=fetcharray($sqlClass_rs1))
          {
			  $tem_arr[] = $rC[id];
          }
	
	 $sqlClass_rs=execute("select * from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type!=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
		while($rC1=fetcharray($sqlClass_rs))
          {
               $tem_arr[] = $rC1[id]; 
          } 
		  
		  $testnames=array_unique($tem_arr);
		
		while (list(, $value) = each($testnames)) 
		{
		$j=$value;
			$sql1="select id,codename,section_name from class_section where id='".$j."' and status=1 order by grade";
			$sqlname=fetchrow(execute($sql1));
			if($j==$class)
			{
				echo "<option value='$j' selected>$sqlname[1]-$sqlname[2]</option>";
			}
		else
			{
				echo "<option value='$j'>$sqlname[1]-$sqlname[2]</option>";
			}
		}
		  
	
   	}
         
      ?>
      </select>
        <?
	   }
		?>
        <?
	   if($by=='homeroom')
	   {
	  ?>
	  
      <select name="class" multiple style="height:150px; width:160px;" onClick="ReloadMe()">
        <?php
        if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='ADMISSION' || $staffrigtss[0]=='admin'  ||  $staffrigtss[0]=='SECRETARIAL DEPT'  || $staffrigtss[0]=='STAFF MANAGEMENT' || $user=='eyinfo')
	{
   $sqlClass=execute("select * from class_section a,subject_m b where b.sub_type=2 and a.sub=b.subject_id and b.course_year_id=a.grade and a.status=1  group by a.id order by  b.course_year_id,a.section_name");
    while($rC=fetcharray($sqlClass))
          {
              if($class==$rC[id])
                  echo "<option value=$rC[id] selected>$rC[codename]-$rC[section_name]</option>";
              else
                  echo "<option value=$rC[id]>$rC[codename]-$rC[section_name]</option>";
          }
   	}
   	else
   	{
   	$sqlClass_rs1=execute("select * from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and b.srid IN ( sub_teac2, sub_teac, home_teac) order by a.class, a.section");
		while($rC=fetcharray($sqlClass_rs1))
          {
			  $tem_arr[] = $rC[id];
          }
	
	 $sqlClass_rs=execute("select * from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
		while($rC1=fetcharray($sqlClass_rs))
          {
               $tem_arr[] = $rC1[id]; 
          } 
		  
		  $testnames=array_unique($tem_arr);
		
		while (list(, $value) = each($testnames)) 
		{
		$j=$value;
			$sql1="select id,codename,section_name from class_section where id='".$j."' and status=1 order by grade";
			$sqlname=fetchrow(execute($sql1));
			if($j==$class)
			{
				echo "<option value='$j' selected>$sqlname[1]-$sqlname[2]</option>";
			}
		else
			{
				echo "<option value='$j'>$sqlname[1]-$sqlname[2]</option>";
			}
		}
	}
   	
         
      ?>
      </select>
        <?
	   }
	if($by=='status' && $student_type=='enrolled')
	   {
	   if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='ADMISSION' || $staffrigtss[0]=='admin'  ||  $staffrigtss[0]=='SECRETARIAL DEPT'  || $staffrigtss[0]=='STAFF MANAGEMENT'|| $user=='eyinfo')
			{
	  ?>
      <select name="class" multiple style="height:150px; width:160px;" onClick="ReloadMe()">
        <?php
   $sqlClass=execute("SELECT `year_id`, `year_name` FROM `course_year` WHERE status=1 ORDER BY `year_id`");
          while($rC=fetcharray($sqlClass))
          {
              if($class==$rC[year_id])
                  echo "<option value=$rC[year_id] selected>$rC[year_name]</option>";
              else
                  echo "<option value=$rC[year_id]>$rC[year_name]</option>";
          }
      ?>
      </select>
        <?
	   }
	   else
	   {
	   ?>
       <?
	   for($tests=0;$tests<sizeof($yearname2);$tests++)
		{
     
		$jme=$yearname2[$tests];
		$sdrt44="select year_name from course_year where year_id='".$jme."' order by year_id";
		$sdrt4423=fetchrow(execute($sdrt44));
		
			echo "test<br>"."$sdrt4423[0]";
	}
    ?>
	    <select name="class" multiple style="height:150px; width:160px;" onClick="ReloadMe()">
			<?
            if($class=='')
            $check='selected';
            else
            $check='';
            
            ?>
            <option value='' <?=$check?>>All</option>
	    <?php
          while (list(, $value) = each($yearname2)) 
	{
		$j=$value;
		$sql1="select year_name from course_year where year_id='".$j."' order by year_id";
		$sqlname=fetchrow(execute($sql1));
		if($j==$class)
		{
			echo "<option value='$j' selected>$sqlname[0]</option>";
		}
		else
		{
			echo "<option value='$j'>$sqlname[0]</option>";
		}
	}
      ?>
       </select>
	   <?
	   }
		}			
					}
					
		
	   				if ($person_type=='staff')
					{
	   ?>           
                <select name="staff_types" multiple style="height:150px; width:160px;" onClick="ReloadMe()">
                <?php
                $sqlClass=execute("SELECT id,name FROM `staff_group` where id!=4");
                while($rC=fetcharray($sqlClass))
                {
                if($staff_types==$rC[id])
                echo "<option value=$rC[id] selected>$rC[1]</option>";
                else
                echo "<option value=$rC[id]>$rC[1]</option>";
                }
                ?>
                </select>
      
		<?
		
		}
		?>
    </td>
  
    <td align="left" colspan="4" rowspan="2">
<?
for($ids=0;$ids<sizeof($yearname2);$ids++)
		{
		$mnt=$yearname2[$ids];
		$tesrts="select year_name from course_year where year_id='$mnt' order by year_id";
		$tesrts1=fetchrow(execute($tesrts));
		echo "<br>".$tesrts1[0];
		}
?>
    <select name="StudID[]" multiple style="height:245px; width:178px" >             
<?php
	if($person_type == "staff")
	{
	$sql="SELECT `id`,`f_name` as first_name,`s_name` as last_name FROM `staff_det` where group_id='$staff_types' and active='YES'  and id!='$adminvats[0]' order by f_name";
	}
	if($person_type == "student")
	{
		if($by!='class' && $by!='homeroom')
		{
			if($staffrigtss[0]!='adminm' || $staffrigtss[0]!='ADMISSION' || $staffrigtss[0]!='admin'  ||  $staffrigtss[0]!='SECRETARIAL DEPT'  || $staffrigtss[0]!='STAFF MANAGEMENT' || $user!='eyinfo')
			{
			$sql="SELECT `id`,`first_name`,`last_name` FROM `student_m` WHERE id is not null  AND academic_year='$a_year' AND archive='N' AND course_yearsem='$class' ORDER BY first_name";
			
			}			
		
			if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='ADMISSION' || $staffrigtss[0]=='admin'  ||  $staffrigtss[0]=='SECRETARIAL DEPT' || $staffrigtss[0]=='STAFF MANAGEMENT' || $user=='eyinfo')
			{			
			
			if($student_type=="pre-Enrolled")
			{
			$sql="SELECT `id`,`first_name`,`last_name` FROM `student_m_pre` WHERE id is not null  AND academic_year='$a_year'";
			}
			else{
			
			$sql="SELECT `id`,`first_name`,`last_name` FROM `student_m` WHERE id is not null  AND academic_year='$a_year'";
			if($student_type=="enrolled")
			{		
			$sql.=" AND archive='N'";
			}
			if($student_type=="graduate")
			{		
			$sql.=" AND archive='Y'";
			}
			if($student_type=="withdrawn")
			{		
			$sql.=" AND archive='F'";
			}
			if($student_type=="inactive")
			{		
			$sql.=" AND archive='Y'";
			}
			if($class!='')
			{		
			$sql.=" AND course_yearsem='$class'";
			}
			$sql.=" ORDER BY first_name";
			}
			// student list till here
			}	   
		}

if($by=='class' or $by=='homeroom')
{

if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='ADMISSION' || $staffrigtss[0]=='admin'  ||  $staffrigtss[0]=='SECRETARIAL DEPT' || $staffrigtss[0]=='STAFF MANAGEMENT' || $user=='eyinfo')
{
$sql="select a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem from student_m a,student_course b where b.stu_id=a.id and b.sub_sec='$class' and b.acc_year='$a_year'";
	
$sql.=" group by b.stu_id";	 	
$sql.=" ORDER BY first_name";
			
}
else
{
	
	if($class=='')
	{
	/*for($ids=0;$ids<sizeof($yearname2);$ids++)
		{
		$mnt=$yearname2[$ids];
		$tesrts="select year_name from course_year where year_id='$mnt' order by year_id";
		$tesrts1=fetchrow(execute($tesrts));
		echo $tesrts1[0];
		
		$sql="select a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem from student_m a,student_course b where b.stu_id=a.id and archive='N' and b.sub_sec='$mnt' and b.acc_year='$a_year'";	
		$sql.=" group by b.stu_id";	 	
		$sql.=" ORDER BY first_name";
		$rs=execute($sql);
            while($row=fetcharray($rs))
            {
                if($StudID==$row['id'])
                	echo "<option value='$row[id]' selected>$row[first_name]&nbsp;$row[last_name]</option>";
                else
               		echo "<option value='$row[id]' >$row[first_name]&nbsp;$row[last_name]</option>";
            }
		}*/
	}
	else
	{
		$sql="select a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem from student_m a,student_course b where b.stu_id=a.id and archive='N' and b.sub_sec='$class' and b.acc_year='$a_year'";	
		$sql.=" group by b.stu_id";	 	
		$sql.=" ORDER BY first_name";

	}
		
}	
}
}
			$rs=execute($sql);
            while($row=fetcharray($rs))
            {
                if($StudID==$row['id'])
                	echo "<option value='$row[id]' selected>$row[first_name]&nbsp;$row[last_name]</option>";
                else
               		echo "<option value='$row[id]' >$row[first_name]&nbsp;$row[last_name]</option>";
            }
			 
        ?>
    	</select></td>
     <td align="center" valign="top" rowspan="2"><BR><BR><BR><BR>
     <input type="submit" name="addstundet" value=">>" style="width:40px; height:22px" class="bgbutton" onClick="form_validate()"/><BR>
     <!--<input type="button" name="selectAll" value=" >> " style="width:60px; height:22px" class="bgbutton"/>-->
     <BR><BR><BR><BR>
     <input type="submit" name="remove" value="<<" style="width:40px; height:22px" class="bgbutton" onClick="form_validate()"/><BR>
     <!--<input type="button" name="removeAll" value=" << " style="width:60px; height:22px" class="bgbutton"/><BR> -->
   </td>
<?php
	$StudID=$_POST['StudID'];
	
	//print_r($_POST);
$user_name = $_SESSION['user'];
$date_entered = date('Y-m-d');


if($_POST['addstundet'])
{
	$StudID=$_POST['StudID'];
	if($person_type == "staff")
	{
		for($staffid=0;$staffid<sizeof($StudID);$staffid++)
		{
			
			$staff_id = $StudID[$staffid];
			$staff_sql="SELECT `id`,`f_name` as first_name,`s_name` as last_name, `email` FROM `staff_det` where id ='$staff_id'";
			$staff_id_rs = fetchrow(execute($staff_sql));
			$staff_list_id = $staff_id_rs[0];
			$staff_list_name = $staff_id_rs[1];
			$staff_list_lname = $staff_id_rs[2];
			$staff_list_email = $staff_id_rs[3];//person_type
			$insert_sql = "INSERT INTO `student_mail_list` (`date_entered`, `staff_idss`, `first_name`, `last_name`, `staff_mailid`, `parent_name`, `m_name`, `f_email`, `m_email`, `g_name`, `g_mail`, `user`, `person_type`,`store_ids`) VALUES ('$date_entered', '$staff_id', '$staff_list_name', '$staff_list_lname', '$staff_list_email', NULL, NULL, NULL, NULL, NULL, NULL, '$user_name', 'staff','$store_stud')";
				$insert_rs = execute($insert_sql);
		}
	}
	else
	{
		// student from here
		 // from here
		//print_r($StudID);
		//echo "<br>";
		for($stuid=0;$stuid<sizeof($StudID);$stuid++)
		{
			
			$student_id = $StudID[$stuid];
			
			if($student_type=="pre-Enrolled")
			{
				$sql_students_pre="SELECT `id`,`first_name`,`last_name`, `rgmailid`, `parent_name`, `m_name`, `f_email`, `m_email`, `g_name`, `g_mail`,`img_source_s` FROM `student_m_pre` WHERE id ='$student_id'";
				//WHERE id is not null  AND academic_year='$a_year'";
				$students_id = fetchrow(execute($sql_students_pre));
				$student_list_id = $students_id[0];
				$student_list_name = $students_id[1];
				$student_list_lname = $students_id[2];
				$student_list_mailid = $students_id[3];
				$student_list_pname = $students_id[4];
				$student_name_mname = $students_id[5];
				$student_name_pmailid = $students_id[6];
				$student_name_mmailid = $students_id[7];
				$student_name_gname = $students_id[8];
				$student_name_gmaidid = $students_id[9];
				$student_mailss1 = $students_id[10];
				//echo "student_name_list : ".$student_name_list."<br>";
				
				$insert_sql = "INSERT INTO `student_mail_list` (`date_entered`, `student_id`, `first_name`, `last_name`, `emrgcy_mails`, `parent_name`, `m_name`, `f_email`, `m_email`, `g_name`, `g_mail`, `user`, `person_type`,`stud_mailss`,`store_ids`) VALUES ('$date_entered', '$student_id', '$student_list_name', '$student_list_lname', '$student_list_mailid', '$student_list_pname', '$student_name_mname', '$student_name_pmailid', '$student_name_mmailid', '$student_name_gname', '$student_name_gmaidid', '$user_name', 'student','$student_mailss1','$store_stud')";
				$insert_rs = execute($insert_sql);
			}
			else
			{   
				$sql_students="SELECT `id`,`first_name`,`last_name`, `rgmailid`, `parent_name`, `m_name`, `f_email`, `m_email`, `g_name`, `g_mail`,`img_source_s` FROM `student_m` WHERE id= '$student_id'";
				//WHERE id is not null  AND academic_year='$a_year'";
				$students_id1 = fetchrow(execute($sql_students));
				$student_list_id1 = $students_id1[0];
				$student_list_name1 = $students_id1[1];
				$student_list_lname1 = $students_id1[2];
				$student_list_mailid1 = $students_id1[3];
				$student_list_pname1 = $students_id1[4];
				$student_name_mname1 = $students_id1[5];
				$student_name_pmailid1 = $students_id1[6];
				$student_name_mmailid1 = $students_id1[7];
				$student_name_gname1 = $students_id1[8];
				$student_name_gmaidid1 = $students_id1[9];
				$student_mailss = $students_id1[10];
				//echo "student_name_list1 : ".$student_list_id1."<br>";
				
				$insert_sql1 = "INSERT INTO `student_mail_list` (`date_entered`, `student_id`, `first_name`, `last_name`, `emrgcy_mails`, `parent_name`, `m_name`, `f_email`, `m_email`, `g_name`, `g_mail`, `user`, `person_type`,`stud_mailss`,`store_ids`) VALUES ('$date_entered', '$student_list_id1', '$student_list_name1', '$student_list_lname1', '$student_list_mailid1', '$student_list_pname1', '$student_name_mname1', '$student_name_pmailid1', '$student_name_mmailid1', '$student_name_gname1', '$student_name_gmaidid1', '$user_name', 'student','$student_mailss','$store_stud')";
				$insert_rs = execute($insert_sql1);
			}
		}
		//student till here
	}		
}
//echo "<br>";
//print_r($_POST);
// delete selected from here
if($_POST['remove'])
{
	$RemID=$_POST['selected_student'];
	for($rem_id=0;$rem_id<sizeof($RemID);$rem_id++)
	{
		$remove_id = $RemID[$rem_id];
		$rem_sql = "DELETE from `student_mail_list` where `id` = '$remove_id' and user = '$user_name' and date_entered = '$date_entered' and store_ids='$store_stud'";
		$rem_rs = execute($rem_sql);
		
	}
}
// delete selected till here

?>        
   <td align="left" colspan="4"  rowspan="2">
   <?php
   /*
    <select name="selected_student" multiple style="height:240px;">
<!--        <option value="">-------  Select Student  -------</option>
-->         <!--<option value="student" <?=$one?>>Enrolled</option>  --> 
          <?
    
    for($g=0;$g<sizeof($branch);$g++)
    {
        $rs_sub=execute("select * from subject_m a,course_year b where a.course_year_id='$branch[$g]' and b.year_id='$branch[$g]' and a.status=1 group by a.subject_id");

        while($r_sub=fetcharray($rs_sub))
        {
            if($subject==$r_sub[subject_name])
            echo "<option value='$r_sub[subject_id]' selected>$r_sub[subject_name]-$r_sub[year_name]</option>";
            else
            echo "<option value='$r_sub[subject_id]'>$r_sub[subject_name]-$r_sub[year_name]</option>";
        }
    
    }
     
    ?>          
      </select>
	  */ ?>
      <select name="selected_student[]" multiple style="height:240px; width:178px">
      <?php
		if($person_type == "staff")
		{
			$list_sql = "select * from `student_mail_list` where status = '0' and person_type = 'staff' and user = '$user_name' and date_entered = '$date_entered'  and store_ids='$store_stud'  group by  staff_idss order by first_name";
		}
		else
		{
			$list_sql = "select * from `student_mail_list` where status = '0' and person_type = 'student' and user = '$user_name' and date_entered = '$date_entered'  and store_ids='$store_stud'   group by student_id order by first_name";
		}
      $rs_sub=execute($list_sql);
      while($r_sub=fetcharray($rs_sub))
	  {
		   echo "<option value='$r_sub[id]'>$r_sub[first_name] $r_sub[last_name]</option>";
	  }
	  ?>
      </select>
      </td>
          <td align="left" valign="top" nowrap>
          <?
		  if($sendto0==1)
		  {
			  $cheskd1='checked';
		  }
		   if($sendto1==2)
		  {
			  $cheskd2='checked';
		  }
		   if($sendto2==3)
		  {
			  $cheskd3='checked';
		  }
		   if($sendto3==4)
		  {
			  $cheskd4='checked';
		  }
		   if($sendto4==5)
		  {
			  $cheskd5='checked';
		  }
		  if($sendto5==6)
		  {
			  $cheskd6='checked';
		  }
		   if($sendto6==7)
		  {
			  $cheskd7='checked';
		  }
		  ?>
              <fieldset style="border: groove; border-width:1px; width:100px; height:150px;align:left; border-style:dotted;">
              		<legend>Send To</legend>
         <? if($person_type=="student" or $person_type=="admission") { ?>
            <input type="checkbox" name="sendto0" onClick="ReloadMe()"    value="1" <?=$cheskd1?>>Student<BR>
            <input type="checkbox" name="sendto6" onClick="ReloadMe()"  value="7" <?=$cheskd7?>>Father<BR>
            <input type="checkbox" name="sendto1" onClick="ReloadMe()"  value="2" <?=$cheskd2?>>Mother<BR>
            <input type="checkbox" name="sendto2" onClick="ReloadMe()" value="3" <?=$cheskd3?>>Guardian<BR>
            <input type="checkbox" name="sendto3" onClick="ReloadMe()"  value="4" <?=$cheskd4?>>Emergency Contact<BR>
            <input type="checkbox" name="sendto4" onClick="ReloadMe()" value="5" <?=$cheskd5?>>Staff<BR>
            <input type="checkbox" name="sendto5" onClick="ReloadMe()" value="6" <?=$cheskd6?>>Carbon Self
            <? 
			} 
			?> 
			<? if($person_type=="staff") 
            { 
				  if($staff_dd2==1)
				  {
					  $staffdet='checked';
				  }
				   if($staff_dd1==2)
				  {
					  $staffdet1='checked';
				  }
            ?>
            <input type="checkbox" name="staff_dd2" onClick="ReloadMe()" value="1" <?=$staffdet?>>Staff<BR>
            <input type="checkbox" name="staff_dd1" onClick="ReloadMe()" value="2" <?=$staffdet1?>>Carbon Self<BR> 
            <? 
            }
			if($person_type=="staff") 
            { 
				  if($staff_dd1==2)
				  {
					  $staffdet='selected';
				  }
				   if($staff_dd2!=1)
				  {
					  $disvats='disabled';
				  } 
			}
			if($person_type=="student") 
            { 
				  if($sendto5==6)
				  {
					  $staffdet='selected';
				  }
				  if($sendto4!=5)
				  {
					   $disvats='disabled';
				  } 
			}
            ?>
           </fieldset>   
	<BR>
    
    <?
	$davat=date("Y-m-d");
	?>
     <select name="selected_student1[]" multiple style="style="height:90px; width:165px;" <?=$disvats?> >       
         <option value="student" <?=$staffdet?>>Admin [ <?=$user?> ]</option>
			<?
			$qry="SELECT `id`,`f_name` as first_name,`s_name` as last_name FROM `staff_det` where active='YES' and id!='$adminvats[0]' order by f_name";
			
			
			$sqlF=execute($qry);
			while($rr=fetcharray($sqlF))
			{
			if($newFac==$rr[0])
			echo "<option value='$rr[0]' selected>$rr[1] $rr[2]</option>";
			else
			echo "<option value='$rr[0]'>$rr[1] $rr[2]</option>";
			}
			?>
		</select>       
    </td>   
</tr>
<tr>
	<td></td>
</tr>
<tr>
 <?
		  if($sendto0==1)
		  {
			  $cheskd1='checked';
		  }
		   if($sendto1==2)
		  {
			  $cheskd2='checked';
		  }
		   if($sendto2==3)
		  {
			  $cheskd3='checked';
		  }
		   if($sendto3==4)
		  {
			  $cheskd4='checked';
		  }
		   if($sendto4==5)
		  {
			  $cheskd5='checked';
		  }
		  if($sendto5==6)
		  {
			  $cheskd6='checked';
		  }
		  if($sendto6==7)
		  {
			  $cheskd7='checked';
		  }
		  
		  ?>
	<td colspan="15" align="center" valign="top"><b>To</b>&nbsp;&nbsp;<textarea rows="3" cols="116" name='mail_info' disabled>
    <?
		$reagdet=date("Y-m-d");
		if($person_type=='staff')
		{
			if($staff_dd2=='1')
			{
				$staffmaildet=execute("SELECT b.staff_mailid FROM staff_det a,student_mail_list b where a.id =b.staff_idss and b.date_entered='$reagdet'  and b.store_ids='$store_stud'");
				while($staffmaildet1=fetcharray($staffmaildet))
				{
					if($staffmaildet1[0])
					{
						echo $staffmaildet1[0].",";
					}
				}
			}
		}
	?>
    <?
	$staffemaisvat=fetcharray(execute("select From_address from mail_settings where user_id='$user' and status=1"));
	$maildet=execute("select a.stud_mailss,a.emrgcy_mails,a.f_email,a.m_email,a.g_mail from student_mail_list a,student_m b where a.date_entered='$reagdet'  and store_ids='$store_stud' and a.student_id=b.id");
	while($maildet1=fetcharray($maildet))
	{
		if($person_type=="student") 
		{
			if($sendto0==1)
			  {
				if($maildet1[0])
				{
					echo $maildet1[0].",";//student mail address
				}
			  }
			   if($sendto1==2)
			  {
				if($maildet1[3])
				{
					echo $maildet1[3].",";//mother mail address
				}
			
			  }
			  if($sendto6==7)
			  {
				if($maildet1[2])
				{  
					echo $maildet1[2].",";//fathe mail address
				}
			  }
			   if($sendto2==3)
			  {
				if($maildet1[4])
				{
				echo $maildet1[4].",";//gurdian mail address
				}
			  }
			  if($sendto3==4)
			  {
				if($maildet1[1])
				{ 
					echo $maildet1[1].",";//emergency mail address
				}
			  }
		}
	}
	  	  
	if($person_type=="staff") 
	{ 
		if($staff_dd1=='2')
		{
			if($staffemaisvat[0])
			{
				echo $staffemaisvat[0];//admin mail
			}
		} 
	}
	if($person_type=="student") 
	{ 
		if($sendto5==6)
		{
			if($staffemaisvat[0])
			{
				echo $staffemaisvat[0];//admin mail
			}
		} 
	}
	?>
    </textarea></td>
</tr>
<tr>
	<td colspan="15">
    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?
	$vatnames=fetcharray(execute("select From_address from mail_settings where user_id='$user' and status=1"));
	if($vatnames[0])
	{
	?>
    <input type="text"  id="subjectfrom" name="subjectfrom" value="<?=$vatnames[0]?>" size="70" maxlength="70" max="70" disabled />
    <?
	}
	else
	{
	?>
    <input type="text"  id="subjectfrom" name="subjectfrom" size="70" maxlength="70" max="70" disabled placeholder="Please Complete Email Setting!" />
    <?
	}
	?>
    </td>
</tr>

<tr>
	<td align="left" colspan="15">
<!------------------------------------------------------------------------------------------------------------------------------>
<!--

Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.

For licensing, see LICENSE.html or http://ckeditor.com/license

-->
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<!--<script type="text/javascript" src="../ckeditor.js"></script>-->
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script src="sample.js" type="text/javascript"></script>
<link href="sample.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function showUser(str)
{
if (str=="")
{

  document.getElementById("txtHint").innerHTML="";

  return;

} 

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();
}

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET","getuser.php?q="+str,true);

xmlhttp.send();

}

</script>

<link href="http://focusedu.net/virtual.php" rel="contents" type="text/css" />

<?php /*
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="from" size="100" maxlength="70" max="70" value="<?=$emailID[0]?>" />
<br /><br /> */ ?>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subject</strong> &nbsp;&nbsp;&nbsp;&nbsp;
<input type="text"  id="subject" name="subject" size="100" maxlength="70" max="70" value="<?=$subject?>" />
<a href="javascript:void(0);" onClick ="OpenWind3('attach.php?store_stud=<?=$store_stud?>', 'OpenWind3',600,400)">
      <input type="button" class="bgbutton" value="Attachment">
</a>
<br />
<?php /*
<p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<textarea cols="80"  name="to" rows="5" placeholder="To" disabled ><?=$to?></textarea></p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/ ?>
<textarea cols="80" id="editor1" name="editor1" rows="10" ><?php echo $editor1; ?></textarea>
<script type="text/javascript">
//<![CDATA[
CKEDITOR.replace( 'editor1',
{

			  /*

			   * Style sheet for the contents

			   */

			  contentsCss : '',
			  /*

			   * Simple HTML5 doctype

			   */

			  docType : '<!DOCTYPE HTML>',

			  /*

			   * Core styles.

			   */
			  coreStyles_bold	: { element : 'b' },
			  coreStyles_italic	: { element : 'i' },
			  coreStyles_underline	: { element : 'u'},
			  coreStyles_strike	: { element : 'strike' },
			  /*

			   * Font face

			   */

			  // Define the way font elements will be applied to the document. The "font"

			  // element will be used.

			  font_style :
			  {
				  
					  element		: 'font',
					  attributes		: { 'face' : '#(family)' }
			  },
			  /*

			   * Font sizes.

			   */

			  fontSize_sizes : 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',

			  fontSize_style :

				  {

					  element		: 'font',

					  attributes	: { 'size' : '#(size)' }

				  } ,

			  /*

			   * Font colors.

			   */

			  colorButton_enableMore : true,
			  colorButton_foreStyle :
				  {
					  element : 'font',
					  attributes : { 'color' : '#(color)' }
				  },
			  colorButton_backStyle :
				  {

					  element : 'font',

					  styles	: { 'background-color' : '#(color)' }

				  },

			  /*

			   * Styles combo.

			   */

			  stylesSet :

					  [

						  { name : 'Computer Code', element : 'code' },

						  { name : 'Keyboard Phrase', element : 'kbd' },

						  { name : 'Sample Text', element : 'samp' },

						  { name : 'Variable', element : 'var' },



						  { name : 'Deleted Text', element : 'del' },

						  { name : 'Inserted Text', element : 'ins' },



						  { name : 'Cited Work', element : 'cite' },

						  { name : 'Inline Quotation', element : 'q' }

					  ],
					  
			  on : { 'instanceReady' : configureHtmlOutput }

		  });
/*

 * Adjust the behavior of the dataProcessor to avoid styles

 * and make it look like FCKeditor HTML output.

 */

function configureHtmlOutput( ev )
{
	var editor = ev.editor,
		dataProcessor = editor.dataProcessor,
		htmlFilter = dataProcessor && dataProcessor.htmlFilter;
	// Out self closing tags the HTML4 way, like <br>.
	dataProcessor.writer.selfClosingEnd = '>';
	// Make output formatting behave similar to FCKeditor

	var dtd = CKEDITOR.dtd;

	for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) )
	{
		dataProcessor.writer.setRules( e,
			{

				indent : true,

				breakBeforeOpen : true,

				breakAfterOpen : false,

				breakBeforeClose : !dtd[ e ][ '#' ],
				
				breakAfterClose : true
			});
	}
	// Output properties as attributes, not styles.
	htmlFilter.addRules(
		{
			elements :
			{
				$ : function( element )
				{
					// Output dimensions of images as width and height
					if ( element.name == 'img' )
					{
						var style = element.attributes.style;
						if ( style )
						{
							// Get the width from the style.
							var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style ),
								width = match && match[1];
								
							// Get the height from the style.
							match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );
							var height = match && match[1];
							
							if ( width )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)width\s*:\s*(\d+)px;?/i , '' );
								element.attributes.width = width;
							}
							if ( height )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)height\s*:\s*(\d+)px;?/i , '' );
								element.attributes.height = height;
							}
						}
					}
				
					// Output alignment of paragraphs using align
					if ( element.name == 'p' )
					{
						style = element.attributes.style;
						if ( style )
						{
							// Get the align from the style.
							match = /(?:^|\s)text-align\s*:\s*(\w*);/i.exec( style );
							var align = match && match[1];
							if ( align )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)text-align\s*:\s*(\w*);?/i , '' );
								element.attributes.align = align;
							}
						}
					}
					if ( !element.attributes.style )
						delete element.attributes.style;
					return element;
				}
			},
			attributes :
				{
					style : function( value, element )
					{
						// Return #RGB for background and border colors
						return convertRGBToHex( value );
					}
				}
		} );
}

function convertRGBToHex( cssStyle )
{

	return cssStyle.replace( /(?:rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\))/gi, function( match, red, green, blue )
	{
			red = parseInt( red, 10 ).toString( 16 );
			green = parseInt( green, 10 ).toString( 16 );
			blue = parseInt( blue, 10 ).toString( 16 );
			
			var color = [red, green, blue] ;
			// Add padding zeros if the hex value is less than 0x10.
			for ( var i = 0 ; i < color.length ; i++ )
				color[i] = String( '0' + color[i] ).slice( -2 ) ;
			return '#' + color.join( '' ) ;
		 });
}
			//]]>
</script>
</td>
</tr>
</table>
<?

if($person_type=='student' || $person_type=='student' || $person_type=='student')
{
?>
<p align="center"><input type="button" value="Send Mail" class="bgbutton" onClick="redirectnew()"/></p>
<?
}
else
{
?>
<p align="center"><input type="button" value="Send Mail" class="bgbutton" onClick="redirectstaff()"/></p>
<?
}
?>
</form>
</body>
</html>