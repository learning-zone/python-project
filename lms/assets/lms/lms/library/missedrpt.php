<?php
include_once("../db.php");
$id=$_POST['id'];
$SeekPos=$_POST['SeekPos'];
$library=$_POST['library'];
$register=$_POST['register'];
$media=$_POST['media'];
$mode=$_POST['mode'];
$submit1=$_POST['submit1'];
$PAGES=$_POST['PAGES'];

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
echo "<div align='center' id='div_id2'>As on :". date('d-m-Y g:i:s:a')."</div>";
echo "<div id='prn1'>";
echo "<form name=form1 method=post onSubmit='frm_submit()'>";
echo "<input type='hidden' name=SeekPos value=$SeekPos>";
echo "<table  align='center'class=forumline width='47%'>";
echo "<tr><td align='center' Class='head' id='div_id1' colspan=2>Missed Media Detail Report</td></tr>";
/*
echo "<tr><td>Library</td>";
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
	echo "<td>Register</td>";
	echo "<td>";
	$qry="select * from lib_register where library=$library";
	echo "<select name=register>";
	echo "<option value=0>---ALL---</option>";
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
	echo "<tr><td align='right'>Media Type &nbsp;</td>";
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
?>
<tr>
	<td align="right">Media Mode &nbsp;</td>
	<td>
	<select name="mode" onChange="fundir()">
	<?php
	if($mode=='')
		{
			$rt1="selected";
			$rt2="";
			$rt3="";
		}
	elseif($mode=='Issue Mode')
		{
			$rt1="";
			$rt2="selected";
			$rt3="";
		}
	elseif($mode=='Reference Mode')
		{
			$rt1="";
			$rt2="";
			$rt3="selected";	
		} 
?>			 	  
	<option value="0" <?=$rt1?>>Select</option>
	<option value="I" <?=$rt2?>>Issue Mode</option>
	<option value="R" <?=$rt3?>>Reference Mode</option>
	</select>
	</td>
</tr> 
<tr>
	
</tr>
<?php		
}
?>
</table>
<br>
<div align='center'><input type='submit' name='submit1' value='Search' class='bgbutton'></div>
</form></div>
<?php
if($media=="")
	{
		die();
	}
if(isset($submit1))
{
	$ctr=0;
	$c_date=date('d-m-Y');
	echo "<center><table border=1 cellpadding=0 cellspacing=0 width=90% class=forumline>";
	echo "<tr>";
	echo "<td class='head' align='center'>Sl.No.</td>";
	if($media != 6)
	{
		echo "<td class='head' align='center'>Accession No.</td>";
		echo "<td class='head' align='center'>Title</td>";
		if($media !=2 && $media !=4 && $media !=3)
		{
			echo "<td class='head' align='center'>Author</td>";
		}
		if($media !=5)
		{
			echo "<td class='head' align='center'>";
			if($media==1)
			{
				echo"Subject";
			}
			else
			{
				echo"Rack";
			}
			echo "</td>";
		}
		else
		{
			echo "<td class='head' align='center'>Guide Name</td>";
		}
		echo "<td class='head' align='center'>";
		if(($media != 2 ) && ($media != 4) && $media !=5 && $media !=3)
		{
			echo"Publisher";
		}
		else if($media !=5)
		{
			echo"Source";
		}
		echo "</td>";
		if($media !=5 && $media !=4 && $media !=2 && $media !=3)
		{
			echo "<td class='head' align='center'>Price</td>";
		}
		else if($media !=2 && $media !=4 && $media !=3)
		{
			echo "<td class='head' align='center'>Class</td>";
		}
	}
		elseif($media==6)
		{
			echo "<td class='head' align='center'>Accession No.</td>";
			echo "<td class='head' align='center'>Title</td>";
			echo "<td class='head' align='center'>Month/Year</td>";
		}
		echo "</tr>";
		$attribute="Accno";
	$register=1;
if($register!=0)
{
	if($media==1)  // Book
	{  
		$qry="select a.*,b.acc_no from lib_book_details a,lib_acc_details b where b.mode='M' and b.book_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library and b.book_type='$mode' order by b.acc_no ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='M' and b.cd_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library and b.cd_type='$mode' order by b.acc_no ";
	}
	elseif($media==3) //Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where b.mode='M' and b.floppy_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library and b.floppy_type='$mode' order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='M' and b.cd_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library and b.cd_type='$mode' order by b.acc_no ";
	}
	elseif($media==5) //Project Report
	{
		$qry="select a.*,b.acc_no from lib_project_report_det a,lib_proj_acc_det b where b.mode='M' and b.book_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library and b.book_type='$mode' order by b.acc_no ";
	}
	elseif($media==6) //Bound Media
	{
		$qry="select a.* from lib_bound_media_det a,lib_bound_acc_det b where b.mode='M' and b.bound_status='1' and ";
		$qry .=" b.register=$register and b.master_id=a.id and b.library=$library and b.bound_type='$mode' order by a.acc_no ";
	}
}
else
{
	if($media==1)  // Book
	{
		$qry="select a.*,b.acc_no from lib_book_details a,lib_acc_details b where b.mode='M' and b.book_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.book_type='$mode' order by b.acc_no ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='M' and b.cd_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.cd_type='$mode' order by b.acc_no ";
	}
	elseif($media==3) //Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where b.mode='M' and b.floppy_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.floppy_type='$mode' order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='M' and b.cd_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.cd_type='$mode' order by b.acc_no ";
	}
	elseif($media==5) //Project Report
	{
		$qry="select a.*,b.acc_no from lib_project_report_det a,lib_proj_acc_det b where b.mode='M' and b.book_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library and b.book_type='$mode' order by b.acc_no ";
	}
	elseif($media==6) //Bound Media
	{
		$qry="select a.* from lib_bound_media_det a,lib_bound_acc_det b where b.mode='M' and b.bound_status='1' and ";
		$qry .=" b.master_id=a.id and b.library=$library and b.bound_type='$mode' order by a.acc_no ";
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
		echo "<tr>";
		echo "<td align='center'>$slno</td>";
		if($media !=6)
			{
				echo "<td align='center'>$row[acc_no]</td>";
				echo "<td align='center'>$row[title]</td>";
				if($media !=2 && $media !=4 && $media !=3)
					{
						echo "<td align='center'>$row[author]</td>";
					}
				if($media !=5)
					{
						echo "<td align='center'>";
						if($media==1)
							{
								echo "$row[subject]";
							}
						else
							{
								echo "$row[rack]";
							}
						echo "</td>";
					}
				else
					{
						echo "<td align='center'>$row[guide_name]</td>";
					}
				echo "<td align='center'>";
				if(($media != 2 ) && ($media != 4 )&& ($media !=5) && ($media !=3))
					{
						echo "$row[publisher]";
					}
				else if($media !=2 && ($media !=5) && ($media !=3))
					{
						echo "$row[source]";
					}
				else
					{
						echo "$row[source_acc_no]";
					}
				echo "</td>";
				if($media !=5 && $media !=2 && $media !=4 && $media !=3)
					{
						echo "<td align='right'>$row[price]</td>";
					}
				else if($media !=2 && $media !=4 && $media !=3)
					{
						echo "<td align='left'>$row[course] - $row[class_name]</td>";
					}
			}
		elseif($media==6)
			{
				echo "<td align='center'>$row[acc_no]</td>";
				echo "<td align='center'>$row[title]</td>";
				echo "<td align='center'>$row[month]/$row[year]</td>";
			}
		echo "</tr>";
		$slno+=1;
	}
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
<form name="frm" action="missedrpt.php">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="media" value="<?=$media?>">
<input type="hidden" name="library" value="<?=$library?>">
<input type="hidden" name="register" value="<?=$register?>">
<input type="hidden" name="submit1" value="<?=$submit1?>">
<input type="hidden" name="PAGES" value="<?=$PAGES?>">

<div id='prn2' align='center'>
<table width="10%" border="0" cellspacing="2" cellpadding="1">
<tr>
	<td colspan="2" align="right">Go To</td>
	<td colspan="2" align="left"><input type="text" name="go_to" value="<?= ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
	<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()"></td>
</tr>
<tr>
</tr>
<tr>
	<!--<td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0" alt="First"></a></td>
    <td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0" alt="Previous"></a></td>
    <td><a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next" onMouseOver="Javascript:status='Next Page';"></a></td>
    <td><a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last" onMouseOver="Javascript:status='Last Page';"></a></td>-->
	<td title="First"><a href="Javascript:first()"><<</td>
	<td title="Previous"><a href="Javascript:prev()"><</td>
	<td title="Next"><a href="Javascript:next()">></td>
	<td title="Last"><a href="Javascript:last()">>></td>
</tr>
</table>
</div>
<div align="right"><small>Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></small></div>
</form>
<br>
<div id='prn' align='center'>
<input type="button" value="Print" name="B1" onClick="printReport()" style='background-color: #7599D0; color: #000000; font-weight: bold; border: 2 solid #000080; padding: 2'>
</div>
</BODY>
</HTML>