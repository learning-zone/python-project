<html>
<head><?php
session_start();
include("../db.php");
$language=$_GET['language'];
if(strlen($language))
{
	$sql1=execute("select * from language where lang='$language'") or die(error_description());
	if(rowcount($sql1)>=1)
	{
		?>
<SCRIPT LANGUAGE ="JavaScript">
alert('Duplicate Language  Entered !! Cannot Save Details');
 </script>
 <?

	}
	$sqlstr="Insert Into language(lang) Values ('$language')";
	execute($sqlstr) or die("Cannot insert into language table!");
	
 }else{
	 		?>
<SCRIPT LANGUAGE ="JavaScript">
alert('Please Enter Valid language Name');
 </script>
 <?

 }
?>
<SCRIPT LANGUAGE ="JavaScript">
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

