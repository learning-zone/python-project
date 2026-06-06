<html>
<head>
<?
include("../db.php");
if($_POST)
{
	$SeekPos=$_POST['SeekPos'];
}
if($_GET)
{
	$SeekPos=$_GET['SeekPos'];
}

if(!checkdate($DMon,$DDay,$DYear))
{
echo "<font color=royalblue;><b>Invalid From Date.</b> </font>";
die("</td></tr></table>");
}
$FromDate = "$DYear-$DMon-$DDay";
if(!checkdate($TMon,$TDay,$TYear)){
echo "<font color=royalblue;><b>Invalid To Date.</b> </font>";
die("</td></tr></table>");
}
$ToDate = "$TYear-$TMon-$TDay";

$_NUMREC_ = 15; // Number of result per page;

//Set the initial seek position
if(empty($SeekPos)){
        $SeekPos = 0;
}

?>
</head>
<body>
<div  Class="Label" align="center"><small><b>New Arrival Bound Volume Details Report </b></small></div>
<table width="100%">
<tr>
<td>
<b>Media Type:</b>Bound Volume
</td>
</tr>
<?
$qry="select * from lib_register where id=$register";
$ls=execute($qry) or die(error_description());
$rls=fetcharray($ls);

if($register!=0){
	$reg=$rls[register];
}else{
	$reg="ALL";
}
?>
<tr>
<td><b>Register=</b><?=$reg?></td>
<td align='right'><b>As on :</b> <?=date('d-m-Y')?></td>
</tr>
</table>
<?
echo "<center>";
if($media=="")
{
	die();
}
$ctr=0;
echo "<center><table border=1 cellpadding=0 cellspacing=0 width=100%>";
echo "<tr>";
echo "<td>";
	echo"<b>Sl.No.</b>";
echo "</td>";
echo "<td>";
	echo"<b>Title</b>";
echo "</td>";
echo "<td>";
	echo "<b>Month/Year</b>";
echo "</td>";
echo "<td>";
	echo "<b>Periodicity</b>";
echo "</td>";
echo "<td>";
	echo "<b>Date of Acquiring </b>";
echo "</td>";
echo "<td>";
	echo "<b>Copies</b>";
echo "</td>";

echo "</tr>";
$attribute="Accno";
if($register!=0)
{
$qry="select distinct(b.master_id) from  lib_bound_acc_det b,lib_bound_media_det a where ";
$qry .=" b.register=$register and b.mode='A' and b.bound_status='1' and b.master_id=a.id and a.date_of_acquiring between '$FromDate' and '$ToDate' order by a.date_of_acquiring ASC";
}else
{
$qry="select distinct(b.master_id) from  lib_bound_acc_det b,lib_bound_media_det a where ";
$qry .=" b.mode='A' and b.bound_status='1' and b.master_id=a.id and a.date_of_acquiring between '$FromDate' and '$ToDate' order by a.date_of_acquiring ASC";
}

$t4=execute($qry);
$countRS = rowcount($t4);
if($countRS==0)
{
	die("<font color=red>Record Not Found.</font>");
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
	$sql2="select * from lib_bound_media_det where id=$row[master_id]";
	$rs22=execute($sql2);
	$r22=fetcharray($rs22);
	$sql="select count(*) from lib_bound_acc_det where master_id=$row[master_id]";
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
		echo "$r22[month]/$r22[year]";
	echo "</td>";
	echo "<td align='left'>";
	if($r22[periodicity]=="D")
	{
		$periodicity="Daily";
	}
	elseif($r22[periodicity]=="W")
	{
		$periodicity="Weekly";
	}
	elseif($r22[periodicity]=="M")
	{
		$periodicity="Monthly";
	}
	elseif($r22[periodicity]=="F")
	{
		$periodicity="Fortnightly";
	}
	elseif($r22[periodicity]=="Q")
	{
		$periodicity="Quatarly";
	}
	elseif($r22[periodicity]=="Y")
	{
		$periodicity="Yearly";
	}
		echo "$periodicity";
	echo "</td>";
	echo "<td align='left'>";
			echo date('d-m-Y',strtotime($r22[date_of_acquiring]));
	echo "</td>";
	echo "<td align='right'>";
		echo "$r[0]";
	echo "</td>";
	echo "</tr>";

	$sno+=1;
	$total=$total+$r[0];
}
echo "<td colspan=5 align=right>";
echo "<b> Total</b>";
echo "</td>";
echo "<td align=right>";
	echo "<b> $total</b>";
echo "</td>";

echo "</table></center>";

?>
<script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function checkIt(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) {
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
		document.frm.SeekPos.value = (parseInt(document.frm.go_to.value)-1)* 15;
		document.frm.submit();
	}



}
         function first(){

           var i;
           i = 0;

           document.frm.SeekPos.value = i;
           document.frm.submit();


         }

         function prev(){

           var i;
           i = "<?=$PREV?>";

           document.frm.SeekPos.value = i;
           document.frm.submit();


         }

         function next(){

           var i;
           i = "<?=$NEXT?>";

           document.frm.SeekPos.value = i;
           document.frm.submit();


         }



         function last(){

           var i;
           i = "<?=$LAST?>";

           document.frm.SeekPos.value = i;
           document.frm.submit();



         }
</script>
<form name="frm" action="view_newarrival_bound_volume.php">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="media" value="<?=$media?>">
<input type="hidden" name="library" value="<?=$library?>">
<input type="hidden" name="register" value="<?=$register?>">
<input type="hidden" name="DDay"  value="<?=$DDay?>">
<input type="hidden" name="DMon"  value="<?=$DMon?>">
<input type="hidden" name="DYear"  value="<?=$DYear?>">

<input type="hidden" name="TDay"  value="<?=$TDay?>">
<input type="hidden" name="TMon"  value="<?=$TMon?>">
<input type="hidden" name="TYear"  value="<?=$TYear?>">



<input type="hidden" name="sno" value="<?=$sno?>">
<input type="hidden" name="PAGES" value="<?=$PAGES?>">
<div align="center">
<table width="10%" border="0" cellspacing="2" cellpadding="1">
<tr>
	<td colspan="2" align="right">
	<b>Go To</b>
	</td>
	<td colspan="2" align="left">
	<input type="text" name="go_to" value="<?= ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
	<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()"  >
	</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
       <tr>
            <td>
             <a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First">                   </a>
            </td>
            <td>
                <a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous">  </a>
            </td>
            <td>
                <a href="Javascript:next()">
                <img src="../images/nextbtn.gif" border="0"
                alt="Next" onMouseOver="Javascript:status='Next Page';">  </a>
            </td>
            <td>

                <a href="Javascript:last()">
                <img src="../images/lastbtn.gif" border="0"
                alt="Last" onMouseOver="Javascript:status='Last Page';"> </a>
            </td>
       </tr>
</table>
</div>
<div align="center">
<small>
<b>
Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?>
</b>
</small>
</div>
</form>
</BODY>
</HTML>