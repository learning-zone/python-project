<html>
<HEAD>
<?php
session_start();
require("../db.php");
?>
<SCRIPT LANGUAGE="JavaScript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}
</SCRIPT>
</HEAD>
<body>
<?php
  $sql123="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N'";
	if($branch!=0)
	{
		$sql123.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
		$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
		$sql123.=" and class_section_id=$class_section_id  ";
	}
	$sql123.=" order by gender desc,first_name";
	$rs=execute($sql123) or die(mysql_error());
$rs11=execute("select exam_name,sub_id  from exam_m where id='$examname'");
while($r11=fetcharray($rs11))
{
	$subarr=$r11[1];
	$examnamedet=$r11[0];
}
$tempsub=explode(',',$subarr);
$colsp=sizeof($tempsub);
$colsp++;
$ttcol=$colsp+6;
$kk=0;
$i=1;
while($kk==0)
{
	?>
	<table width="90%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr>
    <td align="center"  class="head"  colspan="<?=$ttcol?>">Marks Check List</td>
  </tr>
  <tr height='25'>
    <td  align="center"  class="rowpic"  colspan="<?=$ttcol?>">&nbsp;&nbsp;&nbsp;Class : <?php
	$semname=fetcharray(execute("SELECT year_name FROM course_year where year_id='$sem'"));
	echo $semname[0]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
	$class_section_id11=fetcharray(execute("select section_name  from class_section where id='$class_section_id'"));
	echo $class_section_id11[0]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Exam Name : <?php
	$examname1=fetcharray(execute("select descr,exam_count,vct from exam_m where id='$examname'"));
	echo $examname1[descr]; ?>&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="center" nowrap class="head">Sl No.</td>
    <td nowrap align="center" class="head">Student Name</td>
    <td  nowrap align="center" class="head">Student Id</td>
    <?php
	for($k=0;$k<sizeof($tempsub);$k++)
	{
	echo "<td nowrap align='center' class='head'>";
	$subname1=fetcharray(execute("select subject_code from subject_m where subject_id='$tempsub[$k]'"));
	echo "$subname1[0]</td>";
	}
	
	?>
   <td align="center" class="head">
	Total
    </td>
	<td align="center" class="head">
	%age
    </td>
	<td align="center" class="head">
	P or F
    </td>
  </tr>
  <?php
	$assmk1='assmk'.$examname1[exam_count];
	  if(date('m')<6)
	{
		$accyear=1-date('Y');
	}
	else
	$accyear=date('Y');
	  if($branch>0)
	{
		$table = "marks_".$branch."_".$sem;
		
	}
  while($r1=fetcharray($rs))
  { 
	  $kk++;
	echo "<tr height='25'>
    <td align='center' nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;&nbsp;$r1[first_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    ";
	for($k=0;$k<sizeof($tempsub);$k++)
	{
	$str11=fetchrow(execute("select $assmk1 from $table  where studid='$r1[id]' and subid='$tempsub[$k]' and accyr='$accyear'"));
	if($str11[0]!='')
	{
		if($str11[0]>0)
			echo "<td nowrap align='center'>&nbsp;$str11[0]</td>";
		else
			echo "<td nowrap align='center'>Ab</td>";
	}
	else
		echo "<td nowrap align='center'>&nbsp;</td>";
	}
	$qq=fetcharray(execute("select total_mark,rfg from exam_topers where exam_id='$examname' and stud_id='$r1[id]'"));
	if($qq[total_mark]>0)
		$per=round(($qq[total_mark]*100/$examname1[vct]),2);
	else
		$per="&nbsp;";
	?>
 <td align="center">
	&nbsp;<?=$qq[total_mark]?>
    </td><td align="center">
	&nbsp;<?=$per?>
    </td><td align="center">
	&nbsp;<?=$qq[rfg]?>
    </td>
  </tr><?php
	$i++;  
	if($kk==25)
	{
		echo "</table>";
		$kk=0;
		echo "<br style='page-break-after: always;' clear='all' />";
		break;
	}
	}
}
?>
</table>
<br>
<br>
<div id='pr1' align='center'><INPUT TYPE="button" class='bgbutton' NAME="print" VALUE="PRINT " onclick='prn()'>
</div>				
</form>	
</body>
</html>