<?php
session_start();
require_once("../db.php");
$library=$_POST['library'];
$register=$_POST['register'];
$status=$_POST['status'];
$issue_date=$_POST['issue_date'];
$ndate=$_POST['ndate'];
$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$FYear=$_POST['FYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
//print_r($_GET);
//print_r($_POST);
?>
<HTML>
<head>
<script language="JavaScript">
		function printReport()
		{
			prn.style.display = "none";

			window.print();
			prn.style.display = "";
		}
</script>
</head>
<?php
if(!checkdate($FMon,$FDay,$FYear))
{
	echo "Invalid From Date. ";
	die("</td></tr></table>");
}
$from_date = "$FYear-$FMon-$FDay";

if(!checkdate($TMon,$TDay,$TYear))
{
	echo "Invalid To Date. ";
	die("</td></tr></table>");
}
$to_date = "$TYear-$TMon-$TDay";
?>
	<FORM NAME="frm" METHOD="POST">
	      <INPUT TYPE="HIDDEN" NAME="issue_date" VALUE="<?=$issue_date;?>">
	      <INPUT TYPE="HIDDEN" NAME="TYear" VALUE="<?=$TYear;?>">
	      <INPUT TYPE="HIDDEN" NAME="TMon" VALUE="<?=$TMon;?>">
	      <INPUT TYPE="HIDDEN" NAME="TDay" VALUE="<?=$TDay;?>">
	      <INPUT TYPE="HIDDEN" NAME="FYear" VALUE="<?=$FYear;?>">
		  <INPUT TYPE="HIDDEN" NAME="FMon" VALUE="<?=$FMon;?>">
		  <INPUT TYPE="HIDDEN" NAME="FDay" VALUE="<?=$FDay;?>">
		  <INPUT TYPE="HIDDEN" NAME="register" VALUE="<?=$register;?>">
          <INPUT TYPE="HIDDEN" NAME="ndate" VALUE="<?=$ndate;?>">
	      <INPUT TYPE="HIDDEN" NAME="library" VALUE="<?=$library;?>">
<body>
<table width='90%' class='forumline' align="center" >
<tr>
<td colspan=6 align='center' class="head">Book Binding Report</td></tr>
<tr>
<?php
/*
<td class=row2 colspan=5>
<?
	$rs_sql=execute("select * from lib_register where id=$register");
	if(rowcount($rs_sql)>0)
	{
		$r_sql=fetcharray($rs_sql);
		$register_name=$r_sql[register];
	}
	else
    {
		$register_name="ALL Registers";
	}
	mysql_free_result($rs_sql);

?>
	Register:<?=$register_name?>

</td class=row2 colspan=6>

*/
	$Register=1;
	?>
<td align='right' class=row2 colspan="6">
	As on : <?=date('d-m-Y')?>
</td></tr>
<?
if($status =='D')
{
?>
	<tr>
	<td colspan=6 align=center class=row2>
		 From:  <?=date('d-m-Y',strtotime($from_date))?>&nbsp;&nbsp; To:   <?=date('d-m-Y',strtotime($to_date))?>
	</td>
	</tr>
<?
}
?>
<tr>
<td colspan=6 align='center' class='rowpic'>
<?
if($status=='O')
	$remarks='Outstanding Detail Report';
elseif($status=='D')
	$remarks='Detailed Report';
?>
	 <?=$remarks?></td></tr>
<tr>
<td align='center' class="head">
	Sl No.</td>
<td align='center' class="head">
	Accession No</td>
<!--<td align='center' class="head">
	Title</td >-->
<td align='center' class="head">
	Date Send for Binding</td>
<td align='center' class="head">
	Return Date</td>
<td class="head" align='center'>
	Status</td>
<td class="head" align='center' >
	Description</td ></tr>

<?
//echo "<p>Register: $register</p>";
if($register=='0')
{  
   if($status=='O')
	{
		$qry="select a.title,c.* from lib_book_details a,lib_acc_details b,lib_book_binding c ";
		$qry.= " where a.id=b.master_id and b.acc_no=c.acc_no and c.status='S' and c.binding_date ";
		$qry.=" between '$from_date' and '$to_date' order by c.binding_date";
	}
	else
	{
		$qry="select a.title,c.* from lib_book_details a,lib_acc_details b,lib_book_binding c ";
		$qry.= " where a.id=b.master_id and b.acc_no=c.acc_no and c.binding_date ";
		$qry.=" between '$from_date' and '$to_date' order by c.binding_date";
	}
}
else
{   
 if($status=='O')
	{  
	    $register=1;
		$qry="select a.title,c.* from lib_book_details a,lib_acc_details b,lib_book_binding c ";
		$qry.= " where a.id=b.master_id and c.status='S' and b.register=$register and c.binding_date ";
		$qry.=" between '$from_date' and '$to_date' group by c.acc_no";
	}
	else
	{   
	    $register=1;
		/*$qry="select a.title,c.* from lib_book_details a,lib_acc_details b,lib_book_binding c ";
		$qry.= " where a.id=b.master_id and b.acc_no=c.acc_no and b.register=$register and c.binding_date ";
		$qry.=" between '$from_date' and '$to_date' order by c.binding_date";*/
		
		$qry="select a.title,c.* from lib_book_details a,lib_acc_details b,lib_book_binding c ";
		$qry.= " where a.id=b.master_id and b.register=$register and c.binding_date ";
		$qry.=" between '$from_date' and '$to_date' group by c.acc_no";
	}
}
$rs_sql=execute($qry) or die("No Records found !!!");
$count=1;
for($i=0; $i <rowcount($rs_sql); $i++)
{
	$r_sql=fetcharray($rs_sql,$i);


		echo "<tr>";
		echo "<td align='center'>";
			echo "$count";
		echo "</td>";

		echo "<td align='center'>";
				echo "$r_sql[acc_no]";
		echo "</td>";
		//echo "<td align='left'>";
					//echo "$r_sql[title]";
		//echo "</td>";
		echo "<td align='center'>";
			$binding_date=date('d-m-Y',strtotime($r_sql[binding_date]));
				echo "$binding_date";
		echo "</td>";
		echo "<td align='center'>";
		
			$return_date=$r_sql[return_date];
			$dateArray=explode('-',$return_date);
			$acq_yy=$dateArray[2];
			$acq_mm=$dateArray[1];
			$acq_dd=$dateArray[0];
			$return_date="$acq_yy-$acq_mm-$acq_dd";
	
		//$return_date=date('d-m-Y',strtotime($r_sql[return_date]));
				echo "$return_date";
				
		echo "</td>";
		echo "<td align='center'>";
			if($r_sql[status]=='S')
				$remarks='Not Bounded';
			elseif($r_sql[status]=='R')
				$remarks='Bounded';
			echo "$remarks";
		echo "</td>";
		
		echo "<td align='center'>";
				echo "$r_sql[descr]";
		echo "</td>";
		
		echo "</tr>";
		$count=$count+1;
}
?>
</table>
<br>
<br>
<div id='prn' align=center>
	<INPUT TYPE="button" NAME="print" VALUE="<<  Print  >>" class=bgbutton onClick="printReport()">
</div>
</body>
</html>