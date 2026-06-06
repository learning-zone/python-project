/* update student_m set parent_name=father.parent_name , parent_occupation=father.parent_occupation ,
 msgphone=father.msgphone , foadd=father.foadd , sms_mobile=father.sms_mobile ,
f_email=father.f_email WHERE usn=father.usn
*/

<?php 
include("db.php");
$i=0;
$q=musql_query("select * from test.father");
while($r=mysql_fetch_array($q))
{

mysql_query("update student_m set parent_name='$q[parent_name]' , parent_occupation='$q[parent_occupation]' , msgphone='$q[msgphone]', foadd='$q[foadd]' , sms_mobile='$q[sms_mobile]' , f_email='$q[f_email]' where usn='$q[usn]' ");
$i++;
}
echo $i;
?>