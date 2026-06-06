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
	$addr=$_POST['addr'];
	$studfname=$_POST['studfname'];
	$branch=$_POST['branch'];
	$un=$_POST['un'];
	$sem=$_POST['sem'];
}
?>
<html>
<head>
<title>Student details Modify form</title>
</head>
<body>
<script LANGUAGE="JavaScript">
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

<?php
$rs = execute("SELECT * FROM student_m");
$num = rowcount($rs);
if($num > 0)
{
	?>
	<form method='post' action="addressPrint.php" name="frm1" >

    
  <table class='forumline' align='center' width="90%">
    <tr> 
      <td Class="Head" colspan='7' align='center'>Search Student Detials</td>
    </tr>
    <tr> 
      <td>&nbsp;&nbsp;Student First Name</td>
      <td><input type='text' name='studfname' value=""></td>
 		<td><?php echo $_SESSION['branchname']; ?></td>
		<td><select name="branch" onChange="reload(this.value)">
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
      <td>&nbsp;&nbsp;Student ID</td>
      <td><input type='text' name='un' value=""></td>
			<td> <?php echo $_SESSION['semname']; ?></td>
		<td><div id="txtHint9" class="inline">
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
    </tr>
    
    <br>
    <tr> 
      <td >&nbsp;&nbsp;Addressed To</td>
      <td colspan='3'><input type="radio" value="0" checked name="addr">
        &nbsp;&nbsp;Correspondence <input type="radio" name="addr" value="1">
        &nbsp;&nbsp;Permanent 
        <input type="radio" name="addr" value="2">
        &nbsp;&nbsp;Local</td>
    </tr>
  </table>
	<div align=center>
	<td ><input type="submit" class='bgbutton' value="Submit" name="studdet"></td>
	</div>
	<table align=center border=0>
	
	</form>
	<?php
}
else
{
	?>
	<td>No studentid Record</td>
	<?php
}
?>
</body>
</html>