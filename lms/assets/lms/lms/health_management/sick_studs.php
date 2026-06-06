<html>
<?
  include("../db.php");
$grade=$_POST['grade'];  
$stud =$_POST['stud'];
$fs =$_POST['fs'];
$ad =$_POST['ad'];
$ag =$_POST['ag'];
$gen =$_POST['gen'];
$adm =$_POST['adm'];
?>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>Student Details</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method="POST" action='sick_studs.php'>
<input type=hidden name='grade' value='<?php echo $grade?>'>
<table  class='forumline' cellspacing=0 width="55%" align=center> 
		<tr><td colspan=6 align=center  class=head>Student Details</td></tr>
		<tr>
		        <td align=center>Student Name</td>
			<td align=center>Identification Number</td>
			<td align=center>Sex</td>
			<td align=center>Age(Yrs.)</td>
			<td align=center>Admission Type</td>
			<td align=center>Academic Year</td>
		</tr>
		<?php
		       $df=execute("select * from student_m where course_admitted='$grade' and archive='N'");
		     while($ddf=fetcharray($df))
		       {
		         $fname=$ddf[first_name]." ".$ddf[last_name];
		         $mm=$ddf[admission_type];
			 $ecc=execute("select * from admission where id='$mm'");
			 $ec=fetcharray($ecc);		 
			 $cdat=date('Y-m-d');
			 $ddat=$ddf[dob];
			 $h=$cdat-$ddat;
			 $diff=date_diff($cdat,$ddat,$h);
			 if($ddf[gender]=='F')
			 {
			   $ss='Female';
			 }
			 else
			 {
			   $ss='Male';
			 }
		        
		?>
		<tr>
			<td >&nbsp;&nbsp;<?php echo $fname?></td>
			<td align=center><a href='sick_next.php?stud=<?php echo $ddf[student_id]?>&fs=<?php echo $fname?>&grade=<?php echo $ddf[course_admitted]?>&ad=<?php echo $ddf[academic_year]?>&ag=<?php echo $h?>&gen=<?php echo $ss?>&adm=<?php echo $ddf[admission_type]?>'>
			<?php echo $ddf[student_id]?></td>
			<td >&nbsp;<?php echo $ss?></td>
			<td >&nbsp;&nbsp;<?php echo $h?></td>
			<td ><?php echo $ec[name]?></td>
			<td align=center><?php echo $ddf[academic_year]?></td>
		</tr>
		<?php
		   }
		?>
		
	</table>
</div>
</form>
</body>
</html>
