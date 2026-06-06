<HTML>
<HEAD>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<script language='javascript'>
function sh()
{
	prn.style.display="none";
	window.print();
	prn.style.display=" ";
}
</script>
</HEAD>
<BODY>
<?php
$stafftype = $_POST['stafftype'];
// VARIABLE DECLARATION BEGINS.
$current_date = date("d-m-Y", strtotime($_STARTOFDAY_));		// FOR STORING THE CURRENT DATE.
$getyearn=$getyear+1;
$heading = "\tEmployee List Staff Wise";
$page = 1;
$serial = 1;
$total = 0;
$j = 0;
// ENDS
//Jahnavi Itagi 11/08/2003 This form dispalys Employee Details Department Wise
echo "<html>";
echo "<head>";
session_start();
include("../db.php");
echo "</head>";

$sql2 = "select col_name from college ";
$rs2 = execute($sql2);
$row2 = rowcount($rs2);
$r2 = fetcharray($rs2,0);
$colname = $r2["col_name"];
?>
</head>
<body>
<table align=center border='1' cellspacing=2 cellpadding=0 class="forumline" width=90%>
<tr><td align=center class="head" colspan=6>Employee List Staff Wise</td></tr>
<tr align=center><td align=center class="row2" colspan=6><b><? echo $_SESSION['SchoolName']?></b></td></tr>
<tr><td class="rowpic"><b>Sl No.</b></td><td class="rowpic"><b>Employee Code</b></td>
<td class="rowpic"><b>Employee Name<b></td><td class="rowpic"><b>Designation</b></td>
<td class="rowpic"><b>Department</b></td>
</tr>
<?php
$slno=1;
if($stafftype>0)
{
	$sql="select * from staff_group where id=$stafftype";
	$rs=execute($sql);
	$groupcount=rowcount($rs);
	
	if($groupcount!=0)
	{
		for($i=0;$i<$groupcount;$i++)
		{
			$row=fetcharray($rs,$i);
			$groupid=$row[id];
			$groupname=$row[name];
			//started here
			$sql3="select * from dept_no";
			$rs3=execute($sql3);
			$detrow=fetcharray($rs3);
			$dept_id=$detrow[dpt_id];
	
			$sql2="select a.* from staff_det a,staff_des d where active='YES' and d.group_id=$groupid order by d.priority";
			$rs2=execute($sql2);
			$staffcount=rowcount($rs2);
			if($staffcount!=0)
			{
				echo "<tr><td colspan=5 class='row2' align='center'>$groupname</td></tr>";
			}
			$sql1="select * from staff_des where group_id='$groupid' order by priority ";
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
						$sql2="select * from staff_det where type_id=$desid and subj=$dept_id and  active='YES' order by f_name";
						$rs2=execute($sql2);
						$staffcount=rowcount($rs2);
						if($staffcount!=0)
						{
							//echo "<tr>";							
							for($k=0;$k<$staffcount;$k++)
							{
								if($slno%2)
								echo "        <tr class='clsname'> ";
								else
								echo "        <tr > ";
								$i++;
								$row2=fetcharray($rs2,$k);
								
								echo "<td class='StudBody'>&nbsp;$slno</td>";
								echo "<td class='StudBody'>&nbsp;$row2[slno]</td>";
								echo "<td class='StudBody'>&nbsp;$row2[f_name] $row2[s_name]</td>";
								echo "<td class='StudBody'>&nbsp;$row1[d_name]</td>";
								echo "<td colspan=4 class='StudBody'>&nbsp;&nbsp;$dept_name</td></tr>";
								echo "</tr>";
								$slno=$slno+1;
							}
						}
					}
				}
			}
		}
	}
}
else
{
	$sql="select * from staff_group ";
	$rs=execute($sql);
	$groupcount=rowcount($rs);
	
	if($groupcount!=0)
	{
		for($i=0;$i<$groupcount;$i++)
		{
			$row=fetcharray($rs,$i);
			$groupid=$row[id];
			$groupname=$row[name];
			//started here
			$sql3="select * from dept_no";
			$rs3=execute($sql3);
			$detrow=fetcharray($rs3);
			$dept_id=$detrow[dpt_id];
	
			$sql2="select a.* from staff_det a,staff_des d where active='YES' and d.group_id=$groupid order by d.priority";
			$rs2=execute($sql2);
			$staffcount=rowcount($rs2);
			if($staffcount!=0)
			{
				echo "<tr><td colspan=5 class='row2' align='center'>$groupname</td></tr>";
			}
			$sql1="select * from staff_des where group_id='$groupid' order by priority";
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
						$sql2="select * from staff_det where type_id=$desid and subj=$dept_id and  active='YES' order by f_name";
						$rs2=execute($sql2);
						$staffcount=rowcount($rs2);
						if($staffcount!=0)
						{
							//echo "<tr>";
							//$i=0;
							for($k=0;$k<$staffcount;$k++)
							{
								if($slno%2)
								echo "<tr class='clsname'> ";
								else
								echo "<tr > ";
								$row2=fetcharray($rs2,$k);								
								echo "<td class='StudBody'>&nbsp;$slno</td>";
								echo "<td class='StudBody'>$row2[slno]</td>";
								echo "<td class='StudBody'>$row2[f_name] $row2[s_name]</td>";
								echo "<td class='StudBody'>$row1[d_name]</td>";
								echo "<td class='StudBody'>&nbsp;&nbsp;$dept_name</td></tr>";
								echo "</tr>";
								$slno=$slno+1;
							}
						}
					}
				}
			}
		}
	}
}
echo "<br>";
?>
</table>
<br>
<div id='prn' align='center'>
<input type='button' class='bgbutton' value='PRINT' Onclick='return sh()'>
</div>
</body>
</html>