<HTML>
<HEAD>
<script>
function validateForm(tempn)
{

	var x=document.forms["frm"][tempn].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	  {
	  		alert("Not a valid e-mail address");
			return false;
	  }
}
</script>
<?php
session_start();
	include("../db.php");

$accyeardet=$_SESSION['AcademicYear'];
$student_id=$_REQUEST['student_id'];
$sub=$_REQUEST['sub'];
$store_stud=$_REQUEST['store_stud'];
$id=$_REQUEST['id'];

$s_name=$_POST['s_name'];
$soccup=$_POST['soccup'];
$smb=$_POST['smb'];
$semail=$_POST['semail'];
$squl=$_POST['squl'];
$soadd=$_POST['soadd'];
$new_id=$_POST['new_id'];
$uploadedfile=$_POST['uploadedfile'];
$imagepath=$_POST['imagepath'];
$relation=$_POST['relation'];

if ($_POST['update'])
{
	$sql23="UPDATE `student_photo_other` SET `relation` = '$relation',`s_name` = '$s_name', `s_occup` = '$soccup', `s_mobi` = '$smb', `s_mail` = '$semail', `s_edu` = '$squl', `s_office_add` = '$soadd',`new_id` = '$new_id' WHERE `id` ='$id'";
	$result=mysql_query($sql23);	
	if($_FILES['uploadedfile']['tmp_name'] != null)
	{
			$f_target_path = "other_photo";			
			if (file_exists("../stud_image_other/") == false)
			$f_path= mkdir("../stud_image_other/",0777);		
			$f_target_path1 = basename( $_FILES['uploadedfile']['name']);
			$file_type = basename( $_FILES['uploadedfile']['type']);
			//$f_path1 = explode(".",$f_target_path1);
			$f_path2 = $student_id;
			$f_target_path1 = "../stud_image_other/$f_target_path/"."IMG_".date('d-m-Y').time().'_'.$f_path2.".".$file_type;
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $f_target_path1))
		{
				$up123d="UPDATE `student_photo_other` SET  `s_photo`='$f_target_path1' WHERE `id` ='$id'";
				$up123d11=mysql_query($up123d);	
			}
		
	}
		?>
			<script type="text/javascript">
            alert("Updated Successfully");
            </script>
	<?php
}
?>

<?
  if ($_POST['delete'])
{
	$sql23="UPDATE `student_photo_other` SET `status` = '0' WHERE `id` ='$id'";
	$result=mysql_query($sql23);
	?>
		<script type="text/javascript">
        alert("Deleted Successfully");
        </script>
    <?
}
	?>	         
</head>
<body>
  <form name="frm1" method="post"  ENCTYPE="multipart/form-data">

  <?php
 
$sql3=mysql_query("select * from  student_photo_other where id=$id and status=1");
if(mysql_num_rows($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3" border="1">
	<?php
	while($r6=mysql_fetch_array($sql3))
	{
		echo "<input type='hidden' name='cid[]' value='$r6[id]'>";
	?>
<tr>
<td align='center' class='head' colspan="3" nowrap>Modify Other Member Details</td>
</tr>
<tr>
<td>&nbsp;&nbsp;Name *</td>
<td align='center'><input type="text" name="s_name" value="<?=$r6[s_name]?>" required></td>
<td rowspan="8" align='center'><img src="<?php echo $r6[s_photo]?>" width="100" height='100'>
<!--<br>
<br>
<br>
<input type="submit" name="delt" value="Delete"  class='bgbutton'>-->
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;Relation *</td>
<td align='center'><input type="text" name="relation" value="<?=$r6[relation]?>" required>
</tr>
<tr>
<td>&nbsp;&nbsp;Occupation</td>
<td align='center'><input type="text" name="soccup" value="<?=$r6[s_occup]?>">
</tr>
<tr>
<td>&nbsp;&nbsp;Mobile Number</td>
<td align='center'><input type="text" name="smb" value="<?=$r6[s_mobi]?>"></td>
</tr>
<tr>
<td>&nbsp;&nbsp;E-mail</td>
<td align='center'><input type="text" name="semail" value="<?=$r6[s_mail]?>" onChange="validateForm(this.name)" ></td>
</tr>
<tr>
<td >&nbsp;&nbsp;Educational Qualification</td>
<td align='center'><input type="text" name="squl" value="<?=$r6[s_edu]?>"></td>	
</tr>
<tr>
<td >&nbsp;&nbsp;Office Address</td>
<td align='center'><input type="text" name="soadd" value="<?=$r6[s_office_add]?>"></td>	
</tr>
<tr>
<td >&nbsp;&nbsp;ID</td>
<td align='center'><input type="text" name="new_id" value="<?=$r6[new_id]?>"></td>	
		</tr>
<tr height='25'>
<td nowrap>&nbsp;&nbsp;Upload Photo</td>
<td align='center'><input type='FILE' name='uploadedfile' id='uploadedfile' size='15' value=""/>
</td>
</tr>       
<?php
	}
	?>
	</table>
 	<?php
}
?>
<br>	
<table align='center' width='70%'>
  <tr>
  <td>
  <div align='left' >
  <a href= "add_other_stud.php?id=<?=$id?>&student_id=<?=$student_id?>"><input type='button' align='center' class='bgbutton' value='Add New'></a></div> 
  </td>
  <td>
  <div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'></div>
   </td>
   <td>
  <div align='right' >
  <input type="submit" name="delete" value="Delete"  class='bgbutton'></div>
  </td>
  </tr>
  </table>
</form>
</body>
</html>