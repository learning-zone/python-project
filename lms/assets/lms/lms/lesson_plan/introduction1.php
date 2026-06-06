<?php
session_start();
include("../db.php");

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

if(isset($_POST['update']))
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$priority=$_POST['priority'.$cid[$i]];
		$title_a=$_POST['title_a'.$cid[$i]];
		$title_b=$_POST['title_b'.$cid[$i]];
		$title_c=$_POST['title_c'.$cid[$i]];
		$lp_no=$_POST['lp_no'.$cid[$i]];
		$imagepath=$_POST['imagepath'.$cid[$i]];
		
		$sql23="update  lms_title set title_a='".addslashes($title_a)."',lp_no='".addslashes($lp_no)."',title_b='".addslashes($title_b)."',title_c='".addslashes($title_c)."',posi='$priority' where id='$cid[$i]'";
		
		execute($sql23);	
	}
		?>
			<script type="text/javascript">
    		alert("Records Updated Successfully");
       		window.opener.location.reload();
    		window.close();
    		</script>
		<?php		
}
if(isset($_POST['save']))
{
	if($title_a!='')
	{
		
		
		$target_path = "menuimage/";
		$fext=basename($_FILES['uploadedfile']['name']);
		$fext1=explode(".",$fext);
		$fexn=$newname.".".$fext1[1];
		$target_path = $target_path.$fext;
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		$imagepath = $target_path;
		else
		$imagepath ='';
		
		$sql2=execute("select * from  lms_title where acc_year='$accyeardet' and sub='$subject' and title_a='$title_a' and title_b='$title_b' and title_c='$title_c' and posi='$priority'");
		if(rowcount($sql2)>=1)
		{
			?>
			<script type="text/javascript">
    		alert("Records Inserted Successfully");
       		window.opener.location.reload();
    		window.close();
    		</script>
			<?php
		}
		else
		{
			
			$sql44="INSERT INTO  lms_title (acc_year, sub, title_a,title_b,title_c, posi,status,lp_no,titleimage) VALUES ('$accyeardet', '$subject', '".addslashes($title_a)."' , '".addslashes($title_b)."','".addslashes($title_c)."', '$priority',1, '".addslashes($lp_no)."','$imagepath')";
	
			execute($sql44);
			?>
			<script type="text/javascript">
    		alert("Records Inserted Successfully");
      		window.opener.location.reload();
    		window.close();
    		</script>
			<?php	
		}
	}
	else
	{
			?>
			<Script language="JavaScript">
			alert("Enter Topic Name");
			</Script>
			<?php
		
	}
}
?>
<html>
</head>
<body>
<form name="frm" method="post"  ENCTYPE="multipart/form-data">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3"  border="1">
	<tr>
        <td align='center' class='head' nowrap>LP Title</td>
        <td align='center' class='head' nowrap>Upload</td>		
        <td align='center' class='head' nowrap>ORDER</td>
	</tr>
	<tr>
        <td align='center' nowrap>
        <input type="text" name='title_a' size="50%"/>
        </td>
        <td align='center' nowrap>
        <input type='FILE' name='uploadedfile' id='uploadedfile' size='15' value=""/>
        </td>        
        <td align='center' nowrap>
        <input type='text' name='priority' value='' maxlength="2" size="2" width="2">
        </td>
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'></div>
  <br>
  
  <br>
  <?php
$sql3=execute("select id, title_a,title_b,title_c, posi,lp_no,titleimage from  lms_title where acc_year='$accyeardet' and sub='$subject'");
if(rowcount($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='70%' cellspacing="0" cellpadding="3" border="1">
<tr>
		<td align='center' class='head' nowrap>Sel</td>
        <td align='center' class='head' nowrap>LP Title</td>
        <td align='center' class='head' nowrap>File Name</td>		
        <td align='center' class='head' nowrap>ORDER</td>
</tr>
	<?php
	while($r6=fetcharray($sql3))
	{
	echo  	
			"<tr>
			<td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'>
			</td>";
		echo"<td align='center' nowrap> <input type='text' name='title_a$r6[0]' size='50%' value='$r6[1]'>
			</td>";
				$img=explode('/',$r6[6]);
				$name=$img[1].$img[2];

			?>
			<td align='cente' nowrap>
			<?=$name?>
			</td>
			<?
			echo"<td align='center' nowrap>
			<input type='text' name='priority$r6[0]' value='$r6[4]' maxlength='2' size='2' width='2'>
			</td>
			</tr>";
			
	}
	?>
	<?php
	?>
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