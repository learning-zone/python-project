<?php

session_start();

include("../db.php");

$branch=$_POST['branch'];

$sem=$_POST['sem'];

$class_section_id=$_POST['class_section_id'];

$academic_year=$_SESSION['AcademicYear'];

?>

<HTML>

<HEAD>

	<script language="JavaScript">

		function prn()

		{

			pr1.style.display = "none";

			window.print();

		}

		function gen_excel()

		{

			document.frm1.action='ex_view_student_detail_report2.php';

			document.frm1.submit();

		}

	</script>

</HEAD>

<BODY>

<form name="frm1" method="POST">

<INPUT TYPE="HIDDEN" NAME="branch" VALUE="<?php echo $branch ?>">

<INPUT TYPE="HIDDEN" NAME="sem" VALUE="<?php echo $sem ?>">

<INPUT TYPE="HIDDEN" NAME="class_section_id" VALUE="<?php echo $class_section_id ?>">



<table border='1' width="100%" cellspacing='0' cellpadding='0' align='center' class='forumline'>

	<tr height='30'>

		<td colspan='12' align='center' class='head'>STUDENT CONTACT DETAILS </td>

	</tr>

	<tr height='25'>

		<td colspan='12' class="rowpic" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> : 

		<?php 

		if(branchname($branch))

		echo branchname($branch);

		else

		echo "All"; ?>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		<?php echo $_SESSION['semname']; ?> : <?php 

		if(semname($sem))

		echo semname($sem);

		else

		echo "All"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		&nbsp;&nbsp;&nbsp;Section :  <?php echo secname($class_section_id); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



		</td>

	</tr>

	

	<tr height='25'>

		<td align='center' nowrap>Sl No</td>

		<td align='center' nowrap>&nbsp;&nbsp;Student Id</td>

		<td align='center' nowrap>Student Name</td>

		<td colspan="3" align='center' nowrap>Father</td>

		<td colspan="3" align='center' nowrap>Mother</td>

		<td colspan="3" align='center' nowrap>Gaurdian </td>

	</tr>

    <tr height='25'>

	  <td align='center' nowrap>&nbsp;</td>

	  <td align='center' nowrap>&nbsp;</td>

	  <td align='center' nowrap>&nbsp;</td>

	  <td align='center' nowrap>Name</td>

	  <td align='center' nowrap>Phone</td>

	  <td align='center' nowrap>E-Mail</td>

      <td align='center' nowrap>Name</td>

	  <td align='center' nowrap>Phone </td>

	  <td align='center' nowrap>E-Mail</td>

      <td align='center' nowrap>&nbsp;Name</td>

	  <td align='center' nowrap>&nbsp;Phone</td>

      <td align='center' nowrap>&nbsp;E-Mail</td>

  </tr>

	<?php

	$sql=execute("select coursename from course_m where course_id='$branch'");

	$branchname=mysql_fetch_row($sql);

	$rs=execute("SELECT year_name FROM course_year year_id='$sem'");

	$classname=mysql_fetch_row($rs);

			

				//	$var = "select student_id,first_name,last_name,g_num,parent_name,m_name,f_email,m_email,g_mail,g_name,sms_mobile,mnum from student_m where course_admitted='$branch' and course_yearsem='$sem' and class_section_id=$class_section_id ";

			

			

			

	$sql="select student_id,first_name,last_name,g_num,parent_name,m_name,f_email,m_email,g_mail,g_name,sms_mobile,mnum from student_m where id is not null and archive='N' and academic_year='$academic_year'";

	

	if($branch!=0)

	{

	$sql.=" and course_admitted=$branch";

	}

	if($sem!=0)

	{

	$sql.=" and course_yearsem=$sem";

	}

	if($class_section_id!='')

	{

	$sql.=" and class_section_id=$class_section_id  ";

	}

	

 $sql.=" order by course_admitted, course_yearsem, class_section_id, first_name";

	$var=$sql;

	$res  = mysql_query($var) or die(mysql_error());

	$tnum=1;

	while($r=mysql_fetch_array($res))

	{

			

			   ?>

         <tr>

           <td align='center'><?php echo $tnum ?></td>

           <td align="center" nowrap><?php echo $r[student_id] ?></td>

	  <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[first_name].$r[last_name] ?></td>

	   <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[parent_name] ?></td>

	   <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[sms_mobile] ?></td>

	   <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[f_email] ?></td>

	  <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[m_name] ?></td>

	   <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[mnum] ?></td>

	   <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[m_email] ?></td>

	   <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[g_name] ?></td>

	  <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[g_num] ?></td>

	   <td align="center" nowrap>&nbsp;&nbsp;<?php echo $r[g_mail] ?></td>

               

	    </tr>

		<?php

			$tnum++;

	}

?>

</table>

<br>

<div id='pr1' align='center'>

	<INPUT TYPE="SUBMIT" class='bgbutton' NAME="print" VALUE="PRINT" onclick='prn()'>&nbsp;&nbsp;

	<INPUT TYPE="button" NAME="Excel" class='bgbutton' VALUE="EXCEL EXPORT" OnClick="gen_excel()">

</div>

</body>

</html>