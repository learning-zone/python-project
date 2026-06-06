<html>
<head>
<?php 
session_start();
include("../db.php");
$modulename=$_POST['modulename'];
$username=$_POST['username'];
$submodulename=$_POST['submodulename'];
?>
<script language="javascript">
function reload()
{
	document.tempfrm.action="useraccess.php";
	document.tempfrm.submit();
}
function win_open()
{
	var a = document.tempfrm.username.value;
	var len = a.length;
	if (a == "")
	{
		alert("Enter the Username atleast 3 characters !!");
		document.tempfrm.username.focus();
		return false;
	}
	else if (len < 3)
	{
		alert("Enter the First 3 characters of Username !!");
		document.tempfrm.username.focus();
		return false;
	}
	var x = window.open("usersearch1.php?username="+a,"user1","width=500,height=500,status=no,toolbar=no,scrollbar=no,menubar=no,sizeable=0");
}
function selectMe()
{

	var i,j,yy,total_student;
	i = document.tempfrm.length;
	for(j=0;j<i;j++)
	{

		if(document.tempfrm[j].Sel != "CheckBox")
		{
			flag = document.tempfrm[j].checked;
			document.tempfrm[j].checked = !flag;
		}
	}
}
</script>
</head>
<body class='bodyline' >
<?php

if($_POST['grant1'])
{
	$qry="select * from links where module='$modulename' and submodule='$submodulename'";
	$rs = execute($qry);
	while($row=fetcharray($rs))
	{
		$tid=$row[id];
		$temp = $_POST['access'.$tid];
		if($temp == 'on')
		{
			$acc = 'Yes';
		}
		else
		{
			$acc = 'No';
		}
		$qry = "select * from usermenu where username='$username' and id=$row[id]";
		$rs1 = execute($qry);
		$num = rowcount($rs1);	
		if($num>0)
		{
			if($acc == 'Yes')
			{
				$qry1="update usermenu set access='$acc' where username='$username' and id=$row[id]";
				$rss = execute($qry1);	
			}
			else
			{
				$qry1="delete from usermenu where username='$username' and id=$row[id]";
				$rss = execute($qry1);	
			}
		}
		else
		{
			if($acc == 'Yes')
			{
				$qry1="insert into usermenu (username,module,submodule,linkname,linkpath,access,parameter,id,groupname) values('$username','$modulename','$submodulename','$row[linkname]','$row[linkpath]','$acc','$row[parameter]','$row[id]','')";
				$rss = execute($qry1);	
			}
		}		
	}
	echo "Updated Successfully";
}

echo "<form action='useraccess.php' method='post' name='tempfrm'>";
echo "<table align=center class='forumline' width = '40%'>";
echo "<tr><td class='head' align='center' colspan=2>User Rights</td></tr>";
echo "<tr>";
echo "<td align='left' >&nbsp;&nbsp; User Name</td>";
echo "<TD WIDTH=45% ALIGN=LEFT>";
		
		$query = "SELECT username FROM users WHERE Activated='On'  ORDER BY username";
$rs = execute($query) or die("QUERY $query " . error_description());
       echo " <select name='username' onChange='reload1()'>";
	   echo "<OPTION VALUE='0'>------------ Select ------------</OPTION>";
	   while($trow=fetcharray($rs))
	   {
		 //echo "<option value='$trow[0]'>$trow[0]</option>";
		 if($username==$trow[username])
		 {
			 echo "<option value='$trow[username]' selected>$trow[username]</option>";
		 }
		 else
		 {
			 echo "<option value='$trow[username]'>$trow[username]</option>";
			 }
		}
		
	echo "</select></TD>";
//echo "<td>";
//echo "<INPUT TYPE='TEXT' NAME='username' SIZE='15' value='$username'>&nbsp;&nbsp;";

//echo "<INPUT TYPE='BUTTON' NAME='search' VALUE='SEARCH' CLASS='bgbutton' onClick='return win_open()'></td>";
//echo "</tr>";
?>
<!--
<TR><TD COLSPAN="2" ALIGN="CENTER">
Username should be atleast 3 characters to Search !!!</TD></TR>
-->
<?php
echo "<tr>";
echo "<td align='LEFT'>&nbsp;&nbsp; Select Module</td>";
echo "<td>";
$qry="select * from modules order by module";
//echo $qry;
echo "<select name=modulename onChange=\"reload()\">";
echo "<option value=''>------------ Select ------------</option>";
$rs = execute($qry);
	
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
	
echo "</select></td></tr>";
echo "<tr><td align='LEFT'>&nbsp;&nbsp; ";
echo "Select Sub Module</td>";
echo "<td>";
echo "<select name=submodulename onChange=\"reload()\">";
echo "<option value=''>------------ Select ------------</option>";
$qry="select * from submodules where module='$modulename' order by submodule";
//echo "$qry<br>";
$rs = execute($qry);

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
echo "</select></td></tr>";
echo "<tr><td colspan=2>";
echo "</table>";
echo "<br>";
echo "<table align=center class='forumline'  width = '40%'>";
?>
<tr><td align='center'>CLICK HERE TO CHECK ALL</td><td width="23" align='center'><div id="checkAll" 
					this.style.cursor='hand';this.style.color='white'"
					this.style.cursor='default';this.style.color='black'"
					onClick="selectMe()"
					Title="Click to Select all Students"><input type="checkbox"></div></td></tr>
<?php
echo "<tr>";
echo "<td nowrap class='rowpic'>";
echo "<b>&nbsp;&nbsp; Sub Menu Items</b>";
echo "</td>";
echo "<td nowrap class='rowpic'>";
echo "<b>Access &nbsp;&nbsp;</b>";
echo "</td>";
echo "</tr>";
$qry="select * from links where module='$modulename' and submodule='$submodulename' ";
$rs = execute($qry);
$x=0;
while($row=fetcharray($rs))
{
	if($x%2)
		echo "<tr > ";
	else
		echo "<tr class='clsname'> ";
	$x = $x + 1;
	
	$sqlst="select Display_name from links where linkname='".$row[2]."' and module='$modulename'";
		$diname=fetchrow(execute($sqlst));
		
		
	echo "<td nowrap>&nbsp;&nbsp; ";
	echo "$diname[0]";
	echo "</td>";
	echo "<td nowrap>";
	$qry="select access from usermenu where username='$username' and id=$row[id]";
	$rs1 = execute($qry);
	$check_box="";
	if(rowcount($rs1) > 0)
	{
		$row1 = fetcharray($rs1);
		if($row1[access]=='Yes')
			$check_box="checked";
	}
	echo "<input type=checkbox name=access$row[id] $check_box>";
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
echo "</td></tr>";

echo "<br>";
echo "<div align=center><input type='submit' name='grant1' value='Update' class='bgbutton'></div>";

echo "</form>";
?>
</body>
</html>