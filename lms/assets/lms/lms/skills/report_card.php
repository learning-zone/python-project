<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/
$user=$_SESSION['user'];

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
if(rowcount($sql)!=0)
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


$user = $_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];

if($_POST)
{
	$term=$_POST['term'];
	$subject = $_POST['subject'];
	$category = $_POST['category'];
	$comments = $_POST['comments'];
	$grade_type = $_POST['grade_type'];
	
	$_SESSION['term'] = $term;
	$_SESSION['subject'] = $subject;

}
if($_GET)
{
	$msg=$_REQUEST['msg'];	
	$Type=$_REQUEST['Type'];
	$term=$_REQUEST['term'];
    $subject = $_REQUEST['subject'];
	$category = $_REQUEST['category'];
	
	if($Type!='')
	{
		$category='';
	}
}
if($_GET['Type']!='')
{
	$_SESSION['Type'] = $Type;
}else{
	$_SESSION['Type'] = '';
}

if(!$term)
{
	$term=1;
}

if($msg)
{
?>
<script language="javascript">
	  //alert("<?=$msg?>");
    </script>
<?
}
?>
<!DOCTYPE html><head>
<style type="text/css">
body
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}
.editbox
{
  	display:none
}

.editbox
{
	font-size:14px;
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
td.marks
{
	padding-left:180px;
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
  
 // temp = encodeURIComponent(first);
  temp=first;
	//alert(temp);
  var dataString = 'id='+ ID + '&comment=' + temp;
  $("#first_"+ID).html('<img src="loader.gif" />'); // Loading image
	
//if(first.length>0)
{
 
  $.ajax({
  type: "POST",
  url: "table_edit_ajax3.php",
  data: dataString,
  cache: false, 
  
  success: function(html) {
	$("#first_"+ID).html(first);
  }
 });
  	
}
//else
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
<Script language="JavaScript">
  function OpenWind2(URL, title,w,h)
  {

	 var left = (screen.width/2)-(w/2);
     var top = (screen.height/2)-(h/2);
     var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	 
  }
</script>
<Script language="JavaScript">
  function adds_onclick()
  {
	  document.frm.action="report_card_edt.php?Type=Add";
	  document.frm.submit();
  }
  function RefreshMe()
  {
	  document.frm.action="report_card.php";
	  document.frm.submit();
  }
</script>
<Script language="JavaScript">
  function Comments()
  {
	  document.frm.action="report_card.php?Type=comments";
	  document.frm.submit();  
  }
</script>
<Script language="JavaScript">
  function Marks()
  {
	  document.frm.action="report_card.php?Type=''";
	  document.frm.submit();  
  }
</script>
</head>


<title>REPORT CARD</title>
<body >
<form method="post" name="frm">
  <table align='center' class='forumline' width='98%'>
    <tr>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
  </tr>
    <tr>
      <td style="background-color:#FFF">&nbsp;&nbsp;&nbsp;&nbsp;Class</td>
       <td style="background-color:#FFF">&nbsp;&nbsp;&nbsp;&nbsp;Term</td>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>

    </tr>
    <tr>
   <? if($sts==2){
	?>
      <td style="background-color:#FFF">&nbsp;&nbsp;
        <select name="subject" onChange="RefreshMe()">
          <option value=""></option>
          
		<?php
			$sql21=execute("SELECT d.head_id,a.class, a.section FROM all_teachers a,users b,class_section c,course_year d WHERE b.username='$user' AND c.id=a.section AND c.status=1 AND d.year_id=a.class AND b.srid IN ( sub_teac2, sub_teac, home_teac) ORDER BY a.class, a.section");
		while($r2=fetcharray($sql21))
		{
			$tmorets[]=$r2[2];
		}
		$sqnmars=execute("select c.id,c.codename,c.section_name from staff_class_group a,users b,class_section c,course_year d,subject_m e where b.username='$user'  and c.id=a.section and c.status=1 and c.sub=e.subject_id and d.year_id=a.grade and b.srid=a.staff_id order by a.grade, a.section");
   	
    while($sqnmars1=fetcharray($sqnmars))
    {
        $tmorets[]=$sqnmars1[0];
    }
	$tmorets1=array_unique($tmorets);
	
	while (list(, $value) = each($tmorets1)) 
	{
		$j=$value;
			$sectname=fetcharray(execute("SELECT codename,section_name FROM `class_section` WHERE id='$j'"));

			if($subject==$j)
				echo "<option value='$j' selected>$sectname[0]-$sectname[1]</option>";
			else
				echo "<option value='$j'>$sectname[0]-$sectname[1]</option>";
			
		}
		
        ?>
        </select></td>
        <?
		}

	if($sts==1){
	?>
      <td style="background-color:#FFF">&nbsp;&nbsp;
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
        <? } ?>     
        <td style="background-color:#FFF">&nbsp;&nbsp;
        <select name="term" onChange="RefreshMe()">
          <option value="">--- Select ---</option>
          <?php
          $sql=execute("SELECT `id`, `term` FROM `academic_term` WHERE `a_year`=$a_year AND `status`=1  ORDER BY `id`");
          while($r2=fetcharray($sql))
          {
              if($term==$r2[id])
                  echo "<option value=$r2[id] selected>$r2[term]</option>";
              else
                  echo "<option value=$r2[id]>$r2[term]</option>";
          }
      ?>
        </select></td>
      <!--<td style="background-color:#FFF"><input type="button"  value="Load Grade"  style="width:88px;" href="javascript:void(0);" onClick="OpenWind2('load_grade.php?subject=<?=$subject?>', 'OpenWind2', 300, 200)" class="bgbutton"></td>-->
      <td style="background-color:#FFF">&nbsp;&nbsp;</td>
      <td style="background-color:#FFF" nowrap><input type="button"  value="Comments"  style="width:86px;"  onClick="Comments()" class="bgbutton">&nbsp;&nbsp;<input type="button"  value="Grade"  style="width:86px;"  onClick="Marks()" class="bgbutton"></td>
    </tr>
    <tr>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
    </tr>
  </table>
  <BR>
 <?
 if($Type=="comments"){

  ?>
   <table width="98%" border="1" align="center" cellspacing="0" cellpadding="0" class="forumline"  >

   <tr height="25">
          
          <td align="center" class="row3" width="5%" nowrap>&nbsp;Sl No.&nbsp;</td>
          <td align="center" class="row3" width="20%" nowrap>&nbsp;Student Name&nbsp;</td>
          <td align="center" class="row3" width="75%" nowrap>&nbsp;Comments&nbsp;</td>
     </tr>
    <?
	
			$tablename='grade_m_'.$subject.'_'.$term;
			
			//echo "<br>SELECT c.id,c.comments,a.first_name,a.last_name FROM student_m a,student_course b, $tablename c WHERE b.stu_id=a.id AND b.sub_sec='$subject' AND b.acc_year='$a_year' AND a.archive='N' AND c.student_id=a.id GROUP BY b.stu_id ORDER BY a.first_name";
			
			$sql=execute("SELECT c.id,c.comments,a.first_name,a.last_name FROM student_m a,student_course b, $tablename c WHERE b.stu_id=a.id AND b.sub_sec='$subject' AND b.acc_year='$a_year' AND a.archive='N' AND c.student_id=a.id GROUP BY b.stu_id ORDER BY a.first_name");
			
	     //$sql=execute("SELECT a.id,a.comments, b.first_name,b.last_name FROM $tablename a, `student_m` b WHERE a.student_id=b.id AND b.archive='N' AND b.academic_year='$a_year' ORDER BY b.first_name");
		 
		  $sno=1;
		  while($r=fetcharray($sql))
		  {
			  if($sno<10)
			  	$sno='0'.$sno;
				
				if($sno%2)
					echo "<tr class='' height='50'>";
				else
					echo "<tr height='50'>";
			
			?>
                <td align="center" title="<?=$sno?>"><?=$sno?></td>
                <td align="left" title="<?=$r[first_name]?>&nbsp;<?=$r[last_name]?>">&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
               <!-- <td align="left" title="<?=$r[comments]?>">&nbsp;&nbsp;<?=$r[comments]?></td>-->
                
                
           <td  height="50" align="left" id="<?=$r[id]?>_<?=$subject?>" class="edit_tr" title="<?=stripslashes($r['comments'])?>">		
           <div style="overflow-x:hidden;overflow-y:scroll; height:70px">           					
           <span id="first_<?=$r[id]?>_<?=$subject?>" class="text" style="width:70px; height:70px"><?=stripslashes($r['comments'])?></span>
           
           <textarea class="editbox" id="first_input_<?=$r[id]?>_<?=$subject?>" style="width:100%;height:70px" ><?=stripslashes($r['comments'])?></textarea></div></td>
                
     
        </tr>
            <?					
      
	  			++$sno;
		   
		  }
	
	?>
 
</table>
 <?
	}else{
		
//#################################   GRADE SECTION   ##########################################
	
 ?>
  <table width="98%" border="1" align="center" cellspacing="0" cellpadding="0" class="forumline"  >

   <tr height="25">
          
          <td align="center" class="row3" width="5%" nowrap>&nbsp;Sl No.&nbsp;</td>
          <td align="center" class="row3" width="20%" nowrap>&nbsp;Student Name&nbsp;</td>
          <td align="center" class="row3" width="35%" nowrap>&nbsp;Mid-Semester 1&nbsp;</td>
          <td align="center" class="row3" width="35%" nowrap>&nbsp;End-Semester 1&nbsp;</td>
     </tr>
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
        <td align='center' ><?=$sno?></td>
        <td align='left' title="<?=$r['first_name']?>&nbsp;<?=$r['last_name']?>">&nbsp;&nbsp;<?=$r['first_name']?>&nbsp;<?=$r['last_name']?></td>
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
				        
			$tablename='grade_m_'.$subject.'_'.$term;
			
			
			$colValue=fetcharray(execute("SELECT `category`,`category1`,$field FROM `$tablename` WHERE `term`='$term' AND student_id='$r[id]'"));
			
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
$titleStudName="$r[first_name]&nbsp;$r[last_name]";
						
		 
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
						 
						
				
					  if($colValue[category]){
 							
				 		$graceValue=fetcharray(execute("SELECT `letter` FROM `grade_grace` WHERE `id`='$colValue[category]'"));						
				      ?>
          			  <td class="marks"  title="<?=$graceValue[letter]?>"><?=$graceValue[letter]?></td>
                    
                      <?   
					  }else{  
				
					   ?>
                      <td class="marks" title="<?=$display?>" ><?=$display?></td>           					
      
                    <?
					  }
					  			                     
					  if($colValue[category1]){
 								
				 		$graceValue1=fetcharray(execute("SELECT `letter` FROM `grade_grace` WHERE `id`='$colValue[category1]'"));						
				      ?>
          			  <td class="marks" title="<?=$graceValue1[letter]?>"><?=$graceValue1[letter]?></td>
   
                      <?   }else{  
				
					?>
                      <td class="marks" title="<?=$display?>" ><?=$display?></td>           					
                    <?

					  }
				     $sum=0;
					 
			}
			
			
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			 
			++$count;
			++$sno;
			++$i;
		      
		    $rowclass = 1 - $rowclass;
	}
						
}
?>
	
</table>
</form>
</body>
</html>
