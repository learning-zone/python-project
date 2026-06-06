<html>
<head>
<title>Fee Receipt</title>
<?php
include("../db.php");

$temp_value_det=date("Y");
$temp_month_detalis=date("m");
if($temp_month_detalis<5)
{
	$temp_year_detalis=$temp_value_det-1;
}
else
{
	$temp_year_detalis=date("Y");
}
$accyear=$temp_year_detalis;

if($_REQUEST['stud_id'])
{
	$stud_id=$_REQUEST['stud_id'];
	$course=$_REQUEST['course'];
	$sem=$_REQUEST['sem'];
	$adm_id=$_REQUEST['adm_id'];
	$stud_yr=$_REQUEST['stud_yr'];
}
else
{
	$stud_id=$_POST['stud_id'];
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$adm_id=$_POST['adm_id'];
	$stud_yr=$_POST['stud_yr'];
}

$oldbalamt=$_POST['oldbalamt'];
$pydt=$_POST['pydt'];
$pymt=$_POST['pymt'];
$pyyr=$_POST['pyyr'];
$dddate=$pyyr."-".$pymt."-".$pydt;
$comets=$_POST['comets'];
$amount=$_POST['amount'];
$paymenttype=$_POST['paymenttype'];
$amt=$_POST['amt'];
$fnamt=$_POST['fnamt'];
$cenamt=$_POST['cenamt'];
if($_POST)
{
	$qury="INSERT INTO `spl_advances_coll` (`div` ,`class` ,`acc_year` ,`student_id` ,`col_amount` ,`bal_amount` ,`col_date` ,`desc` ,`status`)
VALUES ('$course','$sem','$accyear','$stud_id','$amount','$amount','$dddate','$comets','1')";


execute($qury);

//************************************reciving adwance from student **************************************

	$ttlamt=$amount;
	$newRemarks=$comets;
	$dddate1=$dddate;
	$u1=execute("select * from ac_voucher where iIdx_vouchermaster=2");
		$ru1=rowcount($u1);
		if($ru1>0)
		{
			$n1=$ru1/2;
			if($n1>9)
			{
				$n2='00'.($n1+1);
			}
			else
			{
				$n2='000'.($n1+1);
			}
		}
		else
		{
			$n2='0001';
		}

		
$cashdetBal=execute("select fopbal from ac_ledger where iIdx_ledger=39");
$traildetBal=execute("select fopbal from ac_ledger where iIdx_ledger=34");
$cashdetBal1=fetchrow($cashdetBal);
$traildetBal1=fetchrow($traildetBal);

$newcashdetBal1=$cashdetBal1[0]-$ttlamt;
$newtraildetBal1=$traildetBal1[0]+$ttlamt;
$newRemarks=strtoupper($amt_str);

execute("update ac_ledger set fopbal='$newcashdetBal1' where iIdx_ledger=39");
execute("update ac_ledger set fopbal='$newtraildetBal1' where iIdx_ledger=34");

execute("INSERT INTO ac_opbal (opdate, Vledger, fopbal, iId_grp, vins, Dr_Cr, iIdx_organization) VALUES
('$dddate1', 'Student a/c', $newcashdetBal1, 24, 'Bangalore School', 'Cr', 1),
('$dddate1', 'Cash', $newtraildetBal1, 21, 'Bangalore School', 'Dr', 1)");

execute("INSERT INTO ac_voucher ( iIdx_ledger, iIdx_vouchermaster, iIdx_institution, ddate, Dr_Cr, particulars, chequedd_no, chequedd_date, fdebit, fcredit, vvoucherno, vnarration, acc, iIdx_group, istatus, iIdx_organization, vbillno, dbilldate) VALUES
(34, 2, 1, '$dddate1', 'Dr', 'By Cash', '', '0000-00-00', '$ttlamt', '0.00', '$n2', '$newRemarks', 'Cash', 21, 0, 1, '$docid', '$dddate1'),
(39, 2, 1, '$dddate1', 'Cr', 'To Student a/c', '', '0000-00-00', '0.00', '$ttlamt', '$n2', '$newRemarks', 'Student a/c', 24, 0, 1, '$docid', '$dddate1')");


//*******************************************code end *********************************************





	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated Successfully");
	window.close();
	</SCRIPT>
	<?php

}


?>
<script language="javascript" type="text/javascript">
function reload()
{
	document.frm.action="generateReceipt.php";
	document.frm.submit();
}
function genrpt()
{
	document.frm.action="gen_recpt.php";
	document.frm.submit();
}
function genrpt1()
{
	document.frm.action="gen_recpt1.php";
	document.frm.submit();
}
</script>
<style>
	.text{text-align:right;}
</style>
</head>
<body>
<form name="frm" method='post' action="">
<input type='hidden' name='course' value='<?=$course?>'>
<input type='hidden' name='sem' value='<?=$sem?>'>
<input type='hidden' name='adm_id' value='<?=$adm_id?>'>
<input type='hidden' name='stud_id' value='<?=$stud_id?>'>
<input type='hidden' name='stud_yr' value='<?=$stud_yr?>'>
<?php
$cdt=date('d');
$cmt=date('m');
$cyr=date('Y');
$cyr1=$stud_yr;


?>
<input type='hidden' name='oexeamt' value='<?=$oexeamt?>'>
<input type='hidden' name='oldbalamt' value='<?=$oldbalamt?>'>
<?php
$sql2="select `price` from `spl_advances` where `acc_year`='$accyear' and `div`='$course' and `class`='$sem' ";
$sql3=execute($sql2);
if(rowcount($sql3)==0)
die('Fee declaration not done ');
$priceamt=fetchrow($sql3);
 $sql2="select `id` from `spl_advances_coll` where `acc_year`='$accyear' and `div`='$course' and `class`='$sem' and `student_id`='$stud_id' ";
$sql3=execute($sql2);
if(rowcount($sql3)!=0)
die('Advance already  collected ');
?>
<table border='1' width=50% align=center cellspacing='0' cellpadding='1' class='forumline'>
<tr><td colspan='4' align='center' class='head'>Fee Payment Details</td></tr>

<tr><td>&nbsp;&nbsp;Payment Date</td>
			<td><select name='pydt'>
			<?php
			if($pydt=='')
				$pydt=$cdt;
			for($i=1;$i<=31;$i++)
			{
				if($i<10)
					$i="0".$i;
				if($i==$pydt)
					echo "<option value=$i selected>$i</option>";
				else
					echo "<option value=$i>$i</option>";
			}
			?>
			</select><select name='pymt'>
			<?php
			if($pymt=='')
				$pymt=$cmt;
			for($i=1;$i<=12;$i++)
			{
				if($i<10)
					$i="0".$i;
				if($i==$pymt)
					echo "<option value=$i selected>" . MonthName($i) . "</option>";
				else
					echo "<option value=$i>" . MonthName($i) . "</option>";
			}
			?>
			</select><select name='pyyr'>
			<?php
			if($pyyr=='')
				$pyyr=$cyr;
			for($i=$cyr-1;$i<=$cyr+1;$i++)
			{
				if($i==$pyyr)
					echo "<option value=$i selected>$i</option>";
				else
					echo "<option value=$i>$i</option>";
			}
			?>
			</select></td>
<td align='center'>Payment Amount</td>
<td>


<input type="text" name="amount" value="<?php echo $priceamt[0]; ?>"></td></tr>
<tr><td align='center' valign="middle">Remarks </td><td colspan='3' align='center'><textarea name="comets" rows="3" cols="60"></textarea></td></tr>
</table>
<br>
<div align="center"><input type="submit" name="save" value="Update" class="bgbutton"></div>
</form>
</body>
</html>

<?php
function MonthName($mon)
{
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}
?>
</form>
</body>
</html>