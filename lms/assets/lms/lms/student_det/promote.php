<?php

session_start();

require("../db.php");

$academic_year=$_SESSION['AcademicYear'];

$branch=$_POST['branch'];

$sem=$_POST['sem'];

$class_section_id=$_POST['class_section_id'];

if($branch !=-1)

{

	$sql = "SELECT * FROM  student_m WHERE course_admitted=$branch";

	$sql .= " AND course_yearsem = " .$sem." and academic_year='$academic_year'  and archive='N' ";
	if($class_section_id)
	$sql .= "  and class_section_id=$class_section_id";

	$sql .= "  order by first_name";

}

else

{

	$sql = "SELECT * FROM  student_m WHERE ";

	$sql .= " course_yearsem = " .$sem." and academic_year='$academic_year' and archive='N'";
	if($class_section_id)
	$sql .= "  and class_section_id=$class_section_id";

	$sql .= "  order by first_name";

}


$rs = execute($sql);

$num = rowcount($rs);
$arc=mysql_query("select * from archive_student_date where id='$StudID'");
?>

<script language="JavaScript">

window.status = "Reading Students List.....Please Wait!!";

</script>

<HTML>

<HEAD>

<title> Add/Edit Individual Student Details</title>

<script language="JavaScript">

function selectMe()

{

	i = document.form1.length;

	for(j=0;j<i;j++)

	{

		if(document.form1[j].Sel != "CheckBox")

		{

			flag = document.form1[j].checked;

			document.form1[j].checked = !flag;

		}

		if(document.form1[j].SelectAll == "CheckBox")

		{

			flag = document.form1[j].checked;

			document.form1[j].checked = !flag;

		}

	}

}

function validate(nI)

{

	if(nI==-1)

	{

		x = confirm("Are you sure that you want to Archive as Withdrawn students ??");

	}

	else

	{

		if(nI==-2)

		{

			x = confirm("Are you sure that you want to Archive as Graduated students ??");

		}

		else

		{

			x = confirm("Are you sure that you want to promote these students ??");

		}

	}

	if(x)

	{

		if(nI==-1)

		{

			document.form1.bDemote.value = 1;

		}

		else

		{

			if(nI==-2)

			{

				document.form1.bDemote.value = 2;

			}

			else

			{

				document.form1.bDemote.value = 3;

			}

		}

		document.form1.submit();

	}

}

function F182b0dde()

{

	var today = new Date();

	window.status = today.toLocaleString();

	setTimeout("F182b0dde()",1000);

}

function Fd40dca8f()

{

	var i,j;

	checkAll.innerHTML = "x";

	j = document.form1.studID.length;

	if(!isNaN(j))

	{

		for(i=0;i<j;i++)

		{

			document.form1.studID[i].checked = true;

		}

	}

	else

	{

		document.form1.studID.checked = true;

	}

}

</script>

</head>

<body topmargin="0" leftmargin="0">

<form method="POST" action="next.php" name="form1">

<!-- Hidden Values -->

<input type="hidden" name="nPromote" value="1">

<input type="hidden" name="bDemote">

<input type="hidden" name="branch" value="<?=$branch?>">

<input type="hidden" name="sem" value="<?=$sem?>">

<input type="hidden" name="ToYear" value="<?=$sem?>">

<br>

<?php



if($num == 0)

{

	die("<hr><br><div align=\"center\">

	<b>Student records not found <b><br><hr>");

}

?>

<table class='forumline' width="90%" align="center" border="1" >

<tr>

<td align="center" class='head' colspan="4">Students' List</td></tr>

<tr height='25' >

<td Class="rowpic" align='center'><div id="checkAll" 

onClick="selectMe()" Title="Click to Select all">All<input type="checkbox" name="" onClick="selectMe()"></div></td>

<td Class="rowpic" align='center'>Student ID</td>

<td Class="rowpic" align='center'>Student Name</td>
<td Class="rowpic" align='center'>Date</td></tr>

<?php

for($i=0;$i<$num;$i++)

{

	$r = fetcharray($rs);
/*
d.cno=student_id

$sql="select a.title,c.name,d.cno,d.acc_id,d.issue_date,d.due_date from lib_book_details a,lib_acc_details b,";
	    $sql.=" lib_mediatype c,lib_circulation_m d where a.id=b.master_id and b.acc_no=d.acc_id and b.acc_no=$r1[acc_id] and "; 
	    $sql.=" b.flag=1 and $r1[status]=0 and c.id=$r1[media_type] and d.id=$r1[id] order by d.issue_date";

*/


	$szName = $r["student_id"] . "&nbsp;&nbsp;&nbsp;" . $r["first_name"];

	$szName .= "&nbsp;" . $r["last_name"];

	$szVal = $r["id"];

	if($i%2)

		echo "	<tr class='clsname'> ";

		else

		echo "	<tr > ";

	?>

	<td  align='center' >

    <input type="checkbox" name="studID[]" value="<?=$szVal?>"></td>

	<td align="center"><?=$r["student_id"]?></td>

    <td align="left" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?=$r["first_name"]?>&nbsp;<?=$r["last_name"]?></td>
     <td nowrap>
    <?php

$d=date("d");

$m=date("m");

$y=date("Y");

?>

<select name="fd<?=$r["id"]?>" title="From Day">

<?php

for($n=1;$n<32;$n++)

{

 if($n==$d)

 echo "<option value='$n' selected>$n</option>";

 else

 echo "<option value='$n'>$n</option>";

}

?>

</select>

<select name="fm<?=$r["id"]?>" title="From Month">

<?php

for($n=1;$n<13;$n++)

{

 if($n==$m)

 echo "<option value='$n' selected>$n</option>";

 else

 echo "<option value='$n'>$n</option>";

}

?>

</select>

<select name="fy<?=$r["id"]?>" title="From Year">

<?php

for($n=(date('Y')-1);$n<(date('Y')+2);$n++)

{

 if($n==$y)

 echo "<option value='$n' selected>$n</option>";

 else

 echo "<option value='$n'>$n</option>";

}

?>

</select>



</td> </tr>

	<?php

}

?>

</table></center></div></td></tr>

<tr><td colspan="3" align="center">

<br>

<table border="0" align="center" width="90%"><td align="center"width="30%" style="background:none">

<input type="button" class="bgbutton" value= " Promote" name="B4" onClick="validate(1)"

onMouseOver="this.style.backgroundColor='green';this.style.cursor='hand';this.style.color='white'"

onMouseOut="this.style.backgroundColor='silver';this.style.cursor='default';this.style.color='black'"

Title = "Promote Students to a higher class."></td>

<td align="center" width="30%" style="background:none">

<input type="button"  class="bgbutton"  value="Withdrawn" name="B4" onClick="validate(-1)"

onMouseOver="this.style.backgroundColor='red';this.style.cursor='hand';this.style.color='white'"

onMouseOut="this.style.backgroundColor='silver';this.style.cursor='default';this.style.color='black'"

Title = "Archive as Failed Students ."></td>

<td align="center" width="30%" style="background:none">

<input type="button"  class="bgbutton"  value="Graduate" name="B4" onClick="validate(-2)"

onMouseOver="this.style.backgroundColor='blue';this.style.cursor='hand';this.style.color='white'"

onMouseOut="this.style.backgroundColor='silver';this.style.cursor='default';this.style.color='black'"

Title = "Archive as Ex-Students ."></td>

</table>

</form>

</BODY>

</HTML>