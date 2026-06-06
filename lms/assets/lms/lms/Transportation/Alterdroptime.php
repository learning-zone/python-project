<?php

session_start();

require("../db.php");

$Types=$_REQUEST['Types'];

$rid=$_POST['rid'];

if( is_array($rid) )

{

	while( list(,$Value) = each($rid) )

	{

		$RName =$_POST['RName'.$Value];

		if(strtoupper($Types) == "MOD")

		{

			$sql=execute("select * from trans_drop_time where drop_time='$RName' and  id!='$Value)'") or die("<font color=red><b> Enter valid data.</b></font>");

			if(rowcount($sql)>=1)

			{

				echo "<font color=red><b>Duplicate Name !! </b></font><br>";

				echo "<font color=red><b><a href=add_droptime.php>Back To Add Hospital Form</a></b></font>";

				die();

			}

			elseif(trim($RName)!='')

			{

				//echo ("Update nationality set nation='" .trim($RName) . "' , short_nation='" .trim($SName) . "' where id=" .trim($Value));

				$sqlstr = execute("Update trans_drop_time set drop_time='" .trim($RName) . "'  where id=" .trim($Value)) or die(error_description());

			}

			else

			{

				echo "<font color=blue>Drop Time Can not be Empty</font>";

			}

		}

	}

}

else

{

	echo"<font color=red><b>Please Follow Proper Procedure</b></font>";

}
?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">

	function reload1()

	{

    document.form1.action="add_droptime.php";

	 document.form1.submit();

	 }

	 </script>

</head>

<body onLoad="reload1()" >

 <form name="form1" method="post">

     </form>

     </body>

     </html>

