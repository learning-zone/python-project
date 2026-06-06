<?php
session_start();
include("../db.php");

$person=$_POST['person'];
$uname=$_POST['uname'];
$password=$_POST['password'];
$con_password=$_POST['con_password']; 
$fname=$_POST['fname'];
$shortname=$_POST['shortname']; 
$gname=$_POST['gname']; 
$person1=$_POST['person1'];

?>
<html>
<head>
<SCRIPT LANGUAGE='JavaScript'>
function form_validation()
{
	if(document.tempfrm.uname.value=="")
	{
		alert("Enter UserName");
		document.tempfrm.uname.focus();
		return false;
	}
	else if(document.tempfrm.fname.value=="")
	{
		alert("Enter Full Name");
		document.tempfrm.fname.focus();
		return false;
	}
	else if(document.tempfrm.desc.value=="")
	{
		alert("Enter Description");
		document.tempfrm.desc.focus();
		return false;
	}
	else if ((document.tempfrm.gname.value == '') ||
			(document.tempfrm.gname.value == '0') )
	{
		alert("Select the User Belongs to Group !!");
		return false;
	}
	else if(document.tempfrm.s_id.value=="")
	{
		alert("Enter Staff ID");
		document.tempfrm.s_id.focus();
		return false;
	}
	else
	{
		return true;
	}
}
function win_open()
{
	var a = document.tempfrm.uname.value;
	var len = a.length;
	if (a == "")
	{
		alert("Enter the Username atleast 3 characters !!");
		document.tempfrm.uname.focus();
		return false;
	}
	else if (len < 3)
	{
		alert("Enter the First 3 characters of Username !!");
		document.tempfrm.uname.focus();
		return false;
	}
	var x = window.open("usersearch.php?uname="+a,"user1","width=500,height=500,status=no,toolbar=no,scrollbar=no,menubar=no,sizeable=0");
}
	function reload1()
	{
		document.tempfrm.action="mod_del_user.php";
	 	document.tempfrm.submit();
	}
</script> 
</head>
<body class='bodyline'>
<?php

if($_POST['update'])
{
	if($password==$con_password)
	{
		$qry = "select * from users where username = '$uname'";
		//echo $qry;
		$rs = execute($qry);
		if(rowcount($rs) == 0)
		{
			?>
            <script language="javascript">
            alert("Username cannont be changed");
            </script>
			<?php
            
		}
		else
		{
			if($password=='')
			{
				$qry = "UPDATE users SET fullname='$fname',description='$desc',shortname='$shortname',Person='$person1',groupname='$gname' WHERE username='$uname'";
			}
			else
			{
			$password = md5($password);

				$qry = "UPDATE users SET password='$password',fullname='$fname',description='$desc',shortname='$shortname',Person='$person1',groupname='$gname' WHERE username='$uname'";
			}
			execute($qry);

			$qry2=execute("delete from usermenu where username='$uname'");
			$sql1="select * from user_group where group_name='$gname' order by id";
			$rs1=execute($sql1);
			for($i=0;$i<rowcount($rs1);$i++)
			{
				$r1=fetcharray($rs1);
				$sql2="insert into usermenu(username,module,submodule,linkname,linkpath,groupname,id,access,parameter) values('$uname','$r1[module]','$r1[submodule]','$r1[linkname]','$r1[linkpath]','$gname','$r1[id]','Yes','$r1[parameter]')";
				$rs2=execute($sql2);
			}

		}			
		?>
        <script language="javascript">
		alert("Records Modified Successfully");
		</script>
		<?php
    }
	else
	{
	?>
    <script language="javascript">
		alert("Password and Confirm Password missmatch");
	</script>
	<?php
    }
}
if($_POST['delete'])
{
	if($uname!='administrator')
	{
		$curr_date = date("Y-m-d");
		//$qry  = "UPDATE users SET Activated='Off', disabledate='$curr_date' WHERE username='$uname'";
		$qry = "delete from users where username='$uname'";
		execute($qry);
		$qry = "delete from usermenu where username='$uname'";

		execute($qry);
		echo "<script language=javascript>";
		echo "alert('User Deleted ..')";
		echo "</script>";
	}
	else
	{
		echo "<script language=javascript>";
			echo "alert('You cant delete administrator user..')";
		echo "</script>";
		//echo "You can't delete administrator user..";
	}
}
?>
	<LEFT>
	<form name='tempfrm' action='mod_del_user.php' method='post' onSubmit='return form_validation(this.form)'>
<?php

if($_POST['uname']!='' )
{
	$qry = "select * from users where username = '$uname'";
	$rs = execute($qry);
	while($r2=fetcharray($rs))
	{
		$fname=$r2['fullname'];
		$shortname=$r2['shortname'];
		$person1=$r2['Person'];
		$gname=$r2['groupname'];
		$uname=$r2['username'];
		$s_id=$r2['S_ID'];
	}

}

echo "<input type=hidden name=person value=$person>";
?>
<TABLE class='forumline' align='CENTER' width='40%'>
<TBODY>
<TR>
<TD ALIGN=CENTER COLSPAN=3 class='head'>MODIFY / DISABLE USER</TD>
</TR>
<TR>
	<TD WIDTH=45% ALIGN=LEFT>&nbsp;User Name</TD>
	<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<TD WIDTH=45% ALIGN=LEFT>
<?php		
		$query = "SELECT username FROM users WHERE Activated='On'  ORDER BY username";
$rs = execute($query) or die("QUERY $query " . error_description());
       ?> <select name='uname' onChange='reload1()'>
	   <OPTION VALUE='0'>------------ Select ------------</OPTION>
       <?php
	   while($trow=fetcharray($rs))
	   {
		if($uname==$trow[0])
		 echo "<option value='$trow[0]' selected>$trow[0]</option>";
		 else
 		 echo "<option value='$trow[0]' >$trow[0]</option>";

	   }
		?>
	</select></TD>
	</TR>

	<TR>
	<TD ALIGN=LEFT WIDTH=45%>&nbsp;New Password</TD>
	<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<TD ALIGN=LEFT WIDTH=45%>
    <INPUT TYPE=PASSWORD NAME=password SIZE=15></TD>
	</TR>
	<TR>
	<TD ALIGN=LEFT WIDTH=45%>&nbsp;Retype Password</TD>
	<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<TD ALIGN=LEFT WIDTH=45%><INPUT TYPE=PASSWORD NAME=con_password SIZE=15></TD>
	</TR>
	<TR>
	<TD ALIGN=LEFT WIDTH=45%>&nbsp;Full Name</TD>
	<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<TD ALIGN=LEFT WIDTH=45%>
	<?php
	echo "<INPUT TYPE='TEXT' NAME='fname' SIZE=15 value='$fname' >";
	?>
    </td>
	</TR>
	<TR>
	<TD WIDTH=45% ALIGN=LEFT>&nbsp;Short Name</TD>
		<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<TD WIDTH=45% ALIGN=LEFT>
    <?php
    echo "<INPUT TYPE='TEXT' NAME='shortname' SIZE=15 value='$shortname' >";
		?>
        </td>
	</TR>
    <!--
	<TR>
	<TD WIDTH=45% ALIGN=LEFT>&nbsp;Description</TD>
	<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<?php
    echo "<TD WIDTH=45% ALIGN=LEFT><INPUT TYPE=TEXT NAME='desc' SIZE=25 value='$desc'></TD>";
	?>
	</TR>-->
	<TR>
	<TD WIDTH=45% ALIGN=LEFT>&nbsp;Select User Group</TD>
	<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<TD WIDTH=45% ALIGN=LEFT>
		
		<SELECT NAME='gname' SIZE=1>
		<OPTION VALUE='0'>------------ Select ------------</OPTION>
        <?php
		$sql1=execute("select group_name from user_group group by group_name");
		while ($r1 = fetcharray($sql1))
		{
			if($r1[group_name]==$gname)
			{
				echo "<OPTION VALUE='$r1[group_name]' selected>$r1[group_name]</OPTION>";
			}
			else
			{
				echo "<OPTION VALUE='$r1[group_name]'>$r1[group_name]</OPTION>";
			}
		}
		?>
		</SELECT></TD>
	</TR>
	<TR>
	<TD WIDTH=45% ALIGN=LEFT>&nbsp;User Belongs To</TD>
	<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<TD WIDTH=45% ALIGN=LEFT nowrap>
	
<?php	
$sel1="";
$sel2="";
if($person1=='Staff')
{
$sel1="checked";
}
elseif($person1=='None')
{
$sel2="checked";
}
		echo "<INPUT TYPE=RADIO NAME='person1' VALUE='Staff' $sel1 checked>Teaching Staff";
		echo "<INPUT TYPE=RADIO NAME='person1' VALUE='None' $sel2>Non Teaching Staff</TD>";
		?>
	</TD>
	</TR>
	<TR>
	<TD WIDTH=45% ALIGN=LEFT>&nbsp;Staff ID</TD>
	<TD WIDTH=10% ALIGN=LEFT>&nbsp;</TD>
	<TD WIDTH=45% ALIGN=LEFT>
    <?php
    echo "<INPUT TYPE=TEXT SIZE=10 NAME='s_id' value='$s_id' readonly>";
	?></TD>
	</TR>
	</TBODY>
	</TABLE>
	<BR><DIV ALIGN='center'><INPUT TYPE=SUBMIT NAME=update VALUE='Modify' class='bgbutton'>
	&nbsp;<INPUT TYPE=SUBMIT NAME=delete VALUE='Delete' class='bgbutton'></DIV>
    </FORM>
	</LEFT>
</body>
</html>