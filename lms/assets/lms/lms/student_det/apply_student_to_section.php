<?php
session_start();
require("../db.php");
if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}
$sql1 = "SELECT * FROM course_m order by head_id";
$sql2 = "SELECT * FROM course_year where  status=1 and head_id='$branch'";
if(empty($action))
{
	$action="ViewStudentList.php";
}
else
{
	$mesg = "";
}
?>
<html>
<head>
<title></title>
<script language="JavaScript">
function formSubmit()
{
	if(document.frm.branch.selectedIndex != 0 && document.frm.sem.selectedIndex != 0)
		document.frm.submit();
	else
		alert("Please select a branch and year !!");
}
function reload(str)
{
var url="../sessionbranchfile.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
</script>
</head>
<body topmargin="0" leftmargin="0" >
<form method="post" action="<?=$action?>" name="frm">
<?=$mesg?>
<br>
<table class=forumline align=center width="90%">
<tr><td  Class='head' colspan=4 align=center>Apply Students to Section</td width='25%'></tr>
<tr align="left">
<td width='18%' >&nbsp;&nbsp; <?php echo $_SESSION['branchname']; ?>&nbsp;&nbsp;</td width='25%'>
<td width='32%' >&nbsp;&nbsp;
<select name="branch" size="1" onchange='reload(this.value)'>
<option value="0">-- Select--------</option>
<?php
$rs = execute($sql1);
$num = rowcount($rs);
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($rs,$i);
	if($branch==$r[course_id])
	{
		echo("<option value='" . $r["course_id"] . "' selected>" . $r["coursename"] . "</option>\n");
	}
	else
	{
		echo("<option value='" . $r["course_id"] . "'>" . $r["coursename"] . "</option>\n");
	}
}
?>
</select></td width='25%'>

<td width='17%' >&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?>&nbsp;&nbsp;</td width='25%'>
<td width='33%' align="center">&nbsp;&nbsp;
<div id="txtHint9" class="inline">   
<select name="sem" size="1">
<option value="0">Select Class</option>
<?php
$rs = execute($sql2);
$num = rowcount($rs);
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($rs,$i);
	if($sem==$r["year_id"])
	echo("<option value='" . $r["year_id"] . "' selected> " . $r["year_name"] . "</option>\n");
	else
		echo("<option value='" . $r["year_id"] . "'>" . $r["year_name"] . "</option>\n");	
}

?>
</select></div></td width='25%'>

</tr>
</table>
</form>
</td width='25%'>
</tr>
</table>
<div align="center">
<input type="button" value="Submit" onClick="formSubmit()" class='bgbutton'>
</div>
</body>
</html>