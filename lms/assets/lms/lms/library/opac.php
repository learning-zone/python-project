<?php
session_start();
require_once("../db.php");
if($_GET)
{
	$action=$_REQUEST['action'];
}
if($_POST)
{
	$subj=$_POST['subj'];
	$media=$_POST['media'];
	$searchtext=$_POST['searchtext'];
	
}

 $res = execute("select * from lib_mediatype");

?>
<html><head>
<script language="javascript">
function reload(act)
{
	if(document.frm.media.value=='0')
	{
		alert("Please select the Media");
		document.frm.media.focus();
		return false();
	}
	if(document.frm.searchtext.value=='')
	{
		alert("Please Enter the Text");
		document.frm.searchtext.focus();
		return false();
	}
	else
	{
		document.frm.action='opacs.php?action='+act;
		document.frm.submit();
	}
}
</script>
</head>
<body>
<br/>
<form name="frm" method="POST">
<table class=forumline width="60%" cellspacing="2" cellpadding=2 align='center' border=0>
<tr><td align='center' Class='head' colspan='2'>OPAC Search</td></tr>
<tr height='25'>
		<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;Select Media</td>
		<td align="left">
			<select name='media'>
			<option value='0'>---Select---</option>
			<?php
			while($row = fetcharray($res))
			{
				echo "<option value='$row[id]'>$row[name]</option>";
			}
			?>
			</select>
		</td>
</tr>
<tr>
		<td align="center">Enter Text </td>
		<td><input type='text' name='searchtext' value='' size='50'></td>
</tr>
<tr>
		<?php
		   if($action=='basicsearch')
		   {  
		   		//echo "inside";
				?>
				<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;Enter Choice</td>
				<td>
					<select name='subj'>
					<!-- 		<option value='0'>--Select--</option> -->
							<option value=1>Title words</option>
							<option value=2>Title (exact)</option>
							<option value=3>Title (Starting with)</option>
							<option value=4>Anywhere</option>
							<option value=5>Author</option>
							<option value=6>Subject</option>
							<option value=7>ISBN</option>
							<option value=8>Keyword</option>
							<option value=9>Acc Number</option>

			   </select>
				</td>
				<?php
		   }
		?>
</tr>
</table>
<br>
<center>
<input type='button' name='subp' value='Begin Search' class='bgbutton' onClick="reload('<?php echo $action ?>')">
</center>
</form>
</body>
</html>