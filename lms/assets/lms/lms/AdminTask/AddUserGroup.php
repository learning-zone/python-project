<html>
<head><title>Add User Groups</title>
<?php
	include("../db.php");
	
?>
<script language="JavaScript">
function RefreshMe()
{
	document.frm.action="AddUserGroup.php";
	document.frm.submit();
}
function form_validation()
{
	if(document.frm.group_name.value=="")
	{
		alert("Enter Group Name")	
		document.frm.group_name.focus()
	}
	else if(document.frm.group_name.value!=""){
		document.frm.flag.value=0;
		document.frm.submit()
	}
}
function next_page()
{
	document.frm.action="SaveUserGroup.php";
	document.frm.submit()
}
</script>
</head>
<body>
<?php
$group_name=$_POST['group_name'];

?>
<form name="frm" method="post">
<?php if($flag==1)
{
	echo "$msg<br>";
	echo "<a href=AddUserGroup.php>Refresh</a>";
	$flag=0;
}
?>
<table align='center' class='forumline' width='40%'>
<?

if($group_name=='')
{
	?>
    <div align="center"><small>
	Please Enter The Desired Group Name to be Created and press ENTER Key.
    </small>
    </div>
	<?
}

?>

<br><tr><td Class="head" colspan=2 align=center>Add User Group</td></tr>
<tr><td>&nbsp;Group Name</td><td><input type="text" name="group_name" value="<?=$group_name?>" onclick='form_validate()'></td></tr>
<?
if($group_name=="")
{
	die();
}	
$qry="select group_name from user_group where group_name='".strtoupper($group_name)."'";
$rs=execute($qry);
if(rowcount($rs)>0){
	echo "<center>Group Name Already Exist</center>";
	die();	
}
?>
<tr><td colspan=2>&nbsp;Please Select the Main Module First</td></tr>	
<tr><td>&nbsp;Select Module</td><td><select name="module1">
<?php
if($module1=="")
	$module1='Main';
	$sql=execute("select * from modules  where module='Main'") or die(error_description());
	for($i=0;$i<rowcount($sql);$i++)
	{
		$r=fetcharray($sql,$i);
		if($r[module]==$module1)
		{
			echo "<option value='$r[module]' selected>$r[module]</option>";
		}
		else
		{
			echo "<option value='$r[module]'>$r[module]</option>";
		}
	}
?>
</select></td></tr>
<tr><td colspan=2>
</td>
</tr>
</table>

<br>
<?php
if(!empty($module1))
{
	if($module1 <> '' )
	{
		$sql1="select a.*,b.*,b.id as linkid from submodules a,links b where a.module='$module1' and a.submodule=b.submodule and a.module=b.module order by b.submodule,b.linkname";
	}
	
$rs1=execute($sql1) or die(error_description());

$flag=1;
$s1="";
echo "<table border=0 class='forumline' align='center' width='40%'>";
	for($x=0;$x<rowcount($rs1);$x++)
	{
		$r1=fetcharray($rs1,$x);
		if($s1<>$r1[submodule])
		 {
			$flag=0;
		}
		if($flag==0)
		{
			echo "<tr><td colspan=2 Class='rowpic' align='center'>$r1[submodule]</td></tr>";
			$s1=$r1[submodule];
			$flag=1;
		}
		if($x%2)
		echo "        <tr class='clsname'> ";
		else
		echo "        <tr> ";
		echo "<td>&nbsp;$r1[linkname]</td><td><input type=checkbox name=id[] value=$r1[linkid] checked></td</tr>";
	}
	echo "</table>";

}

?>
</td></tr> 
</table>
<br>
<div align='center'>
<input type=button name=addrights value='Add Rights' class='bgbutton' onclick='next_page()'>
</div>

</form>
</body>
</html>

