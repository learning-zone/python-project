<html>

<head><?php

session_start();

include("../db.php");

$drop_time=$_GET['drop_time'];

if(strlen($drop_time))

{

	$sql1=execute("select * from trans_drop_time where drop_time='$drop_time'") or die(error_description());

	if(rowcount($sql1)>=1)

	{

		echo "<font color=red><b>Duplicate Name Entered !! Cannot Save Details</b></font><br>";

		echo "<font color=red><b><a href=add_droptime.php>Back to Add DropTime Form</a></b></font>";

		die();

	}

	$sqlstr="Insert Into trans_drop_time(drop_time) Values ('$drop_time')";

	execute($sqlstr) or die("Can't Save Data !");
	echo "<META HTTP-EQUIV='Refresh' Content='0;URL=point_details.php'>";

	

 }else{

 	echo "<p align=\"Left\"><b>Please Enter Valid Drop Time Name</b></p>";

 }

?>

<SCRIPT LANGUAGE ="JavaScript">

	function reload1()

	{

    document.form1.action="add_droptime.php";

	 document.form1.submit();

	 }
	 </Script>
     <SCRIPT LANGUAGE ="JavaScript">
	 
        
  window.opener.location.href='point_details.php';
  

            alert("Added Successfully");

     
  window.close();
        

	 </script>

</head>

<body onLoad="reload1()" >

 <form name="form1" method="post">

     </form>

     </body>

     </html>

