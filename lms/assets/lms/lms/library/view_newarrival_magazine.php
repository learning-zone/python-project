<?php
include_once("../db.php");
$id=$_POST['id'];
$submit1=$_POST['submit1'];
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
<!--<div  Class="Label" align="center"><small>New Arrival Magazine/Journal Detail Report </small></div>-->
<table width="100%" class='forumline' align='center'>
<tr><td class="head" align="center" colspan=2>New Arrival Magazine/Journal Detail Report</td></tr>
<tr><td class='rowpic' colspan=2>Media Type: Magazine/Journal Report</td></tr></table>
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
		echo "Sl.No.";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo "Title";
		echo "</td>";
        echo "<td class='head' align='center'>";
		echo "Rack";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo "Language";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo "Subject";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo "Magazine Date";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo "Volume No";
		echo "</td>";
		echo "<td class='head' align='center'>";
		echo "Issue No";
		echo "</td>";
	echo "</tr>";
	$attribute="Accno";
	//echo $register;

	if($register==14)
	{ 	$qry="select a.* from lib_newmagazine a where ";
		$qry .="a.status='1' and a.magazine_date between '$FromDate' and '$ToDate' order by a.magazine_date ASC";
	}
	else
	{
		$qry="select a.* from lib_magazine a where ";
		$qry .="a.status='1' and a.magazine_date between '$FromDate' and '$ToDate' order by a.magazine_date ASC";
	}
$rs=execute($qry);
$countRS = rowcount($rs);
if($countRS ==0)
{
	echo "There are no data to show in this view ";
	die();
}

  data_seek($rs,$SeekPos); //Move the data pointer to the next position.

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

  $slno=$SeekPos+1;

    for($i=$SeekPos;$i<$MAX;$i++){
          $row = fetcharray($rs);
//				$sno=1;
//				while($row=fetcharray($rs))
//				{
		echo "<tr>";
			echo "<td>";
			echo "$slno";
			echo "</td>";
			echo "<td>";
			echo "$row[title]";
			echo "</td>";
			echo "<td>";
			echo "$row[rack]";
			echo "</td>";
			echo "<td>";
			echo "$row[language]";
			echo "</td>";
			echo "<td>";
			echo "$row[subject]";
			echo "</td>";
			echo "<td align='left' nowrap>";
			$date_acq=explode("-",$row[magazine_date]);
			echo "$date_acq[2]-$date_acq[1]-$date_acq[0]";
			echo "</td>";
			echo "<td>";
			echo "$row[volume]";
			echo "</td>";
			echo "<td>";
			echo "$row[issue]";
			echo "</td>";
			echo "</tr>";
			$slno+=1;
		}
		echo "</table></center>";
?>
<script language="JavaScript">
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
<form name="frm" action="view_newarrival_magazine.php">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="media" value="<?=$media?>">
<input type="hidden" name="library" value="<?=$library?>">
<input type="hidden" name="submit1" value="<?=$submit1?>">
<input type="hidden" name="register" value="<?=$register?>">
<input type="hidden" name="DDay"  value="<?=$DDay?>">
<input type="hidden" name="DMon"  value="<?=$DMon?>">
<input type="hidden" name="DYear"  value="<?=$DYear?>">
<input type="hidden" name="subject"  value="<?=$subject?>">
<input type="hidden" name="TDay"  value="<?=$TDay?>">
<input type="hidden" name="TMon"  value="<?=$TMon?>">
<input type="hidden" name="TYear"  value="<?=$TYear?>">




<input type="hidden" name="sno" value="<?=$sno?>">
<input type="hidden" name="PAGES" value="<?=$PAGES?>">
<div align="left">
<table width="10%" border="0" cellspacing="2" cellpadding="1">
       <tr>
          <!-- <td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First"></a></td>
           <td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous">  </a></td>
           <td><a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next" onMouseOver="Javascript:status='Next Page';"></a></td>
           <td><a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last" onMouseOver="Javascript:status='Last Page';"></a></td>-->
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
</center>
</BODY>
</HTML>