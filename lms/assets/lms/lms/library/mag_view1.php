<?php
require_once("../db.php");

$acc_no = $_REQUEST['acc_no'];
$m_no = $_REQUEST['m_no'];

$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$FYear=$_POST['FYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
$media=$_POST['media'];
?>
<html><head>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = " ";
}
</script>
</head>
<BODY>
<?php
$sql="select * from lib_circulation_m where acc_id='$acc_no' and cno='$m_no'";
$rs = execute($sql);
$row1=rowcount($rs);
$s=fetcharray($rs);
$rs_col=execute("select * from college");
$r_col=fetcharray($rs_col);

$college=$r_col[col_name];
mysql_free_result($rs_col);
?>
<!--<div align="center"><b><font size=4><?=$college?> </font></b></div><br>-->
<FORM NAME="frm" METHOD="POST">
<table width="80%" border="0" align=center class=forumline>
<div align='center' ><b>As on :</b> <?=date('d-m-Y g:i:s:a')?></div>
<table width="60%" cellpadding="2" align='center'>
<tr><td align="center" Class="head" colspan=4>Referenced Media Issued Report Details</td></tr>
<?php
if($row1 > 0)
{
	for($i=0;$i<$row1;$i++)
	{
		$r1 = fetcharray($rs,$i);
		$sql="select e.*,f.*,a.name,b.register from library_name a,lib_register b,lib_magazine_subscription e,lib_magazine f where ";
		$sql .="e.id=f.magazine_sub_no and f.magazine_no='$acc_no' and a.id=f.library and b.id=f.register";
		$rs = execute($sql)or die(mysql_error());
		$row=rowcount($rs);
		if($row==0)
		{
			$sql="select e.*,a.name,b.register from library_name a,lib_register b,lib_question_paper_det e where ";
			$sql .="e.id='$acc_no' and a.id=e.library and b.id=e.register";
			$rs = execute($sql);
			$row=rowcount($rs);
		}
	}
	for($j=0;$j<$row;$j++)
	{
		$r = fetcharray($rs,$j);
		?>
		<table width="60%" cellspacing="1" class='forumline' align='center'>
		  <tr>
		    <td class="rowpic" align="center">Card No.</td>
		    <td class="CBody" align='center'><?=$s["cno"]?></td>
	      </tr>
		  <tr>
		    <td class="rowpic" align="center">Accession No.</td>
		    <td class="CBody" align="center"><?=$acc_no?></td>
		  </tr>
		 <tr>
		   <td class="rowpic" align="center">Media Type</td>
		   <td class="CBody" align="center">
		<?php
		if($s["media_type"]==7)
		{
			echo "Magazine/Journal";
			$m_type="Magazine";
		}
		elseif($s["media_type"]==8)
		{
			echo "Question Paper";
			$m_type="Question Paper";
		}
		?>
		</td>
		</tr>
		<tr>
		  <td class="rowpic"  align="center">Library</td>
		  <td class="CBody" align="center"><?=$r["name"]?></td>
		</tr>
		<tr>
		  <td class="rowpic" align="center">Register</td>
		  <td class="CBody" align="center"><?=$r["register"]?></td>
		</tr>
		<tr>
		  <td class="rowpic" align="center">Issued Date</td>
		  <td class="CBody" align="center"><?=date("d-m-Y ",strtotime($s["issue_date"]))?></td></tr>
		<tr>
		  <td class="rowpic" align="center">Due Date</td>
		  <td class="CBody" align="center"><?=date("d-m-Y",strtotime($s["due_date"]))?></td>
		</tr>
		<tr>
		  <td class="rowpic" align="center">Return Date</td>
		  <td class="CBody" align="center"><?=date("d-m-Y",strtotime($s["return_date"]))?></td>
		</tr>
		<tr>
		  <td class="rowpic"  align="center">Issued By</td>
		  <td class="CBody" align="center"><?=$s["name"]?></td>
		</tr>
		<tr>
		  <td class="rowpic"  align="center">Return to</td>
		  <td class="CBody" align="center"><?=$s["ret_to"]?></td>
		</tr>
		<?
	}
	?>
	</table></td></tr>
	<?php
}
else
{
	?>
	<tr><td width="500"><div class="label" align="center">Details Not Found</td></tr></div>
	<?php
}
echo "<br>";
?>
</table><br><div id='prn' align='center'></div>
</BODY>
</HTML>