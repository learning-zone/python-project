<html>
<head><?php
session_start();
require("../db.php");
$cid=$_POST['cid'];
$Types=$_REQUEST['Types'];
if( is_array($cid) )
{
	while( list(,$Value) = each($cid) )
	{
		$CName = $_POST['CName'.$Value];
		$Cabbr =$_POST['Cabbr'.$Value];
		if(strtoupper($Types) == "MOD")
		{
			$sqlstr = execute("Update coursehead set cname='" . trim($CName) . "' where id=" . trim($Value) ) or die(error_description());

			$sqlstr = execute("Update course_m set coursename='" . trim($CName) . "',course_abbr='" . trim($Cabbr) . "' where course_ID=" . trim($Value) ) or die(error_description());
		}
		if(strtoupper($Types) == "DEL")
		{
			$sql = "update	course_m set status = 0 WHERE course_id = $Value";
			execute($sql) or die("Cannot alter course table!1");
		}
	}
}

if(is_array($cname))
{
	while( list(,$Value) = each($cname) )
	{
		if(strtoupper($Types) == "ACT")
		{
			$sql = "UPDATE course_m set status=1 where course_id = $Value";
			execute($sql) or die(error_description());
		}
	}
}
?>
    <SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
		alert("Updated Successfully");
    document.form1.action="courseadd.php";
	 document.form1.submit();
	 }
	 </script>
       
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>