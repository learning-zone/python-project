<html>
<script LANGUAGE="JavaScript">

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
	function reload()
	{
		document.frm1.action="emp_list_dep.php";
		document.frm1.submit();
	} 
	
function reload1()
    {
        document.frm1.action="Emp_List_Department.php";
        document.frm1.submit();
    }
	
     
</script>

<body>
<?php
session_start();
require("../db.php");
$subj = $_POST['subj'];
$falg = $_POST['flag'];

$flag = 0;
if(empty($f_name)  && ($subj=="0") && ($staff_status=="0")  && empty($staff_id))
{
        die("<b>Please select proper details!! <a href='Emp_List_Department.php'>Back to Search Form</a>");
}
 else  
 $SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id ";
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
			$SQL .= "and  a.subj =' $subj'" ;
			$flag = 1;
		}
		else
		{
			$SQL .= " AND a.subj = '$subj'";
		}
	}


        
	if($staff_status=="1" )
	{
		$SQL .= " and a.staff_status_id=1 and a.active='YES'  ";
	}
	elseif($staff_status=="2")
	{
		$SQL .= " and a.staff_status_id=2 and a.active='NO' ";
	}
	$SQL.="  ORDER BY a.type_id,a.f_name $key2 ";
	$rs = execute($SQL) or die(mysql_error());
	$num = rowcount($rs);

	if($num == 0)
	{
		$flag =1;
		//die("<div align='left' class='Label'>No records found<<a href='Emp_List_Department.php'>Back to Search Form>");
		?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("No records found");
        </script>
        <?php
		//exit();
	}
	?>
<form method='post' action="emp_list_dep.php"  name="frm1" >

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
<?php
/*
<div align="right" id="sorted"  >
<font color="red"><b>
Sort By : ASC&nbsp;&nbsp;<input type="radio" name='key2' value='ASC' onclick='reload()' <?=$sel1?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DSC<input type="radio" name='key2'  value='DESC'  onclick='reload()' <?=$sel2?> >
</b>
</font>
</div>
*/
?>
<div align='center'><center>
	<table border="1"  cellpadding="0" class="forumline" align=center width="90%">
      <tr><td Class="head" colspan="5" align=center>View Staff Details </td></tr>
	  
	
	
	 <tr>
     <?php
	 /*
	<td class="row2" align='center'><strong>
		 <a href="emp_list_dep.php?&key2=<?php echo $key2 ?>&key1=<?php echo f_name ?>&staff_status=<?php echo $staff_status ?>&f_name=<?php echo $f_name ?>&subj=<?php echo $subj ?>&staff_id=<?php echo $staff_id ?>">Name</a></td>
	<td  class="row2" align='center'>
		<a href="emp_list_dep.php?&key2=<?php echo $key2 ?>&key1=<?php echo slno ?>&staff_status=<?php echo $staff_status ?>&f_name=<?php echo $f_name ?>&subj=<?php echo $subj ?>&staff_id=<?php echo $staff_id ?>">Staff Id</a></td>
        */
        ?>
        <td class="row2" align='center'>
		Name</td>
        <td class="row2" align='center'>
		Staff Id</td>
	<td class="row2" align='center'>
		Department</td>
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
		
		<td  class="CBody" align="left" nowrap>&nbsp;&nbsp;
			<?php echo $r["f_name"] . " " . $r["s_name"] ?>
		</td>
		<td  class="CBody" align="left" nowrap>&nbsp;&nbsp;<?php echo $r["slno"]?></td>
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
		<td class="CBody" align="left" nowrap>&nbsp;&nbsp;<?php echo $department?> </td>
		<td  class="CBody" align="left" nowrap>&nbsp;&nbsp;<?php echo $designation?> </td>	
		<td  class="CBody" align="center" nowrap>&nbsp;&nbsp;
			<a Style='text-decoration: none' href='view_sta.php?id=<?php echo $r["id"]?>'>View</a>
			</td></tr>
            
            
		<?php
		
	}
	?>
	</table>
    <?php
		exit();

?>
<?php
if($flag==1)
{
?>
</head>
<body onLoad="reload1()">
<?php
}

?>
     </body>
     </html>