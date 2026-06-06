<?php 
	session_start();
  	include("../db.php");
	$save=$_REQUEST['save'];
	if($save=='save')
	{
		$Albumname=$_POST['Albumname'];
		$Description=$_POST['Description'];
		execute("INSERT INTO `album` (`Albumname`, `Description`, `Class`, `Section`, `Status`) VALUES ('$Albumname', '$Description', '0', '0', '1')");
		$Albumname='';
		$Description='';
		$idval='';

		?>
        <script language="javascript">
        alert("Album created successfully ");
		</script>
        <?php
	}
	if($_REQUEST['modify']=='modify')
	{
		$Albumname=$_POST['Albumname'];
		$Description=$_POST['Description'];
		$idval=$_POST['idval'];
		execute("UPDATE `album` SET `Description` = '$Description',Albumname='$Albumname' WHERE `id` ='$idval'");
		?>
        <script language="javascript">
        alert("Album Modified  successfully ");
		</script>
        <?php
		$Albumname='';
		$Description='';
		$idval='';

	}
	 if($_REQUEST['action']=='delete')
	 {
		$id1=$_REQUEST['id'];
		$temsq=execute("UPDATE `album` SET `Status` = '0' where id='$id1'");
?>
      <script language="javascript">
        alert("Album Deleted  successfully ");
		</script>
  

<?php
	 }


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<meta content="en-us" http-equiv="Content-Language">
	<br>

<script language="javascript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function addnew()
{
	

	var Albumname=document.getElementById("Albumname").value;
	
	var Description=document.getElementById("Description").value;
	
	if(Description=='' || Albumname=='')
	{
		if(Albumname=='' && Description!='')
		var msg="Enter the Album Name ";
		if(Albumname!='' && Description=='')
		var msg="Enter the Album Name ";
		if(Albumname=='' && Description=='')
		var msg="Enter the Album Name and Album Name";
		
		alert(msg);
	}
	else
	{
		document.frm.action="schoolGallery.php?save=save";
		document.frm.submit();
	}
			
		
}
function addnew1()
{
		document.frm.action="schoolGallery.php?modify=modify";
		document.frm.submit();
}
</script>
 <?php
 if($_REQUEST['action']=='edit')
 {
	$id1=$_REQUEST['id'];
	
	$temsq=execute("select Albumname, Description from album where id='$id1'");
	while($r=fetcharray($temsq))
	{
		$Albumname=$r['Albumname'];
		$Description=$r['Description'];
	}
 }
	?>
    <form method="post" action="" enctype="multipart/form-data" name="frm">
    	<input type="hidden" name="idval" value="<?php echo $id1; ?>" />
        <table align="center" width="60%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" class="head" align="center">Photo Gallery</td>
            </tr>
          <tr>
            <td>&nbsp;Album name</td>
            <td>&nbsp;<input type="text" name="Albumname" id="Albumname" value="<?php echo $Albumname; ?>" /></td>
          </tr>
          <tr>
            <td>&nbsp;Description</td>
            <td>&nbsp;<textarea id="Description" name="Description" rows="4"  cols="40"><?php echo $Description; ?></textarea>
             </td>
          </tr>
	</table>
<br>
<div align="center">
<?php
 if($_REQUEST['action']=='edit')
 {
	 ?>
	    <input type="button" name="Modify1" value="Modify" onClick="addnew1()"  class="bgbutton" />
        &nbsp;&nbsp;&nbsp;
        <a href="schoolGallery.php">
         <input type="button" name="Addnew" value="Add New" class="bgbutton" />
        </a>
        &nbsp;&nbsp;&nbsp;
        <a href="schoolGallery.php?id=<?=$id1?>&&action=delete">
         <input type="button" name="delete" value="Delete" class="bgbutton" />
        </a>     <?php
 }
 else
 {
?>
<input type="button" name="addalbum" value="Save" onClick="addnew()"  class="bgbutton" />
<?php
 }
?>
</div>
</form>
		<br>
    <table  class='forumline' align='center' width="60%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" class="head" align="center">Modify Photo Gallery  </td>
        </tr>
      <tr>
        <td width="12%" align="center" class="rowpic">Sl.No.</td>
        <td width="40%" align="center" nowrap="nowrap" class="rowpic">Album name</td>
        <td width="29%" align="center" class="rowpic">Action</td
        >
        <td width="19%" align="center" class="rowpic">Cover Pic</td>
      </tr>
  <?
	$inc=1;
	$temsql3=execute("select * from album where status=1 order by id desc");
	while($r=fetcharray($temsql3))
	{
		echo "
		<tr height='25'>
			<td align='center'>$inc</td>
			<td nowrap>&nbsp;&nbsp;$r[Albumname]";
			echo "</td>
			<td align='center'  nowrap>";
			?>
			<a href="javascript:OpenWind2('schoolGalleryPic.php?id=<?=$r[id]?>')">
			Add Image</a>&nbsp;&nbsp;&nbsp;
            <a href="schoolGallery.php?id=<?=$r[id]?>&&action=edit">
			Edit </a>
            
            </td>
<?php
$tems=fetcharray(execute("select HalfImagepath from albumpic where AlbumID='$r[id]' and (Cover=1 or Cover=0) order by Cover desc, id  limit 1 "));
	
			echo "<td align='center' nowrap valign='middle'>
			<img height='46' width='70' src='$tems[0]' />";
			echo "</td>
		</tr>";
  $inc++;
	}
	
	?>
	</table>

</body>
</html>
