
<html>
<?php
include("../db.php");
$grade=$_POST['grade'];
$ad=$_POST['ad'];
$st=$_POST['st'];
$sid=$_POST['sid'];
?>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>New Page 1</title>
</head>
<body>
<table border='1' class='forumline' cellspacing=0 width="55%" align=center> 
		<tr><td colspan=3 align=center class=head>Student Details</td></tr>
		<tr>
		        <td align=center>Student Name</td>
			<td align=center>Identification Number</blink></td>
			<td align=center>Academic Year</td>
		</tr>
		<?php
		     $rg=execute("select * from student_m where course_admitted='$grade' and archive='N'");
		     while($fg=fetcharray($rg))
			 {
			   $fname=$fg[first_name]." ".$fg[last_name];


		?>
		        <tr>
			<td>&nbsp;&nbsp;<?php echo $fname?></td>
			<td align=center><a href='ins_medical.php?grade=<?php echo $fg[course_admitted]?>&ad=<?php echo $fg[academic_year]?>&st=<?php echo $fname?>&sid=<?php echo $fg['student_id']?>'>
			<?php echo $fg[student_id]?></a></td>
			<td align=center><?php echo $fg[academic_year]?></td>
		</tr>
           <?php
		}
            ?>
		
	</table>
</div>
</body>
</html>
