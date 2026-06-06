<?php
include("../db.php");
echo"<form name=frm  action=stbarcode1.php>";
$exe="select a.student_id,a.id from student_m a,lib_membership_m b,lib_membership_det c where";
if($cname!=0)
{
$exe.=" a.course_admitted='$cname' and ";
}
if($cyear!=0)
{
$exe.=" a.course_yearsem='$cyear' and ";
}
if($sname!="")
{
$exe.=" a.first_name like '$sname%' and ";
}
$exe.=" a.archive='N' and c.m_id=b.id  and a.id=b.s_id order by a.first_name ";
$exe1=execute($exe);
if(rowcount($exe1)==0)
{
die("STUDENT DETAILS NOT FOUND");
}
echo"<table width=50% align=center border=1>";
echo"<tr><td class=head align=center>STUDENT ID</TD>
<TD class=head align=center>CARD NO</TD></TR>";
while($exe2=fetcharray($exe1))
{
//echo "select distinct(b.mbno) from lib_membership_m a,lib_membership_det b where a.s_id='$exe2[1]' and a.id=b.m_id";
$mem=execute("select distinct(b.mbno) from lib_membership_m a,lib_membership_det b where a.s_id='$exe2[1]' and a.id=b.m_id"); 
$num=rowcount($mem);
echo"<tr><td class=row3 align='center'>$exe2[0]</td><td class=row3 align='center'>";
while($mem1=fetcharray($mem))
{
echo"$mem1[0]";
if($num>1)
{
echo",";
}
}
echo"</td></tr>";
}
echo"</table>";

echo"</form>";