<html>
<head><?php
session_start();
require("../db.php");
$rid=$_POST['rid'];
$Types=$_GET['Types'];
if( is_array($rid) )
{
	while( list(,$Value) = each($rid) )
	{
		$RName = $_POST['RName'.$Value];

		if(strtoupper($Types) == "MOD")
		{
			$sql=execute("select * from language where lang='$RName' ") or die("<font color=red><b> Enter valid data.</b></font>");
			if(rowcount($sql)>=1)
			{
				?>
<SCRIPT LANGUAGE ="JavaScript">
alert('Duplicate language !!');
 </script>
 <?
 
			}
			elseif(trim($RName)!='')
			{
			
				$sqlstr = execute("Update language set lang='" .trim($RName) . "'  where id=" .trim($Value)) or die(error_description());
			}
			else
			{
				?>
<SCRIPT LANGUAGE ="JavaScript">
alert('Language  Can not be Empty');
 </script>
 <?
 
			}
		}
	}
}
else
{
	?>
<SCRIPT LANGUAGE ="JavaScript">
alert('Please Follow Proper Procedure');
 </script>
 <?
 
}
?><SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="language.php";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>

