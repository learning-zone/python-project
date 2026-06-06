<?php
session_start();
include("../db.php");

$disname=$_REQUEST['disname'];
$disdet=$_REQUEST['disdet'];

if($_POST['update'])
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$disname=$_POST['name'.$cid[$i]];
		$disdet=$_POST['desc'.$cid[$i]];
		$sql23="update  fee_discount_slab set `name`='{$disname}' ,`desc`='{$disdet}'   where id='$cid[$i]'";
		
		execute($sql23);	
	}
		?>
			<script type="text/javascript">
    		alert("Updated Successfully");
       		window.opener.location.reload();
    		window.close();
    		</script>
		<?php		
}
if($_POST['save'])
{
	if($disname!='')
	{
		
		$sql2=execute("select * from  fee_discount_slab where name='$disname' and status=1");
		if(rowcount($sql2)>=1)
		{
			?>
			<script type="text/javascript">
    		alert("Duplicate Entry ");
    		</script>
			<?php
		}
		else
		{
			
			$sql44="INSERT INTO  fee_discount_slab (`name`, `desc`, `status`) VALUES ('{$disname}','{$disdet}','1')";
			execute($sql44);
			?>
			<script type="text/javascript">
    		alert("Inserted Successfully");
      		window.opener.location.reload();
    		window.close();
    		</script>
			<?php	
		}
	}
	
}
?>
<html>
</head>
<body>
<form name="frm" method="post"  ENCTYPE="multipart/form-data">
<table align='center' class='forumline' width='90%' cellspacing="0" cellpadding="3">
	<tr>
		<td align='center' class='head' nowrap>Name</td>
        <td align='center' class='head' nowrap>description</td>
	</tr>
	<tr>
    <td align='center' nowrap>
            <input type="text" name='disname' />
		</td>
      <td align='center' nowrap>
            <input type="text" name='disdet' />
		</td>
	</tr>
    
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'></div>
  <br>
  
  <br>
  <?php
$sql3=execute("select * from  fee_discount_slab where status='1'");
if(rowcount($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='90%' cellspacing="0" cellpadding="3">
<tr>
		<td align='center' class='head' nowrap>Sel</td>
 		<td align='center' class='head' nowrap>Name</td>
        <td align='center' class='head' nowrap>description</td>
	</tr>
	<?php
	while($r6=fetcharray($sql3))
	{
	echo "<tr><td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'>
		</td>
		 <td align='center' nowrap> <input type='text' name='name$r6[0]' size='20%' value='$r6[1]'>
		</td>
		 <td align='center' nowrap> <input type='text' name='desc$r6[0]' size='50%' value='$r6[2]'>
		</td>
		</tr>";
	}
	
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