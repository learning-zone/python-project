<?php
session_start();
include("../../db.php");
//print_r($_POST);
	$adtevat=date("Y-m-d");
$accyeardet=$_SESSION['AcademicYear'];
$class=$_REQUEST['class'];
$sub=$_REQUEST['sub'];
$subject=$_REQUEST['subject'];
$priority=$_POST['priority'];
$title_a=$_POST['title_a'];
$title_b=$_POST['title_b'];
$title_c=$_POST['title_c'];
$lp_no=$_POST['lp_no'];
$imagepath=$_POST['imagepath'];
$store_stud=$_REQUEST['store_stud'];

if($_POST['save'])
{
		
		if($title_a)
		{
		$target_path = "attach/";
		$fext=basename($_FILES['uploadedfile']['name']);
		$fext1=explode(".",$fext);
		$fexn=$newname.".".$fext1[1];
		
		$val=explode(".",$fext);
				$va11=sizeof($val);
				$va11=$va11-1;
				$filetyo=$val[$va11];
		$target_path = $target_path.date('Ymd').time().".".$filetyo;
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		$imagepath = $target_path;
		else
		$imagepath ='';
		if(!$title_a)
		$title_a=$fext1[0];
			if($imagepath)
			{
			$sql44="INSERT INTO `mail_attachments` (`name`, `link`, `adate`, `username`, `status`,`str_id`) VALUES ('$title_a','$imagepath', '$adtevat', '$user', '1','$store_stud')";
	
			execute($sql44);
			
			?>
		<script type="text/javascript">
    		alert("Records Inserted Successfully");
    		</script>
			<?php	
}
}
}
if($_POST['delet'])
{

	$cid=$_POST['cid'];
	for($j=0;$j<sizeof($cid);$j++)
		{
			execute("update mail_attachments set status=0 where id='$cid[$j]'");
		}
}
?>
<html>
<title>Attachment</title>

<body>
<form name="frm" method="post"  ENCTYPE="multipart/form-data">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3"  border="1">
	<tr>
        <td align='center' class='head' nowrap>Name</td>
        <td align='center' class='head' nowrap>Upload</td>		
	</tr>
	<tr>
        <td align='center' nowrap>
        <input type="text" name='title_a' size="50%" placeholder="Mandatory *"/>
        </td>
        <td align='center' nowrap>
        <input type='FILE' name='uploadedfile' id='uploadedfile' size='15' value="" />
        </td>        
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'></div>
  <br>

  <?php
$sql3=execute("select id,username,name from  mail_attachments where adate='$adtevat' and status=1 and username='$user' and str_id='$store_stud'");
if(rowcount($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3" border="1">
<tr>
		<td align='center' class='head' nowrap>Sel</td>
        <td align='center' class='head' nowrap>Name</td>
        <td align='center' class='head' nowrap>User Name</td>		
</tr>
	<?php
	while($r6=fetcharray($sql3))
	{
	echo  	
			"<tr>
			<td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'></td>
			<td align='center'  nowrap>$r6[2]</td>
			<td align='center'  nowrap>$r6[1]</td>
			</tr>";
				
	}
	?>
	<?php
	?>
	</table>
    <br>
  <div align='center' >
  <input type="submit" name="delet" value="Delete"  class='bgbutton'></div>
	<?php
}
?>	
  
</form>
</body>
</html>