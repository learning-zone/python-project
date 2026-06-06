<?php
require_once("../db.php");
$media=$_REQUEST['media'];
$stype = $_REQUEST['stype'];
if($_POST)
{
	$SeekPos=$_POST['SeekPos'];
}
if($_GET)
{
	$SeekPos=$_GET['SeekPos'];
}
$_NUMREC_ = 15; // Number of result per page;
//Set the initial seek position
if(empty($SeekPos))
{
    $SeekPos = 0;
}
if($Seek_Val !="")
{
	$SeekPos=$Seek_Val;
}
?>
<HTML>
<HEAD>
<script language="javascript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function checkIt(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!

	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT )
	{
		if((charCode >= 65456 && charCode <= 65465) || (charCode >= 96 && charCode <= 105)|| (charCode >= 49 && charCode <= 59))
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
function printReport()
{
	prn.style.display="none";
	disp.style.display="none";
	disp1.style.display="none";
	print(this.form);
	prn.style.display="";
	disp.style.display="";
	disp1.style.display="";
}
function excel_rep()
{
	document.form1.action="ex_phystkver.php";
	document.form1.submit();
}
</script>
</HEAD>
<?php
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
	$matchedacc3=$_SESSION['matchedacc3'];
	$misedacc3=$_SESSION['misedacc3'];
?>
<form method="POST" name="form1">
<input type="hidden" name="stype" value="<?=$stype?>">
<input type="hidden" name="media" value="<?=$media?>">
<input type="hidden" name="matchedacc3" value="<?=$matchedacc3?>">
<input type="hidden" name="misedacc3" value="<?=$misedacc3?>">
<input type='hidden' name="Seek_Val" value="<?php echo $SeekPos?>">
<table  align='center' class=forumline>
<tr><td class='rowpic' align='center' colspan=10>
Detailed Stock Verification Report</td></tr>
<tr><td class='row3'>Sl No.</td>
<td class='row3'>Accession No</td>
<td class='row3'>Title</td>
<td class='row3'>Author</td>
<td class='row3'>ISBN</td>
<td class='row3'><?php echo $media_name?> Type</td>
<td class='row3'><?php echo $media_name?> Status</td>
<td class='row3'>Register</td>
<td class='row3'>Price</td>
<td class='row3'>Availability</td></tr>
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
$rs_sql=execute($ssql);
$countRS = rowcount($rs_sql);
if($countRS==0)
{
	die ("No Records");
}
else
{
	data_seek($rs_sql,$SeekPos); //Move the data pointer to the next position.
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
	$SeelPos=$PAGES;
	$slno=$SeekPos+1;
	for($i=$SeekPos;$i<$MAX;$i++)
	{
		$r_sql=fetcharray($rs_sql);
		$media=$r_sql[media_type];
		echo "<tr>";
		echo "<td>";
		$j=$i+1;
		echo "$slno";
		echo "</td>";
		echo "<td>";
		echo "$r_sql[acc_no]";
		echo "</td>";
		echo "<td>";
		echo "$r_sql[title]";
		echo "</td>";
		echo "<td>";
		echo "$r_sql[author]";
		echo "</td>";
		echo "<td>";
		echo "$r_sql[isbn]";
		echo "</td>";
		echo "<td>";
		if($r_sql[$med_type]=="I")
		{
			$type="Issue";
		}
		elseif($r_sql[$med_type]=="R")
		{
			$type="Reference";
		}
		echo "$type";
		echo "</td>";
		echo "<td>";
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
		echo "</td>";
		echo "<td>";
		$rsql=execute("select register from lib_register where id='$r_sql[register]'");
		$rs2=fetcharray($rsql);
		echo "$rs2[register]";
		echo "</td>";
		echo "<td>";
		echo "$r_sql[price]";
		echo "</td>";
		echo "<td>";
		echo "$flg";
		echo "</td>";
		echo "</tr>";
		$slno+=1;
	}
	?>
	
	<?php
}
?>
</table>
<br>
<div id="disp1" align="center">
<INPUT TYPE="button" class='bgbutton' NAME="Excel" VALUE="Export to Excel" onClick="excel_rep()"></div>
</form>
<form name="frm" action="viewstkrep.php">
<input type="hidden" name="id" value="<?php echo $id?>">
<input type="hidden" name="SeekPos" value="<?php echo $SeekPos?>">
<input type="hidden" name="LAST" value="<?php echo $LAST?>">
<input type="hidden" name="media" value="<?php echo $media?>">
<input type="hidden" name="stype" value="<?php echo $stype?>">
<input type="hidden" name="PAGES" value="<?php echo $PAGES?>">
<input type=hidden name=lib value='<?=$lib?>'>
<input type=hidden name=regt value='<?=$regt?>'>
<input type=hidden name=mtype value='<?=$mtype?>'>
<input type=hidden name=mode value='<?=$mode?>'>
<input type="hidden" name="stype" value="<?=$stype?>">
<div align="left" id="disp">
<table width="10%" border="0" cellspacing="2" cellpadding="1" align='center'>
<tr><td colspan="2" align="right">Go To</td>
<td colspan="2" align="left">
<input type="text" name="go_to" value="<?php echo  ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()"  ></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0" alt="First"></a></td>
<td><a href="Javascript:prev(<?php echo $PREV?>)"><img src="../images/previousbtn.gif" border="0" alt="Previous"></a></td>
<td><a href="Javascript:next(<?php echo $NEXT?>)">
<img src="../images/nextbtn.gif" border="0" alt="Next" onMouseOver="Javascript:status='Next Page';"></a></td>
<td><a href="Javascript:last(<?php echo $LAST?>)">
<img src="../images/lastbtn.gif" border="0" alt="Last" onMouseOver="Javascript:status='Last Page';"></a></td></tr>

<tr><td colspan="4" align="center">Page <?php echo  ($SeekPos / $_NUMREC_) +1?> of <?php echo (int) $PAGES?></td></tr></div>
</table>
<div id='prn' align='center'>
			<INPUT TYPE="button" class='bgbutton' NAME="print" VALUE="PRINT" onClick="printReport()">
			</div>
</form>
<script language="JavaScript">
function fun_go_to()
{
	if((document.frm.go_to.value==0)||(document.frm.go_to.value=="")||(parseInt(document.frm.go_to.value) > parseInt(document.frm.PAGES.value) ))
	{
		alert("Page not found");
	}
	else
	{
		document.frm.SeekPos.value = (parseInt(document.frm.go_to.value)-1)* 15;
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
function prev(prev)
{
	var i;
	//i = "<?php echo $PREV?>";
	i=prev;
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function next(next)
{
	var i;
	//i = "<?php echo $NEXT?>";
	i=next;
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
function last(last)
{
	var i;
	//i = "<?php echo $LAST?>";
	i=last;
	document.frm.SeekPos.value = i;
	document.frm.submit();
}
</script>
</body>
</html>