<?php
include_once("../db.php");
$id=$_POST['id'];
$library=$_POST['library'];
$register=$_POST['register'];
$media=$_POST['media'];
$submit1=$_POST['submit1'];
$SeekPos=$_POST['SeekPos'];
$PAGES=$_POST['PAGES'];
$go_to=$_POST['go_to'];

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
echo "<div id='main_header' align='center'>";
$rs_col=execute("select * from college");
$r_col=fetcharray($rs_col);
$college=$r_col[col_name];
mysql_free_result($rs_col);

############ SET DEFAULT SERVER TIME-ZONE  ############### 
  $curdate=date('Y-m-d H:i:s');
  date_default_timezone_set('Asia/Calcutta');
  $date = date('m/d/Y h:i:s a', time());
  $timezone = date_default_timezone_get();
  //echo "The current server timezone is: " . $timezone;
##########################################################
echo "<div align='center' id='div_id2'>As on :". date('d-m-Y g:i:s:a')."</div>";
echo "<form name=form1 method=post onSubmit='frm_submit()'>";
echo "<div id='prn1'>";
echo "<input type='hidden' name=SeekPos value=$SeekPos>";
echo "<table  align='center' class=forumline width='47%'>";
echo "<tr><td align='center' Class='head' id='div_id1' colspan=3>Damaged Media Detail Report </td></tr>";

/*echo "<tr>";
echo "<td> ";
echo " Library";
echo "</td>";
echo "<td>";
$qry="select * from library_name";
$rs=execute($qry);
echo "<select name=library onChange='javascript:document.form1.submit()'>";
echo "<option value=0>Select Library</option>";
while($row=fetcharray($rs))
{
	if($row[id]==$library)
		$sel = "selected";
	else
		$sel = "";
	echo "<option value=$row[id] $sel>$row[name]</option>";
}
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
*/
$library=1;
if($library > 0)
{
	/*
	echo "<td align='left'>";
	echo "Register";
	echo "</td>";
	echo "<td>";
	$qry="select * from lib_register where library=$library";
	echo "<select name=register>";
	echo "<option value=0>ALL</option>";
	$ls=execute($qry) or die(error_description());
	for($ii=0;$ii < rowcount($ls);$ii++)
	{
		$lr=fetcharray($ls,$ii);
		if($lr[id]==$register)
			$sel = "selected";
		else
			$sel = "";
		echo "<option value=$lr[id] $sel>$lr[register]</option>";
	}
	echo "</select>";
	echo "</td>";
	echo "</tr>";
	*/
	$register=1;
	echo "<tr>";
	echo "<td align='right'>";
	echo " Media Type&nbsp;&nbsp;&nbsp;";
	echo "</td>";
	echo "<td>";
	$qry="select * from lib_mediatype";
	$rs=execute($qry);
	echo "<select name=media >";
	echo "<option value=''>Select Media</option>";
	while($row=fetcharray($rs))
	{
		if($row[id]==$media)
			$sel = "selected";
		else
			$sel = "";
		echo "<option value=$row[id] $sel>$row[name]</option>";
	}
	echo "</select>";
	echo "</td>";
	echo "</tr>";
	
}
echo "</table>";
echo "</div>";
echo "<p align='center'>";
echo "<input type=submit name=submit1 value='Search' class='bgbutton'>";
echo "</p>";
echo "</form>";
if($media=="")
{
	die();
}
if(isset($submit1))
{
	$ctr=0;
	echo "<center><table border=1 cellpadding=0 cellspacing=0 width=80% class=forumline>";
	echo "<tr><td class='head' align='center'>Sl.No.</td>";
	echo "<td class='head' align='center'>Accession No.</td>";
	echo "<td class='head' align='center'>Title</td>";
	if($media!=4)
		{
			echo "<td class='head' align='center'>Author</td>";
		}
    if($media==1)
		{
			echo "<td class='head' align='center'>Subject</td>";
		}
	else
		{
			echo "<td class='head' align='center'>Rack</td>";
		}
	if($media!=1 && $media!=5)
		{
			echo "<td class='head' align='center'>Source</td>";
		}
	if($media==1)
		{
			echo "<td class='head' align='center'>Publisher</td>";
		}
	if($media==5)
		{
			echo "<td class='head' align='center'>Guide Name</td>";	
		}
	if($media==5)
		{
			echo "<td class='head' align='center'>Class</td>";	
		}
	else
		{
			echo "<td class='head' align='center'>Price</td>";
		}
			echo"</tr>";
			$attribute="Accno";
}
if($register!=0)
{				
	if($media==1)  // Book
	{
		$qry="select a.*,b.acc_no from lib_book_details a,lib_acc_details b where b.mode='D' and b.book_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.register=$register order by b.acc_no ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='D' and b.cd_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.register=$register order by b.acc_no ";
	}
	elseif($media==3) //Book Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where  b.floppy_status='1' and b.mode='D' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.register=$register order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='D' and b.cd_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.register=$register order by b.acc_no ";
	}
	elseif($media==5) //Project Report
	{
		$qry="select a.*,b.acc_no from lib_project_report_det a,lib_proj_acc_det b where b.mode='D' and b.book_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.register=$register order by b.acc_no ";
	}
	elseif($media==6) //Bound Volume
	{
		$qry="select a.* from lib_bound_media_det a,lib_bound_acc_det b where b.mode='D' and b.bound_status='1' and ";
		$qry .=" b.master_id=a.id and b.library=$library and b.register=$register order by a.acc_no ";
	}
}
else
{
	if($media==1)  // Book
	{
		$qry="select a.*,b.acc_no from lib_book_details a,lib_acc_details b where b.mode='D' and b.book_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='D' and b.cd_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==3) //Book Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where b.mode='D' and b.floppy_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='D' and b.cd_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==5) //Project Report
	{
		$qry="select a.*,b.acc_no from lib_project_report_det a,lib_proj_acc_det b where b.mode='D' and b.book_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==6) //Bound Volume
	{
		$qry="select a.* from lib_bound_media_det a,lib_bound_acc_det b where b.mode='D' and b.bound_status='1' ";
		$qry .=" and b.master_id=a.id and b.library=$library order by a.acc_no ";
	}
}
$rs=execute($qry);
$countRS = rowcount($rs);
if($countRS==0)
{
	die("Record Not Found.");
}

		  data_seek($rs,$SeekPos); //Move the data pointer to the next position.
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

		    for($i=$SeekPos;$i<$MAX;$i++)
		    {
				$row = fetcharray($rs);
				echo "<tr><td align='center'>$slno</td>";
				echo "<td align='center'>$row[acc_no]</td>";
				echo "<td align='center'>$row[title]</td>";
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
				if($media!=1 && $media!=5)
					{
						echo "<td align='center'>$row[source]</td>";
					}
				if($media==1)
					{
						echo "<td align='center'>$row[publisher]</td>";
					}
				if($media==5)
					{
						echo "<td align='center'>$row[guide_name]</td>";	
					}
				if($media==5)
					{
						echo "<td align='center'>$row[class_name]</td>";	
					}
				else
					{
						echo "<td align='right'>$row[price]</td>";
					}
						echo"</tr>";
						$slno+=1;
		echo "</table></center>";
	}
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
           i = "<?=$PREV?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		}
		function next()
		{
		   var i;
           i = "<?=$NEXT?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		 }
		function last()
		{

           var i;
           i = "<?=$LAST?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		}
</script>
<form name="frm" action="dummyrpt.php">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="media" value="<?=$media?>">
<input type="hidden" name="library" value="<?=$library?>">
<input type="hidden" name="register" value="<?=$register?>">
<input type="hidden" name="submit1" value="<?=$submit1?>">
<input type="hidden" name="PAGES" value="<?=$PAGES?>">
<div id='prn2' align='center'>
<table width="10%" border="0" cellspacing="2" cellpadding="1" align='cener'>
   <tr>
	<td colspan="2" align="right">
	Go To
	</td>
	<td colspan="2" align="left">
	<input type="text" name="go_to" value="<?= ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
	<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()" class=bgbutton >
	</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
       <tr>
          <!--  <td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First"></a></td>
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
<div align='right'>
<small>

Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?>

</small>
</div>
</form>
<br>
<div id='prn' align='center'>
<input type="button" value="   Print   " name="B1"
	  onClick="printReport()" class=bgbutton>
</div>
</BODY>
</HTML>