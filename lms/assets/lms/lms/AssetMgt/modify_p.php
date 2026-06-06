<html>
<head>
<script language="JavaScript">
function validate()
{
	if(document.frm.total_bill_amount.value=="" || document.frm.total_bill_amount.value <=0)
	{
		alert("Enter The  Valid Amount");
		document.frm.total_bill_amount.focus();
		return false;
}
else
	{
           document.frm.action="InsModifyPO.php";
	   document.frm.submit();
	}
}
function bn()
{
        var other=0;
	var total=0;
	var ta=0;
	var disp=0;
	var temp=0;
	other=parseInt(document.frm.add_charges.value);
	ta=parseInt(document.frm.tax.value);
	temp = parseInt(document.frm.total_bill_amount.value);
	if(temp=='' || isNaN(temp))
	{
	 	total=0;
	}
	else
	{
		total=parseInt(temp);
	}
        disp=other+ta+total;
	document.frm.total_bill_amount.value=disp;	
	
}
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function check(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode 
	if((charCode>=48 && charCode<=57)||(charCode>=96 && charCode<=105)||(charCode==8)||(charCode==9)||(charCode==45)||(charCode==46)||(charCode>=35 && charCode<=40))
	{
	  return true;
	}
	else
	{
	   alert("Please make sure entries are numbers only.");
	   document.frm.per.value="";
	   document.frm.add_charges.value="";
	   return false;
	}
}
</script>
</head>
<?php
session_start();
require("../db.php");
$ToDay=explode("-",date("d-m-Y"));
?>
<form name='frm' method='post' action='InsModifyPO.php'>
<?php
            $sql=execute("select * from purchaseordermaster where PONumber='".strtoupper($PONum)."' and status='Pending'");
              if(rowcount($sql)==0)
		{
			echo "<font color=red><b>Purchase Order Details Not Found !!</b></font>";
			die();
		}
		else
		{
			$rs=fetcharray($sql);
            $sql1=execute("select * from vendormaster_assets where id=$rs[vendor_id]") or die(error_description());
			$rs1=fetcharray($sql1);
			$p=$rs[PONumber];
			$t=date("d-m-Y",strtotime($rs[PODate]));
			echo "<center><b>$Caption</b></center><br>";
	echo "<table width='80%'>";
	echo "<tr><td align='center'><u><font size='2'>MODIFY PURCHASE ORDER</font></u></td></tr>";
	echo "<tr><td width='40%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size='3'>To,</font></td></tr>";
	echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$rs1[contact_person]</td></tr>";
	echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>$rs1[name]</b></td></tr>";
	echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$rs1[address]</td></tr>";
	echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone : $rs1[phone]  Fax : $rs1[fax]</td></tr>";
	echo "<tr><td><div align=right><font size='2'>Purchase Order No&nbsp;&nbsp;</font><input type='text' name='PONum' value='$p'></div></tr></td>";
        echo "<tr><td><div align=right><font size='2'>Date&nbsp;&nbsp;</font><input type='text' name='tt' value='$t'><br></div></tr></td>";
	echo "<tr><td><div align=right><font size='2'>Tan Number&nbsp;&nbsp;</font><input type='text' name='tan' value='$rs[tan_no]'></div></tr></td>";
        echo "<tr><td><div align=right><font size='2'>Tin Number&nbsp;&nbsp;</font><input type='text' name='tin' value='$rs[tin_no]'><br></div></tr></td>";
	echo "</table>";
	echo "<br>";
	echo "<div align=center>This is reference to your quotation dated $t and subsequent discussions<br>";
	echo "we are pleased to place an order as per our terms and conditions.</div><br>";
	$sql2=execute("select a.*,b.*,a.id as myid from purchaseorderdetails a,asset_master b where a.PO_ID=$rs[id] and a.asset_id=b.id");
	echo "<table border=1 align=center>";
	echo "<tr><td class=head colspan='6' align='center'><font face='Lucida Sans' size='2'>Item / Asset Details</font></td></tr>";
	echo "<tr><td><font face='Lucida Sans' size='1.8'>Select</font></td><td><font face='Lucida Sans' size='1.8'>Asset Name</font></td><td><font face='Lucida Sans' size='1.8'>Quantity</font></td><td><font face='Lucida Sans' size='1.8'>Unit Price</font></td><td><font face='Lucida Sans' size='1.8'>Total</font></td></tr>";
        

	                for($j=0;$j<rowcount($sql2);$j++)
			{
				$r2=fetcharray($sql2,$j);
				echo "<tr><td><input type=checkbox name=id[] value='$r2[myid]' checked></td>";
				echo "<td>$r2[asset_name]</td><td><input type=text size=10 name='quantity$r2[myid]' value=$r2[quantity] readonly></td>";
				echo "<td><input type=text size=20 name='unitprice$r2[myid]' value=$r2[unitprice] readonly></td>";
				echo "<td><input type=text size=20 name='totalprice$r2[myid]' value=$r2[totalprice] readonly></td></tr>";
			}
			
            		echo "<input type=hidden name=poid value=$rs[id]>";
			echo "<input type=hidden name=vendorid value=$rs[vendor_id]>";
			echo "<input type=hidden name='PersonName' value='$user'>";
			$t=$rs['tax_amt'];
			$a=$rs['additional_charges'];
			$pr=$rs['tax_per'];
			$addition=$rs['additional_charges']+$rs['tax_amt'];
			echo "<tr><td align=center colspan=5> <font face='Lucida Sans' size='2'>Additional Charges</font></td></tr>";
			echo "<tr><td align='right' colspan=5><font face='Lucida Sans' size='2'>Percentage</font></td><td><input type=text name='per' value='$pr' onkeydown='return check(event)'></div></td></tr>";	
		        echo "<tr><td align='right' colspan=5><font face='Lucida Sans' size='2'>Tax Amount</font></td><td><input type=text name='tax' value='$t' readonly></div></td></tr>";	
			echo "<tr><td align='right' colspan=5><font face='Lucida Sans' size='2'>Other Charges</font></td><td><input type=text name='add_charges' value='$a' onkeydown='return check(event)'></div></td></tr>";
			echo "<tr><td align='right' colspan=5><font face='Lucida Sans' size='2'>Total Amount</font></td><td><input type=text name='total_bill_amount' value=$rs[total_bill_amount] readonly></div></td></tr>";
			echo "</table>";
			echo "<br>";
		        echo "<center><b><u>TERMS & CONDITIONS</u></b></center>";
			echo "<br>";
			$l3=execute("select b.asset_name,a.quantity,a.unitprice,a.totalprice,c.conditions from purchaseorderdetails a,asset_master b,quotation c where a.PO_ID='$rs[id]' and a.asset_id=b.id and b.id=c.asset_id") or die("ffffffff");
			$ll=fetcharray($l3);

			$x=explode("#*",$ll["conditions"]);
			for($g=0;$g<15;$g++)
		      {
	                echo "$x[$g] <br>";
              }
			?>
			
		<?php 
            echo "<div align=center>";
	        echo "Thanking You, <br>";
	        echo "For International School, <br>";
	        echo "</div>";
	        echo "<br><br><br>";
	        echo "<div align=left>";
	        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recommended By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Approved By";
	        echo "</div>";
			echo "<div align=left>";
        	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='recomend' value='Director Administration'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='approve' value='Principal'>";
			echo "</div>";
			echo "<div align=center>";
        	echo "<tr><td align='center'><input type=button value='Modify PO' onClick='validate()' class='bgbutton'></td></tr>";
	  }
	
?>
</form>
</body>
</html>

