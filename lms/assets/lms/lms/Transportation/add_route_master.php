<?php

session_start();

require("../db.php");



$routecode = $_POST['routecode'];

$routename = $_POST['routename'];

$distance = $_POST['distance'];



$mid = $_POST['mid'];

$RCode= $_POST['RCode'];

$RName= $_POST['RName'];

?>

<html>

<head>

<script language="javascript">

function EditClick()

{

	document.form1.action="alterroutemaster.php?Types=Mod";

	document.form1.submit();

 }



 function DeleteClick()

 {

	document.form1.action="alterroutemaster.php?Types=Del";

	document.form1.submit();

 }

 function validate()

{

	if(document.addroute.routename.value=="")

	{

	alert("Please Fill Route Name Field");

	return false;

	}

}

</script>

</head>

<body>
<form Name="addroute" action="addroute.php" method="Post" onSubmit="return validate()">

<Table class='forumline' align=center width='60%'>

<tr><td class="head" colspan=6 align='center'>Add Route Details </td></tr>

<tr><td align='center' >Route Code</td><td align='center' class="CBody"><input type="text" size=18 name="routecode"></td>

<td align='center'>Route Name</td>

<td align='center'><input type="text" size=18 name="routename"></td>
<td align='center'>Distance</td>

<td align='center'><input type="text" size=18 name="distance"></td></tr>

</table>

<br>

<div align='center'><input type="Submit" class="bgbutton" value="ADD"></div>



</form>

<?php

//if($msg!="")

	//echo "<div><font color='brown'><b>$msg</b></font></div>";

//$sql = "SELECT * FROM trans_route_master order by id";

$sql = "SELECT * FROM trans_route_master order by route_name";



$rs = execute($sql);

$num = rowcount($rs);

//echo $num; 

if($num==0)

{

echo "<div align='center'>NO DATA FOUND </div>";

}



if($num)
{

?>

  <form method="post" id="form1" name="form1">

  <Table class='forumline' align=center width='60%'>

  <tr><td class="head" colspan=8 align='center'>Modify Route Details </td></tr>

  <tr><td width='5%' height="43" align='center' class="rowpic">Select</td><td class="rowpic" align='center'>Route Code</td><td class="rowpic" align='center'>Route Name</td>
  <td align='center' class="rowpic">Distance</td>

<?php

	for($i=0;$i<$num;$i++)

	{

		if($i%2)

		echo "  <tr > ";

		else

		echo "<tr class='clsname'> ";

		$r = fetcharray($rs,$i);

?>

  

  <td align='center'>

  <input type="checkbox" name="mid[]" Value="<?=$r["id"]?>">

  </td>

  <td align='center' class="CBody">

  <input type="text" size=30 name="RCode[<?=$r[id]?>]" value="<?=$r[route_code]?>">

  </td>

  <td align='center' class="CBody">

  <input type="text" size=30 name="RName[<?=$r[id]?>]" value="<?=$r[route_name]?>">

  </td>
  <td align='center' class="CBody">

  <input type="text" size=30 name="RDistance[<?=$r[id]?>]" value="<?=$r[distance]?>">

  </td>

<?php

}

?>

</table><br>

  <div align='center'><input Type="Button" class=bgbutton Value="Modify" onClick="EditClick()"><input class='bgbutton' Type="Button" Value="Delete" onClick="DeleteClick()"></div>

  </form>

<?php

}

?>



</body>

</html>