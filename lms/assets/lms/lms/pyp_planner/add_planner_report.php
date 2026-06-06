<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$msg=$_REQUEST['msg'];

if($_POST)
{

   $id=$_POST['id'];
   $title=$_POST['title'];
   $grade=$_POST['grade'];
   $group_name=$_POST['group_name'];
   $group_title=$_POST['group_title'];
   $school_division=$_POST['school_division'];
}
if($msg)
{
?>
    <script language="javascript">
	alert("<?=$msg?>");
    </script>
<?php
}
if($_GET[Types] == "Delete")
{
    $val=$_GET['val'];  
    
	$sql="UPDATE `pyp_group` SET `status`='0' WHERE `id`= $val";
	 
	 $result=execute($sql);  

	  if($result) 
	  {
		  ?>
			  <script type="text/javascript">
				  alert("Deleted Successfully");
			  </script>
		  <?
	  }
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<head>
<script language="javascript">
  function ReloadMe()
  {
	  document.frm.action="add_planner_report.php";
	  document.frm.submit();		
  }
  function Print_onclick()
  {
	  window.print();		
  }
</script>
<script language="javascript">
function OpenWind2(URL, title,w,h)
{

	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);

var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>VIEW PLANNER</title>
</head>
<body>
<FORM id="frm" NAME="frm" ACTION="" METHOD="post"><br/>
<table align='center' class=forumline width='50%' >
	<tr height="25">
		<td align='center' Class='head' colspan=3>PYP PLANNER</td>
	</tr>
     <tr>
				<td colspan="2" nowrap align="right"><?php echo $_SESSION['branchname']; ?>&nbsp;&nbsp;</td>
				<td><select name="school_division"  OnChange="ReloadMe();" >
				<option value='' >----  Select ----</option>
				<?

                	$sqlCourse=execute("SELECT * FROM `course_m` WHERE status=1");
					while($r=fetcharray($sqlCourse))
					{
						if($school_division==$r['course_id'])
							echo "<option value='$r[course_id]' selected>$r[1]</option>";
						else
							echo "<option value='$r[course_id]'>$r[1]</option>";
					}
                ?>
			</select></td>
          </tr>
          <tr>
          	<td colspan="2" nowrap align="right"><?php echo $_SESSION['semname']; ?>&nbsp;&nbsp;</td>
      		<td><select name="grade" OnChange="ReloadMe();">
            <option value='' >----  Select ----</option>
			<?php
				$sqlCYear=execute("SELECT * FROM `course_year` WHERE `status`=1 AND `head_id`='$school_division'");
					while($r=fetcharray($sqlCYear))
					{
						if($grade==$r['year_id'])
							echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
						else
							echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
            ?> </select></td>
          </tr>

          <tr height="25">
				<td colspan="2" nowrap align="right">Group Name&nbsp;&nbsp;</td>
				<td><select name="group_title" OnChange="ReloadMe();">
                <option value='' >----  Select ----</option>
                <?php
              $sqlName=execute("SELECT a.id, a.group_name  FROM `pyp_group_m` a, `pyp_group` b WHERE  a.grade='$grade' AND a.status=1 AND a.id=b.group_id GROUP BY a.id");
                        while($r=fetcharray($sqlName))
                        {
                            if($group_title==$r['id'])
                                echo "<option value='$r[id]' selected>$r[group_name]</option>";
                            else
                                echo "<option value='$r[id]'>$r[group_name]</option>";
                        } 
               ?> </select></td>
            </tr>
          <tr height="25">
				<td colspan="2" nowrap align="right">Title&nbsp;&nbsp;</td>
				<td><select name="title" OnChange="ReloadMe();">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlTitle=execute("SELECT * FROM `pyp_planner` WHERE `school_division`='$school_division'
					AND `grade`='$grade' AND `status`=1");

                        while($r=fetcharray($sqlTitle))
                        {

                            if($title==$r['id'])

                                echo "<option value='$r[id]' selected>$r[title]</option>";

                            else

                                echo "<option value='$r[id]'>$r[title]</option>";

                        }

            

                ?> </select></td>

            </tr>

        </table><BR><BR>
   <table align='center' class="forumline" width='98%' >
    <tr>
        <td width="18%" align='left'>&nbsp;&nbsp;Class/grade :</td>
        <td width="14%" align="left">PYP3</td>
        <td align='right' colspan="4">Age group :</td>
        <td width="15%" colspan="4" align='center'>8-9</td>
    </tr>
     <tr>
    </tr>
    <tr></tr>
    <tr>
        <td align='left'>&nbsp;&nbsp;School :</td>
        <td align='left'>SAMPLE</td>
        <td align='right' colspan="4"> School Code:</td>
        <td align='center' colspan="3"><img src="../ib_logo.png"/></td>
    </tr>
    <tr>
    	<td align="left">&nbsp;&nbsp;Title:</td>
        <td align="left" colspan="6">Workplace</td>
     </tr>
     <tr>
    	<td align="left">&nbsp;&nbsp;Teacher(s):</td>    
       <?
	 
		$resultName=execute("SELECT * FROM `pyp_group` WHERE `group_id`='$group_title' AND `status`=1 ORDER BY `id`");
   
		while($rowN=fetcharray($resultName))
      	{
			 $teacherName=fetcharray(execute("SELECT `f_name` FROM `staff_det` WHERE `slno`='$rowN[teacher_id]'"));
			?>
		      <td colspan="2"><font color=<?=$rowN[color_code]?>><?=$teacherName['f_name']?>,</font></td>      	
            <?				
		}
	   ?>
       
     </tr>
     <tr>
        <td align="left">&nbsp;&nbsp;Date:</td>
        <td align="left" colspan="6"><? echo date("d-M-Y"); ?></td>
      </tr>
     <tr>
        <td align="left">&nbsp;&nbsp;Proposed duration:</td>
        <td align="left" colspan="6">45 minutes number of hour of hours over 6 number of weeks</td>
      </tr> 
    </table><BR><BR>

  <?	

   $result=execute("SELECT * FROM `pyp_add_planner` WHERE `school_division`='$school_division' AND `grade`='$grade'

   AND `group_title`='$group_title' AND `title`='$title'  AND `status`=1 ORDER BY `group_title`");
 

  $NoRows=fetcharray(execute("SELECT COUNT(*) FROM `pyp_add_planner` WHERE `school_division`='$school_division' AND `grade`='$grade' AND `group_title`='$group_title' AND `title`='$title'  AND `status`=1 ORDER BY `group_title`"));

   $i=$NoRows[0];

    while($row=fetcharray($result))
    {

		$teacherID=fetcharray(execute("SELECT `slno` FROM `staff_det` WHERE `f_name`='$row[group_name]'"));
		
		$color_code=fetcharray(execute("SELECT `color_code` FROM `pyp_group` WHERE `teacher_id`='$teacherID[0]'"));
		
		
		 $color[]=$color_code[0];

		 $group_name[]=$row['group_name'];
		 $des_1_aa[]=$row['des_1_aa'];
		 $des_1_ab[]=$row['des_1_ab'];
		 $des_1_b[]=$row['des_1_b'];

		 $des_2a[]=$row['des_2a'];

		 $des_2b[]=$row['des_2b'];

		 $des_3a[]=$row['des_3a'];

		 $des_3b[]=$row['des_3b'];

		 $des_4a[]=$row['des_4a'];

		 $des_4b[]=$row['des_4b'];

		 $des_5a[]=$row['des_5a'];

		 $des_5b[]=$row['des_5b'];

		 $des_6[]=$row['des_6'];

		 $des_7[]=$row['des_7'];

		 $des_8a[]=$row['des_8a'];

		 $des_8b[]=$row['des_8b'];

		 $des_9[]=$row['des_9'];
	}

	?>

<table align='center' class="forumline" width='98%' >
    <tr height="25">
        <td align='center' Class='head' colspan=3>PLANNER DESCRIPTION REPORT</td>
    </tr>
<tr>
    <td align="left"><p><b>&nbsp;&nbsp;1. What is our purpose?</b></p></td>
 <tr>
    <td align="left"><p><b>&nbsp;&nbsp;1 a) To inquire into the following:</b></p></td>
 </tr>
 <tr>
    <td align="left"><li style="margin-left:1em;"><b>transdisciplinary theme</b></td>
 <tr>    
    <?
        for($j=0; $j<$i;$j++)
        {
        ?>	
    <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?> titile=<?=$group_name[$j]?>><?=$des_1_aa[$j]?></font></td>
  </tr>
         <?
         }
     ?>
  <tr>
     <td><p><li style="margin-left:1em;"><b>central idea</b></p></td>
   </tr>
   <tr>
	 <?
              for($j=0; $j< $i;$j++)
              {
              ?>	
                   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_1_ab[$j]?></font></td>
                   </tr>
               <?
               }
           ?>
    <tr>
        <td align="left"><p><b>&nbsp;&nbsp;1 b) Summative assessment task(s):</b></p></td>
    </tr>
    <tr>
        <td align="left">&nbsp;&nbsp;What are the possible ways of assessing student&#146;s understanding of the central idea? What evidence, including student-initiated actions, will we look for?</td>
    </tr>
    <tr>
        
         <?
            for($j=0; $j< $i;$j++)
            {
            ?>	
                 <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_1_b[$j]?></font></td>
                 </tr>
             <?
             }
         ?>
    
       <tr>
          <td align="left"><p><b>&nbsp;&nbsp;2. What do we want to learn?</b></p></td>
       </tr>
       <tr>
          <td align="left"><p>&nbsp;&nbsp;What are the key concepts (form, function, causation, change, connection, perspective, responsibility, reflection) to be emphasized within this inquiry?</p></td>

        </tr>
     <tr>
            <td align="left"><p>&nbsp;&nbsp;Form, Function, Responsibility</p></td>
     </tr>
      <tr>
        <td align="left"><p><b>&nbsp;&nbsp;What lines of inquiry will define the scope of the inquiry into the central idea?</b></p></td>
       </tr>
       <tr>
               
            <?
              for($j=0; $j< $i;$j++)
              {
              ?>	
                   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_2a[$j]?></font></td>
                   </tr>
               <?
               }
             ?>
        
          <tr>
           		 <td align="left"><p><b>&nbsp;&nbsp;What teacher questions/provocations will drive these inquiries?</b></p></td>
           </tr>
           <tr>
             	 
             <?
                for($j=0; $j< $i;$j++)
                {
                ?>	
                     <td  align="left" title="<?=$group_name[$j]?>"> <font color=<?=$color[$j]?>><?=$des_2b[$j]?></font></td>
                     </tr>
                 <?
                 }

               ?>
            
  <tr>
      <td align="left"><p><b>&nbsp;&nbsp;3. How might we know what we have learned?</b></p></td>
  </tr>
  <tr>
      <td align="left"><p><b><i>&nbsp;&nbsp;This column should be used in conjunction with &#147; How best might we learn? &#148;</i></b></p></td>
  </tr>
  <tr>
      <td align="left"><p><b>&nbsp;&nbsp;What are the possible ways of assessing students &#146; prior knowledge and skills? What evidence will we look for?</b></p></td>

  </tr>
  <tr>
    
	<?
	  for($j=0; $j< $i;$j++)
	  {
	  ?>	
		   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_3a[$j]?></font></td></tr>
		   
	   <?
	   }
    ?>
  <tr>
     <td align="left"><p><b>&nbsp;&nbsp;What are the possible ways of assessing student learning in the context of the lines of inquiry? What evidence will we look for? </b></p></td>

  </tr>
  <tr>
     
       <?
		for($j=0; $j< $i;$j++)
		{
		?>	
			<td  align="left" title="<?=$group_name[$j]?>"> <font color=<?=$color[$j]?>><?=$des_3b[$j]?></font></td></tr>

		 <?
		 }
	   ?>
  <tr>
    <td align="left"><p><b>&nbsp;&nbsp;4. How best might we learn?</b></p></td>
  </tr>
  <tr>
  	<td align="left"><p><b>&nbsp;&nbsp;What are the learning experiences suggested by the teacher and/or students to encourage the students to engage with the inquiries and address the driving questions?</b></p></td>
    </tr>
    <tr>
       
          <?
			for($j=0; $j< $i;$j++)
			{
			?>	
			 <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_4a[$j]?></font></td></tr>

			 <?
			 }
		   ?>
    <tr>

      <td align="left"><p><b>&nbsp;&nbsp;What opportunities will occur for transdisciplinary skills development and for the development of the attributes of the learner profile</b>?</p></td>

     </tr>
    <tr>
        <?

		  for($j=0; $j< $i;$j++)
		  {
		  ?>	
			   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_4b[$j]?></font></td></tr>
		   <?
		   }
		 ?>
    <tr>

       <td align="left"><p><b>&nbsp;&nbsp;5. What resources need to be gathered?</b></p></td>

    </tr>

    <tr>

      <td align="left"><p>&nbsp;&nbsp;What people, places, audio-visual materials, related literature, music, art, computer software, etc, will be available?</p></td>

     </tr>
    <tr>
         <?
			for($j=0; $j< $i;$j++)
			{
			?>	
				<td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_5a[$j]?></font></td></tr>
	
			 <?

			 }

		   ?>

  <tr>

    <td align="left"><p><b>&nbsp;&nbsp;How will the classroom environment, local environment, and/or the community be used to facilitate the inquiry?</b></p></td>

   </tr>
   <tr>
        <?
		  for($j=0; $j< $i;$j++)
		  {
		  ?>	
			  <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_5b[$j]?></font></td></tr>

		   <?

		   }

		 ?>
   <tr>
     <td align="left"><p><b>&nbsp;&nbsp;6. To what extent did we achieve our purpose?</b></p></td>
    </tr>
   <tr>
   	 
        <?
		  for($j=0; $j< $i;$j++)
		  {
		  ?>	
			   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_6[$j]?></font></td></tr>
		   <?
		   }
		 ?>
    <tr>
      <td align="left"><p><b>&nbsp;&nbsp;7. To what extent did we include the elements of the PYP?</b></p></td>
    </tr>

    <tr>

      <td align="left"><p><b>&nbsp;&nbsp;What were the learning experiences that enabled students to:</b></p></td>

    </tr>

    <tr>

      <td align="left"><p><li style="margin-left:1em;"><b> develop an understanding of the concepts identified in “What do we want to learn?”</b></p></td>

    </tr>

        <tr>

      <td align="left"><p><li style="margin-left:1em;"><b> demonstrate the learning and application of particular transdisciplinary skills?</b></p></td>
    </tr>
    <tr>
      <td align="left"><p><li style="margin-left:1em;"><b>develop particular attributes of the learner profile and/or attitudes?</b></p></td>
    </tr>
    <tr>
      <td align="left"><p><b>&nbsp;&nbsp;In each case, explain your selection.</b></p></td>
    </tr>
   <tr>
       
	  <?
		  for($j=0; $j< $i;$j++)
		  {
		  ?>	
			   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_7[$j]?></font></td></tr>
		   <?
		   }
		 ?> 
   <tr>
      <td align="left"><p><b>&nbsp;&nbsp;8. What student&#150;initiated inquiries arose from the learning?</b></p></td>
    </tr>
    <tr>
      <td align="left"><p><b>&nbsp;&nbsp;Record a range of student&#150;initiated inquiries and student questions and highlight any that were incorporated into the teaching and learning.</b></p></td>

    </tr>
    <tr>
	  <?
		  for($j=0; $j< $i;$j++)
		  {

		  ?>	
			   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_8a[$j]?></font></td></tr> 
		   <?
		   }
		 ?>  
    <tr>
      <td align="left"><p>&nbsp;&nbsp;What student&#150;initiated actions arose from the learning?</p></td>
    </tr>
     <tr>
	  <?

		  for($j=0; $j< $i;$j++)
		  {
		  ?>	
			   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_8b[$j]?></font></td></tr>

		   <?

		   }

		 ?>
    <tr>
      <td align="left"><p><b>&nbsp;&nbsp;9. Teacher notes</b></b></p></td>
    </tr>
        <tr>
      <td align="left"><p>&nbsp;&nbsp;We could not do the summative assessment which was planned but each child researched a workplace of their choice/liking and made a power point presentation and presented it using their IT skills.</p></td>
    </tr>
    <tr>
      <td align="left"><p>&nbsp;&nbsp;The various field trips proved to be beneficial as they could compare and contrast between structurally different workplaces.</p></td>

    </tr>
   <tr>     
	  <?
		  for($j=0; $j< $i;$j++)
		  {
		  ?>	
			   <td  align="left" title="<?=$group_name[$j]?>"><font color=<?=$color[$j]?>><?=$des_9[$j]?></font></td></tr>	   
		   <?
		   }
		 ?>
  </table>
  <p align="center"><input type="button"  value=" Print " LANGUAGE=javascript onClick="Print_onclick()" class='bgbutton'></p><br>	
</form>
 </body>
 </html>

