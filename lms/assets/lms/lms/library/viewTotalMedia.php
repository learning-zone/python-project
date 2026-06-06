<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
session_start();
require_once("../db.php");

$val=$_POST['val'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$DYear=$_POST['DYear'];
$TYear=$_POST['TYear'];
$accNo=$_POST['accNo'];
$media=$_POST['media'];
$attrib=$_POST['attrib'];
$a_name=$_POST['a_name'];
$member=$_POST['member'];
$library=$_POST['library'];
$action1=$_POST['action1'];
$action=$_REQUEST['action'];
$register=$_POST['register'];


$rs_col=execute("select * from college");
$r_col=fetcharray($rs_col);
$college=$r_col[col_name];
mysql_free_result($rs_col);
?>
<HTML>
<HEAD>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = " ";
}
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=1200,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</HEAD>
<BODY>
<?php
if($register!=0)
{
	$qry="select * from lib_register where id=$register";
}
else
{   
	$qry="select * from lib_register";
}
$ls=execute($qry) or die(mysql_error());
$rls=fetcharray($ls);
//echo "<div align='center'> </div>";
//echo "<br>";
if($register!=0)
{
	$reg=$rls[register];
}
else
{
	$reg="All";
}

$lib_n = execute("select name from library_name where id=$library");
$lib_r = fetcharray($lib_n);
?>
<!--<div align="center"><?=$college?></div><br>-->
<div align='center' >As on : <?=date('d-m-Y g:i:s:a')?><div>
<table width="70%" align="center" class=forumline>
<?php
/*
<tr><td align="center" Class="head" colspan=2>Library&nbsp;:
<?php if($library==0){
echo "All";
}else{ echo $lib_r[name]; 
}?></td><td align="center" Class="head" colspan=4>Register&nbsp;:<?php echo $reg?></td></tr>
*/
$library=1;
$Register=1;
?>
<tr><td align="center" Class="head" colspan=4>Media Summary</td></tr>
<tr>
<td align="center" class="rowpic">Media</td>
<td align="center" class="rowpic" nowrap>Total Copies</td>
<td align="center" class="rowpic" nowrap>Copies in Hand</td>
<td align="center" class="rowpic" nowrap>Copies Out</td>
</tr>

<?php
$total = 0;
$outno=0;
$inhand=0;
$sql="select * from lib_mediatype ";
$rs=execute($sql);

while($r=fetcharray($rs))
{	
	if($library>0)
	{
		if($register!=0)
		{
			
			if($r[0]==1) // Book
			{
				
				$sql1="select count(*) as total_media from lib_acc_details where media_type=$r[0] and library=$library and register=$register and book_status='1' and mode <> 'M'";
				//echo $sql1; 
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$cnt=$r1[0];
				$total_media=$r1[total_media];
				$sql2="select count(*) as total_media_out from lib_acc_details where media_type=$r[0] and library=$library and register=$register and book_status='1' and flag >0 and mode <> 'M'";
				//echo $sql2;
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			else if($r[0]==2) // Book CD
			{
							//echo $sql1;
				$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and library=$library and register=$register and cd_status='1' and flag='0' and mode <> 'M'";
			
             	$rs1=execute($sql1);
				
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_cd_acc_det where media_type=$r[0] and library=$library and register=$register and cd_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			else if($r[0]==4) // Other CD
			{
				$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and library=$library and register=$register and cd_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_cd_acc_det where media_type=$r[0] and library=$library and register=$register and cd_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			elseif($r[0]==5) // Project Report
			{
				$sql1="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and library=$library and register=$register and book_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_proj_acc_det where media_type=$r[0] and library=$library and register=$register and book_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			elseif($r[0]==6) // Bound Volume
			{
				$sql1="select distinct(master_id) as total_media from lib_bound_acc_det where library=$library and register=$register and bound_status='1' and mode <> 'M' ";
				$rs1=execute($sql1);
				$total_media=rowcount($rs1);

				$sql2="select distinct(a.id) as total_media_out from lib_bound_media_det a,lib_bound_acc_det b where a.id=b.master_id and b.library=$library and b.register=$register and b.bound_status='1' and a.flag='1' and b.mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=rowcount($rs2);
			}
			elseif($r[0]==3) // Book Floppys
			{
				$sql1="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and library=$library and register=$register and floppy_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_floppy_acc_det where media_type=$r[0] and library=$library and register=$register and floppy_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
		}//end of if condition
		else
		{
			if($r[0]==1) // Book
			{
				$sql1="select count(*) as total_media from lib_acc_details where media_type=$r[0] and library=$library and book_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];
				//echo "<br>".$sql1;

				$sql2="select count(a.id) as total_media_out from lib_acc_details a, lib_circulation_m b where a.media_type=$r[0] and a.library=$library and a.book_status='1' and a.flag >0 and a.mode <> 'M' AND a.acc_no=b.acc_id ";
				
				//echo "<br>".$sql2;
				
				$rs2=execute($sql2);
				
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			else if($r[0]==2) // Book CD
			{
				$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and library=$library and cd_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_cd_acc_det where media_type=$r[0] and library=$library and cd_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			else if($r[0]==4) // Other CD
			{
				$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and library=$library and cd_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_cd_acc_det where media_type=$r[0] and library=$library and cd_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			elseif($r[0]==5) // Project Report
			{
				$sql1="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and library=$library and book_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_proj_acc_det where media_type=$r[0] and library=$library and book_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			elseif($r[0]==6) // Bound Volume
			{
				$sql1="select distinct(master_id) as total_media from lib_bound_acc_det where library=$library and bound_status='1' and mode <> 'M' ";
				$rs1=execute($sql1);
				$total_media=rowcount($rs1);

				$sql2="select distinct(a.id) as total_media_out from lib_bound_media_det a,lib_bound_acc_det b where a.id=b.master_id and b.library=$library and b.bound_status='1' and a.flag='1' and b.mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=rowcount($rs2);
			}
			elseif($r[0]==3) // Book Floppys
			{
				$sql1="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and library=$library and floppy_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_floppy_acc_det where media_type=$r[0] and library=$library and floppy_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
		}//end of else of register
	}
	else
	{
		if($register!=0)
		{
			if($r[0]==1) // Book
			{
				$sql1="select count(*) as total_media from lib_acc_details where media_type=$r[0] and register=$register and book_status='1' and mode <> 'M'";
				//echo $sql1; 
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];
				$sql2="select count(*) as total_media_out from lib_acc_details where media_type=$r[0] and register=$register and book_status='1' and flag='1' and mode <> 'M' ";
				//echo $sql2;
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			else if($r[0]==2) // Book CD
			{
				$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			else if($r[0]==4) // Other CD
			{
				$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_cd_acc_det where media_type=$r[0] and register=$register and cd_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			elseif($r[0]==5) // Project Report
			{
				$sql1="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and register=$register and book_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_proj_acc_det where media_type=$r[0] and register=$register and book_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			elseif($r[0]==6) // Bound Volume
			{
				$sql1="select distinct(master_id) as total_media from lib_bound_acc_det where register=$register and bound_status='1' and mode <> 'M' ";
				$rs1=execute($sql1);
				$total_media=rowcount($rs1);

				$sql2="select distinct(a.id) as total_media_out from lib_bound_media_det a,lib_bound_acc_det b where a.id=b.master_id and b.register=$register and b.bound_status='1' and a.flag='1' and b.mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=rowcount($rs2);
			}
			elseif($r[0]==3) // Book Floppys
			{
				$sql1="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and register=$register and floppy_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_floppy_acc_det where media_type=$r[0] and register=$register and floppy_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);

				$total_media_out=$r2[total_media_out];
			}
		}//end of if condition
		else
		{
			if($r[0]==1) // Book
			{
				$sql1="select count(*) as total_media from lib_acc_details where media_type=$r[0] and book_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_acc_details where media_type=$r[0] and book_status='1' and flag='1' and mode <> 'M' ";
				
				$rs2=execute($sql2);
				
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			else if($r[0]==2) // Book CD
			{
				$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and cd_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_cd_acc_det where media_type=$r[0] and cd_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			else if($r[0]==4) // Other CD
			{
				$sql1="select count(*) as total_media from lib_cd_acc_det where media_type=$r[0] and cd_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_cd_acc_det where media_type=$r[0] and cd_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			elseif($r[0]==5) // Project Report
			{
				$sql1="select count(*) as total_media from lib_proj_acc_det where media_type=$r[0] and book_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_proj_acc_det where media_type=$r[0] and book_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
			elseif($r[0]==6) // Bound Volume
			{
				$sql1="select distinct(master_id) as total_media from lib_bound_acc_det where bound_status='1' and mode <> 'M' ";
				$rs1=execute($sql1);
				$total_media=rowcount($rs1);

				$sql2="select distinct(a.id) as total_media_out from lib_bound_media_det a,lib_bound_acc_det b where a.id=b.master_id and b.bound_status='1' and a.flag='1' and b.mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=rowcount($rs2);
			}
			elseif($r[0]==3) // Book Floppys
			{
				$sql1="select count(*) as total_media from lib_floppy_acc_det where media_type=$r[0] and floppy_status='1' and mode <> 'M'";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1);
				$total_media=$r1[total_media];

				$sql2="select count(*) as total_media_out from lib_floppy_acc_det where media_type=$r[0] and floppy_status='1' and flag='1' and mode <> 'M'";
				$rs2=execute($sql2);
				$r2=fetcharray($rs2);
				$total_media_out=$r2[total_media_out];
			}
		}//end of else of register
	}
	?>
	
	<tr height='30'>
	<td width="150" class="cbody">&nbsp;&nbsp;<?=$r["name"]?>
	<td width="100" align="center" class="cbody">
	<?php
	if($total_media>0)
	{
		?>
	<a href="javascript:OpenWind('brief_med_rep.php?media=<?=$r[id]?>&lib=<?=$library?>&regt=<?=$register?>&mode=tcop');"><?=$total_media?>
	<?php
		
		echo "</a>";
	}
	else
	{
		echo $total_media;
		echo "</td>";
	}
	?>
	<td width="100" align="center" class="cbody">
	<?php
	if(intval($total_media) - intval($total_media_out)>0)
	{
		?>
	
	<!--<a href="javascript:OpenWind('brief_med_rep.php?media=<?= $r[id]?>&lib=<?=$library?>&regt=<?=$register?>&mode=handcop');"><?=intval($total_media) - intval($total_media_out)?>-->
    <?=intval($total_media) - intval($total_media_out)?>
	<?php
		
		echo "</a>";
	}
	else
	{
		echo intval($total_media) - intval($total_media_out);
		echo "</td>";
	}
	?>
	
	<td width="100" align="center" class="cbody">
	<?php
	if($total_media_out>0)
	{
		?>
	
<a href="javascript:OpenWind('brief_med_rep.php?media=<?= $r[id]?>&lib=<?=$library?>&regt=<?=$register?>&mode=outcop');"><?=$total_media_out?>
 <?php
		
		echo "</a>";
	}
	else
	{
		echo $total_media_out;
		echo "</td>";
	}
	?>
 
  </tr>
	

	
	
	<?php

	$tcop = $tcop + ($total_media);
	$outcop=$outcop+ ($total_media_out);
	$handcop=$handcop+ ($total_media- $total_media_out);
}
if($library>0)
{
	if($register!=0) //Magazine//	
	{
		$mag="select count(*) as total_media from lib_magazine where library=$library and register=$register and magazine_no like 'M%'";
		$sql1="select count(*) as total_media from lib_magazine where library=$library and register=$register and magazine_no like 'M%' and flag=0";
		$msg="select count(*) as total_media from lib_magazine where library=$library and register=$register and magazine_no like 'M%' and flag=1";
	}
	else
	{
		$mag="select count(*) as total_media from lib_magazine where library=$library and magazine_no like 'M%'";
		$sql1="select count(*) as total_media from lib_magazine where library=$library and magazine_no like 'M%' and flag=0";
		$msg="select count(*) as total_media from lib_magazine where library=$library and magazine_no like 'M%' and flag=1";
	}
}
else
{
	$mag="select count(*) as total_media from lib_magazine where magazine_no like 'M%'";
	$sql1="select count(*) as total_media from lib_magazine where magazine_no like 'M%' and flag=0";
	$msg="select count(*) as total_media from lib_magazine where magazine_no like 'M%' and flag=1";
}
$mag1=execute($mag);
$mag2=fetcharray($mag1);

$rs1=execute($sql1);
$r1=fetcharray($rs1);

$msg1=execute($msg);
$msg2=fetcharray($msg1);

if($library>0)
{
	if($register>0) //Journal//
	{
		$jur="select count(*) as total_media from lib_magazine where library=$library and register=$register and magazine_no like 'J%'";

		$sql2="select count(*) as total_media from lib_magazine where library=$library and register=$register and magazine_no like 'J%' and flag=0";
		
		$nal="select count(*) as total_media from lib_magazine where library=$library and register=$register and magazine_no like 'J%' and flag=1";
	}
	else
	{
		$jur="select count(*) as total_media from lib_magazine where library=$library and magazine_no like 'J%'";
		
		$sql2="select count(*) as total_media from lib_magazine where library=$library and magazine_no like 'J%' and flag=0";

		$nal="select count(*) as total_media from lib_magazine where library=$library and magazine_no like 'J%' and flag=1";
	}	
}
else
{
	$jur="select count(*) as total_media from lib_magazine where magazine_no like 'J%'";
		
	$sql2="select count(*) as total_media from lib_magazine where magazine_no like 'J%' and flag=0";

	$nal="select count(*) as total_media from lib_magazine where magazine_no like 'J%' and flag=1";
}
$jur1=execute($jur);
$jur2=fetcharray($jur1);

$rs12=execute($sql2);
$r12=fetcharray($rs12);

$nal1=execute($nal);
$nal2=fetcharray($nal1);
?>


<tr  height='30'>
	<td width="150" class="cbody">&nbsp;&nbsp;Magazine</td>
	<td width="100" align="center" class="cbody">
	<?php
	if($mag2[0]>0)
	{
		?>
	<a href="javascript:OpenWind('brief_med_rep3.php?lib=<?=$library?>&regt=<?=$register?>&mode=tcop');"><?php echo $mag2[0] ?>
	<?php
		
		echo "</a></td>";
	}
	else
	{
	echo $mag2[0];
	echo"</td>";
	}
	?>
	<td width="100" align="right" class="cbody">
	<?php
	if($r1[0]>0)
	{
		?>
		
		
	<a href="javascript:OpenWind('brief_med_rep3.php?lib=<?=$library?>&regt=<?=$register?>&mode=handcop');"><?php echo $r1[0] ?>
	<?php
		
		echo "</a>";
	}
	else
	{
		echo $r1[0];
		echo "</td>";
	}
	?>
	<td width="100" align="right" class="cbody">
	<?php
	if($msg2[0]>0)
	{
		?>
	<a href="javascript:OpenWind('brief_med_rep3.php?lib=<?=$library?>&regt=<?=$register?>&mode=outcop');"><?php echo $msg2[0] ?>
	<?php
		
		echo "</a>";
	}
	else
	{
		echo $msg2[0];
		echo "</td>";
	}
	?>
</tr>


<tr  height='30'>
	<td width="150" class="cbody">&nbsp;&nbsp;Journal</td>
	<td width="100" align="center" class="cbody">
	<?php
	if($jur2[0]>0)
	{
	?>	
	<a href="javascript:OpenWind('brief_med_rep2.php?lib=<?=$library?>&regt=<?=$register?>&mode=tcop');"><?php echo $jur2[0] ?>
	<?php
		
		echo "</a></td>";
	}
	else
	{
		echo $jur2[0];
		echo "</td>";
	}
	?>
	
	<td width="100" align="right" class="cbody">
	<?php
	if($r12[0]>0)
	{
	?>	
	
	<a href="javascript:OpenWind('brief_med_rep2.php?lib=<?=$library?>&regt=<?=$register?>&mode=handcop');"><?php echo $r12[0] ?>
	<?php
		
		echo "</a></td>";
	}
	else
	{
		echo $r12[0];
		echo "</td>";
	}
	?>
	<td width="100" align="right" class="cbody">
	<?php
	if($nal2[0]>0)
	{
	?>	
	
	<a href="javascript:OpenWind('brief_med_rep2.php?lib=<?=$library?>&regt=<?=$register?>&mode=outcop');"><?php echo $nal2[0]?>
<?php
		
		echo "</a></td>";
	}
	else
	{
		echo $nal2[0];
		echo "</td>";
	}
	?>
</tr>
<?php
	$tcop = $tcop + ($mag2[0]);
	$handcop=$handcop+ ($r1[0]);
	$outcop=$outcop+ ($msg2[0]);
	
	$tcop = $tcop + ($jur2[0]);
	$handcop=$handcop+ ($jur2[0]);
	$outcop=$outcop+ ($nal2[0]);


if($register>0) 	
{
	
	$xyz="select count(*) as total_media from lib_question_paper_det where library=$library and register='$register'";
	$sql1="select count(*) as total_media from lib_question_paper_det where library=$library and register=$register and flag=0";
	$abc="select count(*) as total_media from lib_question_paper_det where library=$library and register=$register and flag=1";	
}

else
{
	$xyz="select count(*) as total_media from lib_question_paper_det";
	$sql1="select count(*) as total_media from lib_question_paper_det where library=$library and flag=0";
	$abc="select count(*) as total_media from lib_question_paper_det where library=$library and flag=1";
	
}



$xyz1=execute($xyz);
$xyz2=fetcharray($xyz1);

$rs1=execute($sql1);
$r1=fetcharray($rs1);
$abc1=execute($abc);
$abc2=fetcharray($abc1);


?>
<tr  height='30'>
	<td width="150" class="cbody">&nbsp;&nbsp;Question Paper</td>
	
	<td width="100" align="center" class="cbody"> 
      <?php
	if($xyz2[0]>0)
	{
	?>
    <a href="javascript:OpenWind('brief_med_rep1.php?lib=<?=$library?>&regt=<?=$register?>&mode=tcop');"><?php echo $xyz2[0] ?>
<?php
		
		echo "</a>";
	}
	else
	{
		echo $xyz2[0];
		echo "</td>";
	}
	
	?>
	<td width="100" align="center" class="cbody">-------</td>
		<td width="100" align="center" class="cbody">-------</td>
</tr>
<?php
	$tcop = $tcop + ($xyz2[0]);
	$handcop=$handcop+ ($r1[0]);
	$outcop=$outcop+ ($abc2[0]);
?>

<tr>
<td width="150" align="center" class="cbody"><div class="label">Total</div></td>
<td width="100" align="center" class="cbody"><div class="label"><?=$tcop?></div></td>
<td width="100" align="center" class="cbody"><div class="label"><?=$handcop?></div></td>
<td width="100" align="center" class="cbody"><div class="label"><?=$outcop?></div></td>
</tr>
</table>

<br>
<div id='prn' align='center'>
<input type="button" value="   Print   " name="B1"  onClick="printReport()" class='bgbutton'>
</div>
</BODY>
</HTML>