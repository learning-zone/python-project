<HTML>
<HEAD>
<?php
session_start();
require("../db.php");
?>
<SCRIPT LANGUAGE="JavaScript">

function check()
{
	document.getElementById("new_ele1").checked=false;
}
function check123()
{
	
	document.getElementById("new_ele").checked=false;
}

function check21(k)
{
	document.getElementById("newb" + k).checked=false;
}
function check212(m)
{
		document.getElementById("newa" + m).checked=false;
}

function go1()
{
document.AddSubject.action="subadd.php";
document.AddSubject.submit();
}

	var KEY_LEFT  = 268762961;
	var KEY_RIGHT = 268762963;
	var KEY_SPC = 32;

	function activate_onclick()
	{
		document.AddSubject.action="addsubject.php?Type=Act";
		document.AddSubject.submit();
		return true;
	}
	function adds_onclick()
	{
		document.AddSubject.action="addsubject.php?Type=Add";
		document.AddSubject.submit();
		//return true;
	}
	function Modify_onclick()
	{
		document.AddSubject.action="addsubject.php?Type=Mod";
		document.AddSubject.submit();
		return true;
	}

	function getSubject_onclick()
	{
		str = "subadd.php?Course=" + document.AddSubject.Course.options[document.AddSubject.Course.selectedIndex].value   +  "&CYear=" + document.AddSubject.CYear.options[document.AddSubject.CYear.selectedIndex].value +  "&firstCourse=" + document.AddSubject.Course+options[document.AddSubject.Course.selectedIndex].value;;
		document.location.href= str;
	}
	function Delete_onclick()
	{
		document.AddSubject.action="addsubject.php?Type=Del";
		document.AddSubject.submit();
		return true;
	}
	function checkInt(e)
	{
		var charCode = e.which;
    	//status = charCode;

		if (charCode > 31 && (charCode < 48 || charCode > 57)  && charCode != KEY_LEFT && charCode != KEY_RIGHT )
		{
    		status = "Please make sure entries are numbers only.!!";
    		return false
    	}
		status = "";
        return true
     }
//-->
</SCRIPT>
</HEAD>
<BODY class='bodyline'>
<?php
$Msg=$_POST['msg'];
if($_POST['msg'])
{
	?>
    <script language="javascript">
	alert("<?php echo $Msg; ?>");
    </script>
    <?
}
if(!$_POST)
{
	$Course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}	
else
{
	$Course=$_POST['Course'];
	$sem=$_POST['sem'];
}
?>
<form name="AddSubject" action ="addsubject.php" method="post">
<?php
if($Course=='')
   $sem='';
?>
<Table class='forumline' align=center width="50%">
<tr><td Class="head" align=center colspan=3>Manage Subjects</td></tr>
 <tr><td>&nbsp;&nbsp;School Division&nbsp;&nbsp;</td><td>
	<Select name="Course" OnChange=go1()>

	<option value=''>-- Select--</option>

	<?php
	$sql1 = "SELECT course_id,coursename,course_abbr,head_id FROM course_m where status=1 order by course_id";
	$rs1 = execute($sql1) or die(error_description()."F");
	$num = rowcount($rs1);
	for($i=0;$i<rowcount($rs1);$i++)
	{
		$r = fetcharray($rs1,$i);
		if($Course==$r["course_id"])
		{
			?>
			<Option value="<?=$r["course_id"]?>" Selected><?=$r["coursename"]?></Option>
			<?php
			$CourseAbbr=$r["course_abbr"];
			$head = $r[head_id];
		}
		else
		{
			?>
			<Option value="<?=$r["course_id"]?>"><?=$r["coursename"]?></Option>
			<?php
		}
	}
?>
	</Select></TD></tr>
	<tr><td>&nbsp;&nbsp;Class</td><TD>
	<Select name="sem" OnChange=go1()><option value=0>-select-</option>
<?php
	if($Course>0)
	{
		$yy=execute("select * from course_year where status=1 and head_id='$head'");
	}
for($j=0;$j<rowcount($yy);$j++)
{
	$fyy=fetcharray($yy);
	if($sem==$fyy[0])
	 {
		echo "<option value=$fyy[0] selected>$fyy[year_name]</option>";
	 }
	 else
	 {
		echo "<option value=$fyy[0]>$fyy[year_name]</option>";
	 }
}
echo "</select>";

?>
	</table>
	<br>
	 <table class='forumline' align=center width='100%'>
	
	<TR>
		<TD class="head" align="center">Subject Name</TD>
		<TD class="head" align="center">Subject Code</TD>
		<TD class="head" align="center">Subject Type</TD>
		<TD class="head" align="center">Max.Internal Marks</TD>
		<TD Class="head" align="center">Final MARKS</TD>
		<TD class="head" nowrap  align="center"> Elective </TD>
		<TD Class="head" align="center">Order</TD>
	</TR>
	<TR>
	<TD align="center"><INPUT TYPE="text" name="NewSub" size='35'></TD>
	<TD align="center"><INPUT TYPE="text" name="Newcode" size="10"></TD>

	<td align="center">
	<SELECT name="NewType">
	<OPTION value=-1 selected>-Select-</option>
	<?php
	$sql = "select * from subjecttype";
	$rs = execute($sql);
	$num = rowcount($rs);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		?>
		<OPTION  value="<?=$r["subtype_id"]?>"><?=$r["subtype_name"]?></option>
		<?php
	}
	?>
	</SELECT>
	</td>
	<TD align='center'><Input Type="text"  name="NewMarks" size=3 maxlength=3></TD>
	<TD align='center'><Input Type="text"  name="NewtMarks" size=3 maxlength=3></TD>
	<TD align="center"><Input Type="checkbox" name="new_elective" ></TD>
	<TD align='center'><Input Type="text"  name="Newpre" size=3 maxlength=3></TD>
	</TR>
</Table><br>
	<div align=center>
	<input type="submit" id="adds" value="Add Subject" LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'>
	</div>
	

	<?php


if($sem!=0 && $sem!="")
  {
  echo "<Table class='forumline' align='center' width='100%'>";
  
	$sql = "SELECT subject_id,subject_name,sub_type,total_marks,subject_code,elective,sys_year,max_mark,sub_pre FROM  ";
	$sql.= "subject_m WHERE course_id=$Course";
	$sql .= " and course_year_id = $sem and status=1 order by sub_pre";
	$sub = execute($sql) or die(error_description()."S");
	$num = rowcount($sub);
	
	if($num  > 0 )
	{
		?>
		<TR>
		<TD Class="head">Sel</TD>
		<TD Class="head" align="center">Subject Name</TD>
		<TD Class="head" align="center">Subject Code</TD>
		<TD Class="head" align="center">Subject Type</TD>
		<TD Class="head" align="center">Max.Internal MARKS</TD>
		<TD Class="head" align="center">Final MARKS</TD>
		<TD Class="head" align="center">Elective </TD>
		<TD Class="head" align="center">Order</TD></TR>
		<?php
		for($i=0;$i<$num;$i++)
		{
			$r = fetchrow($sub);
			
		echo "	<tr> ";
			?>
			
			<TD class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$r[0]?>">
			</TD>
			<td class="CBody" align="center">
			<Input Type="Text" Name="<?=$r[0]?>subName" value="<?=$r[1]?>" size=35></td>
			<td class="CBody" align="center">
			<Input Type="Text" Name="<?=$r[0]?>subcode" value="<?=$r[4]?>" size=10></td>
			<td align="center">
			<Select Name="<?=$r[0]?>SubType">

			<?php
			$sql = "SELECT * FROM subjecttype ORDER BY subtype_id";
			$rsTemp = execute($sql);

			$num1 = rowcount($rsTemp);
			for($j=0; $j<$num1; $j++)
			{
				$rTemp = fetcharray($rsTemp,$j);
				if( $rTemp[0] == $r[2])
				{
					echo "<option value=\"$rTemp[0]\" selected>$rTemp[1]</option>";
				}
				else
				{
					echo "<option value=\"$rTemp[0]\">$rTemp[1]</option>";
				}
			}
			?>
			</SELECT>
			</td>
			<td class="CBody" align='center'>
			<Input Type="text" name="<?=$r[0]?>Marks" size=3 maxlength=3 value="<?=$r[3]?>" onKeyDown="return checkInt(event)">
			</td>
			<td class="CBody" align='center'>
			<Input Type="text" name="<?=$r[0]?>tMarks" size=3 maxlength=3 value="<?=$r[7]?>" onKeyDown="return checkInt(event)">
			</td>
			<td class="CBody" align="center">
			<?
			$sel="";
			if(  $r[5]=='Y')
			{
				$sel="checked";
			}
			?>
			<Input Type="checkbox" Name="<?=$r[0]?>elective"  <?=$sel?> >
			</td>
			<td class="CBody" align='center'>
			<Input Type="text" name="<?=$r[0]?>pre" size=3 maxlength=3 value="<?=$r[8]?>" onKeyDown="return checkInt(event)">
			</td>



			</tr>
			<?php
		}
		?>
		<tr height='40'><td colspan=8 align=center>
		<Input type="submit" Name="Modify" value="Modify" LANGUAGE=javascript onClick="return Modify_onclick()" class='bgbutton'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Input type="submit" Name="Delete" value="Delete" LANGUAGE=javascript onClick="return Delete_onclick()" class='bgbutton'> </td></tr>
		<?php
	}
		?>
			<br>
		 
	<input type="hidden" name="courseabbr" value="<?=$CourseAbbr?>">
	<?php
	$sql2 = "SELECT subject_id,subject_name,sub_type,total_marks,subject_code,sys_year FROM  ";
	$sql2.= "subject_m WHERE course_id= '$Course'";
	$sql2 .= " and course_year_id ='$sem' and status=0 order by subject_name";
	$rss = execute($sql2) or die(mysql_error());
     $num11 = rowcount($rss);
	
	if($num11)
	{
		?>
		
		<form name="changestatus" method="post" action="addsubject.php">
		<br>
		<table border="0" cellspacing="1" width="300" class='forumline'>
	    <tr>
		<td width="20%" class="head" colspan="3" align='center'>Deleted Subjects</td>
	    </tr>
	    <tr>
		<td width="20%" class="head">Select</td>
		<td class="head">Subjects<td class="head">Subject Code</td>
		</tr>
		<?php
		for($i=0;$i<$num11;$i++)
		{
			$rsdf = fetcharray($rss,$i);
			?>
		    <tr>
			<td width="20%" ><input type="checkbox" name="sname[]" value="<?=$rsdf[subject_id]?>"></td>
			<td ><?=$rsdf["subject_name"]?> </td><td ><?=$rsdf["subject_code"]?> </td>
			</tr>
			<?php
		}
		?>

	    <tr>
		<td colspan="3" align='center'> <input type="button" onClick ="return activate_onclick()" value="<< Activate >>" class='bgbutton'></td>
		</tr>
		</table>
		</div>
		<?php
	}
}
?>
</form>
</BODY>
</HTML>