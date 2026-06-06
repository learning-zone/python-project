<?php
require_once("../db.php");
$id=$_REQUEST['id'];
$submit1=$_POST['submit1'];
$val=$_POST['val'];
$title=$_POST['title'];
$keywords=$_POST['keywords'];
$subject=$_POST['subject'];
$acc_no=$_POST['acc_no'];
$publisher=$_POST['publisher'];
$author=$_POST['author'];
$attrib=$_POST['attrib'];
$media=$_POST['media'];
$subj=$_POST['subj'];
$searchtext=$_POST['searchtext'];
$SeekPos=$_POST['SeekPos'];

$sql="select * from lib_cd_det where id=$id";
$rs = execute($sql);
$row=rowcount($rs);
?>
<HTML>
<HEAD>
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
  <td class="rowpic">&nbsp;&nbsp;&nbsp;Attribute</td>
  <td class="rowpic" colspan='2'>&nbsp;&nbsp;&nbsp;Value</td>
</tr>
<?php
for($i=0;$i<$row;$i++)
{
	$r = fetcharray($rs);
	?>
	<tr>
	  <td align="left">&nbsp;&nbsp;&nbsp;Title</td>
	  <td align="left" colspan='2'><?php echo $r["title"]?></td>
	</tr>
	<?
	if($media_type==2)
	{
	?>
		<tr>
		  <td align="left">&nbsp;&nbsp;&nbsp;Author</td>
		  <td align="left" colspan='2'><?php echo $r["author"]?></td>
		</tr>
	<?
	}
	?>
	<tr>
	  <td align="left">&nbsp;&nbsp;&nbsp;Call No</td>
	  <td align="left" colspan='2'><?php echo $r["call_no"]?></td>
	</tr>
	<tr>
	  <td align="left">&nbsp;&nbsp;&nbsp;Rack</td>
	  <td align="left" colspan='2'><?php echo $r["rack"]?></td>
	</tr>
	<?
	if($media_type ==2)
	{
	?>
		<tr>
		  <td align="left">&nbsp;&nbsp;&nbsp;Source Acc No</td>
		  <td align="left" colspan='2'><?php echo $r["source_acc_no"]?></td>
		</tr>
	<?
	}
	else
	{
		$pob=date('d-m-Y',strtotime($r["publication_date"]));
	?>
		<tr>
		  <td align="left">&nbsp;&nbsp;&nbsp;Price</td>
		  <td align="left" colspan='2'><?php echo $r["price"]?></td>
		</tr>

		<tr>
		  <td align="left">&nbsp;&nbsp;&nbsp;Publication Date</td>
		  <td align="left" colspan='2'><?php echo $pob?></td>
		</tr>
		<tr>
		  <td align="left">&nbsp;&nbsp;&nbsp;Month-Year</td>
		  <td align="left" colspan='2'><?php echo $r["month"]?>-<?php echo $r["year"]?></td>
		</tr>
		<tr>
		  <td align="left">&nbsp;&nbsp;&nbsp;Volume</td>
		  <td align="left" colspan='2'><?php echo $r["volume"]?></td>
		</tr>
		<tr>
		  <td align="left">&nbsp;&nbsp;&nbsp;Issue</td>
		  <td align="left" colspan='2'><?php echo $r["issue"]?></td>
		</tr>
	<?
	}
		$dob=date('d-m-Y',strtotime($r["date_of_acquiring"]));
	?>
	<tr>
		<td align="left">&nbsp;&nbsp;&nbsp;Date of Acquiring</td>
		<td align="left" colspan='2'><?php echo $dob?></td>
	</tr>

	<?php
}

	$sql="select distinct a.acc_no,a.id,a.cd_type,a.flag from lib_cd_acc_det a left join lib_reservation_m b on b.l_id = a.acc_no left join lib_circulation_m e on e.acc_id = a.acc_no and e.status=0 where a.mode='A' and a.master_id='$id' and b.l_id is  null  ";
	$rs1 = execute($sql);
	$row1=rowcount($rs1);
	if ($row1)
	{
		?>
		<tr>
		<td colspan="3">&nbsp; </td>
		</tr>
		<tr>
		<td colspan="3">Click on the accession number to reserve and enter your Library Card No and follow further instructions.</td>
		</tr>
		<tr>
			<td class='head' width='41%'>&nbsp;&nbsp;Accession Number</td>
			<td class='head' width='26%'>&nbsp;&nbsp;Cd Type</td>
			<td class='head' width='33%'>&nbsp;&nbsp;Status</td>
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
				 if($r[cd_type] =='I' )
					{
						$status='Issue';
					}
					if($r[cd_type]=='R')
					{
						$status='Reference Cd';
					}
					elseif($r[cd_type]=='S')
					{
						$status='Weed out Cd';
					}
					if($r[flag]==0)
					{
						$std='Available';
					}
					if($r[flag]==1)
					{
						$std='Cd Issued';
					}
				?>
				<tr>
					<td>
						&nbsp;&nbsp;&nbsp;<a href="JavaScript:F9c3b6294(<?php echo $r["acc_no"]?>)"><?php echo $r["acc_no"]?>  </a> 
					</td>
					<td>&nbsp;&nbsp;[<?php echo $status?>]</td>
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
<!--<br>
<div align='center'>
<a href='../library/view_opac_cd_search.php?media_type=<?php echo $media_type?>&val=<?php echo $val?>&title=<?php echo $title?>&keywords=<?php echo $keywords?>&author=<?php echo $author?>&source_acc_no=<?php echo $source_acc_no?>&volume=<?php echo $volume?>&issue=<?php echo $issue?>&month=<?php echo $month?>&year=<?php echo $year?>&subject=<?php echo $subject?>&source=<?php echo $source?>&acc_no=<?php echo $acc_no?>&SeekPos=<?php echo $SeekPos?> '>Go Back</a>
</div>-->
</BODY>
</HTML>