<?php

session_start();
include("../db.php");

?>
<html>
<head>
<script language="javascript">
function EditClick()
{
	document.form1.action="Altercat.php?Types=Mod";
	document.form1.submit();
}
function DeleteClick()
{
	document.form1.action="Altercat.php?Types=Del";
	document.form1.submit();
}
function AddClick()
{
	if(document.form2.AdmName.value=='')
	{

		alert("please enter some value");
		return false;
	}
	document.form2.action="Altercat.php?Types=Add";
	document.form2.submit();
}
</script>
</head>
<body class='bodyline'>
<?

$rs=execute("SELECT * FROM category order by name");

if (rowcount($rs)>0)
{

	?>
	<form method="post" id="form1" name="form1">
	<table class='forumline' align=center>
	<tr>
		<td class='head' colspan=2 align='center'> Modify Category</td>
	</tr>
	<tr>
    	<td class="rowpic">Select</td><td class="rowpic" align="center">Category Type</td>
	</tr>
	<?

	while($r=fetcharray($rs))
    {
		?>
		<tr>
        	<td class="CBody" align="center"><input type="checkbox" name="cid[]" Value="<?=$r["id"]; ?>"></td>
            <td class="CBody"><input type="text" size=40 name="Name<?=$r["id"]; ?>" value="<?=$r["name"]; ?>"></td>
		</tr>
		<?
	}
    ?>
	<tr height='40' ><td colspan=2 align='center'>

	<input Type="Button" Value="<< Modify >>" onClick="EditClick()" class='bgbutton'>



	</td></tr>

	</table>

	</form>

	<?
}
?>
<form Name="form2"  method="Post">
<BR>
<table class='forumline' align=center>

<tr>

<td class='head' colspan=2 align='center'> Manage Category</td></tr>

<tr>

<td class="rowpic">

<input type="text" size=40 name="AdmName">

</td></tr>

<tr height='40' ><td colspan=2 align=center><input type="button" onClick="AddClick()" value="<< ADD >>" class='bgbutton'></td></tr>

</table>

</form>



</body>

</html>







