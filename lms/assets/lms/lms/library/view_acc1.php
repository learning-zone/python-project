<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
require_once("../db.php");
$acc_no = $_REQUEST['acc_no'];
$m_no = $_REQUEST['m_no'];
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
</HEAD>
<BODY>
<?php
$sql="select * from lib_circulation_m  where acc_id='$acc_no' and cno='$m_no'";
$rs = execute($sql);
$row1=rowcount($rs);
$s=fetcharray($rs);
$rs_col=execute("select * from college");
$r_col=fetcharray($rs_col);

$college=$r_col[col_name];
mysql_free_result($rs_col);
?>
<!--<div align="left"><?=$college?> </div><br>-->
<FORM NAME="frm" METHOD="POST">
<table width="80%" border="0" align=center class=forumline>
<div align='center' >As on : <?=date('d-m-Y g:i:s:a')?><div>
<table width="80%" cellpadding="2" align='center'>
<tr><td align="center" Class="head" width="100%" colspan="2">Media Report Details</td></tr>
<?php
if($row1 > 0)
{
	for($i=0;$i<$row1;$i++)
	{
		$r1 = fetcharray($rs,$i);
		$sql="select e.*,f.*,a.name,b.register from library_name a,lib_register b,lib_book_details e,lib_acc_details f where ";
		$sql .="e.id=f.master_id and f.acc_no='$acc_no' and a.id=f.library and b.id=f.register";
		$rs = execute($sql)or die(mysql_error());
		$row=rowcount($rs);
		if($row==0)
		{
			$sql="select e.*,f.*,a.name,b.register from library_name a,lib_register b,lib_cd_det e,lib_cd_acc_det f where ";
			$sql .="e.id=f.master_id and f.acc_no='$acc_no' and a.id=f.library and b.id=f.register";
			$rs = execute($sql);
			$row=rowcount($rs);
			if($row==0)
			{
				$sql="select e.*,f.*,a.name,b.register from library_name a,lib_register b,lib_floppy_det e,lib_floppy_acc_det f where ";
				$sql .="e.id=f.master_id and f.acc_no='$acc_no' and a.id=f.library and b.id=f.register";
				$rs = execute($sql);
				$row=rowcount($rs);
				if($row==0)
				{
					$sql="select e.*,f.*,a.name,b.register from library a,lib_register b,lib_project_report_det e,lib_proj_acc_det f where ";
					$sql .="e.id=f.master_id and f.acc_no='$acc_no' and a.id=f.library and b.id=f.register";
					$rs = execute($sql);
					$row=rowcount($rs);
					if($row==0)
					{
						$sql="select e.*,f.*,a.name,b.register from library a,lib_register b,lib_bound_media_det e,lib_bound_acc_det f where ";
						$sql .="e.id=f.master_id  and f.acc_no='$acc_no' and a.id=f.library and b.id=f.register";
						$rs = execute($sql);
						$row=rowcount($rs);
					}
				}
			}
		}
	}
	for($j=0;$j<$row;$j++)
	{
		$r = fetcharray($rs,$j);
		?>
<!--		<table width="100%" cellspacing="1" class='forumline' align='center'> -->
		  <tr>
		    <td class="rowpic" align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Card No.</td>
		    <td class="CBody" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;<?=$s["cno"]?></td>
	      </tr>
		  <tr>
		    <td class="rowpic" align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Accession No.</td>
		    <td class="CBody" align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$r["acc_no"]?></td>
		  </tr>
		  <tr>
		    <td class="rowpic"align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Title</td>
		    <td class="CBody" align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<?=$r["title"]?></td>
	     </tr>
		 <tr>
		   <td class="rowpic" align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           Media Type</td>
		   <td class="CBody" align="left">&nbsp;&nbsp;&nbsp;
		<?php
		if($r["media_type"]==1)
		{
			echo "Book";
			$m_type="Book";
		}
		elseif($r["media_type"]==2)
		{
			echo "Book CD";
			$m_type="Book CD";
		}
		elseif($r["media_type"]==3)
		{
			echo "Book Floppy";
			$m_type="Book Floppy";
		}
		elseif($r["media_type"]==4)
		{
			echo "CD's";
			$m_type="CD's";
		}
		elseif($r["media_type"]==5)
		{
			echo "Project Report";
			$m_type="Project Report";
		}
		else
		{
			echo "Bound Volume";
			$m_type="Bound Volume";
		}
		?>
		</td>
		</tr>
		<tr>
		  <td class="rowpic"  align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Library</td>
		  <td class="CBody" align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$r["name"]?></td>
		</tr>
		<tr>
		  <td class="rowpic" align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Register</td>
		  <td class="CBody" align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$r["register"]?></td>
		</tr>
		<tr>
		  <td class="rowpic" align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Issued Date</td>
		  <td class="CBody" align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=date("d-m-Y ",strtotime($s["issue_date"]))?></td></tr>
		<tr>
		  <td class="rowpic" align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Due Date</td>
		  <td class="CBody" align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=date("d-m-Y",strtotime($s["due_date"]))?></td>
		</tr>
		<tr>
		  <td class="rowpic"  align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Issued By</td>
		  <td class="CBody" align="left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$s["name"]?></td>
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
	<tr><td width="500"><div class="label" align="left">Details Not Found</td></tr></div>
	<?php
}
echo "<br>";
?>
</table><br><div id='prn' align='left'></div>
</BODY>
</html>