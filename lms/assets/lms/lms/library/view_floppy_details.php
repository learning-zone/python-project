<HTML>
<HEAD>
<TITLE>Search Page.</TITLE>
<?php
require("../db.php");
$sql="select * from lib_floppy_det where id=$id";
$rs = execute($sql);
$row=rowcount($rs);
?>
<script language="JavaScript">
function F9c3b6294(id)
{
	var member;
	var pass_word;
	member = prompt("Please Enter your Library Card Number:","");
	if(member!= null && member != "" )
	{
		x = window.open("reserveMedia.php?member=" + escape(member) + "&id=" + id,"","toolbar=0,location=0,menubar=0,width=550,height=150,resizeable=0,scrollbar=0");
	}
	return;
}
</script>
</HEAD>
<BODY>

<table width="60%" class='forumline' align='center' colspan='3'>
<tr>
  <td colspan=3 align='center' class='head'>Media Details</td>
</tr>
<tr>
  <td align="center" class="rowpic">Attribute</td>
  <td align="center" class="rowpic" colspan='2'>Value</td>
</tr>
<?php
for($i=0;$i<$row;$i++)
{
	$r = fetcharray($rs);
	?>
	<tr>
	  <td align="left">Title</td>
	  <td align="left" colspan='2'><?php echo $r["title"]?></td>
	</tr>
	<tr>
	  <td align="left">Author</td>
	  <td align="left" colspan='2'><?php echo $r["author"]?></td>
	</tr>
	<tr>
	  <td align="left">Call No</td>
	  <td align="left" colspan='2'><?php echo $r["call_no"]?></td>
	</tr>
	<tr>
	  <td align="left">Rack</td>
	  <td align="left" colspan='2'><?php echo $r["rack"]?></td>
	</tr>
	<tr>
	  <td align="left">Source Acc No</td>
	  <td align="left" colspan='2'><?php echo $r["source_acc_no"]?></td>
	</tr>
	<?php
	  if($r_q["date_of_acquiring"]!='')
	{
	    $dob=date('d-m-Y',strtotime($r_q["date_of_acquiring"]));
	}
	else
	{
		$dob="--";
	}
	?>
	<tr>
		<td align="left">Date of Acquiring</td>
		<td align="left" colspan='2'><?php echo $dob?></td>
	</tr>
<?php
}

	$sql="select distinct a.acc_no,a.id,a.floppy_type,a.flag from lib_floppy_acc_det a left join lib_reservation_m b on b.l_id = a.acc_no left join lib_circulation_m e on e.acc_id = a.acc_no and e.status=0 where a.mode='A' and a.master_id='$id' and b.l_id is  null  ";
	$rs1 = execute($sql);
	$row1=rowcount($rs1);
	if ($row1)
	{
		?>
		<tr>
		<td colspan="3"><font color="red"><b>Click on the accession number to reserve and enter your Library Card No and follow further instructions.</b></font></td>
		</tr>
		<tr>
			<td width='20%'>&nbsp;&nbsp;Accession Number</td>
			<td width='20%'>&nbsp;&nbsp;Floppy Type</td>
			<td width='20%'>&nbsp;&nbsp;Status</td>
		</tr>
		<?php
		for($j=0;$j<$row1;$j++)
		{
			$r = fetcharray($rs1,0);
			$sql_q="select acc_id,issue_date,due_date from lib_circulation_m where acc_id='$r[acc_no]' and status=0";
			$rs_q=execute($sql_q);
			$status="";
			if(rowcount($rs_q)>0)
			{
				$r_q=fetcharray($rs_q);
				$issue_date=date('d-m-Y',strtotime($r_q[issue_date]));
				$due_date=date('d-m-Y',strtotime($r_q[due_date]));
				$status="Issued on ".$issue_date." Due Date : ".$due_date."";
			}
			if($r[floppy_type] =='I' )
					{
						$status='Issue';
					}
					if($r[floppy_type]=='R')
					{
						$status='Reference Floppy';
					}
					elseif($r[floppy_type]=='S')
					{
						$status='Weed out Floppy';
					}
					if($r[flag]==0)
					{
						$std='<font color=blue face=Lucida Sans size=1.8>Available</font>';
					}
					if($r[flag]==1)
					{
						$std='<font color=red face=Lucida Sans size=1.8>Floppy Issued</font>';
					}
				?>
				<tr>
					<td>
							<a href="JavaScript:F9c3b6294(<?php echo $r["acc_no"]?>)"><?php echo $r["acc_no"]?>  </font></a><font color='GREEN'> 
							</td>
					<td>&nbsp;&nbsp;[<font color='blue' face='Lucida Sans' size='1.8'><?php echo $status?></font>]</td>
					<td>&nbsp;&nbsp;[<?php echo $std?>]</td>
					</tr>
				<?
		}
}
else
{
	?>
	<tr>
	<td colspan="2">You Can't Reserve this media.</td>
	</tr>
	<?php
}
?>
</table>
<br>
<div align='center'>
<a href='../library/view_opac_floppy_search.php?media_type=<?php echo $media_type?>&val=<?php echo $val?>&title=<?php echo $title?>&keywords=<?php echo $keywords?>&author=<?php echo $author?>&source_acc_no=<?php echo $source_acc_no?>&volume=<?php echo $volume?>&issue=<?php echo $issue?>&month=<?php echo $month?>&year=<?php echo $year?>&subject=<?php echo $subject?>&source=<?php echo $source?>&acc_no=<?php echo $acc_no?>&SeekPos=<?php echo $SeekPos?> '><b>Go Back</b></a>
</div>
</BODY>
</HTML>