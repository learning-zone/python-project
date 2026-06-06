<html>
<head>
<?php
session_start();
include("../db.php");
if($_REQUEST['course'])
{
	$master=$_REQUEST['master'];
}
else
{
	$master=$_POST['master'];
	$title=$_POST['title'];
	$description=$_POST['description'];	
	$uploadedfile=$_POST['uploadedfile'];	
	
}
$accyeardet=$_SESSION['AcademicYear'];

if($_REQUEST['master']!='')
$idn=$_REQUEST['master'];
else
$idn=$_POST['idn'];

if(isset($_POST['save']))
{

$sql2=execute("select * from kgskills where id='$idn'");
while($r=fetcharray($sql2))
{
	
	$master_id=$r['id']; 	
	$target_path = "img/";
	$fext=basename($_FILES['uploadedfile']['name']);
	$fext1=explode(".",$fext);
	$fexn=$newname.".".$fext1[1];
	$target_path = $target_path.$fext;
	
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
	$imagepath = $target_path;
	else
	$imagepath ='';
echo "select id from lsm_lesson_name where lesson_head='$master_id' and acc_year='$accyeardet'";
		$Sql66=execute("select id from lsm_lesson_name where lesson_head='$master_id' and acc_year='$accyeardet'");
		if(rowcount($Sql66)>0)
		{

			$sql33="update lsm_lesson_name set `description`='".addslashes($description)."',`title`='".addslashes($title)."',img_source='$imagepath' where acc_year='$accyeardet' and lesson_head='$master_id'";
			execute($sql33);
		}
		else
		{
			execute("INSERT INTO lsm_lesson_name(`title`, `description`,`acc_year`, `lesson_head`, `img_source`) VALUES( '$title','$description','$accyeardet','$master_id','$imagepath')");
		}
	
	

	
	?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php
		}
}
?>

<script language='javascript'>
function valid(emark,mrk,varname)
{
	if(isNaN(emark))
	{
		alert("Enter Number only");
		document.getElementsByName(varname)[0].value='';
	}
	else
	{
		if(emark>mrk)
		{
			alert("Scored Mark cannot be greater than max mark");
			document.getElementsByName(varname)[0].value='';
		}
	}
}

function valid1()
{
	var mmarks= parseInt(document.getElementsByName("cc")[0].value);
	var obt_mark = parseInt(document.getElementsByName("ca")[0].value);
	if(isNaN(mmarks))
	{
		alert("Enter number only.");
		document.getElementsByName("cc")[0].value='';
	}
	if(isNaN(obt_mark))
	{
		alert("Enter number only.");
		document.getElementsByName("ca")[0].value='';
	}
	else
	{
		if(obt_mark>mmarks)
		{
			alert("Attended class cannot be greater than conducted class");
			document.getElementsByName("ca")[0].value='';
		}
	}
}
</script>
</head>
<body>
<form name="frm" action="" method="post" ENCTYPE="multipart/form-data">
<?php
echo "
<input type='hidden' name='idn' value='$idn'>";
?>
<table align="center" width="70%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td align="center" class="head" colspan="2"> Lesson Plan </td>
</tr> 
 <?php
  

$Sql67=execute("select * from lsm_lesson_name where lesson_head='$studentid' and acc_year='$accyeardet'");
while($rk=fetcharray($Sql67))
{
$description1=$rk['description'];
$title1=$rk['title'];

}		
?>
<tr>
<td class="row2" colspan="10">Title</td></tr>
<tr>
<td align='center' colspan='2' ><input type="text" name='title' rows='3' cols='70' value="<?php echo $title1; ?>"/></td>
</tr>
<tr>
<td class="row2" colspan="2">Description</td></tr>
<tr>
<td align='center' colspan='10' ><textarea name='description' rows='3' cols='70'><?php echo $description1; ?></textarea></td></tr>
<tr>
<td align="left">&nbsp;&nbsp;Upload Files</td>
<td align="left">&nbsp;&nbsp;<input type='FILE' name='uploadedfile' size='15' value=""/></td>
</tr>
<?php
$description1='';
$title1='';

?>
</tr>
</table>
    <br>
 <div align="center">
<input type="submit" name="save" value="Save" class="bgbutton"></div></form>
</body>
</html>
