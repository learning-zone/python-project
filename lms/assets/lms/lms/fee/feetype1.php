<?php
session_start();
include("../db.php");
$word = $_GET[word];
$word = mysql_real_escape_string($word);
?>
<head>


</head>
<body>
<form name="form1" method="Post" action="feetype2.php"  >
<?php
$sql = "SELECT * from fee_type where course_id='$word'";
$rs = execute($sql);
$rc = rowcount($rs);
 if($rc>0)
     {
?>

		<table class='forumline' align=center border="1" width=50%>
	<tr><td Class="head" align='center' colspan=2 >MODIFY FEE TYPE</td></tr>
	<tr>
	<td >Modify</b></td>
	<td >Fee Name</b></td>
	<?
     while($r = fetcharray($rs,0))
	{
	?>
	
	
	<tr>
		<td><input type="checkbox" name="fid[]" value="<?php echo $r[id]?>"></td>
		<td><input type="text" size="20" name="fname<?php echo $r[id]?>" value="<?php echo $r[fee_name]?>"></td>
	</tr>

	<?
}
	
	?>
	<tr>
		<td colspan="7" align="center">
			<input type="submit" Value=" Modify ">
		</td>
	</tr>
	</table>
<?
	 }
?>

<br><br>
<table class='forumline' align=center border="1" width=50%>

<tr><td Class="head" align='center' colspan=2 >ADD FEE TYPE</td></tr>
<tr>
	<td >Fee Name</td>
	
	<td ><input type="text" size="20" name="feename"></td>
</tr>
<tr>
	<td align=center colspan=7 ><input type="submit" value="Add"></td>
</tr>
</table>
<input type="hidden" name="word" value="<?php echo $word?>">
</form>

