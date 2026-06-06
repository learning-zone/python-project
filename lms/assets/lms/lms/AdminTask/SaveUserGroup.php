<html>
<head><?php
include("../db.php");
$module1=$_POST['module1'];
$id=$_POST['id'];
$group_name=$_POST['group_name'];
if($module1<>'Main')
{
	$query1  = "select group_name, module from user_group where group_name='".strtoupper($group_name)."' ";
	$query1.= " and module='Main' and submodule='Main' and linkname='$module1'";
	$s=execute($query1)or die("query $query " . error_description('oooooooooooooooo'));
	if(rowcount($s)==0)
	{
		echo "Please Follow proper procedure, Give rights from MAIN to Required Module First.";
		die();
	}
	if(rowcount($s)>0)
	{
		$query  = "select group_name, module from user_group where group_name='".strtoupper($group_name)."' and module='$module1'";
		$rs = execute($query) or die("query $query " . error_description('kkkkkkkkkkk'));
	}

}
else 
{
	$query  = "select group_name, module from user_group where group_name='".strtoupper($group_name)."' and module='$module1'";
	$rs = execute($query) or die("query $query " . error_description('mmmmmmmmm'));
}
if (rowcount($rs) != 0)
{
	execute("delete from user_group where group_name='$group_name' and module='$module1'");
}
if(is_array($id))
{
	while (list($key, $value) = each($id))
	{
		$res = execute("select submodule, linkname,linkpath ,parameter from links where id=$value");
		$row1 = fetcharray($res);
		$query  = "insert into user_group (group_name, module, submodule, linkname, id,linkpath,parameter) values(";
		$query .= "'".strtoupper($group_name)."', '$module1', '$row1[submodule]', '$row1[linkname]', $value,'$row1[linkpath]','$row1[parameter]')";
		execute($query);

	}
	?>
	<SCRIPT LANGUAGE ="JavaScript">
    	alert(' Data Inserted Successufully');
    </script>
 <?
 
}
?>

<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
		document.form1.action="AddUserGroup.php";
		document.form1.submit();
	}
</script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>

