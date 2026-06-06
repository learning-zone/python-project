<?php
require_once("../db.php");
$member=$_POST['member'];
$media=$_POST['media'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];

//print_r($_GET);
//print_r($_POST);
$frm_date=$DYear."-".$DMon."-".$DDay;
$q=fetcharray(execute("select * from lib_membership_m where type=$member"));
$s=fetcharray(execute("select mbno from lib_membership_det where m_id=$q[id]"));

if($media!=0)
{
	$sql="select * from lib_circulation_m where cno='$s[mbno]' and status=0 and media_type='$media' and (due_date >= '".$frm_date."') order by media_type";
}
else
{
	$sql="select * from lib_circulation_m where cno='$s[mbno]' and status=0 and (due_date >= '".$frm_date."') order by media_type";
}
$rs1 = execute($sql);
$row1=rowcount($rs1);
?>
<HTML>
<FORM NAME="frm" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="member" VALUE="<?php echo $member;?>">
<INPUT TYPE="HIDDEN" NAME="day" VALUE="<?php echo $DDay;?>">
<INPUT TYPE="HIDDEN" NAME="month" VALUE="<?php echo $DMon;?>">
<INPUT TYPE="HIDDEN" NAME="year" VALUE="<?php echo $DYear;?>">

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
	$rs_col=execute("select * from college");
	$r_col=fetcharray($rs_col);
	$college=$r_col[col_name];
	mysql_free_result($rs_col);
?>
	
	<!--<div align="center"><b><font size=4><?=$college?></font></b></div><br>-->
    <table align='center' width='90%' colspan='7'>
    <tr height='20'>
      <td align='center' colspan='7'>As on :</b><?=date('d-m-Y g:i:s:a')?></td>
    </tr>
    <tr>
      <td class="head" align="center" colspan=7>A list of renewed medias</td>
    </tr>
	<tr>
	  <td class="head" align="center">Card No.</td>
	  <td class="head" align="center">Member Type</td> 
      <td class="head" align="center">Accession No.</td>
      <td class="head" align="center">Media Type</td>
      <td class="head" align="center">Issued Date</td>
      <td class="head" align="center">Due Date</td>
	  <td class="head" align="center">No Of Renewal</td>
</tr>
<?php
	for($i=0;$i<$row1;$i++)
	{
		$r1 = fetcharray($rs1,$i);
		if($media!=0)
		{
			$sql="select a.cno,a.acc_id,a.issue_date,a.due_date,a.m_id,b.name,c.count from lib_circulation_m a,lib_mediatype b,";
			$sql.=" lib_renewal c where a.acc_id=$r1[acc_id] and a.status=0 and c.card_no=a.cno and c.acc_no=$r1[acc_id]";
			$sql.=" and c.media_type=a.media_type and c.media_type=$r1[media_type] and a.media_type=$media and b.id=$r1[media_type] order by a.issue_date";
		}
		else
		{

			$sql="select a.cno,a.acc_id,a.issue_date,a.due_date,a.m_id,b.name,c.count from lib_circulation_m a,lib_mediatype b,";
			$sql.=" lib_renewal c where a.acc_id=$r1[acc_id] and a.status=0 and c.card_no=a.cno and c.acc_no=$r1[acc_id]";
			$sql.=" and c.media_type=a.media_type and c.media_type=$r1[media_type] and b.id=$r1[media_type] order by a.issue_date";
		}
		//echo"$sql<br>";
		$rs = execute($sql);
		$row=rowcount($rs);
		if($row>0)
		{
			for($j=0;$j<$row;$j++)
			{
				$r = fetcharray($rs,$j);
				?>
				<tr>
		           <td class="CBody" align='center'><?=$r["cno"]?></td>
                   <?php
					if($member==1)
				   {
					?>
		           <td class="CBody" align='center'>Student</td>
				   <?php
				   }
                    if($member==2)
				   {
					?>
				   <td class="CBody" align='center'>Staff</td>
				   <?php
				   }
					?>
				   <td class="CBody" align='center'><?=$r["acc_id"]?></td>
		           <td class="CBody" align='center'><?=$r["name"]?></td>
		           <td class="CBody" align='center'><?=date("d-m-Y",strtotime($r["issue_date"]))?></td>
		           <td class="CBody" align='center'><?=date("d-m-Y",strtotime($r["due_date"]))?></td>
		           <td class="CBody" align='center'><font color='red'><?php echo $r["count"]?></font></td>
		     </tr>
		<?php
			}
		}

	}
	?>
	</table>
	<br>
<div id='prn' align=center>
	<INPUT TYPE="button" NAME="print" VALUE="<<  Print  >>" class=bgbutton onClick="printReport()">
</div>
	<?php
}
else
{
	?>
<tr>
<td>
<div class="label" align="left">No renewed media.</div>
</td>
</tr>
<?php
}
?>
</BODY>
</form>
</HTML>