	<html>
	<head>

	<Script language="JavaScript">
	function start()
	{
		document.frm.dob.options[i].selected=true
	}

	function delete_me(id1)
	{

		if(confirm("Are you sure that you want to delete this record"))
		{
                window.location.href = "delete_sta.php?delete_id=" + id1;
        }
	}
	</script>

	</head>
	<body>
	<?php
session_start();
require("../db.php");
if(empty($f_name) && empty($s_name) && ($dob=="0") && ($subj=="0") && ($staff_status=="0") && empty($qual) && empty($sp_assoc) && empty($xtra) && empty($staff_id))
{
        print("<font color=red><b>Please select proper details!! <a href='view_staff_details.php'>Back to Search Form</a></font>");
}
//Modification done by shri on date: 18/06/04
else
{
	$SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id and";
	$flag = 0;
	if($staff_id !="")
	{
		$SQL .= " a.slno='$staff_id' ";
		$flag = 1;
	}
	if($f_name != "")
	{
		if($flag==0)
		{
			$SQL .= " a.f_name LIKE '$f_name%'";
			$flag = 1;
		}
		else
		{
			$SQL .= " and a.f_name LIKE '$f_name%'";
		}
	}
	if($subj != 0)
	{
		if($flag == 0)
		{
			$SQL .= " a.subj = $subj" ;
			$flag = 1;
		}
		else
		{
			$SQL .= " AND a.subj = $subj";
		}
	}

	$SQL.=" ORDER BY a.f_name";
	
	$rs = execute($SQL);
	$num = rowcount($rs);

	if($num == 0)
	{
		die("<div align='left' class='Label'>No records found</div>");
	}
	?>
	<table border='0' class='forumline' align='center'>
	<tr><td Class="head" colspan=5 align=center><font face='Lucida Sans' size='4'>View Staff Details </font></td></tr>
	 <tr>
	<td class="CHead" align='center'><strong>
		 <font face="Arial" size='2'>Name</font></strong></td>
	<td  class="CHead" align='center'>
		<strong><font face="Arial" size='2'>Staff Id</font></strong></td>
	<td class="CHead" align='center'>
		<strong><font face="Arial" size='2'>Department</font></strong></td>
	<td  class="CHead" align='center'>
	<strong><font face="Arial" size='2'>Designation</font></strong></td>
        <td  class="CHead" align='center'><font face="Arial" size='2'>
	<strong>Action</strong></font></td></tr>
	<?php

	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		$ar2 = getdate($r["j_date"]);
		$ar3 = getdate(time());
		$d=explode(" ",$r["j_date"]);
	
		?>
		<tr>
		<td  class="CBody" align="left"><font face="Arial" size='1.8'><b>
			<?php echo $r["f_name"] . " " . $r["s_name"] ?>
		</b></font></td>
		<td  class="CBody" align="left"><font face="Arial" size='1.8'><?php echo $r["slno"]?></font></td>
		<?php 
		$rs_sql=execute("select * from staff_des where d_id=$r[type_id]");
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
		<td class="CBody" align="left"><font face='Lucida Sans' ><?php echo $department?> </font></td>
		<td  class="CBody" align="left"><font face='Lucida Sans' ><?php echo $designation?> </font></td>
		<td  class="CBody" align="center"><small><font face='Lucida Sans' >
			<a Style='text-decoration: none' href='view_sta.php?id=<?php echo $r["id"]?>'>View</a>
			</font></small></td></tr>
		<?php
	}
}
?>
</table>
</body>
</html>
