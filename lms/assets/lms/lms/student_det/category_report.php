<?php
include("../db.php");
?>
<html>
<head>
	<script language='javascript'>
	function sendMe(xyz)
	{
		if(document.frm.sem.value!='0')
		{
			if(xyz==1)
			{
				document.frm.action='stud_det8.php';
				document.frm.submit();
			}
			if(xyz==2)
			{
				document.frm.action='stud_det9.php';
				document.frm.submit();
			}
		}
		else
		{
			alert("Please Select Semester");
			document.frm.sem.focus();
		}
	}
	function reload()
	{
		document.frm.action='category_report.php';
		document.frm.submit();
	}
	</script>
</head>
<body>
<form name='frm' method='POST' >
<table border='0' align='center' cellspacing='3' cellpadding='3' class='forumline' width='50%'>
<tr>
	<td class='head' colspan='2' align='center'>Categorywise Admission Report</td>
</tr>
<input type="hidden" name="sem" value="1">
<input type="hidden" name="course" value="1">
<tr>
	<td align='center'>Academic Year</td>
	<td><select name="a_year" onchange="go()">
		<option value="0"> select academic year</option>
		<?php
			   $MyYear=date('Y')-5;
			   $CurrentYr=date("Y")+5;
			   for($i=$MyYear;$i<$CurrentYr;$i++)
			   {
					$Fyear=$i;
					$Tyear=$i+1;
					$Tyear=substr($Tyear,2);
					$sele="";
					if($a_year==0)
					 {
						if($i==date('Y'))
						 {
							$sele="selected";
						 }
					 }
					 else 
					 {
						 if($i==$a_year)
						$sele="selected";
					 }	 
					 ?>
				  		<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>-<?=$Tyear?></option>
					<?php
				}
	   ?>
             </select></td>
</tr>
</table>
<br>
<center>
	<input type='button' name='breif' value='Breif Report' onclick='sendMe(1)' class='bgbutton'>
  </center>
</form>
</body>
</html>