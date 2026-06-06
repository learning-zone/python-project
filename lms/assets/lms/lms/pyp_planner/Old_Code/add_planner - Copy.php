<?php
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
session_start();
require_once("../db1.php");

$msg=$_REQUEST['msg'];
if($_POST)
{
	
   $id=$_POST['id'];
   $title=$_POST['title'];
   $grade=$_POST['grade'];
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
	  
	 $result=mysql_query($sql);  
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
<style type="text/css">
<!--
table.forumline
{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	color: #68BBE1;
	//background-color: #fafafa;
	border: 1px  solid;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-top: 0px;
}
table.body
{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	//color: #404040;
	//background-color: #fafafa;
	border: 1px solid;
	background: url('../bgy.png') repeat-y;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-top: 0px;
}
table
{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	color: #404040;
	//background-color: #fafafa;
	//border: 1px #6699CC solid;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-top: 0px;
}
/*table.tablesty	{ background-color:"#E5FAFA"; border: 2px #ffffff solid;font-size:12px;color:#ff0000; }*/
table.tablesty
{ 
	background-color:#ffffff; border: 2px #ffffff solid; 
	font-size:17px; color:#0A2756;
}
table.tablesty td
{ 
	font-size:12px;
	color:#0A2756;
	border: -1px solid; 
}


/* Main table cell colours and backgrounds */
td
{ 
	border-bottom: 0px dotted;  /*1px dotted*/
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;font-weight: normal;
	font-size: 12px;
	color: #404040;
	background-color: white;
	//text-align: left;
	padding-left: 10px;
}
td.nor
{
	background-color: #E5FAFA;font-size:12px;
	color:#0A2756;
	border: 1px #ffffff solid;font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	margin-left:12px;
	font-weight:normal;
}
td.norhead
{ 
	background-color: #E5FAFA;font-size:12px;color:#800000;
	border: 1px #ffffff solid;font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	margin-left:12px;
	font-weight:;
}
td.row2
{
	border-bottom: 2px solid ;
	background-color: #BEC8D1;
	font-weight:;
	text-align: center;
	background:#DFE0FC url('../bg4.png') repeat-x;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	color: #404040; 
}
td.row3
{ 
	//background-color: #BEC8D1;
	font-weight:bold;
	background-image:url('../bg4.png');
	background-repeat:repeat-x,y;
	text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	//color: #404040;
}

/*
  This is for the table cell above the Topics, Post & Last posts on the index.php page
  By default this is the fading out gradiated silver background.
  However, you could replace this with a bitmap specific for each forum
*/
td.rowpic
{
	border-bottom: 0px solid ;
	background-color: #BEC8D1;
	//text-align: center;
	font-weight: bold;
	background:#DFE0FC url('../bg4.png') repeat-x;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	
	font-size: 12px;
	color: #404040;
}
td.back
{
	background-color: #F1E763;
	background-image: url(images/cellpic2.jpg);
	
	background-repeat: repeat-y;
}
/* Header cells - the blue and silver gradient backgrounds */
td.head1
{
	border-bottom: 2px solid #6699CC;
	background-color: #BEC8D1;
	//text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;

	font-size: 12px;
	color: #404040;
}


td.head2
{
	border-bottom: 2px solid #6699CC;
	background-color: #BEC8D1;
	//text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	color: #404040;
}
td.head
{
	border-bottom: 1px solid #68BBE1;
	//font-weight:;
	//text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 14px;
	color: #000;
	background-image: url('../bg1.PNG');
	background-repeat:repeat-x,y;

}
/*************************************************************************************/
.head:hover{
    background-color : #68BBE1;/* BEC8D1*/
	color : #68BBE1; /*030B52*/
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
    font-size: 14px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;	
    background:#DFE0FC url('../bg6.png') repeat-x;
 }
/*************************************************************************************/
td.headc
{
	border-bottom: 2px solid #6699CC;
	background-color: #0066CC;
	background:#DFE0FC url('../bgc.png') repeat-x;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	
	font-size: 14px;
	color: #FFFFFF;
}

-->
</style>
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
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="add_planner_edt.php?Type=Mod";
		document.frm.submit();
		return true;
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
<!-- TinyMCE -->
<script type="text/javascript" src="Editor/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		//theme : "advanced",
		//skin : "o2k7",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : //"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		//content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "12345"
		}
	});
</script>
<!-- /TinyMCE -->

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
                	$sqlCourse=mysql_query("SELECT * FROM `course_m` WHERE status=1");
					while($r=mysql_fetch_array($sqlCourse))
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
				$sqlCYear=mysql_query("SELECT * FROM `course_year` WHERE `status`=1 AND `head_id`='$school_division'");
					while($r=mysql_fetch_array($sqlCYear))
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
				<td><select name="group_title">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlName=mysql_query("SELECT * FROM `pyp_group` WHERE `school_division`='$school_division'
					AND `grade`='$grade' AND `status`=1 GROUP BY `group_title`");
                        while($r=mysql_fetch_array($sqlName))
                        {
                            if($group_title==$r['group_title'])
                                echo "<option value='$r[group_title]' selected>$r[group_title]</option>";
                            else
                                echo "<option value='$r[group_title]'>$r[group_title]</option>";
                        }
            
                ?> </select></td>
            </tr>
          <tr height="25">
				<td colspan="2" nowrap align="right">Title&nbsp;&nbsp;</td>
				<td><select name="title">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlTitle=mysql_query("SELECT * FROM `pyp_planner` WHERE `school_division`='$school_division'
					AND `grade`='$grade' AND `status`=1");
                        while($r=mysql_fetch_array($sqlTitle))
                        {
                            if($title==$r['id'])
                                echo "<option value='$r[id]' selected>$r[title]</option>";
                            else
                                echo "<option value='$r[id]'>$r[title]</option>";
                        }
            
                ?> </select></td>
            </tr>
        </table><BR><BR>
        <table align='center' class="forumline" width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>PLANNER DESCRIPTION</td>
			</tr>
            <tr>
				<td align="left"><br>
                               
<p><b>1. What is our purpose?</b></p>

<p><b>1a) To inquire into the following:</b></p>

<p><b><li>transdisciplinary theme</b></p>

<p><li> How we organise ourselves : <i>An inquiry into the interconnectedness of human-made systems and communities; the structure and function of organizations; societal decision-making; economic activities and their impact on humankind and the environment</i></p>

<p><b><li> central idea</b></p>
  Workplaces define the jobs that people do and the responsibilities they share towards a common purpose.<br/>

<p><b>1b) Summative assessment task(s):</b></p>

<p><b>What are the possible ways of assessing student&#146;s understanding of the central idea? What evidence, including student-initiated actions, will we look for</b>?</p>

<p>Students will choose a workplace of their choice and make a Diorama. The criteria for the diorama will be decided in class.</p>

<p>Based on the criteria, which will include the interior, exterior, people who work there, the kind of training they need, the skills they need for the job, the students will make a check list and assess each other&#146;s work (peer assessment)</p>

<p>While they are in the process of making their workplace, they will be observed for their organizational and social skills.</p>


<p><b>2. What do we want to learn?</b></p>

<p>What are the key concepts (form, function, causation, change, connection, perspective, responsibility, reflection) to be emphasized within this inquiry?</p>

<p>Form, Function, Responsibility</p>

<p><b>What lines of inquiry will define the scope of the inquiry into the central idea?</b></p>

<p><li> the purpose and responsibilities of a job.</p>

<p><li> the tools, training and skills required for different jobs. </p>

<p><li> how the jobs are interconnected </p>

<p><li> what makes a work place a good place to work.</p>

<p><b>What teacher questions/provocations will drive these inquiries?</b></p>

<p>Q1. What is a workplace and how does it function? </p>

<p>Q2. What kind of skills and trainings are required for the smooth functioning of a workplace?</p>

<p>Q3. How does our school function as a workplace? </p>

<p>Q4. What makes a workplace a happy place to work in? </p>

<p>Provocation: look around the classroom and look at how it is organized. Write down the way things are and the way they could improve on them.</p>

<p>Q5.How was Philippe Petit&#146;s work place different from other workplaces?</p>

<p>Q6. What kind of impact do our jobs have on our society?</p>

<p>Provocation: Literature shared: The Man who Walked Between the Towers” by Modicai Gerstein</p>

<p>What materials would you use to create your model?</p>

<p>How does the way in which tools and materials are placed in the workplaces you have observed help them to function smoothly?</p>

<p>Who are all the stake-holders who play a role in helping the workplace you are studying function smoothly?</p>

<p><b>3. How might we know what we have learned?</b></p>

<p><b><i>This column should be used in conjunction with “How best might we learn?”</i></b></p>

<p><b>What are the possible ways of assessing students&#146; prior knowledge and skills? What evidence will we look for?</b></p>

<p>The students will make chatterboxes which will include revision of 2D shapes and write down what they know (K) about organizing themselves or their things. They will also write down any questions they want to know (W) about workplaces.</p>

<p><b>What are the possible ways of assessing student learning in the context of the lines of inquiry? What evidence will we look for? </b></p>

<p>1. Anecdotal records/Observations on how children collect data on workplaces and their presentation skills.</p>

<p>2. Formulating questions for interviewing different people in different workplaces.</p>

<p>3. Reports and reflections on all field trips.</p>

<p>4. Designing individual models of their workplace (choosing one they know or designing their future workplace) and presenting it to their classmates explaining the different departments and responsibilities of the people working there.</p>

<p>5. Making a Venn diagram for comparing organization of two workplaces.</p>

<p><b>4. How best might we learn?</b></p>

<p><b>What are the learning experiences suggested by the teacher and/or students to encourage the students to engage with the inquiries and address the driving questions?</b></p>

<p>1. Brainstorming on the various departments in school and visit each one.<br />
2. Make a flowchart of the different departments to see how roles are interconnected and inquire into any problems they can discover.<br />
3. Make a blueprint of MBIS.<br />
4. Class discussions on the importance of each job in school and whether anyone can function in isolation.<br />
5. Prepare interviews for school school staff and other people connected with the field trips.<br />
6. Preparing reports after the interview after brainstorming and discussing all the answers that the students noted.<br />
7. Written reflections on all the field trips.<br />
8. Interview parents about their workplace. How does their workplace function? Is it similar or different to others they have explored? Discuss.<br />
9. Visits to different workplaces.</p>

<p><b>a) </b>Make a model of a workplace of your choice in the school keeping in mind all the special features/resources that make it function effectively.</p>

<p><b>b) </b>Drawing of layout of art room</p>

<p><b>c) </b>Mind map of all the stakeholders in the school ( being studied as a workplace)</p>

<p>2. Learners practice balancing, juggling and discus throwing and write reflection on their experience.</p>

<p>3. Analyse the character trait of Philippe and themselves and write a bio poem.</p>

<p>4. Debate on the advantages and disadvantages of not having a fixed work place.</p>

<p><b>What opportunities will occur for transdisciplinary skills development and for the development of the attributes of the learner profile</b>?</p>

<p><b>Research skills</b>. Students will research on the meaning of a workplace and present it to the class They will conduct several interviews and take notes in order to write reports and reflections.</p>

<p><b>Self-management and communication skills</b> Their self-management and communication skills will be reflected in how they conduct themselves and their inquiry on various field trips. Designing their own models will enable them to analyze and apply their knowledge (<b>thinking skills)</b>. Presenting their models will help them to communicate. Their reflections on the interviews and field trips will enable them to be <b>appreciative</b> of the importance of <b>cooperation</b> and <b>commitment</b> of every member of a workplace.</p>

<p><b>Learner Profile</b></p>

<p><b>Knowledgeable </b>The students will explore the various systems in school, home and the other workplaces that we visit and will be able to explain how people organise themselves.</p>

<p><b>Reflective: </b>The students will reflect on their own organizational skills and compare them with those around them.</p>

<p><b><u>Self management skill</u></b>: Learners discuss the self management skills required for a street performer and analysed their self management skill swhen they juggled, balanced and tried tanjore painting.</p>

<p><b><u>Risk taker and Open minded</u></b>: Learners take risk and juggle with 3 or 4 balls while balancing on the tight rope.</p>

<p><b><u>Research &amp; Presentation skills</u></b>: They worked in pair and found out information about the twin tower and the tallest tower in their country and presented it to their class.</p>

<p><b>5. What resources need to be gathered?</b></p>

<p>What people, places, audio-visual materials, related literature, music, art, computer software, etc, will be available?</p>

<p>Sample Blue prints of different areas of work</p>

<p>Literature and movie of &#147; The Man who walked between the towers &#148; </p>

<p>List attached.</p>

<p><b>IT:</b> <a href="http://www.knowitall.org/kidswork">www.knowitall.org/kidswork</a> <br />
<b>Field Trips</b>, MBIS, and different workplaces (in collaboration with the parents and other staff)<br />
<b>People:</b>), <b>How will the classroom environment, local environment, and/or the community be used to facilitate the inquiry?</b> </p>

<p>The students will use all the departments in school to understand how different sections of a workplace are interdependent and cannot function smoothly without each other. Their classroom will turn into a workplace with roles and responsibilities assigned to each child to ensure it is a safe, clean and happy place to work in. </p>

<p>The art room as a workplace &#150; the tools ,resources and organizational skills required to make it function effectively</p>

<p><b>How will the classroom environment, local environment, and/or the community be used to facilitate the inquiry?</b></p>

Students will look at the classroom as a workplace and suggest changes in Classroom will be a workplace and would be organized accordingly

<p><b>6. To what extent did we achieve our purpose?</b></p>

<p><b>Assess the outcome of the inquiry by providing evidence of students&#146; understanding of the central idea. The reflections of all teachers involved in the planning and teaching of the inquiry should be included.</b></p>

<p><b>How you could improve on the assessment task(s) so that you would have a more accurate picture of each student&#146;s understanding of the central idea</b>.</p>

<p><b>What was the evidence that connections were made between the central idea and the transdisciplinary theme?</b></p>

<p>The students reflections throughout the unit showed evidence that connections were made between transdisciplinary theme and central idea.</p>

<p><b>7. To what extent did we include the elements of the PYP?</b></p>

<p><b>What were the learning experiences that enabled students to:</b></p>

<p><b><li> develop an understanding of the concepts identified in “What do we want to learn?”</b></p>

<p><b><li> demonstrate the learning and application of particular transdisciplinary skills?</b></p>

<p><b><li> develop particular attributes of the learner profile and/or attitudes?</b></p>

<p><b>In each case, explain your selection.</b></p>

<p><b>Research Slills :</b> Students researched various workplaces and found out about their structure, organizations, the kind of jobs people do, the skills required for the jobs and the responsibilities that go with the jobs . </p>

<p><b>Communication skills</b>: they presented their power point on the workplace of their choice. The students asked questions while interviewing and listened when they got the answers.</p>

<p><b>Social skills : </b>they found out the importance of these skills at a workplace like adopting a variety of group roles, understanding what behavior is appropriate at a workplace and act accordingly, being a leader in some circumstances and follower in others.</p>

<p><b>Self&#150;mamagement skills; </b>these skills were reflected when they went out on field trips to various workplaces.</p>

<p><b>Respect </b>for people at the workplace<b> , Cooperating </b>with them to run the organization<b>, commitment </b>to their work<b> and tolerance </b>at a workplace were some of the important attitudes that came out throughout the inquiry.</p>

<p>Learners had to use small and large muscles to balance, juggle and for discus throw. Initially they were not willing to try juggling with two or three balls, but with practice and being <b>risk takers</b> most of them found out that it is possible for them to do the act and they enjoyed it. They <b>appreciated</b> Philippe&#146;s <b>creative</b> ideas and an opportunity to work independently athis time. They also realized the importance of <b>self management skill</b> required to do any job successfully. </p>

<p><b><u>Creativity</u></b>&#150;Learners had to make use of scrap paper, boxes , bottles etc to design their workplaces</p>

<p><b><u>Self management</u></b>&#150;The project required planning and observation. The learners were able to come up with good ideas .</p>

<b><b><u> Coperation &amp; Respect&#150;</u></b>It was a paired project so there was negotiation and sharing ideas in a mutually beneficial way. Some pairs worked better than others.

<p><b>8. What student&#150;initiated inquiries arose from the learning?</b></p>

<p><b>Record a range of student&#150;initiated inquiries and student questions and highlight any that were incorporated into the teaching and learning.</b></p>

<p><i>At this point teachers should go back to box 2 “What do we want to learn?” and highlight the teacher questions/provocations that were most effective in driving the inquiries.</i></p>

<p><i>Q.</i>1 What is a workplace and how does it function?</p>

<p>Q2. What kind of skills and trainings are required for the smooth functioning of a workplace?</p>

<p>Q3. How does our school function as a workplace?</p>

<p>What student&#150;initiated actions arose from the learning?</p>

<p>Record student&#150;initiated actions taken by individuals or groups showing their ability to reflect, to choose and to act.</p>

<p>The students gave ideas about organizing the classroom and also took their responsibilities as managers very seriously. They suggested making changes in the systems for e.g. collecting homework and recording it on sheets.</p>

<p><b>9. Teacher notes</b></p>

<p>We could not do the summative assessment which was planned but each child researched a workplace of their choice/liking and made a power point presentation and presented it using their IT skills.</p>

<p>The various field trips proved to be beneficial as they could compare and contrast between structurally different workplaces.</p>

<p><b><u>Language component EAL</u></b></p>

<p><b>Literature shared: The Man Who Walked Between The Towers By Mordicai Grestein.</b></p>

<p><b>Learners analyze the workplaces of the Philippe and compare it to other work places they have visited. How is it different from the different workplaces they have visited? They inquire into Philippe&#146;s self management skills and the impact of his daredevil act of walking on the tight rope on the society. </b></p>

<p><b>Understand the difference between fiction and nonfiction</b></p>

<p><b>Diary writing</b></p>

<p><b><u>Report writing:</u> Learners form groups and find out information about the twin towers and what happened to it. </b></p>

<p><b>The class understood the value of mind mapping well and were able to come up with good mind maps of the school structure.</b></p>

<p><b>They created detailed models of the workplaces they studied in the school and enjoyed the project. It was good first unit and an excellent introduction to new surroundings for the new students.</b></p>
<p><b><u>Language component EAL </u></b></p>

<p><b>Literature shared: The Man Who Walked Between The Towers By Mordicai Grestein.</b></p>

<p><b>Learners identify and discuss how Philippe Petie&#146;s work place is different from other work places. What are the advantages and disadvantages of not having a fixed work places? What are some of the skills he needs to have to be an aerialist?</b></p>

<p><b>They inquire into his self management skills, and the impact of his daredevil act of tight rope walking between the towers, on the society and the people. </b></p>

<p><b>Understand the difference between fiction and nonfiction</b></p>

<p><b>Diary writing</b></p>

<p><b><u>Report writing:</u> Learners form groups and find out information about the twin towers and what happened to it. </b></p>

<p><b>Bio poem</b></p>
  
  	</td>          
   </tr>
  </table>	
        <p align="center"><input type="button"  value="&nbsp;&nbsp; Save &nbsp;&nbsp; " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p><br>
</form>

 </body>
 </html>
