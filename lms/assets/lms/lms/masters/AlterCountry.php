<html>
<head><?php
session_start();
	require("../db.php");
	$rid=$_POST['rid'];
	 $Types=$_REQUEST['Types'];
      if( is_array($rid) )
      {
		while( list(,$Value) = each($rid) )
		{
			$RName =$_POST['RName'.$Value];

			if(strtoupper($Types) == "MOD")
			{
				
				$sql=execute("select * from country where country_name='$RName' ") or die("<font color=red><b> Enter valid data.</b></font>");
					
			if(rowcount($sql)>=1)
			{
				
				echo "<font color=red><b>Duplicate Country !! </b></font><br>";
				echo "<font color=red><b><a href=addcountry.php>Back To Add Country Form</a></b></font>";
				die();
			}
			else
				if(trim($RName)!='')
				{
					$sqlstr = execute("Update country set country_name='" .trim($RName) . "' where id=" .trim($Value)) or die(error_description());
				}
				else
				{
					echo "<font color=blue>Country Name Can not be Empty</font>";
				}
			
			}
			
		}
	  }
		else
		{
			echo"<font color=red><b>Please Follow Proper Procedure</b></font>";
		}

?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    	document.form1.action="addcountry.php";
	 	document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>