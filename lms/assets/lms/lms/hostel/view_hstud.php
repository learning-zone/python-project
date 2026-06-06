<?php
session_start();
require("../db.php");

$hname = $_POST['hname'];
$rname = $_POST['rname'];
$branch = $_POST['branch'];
$sem = $_POST['sem'];
$studfname = $_POST['studfname'];
$_action1 = $_REQUEST['action1'];

$ID = $_POST['ID'];

?>
<HTML>
<HEAD>
<TITLE>VIEW STUDENT DETAILS</TITLE>
</HEAD>
<BODY>
<CENTER>
<?php

	$sql.="select a.id,a.student_id,a.first_name,a.last_name,a.course_admitted,a.course_yearsem,b.s_id,b.h_id,b.room_no,b.bid from student_m a,h_stud_m b where a.id=b.s_id AND b.archive='N'";
	//echo $sql;
	if($branch!=0)
	{
	$sql.=" and a.course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and a.course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and a.first_name='$studfname'";
	}
    if($hname!=0)
	{
	 $sql.=" and b.h_id='$hname'";
	}
	if($rname!=0)
	{
	 $sql.=" and b.room_no='$rname'";
	}
	//echo "$sql";
		$rs=execute($sql) or die(mysql_error());
		$row=rowcount($rs);
    if($row > 0)
    {
?>
         <form name="frm" method="post">
         <input type="hidden" name="branch" value="<?php echo $branch ?>">
         <input type="hidden" name="sem" value="<?php echo $sem ?>">
         <input type="hidden" name="studfname" value="<?php echo $studfname ?>">
         <input type="hidden" name="hname" value="<?php echo $hname?>">
         <input type="hidden" name="rname" value="<?php echo $rname?>">
	
		 
         <TABLE WIDTH='80%' CELLPADDING='0' CELLSPACING='0' CLASS='forumline'>
         <TR><TD ALIGN='CENTER' CLASS='head' COLSPAN='8'>Student Details</TD></TR>
         <TR height='25'>
         <TD ALIGN='CENTER' CLASS='row2'>Count</TD>
         <TD ALIGN='CENTER' CLASS='row2'>Name</TD>
         <TD ALIGN='CENTER' CLASS='row2'>Course</TD>
         <TD ALIGN='CENTER' CLASS='row2'>Sem</TD>
         <!-- <TD ALIGN='CENTER' CLASS='row2'><B>Hostel</B></TD>
         <TD ALIGN='CENTER' CLASS='row2'><B>Block</B></TD>
         <TD ALIGN='CENTER' CLASS='row2'><B>Room No.</B></TD> -->
		 <TD ALIGN='CENTER' CLASS='row2'>Action</TD>
         </TR>
		 <?php
			 $k = 1;
		     while ($row=fetcharray($rs))
	            {
				 $a=execute("select * from student_m where id=$row[id]");
                 $aa=fetcharray($a);
				 $b=execute("select course_id,coursename from course_m where course_id=$aa[course_admitted]");
				 $bb=fetcharray($b);
				 $c=execute("select year_id,year_name from course_year where year_id=$aa[course_yearsem]");
				 $cc=fetcharray($c);
				 ?>
			<TR>
			<TD WIDTH='05%' ALIGN='CENTER'><?php echo $k?></TD>
		    <TD WIDTH='25%' ALIGN='CENTER'><?php echo $row[first_name]?>&nbsp;<?php echo $row[last_name]?></TD>
			<TD WIDTH='20%' ALIGN='CENTER'><?php echo $bb[coursename]?></TD>
			<TD WIDTH='15%' ALIGN='CENTER'><?php echo $cc[year_name]?></TD>
			<!-- <TD WIDTH='15%' ALIGN='CENTER'><B><?php echo $dd[hostel_name]?></B></TD>
			<TD WIDTH='10%' ALIGN='CENTER'><B><?php echo $ee[blockname]?></B></TD>
			<TD WIDTH='10%' ALIGN='CENTER'><B><?php echo $ff[room_no]?></B></TD> -->
			<TD WIDTH='10%' ALIGN='CENTER'>
			<A HREF="view_hstud1.php?ID=<?php echo $row[id]?>">View/</A>
			<A HREF="test1.php?ID=<?php echo $row[id]?>">Modify</A></TD>
	        </TR>
		<?php
		$k++;
	}
	echo "</TBODY>";
	echo "</TABLE>";
	}
elseif($row == 0)
{
	echo "<TT>The Student record could not be found..</TT>";
	echo "<br>";
    echo "<a href='doSearch2.php'> <u>Back</u></a>";
}
else
{
	echo "<TT>Please Select Required field for Search..</TT>";
} 
?>
</FORM>
</CENTER>
</BODY>
</HTML>