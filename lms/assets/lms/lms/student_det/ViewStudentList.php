<html>
<head>
<?php
session_start();
require("../db.php");
$academic_year=$_SESSION['AcademicYear'];
if($_POST['branch']=='')
{
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$sel_student=$_POST['sel_student'];
	$sel_section=$_POST['sel_section'];

}
if(isset($_POST['subsave']))
{
	
	$student_len=sizeof($sel_student);
	
	if($sel_student!='')
	{
		for($i=0;$i<$student_len;$i++)
		{
			$student_id=$sel_student[$i];
			$subject_id=$sel_elective;
		
			$sql="update student_m set class_section_id=$sel_section where id=$student_id";
			//echo $sql."<br>";
			execute($sql);
		
			/*$sql="update daily_att set class_section_id=$sel_section where id=$student_id";
			echo "$sql<br>";
			execute($sql) or die(mysql_error());
			*/
		
		
			if($sem==1 || $sem==2)
			{
				
				$sql="insert into major_master values(NULL,$student_id,$sel_section,$sem,$branch,$major)";
				//echo "sql=$sql<br>";
				execute($sql);
			}
		
		}
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
	x=0;
	yy=0;
	i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
			if(flag== true)
			{
				x=x+1;
			}
			else
			{
				yy=yy+1;
			}
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
	document.frm.action="ViewStudentList.php";
	document.frm.submit();
}
function frm_submit()
{
	if(document.frm.sel_section.value==0)
	{
		alert("Please select the Section");
		document.frm.sel_section.focus();
		return false;
	}
	else if(document.frm.major.value==0)
	{
		alert("Please select Cycle");
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

if(empty($branch) )
{
	//die("<div class=\"label\">Please follow proper procedure.</div>");
	$CourseName="";
	$c_abbr="";

}
else
{
	$sql1=execute("select coursename,course_abbr from course_m where course_id=$branch") or die(error_description());
	$rs1=fetcharray($sql1,0);
	$CourseName=$rs1["coursename"];
	$cou_abbr=$rs1["course_abbr"];
}

	$sql2=execute("select year_name from course_year where year_id=$sem") or die(error_description());
	$rs2=fetcharray($sql2,0);
	$Year=$rs2["year_name"];

?>
<form name="frm" method="post" action="" onSubmit="return frm_submit()">
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="sem" value="<?=$sem?>">

<table class=forumline align="center" border="0" width="90%" cellspacing="0" cellpadding="0">
<tr height="25">
	<td Class='head' align=center colspan=3><b>Apply Student to Section</b></td>
</tr>
	<input type="hidden" name="branch" value="<?=$branch?>">
	<input type="hidden" name="sem" value="<?=$sem?>">
<?php

	$temp="select id,section_name from class_section where id>0";
	$rs = execute($temp);
	$num = rowcount($rs);
?>


<tr align="left" height="25">
<td  align='center' width='15%' nowrap>Select Section</td>
<td colspan="2">
<select name="sel_section" >
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

	echo("<option value='" . $r["id"] . "' $sele  >" . $r["section_name"] . "</option>\n");
}
?>

</select>
</td>

<?

if($sem ==1 || $sem==2)
{
	if($major==1)
	{
		$sel="selected";
		$sel1="";
	}
	elseif($major==2)
	{
		$sel="";
		$sel1="selected";
	}
?>


</tr>
<?php
}
else
{
	echo "<td colspan='4'></td></tr>";
}
?>
<tr height="30">
  <td Class="row3" colspan=3 align=center>List of Students from <?=$Year?>,<?=$CourseName?></td></tr>
<tr  height="27"> 
<td width="23" align='center' Class="rowpic"><div id="checkAll" onMouseOver="
	this.style.cursor='hand';this.style.color='blue'"
	onMouseOut="this.style.cursor='default';this.style.color='black'"
	onClick="selectMe()"
	Title="Click to Select all Students"><b>X</b></div></td>
	<td Class="rowpic"  >Apllicatio
	<td Class="rowpic">Student Name </td>
</tr>
<?php
		
		$sql1 = "SELECT id,student_id,first_name,last_name FROM student_m WHERE course_admitted = $branch AND course_yearsem=$sem  and archive='N' and class_section_id='0' and academic_year='$academic_year' order by first_name";
$rs1 = execute($sql1) or die(error_description());
$num = rowcount($rs1);
$rowclass=1;
for($i=0;$i<$num;$i++)
{

	$r=fetcharray($rs1,$i);
	if($i%2)
		echo "	<tr class='clsname'> ";
		else
		echo "	<tr > ";
	?>
	
		<td  align='center'><input type="checkbox" name="sel_student[]" value="<?php echo $r[id]?>" ></td>
				<td >&nbsp; <?php echo $r[student_id]?><td >
				<?php echo $r[first_name]?>&nbsp;<?=$r["last_name"]?></td>
	</tr>
	<?php
			$rowclass = 1 - $rowclass ;
}
echo "</table>";
echo "<br><div align='center'>";
echo "<input type='submit' value='Apply Section'  name='subsave' class='bgbutton'>";
echo "</div>";
?>

</form>
</body>
</html>
