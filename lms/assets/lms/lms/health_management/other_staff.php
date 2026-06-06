<html>
<?
  include("../db.php");
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
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>Other Details</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method="POST" action='other_staffs.php'>
<input type='hidden' name='penal_day' value='<?php echo $penal_day?>'>
<input type='hidden' name='penal_month' value='<?php echo $penal_month?>'>
<input type='hidden' name='penal_year' value='<?php echo $penal_year?>'>
<input type='hidden' name='penal_days' value='<?php echo $penal_days?>'>
<input type='hidden' name='penal_months' value='<?php echo $penal_months?>'>
<input type='hidden' name='penal_years' value='<?php echo $penal_years?>'>
<table border=1 width="55%" align=center> 
		<tr><td colspan=6 align=center  class=head>Other Details</td></tr>
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
</div>
</form>
</body>
</html>
