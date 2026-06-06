<?php
session_start();
include("../db.php");
$addyear=$_REQUEST['addyear'];
$adate=$_REQUEST['adate'];
$bdate=$_REQUEST['bdate'];
$eur=$_REQUEST['eur'];
$usd=$_REQUEST['usd'];
$rmk1=$_REQUEST['rmk1'];
$rmk2=$_REQUEST['rmk2'];
$rmk3=$_REQUEST['rmk3'];

$d1=explode('/',$adate);
$date1="$d1[2]-$d1[1]-$d1[0]";

$d2=explode('/',$bdate);
$date2="$d2[2]-$d2[1]-$d2[0]";

if($_POST['save'])
{
	
	//INSERT INTO `fee_invoice_settings` ( `invoicedate`, `duedate`, `eur`, `usd`, `remark1`, `remark2`, `remark3`, `accyear`, `status`) VALUES ( '2013-03-19', '2013-03-29', '65.9999', '45.666', 'rrrrrrrrrrrr', 'tttttttttttttttttt', 'yyyyyyyyyyyyyyyyyyyy', '2012', '1');
	$sql2=execute("select * from  `fee_invoice_settings` where `accyear`='$addyear'");
	if(rowcount($sql2)>=1)
	{
		$sql44="update `fee_invoice_settings` set `invoicedate`='$date1', `duedate`='$date2', `eur`='$eur', `usd`='$usd', `remark1`='{$rmk1}', `remark2`='{$rmk2}', `remark3`='{$rmk3}'  where accyear='$addyear'";

	}
	else
	{
		
		$sql44="INSERT INTO `fee_invoice_settings` ( `invoicedate`, `duedate`, `eur`, `usd`, `remark1`, `remark2`, `remark3`, `accyear`, `status`) VALUES ( '$date1', '$date2', '$eur', '$usd', '{$rmk1}', '{$rmk2}', '{$rmk3}', '$addyear', '1')";
	}
		execute($sql44);
		?>
		<script type="text/javascript">
		alert("Updated Successfully");
		//window.opener.location.reload();
		//window.close();
		</script>
		<?php	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MySchool</title>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>

</head>

<body>
<?php
//`invoicedate`, `duedate`, `eur`, `usd`, `remark1`, `remark2`, `remark3`, `accyear`
	$sql2=execute("select * from  `fee_invoice_settings` where `accyear`='$addyear'");
	while($r=fetcharray($sql2))
	{
		$date1=$r['invoicedate'];
		$date2=$r['duedate'];
		$eur=$r['eur'];
		$usd=$r['usd'];
		$rmk1=$r['remark1'];
		$rmk2=$r['remark2'];
		$rmk3=$r['remark3'];
		
		$d3=explode('-',$date1);
		$adate="$d3[2]/$d3[1]/$d3[0]";
		
		$d4=explode('-',$date2);
		$bdate="$d4[2]/$d4[1]/$d4[0]";
		
	}
?>
<FORM NAME='frm' METHOD='POST' ><br>
<input type="hidden" name="addyear" value="<?=$addyear?>" />
<table width="80%" border="1" cellspacing="2" align="center" cellpadding="0">
<tr>
    <td colspan="2" align="center" class="head">Invoice Settings</td>
  </tr>  <tr>
    <td width="" nowrap="nowrap">&nbsp;Invoice Date </td>
    <td width="">&nbsp;<input type='text' name='adate' value='<?=$adate?>' size="10"  readonly >
                        <a href="javascript:showCal('Calendar1')"><img src='../images/calendar.jpg' align='absmiddle' ></a></td>
  </tr>
  <tr>
    <td nowrap="nowrap">&nbsp;Due Date</td>
    <td>&nbsp;<input type='text' name='bdate' value='<?=$bdate?>' size="10"  readonly >
                        <a href="javascript:showCal('Calendar2')"><img src='../images/calendar.jpg' align='absmiddle' ></a></td>
  </tr>
  <tr>
    <td>&nbsp;EUR</td>
    <td>&nbsp;<input type="text" name="eur" value="<?=$eur?>" size="10" /></td>
  </tr>
  <tr>
    <td>&nbsp;USD</td>
    <td>&nbsp;<input type="text" name="usd" value="<?=$usd?>" size="10" /></td>
  </tr>
  <tr>
    <td>&nbsp;Remarks 1</td>
    <td>&nbsp;<textarea name="rmk1" cols="60" rows="2"><?=$rmk1?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;Remarks 1</td>
    <td>&nbsp;<textarea name="rmk2" cols="60" rows="2"><?=$rmk2?></textarea></td>
  </tr><tr>
    <td>&nbsp;Remarks 1</td>
    <td>&nbsp;<textarea name="rmk3" cols="60" rows="2"><?=$rmk3?></textarea></td>
  </tr>
</table>
<br>
<div align="center">
	<input type="submit" name="save" value="  Update  " class="bgbutton" />
</div>
</FORM>
</body>
</html>