<html>
<head>
<Script language="JavaScript">

function OpenWind2(URL, title,w,h)
{
 var left = (screen.width/2)-(w/2);
 var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<title>Myschool</title>
</head>
<?php
session_start();
include("../db.php");
//print_r($_POST);
$a_year=$_SESSION['AcademicYear'];
$accyeardet=$_SESSION['AcademicYear'];
$term=$_REQUEST['term'];
$class=$_REQUEST['class'];
$sem=$_REQUEST['sem'];
$title=$_REQUEST['title'];
$desc=$_REQUEST['desc'];

if($_POST['update'])
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$title=$_POST['title'.$cid[$i]];
		$desc=$_POST['desc'.$cid[$i]];
		$sql23="update  grade_cat_setup set sub_skill='".addslashes($desc)."', posi='$title' where id='$cid[$i]'";
		execute($sql23);	
	}
	?>
	<Script language="JavaScript">
	alert("Updated successfully");
	</Script>
	<?
}
?>

<?php		
if($_POST['save'])
{
	if($title=='')
	{
		?>
		<Script language="JavaScript">
		alert("Enter Title");
		</Script>
		<?	
	}
		if($title!='')
		{	
				
			for($v=0; $v<sizeof($term); $v++)
			{
			$sql44="INSERT INTO `grade_cat_setup` (`acc_year`,`class`,`desc`,`title`,`term`) VALUES ('$accyeardet', '$sem','".addslashes($desc)."','$title','$term[$v]')";
			
			execute($sql44);
			}
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php
		}
}
?>
<body>
<form name="frm" method="post">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<table align='center' width='60%' border="1">
<tr>
	<td align='center' class='head' colspan="3" nowrap>Add Category</td>
</tr>
<tr>
    <td align='left' nowrap >&nbsp;Title</td>
    <td align='left' nowrap>&nbsp;<input type='text' name='title' value='' placeholder="Title" autofocus></td>
</tr>   
<tr> 
<td align='left' nowrap>&nbsp;Description</td>
<td align='left' nowrap>&nbsp;
<textarea name='desc' rows='3' cols='50' placeholder="Description"></textarea>
</td>
</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'></div>
  <br>
  <?php
$sql3=execute("select `id`,`title`,`desc`,`term` from  `grade_cat_setup` where `acc_year`='$accyeardet' group by title");
if(rowcount($sql3)>=1)
{	
	?>
    <br>
    <table align='center' class='forumline' width='60%' border="1">
    <tr>
    	<td align='center' class='head' nowrap>Select</td>
        <td align='center' class='head' nowrap colspan="2">Edit Category</td>
        <td align='center' class='head' nowrap>Action</td>
    </tr>
        <?php
        while($r6=fetcharray($sql3))
        {
            
        echo "<tr><td align='center' rowspan='2'><input type='checkbox' name='cid[]' value='$r6[0]'>
        </td>
		<td align='left' nowrap valign='top'>Title</td>
        <td align='left' nowrap>&nbsp;&nbsp;
        <input type='text' name='title$r6[0]' value='$r6[1]'>
        </td>";
		?>
		<td align='center' nowrap rowspan="2"><a href="javascript:void(0);" onClick ="OpenWind2('addcat.php?sem=<?=$sem?>&accyear=<?=$a_year?>', 'OpenWind2',400,400)"><input type="button" class='bgbutton' value="Apply Term"></a></td>
		<?
		echo "</tr>
		<tr>
		<td align='left' nowrap valign='top'><br>Description</td>
        <td align='left' nowrap valign='top'><br>&nbsp;&nbsp;
        <textarea name='desc$r6[0]' rows='3' cols='60' >$r6[2]</textarea></td>
        ";
        }
        ?>
        
        </tr>
        </table>
        <br>
      <div align='center' >
      <input type="submit" name="update" value="UPDATE"  class='bgbutton'></div>
        <?php
}
?>	
  
</form>
</body>
</html>