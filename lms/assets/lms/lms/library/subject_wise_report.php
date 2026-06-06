<?php
include_once("../db.php");
$library=$_POST['library'];
$register=$_POST['register'];
$subject=$_POST['subject'];
?>
<html>
<head>
<script language="JavaScript">
function frm_submit()
{
	document.form1.action='view_subject_wise_report.php'
	document.form1.submit();
}
</script>
</head>
<body>
<?php
	echo "<form name=form1 method=post >";
	echo "<input type='hidden' name=SeekPos value=$SeekPos>";
	echo "<table  align='center' class=forumline width='47%'>";
	echo "<tr><td class='head' colspan=2 align='center'>Subject Wise Book Detail Report</font></td></tr>";
/*
echo "<tr>";
echo "<td><font face='Lucida Sans' size='1.8'>";
echo " Library";
echo "</font></td>";
echo "<td>";
$qry="select * from library_name";
$rs=execute($qry);
echo "<select name=library onChange='javascript:document.form1.submit()'>";
echo "<option value=0>Select Library</option>";
while($row=fetcharray($rs))
{
	if($row[id]==$library)
		$sel = "selected";
	else
		$sel = "";
	echo "<option value=$row[id] $sel>$row[name]</option>";
}
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
*/
$library=1;
if($library > 0)
{
	/*
	echo "<td>";
	echo "<div align=left><font face='Lucida Sans' size='1.8'>Register</font>";
	echo "</td>";
	echo "<td>";
	$qry="select * from lib_register where library=$library";
	echo "<select name=register onChange='javascript:document.form1.submit()'>";
	echo "<option value='0'>----  Select Register  ----</option>";
	//echo "<option value='-1'>--ALL--</option>";
	$ls=execute($qry) or die(error_description());
	for($ii=0;$ii < rowcount($ls);$ii++)
	{
		$lr=fetcharray($ls,$ii);
		if($lr[id]==$register)
		{
			$sel = "selected";
		}
		else
			$sel = "";
		echo "<option value=$lr[id] $sel>$lr[register]</option>";
	}
	echo "</select>";
	echo "</td>";
	echo "</tr>";
	*/
	$register =1;
	if($register !=0)
	{
		echo "<tr>";
		echo "<td align='right'>";
		echo "Subject &nbsp;";
		echo "</td>";
		echo "<td>";
		
		 if($register!=9 && $register!=14)
		 {
			$qry="select distinct(subject) as subject from lib_book_details a,lib_acc_details b where b.master_id=a.id and b.register=$register";
		 }
		  
			else if($register==14)
			{
				$qry="select distinct(title) as subject from lib_newmagazine where register=$register";
			}
			else
			{
				$qry="select distinct(title) as subject from lib_magazine where register=$register";
			}
		//}
		     $rs=execute($qry);
		echo "<select name=subject >";
		echo "<option value=''>--- Select Subject ---</option>";
		while($row121=fetcharray($rs))
		{
			if(trim($row121[subject]) == trim($subject))
				$sel = "selected";
			else
				$sel = "";
			echo "<option value='$row121[subject]' $sel>$row121[subject]</option>";
		}
		echo "</select>";
		echo "</td>";
		echo "</tr>";
	
	}
}
echo "</table>";
echo "<p align='center'>";
echo "<input type=button name=button value='Search' onClick='frm_submit()' class='bgbutton'>";
echo "</p>";
echo "</form>";
?>
</BODY>
</HTML>