<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
require_once("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$sno=$_POST['sno'];
	$TDay=$_POST['TDay'];
	$TMon=$_POST['TMon'];
	$FDay=$_POST['FDay'];
	$FMon=$_POST['FMon'];
	$FYear=$_POST['FYear'];
	$TYear=$_POST['TYear'];
	$media=$_POST['media'];
	$PAGES=$_POST['PAGES'];
	$go_to=$_POST['go_to'];
	$SeekPos=$_POST['SeekPos'];
	$submit1=$_POST['submit1'];
	$register=$_POST['register'];
	$media_mode=$_POST['media_mode'];
}
if($_GET)
{
	$sno=$_GET['sno'];
	$TDay=$_GET['TDay'];
	$TMon=$_GET['TMon'];
	$FDay=$_GET['FDay'];
	$FMon=$_GET['FMon'];
	$FYear=$_GET['FYear'];
	$media=$_GET['media'];
	$TYear=$_GET['TYear'];
	$PAGES=$_GET['PAGES'];
	$go_to=$_GET['go_to'];
	$SeekPos=$_GET['SeekPos'];
	$register=$_GET['register'];
	$media_mode=$_GET['media_mode'];
}
$_NUMREC_ = 20; // Number of result per page;

//Set the initial seek position
if(empty($SeekPos))
{
    $SeekPos = 0;
}

if($media ==1)
	$media_name='Book';
elseif($media==2)
	$media_name="CD's";
elseif($media==5)
	$media_name="Project Report";
elseif($media==6)
	$media_name='Bound Volume';
elseif($media==7)
	$media_name='Magazine/Journals';

if($media_mode=='I')
	$media_mode_type='Issue';
else
	$media_mode_type='Reference';

if(!checkdate($FMon,$FDay,$FYear))
{
	echo "Invalid From Date. ";
	die("</td></tr></table>");
}
 $from_date = "$FYear-$FMon-$FDay";
 
if(!checkdate($TMon,$TDay,$TYear))
{
	echo "Invalid To Date. ";
	die("</td></tr></table>");
}
 $to_date = "$TYear-$TMon-$TDay";
 

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
	}
	window.print();
	main_header.style.display ="";
	div_id1.style.display = "";
	prn.style.display = "";
	prn1.style.display = "";
	prn2.style.display = "";
}
</script>
</head>
<body>
<div id='prn1'><a href="media_usage_analysis.php"><font color="#FFFFFF">Go Back </font></a>
</div>
<?
echo "<div id='main_header'>";
if($register !="")
{
	$qry="select * from lib_register where id=$register";
	$ls=execute($qry);
	$rls=fetcharray($ls);
	echo "<div align='center'> $rls[collage_name]</div>";
	echo "<br>";
}
echo "</div>";
//echo "<div id='div_id1'>";
echo "<center><table  width='90%' class=forumline>";
//echo "<tr><td colspan=2>";
echo "<tr><td class=head colspan=3 align=center>$media_mode_type $media_name Usage Analyis </td></tr>";
echo "</td></tr>";
echo "<tr>";
/*
echo "<td>";
echo "Register:";
if($register!=-1)
{
$rs_sql=execute("select * from lib_register where id=$register");
$r_sql=fetcharray($rs_sql);
echo "$r_sql[register]";
}else
{
echo "ALL";
}
echo "</td>";
*/
$Register=1;
echo "<td align='left'>";
$c_date=date('d-m-Y');
echo "As On $c_date ";
echo "</td></tr>";
echo "<tr><td colspan=2 align='center'>";
echo "From : ";
print date('d-m-Y',strtotime($from_date));
echo "  To : ";
print date('d-m-Y',strtotime($to_date));

echo "</td></tr>";
echo "</table>";
echo "</div>";
	$ctr=0;
	echo "<center><table border=1 cellpadding=0 cellspacing=0 class='forumline' width='90%'>";
	echo "<tr>";
	echo "<tr>";
	echo "<td class='head' align='center'>";
		echo"Sl.No.";
	echo "</td>";
	echo "<td class='head' align='center'>";
		echo"Title";
	echo "</td>";
	if($media !=2 && $media !=6 && $media !=7  )
	{
		echo "<td class='head' align='center'>";
			echo "Author";
		echo "</td>";
		echo "<td class='head' align='center'>";
			echo "Publisher";
		echo "</td>";
	}
	if($media==5)
	{
		echo "<td class='head' align='center'>";
			echo "Guide Name";
		echo "</td>";
	}
	if($media==6)
	{
		echo "<td class='head' align='center'>";
			echo "Month/Year";
		echo "</td>";
	}
	echo "<td class='head' align='center' nowrap>";
	echo"No.of Times Used";
	echo "</td>";
	echo "</tr>";
	$attribute="Accno";
	
	
if($register!=-1)
{
	if($media==1)
	{    
	    $register=1;		
		$qry="select distinct(b.master_id) from  lib_acc_details b,lib_book_details a where ";
		$qry .=" b.book_type='$media_mode' and b.register=$register and a.id=b.master_id AND b.flag >0 order by master_id ";
		//echo $qry;
		
	}
	elseif($media==2)
	{
	    $register=1;
		$qry="select distinct(b.master_id) from  lib_cd_acc_det b,lib_cd_det a where ";
		$qry .=" b.cd_type='$media_mode' and b.register=$register and a.id=b.master_id AND b.flag >0 order by master_id ";

	}
	elseif($media==5)
	{
	    $register=1;
		$qry="select distinct(b.master_id) from  lib_proj_acc_det b,lib_project_report_det a where ";
		$qry .=" b.book_type='$media_mode' and b.register=$register and a.id=b.master_id AND b.flag >0 order by master_id ";
	}
	else if($media ==6)
	{
		$qry="select distinct(b.master_id) from  lib_bound_acc_det b,lib_bound_media_det a where ";
		$qry .=" b.bound_type='$media_mode' and b.register=$register and a.id=b.master_id AND b.flag >0 order by master_id ";
	}
	else
	{ 
	    
		//$qry="select distinct(title) from  lib_magazine  where ";
		//$qry .=" bound='N' and  register=$register order by title";
		$qry="select distinct(title) from  lib_magazine  where ";
		$qry .=" bound='N' order by title";
	}
}
else
{
	if($media==1)
	{   
		$qry="select distinct(b.master_id) from  lib_acc_details b,lib_book_details a where ";
		$qry .=" b.book_type='$media_mode' and a.id=b.master_id AND b.flag >0 order by master_id ";
		
	}
	elseif($media==2)
	{
		$qry="select distinct(b.master_id) from  lib_cd_acc_det b,lib_cd_det a where ";
		$qry .=" b.cd_type='$media_mode' and a.id=b.master_id AND b.flag >0 order by master_id ";

	}
	elseif($media==5)
	{
		$qry="select distinct(b.master_id) from  lib_proj_acc_det b,lib_project_report_det a where ";
		$qry .=" b.book_type='$media_mode' and a.id=b.master_id AND b.flag >0 order by master_id ";
	}
	else if($media ==6)
	{
		$qry="select distinct(b.master_id) from  lib_bound_acc_det b,lib_bound_media_det a where ";
		$qry .=" b.bound_type='$media_mode' and a.id=b.master_id AND b.flag >0 order by master_id ";
	}
	else
	{
		$qry="select distinct(title) from  lib_magazine  where ";
		$qry .=" bound='N' order by title";
	}
}
$t4=execute($qry);
$countRS = rowcount($t4);

if($countRS==0)
{
	die("Record Not Found.");
}
  mysql_data_seek($t4,$SeekPos); //Move the data pointer to the next position.
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
for($i=$SeekPos;$i<$MAX;$i++)
{
    	$row = fetcharray($t4,$i);
    	if($media==1)
    	{
		$sql2="select * from lib_book_details where id=$row[master_id]";
		$rs22=execute($sql2);
		$r22=fetcharray($rs22);
		if($media_mode=='R')
		{
			$sql="select count(a.id) as no_count from lib_reference_media_trans a,lib_acc_details b where a.acc_no=b.acc_no and b.master_id=$row[master_id] and a.trans_date between '$from_date' and '$to_date' AND b.flag >0";
			//echo $sql;
		}
		else
		{
			$sql="select count(a.id), b.flag as no_count from lib_circulation_r a,lib_acc_details b where a.acc_id=b.acc_no and b.master_id=$row[master_id] and a.issue_date between '$from_date' and '$to_date' AND b.flag >0";
			//echo $sql;
			//echo "<br>";
		}
		$rs=execute($sql);
	}
	elseif($media==2)
	{
		$sql2="select * from lib_cd_det where id=$row[master_id]";
		$rs22=execute($sql2);
		$r22=fetcharray($rs22);
		if($media_mode=='R')
		{
			$sql="select count(a.id) as no_count from lib_reference_media_trans a,lib_cd_acc_det b where a.acc_no=b.acc_no and b.master_id=$row[master_id] and a.trans_date between '$from_date' and '$to_date' AND b.flag >0";
		}
		else
		{
			$sql="select count(a.id) as no_count from lib_circulation_r a,lib_cd_acc_det b where a.acc_id=b.acc_no and b.master_id=$row[master_id] and a.issue_date between '$from_date' and '$to_date' AND b.flag >0";
		}
		$rs=execute($sql);
	}
	elseif($media==5)
	{
		$sql2="select * from lib_project_report_det where id=$row[master_id]";
		$rs22=execute($sql2);
		$r22=fetcharray($rs22);
		if($media_mode=='R')
		{
			$sql="select count(a.id) as no_count from lib_reference_media_trans a,lib_proj_acc_det b where a.acc_no=b.acc_no and b.master_id=$row[master_id] and a.trans_date between '$from_date' and '$to_date' AND b.flag >0";
		}
		else
		{
			$sql="select count(a.id) as no_count from lib_circulation_r a,lib_proj_acc_det b where a.acc_id=b.acc_no and b.master_id=$row[master_id] and a.issue_date between '$from_date' and '$to_date' AND b.flag >0";
		}
		$rs=execute($sql);
	}
	elseif($media==6)
	{

		$sql2="select * from lib_bound_media_det where id=$row[master_id]";

		$rs22=execute($sql2);
		$r22=fetcharray($rs22);
		if($media_mode=='R')
		{
			$sql="select count(a.id) as no_count from lib_reference_media_trans a,lib_bound_media_det b where a.acc_no=b.acc_no and b.id=$row[master_id] and a.trans_date between '$from_date' and '$to_date'";
		}
		else
		{
			$sql="select count(a.id) as no_count from lib_circulation_r a,lib_bound_media_det b where a.acc_id=b.acc_no and b.id=$row[master_id] and a.issue_date between '$from_date' and '$to_date'";
		}
		$rs=execute($sql);
	}
	else
	{
		$sql2="select * from lib_magazine where bound='N' and title='$row[title]'";
		$rs22=execute($sql2);
		$r22=fetcharray($rs22);
		if($media_mode=='R')
		{
			$sql="select count(a.id) as no_count from lib_reference_media_trans a,lib_magazine b where b.bound='N' and a.acc_no=b.magazine_no and b.title='$row[title]' and a.trans_date between '$from_date' and '$to_date'";
		}
		$rs=execute($sql);
	}

		if(rowcount($rs)>0)
		{
			$r=fetcharray($rs);
			$count=$r[0];
			if($count==0)
			{
				$count=1; 
			}
				
		}
		else
		{
			$count=1;
		}

		echo "<tr>";
		echo "<td align=center>";
			$temp_i=strval($i)+1;
			echo "$temp_i";
		echo "</td>";
		$title=$r22['title'];
		echo "<td>";
			echo "$title";
		echo "</td>";

		if($media !=2 && $media !=6 && $media !=7 )
		{
			echo "<td>";
				echo "$r22[author]";
			echo "</td>";

			if($media==1)
			{
				echo "<td>";
				echo "$r22[publisher]";
				echo "</td>";
			}
			elseif($media==5)
			{
					/*echo "<td>";
						echo "$r22[college]";
					echo "</td>";*/
			    echo "<td>";
				     echo "$r22[publisher]";
				echo "</td>";
				
					echo "<td>";
						echo "$r22[guide_name]";
					echo "</td>";
			}


		}
		elseif($media==6)
		{
			echo "<td>";
				echo "$r22[month]/$r22[year]";
			echo "</td>";
		}
		echo "<td align='right'>";
			echo "$count";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;</td>";
		echo "</tr>";


				$sno+=1;
				$total=$total + $count;

			}
			if($media ==1)
				$col=4;
			elseif($media ==2 ||  $media ==7)
				$col=2;
			elseif($media==5 )
				$col=5;
			elseif($media==6)
				$col=3;
			elseif($media==9)
				$col=2;
				//echo "<p>Media :$media</p>";
					echo "<td colspan=$col align=right>";

			echo " Total";
			echo "</td>";
			echo "<td align=right>";
			echo " $total";
			echo "&nbsp;&nbsp;</td>";


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
<form name="frm" action="view_media_usage_analysis.php">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="SeekPos">
<input type="hidden" name="media" value="<?=$media?>">
<input type="hidden" name="register" value="<?=$register?>">
<input type="hidden" name="submit1" value="<?=$submit1?>">
<input type="hidden" name="sno" value="<?=$sno?>">
<input type="hidden" name="PAGES" value="<?=$PAGES?>">
<input type="hidden" name="media_mode" value="<?=$media_mode?>">
<input type="hidden" name="FYear" value="<?=$FYear?>">
<input type="hidden" name="FMon" value="<?=$FMon?>">
<input type="hidden" name="FDay" value="<?=$FDay?>">
<input type="hidden" name="TDay" value="<?=$TDay?>">
<input type="hidden" name="TMon" value="<?=$TMon?>">
<input type="hidden" name="TYear" value="<?=$TYear?>">
<div id='prn2' align="center">
<table width="10%" border="0" cellspacing="2" cellpadding="1">
<tr>
	<td colspan="4" align="center">Go To
	
	<input type="text" name="go_to" value="<?= ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
	<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()" class=bgbutton >
	</td>
	</tr>
       <tr>
	       <!-- <td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First"> </a></td>
            <td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous"></a></td>
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
<br>
<div id='prn' align='center'>
<input type="button" value="   Print   " name="B1" onClick="printReport()" class=bgbutton>
</div>
</BODY>
</HTML>