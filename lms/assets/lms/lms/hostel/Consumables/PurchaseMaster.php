<?php
session_start();
include("../../db.php");
$supplier = $_POST['supplier'];
$flag = $_POST['flag'];
$bill_num = $_POST['bill_num'];

$dd = $_POST['dd'];
$mm = $_POST['mm'];
$yy = $_POST['yy'];

$item = $_POST['item'];
$search = $_POST['search'];
$quantity = $_POST['quantity'];
$quantity_type = $_POST['quantity_type'];
$unitprice = $_POST['unitprice'];
$totalamt = $_POST['totalamt'];
$um = $_POST['um'];

$per = $_POST['per'];;
$tax = $_POST['tax'];
$total_amt = $_POST['total_amt'];
$comments = $_POST['comments'];

$additems = $_POST['additems'];
$SaveDetails = $_POST['SaveDetails'];

$mon = $_POST['$mon'];
$date4 = $_POST['date4'];
$date3 = $_POST['date3'];
if($flag=='')
{
	$flag=1;
}
$today=explode("-",date("d-m-Y"));
?>
<html>
<head>
<title>Consumables - Purchase Master</title>
<script language="javascript" src="../cal2.js"></script>
  <script language="javascript" src="../cal_conf2.js"></script>
<Script language="JavaScript">
function CalcTotal()
{
	var x;
	
	x=parseFloat(document.frm.unitprice.value)*parseFloat(document.frm.quantity.value);
	var y=x.toFixed(2);//to give precision 2i.e., 0.00
	document.frm.totalamt.value=y;//parseFloat(x);
	
}
function insert_records()
{
	document.frm.action="insert_purchase_master.php";
	document.frm.submit();
}
</Script>

<script language=javascript>
function dispvalue1()
{
var a1=document.frm.item.value;
var x1 = window.open("openitem.php?item="+a1,"user","width=500,height=500,scrollbars=yes,status=no,toolbar=no,menubar=no,sizeable=0,left=550,top=150");
}
var total = 0;

function addTotal(i,flag)
{
if(document.frm.total_amt.value!='')
{
 total = parseFloat(document.frm.total_amt.value);
}
document.frm.total_amt.value=0;
var tot= 0;
tot = parseFloat(eval("document.frm.totalprice" + i + ".value"));
if(flag)
{
total += parseFloat(tot);
temp_ref="document.frm.totalprice"+i;
temp_ref.value=3232;
}
else
{
total -= parseFloat(tot);
}
 document.frm.total_amt.value = parseFloat(total);
}

function dn()
{
	
	var th=0;
	var pa=0;
	var tv;
	var tot=0;
	var total;
	if(document.frm.per.value=='' || isNaN(document.frm.per.value))
	{
	  	pa=0;
	}
	else
	{
		pa=parseInt(document.frm.per.value);
	}
	if(document.frm.totalamt.value=='' || isNaN(document.frm.totalamt.value))
	{
	  	tv=0;
	}
	else
	{
		tv=parseInt(document.frm.totalamt.value);
	}
	if(document.frm.tax.value=='' || isNaN(document.frm.tax.value))
	{
		th=0;
	}
	else
	{
		th=parseInt(document.frm.tax.value);
	}
	
	ttt=(pa*tv)/100;
	document.frm.tax.value=ttt;

	if(ttt!='')
	{
		total = ttt + tv;
	}
	document.frm.total_amt.value=total;
	
}


function validate()
{
    if(document.frm.bill_num.value=="")
	{
		alert("Enter Bill no ");
		document.frm.bill_num.focus();
		return false;
	}
	if(document.frm.item.value=="")
	{
		alert("Enter Item Name ");
		document.frm.item.focus();
		return false;
	}
	if(document.frm.quantity.value=="")
	{
		alert("Enter the quantity ");
		document.frm.quantity.focus();
		return false;
	}
	if(document.frm.quantity_type.value =="")
	{
		alert("Enter the quantity type  ");
		document.frm.quantity_type.focus();
		return false;
	}
	if(document.frm.unitprice.value =="")
	{
		alert("Enter the unitprice!!!!!");
		document.frm.unitprice.focus();
		return false;
	}
		if(document.frm.totalamt .value =="")
	{
		alert("Enter the totalamount!!!!!");
		document.frm.totalamt .focus();
		return false;
	}
		else
	{
		return true;
	}
}
</script>

</head>
<body>
<?php
if(isset($additems))
{
	if(($quantity=='' && $quantity=='0') && ($unitprice=='' && $unitprice=='0'))
	{
		?>
			<SCRIPT LANGUAGE="JavaScript">
				alert("Please Enter Quantity and Unit Price");
			</SCRIPT>
		<?php
		print("<a href=PurchaseMaster.php></a>");
	}
	else
	{
		$flag=0;
		$query_itemid="select * from h_item_master where item_name='$item'";
		$result_itemid=execute($query_itemid);
		
		while($qid=fetcharray($result_itemid))
		{
			$itemsid=$qid[0];
		}
		$temp_det="select * from h_temp_cons_purchase_det where itemname_id='$itemsid'";
		$result_det=execute($temp_det);
		if(rowcount($result_det)==0)
		{
			$sql="insert into h_temp_cons_purchase_det(itemname_id,quantity,quantity_type,unit_price,amount) ";
			$sql.=" values('$itemsid','$quantity','$quantity_type','$unitprice','$totalamt')";
			execute($sql) or die(error_description());
		}
	}
}
if(isset($delete))
{
	$flag=0;
	if($id1)
	{
		while( list(,$Value) = each($id1) )
		{
			execute("delete from h_temp_cons_purchase_det where id_det=$Value");
		}
	}
}
?>
<form method="post" name="frm" onSubmit="return validate()">
<input type="hidden" name="flag" value="<?=$flag?>">
<?php
if($flag==1)
{$qr=execute("truncate h_temp_cons_purchase_det ");
}
?>
<table border=1 align='center' class="forumline" width="90%">
<tr><td Class="head" align='center' colspan='6'>PURCHASE MASTER</td></tr>
<tr>
		<td align="LEFT">&nbsp;Purchase Date</td>
		<td nowrap align="LEFT">
		<input type="text" readonly="" name="date3" value="<?php echo $date3?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar3')"><img src="../../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>  

<tr><td  align="LEFT" >&nbsp;Supplier</td>
<td align="LEFT" colspan='3' ><select name="supplier">
<?php
$sql=execute("select * from h_suplier_master order by name") or die(error_description());
for($i=0;$i<rowcount($sql);$i++)
{
	$r=fetcharray($sql,$i);
	if($r[id]==$supplier)
	{
		echo "<option value='$r[id]' selected>$r[name]</option>";
	}
	else
	{
		echo "<option value=$r[id]>$r[name]</option>";
	}
}
?>
</select></td></tr>
<tr><td  align="LEFT" >&nbsp;Bill Number</td>
<td  align="LEFT" colspan='3'><input type="text" name="bill_num" size="20" value=<?=$bill_num?>></td></tr>
<tr>
		<td align="LEFT">&nbsp;Bill Date</td>
		<td nowrap align="LEFT">
		<input type="text" readonly="" name="date4" value="<?php echo $date4?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar4')"><img src="../../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>  
</table>
<?php
$sql1=execute("select a.*,a.itemname_id as MyID,b.*,b.id as ItemId from h_temp_cons_purchase_det a,h_item_master b where b.id=a.itemname_id");
if(rowcount($sql1)>=1)
{
	echo "<tr><td colspan=2>";
	echo "<table border=1 align=center class='forumline' width='90%'>";
	echo "<tr><td colspan=7 Class='head' align=center>ITEM DETAILS</td></tr>";
	echo "<tr>";
	echo "<td Class='rowpic'>Select</td>";
	echo "<td Class='rowpic'>Item Name</td>";
	echo "<td Class='rowpic'>Quantity</td>";
	echo "<td Class='rowpic'>Quantity Type</td>";
	echo "<td Class='rowpic'>Unit Price</td>";
	echo "<td Class='rowpic'>Amount</td>";
	echo "</tr>";
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);
		echo "<tr>";
		echo "<td class='row2'><input type=checkbox name=id1[] value='$r1[MyID]' onclick='addTotal($r1[MyID],this.checked)'></td>";
		echo "<td class='row2'>$r1[item_name]</td>";
		echo "<td class='row2'><input type=text name='quantity$r1[MyID]' value='$r1[quantity]' size=5></td>";
		echo "<td class='row2'>$r1[quantity_type]</td>";
		$unitcost=number_format($r1[unit_price],2,".","");
		echo "<td class='row2'>$unitcost</td>";
		$totalamount=number_format($r1[amount],2,".","");
		echo "<td class='row2'><input type=text name='totalprice$r1[MyID]' value='$r1[amount]' size=10></td>";
		echo "</tr>";
	}
	echo "<tr>";
	echo "<td class='row2' align=center colspan=7>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</td></tr>";
}
?>
</table>
<table border='1' align='center' class='forumline' width='90%'>
<tr><td Class='rowpic'>Item Name</td><td Class='rowpic'>Search</td>
<td Class='rowpic'>Quantity</td><td Class='rowpic'>Quantity Type</td>
<td Class='rowpic'>Unit Price</td><td Class='rowpic'>Total Amount</td></tr>

<?php
echo "$c";
?>
<?php
echo "<td align='center'><input type='text' name='item' id='item' size='10' readonly></td>";
echo "<td align='center'><input type='button' value='search' name='search' id='search' onClick='javascript:dispvalue1();'></td>";
echo "<td align='center'><input type='text' name='quantity' id='quantity' size='10'></td>";
echo "<td align='center'><input type='text' name='quantity_type' id='quantity_type' size=15></td>";
echo "<td align='center'><input type='text' name='unitprice' id='unitprice' size='10' onBlur='CalcTotal()'></td>";
echo "<td align='center'><input type='text' name='totalamt' id='totalamt' size='10'></td></tr><input type='hidden' name='um' value='$um'> </table>";

echo "<table border='1' align='center' width='90%' class='forumline'>";
echo "<tr><td class='row2' colspan='6' >";
echo "<tr><td class='row2' colspan='6' align='center'><input class='bgbutton' type='submit' name='additems' value='Add' ></td></tr>";
echo "<tr><td  align='center' colspan='3'>Enter Tax Percentage</td>";
echo "<td  colspan='3'><input type='text' name='per' value='0' size='20'  onblur='dn()'></td></tr>";
echo "<tr><td  align='center' colspan='3'>Tax</td>";
echo "<td  colspan='3'><input type='text' name='tax' size='20' value='$tax' readonly></td></tr>";
echo "<tr><td  align='center' colspan='3'>Total Amount</td>";
echo "<td  colspan='3'><input type='text' name='total_amt' size='20' value=$total_amt></td></tr>";
echo "<tr><td  align='center' colspan='3'>Comments</td>";
echo "<td  colspan='3'>";
echo "<textarea id=textarea1  name='comments' tabindex=7 rows=3 cols=18 MAXLENGTH=250 scrollbars=no>$comments</textarea></td></tr>";
echo "<table border=1 align=center class='forumline' width='90%'>";
if(isset($additems))
{

	echo "<tr><td class='row2' colspan='6' align='center' ><input type='button' align='center' class='bgbutton' name='SaveDetails' value='Save Purchase Details' onClick='insert_records()'></td></tr></table>";
}
?>
</table>
</form>
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
</body>
</html>