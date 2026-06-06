<?php
require_once("../db.php");
$media=$_REQUEST['media'];
?>
<?php
$cdte=date("Y-m-d");
$rs=execute("select accno,media_type from lib_reservation_temp where stts=0 and end_date < '$cdte' order by id");
if(rowcount($rs)>0)
{
	while($r=fetcharray($rs))
	{
		if($r[media_type]==2 || $r[media_type]==4)
			$tbl="lib_cd_acc_det";
		elseif($r[media_type]==1)
			$tbl="lib_acc_details";
		elseif($r[media_type]==5)
			$tbl="lib_acc_proj_det";

		$rs1=execute("update $tbl set flag=0 where acc_no='$r[accno]'");
	}
	$rs1=execute("update lib_reservation_temp set stts=1 where stts=0 and end_date < '$cdte'");
}
?>
<html>
<head></head>
<body>
<p align="center">&nbsp;</p>
<form name="frm" method="POST" style="background-image: url('../images/Mouse1.gif')">
<table class=forumline width="81%" cellspacing="0" align='center'>
<tr><td align='center' Class='head' colspan='2'>Advance OPAC Search</td></tr>
	<tr height='30'>
		<td width="300%" colspan="4" align="center">
			<a href='advance_opac_search_book.php?media=True'>OPAC Search For Book</a>
		</td>
	</tr>
	<tr height='30'>
		<td width="300%" colspan="4" align="center">
			&nbsp;&nbsp;&nbsp;&nbsp;<a href='advance_opac_search_cd.php?media=True&media_type=2'>OPAC Search For CD/DVD</a>
        </td>
	</tr>
		<tr height='30'>
		<td width="300%" colspan="4" align="center">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='advance_opac_search_project.php?media=True'>OPAC Search For Project Report</a>
		</td>
	</tr>
	<tr height='30'>
		<td width="300%" colspan="4" align="center">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='advance_opac_search_magazine.php?media=True&type=M'>OPAC Search For Magazine</a>
		</td>
	</tr>
    <tr height='30'>
		<td width="300%" colspan="4" align="center">
			&nbsp;&nbsp;&nbsp;&nbsp;<a href='advance_opac_search_magazine.php?media=True&type=J'>OPAC Search For Journal</a>
		</td>
	</tr>
    <tr height='30'>
		<td width="300%" colspan="4" align="center">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='advance_opac_search_questionpaper.php?media=True'>OPAC Search For Question Paper</a>
		</td>
	</tr>
    <!-- <tr>
		<td width="300%" colspan="4" align="center">
			<a href='advance_opac_search_bound_volume.php?media=True'>OPAC Search For Bound Volumes</a>
		</td>
	</tr> --> 
</table>
</form>
</body>
</html>