<?php
include("../db.php");

$user=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];
$paid=$_POST['paid'];
$paid_eligible=$_POST['paid_eligible'];
if(($_GET["page"])) //$_page
{ 
	$page  = $_GET["page"]; 
} 
else 
{ 
	$page=1; 
};
$start_from = ($page-1) * 10;
$sort_by = $_REQUEST['sort_by'];
$sort_type = $_REQUEST['sort_type'];
if($sort_by=="")
{
	$sort_by="f_name";
}
if($sort_type=="")
{
	$sort_type="ASC";
}
	
?>
<Script language="JavaScript">	
	function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
<ul class="tabHead">
<li><a href="leavesetup.php?tab=1" >Leave Setup</a></li>
<li><a href="leavestaffsetup.php?tab=2" >Staff Leave Detail</a></li>
<li><a href="staff_calnd.php?tab=3" >Staff Calendar</a></li>
<li><a href="staff_time.php?tab=4" >Staff Timing</a>
<li><a href="att_point.php?tab=5" >Attendance Point</a>
<li class="currentBtn"><a href="leave_paid_count1.php?tab=7" >Paid Leave Update</a>
</li>
<li><a href="leave_acc.php?tab=8">Staff Academic Setup</a></li>
</ul>
</div>
</div>
<br />
 <?php
	$accdispaly=execute("select * from leave_acc_year where status=1 and acc_name!='$a_year' order by acc_name desc");
	while($accdispaly22=fetcharray($accdispaly))
	{
		$test++;
	}
	?>
    <form  method="post" name="frm">
    <table width="100%" border="1" align="center" cellpadding="3"  cellspacing="0">
    <tr>
    <td colspan="<?=10+$test?>" align='center' class="head" nowrap>Paid Leave</td>
    </tr>
    <tr>
    <td align='center' class='rowpic' nowrap>Sl</td>
    <td align='center' class='rowpic' nowrap><a href="<?php echo "leave_paid_count1.php?sort_by=f_name&sort_type=ASC";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Staff Name<a href="<?php echo "leave_paid_count1.php?sort_by=f_name&sort_type=DESC";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a></td>
    <td align='center' class='rowpic' nowrap>Staff Id</td>
    <td align='center' class='rowpic' nowrap>Staff Type</td>
    <td align='center' class='rowpic' nowrap>Leave Eligible for the Year<br><?=$a_year?> - <?=$a_year+1?>
    </td>
   
    <td align='center' class='rowpic' nowrap>Leave Availed for the Current Year<br><?=$a_year?> - <?=$a_year+1?></td>
     <td align='center' class='rowpic' nowrap>Unpaid Leave</td>
         <td align='center' class='rowpic' nowrap>Teaching</td>
    <td align='center' class='rowpic' nowrap>Non Teaching</td>
     <td align='center' class='rowpic' nowrap>Unpaid Leave</td>
     <td align='center' class='rowpic' nowrap>Balance</td>
    </tr>
    <?php
	$c=1;
$staff_name_display="SELECT * from staff_det where active='YES' and (recruitment_procedure='User' or recruitment_procedure='') and category=2";
$staff_name_display.=" ORDER BY f_name";
$staffname22=execute($staff_name_display);
	while($staff_name_dis1=fetcharray($staffname22))
	{
		
		
		$staffname=fetcharray(execute("select f_name,s_name,group_id,EmployeeCode,category from staff_det  where id='$staff_name_dis1[id]'"));
		$staff_group=fetcharray(execute("select name from staff_group where id='$staffname[2]'"));
		$staff_type=explode('(',$staff_group[0]);
		
		
		$stafftype_nm='';
	if($staffname[4]=='1')
	{
		$stafftype_nm="Teaching";
	}
	if($staffname[4]=='2')
	{
		$stafftype_nm="Non Teaching";
	}
		?>
		<tr>
		<td align='center'  nowrap><?=$c?></td>
		<td align='center'  nowrap><?=$staffname[0]?> <?=$staffname[1]?> -- <?=$staff_name_dis1[id]?></td>
		<td align='center'  nowrap><?=$staffname[3]?> </td>
		<td align='center'  nowrap><?=$stafftype_nm?></td>
        <?php
		$staff_Eligible=fetcharray(execute("select tot_paid from leave_staff_paid_tot_acc_temp where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='6'"));
		$staff_ap=fetcharray(execute("select paid_vat from  leave_staff_paid_tot_acc_month where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='6' and pay_month='04-05' and pay_acc='2013'"));

$staff_may=fetcharray(execute("select paid_vat from  leave_staff_paid_tot_acc_month where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='6' and pay_month='05-06' and pay_acc='2013'"));

$staff_june=fetcharray(execute("select paid_vat from  leave_staff_paid_tot_acc_month where status=1 and staff_id='$staff_name_dis1[id]' and acc_id='6' and pay_month='06-07' and pay_acc='2013'"));

		?>
		  <td align='center'  nowrap><?=$staff_Eligible[0]?></td>
		<td align='center'  nowrap><?=$staff_ap[0]?></td> 
		<td align='center'  nowrap><?=$staff_may[0]?></td> 
		<td align='center'  nowrap><?=$staff_june[0]?></td> 
        <td align='center'  nowrap>
		<?php
        $staff_tot_acc=execute("select paid_vat from  leave_staff_paid_tot_acc_month where status=1 and staff_id='$staff_name_dis1[id]' and acc_id!='6' and pay_month='04-05' and pay_acc='2013' order by acc_id");
        while($staff_tot_acc1=fetcharray($staff_tot_acc))
        {
        ?>
        <?=$staff_tot_acc1[0]?>,
        <?php
        }
        ?>
        </td>
        <td align='center'  nowrap><?=$haiss?> </td>
		</tr>
		<?php
		$c++;
	}
	?>
    </table>
   </form>