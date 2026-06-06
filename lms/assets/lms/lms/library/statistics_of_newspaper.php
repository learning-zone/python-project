<?php
include_once("../db.php");
$register=$_POST['register'];
$SeekPos=$_POST['SeekPos'];
$media_type=$_POST['media_type'];
$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$FYear=$_POST['FYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];
?>
<html>
<head>
<script language="JavaScript">
function frm_submit()
{
	document.form1.action='view_statistics_ofnewspaper.php'
	document.form1.submit();
}
</script>
</head>
<body>
<?
	echo "<form name=form1 method=post >";
	echo "<input type='hidden' name=SeekPos value=$SeekPos>";
	echo "<table  align='center' class=forumline width='47%'>";
	echo "<tr><td class='head' align='center' colspan=3>Statistics of News Paper/Magazines</td></tr>";
	echo "<tr>";
	/*
	echo "<td>";
		echo "<div align=left>Register";
	echo "</td>";
	echo "<td>";
		$qry="select * from lib_register ";
		echo "<select name=register onChange='javascript:document.form1.submit()'>";
		echo "<option value='0'>----  Select Register  ----</option>";
		if($register==-1)
		{
			$ss="selected";
		}else
		{
			$ss="";
		}
		echo "<option value='-1' $ss>----  ALL ----</option>";
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
	*/
		$Register=1;
	echo "</tr>";
	//if($register !=0 || $register==-1)
	{
	echo "<tr>";
	echo "<td align='right'>";
	echo " Media Type &nbsp;";
	echo "</td>";
	echo "<td>";
	echo "<select name='media_type'>";
	echo "<option value='M'>Magazines</option>";
	echo "<option value='J'>Journals</option>";
	echo "<option value='N'>News Paper</option>";
	echo "</select>";
	echo "</td></tr>";

		echo "<tr>";
		echo "<td  align='right'> From Date &nbsp;</td>";
		echo "<td  align='left'>";
		$d=getdate();
		$MyDay=$d["mday"];
		echo "<select name='FDay'>";
		for($i=1;$i<=31;$i++)
		{
			if($i <10)
			{
				$i="0".$i;
			}
			if($i == $MyDay)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i'>$i</option>\n";
		}
		echo "</select>";
		$MyMonth=$d["mon"];
		echo "<select name='FMon'>";
		for($i=1;$i<=12;$i++)
		{
			if($i <10)
			{
				$i="0".$i;
			}
			if($i == $MyMonth)
				echo "<option value='$i' selected>" . month_name($i) . "</option>\n";
			else
				echo "<option value='$i'>" . month_name($i) . "</option>\n";
		}
		echo "</select>";
		$maxYr =$d["year"]+1;
		$MyYear=$d["year"];
		echo "<select name='FYear'>";
		for($i=1997;$i<=$maxYr;$i++)
		{
			if($i == $MyYear)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td  align='right'>To Date &nbsp;</td>";
		echo "<td  align='left'>";
		$d=getdate();
		$MyDay=$d["mday"];
		echo "<select name='TDay'>";
		for($i=1;$i<=31;$i++)
		{
			if($i < 10)
			{
				$i="0".$i;
			}
			if($i == $MyDay)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i'>$i</option>\n";
		}
		echo "</select>";
		$MyMonth=$d["mon"];
		echo "<select name='TMon'>";
		for($i=1;$i<=12;$i++)
		{
			if($i <10)
			{
				$i="0".$i;
			}
			if($i == $MyMonth)
				echo "<option value='$i' selected>" . month_name($i) . "</option>\n";
			else
				echo "<option value='$i'>" . month_name($i) . "</option>\n";
		}
		echo "</select>";
		$maxYr =$d["year"]+1;
		$MyYear=$d["year"];
		echo "<select name='TYear'>";
		for($i=1997;$i<=$maxYr;$i++)
		{
			if($i == $MyYear)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
		echo "</td>";
		echo "</tr>";
		
	}
	echo "</table>";
	echo "<p align=center>";
    echo "<input type=submit name=button value='Search' onClick='frm_submit()' class='bgbutton'>";
    echo "</p>";
	echo "</form>";
function month_name($mon)
{
	if($mon == '01') return("Jan");
	if($mon == '02') return("Feb");
	if($mon == '03') return("Mar");
	if($mon == '04') return("Apr");
	if($mon == '05') return("May");
	if($mon == '06') return("Jun");
	if($mon == '07') return("Jul");
	if($mon == '08') return("Aug");
	if($mon == '09') return("Sep");
	if($mon == '10') return("Oct");
	if($mon == '11') return("Nov");
	if($mon == '12') return("Dec");
}
?>
</BODY>
</HTML>