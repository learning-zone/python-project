<?php
session_start();
include("../db.php");


$sql2 = "select col_name from college ";
$rs2 = execute($sql2);
$row2 = rowcount($rs2);
$r2 = fetcharray($rs2,0);
$colname = $r2["col_name"];
?>
<html>
    <head></head>
  <body>
<FORM NAME="frm" METHOD="POST">
<script language="JavaScript">
function prn()
{
	pp.style.display="none";
	print(this.form);
}
</script>
<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
<body>
<table width='70%' align=center cellspacing=2 cellpadding=0 class="forumline">
<tr><td align=center class="head" colspan=6>Archived Employee List </td></tr>
<tr align=center><td align=center colspan=6 class="row2"><?=$colname?></td></tr>
<tr><td width=50 class="row3">Sl No.</td>
<td class="row3">Staff ID</td>
<td class="row3">Staff Name</td>
<td class="row3">Date of Join</td>
<td class="row3">Date of Leaving</td>
<td class="row3">Service Rendered</td>
</tr>
<?php
$slno=1;
$sql="select * from staff_group";
$rs=execute($sql);
$groupcount=rowcount($rs);
if($groupcount!=0)
{
for($i=0;$i<$groupcount;$i++)
{
   $row=fetcharray($rs,$i);
    $groupid=$row[id];
    $groupname=$row[name];

    $sql1="select * from staff_des where group_id=$groupid";
    $rs1=execute($sql1);
    $descount=rowcount($rs1);
    $des_name=$row[name];
    if($descount!=0)
    {

    for($j=0;$j<$descount;$j++)
	{
   	$row1=fetcharray($rs1,$j);
	$desid=$row1[d_id];

	$sql3="select * from dept_no";
	$rs3=execute($sql3);
	$detcnt=rowcount($rs3);

	for($l=0;$l<$detcnt;$l++)
	{
	  $detrow=fetcharray($rs3,$l);
	  $dept_id=$detrow[dpt_id];
	  $dept_name=$detrow[Dept];
	  $sql2="select * from staff_det where type_id=$desid and subj=$dept_id and active='NO' order by slno";
	       
	$rs2=execute($sql2);
	$staffcount=rowcount($rs2,j);
	if($staffcount!=0)
	{
		echo "<tr>";
		echo "<td colspan=6 class='StudBody'><font color=blue>$groupname</font></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td colspan=6 class='StudBody'>$dept_name</td></tr>";
		for($k=0;$k<$staffcount;$k++)
		{
			$row2=fetcharray($rs2,$k);
			echo "<tr>";
			echo "<td >$slno</td>";
			echo "<td >$row2[slno]</td>";
			echo "<td >$row2[f_name] $row2[s_name]</td>";
			$d = explode(" ",$row2["j_date"]);
			echo "<td>$row2[j_date]</td>";
			if($row2['expirydate']>0)
			{
				echo "<td>".date("d-m-Y",strtotime($row2["expirydate"]))."</td>";
				$service=date_diff($row2["expirydate"],$row2["j_date"],"m");
				$service=abs($service);
				echo "<td>$service Months</td>";
			}
			else
			{
				echo "<td>-</td>";
				echo "<td>-</td>";
			}
			echo "</tr>";
			$slno=$slno+1;
		}
	}
	}
      }
     }
}
}
?>
</table><br><br>
<div id="pp">
<table  border="0" align=center>
<TR><TD><INPUT TYPE="BUTTON" NAME="print" VALUE="PRINT THE REPORT" class="bgbutton" ONCLICK="prn()"></TD><td>
</TR>
</TABLE>
</div>
</body>
</html>