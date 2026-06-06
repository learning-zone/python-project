<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user=$_SESSION['user'];
$msg=$_REQUEST['msg'];

if($_POST)
{
   $id=$_POST['id'];
   $title=$_POST['title'];
   $grade=$_POST['grade'];
   $group_id=$_POST['group_id'];
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

	 $result=execute($sql) or die(mysql_error());  
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
	  document.frm.action="add_planner.php";
	  document.frm.submit();
  }
  function adds_onclick()
  {
	  document.frm.action="add_planner_edt.php?Type=Add";
	  document.frm.submit();
  }

  function Modify_onclick()
  {
	  document.frm.action="add_planner_edt.php?Type=Mod";
	  document.frm.submit();
  }

  function det(del)
  {
	  var answer = confirm("Are you sure to delete record ???")
	  if (answer)
	  {
		  document.frm.action="add_planner.php?Types=Delete&val="+del;
		  document.frm.submit();
	  }
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
<title>ADD PLANNER</title>
</head>
<body>
<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<br/>
	<table align='center' class=forumline width='50%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>ADD PLANNER</td>
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
              <td><select name="group_id" OnChange="ReloadMe()" required>
              <option value=''>----  Select ----</option>
              <?php
                $sqlGroup=execute("SELECT `id`,`group_name` FROM `pyp_group_m` WHERE `status`=1 AND `grade`='$grade' ORDER BY `id`");
                      while($r=fetcharray($sqlGroup))
                      {
                          if($group_id==$r['id'])
                              echo "<option value='$r[id]' selected>$r[group_name]</option>";
                          else
                              echo "<option value='$r[id]'>$r[group_name]</option>";
                      }
          
              ?></select></td>
          </tr>
          <tr height="25">
				<td colspan="2" nowrap align="right">Title&nbsp;&nbsp;</td>
				<td><select name="title">
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
  <?
  $user_id=fetcharray(execute("SELECT `slno`,`f_name` FROM `staff_det` WHERE `email`='$user'"));
  
  $user_right=fetcharray(execute("SELECT `id` FROM `pyp_group` WHERE `teacher_id`='$user_id[0]' AND status=1"));
  
  if($user_right[0]=='')
  {
      die("<blink><font color=#FF0000>You Don't have Rights</font></blink>");   
  } 
?>
<?
	 $font_color=fetcharray(execute("SELECT `color_code` FROM `pyp_group` WHERE school_division='$school_division' AND grade=$grade AND `group_id`='$group_id' AND status=1"));

	$qResult = execute ("SELECT * FROM  `pyp_add_planner` WHERE school_division='$school_division' AND grade=$grade 
	AND `user_name`='$user'");
				
	$num=rowcount($qResult);
	$itms=fetcharray($qResult);
?>
<table align='center' class="forumline" width='90%' >
    <tr height="25">
        <td align='center' Class='head' colspan=3>PLANNER DESCRIPTION</td>
    </tr>
 <tr>
	<td align="left"><br>
                
<p><b>&nbsp;&nbsp;1. What is our purpose ?</b></p>



<p><b>&nbsp;&nbsp;1 a) To inquire into the following:</b></p>



<p><li style="margin-left:1em;"><b>transdisciplinary theme</b></p>



<!------------------------------------------------------------------------------------------------------------------------------->
	<p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_1_aa]?></font></p>
	<p><textarea name="des_1_aa" cols="134" rows="4"></textarea></font></p>

<!-------------------------------------------------------------------------------------------------------------------------------->



<p><li style="margin-left:1em;"><b>central idea</b></p>



<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_1_ab]?></font></p>
	<p><textarea name="des_1_ab" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>1 b) Summative assessment task(s):</b></p>



<p><b>What are the possible ways of assessing student&#146;s understanding of the central idea? What evidence, including student-initiated actions, will we look for</b>?</p>

<!------------------------------------------------------------------------------------------------------------------------------->


    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_1_b]?></font></p>
	<p><textarea name="des_1_b" cols="134" rows="4"></textarea></p>



<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>2. What do we want to learn?</b></p>



<p>What are the key concepts (form, function, causation, change, connection, perspective, responsibility, reflection) to be emphasized within this inquiry?</p>



<p>Form, Function, Responsibility</p>



<p><b>What lines of inquiry will define the scope of the inquiry into the central idea?</b></p>



<!------------------------------------------------------------------------------------------------------------------------------->
     <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_2a]?></font></p>
	<p><textarea name="des_2a" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>What teacher questions/provocations will drive these inquiries?</b></p>

<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_2b]?></font></p>
	<p><textarea name="des_2b" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>3. How might we know what we have learned?</b></p>



<p><b><i>This column should be used in conjunction with &#147; How best might we learn? &#148;</i></b></p>



<p><b>What are the possible ways of assessing students &#146; prior knowledge and skills? What evidence will we look for?</b></p>



<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_3a]?></font></p>
	<p><textarea name="des_3a" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>What are the possible ways of assessing student learning in the context of the lines of inquiry? What evidence will we look for? </b></p>

<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_3b]?></font></p>
	<p><textarea name="des_3b" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>4. How best might we learn?</b></p>



<p><b>What are the learning experiences suggested by the teacher and/or students to encourage the students to engage with the inquiries and address the driving questions?</b></p>



<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_4a]?></font></p>
	<p><textarea name="des_4a" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>What opportunities will occur for transdisciplinary skills development and for the development of the attributes of the learner profile</b>?</p>



<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_4b]?></font></p>
	<p><textarea name="des_4b" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>5. What resources need to be gathered?</b></p>



<p>What people, places, audio-visual materials, related literature, music, art, computer software, etc, will be available?</p>

<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_5a]?></font></p>
	<p><textarea name="des_5a" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>How will the classroom environment, local environment, and/or the community be used to facilitate the inquiry?</b></p>

<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_5b]?></font></p>
	<p><textarea name="des_5b" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>6. To what extent did we achieve our purpose?</b></p>

<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_6]?></font></p>
	<p><textarea name="des_6" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>7. To what extent did we include the elements of the PYP?</b></p>



<p><b>What were the learning experiences that enabled students to:</b></p>



<p><li style="margin-left:1em;"><b>develop an understanding of the concepts identified in “What do we want to learn?”</b></p>



<p><li style="margin-left:1em;"><b>demonstrate the learning and application of particular transdisciplinary skills?</b></p>



<p><li style="margin-left:1em;"><b>develop particular attributes of the learner profile and/or attitudes?</b></p>



<p><b>In each case, explain your selection.</b></p>

<!------------------------------------------------------------------------------------------------------------------------------->
    <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_7]?></font></p>
	<p><textarea name="des_7" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>8. What student&#150;initiated inquiries arose from the learning?</b></p>



<p><b>Record a range of student&#150;initiated inquiries and student questions and highlight any that were incorporated into the teaching and learning.</b></p>

<!------------------------------------------------------------------------------------------------------------------------------->
     <p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_8a]?></font></p>
	<p><textarea name="des_8a" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->



<p><b>What student&#150;initiated actions arose from the learning?</b></p>



<!------------------------------------------------------------------------------------------------------------------------------->
<p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_8b]?></font></p>
<p><textarea name="des_8b" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>9. Teacher notes</b></b></p>



<p>We could not do the summative assessment which was planned but each child researched a workplace of their choice/liking and made a power point presentation and presented it using their IT skills.</p>



<p>The various field trips proved to be beneficial as they could compare and contrast between structurally different workplaces.</p>

<!------------------------------------------------------------------------------------------------------------------------------->
<p title="<?=$user_id[1]?>"><font color="#<?=$font_color?>"><?=$itms[des_9]?></font></p>
<p><textarea name="des_9" cols="134" rows="4"></textarea></p>

<!------------------------------------------------------------------------------------------------------------------------------->
  	</td>          
   </tr>
  </table>	
        <p align="center"><input type="button"  value="&nbsp;&nbsp; Save &nbsp;&nbsp; " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p><br>

</form>
 </body>
 </html>

