<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
require_once("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$sno=$_POST['sno'];
	$PAGES=$_POST['PAGES'];
	$go_to=$_POST['go_to'];
	$library=$_POST['library'];
	$subject=$_POST['subject'];
	$submit1=$_POST['submit1'];
	$SeekPos=$_POST['SeekPos'];
	$register=$_POST['register'];

}
else
{
	$id=$_REQUEST['id'];
	$sno=$_REQUEST['sno'];
	$PAGES=$_REQUEST['PAGES'];
	$go_to=$_REQUEST['go_to'];
	$library=$_REQUEST['library'];
	$subject=$_REQUEST['subject'];
	$submit1=$_REQUEST['submit1'];
	$SeekPos=$_REQUEST['SeekPos'];
	$register=$_REQUEST['register'];
}

$_NUMREC_ = 25; // Number of result per page;
//Set the initial seek position
if(empty($SeekPos))
{
	$SeekPos = 0;
}
?>
<html>
<head>
<script language="JavaScript">
function frm_submit()
{
	document.frm.SeekPos.value=0;
}
function printReport()
{
	prn.style.display = "none";
	prn1.style.display = "none";
	prn2.style.display = "none";
	if(document.frm.go_to.value >1)
	{
		main_header.style.display = "none";
		div_id1.style.display = "none";
	}
	window.print();
	main_header.style.display ="";
	div_id1.style.display = "";
	prn.style.display = "";
	prn1.style.display = "";
	prn2.style.display = "";
}
</script>
</head>
<body>
<?php
echo "<div id='main_header'>";
$rs_col=execute("select * from college");
$r_col=fetcharray($rs_col);
$college=$r_col[col_name];
mysql_free_result($rs_col);
//echo "<div align='center'>$college <br></div>";
echo "<br>";
echo "</div>";
echo "<div id='div_id1'>";
echo "<table  width='60%' class='forumline' align='center'>";
echo "<tr><td colspan=5 class='head' align='center'>Subject Wise Book Detail Report</td></tr>";
echo "</td></tr>";
echo "<tr>";
/*
echo "<td>";
echo "<font face='Lucida Sans' size='1.8'>Register : </font>";
$rs_sql=execute("select * from lib_register where id=$register");
$r_sql=fetcharray($rs_sql);

echo "$r_sql[register]";
echo "</td>";
*/
$Register=1;
echo "<td align='left'>";
############ SET DEFAULT SERVER TIME-ZONE  ############### 
  $curdate=date('Y-m-d H:i:s');
  date_default_timezone_set('Asia/Calcutta');
  $date = date('m/d/Y h:i:s a', time());
  $timezone = date_default_timezone_get();
  //echo "The current server timezone is: " . $timezone;
##########################################################
$c_date=date('d-m-Y');
echo "As On :$c_date";
echo "</td></tr>";
echo "<tr><td colspan=2 align='center'>";
echo "Subject : $subject";
echo "</td></tr>";
echo "</table>";
echo "</div>";
$ctr=0;
echo "<center><table border=1 cellpadding=0 cellspacing=0 width='60%' align='center' class=forumline>";
echo "<tr>";
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
	echo"No.of Copies";
	echo "</td>";
echo "</tr>";
$attribute="Accno";
$register=1;

$qry="select distinct(b.master_id) from  lib_acc_details b,lib_book_details a where ";
$qry .=" b.register=$register and a.subject='$subject' and a.id=b.master_id and mode='A'order by a.title ";
$t4=execute($qry);
$countRS = rowcount($t4);
if($countRS==0)
{
	die("Record Not Found.");
}
 mysql_data_seek($t4,$SeekPos); //Move the data pointer to the next position.
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
{
    for($i=$SeekPos;$i<$MAX;$i++)
    {
    	$row = fetcharray($t4,$i);
		$sql2="select * from lib_book_details where id=$row[master_id]";
		$rs22=execute($sql2);
		$r22=fetcharray($rs22);
		$sql="select count(*) from lib_acc_details where master_id=$row[master_id]";
		$rs=execute($sql);
		$r=fetcharray($rs,0);
		echo "<tr>";
		echo "<td>";
			$temp_i=strval($i)+1;
				echo "$temp_i";
		echo "</td>";
			$title=$r22[title];
		echo "<td>";
			echo "$title";
		echo "</td>";
		echo "<td>";
			echo "$r22[author]";
		echo "</td>";
		echo "<td align='right'>";
			echo "$r[0]";
		echo "</td>";
		echo "</tr>";
		$sno+=1;
		$total=$total+$r[0];
	}
}
echo "<td colspan=3 align=right>";
echo "Total";
echo "</td>";
echo "<td align=right>";
echo "$total";
echo "</td>";
echo "<p align='center'><a href='subject_wise_report.php'>Go Back</a></p>";
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
		document.frm.SeekPos.value = (parseInt(document.frm.go_to.value)-1)* 25;
		document.frm.submit();
	}
}
</script>
<script language="JavaScript">
	function first()
		{
			//alert("first");
			var i;
            i = 0;
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function prev()
		{
			//alert("prev");
			var i;
            i = "<?=$PREV?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
    function next()
		{
			//alert("next");
		    var i;
            i = "<?=$NEXT?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function last()
		{
            //alert("last");
			var i;
            i = "<?=$LAST?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
</script>
<form name="frm" action="view_subject_wise_report.php">
<input type="hidden" name="id" value="<?php echo $id?>">
<input type="hidden" name="SeekPos" value="<?php echo $SeekPos?>" >
<input type="hidden" name="subject" value="<?php echo $subject?>">
<input type="hidden" name="library" value="<?php echo $library?>">
<input type="hidden" name="register" value="<?php echo $register?>">
<input type="hidden" name="submit1" value="<?php echo $submit1?>">
<input type="hidden" name="sno" value="<?php echo $sno?>">
<input type="hidden" name="PAGES" value="<?php echo $PAGES?>">
<div id='prn2' align="center">
<table width="10%" border="0" cellspacing="2" cellpadding="1">
<tr><td colspan="4" align="center">Go To
<input type="text" name="go_to" value="<?php echo  ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()" class=bgbutton></td></tr>

    <tr>
		<td title="First"><a href="Javascript:first()"><<</td>
		<td title="Previous"><a href="Javascript:prev()"><</td>
		<td title="Next"><a href="Javascript:next()">></td>
		<td title="Last"><a href="Javascript:last()">>></td>
    </tr>
</table>
</div>
<div align="center">
<font face='Lucida Sans' size='1.8'>Page <?php echo ($SeekPos / $_NUMREC_)+1?> of <?php echo (int) $PAGES?></font></div>
</form>
</BODY>
</HTML>