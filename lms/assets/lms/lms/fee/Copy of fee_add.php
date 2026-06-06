<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<html>
<head>
  <SCRIPT LANGUAGE="JavaScript" SRC="../js/cal2.js" TYPE="text/javascript"> </SCRIPT>
  <SCRIPT LANGUAGE="JavaScript" SRC="../js/cal_conf2.js" TYPE="text/javascript"> </SCRIPT>

<script language="javascript" type="text/javascript">
function ajaxFunction()
{
	var ajaxRequest; 
	try
	{
		ajaxRequest = new XMLHttpRequest();
	} 
	catch (e)
	{
		try
		{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) 
		{
			try
			{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} 
			catch (e)
			{
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

	var amount = document.getElementById('amt').value;
	var queryString = "?amount=" + amount + "&stud_id=" + '<?php echo $stud_id ?>' + "&course=" + '<?php echo $course ?>' + "&sem=" + '<?php echo $sem ?>' + "&adm_id=" + '<?php echo $adm_id ?>';
	
			ajaxRequest.open("GET","fee_add1.php"+ queryString,true);
			ajaxRequest.send(null);
}
</script>
</head>
<body >
<form name="frm" method='GET' >
<table border='1' width=50% align=center cellspacing='0' cellpadding='1'>
	<tr>
		<td colspan='2' align='center' class='head'>Fee General Receipt </td>
	</tr>
	<tr>
		<td align='center'>Date</td>
		<td>
			<INPUT type="text" name="pay_date" readonly>
			<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle"></a>
		</td>
	<tr>
		<td align='center'>Fee Amount</td>
		<td><input type='text' name='amt' id='amt' value='' onchange="ajaxFunction();"></td>
	</tr>
</table>
</form>
<br>
<div id='ajaxDiv'><center><b></b></center></div>
<br>