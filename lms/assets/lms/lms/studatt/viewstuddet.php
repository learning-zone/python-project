<html>
<head>
		<?php
		session_start();
		include("../db.php");
		$table = marks."_".$branch."_".$sem;
	
		?>
</head>
<script language="JavaScript">
			function prn()
			{
				pr1.style.display = "none";
				window.print();
			}
</script>
<body>
<?php
$sql="SELECT a.id ,a.student_id,a.first_name FROM student_m a, $table b where a.course_admitted ='$branch' and   a.course_yearsem='$sem' and a.id=b.studid group by  a.student_id";

$rs=execute($sql) or die(mysql_error());
		if(rowcount($rs)==0)
			{
				echo "<font color=brown><b>No Records Found !!</b></font>";
				die();
			}
?>
<form name="frm" method="post">
<input type="hidden" name="app_no" value="<?php echo $app_no?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="sem" value="<?php echo $sem ?>">
<input type="hidden" name="studfname" value="<?php echo $studfname ?>">
<input type="hidden" name="a_year" value="<?php echo $a_year?>">
<input type="hidden" name="un" value="<?php echo $un ?>">


<table border=1 class=forumline align=center width='60%' >

<?

$result = execute("SELECT  a.subject_name , b.subid  FROM subject_m a,$table b  where a.course_id='$branch' and a.course_year_id='$sem' and a.subject_id=b.subid  group by  a.subject_name order by a.sub_pre ");
while($row = fetcharray($result))
{
	  	$subid[]=$row[subid];
	  	$subname[]=$row[subject_name];
}
$colspn=4+(3*sizeof($subid));
?>
<tr>
<td align='center' class='head' colspan='<?=$colspn?>'><font size="4"><b>Consolidated Attendance Report</b></font></td>
</tr>
<tr height='25'>
<td rowspan="2" align="center" Class="rowpic">Slno</td>
<td rowspan="2" align="center"  Class="rowpic">Student ID</td>
<td rowspan="2" align="center"  Class="rowpic" >Student Name</td>
<?php
for($i=0;$i<sizeof($subid);$i++)
{
	?>
		<td colspan="3" align="center"  Class="rowpic" >&nbsp;<?php echo $subname[$i];?>
	<?
}
?>
</tr>
<tr height='25'>
<?
$result = execute("SELECT  a.subject_name  FROM subject_m a,$table b  where a.course_id='$branch' and a.course_year_id='$sem' and a.subject_id=b.subid group by b.subid");
	while($row = fetcharray($result))
	{
	?>
		<td align="center"  Class="rowpic" nowrap> &nbsp; CC</td>
		<td align="center"  Class="rowpic" nowrap> &nbsp; CA</td>
        <td align="center"  Class="rowpic" nowrap> &nbsp; % &nbsp;</td>
	<?
	}
?>
</tr>
<?php
    $rowclass=1;
	while($r=fetcharray($rs))
	{	 
	
		?>
		<tr height='25'>
		<td  align="center" ><?=$rowclass?></td>
        <td  align="center" nowrap><?=$r[student_id]?></td>
        <td  align="center" nowrap><?=$r[first_name]?></td>
        <?
		for($i=0;$i<sizeof($subid);$i++)
	    {
			
			$sql2=execute("SELECT cc,ca FROM $table  where subid='$subid[$i]' and studid='$r[id]'");
			if(rowcount($sql2)>0)
			{
				while($r4=fetcharray($sql2))
				{
					if($r4[ca]==0)
					$temper=0;
					else
					$temper=($r4[ca]*100)/$r4[cc];
					?>
					<td nowrap >&nbsp;<?=$r4[cc]?></td><td nowrap >&nbsp;<?=$r4[ca]?></td>
                    <td nowrap >&nbsp;<?=$temper?></td>
					<?php 
				}
			}
			else
			{
				?>
				<td nowrap >&nbsp;0</td><td nowrap >&nbsp;0</td><td nowrap >&nbsp;0</td>
				<?php 
			}
		}
		$rowclass++;
		echo "</tr>";
	} 
	?>
		  
</table>
<br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>
</form>
</body>
</html>