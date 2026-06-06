<?php
require_once("../db.php");

$id=$_REQUEST['id'];
//print_r($_GET);
//print_r($_POST);
?>
<HTML>
<HEAD>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = "";
}

function delete_po(thisform)
{
thisform.action="DeletePurOrder.php"
thisform.submit();
}
</script>
</HEAD>
<BODY>
<form method="POST">
<?php
$sql = "SELECT a.*,b.Name,b.address FROM lib_order_m a,lib_vendor_m b ";
$sql .= " WHERE a.vendor_id = b.id and a.id=$id ORDER BY a.order_date DESC";
$rs=execute($sql) or die(errordescription());
$row=rowcount($rs);
for($i=0;$i<$row;$i++)
{
$r=fetcharray($rs,$i);
			/* Generation of Purchase Order Form */

			echo "<table width=100% cellspacing=2 class=forumline>";
				echo "<tr><td align=center colspan=7 class=head>Purchase Order</td></tr>";
				echo "<tr>";
					echo "<td class=row2>";
						echo "<b>Purchase Order No. :</b>$r[order_no]";
					echo "</td>";
					echo "<td align=right colspan=7 class=row2>";
						echo "<b>Date :</b>". date('d-m-Y',strtotime($r[order_date]));
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td colspan=7>";
						echo "<b>To,</b>";
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td colspan=7>";
						echo "$r[Name] <br>";
						echo "$r[address]";
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td colspan=7>";
						echo "Sir,";
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td colspan=7>";
						echo "We are pleased to place order for the following";
					echo "</td>";
				echo "</tr>";

			echo "<center>";
              echo "<tr>";
			  echo "<td colspan=7><br>";
			  echo "</td>";
			  echo "</tr>";

				echo "<tr>";
					echo "<td class=rowpic align='center'>Sl.No</td>";
					echo "<td class=rowpic align='center'>Author</td>";
					echo "<td class=rowpic align='center'>Publisher</td>";
					echo "<td class=rowpic align='center'>Title</td>";
					echo "<td class=rowpic align='center'>No. Of Copies</td>";
					echo "<td class=rowpic align='center'>Unit Price</b></td>";
					echo "<td class=rowpic align='center'>Amount</td>";
				echo "</tr>";
				$qry="select * from lib_order_det where order_id='$r[id]'";
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
							echo "<td align=right>$row[apprate]</td>";
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
					echo "<td align=right><b>";
						echo number_format($tot1,2,'.','');
					echo "</b></td>";
				echo "</tr>";

			echo "<tr><td colspan=7><br></td></tr>";
			echo "<tr><td colspan=7>Terms and Conditions :-</td></tr>";

					echo "<tr><td colspan=7>Payment within ____ days from the date of delivery</td></tr>";
				$rs_col=execute("select * from college");
				$r_col=fetcharray($rs_col);
				$college=$r_col[col_name];

					echo "<tr><td colspan=7>Delivery should be made at  $college </td></tr>";
					echo "<tr><td colspan=7>$r_col[col_addr] </td></tr>";
					mysql_free_result($rs_col);


					echo "<tr><td colspan=7>Billing should be done in the name of _______________________</td><tr>";
					echo "<tr><td colspan=7>Books should be delivered withon one week<br><br><br><br></td></tr>";

				echo "<tr>";
					echo "<td align=left colspan=7>";
						echo "Thanking You";
						echo "<br>";
						echo "With Regards";
						echo "<br><br><br><br>";
						echo "Executive Director";
					echo "</td>";
				echo "</tr>";
			echo "</table>";
			/*Generation Ends Here */
?>
</div>
<div align='center' id='prn'>
<br><input type="button" value="Print Purchase Order" name="B3" onClick="printReport()" class=bgbutton >
<input type="button" value="Delete" name="del" onClick="delete_po(this.form)" class=bgbutton>
<div>
<?php
}
?>
</form>
</BODY>
</HTML>