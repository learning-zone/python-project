<?php
 require_once("../db.php");
$penal_day = $_REQUEST['penal_day'];
$penal_month = $_REQUEST['penal_month'];
$penal_year = $_REQUEST['penal_year'];

$penal_days = $_REQUEST['penal_days'];
$penal_months = $_REQUEST['penal_months'];
$penal_years = $_REQUEST['penal_years'];

$mtype = $_REQUEST['mtype'];
  
$penal_from=$penal_year."-".$penal_month."-".$penal_day;
$penal_to=$penal_years."-".$penal_months."-".$penal_days;  
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
</head>
<body>
<form name='frm' method="POST" action='day_studs.php'>
<input type='hidden' name='penal_day' value='<?php echo $penal_day?>'>
<input type='hidden' name='penal_month' value='<?php echo $penal_month?>'>
<input type='hidden' name='penal_year' value='<?php echo $penal_year?>'>
<input type='hidden' name='penal_days' value='<?php echo $penal_days?>'>
<input type='hidden' name='penal_months' value='<?php echo $penal_months?>'>
<input type='hidden' name='penal_years' value='<?php echo $penal_years?>'>
<input type='hidden' name='mtype' value='<?php echo $mtype?>'>
<table border=1 width="90%" align=center> 
		<tr><td colspan=6 align=center  class=head>Student Details</td></tr>
		<tr>
		        <td align=center>&nbsp;Student Name</td>
			<td align=center>&nbsp;Identification Number</td>
			<td align=center>&nbsp;Sex</td>
			<td align=center>&nbsp;Admission Type</td>
		</tr>
		<?php
			 $df=execute("select a.*,b.first_name,b.last_name,b.course_yearsem from doc_detail a,student_m b where a.d_date between '$penal_from' and '$penal_to' and a.stud_id=b.student_id group by a.stud_id");
		     while($ddf=fetcharray($df))
		       {
		         $mm=$ddf[adm_type];
			 $fd=$ddf[first_name]." ".$ddf[last_name];
			 $ecc=execute("select * from admission where id='$mm'");
			 $ec=fetcharray($ecc);
			 
		        
		?>
		<tr>
			<td >&nbsp;<?php echo $fd?></td>
			<td align=center><a href='day_studs.php?stud=<?php echo $ddf[stud_id]?>&dt=<?php echo date("d-m-Y",strtotime($ddf[d_date]))?>&fs=<?php echo $fd?>&as=<?php echo $ddf[course_id]?>&sem=<?php echo $ddf[course_yearsem]?>&ad=<?php echo $ddf[acc_year]?>&ag=<?php echo $ddf[age]?>&gen=<?php echo $ddf[sex]?>&adm=<?php echo $ddf[adm_type]?>&pf=<?php echo $penal_from?>&pt=<?php echo $penal_to?>&mtype=<?php echo $mtype?>&penal_from=<?php echo $penal_from?>&penal_to=<?php echo $penal_to?>'>
 			&nbsp;<?php echo $ddf[stud_id]?></a></td>
			<td >&nbsp;<?php echo $ddf[sex]?></td>
			<td align=center>&nbsp;<?php echo $ec[name]?></td>
		</tr>
		<?php
		   }
		?>
		
	</table>
	<br><br>
	<table border=1  width="90%" align=center> 
		<tr><td colspan=6 align=center class=head>Staff Details</td></tr>
		<tr>
		        <td align=center>&nbsp;Staff Name</td>
			<td align=center>&nbsp;Identification Number</td>
			<td align=center>&nbsp;Sex</td>
			<td align=center>&nbsp;Designation</td>
		</tr>
<?php
	$df=execute("select a.*,b.f_name,b.s_name from doc_staff a,staff_det b where a.group_id=b.group_id and a.des_id=b.type_id and a.d_date between '$penal_from' and '$penal_to' group by a.slno");
	while($ddf=fetcharray($df))
	{
		$vvv=$ddf['type_id'];
		$ecc=execute("select * from staff_des where d_id='$ddf[des_id]'");
		$ec=fetcharray($ecc);
		$rf=execute("select * from staff_det where slno='$ddf[slno]'");
		$rff=fetcharray($rf);
		$m=$rff[f_name]." ".$rff[s_name];

?>
		<tr>
			<td >&nbsp;<?php echo $m?></td>
			<td align=center><a href='day_staffs.php?stud=<?php echo $ddf[slno]?>&fs=<?php echo $m?>&gen=<?php echo $ddf[sex]?>&gg=<?php echo $ddf[des_id]?>&aa=<?php echo $ddf[slno]?>&gr=<?php echo $ddf[group_id]?>&pf=<?php echo $penal_from?>&pt=<?php echo $penal_to?>'>
			&nbsp;<?php echo $ddf[slno]?></td>
			<td >&nbsp;<?php echo $ddf[sex]?></td>
			<td >&nbsp;&nbsp;<b><?php echo $ec[d_name]?></td>
			
		</tr>
		<?php
	}
		?>
		
	</table>
	<br><br>
	<table border=1  width="90%" align=center> 
		<tr><td colspan=6 align=center class=head>Other Details</td></tr>
		<tr>
		        <td align=center>&nbsp; Name</td>
			<td align=center>&nbsp;Identification Number</td>
			<td align=center>&nbsp;Designation</td>
		</tr>
	<?php
    $df=execute("select * from doc_other where d_date between '$penal_from' and '$penal_to' group by name");
    while($ddf=fetcharray($df))
    {
		?>
		<tr>
		<td >&nbsp;<?php echo $ddf[name]?></td>
		<td align=center><a href='other_staffs.php?stud=<?php echo $ddf[name]?>&gen=<?php echo $ss?>&gg=<?php echo $ddf[type_id]?>&aa=<?php echo $ddf[slno]?>&gr=<?php echo $ddf[group_id]?>&pf=<?php echo $penal_from?>&pt=<?php echo $penal_to?>'>
		&nbsp;<?php echo $ddf[slno]?></td>
		<td >&nbsp;&nbsp;<b><?php echo $ddf[designation]?></td>
		
		</tr>
		<?php
    }
    ?>
		
	</table>
	<br><br>
</div>
</form>
</body>
</html>
