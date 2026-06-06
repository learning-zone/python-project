<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
require_once("../db.php");
$date=date('d-m-Y');
$date1=explode("-",$date);
$d1=$date1[0];
$d2=$date1[1];
$d3=$date1[2];
$current_date=$d3."-".$d2."-".$d1;

$Cno = $_POST['Cno'];
$sem = $_POST['sem'];
$m_no = $_POST['m_no'];
$acc_no = $_POST['acc_no'];
$branch = $_POST['branch'];
?>
<?php
$sql="select * from lib_circulation_m  where due_date <= '".$current_date."' and status=0 order by media_type";
$rs1 = execute($sql);
$row1=rowCount($rs1);
?>
<HTML>
<HEAD>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = "";
}
</script>
</HEAD>
<BODY>
<?php
if($row1 > 0)
{
	$slno=1;
$rs_col=execute("select * from college");
$r_col=fetcharray($rs_col);
$college=$r_col[col_name];
mysql_free_result($rs_col);
?>
<!--<div align="center"><?=$college?></div><br>-->
<table align='center' width='98%' colspan='10' border="1">
<tr height='20'>
  <td align='center' colspan='10'>As on :<?=date('d-m-Y g:i:s:a')?></td>
</tr>
<tr>
  <td class="head" align="center" colspan=10>A list of outstanding medias</td>
</tr>
<td class="head" align="center" nowrap>Sl.No</td>
<td class="head" align="center" nowrap>Card No.</td>
<td class="head" align="center" nowrap>Accession No.</td>
<td class="head" align="center" nowrap>Member Name</td>
<td class="head" align="center" nowrap>Title</td>
<td class="head" align="center" nowrap>Media Type</td>
<td class="head" align="center" nowrap>Issued Date</td>
<td class="head" align="center" nowrap>Due Date</td>
<td class="head" align="center" nowrap>Fine</td>
<td class="head" align="center" nowrap>Status</td>
<?php
for($i=0;$i<$row1;$i++)
{
	$r1 = fetcharray($rs1);
	if($r1[media_type]==1)
	{
	    $sql="select a.title,c.name,d.cno,d.acc_id,d.issue_date,d.due_date from lib_book_details a,lib_acc_details b,";
	    $sql.=" lib_mediatype c,lib_circulation_m d where a.id=b.master_id and b.acc_no=d.acc_id and b.acc_no=$r1[acc_id] and "; 
	    $sql.=" b.flag=1 and $r1[status]=0 and c.id=$r1[media_type] and d.id=$r1[id] order by d.issue_date";
	}
    if($r1[media_type]==2 || $r1[media_type]==4)
	{
		$sql="select a.title,c.name,d.cno,d.acc_id,d.issue_date,d.due_date from lib_cd_det a,lib_cd_acc_det b,";
		$sql.=" lib_mediatype c,lib_circulation_m d where a.id=b.master_id and b.acc_no=d.acc_id and b.acc_no=$r1[acc_id]";
		$sql.=" and b.flag=1 and $r1[status]=0 and c.id=$r1[media_type] and d.id=$r1[id] order by d.issue_date";
	}
	if($r1[media_type]==3)
	{
		$sql="select a.title,c.name,d.cno,d.acc_id,d.issue_date,d.due_date from lib_floppy_det a,lib_floppy_acc_det b,";
		$sql.=" lib_mediatype c,lib_circulation_m d where a.id=b.master_id and b.acc_no=d.acc_id and ";
		$sql.=" b.acc_no=$r1[acc_id] and b.flag=1 and $r1[status]=0 and c.id=$r1[media_type] and d.id=$r1[id] order by d.issue_date";
	}
	if($r1[media_type]==5)
	{
		$sql="select a.title,c.name,d.cno,d.acc_id,d.issue_date,d.due_date from lib_project_report_det a,";
		$sql.=" lib_proj_acc_det b,lib_mediatype c,lib_circulation_m d where a.id=b.master_id and b.acc_no=d.acc_id";
		$sql.=" and b.acc_no=$r1[acc_id] and b.flag=1 and $r1[status]=0 and c.id=$r1[media_type] and d.id=$r1[id] order by d.issue_date";
	}
	if($r1[media_type]==6)   
	{
		$sql="select a.title,c.name,d.cno,d.acc_id,d.issue_date,d.due_date from lib_bound_media_det a,";
		$sql.=" lib_bound_acc_det b,lib_mediatype c,lib_circulation_m d where a.id=b.master_id and b.acc_no=d.acc_id";
		$sql.=" and b.mag_acc_no=$r1[acc_id] b.flag=1 and $r1[status]=0 and c.id=$r1[media_type] and d.id=$r1[id] order by d.issue_date";
	}
$rs = execute($sql);
$row=rowcount($rs);
for($j=0;$j<$row;$j++)
	{
	    $r = fetcharray($rs,$j);
		?>
     <?
	 
	 	$name=fetcharray(execute("SELECT `MemberName` FROM `lib_membership_m` WHERE `m_no`='$r[cno]'"));
	 ?>
	<tr>
    <td class="CBody" align='center'><?=$slno?></td>
	<td class="CBody" align='center'><a href="viewMemberInfo.php?Cno=<?=$r["cno"]?>"><?=$r["cno"]?></a></td>
	<td class="CBody" align='center'><a href="view_acc1.php?acc_no=<?=$r["acc_id"]?>&m_no=<?=$r["cno"]?>"><?=$r["acc_id"]?></a></td>
    <td class="CBody" align='left'><?=$name[0]?></td>
	<td class="CBody" align='left'><?=$r["title"]?></td>
	<td class="CBody" align='center'><?=$r["name"]?></td>
        <?
					$newd=$r['issue_date'];
			    	$dateArray=explode('-',$newd);
					$acq_yy=$dateArray[0];
					$acq_mm=$dateArray[1];
					$acq_dd=$dateArray[2];
					$issue_date="$acq_dd-$acq_mm-$acq_yy";
					
				    $newd1=$r['due_date'];
			    	$dateArray1=explode('-',$newd1);
					$acq_yy1=$dateArray1[0];
					$acq_mm1=$dateArray1[1];
					$acq_dd1=$dateArray1[2];
					$due_date="$acq_dd1-$acq_mm1-$acq_yy1";
		?>
		<td class="CBody" align='center'><?=$issue_date?></td>
		<td class="CBody" align='center'><?=$due_date?></td>
        <?
		$fine_amt=0;
			$cdte=date("Y-m-d");
			$nsql=execute("select to_days('".$cdte."')-to_days('".$r[due_date]."')") or die(error_description());
			$nrs=fetcharray($nsql);
			$ndays=$nrs[0];
			//echo $ndays;
			$frs=fetcharray(execute("select * from lib_finedtls"));
			if($ndays>0)
			{
				if($ndays>$frs[daysfrom])
				{
					$fine_amt=$frs[fine1]*$frs[daysfrom];
					$ndays-=$frs[daysfrom];
					$nextd=$frs[daysto]-$frs[daysfrom];
					if($ndays>$nextd)
					{
						$fine_amt=$fine_amt+($frs[fine2]*$nextd);
						$ndays-=$nextd;
						$fine_amt=$fine_amt+($ndays*$frs[fine3]);
					}
					elseif($ndays==$nextd)
						$fine_amt=$fine_amt+($frs[fine2]*$nextd);
					else
						$fine_amt=$fine_amt+($ndays*$frs[fine2]);
				}
				elseif($ndays==$frs[daysfrom])
					$fine_amt=($frs[fine1]*$frs[daysfrom]);
				else
					$fine_amt=($ndays*$frs[fine1]);
			}
			else
				$fine_amt=0;
			$fine_amt1 = number_format($fine_amt,2);
		?>
        <td class="CBody" align='center'><?=$fine_amt1?></td> 
		<td class="CBody" align='center'>Pending</td>
		
		<?php
			$slno++;
	}
}
?>
</tr>
</table>
<br>
<div id='prn' align=center>
	<INPUT TYPE="button" NAME="print" VALUE="<<  Print  >>" class='bgbutton' onClick="printReport()">
</div>
<?php
}
else
{
?>
<tr>
<td>
<div class="label" align="left">No outstanding media.</div>
</td>
</tr>
<?php
}
?>
</BODY>
</form>
</HTML>