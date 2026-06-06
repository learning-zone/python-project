<?php
$file_name= "Reporting_Staff_Details.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");

include("../db1.php");
$user=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];
$leave_paid_staff=$_POST['leave_paid_staff'];

?>
<html>
<title>Reporting Staff Details</title>
<body>
 
    <form  method="post" name="frm">
    <table width="100%" border="1" align="center" cellpadding="3"  cellspacing="0">
    <tr>
    <td colspan="6" align='center' class="head" nowrap>Reporting Staff Details</td>
    </tr>
    <tr>
    <td align='center' class='rowpic' nowrap>Sl</td>
    <td align='center' class='rowpic' nowrap>Staff Name</td>
    <td align='center' class='rowpic' nowrap>Staff Id</td>
    <td align='center' class='rowpic' nowrap>Staff Type</td>
    <td align='center' class='rowpic' nowrap>Manager</td>
    <td align='center' class='rowpic' nowrap>HR</td>
    </tr>
    <?php
	$c=1;
$staff_name_display="SELECT * from staff_det where active='YES' and (recruitment_procedure='User' or recruitment_procedure='') ";
$staff_name_display.=" ORDER BY f_name";
$staffname22=execute($staff_name_display);

	while($staff_name_dis1=fetcharray($staffname22))
	{
		
		$staffname=fetcharray(execute("select f_name,s_name,group_id,EmployeeCode from staff_det  where id='$staff_name_dis1[id]'"));
		$staff_group=fetcharray(execute("select name from staff_group where id='$staffname[2]'"));
		$staff_type=explode('(',$staff_group[0]);
		
				$staff_hr_mang=fetcharray(execute("select hr_id,mng_id from staff_hr_grup where status=1 and staff_id='$staff_name_dis1[id]'"));

		$staffname_hr=fetcharray(execute("select f_name,s_name,group_id,EmployeeCode from staff_det  where id='$staff_hr_mang[hr_id]'"));
		
		$staffname_mang=fetcharray(execute("select f_name,s_name,group_id,EmployeeCode from staff_det  where id='$staff_hr_mang[mng_id]'"));

		?>
		<input type="hidden" name="satff[]" value="<?=$staff_name_dis1['id']?>">
<tr>
<td align='center'  nowrap><?=$c?></td>
<td align='center'  nowrap><?=$staffname[0]?> <?=$staffname[1]?></td>
<td align='center'  nowrap><?=$staffname[3]?> </td>
<td align='center'  nowrap><?=$staff_type[0]?></td>
<td align='center'  nowrap><?=$staffname_mang[0]?> <?=$staffname_mang[1]?></td>
<td align='center'  nowrap><?=$staffname_hr[0]?> <?=$staffname_hr[1]?></td>

</tr>
<?php
/*echo "<br>update leave_staff_paid_tot_acc_temp set paid_vat='$total_paid' where staff_id='$staff_name_dis1[id]' and acc_id='6'";
execute("update leave_staff_paid_tot_acc_temp set paid_vat='$total_paid' where staff_id='$staff_name_dis1[id]' and acc_id='6'");
*/		
$total_paid='';
$c++;
	}
?>
</table>
 </form>