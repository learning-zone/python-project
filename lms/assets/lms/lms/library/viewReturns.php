<?php
require_once("../db.php");
$media=$_POST['media'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
//print_r($_GET);
//print_r($_POST);

//$issue_date = $today;
if(!checkdate($DMon,$DDay,$DYear))
{
	echo "<p>Invalid From Date.</p>";
	die("</td></tr></table>");
}
$issue_date = "$DYear-$DMon-$DDay";
if(!checkdate($TMon,$TDay,$TYear))
{
	echo "<p>Invalid To Date.</p>";
	die("</td></tr></table>");
}
$to_date = "$TYear-$TMon-$TDay";
?>
<FORM NAME="frm" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="issue_date" VALUE="<?=$issue_date;?>">
<INPUT TYPE="HIDDEN" NAME="TYear" VALUE="<?=$TYear;?>">
<INPUT TYPE="HIDDEN" NAME="TMon" VALUE="<?=$TMon;?>">
<INPUT TYPE="HIDDEN" NAME="TDay" VALUE="<?=$TDay;?>">
<INPUT TYPE="HIDDEN" NAME="DYear" VALUE="<?=$DYear;?>">
<INPUT TYPE="HIDDEN" NAME="DMon" VALUE="<?=$DMon;?>">
<INPUT TYPE="HIDDEN" NAME="DDay" VALUE="<?=$DDay;?>">
<INPUT TYPE="HIDDEN" NAME="register" VALUE="<?=$register;?>">
<INPUT TYPE="HIDDEN" NAME="library" VALUE="<?=$library;?>">
<table align='center' width='90%' colspan='7'>
	 <tr height='20'>
       <td align='center'>As on :<?=date('d-m-Y g:i:s:a')?></td>
     </tr>
	 <tr height='25'>
       <td align="center" Class="head">Returned Media Report</td>
     </tr>
	 <tr height='20'>
       <td align="center">A list of media Returned between <?=date("d-m-Y",strtotime($issue_date))?> and <?=date("d-m-Y",strtotime($to_date))?></td>
	</tr>
	<tr>
      <td></td>
    </tr>
  </table>
<?
if($media==0)
{

$sql="select a.m_no,c.cno,c.due_date,c.issue_date,c.return_date,c.name,c.acc_id,c.ret_to,c.status from lib_membership_m a,";
$sql.="lib_membership_det b,lib_circulation_m c where c.returned='Yes' and c.status='1' and b.m_id=a.id and b.mbno=c.cno";
$sql.=" and c.media_type not in (7,8) and (c.return_date >= '".$issue_date."') and (c.return_date <= '".$to_date."') order by c.issue_date";
}
if($media!=0)
{
$sql="select a.m_no,c.cno,c.due_date,c.issue_date,c.return_date,c.name,c.acc_id,c.ret_to,c.status from lib_membership_m a,";
$sql.="lib_membership_det b,lib_circulation_m c where c.returned='Yes' and c.status='1' and c.media_type='$media' and b.m_id=a.id";
$sql.=" and b.mbno=c.cno and (c.return_date >= '".$issue_date."') and (c.return_date <= '".$to_date."') order by c.issue_date";
}
$rs1 = execute($sql);

$row1=rowcount($rs1);
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
$slno=1;
if($row1 > 0)
{
	$rs_col=execute("select * from college");
	$r_col=fetcharray($rs_col);
	$college=$r_col[col_name];
	mysql_free_result($rs_col);
	?>
  <br/>
  <table width="90%" cellspacing="1" align='center' class='forumline' colspan='7'>
	<tr>
	<td class="head" align="center">Sl.No</td>	
	<td class="head" align="center">Card No.</td>
	<td class="head" align="center">Accession No.</td>
    <td class="head" align="center">Returned Date</td>
	<td class="head" align="center">Issued By</td>
	<td class="head" align="center">Returned To</td>
	<td class="head" align="center">Status</td>
	<?php
	for($i=0;$i<$row1;$i++)
	{
		$r = fetcharray($rs1,$i);
       ?>
 <tr>
	<td class="CBody" align='center'><?=$slno?></td>
    <td class="CBody" align='center'><a href="viewMemberInfo.php?Cno=<?=$r["cno"]?>"><?=$r["cno"]?></a></td>
    <td class="CBody" align='center'><a href="view_acc_info.php?acc_no=<?=$r["acc_id"]?>&m_no=<?=$r["cno"]?>"><?=$r["acc_id"]?></a></td>
	<td class="CBody" align='center'><?=date("d-m-Y",strtotime($r["return_date"]))?></td>
	<td class="CBody" align='center'><?=$r["name"]?></td>
	<td class="CBody" align='center'><?=$r["ret_to"]?></td>
	<?php
		   
			if($r[status]==1)
	        $stat="Returned";
          ?>
			<td class="CBody" align='center'><font color='red'><?=$stat?></font></td>
		<?php
	 $slno++;
	}
 ?>
 </tr>
</table>
<div id='prn' align='center'>
<INPUT TYPE="button" NAME="print" VALUE="<<  Print  >>" class=bgbutton onClick="printReport()">
</div>
<?
}
else
{
	?>
	<tr><td><p align="center">No media were Returned between 
	<?=date("d-m-Y",strtotime($issue_date))?> and <?=date("d-m-Y",strtotime($to_date))?></p></td></tr>
	<?php
}
echo "<br>";
?>
</form>
</BODY>
</HTML>