<?php
include("../db.php");
$user=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];
?>
<html>
<title>Unpaid Leave Report</title>
<body>
<script LANGUAGE="JavaScript">
function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
		function gen_excel()
		{
			document.frm.action='unpaid_leave_exl.php';
			document.frm.submit();
		}
</script>


 
    <form  method="post" name="frm">
    <table width="100%" border="1" align="center" cellpadding="3"  cellspacing="0">
    <tr>
    <td colspan="18" align='center' class="head" nowrap>Unpaid Leave Report</td>
    </tr>
    <tr>
    <td align='center' class='rowpic' nowrap>Sl</td>
    <td align='center' class='rowpic' nowrap>Staff Name</td>
    <td align='center' class='rowpic' nowrap>Staff Id</td>
    <td align='center' class='rowpic' nowrap>Staff Type</td>
    <td align='center' class='rowpic' nowrap>Leave Eligible for the Year<br><?=$a_year?> - <?=$a_year+1?>
    </td>
    <td align='center' class='rowpic' nowrap>Apr-13</td>
    <td align='center' class='rowpic' nowrap>May-13</td>
    <td align='center' class='rowpic' nowrap>June-13</td>
    <td align='center' class='rowpic' nowrap>July-13</td>
    <td align='center' class='rowpic' nowrap>Aug-13</td>
    <td align='center' class='rowpic' nowrap>Sep-13</td>
    <td align='center' class='rowpic' nowrap>Oct-13</td>
    <td align='center' class='rowpic' nowrap>Nov-13</td>
    <td align='center' class='rowpic' nowrap>Dec-13</td>
    <td align='center' class='rowpic' nowrap>Jan-14</td>
    <td align='center' class='rowpic' nowrap>Feb-14</td>
    <td align='center' class='rowpic' nowrap>March-14</td>
    <td align='center' class='rowpic' nowrap>Total</td>    
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
		$staff_Eligible=fetcharray(execute("select tot_paid from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='6'"));
		
		$staff_paid_leave=fetcharray(execute("select  Apr_13,May_13,June_13,	July_13,Aug_13,Sep_13,Oct_13,Nov_13,Dec_13,Jan_14,Feb_14,March_14,id from unpaid_leave_data_m20 where staff_id='$staff_name_dis1[id]'"));
		
		$total_paid=$staff_paid_leave['Apr_13']+$staff_paid_leave['May_13']+$staff_paid_leave['June_13']+$staff_paid_leave['July_13']+$staff_paid_leave['Aug_13']+$staff_paid_leave['Sep_13']+$staff_paid_leave['Oct_13']+$staff_paid_leave['Nov_13']+$staff_paid_leave['Dec_13']+$staff_paid_leave['Jan_14']+$staff_paid_leave['Feb_14']+$staff_paid_leave['March_14'];
		?>
		<input type="hidden" name="satff[]" value="<?=$staff_name_dis1['id']?>">
<tr>
<td align='center'  nowrap><?=$c?></td>
<td align='center'  nowrap><?=$staffname[0]?> <?=$staffname[1]?></td>
<td align='center'  nowrap><?=$staffname[3]?> </td>
<td align='center'  nowrap><?=$staff_type[0]?></td>
<td align='center'  nowrap><?=$staff_Eligible[0]?></td>
<td align='center'  nowrap>
<?=$staff_paid_leave['Apr_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['May_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['June_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['July_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['Aug_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['Sep_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['Oct_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['Nov_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['Dec_13']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['Jan_14']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['Feb_14']?></td>
<td align='center'  nowrap><?=$staff_paid_leave['March_14']?></td>
<td align='center'  nowrap><?=$total_paid?></td>

</tr>
<?php
execute("update leave_staff_paid_tot_acc_temp set un_paid='$total_paid' where staff_id='$staff_name_dis1[id]' and acc_id='6'");

$total_paid='';
$c++;
	}
?>
</table>
<br>
<div id=pr1 align=center>
<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="gen_excel()">
 &nbsp;&nbsp;
<INPUT TYPE="button" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>

 </form>