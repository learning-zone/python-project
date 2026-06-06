<?php
session_start();
include("../../db.php");
$dept = $_POST['dept'];
$IssuedBy = $_POST['IssuedBy'];
$item = $_POST['item'];
$stock_hand = $_POST['stock_hand'];
$quantity_type = $_POST['quantity_type'];
$issued_quantity = $_POST['issued_quantity'];
$issued_to = $_POST['issued_to'];
$additems = $_POST['additems'];
$comments = $_POST['comments'];
$date3 = $_POST['date3'];
include("../../functions_util.php");
//$college_list=get_colleges();
if($flag=='')
{
	$flag=1;
}
//echo "hello";
//echo $user;
$today=explode("-",date("d-m-Y"));
$sql=execute("select * from users where username='$user'") or die(error_description());
$usn=fetcharray($sql);
?>

<html>
<head><title>Consumables - Issue Master</title>
<script language="javascript" src="../cal2.js"></script>
  <script language="javascript" src="../cal_conf2.js"></script>
<Script language="JavaScript">
function CalcTotal()
{
	document.frm.totalamt.value=parseInt(document.frm.unitprice.value)*parseInt(document.frm.quantity.value);
}
function insert_records()
{
	document.frm.action="insert_issue_master.php";
	document.frm.submit();
}
function RefreshMe(val)
{
	document.frm.flag.value=val;
	document.frm.action="IssueMaster.php";
	document.frm.submit();
}
function validate()
{
	x=parseInt(document.frm.ExistingQuantity.value);
	y=parseInt(document.frm.quantity.value);
	if(x==0)
	{
		alert("Cannot Add Since Existing Quantity is Nil");
		return false;
	}
	else if(y==0)
	{
		alert("Entered Quantity is zero");
		document.frm.quantity.focus();
		return false;
	}
	else if(y<0)
	{
		alert("Entered Quantity is negative");
		document.frm.quantity.focus();
		return false;
	}
	else if(y>x)
	{
		alert("Issue Qty cannot be more than Existing Qty");
		document.frm.quantity.focus();
		return false;
	}
	else
	{
		document.frm.submit();
		return true;
	}
}
</Script>
<script language=javascript>
function check()
{
	if((document.frm.issued_quantity.value) > (document.frm.stock_hand.value))
	{
		alert("you cannnot issue more than the stock in hand");
		return false;
	}
}
</script>
<script language=javascript>
function dispvalue1()
{
var a1=document.frm.item.value;
var x1= window.open("open_item1.php?item="+a1,"width=500,height=500,scrollbars=yes,status=no,toolbar=no,menubar=no,sizeable=0,left=550,top=150");

}
</script>
</head>
<body>
<?php
if(isset($additems))
{
	if($issued_quantity=='')
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		alert("Please Select an Item and Enter the Quantity");
		</SCRIPT>
		<?
		print("<a href=IssueMaster.php></a>");
	}
	else
	{
		$flag=0;
		$query_itemid="select * from h_item_master where item_name like '$item%'";
		$result_itemid=execute($query_itemid);
		while($qid=fetcharray($result_itemid))
		{
			$itemsid=$qid[0];
		}
		$temp_det="select * from h_temp_issue_consumable where itemname_id='$itemsid'";
		$result_det=execute($temp_det);
		if(rowcount($result_det)==0)
		{
		$sql="insert into h_temp_issue_consumable values('','$itemsid','$issued_quantity','$issued_to') ";
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
			execute("delete from h_item_issue_details_temp where id=$Value");
		}
	}
}
?>
<form method="post" name="frm" onSubmit="return validate()">
<input type="hidden" name="flag" value="<?=$flag?>">
<?php
if($flag==1)
{
	execute("delete from h_temp_issue_consumable");
}
?>
<table border=1 align=center class="forumline" colspan="6" width="90%">
<tr><td Class="head" align=center colspan=6>ISSUE MASTER</td></tr>
<!-- <tr><td Class="rowpic" align="center" colspan="3">Select College</td>
<TD><select  size="1" name="college" id="college" tabindex="14"  WIDTH="281px" >
<?
   $rem=execute("select * from college");
	for($i=0;$i<rowcount($rem);$i++)
	{
	 $re=fetcharray($rem);
	
	if($re[col_id]==$college)
	{
		echo "<option value='$re[col_id]' selected>$re[col_name]</option>";
	}
	else
	{
		echo "<option value='$re[col_id]'>$re[col_name]</option>";
	}
  }
?>
</SELECT></TD></tr> -->
<tr><td class=rowpic align="left" colspan="3">Department</td><td class=row2><select name="dept">
<?php
$sql=execute("select * from dept_no where Dept<>'Central Stores'") or die(error_description());

for($i=0;$i<rowcount($sql);$i++)
{
	$r=fetcharray($sql,$i);
	if($r[dpt_id]==$dept)
	{
		echo "<option value=$r[dpt_id] selected>$r[Dept]</option>";
	}
	else
	{
		echo "<option value=$r[dpt_id]>$r[Dept]</option>";
	}
}
?>
</select></td></tr>

<tr><td class=rowpic colspan="3"><b>Issued Date</b></td>
<td nowrap align="LEFT">
		<input type="text" readonly="" name="date3" value="<?php echo $date3?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar3')"><img src="../../images/calendar.jpg" align="absmiddle" ></a>
        </td>
				</tr>

<tr><td class='rowpic' colspan="3">Issued By</td><td class='row2' colspan="3"><?=$usn[username]?></td>
<input type='hidden' name="IssuedBy" value='<?=$usn[username]?>'></tr>
</table>
<?php
$sql1=execute("select a.*,a.itemname_id as MyID,b.*,b.id as ItemId from h_temp_issue_consumable a,h_item_master b where a.itemname_id=b.id");
if(rowcount($sql1)>=1)
{
	echo "<tr><td colspan=2><b>";
	echo "<table border=1 align=center class=forumline width='90%'>";
	echo "<tr><td colspan=7 Class=head align=center>ITEM DETAILS</td></tr>";
	echo "<tr>";
	echo "<td Class=rowpic>Select</td>";
	echo "<td Class=rowpic>Item Name</td>";
	echo "<td Class=rowpic>Quantity</td>";
	echo "</tr>";
	for($j=0;$j<rowcount($sql1);$j++)
	{
		$r1=fetcharray($sql1,$j);
		echo "<tr>";
		echo "<td ><input type=checkbox name=id1[] value='$r1[MyID]'></td>";
		echo "<td >$r1[item_name]</td>";
		echo "<td >$r1[issued_qty]</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</td></tr>";
}
?>
</table>
</td></tr>
</table>

<table border='1' align='center' class='forumline' colspan='6' width='90%'>
<tr>
<td Class='rowpic'>Item Name</td>
<td Class='rowpic'>Search</td>
<td Class='rowpic'>Stock On Hand</td>
<td Class='rowpic'>Quantity Type</td>
<td Class='rowpic'>Issued Quantity</td>
<td Class='rowpic'>Issued to</td>
</tr>


<td align="center"><input type=text name='item'></td>
<td align="center"><input type='button' value='search' name='search' id='search' onClick='javascript:dispvalue1();'></td>
<td align="center"><input type='text' name='stock_hand'></td>
<td align="center"><input type='text' name='quantity_type'></td>
<td align="center" ><input type='text' name='issued_quantity' onblur='check()'></td>
<td align="center"><input type='text' name='issued_to'><input type='hidden' name='um' value='$um'>
</tr>
</table>
<br>
<center><input type='submit' class='bgbutton'  name='additems' value='Add'>
</center>

<?php
if(isset($additems))
{
?>
<table border='0' align='center' class='forumline' width='90%'>
<tr>
<td class='rowpic' colspan='3'>Comments</td>
<td class='row2' ><textarea id='textarea'1  name='comments' tabindex='7' rows='3' cols='18' MAXLENGTH='250' scrollbars='no'></textarea></td>
</tr>
<tr>
</table>
<br>
<center><input type='button' class='bgbutton' name='SaveDetails' value='Save Issue Details' onClick='insert_records()'>
</center>
<?php
}
?>
</table></form>
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
