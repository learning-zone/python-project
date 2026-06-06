<html>
 <?php
	session_start();
	include("../db.php");
	//print_r($_POST);
	$curtype=$_POST['curtype'];
	$branch=$_POST['branch'];
	$teacher=$_POST['teacher'];
	$subject=$_POST['subject'];
	$groupname=$_POST['groupname'];
	?>
<head>
<script>
function reloadme()
	{
		document.frm.action="group.php";
		document.frm.submit();
	}
</script>
</head>
<body>
<?php

if ($_POST['subn'])
{
	//subjectwise  teacher rights
		if($subject!='')	
		{	
			for($i=0; $i < sizeof($teacher); $i++)
			{
				for($l=0; $l < sizeof($subject); $l++)
				{
				$sqq=execute("insert into group_master(group_name,subject,teacher,status) values('$groupname','$subject[$l]','$teacher[$i]',1)");
				}
			}
		}
	
	//gradewise  teacher rights
	if($subject=='')	
	{	
		for($m=0; $m < sizeof($teacher); $m++)
		{
			for($j=0; $j < sizeof($branch); $j++)
			{
				$brsnc=explode(',',$branch[$j]);
				$branchid=$brsnc[0];
				$secid=$brsnc[1];
				$sqq=execute("insert into group_master(group_name,grade,section_id,teacher,status) 		values('$groupname','$branchid','$secid','$teacher[$m]',1)");
			}
		}
	}

	//school_div wise  teacher rights	
	if($branch=='' && $subject=='')	
	{	
		for($n=0; $n < sizeof($teacher); $n++)
		{
			
				$sqq=execute("insert into group_master(group_name,school_div,teacher,status) 		values('$groupname','$curtype','$teacher[$n]',1)");

		}
	}
?>		
<script language="javascript">
alert("Groups Added successfully ");
</script> 
<?
}
?>

<form Name="frm" action="group.php" method="post">     
<table class='forumline' align='center' border="1" width="100%">
<tr><td Class="head" align='center' colspan=4>Create Group</td></tr>
<tr>
<td>&nbsp;Group Name</td>
<td colspan="3">&nbsp;<input type="text" name="groupname"  value="<?=$groupname?>"  onclick='form_validate()' required> &nbsp;&nbsp;&nbsp;&nbsp;

<?php
if($groupname=="")
{
?>
	<input type='submit' name='enter' value='Enter' class='bgbutton' onclick='form_validate()'>
<?php
}
?>
</td>
</tr>

<?
if($groupname=='')
{
die();
}
?>

<tr>
    <td class="rowpic">&nbsp;<? echo $_SESSION['branchname'] ?></td>
    <td class="rowpic">&nbsp;<? echo $_SESSION['semname'] ?></td>
    <td class="rowpic">&nbsp;Subject</td>
</tr>
 <?php
  if($curtype=='99')
  $selected='selected';
  else
  $selected='';
  ?> 
<tr>
<td valign="top">&nbsp;<select name="curtype" onChange="reloadme()" style="text-align:center;" style="width:300px;height:200px">
<option value="-1"> Select Head </option>
<option value="99" <?=$selected?>> ALL </option>

<?php
$sql="select course_id,coursename from course_m where status=1";
$rs=execute($sql) or die(error_description());
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs);
	
	if($curtype==$r[course_id])
	{
	?>
		<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
	<?php
	}
		else
	{
	?>
		<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
	<?php
	}
}
?>
</select>
</td>
<?
//echo $curtype;
if ($curtype=='-1' || $curtype=='')
{
	echo "<td>&nbsp;NULL</td><td>&nbsp;NULL</td></tr>";
}

?>

<?
if ($curtype=='99')
{
	echo "<td>&nbsp;ALL</td><td>&nbsp;ALL</td></tr>";
}

?>


<?
if ($curtype!='99' && $curtype!='-1' && $curtype!='')
{
?>
    <td valign="top" width="40%">&nbsp;<select name="branch[]" STYLE="width:300px;height:300px" multiple nowrap>
    <?php
    $rs=execute("SELECT a.year_name,a.year_id,c.section_name,c.id FROM course_year a,course_m b,class_section c,student_m d where a.head_id=b.head_id and b.course_id='$curtype' and c.id=d.class_section_id and a.year_id=d.course_yearsem group by a.year_id,c.section_name order by a.year_id,c.section_name");
    while($r=fetcharray($rs))
    {
        if($branch==$r[year_id] && $r[3])
        {
            echo "<option value='$r[year_id],$r[3]' selected> $r[year_name] $r[section_name]</option>";
        }
            else
        {
            echo "<option value='$r[year_id],$r[3]'> $r[year_name] $r[section_name]</option>";
        }
    }
    ?>
    </select>
    &nbsp;&nbsp;&nbsp;<input type='submit' name='enter' value='>>' class='bgbutton' onclick='form_validate()'>
    </td>
    <td>&nbsp;<select name="subject[]" STYLE="width:300px;height:300px" multiple>
    <?
    
    for($g=0;$g<sizeof($branch);$g++)
    {
        $rs_sub=execute("select * from subject_m a,course_year b where a.course_year_id='$branch[$g]' and b.year_id='$branch[$g]' and a.status=1 group by a.subject_id");
        while($r_sub=fetcharray($rs_sub))
        {
            if($subject==$r_sub[subject_name])
            echo "<option value='$r_sub[subject_id]' selected>$r_sub[year_name] - $r_sub[subject_name]</option>";
            else
            echo "<option value='$r_sub[subject_id]'>$r_sub[year_name] - $r_sub[subject_name]</option>";
        }
    
    }
     
    ?>
    </select>
    </td>
    </tr>
    
<?
} // end f cndtn
//teacher condf
if ($curtype=='99' || $curtype=='1' || $curtype=='2' || $curtype=='3'  || $curtype=='4')
{
	?>
	<tr>
	<td>&nbsp;Staff</td>
	<td colspan="3">&nbsp;<select name="teacher[]" STYLE="width:300px;height:200px" multiple>
	<?php
	
	$dd1=execute("select a.id, a.f_name,a.s_name from staff_det a,users b where  b.srid=a.id order by a.f_name");
	$countBR1=rowcount($dd1);
	for($i1=0;$i1<$countBR1;$i1++)
	{
		$rBR1 = fetcharray($dd1);
		if($teacher==$rBR1[id])
		{
			echo("<option value='$rBR1[id]' selected>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
			else
		{
			echo("<option value='$rBR1[id]'>$rBR1[f_name] $rBR1[s_name]</option>\n");
		}
	}
	?>
	</select>
	</td>
	</tr>
<?
}
?>
</table>
<br>
<div align='center'><input type='submit' name='subn' value='Submit' class='bgbutton'></div>
<br>
</form>
<!--<table class='forumline' align='center' width="100%" border="1">
<tr><td colspan=5 class='head' align='center'>View/Delete Groups</td></tr>
<tr>
<td align="left" class="row2">&nbsp;Group Name</td>
<td align="left" class="row2">&nbsp;<? echo $_SESSION['semname']; ?></td>
<td align="left" class="row2">&nbsp;Class Teacher</td></tr>
<?
/*$grpname=execute("select a.group_name,b.year_name,c.f_name from group_master a,course_year b, staff_det c where a.status=1 and b.year_id=a.grade and c.id=a.teacher order by b.year_id");
while($grupnames=fetcharray($grpname))
{
*/?>
<tr>
<td align="left" >&nbsp;<?=$grupnames[0]?></td>
<td align="left" >&nbsp;<?=$grupnames[1]?></td>
<td align="left" >&nbsp;<?=$grupnames[2]?></td></tr>
<?
//}
?>
</table>
<br><div align='center'><input type='submit' name='del' value='Delete' class='bgbutton'></div>-->

</BODY>
</HTML>
