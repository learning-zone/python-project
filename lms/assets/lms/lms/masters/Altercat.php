<html>
<head><?
session_start();
include("../db.php");
$cid=$_POST['cid'];
$Types=$_REQUEST['Types'];
$AdmName=$_POST['AdmName'];
if ($Types=="Add")
{
	$rs_sql=execute("select * from category where name='$AdmName'");
	if(rowcount($rs_sql)==0)
	{
  		$sql="INSERT INTO category(name) VALUES('".$AdmName."')";
  		execute($sql);
  		header("Location: "."add_category_type.php");
  	}
  	else
  	{
  		echo "<font color=red><b>Duplicate Category Type Entered !! Cannot Save Details</b></font><br>";
		echo "<font color=red><b><a href=add_category_type.php>Back to Add Admission Form</a></b></font>";
		die();

  	}

}

else
{
	while( list(,$Value) = each($cid) )
	{
		$CName=$_POST['Name'.$Value];

	    if ($Types=="Mod")
	    {
			$rs_sql=execute("select * from category where name='$CName'");
			if(rowcount($rs_sql)==0)
			{
	    	  $sqlstr=trim("Update category set name='$CName' where id=$Value");
	    	}
	    }
	    else
	    {
			echo "DEL=Delete from category where id=$Value";
	      	$sqlstr=trim("Delete from category where id=$Value");
	    }

	    execute($sqlstr);

	}

	  
}
?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="add_category_type.php";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>


