<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
</head>
<?php
session_start();
require("../db.php");
$subj = $_POST['subj'];
$id = $_POST['id'];
if(empty($f_name)  && ($subj=="0") && ($staff_status=="0")  && empty($staff_id))
{
        die("Please select proper details!! <a href='search.php'>Back to Search Form</a>");
}
  
	if($subj==0)
	{
	$SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id order by a.type_id , a.f_name";
	}
	else
	{
	$SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id and a.type_id='$subj' order by  a.f_name";
	}
	
 
	$rs = execute($SQL) or die(mysql_error());
$num = rowcount($rs);
	if($num ==0)
	{
		$flag =1;
		//die("<div align='left' class='Label'>No records found<<a href='Emp_List.php'>Back to Search Form>");
		?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("No records found");
        </script>
        <?php
	}
	//else
	{
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
	<table border="1" width="60%" cellpadding="0" class="forumline" align=center>
      <tr><td Class="head" colspan=4 align=center>View/Modify Staff Details </td></tr>
	  </table>
	<div align='center'><center>
	<table border='1' class='forumline' width="60%">
	 <tr>
	<td class="row2" align='center'>
		 Name</td>
	<td  class="row2" align='center'>
		Staff Id</td>
	<td  class="row2" align='center'>
	Designation</td>
        <td  class="row2" align='center'>
	Action</td></tr>
	<?php

	for($i=0;$i<$num;$i++)
	{
		if($i%2)
               echo "        <tr class='clsname' > ";
               else
               echo "        <tr > ";
		$r = fetcharray($rs,$i);
		$ar2 = getdate($r["j_date"]);
		$ar3 = getdate(time());
		$d=explode(" ",$r["j_date"]);
	
		?>
		
		<td  class="CBody" align="left">&nbsp;
			<?php echo $r["f_name"] . " " . $r["s_name"] ?>
		</td>
		<td  class="CBody" align="left"><?php echo $r["slno"]?></td>
		<?php 
		$rs_sql=execute("select * from staff_des where d_id='$r[type_id]' order by priority");
		$designation="";
		if(rowcount($rs_sql)>0)
		{
			$r_sql=fetcharray($rs_sql);
			$designation=$r_sql[d_name];
		}
		mysql_free_result($rs_sql);
		$rs_sql=execute("select * from dept_no where dpt_id='$r[subj]'");
		$department="";
		if(rowcount($rs_sql)>0)
		{
			$r_sql=fetcharray($rs_sql);
			$department=$r_sql[Dept];
		}
		mysql_free_result($rs_sql);
		?>
		<td  class="CBody" align="left">&nbsp;<?php echo $designation?> </td>
		<td  class="CBody" align="center">
		<a Style='text-decoration: none' href='view_sta.php?id=<?php echo $r["id"]?>'>&nbsp;View</a>
		</td></tr>
		<?php
	}	
 }
?>

<?php

if($flag==1)
{
?>
	<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="Emp_List.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
<?php
}

?>

     </body>
     </html>

