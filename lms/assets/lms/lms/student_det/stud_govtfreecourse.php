<?php

session_start();

require("../db.php");

$academic_year=$_SESSION['AcademicYear'];

$AdmName=$_POST['AdmName'];

$branch=$_POST['branch'];

$sem=$_POST['sem'];

if((@$course==-1) || ($sem==-1) || ($AdmName==-1) || ($acayr==-1))

{

	die("<div class='label'>Follow proper procedure.</div>");

}

$sql1 = "select * from course_year where status='1' and headid='$headid'";

$rs1 = execute($sql1);

$row1 = rowcount($rs1);

$r1 = fetcharray($rs1,0);

$yr = $r1["year_name"];



$sql2 = "select * from admission where id = $AdmName";

$rs2 = execute($sql2);

$row2 = rowcount($rs2);

$r2 = fetcharray($rs2,0);

$amd = $r2["name"];



$sql2 = "select col_name from college ";

$rs2 = execute($sql2);

$row2 = rowcount($rs2);

$r2 = fetcharray($rs2,0);

$colname = $r2["col_name"];



$dfg=fetcharray(execute("select * from coursehead where id='$branch'"));

?>

<html>

<head>

<SCRIPT>

function printReport()

{

	window.print();

}

</script>

</head>

<body>

<center>

<table  width="100%" align=center class=forumline>

<tr><td  align='center' class=head colspan=11><b><?=$colname?></b></td></tr>

<tr align="center"><td align="center"  class=row3 colspan=11>

List of Students Admitted to  <?=$yr?> <?=$dfg[branch]?> </b></font></td></tr>

<tr align="center"><td align="center" class=row2 colspan=11><b><?=$amd?></b></td></tr>

<br>

<tr><td width="3%"  align="center" class=rowpic ><b>SL.NO.</b></font></td>

<td width="15%"  align="center" class=rowpic><b>NAME OF CANDIDATE</b></td>

<td width="7%"  align="center" class=rowpic><b>DATE OF BIRTH</b></td>

<td width="8%"  align="center" class=rowpic><b>STATE</b></td>

<td width="8%"  align="center" class=rowpic><b>NATIONALITY</b></td>

<td width="12%" align="center" class=rowpic><b>FEE RECEIPT NO </b></td>

<td width="8%"  align="center" class=rowpic><b>REMARKS</b></td></tr>

<?PHP

$sql = "SELECT * FROM course_m WHERE head_id='$branch'";

$rs = execute($sql);

$row = rowcount($rs);

if($row == 0)

{

	echo("No course details");

}

else

{

	$slno=1;

	for($i=0;$i<$row;$i++)

	{

    	$r = fetcharray($rs,$i);

		$cid= $r[0];

    	$coursename = $r[1];

		$yt=$acayr."-".substr(($acayr+1),2);

		$sqls = "SELECT * FROM student_m WHERE  course_yearsem = ".$sem."  AND ";

		$sqls .= "admission_type = ".$AdmName." AND course_admitted = ".$cid." and academic_year='$academic_year'";

		$rsst = execute($sqls);

		$rows = rowcount($rsst);

		if($rows !=0)

			echo("<tr><td  align='left' colspan='15' class=row2>".$coursename."</td></tr>");

		for($j=0;$j<$rows;$j++)

		{

        	$rt = fetcharray($rsst,$j);

			echo("<tr><td width='5%' align='center' valign='middle'>".$slno."</td>");

			echo("<td width='15%' align='center' valign='middle'>". $rt["first_name"] . " ". $rt["last_name"] . "</td>");

			$temp_dob=explode("-",$rt["dob"]);

			$dob=$temp_dob[2]."-".$temp_dob[1]."-".$temp_dob[0];

			echo("<td width='7%' align='center' valign='middle'>". $dob . "</td>");

			$nal=fetcharray(execute("select nation from nationality where id='$rt[nationality]'"));

			echo("<td width='8%' align='center' valign='middle'>".$rt[per_state]."</td>");

			echo("<td width='8%' align='center' valign='middle'>".$nal[0]."</td>");

			echo("<td width='12%' align='center' valign='middle'>".$rt["cetreceiptno"]."</td>");

			echo("<td width='8%' align='center' valign='middle'>".$rt["remarks"]."</td></tr>");

			$slno=$slno+1;

		}

	}

}

?>

</table>

<br>

<div align=center>

<INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="PRINT" onClick="printReport()">

</div>



</body>

</html>