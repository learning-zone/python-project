<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body><?php 
include("db.php");
$i=0;
$r=mysql_query("select * from test.father");
while($q=mysql_fetch_array($r))
{

mysql_query("update student_m set parent_name='$q[parent_name]' , parent_occupation='$q[parent_occupation]' , msgphone='$q[msgphone]', foadd='$q[foadd]' , sms_mobile='$q[sms_mobile]' , f_email='$q[f_email]' where usn='$q[usn]' ");
$i++;
}
echo $i;
?>
</body>
</html>