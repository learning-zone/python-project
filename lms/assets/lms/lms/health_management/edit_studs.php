<html>
<?php
  include("../db.php");
  $grade =$_POST['grade'];
  
$stud =$_POST['stud'];
$fs =$_POST['fs'];

$ad =$_POST['ad'];
$at =$_POST['at'];
$dat =$_POST['dat'];
$ag =$_POST['ag'];
$gen =$_POST['gen'];
$adm =$_POST['adm'];
$dts = $_POST['dts'];
?>
<head>
<title>New Page 1</title>
</head>
<body>
<script>
function send()
{
	document.frm.action='edit_next.php';
	document.frm.submit();
}
</script>
<form name='frm' method="POST" action='edit_next.php'>
<input type=hidden name='grade' value='<?php echo $grade?>'>

<table class='forumline' cellspacing=0 width="75%" align=center> 
		<tr><td colspan=7 align=center  class=head>Student Details</td></tr>
		<tr><td align=center nowrap>&nbsp;Student Name</td>
			<td align=center nowrap>&nbsp;Identification Number</td>
			<td align=center nowrap>&nbsp;Sex</td>
			<td align=center nowrap>&nbsp;Age(Yrs.)</td>
			<td align=center nowrap>&nbsp;Admission Type</td>
			<td align=center nowrap>&nbsp;Academic Year</td>
			<td align=center nowrap>&nbsp;Date</td>
		</tr>
		<?php
		        $df=execute("select * from doc_detail where course_id='$grade' group by stud_id");
			$rc=rowcount($df);
		     while($ddf=fetcharray($df))
		       {
		         $mm=$ddf[adm_type];
			 $ecc=execute("select * from admission where id='$mm'");
			 $ec=fetcharray($ecc);
			 $dv=execute("select * from student_m where student_id='$ddf[stud_id]' and archive='N'");
			 $dvv=fetcharray($dv);
			 $fname=$dvv[first_name]." ".$dvv[last_name];
		?>
		<input type=hidden name='stud' value='<?php echo $dvv[student_id]?>'>
		<input type=hidden name='fs' value='<?php echo $fname?>'>
		<input type=hidden name='grade'value='<?php echo $ddf[course_id]?>'>
		<input type=hidden name='ad' value='<?php echo $ddf[acc_year]?>'>
		<input type=hidden name='dat' value='<?php echo $dg[d_date]?>'>
		<input type=hidden name='ag' value='<?php echo $ddf[age]?>'>
		<input type=hidden name='gen' value='<?php echo $ddf[sex]?>'>
		<input type=hidden name='adm' value='<?php echo $ec[name]?>'>
		<tr>
			<td ><?php echo $fname?></td>
			<td align=center>
			<!-- <a href='edit_next.php?stud=<?php echo $dvv[student_id]?>&fs=<?php echo $fname?>&grade=<?php echo $ddf[course_id]?>&ad=<?php echo $ddf[acc_year]?>&dat=<?php echo $dg[d_date]?>&ag=<?php echo $ddf[age]?>&gen=<?php echo $ddf[sex]?>&adm=<?php echo $ec[name]?>'> -->
			<?php echo $dvv[student_id]?></td>
			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ddf[sex]?></td>
			<td >&nbsp;&nbsp;&nbsp;<?php echo $ddf[age]?></td>
			<td >&nbsp;<?php echo $ec[name]?></td>
			<td align=center><?php echo $ddf[acc_year]?></td>
			<td align=center><select style="WIDTH: 185px" name="dts" onchange='send()'>
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
</select></td>
			
</tr>
<?php
		   }
		?>
		
	</table>
</div>
</form>
</body>
</html>
