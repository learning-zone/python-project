<?php
require_once("../db.php");
$type=$_POST['type'];
$action=$_REQUEST['action'];
$library=$_POST['library'];
$cardno=$_POST['cardno'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
?>
<html>
<head>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = " ";
}
</script>
</head>
<body>
<form method="POST" name="form1">
<INPUT TYPE="HIDDEN" NAME="cardno" VALUE="<?=$cardno;?>">
<INPUT TYPE="HIDDEN" NAME="type" VALUE="<?=$type;?>">
<INPUT TYPE="HIDDEN" NAME="library" VALUE="<?=$library;?>">
<?php
//echo "hello";
//die();
$library=1;
if(!checkdate($DMon,$DDay,$DYear))
	{
		echo "Invalid From Date. ";
		die();
	}
$from_date = "$DYear-$DMon-$DDay";

if(!checkdate($TMon,$TDay,$TYear))
	{
		echo "Invalid To Date. ";
		die();
	}
$to_date = "$TYear-$TMon-$TDay";

if($library<>"" && $cardno=="")
	{
		$sql1="SELECT distinct(a.m_no),a.totalcards,a.s_id,a.type from lib_membership_m a,lib_membership_det b where a.id=b.m_id ";
		$sql1.=" and a.status='1' and b.library='".$library."' and a.type=".$type ." order by a.m_no" ;
	}

else if ($library=="-1" && $cardno<>"")
	{
		$sql1="SELECT distinct(a.m_no),a.totalcards,a.s_id,a.type from lib_membership_m a,lib_membership_det b where a.id=b.m_id ";
		$sql1.=" and a.status='1' and b.mbno ='".$cardno."' and a.type=".$type ." order by a.m_no" ;
	}

else if($library<>"" && $cardno<>"")
	{
		$sql1="SELECT distinct(a.m_no),a.totalcards,a.s_id,a.type from lib_membership_m a,lib_membership_det b where a.id=b.m_id ";
		$sql1.=" and a.status='1' and b.library ='".$library."' and b.mbno ='".$cardno."' and a.type=".$type ." order by a.m_no" ;
	}

$rs1=execute($sql1);
$row1=rowcount($rs1);
?>

<table width="70%" border="0" cellpadding="0" cellspacing="2" class="forumline" align="center" colspan='5'>
<tr><td align='center' class='head' colspan='5'>A list of members present in the library</td></tr>
<?php
if($row1 > 0)
	{
		?>
		<tr><td></td></tr>
		<?php
		$flag=1;
		for($i1=0;$i1<$row1;$i1++)
			{
				$r1=fetcharray($rs1,$i1);
				if($r1["type"]=="1")
					{
						if($flag==1)
							{
								$flag=0;
								?>
								<tr height='20'>
								<td align="center" class='rowpic'>Member No</td>
								<td align="center" class='rowpic'>No of Cards</td>
								<td align="center" class='rowpic'>Name</td>
								<td align="center" class='rowpic'>Branch</td>
								<td align="center" class='rowpic'>Semester</td>
								</tr>
								<?php
							}
						$sql2="select distinct(b.admission_id),b.first_name,b.last_name,c.coursename,d.year_name from "; 
						$sql2.=" lib_membership_m a ,student_m b,course_m c,course_year d where b.course_admitted=c.course_id ";
						$sql2.=" and b.course_yearsem=d.year_id and b.id='".$r1["s_id"]."' ";

						$rs2=execute($sql2);
						$row2=rowcount($rs2);
						for($i2=0;$i2<$row2;$i2++)
							{
								$r2 = fetcharray($rs2,$i2);
								?>
								<tr>
									<td align='center'><a href="viewMHistory.php?m_no=<?php echo $r1["m_no"] ?>&f_date=<?php echo $from_date ?>&t_date=<?php echo $to_date ?>"><?php echo $r1["m_no"] ?></a></td>
									<td align='center'><?php echo $r1["totalcards"]?></td>
									<td align='center'><?php echo $r2["first_name"]." ".$r2["last_name"]?></td>
									<td align='center'><?php echo $r2["coursename"]?></td>
									<td align='center'><?php echo $r2["year_name"]?></td>
								</tr>
								<?php
							}
					}

				if($r1["type"]=="2")
					{
						if($flag==1)
							{
								$flag=0;
								?>
								<td align="center" class='rowpic'>Member No</td>
								<td align="center" class='rowpic'>No of Cards</td>
								<td align="center" class='rowpic'>Name</td>
								<td align="center" class='rowpic'>Department</td>
								<td align="center" class='rowpic'>Designation</td>
								<?php
							}
						$sql3="select distinct(b.id),b.f_name,b.s_name,c.dept ,d.d_name from lib_membership_m a ,staff_det b, ";
						$sql3.=" dept_no c,staff_des d where b.subj=c.dpt_id and b.type_id=d.d_id and b.id='".$r1["s_id"]."' ";
						$rs3=execute($sql3);
						$row3=rowcount($rs3);
						for($i3=0;$i3<$row3;$i3++)
							{
								$r3 = fetcharray($rs3,$i3);
								?>
								<tr>
									<td align='center'><a href="viewMHistory.php?m_no=<?php echo $r1["m_no"] ?>&f_date=<?php echo $from_date ?>&t_date=<?php echo $to_date ?>&college=<?php echo $college ?>"><?php echo $r1["m_no"] ?></a></td>
									<td align='center'><?php echo $r1["totalcards"]?></td>
									<td align='center'><?php echo $r3["f_name"]." ".$r3["s_name"]?></td>
									<td align='center'><?php echo $r3["dept"]?></td>
									<td align='center'><?php echo $r3["d_name"]?></td>
								</tr>
								<?php
							}
					}
			}
		?>
</table>
<br>
<div id='prn' align='center'>
	<INPUT TYPE="button" id="prn" NAME="print" VALUE="<<  Print  >>" class='bgbutton' onClick="printReport()">
</div>

<?php
}
else
{
echo ("Members not found");
}
?>
</form>
</body>
</html>