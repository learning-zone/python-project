<?php
include("../db.php");
$user=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];
$leave_paid_staff=$_POST['leave_paid_staff'];

$leave_paid_staff_apr=$_POST['leave_paid_staff_apr'];
$leave_paid_staff_may=$_POST['leave_paid_staff_may'];
$leave_paid_staff_jun=$_POST['leave_paid_staff_jun'];
$leave_paid_staff_july=$_POST['leave_paid_staff_july'];
$leave_paid_staff_aug=$_POST['leave_paid_staff_aug'];
$leave_paid_staff_sep=$_POST['leave_paid_staff_sep'];
$leave_paid_staff_oct=$_POST['leave_paid_staff_oct'];
$leave_paid_staff_nov=$_POST['leave_paid_staff_nov'];
$leave_paid_staff_dec=$_POST['leave_paid_staff_dec'];
$leave_paid_staff_jan=$_POST['leave_paid_staff_jan'];
$leave_paid_staff_feb=$_POST['leave_paid_staff_feb'];
$leave_paid_staff_mar=$_POST['leave_paid_staff_mar'];



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

if($_POST['save'])
	{
		$satff=$_POST['satff'];
		for($d=0;$d<sizeof($satff);$d++)
		{		
			$stfid=$satff[$d];
			//$satff_acc=$_POST['satff_acc'.$stfid];
		$leave_paid_staff_apr=$_POST['leave_paid_staff_apr'.$stfid];
		$leave_paid_staff_may=$_POST['leave_paid_staff_may'.$stfid];
		$leave_paid_staff_jun=$_POST['leave_paid_staff_jun'.$stfid];
		$leave_paid_staff_july=$_POST['leave_paid_staff_july'.$stfid];
		$leave_paid_staff_aug=$_POST['leave_paid_staff_aug'.$stfid];
		$leave_paid_staff_sep=$_POST['leave_paid_staff_sep'.$stfid];
		$leave_paid_staff_oct=$_POST['leave_paid_staff_oct'.$stfid];
		$leave_paid_staff_nov=$_POST['leave_paid_staff_nov'.$stfid];
		$leave_paid_staff_dec=$_POST['leave_paid_staff_dec'.$stfid];
		$leave_paid_staff_jan=$_POST['leave_paid_staff_jan'.$stfid];
		$leave_paid_staff_feb=$_POST['leave_paid_staff_feb'.$stfid];
		$leave_paid_staff_mar=$_POST['leave_paid_staff_mar'.$stfid];
			
			$staff_paid=execute("select * from unpaid_leave_data_m20 where  staff_id='$stfid'");
						if(mysql_num_rows($staff_paid)>=1)
						{
						
						execute("update unpaid_leave_data_m20 set Apr_13='$leave_paid_staff_apr',	May_13='$leave_paid_staff_may',June_13='$leave_paid_staff_jun',July_13='$leave_paid_staff_july',Aug_13='$leave_paid_staff_aug',Sep_13='$leave_paid_staff_sep',Oct_13='$leave_paid_staff_oct',Nov_13='$leave_paid_staff_nov',Dec_13='$leave_paid_staff_dec',Jan_14='$leave_paid_staff_jan',Feb_14='$leave_paid_staff_feb',March_14='$leave_paid_staff_mar' where staff_id='$stfid'");
						}
						else
						{
						
						execute("INSERT INTO unpaid_leave_data_m20 (staff_id,Apr_13,May_13,June_13,July_13,Aug_13,Sep_13,Oct_13,Nov_13,	Dec_13,Jan_14,Feb_14,March_14) VALUES ('$stfid','$leave_paid_staff_apr','$leave_paid_staff_may','$leave_paid_staff_jun','$leave_paid_staff_july','$leave_paid_staff_aug','$leave_paid_staff_sep','$leave_paid_staff_oct','$leave_paid_staff_nov','$leave_paid_staff_dec','$leave_paid_staff_jan','$leave_paid_staff_feb','$leave_paid_staff_mar')");
						}
			
		}
	}
	
?>
<html>
<title>Unpaid Leave</title>
<body>


 
    <form  method="post" name="frm">
    <table width="100%" border="1" align="center" cellpadding="3"  cellspacing="0">
    <tr>
    <td colspan="17" align='center' class="head" nowrap>Unpaid Leave</td>
    </tr>
    <tr>
    <td align='center' class='rowpic' nowrap>Sl</td>
    <td align='center' class='rowpic' nowrap><a href="<?php echo "leave_undata_month.php?sort_by=f_name&sort_type=ASC";?>" title="Click here to Sort ASC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9650;</font>
</a>Staff Name<a href="<?php echo "leave_undata_month.php?sort_by=f_name&sort_type=DESC";?>" title="Click here to Sort DESC" style="text-decoration: none"><font style="font-size:16px; color:#000">&#9660;</font></a></td>
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
    </tr>
    <?php
	$c=1;
$staff_name_display="SELECT * from staff_det where active='YES' and (recruitment_procedure='User' or recruitment_procedure='') ";
$staff_name_display.=" ORDER BY $sort_by $sort_type LIMIT $start_from, 10";
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
<input type="text" name="leave_paid_staff_apr<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['Apr_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_may<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['May_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_jun<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['June_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_july<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['July_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_aug<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['Aug_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_sep<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['Sep_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_oct<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['Oct_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_nov<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['Nov_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_dec<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['Dec_13']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_jan<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['Jan_14']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_feb<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['Feb_14']?>" size="3%" /></td>
<td align='center'  nowrap><input type="text" name="leave_paid_staff_mar<?=$staff_name_dis1[id]?>" value="<?=$staff_paid_leave['March_14']?>" size="3%" /></td>
</tr>
<?php

execute("update leave_staff_paid_tot_acc_temp set un_paid='$total_paid' where staff_id='$staff_name_dis1[id]' and acc_id='6'");

$total_paid='';
$c++;
	}
?>
<tr><td align="center" nowrap="nowrap" colspan="17">
    <?php
 $tempsql=$staff_name_display;
 $tempsql1=explode("SELECT *", $tempsql);
 $tempsql2=explode(" LIMIT ", $tempsql1[1]);
 $tempsql1 = $tempsql2[0];
 $sql ="SELECT COUNT(id) ".$tempsql1;

 $rs_result = mysql_query($sql);

 $row = mysql_fetch_row($rs_result);

 $total_records = $row[0];

 $total_pages = ceil($total_records / 10);

  

 echo "<p align='center'>";

 if($page==1)
  echo "First&nbsp;";
 else
  echo "<a href='leave_undata_month.php?page=1&sort_by=".$sort_by."&sort_type=".$sort_type."' title='Click to go to First page..'  > First </a> &nbsp;";

 $prv=$page-1;

 if($prv>0)
  echo "<a href='leave_undata_month.php?page=".$prv."&sort_by=".$sort_by."&sort_type=".$sort_type."' title='Click to go to Previous page..'  > Previous </a> &nbsp;";
 else
  echo "&#9668;";

 echo "&nbsp;(Page $page of $total_pages)&nbsp;";

 $nxt=($page+1); 

 if($nxt<=$total_pages)
  echo "<a href='leave_undata_month.php?page=".$nxt."&sort_by=".$sort_by."&sort_type=".$sort_type."' title='Click to go to Next page..'  > Next </a> &nbsp;"; 
 else
  echo "&#9658;";

 if($page==$total_pages)
  echo "&nbsp;Last&nbsp;";
 else
  echo "<a href='leave_undata_month.php?page=".$total_pages."&sort_by=".$sort_by."&sort_type=".$sort_type."' title='Click to go to Last page..' >Last</a> &nbsp;";

  echo "<br>Total $total_records Staff(s)</p>";
?>
</td>
</tr>
</table>
   <br />
    <div align='center' >
  <input type="submit"  name="save" value="Save"  class='bgbutton'>  </div>
 </form>