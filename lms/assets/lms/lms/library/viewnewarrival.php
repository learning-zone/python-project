<?php
include_once("../db.php");
$id=$_POST['id'];
$SeekPos=$_POST['SeekPos'];
$library=$_POST['library'];
$register=$_POST['register'];
$media=$_POST['media'];
$subject=$_POST['subject'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
$sno=$_POST['sno'];
$PAGES=$_POST['PAGES'];
$go_to=$_POST['go_to'];
if($_GET)
{
	$SeekPos=$_GET['SeekPos'];
}
if(!checkdate($DMon,$DDay,$DYear))
{
	echo "Invalid From Date.";
	die("</td></tr></table>");
}
$FromDate = "$DYear-$DMon-$DDay";
if(!checkdate($TMon,$TDay,$TYear))
{
	echo "Invalid To Date.";
	die("</td></tr></table>");
}
$ToDate = "$TYear-$TMon-$TDay";
$_NUMREC_ = 20; // Number of result per page;
//Set the initial seek position
if(empty($SeekPos))
{
        $SeekPos = 0;
}

?>
<html>
<head>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	if(document.frm.go_to.value >1)
	{
		header.style.display = "none";
	}
	window.print();
	prn.style.display = "";
	header.style.display = "";
}
</script>
</head>
<body>
<div id='header'>
<?
if($register!=0)
{
	$qry="select * from lib_register where id=$register";
}
else
{
	$qry="select * from lib_register";
}
$ls=execute($qry);
$rls=fetcharray($ls);
//echo "<div align='center'>$rls[collage_name]</div>";
//echo "<br>";
if($register!=0)
{
	$reg=$rls[register];
}
else
{
	$reg="All";
}
?>
<table width="90%" class='forumline' align='center'>
<tr><td class="head" align="center" colspan=2>New Arrival Media Report </td></tr>
<tr><td class='rowpic' colspan=2 align="left">Media Type: Book</td></tr>
<?php
/*
<tr><td>Register=<?php echo $reg?></td><td align='right'>As on : <?php echo date('d-m-Y')?></td>
</tr>
*/
$Register=1;
?>
</table>
</div>
<?
echo "<center>";
if($media=="")
{
	die();
}
$ctr=0;
echo "<center><table border=1 cellpadding=0 cellspacing=0 width=90% class=forumline>";
    echo "<tr>";
		echo "<td class='head' align='center'>";
		echo"Sl.No.";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo"Title";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo "Author";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo"Subject";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo"Publisher";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo"Price";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo"Copies";
		echo "</td>";
    echo "</tr>";
$attribute="Accno";
if($register!=0)
{
	$qry="select distinct(b.master_id) from  lib_acc_details b, lib_book_details a where ";
	$qry.="b.media_type=$media and b.register=$register and b.master_id=a.id and a.subject='$subject' ";
	$qry.= "and a.date_of_acquiring between '$FromDate' and '$ToDate' order by a.title ASC";
}
else
{
	$qry="select distinct(b.master_id) from  lib_acc_details b, lib_book_details a where ";
	$qry.="b.media_type=$media and b.master_id=a.id and a.subject='$subject' ";
	$qry.="and a.date_of_acquiring between '$FromDate' and '$ToDate' order by a.title ASC";
}
$t4=execute($qry);
$countRS = rowcount($t4);
if($countRS==0)
{
	die("Record Not Found.");
}
data_seek($t4,$SeekPos); //Move the data pointer to the next position.
if( ($SeekPos + $_NUMREC_) > $countRS)
{
	$MAX = $countRS;
}
else
{
	$MAX = $SeekPos + $_NUMREC_ ;
}
if( ($SeekPos + $_NUMREC_) >= $countRS)
{
	$NEXT = $SeekPos;
}
else
{
	$NEXT  = $SeekPos + $_NUMREC_ ;
}
if( ($SeekPos - $_NUMREC_)  > 0)
{
	$PREV = $SeekPos - $_NUMREC_;
}
else
{
	$PREV = 0;
}
$PAGES = $countRS / $_NUMREC_;
if($countRS % $_NUMREC_)
{
	$PAGES++;
}
$LAST = ((int) $PAGES - 1) * $_NUMREC_;
for($i=$SeekPos;$i<$MAX;$i++)
{
	$row = fetcharray($t4);
	$sql2="select * from lib_book_details where id=$row[master_id]";
	$rs22=execute($sql2);
	$r22=fetcharray($rs22);
	$sql="select count(*) from lib_acc_details where master_id=$row[master_id]";
	$rs=execute($sql);
	$r=fetcharray($rs,0);
	echo "<tr>";
		echo "<td align='center'>";
		$temp_i=strval($i)+1;
		echo "$temp_i";
		echo "</td>";
		$title=$r22[title];
		echo "<td align='center'>";
		echo "$title";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r22[author]";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r22[subject]";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r22[publisher]";
		echo "</td>";
		echo "<td align='right'>";
		$price = number_format($r22[price], 2, '.', '');
		echo "$price";
		echo "</td>";
		echo "<td align='right'>";
		echo "$r[0]";
		echo "</td>";
	echo "</tr>";
	$sno+=1;
	$total=$total+$r[0];
}
echo "<td colspan=6 align=right>";
echo " Total";
echo "</td>";
echo "<td align=right>";
echo " $total";
echo "</td>";
if($register!=0)
{
	$sql_qry="select count(*) from  lib_acc_details b, lib_book_details a where ";
	$sql_qry .=" b.media_type=$media and b.register=$register and b.master_id=a.id ";
	$sql_qry.= "and a.date_of_acquiring between '$FromDate' and '$ToDate' ";
}
else
{
	$sql_qry="select count(*) from  lib_acc_details b, lib_book_details a where ";
	$sql_qry .=" b.media_type=$media and b.master_id=a.id ";
	$sql_qry.= "and a.date_of_acquiring between '$FromDate' and '$ToDate' ";
}
$rs_sql=execute($sql_qry);
$r_sql=fetcharray($rs_sql);
$grand_total=$r_sql[0];
echo "</tr>";
$current_page= ($SeekPos / $_NUMREC_) +1;
if(intval($current_page) == intval($PAGES))
{
	echo "<tr>";
	echo "<td colspan=6 align=right>";
	echo " Grand Total";
	echo "</td>";
	echo "<td align=right>";
	echo " $grand_total";
	echo "</td>";
	echo "</tr>";
}
	echo "</table></center>";
?>
<script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function checkIt(e)
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
			alert("Please make sure entries are numbers only.")
			return false
		}
	}
	return true
}
function fun_go_to()
{
	if((document.frm.go_to.value==0)||(document.frm.go_to.value=="")||(parseInt(document.frm.go_to.value) > parseInt(document.frm.PAGES.value) ))
	{
		alert("Page not found");
	}
	else
	{
		document.frm.SeekPos.value = (parseInt(document.frm.go_to.value)-1)* 20;
		document.frm.submit();
	}
}
function first()
{
	var i;
	i = 0;
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function prev()
{
	var i;
	i = "<?php echo $PREV?>";
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function next()
{
	var i;
	i = "<?php echo $NEXT?>";
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function last()
{
	var i;
	i = "<?php echo $LAST?>";
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
</script>
<form name="frm" action="viewnewarrival.php">
<input type="hidden" name="id" value="<?php echo $id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="media" value="<?php echo $media?>">
<input type="hidden" name="library" value="<?php echo $library?>">
<input type="hidden" name="register" value="<?php echo $register?>">
<input type="hidden" name="DDay"  value="<?php echo $DDay?>">
<input type="hidden" name="DMon"  value="<?php echo $DMon?>">
<input type="hidden" name="DYear"  value="<?php echo $DYear?>">
<input type="hidden" name="subject"  value="<?php echo $subject?>">
<input type="hidden" name="TDay"  value="<?php echo $TDay?>">
<input type="hidden" name="TMon"  value="<?php echo $TMon?>">
<input type="hidden" name="TYear"  value="<?php echo $TYear?>">
<input type="hidden" name="sno" value="<?php echo $sno?>">
<input type="hidden" name="PAGES" value="<?php echo $PAGES?>">
<!--<div id="prn" align="center">
<table width="10%" border="0" cellspacing="2" cellpadding="1">
<tr>
<td colspan="4" align="center">Go To</td><td>
<input type="text" name="go_to" value="<?php echo  ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
</td><td align="right"><input type="button" name="but_go_to" value="Go" onClick="fun_go_to()"  class=bgbutton >
</td>
</tr>

	<tr>
		<!--<td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First"></a></td>
		<td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous"></a></td>
		<td><a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next" onMouseOver="Javascript:status='Next Page';"></a></td>
        <td><a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last" onMouseOver="Javascript:status='Last Page';"></a></td>-->
		<!--<td title="First"><a href="Javascript:first()"><<</td>
	    <td title="Previous"><a href="Javascript:prev()"><</td>
	    <td title="Next"><a href="Javascript:next()">></td>
	    <td title="Last"><a href="Javascript:last()">>></td>
    </tr>
</table>
<br>
<input type="button" value="   Print   " name="B1"  onClick="printReport()" class='bgbutton'>
</div>
<div align='center'>
	Page <?php echo  ($SeekPos / $_NUMREC_) +1?> of <?php echo (int) $PAGES?>
</div>-->
</form>
</BODY>
</HTML>