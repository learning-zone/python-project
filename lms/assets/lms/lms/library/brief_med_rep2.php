<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
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
else
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
<table  align='center' class=forumline width="90%">
<tr><td class='rowpic' align='center' colspan=10>
Media Report</td></tr>
<tr><td class='row3' align="center">Sl No.</td>
<td class='row3' align="center">Journal No</td>
<td class='row3' align="center">Title</td>
<td class='row3' align="center">Journal Subscription No</td>
<td class='row3' align="center">Journal Date</td>
<td class='row3' align="center">Amount</td>
<td class='row3' align="center">Month</td></tr>
<?php
if($lib==1)
{    

	$ssql="select magazine_no,title,magazine_sub_no,magazine_date,amount,month,ssp_type from lib_magazine where  library='$lib' and magazine_no like 'J-%' ";
		
		if($regt!=0)
		$ssql.=" and register='$regt'";
	if($mode=='handcop')
		$ssql.=" and flag='0'";
	elseif($mode=='outcop')
		$ssql.=" and flag='1'";
	
	
}
else 
{
	$ssql="select magazine_no,title,magazine_sub_no,magazine_date,amount,month,ssp_type  from lib_magazine where magazine_no like 'J-%' ";
	
	if($regt!=0)
		$ssql.=" and register='$regt'";
	if($mode=='handcop')
		$ssql.=" and flag ='0'";
	elseif($mode=='outcop')
		$ssql.=" and flag ='1'";
	
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
		
		echo "<tr>";
		echo "<td align='center'>";
		$j=$i+1;
		echo "$slno";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r_sql[magazine_no]";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r_sql[title]";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r_sql[magazine_sub_no]";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r_sql[magazine_date]";
		echo "</td>";
		echo "<td align='center'>";
		echo "$r_sql[amount]";
			echo "</td>";?>
		<td><?php
		if($r_sql[month]==1)
{
echo "January";
}
if($r_sql[month]==2)
{
echo "Feburary";
}if($r_sql[month]==3)
{
echo "March";
}if($r_sql[month]==4)
{
echo "April";
}if($r_sql[month]==5)
{
echo "May";
}if($r_sql[month]==6)
{
echo "June";
}if($r_sql[month]==7)
{
echo "July";
}if($r_sql[month]==8)
{
echo "August";
}
if($r_sql[month]==9)
{
echo "Septmember";
}if($r_sql[month]==10)
{
echo "October";
}if($r_sql[month]==11)
{
echo "November";
}if($r_sql[month]==12)
{
echo "December";
}
		
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
<form name="frm" action="brief_med_rep2.php">
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
<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()"  ></td></tr>
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