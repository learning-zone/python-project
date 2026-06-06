<html>
<head>
<?php
include("../db.php");
$ID = $_REQUEST['ID'];
?>
</head>
<?php
function MonthName($mon)
{
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}
?>
<body>
<form name='form' method='post'  ENCTYPE="multipart/form-data">
<input type="hidden" name="ID" value="<?=$ID?>">
  <?php
  $qdett=execute("select * from lib_question_paper_det where id='$ID' and flag='0'");
	if(rowcount($qdett)>0)
		$qdet=fetcharray($qdett);
	else
		die("<font color='brown' size='3'><b>No relavent data ..!!</b></font>");
	$lib_name=fetcharray(execute("select name from library_name"));
	 ?>
	 <table border='0' align='center' width='95%' class='forumline' cellspacing=2>
	 <tr >
	<td class='head' colspan=4 align='center'>Download Question Paper</td>
  </tr>
	<tr><td nowrap>&nbsp;&nbsp;Accesion No</td><td>&nbsp;&nbsp;<?php echo $qdet[question_paper_no] ?></td>
		<td>&nbsp;&nbsp;Scheme</td>
	<td>&nbsp;&nbsp;<?php echo $qdet[scheme]; ?>
	</td>
	</tr>
	<tr height="25">
		<td width="20%">&nbsp;&nbsp;Course</td>
		<td width="35%" nowrap>&nbsp;&nbsp;
		<?php
		if($qdet[course]=='0')
		{ 
			echo "First Year";
		}
		else
		{
			$cname=fetcharray(execute("select coursename from course_m where course_id='$qdet[course]'"));
			echo $cname[0];
		}
		?>
		</td>
		<td>&nbsp;&nbsp;Semester</td>
		<td>&nbsp;&nbsp;
		<?php
			$rs=fetcharray(execute("SELECT year_name FROM course_year where year_id='$qdet[sem]' "));
			echo $rs[0];
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;Subject</td>
		<td>&nbsp;&nbsp;
			<?php
			$res5=fetcharray(execute("select subject_name,subject_code from subject_m where subject_id='$qdet[subject]'"));
			echo "$res5[subject_name]";	
			?>
			</td>
			<td>&nbsp;&nbsp;Subject Code</td>
			<td>&nbsp;&nbsp;<?php echo $res5[subject_code] ?></font>
	</tr>
	<tr>
	<td>&nbsp;&nbsp;Month & Year</td>
	<td nowrap>&nbsp;&nbsp;<?php echo MonthName($qdet[month])." - ".$qdet[year];
	?>
	</td>
	<td nowrap>&nbsp;&nbsp;No of Pages</td>
	<td>&nbsp;&nbsp;<?php echo $qdet[noupld]; ?>
	</td></tr>
	<?php
	if($qdet[noupld]>0)
	{
		?>
		<tr>
		<td align='center' colspan='4'>Uploaded Files <font color='red'>*** Click on File Name to download ***</td></tr>
		<tr><td colspan='4'><table align='center' width='100%'>
		<?php
			$uplds=explode(":",$qdet[upldfiles]);
		for($i=0;$i<$qdet[noupld];$i++)
		{
			$k=$i+1;
			$pth="../question_paper/Q".$qdet[course].$qdet[sem]."/".$ID."_".$uplds[$i];
			echo "<tr height='30'><td width='15%' align='center' nowrap>Page - $k</td>";
			echo "<td><a href='$pth'>$uplds[$i]</a></td></tr>";
		}
		?>
	</table></td></tr>
	<?php
	}
	?>
</table>
</form>
</head>
</html>