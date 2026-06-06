<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='applyCharges.php';
	document.frm.submit();
	
}
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}	
</SCRIPT>
</HEAD>

<body>
<?php 
$charges_group_id=$_POST['charges_group_id'];
$charges=$_POST['charges'];
$tablename="charges_applied";
$sysdate=date("Y-m-d");
session_start();
require("../db.php");
if($_POST['open'])
{
		$temsql4=execute("select price from charges where id='$charges'");
		while($r1=fetcharray($temsql4))
		{
			 $price=$r1['price'];	
		}
		$temsq5=execute("select charge_name from charges where id='$charges'");
		while($r1=fetcharray($temsq5))
		{
			$charge_name=$r1['charge_name'];	
		}

		
		$sql5=execute("select count(student_id) from charges_student_group where charge_group_id='$charges_group_id' and status=1");
		while($r5=fetcharray($sql5))
		{
			$stcount=$r5[0];
		}
	$totalamount=$stcount*$price;
	
		$sql5=execute("select id from $tablename where charges_id='$charges' and group_id='$charges_group_id' ");
		if(rowcount($sql5)>0)
		{
			?>
			<SCRIPT LANGUAGE="JavaScript">
			alert("Charges already collected ");
			</SCRIPT>
			<?php
		}
		else
		{
			
			$sql1="insert into $tablename(charges_id, group_id, app_date, status) values('$charges', '$charges_group_id', '$sysdate', 1)";
			execute($sql1);	
			
				//********************charges collection starts ********************
				
				
				$ttlamt=$totalamount;
				
				$dddate1=$sysdate;
					$u1=execute("select * from ac_voucher where iIdx_vouchermaster=6");
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
				
				$ledgerid=execute("select iIdx_ledger from ac_ledger where vledger='$charge_name'");
				$ledgerid1=fetchrow($ledgerid);
				
$cashdetBal=execute("select fopbal from ac_ledger where iIdx_ledger=39");
				$traildetBal=execute("select fopbal from ac_ledger where iIdx_ledger='$ledgerid1[0]'");
				$cashdetBal1=fetchrow($cashdetBal);
				$traildetBal1=fetchrow($traildetBal);
				
				$newcashdetBal1=$cashdetBal1[0]+$ttlamt;
				$newtraildetBal1=$traildetBal1[0]-$ttlamt;
				$newRemarks=strtoupper($amt_str);
				
				
				execute("update ac_ledger set fopbal='$newcashdetBal1' where iIdx_ledger=39");
				execute("update ac_ledger set fopbal='$newtraildetBal1' where iIdx_ledger='$ledgerid1[0]'");
				
				execute("INSERT INTO ac_opbal (opdate, Vledger, fopbal, iId_grp, vins, Dr_Cr, iIdx_organization) VALUES
				('$dddate1', 'Student a/c', $newcashdetBal1, 24, 'Bangalore School', 'Dr', 1),
				('$dddate1', '$charge_name', $newtraildetBal1, 18, 'Bangalore School', 'Dr', 1)");
				
				execute("INSERT INTO ac_voucher ( iIdx_ledger, iIdx_vouchermaster, iIdx_institution, ddate, Dr_Cr, particulars, chequedd_no, chequedd_date, fdebit, fcredit, vvoucherno, vnarration, acc, iIdx_group, istatus, iIdx_organization, vbillno, dbilldate) VALUES
				(39, 6, 1, '$dddate1', 'Dr', 'By Student a/c', '', '0000-00-00', '$ttlamt', '0.00', '$n2', '$charge_name', 'Student a/c', 24, 0, 1, '$docid', '$dddate1'),
				('$ledgerid1[0]', 6, 1, '$dddate1', 'Cr', 'To $charge_name', '', '0000-00-00', '0.00', '$ttlamt', '$n2', '$charge_name', '$charge_name', 18, 0, 1, '$docid', '$dddate1')");
				
				
				//********************charges starts ********************

			?>
			<SCRIPT LANGUAGE="JavaScript">
			alert("Successfully Updated");
			</SCRIPT>
			<?php
		
		}		
	
}
	

?>		<form name="frm" action="" method="post" >
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Apply Charges</td>
    </tr>

  <tr>
    <td height="28">&nbsp;&nbsp;Charges</td><td>&nbsp;<select name='charges'  onChange="reload()">
  <?
$rs_section=execute("select * from charges");
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($charges==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[charge_name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[charge_name]</option>";

}
?>
  </select>
  </td>
  </tr>
 <tr>
  <td height="28">&nbsp;&nbsp;Group</td><td>&nbsp;<select name='charges_group_id'  onChange="reload()">
<?
$rs_section=execute("select * from charges_group");
echo "<option value=''>--Select--</option>";
for($i=0;$i<rowcount($rs_section);$i++)
{
	$r_section=fetcharray($rs_section,$i);
	if($charges_group_id==$r_section[id])
	echo "<option value='$r_section[id]' selected>$r_section[name]</option>";
	else
	echo "<option value='$r_section[id]'>$r_section[name]</option>";

}
?>
</select>
</td>
  </tr> 
</table>
<br>
<div align="center"><input type="submit" name="open" value="UPDATE" class="bgbutton" ></div><br>
</form>	
</body>
</html>