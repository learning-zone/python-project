<html>
<Script language="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
	function RefreshMe(val)
	{
		document.MyFrm.action="YearSetupnw.php";
		document.MyFrm.submit();
	}
function checkval(st)
{
	alert("Marks have been entered for this term, hence cannot be modified. Please get in touch with your school system administrator for further assistance  ");
	document.getElementById(st).checked = false;
}
</script>
<?php
	session_start();
	include("../db.php");
if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$a_year=$_POST['a_year'];
}
else
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$a_year=$_SESSION['AcademicYear'];
}
$ExamName=$_POST['ExamName'];
$ShortName=$_POST['ShortName'];
$Persatage=$_POST['Persatage'];
$maxmark=$_POST['maxmark'];
$ordercount=$_POST['ordercount'];
if($_POST['saveyear'])
{	
		$yearstt=execute("SELECT count(id)
FROM `igc_exam_year_m` where`acc_year`='$a_year' and `class`='$sem' and (exam_name='$ExamName' or exam_sub_name='$ShortName')");
		$yearstt1=fetchrow($yearstt);
		if($yearstt1[0]>0)
		{
			?>
			<Script language="JavaScript">
			alert("Duplicate entry not allowed");
			</Script>
			<?php		
		}
		else
		{
			if($sem!=0 and $ExamName!='' and $Persatage!='' and $maxmark!='' )
			{
				execute("INSERT INTO `igc_exam_year_m` ( `exam_name`, `exam_sub_name`, `per_info`, `mark`, `acc_year`, `class`, `status`, `order_id`) VALUES ( '$ExamName', '$ShortName', '$Persatage', '$maxmark','$a_year','$sem','1','$ordercount')");
					//execute();				
				?>
				<Script language="JavaScript">
				alert("Updated successfully");
				</Script>
				<?php
			}
			else
			{
				?>	
				<Script language="JavaScript">
				alert("Make sure all the entry properly entered");
				</Script>
				<?php
				
			}
		}
	
	
		
}
//modify
if($_POST['modify'])
{
	
	$cid=$_POST['seltype'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$ExamName1=$_POST['ExamName'.$cid[$i]];
		$ShortName1=$_POST['ShortName'.$cid[$i]];
		$Persatage1=$_POST['Persatage'.$cid[$i]];
		$ordercount1=$_POST['ordercount'.$cid[$i]];		
		$maxmark1=$_POST['maxmark'.$cid[$i]];
		execute("update igc_exam_year_m set `exam_name`='$ExamName1', `exam_sub_name`='$ShortName1', `per_info`='$Persatage1', `order_id`='$ordercount1',`mark`='$maxmark1' where id='$cid[$i]' and status=1 ");	
	}

		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php		

	
}


$usergroup=fetchrow(execute("SELECT groupname,srid FROM users WHERE username='$user'"));
if($usergroup[0]=='ADMIN' or $usergroup[0]=='adminm' or $usergroup[0]=='Admin' )
{
 	$sts=1;
}
else
{
	 $sts=2;
	// SUBJECT RIGHTS STARTS
	 $user=$_SESSION['user'];
 
// teacher rights
//class teacher code
$sql21=execute("SELECT  a.class, a.section FROM all_teachers a,users b WHERE b.username='$user' and a.home_teac=b.srid ORDER BY a.class");

// subject teacher code
$sql=execute("SELECT a.sub, a.class, a.sub_type, a.section FROM all_teachers a,users b WHERE b.username='$user' AND (a.sub_teac =b.srid or a.sub_teac2=b.srid) ORDER BY a.class, a.sub");
 if(rowcount($sql)==0 and rowcount($sql21)==0)
 {
  	echo die("You don't have rights"); 
 }
 //end
 
// class teacher
if(rowcount($sql21)!=0)
{
	 while($r12=fetcharray($sql21))
	 {
	
		  $yearname1[]=$r12[0];
		  $sm1=$r12[0];
		  $sql5=execute("SELECT subject_id FROM subject_m WHERE course_year_id='$sm1' AND status=1 ORDER BY sub_pre");
		  while($r=fetcharray($sql5))
		  {
		   		$subject_id[]=$r[0];
		  }
	 }
}
//end

//subject teacher
$sql=execute("SELECT a.sub, a.class, a.sub_type, a.section FROM all_teachers a,users b WHERE b.username='$user' AND (a.sub_teac =b.srid or a.sub_teac2=b.srid) ORDER BY a.class, a.sub");
if(rowcount($sql)!=0)
{
	 while($r12=fetcharray($sql))
	 {
		  $yearname1[]=$r12[1];
		  $subject_id[]=$r12[0];
	 }
}

$branch2=array_unique($branch1);
$yearname2=array_unique($yearname1);
asort($yearname2);
$subject_id2=array_unique($subject_id);
//end
//SUBJECT RIGHTS ENDS 
}
 
?>
</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='70%' >
<tr>
  <td colspan=2 align='center' class='head'>Year Setup</td></tr>
<tr height="25">
<td nowrap>&nbsp;&nbsp;Academic Year</td>
            <td> <select name="a_year" id="a_year" onchange='reload()'>
                <option value='0'>--Select--</option>
                <?php
				   $MyYear=date('Y')-1;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
						   ?>
              </select></td>
              </tr>
<tr><td>&nbsp;&nbsp;Grade</td><td><select name="course" onChange="RefreshMe(0)">
<option value='-1'>-- Select --</option>
<?php
	$sql=execute("select year_id,year_name from course_year ");
	while($r=fetcharray($sql))
	{
		if($course==$r[0])
			echo "<option value=$r[0] selected>$r[1]</option>";
		else
			echo "<option value=$r[0]>$r[1]</option>";
	}
?>
</select></td></tr>
<tr>
      <td>&nbsp;&nbsp;Class</td>
    <?
	if($sts==2)
	{
	?>
      <td>
        <select name="sem" onChange="RefreshMe(0)">
          <option value=""> --Select-- </option>
          
		<?php
		
			$sql21=execute("select c.id,c.codename,c.section_name from all_teachers a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.class and c.grade='$course' and b.srid IN ( sub_teac2, sub_teac, home_teac) order by a.class, a.section");
		while($r2=fetcharray($sql21))
		{
			
			if($sem==$r2[0])
				echo "<option value='$r2[0]' selected>$r2[1]-$r2[2]</option>";
			else
				echo "<option value='$r2[0]'>$r2[1]-$r2[2]</option>";
			
		}
        ?>
        </select></td>
        <?
		}
		?>
    <?
	if($sts==1)
	{
	?>
      <td>
        <select name="sem" onChange="RefreshMe(0)">
          <option value=""> --Select-- </option>
          
		<?php
			$sqlSub=execute("SELECT a.id,a.codename,a.section_name FROM class_section a,subject_m b WHERE  a.status=1 and b.subject_id=a.sub and b.status=1 and b.sub_type=2 and a.grade='$course' order by a.grade,a.codename,a.section_name");
		  
          while($r1=fetcharray($sqlSub))
          {
              if($sem==$r1[0])
                  echo "<option value=$r1[0] selected>$r1[codename] - $r1[section_name]</option>";
              else
                  echo "<option value=$r1[0]>$r1[codename] - $r1[section_name]</option>";
          }
        ?>
        </select></td>
        <?
		}
		?>     



</tr>



</table>
<br>
<?

if($sem!='' and $sem!=0)
{
}
?>
<table align='center' class='forumline' width='70%' border="1" >
	<tr>
        <td align='center' class='head' nowrap>Exam Name</td>
        <td align='center' class='head' nowrap>Short Name</td>
		<td align='center' class='head' nowrap> % </td>
        <td align='center' class='head' nowrap> Mark </td>
        <td align='center' class='head' nowrap>Order</td>
	</tr>

	<tr>
	
        <td align='center' nowrap>
        	<input type='text' size="40" name='ExamName' value=''>
		</td>
        <td align='center' nowrap>
        	<input type='text' name='ShortName' value=''>
		</td>
      <td align='center' nowrap>
        	<input type='text' name='Persatage' size="2" maxlength="3" value=''>
		</td>
		
        <td align='center' nowrap>
        	<input type='text' size="3" name='maxmark' maxlength="3" value=''>
		</td>
         <td align='center' nowrap>
                <select name="ordercount" >
                    <option value="">Select</option>
                    <?php
                        for($j=1;$j<10;$j++)
                        {
                              echo "<option value=$j>   $j   </option>";
                        }
                    ?>
             </select>
		</td>

</tr>

</table>
<br>  <div align='center' >
  <input type="submit" name="saveyear" value="Save Setup"  class='bgbutton'>
</div>  


<br>
<?php

		$yearstt=execute("SELECT * FROM `igc_exam_year_m` where`acc_year`='$a_year' and `class`='$sem' ");
		$yearstt2=fetchrow($yearstt);
		$yearstt2[0];
		if($yearstt2[0]==0)
		die();
?><table align='center' class='forumline' width='70%' border="1" >
	<tr>
		<td align='center' class='head' nowrap>Sl No.</td>
        <td align='center' class='head' nowrap>Exam Name</td>
        <td align='center' class='head' nowrap>Short Name</td>
		<td align='center' class='head' nowrap> % </td>
        <td align='center' class='head' nowrap>Mark </td>
        <td align='center' class='head' nowrap>Order</td>
	</tr>
<?php
echo "SELECT * FROM `igc_exam_year_m` where`acc_year`='$a_year' and `class`='$sem'"; 
$yearstt=execute("SELECT * FROM `igc_exam_year_m` where`acc_year`='$a_year' and `class`='$sem'");
while($yearstt1=fetcharray($yearstt))
{
?>
	<tr>
	
      	 <td align='center'  nowrap>
         <?php
		 if($yearstt1['status']==0)
		 {
		 	echo "<input type='checkbox' name='$yearstt1[0]' onClick='checkval(this.value)' id='$yearstt1[0]' value='$yearstt1[0]'>";
         }
		 else
		 {
				echo "<input type='checkbox' name='seltype[]' value='$yearstt1[0]'>";
		 }
		 ?>
         </td>
        <td align='center' nowrap>
        	<input type='text' size="40" name='ExamName<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['exam_name']; ?>'>
		</td>
        <td align='center' nowrap>
        	<input type='text' name='ShortName<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['exam_sub_name']; ?>'>
		</td>
       <td align='center' nowrap>
        	<input type='text' name='Persatage<?php echo $yearstt1[0]; ?>' size="2" value='<?php echo $yearstt1['per_info']; ?>'>
		</td>
        <td align='center' nowrap>
        	<input type='text' size="3" name='maxmark<?php echo $yearstt1[0]; ?>' value='<?php echo $yearstt1['mark']; ?>'>
		</td>
         <td align='center' nowrap>
                <select name="ordercount<?php echo $yearstt1[0]; ?>">
                    <option value="">Select</option>
                    <?php
                        for($j=1;$j<10;$j++)
                        {
							$tempname=$yearstt1['order_id'];
                            if($tempname==$j)
                                echo "<option value=$j selected>   $j   </option>";
                            else
                                echo "<option value=$j>   $j   </option>";
                        }
                    ?>
             </select>
		</td>
</tr>
<?php
}
?>
</table>

<br>
  <div align='center' >
  <input type="submit" name="modify" value="Modify"  class='bgbutton'>

	</form>
 </body>
</html>
