<html>
<head>

<?php
session_start();
include("../db.php");
if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
}
else
{
	$AdmName=$_POST['AdmName'];
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}
?>
</head>
<script>
function reload(str)
{
var url="../sessionbranchfile.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

</script>
<body>
<form Name="form2"  method="Post" action="stud_govtfreecourse.php">
<center><table class='forumline'  align='center' width="70%">
<tr><td Class="head" align='center' colspan=2 >Admission Type Wise Report</td></tr>
<?php
$rs1 = execute("SELECT * FROM admission");
$row1 = rowcount($rs1);
if($row1 == 0)
{
	echo("<div class='label'>No Admission Details.</div>");
}
?>
<tr>
<td >&nbsp;&nbsp;Admission Type:</td>
<td>&nbsp;&nbsp;&nbsp;<select name="AdmName">
<OPTION selected value=-1>Select Admission Type </option>
<?php
for($i=0;$i<$row1;$i++)
{
	$r1 = fetcharray($rs1,$i);
	if($AdmName==$r1[id])
	{
		?>
		<option value="<?=$r1["id"]?>" selected><?=$r1["name"]?></option>
		<?php
	}
	else
	{
		?>
		<option value="<?=$r1["id"]?>"><?=$r1["name"]?></option>
		<?php
	}
}
?>
</select></td></tr><br>
<tr>

		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td>&nbsp;&nbsp;&nbsp;<select name="branch" onChange="reload(this.value)">
			<option value="0">---------------Select---------------</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=mysql_fetch_array($rs);

						if($branch==$r[course_id])
						{
							?>
							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
							<?php
						}
						else
						{
							?>
							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
							<?php
						}
					}
				?>
			</select>
			</td>
            </tr>
            <tr>
			<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
		<td><div id="txtHint9" class="inline">&nbsp;&nbsp;
        <select name="sem">
			<option value='0'>----------Select---------</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
				}
			?>
			</select></div>

		</td>
</tr></table><br>

<div align='center'><input class=bgbutton type="submit" name="b1" value="Submit"></div>

</form>
</body>
</html>