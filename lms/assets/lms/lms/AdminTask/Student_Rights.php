<?php
session_start();
include("../db.php");
$submodulename=$_POST['submodulename'];
$modulename=$_POST['modulename'];
?>
<html>
<head>
<script language="javascript">
function reload()
{
	document.forms[0].submit();
}
</script>
</head>

<body class='bodyline' >
<?
if(isset($_POST['grant']))
{
	$qry="select * from links where module='$modulename' and submodule='$submodulename'";
	$rs = execute($qry);
	if($rs)
	{
		while($row=fetcharray($rs))
		{
			$temp = $_POST['access'.$row[id]];
			if($temp == 'on')
			{
				$acc = 'Yes';
			}
			else
			{
				$acc = 'No';
			}
			$qry = "select * from studentmenu where module='$modulename' and submodule='$submodulename' and linkname='$row[linkname]' and id=$row[id]";
			$rs1 = execute($qry);
			if($rs1)
			{
				if(rowcount($rs1)>0)
				{
					$qry="update studentmenu set access='$acc' where module='$modulename' and submodule='$submodulename' and linkname='$row[linkname]' and id=$row[id]";
				}
				else
				{
					$qry="insert into studentmenu values('$modulename','$submodulename','$row[linkname]','$row[linkpath]','$acc','$row[parameter]',$row[id])";				}
					execute($qry);
				}
			}
	}
}

echo "<form  method=post name='tempfrm'>";
echo "<table align=center class='forumline' width = '30%'>";
echo "<tr><td class='head' align='center' colspan=2>Add Student Rights</td></tr>";
//echo "select * from links where module='$modulename' and submodule='$submodulename'";
echo "<tr>";
echo "<td>&nbsp;&nbsp;Module</td>";
echo "<td>";
$qry="select * from modules order by id";
echo "<select name=modulename onChange=\"reload()\">";
//echo "<option value=''>&nbsp;&nbsp;Module Name</option>";
echo "<option value=''>----- SELECT -----</option>";

$rs = execute($qry);
if($rs)
{
	if(rowcount($rs)>0)
	{
		while($row=fetcharray($rs))
		{
			if($modulename==$row[module])
			{
				echo "<option value='$row[module]' selected>$row[module]</option>";
			}
			else
			{
				echo "<option value='$row[module]'>$row[module]</option>";
			}
		}
	}
}
echo "</select></td></tr>";
echo "<tr><td>";
echo "&nbsp;&nbsp;Sub Module</td>";
echo "<td>";
echo "<select name=submodulename onChange=\"reload()\">";
echo "<option value=''>----- SELECT -----</option>";
/*Modified By Manjula On 07-06-2006
FOr Student not required the material upload link(Only for Staff)*/
if($modulename=='Online Class')
{
	$qry="select * from submodules where module='$modulename' and submodule!='Upload' order by module,submodule";
}
else
{
	$qry="select * from submodules where module='$modulename' order by module,submodule";
}
$rs = execute($qry);
if($rs)
{
	if(rowcount($rs)>0)
	{
		while($row=fetcharray($rs))
		{
			if($submodulename==$row[submodule])
			{
				echo "<option value='$row[submodule]' selected>$row[submodule]</option>";
			}
			else
			{
				echo "<option value='$row[submodule]'>$row[submodule]</option>";
			}
		}
	}
}
echo "</select></td></tr>";
echo "<tr><td colspan=2>";
echo "</table>";
echo "<br>";
echo "<table align=center class='forumline' width = '30%'>";
echo "<tr>";
echo "<td nowrap class='rowpic'>";
echo "Sub Menu Items";
echo "</td>";
echo "<td nowrap class='rowpic'>";
echo "Access";
echo "</td>";
echo "</tr>";
$qry="select * from links where module='$modulename' and submodule='$submodulename' ";
$rs = execute($qry);
if($rs)
{
	if(rowcount($rs)>0)
	{
		$x=0;
		while($row=fetcharray($rs))
		{
			if($x%2)
			echo "<tr> ";
			else
			echo "<tr class='clsname'> ";
			$x = $x + 1;
			//echo "<tr>";
			echo "<td nowrap>";
			echo "&nbsp;$row[2]";
			echo "</td>";
			echo "<td nowrap align='center'>";
			$qry="select access from studentmenu where module='$modulename' and submodule='$submodulename' and linkname='$row[linkname]' and id=$row[id]";
			$rs1 = execute($qry);
			$check_box="";
			if($rs1 && rowcount($rs1) > 0)
			{
				$row1 = fetcharray($rs1);
				if($row1[access]=='Yes')
					$check_box="checked";
			}
			echo "<input type=checkbox name=access$row[id] $check_box>";
			echo "</td>";
			echo "</tr>";
		}
	}
}

echo "</table>";
echo "<br>";
echo "<DIV align=center><input type=submit name=grant value='Update' class='bgbutton'></DIV>";

echo "</form>";
?>
</body>
</html>
