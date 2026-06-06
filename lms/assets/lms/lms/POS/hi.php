<?php
include("db.php")
error_reporting (E_ALL ^ E_NOTICE);

if(isset($_POST['save']))
{
	$temp=mysql_query("SELECT * FROM  EMAIL_DETAILS WHERE ORGID='$orgID' AND OUTLETID='$outletID'");
	if(mysql_num_rows($temp)==1)
	{
  mysql_query("UPDATE EMAIL_DETAILS SET EMAIL='$_POST[email]',USERNAME='$_POST[username]',PASSWORD='$_POST[password]',STATUS='$_POST[pas]',DOMAIN_ID='$_POST[domain]'");
	   }
	else
	{
		mysql_query("INSERT INTO EMAIL_DETAILS(ID,ORG_ID,OUTLET_ID,EMAIL,USERNAME,STATUS,DOMAIN_ID,PASSWORD)VALUES('','$orgID','$outletID','$_POST[email]','$_POST[username]','$_POST[pas]','$_POST[domain]','$_POST[password]'");
	}
}
$tem1=mysql_query("SELECT * FROM EMAIL_DETAILS");
while($r=mysql_fetch_array($tem1))
{
  $email=$row[EMAIL];
  $username=$row[USERNAME];
  $pasword=$row[PASSWORD];
  $status=$row[DOMAIN];

}
?>
<html>
<body>
<table width="100%">

<form method="post" name="frm" action=" ">

<table border="1" align="center" cellpadding="0" width="17%" colspan="2">
<tr><td align="center" colspan="2"><b>MAIL SETTINGS</b></td></tr>
<tr><td nowrap="nowrap">&nbsp;&nbsp;Enter the email id: </td>&nbsp;&nbsp;<td><input type="text" name="email" value="<?php echo $email ?>"/></td></tr>
<tr><td>&nbsp;&nbsp;Select Domain:</td>
<td>
<select name="domain">
<option value="0">Select</option>

<?php
	   $sql=mysql_query("SELECT * FROM DOMAIN");
	   while($row=mysql_fetch_array($sql))
				{
				   if($_POST['domain']==$row[0])
				    echo "<option value='$row[0]' selected>$row[1]</option>";
					else
					echo "<option value='$row[0]'>$row[1]</option>";
				}
?>
</select>

</td></tr>
<tr><td>&nbsp;&nbsp;User Name:</td>&nbsp;&nbsp;<td><input type="text" name="username" value="<?php echo  $username ?>"/></td></tr>
<tr><td colspan="2" nowrap="nowrap" align="center"><b>Do You wish to login using password:</b></td></tr>
<?php

if($_POST['pas'] == 1)
{
  $chk1="checked";
  $chk2=" ";
}
else
{
  $chk2="checked";
  $chk1=" ";
}
?>
<tr> 
<td>&nbsp;&nbsp;YES&nbsp;&nbsp;<input type="radio" name="pas" value="1" <?php echo $chk1; ?>   onChange="reload()"></td> 
<td>&nbsp;&nbsp;NO&nbsp;&nbsp;<input type="radio" name="pas"  value="0"  <?php echo $chk2; ?>  onChange="reload()" ></td>
</tr>
<?php

if($_POST['pas'] == 1)
{
 ?>
<tr><td>&nbsp;&nbsp;PASSWORD</td>&nbsp;&nbsp;<td><input type="text" name="password" value="<?php echo $pasword=$row[PASSWORD]; ?>"></td></tr>
 <?php
}

?>

<tr><td colspan="2" align="center"><input type="submit" value="save" name="save" onClick="reload1()"/></td></tr>
</table>
</form>
</body>
</html>