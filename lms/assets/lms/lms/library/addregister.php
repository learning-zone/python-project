<?php
session_start();
require_once("../db.php");

$act=$_REQUEST['act'];
$register=$_POST['register'];
$library=$_POST['library'];
$submit1=$_POST['submit1'];
$SchoolCode=$_SESSION['SchoolCode'];

//print_r($_GET);
//print_r($_POST);

if(isset($submit1))
{
	if($library=='' || $register=='' )
		echo "<div>ERROR : Library not Selected or Register Name not Entered...</div><br>";
	else
	{
		$qry=execute("insert into lib_register values(NULL,$library,'$register','$SchoolCode')");
		echo "<div>Register details added...</div><br>";
	}
}
$submit2=$_POST['submit2'];
if(isset($submit2))
{
	$rsid=$_POST['rsid'];
	if(is_array($rsid))
	{
		while( list(,$Value) = each($rsid) )
		{
			$lib=$_POST["lib".$Value];
			$regn=$_POST["regn".$Value];
				
			if($regn=='')
				echo "<div>Register name cannot be empty ...</div><br>";
			else
				$qry=execute("update lib_register set library='$lib',register='$regn' where id=$Value");
		}
		echo "<div>Register details updated ...</div><br>";
	}
	else
		echo "<div>Please select checkbox ...</div><br>";
}
?>
<html>
<head>
<Script language="JavaScript">
function reload()
{
	document.form1.action="addregister.php";
	document.form1.submit();
}
</script>
</head>
<body>
<form name='form1' method='post' action="addregister.php">
<?php
if($act=="")
{
	?>
 <table class='forumline' align='center' width='47%'>
	<tr>
    	<td colspan='2' class='head' align='center'>MANAGE CATEGORY</td>
    </tr>
	<tr height='30'>
    	<td align='right'>Operation&nbsp;&nbsp;&nbsp;</td>
        <td align='left'><select name='act' onchange='reload()'>
        <option value=''>-- Select --</option>
        <option value='1'>&nbsp;&nbsp;ADD&nbsp;&nbsp;</option>
        <option value='2'>&nbsp;&nbsp;MODIFY&nbsp;&nbsp;</option>
        </select></td>
     </tr>
  </table>
    <?
}
else
{
	echo "<input type='hidden' name='act' value='$act'>";
	if($act==1)
	{
		?>
		<table class='forumline' align='center' width="47%">
		<tr>
        	<td colspan='2' class='head' align='center'>ADD CATEGORY DETAILS</td>
		</tr>
		<tr>
            <td nowrap>&nbsp;&nbsp;Library</td>
            <?php 
				$qry="select * from library_name";
				$rs=execute($qry);
				echo "<td><select name=library>";
				while($row=fetcharray($rs))
				{
					echo "<option value='$row[id]'>$row[name]</option>";
				}
				echo "</select></td></tr>";
            ?>
		<tr>
        	<td nowrap>&nbsp;&nbsp;Category Name</td>
			<td><input type='text' name='register' size='35'></td>
        </tr>
	</table>
	<br>
    <div align='center'><input type='submit' name='submit1' value='Add' class='bgbutton' style="width:60px; height:22px"></div>
    	<?php
	}
	else
	{
		$qry="select * from lib_register order by register";
		$rs=execute($qry);
		if(rowcount($rs)>0)
		{
			?>
			<table class='forumline' align='center' width="47%">
			<tr>
            	<td class='head' colspan='4' align='center'>MODIFY CATEGORY DETAILS</td>
            </tr>
			<tr>
            	<td align='center' class="row3">SELECT</td>
                <td align='center' class="row3">Library</td>
                <td align='center' class="row3" nowrap>Category Name</td>
            </tr>
			<?php
			while($row=fetcharray($rs))
			{
				echo "<tr><td align='center'><input type='checkbox' name='rsid[]' value='$row[id]'></td>";
				$s=execute("select * from library_name");
				echo "<td align='center'><select name='lib".$row[id]."'>";
				while($r1=fetcharray($s))
				{
					if($r1[id]==$row[library])
						echo "<option value='$r1[id]' selected>$r1[name]</option>";
					else
						echo "<option value='$r1[id]'>$r1[name]</option>";
				}
				echo "</select></td>";
				echo "<td align='center'><input type='text' name='regn".$row[id]."' value='$row[register]' size='30'></td></tr>";
			}
			?>
			</table>
	<br>
    <div align='center'><input type='submit' name='submit2' value='Modify' class='bgbutton' style="width:70px; height:22px"></div>		
	<?php
		}
	}
}
?>
</form>
</body>
</html>