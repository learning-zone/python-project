<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>

<body>
<?php
include("db.php");
$uploadedfile=$POST['uploadedfile'];
$folder1=$_POST['folder1'];


?>
<form name='frm' method='post' ENCTYPE='multipart/form-data' action="upload.php">
<input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' >
<label for="folder">Select folder</label>
<select name="folder1" id="folder1">
  <option value="hostel">hostel</option>
  <option value="library">library</option>
</select>
<br>
<input type="submit" value="update" name="update" class="bgbutton">

</form>
</body>
</html>