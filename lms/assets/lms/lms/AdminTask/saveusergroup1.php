<html>
<head><?php
include("../db.php");
$gname=$_POST['gname'];
$module1=$_POST['module1'];
$id=$_POST['id'];
if($module1<>'Main')
{
	$query1  = "select group_name, module from user_group where group_name='".strtoupper($gname)."' ";
	$query1.= " and module='Main' and submodule='Main' and linkname='$module1'";
	$s=execute($query1);
	if(rowcount($s)==0)
	{
		?>
<SCRIPT LANGUAGE ="JavaScript">
alert(' Please Follow proper procedure, Give rights from MAIN to Required Module First.');
 </script>
 <?

	}
	if(rowcount($s)>0)
	{
		$query  = "select group_name, module from user_group where group_name='".strtoupper($gname)."' and module='$module1'";
		$rs = execute($query) or die("query $query " . error_description());
	}
}
else if($module1=='Main')
{
	$query  = "select group_name, module from user_group where group_name='".strtoupper($gname)."' and module='$module1'";
	$rs = execute($query) or die("query $query " . error_description());
}
if (rowcount($rs) != 0)
{
	execute("delete from user_group where group_name='$gname' and module='$module1'");
	execute("delete from usermenu where groupname='$gname' and module='$module1'");
}
while (list($key, $value) = each($id))
{
	$res = execute("select submodule, linkname,linkpath ,parameter from links where id='$value'");
	$row1 = fetcharray($res);
	$submodule=$row1['submodule'];
	$linkname=$row1['linkname'];
	$linkpath=$row1['linkpath'];
	$parameter=$row1['parameter'];
	$query  = "insert into user_group (group_name, module, submodule, linkname,linkpath,id,parameter) values(";
	$query .= "'".strtoupper($gname)."', '$module1', '$submodule', '$linkname','$linkpath',$value,'$parameter')";
	//$query=addslashes($query);
	execute($query) or die ("query1 $query" . error_description());
	
	$qry4="select distinct(username) from usermenu where groupname='$gname'";
	$rs4=execute($qry4);
	$row=rowcount($rs4);
	for($t=0;$t<rowcount($rs4);$t++)
	{
		$r4=fetcharray($rs4);				
		$qry3="insert into usermenu (username,module,submodule,linkname,linkpath,access,groupname,id,parameter) values('$r4[username]','$module1','$row1[submodule]','$row1[linkname]','$row1[linkpath]','Yes','$gname','$value','$row1[parameter]')";
		execute($qry3);
	}
}
?>
<SCRIPT LANGUAGE ="JavaScript">
alert('User Group Updated Successfully');
 </script>
 <?

?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="ModUserGroup.php";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
 <input type="hidden" name="gname" value="<?=$gname?>" >
  <input type="hidden" name="module1" value="<?=$module1?>" >

    
     </form>
     </body>
     </html>
