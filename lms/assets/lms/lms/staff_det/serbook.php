<html>
<head>
<?php
session_start();
require("../db.php");
?>
</head>
<body>
<?php
if(empty($f_name) && empty($slno) && ($subj=="0"))
{
        print("<font color=red><b>Please enter details!! <a href='archive_search.php'> Back to Search Form</a></font>");
}
else
{
	$SQL = "SELECT distinct f_name,id,slno,staff_status_id,s_name,subj,type_id FROM staff_det WHERE id !=''";
	
	if($f_name != "")
		$SQL .= " and f_name LIKE '$f_name%'";

	if($slno != "")
		$SQL .= " and slno='$slno'";
	
	if($subj != "0")
		$SQL .= " and subj = $subj" ;
	if($sts>0)
	{
		if($sts==1)
			$stts='YES';
		else
			$stts='NO';
		$SQL .=" and active='$stts'";
	}

	$SQL.=" group by f_name";
	$rs = execute($SQL) or die("Query Failed.");
	$num = rowcount($rs);
	if($num == 0)
	{
		die("<div align='left' class='Label'>No Records Found</div>");
	}
	?>
	<table class="forumline" align="center">
	<tr><td Class="head" colspan=6 align=center><font face='Lucida Sans' size='4'>Staff List</font></td></tr>
	<tr><td colspan=6 align=center><font face='Lucida Sans' color='Brown'>*** Click on Required Action ***</font></td></tr>
	<tr><td  class="row3" align='center'><strong><font face='Lucida Sans' size='1.8'>Sl No</font></strong></td>
	<td  class="row3" align='center'><strong><font face='Lucida Sans' size='1.8'>Staff Id</font></strong></td>
	<td  class="row3" align='center'><strong><font face='Lucida Sans' size='1.8'>Name</font></strong></td>
	<td  class="row3" align='center'><strong><font face='Lucida Sans' size='1.8'>Department</font></strong></td>
	<td  class="row3" align='center'><strong><font face='Lucida Sans' size='1.8'>Designation</font></strong></td>
	<td  class="row3" align='center'><strong><font color='brown' face='Lucida Sans' size='1.8'>Action</font></strong></td></tr>
	<?php
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		$i1=$i+1;
		if($i1<10)
			$i1="0".$i1;
		?>
		<tr height='25'><td align=center><?=$i1?></td><td  class="CBody"><font face='Lucida Sans' size='1.5'>&nbsp;&nbsp;&nbsp;<?php echo $r["slno"]?></font></td>
		<td class="CBody" ><font face='Lucida Sans' size='1.5'><?php echo strtoupper($r["f_name"]) . " " . strtoupper($r["s_name"])?></font></td>
		<?php 
		$rs_sql=execute("select * from staff_des where d_id=$r[type_id] order by priority");
		$designation="";
		if(rowcount($rs_sql)>0)
		{
			$r_sql=fetcharray($rs_sql);
			$designation=$r_sql[d_name];
		}
		mysql_free_result($rs_sql);
		$rs_sql=execute("select * from dept_no where dpt_id=$r[subj]");
		$department="";
		if(rowcount($rs_sql)>0)
		{
			$r_sql=fetcharray($rs_sql);
			$department=$r_sql[Dept];
		}
		mysql_free_result($rs_sql);
		?>
		<td  class="CBody"><font face='Lucida Sans' size='1.5'><?php echo $department?></font></td>
		<td class="CBody"><font face='Lucida Sans' size='1.5'><?php echo $designation?></font></td>
		<td  class="CBody"><a Style='text-decoration: none'
		href='viewserbook.php?id=<?php echo $r["id"]?>'><font face='Lucida Sans' size='1.5'>&nbsp;VIEW&nbsp;</font></a></td></tr>
		<?php
	}
}
?>
</table>
</body>
</html>