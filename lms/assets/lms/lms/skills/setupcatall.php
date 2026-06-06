<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
//print_r($_POST);
echo "</pre>";*/

$user=$_SESSION['user'];

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
 

$user = $_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];

if($_GET)
{
	$term  = $_GET['term'];
	$msg = $_REQUEST['msg'];	
	$Type = $_REQUEST['Type'];
    $subject = $_REQUEST['subject'];
	$category = $_REQUEST['category'];
	
	if($Type!='')
	{
		$category='';
	}
}

if($_POST)
{
	$term = $_POST['term'];
	$subject = $_POST['subject'];
	$category = $_POST['category'];
}
if($_POST['subject']!='' and $_POST['term']!='' and $_POST['category']=='')
{
	$Type="summary";
}
if($_GET['Type']=="summary"){
	$category='';
}

	$_SESSION['term']=$term;
	$_SESSION['subject']=$subject;


if($msg)
{
	?>
	<script language="javascript">
		  alert('<?=$msg?>');
		</script>
	<?
}
?>
<!DOCTYPE html>
<html>
<head>
<Script language="JavaScript">
  function OpenWind2(URL, title,w,h)
  {

	 var left = (screen.width/2)-(w/2);
     var top = (screen.height/2)-(h/2);
     var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	 
  }
</script>
<Script language="JavaScript">
  function Call_Category()
  {
	  //alert('Category');
	  document.frm.action="setupcat_edt.php?Type=Add";
	  document.frm.submit();
  }
  function Call_Summary()
  {
      //alert('Summary');	
	  document.frm.action="setupcat_edt.php?Type=grace";
	  document.frm.submit();
  }
  function RefreshMe()
  {
	  document.frm.action="setupcatall.php";
	  document.frm.submit();
  }
  function Summary()
  {
	  document.frm.action="setupcatall.php?Type=summary";
	  document.frm.submit();
  }
</script>
<Script language="JavaScript">
  function selectMe()
  {
	  
	var i = document.frm.length;
	for(j=0;j<i;++j)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
  }
</script>
<style>
body
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}
.editbox
{
  	display:none
}
td
{
	padding:5px;
}
.editbox
{
	font-size:14px;
	width:70px;
	background-color:#ffffcc;
	border:solid 1px #000;
	padding:4px;
}
.edit_tr:hover
{
	/*background-color:#6600CC;*/
	background:url(edit.png) right no-repeat #80C8E5; 
	cursor:pointer;
}
</style>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".edit_tr").click(function()
{
  var ID=$(this).attr('id');
  $("#first_"+ID).hide();
  $("#first_input_"+ID).show();
  }).change(function()
{
  var ID=$(this).attr('id');
  var first=$("#first_input_"+ID).val();
  temp = encodeURIComponent(first);
/*  var dataString = 'id='+ ID + '&grace=' + first + '&subject=' + <?PHP echo $subject ; ?> + '&term=' + <?PHP echo $term ; ?>;*/
  var dataString = 'id='+ ID + '&grace=' + temp;
  $("#first_"+ID).html('<img src="loader.gif" />'); // Loading image

	//alert(dataString);
	
if(first.length>0)
{

  $.ajax({
  type: "POST",
  url: "table_edit_ajax.php",
  data: dataString,
  cache: false,
  success: function(html) {
	$("#first_"+ID).html(first);
  }
 });
}
else
{
  //alert('Enter something.');
}

});

// Edit input box click action
$(".editbox").mouseup(function() 
{
  return false
});

// Outside click action
$(document).mouseup(function()
{
  $(".editbox").hide();
  $(".text").show();
});

});
</script>
</head>
<title>SETUP</title>
<body>
<form method="post" name="frm">
  <table align='center' class='forumline' width='100%'>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <?
	  $stsad=1;
	  $staffgrps=fetchrow(execute("SELECT group_id FROM staff_det WHERE id='$usergroup[1]'"));
	  ?>
		<?
        if($usergroup[0]=='adminm' || $usergroup[0]=='admin')
        {
			$stsad=0;
			?>
			<td>&nbsp;&nbsp;Category</td>
			<?
        }
       
	  ?>
     		<?
        if($staffgrps[0]!='1' && $usergroup[0]!='adminm'  && $staffgrps[0]!='1')
        {
			$stsad=0;
			?>
			<td>&nbsp;&nbsp;Category</td>
			<?
        }
       	if($stsad)
		{
		  ?>
		  <td>&nbsp;</td>
		  <?
		}
	  ?>

      <td>&nbsp;&nbsp;Assignment</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Class</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Term</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Category</td>
      <td>&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;</td>
		<?
        if($usergroup[0]=='adminm' || $usergroup[0]=='admin')
        {
			$stsad=0;
        ?>
        <td><input type="button"  value="Add"  style="width:86px; height:22px;"  href="javascript:void(0);" onClick="OpenWind2('category.php?subject=<?=$subject?>&term=<?=$term?>', 'OpenWind2', 800, 400)" class="bgbutton"></td>
        <?
		}
	  ?>
        <?
        if($staffgrps[0]!='1'  && $usergroup[0]!='adminm'  && $staffgrps[0]!='1')
        {
			$stsad=0;
        ?>
        <td><input type="button"  value="Add"  style="width:86px; height:22px;"  href="javascript:void(0);" onClick="OpenWind2('category.php?subject=<?=$subject?>&term=<?=$term?>', 'OpenWind2', 800, 400)" class="bgbutton"></td>
        <?
        }
		if($stsad)
		{
		  ?>
		  <td>&nbsp;</td>
		  <?
		}
	  ?>
      
      <td><input type="button"  value="Add"  style="width:86px; height:22px;"  href="javascript:void(0);" onClick="OpenWind2('assignment.php?subject=<?=$subject?>&category=<?=$category?>&term=<?=$term?>', 'OpenWind2', 800, 400)" class="bgbutton"></td>
    </tr>
    <tr>
    <?
	if($sts==2)
	{
	?>
      <td>&nbsp;&nbsp;
        <select name="subject" onChange="RefreshMe()">
          <option value=""></option>
          
		<?php
			$sql21=execute("SELECT d.head_id,a.class, a.section FROM all_teachers a,users b,class_section c,course_year d WHERE b.username='$user' AND c.id=a.section AND c.status=1 AND d.year_id=a.class AND b.srid IN ( sub_teac2, sub_teac, home_teac) ORDER BY a.class, a.section");
		while($r2=fetcharray($sql21))
		{
			$tmorets[]=$r2[2];
		}
		$sqnmars=execute("select c.id,c.codename,c.section_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and e.sub_type=2 and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
   	
    while($sqnmars1=fetcharray($sqnmars))
    {
        $tmorets[]=$sqnmars1[0];
    }
	$tmorets1=array_unique($tmorets);
	
	while (list(, $value) = each($tmorets1)) 
		{
		$j=$value;
			$sectname=fetchrow(execute("SELECT codename,section_name FROM `class_section` WHERE id='$j'"));

			if($subject==$j)
				echo "<option value='$j' selected>$sectname[0]-$sectname[1]</option>";
			else
				echo "<option value='$j'>$sectname[0]-$sectname[1]</option>";
			
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
      <td>&nbsp;&nbsp;
        <select name="subject" onChange="RefreshMe()">
          <option value=""></option>
          
		<?php
			$sqlSub=execute("SELECT * FROM class_section WHERE  status=1 order by grade,codename,section_name");
		  
          while($r1=fetcharray($sqlSub))
          {
              if($subject==$r1[id])
                  echo "<option value=$r1[id] selected>$r1[codename] - $r1[section_name]</option>";
              else
                  echo "<option value=$r1[id]>$r1[codename] - $r1[section_name]</option>";
          }
        ?>
        </select></td>
        <?
		}
		?>     
<br>  
     <?
		$CURDATE=date('Y-m-d');

	$termDate=fetcharray(execute("SELECT id FROM academic_term
WHERE CURDATE() between start_date AND end_date AND `a_year`='$a_year' AND `status`=1"));

		if($_POST['term']!=''){
			$term=$_POST['term'];
		}
		else{
			$term=$termDate[0];
		}
?>
      <td>&nbsp;&nbsp;
        <select name="term" onChange="RefreshMe()">
          <option value="">--- Select ---</option>
          <?php
          $sql=execute("SELECT `id`, `term` FROM `academic_term` WHERE `a_year`='$a_year' AND `status`=1  ORDER BY `id`");
		          //$term=$rermDate[0];
          while($r2=fetcharray($sql))
          {
              if($term==$r2[id])
                  echo "<option value=$r2[id] selected>$r2[term]</option>";
              else
                  echo "<option value=$r2[id]>$r2[term]</option>";
          }
      ?>
        </select></td>
      <td>&nbsp;&nbsp;
        <select name="category" onChange="RefreshMe()">
          <option value="">--- Select ---</option>
          <?php
$sql=execute("SELECT `id`, `title` FROM `grade_category` WHERE `a_year`='$a_year' AND `status`=1 AND `subject`='$subject' ORDER BY `id`");
          while($r3=fetcharray($sql))
          {
              if($category==$r3[id])
                  echo "<option value=$r3[id] selected>$r3[title]</option>";
              else
                  echo "<option value=$r3[id]>$r3[title]</option>";
          }
      ?>
        </select></td>
      <td><input type="button"  value="Summary"  style="width:86px; height:22px;" onClick="Summary()" class="bgbutton"></td>
      	<?
        if($usergroup[0]=='adminm' || $usergroup[0]=='admin')
        {
			$stsad=0;
        ?>
      <td><input type="button"  value="Set Up"  style="width:86px; height:22px;"  href="javascript:void(0);" onClick="OpenWind2('setup.php?subject=<?=$subject?>&term=<?=$term?>&category=<?=$category?>', 'OpenWind2', 800, 450)" class="bgbutton"></td>
      <?
		}
	  ?>
      	<?
        if($staffgrps[0]!='1'  && $usergroup[0]!='adminm'  && $staffgrps[0]!='1')
        {
			$stsad=0;
        ?>
      <td><input type="button"  value="Set Up"  style="width:86px; height:22px;"  href="javascript:void(0);" onClick="OpenWind2('setup.php?subject=<?=$subject?>&term=<?=$term?>&category=<?=$category?>', 'OpenWind2', 800, 450)" class="bgbutton"></td>
      <?
		}
		if($stsad)
		{
		  ?>
		  <td>&nbsp;</td>
		  <?
		}
	  ?>
      	<?
        if($usergroup[0]=='adminm' || $usergroup[0]=='admin')
        {
			$stsad=0;
        ?>
      <td><input type="button"  value="Edit" style="width:86px; height:22px"  href="javascript:void(0);" onClick="OpenWind2('category_edt.php?subject=<?=$subject?>&category=<?=$category?>', 'OpenWind2', 800, 500)" class="bgbutton"></td>
      <?
		}
	  ?>
      <?
        if($staffgrps[0]!='1'  && $usergroup[0]!='adminm'  && $staffgrps[0]!='1')
        {
			$stsad=0;
        ?>
      <td><input type="button"  value="Edit" style="width:86px; height:22px"  href="javascript:void(0);" onClick="OpenWind2('category_edt.php?subject=<?=$subject?>&category=<?=$category?>', 'OpenWind2', 800, 500)" class="bgbutton"></td>
      <?
		}
	  if($stsad)
		{
		  ?>
		  <td>&nbsp;</td>
		  <?
		}
	  ?>
      <td><input type="button"  value="Edit" style="width:86px; height:22px"  href="javascript:void(0);" onClick="OpenWind2('assignment_edt.php?subject=<?=$subject?>&category=<?=$category?>&term=<?=$term?>', 'OpenWind2', 800, 500)" class="bgbutton"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <BR>
  <div style="overflow-x:hidden;overflow-y:scroll; height:422px">
  <?php
  //+++++++++++++++++++++++++++++++++++   INSERTING NEW STUDENT DETAILS    +++++++++++++++++++++++++++++++++++++++++++
 
	$sqlIns=execute("SELECT a.id,a.first_name FROM student_m a,student_course b WHERE b.stu_id=a.id AND b.sub_sec=$subject AND b.acc_year='$a_year' GROUP BY b.stu_id ORDER BY a.first_name");	

	  while($rIns=fetcharray($sqlIns))
	  {
		 $student_id=$rIns['id'];
		 if($student_id!='')
		 {
		 	$tablename='grade_m_'.$subject.'_'.$term;
			
			//echo "<br>SELECT * FROM `$tablename` WHERE `student_id` = '$student_id' AND `status` = 1 AND user!=''";
			$chkName=rowcount(execute("SELECT id FROM `$tablename` WHERE `student_id` = '$student_id' AND `status` = 1 AND user!=''"));
			
			if($chkName < 1)
		    {
				//echo "<br>UPDATE `$tablename` SET user='$rIns[first_name]'";
				$rsu=execute("UPDATE `$tablename` SET user='$rIns[first_name]' WHERE `student_id` = '$student_id' ");	
			}
			
			//echo "<br>SELECT * FROM `$tablename` WHERE `student_id` = '$student_id' AND `status` = 1";
			$check=rowcount(execute("SELECT * FROM `$tablename` WHERE `student_id` = '$student_id' AND `status` = 1"));
			
		    if($check < 1)
		    {			
				//echo "<br>SELECT id FROM `$tablename` ORDER BY id DESC LIMIT 1";
			$id=fetcharray(execute("SELECT id FROM `$tablename` ORDER BY id DESC LIMIT 1")) or die('<center><blink>Please Create SetUp !</blink></center>');
				$id=$id[0] + 1;
				
				$sqlInsert="INSERT INTO `$tablename` (`id`, `student_id`, `term`, `subject`) 
				VALUES ('$id', '$student_id', '$term', '$subject')";
		
				 //echo "<br>".$sqlInsert;
				 $resultInsert = execute($sqlInsert) or die('<center><blink>Please Create SetUp !</blink></center>');
			 }
		 }
		  
	  }
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
if($Type!="summary"){


	$tablename='grade_m_'.$subject.'_'.$term;
	$rs=execute("SELECT * FROM $tablename LIMIT 1") or die('<center><blink>Please Select the Class !</blink></center>');
	?>
    <table align="left" border="1" class="forumline">
      <tr height="30"> 
        <td class="row3" align="center" width="190" nowrap>Student Name <BR></td>
        <?
       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
 
	    $resultCol=execute("SELECT `title`, `max_point`, `inserted_date`, `description`, `apply_grade`, `grade_type` FROM `grade_assessment` WHERE `subject`=$subject AND `category_id` = $category and status=1");
		$rowCount=rowcount($resultCol);
		
		/*$resultCount=execute("SELECT `id` FROM `grade_assessment` WHERE `subject`=$subject AND `category_id` = $category AND `apply_grade`='Y'  and status=1");
		$NoRowCount=rowcount($resultCount);*/
		
		//echo "<br>RowCount :".$NoRowCount;
		
		while($rCol=fetcharray($resultCol))      
		{
			if($rCol['apply_grade']=='Y')
			{
				$apply_grade='Applied to Report Card';
				$titleValue="Created Date :".date('d-M-Y', strtotime($rCol['inserted_date']))."
Maximum Point :$rCol[max_point]
Description :$rCol[description]
$apply_grade";

			?>
                <td class="row3" align="center" title="<?=$titleValue?>">
             <font color="#006600"><?=$rCol['title']?><BR><?PHP if($rCol['max_point']==0){ echo 'Letter';}else{ echo $rCol['max_point'];}?></font></td>
            <?
			}
			else
			{
				$apply_grade='Not Applied to Report Card';
				$titleValue="Created Date :".date('d-M-Y', strtotime($rCol['inserted_date']))."
Maximum Point :$rCol[max_point]
Description :$rCol[description]
$apply_grade";

			?>
                <td class="row3" align="center" title="<?=$titleValue?>">
                <font color="#990000"><?=$rCol['title']?><BR><?PHP if($rCol['max_point']==0){ echo 'Letter';}else{ echo $rCol['max_point'];}?></font></td>
            <?
			}
				//++++++++++++++++++++++++++++++++++++++++++++++
				if($rCol['grade_type']=='alphabet'){
					 $flag=1;
				}else{
					 $flag=0;
				}

		 }
		 if($category==''){
		?>
            <td class="row3" align="center" title="New Header" width="100px"></td>
            <td class="row3" align="center" title="New Header" width="100px"></td>
            <td class="row3" align="center" title="New Header" width="100px"></td>
            <td class="row3" align="center" title="New Header" width="100px"></td>
        <?
		 }
		 
		
	  if($category!=''){
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	  	if($flag==0){
	   ?>
      	   <!--<td class="row3" align="center" width="50">AVG<BR></td>-->
          <?
		   }
		  ?>
          <td class="row3" align="center" width="50">GRADE <BR></td>
      <?
	  }
	  ?>
      </tr>
      <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
      <?
		   $qResult = execute ("SELECT * FROM `grade_avg` WHERE `subject` = '$subject' AND `status` ='1'");
			$itms=fetcharray($qResult);
			
				$sql=execute("SELECT a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem FROM student_m a,student_course b WHERE b.stu_id=a.id  AND a.archive='N' AND b.sub_sec='$subject' AND b.acc_year='$a_year' group by b.stu_id ORDER BY a.first_name");	
			
	 
	 ?>
      
      <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
      
      <tr>
        <?php
			$sno=1;
			$count=1;
			$avg=0;	
            while($r=fetcharray($sql))
			{
				if($sno<10)
				{
					$sno="0".$sno;
				}
				
				if($i%2)
					echo "<tr class=''>";
				else
					echo "<tr>";
					
				$resultCount=execute("SELECT `id` FROM `grade_assessment` WHERE `subject`=$subject AND `category_id` = $category AND `apply_grade`='Y'  and status=1");
		$NoRowCount=rowcount($resultCount);
					
			?>
        <input type="hidden" name="Sel[]" value="<?=$r['id']?>" >
        <td align='left' >&nbsp;
          <?=$sno?>.&nbsp;&nbsp;<?=$r['first_name']?>&nbsp;<?=$r['last_name']?></td>
        <?
       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
		
		$resultCol=execute("SELECT `id`,`title`,`max_point` FROM `grade_assessment` WHERE `subject`='$subject' AND `category_id` ='$category' and status=1");
		
		$resultRow=execute("SELECT `id`,`title`,`max_point` FROM `grade_assessment` WHERE `subject`='$subject' AND `category_id` ='$category' AND `apply_grade`='Y' and status=1");
		$newRow=rowcount($resultRow);
	
		
		 $sum=0;$exceptionCount=0;	 
		while($rCol=fetcharray($resultCol))      
		{
			
			$string = str_replace(' ', '_', $rCol['title']);
			$field=$string.'_'.$category;
	        
			$tablename='grade_m_'.$subject.'_'.$term;
			
			//echo "<br>SELECT $field FROM `$tablename` WHERE `term`='$term' AND student_id='$r[id]'";
			
			$colValue=fetcharray(execute("SELECT $field FROM `$tablename` WHERE `term`='$term' AND student_id='$r[id]'"));
			
		
		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX		 EXCEPTION COUNT 	 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			//echo "colValue :".$colValue[$field]."\n";
			 
			 $displayTitle='';
			 $SqlException="SELECT `exception`, `description` FROM `grade_m_exception` WHERE status=1 ORDER BY id";	
					$rsExp = execute($SqlException) or die(mysql_error());	
					while($re=fetcharray($rsExp))
					{
						if($colValue[$field]==$re['exception']){
							$displayTitle=$re['description'];
							$exceptionCount++;
						}
					}
		
				//echo "<br>ExceptionCount :".$exceptionCount."\n";
			
		  ?>
            <td nowrap align="center" width="5" title="<?=$displayTitle?>">
            <Input Type="Text" Name="<?=$r['id']?><?=$rCol['title']?>" value="<?=$colValue[$field]?>" size="10" ></td>
         <?
         
		 
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	 
		 $resultColN=fetcharray(execute("SELECT `id`, `title`,`max_point`,`grade_type` FROM `grade_assessment` WHERE `subject`='$subject' AND `category_id` ='$category' AND `term`='$term' AND `apply_grade`='Y' AND id='$rCol[id]' and status=1"));
	    
	#############################################################################################################################
						if($itms['letter1']==$colValue[$field]){				/*CONDITIONS FOR DISPALY GRADES*/
							$gradeValue=$itms['avg1'];		
						}elseif($itms['letter2']==$colValue[$field]){
							$gradeValue=$itms['avg2'];
						}elseif($itms['letter3']==$colValue[$field]){
							$gradeValue=$itms['avg3'];
						}elseif($itms['letter4']==$colValue[$field]){
							$gradeValue=$itms['avg4'];
						}elseif($itms['letter5']==$colValue[$field]){
							$gradeValue=$itms['avg5'];
						}elseif($itms['letter6']==$colValue[$field]){
							$gradeValue=$itms['avg6'];
						}elseif($itms['letter7']==$colValue[$field]){
							$gradeValue=$itms['avg7'];
						}elseif($itms['letter8']==$colValue[$field]){
							$gradeValue=$itms['avg8'];
						}elseif($itms['letter9']==$colValue[$field]){
							$gradeValue=$itms['avg9'];
						}elseif($itms['letter10']==$colValue[$field]){
							$gradeValue=$itms['avg10'];
						}elseif($itms['letter11']==$colValue[$field]){
							$gradeValue=$itms['avg11'];
						}elseif($itms['letter12']==$colValue[$field]){
							$gradeValue=$itms['avg12'];
						}elseif($itms['letter13']==$colValue[$field]){
							$gradeValue=$itms['avg13'];
						}elseif($itms['letter14']==$colValue[$field]){
							$gradeValue=$itms['avg14'];
						}elseif($itms['letter15']==$colValue[$field]){
							$gradeValue=$itms['avg15'];
						}
						
					$SqlExceptiong="SELECT `exception` FROM `grade_m_exception` WHERE status=1 ORDER BY id";	
					$rsExpg = execute($SqlExceptiong) or die(mysql_error());	
					while($reg=fetcharray($rsExpg))
					{
						if($colValue[$field]==$reg['exception']){
							$gradeValue=0;
						}
					}
			
			//echo "<br>".$colValue[$field];
			//echo "<br>".$gradeValue;
	
	#############################################################################################################################	
			
		if($resultColN['id']!='')
		{
			 
		 	$stringN = str_replace(' ', '_', $resultColN['title']);
			$fieldN=$string.'_'.$category;
			
			$tablename='grade_m_'.$subject.'_'.$term;
			
		$colValueN=fetcharray(execute("SELECT $fieldN FROM `$tablename` WHERE `student_id`=$r[id] AND `term`='$term'"));

   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++			
			  	if($resultColN['grade_type']=='alphabet')
				{
			  		 //echo "<br>gradeValue :".$gradeValue;
					 $sum = ($sum + $gradeValue);		
				}
				else
				{
					$field_avg = ( $colValueN[$fieldN] * 100 )/$rCol['max_point'];
			  		$sum = $sum + $field_avg;
				}		
		}
	}
		 if($category!=''){
			 
				if($exceptionCount > $NoRowCount){
					//echo '<br>Exception Greater';
				}else{
					$NoRowCount=$NoRowCount - $exceptionCount;
					$avg=round(($sum / $NoRowCount),0);
					
				}
				 //echo "<br>NoRowCount :".$NoRowCount;
				 //echo "<br>Sum :".$sum;
				 //echo "<br>Average :".$avg;
					 	       
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	  			if($flag==0){
	    	?>
           		 <!--<td nowrap align="center"><?=$avg?>.00</td>-->
         	<?
				}
						if($avg <= $itms['avg1'] and $avg > $itms['avg2']){				/*CONDITIONS FOR DISPALY GRADES*/
							$display=$itms['letter1'];		
						}elseif($avg <= $itms['avg2'] and $avg > $itms['avg3']){
							$display=$itms['letter2'];
						}elseif($avg <= $itms['avg3'] and $avg > $itms['avg4']){
							$display=$itms['letter3'];
						}elseif($avg <= $itms['avg4'] and $avg > $itms['avg5']){
							$display=$itms['letter4'];
						}elseif($avg <= $itms['avg5'] and $avg > $itms['avg6']){
							$display=$itms['letter5'];
						}elseif($avg <= $itms['avg6'] and $avg > $itms['avg7']){
							$display=$itms['letter6'];
						}elseif($avg <= $itms['avg7'] and $avg > $itms['avg8']){
							$display=$itms['letter7'];
						}elseif($avg <= $itms['avg8'] and $avg > $itms['avg9']){
							$display=$itms['letter8'];
						}elseif($avg <= $itms['avg9'] and $avg > $itms['avg10']){
							$display=$itms['letter9'];
						}elseif($avg <= $itms['avg10'] and $avg > $itms['avg11']){
							$display=$itms['letter10'];
						}elseif($avg <= $itms['avg11'] and $avg > $itms['avg12']){
							$display=$itms['letter11'];
						}elseif($avg <= $itms['avg12'] and $avg > $itms['avg13']){
							$display=$itms['letter12'];
						}elseif($avg <= $itms['avg13'] and $avg > $itms['avg14']){
							$display=$itms['letter13'];
						}elseif($avg <= $itms['avg14'] and $avg > $itms['avg15']){
							$display=$itms['letter14'];
						}else{
							$display=$itms['letter15'];
						}
					?>
                      <td align="left" nowrap>&nbsp;&nbsp;<?=$display?>&nbsp;</td>
                <?
		 }
		if($category==''){
		?>
            <td  align="center" title="New field" width="100px"></td>
            <td  align="center" title="New field" width="100px"></td>
            <td  align="center" title="New field" width="100px"></td>
            <td  align="center" title="New field" width="100px"></td>
        <?
		 }
		    
			if($subject!='' and $category!='' and $term!=''){
				
					$tablename='grade_m_'.$subject.'_'.$term;
					
					//$sqlUd="UPDATE `$tablename` SET `avg_$category` = '$avg' WHERE `student_id`= $r[id]";
					
					//$resultUd=execute($sqlUd) or die();
					
					if(rowcount(execute("SHOW COLUMNS FROM $tablename LIKE '"."avg_".$category."'"))==1)
					{ 					
							$sqlUd="UPDATE `$tablename` SET `avg_$category` = '$avg' WHERE `student_id`= $r[id]";
							$resultUd=execute($sqlUd) or die(mysql_error());
					}
					else{
						 //echo "<br>Category does not exist";
					}
		
					
			}
		
			++$count;
			++$sno;
			 ++$i;
		      
		       $rowclass = 1 - $rowclass;
			}
            ?>
      </tr>
    </table>
    </div>


  <?
 }
 else{
	
//##############################################    GRADE SUMMARY PART   ########################################################
//
//
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

?>
<div style="overflow-y:hidden;overflow-x:scroll; width: 100%">
  <table align="left" border="1" class="forumline">
      <tr height="30"> 
        <td  class="row3" align="center" width="190" nowrap>Student Name<BR></td>
        <?
       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  ++++++++++++++++++++++++++++++++++++++
	/*DISPLAY ASSIGNMENT FOLLOWED BY CATEGORY*/
	 
	  $resultCol=execute("SELECT a.title, a.max_point, a.inserted_date, a.description, a.apply_grade, a.grade_type, b.id FROM grade_assessment a, grade_category b WHERE a.subject=$subject and a.status=1 AND b.status=1 AND a.category_id=b.id ORDER BY a.category_id");
		$rowCount=rowcount($resultCol);
		
		$resultCount=execute("SELECT `id` FROM `grade_assessment` WHERE `subject`='$subject' AND `apply_grade`='Y'  and status=1 ORDER BY category_id");
		$NoRowCount=rowcount($resultCount);
		while($rCol=fetcharray($resultCol))      
		{
			
		$categoryTitle=fetcharray(execute("SELECT title FROM grade_category WHERE id='$rCol[id]' LIMIT 1"));
		
			if($rCol['apply_grade']=='Y')
			{
				$apply_grade='Applied to Report Card';
				$titleValue="Created Date :".date('d-M-Y', strtotime($rCol['inserted_date']))."
Category :$categoryTitle[title]
Description :$rCol[description]
$apply_grade";
			?>
                <td class="row3" align="center" title="<?=$titleValue?>" >&nbsp;
             <font color="#006600"><?=$rCol['title']?><BR><?PHP if($rCol['max_point']==0){ echo 'Letter';}else{ echo $rCol['max_point'];}?></font>&nbsp;</td>
            <?
			}
			else
			{
				$apply_grade='Not Applied to Report Card';
				$titleValue="Created Date :".date('d-M-Y', strtotime($rCol['inserted_date']))."
Category :$categoryTitle[title]
Description :$rCol[description]
$apply_grade";

			?>
                <td class="row3" align="center" title="<?=$titleValue?>" >&nbsp;
                <font color="#990000"><?=$rCol['title']?><BR><?PHP if($rCol['max_point']==0){ echo 'Letter';}else{ echo $rCol['max_point'];}?></font>&nbsp;</td>
            <?
			}
				//++++++++++++++++++++++++++++++++++++++++++++++
				if($rCol['grade_type']=='alphabet'){
					 $flag=1;
				}else{
					 $flag=0;
				}

		 }
		 //----------------------------------------------------------------------------------------------------
	 
	 
	/*  $method=fetcharray(execute("SELECT `cal_method` FROM `grade_setup` WHERE `subject`='$subject' AND `status`=1"));
		  
	    $resultGrade=execute("SELECT `id`,`title`,`weight` FROM `grade_category` WHERE `subject`= '$subject' AND `status`=1");
		
		while($rGrade=fetcharray($resultGrade))      
		{
   $maxPoint=fetcharray(execute("SELECT SUM(max_point) FROM grade_assessment WHERE category_id='$rGrade[id]' AND `apply_grade`='Y' and status=1"));
		 	  ?>
        		<td class="row3" align="center"><?=$rGrade['title']?><BR>
				<?
				  if($method['cal_method']==2)
	 			  {
					  echo $rGrade['weight']?></td>
                    <?  
				  }if($method['cal_method']==1){
				       echo $maxPoint[0]?></td>
           	  <?
				  }
		 }*/
	  
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 ?>
     		<!--<td class="row3" align="center">&nbsp;AVG&nbsp;<BR></td>-->
            <td class="row3" align="center">&nbsp; SYSTEM &nbsp;<br>GRADE &nbsp;<BR></td>
            <td class="row3" align="center">&nbsp; EDITABLE &nbsp;<br>GRADE &nbsp;<BR></td>
      </tr>
      <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
      <?
			
				$sql=execute("SELECT a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem FROM student_m a,student_course b WHERE b.stu_id=a.id  AND a.archive='N' AND b.sub_sec='$subject' AND b.acc_year='$a_year' group by b.stu_id ORDER BY a.first_name");	
			
	  ?>
      
      <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->      
      <tr>
        <?php
			
			$qResult = execute ("SELECT * FROM `grade_avg` WHERE `subject` = '$subject' AND `status` ='1'");
			$itms=fetcharray($qResult);
			
        $method=fetcharray(execute("SELECT `cal_method` FROM `grade_setup` WHERE `subject` = '$subject' AND `status`=1"));
		  
				$sno=1;
				$count=1;
				$k = 9;
				
            while($r=fetcharray($sql))
			{
				
				if($sno<10)
				{
					$sno="0".$sno;
				}
				
				if($i%2)
					echo "<tr class=''>";
				else
					echo "<tr>";
					
	  ?>
        <td align='left' >&nbsp;
          <?=$sno?>.&nbsp;&nbsp;<?=$r['first_name']?>&nbsp;<?=$r['last_name']?></td>
        <?
       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
			$tablename='grade_m_'.$subject.'_'.$term;
	
	
	$SqlAvg=execute("SELECT * FROM $tablename WHERE `student_id` = '$r[id]' AND `status` = 1 AND `term`='$term'");
		 $rowAvg=rowcount($SqlAvg);
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

$resultColV=execute("SELECT a.category_id, a.title, a.max_point, a.inserted_date, a.description, a.apply_grade, a.grade_type FROM grade_assessment a ,grade_category b WHERE a.subject=$subject AND a.status=1 AND b.status=1 AND a.category_id=b.id ORDER BY a.category_id");

/*$resultCol=execute("SELECT a.title, a.max_point, a.inserted_date, a.description, a.apply_grade, a.grade_type FROM grade_assessment a, grade_category b WHERE a.subject=$subject and a.status=1 AND b.status=1 AND a.category_id=b.id ORDER BY a.category_id");*/

		$rowCount=rowcount($resultColV);
		
	
		$resultCount=execute("SELECT `id` FROM `grade_assessment` WHERE `subject`=$subject AND `apply_grade`='Y'  and status=1 ORDER BY category_id");
		$NoRowCount=rowcount($resultCount);
		
				 $sum=0;		 
		while($rCol=fetcharray($resultColV))      
		{
			
			$string = str_replace(' ', '_', $rCol['title']);
			$field=$string.'_'.$rCol['category_id'];
			
			//echo "<br>".$rCol['category_id'];
	        
			$tablename='grade_m_'.$subject.'_'.$term;
			
			//echo "<br>SELECT $field FROM `$tablename` WHERE `term`='$term' AND student_id='$r[id]'";
			
			$colValue=fetcharray(execute("SELECT `category`,$field FROM `$tablename` WHERE `term`='$term' AND student_id='$r[id]'"));
			
		  ?>
            <td nowrap align="center" width="10"><?=$colValue[$field]?></td>
         <?
		}

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
			
			$avg_sum=0;
			while($rAvg=fetcharray($SqlAvg))
			{	
						
				$SqlCat=execute("SELECT `id`,`weight` FROM `grade_category` WHERE `subject` = '$subject' AND `status` = '1'");
			    $rowCountFirst=rowcount($SqlCat); 
				
				while($rf=fetcharray($SqlCat))
				{		
	
	
	$SqlAssm=execute("SELECT `id` FROM `grade_assessment` WHERE `subject` = '$subject' AND `status` =1 AND category_id='$rf[id]'");
					$rowCount=rowcount($SqlAssm); 
				
						$field='avg_'.$rf['id'];
						
						if($method['cal_method']==1){
	
							$points=$rAvg[$field] * $rowCount;
						
				   ?>
                	   <td align="center" nowrap><?=$points?></td>
                   <?
						}if($method['cal_method']==2){
							
							$avg_sum = $avg_sum + (($rAvg[$field] * $rf['weight']))/100;
							
							//echo "<br>rAvg :".$rAvg[$field] * $rf['weight'];
							//echo "<br>avg_sum :".$avg_sum;
				  
						}
				   		//$sum = $sum + $rAvg[$field];
						//echo "<br>rAvg :".$rAvg[$field];
						
					}

						//echo "<br>RowCountCategory :".$rowCountFirst;
						//echo "<br>sum :".$sum;

						//$avg = round(($sum / $rowCountFirst),0);
						
						
					   // echo "<br>avg :".$avg;
						$avg=$avg_sum;
					
					

						if($avg <= $itms['avg1'] and $avg > $itms['avg2']){				/*CONDITIONS FOR DISPALY GRADES*/
							$display=$itms['letter1'];		
						}elseif($avg <= $itms['avg2'] and $avg > $itms['avg3']){
							$display=$itms['letter2'];
						}elseif($avg <= $itms['avg3'] and $avg > $itms['avg4']){
							$display=$itms['letter3'];
						}elseif($avg <= $itms['avg4'] and $avg > $itms['avg5']){
							$display=$itms['letter4'];
						}elseif($avg <= $itms['avg5'] and $avg > $itms['avg6']){
							$display=$itms['letter5'];
						}elseif($avg <= $itms['avg6'] and $avg > $itms['avg7']){
							$display=$itms['letter6'];
						}elseif($avg <= $itms['avg7'] and $avg > $itms['avg8']){
							$display=$itms['letter7'];
						}elseif($avg <= $itms['avg8'] and $avg > $itms['avg9']){
							$display=$itms['letter8'];
						}elseif($avg <= $itms['avg9'] and $avg > $itms['avg10']){
							$display=$itms['letter9'];
						}elseif($avg <= $itms['avg10'] and $avg > $itms['avg11']){
							$display=$itms['letter10'];
						}elseif($avg <= $itms['avg11'] and $avg > $itms['avg12']){
							$display=$itms['letter11'];
						}elseif($avg <= $itms['avg12'] and $avg > $itms['avg13']){
							$display=$itms['letter12'];
						}elseif($avg <= $itms['avg13'] and $avg > $itms['avg14']){
							$display=$itms['letter13'];
						}elseif($avg <= $itms['avg14'] and $avg > $itms['avg15']){
							$display=$itms['letter14'];
						}else{
							$display=$itms['letter15'];
						}
						 
						
					//echo "<br>Student ID :".$r['id'];
					?>
                    <input type="hidden" name="Sel[]" value="<?=$r['id']?>" >
                    
                      <td align="center" nowrap>&nbsp;<?=$display?>&nbsp;</td>
                      
                      <? 
					  if($colValue[category]){
 							
				 		$graceValue=fetcharray(execute("SELECT `letter` FROM `grade_grace` WHERE `id`='$colValue[category]'"));						
				      ?>
          			  <td align="center" id="<?=$r['id']?>" class="edit_tr" >
               <!--<input type="text" name="<?=$r['id']?>grace" value="<?=$graceValue[letter]?>" size="2" style="background-color:#0F0;">-->
                    <span id="first_<?=$r['id']?>" class="text" style="background-color:#0F0;"><?=$graceValue[letter]?></span>
                    <input type="text" value="<?=$graceValue[letter]?>" class="editbox" id="first_input_<?=$r['id']?>"  />
              	 	
  
               </td>
                      <?   }else{  
				
					   ?>
                      <td align="center" id="<?=$r['id']?>" class="edit_tr" >
               <!--<input type="text" name="<?=$r['id']?>grace" value="<?=$display?>" size="2" style="background-color:#0F0;">-->
              					
                    <span id="first_<?=$r['id']?>" class="text"><?=$display?></span>
                    <input type="text" value="<?=$display?>" class="editbox" id="first_input_<?=$r['id']?>" />
               </td>
                    <?
					  }
				     $sum=0;
					 
			}
			if($rowAvg=='' or $rowAvg==0)
			{
				?>
				<!--<td>&nbsp;&nbsp;</td>-->
				<td>&nbsp;&nbsp;</td>
				<?
			}
		
			
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			 
			++$count;
			++$sno;
			++$i;
		      
		    $rowclass = 1 - $rowclass;
	}
      ?>
      </tr>
    </table>
     </div>

<?
 } if($Type=="summary"){
?>
  <!-- <p align="center">
    <input type="button"  value="Save"  style="width:86px; height:22px" onClick="Call_Summary()" class="bgbutton">
  </p> -->
  <? }else{ ?>
    
   <p align="center">
    <input type="button"  value="Save"  style="width:86px; height:22px" onClick="Call_Category()" class="bgbutton">
  </p>
  <? } ?>
</form>
</body>
</html>
