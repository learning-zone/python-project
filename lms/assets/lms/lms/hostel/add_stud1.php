<html>
<head>
<?php
session_start();
require("../db.php");
require ("../pdatagrid.class.php");
$studId = $_POST['studId'];
if($_REQUEST)
{
	$studFName = $_REQUEST['studFName'];
	$c_name = $_REQUEST['c_name'];
	$c_year = $_REQUEST['c_year'];
}
?>
</head>
<body>
<?php

$conn = mysql_pconnect("localhost",'root','') or die('Connection to database failed: ' . mysql_error());
mysql_select_db("renew_eng") or die ('select_db failed!');

$query.="select id,student_id,first_name,last_name from student_m where id is not null";
if($studId!='')
{
$query.=" and student_id='$studId'";
}
if($c_name!=0)  
{
$query.=" and course_admitted=$c_name";
}
if($studFName!="")
{
$query.=" and first_name='$studFName'";
}
if($c_year!=0)
{
$query.=" and course_yearsem=$c_year";
}

$query1.="select count(*) from student_m where id is not null";
if($studId!='')
{
$query1.=" and student_id='$studId'";
}
if($c_name!=0)  
{
$query1.=" and course_admitted=$c_name";
}
if($studFName!="")
{
$query1.=" and first_name='$studFName'";
}
if($c_year!=0)
{
$query1.=" and course_yearsem=$c_year";
}
//echo "$query";
//start

$grid = new PDatagrid($conn);

//SQL queries to count/select records
$grid->setSqlCount("$query1");

$grid->setSqlSelect($query);

//Base url for navigation links
$grid->baselink = 'add_stud1.php';

//Maximum number of page navigation links
$grid->setMaxNavLinks(1);

//Rows (records) per page
$grid->setRowsPerPage(5);

//end
//$rs = execute($query) or die("QUERY $query : " . mysql_error());
/*
if(rowcount($rs)==0)
	{
		//echo "No Records Found !!";
		//die();
		?>
<script language="JavaScript" type="text/javascript">
alert("No Records Found !!");
//document.frm.action="doSearch.php";
//document.frm.submit();
</script>
<?php
echo "<center><a href=doSearch.php><font color = #000000><u>Back</u></font></a></center>";
	die();
	}
*/
?>
<form name="frm" method="post">
<input type="hidden" name="studId" value="<?php echo $studId ?>">
<input type="hidden" name="studFName" value="<?php echo $studFName ?>">
<input type="hidden" name="c_name" value="<?php echo $c_name ?>">
<input type="hidden" name="c_year" value="<?php echo $c_year?>">

<table  class=forumline align=center width='30%' cellspacing=0 cellpadding=0>
<thead>
<tr><td align='center' class='head' colspan='2'>Add Student To Hostel</td>
</tr>
<tr height='25'>
<TD CLASS='rowpic'>&nbsp;Student ID</TD>
<TD CLASS='rowpic'>&nbsp;Name</TD>
</TR>
</thead>
<tfoot>
<tr>
	<td colspan="3">
	<span id="navlinks"><?php echo $grid->getLinks();?></span>
	</td>
</tr>
</tfoot>
<tbody>
	<?php echo $grid->getRows();?>
</tbody>
</table>
<?php
/*
    $rowclass=1;
	//for($i=0;$i<rowcount($rs);$i++)
	{
	 $row=fetcharray($rs);
?>
	<tr class='row<?php echo $rowclass ?>' height='25'>
	<TD align = 'center'><A HREF='add_hostel_stud.php?studId=<?php echo $row[id]?>&studFName=<?php echo $row[first_name]?>&c_name=<?php echo $c_name?>&c_year=<?php echo $c_year?>Studentid=<?php echo $row[student_id]?>'><?php echo $row[student_id]?></A></TD>
	<TD CLASS='cbody' align = 'LEFT'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row[first_name]?>&nbsp;<?php echo $row[last_name]?></TD>
	</TR>
	<?php
	$rowclass = 1 - $rowclass;
	}
	*/
?>
</TABLE> 
</form>
</body>
</html>