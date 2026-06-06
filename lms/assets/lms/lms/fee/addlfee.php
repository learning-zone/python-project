<?php
session_start();
include("../db.php");
$adate=$_POST['adate'];
$currency=$_POST['currency'];
$rate=$_POST['rate'];
$bnkchargers=$_POST['bnkchargers'];
$remarks=$_POST['remarks'];
$d=explode('/',$adate);
$date1="$d[2]-$d[1]-$d[0]";
if($_POST['rate'])
{
	$sql1=fetchrow(execute("select id from `fee_m_conversion_rate` where `c_date`='$date1' and `currency`='$currency'"));
	if($sql1[0])
	{
		$sql="update `fee_m_conversion_rate` set `conversion_rate`='$rate', `bankCharges`='$bnkchargers', `remarks`='".addslashes($remarks)."' where id='$sql1[0]'";
	}
	else
	{
		$sql="INSERT INTO `fee_m_conversion_rate` (`c_date`, `native_currency`, `currency`, `conversion_rate`, `bankCharges`, `remarks`, `status`) VALUES ('$date1', '1', '$currency', '$rate', '$bnkchargers', '".addslashes($remarks)."', '1');";
	}
	execute($sql);
		?>
    <script language="javascript">
	alert("Updated successfully ");
    </script>
    <?php	
}
?>
<html>
<head>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>

<script LANGUAGE="JavaScript">
function frm_reload()
{
	document.frm.action='addlfee.php';
	document.frm.submit();
} 
</script>
</head>
<body>
<form method='POST' action="" name="frm" >
<br>
<table width="90%" border="1" align="center" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" align="center" class="head">Conversion Rates</td>
  </tr>
  <tr>
    <td class="head" align="center">Date</td>
    <td class="head" align="center">Currency</td>
    <td class="head" align="center">Conversion Rate</td>
    <td class="head" align="center">Bank Charges</td>
    <td class="head" align="center">Remarks</td>
  </tr>
  <tr>
  <?php
  $adate=date("d/m/Y");
  ?>  <td align="center"><input type='text' name='adate' value='<?=$adate?>' size="10"  readonly >
                        <a href="javascript:showCal('Calendar1')"><img src='../images/calendar.jpg' align='absmiddle' ></a></td>
    <td  align="center">
    <?php
	$nativecur=fetchrow(execute("SELECT `description` FROM `fee_m_currency_code` where `id`=1"));
	echo $nativecur[0]." to ";
	?>
    <select name="currency" OnChange=go()>
			<?php
            $qqq=execute("select id, description  from fee_m_currency_code where status=1 and id!=1");
            for($i=0;$i<rowcount($qqq);$i++)
            {
				$myq=fetcharray($qqq);
				if($currency==$myq[id])
				{
					?>
					<option value="<?=$myq[id]?>" selected><?=$myq[description]?></option>
					<?php
				}
				else
				{
					?>
					<option value="<?=$myq[id]?>"><?=$myq[description]?></option>
					<?php
				}
            }
            ?>
            </select>
    
    </td>
    <td align="center"><input type="text" name="rate" value=""></td>
    <td align="center"><input type="text" name="bnkchargers" value=""></td>
    <td align="center"><textarea name="remarks"></textarea></td>
  </tr>
</table>
<br>
    <div align='center'>
        <input type="button" class='bgbutton' value="Submit" name="studdet" OnClick="frm_reload()">
    </div>
    <br>
    
<table width="90%" border="1" align="center" cellspacing="0" cellpadding="0">
  <tr>
    <td class="head" align="center">SlNo</td>
    <td class="head" align="center">Date</td>
    <td class="head" align="center">Currency</td>
    <td class="head" align="center">Conversion Rate</td>
    <td class="head" align="center">Bank Charges</td>
    <td class="head" align="center">Remarks</td>
  </tr>
  <?php
  $sql1=execute("select * from `fee_m_conversion_rate` where status=1");
  while($r=fetcharray($sql1))
  {
	  ?>
	 <tr>
		<td  align="center"><?=$i?></td>
		<td  align="center"><?=$r[1]?></td>
		<td  align="center"><?php
        $foricur=fetchrow(execute("SELECT `description` FROM `fee_m_currency_code` where `id`=$r[3]"));
	echo $nativecur[0]." to ".$foricur[0];
		
		?></td>
		<td  align="center"><?=$r[4]?></td>
		<td  align="center"><?=$r[5]?></td>
		<td  align="center"><?=$r[6]?></td>
	  </tr>
<?php
  }
  ?>
 </table>   
</form>
</body>
</html>