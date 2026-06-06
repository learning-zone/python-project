            <HTML>
<HEAD>

</HEAD>
<body>

<?php
	$con  = mysql_pconnect("localhost",'root','')
	 or die("<b>Cannot open connection to database</b>.");
	
	mysql_select_db("rnsit")
	 or die("<b>could not select database</b>.");
	 $file_type = "vnd.ms-excel";
	$file_name= "stock_verification.xls";
	header("Content-Type: application/$file_type");
	header("Content-Disposition: attachment; filename=$file_name");
	if($media==1)
	{
		$tble1="lib_acc_details";
		$tble2="lib_book_details";
		$med_type="book_type";
	}
	elseif($media==2)
	{
		$tble1="lib_cd_acc_det";
		$tble2="lib_cd_det";
		$med_type="cd_type";
	}
	elseif($media==3)
	{
		$tble1="lib_floppy_acc_det";
		$tble2="lib_floppy_det";
		$med_type="floppy_type";
	}
	elseif($media==4)
	{
		$tble1="lib_cd_acc_det";
		$tble2="lib_cd_det";
		$med_type="cd_type";
	}
?>
<form method="POST" name="form1">
<table  align='center' class=forumline>
<tr><td class='rowpic' align='center' colspan=10>
<font face='Lucida Sans' size='2'><b>Detailed Stock Verification Report</b></font></td></tr>
<tr><td class='row3'><font face='Lucida Sans' size='1'><b>Sl No.</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b>Accession No</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b>Title</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b>Author</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b>ISBN</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b><?php echo $media_name?> Type</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b><?php echo $media_name?> Status</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b>Register</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b>Price</b></font></td>
<td class='row3'><font face='Lucida Sans' size='1'><b>Availability</b></font></td></tr>
<?php
if($stype=='mis')
{
	$ssql="select a.*,b.title,b.author,b.isbn,b.price from $tble1 a,$tble2 b where a.master_id=b.id and a.media_type='$media' and a.acc_no not in(".$matchedacc3.") and a.flag='0'";
	$ssql.=" order by a.acc_no";
}
else if($stype=='ext')
{
$ssql="select ext_acc as acc_no from lib_phy_stkrep where media='$media' and sdate='".date("d-m-Y")."' order by id desc limit 1";
}
else if($stype=='issue')
{
	$ssql="select * from lib_acc_details where flag='1'";
}
else if($stype=='dam')
{
	$ssql="select * from lib_acc_details where mode='D'";
}
$rs_sql=execute($ssql) or die("Error");
echo $countRS = rowcount($rs_sql);
if($countRS==0)
{
	die ("No Records");
}
else
{
	$slno=1;
	for($i=0;$i<$countRS;$i++)
	{
		$r_sql=fetcharray($rs_sql);
		$media=$r_sql[media_type];
		echo "<tr>";
		echo "<td><font face='Lucida Sans' size='1'>";
		$j=$i+1;
		echo "$slno";
		echo "</font></td>";
		echo "<td>&nbsp;<font face='Lucida Sans' size='1'>";
		echo "$r_sql[acc_no]";
		echo "</font></td>";
		echo "<td><font face='Lucida Sans' size='1'>";
		echo "$r_sql[title]";
		echo "</font></td>";
		echo "<td><font face='Lucida Sans' size='1'>";
		echo "$r_sql[author]";
		echo "</font></td>";
		echo "<td><font face='Lucida Sans' size='1'>";
		echo "$r_sql[isbn]";
		echo "</font></td>";
		echo "<td><font face='Lucida Sans' size='1'>";
		if($r_sql[$med_type]=="I")
		{
			$type="Issue";
		}
		elseif($r_sql[$med_type]=="R")
		{
			$type="Reference";
		}
		echo "$type";
		echo "</font></td>";
		echo "<td><font face='Lucida Sans' size='1'>";
		if($r_sql[mode]=="A")
		{
			$sts="Active";
			if($r_sql[flag]==0)
				$flg="Available";
			else
				$flg="Issued";
		}
		elseif($r_sql[mode]=="D")
		{
			$sts="Damaged";
			$flg="------";
		}
		elseif($r_sql[mode]=="M")
		{
			$sts="Missing";
			$flg="------";
		}
		echo "$sts";
		echo "</font></td>";
		echo "<td><font face='Lucida Sans' size='1'>";
		$rsql=execute("select register from lib_register where id='$r_sql[register]'");
		$rs2=fetcharray($rsql);
		echo "$rs2[register]";
		echo "</font></td>";
		echo "<td><font face='Lucida Sans' size='1'>";
		echo "$r_sql[price]";
		echo "</font></td>";
		echo "<td><font face='Lucida Sans' size='1'>";
		echo "$flg";
		echo "</font></td>";
		echo "</tr>";
		$slno+=1;
	}
	?>
	<tr>
	</tr>
	<?php
}
?>
</table>
</form>
</body>
</html>