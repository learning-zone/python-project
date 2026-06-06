<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
<html xmlns="http://www.w3.org/1999/xhtml"><head>
</head>
<script type="text/javascript">
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getuser.php?q="+str,true);
xmlhttp.send();
}
</script>

<!--content-->
 
<link href="../../../mistStyle.css" rel="stylesheet" type="text/css" />

    <table border="1" align='center' width='90%' >
  <tr>
    <td class="head" colspan="4" align="center">Modify Lesson Master</td>
    </tr>
     <tr>
    <td class="rowpic" align="center">Sl No.</td>
    <td class="rowpic" align="center">Title</td>
    <td class="rowpic" align="center">Modify</td>
    <td class="rowpic" align="center">Delete</td>
  </tr>


<?php
session_start();
include("../../../db.php");

	$accyeardet=$_SESSION['AcademicYear'];

	$unit=$_REQUEST['unit'];
	$title_id=$_REQUEST['title_id'];
	$subject=$_REQUEST['subject'];
	$id1=$_REQUEST['id'];
	$delete=$_REQUEST['delete'];
	if($delete==1 and $id1>0)
	{
		$delet1="update `lms_lesson_master` set `status`='0' where id='".$id1."'";
		mysql_query($delet1);
		?>
		
	<SCRIPT LANGUAGE ="JavaScript">
			alert("Lesson Master Deleted Successfully");
			</script>	
		
<?php	
	}
	$s=1;
	$Sql=mysql_query("select * from lms_lesson_master where acc_year='$accyeardet' and title_id='$title_id' and sub='$subject'  and unit_id='$unit' and status=1");
while($r=mysql_fetch_array($Sql))	
{
	?>
    <tr>
    <td align="center" width="10%"><?=$s?> </td>
    <td>&nbsp;&nbsp;&nbsp;<?=$r[sub_title]?> </td>
    <td align="center"><a href= "output_html.php?unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>&action=mod&id=<?=$r[id]?>"><input type='button' align='center' class='bgbutton' value='Modify'></a>
    </td>
    <td align="center"><a href= "output_html1.php?unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>&id=<?=$r[id]?>&delete=1"><input type='button' align='center' class='bgbutton' value='Delete'></a>
    </td>
    </tr>
    
    <?php
	$s++;
}
?>
<br>
&nbsp;&nbsp;&nbsp;<a href= "output_html.php?unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>&action=add"><input type='button' align='center' class='bgbutton' value='Add New'></a>
<br>
<br />		
</form>
</body>
</html>
