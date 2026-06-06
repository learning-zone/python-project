<?php
session_start();
include("../db1.php");

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
  echo die("You don't have rights"); 
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
	

if($msg)
{
?>
<script language="javascript">
	  //alert("<?=$msg?>");
    </script>
<?
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <link rel="icon" href="common/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="common/favicon.ico" type="image/x-icon" />
  <!--<link rel="stylesheet" href="common/css/style.css" type="text/css" media="screen" />-->
  <link rel="STYLESHEET" type="text/css" href="codebase/dhtmlxgrid.css">
  <link rel="stylesheet" type="text/css" href="codebase/skins/dhtmlxgrid_dhx_skyblue.css">
  <style type="text/css">
  <!--

body {

	background-image:url('../bgy.png');
	background-repeat:repeat-x,y;
	border-bottom-left-radius:13px;
	border-bottom-right-radius:13px;
	border-top-left-radius:13px;
	border-top-right-radius:13px;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;

}

a:active{ color : #0A2756;text-decoration: blink;font-weight:bold; }
a:hover		{ text-decoration: underline; color : #DD6900; }
hr	{ height: 0px; border: solid #D1D7DC 0px; border-top-width: 1px;}

.bodyline	{  border: 1px #98AAB1 ; }

.bodyline_new	{ background-color: #F1F2FA; border: 1px #98AAB1 ; }

table.forumline	{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	border:thin;
	border-spacing: 50px;
	margin-top: 0px;
	padding-top:25px;
	padding-bottom:25px;
	padding-right:50px;
	padding-left:50px;
}
table	{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	color: #404040;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-top: 0px;
}

td { 

	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;font-weight: normal;
	font-size: 12px;
	color: #404040;
	padding-left: 3px;
}

td.row3	{ 
	border-bottom:thin;
	border-bottom-color:#999;
	background-color: #BEC8D1;
	font-weight:bold;
	background:#DFE0FC url('../bg4.png') repeat-x;
	text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	color: #404040;
}


td.head{
	border-bottom:thin;
	border-bottom-color:#999;
	font-weight:bold;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
	background-image:url('../bg1.png');
	background-repeat:repeat-x,y;
}

td.cat,td.catHead,td.catSides,td.catLeft,td.catRight,td.catBottom {
	background-image: url(images/cellpic1.gif);
	background-color:#646D7E; border-bottom:thin;
	border-bottom-color:#999;
	height: 28px;
	color:#FFF;
}
td.catHead div{
	padding:5px;
	background-color:#98AFC7; border: #FFFFFF;  height: 18px;
	color:#FFF;
	font-face:bold;
   }

td.cat,td.catHead,td.catBottom {
	height: 29px;
	border-width: 0px 0px 0px 0px;
}

td.submenu{
	border-bottom: 1px dotted #6699CC;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;font-weight: bold;
	font-size: 13px;
	color: #404040;
	background:#DFE0FC url('../bg4.png') repeat-x;
	background-color: white;
	padding-left: 3px;
}
td.thHead,td.thSides,td.thTop,td.thLeft,td.thRight,td.thBottom,td.thCornerL,td.chead,td.thCornerR {
	border: #FFFFFF; border-style: solid; height: 28px; }
td.row3Right,td.spaceRow {
	background-color: #D1D7DC; border: #FFFFFF; border-style: solid; }

th.thHead,td.catHead { font-size: 12px; border-width: 1px 1px 0px 1px; }
th.thSides,td.catSides,td.spaceRow	 { border-width: 0px 1px 0px 1px; }
th.thRight,td.catRight,td.row3Right	 { border-width: 0px 1px 0px 0px; }
th.thLeft,td.catLeft	  { border-width: 0px 0px 0px 1px; }
th.thBottom,td.catBottom  { border-width: 0px 1px 1px 1px; }
th.thTop	 { border-width: 1px 0px 0px 0px; }
th.thCornerL { border-width: 1px 0px 0px 1px; }
th.thCornerR { border-width: 1px 1px 0px 0px; }

.maintitle,h1,h2	{
	font-size: 22px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	text-decoration: none; line-height : 120%; color : #000000;
}


.gen { font-size : 12px; }
.genmed { font-size : 11px; }
.gensmall { font-size : 10px; }
.gen,.genmed,.gensmall { color : #000000; }
a.gen,a.genmed,a.gensmall { color: #0A2756; text-decoration: none; }
a.gen:hover,a.genmed:hover,a.gensmall:hover	{ color: #F00; oration: underline; }

tr.clsName td{
background-color:#D7D7D7;
}

.bgbutton{

	font-size: 13px;
	color: #FFFFFF;
	background:#DFE0FC url('../bg1.png') repeat-x;
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
	border-top-left-radius:5px;
	border-top-right-radius:5px;
}
.bgbutton:hover{
	background-color : #BEC8D1;
	color : #030B52;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 13px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	background:#DFE0FC url('../bg2.png') repeat-x;
 }
button{

	font-size: 13px;
	color: #FFFFFF;
	background:#DFE0FC url('../bg1.png') repeat-x;
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
	border-top-left-radius:5px;
	border-top-right-radius:5px;
}
button:hover{
	background-color : #BEC8D1;
	color : #030B52;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 13px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;	
	background:#DFE0FC url('../bg2.png') repeat-x;
 }
submit{

	font-size: 13px;
	color: #FFFFFF;
	background:#DFE0FC url('../bg1.png') repeat-x;
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
	border-top-left-radius:5px;
	border-top-right-radius:5px;
}
submit:hover{
	background-color : #BEC8D1;
	color : #030B52;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;	
	font-size: 13px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	background:#DFE0FC url('../bg2.png') repeat-x;
 }

.mainmenu		{ font-size : 11px; color : #000000 }
a.mainmenu		{ text-decoration: none; color : #0A2756; }
a.mainmenu:hover{ text-decoration: underline; color : #DD6900; }
a.mainmenu:active{color : #000000; }


.name			{ font-size : 11px; color : #000000;}


.postdetails		{ font-size : 10px; color : #000000; }

input,textarea, select {
	font-size:12px;
	color:#000033;
	border: 1px solid #B0C6EA;	
}

input.post, textarea.post, select {
	font-size:12px;
	color:#000033;
	border: 1px solid #B0C6EA;	
}
  -->
  </style>
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
	  document.frm.action="report_cardall.php";
	  document.frm.submit();
  }
</script>
<Script language="JavaScript">
  function Comments()
  {
	  document.frm.action="report_cardall.php?Type=comments";
	  document.frm.submit();  
  }
</script>
  <script src="codebase/dhtmlxcommon.js"></script>
  <script src="codebase/dhtmlxgrid.js"></script>		
  <script src="codebase/dhtmlxgridcell.js"></script>
  <script src="codebase/dhtmlxdataprocessor.js"></script>

</head>
<title>REPORT CARD</title>
<body >
<form method="post" name="frm">
  <table align='center' class='forumline' width='100%'>
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
			/*$sql21=execute("SELECT d.head_id,a.class, a.section FROM all_teachers a,users b,class_section c,course_year d WHERE b.username='$user' AND c.id=a.section AND c.status=1 AND d.year_id=a.class AND b.srid IN ( sub_teac2, sub_teac, home_teac) ORDER BY a.class, a.section");
		while($r2=fetcharray($sql21))
		{
			$sectname=fetchrow(execute("SELECT codename,section_name FROM `class_section` WHERE id='$r2[2]'"));
			$semname =fetchrow(execute("SELECT year_name FROM course_year WHERE year_id='$r2[1]'"));

			if($subject==$r2[2])
				echo "<option value='$r2[2]' selected>$sectname[0]-$sectname[1]</option>";
			else
				echo "<option value='$r2[2]'>$sectname[0]-$sectname[1]</option>";
			
		}*/
		
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
      <!--<td style="background-color:#FFF"><input type="button"  value="Load Grade"  style="width:88px; height:22px;" href="javascript:void(0);" onClick="OpenWind2('load_grade.php?subject=<?=$subject?>', 'OpenWind2', 300, 200)" class="bgbutton"></td>-->
      <td style="background-color:#FFF">&nbsp;&nbsp;</td>
      <td style="background-color:#FFF"><input type="button"  value="Comments"  style="width:86px; height:22px;"  onClick="Comments()" class="bgbutton"></td>
    </tr>
    <tr>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
      <td style="background-color:#FFF"></td>
    </tr>
  </table>
  <BR>
<!--  <div style="overflow-x:hidden;overflow-y:scroll; height:422px">-->
  <table align="left" border="1">
  	<tr>
       <td colspan="10"><div id="gridbox" style="width:1000px;height:422px;overflow:hidden"></div>

 <?
 if($Type=="comments"){

  ?>
 <script>
	mygrid = new dhtmlXGridObject('gridbox');
	mygrid.setImagePath("codebase/imgs/");
	mygrid.setHeader("Sl No,Student Name,Comments");
	mygrid.setInitWidths("50,300,620")
	mygrid.setColAlign("center,left,left")
	<!--mygrid.setColTypes("dyn,ed,txt,price,ch,coro,ch,ro");-->
	mygrid.setColTypes("ro,ro,txt");
	mygrid.setSkin("dhx_skyblue");
	mygrid.setColSorting("int,str,str")
	mygrid.init();
	mygrid.loadXML("php/get.php");	//used just for demo purposes
	
   //============================================================================================
	myDataProcessor = new dataProcessor("php/update.php"); //lock feed url
	myDataProcessor.init(mygrid); //link dataprocessor to the grid
   //============================================================================================
 </script>
 <?
}else{
	
 ?>
 <script>
	mygrid = new dhtmlXGridObject('gridbox');
	mygrid.setImagePath("codebase/imgs/");
	mygrid.setHeader("Sl No,Student Name,Semester One,Semester Two");
	mygrid.setInitWidths("50,400,300,300")
	mygrid.setColAlign("center,left,left,left")
	<!--mygrid.setColTypes("dyn,ed,txt,price,ch,coro,ch,ro");-->
	mygrid.setColTypes("ro,ro,ro,ro");
	mygrid.setSkin("dhx_skyblue");
	mygrid.setColSorting("int,str,str,str")
	mygrid.init();
	mygrid.loadXML("php/get.php");	//used just for demo purposes
	
   //============================================================================================
	myDataProcessor = new dataProcessor("php/update.php"); //lock feed url
	myDataProcessor.init(mygrid); //link dataprocessor to the grid
   //============================================================================================
</script>
<?
}
?>
	</td>
   </tr>
</table>
</form>
</body>
</html>
