<html>
<?php
session_start();
include("../urlaccess.php");
include("../db.php");

?>

<head>

<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<script language="javascript" type="text/javascript">
function ajaxFunction()
{
	var ajaxRequest; // The variable that makes Ajax possible!
	try
	{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} 
	catch (e)
	{
		// Internet Explorer Browsers
		try{
		ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) 
		{
			try{
			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e)
		{
			// Something went wrong
			alert("Your browser broke!");
			return false;
		}
		}
	}

	ajaxRequest.onreadystatechange = function()
	{
		if(ajaxRequest.readyState == 4)
		{
			var ajaxDisplay = document.getElementById('ajaxDiv');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}

	var word = document.getElementById('test').value;
	

	var queryString = "?word=" + word ;
	ajaxRequest.open("GET","feetype1.php"+ queryString,true);
	ajaxRequest.send(null);
	
}

</script>



</head>
<body>
 <form  method='GET'>

	<table class='forumline' align=center border="1" width=50%>
	<tr><td Class="head" align='center' colspan=2 >ADD FEE TYPE</td></tr>
	<tr><td>Select Course</td>
	 <td><select name="coursesel" onchange="ajaxFunction();" id="test">
	 <option value='0'>Select Course</option>
	 <?php
	 	$sql="select * from course_m ";
	 	$rs=execute($sql) or die(error_description());
	 	for($i=0;$i<rowcount($rs);$i++)
	 	{
	 	  $r1=fetchrow($rs);
	  		if($r[coursesel]==$r1[0])
	 		{
	 ?>
	 		<option value="<?=$r1[0]?>" selected><?=$r1[1]?></option>
	 <?php
	 		}
	 		else
	 		{
	 ?>
	 		<option value="<?=$r1[0]?>"><?=$r1[1]?></option>
	 <?php
	 		}
	 	}
	 ?>
	 </select>
</td></tr></table>



</form>
	
<div id='ajaxDiv'></div>






 

  
