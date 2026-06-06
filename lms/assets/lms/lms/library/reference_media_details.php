<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
include_once("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$PAGES=$_POST['PAGES'];
	$go_to=$_POST['go_to'];
	$media=$_POST['media'];
	$SeekPos=$_POST['SeekPos'];
	$submit1=$_POST['submit1'];
	$register=$_POST['register'];
	$media_mode=$_POST['media_mode'];
}
if($_GET and !$_POST)
{
    $id=$_GET['id'];
	$PAGES=$_GET['PAGES'];
	$go_to=$_GET['go_to'];
	$media=$_GET['media'];
	$SeekPos=$_GET['SeekPos'];
	$submit1=$_GET['submit1'];
	$register=$_GET['register'];
	$media_mode=$_GET['media_mode'];
}
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
function frm_submit()
{
	document.form1.SeekPos.value=0;
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
		div_id2.style.display = "none";
	}
	window.print();
	main_header.style.display ="";
	div_id1.style.display = "";
	div_id2.style.display = "";
	prn.style.display = "";

	prn1.style.display = "";
	prn2.style.display = "";
}

</script>
</head>
<body>
<?php
echo "<div id='main_header'>";
		$qry="select * from lib_register";
		$ls=execute($qry) or die(error_description());
		$rls=fetcharray($ls);
	############ SET DEFAULT SERVER TIME-ZONE  ############### 
       $curdate=date('Y-m-d H:i:s');
       date_default_timezone_set('Asia/Calcutta');
       $date = date('m/d/Y h:i:s a', time());
       $timezone = date_default_timezone_get();
       //echo "The current server timezone is: " . $timezone;
    ##########################################################
	echo "<div align='center' id='div_id2'>As on :". date('d-m-Y g:i:s:a')."</div>";
	echo "<div id='prn1'>";
	echo "<form name=form1 method=post onSubmit='frm_submit()'>";
	echo "<input type='hidden' name='SeekPos' value=$SeekPos>";
	echo "<table  align='center' class=forumline width='47%'>";
	echo "<tr><td align='center' Class='head' id='div_id1' colspan=3>Reference Media Details Report</td></tr>";
	
$register=1;
if($register > 0 || $register==-1)
{
	echo "<tr>";
	echo "<td align='right'>";
	echo " Media Type &nbsp;";
	echo "</td>";
	echo "<td>";
	?>
    <select name='media'>
     <option value='' >Select Media</option>
	  <?php
      $sqlMedia=execute("SELECT * FROM `lib_mediatype` ORDER BY id");
          while($row=fetcharray($sqlMedia))
          {
              if($media==$row['id'])
              echo "<option value='$row[id]' selected>$row[name]</option>";
              else
              echo "<option value='$row[id]' >$row[name]</option>";
          }
      ?>
      </select>
   <?
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align='right'>";
		echo " Media Mode&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<select name='media_mode'>";
		$sel="";
		if($media_mode =='I')
		$sel="selected";
		echo "<option value='I' $sel >Issue</option>";
		$sel="";
		if($media_mode =='R')
		$sel="selected";
		echo "<option value='R' $sel >Reference</option>";

		$sel="";
		if($media_mode =='T')
		$sel="selected";
		echo "<option value='T' $sel >Temp</option>";

		$sel="";
		if($media_mode =='S')
		$sel="selected";
		echo "<option value='S' $sel >Weed out</option>";
		echo "</select>";
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
echo "<p align=center>";
echo "<input type=submit name='submit1' value='Search' class='bgbutton'>";
echo "</p>";
echo "</form>";
echo "</div>";

if($media=="")
{
	die(); 
}
//This part to display reference media details
if($submit1)
{
$ctr=0;
echo "<center><table border=1 cellpadding=0 cellspacing=0 width=90% class=forumline>";
echo "<tr><td class='head' align='center' nowrap >Sl.No.</td>";
echo "<td class='head' align='center' nowrap>Accession No.</td>";
echo "<td class='head' align='center' nowrap>Title</td>";
if($media!=4)
	{
		echo "<td class='head' align='center' nowrap>Author</td>";
	}
if($media==1)
	{
		echo "<td class='head' align='center' nowrap>Subject</td>";
	}
else
	{
		echo "<td class='head' align='center' nowrap>Rack</td>";
	}
if($media!=1 && $media!=5 && $media!=6)
	{
		echo "<td class='head' align='center' nowrap>Source</td>";
	}
if($media==1 || $media==6)
	{
		echo "<td class='head' align='center' nowrap>Publisher</td>";
	}
if($media==5)
	{
		echo "<td class='head' align='center' nowrap>Guide Name</td>";	
		echo "<td class='head' align='center' nowrap>Class</td>";	
	}
else
	{
		echo "<td class='head' align='center' nowrap>Price</td>";
	}
echo"</tr>";
$attribute="Accno";
}
//echo "<p>Media Mode:$media_mode</p>";
//echo "<p>Register :$register</p>";
//echo "<p>Media:$media</p>";

if($register!=-1)
{
	if($media==1)  // Book
	{   
	    $register=1;
		$qry="select a.*,b.acc_no from lib_book_details a,lib_acc_details b where b.mode='A' and b.book_status='1' and ";
		$qry .=" b.book_type='$media_mode' and b.register=$register and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==2) //Book CD
	{   
	    $register=1;
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and b.cd_status='1' and ";
		$qry .=" b.register=$register and b.cd_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==3) //Book Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where b.mode='A' and b.floppy_status='1' and ";
		$qry .=" b.register=$register and b.floppy_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and b.cd_status='1' and ";
		$qry .=" b.register=$register and  b.cd_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==5) //Project Report
	{   
	    $register=1; 
		$qry="select a.*,b.acc_no from lib_project_report_det a,lib_proj_acc_det b where b.mode='A' and b.book_status='1' and ";
		$qry .=" b.register=$register and b.book_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==6) //Bound Media
	{
		$qry="select a.* from lib_bound_media_det a,lib_bound_acc_det b where b.mode='A' and b.bound_status='1' and ";
		$qry .=" b.bound_type='$media_mode'  and b.register=$register and b.master_id=a.id  order by a.acc_no ";
	}
	if($media==7)//question paper
	{
	$qry=" Select * from lib_question_paper_det  where register=$register order by year";
	}
}
else
{
	if($media==1)  // Book
	{
		$qry="select a.*,b.acc_no from lib_book_details a,lib_acc_details b where b.mode='A' and b.book_status='1' and ";
		$qry .=" b.book_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and b.cd_status='1' and ";
		$qry .=" b.cd_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==3) //Book Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where b.mode='A' and b.floppy_status='1' and ";
		$qry .=" b.floppy_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and b.cd_status='1' and ";
		$qry .=" b.cd_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==5) //Project Report

	{
		$qry="select a.*,b.acc_no from lib_project_report_det a,lib_proj_acc_det b where b.mode='A' and b.book_status='1' and ";
		$qry .=" b.book_type='$media_mode' and b.media_type=$media and b.master_id=a.id order by b.acc_no ";
	}
	elseif($media==6) //Bound Media
	{
		$qry="select a.* from lib_bound_media_det a,lib_bound_acc_det b where b.mode='A' and b.bound_status='1' and ";
		$qry .=" b.bound_type='$media_mode'  and b.master_id=a.id order by a.acc_no ";
	}
	if($media==7)//question paper
	{
	$qry=" Select * from lib_question_paper_det order by year";
	}
}
$rs=execute($qry);
$countRS = rowcount($rs); 
if($countRS==0)
{
	die("Record Not Found.");
}
 mysql_data_seek($rs,$SeekPos); //Move the data pointer to the next position.

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
$slno=$SeekPos+1;
for($i=$SeekPos;$i<$MAX;$i++){
	$row = fetcharray($rs);
	echo "<tr><td align='center'>$slno</td>";
	echo "<td align='center'>$row[acc_no]</td>";
	echo "<td align='left'>&nbsp;$row[title]</td>";
	if($media!=4)
		{
			echo "<td align='center'>$row[author]</td>";
		}
	if($media==1)
		{
			echo "<td align='center'>$row[subject]</td>";
		}
	else
		{
			echo "<td align='center'>$row[rack]</td>";
		}
	if($media!=1 && $media!=5 && $media!=6)
		{
			echo "<td align='center'>$row[source]</td>";
		}
	if($media==1 || $media==6)
		{
			echo "<td align='center'>$row[publisher]</td>";
		}
	if($media==5)
		{
			echo "<td align='center'>$row[guide_name]</td>";	
			echo "<td align='center'>$row[class_name]</td>";	
		}
	else
		{
			echo "<td align='right'>$row[price]</td>";
		}
	$slno+=1;
	echo"</tr>";
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
		document.frm.SeekPos.value = (parseInt(document.frm.go_to.value)-1)* 20;
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
<form name="frm" action="reference_media_details.php">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="media" value="<?=$media?>">
<!--<input type="hidden" name="library" value="<?=$library?>">-->
<input type="hidden" name="register" value="<?=$register?>">
<input type="hidden" name="submit1" value="<?=$submit1?>">
<input type="hidden" name="PAGES" value="<?=$PAGES?>">
<input type="hidden" name="media_mode" value="<?=$media_mode?>">
<div id='prn2' align="center">
<table width="10%" border="0" cellspacing="2" cellpadding="1">
<tr>
	<td colspan="4" align="center">
	Go To
	
	<input type="text" name="go_to" value="<?= ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
	<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()" class=bgbutton >
	</td>
	</tr>
       <tr>
            <!--<td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First"></a> </td>
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
<br>
<div id='prn' align='center'>
<input type="button" value="   Print   " name="B1"  onClick="printReport()" class=bgbutton>
</div>
</BODY>
</HTML>