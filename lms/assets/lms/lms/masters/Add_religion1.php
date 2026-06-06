<html>
<head><?php
session_start();
include("../db.php");
$cname=$_GET['cname'];
if(strlen($cname))
{
	$sql1=execute("select * from religion where name='$cname'");
	if(rowcount($sql1)>=1)
	{
	
	}
	else
	{
	$sqlstr="insert into religion(name)Values('$cname')";
	execute($sqlstr);
	}
 }
 else
 {
 	
 }
?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="add_religion.php";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>
