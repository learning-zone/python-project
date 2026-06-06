<?php
	include("../db.php");
	$id=$_REQUEST['id'];	 
//delete  code starts
if($_GET['action']=='del' and !$_POST['Save'] and !$_POST['new'])
{
	$idval=$_GET['idval'];
	$nop=execute("update tee_time_table set status=0 where id='$idval'");
	?>
		<Script language="JavaScript">
			alert("Deleted Successfully");
		</Script>
	<?php
}
//delete code ends

//Activate code starts
if($_GET['action']=='Activate' and !$_POST['Save'] and !$_POST['new'])
{
	$idval=$_GET['idval'];
	$nop=execute("update tee_time_table set status=1 where id='$idval'");
	?>
		<Script language="JavaScript">
			alert("Activate Successfully");
		</Script>
	<?php
}
//Activate code ends

//insert code starts
if($_POST['Save'])
{	
	$topic=$_POST['topic'];
	if($_FILES['uploadedfile']['tmp_name'] != null)
	{

		if (file_exists("attachments/") == false)
		$dir_created= mkdir("attachments/",0755);		
		$target_path = basename( $_FILES['uploadedfile']['name']);
		$var3 = date("dmyhis").$target_path;
		$target_path = "attachments/".$var3;
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
	
	}
	$adate=date("Y-m-d");
	$newsql="INSERT INTO tee_time_table ( name, link, adate, status) VALUES ('$topic', '$target_path', '$adate', '1')";
	execute($newsql);
	?>
		<Script language="JavaScript">
			alert("Updated Successfully");
		</Script>
	<?php	
}
//insert code ends
?>
<html>
<head>
    <link href="../../../mistStyle.css" rel="stylesheet" type="text/css" />
<Script language="JavaScript">
function frmsub(val)
	{
		document.MyFrm.action="timetable.php?action=mod&idval="+val;
		document.MyFrm.submit();

	}
	function frmsub1(val)
	{
		document.MyFrm.action="timetable.php?action=del&idval="+val;
		document.MyFrm.submit();

	}
	function frmsub2(val)
	{
		document.MyFrm.action="timetable.php?action=Activate&idval="+val;
		document.MyFrm.submit();

	}
	function RefreshMe(val)
	{
		document.MyFrm.action="timetable.php";
		document.MyFrm.submit();
	}
</script>
</head>
<body class='bodyline'>
<form method="POST" name="MyFrm" ENCTYPE='multipart/form-data'>
<input type="hidden" name="id" value="<?=$id?>">
<br>
<table align='center' class='forumline' width='90%' border="1" >
<tr><td colspan=2 align='center' class='head'>TEE Time Table</td></tr>

<tr>
	<tr>
		<td align='center' class='head' nowrap> Name
		</td>
		
		<td align='center' class='head' nowrap><p>Source </p></td>
        
	</tr>
	<tr>
		<td align='center' nowrap><input type='text' name='topic' value=''></td>
		<td align='center' nowrap><input type='FILE' name='uploadedfile' value='' size='15' ></td>
	</tr>
</table>
<br>
	<div align='center' >
		<input type="submit" name="Save" value="Add"  class='bgbutton' onClick="save()">
        <input type="Button" name="goback" value="Close"  class='bgbutton' onClick="close1()">
 	   </div>
	<br>
<?php
$k=1;
$sql3=execute("select * from tee_time_table where  status=1  ");
if(rowcount($sql3)>=1)
{	
	?>
	<table align='center' class='forumline'  border="1" width='90%' >
        <tr>
            <td align='center' class='head' nowrap>Sl.No</td>
            <td align='center' class='head' nowrap>Name</td>
            <td align='center' class='head' nowrap>View</td>
            <td align='center' class='head' nowrap>Action</td>
        </tr>
 	<?php
	while($r6=fetcharray($sql3))
	{
		echo "<tr>
		<td align='center' nowrap>$k</td>
		<td nowrap>$r6[name]</td><td nowrap>";
		?>
		<a href="javascript:void(0)" onClick="window.open('viewtimetable.php?linkname=<?=$r6['link']?>','editservices', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">View</a>
		<?php
		echo "</td>
		<td align='center'>
		<input type='button' name='new' class='bgbutton' onClick='frmsub1($r6[0])' value='Delete' />
		</td>
		</tr>";
	$k++;
	}
	?>
	</table>
	<?php
}
?>	
<br>
<?php
$k=1;
$sql3=execute("select * from tee_time_table where  status=0  ");
if(rowcount($sql3)>=1)
{	
	?>
	<table align='center' class='forumline'  border="1" width='90%' >
        <tr>
            <td align='center' class='head' nowrap>Sl.No</td>
            <td align='center' class='head' nowrap>Name</td>
            <td align='center' class='head' nowrap>Action</td>
        </tr>
	<?php
	while($r6=fetcharray($sql3))
	{
		echo "<tr>
		<td align='center' nowrap>$k</td>
		<td nowrap>$r6[name]</td>
		<td align='center'>
			<input type='button' name='new' class='bgbutton' onClick='frmsub2($r6[0])' value='Activate' />
		</td>
		</tr>";
	$k++;
	}
	?>
	</table>
	<?php
}
?>	
<br>
		
	</form></body></html>
