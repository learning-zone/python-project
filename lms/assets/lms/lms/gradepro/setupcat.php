<html>
<head>
<Script language="JavaScript">
function OpenWind2(URL, title,w,h)
{
 var left = (screen.width/2)-(w/2);
 var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
	function RefreshMe(val)
	{
		document.MyFrm.action="setupcat.php";
		document.MyFrm.submit();
	}
function checkval(st)
{
	alert("Marks have been entered for this term, hence cannot be modified. Please get in touch with your school system administrator for further assistance  ");
	document.getElementById(st).checked = false;
}
	
</script>
<?php
	session_start();
	include("../db.php");
if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$a_year=$_POST['a_year'];
}
else
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$a_year=$_SESSION['AcademicYear'];
}
$examname_m=$_POST['examname_m'];
$subject=$_POST['subject'];
$class_section_id=$_POST['class_section_id'];
$ExamName=$_POST['ExamName'];
$ShortName=$_POST['ShortName'];
$Persatage=$_POST['Persatage'];
$maxmark=$_POST['maxmark'];
$ordercount=$_POST['ordercount'];
?>
</head>
<body class='bodyline'>
<form method="post" name="MyFrm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='70%' >
<tr>
  <td colspan=2 align='center' class='head'><p><strong>Grade Book Setup</strong></p></td></tr>
<td nowrap>&nbsp;&nbsp;Academic Year</td>
            <td> <select name="a_year" id="a_year" onchange='RefreshMe(0)'>
                <?php
				   $MyYear=date('Y')-1;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}

						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
						   ?>
              </select></td>
              </tr>
<tr><td>&nbsp;&nbsp;School Division</td><td><select name="course" onChange="RefreshMe(0)">
<option value='-1'>-- Select --</option>
<?php
if($course=='0')
	$s="selected";
else
	$s="";
	$sql1=execute("select * from course_m ") or die(mysql_error());
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);

		if($r1['course_id']==$course)
		{
			echo "<option value=$r1[course_id] selected>$r1[coursename]</option>";
		}
		else
		{
			echo "<option value=$r1[course_id]>$r1[coursename]</option>";
		}
	}

?>
</select></td></tr>
<tr>
      <td>&nbsp;&nbsp;Class</td>
      <td><select name="sem" onChange="RefreshMe(0)">
<option value=""> --Select-- </option>
<?php
	$sql=execute("select * from course_year  where head_id='$course'  ") or die(mysql_error());
	while($r=fetcharray($sql))
	{
		if($sem==$r[0])
			echo "<option value=$r[0] selected>$r[1]</option>";
		else
			echo "<option value=$r[0]>$r[1]</option>";
	}
?>
</select>
</td>
</tr>
</table>
<br>
<?
if($sem=='')
{
	die();
}
?>
<table align='center' class='forumline' width='70%' border="1" >
	<tr>
		<td align='center' class='head' colspan="2" nowrap>Setup</td>
	</tr>
	<td align="center">
    <a href="javascript:void(0);" onClick ="OpenWind2('addcat.php?sem=<?=$sem?>&accyear=<?=$a_year?>', 'OpenWind2',1000,600)"><input type="button" class='bgbutton' value="Add Category"></a>
    </td>
	<td align="center">
    <a href="javascript:void(0);" onClick ="OpenWind2('addast.php?sem=<?=$sem?>&accyear=<?=$a_year?>', 'OpenWind2',1000,600)"><input type="button" class='bgbutton' value="Add Assessment"></a>
    </td>
</tr></table>
	</form>
 </body>
</html>
