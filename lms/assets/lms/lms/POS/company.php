<?php

require('includes/dbconnect.php');
error_reporting (E_ALL ^ E_NOTICE);

if(isset($_POST['save']))
{
	$temp=mysql_query("SELECT * FROM company");
	if(mysql_num_rows($temp)==1)
	{
  mysql_query("UPDATE company SET COMPANY_NAME='$_POST[company_name]',COMPNY_SNAME='$_POST[company_sname]',PHONE_NUM1='$_POST[phone_num]',PHONE_NUM2='$_POST[phone_num1]',PHONE_NUM3='$_POST[phone_num2]',COMPANY_ADDRESS1='$_POST[address1]',COMPANY_ADDRESS2='$_POST[address2]',EMAIL_ID='$_POST[email]',WEBSITE='$_POST[website]',FAX='$_POST[fax]',TIN_NUMBER='$_POST[tin_number]'");
	   }
	else
	{
		mysql_query("INSERT INTO company(COMPANY_NAME,COMPANY_ADDRESS1,COMPANY_ADDRESS2,EMAIL_ID,PHONE_NUM1,PHONE_NUM2,PHONE_NUM3,WEBSITE,FAX,COMPNY_SNAME,TIN_NUMBER) VALUES('$_POST[company_name]','$_POST[company_sname]','$_POST[phone_num]','$_POST[phone_num1]','$_POST[phone_num2]','$_POST[email]','$_POST[address1]','$_POST[address2]','$_POST[website]','$_POST[fax]','$_POST[tin_number]')");
	}
}
$tem1=mysql_query("SELECT * FROM company");
while($r=mysql_fetch_array($tem1))
{
	$company_name=$r['COMPANY_NAME'];
	$company_sname=$r['COMPNY_SNAME'];
	$phone_num=$r['PHONE_NUM1'];
	$phone_num1=$r['PHONE_NUM2'];
	$phone_num2=$r['PHONE_NUM3'];
	$email=$r['EMAIL_ID'];
	$address1=$r['COMPANY_ADDRESS1'];
	$address2=$r['COMPANY_ADDRESS2'];
	$website=$r['WEBSITE'];
	$fax=$r['FAX'];
	$tin_number=$r['TIN_NUMBER'];
}
?>
<html>
<body>
<table width="100%">
  	<tr>
  		<td class="bottomborder" height="22" valign="top">
  		<?php include "topMenu.php"; ?> <!--<script SRC="JS/myCRM_Top_Menu.js"></script>-->
  		</td>
  	</tr>
</table>
<form method=post name="frm" action="company.php">
<BR><BR>
<table border="1" align="center" bordercolor="#000000" cellpadding='0' cellspacing="0">
<tr  height='35'>
<td colspan=2 align="center"><font color="skyblue" size="+1"><b>Organization Details</b></font></td>
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;Name</td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="company_name" value='<?php echo $company_name; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;Short Name</td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="company_sname" value='<?php echo $company_sname; ?>'  />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;Phone Number </td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="phone_num"  value='<?php echo $phone_num; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;Phone Number1</td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="phone_num1"  value='<?php echo $phone_num1; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;Phone Number2</td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="phone_num2"  value='<?php echo $phone_num2; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;Email-id </td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="email"  value='<?php echo $email; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;address1 </td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="address1"  value='<?php echo $address1; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;address2 </td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="address2"  value='<?php echo $address2; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;Website</td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="website"  value='<?php echo $website; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;Fax</td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="fax"  value='<?php echo $fax; ?>' />
</tr>
<tr height='30'>
<td>&nbsp;&nbsp;TIN</td>
<td>&nbsp;&nbsp;<input type="text" size="20" name="tin_number"  value='<?php echo $tin_number; ?>' />
</tr>
</table>
<br>
<div align='center'><input type='submit' name='save' value='submit'></div>

</form>
</body>
</html>