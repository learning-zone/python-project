<?php
session_start();
require_once("../../db.php");

if($_SESSION)
{
	$academic_year=$_SESSION['AcademicYear'];
    $branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}

if($_POST)
{

	$class_section_id=$_POST['class_section_id'];
	$description=$_POST['description'];
	$member_type=$_POST['member_type'];
	$group_name=$_POST['group_name'];
	$studfname=$_POST['studfname'];
	$studdet=$_POST['studdet'];
	$branch=$_POST['branch'];
	$app_no=$_POST['app_no'];	
	$id=$_POST['id'];
	$sem=$_POST['sem'];
	$subj=$_POST['subj'];
}
if($_GET)
{
	$class_section_id=$_GET['class_section_id'];
	$description=$_GET['description'];
	$member_type=$_GET['member_type'];
	$group_name=$_GET['group_name'];
	$Unchecked=$_GET['Unchecked'];
	$branch=$_GET['branch'];
	$Sel=$_GET['Sel'];
	$msg=$_GET['msg'];
	$sem=$_GET['sem'];
	$id=$_GET['id'];
	$subj=$_GET['subj'];
}

//print_r($_SESSION);
//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);
if($msg)
{
	?><head><script type="text/javascript">
		      alert('<?=$msg?>');
		  </script></head>
	<?
}

?>
<html>
<head>
<script language="javascript">
function reload(str)
{
	var url="../../sessionbranchfile.php";
	url=url+"?q="+str;
	url=url+"&sid="+Math.random();
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	  {
		document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
	  }
	}
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}
</script>
<script language="javascript">
	function adds_onclick()
	{
		
		document.frm.action="mail_member_edt.php?Type=Add";
		document.frm.submit();
		//return true;
	}
	function RefreshMe()
	{
		document.frm.action="mail_member.php";
		document.frm.submit();
	}
</script>
</head>

		  <title>GROUP MAIL</title>
<body>
<form name="frm" method="POST" action="mail_member.php">
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='47%'>
<tr>
    <td align='center' class='head' colspan='3'>MAIL GROUP MASTER FORM</td>
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;Group Name </td>
	  <td><select name='group_name'>
		<?php
			$sql=execute("SELECT id, group_name FROM `mail_group` where status=1 ORDER BY id");
				while($r=fetcharray($sql))
				{
					if($group_name==$r[id])
					echo "<option value='$r[id]'  selected>$r[group_name]</option>";
					else
					echo "<option value='$r[id]' >$r[group_name]</option>";
				}
				
		?>
		</select></td>
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;Member Type </td>
	  <td><select name='member_type'  OnChange='RefreshMe()'>
		<?php
			$sql=execute("SELECT id, name FROM `mail_member_field` where status=1 ORDER BY id");
				while($r=fetcharray($sql))
				{
					if($member_type==$r[id])
					echo "<option value='$r[id]'  selected>$r[name]</option>";
					else
					echo "<option value='$r[id]' >$r[name]</option>";
				}
				
		?>
		</select></td>
</tr>
<?
if($member_type!=4 )
{
$sql1 = "SELECT * FROM course_m where status=1";
?>
<tr height="25">
	<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
	<td colspan="2" align="left">
	<select name="branch" size="1" OnChange='reload(this.value)'>
		<option selected value="-1">------- Select --------</option>
		<?php
		$rs1 = execute($sql1);
		$num = rowcount($rs1);
		for($i=0;$i<$num;$i++)
		{
			$r1 = fetcharray($rs1,$i);
			if($branch==$r1[0])
			{
				echo "<option value='$r1[0]' selected>$r1[1]</option>";
			}
			else
			{
				echo "<option value='$r1[0]'>$r1[1]</option>";
			}
		}
		?>
    </select> </td>
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
	<td><div id="txtHint9" class="inline">   
	<select name="sem" >
	<?php
		$sq=fetcharray(execute("select * from course_m where course_id='$branch'"));
		$cname=$sq[head_id];
		$sql2 = "SELECT * FROM course_year where status=1 and head_id='$cname'";
		$rs2 = execute($sql2);
		$num = rowcount($rs2);
		echo "<option value=\"0\">-- Select --</option>";
		for($i=0;$i<$num;$i++){
		$r2 = fetcharray($rs2,$i);
		if($sem==$r2[0])
		echo "<option value=\"$r2[0]\" selected>$r2[1]</option>";
		else
		echo "<option value=\"$r2[0]\">$r2[1]</option>";
		
		}
	
	  ?> </select></div></td>
</tr>
<?php
}
else
{
	?>
    <tr>
    <td>&nbsp;&nbsp;Department</td>
    <td ><select  name="subj" size="1" OnChange='RefreshMe()'>
    <option  value="0"> --All-- </option>
    <?php
    $temp = "SELECT * FROM dept_no";
    
    $rs = execute($temp);
    
    $num = rowcount($rs);
    
    for($i=0;$i<$num;$i++)
    {
		$r = fetcharray($rs,$i);
		if($subj==$r[1])
		echo("<option value='" . $r[1] . "' selected>" . $r[0] . "</option>");
		else
		echo("<option value='" . $r[1] . "'>" . $r[0] . "</option>");
    }
    ?>
    </select></td>
</tr>

    <?php
	
}
?>
</table>
<p align="center"><input type="submit" class='bgbutton' value=" Search " name="studdet"></p>

<?php

	$sql1=execute("SELECT name_field, mail_field, phone FROM `mail_member_field` where id='$member_type' ORDER BY id");
	while($r=fetcharray($sql1))
	{
		$name_field=$r[0];
		$mail_field=$r[1];
		$phone=$r[2];
	}	


if($member_type!=4)
{
	if(!$_POST['studdet'] and ! $_REQUEST)
	die();
		$sql="select id, first_name, last_name, $name_field, $mail_field, $phone from student_m where id is not null and archive='N' and academic_year='$academic_year'";
		if($app_no!='')
		{
		 $sql.=" and student_id='$app_no'";
		}
		if($sem!=0)
		{
		$sql.=" and course_yearsem=$sem";
		}
		if($class_section_id!='')
		{
		$sql.=" and class_section_id=$class_section_id  ";
		}
		
		if($studfname!='')
		{
		 $sql.=" and first_name like '$studfname%'";
		}
	 $sql.=" order by first_name";
			$rs=execute($sql);
	
		if(rowcount($rs)==0)
		{
			die("<center><b>No Records Found !!</b></center>");
		}
	
		$parent_name=fetcharray(execute("SELECT name FROM `mail_member_field` WHERE `id` = '$member_type'"));
	?>
	
	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='98%'>
	<tr height='25' >
		<td Class="rowpic" align='center' width="5%">Sl No</td>
		<td Class="rowpic" align='center' width="30%">Student Name</td>
		<td Class="rowpic" align='center' width="30%"><?=$parent_name[0]?>&nbsp;&nbsp;Name</td>
		<td Class="rowpic" align='center' width="20%">Email</td>
		<td Class="rowpic" align='center' width="10%">Phone No.</td>
		<td Class="rowpic" align='center' width="5%">Select</td>
	</tr>
	<tr>
	<?php
	  $rowclass=1;
	  $sno=1;
		for($i=0;$i<rowcount($rs);$i++)
		{
			$r=fetcharray($rs);
			if($sno<10)
				$sno="0".$sno;
			if($i%2)
			echo "	<tr class='clsname' > ";
			else
			echo "	<tr > ";
			?>
		
			<td align='center' ><?=$sno?></td>
			<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
			<td>&nbsp;&nbsp;<?=$r[3]?></td>
			<td>&nbsp;&nbsp;<?=$r[4]?></td>
			<?php
				if($r[5]==0)
				{
					$phno='';
				}
				else
				{
					$phno=$r[5];
				} 
			?>
			<td align='center' ><?=$phno?></td>
			<?php
				   
				   $selected_val=fetcharray(execute("SELECT stud_id FROM `mail_member` WHERE `stud_id` = '$r[id]' AND `member_type` = '$member_type' AND `group_name`= '$group_name' AND status=1 "));
				   if($selected_val[0])
				   $check='checked';
				   else
				   $check='';
				   
			?>
			
			<td align="center">
			<input type="hidden" name="Unchecked[]" value="<?=$r[id]?>">
			<Input Type="checkbox" name="Sel[]" value="<?=$r[id]?>" size="10" <?=$check?>></td>
			
	  </tr>
			<?php
			$sno++;
			$rowclass = 1 - $rowclass;
		}
	?>
	</table>
<?php
}
else
{
	?>
        <br>
     <?php
    $SQL = "SELECT a.* ,b.* FROM staff_det a ,staff_des b WHERE a.type_id=b.d_id and a.Active='YES'  ";
	$flag = 0;
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
		die("No records found");
	}
	?>
	<table border='1'  align="center" width="90%">
	
	<td class="head" align='LEFT'>Name
	</td>
	<td class="head" align='LEFT'>Staff Id
	</td>
	<td class="head" align='LEFT'>
	Department</td>
	<td  class="head" align='LEFT'>
	Designation</td>
	<td width="7%" align="center" class="head" nowrap><div class="head" id="checkAll" 
	onClick="selectMe()" Title="Click to Select all Students">Select ALL<input type="checkbox"></div></td>

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
		
		<td  class="CBody" align="LEFT">
		&nbsp;<?php echo $r["f_name"] . " " . $r["s_name"] ?>
		</td>
		<td  class="CBody" align="LEFT">&nbsp;<?php echo $r["slno"]?></td>
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
		<td class="CBody" align="CENTER"><?php echo $department?> </td>
		<td  class="CBody" align="LEFT">&nbsp;<?php echo $designation?> </td>
		<!--	<td class="CBody" align="left"><font face='Lucida Sans' ><?php //echo $ex?> Years</font></td>-->
		<td  class="CBody" align="CENTER">
		<?php
        
        $selected_val=fetcharray(execute("SELECT stud_id FROM `mail_member` WHERE `stud_id` = '$r[id]' AND `member_type` = '$member_type' AND `group_name`= '$group_name' AND status=1 "));
        if($selected_val[0])
        $check='checked';
        else
        $check='';
        
        ?>
		
       	<input type="hidden" name="Unchecked[]" value="<?=$r[id]?>">
	 	<input type="checkbox" name="Sel[]" value="<?=$r[id]?>" <?=$check?>>
		</td></tr>
		<?php
	}
	?>
	</table>
<?php
}
?><p align="center"><input type="submit"  value=" Add " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>
</form>
</body>
</html>