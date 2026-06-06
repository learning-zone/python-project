<?php 
  include("../db.php");
  if($_POST)
  {
      $id=$_POST['id'];  	 
	  $id1=$_POST['id1'];
	  $Delete=$_POST['Delete'];	
  }
  if($_REQUEST)
  {
  	  $id=$_REQUEST['id'];
      $id1=$_REQUEST['id1'];
	  $Delete=$_REQUEST['Delete'];
  }

  //print_r($_POST);
  //echo "<br>";
  //print_r($_REQUEST);
  //echo "<br>";
 error_reporting(0);

$limit_size=50000;

$uploadedfile=$_POST['uploadedfile'];

//If no errors registred, print the success message
 if(isset($_POST['Submit']) && !$errors) 
 {
	
   // execute("update {$prefix}users set img='$big',img_small='$small' where user_id='$user'");
	//$id=$_POST['id'];
	//echo "id".$id;
	$Albumname=$_POST['Albumname'];
	$Description=$_POST['Description'];

	$tempName=date("dmyHis");
	$filename = $tempName.$_FILES['file']['name'];
	
	/*
	if($_FILES['uploadedfile']['tmp_name'] != null)
	{
		$directory = "images";			
		if(file_exists("../PhotoGallery/") == false)
		$dir_created= mkdir("../PhotoGallery/",0777);		
		$target_path = basename( $_FILES['uploadedfile']['name']);
		$var = explode(".",$target_path);
		$var3 = $filename;
		$target_path = "../PhotoGallery/$directory/".$var3;
	
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			execute("INSERT INTO `albumpic` (`AlbumID`, `PicName`, `Description`, `FullImagePath`, `HalfImagepath`, `Cover`, `Status`) VALUES ('$id', '$Albumname', '$Description', '$target_path', '$target_path', '0', '1')");
	
		}	
	}
     */
############################################################################################################################	 
	 //echo "No. files uploaded : ".count($_FILES['uploadedfile']['name'])."<br>"; 

	if($_FILES['uploadedfile']['tmp_name'] != null)
	{
	
		$uploadDir = "images/";
		
		for ($i = 0; $i < count($_FILES['uploadedfile']['name']); $i++) 
		{
		
			$directory = "images/";
			 //echo "File names : ".$_FILES['infile']['name'][$i]."<br>";
			 $ext = substr(strrchr($_FILES['uploadedfile']['name'][$i], "."), 1); 
			
			 // generate a random new file name to avoid name conflict
			 $fPath = md5(rand() * time()) . ".$ext";
			
			 $dir_created= mkdir("../PhotoGallery/",0777);		
			 $target_path = basename( $_FILES['uploadedfile']['name']);
			 $var = explode(".",$target_path);
			 $var3 = $filename;
			 $target_path = "../PhotoGallery/$directory".$fPath;
			if(!$_POST['Albumname'])
			$Albumname="PIC $i";
			else
			$Albumname=$_POST['Albumname']." $i";
			
			 //echo "File paths : ".$_FILES['infile']['tmp_name'][$i]."<br>";
			// $result = move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadDir . $fPath);
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'][$i], $uploadDir . $fPath))
			{
					execute("INSERT INTO `albumpic` (`AlbumID`, `PicName`, `Description`, `FullImagePath`, `HalfImagepath`, `Cover`, `Status`) VALUES ('$id', '$Albumname', '$Description', '$target_path', '$target_path', '0', '1')");
					
			}
			
			 if (strlen($ext) > 0)
			 {
			  //echo "Uploaded ". $fPath ." succefully. <br>";
			 }
		}
	}

 
###################################################################################################################################

 	$change='<div class="msgdiv">Image Uploaded Successfully!</div>';
?>
    <script language="javascript">
	alert("<?php echo $change; ?>");  
	</script>

<?php
 }
 if($_GET['id1']) 
 {
 		$result=execute("UPDATE `albumpic` SET  Status='0' WHERE `id` = '$id1'");
		
		if($result)
		{
			echo "Picture Deleted Successfully";
		}
 
 }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<meta content="en-us" http-equiv="Content-Language">

    <title>picture demo</title>
    
   <link href=".css" media="screen, projection" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery_002.js"></script>
<script type="text/javascript" src="js/displaymsg.js"></script>
<script type="text/javascript" src="js/ajaxdelete.js"></script>
<script language="javascript">
function addnew()
{
	var Albumname=document.getElementById("Albumname").value;
	
	var Description=document.getElementById("Description").value;
	
	var file1=document.getElementById("file").value;
	
	if( Albumname=='' || file1=='')
	{
		if(Albumname=='' && file1!='')
		var msg="Enter the Pic Name ";
		if(Albumname!='' && file1=='')
		var msg="Select Pic ";
		if(Albumname=='' && file1=='')
		var msg="Enter the Pic Name and Select Pic";
		
		alert(msg);
	}
	else
	{
		document.form1.action="schoolGalleryPic.php?save=save";
		document.form1.submit();
	}
			
		
} 
function addnew1(str)
{
	document.frm.action="schoolGalleryPic.php?modify=modify&&id".str;
	document.frm.submit();
}   
</script>	 
 <?php 
 echo $user_row['img_src']; 
  if($_REQUEST['action']=='edit')
 {
	$id=$_REQUEST['id'];
	$id1=$_REQUEST['id1'];
	$temsq=execute("select PicName, Description from albumpic where id='$id1'");
	while($r=fetcharray($temsq))
	{
		$Albumname=$r['PicName'];
		$Description=$r['Description'];
	}
 }

 
 ?>

  </head><body>
     
	<div id="space"></div>

        <form method="post" action="" enctype="multipart/form-data" name="form1">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="id1" value="<?php echo $id1; ?>" />
        <table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="head" align="center">Photo Gallery</td>
    </tr>
  <tr>
    <td>&nbsp;Pic Name</td>
    <td>&nbsp;<input type="text" name="Albumname" id="Albumname"  value="<?php echo $Albumname; ?>"  /></td>
  </tr>
  <tr>
    <td>&nbsp;Description</td>
    <td>&nbsp;<textarea id="Description" name="Description" rows="4"  cols="40"><?php echo $Description; ?></textarea></td>
  </tr>
  <?php
 if($_REQUEST['action']!='edit')
 {
	?>
  <tr>
    <td>&nbsp;Picture</td>
    <td>&nbsp;<input size="25" name="uploadedfile[]" id='uploadedfile' type="file" class="bgbutton" multiple="true" />&nbsp;&nbsp;Image maximum size :5 MB</td>
  </tr>

	<?php
 }
	?>

</table>


<br>

<div align="center">
<?php
 if($_REQUEST['action']=='edit')
 {
	 ?>
	    <input type="button" name="Modify1" value="Modify" onClick="addnew1()"  class="bgbutton" />
        &nbsp;&nbsp;&nbsp;
        <a href="schoolGalleryPic.php?id=<?=$id?>">
         <input type="button" name="Addnew" value="Add New" class="bgbutton" />
        </a>
        &nbsp;&nbsp;&nbsp;
    	<a href="javascript:OpenWind2('schoolGalleryPic.php?id1=<?=$r[id]?>&&id=<?=$id?>&&action=Delete')" >
	     <input type="button" name="delete" value="Delete" class="bgbutton" />
        </a>     <?php
 }
 else
 {
	?>
	<input type="submit" id="mybut" value="Upload" name="Submit" onClick="addnew()" class="bgbutton"/>
	<?php
 }
 ?>
 </div>
   </form>
		<br>
    <table  class='forumline' align='center' width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="4" class="head" align="center">Modify Photo Gallery  </td>
	</tr>
  <tr>
    <td width="10%" align="center" class="rowpic">Sl.No.</td>
    <td align="center" class="rowpic" nowrap="nowrap">Pic name</td>
   <!-- <td align="center" class="rowpic">Action</td >
    --><td align="center" class="rowpic">Action</td>
  </tr>
  <?
	$inc=1;
	$temsql3=execute("select * from albumpic where status=1 and AlbumID='$id' order by id desc");
	while($r=fetcharray($temsql3))
	{
		echo "
		<tr height='25'>
			<td align='center'>$inc</td>
			
			
			<td align='center' nowrap>$r[PicName]";
			echo "</td>";
		//	<td align='center' nowrap>&nbsp;&nbsp;";
			?>
           <!-- 
			<a href="javascript:OpenWind2('schoolGalleryPic.php?id1=<?=$r[id]?>&&id=<?=$id?>&&action=Delete')" >
			Delete</a>
            &nbsp;&nbsp;&nbsp;
            <a href="schoolGalleryPic.php?id1=<?=$r[id]?>&&action=edit&&id=<?=$id?>">
			Edit </a>
            </td>-->
<?php
			echo '<form id="frmd" name="frmd" method="POST" action="schoolGalleryPic.php">';
			
			
			echo "<td align='center' nowrap valign='middle'>
			<a href='schoolGalleryPic.php?id1=".$r[id]."&&id=".$id."' title='DELETE THIS PICS '>
			<img height='46' width='70'  src='$r[HalfImagepath]' />&nbsp;";
			//echo '<input type="radio" name="test" />';
			echo '<input type="hidden" name="id1" value="<?=$id1?>"/>';
			echo '<input type="button" value="Delete" name="Delete" class="bgbutton"/>';
			
			echo "</a></td>
		</tr></form>";
  $inc++;
	}
	
	?>
	</table>
		
</body></html>
