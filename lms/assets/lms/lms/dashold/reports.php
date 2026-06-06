<?php
	session_start();
	require("../db.php");
if($_SESSION['per00']==1)
die();

$AcademicYear=$_SESSION['AcademicYear'];
$branch=$_SESSION['branch'];
$sem=$_SESSION['sem'];
$user=$_SESSION['user'];
$SchoolName=$_SESSION['SchoolName'];

$sql2=fetcharray(execute("select id, class_section_id, course_admitted from student_m where student_id='$user'"));
$studentid=$sql2[0];
$class_section_id=$sql2[1];
$course=$sql2[1];
$student_id=$user;


?>
<br>
<div align="center">
	<font color="#FFFFFF" style="font-size:26px; font-weight:bold">
		<?=$SchoolName?>
    </font>
</div>
<BR>
<BR>
<?php

$sql=execute("select id, descr from exam_m where class='$sem' and accyear='$AcademicYear' and sts='1'");
while($r=fetcharray($sql))
{
	$examid=$r[0];
	$linkname=fetcharray(execute("select linkname from exam_links where sem='$sem'"));
	?>
    <div Align="center" >
        <a href="javascript:void(0)" onClick="window.open('<?=$linkname[0]?>course=<?=$course?>&sem=<?=$sem?>&examid=<?=$examid?>&studentid=<?=$studentid?>&class_section_id=<?=$class_section_id?>&student_id=<?=$student_id?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">
            <font color="#FFFFFF">
                <?=$r[1]?>
            </font>
        </a>
    </div>
    <?php
}
?>
