<?php
  session_start();
  require_once("../db.php");
  
  $query =execute("SELECT * FROM library_name ORDER BY name");
  $row=rowcount($query);
?>
<HTML>
<HEAD>
<Script language="JavaScript">
function F2a99922b()
{
	if(document.lib_add_mod_del.na.value =="")
	{
		alert("Enter Library Name");
		document.lib_add_mod_del.na.focus()
	}
	else if(document.lib_add_mod_del.ad.value =="")
	{
		alert("Enter Address");
		document.lib_add_mod_del.ad.focus()
	}
	else if(document.lib_add_mod_del.ph.value =="")
	{
		alert("Enter Phone");
		document.lib_add_mod_del.ph.focus()
	}
	else
	{     
		document.lib_add_mod_del.action ="lib_add_mod_del.php?Type=add";
		document.lib_add_mod_del.submit();
	}
}
function F8f45a264()
{
	document.lib_add_mod_del.action = "lib_add_mod_del.php?Type=modify";
	document.lib_add_mod_del.submit();
}
function F0bfb391b()
{
	document.lib_add_mod_del.action = "lib_add_mod_del.php?Type=delete";
	document.lib_add_mod_del.submit();
}
</script>
</HEAD>

<body>
<form method="POST" name="lib_add_mod_del" action="lib_add_mod_del.php">
<table class='forumline' align='center' width="80%">
	<tr>
		<td Class="head" align='center'>LIBRARY DETAILS</td>
	</tr>
	<?php
	if($row > 0)
		{
			?>
<tr>
    <td>
    <table class='forumline' width="100%">
        <tr>
            <!--<td align="center" CLASS="row3">Select</td>-->
            <td align="center" CLASS="row3">Library Name</td>
            <td align="center" CLASS="row3">Address</td>
            <td align="center" CLASS="row3">Phone</td>
            <td align="center" CLASS="row3">Email</td>
            <td align="center" CLASS="row3">Remark</td>
        </tr>
        <?php
        for($i=0;$i<$row;$i++)
            {
                $r = fetcharray($query);
                ?>
                <tr>
                    <input type="hidden" name="Sel[]" value="<?php echo $r[id] ?>">
                    <td align="center"><input type="text" name="na<?php echo $r[id] ?>" value="<?php echo $r[name] ?>" size="30"></td>
                    <td align="center"><textarea rows="3" name="ad<?php echo $r[id] ?>" cols="20"><?php echo $r[address] ?></textarea></td>
                    <td align="center"><input type="text" name="ph<?php echo $r[id] ?>" value="<?php echo $r[phone] ?>"></td>
                    <td align="center"><input type="text" name="em<?php echo $r[id] ?>" value="<?php echo $r[email] ?>" size="30"></td>
                    <td align="center"><input type="text" name="re<?php echo $r[id] ?>" value="<?php echo $r[remark] ?>"></td>
                </tr>
            <?php
            }
        ?>
					
				</table>
				</td>
			</tr>
		<?php
		}
	?>
	<tr>
		<td align="center"><input type="button" value="Modify" onClick="F8f45a264()" id='button2' name='button2' class='bgbutton' style="width:70px; height:22px"></td>
	</tr>
	<tr>
		<td align='center'>
		<table class='forumline' width='100%'>
			<tr>
				<td align="center" CLASS="row3">Library Name</td>
				<td align="center" CLASS="row3">Address</td>
				<td align="center" CLASS="row3">Phone</td>
				<td align="center" CLASS="row3">Email</td>
				<td align="center" CLASS="row3">Remark</td>
			</tr>
			<tr>
				<td align="center"><input type="text" name="na" size="30"></td>
				<td align="center"><textarea rows="3" name="ad" cols="20" class="CBody"></textarea></td>
				<td align="center"><input type="text" name="ph"></td>
				<td align="center"><input type="text" name="em" size="30"></td>
				<td align="center"><input type="text" name="re"></td>
			</tr>
			
		</table>
		</td>
	</tr>
</table>
<br>
<div align="center"><input type="button" value=" Add " onClick="F2a99922b()" class='bgbutton' style="width:70px; height:22px"></div>
</form>
</body>
</html>