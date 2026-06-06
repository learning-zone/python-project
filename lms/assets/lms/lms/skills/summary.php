<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

/*print_r($_SESSION);*/

$user = $_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];

if($_POST)
{
	$term=$_POST['term'];
	$subject = $_POST['subject'];
	$category = $_POST['category'];
}
if($_GET)
{
	$msg=$_REQUEST['msg'];	
	$term=$_REQUEST['term'];
    $subject = $_REQUEST['subject'];
	$category = $_REQUEST['category'];
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
</head>
<body >
<form method="post" name="frm">
  <div style="overflow-x:hidden;overflow-y:scroll; height:422px">
<table align="left" border="1" class="forumline">   
</tr>
    <tr>	
    	<!--<td  class="row3" align="center" width="5%" nowrap>
        <div class="head" id="checkAll" onClick="selectMe()" Title="Click to Select all Students">Select All<input type="checkbox"></div><BR></td>-->
        <td  class="row3" align="center" width="30%" nowrap>Student Name<BR></td>
     <?
       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
	  
	    $resultCol=execute("SELECT `title`, `max_point`, `inserted_date`, `description` FROM `grade_assessment` WHERE `subject`=$subject AND `category_id` = $category");

		while($rCol=fetcharray($resultCol))      
		{
			$titleValue="Created Date :".date('d-M-Y', strtotime($rCol[inserted_date]))."
Maximum Point :$rCol[max_point]
Description :$rCol[description]";
			

		  ?>
          	   <td class="row3" align="center" title="<?=$titleValue?>">
			   <?=$rCol['title']?><BR><?=$rCol['max_point']?></td>
          <?
		 }
	  
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 ?>    
     </tr>
 	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
     <?
			$subdet=fetchrow(execute("select elective,course_year_id from subject_m where subject_id='$subject'"));
			if($subdet[0]=='N')
			{
				$sql=execute("select student_id, first_name, last_name from student_m where course_yearsem='$subdet[1]' and archive='N' order by first_name");
			}
			else
			{
				$sql=execute("select a.student_id, a.first_name, a.last_name from student_m a, student_course b where a.archive='N' and b.`sub`='$subject' and a.id=b.stu_id and b.acc_year=a.academic_year group by  a.student_id  order by a.first_name ");	
			}
	 
	 ?>
 
 	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->   
 
    <tr>    	         
       <?php
			$sno=1;
			$count=1;
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
          
           <!-- <td align='center'><input type="checkbox" name="Sel[]" value="<?=$r['student_id']?>" size="5"></td>-->
            <input type="hidden" name="Sel[]" value="<?=$r['student_id']?>" >
            <td align='left' >&nbsp;<?=$sno?>.&nbsp;&nbsp;<?=$r['first_name']?><?=$r['last_name']?></td>
     <?
       //++++++++++++++++++++++++++++++++++++++++++   TO FETCH EXSISTING COLUMN NAME  +++++++++++++++++++++++++++++++++++++++++++
	  
	    $resultCol=execute("SELECT `title` FROM `grade_assessment` WHERE `subject`='$subject' AND `category_id` ='$category'");
		 		 
		while($rCol=fetcharray($resultCol))      
		{
			
			$string = str_replace(' ', '_', $rCol['title']);
			$field=$string.'_'.$category;
	
			$colValue=fetcharray(execute("SELECT $field FROM `grade_m_$subject` WHERE `id`=$count"));
		  ?>
          	 <td nowrap align="center"><Input Type="Text" Name="<?=$r['student_id']?><?=$rCol['title']?>" value="<?=$colValue[$field]?>" size=8></td>
               
          <?
		     
		 }
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	  ?>
       <?	
			$count++;
			$sno++;
			 $i++;
		      
		       $rowclass = 1 - $rowclass;
			}
            ?>
       </tr>
   </table>
    </div> 
  <p align="center">
		<input type="button"  value="Save"  style="width:86px; height:22px" onClick="adds_onclick()" class="bgbutton">				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button"  value="Clear"  style="width:86px; height:22px" onClick="WindowClose()" class="bgbutton"></p>

</form>
</body>
</html>
