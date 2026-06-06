<html>
<head><title>Add User Groups</title>
<script language="JavaScript">
function RefreshMe()
{
	document.frm.action="ModUserGroup.php";
	document.frm.submit();
}
</script>
</head>
<body class='bodyline'>
<?php
include("../db.php");
echo "$msg";
$gname=$_POST['gname'];
$module1=$_POST['module1'];
?>

<form name="frm" method="post" action="saveusergroup1.php" >
<?php if($flag==1)
{
	echo "$msg<br>";
	echo "<a href=ModUserGroup.php>Refresh</a>";
	$flag=0;
}
?>
<table align='center' class='forumline' width='50%'>
<tr><td Class="head" colspan=3 align=center>Modify User Group</td></tr>
<tr>
  <td align='LEFT' colspan="2">&nbsp;Group Name</td>
  <td>
    <select name="gname" onChange="RefreshMe()">
<option>--------------- Select ---------------</option>
<?
$sql = execute("select * from user_group group by group_name");
for ($i=0;$i<rowcount($sql);$i++)
{
	$r = fetcharray($sql, $i);
	if ($r["group_name"]==$gname)
	{
		echo "<option value='$r[group_name]' selected>$r[group_name]</option>";
	}
	else
	{
		echo "<option value='$r[group_name]'>$r[group_name]</option>";
	}
}
?>
</select></td></tr>
</table>

<?php
if(!empty($gname))
{
	$sql1="select id, module, submodule, linkname from user_group where group_name='$gname'";

	$rs1=execute($sql1);

	$flag_m = 1;
	$flag=1;
	$s1="";
	$m1="";
	echo "<br>";
	echo "<table align='center' class='forumline' width='50%'>";
	echo "<tr><td Class='head' colspan='2' align=center >Select Module</td></tr>";
	?>
	<tr>
<td align="center" colspan=2><select name="module1" onChange="RefreshMe()">
<option>------Select------</option>

<?php
		

	$sql=execute("select * from modules  order by module");
    for($i=0;$i<rowcount($sql);$i++)
	{    
		$r=fetcharray($sql,$i);
	    //echo "$rs";
		$sqlst="select Display_name from links where linkname='".$r['module']."' and module='Main'";
		$diname=fetchrow(execute($sqlst));
		if($diname[0]=='')
		$diname[0]='Main';
		if($r[module]==$module1)
		{
           echo "<option value='$r[module]' selected>$diname[0]</option>";
		}
		else
		{
			echo "<option value='$r[module]'>$diname[0]</option>";
		}
	}
?>
</select></td></tr>
<tr><td colspan=2>
<?php
}
if(!empty($module1))
{
	if($module1 <> '' )
	{
		$sql1="select a.*,b.*,b.id as linkid from submodules a,links b where a.module='$module1' and a.submodule=b.submodule and a.module=b.module order by b.submodule,b.linkname";
	}
	$rs1=execute($sql1) or die(error_description());
	$flag=1;
	$s1="";

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
		echo "<tr class='clsname'> ";
		else
		echo "<tr> ";
		$sqlst="select Display_name from links where linkname='".$r1['linkname']."' ";
		$diname=fetchrow(execute($sqlst));
		
		echo "<td>&nbsp;&nbsp;$diname[0]</td><td align='left'>";
		$qry="select * from user_group where group_name='$gname' and module='$r1[module]' and submodule='$r1[submodule]' and linkname='$r1[linkname]' order by submodule,linkname";
		$rs123=execute($qry);
			$r123=fetcharray($rs123);
			if($r123[linkname]==$r1[linkname])
			{	
				echo "<input type=checkbox name=id[] value=$r1[linkid] checked></td</tr>";
			
			}
			else
			{
				echo "<input type=checkbox name=id[] value=$r1[linkid]></td</tr>";
			}
			
	}
	echo "</table>";
	echo "<br>";
echo "<div align='center'><input type=submit name=addrights value='Add Rights' class='bgbutton'></div>";

}
?>
</form></body></html>
