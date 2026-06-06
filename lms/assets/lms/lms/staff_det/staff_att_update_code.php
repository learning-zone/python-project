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
		$ttimess=date('H:i:s');
	$with_date_test=date('Y-m-d');

?>
<Script language="JavaScript">	
	function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script>

 <?php
	$accdispaly=execute("select * from leave_acc_year where status=1 and acc_name!='$a_year' order by acc_name desc");
	while($accdispaly22=fetcharray($accdispaly))
	{
		$test++;
	}
	$fromdate[2]="2014";
	$fromdate[1]="07";
	$fromdate[0]="31";

		
	?>
    <form  method="post" name="frm">
    <table width="100%" border="1" align="center" cellpadding="3"  cellspacing="0">
    <tr>
    <td colspan="<?=10+$test?>" align='center' class="head" nowrap>Paid Leave</td>
    </tr>
    <tr>
    <td align='center' class='rowpic' nowrap>Sl</td>
    <td align='center' class='rowpic' nowrap>Staff Name</td>
    <td align='center' class='rowpic' nowrap>Staff Id</td>
     <?php
        for($c=0;$c<56;$c++)
		{
        
		$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
		$viewdate_att=date("Y-m-d", $attview);
		$day_view_date=date("d/m/Y", $attview);
		$viewdate_att=date("d M", $attview);
		?>
    <td align='center' class='rowpic' nowrap><?=$viewdate_att?></td>
    <?php
		}
	?>
    </tr>
    <?php
	$a=1;
$staff_name_display="SELECT f_name,s_name,group_id,EmployeeCode,category,id from staff_det where active='YES' and (recruitment_procedure='User' or recruitment_procedure='') and category=1";
$staff_name_display.=" ORDER BY f_name";
$staffname22=execute($staff_name_display);
	while($staff_name_dis1=fetcharray($staffname22))
	{
		
	
		?>
		<tr>
		<td align='center'  nowrap><?=$a?></td>
		<td align='center'  nowrap><?=$staff_name_dis1[0]?> <?=$staff_name_dis1[1]?></td>
		<td align='center'  nowrap><?=$staff_name_dis1[3]?> </td>
        <?php
        for($c=0;$c<1;$c++)
		{
        
		$attview = mktime(0,0,0,$fromdate[1],$fromdate[0]+$c,$fromdate[2]);
		$viewdate_att=date("Y-m-d", $attview);
		$day_view_date=date("d/m/Y", $attview);
		$viewdate_sunday=date("D", $attview);
		
		//mysql_query("INSERT INTO staff_att_updt (staff_id, user, type, toddate, todtime,insert_date) VALUES ( '$staffids', '$user', '$type', '$tdatess', '$ttimess','$with_date_test')");
		$view_holidays='';
		if($viewdate_sunday=='Sat' || $viewdate_sunday=='Sun')
				{
					$view_holidays='3';
				}
				else
				{
					$view_holidays='1';
				}
		$Sql66=mysql_query(" select id from staff_att_updt where toddate='$viewdate_att' and staff_id='$staff_name_dis1[id]'");		
		if(mysql_num_rows($Sql66)>0)
		{
		$sql33="update staff_att_updt set type='$view_holidays',user='$user',insert_date='$with_date_test',todtime='$ttimess' where toddate='$viewdate_att' and staff_id='$staff_name_dis1[id]'";
		mysql_query($sql33);
		}
		else
		{
		mysql_query("INSERT INTO staff_att_updt (staff_id, user, type, toddate, todtime,insert_date) VALUES ( '$staff_name_dis1[id]', '$user', '$view_holidays', '$viewdate_att', '$ttimess','$with_date_test')");
		}
		?>
		<td align='center'  nowrap><?=$view_holidays?></td>
		<?php
		}
		$a++;
		$unpa_vat='';
		$totbalance='';
		$staffname[0]='';
		$staffname[1]='';
		$staffname[3]='';
		$staff_type[0]='';
		$total_paid='';
	}
	?>
    </table>
   </form>