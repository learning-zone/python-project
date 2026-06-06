<html>
<?php
  include("../db.php");
  	$grade=$_POST['grade'];
  
  	$stud =$_POST['stud'];
	$fs =$_POST['fs'];
	$ad =$_POST['ad'];
	$gen =$_POST['gen'];
	$adm =$_POST['adm'];
	$ag =$_POST['ag'];
	$dts = $_POST['dts'];
?>
<head>
<script>
function reload()
{
	
	document.frm.action='view_medical_next.php';
	document.frm.submit();
	
}
</script>

<title>Student Details</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method="POST" action='view_studs.php'>
<input type=hidden name='grade' value='<?php echo $grade?>'>
<table border=1 class='forumline' cellspacing=0 width="70%" align=center> 
		<tr><td colspan=7 align=center class=head>Student Details</td></tr>
		<tr>
		        <td align=center>&nbsp;Student Name</td>
			<td align=center>&nbsp;Identification Number</td>
			<td align=center>&nbsp;Sex</td>
			<td align=center>&nbsp;Age(Yrs.)</td>
			<td align=center>&nbsp;Admission Type</td>
			<td align=center>&nbsp;Academic Year</td>
			<td align=center>&nbsp;Date</td>
		</tr>
		<?php
		       $df=execute("select * from doc_detail where course_id='$grade' group by stud_id");
		     while($ddf=fetcharray($df))
		       {
		         $mm=$ddf[adm_type];
				 $ecc=execute("select * from admission where id='$mm'");
				 $ec=fetcharray($ecc);
			 
			 $sf=execute("select * from student_m where student_id='$ddf[stud_id]'");
			 $ssf=fetcharray($sf);
			 $f=$ssf[first_name]." ".$ssf[last_name];
		?>
		<input type=hidden name='grade' value='<?php echo $ddf[course_id]?>'>
		<input type=hidden name='ad' value='<?php echo $ddf[acc_year]?>'>
		<input type=hidden name='gen' value='<?php echo $ddf[sex]?>'>
		<input type=hidden name='adm' value='<?php echo $ddf[adm_type]?>'>
		<input type=hidden name='ag' value='<?php echo $ddf[age]?>'>
		<input type=hidden name='stud' value='<?php echo $ddf[stud_id]?>'>
		<input type=hidden name='fs' value='<?php echo $f?>'>
		

		<tr>
			<td >&nbsp;<?php echo $f?></td>
			<td align=center>
			<!-- <a href='view_medical_next.php?stud=<?php echo $ddf[stud_id]?>&fs=<?php echo $f?>&grade=<?php echo $ddf[course_id]?>&ad=<?php echo $ddf[acc_year]?>&ag=<?php echo $ddf[age]?>&gen=<?php echo $ddf[sex]?>&adm=<?php echo $ddf[adm_type]?>'> -->
			&nbsp;<?php echo $ddf[stud_id]?>
			</td>
			<td >&nbsp;<?php echo $ddf[sex]?></td>
			<td >&nbsp;&nbsp;<?php echo $ddf[age]?></td>
			<td >&nbsp;<?php echo $ec[name]?></td>
			<td align=center>&nbsp;<?php echo $ddf[acc_year]?></td>
			<td align=center>&nbsp;<select style="WIDTH: 185px" name="dts" onchange='reload()'>
					<option value='0'>Select Date</option>
					<?php
					$dv=execute("select * from doc_detail where course_id='$grade' and stud_id='$ddf[stud_id]'");
					$rcp=rowcount($dv);
					for($i=0;$i<$rcp;$i++)
				   {
							$dg=fetcharray($dv);
							$dt=date('d-m-Y',strtotime($dg[d_date]));
							if($dts==$dg[d_date])
							{
							 echo("<option value='$dg[d_date]' selected>$dt</option>");
							}
							else
							{
							 echo("<option value='$dg[d_date]'>$dt</option>");
							} 
				   }
					?>
</select>
</td>
</tr>
		<?php
		   }
		?>
		
	</table>
</div>
</form>
</body>
</html>
