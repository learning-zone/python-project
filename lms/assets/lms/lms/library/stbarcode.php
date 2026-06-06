<?php
include("../db.php");
echo"<form name=frm method=post action=stbarcode1.php>";
$course=execute("select * from course_m");
$sem=execute("select * from course_year");
echo"<table border=1 align=center width=50%>";
echo"<tr><td class=head colspan=2>VIEW STUDENTS</td></tr>";
echo"<tr><td class=forumline>Course</td><td class=forumline><select name=cname><option value=0>select</option>";
while($course1=fetcharray($course))
{
echo"<option value=$course1[course_id]>$course1[coursename]</option>";
}
echo"</select></td></tr>";
echo"<tr><td class=forumline>Sem</td><td class=forumline><select name=cyear><option value=0>select</option>";
while($sem1=fetcharray($sem))
{
echo"<option value=$sem1[year_id]>$sem1[year_name]</option>";
}
echo"</select></td></tr>";
echo"<tr><td class=forumline>Student Name</td><td><input type=text name=sname value=$sname></td></tr>";
echo"<tr><td class=head colspan=2 align=center><input type=submit name=submit1 value=VIEW></td></tr></table>";
echo"</form>";