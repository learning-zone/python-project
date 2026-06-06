<?php
session_start();
require_once("../db.php");
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
if($_GET)
{
	$media=$_GET['media'];
}
if($_POST)
{
	$B1 = $_POST['B1'];
	$crs = $_POST['crs'];
	$dys = $_POST['dys'];
	$media = $_POST['media'];
	$member = $_POST['member'];
	$issues = $_POST['issues'];
	$renewals = $_POST['renewals'];
}
?>
<HTML>
<HEAD>
<script language="javascript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function frm_reload()
{
	document.frm.action="mem_circulate2.php";
	document.frm.submit();
}
function checkIt(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if((charCode>=48 && charCode<=57)||(charCode>=96 && charCode<=105)||(charCode==8)||(charCode==9)||(charCode==45)||(charCode==46)||(charCode>=35 && charCode<=40))
	{
	  return true;
	}
	else
	{
		alert("Please make sure entries are numbers only.");
		return false;
	}
		return true;
}
</script>
</HEAD>
<BODY>
<form method="POST" name="frm">
<?php 
echo "$msg"; 
echo"<input type=hidden name=member value=$member>";
echo"<input type=hidden name=crs value=$crs>";
?>
<table align=center class=forumline>
<tr><td  align=center class=head colspan=4>Member Circulation Parameters</td></tr>
<tr><td align=center class=row3>&nbsp;&nbsp;&nbsp;Media Type</td>
<td align=center class=row3>Max No. Of Issues</td>
<td align=center class=row3>No of Days</td>
<td align=center class=row3>Max No. Of Renewals</td></tr>
<tr>
<?php
if($_POST['B1']!='')
{
	if($issues == "" || $renewals == "" )
	{
		die("Please Enter all Details");
	}
	else
	{
		if($member=='1')
		{
			$sql="select * from cir_parameter where member='$member' and course='$crs' and media='$media'";
			$rs=execute($sql) or die(mysql_error());
			if(rowcount($rs)==0)
			{
				$muz="insert into cir_parameter(member,course,media,issues,renewals,dys) values('$member','$crs','$media','$issues','$renewals','$dys')";
				$muzz=execute($muz) or die(mysql_error());
				$msg="One Record Inserted Successfully";

			}
			else
			{	
				$sql1="update cir_parameter set issues='$issues', renewals='$renewals',dys='$dys' where member='$member' and course='$crs' and media='$media'";
				execute($sql1) or die(mysql_error());
				$msg="One Record Modified Successfully";
			}
		} 
		if($member=='2')
		{
			$sql="select * from cir_parameter where member='$member' and department='$crs' and media='$media'";
			$rs=execute($sql) or die(mysql_error());
			if(rowcount($rs)==0)
			{
				$muz="insert into cir_parameter(member,department,media,issues,renewals,dys) values('$member','$crs','$media','$issues','$renewals','$dys')";
				$muzz=execute($muz) or die(mysql_error());
				$msg="One Record Inserted Successfully";
			}
			else
			{	
				$sql1="update cir_parameter set issues='$issues', renewals='$renewals',dys='$dys' where member='$member' and department='$crs' and media='$media'";
				execute($sql1) or die(mysql_error());
				$msg="One Record Modified Successfully";
			}
		}
		if($member=='3')
		{
			$sql="select * from cir_parameter where member='$member' and department='$crs' and media='$media'";
			$rs=execute($sql) or die(mysql_error());
			if(rowcount($rs)==0)
			{
				$muz="insert into cir_parameter(member,department,media,issues,renewals,dys) values('$member','$crs','$media','$issues','$renewals','$dys')";
				$muzz=execute($muz) or die(mysql_error());
				$msg="One Record Inserted Successfully";
			}
			else
			{	
				$sql1="update cir_parameter set issues='$issues', renewals='$renewals',dys='$dys' where member='$member' and department='$crs' and media='$media'";
				execute($sql1) or die(mysql_error());
				$msg="One Record Modified Successfully";
			}
		}
	}
}
echo "$msg"; 

$smedia =execute("SELECT * FROM lib_mediatype order by id") or die(mysql_error());
$num = rowcount($smedia);
?>
<td width="100" align="center">
<select size="1" name="media" OnChange="frm_reload()">
<option value=''>--- Select ---</option>
<?php
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($smedia,$i);
	if($r[id]==$media)
		$sel="selected";
	else
		$sel="";
	?>
	<option value="<?php echo $r["id"]?>" <?php echo $sel?>><?php echo $r["name"]?></option>
	<?php
}
?>
</select></td>
<?php
$sql10="select * from cir_parameter where member='$member' and media='$media'";
if($member=='1')
{
	$sql10.=" and course='$crs'";
}
else
{
	$sql10.=" and department='$crs'";
}
$rs10=execute($sql10) or die(mysql_error());

if(rowcount($rs10)>0)
{
	
	$r10=fetcharray($rs10);
	$issues1=$r10[4];
	$renewals1=$r10[7];
	$dys=$r10[8];
}
else
{
	
	$issues1="";
	$renewals1="";
	$dys="";
}
?>	
<td align=center>
<input type="text" name="issues" value="<?php echo $issues1?>" onKeyDown="return checkIt(event)"></td>
<td align=center>
<input type="text" name="dys" value="<?php echo $dys?>" onKeyDown="return checkIt(event)"></td>
<td align=center>
<input type="text" name="renewals" value="<?php echo $renewals1?>" onKeyDown="return checkIt(event)"></td>
<br>
<?php
if(rowcount($rs10)>0)
{
	?>
	</table>
<p align="center"><input type="submit" value="Modify" name="B1" class='bgbutton' onclick='frm_reload()' style="width:70px; height:22px">
	<?php
}
elseif(rowcount($rs10)==0)
{
	?>
	</table>
<p align="center"><input type="submit" value="Save" name="B1" class='bgbutton' onclick='frm_reload()' style="width:70px; height:22px">
	<?php
}
?>
</form>
</body>
</html>