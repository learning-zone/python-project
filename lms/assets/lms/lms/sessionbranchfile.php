<?php
session_start();
include("db1.php");
$q=$_GET["q"];
$branch=$q;
?>
<script LANGUAGE="JavaScript">
function reloadAjax(str)
{

var url="../sessionsectionfile.php";

url=url+"?r="+str;

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

    document.getElementById("txtHint10").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET",url,true);

xmlhttp.send();

}

</script>
<?
 echo "	<select name='sem' onChange=reloadAjax(this.value)><option value='select'>---Select---</option>";
		$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
  echo "</select>";
?>
