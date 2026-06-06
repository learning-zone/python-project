<html>
<head>
<?php
session_start();
include("../db.php");
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$examid=$_REQUEST['examid'];
	$studentid=$_REQUEST['studentid'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stundetname=$_REQUEST['stundetname'];
	$student_id=$_REQUEST['studentid'];	

if(date("m")>5)
$accyeardet=date("Y");
else
$accyeardet=date("Y")-1;

?>
<script language='javascript'>
function valid(id)
{
	var mmarks= document.getElementsByName("m_mark" + id)[0].value;
	var obt_mark = parseInt(document.getElementsByName("mark" + id)[0].value);
	if(isNaN(obt_mark))
	{
		alert("Enter number only. For Absentees enter as 0");
		document.getElementsByName("mark" + id)[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Scored Mark cannot be greater than max mark");
			document.getElementsByName("mark" + id)[0].value='';
		}
	}
}
function valid1()
{
	var mmarks= parseInt(document.getElementsByName("cc")[0].value);
	var obt_mark = parseInt(document.getElementsByName("ca")[0].value);
	if(isNaN(mmarks))
	{
		alert("Enter number only.");
		document.getElementsByName("cc")[0].value='';
	}
	if(isNaN(obt_mark))
	{
		alert("Enter number only.");
		document.getElementsByName("ca")[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Attended class cannot be greater than conducted class");
			document.getElementsByName("ca")[0].value='';
		}
	}
}
</script>
</head>
<body>
<form name="frm" action="skillset_report2.php" method="post">
<?php
echo "
<input type='hidden' name='course' value='$course'>
<input type='hidden' name='sem' value='$sem'>
<input type='hidden' name='examid' value='$examid'>
<input type='hidden' name='studentid' value='$studentid'>
<input type='hidden' name='stundetname' value='$stundetname'>
<input type='hidden' name='student_id' value='$student_id'>
<input type='hidden' name='class_section_id' value='$class_section_id'>";

$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=fetcharray($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
}

?>
<table align="center" width="700" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="5" >  Skills </td>
</tr>    
  <?php
  echo '
  <tr height="25">
    <td align="center" colspan="5"  class="row2" >Name : '.$stundetname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Id : '.$student_id.' </td>
  </tr>';
  ?>
<tr>
    <td align="center" colspan="5" ><p><strong><em >At Oberoi  International School, we want our students to embody the Learner Profile  attributes of being:</em></strong></p>
      <table border="1" cellspacing="0" cellpadding="0" width="700">
        <tr>
          <td width="121" valign="top"><br>
            <strong>Inquirers</strong></td>
          <td width="517" valign="top"><p>Their natural curiosity    is nurtured. They have acquired the skills necessary to conduct purposeful,    constructive research. They actively enjoy learning and this learning will be    sustained throughout their lives.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Thinkers</strong></p></td>
          <td width="517" valign="top"><p>They exercise initiative    in applying thinking skills critically and creatively to make sound decisions    and solve complex problems.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Communicators</strong></p></td>
          <td width="517" valign="top"><p>They receive and express    ideas and information confidently in more than one language, including the    mathematical and musical symbols.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Risk-takers</strong></p></td>
          <td width="517" valign="top"><p>They approach unfamiliar situations without anxiety and    have the confidence and independence of spirit to explore new roles, ideas    and strategies. They are courageous and articulate in defending those things    in which they believe. </p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Knowledgeable</strong></p></td>
          <td width="517" valign="top"><p>They have acquired    significant knowledge through exploring themes which have global relevance    and importance.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Principled</strong></p></td>
          <td width="517" valign="top"><p>They have a sound grasp    of the principles and moral reasoning. They have integrity, honesty and sense    of service.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Caring</strong></p></td>
          <td width="517" valign="top"><p>They show sensitivity    towards the needs and feelings for others. They have a personal commitment to    action and service.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Open-minded</strong></p></td>
          <td width="517" valign="top"><p>They respect the views,    values and traditions of other individuals and cultures and are  accustomed to seeking and considering a    range of points of views.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Balanced</strong></p></td>
          <td width="517" valign="top"><p>They understand the    importance of physical and mental balance and personal well being.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Reflective</strong></p></td>
          <td width="517" valign="top"><p>They give thoughtful    consideration of their own learning and analyse their personal <br>
            strengths and weakness in a constructive    manner.</p></td>
        </tr>
      </table>
      <p><strong><em>We also want  Oberoi International School students to develop these PYP attitudes:</em></strong></p>
      <table border="1" cellspacing="0" cellpadding="0" width="700">
        <tr>
          <td width="121" valign="top"><br>
            <strong>Independence</strong></td>
          <td width="517" valign="top"><p>Thinking and acting    independently, making their own judgments based on reasoned  principles and being able to defend their    judgments.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Integrity</strong></p></td>
          <td width="517" valign="top"><p>Having integrity and a    firm sense of fairness and honesty.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Appreciation</strong></p></td>
          <td width="517" valign="top"><p>Appreciating the wonder    and beauty of the world and its people.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Respect</strong></p></td>
          <td width="517" valign="top"><p>Respecting themselves,    others and the world around them.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Empathy</strong></p></td>
          <td width="517" valign="top"><p>Imaginatively projecting themselves into another's    situation, in order to understand his / her thoughts, reasoning and emotions. </p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Curiosity</strong></p></td>
          <td width="517" valign="top"><p>Being curious about the nature of learning and of the    world, its people and cultures. </p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Commitment</strong></p></td>
          <td width="517" valign="top"><p>Being committed to their learning, preserving and    showing self - discipline and responsibility </p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Enthusiasm</strong></p></td>
          <td width="517" valign="top"><p>Enjoying learning. </p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Tolerance</strong></p></td>
          <td width="517" valign="top"><p>Feeling sensitivity towards differences and diversity in    the world and being responsive to the needs of    others.</p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Creativity</strong></p></td>
          <td width="517" valign="top"><p>Being creative and imaginative in their thinking and in    their approach to problems and dilemmas. </p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Confidence</strong></p></td>
          <td width="517" valign="top"><p>Feelings confident in their ability as learners, having    the courage to take risks, applying what they have learned and making    appropriate decisions and choices. </p></td>
        </tr>
        <tr>
          <td width="121" valign="top"><p><strong>Cooperation</strong></p></td>
          <td width="517" valign="top"><p>Cooperating, collaborating and lending or following as    the situation demands. </p></td>
        </tr>
      </table></td>
</tr>
   
  <?php
	$Sql67=execute(" select * from skill_grade_desc where student_id='$studentid' and acc_year='$accyeardet'");
		while($rk=fetcharray($Sql67))
		{
			$desc11=$rk['desc1'];
			$desc12=$rk['desc2'];
			$desc13=$rk['desc3'];
			$desc14=$rk['desc4'];
			$desc15=$rk['desc5'];
		}
  ?>
     <tr height="24">
        <td align="left" colspan="5" > <div align="left"><br>
          <p><strong>How your child displayed the Learner Profile and PYP  attitudes:</strong></p>
          <table border="1" cellspacing="0" cellpadding="0">
            <tr>
              <td width="638" valign="top">
              <p>&nbsp;</p>
                <p><?php echo $desc11; ?></p>
                <p>&nbsp;</p></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr height="60">
        <td align="left" colspan="5" >  &nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td align="left" colspan="5" ><table border="1" cellspacing="0" cellpadding="0">
      
        </table>
          <p><strong><u>Units of Inquiry</u></strong></p>
          <table align="center" border="1" cellspacing="0" cellpadding="0" width="700">
            <tr>
              <td width="638" valign="top"><br>
                <strong>Unit Title: </strong>Growth<strong></strong></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Transdisciplinary Theme</strong>: Who we are</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Central Idea</strong>:    People's capabilities may increase as they grow.</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Key Concepts</strong>:  form, change, function</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Related Concepts: </strong>identity, health and hygiene</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Lines of Inquiry</strong>:<br>
                *Physical, emotional and    social growth<br>
                *Roles and    responsibilities at home and school<br>
                *Different stages of    growth</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Focus Subjects</strong>:  Physical, Social and    Personal Education, Science</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Transdisciplinary Skills</strong>:  Self-management    and Social Skills</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>How your child demonstrated an understanding of the    knowledge and concepts taught in this unit:</strong></p>
                <p><strong>&nbsp;<?php echo $desc12; ?></strong></p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Unit Title: </strong>Field    to Table</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Transdisciplinary Theme</strong>: How we organize ourselves</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Central Idea</strong>:    Many foods go through different processes before being eaten.</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Key Concepts</strong>:  form, causation, change</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Related Concepts: </strong>systems, states of matter</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Lines of Inquiry</strong>:<br>
                *Foods that are commonly    consumed<br>
                *Food sources <br>
                *Processes that some    foods undergo<br>
                *People and jobs    involved in these processes</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Focus Subjects</strong>:  Social Studies and Science</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Transdisciplinary Skills</strong>:  Thinking    and Self-Management Skills</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>How your child demonstrated an understanding of the    knowledge and concepts taught in this unit:</strong></p>
                <p><strong>&nbsp;<?php echo $desc13; ?></strong></p>
                <p><strong>&nbsp;</strong></p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Unit Title: </strong>Reduce,    Reuse, Recycle (*The following is an ongoing unit    where students haven't completed all assessments.)</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Transdisciplinary Theme</strong>: Sharing the Planet</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Central Idea</strong>:    Habits can help sustain and maintain the Earth's resources.</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Key Concepts</strong>:  responsibility, reflection</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Related Concepts: </strong>distribution, conservation, ecology</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Lines of Inquiry</strong>:<br>
                *The earth's resources<br>
                *Habits that replenish    and deplete these resources<br>
                *How we can make  the Earth a better place to live in</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Focus Subjects</strong>:  Science and Social Studies</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>Transdisciplinary Skills</strong>:  Self-Management    and Social Skills</p></td>
            </tr>
            <tr>
              <td width="638" valign="top"><p><strong>How your child demonstrated an understanding of the    knowledge and concepts taught in this unit:</strong></p>
                <p><strong>&nbsp;<?php echo $desc14; ?></strong></p>
                <p><strong>&nbsp;</strong></p></td>
            </tr>
          </table>
          <p><strong>Goals and Recommendations:</strong></p>
          <table border="1" cellspacing="0" cellpadding="0" width="700">
            <tr>
              <td width="638" valign="top"><p><strong>&nbsp;</strong></p>
                <p><strong>&nbsp;<?php echo $desc15; ?></strong></p></td>
            </tr>
          </table>
          <p><strong>&nbsp;</strong></p>
          <p>Your child is currently  receiving the following support:</p>
          <ul>
            <li>English as  Another Language (EAL)</li>
            <li>Learning Support</li>
          </ul>
          <p><br><strong><u>Descriptors</u></strong></p>
          <p>The following are  abbreviations for descriptors.  Please  refer to your assessment booklet for the detailed descriptions of each assessed  skill.</p>
          <div>
          
          	NE Not Evident
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          	
            E Evident
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          	
            P Proficient
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          	
            HP Highly Proficient	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
            NA Not Applicable

          
          </div></td>
    </tr>
 
  
  <?php

$sql1=execute("SELECT a.subject_id , a.subject_name FROM subject_m a, master_skills b where a.course_id='$course' and  a.course_year_id='$sem' and b.sub=a.subject_id  group by b.sub ");

 //echo "SELECT * FROM master_skills where divi='$course' and class='$sem'";
while($r2=fetcharray($sql1))
{

  echo " <tr>
    <td nowrap width='75%' colspan='2' class='row2'><strong>  $r2[1] </strong></td>
  	<td nowrap align='center' class='row2'> SEMESTER-1 </td>
  	<td nowrap align='center' class='row2'> SEMESTER-2 </td>
    </tr> ";
  $k=1;
	$sql2=execute("SELECT id , skill FROM master_skills where divi='$course' and class='$sem' and sub='$r2[0]' order by posi");
	while($r3=fetcharray($sql2))
	{
			echo " <tr>
						<td nowrap width='5%' align='center' valign='top'> $k</td>
						<td   valign='top'>  $r3[1]  :-  ";
					  $k++;
		$sql4=execute("SELECT id , sub_skill FROM sub_skills where  master_skill='$r3[0]' order by posi");
		while($r4=fetcharray($sql4))
		{
			echo "  <br>&nbsp;  &nbsp;*  &nbsp;$r4[1] ";
		}
		$sql5=execute("SELECT eval1, eval2,	eval3 FROM skill_grade where  student_id='$studentid' and	skill='$r3[0]' and acc_year='$accyeardet'");
		while($r5=fetcharray($sql5))
		{
			$eval1=$r5[0];
			$eval2=$r5[1];
			$eval3=$r5[2];
		}
		echo "</td><input type='hidden' name='subarr[]' value='$r3[0]'>
						<td nowrap align='center'> $eval1 </td>
						<td nowrap align='center'> $eval2 </td>
						
					  </tr>";
	}
}
?>
<tr>
    <td align="center" colspan="5" ><p>&nbsp;</p>
      <table border="1" align="center" cellspacing="0" cellpadding="0" >
        <tr>
          <td width="174" valign="top"><p align="center"><strong>ATTENDANCE</strong></p></td>
          <td width="168" valign="top"><p align="center"><strong>FIRST SEMESTER</strong></p></td>
        </tr>
        <tr>
          <td width="174" valign="top"><p align="center">Total    instructional days</p></td>
          <td width="168" valign="top"><p align="center">&nbsp;</p></td>
        </tr>
        <tr>
          <td width="174" valign="top"><p align="center">Days missed</p></td>
          <td width="168" valign="top"><p align="center">&nbsp;</p></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>___________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_________________________________<br>
      <strong>Homeroom Teacher&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Head of Primary</strong></p><br></td>
</tr>  

	</table><br><div align="center">
<input type="submit" name="save" value="Export" class="bgbutton">
 
 <a href='skillset_report1.php?course=<?=$branch?>&sem=<?=$sem?>&examid=<?=$examname?>&studentid=<?=$r1[id]?>&class_section_id=<?=$class_section_id?>&stundetname=<?=$r1[first_name]?>&student_id=<?=$r1[student_id]?>'>VIEW		
</a></div></form>
</body>
</html>
