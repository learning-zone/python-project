<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
require_once("../db1.php");

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
<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<br/>
	<table align='center' class=forumline width='50%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>VIEW PLANNER</td>
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
                    $sqlName=execute("SELECT * FROM `pyp_group` WHERE `school_division`='$school_division'
					AND `grade`='$grade' AND `status`=1 GROUP BY `group_title`");
                        while($r=fetcharray($sqlName))
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
  <?
	
  // echo "SELECT * FROM `pyp_add_planner` WHERE `school_division`='$school_division' AND `grade`='$grade'
   //AND `group_title`='$group_title' AND `title`='$title'  AND `status`=1 ORDER BY `group_title`";
   //echo "<br>";
   
   
   		
   $result=execute("SELECT * FROM `pyp_add_planner` WHERE `school_division`='$school_division' AND `grade`='$grade'
   AND `group_title`='$group_title' AND `title`='$title'  AND `status`=1 ORDER BY `group_title`");
   
  
  $NoRows=fetcharray(execute("SELECT COUNT(*) FROM `pyp_add_planner` WHERE `school_division`='$school_division' AND `grade`='$grade' AND `group_title`='$group_title' AND `title`='$title'  AND `status`=1 ORDER BY `group_title`"));
   
   //echo "NoRows :".$NoRows[0];
   $i=$NoRows[0];
   //echo "Hello :".$i;
		
    while($row=fetcharray($result))
    {
	
		$color_code=fetcharray(execute("SELECT `color_code` FROM `pyp_group` WHERE `group_name`='$row[group_name]'"));
		//echo "color_code :".$color_code[0];
		 $color[]=$color_code[0];
		//echo "<BR>";
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
			//echo $i;
			//print_r($color);
	?>
        <table align='center' class="forumline" width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>PLANNER DESCRIPTION REPORT</td>
			</tr>
            <tr>
				<td align="left"><br>
		                               
<p><b>1. What is our purpose?</b></p>

<p><b>1a) To inquire into the following:</b></p>

<p><b><li>transdisciplinary theme</b></p>
 <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		<font color=<?=$color[$j]?> titile=<?=$group_name[$j]?>><?=$des_1_aa[$j]?></font>
		 <br>
     <?
     }
 ?>


<p><b><li> central idea</b></p>

 <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_1_ab[$j]?></font>
		 <br>
     <?
     }
 ?>

<p><b>1b) Summative assessment task(s):</b></p>

<p><b>What are the possible ways of assessing student&#146;s understanding of the central idea? What evidence, including student-initiated actions, will we look for</b>?</p>
<!------------------------------------------------------------------------------------------------------------------------------->

 <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_1_b[$j]?></font>
		 <br>
     <?
     }
 ?>

<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>2. What do we want to learn?</b></p>

<p>What are the key concepts (form, function, causation, change, connection, perspective, responsibility, reflection) to be emphasized within this inquiry?</p>

<p>Form, Function, Responsibility</p>

<p><b>What lines of inquiry will define the scope of the inquiry into the central idea?</b></p>

<!------------------------------------------------------------------------------------------------------------------------------->    
    <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_2a[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>What teacher questions/provocations will drive these inquiries?</b></p>
<!------------------------------------------------------------------------------------------------------------------------------->
  <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_2b[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>3. How might we know what we have learned?</b></p>

<p><b><i>This column should be used in conjunction with &#147; How best might we learn? &#148;</i></b></p>

<p><b>What are the possible ways of assessing students &#146; prior knowledge and skills? What evidence will we look for?</b></p>

<!------------------------------------------------------------------------------------------------------------------------------->
    <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_3a[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>What are the possible ways of assessing student learning in the context of the lines of inquiry? What evidence will we look for? </b></p>
<!------------------------------------------------------------------------------------------------------------------------------->
  <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_3b[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->
<p><b>4. How best might we learn?</b></p>

<p><b>What are the learning experiences suggested by the teacher and/or students to encourage the students to engage with the inquiries and address the driving questions?</b></p>

<!------------------------------------------------------------------------------------------------------------------------------->
   <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_4a[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>What opportunities will occur for transdisciplinary skills development and for the development of the attributes of the learner profile</b>?</p>

<!------------------------------------------------------------------------------------------------------------------------------->
  <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_4b[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>5. What resources need to be gathered?</b></p>

<p>What people, places, audio-visual materials, related literature, music, art, computer software, etc, will be available?</p>
<!------------------------------------------------------------------------------------------------------------------------------->
  <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_5a[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>How will the classroom environment, local environment, and/or the community be used to facilitate the inquiry?</b></p>
<!------------------------------------------------------------------------------------------------------------------------------->
   <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_5b[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>6. To what extent did we achieve our purpose?</b></p>
<!------------------------------------------------------------------------------------------------------------------------------->
   <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_6[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->

<p><b>7. To what extent did we include the elements of the PYP?</b></p>

<p><b>What were the learning experiences that enabled students to:</b></p>

<p><b><li> develop an understanding of the concepts identified in “What do we want to learn?”</b></p>

<p><b><li> demonstrate the learning and application of particular transdisciplinary skills?</b></p>

<p><b><li> develop particular attributes of the learner profile and/or attitudes?</b></p>

<p><b>In each case, explain your selection.</b></p>
<!------------------------------------------------------------------------------------------------------------------------------->
   <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_7[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->
<p><b>8. What student&#150;initiated inquiries arose from the learning?</b></p>

<p><b>Record a range of student&#150;initiated inquiries and student questions and highlight any that were incorporated into the teaching and learning.</b></p>
<!------------------------------------------------------------------------------------------------------------------------------->
    <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_8a[$j]?></font>
		 <br>
     <?
     }
   ?>
    
<!------------------------------------------------------------------------------------------------------------------------------->

<p>What student&#150;initiated actions arose from the learning?</p>

<!------------------------------------------------------------------------------------------------------------------------------->
   <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_8b[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->
<p><b>9. Teacher notes</b></b></p>

<p>We could not do the summative assessment which was planned but each child researched a workplace of their choice/liking and made a power point presentation and presented it using their IT skills.</p>

<p>The various field trips proved to be beneficial as they could compare and contrast between structurally different workplaces.</p>
<!------------------------------------------------------------------------------------------------------------------------------->
  <?
 	for($j=0; $j< $i;$j++)
	{
	?>	
		 <font color=<?=$color[$j]?>><?=$des_9[$j]?></font>
		 <br>
     <?
     }
   ?>
<!------------------------------------------------------------------------------------------------------------------------------->
  	</td>          
   </tr>
  </table>
  <p align="center"><input type="button"  value=" Print " LANGUAGE=javascript onClick="Print_onclick()" class='bgbutton'></p><br>	
</form>

 </body>
 </html>
