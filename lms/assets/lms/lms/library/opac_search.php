<html>
<head>
<?php
session_start();
include("../db.php");
include("../urlaccess.php");
$_NUMREC_ = 20; // Number of result per page;
//Set the initial seek position
if(empty($SeekPos))
{
        $SeekPos = 0;
}
?>
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
	div_id2. style.display = "";
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
	echo "<div align='center' id='div_id2'><b>As on :</b>". date('d-m-Y g:i:s:a')."</div>";
	echo "<div id='prn1'>";
	echo "<form name=form1 method=post onSubmit='frm_submit()'>";
	echo "<input type='hidden' name=SeekPos value=$SeekPos>";
	echo "<table  align='center' class=forumline>";
	echo "<tr><td align='center' Class='head' id='div_id1' colspan=3>Media Detail Report </td></tr>";
	echo "<tr>";
	echo "<td> <font face=Arial><b>";
	echo " Library";
	echo "</font></b></td>";
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
					echo "<option value='$row[id]' $sel>$row[name]</option>";
				}
			echo "</select>";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
		if($library > 0)
		{
			echo "<td>";
			echo "<font face=Arial><b>Register</b></font>";
			echo "</td>";
			echo "<td>";
			$qry="select * from lib_register where library=$library";
			echo "<select name=register>";
			echo "<option value=0>All</option>";
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
				echo "<tr>";
				echo "<td><font face=Arial><b>";
				echo " Media Type";
				echo "</font></b></td>";
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
						$sel="";
						if($media=='magazine')
						{
							$sel='selected';
						}
						echo "<option value='magazine' $sel >Magazines/Journals</option>";
				echo "</select>";
				echo "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan=2 align=center>";
				echo "<input type=submit name=submit1 value='Search' class=bgbutton>";
				echo "</td>";
				echo "</tr>";
			}
		echo "</table>";
		echo "</form>";
		echo "</div>";
		if($media=="")
		{
			die();
		}
if(isset($submit1))
{
	$ctr=0;
	$c_date=date('d-m-Y');
	echo "<center><table border=1 cellpadding=0 cellspacing=0 width=100% class=forumline>";
	if($media != 'magazine' && $media !=6)
	{
		echo "<tr><td class=rowpic align='center'>Sl.No.</td>";
		echo "<td class=rowpic align='center'>Accession No.</td>";
		echo "<td class=rowpic align='center'>Title</td>";
		if($media!=4)
			{
				echo "<td class=rowpic align='center'>Author</td>";
			}
		if($media==1)
			{
				echo "<td class=rowpic align='center'>Subject</td>";
			}
		else
			{
				echo "<td class=rowpic align='center'>Rack</td>";
			}
		if($media!=1 && $media!=5)
			{
				echo "<td class=rowpic align='center'>Source</td>";
			}
		if($media==1)
			{
				echo "<td class=rowpic align='center'>Publisher</td>";
			}
		if($media==5)
			{
				echo "<td class=rowpic align='center'>Guide Name</td>";	
			}
		if($media==5)
			{
				echo "<td class=rowpic align='center'>Class</td>";	
			}
		else
			{
				echo "<td class=rowpic align='center'>Price</td>";
			}
		echo "<td class=rowpic align='center'>ISBN No</td>";
		echo"</tr>";
		$attribute="Accno";
	}

elseif($media=='magazine')		
	{
		echo "<tr>";
		echo "<td class=rowpic align='center'>Magazine No.</td>";
		echo "<td class=rowpic align='center'>Title</td>";
		echo "<td class=rowpic align='center'>Magazine Date</td>";
		echo "<td class=rowpic align='center'>Price</td>";
		echo "<td class=rowpic align='center'>ISBN No</td>";
		echo "</tr>";
	}
	else
	{
		echo "<tr>";
		echo "<td class=rowpic align='center'>Accession No</td>";
		echo "<td class=rowpic align='center'>Title</td>";
		echo "<td class=rowpic align='center'>Month Year</td>";
		echo "<td class=rowpic align='center'>Date of Acquiring</td>";
		echo "</tr>";
	}
if($register!=0)
{
	if($media==1)  // Book
	{
		$qry="select a.*,b.acc_no from lib_book_details a,lib_acc_details b where b.mode='A' and b.book_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and b.cd_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==3) //Book Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where b.mode='A' and b.floppy_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and b.cd_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==5) //Project Report
	{
		$qry="select a.*,b.acc_no from lib_project_report_det a,lib_proj_acc_det b where b.mode='A' and b.book_status='1' and ";
		$qry .=" b.register=$register and b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==6) //Bound Media
	{
		$qry="select * from lib_bound_media_det a,lib_bound_acc_det b where b.mode='A' and b.bound_status='1' and ";
		$qry .=" b.register=$register and b.master_id=a.id and b.library=$library order by a.acc_no ";
	}
	else
	{
		if($register==14)
		{
			$qry=" Select * from lib_newmagazine where bound='N' and register=$register order by magazine_date";
		}
		else
		{
			$qry=" Select * from lib_magazine where bound='N' and register=$register order by magazine_date";
		}
	}
	
}
else
{
	if($media==1)  // Book
	{
		$qry="select a.*,b.acc_no from lib_book_details a,lib_acc_details b where b.mode='A' and b.book_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and b.cd_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==3) //Book Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where b.mode='A' and b.floppy_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select a.*,b.acc_no from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and b.cd_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==5) //Project Report
	{
		$qry="select a.*,b.acc_no from lib_project_report_det a,lib_proj_acc_det b where b.mode='A' and b.book_status='1' and ";
		$qry .=" b.media_type=$media and b.master_id=a.id and b.library=$library order by b.acc_no ";
	}
	elseif($media==6) //Bound Media
	{
		$qry="select * from lib_bound_media_det a,lib_bound_acc_det b where b.mode='A' and b.bound_status='1' and ";
		$qry .=" b.master_id=a.id and b.library=$library order by a.acc_no ";
	}
	else
	{
		if($register==14)
		{
			$qry=" Select * from lib_newmagazine where bound='N' order by magazine_date";
		}
		else
		{
			$qry=" Select * from lib_magazine where bound='N' order by magazine_date";
		}
	}
}
$rs=execute($qry);
$countRS = rowcount($rs);
if($countRS==0)
{
	die("<font color=red>Record Not Found.</font>");
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
	if($media != 'magazine' && $media !=6)
	{
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
		echo "<td align='center'>$row[isbn]</td>";
		echo"</tr>";
		$attribute="Accno";
	}

elseif($media=='magazine')		
	{
		echo "<td align='center'>$row[magazine_no]</td>";
		echo "<td align='center'>$row[title]</td>";
		echo "<td align='center'>";
		$magazine_date=date('d-m-Y',strtotime($row[magazine_date]));
		echo "$magazine_date";
		echo "</td>";
		echo "<td align='right'>$row[amount]</td>";
	}
	else
	{
		$sql_qry=" select * from lib_magazine where magazine_no=$row[mag_acc_no]";
		$sqr=execute($sql_qry);
		$sqr1=fetcharray($sqr);
		echo "<td align='center'>$row[acc_no]</td>";
		echo "<td align='center'>$row[title]</td>";
		echo "<td align='center'>$row[month]/$row[year]</td>";
		echo "<td align='center'>";
		$magazine_date=date('d-m-Y',strtotime($sqr1[magazine_date]));
		echo "$magazine_date";
		echo "</td>";
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
           i = "<?php echo $PREV?>";
           document.frm.SeekPos.value = i;
           document.frm.submit();
         }
         function next()
		{
           var i;
           i = "<?php echo $NEXT?>";
           document.frm.SeekPos.value = i;
           document.frm.submit();
         }
		function last()
		{
           var i;
           i = "<?php echo $LAST?>";
           document.frm.SeekPos.value = i;
           document.frm.submit();
         }
</script>
<form name="frm" action="opac_search.php">
<input type="hidden" name="id" value="<?php echo $id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="media" value="<?php echo $media?>">
<input type="hidden" name="library" value="<?php echo $library?>">
<input type="hidden" name="register" value="<?php echo $register?>">
<input type="hidden" name="submit1" value="<?php echo $submit1?>">
<input type="hidden" name="PAGES" value="<?php echo $PAGES?>">
<div id='prn2' align='center'>
<table width="10%" border="0" cellspacing="2" cellpadding="1">
<tr>
	<td colspan="2" align="right"><b>Go To</b></td>
	<td colspan="2" align="left">
	<input type="text" name="go_to" value="<?php echo  ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
	<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()" class=bgbutton >
	</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
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
                alt="Next" onmouseover="Javascript:status='Next Page';">  </a>
            </td>
            <td>
                <a href="Javascript:last()">
                <img src="../images/lastbtn.gif" border="0"
                alt="Last" onmouseover="Javascript:status='Last Page';"> </a>
            </td>
       </tr>
</table>
</div>
<div align="right">
<small>
<b>
Page <?php echo  ($SeekPos / $_NUMREC_) +1?> of <?php echo (int) $PAGES?>
</b>
</small>
</div>
</form>
<br>
<div id='prn' align='center'>
<input type="button" value="   Print   " name="B1"  onClick="printReport()" class=bgbutton>
</div>
</BODY>
</HTML>