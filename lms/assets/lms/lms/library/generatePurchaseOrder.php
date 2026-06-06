<?php
require_once("../db.php");
$quotation=$_REQUEST['quotation'];
$order=$_POST['order'];
$dd=$_POST['dd'];
$mm=$_POST['mm'];
$yy=$_POST['yy'];
$library=$_POST['library'];
$vendor=$_POST['vendor'];
$tid=$_POST['tid'];
$author=$_POST['author'];
$publisher=$_POST['publisher'];
$title=$_POST['title'];
$copies=$_POST['copies'];
$unit=$_POST['unit'];
$amount=$_POST['amount'];
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
		if((charCode >= 65456 && charCode <= 65465) || (charCode >= 96 && charCode <= 105))
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
function calculate(unit,copies,amount)
{
	amount.value = parseFloat(unit.value * copies.value);
	amount.value =dollarize(amount.value);
}
function format (expr, decplaces) {
	var str = "" + Math.round (eval(expr) * Math.pow(10,decplaces))
	while (str.length <= decplaces) {
		str = "0" + str
	}
	var decpoint = str.length - decplaces
	return str.substring(0,decpoint) + "." + str.substring(decpoint,str.length);
}
function dollarize (expr)
	{
		return format(expr,2)
	}
</script>
</head>
<body>
<?
if(isset($submit1))
	{
		if(!checkdate($mm,$dd,$yy))
		{
			echo "Invalid Purchase Order Date.";
			die("</td></tr></table>");
		}
		$purchase_date = "$yy-$mm-$dd";
		if(sizeof($tid) >0)
			{
				if($order=="")
					{
						die("<font color='red' size=4> Enter Order No.</font>");
					}
				$qry="select * from lib_order_m where order_no='$order'";
				
				$rs=execute($qry);
				if($rs)
					{
						if(rowcount($rs)>0)
							{
								echo "Record already Exists....";
							}
						else
							{
								$totcop=0;
								$ordamt=0;
								for($i=0;$i<count($tid);$i++)
									{
										$cptemp=$tid[$i];
										$cp=$_POST["copies".$cptemp];										
										$cp=$_POST['copies'.$tid[$i]];
										$totcop = $totcop + $cp;
										//$ut="unit$tid[$i]";
										$uttemp=$tid[$i];
										$ut=$_POST['unit'.$uttemp];										
										$amount_order=(($cp)*($ut));
										$ordamt = $ordamt + $amount_order;
									}
									$qry="insert into lib_order_m(order_no,order_date,order_copies,order_amt,vendor_id,library)                 values('$order','$purchase_date','$totcop','$ordamt','$vendor','$library')";								
								execute($qry);
								$pid=fetchInsertId();
								for($i=0;$i<count($tid);$i++)
									{
										$temp=$tid[$i];
										//$au="author$tid[$i]";
										//$au=$$au;
										$au=$_POST["author".$temp];
										//$pu="publisher$tid[$i]";
										//$pu=$$pu;
										$pu=$_POST["publisher".$temp];
										//$tit="title$tid[$i]";
										//$tit=$$tit;
										$tit=$_POST["title".$temp];
										//$copies="copies$tid[$i]";
										//$copies=$$copies;
										$copies=$_POST["copies".$temp];
										//$amt="unit$tid[$i]";
										//$amt=$$amt;
										$amt=$_POST["unit".$temp];
										$qry="insert into lib_order_det(order_id,title,copies,author,publisher,apprate) values($pid,'$tit',$copies,'$au','$pu',$amt)";
										//echo $qry;
										execute($qry);
									}				
								echo "<center><h3><u>Purchase Order</u></h3></center>";
								echo "<table width=50% align='center'>";
								echo "<tr>";
								echo "<td>Purchase Order No. :$order</td>";
								echo "<td align=right colspan=4>Date : $dd-$mm-$yy</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td colspan=5>To,</td>";
								echo"</tr>";
								echo "<tr>";
								echo "<td colspan=5>";
								$qry="select * from lib_vendor_m where id=$vendor";
								$rs=execute($qry);
								$row=fetcharray($rs);
								echo "$row[Name] <br>";
								echo "$row[address]";
								echo "</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td colspan=5>Sir,</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td colspan=5>We are pleased to place order for the following</td>";
								echo "</tr>";
								echo "</table><br><br>";
								echo "<center>";
								echo "<table border=1 cellspacing=0 cellpadding=0 width='50%'>";
								echo "<tr>";
								echo "<td align='center' class='head'>Sl.No.</td>";
								echo "<td align='center' class='head'>Author</td>";
								echo "<td align='center' class='head'>Publisher</td>";
								echo "<td align='center' class='head'>Title</td>";
								echo "<td align='center' class='head'>No. Of Copies</td>";
								echo "<td align='center' class='head'>Unit Price</td>";
								echo "<td align='center' class='head'>Amount</td>";
								echo "</tr>";
								$qry="select * from lib_order_det where order_id=$pid";
								$rs=execute($qry);
								if($rs)
									{
										$ctr=1;
										$tot = 0;
										$tot1 = 0;
										while($row=fetcharray($rs))
											{
												echo "<tr>";
												echo "<td align='center'>$ctr</td>";
												echo "<td align='center'>$row[author]</td>";
												echo "<td align='center'>$row[publisher]</td>";
												echo "<td align='center'>$row[title]</td>";
												echo "<td align=right>$row[copies]</td>";
												echo "<td align=right>";
												echo number_format($row[apprate],2,'.','');
												echo "</td>";
												echo "<td align=right>";
												echo number_format(($row[copies] * $row[apprate]),2,'.','');
												echo "</td>";
												echo "</tr>";
												$ctr++;
												$tot = $tot + $row[copies];
												$tot1 = $tot1 + ($row[copies] * $row[apprate]);
											}
									}
							echo "<tr>";
							echo "<td colspan=4 align=right>Grand Total</td>";
							echo "<td align=right>$tot</td>";
							echo "<td>&nbsp;</td>";
							echo "<td align=right>";
							echo number_format($tot1,2,'.','');
							echo "</td>";
							echo "</tr>";
							echo "</table>";
							echo "</center><br><br><br>";
							echo "Terms and Conditions :-";
							echo "<ul>";
							echo "<li>Payment within __ days from the date of delivery</li>";
							echo "<li>Delivery should be made at ________________________<br></li>";
							echo "<li>Billing should be done in the name of _______________________</li>";
							echo "<li>Books should be delivered withon one week</li>";
							echo "</ul>";
							echo "<br>";
							echo "<table>";
							echo "<tr>";
							echo "<td align=left>Thanking You<br>With Regards<br><br><br><br>Executive Director</td>";
							echo "</tr>";
							echo "</table>";
							die();
						}
					}
				}
			}
		echo "<form method='POST' name='form'>";
		echo "<table class=forumline align=center colspan='2' width='47%'>";
		echo "<tr><td colspan=2 class=head align='center'>Generate Purchase Order</td></tr>";
		echo "<tr>";
		echo "<td align='right'>Quotation No.&nbsp;&nbsp;&nbsp;</td>";
		echo "<td><select name=quotation onChange=\"javascript:document.forms[0].submit()\">";
		echo "<option value=''> Select Quotation </option>";
		$rs=execute("select * from lib_quotation");
		for($i=0;$i<rowcount($rs);$i++)
			{
				$r=fetcharray($rs,$i);
				if($r[id]==$quotation)
					$sel="selected";
				else
					$sel="";
				printf("<option value=$r[id] $sel>Q.No.%02d - ($r[quot_date]) </option>",$r[id]);
			}
		echo "</select></td>";
		echo "</tr>";
		echo "</table>";
		echo "<br>";
		if($quotation <> '')
			{
				$qry="select * from lib_quotation where id=$quotation";
				$rs=execute($qry);
				$row=fetcharray($rs);
				echo "<table border=1 class=forumline align=center colspan='4'>";
				echo "<tr>";
				echo "<td><font color=blue>Order No.</font></td>";
				echo "<td><input type=text name=order size=10 maxlength=50></td>";
				echo "<td><font color=blue>Purchase Order Date</font></td>";
				echo "<td><input type=text name=dd size=2 maxlength=2 onKeydown='return checkIt(event,0)'>";
				echo "<input type=text name=mm size=2 maxlength=2 onKeydown='return checkIt(event,0)'>";
				echo "<input type=text name=yy size=4 maxlength=4 onKeydown='return checkIt(event,0)'></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan=2><font color=blue>Library</font></td>";
				echo "<td colspan=2>";
				$rs1=execute("select * from library_name where id=$row[library]");
				$librow=fetcharray($rs1);
				echo "<input type=hidden name=library value=$row[library]>$librow[name]</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td><font color=blue>Vendor Name</font></td>";
				echo "<td>";
				$rs1=execute("select * from lib_vendor_m where id=$row[vendor]");
				$venrow=fetcharray($rs1);
				echo "<input type=hidden name=vendor value=$row[vendor]>$venrow[Name]</td>";
				echo "<td><font color=blue>Address : </font></td>";
				echo "<td>$venrow[address]</td>";
				echo "</tr>";
				echo "</table>";
				echo "<br>";
				echo "<table border=1 colspan='7' align=center class=forumline>";
				echo "<tr>";
				echo "<td class='head' align=center>Select</td>";
				echo "<td class='head' align=center>Author</td>";
				echo "<td class='head' align=center>Publisher</td>";
				echo "<td class='head' align=center>Title</td>";
				echo "<td class='head' align=center>Copies</td>";
				echo "<td class='head' align=center>Unit Price</td>";
				echo "<td class='head' align=center>Amount</td>";
				echo "</tr>";
				$qry="select * from quotation_trans where id=$quotation";
				$transrs=execute($qry);
				while($transrow=fetcharray($transrs))
				{
					echo "<tr>";
					echo "<td><input type=checkbox name=tid[] value=$transrow[tid]></td>";
					echo "<td><input type=hidden name=author$transrow[tid] value='$transrow[author]'>$transrow[author]</td>";
					echo "<td><input type=hidden name=publisher$transrow[tid] value='$transrow[publisher]'>$transrow[publisher]</td>";
					echo "<td><input type=hidden name=title$transrow[tid] value='$transrow[title]'>$transrow[title]</td>";
					echo "<td><input type=text name=copies$transrow[tid] value='$transrow[copies]' size=4 onKeydown='return checkIt(event,0)'></td>";
					echo "<td><input type=text name=unit$transrow[tid] value=0 size=6 onKeydown='return checkIt(event,1)' onChange=\"calculate(this.form.unit$transrow[tid],this.form.copies$transrow[tid],this.form.amount$transrow[tid])\"></td>";
					echo "<td><input type=text name=amount$transrow[tid] value=0 size=7 onKeydown='return checkIt(event,1)' disabled></td>";
					echo "</tr>";
				}
			echo "<tr>";
			echo "<td colspan=7 align='center'><input type=submit name=submit1 value='Generate' class=bgbutton></td>";
			echo "</tr>";
			echo "</table>";
		}
	echo "</form>";
?>
</body>
</html>