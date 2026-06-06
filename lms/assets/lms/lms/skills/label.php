<?php
session_start();
include("../db.php");

//echo "<pre>";
//print_r($_GET);
//echo "<br>"; 
//print_r($_POST);
//echo "</pre>";

$user=$_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];


if($_GET)
{

	$Type = $_GET['Type'];
	$criterion_id = $_GET['criterion_id'];
	$term = $_REQUEST['term'];
	$subject = $_REQUEST['subject'];
	$category = $_REQUEST['category'];
	$assignment = $_REQUEST['assignment'];
}
if($_POST)
{
	
    $id=$_POST['id'];
	
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

if($Type== "add")
{
	
	
	 //++++++++++++++++++++++++++  ADDING FIELDS TO GRADE MASTER TABLE  +++++++++++++++++++++++++++++++++++
  	$titleNew = str_replace(' ', '_', $criterion_name);
	$titleNew = $titleNew.'_'.$assignment;
	
	$tablename='grade_m_'.$subject.'_'.$term;
  
  	$sqlAlter="ALTER TABLE $tablename ADD $titleNew VARCHAR(5) DEFAULT NULL";
	
	//echo "<br>".$sqlAlter;
	$resultAlter = execute($sqlAlter) or die(mysql_error());

  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
 
  $sqlIns="INSERT INTO `grade_criterion` (`term`, `subject`, `category_id`, `assessment_id`, `criterion_name`) VALUES('$term', '$subject', '$category', '$assignment', '$criterion_name')";
  
  //echo "<br>sqlUpdateS :".$sqlIns;
  $resultIns=execute($sqlIns);

	if($resultIns)
	{
	?>
		<script type="text/javascript">
		  window.opener.location.reload();
		  window.reload();
		  //self.opener.location.reload();
		</script>
	<?
	}
  
}

if($Type== "update")
{
	 
	 
	 //echo "<br>SELECT criterion_name FROM `grade_criterion` WHERE `id`=$id";
	 
	 $titleOld=fetcharray(execute("SELECT criterion_name FROM `grade_criterion` WHERE `id`=$id"));
	 $titleOld=	$titleOld[0];
	 //echo "<br>titleOld :".$titleOld;
	 
     $sqlUpdateA="UPDATE `grade_criterion` SET `criterion_name` = '$criterion_name'";
     $sqlUpdateA .=" WHERE `id` = '$id'";
	
  //echo "<br>sqlUpdateA :".$sqlUpdateA;	
  $resultUpdateA=execute($sqlUpdateA);
  
   //++++++++++++++++++++++++++  ALTER FIELD NAME TO GRADE MASTER TABLE  +++++++++++++++++++++++++++++++++++
    $titleOld = str_replace(' ', '_', $titleOld);
	$titleOld = $titleOld.'_'.$assignment;
  
  	$titleNew = str_replace(' ', '_', $criterion_name);
	$titleNew = $titleNew.'_'.$assignment;
	
	$tablename='grade_m_'.$subject.'_'.$term;
	if($resultUpdateA){
  
  		$sqlAlter="ALTER TABLE $tablename CHANGE $titleOld $titleNew VARCHAR(5) NULL";
	
	}
		//echo "<br>sqlAlter :".$sqlAlter;
	
	$resultAlter = execute($sqlAlter) or die(mysql_error());
	
	 if($resultAlter){
		 ?>
         	<script type="text/javascript">
			  
			   window.opener.location.reload();
			    window.reload();
			 </script>
         <?
	 }

  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
  
}
if($Type== "delete")
{
	 
	 $sqlUpdate="UPDATE `grade_criterion` SET `status`='0' WHERE `id`='$id'";
 	 //echo "<br>".$sqlUpdate;
	 $resultUpdate=execute($sqlUpdate) or die(mysql_error());
	 
	 $title=fetcharray(execute("SELECT `criterion_name` FROM `grade_criterion` WHERE `id`= $id"));
	 
	$titleNew = str_replace(' ', '_', $title['criterion_name']);
	$titleNew = $titleNew.'_'.$assignment;
	
	$tablename='grade_m_'.$subject.'_'.$term;
	
	$res="ALTER TABLE $tablename DROP COLUMN $titleNew";
	
	//echo "<br>".$res;
	$resultDrop = execute($res) or die(mysql_error());
	
	 if($resultUpdate){
		 ?>
         	<script type="text/javascript">			   
			   window.opener.location.reload();
			   window.reload();
			 </script>
         <?
	 }
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

?> 
<html>
<head>
<Script language="JavaScript">
  function RefreshMe(token)
  {
	  document.frm.action="criterion.php?token="+token;
	  document.frm.submit();
  }
  function adds_onclick()
  {
	  document.frm.action="criterion.php?Type=add";
	  document.frm.submit();
  }
  function update_onclick()
  {
	  document.frm.action="criterion.php?Type=update";
	  document.frm.submit();
  }
  function delete_onclick()
  {
	  document.frm.action="criterion.php?Type=delete";
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

<table align='center' class='forumline' width='90%' >
<tr height="30">
   <td class="head" colspan="4" align="center">ADD CRITERION</td>
</tr>
<tr>
<?
		$result=execute("SELECT * FROM `grade_criterion` WHERE assessment_id = '$assignment' AND status=1 ORDER BY id");
		  $i=0;
		  $rowclass=1;
		  
		while($row=fetcharray($result))
        {
				if($i%2)
					echo "<tr class='clsname'>";
				else
					echo "<tr>";
     ?>
       
       <td align='left'>&nbsp;&nbsp;<a herf="criterion.php?token=<?=$row['id']?>" onClick="RefreshMe('<?=$row['id']?>');" >
	   <?=$row['criterion_name']?>
       <input type="hidden" name="token" value="<?=$row['id']?>"/></a></td>
  </form>
        
     <?
	 	$i++;
		 
		       $rowclass = 1 - $rowclass;
		}
?>
</tr>
</table>
<!--</div>-->
<table align='center' class='forumline' width='90%'>
   <tr>
   	<?
	      $criterion=fetcharray(execute("SELECT `criterion_name` FROM `grade_criterion` WHERE id='$token' LIMIT 1"));
	?>
       <td><input type="text" name="criterion_name" value="<?=$criterion['criterion_name']?>" size="100"></td>
   </tr>
</table>
<?
if($token!='')
{
	?>
	<p align="center"><input type="button"  value="Save"  style="width:86px; height:22px" onClick="update_onclick()" class="bgbutton">
	<? 
}else{ 
	?>
	<p align="center"><input type="button"  value="Save"  style="width:86px; height:22px" onClick="adds_onclick()" class="bgbutton">
	<?
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button"  value="Delete"  style="width:86px; height:22px" onClick="delete_onclick()" class="bgbutton"></p>
<input type="hidden" name="id" value="<?=$token?>"/>
 </form>
 </body>
</html>
