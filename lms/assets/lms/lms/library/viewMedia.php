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

$sql="select * from lib_book_details where id=$id";
$rs = execute($sql);
$row=rowcount($rs);
if($per00==1)
{
	$mid=fetcharray(execute("select a.m_no from lib_membership_m a,users b,staff_det c where a.type=2 and a.status=1 and a.s_id=c.id and b.username='$user' and b.S_ID=c.slno"));
	$memid=$mid[0];
}
else
{
	$mid=fetcharray(execute("select a.m_no from lib_membership_m a,student_m b where a.type=1 and a.status=1 and a.s_id=b.id and b.username='$user'"));
	$memid=$mid[0];
}
?>
<HTML>
<HEAD>
<script language="JavaScript">
function anu()
{
	document.frmm.action="SpecialReservation.php";
	document.frmm.submit();
}
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	if(confirm("Are you sure, You want to resever this media ?"))
	{
		window.open(finalVar,'Stud','height=300,width=600,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
	}		
}
</script>
</HEAD>
<BODY>
<?php
if($searchtext!="")
 $title=$searchtext;
?>
<table width="60%" class='forumline' align='center' colspan='3'>
<tr>
  <td colspan='4' align='center' class='head'>Book Details</td>
</tr>
<tr>
  <td align="center" class="rowpic">Attribute</td>
  <td align="center" class="rowpic" colspan='3'>Value</td>
</tr>
<?php
for($i=0;$i<$row;$i++)
{
	$r = fetcharray($rs,$i);
	?>
	<tr>
		<td align="center">Title</td>
		<td align="center" colspan='3'><?php echo $r["title"]?></td>
	</tr>
	<tr>
		<td align="center">&nbsp;&nbsp;&nbsp;Author</td>
		<td align="center" colspan='3'><?php echo $r["author"]?></td>
	</tr>
	<tr>
		<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Publisher</td>
		<td align="center" colspan='3'><?php echo $r["publisher"]?></td>
	</tr>
	<tr>
		<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;Edition</td>
		<td align="center" colspan='3'><?php echo $r["edition"]?></td>
	</tr>
	<tr>
		<td align="center">&nbsp;Year</td>
		<td align="center" colspan='3'><?php echo $r["year"]?></td>
	</tr>

	<?php
	}
$sql="select distinct a.acc_no,a.id,a.book_type,a.register,a.mode,a.flag,a.library from lib_acc_details a left join lib_reservation_m b";
$sql.=" on b.accno=a.acc_no left join lib_circulation_m e on e.acc_id=a.acc_no and e.status=0 where a.mode='A'";
$sql.=" and a.master_id='$id' and  b.l_id is null";

$rs1 = execute($sql);
$row1=rowcount($rs1);
	if ($row1)
	{
		?>
		<tr>
		<td colspan="4" align='center' class="rowpic">&nbsp;</td>
		</tr>
		<tr>
		<td colspan="4" align='center' class="rowpic">Click on the Accession number to reserve  the Book.</td>
		</tr>
		<tr>
			<td align='left' class="head">&nbsp;Accession Number</td>
			<td align='left' class="head">Book Type</td>
			<td align='left' class="head">&nbsp;&nbsp;&nbsp;Status</td>
			<td align='left' class="head">Member ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Details</td>
		
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
						$status='Reference Book';
					}
					elseif($r[book_type]=='S')
					{
						$status='Weed out Book';
					}
					if($r[flag]==0)
					{
						$cs='2';
						$std='Available]';
						?>
						<tr><td>&nbsp;&nbsp;<A HREF="javascript:OpenWind('reserveMedia.php?member=<?php echo $memid?>&id=<?php echo $r[acc_no]?>&library=<?php echo $r[library]?>&media=1')"><?php echo $r[acc_no]?></A></td>
					<td>&nbsp;&nbsp;[<?php echo $status?>]</td>
					<td colspan='<?=$cs?>' nowrap>&nbsp;&nbsp;[<?php echo $std?></td>
					</tr>
					<?php
					}
					elseif($r[flag]==1)
					{
						$cs='0';
						
						$x=execute("select b.type,b.MemberName,b.m_no from lib_circulation_m a,lib_membership_m  b where a.acc_id='$r[acc_no]' and a.status=0 and (b.usn=a.cno or b.m_no=a.cno)") or die("Errot-1");
						$y=fetcharray($x);
						if($y[type]==1)
						$type='Student';
						if($y[type]==2)
						$type='Staff';
						$std='Book Issued ]</td><td nowrap>&nbsp;&nbsp;'.$y[m_no].'&nbsp;'.$y[MemberName].'('.$type.')';
						$anc=''.$r[acc_no].'';
						?>
						<tr>
					<td>&nbsp;&nbsp;<?=$anc?></td>
					<td>&nbsp;&nbsp;[<?php echo $status?>]</td>
					<td colspan='<?=$cs?>' nowrap>&nbsp;&nbsp;[<?php echo $std?></td>
					</tr>
					<?php
					}
					else
					{
						$Tdate=date("Y-m-d");
						$cs='0';
						$x=execute("select b.type,b.MemberName,b.m_no from lib_reservation_temp a,lib_membership_m b where a.accno='$r[acc_no]' and end_date>='$Tdate' and (b.usn=a.m_id or b.m_no=a.m_id)") or die("Errot-1");
						$y=fetcharray($x);
						if($y[type]==1)
						$type='Student';
						if($y[type]==2)
						$type='Staff';
						$std='Book Reserved]</td><td nowrap>&nbsp;&nbsp;'.$y[m_no].'&nbsp;'.$y[MemberName].'('.$type.')';
						$anc=''.$r[acc_no].'';
						?>
						<tr>
					<td>&nbsp;&nbsp;<?=$anc?></td>
					<td>&nbsp;&nbsp;[<?php echo $status?>]</td>
					<td colspan='<?=$cs?>' nowrap>&nbsp;&nbsp;[<?php echo $std?></td>
					</tr>
					<?php
					}
		}
}
else
{
	$tyrop=execute("select acc_no from lib_acc_details  where master_id=$id");
	$rfrt=0;
	for($z=0;$z<rowcount($tyrop);$z++)
		{
			$qwew=fetcharray($tyrop);
			$tet11=execute("select count(*)from lib_reservation_m where l_id=$qwew[acc_no]");
			$tet12=fetcharray($tet11);
			$rfrt=$rfrt+$tet12[0];
		}
	$ewe11=execute("select count(*)from special_reservation_temp where bok_id=$id");
	$ewe12=fetcharray($ewe11);
	if(rowcount($ewe11)==0)
	$ewe12[0]=0;
	$fwf11=execute("select count(*)from lib_acc_details where master_id=$id ");
	$fwf12=fetcharray($fwf11);
	$bout=$rfrt+$ewe12[0];
	?>
	<form name=frmm onSubmit="return anu()">
	<input type="hidden" name=id value='<?php echo $id?>'>
	<tr><td colspan=2>Mebers in quee for this book= <?php echo $bout?> <br>Copies avialable in library=<?php echo $fwf12[0]?> </td></tr>
	<tr>
		</tr>
	</form>	
	<?php
}
?>
</table><!--
<br>
<div align=center><input type='submit'  name='spresv' value="Special Reservation"></div>-->
<br/><!--
<div align='center'>
<a href='opacs_book_search.php?val=<?php echo $val?>&title=<?php echo $title?>&keywords=<?php echo $keywords?>&subject=<?php echo $subject?>&acc_no=<?php echo $acc_no?>&publisher=<?php echo $publisher?>&author=<?php echo $author?>&attrib=<?php echo $attrib?>&SeekPos=<?php echo $SeekPos?>'>Go Back</a>
</div>-->
</BODY>
</HTML>