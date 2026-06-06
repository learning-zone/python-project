<?php
include_once("../db.php");
$id=$_POST['id'];
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
$SeekPos=$_POST['SeekPos'];
$sno=$_POST['sno'];
$PAGES=$_POST['PAGES'];
$go_to=$_POST['go_to'];
if(!checkdate($DMon,$DDay,$DYear))
{
echo "Invalid From Date. ";
die("</td></tr></table>");
}
$FromDate = "$DYear-$DMon-$DDay";
if(!checkdate($TMon,$TDay,$TYear)){
echo "Invalid To Date. ";
die("</td></tr></table>");
}
$ToDate = "$TYear-$TMon-$TDay";

$_NUMREC_ = 15; // Number of result per page;

//Set the initial seek position
if(empty($SeekPos)){
        $SeekPos = 0;
}
?>
<html>
<head></head>
<body>
<?php
	if($media==7)
	{
	?>
	<!--
		<div class="head" align="center"><small>New Arrival CD Details Report </small></div>
		<table width="100%">
		<tr>
		<td>
		Media Type:CD
		</td>-->
	    <table width="100%" class=forumline align=center>
        <tr><td class="head" align="center" colspan=2>New Arrival CD Details Report </td></tr>
        <tr><td class='rowpic' colspan=2>Media Type: CD</td></tr>

	<?
	}
	else
	{
	?>
	<!--
		<div class="head" align="center"><small>New Arrival Book CD Details Report </small></div>
		<table width="100%">
		<tr>
		<td>
			Media Type:Book CD
		</td>
		</tr>-->
	    <table width="100%" class=forumline align=center>
        <tr><td class="head" align="center" colspan=2>New Arrival CD Details Report </td></tr>
        <tr><td class='rowpic' colspan=2>Media Type:CD</td></tr>
	<?
	}
	
	//Purpose: if condition added to check whether selected option is all or not if not then proceed with report to display for particular register
	//other wise dispaly for all register
if($register!=0)
{
$qry="select * from lib_register where id=$register";
$ls=execute($qry) or die(error_description());
$rls=fetcharray($ls);
}
if($register!=0)
{
	$reg=$rls[register];
}else
{
	$reg="All";
}
?>
<!--<tr>
<td>Register=<?=$reg?></td>
<td align='right'>As on : <?=date('d-m-Y')?></td>
</tr>-->
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
echo "<td class='head' align='center'>";
echo"Sl.No.";
echo "</td>";
echo "<td class='head' align='center'>";
echo"Title";
echo "</td>";
echo "<td class='head' align='center'>";
echo "Rack";
echo "</td>";
if($media ==7)
{
echo "<td class='head' align='center'>";		
echo "price";
echo "</td>";
}
echo "<td class='head' align='center'>";
echo "Copies";
echo "</td>";
echo "</tr>";
$attribute="Accno";

//Purpose: if condition added to check whether selected option is all or not if not then proceed with report to display for particular register
//other wise dispaly for all register
if($register!=0)
{
$qry="select distinct(b.master_id) from  lib_cd_acc_det b,lib_cd_det a where ";
$qry .=" b.register=$register and b.mode='A' and b.cd_status='1' and b.media_type=$media and b.master_id=a.id and a.date_of_acquiring between '$FromDate' and '$ToDate' order by a.date_of_acquiring ASC";
}else
{
$qry="select distinct(b.master_id) from  lib_cd_acc_det b,lib_cd_det a where ";
$qry .=" b.mode='A' and b.cd_status='1' and b.media_type=$media and b.master_id=a.id and a.date_of_acquiring between '$FromDate' and '$ToDate' order by a.date_of_acquiring ASC";
}
$t4=execute($qry);
$countRS = rowcount($t4);

if($countRS==0)
{
	die("Record Not Found.");
}
  data_seek($t4,$SeekPos); //Move the data pointer to the next position.

  if( ($SeekPos + $_NUMREC_) > $countRS){
        $MAX = $countRS;
  }else{
        $MAX = $SeekPos + $_NUMREC_ ;
  }
  if( ($SeekPos + $_NUMREC_) >= $countRS){
        $NEXT = $SeekPos;
  }else{
        $NEXT  = $SeekPos + $_NUMREC_ ;
  }
  if( ($SeekPos - $_NUMREC_)  > 0){
        $PREV = $SeekPos - $_NUMREC_;
  }else{
        $PREV = 0;
  }
  $PAGES = $countRS / $_NUMREC_;

  if($countRS % $_NUMREC_){
        $PAGES++;
  }

  $LAST = ((int) $PAGES - 1) * $_NUMREC_;
    for($i=$SeekPos;$i<$MAX;$i++){
          $row = fetcharray($t4);
	$sql2="select * from lib_cd_det where id=$row[master_id]";
	$rs22=execute($sql2);
	$r22=fetcharray($rs22);
	$sql="select count(*) from lib_cd_acc_det where master_id=$row[master_id]";
	$rs=execute($sql);
	$r=fetcharray($rs,0);
	echo "<tr>";
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
			echo "$r22[rack]";
		echo "</td>";
		if($media==7)
		{
			echo "<td align='right'>";
						echo "$r22[price]";
			echo "</td>";
		}
		echo "<td align='right'>";
				echo "$r[0]";
			echo "</td>";
		echo "</tr>";
		$sno+=1;
		$total=$total+$r[0];
	}
		if($media !=7)
		{
			echo "<td colspan=3 align=right>";
		}
		else
		{
			echo "<td colspan=4 align=right>";
		}
			echo " Total";
			echo "</td>";
			echo "<td align=right>";
			echo " $total";
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
<form name="frm" action="view_newarrival_bookcd.php">
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
	Go To
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
           <!-- <td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First"></a></td>
            <td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous">  </a></td>
            <td><a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next" onMouseOver="Javascript:status='Next Page';"></a></td>
            <td><a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last" onMouseOver="Javascript:status='Last Page';"> </a></td>-->
			<td title="First"><a href="Javascript:first()"><<</td>
			<td title="Previous"><a href="Javascript:prev()"><</td>
			<td title="Next"><a href="Javascript:next()">></td>
			<td title="Last"><a href="Javascript:last()">>></td>
       </tr>
</table>
</div>
<div align="center">
<small>

Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?>

</small>
</div>
</form>
</BODY>
</HTML>