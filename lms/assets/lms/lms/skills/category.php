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

if($_GET)
{
	$term = $_REQUEST['term'];
	$subject=$_REQUEST['subject'];
	
}
if($_POST)
{
	$subject=$_POST['subject'];
	$time_frame=$_POST['time_frame'];
	$web_progress=$_POST['web_progress'];
	$assignment_sorting=$_POST['assignment_sorting'];
}
if($subject=='' or $term=='')
{
	?>
    	<script type="text/javascript">
		   alert('Please select Class and Term');
		   window.close();
		</script>
    <?
	
}
$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
?>
    <script language="javascript">
		alert("<?=$msg?>");
		window.opener.location.href='setupcat.php?term='+"<?=$term?>"+'&subject='+"<?=$subject?>";
		window.close();
    </script>
<?
}
?>
<!DOCTYPE HTML>
<html>
<head>
<Script language="JavaScript">
  function RefreshMe()
  {
	  document.frm.action="category.php";
	  document.frm.submit();
  }
  function adds_onclick()
  {
	  document.frm.action="category_exec.php?Type=Add";
	  document.frm.submit();
  }
  function WindowClose()
  {
	  window.close();
  }
</script>
</head>
<title>ADD CATEGORY</title>
<body>
<form method="post" name="frm">
<input type="hidden" name="term" value="<?=$term?>">
<input type="hidden" name="subject1" value="<?=$subject?>">
<table align='center' class='forumline' width='90%' >
<tr>
	<td width="50%">
    <table width="100%">
<tr>
	<td>&nbsp;&nbsp;Title</td>
    <td><input type="text" name="title" value="" size="30" required></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Description</td>
    <td ><textarea rows="4" cols="30" name="description"></textarea></td>
</tr>
<?
	$cal_method=fetcharray(execute("SELECT `cal_method` FROM `grade_setup` WHERE `subject`='$subject' AND `status`='1'"));
if($cal_method['cal_method']==2)
{?>
<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Weight&nbsp;</td>
    <td><input type="text" name="weight" value="" placeholder="0" size="10"></td>
</tr>
<?
}
?>
<tr>
	<td align="center"><BR><BR><BR><BR><BR><BR></td>
</tr>
<tr>
	<td align="left"></td>
</tr>
</table>
</td>
<td width="50%">
<table width="100%">
<tr>
	    <td align="right"><!--<fieldset style="border: groove; border-width:1px; width: 200px; align:left;">
			<legend>Terms</legend>
        	<p align="left"><input type="checkbox" name="term1" value="t1" checked>T1</p>
            <p align="left"><input type="checkbox" name="term2" value="t2" checked>T2</p>
            <p align="left"><input type="checkbox" name="term3" value="t3" checked>T3</p>
            <p align="left"><input type="checkbox" name="term4" value="t4" checked>T4</p>
            <p align="left"><input type="checkbox" name="term5" value="t5" checked>T5</p>
            <p align="left"><input type="checkbox" name="term6" value="t6" checked>T6</p>
            
            <p align="left"></p>
            <p align="left">Select the terms in this category applies</p>
        </fieldset> --> 
   <fieldset style="border: groove; border-width:1px; width: 260px; align:left;">
	<legend>Copy Category to Class</legend>
  <?
	if($sts==2)
	{
	?>
      <p align="left">
        <select name="subject[]" multiple style="height:250px;width:250px;">
          <option value=""></option>
          
		<?php
			$sql21=execute("SELECT d.head_id,a.class, a.section FROM all_teachers a,users b,class_section c,course_year d WHERE b.username='$user' AND c.id=a.section AND c.status=1 AND d.year_id=a.class AND b.srid IN ( sub_teac2, sub_teac, home_teac)  ORDER BY a.class, a.section");
		while($r2=fetcharray($sql21))
		{
			$sectname=fetchrow(execute("SELECT codename,section_name FROM `class_section` WHERE id='$r2[2]'"));
			$semname =fetchrow(execute("SELECT year_name FROM course_year WHERE year_id='$r2[1]'"));

			if($subject==$r2[2])
				echo "<option value='$r2[2]' selected>$sectname[0]-$sectname[1]</option>";
			else
				echo "<option value='$r2[2]'>$sectname[0]-$sectname[1]</option>";
			
		}
        ?>
        </select></p>
        <?
		}
		?>
    <?
	if($sts==1)
	{
	?>
      <p align="left">
        <select name="subject[]" multiple style="height:250px;width:250px;">
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
        </select></p>
        <?
		}
    ?>
            <p align="left"></p>
   </fieldset>    
    </td>
</tr>
</table>
</td>
</tr>
</table>
<p align="center"><input type="submit"  value="Save"  style="width:86px;" onClick="adds_onclick()" class="bgbutton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<!--<input type="button"  value="Exit"  style="width:86px;" onClick="WindowClose()" class="bgbutton">-->

<input type="button" value="Exit" onClick="self.close();" onKeyPress="self.close();" style="width:86px;" class="bgbutton"></p>
 </form>
 </body>
</html>
