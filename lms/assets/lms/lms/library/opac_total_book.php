<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
require_once("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$sno=$_POST['sno'];
	$media=$_POST['media'];
	$PAGES=$_POST['PAGES'];
	$go_to=$_POST['go_to'];
	$Search=$_POST['Search'];
	$SeekPos=$_POST['SeekPos'];
	$library=$_POST['library'];
	$register=$_POST['register'];
}
else
{
	$id=$_GET['id'];
	$sno=$_GET['sno'];
	$media=$_GET['media'];
	$PAGES=$_GET['PAGES'];
	$go_to=$_GET['go_to'];
	$Search=$_GET['Search'];
	$SeekPos=$_GET['SeekPos'];
	$library=$_GET['library'];
	$register=$_GET['register'];
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
	document.frm.SeekPos.value=0;
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
<?
	echo "<div id='main_header'>";
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
	echo "<div id='prn1'>";
	echo "<form name='forms' action='opac_total_book.php'>";
	echo "<table  align='center' class=forumline width='47%'>";
	echo "<tr><td align='center' Class='head' id='div_id1' colspan=2>Total Media Detail Report </td></tr>";
	/*
	echo "<tr>";
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
	*/
//echo "<tr>";

$library  =1;
	if($library > 0)
	{
		/*
		echo "<td>";
		echo "Register";
		echo "</td>";
		echo "<td>";
		$qry="select * from lib_register where library=$library";
		echo "<select name=register >";
		echo "<option value=0>All</option>";
		$ls=execute($qry) or die(error_description());
		for($ii=0;$ii < rowcount($ls);$ii++)
		{
			$lr=fetcharray($ls,$ii);
			if($lr[id]==$register)
			{

				$sel = "selected";
			}
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
				$sel="";
				if($media=='magazine')
				{
					$sel='selected';
				}
			echo "<option value='magazine' $sel >Magazines/Journals</option>";
			echo "</select>";
		echo "</td>";
		echo "</tr>";
}
?>
</table>
</div>
<p align='center'><input type="submit" name="Search" value="Search" class="bgbutton"></p>
</form>
<?
if($media=="")
{
	die();
}
if(isset($Search))
{
	$ctr=0;
	echo "<center><table border=1 cellpadding=0 cellspacing=0 class='forumline' width='60%' >";
	echo "<tr>";
	echo "<tr>";
	echo "<td class='head' align='center'>";
		echo"Sl.No.";
	echo "</td>";

	echo "<td class='head' align='center'>";
			echo"Title";
	echo "</td>";
	if($media !='magazine' && $media !=4)
	{
		echo "<td class='head' align='center'>Author</td>";
	}
	if($media==1)
	{
		echo "<td class='head' align='center'>Subject</td>";
		echo "<td class='head' align='center'>Publisher</td>";
	}
	if($media!=1)
	{
		echo "<td class='head' align='center'>Rack</td>";
		if($media!=5)
			{
				echo "<td class='head' align='center'>Source</td>";
			}
	}
	if($media!=5)
	{
		echo "<td class='head' align='center'>Price</td>";
	}
	
	if($media==5)
	{
		echo "<td class='head' align='center'>Guide</td>";
		echo "<td class='head' align='center'>Class</td>";
	}
		echo "<td class='head' align='center'>No.of Copies</td></tr>";
}

$attribute="Accno";
//echo "<p>Media :$media</p>";
if($register!=0)
{
	if($media==1)  // Book
	{
		$qry="select distinct(b.master_id) from  lib_acc_details b where ";
		$qry .=" b.media_type=$media and b.register=$register order by register ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select distinct(b.master_id) from  lib_cd_acc_det b where ";
		$qry .=" b.media_type=$media and b.register=$register order by master_id ";
	}
	elseif($media==3) //Book Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where ";
		$qry .="b.mode='A' and b.floppy_status='1' and b.register=$register and b.media_type=$media and b.master_id=a.id  order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select distinct(b.master_id) from  lib_cd_acc_det b where ";
		$qry .=" b.media_type=$media and b.register=$register order by master_id ";
	}
	elseif($media==5) //Project Report
	{
		$qry="select distinct(b.master_id) from  lib_proj_acc_det b where ";
		$qry .=" b.media_type=$media and b.register=$register order by master_id ";
	}
	elseif($media==6)
	{
		$qry="select distinct(a.title) from lib_bound_media_det a ,lib_bound_acc_det b where b.register=$register and b.master_id=a.id";
	}
	elseif($media=='magazine') //magazine/journals
	{   
	    //echo "<p>Media :$media</p>";
		echo $qry="select distinct(title) from lib_magazine";
	}
}
else
{
	if($media==1)  // Book
	{
		$qry="select distinct(b.master_id) from  lib_acc_details b where ";
		$qry .=" b.media_type=$media order by register ";
	}
	elseif($media==2) //Book CD
	{
		$qry="select distinct(b.master_id) from  lib_cd_acc_det b where ";
		$qry .=" b.media_type=$media order by master_id ";
	}
	elseif($media==3) //Book Floppy
	{
		$qry="select a.*,b.acc_no from lib_floppy_det a,lib_floppy_acc_det b where ";
		$qry .="b.mode='A' and b.floppy_status='1' and b.media_type=$media and b.master_id=a.id  order by b.acc_no ";
	}
	elseif($media==4) //Other CD
	{
		$qry="select distinct(b.master_id) from  lib_cd_acc_det b where ";
		$qry .=" b.media_type=$media order by master_id ";
	}
	elseif($media==5) //Project Report
	{
		$qry="select distinct(b.master_id) from  lib_proj_acc_det b where ";
		$qry .=" b.media_type=$media order by master_id ";
	}
	elseif($media==6) 
	{
		$qry="select distinct(a.title) from lib_bound_media_det a ,lib_bound_acc_det b where b.master_id=a.id";
	}
	elseif($media=='magazine') //magazine/journals
	{
		$qry="select distinct(title) from lib_magazine ";
	}
}
		$t4=execute($qry);
		$countRS = rowcount($t4);
		
		if($countRS==0)
		{
			die("Record Not Found.");
		}
      mysql_data_seek($t4,$SeekPos); //Move the data pointer to the next position.
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
		if($media==1)  // Book
			{
				$sql2="select * from lib_book_details where id=$row[master_id] order by title asc ";
				$rs22=execute($sql2);
				$r22=fetcharray($rs22);
				$sql="select count(*) from lib_acc_details where master_id=$row[master_id]";
				$rs=execute($sql);
				$r=fetcharray($rs,0);
			}
		elseif($media==2)
			{
				$sql2="select * from lib_cd_det where id=$row[master_id]";
				$rs22=execute($sql2);
				$r22=fetcharray($rs22);
				$sql="select count(*) from lib_cd_acc_det where master_id=$row[master_id]";
				$rs=execute($sql);
				$r=fetcharray($rs,0);

			}
		elseif($media==3)
			{
				$sql2="select * from lib_floppy_det where id=$row[id]";				
				$rs22=execute($sql2);
				$r22=fetcharray($rs22);
				$sql="select count(*) from lib_floppy_acc_det where master_id=$row[id]";
				$rs=execute($sql);
				$r=fetcharray($rs,0);
			}
		elseif($media==4) //Other Cd
			{
				$sql2="select * from lib_cd_det where id=$row[master_id]";
				$rs22=execute($sql2);
				$r22=fetcharray($rs22);
				$sql="select count(*) from lib_cd_acc_det where master_id=$row[master_id]";
				$rs=execute($sql);
				$r=fetcharray($rs,0);
			}
		elseif($media==5) //Project
			{
				$sql2="select * from lib_project_report_det where id=$row[master_id]";
				$rs22=execute($sql2);
				$r22=fetcharray($rs22);
				$sql="select count(*) from lib_proj_acc_det where master_id=$row[master_id]";
				$rs=execute($sql);
				$r=fetcharray($rs,0);
			}
		elseif($media==6)  //Bound Media
			{
				$sql=" select count(*) from lib_bound_media_det where title='$row[title]'";
				$rs=execute($sql);
				$r=fetcharray($rs,0);
			}
		elseif($media=='magazine') //magazines
			{
				$sql2="select * from lib_magazine where title='$row[title]'";
				$rs22=execute($sql2);
				$r22=fetcharray($rs22);
				$sql=" select count(*) from lib_magazine where title='$row[title]'";
				$rs=execute($sql);
				$r=fetcharray($rs,0);
			}
			
echo "<tr>";
echo "<td align='center'>";
$temp_i=strval($i)+1;
echo "$temp_i";
echo "</td>";
if($media !='magazine' && $media  !=6)
	{
		$title=$r22[title];
	}
else
	{
		$title=$row[title];
	}
	echo "<td align='center'>$title</td>";

if($media !='magazine' && $media !=4)
	{
		echo "<td align='center'>$r22[author]</td>";
	}
if($media==1)
	{
		echo "<td align='center'>$r22[subject]</td>";
		echo "<td align='center'>$r22[publisher]</td>";
	}
if($media!=1)
	{
		echo "<td align='center'>$r22[rack]</td>";
		if($media!=5)
			{
				echo "<td align='center'>$r22[source]</td>";
			}
	}
if($media!=5)
	{
		if($media=='magazine')
			{
				echo "<td align='right'>$r22[amount]</td>";
			}
		else
			{
				echo "<td align='right'>$r22[price]</td>";
			}
	}
	
if($media==5)
	{
		echo "<td align='center'>$r22[guide_name]</td>";
		echo "<td align='center'>$r22[class_name]</td>";
	}
		echo "<td align='center'>$r[0]</td></tr>";
		echo "</tr>";
		$sno+=1;
		$total=$total+$r[0];
}
if($media =='magazine' || $media==4)
{
	echo "<td colspan=5 align=right>";
}
else
{
	echo "<td colspan=6 align=right>";
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

	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT )
	{
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
<form name="frm" action="opac_total_book.php">
<input type="hidden" name="id" value="<?=$id?>" >
<input type="hidden" name="SeekPos" value="<?=$SeekPos?>" >
<input type="hidden" name="media" value="<?=$media?>" >
<input type="hidden" name="library" value="<?=$library?>" >
<input type="hidden" name="register" value="<?=$register?>" >
<input type="hidden" name="Search" value="<?=$Search?>" >
<input type="hidden" name="sno" value="<?=$sno?>" >
<input type="hidden" name="PAGES" value="<?=$PAGES?>" >
<div id='prn2' align='center'>
<br>
<table width="10%" border="0" cellspacing="2" cellpadding="1">
<tr>
	<td colspan="4" align="center">
	Go To
	
<input type="text" name="go_to" value="<?php echo  ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()" class="bgbutton">
</td>
  </tr>
       <tr>
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
<div id='prn' align='center'>
<input type="button" value="   Print   " name="B1"  onClick="printReport()" class='bgbutton'>
</div>
</form>
</BODY>
</HTML>