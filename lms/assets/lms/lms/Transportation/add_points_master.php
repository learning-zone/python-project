<?php

session_start();
require("../db.php");

$pointcode = $_POST['pointcode'];

$pointname = $_POST['pointname'];

$pointdist = $_POST['pointdist'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];



$mid = $_POST['mid'];

$details = $_POST['details'];

$PName = $_POST['PName'];

$Pdist = $_POST['Pdist'];
$Platitude = $_POST['Platitude'];
$Plongitude = $_POST['Plongitude'];



$Types = $_POST['Types'];



?>

<html>

<head>

<script language="javascript">

function EditClick()

{

	document.form1.action="alterpointmaster.php?Types=Mod";

	document.form1.submit();

}

function DeleteClick()

{

	document.form1.action="alterpointmaster.php?Types=Del";

	document.form1.submit();

}

function validate()

{

	if(document.addpoint.pointname.value=="" || document.addpoint.details.value=="")

	{

	alert("Please Fill Blank Fields");

	return false;

	}

}

</script>

</head>

<body>
<form Name="addpoint" action="addpoint.php" method="Post">

<Table class='forumline' align='center'  width='80%'>

<tr><td class="head" colspan='5' align='center'><b><font>Add Pickup Point Details</font> </b></td></tr>

<tr><td align='center' class="rowpic"><b>Pickup Point Name</b></td><td align='center' class="rowpic"><b>Pickup Point Details</b></td>
<td align='center' class="rowpic"><b>Latitude</b></td>
<td align='center' class="rowpic"><b>Longitude</b></td></tr>

<td align='center' class="CBody"><input type="text" size=20 name="pointname"></td>

<td align='center' class="CBody"><input type="text" size=40 name="pointcode"></td>

<td align='center' class="CBody"><input type="text" size=10 name="latitude">
<td align='center' class="CBody"><input type="text" size=10 name="longitude"></td>

</table>

<br>

<div align='center' colspan='3'><input type="Submit" value="ADD" class='bgbutton'></div>



</form>

<?php

//if($msg!="")

	//echo "<div><font color='brown'><b>$msg</b></font></div>";

$sql = "SELECT * FROM trans_point_master order by point_name";

$rs = execute($sql);

$num = rowcount($rs);

if($num==0)

{

	//echo "Pickup Points not declared..";

}

if($num)

	{

	  ?>

	  <form method="post" id="form1" name="form1">

		<Table class='forumline' align='center' width='80%'>

	  <tr><td class="head" colspan='6' align='center'>Modify Pickup Point Details</td></tr>

	  <tr><td class="rowpic" align='center'>Select</td><td class="rowpic" align='center'>Pickup Point Name</td><td class="rowpic" align='center'>Pickup Point Detail</td><td align='center' class="rowpic">Latitude</td>
<td align='center' class="rowpic">Longitude</td></tr>

	  <?php

	  for($i=0;$i<$num;$i++)

		  {

			  if($i%2)

			  	echo " <tr > ";

			  else

			 	 echo "<tr class='clsname'> ";

			  $r = fetcharray($rs,$i);

			?>

			 

				 <td align='center' class="CBody"><input type="checkbox" name="mid[]" Value="<?=$r["id"]?>"></td>

                 

                 <td align='center' class="CBody"><input type="text" size='20' name="PName[<?=$r[id]?>]" value="<?=$r[point_name]?>"></td>

			 <td align='center' class="CBody"><input type="text" size='40' name="details[<?=$r[id]?>]" value="<?=$r[details]?>"></td>

<td align='center' class="CBody"><input type="text" size='10' name="Platitude[<?=$r[id]?>]" value="<?=$r[latitude]?>"></td>

<td align='center' class="CBody"><input type="text" size='10' name="Plongitude[<?=$r[id]?>]" value="<?=$r[longitude]?>"></td>

			 </tr>

			<?php

		  }

		?>

	 </table>

     <br>

		<div align='center'><input class='bgbutton' Type="Button" Value="Modify" onClick="EditClick()">
        <input class='bgbutton' Type="Button" Value="Delete" onClick="DeleteClick()"></div>

  <br><br>

  </form>

<?php

}

?>



</body>

</html>	

