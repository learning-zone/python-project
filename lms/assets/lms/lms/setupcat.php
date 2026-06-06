<?php
/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

session_start();
include("../db.php");

//print_r($_SESSION);
$a_year=$_SESSION['AcademicYear'];
if($_POST)
{
	$term=$_POST['term'];
	$subject = $_POST['subject'];
	$category = $_POST['category'];
}
if($_GET)
{
	$msg=$_REQUEST['msg'];	
	$subject = $_REQUEST['subject'];
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
<Script language="JavaScript">
  function RefreshMe()
  {
	  document.frm.action="setupcat.php";
	  document.frm.submit();
  }
</script>
<Script language="JavaScript">
  function adds_onclick()
  {
	  alert('hi');
	 // document.frm.action="setupcat_edt.php?Type=Add";
	  //document.frm.submit();
  }
</script>
</head>
<body >
<form method="post" name="frm">
<table align='center' class='forumline' width='100%' >
<tr>
    <td></td>
    <td></td>
     <td></td>
      <td></td>
    <td>Category</td>
    <td>Assignment</td>
    <!--<td><input type="button"  value="Attendance"  style="width:86px; height:22px" onClick="" ></td>-->
    <!--<td><input type="button"  value="Report Card"  style="width:100px; height:22px" onClick="" ></td>-->
    <!--<td rowspan="4"><fieldset style="border: groove; border-width:1px; width: 200px; align:left;">
			<legend>Assignment Details</legend>
        	<textarea rows="4" cols="30" name=""></textarea>
        </fieldset>   
    </td>-->
</tr>
<tr> 
    <td>&nbsp;&nbsp;Class</td> 
    <td>&nbsp;&nbsp;Term</td>  
    <td>&nbsp;&nbsp;Category</td>  
    <td><input type="button"  value="Set Up"  style="width:86px; height:22px;"  href="javascript:void(0);" onClick="OpenWind2('setup.php?subject=<?=$subject?>', 'OpenWind2', 800, 500)" class="bgbutton"></td>
    
    <td><input type="button"  value="Add"  style="width:86px; height:22px;"  href="javascript:void(0);" onClick="OpenWind2('category.php?subject=<?=$subject?>', 'OpenWind2', 800, 400)" class="bgbutton"></td>
    <td><input type="button"  value="Add"  style="width:86px; height:22px;"  href="javascript:void(0);" onClick="OpenWind2('assignment.php?subject=<?=$subject?>', 'OpenWind2', 800, 400)" class="bgbutton"></td>
    <!--<td><input type="button"  value="Email"  style="width:86px; height:22px" onClick=""></td>
    <td><input type="button"  value="Report Manager"  style="width:100px; height:22px" onClick=""></td>-->
    
    
</tr>
<tr>

	<td>&nbsp;&nbsp;<select name="subject" onChange="RefreshMe()">
	  <option value=""></option>
	  <?php
          $sqlSub=execute("SELECT a.year_id, a.year_name, b.subject_id, b.subject_name FROM `course_year` a, `subject_m` b  WHERE a.year_id = b.course_year_id ORDER BY `year_id`");
          while($r1=fetcharray($sqlSub))
          {
              if($subject==$r1[subject_id])
                  echo "<option value=$r1[subject_id] selected>$r1[year_name] - $r1[subject_name]</option>";
              else
                  echo "<option value=$r1[subject_id]>$r1[year_name] - $r1[subject_name]</option>";
          }
      ?>
     </select></td>
     <td>&nbsp;&nbsp;<select name="term" onChange="RefreshMe()">
	  <option value=""></option>
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
     <td>&nbsp;&nbsp;<select name="category" onChange="RefreshMe()">
	  <option value=""></option>
	  <?php
   $sql=execute("SELECT `id`, `title` FROM `grade_category` WHERE `a_year`=$a_year AND `status`=1 AND `subject`=$subject ORDER BY `id`");
          while($r3=fetcharray($sql))
          {
              if($category==$r3[id])
                  echo "<option value=$r3[id] selected>$r3[title]</option>";
              else
                  echo "<option value=$r3[id]>$r3[title]</option>";
          }
      ?>
     </select></td>
     <td><input type="button"  value="Recalculate" style="width:86px; height:22px" onClick="" class="bgbutton"></td>
     <td><input type="button"  value="Edit" style="width:86px; height:22px" onClick="" class="bgbutton"></td>
     <td><input type="button"  value="Edit" style="width:86px; height:22px"  onClick="" class="bgbutton"></td>
    <!-- <td><input type="button"  value="Lession Plan"  style="width:86px; height:22px" onClick="" ></td>
     <td colspan="2"><input type="button"  value="WEB" style="width:100px; height:22px" onClick="" ></td>-->
</tr>
<tr>
    <td></td>
	<td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>
	<!--<td colspan="2"><input type="button"  value="Print Grid" style="width:220px; height:22px" onClick=""></td>-->
   
</tr>

    <tr>
    	<td align="left" class="rowpic" width="5%">&nbsp;&nbsp; Sl No</td>
        <td  class="rowpic" width="40%">Student Name</td>
        <td  class="rowpic" width="20%">First Category</td>
        <td  class="rowpic" width="20%">Second Category</td>
        <td  class="rowpic" width="20%">Third Category</td>
        <td  class="rowpic" width="30%">Avgerage</td>
        
        
       
     </tr>  
   <!--<fieldset style="border: groove; border-width:1px; width: 180px; align:left;">
			<legend>Grade Book Details</legend>-->
 	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
     <?
			$subdet=mysql_fetch_row(mysql_query("select elective,course_year_id from subject_m where subject_id='$subject'"));
			if($subdet[0]=='N')
			{
				$sql=mysql_query("select student_id, first_name, last_name from student_m where course_yearsem='$subdet[1]' and archive='N' order by first_name");
			}
			else
			{
				$sql=mysql_query("select a.student_id, a.first_name, a.last_name from student_m a, student_course b where a.archive='N' and b.`sub`='$subject' and a.id=b.stu_id and b.acc_year=a.academic_year group by  a.student_id  order by a.first_name ");	
			}
	 
	 ?>
 
 	<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->            <!--<div style="overflow-x:hidden;overflow-y:scroll; height:390px"> -->   
  	<tr>
    	<td>           
            <?php
			$sno=1;
            while($r=mysql_fetch_array($sql))
			{
				if($sno<10)
				{
					$sno="0".$sno;
				}
				
				if($i%2)
					echo "	<tr class='clsname' > ";
				else
					echo "	<tr > ";
					
				//echo "$sno. $r[1] $r[2] <br>";
				$num1=rand(50,100);
				$num2=rand(50,100);
				$num3=rand(50,100);
				$avg=( $num1 + $num2 + $num3 )/3;
				$sum = $num1 + $num2 + $num3 ;
				$percentage=($sum*100)/300;
				?>
                    <td align='left' >&nbsp;&nbsp;&nbsp;&nbsp;<?=$sno?></td>
                    <td align='left' ><?=$r[1]?><?=$r[2]?></td>
                    <td align='center' ><?=$num1?></td>
                    <td align='center' ><?=$num2?></td>
                    <td align='center' ><?=$num3?></td> 
                    <td align='center' ><?=round($avg,2)?></td> 
                 
                  
                <?
				
				$sno++;
				 $i++;
		      
		       $rowclass = 1 - $rowclass;
			}
            ?>
            </td>
            </tr>
            </div></div>
        <!--</fieldset>  
   </td>-->
   </table>
</tr>
<!--<div style="height:350px; width:999px;">-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--<tr>
	<td colspan="7"><div style="height:500px;"></div></td>	              
</tr>-->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--<tr>
	<td></td>
    <td><input type="button"  value="Save" style="width:100px; height:22px" onClick="">&nbsp;&nbsp;</td>
	<td><input type="button"  value="Exit" style="width:100px; height:22px" onClick="">&nbsp;&nbsp;</td>
	<td><input type="button"  value="Fill" style="width:100px; height:22px" onClick="">&nbsp;&nbsp;</td>
    <td></td>	
</tr>-->   
</table>
</form>
</body>
</html>
