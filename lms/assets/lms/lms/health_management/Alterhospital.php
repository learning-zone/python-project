<html>

<head><?php

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

			$sql=execute("select * from hospital_tab where hospital_name='$RName' and  id!='$Value)'") or die("<font color=red><b> Enter valid data.</b></font>");

			if(rowcount($sql)>=1)

			{

				echo "<font color=red><b>Duplicate Hospital Name !! </b></font><br>";

				echo "<font color=red><b><a href=add_hospital.php>Back To Add Hospital Form</a></b></font>";

				die();

			}

			elseif(trim($RName)!='')

			{

				//echo ("Update nationality set nation='" .trim($RName) . "' , short_nation='" .trim($SName) . "' where id=" .trim($Value));

				$sqlstr = execute("Update hospital_tab set hospital_name='" .trim($RName) . "'  where id=" .trim($Value)) or die(error_description());

			}

			else

			{

				echo "<font color=blue>Hospital Name Can not be Empty</font>";

			}

		}

	}

}

else

{

	echo"<font color=red><b>Please Follow Proper Procedure</b></font>";

}



?><SCRIPT LANGUAGE ="JavaScript">

	function reload1()

	{

    document.form1.action="add_hospital.php";

	 document.form1.submit();

	 }

	 </script>

</head>

<body onLoad="reload1()" >

 <form name="form1" method="post">

     </form>

     </body>

     </html>

