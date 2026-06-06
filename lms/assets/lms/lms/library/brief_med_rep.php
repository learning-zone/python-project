<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
require_once("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$LAST=$_POST['LAST'];
	$media=$_POST['media'];
	$PAGES=$_POST['PAGES'];
	$go_to=$_POST['go_to'];
	$SeekPos=$_POST['SeekPos'];
}
if($_GET)
{

	$id=$_REQUEST['id'];
	$lib=$_REQUEST['lib'];
	$LAST=$_REQUEST['LAST'];
	$regt=$_REQUEST['regt'];
	$mode=$_REQUEST['mode'];
	$PAGES=$_REQUEST['PAGES'];
	$mtype=$_REQUEST['mtype'];
	$go_to=$_REQUEST['go_to'];
	$media=$_REQUEST['media'];
	$SeekPos=$_REQUEST['SeekPos'];
}
$_NUMREC_ = 15; // Number of result per page;
//Set the initial seek position
if(empty($SeekPos))
{
    $SeekPos = 0;
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
elseif($media==5)
{
	$tble1="lib_proj_acc_det";
	$tble2="lib_project_report_det";
	$med_name="Project Reports";
	$med_type="book_type";
}
?>
<!--<form method="POST" name="form1">-->
<form name="frm" action="brief_med_rep.php">
<table  align='center' class=forumline width="98%">
<tr><td class='rowpic' align='center' colspan=10>
Media Report</td></tr>
<tr><td class='row3' align="center" nowrap>Sl No.</td>
<td class='row3' align="center" nowrap>Accession No</td>
<td class='row3' align="center">&nbsp;&nbsp;Title</td>
<td class='row3' align="center">&nbsp;&nbsp;Author</td>
<td class='row3' align="center"><?php echo $media_name?> Type</td>
<td class='row3' align="center"><?php echo $media_name?> Status</td>
<td class='row3' align="center">&nbsp;Register</td>
<td class='row3' align="center">Price</td>
<td class='row3' align="center">Availability</td></tr>
<?php
if($lib==0)
{    

	$ssql="select a.*,b.title,b.author,b.isbn,b.price from $tble1 a,$tble2 b, lib_circulation_m c where a.master_id=b.id and a.media_type='$media' and a.mode !='M' AND a.acc_no=c.acc_id";
	
	
	if($regt!=0)
		$ssql.=" and a.register='$regt'";
	if($mode=='handcop')
		$ssql.=" and a.flag ='0'";
	elseif($mode=='outcop')
		$ssql.=" and a.flag ='1'";
	$ssql.=" order by a.acc_no";
	
	//echo $ssql;
}
else 
{
	
	if($regt!=0)
	{
		$ssql="SELECT a.*, b.title, b.author, b.price FROM $tble1 a, $tble2 b where a.master_id=b.id and a.media_type='$media' and a.mode !='M' and a.library='$lib' and a.register='$regt'";
	}
	
	if($mode=='tcop')
	{
		$ssql="SELECT a.*, b.title, b.author, b.price FROM $tble1 a, $tble2 b where a.master_id=b.id and a.media_type='$media' and a.mode !='M' and a.library='$lib'";
	}
	
	if($mode=='handcop')
	{
		$ssql="SELECT a.*, b.title, b.author, b.price FROM $tble1 a, $tble2 b where a.master_id=b.id and a.media_type='$media' and a.mode !='M' and a.library='$lib' and a.flag ='0'";
		
	}
	
	elseif($mode=='outcop')
	{
		$ssql="SELECT a.*, b.title, b.author, b.price FROM $tble1 a, $tble2 b, lib_circulation_m c where a.master_id=b.id and a.media_type='$media' and a.mode !='M' and a.library='$lib' and a.flag >0 and a.acc_no = c.acc_id";		
		
	}
	
	$ssql.=" order by a.acc_no";
	
	//echo "<br>".$ssql;
}

$rs_sql=execute($ssql);

$countRS = rowcount($rs_sql);
if($countRS==0)
{
	die ("No Records");
}
else
{
	mysql_data_seek($rs_sql,$SeekPos); //Move the data pointer to the next position.
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
		echo "<td align='center'>";
		$j=$i+1;
		echo "$slno";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r_sql[acc_no]";
		echo "</td>";
		echo "<td align='left'>";
		echo "$r_sql[title]";
		echo "</td>";
		echo "<td align='left'>";
		echo "$r_sql[author]";
		echo "</td>";
		echo "<td align='center'>";
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
		echo "<td align='center'>";
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
		echo "<td align='left'>";
		$rsql=execute("select register from lib_register where id='$r_sql[register]'");
		$rs2=fetcharray($rsql);
		echo "$rs2[register]";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r_sql[price]";
		echo "</td>";
		echo "<td align='center'>";
		echo "$flg";
		echo "</td>";
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
<input type="hidden" name="id" value="<?php echo $id?>">
<input type="hidden" name="SeekPos" value="<?php echo $SeekPos?>">
<input type="hidden" name="LAST" value="<?php echo $LAST?>">
<input type="hidden" name="media" value="<?php echo $media?>">
<input type="hidden" name="PAGES" value="<?php echo $PAGES?>">
<input type=hidden name=media value='<?=$media?>'>

<input type=hidden name=lib value='<?=$lib?>'>
<input type=hidden name=regt value='<?=$regt?>'>
<input type=hidden name=mtype value='<?=$mtype?>'>
<input type=hidden name=mode value='<?=$mode?>'>
<div align="center">
<table width="10%" border="0" cellspacing="2" cellpadding="1" align='center'>
<tr><td colspan="4" align="center">Go To
<input type="text" name="go_to" value="<?php echo  ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()" class="bgbutton"></td></tr>
 <tr>
	<td title="First"><a href="Javascript:first()"><<</td>
	<td title="Previous"><a href="Javascript:prev()"><</td>
	<td title="Next"><a href="Javascript:next()">></td>
	<td title="Last"><a href="Javascript:last()">>></td>
 </tr>
</table>
</div>
<div align="center">
Page <?php echo  ($SeekPos / $_NUMREC_) +1?> of <?php echo (int) $PAGES?></div>
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
</form>
</body>
</html>