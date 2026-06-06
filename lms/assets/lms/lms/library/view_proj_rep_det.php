<?php
require_once("../db.php");
$action=$_REQUEST['action'];
$media=$_REQUEST['media'];
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
if($_GET)
{
	$SeekPos=$_GET['SeekPos'];
}

$sql="select * from lib_project_report_det where id='$id'";
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
   <td colspan='3' align='center' class='head'>Media Details</td>
</tr>
<tr>
   <td align="left" class="rowpic">&nbsp;Attribute</td>
   <td align="left" class="rowpic" colspan='2'>&nbsp;Value</td>
</tr>
<?php
for($i=0;$i<$row;$i++)
{
	$r = fetcharray($rs,$i);
	?>
	<tr>
	   <td>&nbsp;&nbsp;&nbsp;Title</td>
	   <td colspan='2'><?php echo $r["title"]?></td>
    </tr>
	<tr>
	   <td>&nbsp;&nbsp;&nbsp;Author</td>
	   <td colspan='2'><?php echo $r["author"]?></td>
	</tr>
	<tr>
	   <td>&nbsp;&nbsp;&nbsp;College</td>
	   <td colspan='2'><?php echo $r["college"]?></td>
	</tr>
	<tr>
	   <td>&nbsp;&nbsp;&nbsp;Year</td>
	   <td colspan='2'><?php echo $r["year"]?></td>
	</tr>
	<tr>
	   <td>&nbsp;&nbsp;&nbsp;Rack</td>
	   <td colspan='2'><?php echo $r["rack"]?></td>
	</tr>
	<?php
		if($r[date_of_acquiring]!='')
		{
			$dob=date('d-m-Y',strtotime($r[date_of_acquiring]));
		}
		else
		{
			$dob="--";
		}
	?>
	<tr>
	   <td>&nbsp;&nbsp;&nbsp;Date of Acquiring</td>
	   <td colspan='2'><?php echo $dob?></td>
	</tr>
	<tr>
	   <td>&nbsp;&nbsp;&nbsp;Name of the Guide</td>
	   <td colspan='2'><?php echo $r["guide_name"]?></td>
	</tr>
    <tr>
		<td>&nbsp;&nbsp;&nbsp;Course</td>
		<td colspan='2'><?php echo $r["course"]?></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Class</td>
		<td colspan='2'><?php echo $r["class_name"]?></td>
	</tr>
	<?php
}

	$sql="select distinct a.acc_no,a.id,a.book_type,a.flag from lib_proj_acc_det a left join lib_reservation_m b on b.l_id = a.acc_no left join lib_circulation_m e on e.acc_id = a.acc_no and e.status=0 where a.mode='A' and a.master_id='$id' and b.l_id is null";
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
			<td class="head">&nbsp;Accession Number</td>
			<td class="head">Project Type</td>
			<td class="head">Status</td>
		</tr>
		<?php
		for($j=0;$j<$row1;$j++)
		{
			$r = fetcharray($rs1);
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
					if($r[book_type] =='I' )
					{
						$status='Issue';
					}
					if($r[book_type]=='R')
					{
						$status='Reference Project';
					}
					elseif($r[book_type]=='S')
					{
						$status='Weed out Project';
					}
					if($r[flag]==0)
					{
						$std='Available';
					}
					if($r[flag]==1)
					{
						$std='Project Issued';
					}
				?>
		<tr>
		  <td>&nbsp;&nbsp;&nbsp;<a href="JavaScript:F9c3b6294(<?php echo $r["acc_no"]?>)"><?php echo $r["acc_no"]?></a></td>
		  <td>[<?php echo $status?>]</td>
		  <td>[<?php echo $std?>]</td>
	   </tr>
				<?
		}
}
else
{
	?>
	<tr>
	<td colspan="2">You Can't Reserve this media.Because all the media Reserved.</td>
	</tr>
	<?php
}
?>
</table>
<!--<div align='center'>
<a href='../library/view_opac_project_search.php?id=<?php echo $id?>&title=<?php echo $title?>&author=<?php echo $author?>&college=<?php echo $college?>&course=<?php echo $course?>&subject=<?php echo $subject?>&keywords=<?php echo $keywords?>&acc_no=<?php echo $acc_no?>&val=<?php echo $val?>&SeekPos=<?php echo $SeekPos?> '>Go Back</a>
</div> -->
</BODY>
</HTML>