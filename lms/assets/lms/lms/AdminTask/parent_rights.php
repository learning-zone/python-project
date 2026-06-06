<LINK rel="stylesheet" type="text/css" href="mistStyle.css">
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
<body class='bodyline'>
<?
if($_POST['grant'])
{
	$qry="select * from links_p where module='$modulename' and submodule='$submodulename'";
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
			$qry = "select * from parentmenu where module='$modulename' and submodule='$submodulename' and linkname='$row[linkname]' and id=$row[id]";
			
			$rs1 = execute($qry);
			if($rs1)
			{
				if(rowcount($rs1)>0)
				{
					$qry="update parentmenu set access='$acc' where module='$modulename' and submodule='$submodulename' and linkname='$row[linkname]' and id=$row[id]";
					
				}
				else
				{
					$qry="insert into parentmenu values('$modulename','$submodulename','$row[linkname]','$row[linkpath]','$acc','$row[parameter]',$row[id])";
				}
					
					execute($qry);
				}
			}
	}
	
}
echo "<form  method=post name='tempfrm'>";
echo "<table align=center class='forumline' width = '40%'>";
echo "<tr><td class='head' align='center' colspan=2>Add Parents Rights</td></tr>";
echo "<tr>";
echo "<td>&nbsp;&nbsp;Module</td>";
echo "<td>";
echo "<select name=modulename onChange=\"reload()\">";
echo "<option value=''>----- Select -----</option>";
$qry="select * from modules_p order by id";
$rs = execute($qry);
if($rs)
{
	if(rowcount($rs)>0)
	{
		while($row=fetcharray($rs))
		{
			
			$sqlst="select Display_name from links where linkname='".$row['module']."' and module='Main'";
			$diname=fetchrow(execute($sqlst));
			if($diname[0]=='')
			$diname[0]='Main';

			if($modulename==$row[module])
			{
				echo "<option value='$row[module]' selected>$diname[0]</option>";
			}
			else
			{
				echo "<option value='$row[module]'>$diname[0]</option>";
			}
		}
	}
}
echo "</select></td></tr>";
echo "<tr><td>";
echo "&nbsp;&nbsp;Sub Module</td>";
echo "<td>";
echo "<select name=submodulename onChange=\"reload()\">";
echo "<option value=''>----- Select -----</option>";

	$qry="select * from submodules where module='$modulename' order by module,submodule";

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
echo "<table align=center class='forumline' width = '40%'>";
echo "<tr>";
echo "<td nowrap class='rowpic'>";
echo "<b>Sub Menu Items</b>";
echo "</td>";
echo "<td nowrap class='rowpic'>";
echo "<b>Access</b>";
echo "</td>";
echo "</tr>";
$qry="select * from links_p where module='$modulename' and submodule='$submodulename' ";
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
			echo "<tr  class='clsname'> ";
			$x= $x + 1;
			echo "<td nowrap>";
			$sqlst="select Display_name from links where linkname='".$row['linkname']."' ";
			$diname=fetchrow(execute($sqlst));
			if($diname[0]=='')
			$diname[0]='Main';
	
			echo "&nbsp;$diname[0]";
			echo "</td>";
			echo "<td nowrap align='center'>";
			$qry="select access from parentmenu where module='$modulename' and submodule='$submodulename' and linkname='$row[linkname]' and id=$row[id]";
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
echo "<div align=center><input type=submit name=grant value='Update' class='bgbutton'></div>";


echo "</form>";
?>
</body>
</html>
