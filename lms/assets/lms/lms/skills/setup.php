<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user=$_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];

$usergroup=fetchrow(execute("SELECT groupname FROM users WHERE username='$user'"));
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
 if(mysql_num_rows($sql)==0 and mysql_num_rows($sql21)==0)
 {
  echo die("You don't have rights"); 
 }
 //end
 
// class teacher
if(mysql_num_rows($sql21)!=0)
{
 while($r12=fetcharray($sql21))
 {
 // $branch1[]=$r12[0];
  //$br=$r12[0];
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
if(mysql_num_rows($sql)!=0)
{
 while($r12=fetcharray($sql))
 {
//  $branch1[]=$r12[0];
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

if($_GET)
{
	$Type = $_REQUEST['Type'];
	$term = $_REQUEST['term'];
	$subject = $_REQUEST['subject'];
	$category=$_REQUEST['category'];
}
if($_POST)
{
$category=$_POST['category'];
    $term = $_POST['term'];
	$avg1=$_POST['avg1'];				$avg2=$_POST['avg2'];
	$avg3=$_POST['avg3'];				$avg4=$_POST['avg4'];
	$avg5=$_POST['avg5'];				$avg6=$_POST['avg6'];
	$avg7=$_POST['avg7'];				$avg8=$_POST['avg8'];
	$avg9=$_POST['avg9'];				$avg10=$_POST['avg10'];
	$avg11=$_POST['avg11'];				$avg12=$_POST['avg12'];
	$avg13=$_POST['avg13'];				$avg14=$_POST['avg14'];
	$avg15=$_POST['avg15'];

	$letter1=$_POST['letter1'];			$letter2=$_POST['letter2'];
	$letter3=$_POST['letter3'];			$letter4=$_POST['letter4'];
	$letter5=$_POST['letter5'];			$letter6=$_POST['letter6'];
	$letter7=$_POST['letter7'];			$letter8=$_POST['letter8'];
	$letter9=$_POST['letter9'];			$letter10=$_POST['letter10'];
	$letter11=$_POST['letter11'];		$letter12=$_POST['letter12'];
	$letter13=$_POST['letter13'];		$letter14=$_POST['letter14'];
	$letter15=$_POST['letter15'];
	$grade_id=$_POST['grade_id'];
	$cap_term=$_POST['cap_term'];
	$subject=$_POST['subject'];
	
	$copy_class=$_POST['copy_class'];
	$cal_method=$_POST['cal_method'];	
	$cap_category=$_POST['cap_category'];	
	$assignment_sorting=$_POST['assignment_sorting'];

}
if($subject=='' or $term=='')
{
	?>
    	<script type="text/javascript">
		   alert('Please select Class and Term');
		   window.close();
		</script>
    <?
	
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if($Type== "Update")
{
	 
  $sqlUpdateS="UPDATE `grade_setup` SET `category_grade` = '$cap_category', `term_grade` = '$cap_term', `copy_class`='$copy_class',";
  $sqlUpdateS .=" `cal_method` = '$cal_method'  WHERE `subject` = '$subject[0]'";
  
  //echo "<br>sqlUpdateS :".$sqlUpdateS;
  $resultUpdateS=execute($sqlUpdateS) or die(mysql_error());
  

  $sqlUpdateA="UPDATE `grade_avg` SET `letter1` = '$letter1', `letter2` = '$letter2', `letter3`='$letter3', `letter4` = '$letter4'";
  $sqlUpdateA .=",`letter5` = '$letter5', `letter6` = '$letter6', `letter7`='$letter7', `letter8` = '$letter8',`letter9` = '$letter9'";
  $sqlUpdateA .=",`letter10` = '$letter10', `letter11` = '$letter11', `letter12` = '$letter12', `letter13` = '$letter13', ";
  $sqlUpdateA .="`letter14` = '$letter14', `letter15` = '$letter15', `avg1` = '$avg1', `avg2` = '$avg2', `avg3`='$avg3', `avg4`='$avg4'";
  $sqlUpdateA .=",`avg5` = '$avg5', `avg6` = '$avg6', `avg7`='$avg7', `avg8` = '$avg8',`avg9` = '$avg9', `avg10` = '$avg10'";
  $sqlUpdateA .=", `avg11` = '$avg11', `avg12` = '$avg12', `avg13` = '$avg13', `avg14` = '$avg14', `avg15` = '$avg15' ";
  $sqlUpdateA .=" WHERE `subject` = '$subject[0]'";
	
  //echo "<br>sqlUpdateA :".$sqlUpdateA;	
  $resultUpdateA=execute($sqlUpdateA) or die(mysql_error());
  
     //+++++++++++++++++++++++++++++++++++   INSERTING NEW STUDENT DETAILS    +++++++++++++++++++++++++++++++++++++++++++

 //echo "<br>SELECT a.id FROM student_m a,student_course b WHERE b.stu_id=a.id AND b.sub_sec=$subject[0] AND b.acc_year='$a_year' GROUP BY b.stu_id ORDER BY a.first_name";
 
	$sql=execute("SELECT a.id FROM student_m a,student_course b WHERE b.stu_id=a.id AND b.sub_sec=$subject[0] AND b.acc_year='$a_year' GROUP BY b.stu_id ORDER BY a.first_name");	

	  while($r=fetcharray($sql))
	  {
		 $student_id=$r['id'];
		 if($student_id!='')
		 {
		 	$tablename='grade_m_'.$subject[0].'_'.$term;
			
			$check=rowcount(execute("SELECT * FROM `$tablename` WHERE `student_id` = '$student_id' AND `status` = 1"));
			
		    if($check < 1)
		    {			
				$sqlInsert="INSERT INTO `$tablename` (`student_id`, `term`, `subject`) 
				VALUES ('$student_id', '$term', '$subject[0]')";
		
				 //echo "<br>".$sqlInsert;
				 $resultInsert = execute($sqlInsert) or die(mysql_error());
			 }
		 }
		  
	  }
	   //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	 
	 if($resultUpdateA){
		 ?>
         	<script type="text/javascript">
			  alert('Records Saved');
			  window.opener.location.href='setupcat.php?term='+"<?=$term?>"+'&subject='+"<?=$subject[0]?>"+'&category='+"<?=$category?>";
			  window.close();
			 </script>
         <?
	 }
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
?>
    <script language="javascript">
		alert("<?=$msg?>");
		window.close();
    </script>
<?
}

//++++++++++++  Web Progress Enable  ++++++++++++++++//
   if($web_progress=='full_details'){
	   $first="selected";	$second="";	  $third="";
   }
   if($web_progress=='category_avg'){
	   $first="";	$second="selected";	 $third="";
   }
  if($web_progress=='term_avg'){
	   $first="";	$second="";	 $third="selected";
  }
  
//++++++++++++++++++++++++++++   Assignment Sorting   +++++++++++++++++++++++++++// 
  if($assignment_sorting=='ascending'){
	   $four="selected";	$five="";	 $six="";  $seven=""; $eight="";  $nine="";
   }
  if($assignment_sorting=='descending'){
	    $four="";	$five="selected";	 $six="";  $seven=""; $eight="";  $nine="";
   }
  if($assignment_sorting=='due_ascending'){
	    $four="";	$five="";	 $six="selected";  $seven=""; $eight="";  $nine="";
  }
  if($assignment_sorting=='due_descending'){
	    $four="";	$five="";	 $six="";  $seven="selected"; $eight="";  $nine="";
  }
  if($assignment_sorting=='assignment_ascending'){
	    $four="";	$five="";	 $six="";  $seven=""; $eight="selected";  $nine="";
  }
  if($assignment_sorting=='assignment_descending'){
	    $four="";	$five="";	 $six="";  $seven=""; $eight="";  $nine="selected";
  }

//++++++++++++  TIME FRAME  ++++++++++++++++//
   if($time_frame=='semester'){
	   $ten="selected";	$eleven="";	  $twelve="";
   }
   if($time_frame=='term'){
	   $ten="";	$eleven="selected";	  $twelve="";
   }
  if($time_frame=='year'){
	   $ten="";	$eleven="";	  $twelve="selected";
  }

?> 
<html>
<head>
<Script language="JavaScript">
  function RefreshMe()
  {
	  document.frm.action="setup.php";
	  document.frm.submit();
  }
  function adds_onclick()
  { 
	  document.frm.action="setup_edt.php?Type=Add";
	  document.frm.submit();
  }
  function update_onclick()
  {
	  document.frm.action="setup.php?Type=Update";
	  document.frm.submit();
  }
  function WindowClose()
  {
	  window.close();
  }
</script>
<Script language="JavaScript">
  function OpenWind2(URL, title,w,h)
  {

	 var left = (screen.width/2)-(w/2);
     var top = (screen.height/2)-(h/2);
     var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	 
  }
</script>
</head>
<title>CLASS SETUP</title>
<body>
<form method="post" name="frm">
<input type="hidden" name="term" value="<?=$term?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="category" value="<?=$category?>">

<?
		$qResult = execute ("SELECT a.*, b.* FROM  `grade_avg` a, `grade_setup` b WHERE a.subject = b.subject AND
		 a.subject='$subject'");
			$num=mysql_num_rows($qResult);			
			$itms=fetcharray($qResult);
?>
<table align='center' class='forumline' width='100%' >
<tr>
	<td width="50%">
    <table align="center" width="50%">
<tr>
  	<td><fieldset style="border: groove; border-width:1px; height:120px; width:200px; align:left;">
			<legend>Grade Calculation Method</legend>
            <?
				$first='';$second='';$third='';
				$val=$itms['cal_method'];
				if($val=='1'){
					$first='checked';
				}
				if($val=='2'){
					$second='checked';
				}
				if($val=='3'){
					$third='checked';
				}
				
			?>
        	<p align="left"><input type="radio" name="cal_method" value="1" required <?=$first?>>&nbsp;Points</p>
            <p align="left"><input type="radio" name="cal_method" value="2" required <?=$second?>>&nbsp;Weighted Percentage</p>
            <!--<p align="left"><input type="radio" name="cal_method" value="3" required <?=$third?>>&nbsp;Mixed</p>-->
        </fieldset>
    </td>
</tr>
<tr>
  	<td><BR><fieldset style="border: groove; border-width:1px; height:120px; width: 200px; align:left;">
			<legend>User Preferances</legend>
        	<!--<p align="left"><input type="checkbox" name="incomplete" >&nbsp;Treat Incomplete as 0</p>-->
            <!--<p align="left"><input type="checkbox" name="web_progress" >&nbsp;Web Progress Enable</p>
            <p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="web_progress" onChange="RefreshMe()">
          		 <option value="full_details" <?=$first?>>Full Details</option>
                 <option value="category_avg" <?=$second?>>Category Averages</option>
                 <option value="term_avg" <?=$third?>>Term Average</option>                   
              </select></p>-->
             <?
			 		$category='';$term='';
					$term_grade=$itms['term_grade'];
					$category_grade=$itms['category_grade'];
					if($category_grade=='Y'){
						$category='checked';
					}
					if($term_grade=='Y'){
						$term='checked';
					}
			 ?>
        
            <p align="left"><input type="checkbox" name="cap_category" value="Y" <?=$category?>>&nbsp;Cap Categroy grade at 100</p>
            <p align="left"><input type="checkbox" name="cap_term" value="Y" <?=$term?>>&nbsp;Cap Term grade at 100</p>
            <!--<p align="left"><input type="checkbox" name="grade" >&nbsp;show points Earned</p>-->
            
            <!--<p align="left">&nbsp;Assignment Sorting<BR>
            &nbsp;<select name="assignment_sorting">
          		 <option value="ascending" <?=$four?>>In order they were added (Ascending)</option>
                 <option value="descending" <?=$five?>>In order they were added (Descending)</option>
                 <option value="due_asc" <?=$six?>>Due Date (Ascending)</option>
                 <option value="due_desc" <?=$seven?>>Due Date (Descending)</option>
                 <option value="assignment_asc" <?=$eight?>>Assignment Title (Ascending)</option>
                 <option value="assignment_desc" <?=$nine?>>Assignment Title (Descending)</option>
            </select></p>-->
            <!--<p align="center"><input type="button"  value="Student Aliases"  style="width:235px;" onClick=""></p>-->
        </fieldset>
        		
     </td>
   </tr>
</table>
</td>
<td width="50%" valign="top">
<table align="left" width="91%" border="1">
	<tr>
    	<td align="center" class="head">Letter Grade Criteria</td>        
    </tr>
    <tr>
    	<td class="rowpic"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Letter 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;
         Avg</td>        
    </tr>
<tr>   
    <td><div style="overflow-x:hidden;overflow-y:scroll; height:120px">
    <input type="text" name="letter1" placeholder="A" value="<?=$itms['letter1']?>"><input type="text" name="avg1" placeholder="100" value="<?=$itms['avg1']?>"><BR>
    <input type="text" name="letter2" placeholder="B" value="<?=$itms['letter2']?>"><input type="text" name="avg2" placeholder="90" value="<?=$itms['avg2']?>">
    <input type="text" name="letter3" placeholder="C" value="<?=$itms['letter3']?>"><input type="text" name="avg3" placeholder="80" value="<?=$itms['avg3']?>"><BR>
    <input type="text" name="letter4" placeholder="D" value="<?=$itms['letter4']?>"><input type="text" name="avg4" placeholder="70" value="<?=$itms['avg4']?>">
    <input type="text" name="letter5" placeholder="E" value="<?=$itms['letter5']?>"><input type="text" name="avg5" placeholder="60" value="<?=$itms['avg5']?>"><BR>
    <input type="text" name="letter6" placeholder="F" value="<?=$itms['letter6']?>"><input type="text" name="avg6" placeholder="50" value="<?=$itms['avg6']?>">
    <input type="text" name="letter7" value="<?=$itms['letter7']?>"><input type="text" name="avg7" value="<?=$itms['avg7']?>" ><BR>
    <input type="text" name="letter8" value="<?=$itms['letter8']?>"><input type="text" name="avg8" value="<?=$itms['avg8']?>">
    <input type="text" name="letter9" value="<?=$itms['letter9']?>"><input type="text" name="avg9" value="<?=$itms['avg9']?>" ><BR>
    <input type="text" name="letter10" value="<?=$itms['letter10']?>" ><input type="text" name="avg10" value="<?=$itms['avg10']?>" >
    <input type="text" name="letter11" value="<?=$itms['letter11']?>" ><input type="text" name="avg11" value="<?=$itms['avg11']?>"><BR>
    <input type="text" name="letter12" value="<?=$itms['letter12']?>"><input type="text" name="avg12" value="<?=$itms['avg12']?>">
    <input type="text" name="letter13" value="<?=$itms['letter13']?>"><input type="text" name="avg13" value="<?=$itms['avg13']?>"><BR>
    <input type="text" name="letter14" value="<?=$itms['letter14']?>" ><input type="text" name="avg14" value="<?=$itms['avg14']?>">
    <input type="text" name="letter15" value="<?=$itms['letter15']?>"><input type="text" name="avg15" value="<?=$itms['avg15']?>">
    </div><hr color="#000000">
        <br>
  <fieldset style="border: groove; border-width:1px; width: 300px; align:left;">
	<legend>Copy To Class</legend>
  <?
	if($sts==2)
	{
	?>
      <p align="left">
        <select name="subject[]" multiple style="height:100px;width:250px;">
          <option value=""></option>
          
		<?php
			$sql21=execute("SELECT d.head_id,a.class, a.section FROM all_teachers a,users b,class_section c,course_year d,  WHERE b.username='$user' AND c.id=a.section AND c.status=1 AND d.year_id=a.class AND b.srid IN ( sub_teac2, sub_teac, home_teac) ORDER BY a.class, a.section");
		while($r2=fetcharray($sql21))
		{
			$sectname=fetchrow(execute("SELECT codename,section_name FROM `class_section` WHERE id='$r2[2]'"));
			$semname =fetchrow(execute("SELECT year_name FROM course_year WHERE year_id='$r2[1]'"));

			if($subject==$r2[2])
				echo "<option value='$r2[2]' selected>$sectname[0]-$sectname[1]</option>";
			else
				echo "<option value='$r2[2]'>$sectname[0]-$sectname[1]</option>";
			
		}
        ?>
        </select></p>
        <?
		}
		?>
    <?
	if($sts==1)
	{
	?>
      <p align="left">
        <select name="subject[]" multiple style="height:100px;width:250px;">
          <option value=""></option>
          
		<?php
		 
		 $sqlSub=execute("SELECT * FROM class_section WHERE status=1 ORDER BY grade,codename,section_name");
		 
          while($r1=fetcharray($sqlSub))
          {		 
			 $chk=rowcount(execute("SELECT id FROM grade_setup WHERE subject='$r1[id]'"));
			 if($chk < 1){
			  	 if($subject==$r1[id])
                 	 echo "<option value=$r1[id] selected>$r1[codename] - $r1[section_name]</option>";
              	 else
                 	 echo "<option value=$r1[id]>$r1[codename] - $r1[section_name]</option>";
			 }else{
				  if($subject==$r1[id])
                 	 echo "<option value=$r1[id] selected style=background-color:#0F0 title='SetUp Created'>$r1[codename] - $r1[section_name]</option>";
                  else
                  	 echo "<option value=$r1[id] style=background-color:#0F0 title='SetUp Created'>$r1[codename] - $r1[section_name]</option>";
			 }
          }
        ?>
        </select></p>
        <?
		}
    ?>
            <p align="left"></p>
   </fieldset>      
    </td>         
</tr>
<BR><BR> 
</table>
</td>
</tr>
</table>
<p align="center">
<?
	  $id=fetcharray(execute("SELECT `id` FROM `grade_setup` WHERE `subject`='$subject' AND `status`='1'"));
	  if($id[0]==''){
?>
<input type="button"  value="Save"  style="width:86px;" onClick="adds_onclick()" class="bgbutton">
<?
	  }else{
?>
<input type="button"  value="Save"  style="width:86px;" onClick="update_onclick()" class="bgbutton">
<?
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button"  value="Exit"  style="width:86px;" onClick="WindowClose()" class="bgbutton">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--<input type="button"  value="Add Exceptions"  style="height:22px" onClick="OpenWind2('addException.php', 'OpenWind2', 800, 400)" class="bgbutton">--></p>
 </form>
 </body>
</html>
