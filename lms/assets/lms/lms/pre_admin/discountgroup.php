<HTML>
<head>
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
  <script language="javascript">
	function OpenWind2(k2)
	{
	
		var finalVar ;
	
		finalVar=k2 ;
	
		window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
	
	}
  </script>
</HEAD>
<?php
	session_start();
	include("../db.php");

	$admistion_type=$_POST['admistion_type'];
	$discount=$_POST['discount'];	
	$currency=$_POST['currency'];
	$feet=$_POST['feet'];
	
if($_POST['save'])
{
	for($i=0;$i<sizeof($feet);$i++)
	{
		$id=$feet[$i];
		$feeamt=$_POST['feeamt'.$id];
		$feetype=$_POST['feetype'.$id];
		if($feeamt)
		{
			$fee1=execute("select discountAmt from  fee_discount_det where admissionType='$admistion_type' and disscountType='$discount' and feeHead='$id' and status='1' ");
			if(rowcount($fee1)>0)
			{
				$sql1="update `fee_discount_det` set `discountAmt`='$feeamt', `curType`='$feetype' where admissionType='$admistion_type' and disscountType='$discount' and feeHead='$id' and status='1' ";
			}
			else
			{
				$sql1="INSERT INTO `fee_discount_det` (`admissionType`, `currencyType`, `disscountType`, `feeHead`, `discountAmt`, `curType`,`status`) VALUES ('$admistion_type','$currency', '$discount', '$id','$feeamt','$feetype', '1')";
			
			}			
			execute($sql1);				
		}
	}


	?>
    <script language="javascript">
	alert("Updated successfully ");
    </script>
    <?php	
}
?>
    
<SCRIPT LANGUAGE="JavaScript">
function go()
{
	document.frm.action="discountgroup.php";
	document.frm.submit();
}
function calcal(i,k1)
{
	var installment=parseInt(document.getElementById("installment").value);
	var k=1;
	var total=0;
	var tot1=0;
	var newval=0;
	var newva2=0;	
	for(k=1;k<=installment;k++)
	{
		tot1=parseInt(document.getElementById("fee_"+i+"_"+k).value);
		newval=parseInt(document.getElementById("feetotal"+k).value);
		if(isNaN(tot1))
		{
			tot1=0;
			document.getElementById("fee_"+i+"_"+k).value=0;
		}
		newva2=newval+tot1;
		total=total+tot1;

		newva2=0;
		tot1=0;
	}
	//feetotal
	document.getElementById("total"+i).value=total;

	var levar=document.frm.elements['feeid[]'].length;
	var myControls = document.frm.elements['feeid[]'];
	var gtotal=0;
	var ggtotal=0;

	for(var m=0;m<levar;m++)
	{
		var newval1=myControls[m].value
		tot1=parseInt(document.getElementById("fee_"+newval1+"_"+k1).value);
		gtotal=gtotal+tot1;
		tot1=parseInt(document.getElementById("total"+newval1).value);
		ggtotal=ggtotal+tot1;
	}
	document.getElementById("feetotal"+k1).value=gtotal;
	document.getElementById("totalm").value=ggtotal;
}

</SCRIPT>
<BODY>
	<FORM NAME='frm' METHOD='POST' ><br>
	<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
    <tr>
        <td align='center' colspan="2" class="head" nowrap>Discount Master</td>
    </tr>
   		<tr>
		 <td nowrap>&nbsp;&nbsp;Admission Category</td>
            <td align="left">&nbsp;&nbsp;<select name="admistion_type" OnChange=go()>
			<?php
            $qq="select id,name from admission";
            $qqq=execute($qq);
            for($i=0;$i<rowcount($qqq);$i++)
            {
				$myq=fetcharray($qqq);
				if($admistion_type==$myq[id])
				{
					?>
					<option value="<?=$myq[id]?>" selected><?php echo $myq[name] ?></option>
					<?php
				}
				else
				{
					?>
					<option value="<?php echo $myq[id] ?>"> 
					<?=$myq[name]?>
					</option>
					<?php
				}
            }
            ?>
            </select> </td>
	</tr>

    	<tr>
		 <td nowrap>&nbsp;&nbsp;Currency Type</td>
            <td align="left">&nbsp;&nbsp;<select name="currency" OnChange='go()' <?=$selectval?>>
			<?php
            $qqq=execute("select id, description  from fee_m_currency_code where status=1");
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
            </select> </td>
	</tr>
    <tr>

<td>&nbsp;&nbsp;Discount Type</td><td>&nbsp;&nbsp;<select name="discount" onChange="go()">

	<option value="0">Select  </option>

<?php

	$sql3=execute("SELECT id, name FROM `fee_discount_head` where status=1");

	for($j=0;$j<rowcount($sql3);$j++)
	{

		$r3=fetcharray($sql3,$j);

		if($r3[0]==$discount)
		{

			echo "<option value=$r3[0] selected>$r3[1]</option>";

		}
		else
		{

			echo "<option value=$r3[0]>$r3[1]</option>";

		}

	}

?>

</select>&nbsp;&nbsp;

<a href= "javascript:OpenWind2('discount_head.php?subject')"><input type="button" align="center" class="bgbutton" value="Add"></a> 		

</td> 

</tr>
    
</table>
    
<table class='forumline' align='center' width="70%" border="1" cellspacing="0" cellpadding="0">
    <tr>
        <td align='center' class="head" nowrap>Sl No.</td>
        <td align='center' class="head" nowrap>Fee Head</td>
        <td align='center' class="head" nowrap>Discount Amount</td>
    </tr>
<?php
$i=1;
$currencydes=fetchrow(execute("select code from fee_m_currency_code where id='$currency'"));

$sql441= execute("SELECT fee_id, fee_name FROM fee_type WHERE status=1 ORDER BY fee_id");
while($r=fetcharray($sql441))
{
	$fee5=fetchrow(execute("select discountAmt,curType from  fee_discount_det where admissionType='$admistion_type' and disscountType='$discount' and feeHead='$r[0]' and status='1' "));
	if($fee5[1]==2)
	{
		$check2='checked';
		$check1='';
	}
	else
	{
		$check1='checked';
		$check2='';
	}
	?>
    <tr><input type="hidden" name="feet[]" value="<?=$r[0]?>">
        <td align='center'  nowrap><?=$i?></td>
        <td nowrap>&nbsp;&nbsp;<?=$r[1]?></td>
        <td nowrap align="center">&nbsp;&nbsp;<input type="text" name="feeamt<?=$r[0]?>" value="<?=$fee5[0]?>">&nbsp;&nbsp;
        %<input type="radio"name="feetype<?=$r[0]?>" value="1" <?=$check1?>>&nbsp;OR&nbsp;<?=$currencydes[0]?>
        <input type="radio"name="feetype<?=$r[0]?>" value="2" <?=$check2?>>&nbsp;&nbsp;</td>
    </tr>
	<?php
	$i++;
}
?>
</table>
	  <br>
	  <div align="center">
		<input type="submit" name="save" value="UPDATE" class="bgbutton">
	  </div>
	
</FORM>
</BODY>
</HTML>