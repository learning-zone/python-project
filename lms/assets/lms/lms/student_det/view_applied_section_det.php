<html>
<head>
<?php
	session_start();
	require("../db.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$sel_section=$_POST['sel_section'];
	$to_section=$_POST['to_section'];
	$sel_section=$_POST['sel_section'];
	$to_section=$_POST['to_section'];
	$sel_student=$_POST['sel_student'];
	$academic_year=$_SESSION['AcademicYear'];
	$student_len=sizeof($sel_student);
if(isset($_POST['savedata']))
{
//	die("ddd");
	for($i=0;$i<$student_len;$i++)
	{
		$student_id=$sel_student[$i];
	
		$section_id=$sel_section;
	
	
		$sql="update student_m  set class_section_id=$to_section where id=$student_id and class_section_id=$section_id";
	
		execute($sql);
	
		$sql="update daily_att  set class_section_id=$to_section where id=$student_id and class_section_id=$section_id";
	
		execute($sql);
	
	
	
	
	}
?>
<Script language="JavaScript">
alert("Updated successfully ");
</script>
<?php

}
?>
<Script language="JavaScript">
function selectMe()
{
		i = document.frm.length;
		for(j=0;j<i;j++)
		{
			if(document.frm[j].Sel != "CheckBox")
			{
				flag = document.frm[j].checked;
				document.frm[j].checked = !flag;
			}
			if(document.frm[j].SelectAll == "CheckBox")
			{
				flag = document.frm[j].checked;
				document.frm[j].checked = !flag;

			}
		}
	}

	function changeMs(i)
	{
		if(i)
		{
			document.all.sl.style.cursor='hand';
			document.all.sl.style.color='blue'
		}
		else
		{
			document.all.sl.style.cursor='default';
			document.all.sl.style.color='ivory'
		}

	}

	function frm_reload()
	{
		document.frm.action="view_applied_section_det.php";
		document.frm.submit();


	}

	function frm_submit()
	{
		if(document.frm.sel_section.value=="")
		{
			alert("Select the Section");
			return false;
		}
		else if(document.frm.to_section.value=="")
		{
			alert("Select the To Section");
			return false;
		}
		else
		{
			return true;
		}


	}

</Script>
</head>
<body>
<?php

if( empty($sem))
{
	die("<div class=\"label\">Please follow proper procedure.</div>");
}

if(empty($branch))
{
die("<div class=\"label\">Please follow proper procedure.</div>");
/*
$CourseName="";
$c_abbr="";
*/
}
else
{

$sql1=execute("select coursename,course_abbr from course_m where course_id=$branch") or die(error_description());
$rs1=fetcharray($sql1,0);


}

$CourseName=$rs1["coursename"];
$c_abbr=$rs1["coursename"];

$sql2=execute("select year_name from course_year where year_id=$sem") or die(error_description());
$rs2=fetcharray($sql2,0);
$Year=$rs2["year_name"];

?>
<form name="frm" method="post" action="" onSubmit="return frm_submit()">
<table class='forumline' border="1" align='center' width="90%">
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<?php


$temp="select id,section_name from class_section ";

$rs = execute($temp);
$num = rowcount($rs);

?>

<tr><td Class='head' align=center colspan=4><b>Change Students Section</b></td></tr>
<tr align="left">
<td colspan="2" valign="top">Select Section</td>
<td colspan="2">
<select name="sel_section" onChange="frm_reload()"  >
<option value=""> Select Section</option>
<?php
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($rs,$i);
	$sele="";
	if($r[id]==$sel_section)
	{
		$sele="selected";
	}

	echo("<option value='" . $r["id"] . "' $sele  >" . $r["section_name"]  . "</option>\n");
}
?>

</select>
</td>

</tr>
<?
if($sel_section <> "")
{
	if($branch==0)
	{
	$sql1 = "SELECT a.id,a.student_id,a.first_name,a.last_name FROM student_m a WHERE  course_yearsem =";
	$sql1 .= "$sem and archive='N' and a.academic_year='$academic_year' a.class_section_id=$sel_section order by student_id";
	}
	else
	{
	$sql1 = "SELECT a.id,a.student_id,a.first_name,a.last_name FROM student_m a WHERE course_admitted = $branch AND course_yearsem =";
	$sql1 .= "$sem and archive='N' and a.academic_year='$academic_year' and a.class_section_id=$sel_section order by student_id";
	}
	//echo "$sql1<br>";
	$rs1 = execute($sql1) or die(error_description());

	if(rowcount($rs1)==0)
	{
		print("There are no students in this Section");
		die();
	}


?>
	<tr><td Class="row3" colspan=4>List of Students of <?=$Year?>,<?=$CourseName?></td></tr>
	<tr><td Class="rowpic" width="5%">
<input type="checkbox" name="SelectAll" OnClick="selectMe()">
	</td>
    <td Class="rowpic">ID</td>
	<td Class="rowpic">Register No</td>
	<td Class="rowpic">Student Name </td>
	</tr>
	<?php
	$num = rowcount($rs1);
	$st=array();
	$st1=array();
	$st2=array();
	for($i=0;$i<$num;$i++)
	{
		$r=fetcharray($rs1,$i);
		array_push($st,$r[id]); 
		array_push($st1,substr($r[student_id],3,2));
		array_push($st2,substr($r[student_id],7,3));
	}

array_multisort($st1,SORT_DESC,SORT_REGULAR,$st2,SORT_ASC,SORT_NUMERIC,$st);	

	$i=0;
	while($i<count($st))
	{

		$g=execute("select * from student_m where id='$st[$i]'");
		$gk=mysql_fetch_array($g);
		if($i%2)
		echo "	<tr class='clsname'> ";
		else
		echo "	<tr> ";
		?>
		<td align="center"><input type="checkbox" name="sel_student[]" value="<?=$gk["id"]?>"  checked></td><td><?=$gk["id"]?></td><td><?=$gk["student_id"]?></td>
		<td><?=$gk["first_name"]?>&nbsp;<?=$gk["last_name"]?></td>
		</tr>
		<?php
			$i++;
	}
	?>
	<tr align="left">
	<td colspan="2" valign="top">Change to Section</td>
	<td colspan="2">
	<select name="to_section"   >
	<option value=""> Select  Section</option>
	<?php
	$rs = execute($temp);
    $num = rowcount($rs);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		$sele="";
		if($r[id]==$to_section)
		{
			$sele="selected";
		}

		echo("<option value='" . $r["id"] . "' $sele  >" . $r["section_name"] . "</option>\n");
	}
	?>

	</select>
	</td>

</tr>

</table>
<br>
<div align="center">
<input type='submit' value='Change Section' name='savedata' class='bgbutton' >
</div>
<?
}
?>

</form>
</body>
</html>
