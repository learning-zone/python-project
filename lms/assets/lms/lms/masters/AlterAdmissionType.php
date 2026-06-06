<html>
<head><?php
session_start();
include("../db.php");
$Types=$_REQUEST['Types'];
$cid=$_POST['cid'];

while( list(,$Value) = each($cid) )
{
	$CName = $_POST['CName'.$Value];
	$sname = $_POST['short_name'.$Value];
	if(strtoupper($Types) == "MOD")
	{
		$rs_sql=execute("select * from admission where name='$CName' and short_name='$sname'");
		if(rowcount($rs_sql)==0)
		{
			$sqlstr = execute("Update admission set name='$CName',short_name='$sname' where id=$Value") or die(error_description());
		}
	}
}
?><SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
		alert("Updated successfully  ");
    	document.form1.action="add_admission_type.php";
	 	document.form1.submit();
	}
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>

