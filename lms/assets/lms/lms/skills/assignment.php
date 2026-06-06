<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$a_year=$_SESSION['AcademicYear'];
if($_GET)
{
	$term=$_REQUEST['term'];
	$subject=$_REQUEST['subject'];
	$category=$_REQUEST['category'];
	
}
if($_POST)
{
	$term=$_POST['term'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$title=$_POST['title'];
	$subject=$_POST['subject1'];
	$category=$_POST['category'];
	$max_point=$_POST['max_point'];
	$grade_type=$_POST['grade_type'];
	$time_frame=$_POST['time_frame'];
	$apply_grade=$_POST['apply_grade'];
	$description=$_POST['description'];
	$web_progress=$_POST['web_progress'];
	$assignment_sorting=$_POST['assignment_sorting'];
}
if($subject=='' or $category=='')
{
	?>
    	<script type="text/javascript">
		   alert('Please select Class and Category');
		   window.close();
		</script>
    <?
	
}
$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
?>
    <script language="javascript">
		alert("<?=$msg?>");
		window.opener.location.href='setupcat.php?term='+"<?=$term?>"+'&subject='+"<?=$subject?>"+'&category='+"<?=$category?>";
    </script>
<?
}
?>
<!DOCTYPE HTML>
<html>
<head>
<Script language="JavaScript">
  function RefreshMe()
  {
	  document.frm.action="assignment.php";
	  document.frm.submit();
  }
  function adds_onclick()
  {
	  document.frm.action="assignment_exec.php?Type=Add";
	  document.frm.submit();
  }
  function WindowClose()
  {
	  window.close();
  }
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
</head>
<title>Add Assignment</title>
<body>
<form method="post" name="frm">
<input type="hidden" name="term" value="<?=$term?>">
<input type="hidden" name="title" value="<?=$title?>">
<input type="hidden" name="subject1" value="<?=$subject?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="description" value="<?=$description?>">
<table align='center' class='forumline' width='90%' >
<tr>
	<td align="left">&nbsp;&nbsp;Category</td>
    <td><select name="category" disabled>
	  <option value=""></option>
	  <?php
        $sql=execute("SELECT `id`, `title` FROM `grade_category` WHERE `status` = 1 ORDER BY `id`");
          while($r=fetcharray($sql))
          {
              if($category==$r[id])
                  echo "<option value=$r[id] selected>$r[title]</option>";
              else
                  echo "<option value=$r[id]>$r[title]</option>";
          }
      ?>
     </select></td>
</tr>
<tr>
	<td align="left">&nbsp;&nbsp;Title Abbreviation</td>
    <td><input type="text" name="title" value="<?=$title?>" size="20" required>&nbsp;&nbsp;&nbsp;( Column Heading )</td>
</tr>
<tr>
	<td align="left">&nbsp;&nbsp;Description</td>
    <td><input type="text" name="description" value="<?=$description?>" size="60"></td>
</tr>
<?
	 $termDate=fetcharray(execute("SELECT * FROM `academic_term` WHERE id='$term' AND `a_year`='$a_year'"));
	 
		  $dateArray=explode('-',$termDate['start_date']);
		  $acq_yy=$dateArray[0];
		  $acq_mm=$dateArray[1];
		  $acq_dd=$dateArray[2];
		  $start_date="$acq_dd/$acq_mm/$acq_yy";
		  
		  $dateArray1=explode('-',$termDate['end_date']);
		  $acq_yy1=$dateArray1[0];
		  $acq_mm1=$dateArray1[1];
		  $acq_dd1=$dateArray1[2];
		  $end_date="$acq_dd1/$acq_mm1/$acq_yy1";
?>
<tr>
	<td align="left">&nbsp;&nbsp;Date Assigned</td>
    <td title="Please select date b/w <?=$start_date?> - <?=$end_date?>"><input type="text" name="adate" value="<?=$adate?>" >&nbsp;<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;&nbsp;( <?=$start_date?> - <?=$end_date?> )</td>
</tr>
<tr>
	<td align="left">&nbsp;&nbsp;Date Due</td>
    <td title="Please select date b/w <?=$start_date?> - <?=$end_date?>"><input type="text" name="bdate" value="<?=$bdate?>" >&nbsp;<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;&nbsp;( <?=$start_date?> - <?=$end_date?> )</td>
 </tr>
<!-- <tr>
	<td align="left">Weight&nbsp;&nbsp;</td>
    <td><input type="text" name="weight" value="<?=$weight?>" size="10"></td>
 </tr>-->
  <tr>
	<td align="left">&nbsp;&nbsp;Grade Type</td>
    <td><select name="grade_type" onChange="RefreshMe()">
     <?
         if($grade_type=='number')
             $first="selected";
         if($grade_type=='alphabet')
             $second="selected"; 
     ?> 
    <!--<option value="number" <?=$first?>>NUMBER</option>-->
     <option value="alphabet" <?=$second?>>LETTER</option>               
  </select></td>
 </tr>
<?
 	if($grade_type!='alphabet'){
?>
<!-- <tr>
	<td align="left">&nbsp;&nbsp;Maximum Points</td>
    <td><input type="text" name="max_point" value="<?=$max_point?>" size="10"></td>
 </tr>-->
<?
}
?>
 <tr>
	<td align="left">&nbsp;&nbsp;Apply for grade-book</td>
    <td><select name="apply_grade">
     <?
         if($apply_grade=='Y')
             $first="selected";
         if($apply_grade=='N')
             $second="selected"; 
     ?> 
     <option value="Y" <?=$first?>>YES</option>
     <option value="N" <?=$second?>>NO</option>               
  </select></td>
 </tr>
 <tr>
	<td align="left">&nbsp;&nbsp;Course Objective</td>
    <td><textarea rows="3" cols="50" name="course_objective"></textarea></td>
 </tr>
</table>
<!--<p align="center"><input type="button"  value="Copy to another class"  style="width:186px;" onClick=""></p>-->
<p align="center">
<input type="submit"  value="Save"  style="width:86px;" onClick="adds_onclick()" class="bgbutton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit"  value="Exit"  style="width:86px;" onClick="WindowClose()" class="bgbutton"></p>
 </form>
 </body>
</html>
