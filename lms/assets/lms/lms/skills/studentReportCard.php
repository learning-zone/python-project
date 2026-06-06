<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
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
  	//echo die("You don't have rights"); 
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
	$studID = $_GET['studID'];
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
	$studID = $_POST['studID'];
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
	 
	  document.frm.action="setupcat_edt.php?Type=Add";
	  document.frm.submit();
  }
  function Call_Summary()
  {
      
	  document.frm.action="setupcat_edt.php?Type=grace";
	  document.frm.submit();
  }
  function RefreshMe()
  {
	  document.frm.action="studentReportCard.php";
	  document.frm.submit();
  }
  function Summary()
  {
	  document.frm.action="studentReportCard.php?Type=summary";
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
  var dataString = 'id='+ ID + '&grace=' + temp;
  $("#first_"+ID).html('<img src="loader.gif" />'); // Loading image
	
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
      
	<?
        if($staffgrps[0]!='1' && $usergroup[0]!='adminm'  && $staffgrps[0]!='1')
        {
			$stsad=0;
			?>
			<!--<td>&nbsp;&nbsp;Student</td>-->
			<?
        }
       	if($stsad)
		{
		  ?>
		  <td>&nbsp;</td>
		  <?
		}
	  ?>

    </tr>
    <tr>
   
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Class</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Term</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Student</td>
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
				$sql1=execute("SELECT d.head_id,a.class, a.section FROM all_teachers a,users b,class_section c,course_year d WHERE b.username='$user' AND c.id=a.section AND c.status=1 AND d.year_id=a.class AND b.srid IN ( sub_teac2, sub_teac, home_teac) ORDER BY a.class, a.section");
		while($r2=fetcharray($sql1))
		{
			$tmorets[]=$r2[2];
		}
		$sqnmars=mysql_query("select c.id,c.codename,c.section_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
   	
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
          <option value="">  </option>
          
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
         <select name="studID" onChange="RefreshMe()">
          <option value="">--- Select ---</option>
          <?php
$sql=execute("SELECT a.id,a.student_id,a.first_name,a.last_name FROM student_m a,student_course b WHERE b.stu_id=a.id  AND a.archive='N' AND b.sub_sec='$subject' AND b.acc_year='$a_year' group by b.stu_id ORDER BY a.first_name");
          while($r3=fetcharray($sql))
          {
              if($studID==$r3[id])
                  echo "<option value=$r3[id] selected>$r3[first_name] &nbsp; $r3[last_name]</option>";
              else
                  echo "<option value=$r3[id]>$r3[first_name] &nbsp; $r3[last_name]</option>";
          }
      ?>
        </select></td>
        
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <BR>
  <div style="overflow-x:hidden;overflow-y:scroll; height:422px">
  <?php
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


			if($rCol['inserted_date'] >= '2013-10-21'){  /*TO DIFFIRIENCIATE GRADES*/					
					?>
                 <td class="row3" align="center" title="<?=$titleValue?>">
                <font color="#0066FF"><?=$rCol['title']?><BR><?PHP if($rCol['max_point']==0){ echo 'Letter';}else{ echo $rCol['max_point'];}?></font></td>
                    <?
				}else{
					
					?>
                 <td class="row3" align="center" title="<?=$titleValue?>">
                <font color="#006600"><?=$rCol['title']?><BR><?PHP if($rCol['max_point']==0){ echo 'Letter';}else{ echo $rCol['max_point'];}?></font></td>
                    
                    <?
				}
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
	  
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 ?>
           <!-- <td class="row3" align="center">&nbsp; SYSTEM &nbsp;<br>GRADE &nbsp;<BR></td>-->
            <td class="row3" align="center" nowrap> Mid-Semester 1<BR></td>
      </tr>
      <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
      <?
			$sql=execute("SELECT a.id,a.student_id,a.first_name,a.last_name,a.admission_id,a.course_yearsem FROM student_m a,student_course b WHERE b.stu_id=a.id  AND a.archive='N' AND b.sub_sec='$subject' AND b.acc_year='$a_year' AND a.id='$studID' group by b.stu_id ORDER BY a.first_name");	
			
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
			
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX		 EXCEPTION COUNT 	 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
						 
			 $displayTitle='';
			 $SqlException="SELECT `exception`, `description` FROM `grade_m_exception` WHERE status=1 ORDER BY id";	
					$rsExp = execute($SqlException);	
					while($re=fetcharray($rsExp))
					{
						if($colValue[$field]==$re['exception']){
							$displayTitle=$re['description'];
						}
					}
						
		  ?>
            <td nowrap align="center" width="10" title="<?=$displayTitle?>"><?=$colValue[$field]?></td>
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
					  
						}						
					}

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
                    
                     <!-- <td align="center" nowrap>&nbsp;<?=$display?>&nbsp;</td>-->
                      
                      <? 
					  if($colValue[category]){
 							
				 		$graceValue=fetcharray(execute("SELECT `letter` FROM `grade_grace` WHERE `id`='$colValue[category]'"));						
				      ?>
          			  <td align="center" id="<?=$r['id']?>" class="edit_tr" >
                      <span id="first_<?=$r['id']?>" class="text" style="background-color:#0F0;"><?=$graceValue[letter]?></span>
                      <input type="text" value="<?=$graceValue[letter]?>" class="editbox" id="first_input_<?=$r['id']?>" readonly  />
              	 	
  
               </td>
                      <?   }else{  
				
					   ?>
                      <td align="center" id="<?=$r['id']?>" class="edit_tr" >           					
                      <span id="first_<?=$r['id']?>" class="text"><?=$display?></span>
                      <input type="text" value="<?=$display?>" class="editbox" id="first_input_<?=$r['id']?>" readonly />
               </td>
                    <?
					  }
				     $sum=0;
					 
			}
			if($rowAvg=='' or $rowAvg==0)
			{
				?>
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
     </div></div>
</form>
</body>
</html>
