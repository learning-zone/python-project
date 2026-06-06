<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_GET)
{
	$id=$_REQUEST['id'];
	$Type=$_REQUEST['Type'];
	$term=$_REQUEST['term'];	
	$subject=$_REQUEST['subject'];
	$category=$_REQUEST['category'];
	
}
if($_POST)
{
	$term=$_POST['term'];
	$recID=$_POST['recID'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];	
	$title=$_POST['title'];
	$subject=$_POST['subject'];
	$category=$_POST['category'];
	$max_point=$_POST['max_point'];
	$apply_grade=$_POST['apply_grade'];
	$description=$_POST['description'];
	$course_objective=$_POST['course_objective'];
}
if($subject=='' or $category=='' )
{
	?>
    	<script type="text/javascript">
		   alert('Please select Class and Category');
		   window.close();
		</script>
    <?
	
}
if($Type == "Update")
{
	 
	 	
		$dateArray=explode('/',$adate);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		$assign_date="$acq_yy-$acq_mm-$acq_dd";
							
		$dateArray1=explode('/',$bdate);
		$acq_yy1=$dateArray1[2];
		$acq_mm1=$dateArray1[1];
		$acq_dd1=$dateArray1[0];
		$due_date="$acq_yy1-$acq_mm1-$acq_dd1";
					
	 $sqlUpdate="UPDATE `grade_assessment` SET `title` = '$title', `description` = '$description', `assign_date`= '$assign_date', ";
	
	 $sqlUpdate .= "`due_date` = '$due_date', `max_point` = '$max_point', `apply_grade` = '$apply_grade', ";
	
	 $sqlUpdate .= " `course_objective` = '$course_objective' WHERE `id`= $recID";
	 
	 //echo "<br>sqlUpdate :".$sqlUpdate;
	 
	 $titleOld=fetcharray(execute("SELECT title FROM `grade_assessment` WHERE `id`=$recID"));
	 $titleOld=	$titleOld[0];	
	 
	 //echo "<br>titleOld :".$titleOld;
	$resultUpdate=execute($sqlUpdate) or die(mysql_error());
	 
   //++++++++++++++++++++++++++  ALTER FIELD NAME TO GRADE MASTER TABLE  +++++++++++++++++++++++++++++++++++
   /* $titleOld = str_replace(' ', '_', $titleOld);
	$titleOld = $titleOld.'_'.$category;
  
  	$titleNew = str_replace(' ', '_', $title);
	$titleNew = $titleNew.'_'.$category;
	
	$tablename='grade_m_'.$subject.'_'.$term;
	if($resultUpdate){
  
  		$sqlAlter="ALTER TABLE $tablename CHANGE $titleOld $titleNew VARCHAR(5) NULL";
	
	}
		//echo "<br>sqlAlter :".$sqlAlter;
	
	$resultAlter = execute($sqlAlter) or die(mysql_error());*/

  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	 
	 if($resultUpdate){
		 ?>
         	<script type="text/javascript">
			   alert('Records Updated');
			   window.opener.location.reload();
			   window.close();
			 </script>
         <?
	 }
}

 if($_POST['deled'])
 {
	 
	 $sqlDelete="UPDATE `grade_assessment` SET `status` = '0' WHERE `id`= $recID";
	 //echo "<br>".$sqlDelete;

	 $resultDelete=execute($sqlDelete);
	 
	/* $title=fetcharray(execute("SELECT `title` FROM grade_assessment WHERE `id`= $recID"));
	 
	$titleNew = str_replace(' ', '_', $title['title']);
	$titleNew = $titleNew.'_'.$category;
	
	$tablename='grade_m_'.$subject.'_'.$term;
	
	$resDrop=execute("ALTER TABLE $tablename DROP COLUMN $titleNew");*/
	 
	 
	 if($resultDelete){
		 ?>
         	<script type="text/javascript">
			   alert('Deleted Successfully');
			  window.opener.location.href='setupcat.php?tedrt=1&category='+"<?=$category?>"+'&subject='+"<?=$subject?>"+'&term='+"<?=$term?>";
			   window.close();
			 </script>
         <?
	 }
}
$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
?>
    <script language="javascript">
		alert("<?=$msg?>");
		window.opener.location.reload();
		window.close();
    </script>
<?
}
?>
<html>
<head>
<Script language="JavaScript">
  function RefreshMe()
  {
	  document.frm.action="assignment_edt.php";
	  document.frm.submit();
  }
  function update_onclick()
  {
	  document.frm.action="assignment_edt.php?Type=Update";
	  document.frm.submit();
  }
  function edt_onclick(token)
  {
		document.frm.action="assignment_edt.php?Type=edit&id="+token;
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
<input type="hidden" name="recID" value="<?=$id?>">
<input type="hidden" name="term" value="<?=$term?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="category" value="<?=$category?>">
<?
		$qResult = execute ("SELECT * FROM  `grade_assessment` WHERE id='$id';");
			$num=rowcount($qResult);			
			$itms=fetcharray($qResult);
?>
<table align='center' class='forumline' width='90%' >
<tr>
	<td width="38%" align="right"> Category&nbsp;&nbsp;</td>
    <td width="62%"><select name="category" disabled>
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
	<td align="right">Title Abbreviation&nbsp;&nbsp;</td>
    <td><input type="text" name="title" value="<?=$itms['title']?>" size="20">&nbsp;&nbsp;&nbsp;( Column Heading )</td>
</tr>
<tr>
	<td align="right">Description&nbsp;&nbsp;</td>
    <td><input type="text" name="description" value="<?=$itms['description']?>" size="60"></td>
</tr>
<tr>
	<td align="right">Date Assigned&nbsp;&nbsp;</td>
    <?
					$newd=$itms['assign_date'];
			    	$dateArray=explode('-',$newd);
					$acq_yy=$dateArray[0];
					$acq_mm=$dateArray[1];
					$acq_dd=$dateArray[2];
					$assign_date="$acq_dd/$acq_mm/$acq_yy";
					if($assign_date=='//'){
						$assign_date='';
					}
	?>
    <td><input type="text" name="adate" value="<?=$assign_date?>" >&nbsp;
     <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
</tr>
<tr>
	<td align="right">Date Due&nbsp;&nbsp;</td>
    <?
					$newd1=$itms['due_date'];
			    	$dateArray1=explode('-',$newd1);
					$acq_yy1=$dateArray1[0];
					$acq_mm1=$dateArray1[1];
					$acq_dd1=$dateArray1[2];
					$due_date="$acq_dd1/$acq_mm1/$acq_yy1";
					if($due_date=='//'){
						$due_date='';
					}
	?>
    <td><input type="text" name="bdate" value="<?=$due_date?>" >&nbsp;
     <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
 </tr>
  <tr>
	<td align="right">Grade Type&nbsp;&nbsp;</td>
    <td><select name="grade_type" onChange="RefreshMe()">
     <?
	 		$grade_type=$itms['grade_type'];
         if($grade_type=='number')
             $first="selected";
         if($grade_type=='alphabet')
             $second="selected"; 
     ?> 
    <!-- <option value="number" <?=$first?>>NUMBER</option>-->
     <option value="alphabet" <?=$second?>>LETTER</option>               
  </select></td>
 </tr>

 <!--<tr>
	<td align="right">Maximum Points&nbsp;&nbsp;</td>
    <td><input type="text" name="max_point" value="<?=$max_point?>" size="10"></td>
 </tr>-->

  <tr>
	<td align="right">Apply for grade-book</td>
    <td><select name="apply_grade">
     <?
	     $apply_grade=$itms['apply_grade'];
		 
         if($apply_grade=='Y'){
             $first="selected"; $second='';
		 }
         elseif($apply_grade=='N'){
             $second="selected"; $first='';
		 }
     ?> 
     <option value="Y" <?=$first?>>YES</option>
     <option value="N" <?=$second?>>NO</option> 
     
  </select></td>
 </tr>
 <tr>
	<td align="right">Course Objective&nbsp;&nbsp;</td>
    <td><textarea rows="3" cols="50" name="course_objective"><?=$itms['course_objective']?></textarea></td>
 </tr>
</table>
<?
	 $result=execute("SELECT * FROM `grade_assessment` WHERE `subject`='$subject' AND `category_id`='$category' AND `status`=1");
		 
   if(rowcount($result)>0)
   {
   ?><BR>
   	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
   	<tr>
		<td class="head" align="center" colspan="8">ASSIGNMENT DETAILS</td>
	</tr>
		<tr height='22' >
		    <td Class="row3">Sl No</td>
			<td Class="row3">Title</td>
			<td Class="row3">Description</td>
            <td Class="row3">Date Assigned</td>
            <td Class="row3">Date Due</td>	
            <!--<td Class="row3">Max Points</td>-->
            <td Class="row3">Action</td>				
	   </tr>
        <?php
		  $rowclass=1;
		  $sno=1;
		  while($row=fetcharray($result))
		  {
				if($sno<10)
				{
					$sno="0".$sno;
				}
					if($i%2)
						echo "<tr class='clsname'>";
					else
						echo "<tr>";
			        
					$newd=$row['assign_date'];
			    	$dateArray=explode('-',$newd);
					$acq_yy=$dateArray[0];
					$acq_mm=$dateArray[1];
					$acq_dd=$dateArray[2];
					$assign_date="$acq_dd-$acq_mm-$acq_yy";
					
				    $newd1=$row['due_date'];
			    	$dateArray1=explode('-',$newd1);
					$acq_yy1=$dateArray1[0];
					$acq_mm1=$dateArray1[1];
					$acq_dd1=$dateArray1[2];
					$due_date="$acq_dd1-$acq_mm1-$acq_yy1";
						
	
			?>
                    <td align='center' ><?=$sno?></td>
                    <td align='center' ><?=$row['title']?></td>
                    <td align='center' ><?=$row['description']?></td>
                    <td align='center' ><?=$assign_date?></td>
                    <td align='center' ><?=$due_date?></td>
                    <!--<td align='center' ><?=$row['max_point']?></td>-->
                    <td  align='center' >
   	<input type="button"  value="Edit" style="width:56px;"  href="javascript:void(0);" onClick="edt_onclick(<?=$row[id]?>)" class="bgbutton"></td>
 
  <?
		
		       $sno++;
		       $rowclass = 1 - $rowclass;
  }
  ?>
  </tr>
 </table>
  <?
   }
?>

<p align="center">
<input type="button"  value="Save"  style="width:86px;" onClick="update_onclick()" class="bgbutton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button"  value="Exit"  style="width:86px;" onClick="WindowClose()" class="bgbutton"></p>
<br>
 <div align="center">
    <input type="submit" name="deled" value="Delete" class="bgbutton" style="width:86px;"></div>	
 </form>
 </body>
</html>
