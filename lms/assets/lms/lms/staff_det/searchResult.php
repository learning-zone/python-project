<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
</head>
<script LANGUAGE="JavaScript">

function reload()
	{
		
		document.frm1.action="searchResult.php";
		document.frm1.submit();
	} 
</script>
<?php
session_start();
require("../db.php");
$staff_id = $_POST['staff_id'];
$f_name = $_POST['f_name'];
$subj = $_POST['subj'];
$id1 = $_POST['id1'];
if(empty($f_name)  && ($subj=="0") && empty($staff_id))
{
        die("<b>Please select proper details!! <a href='search.php'>Back to Search Form</a>");
}
   
	$SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id and a.Active='YES'  ";
	$flag = 0;
	if($staff_id !="")
	{
		$SQL .= " and a.slno='$staff_id' ";
		$flag = 1;
	}
	if($f_name != "")
	{
		if($flag==0)
		{
			$SQL .= "and  a.f_name LIKE '%$f_name%'";
			$flag = 1;
		}
		else
		{
			$SQL .= " and a.f_name LIKE '%$f_name%'";
		}
	}
	 if($subj != 0)
	{
		if($flag == 0)
		{
			$SQL .= "and  a.subj = $subj" ;
			$flag = 1;
		}
		else
		{
			$SQL .= " AND a.subj = $subj";
		}
	}
     $SQL.=" order by a.f_name";
        $rs = execute($SQL) or die(mysql_error());
	$num = rowcount($rs);

	if($num == 0)
	{
		die("<div align='left' class='Label'>No records found<<a href='search.php'>Back to Search Form>");
	}
	?>
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
                window.location.href = "delete.php?delete_id=" + id1;
        }
	}
	</script>

	</head>
	<body>
		<form method='post' action="searchResult.php"  name="frm1" >

		<input type="hidden" name="key2" value="<?php echo $key2?>">
<input type="hidden" name="key1" value="<?php echo slno?>">
	<input type="hidden" name="staff_status" value="<?php echo $staff_status?>">
<input type="hidden" name="f_name" value="<?php echo $f_name?>">
<input type="hidden" name="subj" value="<?php echo $subj?>">

<input type="hidden" name="staff_id" value="<?php echo $staff_id?>">


		<?php

if($key2=="ASC")
{
	$sel1="checked";
	$sel2="";
}
if($key2=="DESC")
	{
	$sel1="";
	$sel2="checked";

}

?>
<div align="right" id="sorted"  >

Sort By : ASC&nbsp;&nbsp;<input type="radio" name='key2' value='ASC' <?=$sel1?> onclick='reload()'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DSC<input type="radio" name='key2'  value='DESC'  <?=$sel2?> onclick='reload()'>

</div>
	<table border="0" width="90%" cellpadding="0" class="forumline" align="center">
      <tr><td Class="head" colspan=4 align=center>View/Modify Staff Details </td></tr>
	  </table>
	<div align='center'><center>
	<table border='0'  align="center" width="90%">
	 
	<td class="row3" align='LEFT'>Name
		 </td>
	<td class="row3" align='LEFT'>Staff Id
		 </td>
	<td class="row3" align='LEFT'>
		Department</td>
	<td  class="row3" align='LEFT'>
	Designation</td>
        <td  class="row3" align='LEFT'>
	Action</td>
    
	<?php

	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		$ar2 = getdate($r["j_date"]);
		$ar3 = getdate(time());
		$d=explode(" ",$r["j_date"]);
	
		?>
		<tr>
		<td  class="CBody" align="LEFT">
			<?php echo $r["f_name"] . " " . $r["s_name"] ?>
		</td>
		<td  class="CBody" align="LEFT"><?php echo $r["slno"]?></td>
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
		<td class="CBody" align="LEFT"><?php echo $department?> </td>
		<td  class="CBody" align="LEFT"><?php echo $designation?> </td>
	<!--	<td class="CBody" align="left"><font face='Lucida Sans' ><?php echo $ex?> Years</font></td>-->
		<td  class="CBody" align="LEFT">
			<a Style='text-decoration: none; ' href='modify.php?id1=<?php echo $r["id"]?>'>Modify</a>
			</td></tr>
		<?php
	}

?>
</table>
</form>
</body>

</html>
