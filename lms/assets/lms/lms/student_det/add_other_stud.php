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
$store_stud=$_REQUEST['store_stud'];

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
	/*$count=mysql_fetch_array(mysql_query("SELECT count(*) FROM `student_photo_other` WHERE `studid` = '$student_id'"));
	echo $count[0];*/
	$cid=$_POST['cid'];
	 
	for($i=0;$i<sizeof($cid);$i++)
	{
		
		/*$relation=$_POST['relation'.$cid[$i]];
		$s_name=$_POST['s_name'.$cid[$i]];
		$smb=$_POST['smb'.$cid[$i]];
		$semail=$_POST['semail'.$cid[$i]];
		$squl=$_POST['squl'.$cid[$i]];
		$soadd=$_POST['soadd'.$cid[$i]];
		$soccup=$_POST['soccup'.$cid[$i]];*/

		
		$sql23="UPDATE `student_photo_other` SET `relation` = '$relation',`s_name` = '$s_name', `s_occup` = '$soccup', `s_mobi` = '$smb', `s_mail` = '$semail', `s_edu` = '$squl', `s_office_add` = '$soadd',`new_id`='$new_id' WHERE `id` ='$cid[$i]'";
				
		//echo $sql23;
		$result=mysql_query($sql23);	
		
	}
	
	
	/*if($_FILES['uploadedfile']['tmp_name'] != null)
	{
			$f_target_path = "other_photo";			
			if (file_exists("../stud_image_other/") == false)
			$f_path= mkdir("../stud_image_other/",0777);		
			$f_target_path1 = basename( $_FILES['uploadedfile']['name']);
			$f_path1 = explode(".",$f_target_path1);
			$f_path2 = $StudID.".".$f_path1[1];
			$f_target_path1 = "../stud_image_other/$f_target_path/".$f_path2;
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $f_target_path1))
		{
			
			$up123d="UPDATE `student_photo_other` SET  `s_photo`='$f_target_path1' WHERE `id` ='$cid[$i]'";
				
		$up123d11=mysql_query($up123d);	
		
			
		}
	}*/

		?>
			<script type="text/javascript">
    		alert("Records Updated Successfully");
    		</script>
		<?php		
}
if ($_POST['save'])
{

	$m_target_path = "other_photo";			
		if (file_exists("../stud_image_other/") == false)
		$m_path= mkdir("../stud_image_other/",0777);		
		$m_target_path1 = basename( $_FILES['uploadedfile']['name']);
		$file_type = basename( $_FILES['uploadedfile']['type']);
		//$m_path1 = explode(".",$m_target_path1);
		$m_path2 = $student_id;
		$m_target_path1 = "../stud_image_other/$m_target_path/"."IMG_".date('d-m-Y').time().'_'.$m_path2.".".$file_type;
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $m_target_path1))
		$m_target_path1 = $m_target_path1;
		else
		$m_target_path1 ='';
	
			$sql44="INSERT INTO `student_photo_other` (`studid`,`relation`,`s_name`, `s_occup`, `s_mobi`, `s_mail`, `s_edu`, `s_office_add`, `s_photo`, `username`, `acc_year`, `status`,`new_id`) VALUES
('$student_id','$relation','$s_name', '$soccup', '$smb', '$semail', '$squl', '$soadd','$m_target_path1', '$user','$accyeardet','1','$new_id')";
	
			 mysql_query($sql44);
			
			?>
			<script type="text/javascript">
    		alert("Records Inserted Successfully");
    		</script>
			<?php	
		
			
	}	
	
			?>
          
</head>
<body>
<form name="frm" method="post"  ENCTYPE="multipart/form-data">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3"  border="1">
	<tr>
        <td align='center' class='head' colspan="2" nowrap>Add Other Member Details</td>
	</tr>
	<tr>
	<td>&nbsp;&nbsp;Name *</td>
	<td align='center'><input type="text" name="s_name" value="" required></td>
	</tr>
    <tr>
<td>&nbsp;&nbsp;Relation *</td>
<td align='center'><input type="text" name="relation" value="Caregiver" required>
</tr>
    <tr>
	<td>&nbsp;&nbsp;Occupation</td>
	<td align='center'><input type="text" name="soccup" value="">
</tr>
 <tr>
   <td>&nbsp;&nbsp;Mobile Number</td>
   <td align='center'><input type="text" name="smb" value=""></td>
 </tr>
 <tr>
	<td>&nbsp;&nbsp;E-mail</td>
	<td align='center'><input type="text" name="semail" value="" onChange="validateForm(this.name)" ></td>
 </tr>
 <tr>
<td >&nbsp;&nbsp;Educational Qualification</td>
<td align='center'><input type="text" name="squl" value=""></td>	
		</tr>
		<tr>
<td >&nbsp;&nbsp;Office Address</td>
<td align='center'><input type="text" name="soadd" value=""></td>	
		</tr>
        <tr>
<td >&nbsp;&nbsp;ID</td>
<td align='center'><input type="text" name="new_id" value=""></td>	
		</tr>
        <tr height='25'>
			 <td nowrap>&nbsp;&nbsp;Upload Photo</td>
           <td align='center'><input type='FILE' name='uploadedfile' id='uploadedfile' size='15' value=""/>
</td>
           
          </tr>       
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'></div>
  </form>
  <br>
  <br>
  <?php

$sql3=mysql_query("select * from  student_photo_other where  studid='$student_id' and status=1");
if(mysql_num_rows($sql3)>=1)
{	
	?>
<br>
      <form name="frm1" method="post"  ENCTYPE="multipart/form-data">

<table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3" border="1">
<tr>
<td align='center' class='head' colspan="5" nowrap>Modify Other Member Details</td>
</tr>
<tr>
<td align='center' class='rowpic'>Name</td>
<td align='center' class='rowpic'>Relation</td>
<td align='center' class='rowpic'>Mobile No.</td>
<td align='center' class='rowpic'>Photo</td>
<td align='center' class='rowpic'>Action</td>

</tr>
	<?php
	
	while($r6=mysql_fetch_array($sql3))
	{
		
		echo "<input type='hidden' name='cid[]' value='$r6[id]'>";
	?>
<tr>
<td align='left'>&nbsp;<?=$r6[s_name]?></td>
<td align='left'>&nbsp;<?=$r6[relation]?></td>
<td align='center'>&nbsp;<?=$r6[s_mobi]?></td>
<td align='center'><img src="<?php echo $r6[s_photo]?>" width="50" height='50'></td>
<td align='center' ><a href= "modi_other_stud.php?id=<?=$r6[id]?>&student_id=<?=$student_id?>"><input type='button' align='center' class='bgbutton' value='Modify'></a></td>
</tr>      
<?php
	}
	?>
	</table>
   </form>
	<?php
	
}
?>	
  

</body>
</html>