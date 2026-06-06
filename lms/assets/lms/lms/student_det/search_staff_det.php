<?php
session_start();
require("../db.php");


if($_POST)
{
	$B1 = $_POST['B1'];
	$subj = $_POST['subj'];
	$f_name = $_POST['f_name'];
	$staff_id = $_POST['staff_id'];
}
?>
<html>
<head>
<Script language="JavaScript">
function start()
{
 document.frm.dob.options[0].selected=true
}
function delete_me(id1)
{

	if(confirm("Are you sure that you want to delete this record"))
	{
		window.location.href = "delete.php?delete_id=" + id1;
	}
}

function check_data()
{
  document.frm.submit();
}
</script>
<script type="text/javascript">
function reloadMe(reloadMe)
{
	 //alert(reloadMe); 
	 window.opener.location.href="lib.php?tmid="+reloadMe+"&medtyp=3&memtp=2&type=2";
	 window.close();
}
</script>
</head>
<body topmargin="15" leftmargin="5" onLoad="start()">
<form method="POST"  action="search_staff_det.php" name="frm">
<table border=0 width="90%" align="center" class="forumline">
<tr>
	<td Class="head" colspan=6 align=center >SELECT STAFF ID</td>
</tr>
 <tr>
      <td >&nbsp;Staff ID</td>
      <td><input type="text" name="staff_id" size="15" ></td>
      <td >First Name</td>
      <td><input type="text" name="f_name" size="25" ></td>
      <td align='center'>Department</td>
      <td ><select  name="subj" size="1" onChange="reload()">
      <option  value="0">---  Select ---</option>
	  <?php
      $temp = "SELECT * FROM `dept_no` WHERE `status`=1";     
      $rs = execute($temp);
      $num = rowcount($rs);
      
      for($i=0;$i<$num;$i++)
      {
          $r = fetcharray($rs,$i);
         // echo("<option value='" . $r[1] . "'>" . $r[0] . "</option>");
		  if($subj==$r[1])
		  {
			  echo "<option value='$r[1]' selected>$r[0]</option>";
		  }
		  else
		  {
			  echo "<option value='$r[1]'>$r[0]</option>";
		  }
      }
      ?>
	</select></td>
    </tr></table>

<p align="center"><input type="submit" value="Search" name="B1" class='bgbutton' onClick="reload()"></p>

<input type="hidden" name="display" value="<?php echo $display?>">
<input type='hidden' name='key2' value="<?php echo ASC ?>">
<input type='hidden' name='key1' value="<?php echo slno ?>">

<?php       

if($_POST['B1'] or $_REQUEST)
{
	
	if(empty($f_name)  && ($subj=="0") && empty($staff_id))
	{
		die("<center><font color='red'><blink>Please Select Proper Details...!!!</blink></font></center>");
	}

	$SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id and a.active='YES'  ";
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
		die("<center><blink>No records found...!!!</blink></center>");
	}
	?>
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
<form method='post' action="search_staff_det.php"  name="frm1" >
    <input type="hidden" name="key2" value="<?php echo $key2?>">
    <input type="hidden" name="key1" value="<?php echo slno?>">
    <input type="hidden" name="staff_status" value="<?php echo $staff_status?>">

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
<table border="1" width="90%" cellpadding="0" class="forumline" align="center">
<tr>	 
	<td class="row3" align='LEFT' nowrap>SL.No</td>
    <td class="row3" align='LEFT'>Staff Id</td>
	<td class="row3" align='LEFT'>Name</td>
	<td class="row3" align='LEFT'>Department</td>
	<td  class="row3" align='LEFT'>Designation</td>
	<?php

	for($i=0;$i<$num;$i++)
	{
		if($i%2)
               echo "<tr class='clsname' > ";
               else
               echo "<tr>";
		$r = fetcharray($rs,$i);
		$ar2 = getdate($r["j_date"]);
		$ar3 = getdate(time());
		$d=explode(" ",$r["j_date"]);
	
		?>
		<td  class="CBody" align="center"><?=$i+1?></td>
    <td class="CBody" align="LEFT">
    <font color="#0033FF"><u><a LANGUAGE="JavaScript" onClick="reloadMe('<?=$r[slno]?>')"><?=$r[slno]?></a></font></u></td>		
		<td  class="CBody" align="LEFT">&nbsp;<?php echo $r["f_name"] . " " . $r["s_name"] ?></td>
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
		<td  class="CBody" align="LEFT">&nbsp;<?php echo $designation?> </td>
		
    </tr>
		<?php
	}
}
	 ?>
    </form>
    </td>
 </body>
</html>

