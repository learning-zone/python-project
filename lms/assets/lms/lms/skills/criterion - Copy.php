<?php
session_start();
include("../db.php");

//echo "<pre>";
print_r($_GET);
//echo "<br>"; 
print_r($_POST);
//echo "</pre>";

$user=$_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];


if($_GET)
{

	$term = $_REQUEST['term'];
	$subject = $_REQUEST['subject'];
	$category = $_REQUEST['category'];
	$assignment = $_REQUEST['assignment'];
}
if($_POST)
{
	
    $avg1 = $_POST['avg1'];
	$term = $_POST['term'];
	$subject = $_POST['subject'];
	$grade_id = $_POST['grade_id'];
	$cap_term = $_POST['cap_term'];
	$category = $_POST['category'];
	$copy_class = $_POST['copy_class'];
	$assignment = $_POST['assignment'];
	$no_criterion = $_POST['no_criterion'];	
	$criterion_name=$_POST['criterion_name'];


}

//echo "<br>assignment :".$assignment;

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if($_REQUEST[Type]== "Add")
{
	
	for($j=0; $j < $no_criterion; ++$j){
		
	 //++++++++++++++++++++++++++  ADDING FIELDS TO GRADE MASTER TABLE  +++++++++++++++++++++++++++++++++++
  	$titleNew = str_replace(' ', '_', $criterion_name[$j]);
	$titleNew = $titleNew.'_'.$category;
	
	$tablename='grade_m_'.$subject.'_'.$term;
  
  	$sqlAlter="ALTER TABLE $tablename ADD $titleNew VARCHAR(5) DEFAULT NULL";
	
	//echo "<br>".$sqlAlter;
	$resultAlter = execute($sqlAlter) or die(mysql_error());

  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
 
  $sqlIns="INSERT INTO `grade_criterion` (`term`, `subject`, `category_id`, `assessment_id`, `criterion_name`) VALUES('$term', '$subject', '$category', '$assignment', '$criterion_name[$j]')";
  
  //echo "<br>sqlUpdateS :".$sqlIns;
  $resultIns=execute($sqlIns);
  
	} // FOR LOOP CLOSE
	
	if($resultIns)
	{
	?>
		<script language="javascript">
			alert("Record Saved");
			window.close();
		</script>
	<?
	}
  
}

if($Type== "Update")
{
	 
  $sqlUpdateA="UPDATE `grade_criterion` SET `criterion_name` = '$criterion_name[$k]'";
  $sqlUpdateA .=" WHERE `assessment_id` = '$assessment'";
	
  //echo "<br>sqlUpdateA :".$sqlUpdateA;	
  //$resultUpdateA=execute($sqlUpdateA);
  
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

?> 
<html>
<head>
<Script language="JavaScript">
  function RefreshMe()
  {
	  document.frm.action="criterion.php";
	  document.frm.submit();
  }
  function adds_onclick()
  { 
	  document.frm.action="criterion.php?Type=Add";
	  document.frm.submit();
  }
  function update_onclick()
  {
	  document.frm.action="criterion.php?Type=Update";
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
<title>ADD CRITERION</title>
<body>
<form method="post" name="frm">
<input type="hidden" name="term" value="<?=$term?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="assignment" value="<?=$assignment?>">

<?PHP
		//echo "<br>SELECT * FROM `grade_criterion` WHERE assessment_id = '$assignment'";
		
		$qResult = execute ("SELECT * FROM `grade_criterion` WHERE assessment_id = '$assignment' ORDER BY id");
			$num=rowcount($qResult);			
  if(!$no_criterion)
  {
	  $no_criterion=$num;
  }
			//echo "<br>num :".$num;
?>
<table align='center' class='forumline' width='90%' >
<tr height="30">
   <td class="head" colspan="4" align="center">ADD CRITERION</td>
</tr>
<tr>
   <td align="center">No of Criterions</td>
   <td><select name='no_criterion' style="width:120px;" onChange="RefreshMe()">
       <option value="">--- Select ---</option>
   <?php
		  $sql=execute("SELECT * FROM `grade_no_criterion` where status=1 order by id");
			  while($r=fetcharray($sql))
			  {
				  if($no_criterion==$r[id])
					echo "<option value='$r[id]' selected>&nbsp; $r[name]</option>";
				  else
					echo "<option value='$r[id]' >&nbsp; $r[name]</option>";
			  }
		  ?>
	  </select></td>
</tr>
<?
	$row=0;
	for($i=1; $i< $no_criterion; ++$i){
		
		$row=fetcharray($qResult);
?>
<tr>
   <td align="center"><?=$i?>. Criterion Name</td>
   <td><input type="text" name="criterion_name[]" value="<?=$row['criterion_name']?>" style="width:500px; height:30px;"></td>
</tr>
<?
	} //FOR LOOP CLOSE

?>
<tr>
   <td align="center"><?=$i+1?>. Criterion Name</td>
   <td><input type="text" name="criterion_name[]" value="<?=$row['criterion_name']?>" style="width:500px; height:30px;"></td>
</tr>
</table>
<p align="center">
<?
	  $chk=rowcount(execute("SELECT `id` FROM `grade_criterion` WHERE `term`='$term', `subject`='$subject' AND `category_id`='$category' AND `assessment_id`='$assessment' AND `status`=1"));
	  if($chk < 1){
?>
<input type="button"  value="Save"  style="width:86px; height:22px" onClick="adds_onclick()" class="bgbutton">
<?
	  }else{
?>
<input type="button"  value="Save"  style="width:86px; height:22px" onClick="update_onclick()" class="bgbutton">
<?
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button"  value="Exit"  style="width:86px; height:22px" onClick="WindowClose()" class="bgbutton">
</p>
 </form>
 </body>
</html>
