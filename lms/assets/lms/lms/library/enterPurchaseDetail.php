<?php
require_once("../db.php");
$order=$_POST['order'];
$bill_no = $_POST['bill_no'];
$dd = $_POST['dd'];
$mm = $_POST['mm'];
$yy = $_POST['yy'];
$library = $_POST['library'];
$vendor = $_POST['vendor'];
$tid = $_POST['tid'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$title = $_POST['title'];
$copies = $_POST['copies'];
$unit = $_POST['unit'];
$pending = $_POST['pending'];
$received = $_POST['received'];
$paytype = $_POST['paytype'];
$submit1 = $_POST['submit1'];
?>
<html>
<head>
<script language="javascript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function checkIt(e,flag)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT )
	{
		if((charCode == 46) || (charCode >= 65456 && charCode <= 65465) || (charCode >= 96 && charCode <= 105))
		{
			return true
		}
		else
		{
			if(flag==1)
			{
				if((charCode !=190) && (charCode !=110))
				{
					alert("Please make sure entries are numbers only.")
					return false
				}
				else
				{
					return true
				}
			}
			else
			{
					alert("Please make sure entries are numbers only.")
					return false
			}
		}
	}
	return true
}
function frm_submit()
{
	if(document.frm.bill_no.value =='')
	{
		alert("Enter Bill No.");
		document.frm.bill_no.focus();
	}
	else if((document.frm.dd.value =='')||(document.frm.mm.value =='')||(document.frm.yy.value ==''))
	{
		alert("Enter Valid Date");
		document.frm.dd.focus();
	}
	else
	{
		document.frm.action='storePurchaseDetail.php';
		document.frm.submit();
	}
}
function frm_validation(this_text,pending)
{
	received=this_text.value;
	if(received > pending)
	{
		alert ("You can't Receive more than what you ordered.Balance Copy is ="+pending);
		this_text.value=pending;
		this_text.focus();
	}
}
</script>
</head>
<body>
<?
echo "<form name='frm' method='post'>";
echo "<table class=forumline align=center width='47%'>";
	echo "<tr><td class='head' align='center' colspan=3>Receive Purchased</td></tr>";
	echo "<tr><td align='right'>Purchase Order No.&nbsp;&nbsp;&nbsp;";
	echo "<td><select name=order onChange=\"javascript:document.forms[0].submit()\">";
	echo "<option value=''> Select Order No </option>";
	$rs=execute("select distinct(a.id),order_date,order_no from lib_order_m a,lib_order_det b where b.order_id=a.id and b.copies <> b.received_copies");
	for($i=0;$i<rowcount($rs);$i++)
		{
			$r=fetcharray($rs,$i);
			if($r[id]==$order)
			$sel="selected";
			else
			$sel="";
			printf("<option value=$r[id] $sel>PO.No.%02d - ($r[order_date]) </option>",$r[order_no]);
		}
	echo "</select></td>";
	echo "</tr>";
echo "</table>";
echo"<br>";
if($order <> '')
{
	$qry="select * from lib_order_m where id=$order";
	$rs=execute($qry);
	$row=fetcharray($rs);
	echo "<table border=1 colspan='4' class=forumline align=center>";
		echo "<tr>";
			echo "<td><font color='blue'>Bill No.</font></td>";
			echo "<td><input type=text name='bill_no' size=10 maxlength=50></td>";
			echo "<td><font color='blue'>Received Date</font></td>";
			echo "<td>";
			$to_day=getdate();
			$dd=$to_day[mday];
			$mm=$to_day[mon];
			$yy=$to_day[year];
			echo "<input type=text name=dd value='$dd' size=2 maxlength=2 onKeydown='return checkIt(event,0)'>";
			echo "<input type=text name=mm value='$mm' size=2 maxlength=2 onKeydown='return checkIt(event,0)'>";
			echo "<input type=text name=yy value='$yy' size=4 maxlength=4 onKeydown='return checkIt(event,0)'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td colspan='2'><font color='blue'>Library</font></td>";
			echo "<td colspan='2'>";
			$rs1=execute("select * from library_name where id=$row[library]");
			$librow=fetcharray($rs1);
			//echo "<input type=hidden name=library value=$row[library]>$librow[name]</td>";
			echo "<input type=hidden name=library value='1'>$librow[name]</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td><font color='blue'>Vendor Name</font></td>";
			echo "<td>";
			$rs1=execute("select * from lib_vendor_m where id=$row[vendor_id]");
			$venrow=fetcharray($rs1);
			echo "<input type=hidden name=vendor value=$row[vendor_id]>$venrow[Name]</td>";
			echo "<td><font color='blue'>Address :</font></td>";
			echo "<td>$venrow[address]</td>";
		echo "</tr>";
	echo "</table>";
	echo"<br>";
	echo "<table border=1 class=forumline align=center>";
		echo "<tr>";
			echo "<td class='head'>Select</td>";
			echo "<td class='head'>Author</td>";
			echo "<td class='head'>Publisher</td>";
			echo "<td class='head'>Title</td>";
			echo "<td class='head'>Copies Ordered</td>";
			echo "<td class='head'>Unit Price</td>";
			echo "<td class='head'>Copy Received</td>";
	    echo "</tr>";
	    $qry="select * from lib_order_det where order_id=$order and copies <> received_copies";
	    $transrs=execute($qry);
	    while($transrow=fetcharray($transrs))
			{
				echo "<tr>";
					echo "<td><input type=checkbox name=tid[] value=$transrow[id]></td>";
					echo "<td><input type=hidden name=author$transrow[id] value='$transrow[author]'>$transrow[author]</td>";
					echo "<td><input type=hidden name=publisher$transrow[id] value='$transrow[publisher]'>$transrow[publisher]</td>";
					echo "<td><input type=hidden name=title$transrow[id] value='$transrow[title]'>$transrow[title]</td>";
					echo "<td align='right'><input type=hidden name=copies$transrow[id] value='$transrow[copies]' size=4 onKeydown='return checkIt(event,0)'>$transrow[copies]</td>";
					echo "<td align='right'><input type=hidden name=unit$transrow[id] size=6 value='$transrow[apprate]'>";
					echo number_format($transrow[apprate],2,'.','');
					echo "</td>";
					echo "<td>";
					$pending=$transrow[copies]-$transrow[received_copies];
					echo "<input type=hidden name=pending$transrow[id] value='$pending'>";
					echo "<input type=text name=received$transrow[id] value=$pending size=10 onKeydown='return checkIt(event,1)' onBlur='frm_validation(this.form.received$transrow[id],$pending)'>";
					echo "</td>";
				echo "</tr>";
	}
	?>
    <tr>
		<td colspan=7 align='center'>Payment Type<select size="1" name="paytype">
		<option value="Cash" selected>Cash</option>
		<option value="DD">DD</option>
		<option value="Cheque">Cheque</option>
		</select></td>
	</tr>	
</table>
<p align='center'><input type=button name=submit1 value='Generate' onClick='frm_submit()' class=bgbutton></p>
<?php
}
echo "</form>";
?>
</body>
</html>