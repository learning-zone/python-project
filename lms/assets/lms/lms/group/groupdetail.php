<html>
 <?php
	session_start();
	include("../db.php");
	$groupname=$_REQUEST['groupname'];
	
	?>
<head>
<script>
function reloadme()
	{
		document.frm.action="groupdetail.php";
		document.frm.submit();
	}
</script>
</head>
<body>
<form Name="frm" action="groupdetail.php" method="post">     
<table class='forumline' align='center' border="1" width="80%">
<tr>
<td class="head" align="center" colspan="2">Group Details</td>
</tr>
<tr>
<td>&nbsp;&nbsp;Groups</td><td><select name="groupname" onChange="reloadme()">
	<option value="0">Select  </option>
<?php
	$sql3=execute("SELECT id, group_name FROM `group_master` where status=1 group by group_name");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($groupname==$r3[1])
		{
			echo "<option value='$r3[1]' selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value='$r3[1]'>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>
</table>
<br>
<br>
<?
if($groupname=='')
{
	die();
}
?>
<table class='forumline' align='center' border="1" width="100%">
<tr>
<td class="head" align="center" colspan="5">Group Details View</td>
</tr>
<tr>
<td align="center" >School Division</td>
<td align="center" >Grade</td>
<td align="center" >Subject</td>
<td align="center" >Staff Name</td>
</tr>
<?
$schooldivs=fetcharray(execute("select school_div from group_master where group_name='$groupname'"));

$grdid=fetcharray(execute("select grade from group_master where group_name='$groupname'"));

$subjectsnm=fetcharray(execute("select subject from group_master where group_name='$groupname'"));
?>
<tr>
<td align="center" ><select name="schooldiv[]" STYLE="width:200px;height:100px"  multiple>
<?php
if($schooldivs[0]!='0' and ($schooldivs[0]!=99))

{
	//schooldiv
	
	$schoold=execute("select * from group_master a,course_m b where b.course_id=a.school_div and a.group_name='$groupname' group by b.course_id");

}
if($schooldivs[0]=='0' and $grdid[0]!='')

{
	//Grade
	 $schoold=execute("select * from group_master a,course_m b,course_year c where c.head_id=b.course_id and a.grade=c.year_id and a.group_name='$groupname' group by c.head_id");

}

if($subjectsnm[0]!='0')

{
	//subject
	$schoold=execute("select * from group_master a,course_m b,subject_m c where c.course_id=b.course_id and a.subject=c.subject_id and a.group_name='$groupname' group by b.course_id");

}	
	if($schooldivs[0]=='99')

{
	//ALL
	 $schoold=execute("select * from course_m where status=1");

}

	for($k=0;$k<rowcount($schoold);$k++)
	{
		$scld=fetcharray($schoold,$k);
		if($schooldiv==$scld[course_id])
		{
			echo "<option value=$scld[course_id] selected>$scld[coursename]</option>";
		}
		else
		{
			echo "<option value=$scld[course_id]>$scld[coursename]</option>";
		}
	}
?>
</select>
</td>
<td align="center" ><select name="grde[]" STYLE="width:200px;height:100px"  multiple>
<?php 


if($schooldivs[0]!='0' and ($schooldivs[0]!=99))

{
	//schooldiv
	
	$grdes=execute("select * from group_master a,course_year b where b.head_id=a.school_div and a.group_name='$groupname' group by b.year_id");

}
if($schooldivs[0]=='0' and $grdid[0]!='')

{
	//Grade
	 $grdes=execute("select * from group_master a,course_year b where a.grade=b.year_id and a.group_name='$groupname' group by b.year_id");

}

if($subjectsnm[0]!='0')

{
	//subject
	$grdes=execute("select * from group_master a,course_year b,subject_m c where c.course_year_id=b.year_id and a.subject=c.subject_id and a.group_name='$groupname' group by b.year_id");

}	
	if($schooldivs[0]=='99')

{
	//ALL
	 $grdes=execute("select * from course_year where status=1");

} 
   for($l=0;$l<rowcount($grdes);$l++)
	{
		$gds=fetcharray($grdes,$l);
		if($grde==$gds[year_id])
		{
			echo "<option value=$gds[year_id] selected>$gds[year_name]</option>";
		}
		else
		{
			echo "<option value=$gds[year_id]>$gds[year_name]</option>";
		}
	}
?>
</select>
</td>


<td align="center" ><select name="subjects[]" STYLE="width:250px;height:100px"  multiple>
<?
  if($schooldivs[0]!='0' and ($schooldivs[0]!=99))

{
	//schooldiv
	
	$subjt=execute("select * from group_master a,subject_m b,course_year c where b.course_id=a.school_div and a.group_name='$groupname' and c.year_id=b.course_year_id and b.status=1 group by b.subject_id order by b.course_year_id");

}
if($schooldivs[0]=='0' and $grdid[0]!='')

{
	//Grade
	 $subjt=execute("select * from group_master a,subject_m b,course_year c where a.grade=b.course_year_id and a.group_name='$groupname' and c.year_id=b.course_year_id and b.status=1 group by b.subject_id order by b.course_year_id");

}

if($subjectsnm[0]!='0')

{
	//subject
	$subjt=execute("select * from group_master a,subject_m b,course_year c where a.subject=b.subject_id and a.group_name='$groupname' and c.year_id=b.course_year_id and b.status=1 group by b.subject_id order by b.course_year_id");

}	
	if($schooldivs[0]=='99')

{
	//ALL
	 $subjt=execute("select * from subject_m a,course_year b where b.year_id=a.course_year_id and a.status=1 order by a.course_year_id");

} 
    for($n=0;$n<rowcount($subjt);$n++)
	{
		$sjs=fetcharray($subjt,$n);
		if($subjects==$sjs[subject_id] && $sjs[year_id])
		{
			echo "<option value='$sjs[subject_id],$sjs[year_id]' selected>$sjs[year_name] $sjs[subject_name] </option>";
		}
		else
		{
			echo "<option value='$sjs[subject_id],$sjs[year_id]'>$sjs[year_name] $sjs[subject_name]</option>";
		}
	}
    ?>
</select>
</td>

<td align="center" ><select name="teacname[]" STYLE="width:200px;height:100px"  multiple>
<?
 $twac=execute("select * from group_master a,staff_det b where a.teacher=b.id and a.group_name='$groupname' and b.status_id=1 group by b.id order by b.f_name");
    
    for($p=0;$p<rowcount($twac);$p++)
	{
		$teacs=fetcharray($twac,$p);
		if($teacname==$teacs[id])
		{
			echo "<option value=$teacs[id] selected>$teacs[f_name] $teacs[s_name]</option>";
		}
		else
		{
			echo "<option value=$teacs[id]>$teacs[f_name] $teacs[s_name]</option>";
		}
	}
   ?>
</select>
</td>
</table>

</form>
</body>
</html>