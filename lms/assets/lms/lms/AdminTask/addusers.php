<?php
session_start();
include("../db.php");
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//print_r($_REQUEST);
//echo "</pre>";
?>
<?php
$username=$_POST['username'];
$s_id=$_POST['s_id'];
$password=$_POST['password'];
$fullname=$_POST['fullname'];
$description=$_POST['description'];
$person=$_POST['person'];
$srid=$_POST['srid'];
$gname=$_POST['gname'];
$shortname=$_POST['shortname'];
if($_POST['submit'])
{
	$qry = "select * from users where username = '$username'";
	$rs = execute($qry);
	if(rowcount($rs) > 0)
	{
		echo "<div>Username already exists...</div>";
	}
	else
	{
		$query2 = "SELECT * FROM users WHERE S_ID='$s_id'";
		$rs2 = execute($query2);
		if (rowcount($rs2) > 0)
		{
			echo "<div>Staff ID Already Exists!!</div>";	

		}
		else
		{
			$query = "SELECT id FROM staff_det WHERE slno='$s_id'";
			$rs = execute($query);
			if (rowcount($rs)==0)
			{
				echo "<div>Invalid staff ID </div>";

			}
			else
			{		
				$srid=fetchrow($rs);
				$password = md5($password);
				$qry  = "INSERT INTO users (username,password, fullname, description, Person, S_ID,srid,groupname,shortname) ";
				$qry .= "VALUES('$username','$password','$fullname','$description', '$person','$s_id','$srid[0]','$gname','$shortname')";
				execute($qry);
				$query = "select id from user_group where group_name='$gname' order by id";
				$rs = execute($query);
				while ($row = fetcharray($rs))
				{
					$query = "select module, submodule, linkname, linkpath, parameter,id from links where id=$row[id]";
					$res = execute($query);
					$row1 = fetcharray($res);
					$sql1  = "insert into usermenu (username, module, submodule, linkname, linkpath, ";
					$sql1 .= "access, parameter,id,groupname) values('$username', '$row1[module]', '$row1[submodule]', ";
					$sql1 .= "'$row1[linkname]', '$row1[linkpath]', 'Yes', '$row1[parameter]','$row1[id]','$gname')";

					execute($sql1);

				}

				echo "<center>User created Successfully...!!</center><br>";

			}

		}

	}

}
?>
<HTML>
<HEAD>
<TITLE>ADD NEW USERS</TITLE>
<script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<SCRIPT LANGUAGE='JavaScript'>
function form_validation()
{
	if(document.frm.s_id.value=="")
	{

		alert("Please select Staff ID");

		document.frm.s_id.focus();

		return false;

	}
	else if(document.frm.username.value=="")
	{
		alert("Enter User Name");
		document.frm.username.focus();
		return false;
	}
	else if(document.frm.password.value=="")
	{
		alert("Enter Password");
		document.frm.password.focus();
		return false;
	}
	else if(document.frm.fullname.value=="")
	{
		alert("Enter Full Name");
		document.frm.fullname.focus();
		return false;

	}
	else if(document.frm.description.value=="")
	{
		alert("Enter Description");
		document.frm.description.focus();
		return false;

	}
	else if ((document.frm.gname.value == '') || (document.frm.gname.value == '0') )
	{

		alert("Select the User Belongs to Group !!");
		return false;

	}
	else
	{
		return true;
	}

}
function reloadMe1(str)
{
	var url="city.php";
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
		var email=xmlhttp.responseText;
		document.getElementById('username').value=email;
		}
	  }
	xmlhttp.open("GET",url,true);
	xmlhttp.send();

}
</script>
</HEAD>
<BODY CLASS='bodyline'>
<BR>

<!--<FORM NAME="frm" METHOD="POST" ACTION='addusers.php' onSubmit='return form_validation()'>-->
<FORM NAME="frm" METHOD="POST" ACTION='addusers.php'>
<input type='hidden' name='srid' value=''>
<TABLE align="center"  class='forumline' width='50%' >
<TR>
	<TD WIDTH=100% ALIGN=CENTER COLSPAN=3 CLASS='head'>ADD NEW USER</TD>
</TR>
<TR>
	<TD  ALIGN=LEFT>&nbsp;Staff  ID</TD>
	<TD  ALIGN=LEFT>
	<select name="s_id" onChange="reloadMe1(this.value)">
    <option value="" >----  Select  -----</option>
    
<?php 
$queryS_id = execute("SELECT id, slno, f_name, s_name FROM staff_det  WHERE active='YES' order by id ");
while($r9 = fetchrow($queryS_id)) 
{
	$trow=$r9[0];
	$r2=fetchrow(execute("select srid from users where  srid='$trow'"));
	if($trow!=$r2[0])
	  echo "<option value='$r9[1]' id='1' >$r9[2] $r9[3] ( $r9[1] )</option>";
}
?>
</select>
</TD></TR>
<TR>
	<TD WIDTH=50% ALIGN=LEFT>&nbsp;User Name</TD>
	<TD WIDTH=50% ALIGN=LEFT><INPUT TYPE=TEXT NAME="username" id="username" SIZE=45 ></TD>
</TR>
<TR>
	<TD WIDTH=50% ALIGN=LEFT>&nbsp;Password</TD>
	<TD WIDTH=50% ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=password SIZE=45></TD>
</TR>
<TR>
	<TD WIDTH=50% ALIGN=LEFT>&nbsp;Full Name</TD>
	<TD WIDTH=50% ALIGN=LEFT><INPUT TYPE=TEXT NAME=fullname SIZE=45 ></TD>
</TR>
<TR>
	<TD WIDTH=50% ALIGN=LEFT>&nbsp;Short Name</TD>
	<TD WIDTH=50% ALIGN=LEFT><INPUT TYPE=TEXT NAME=shortname SIZE=45 ></TD>
</TR>
<script type="text/javascript">
	var options = {
		script:"selectUserId.php?json=true&",
		varname:"input",
		json:true,
		callback: function (obj) { document.getElementById('testid').value = obj.id; }
	};

	var as_json = new AutoSuggest('s_id', options);
	var options_xml = {
		script:"selectUserId.php?",
		varname:"input"
	};

	var as_xml = new AutoSuggest('testinput_xml', options_xml);
</script>
<TR>
	<TD WIDTH=50% ALIGN=LEFT>&nbsp;Description</TD>
	<TD WIDTH=45% ALIGN=LEFT>
    <INPUT TYPE=TEXT NAME=description SIZE=45></TD>
</TR>
<TR>
	<TD WIDTH=50% ALIGN=LEFT>&nbsp;User Group</TD>
	<TD WIDTH=50% ALIGN=LEFT>
		<SELECT NAME='gname' SIZE=1>
			<OPTION VALUE='0'>------------ Select ------------</OPTION>
<?php
		$sql1=execute("select group_name from user_group group by group_name");
		while ($r1 = fetcharray($sql1))
		{

			echo "<OPTION VALUE='$r1[group_name]'>$r1[group_name]</OPTION>";

		}
		?>

		</SELECT></TD>

</TR>


</TABLE><br>
 <div align = 'center'>
	<INPUT TYPE="submit" NAME="submit" VALUE='Create User' CLASS='bgbutton'></DIV>
</form>
</body>
</html>