<?php

	session_start();

	require("../db.php");



	$adate = $_POST['adate'];
	
	$reqgivenby = $_POST['reqgivenby'];
	
	$det = $_POST['det'];
	
	$pickup = $_POST['pickup'];
	
	$departure = $_POST['departure'];
	
	$vechile = $_POST['vechile'];
	
	$driver = $_POST['driver'];
	
	$helper = $_POST['helper'];
	
	$date1 = $_POST['date1'];
	
	$add = $_POST['add'];

	

?>

<html>

<head>

<script language="javascript" src="cal2.js"></script>

<script language="javascript" src="cal_conf2.js"></script>

</head>

<body>



<?php

	if(isset($add))

		{

			//echo "inside";

			//$date1=$adate;

			$date1 = date("Y-m-d", strtotime($adate));

			if($vechile=='-1' || empty($reqgivenby) || empty($det) || empty($departure) || empty($driver) || empty($helper))

				{

					//echo "<font color=red><b>Please Fill Blank Fields</b></font>";

					?>

        					<SCRIPT LANGUAGE ="JavaScript">

            				alert("Please Fill Blank Fields");

        					</script>

        					<?php

				}

			else

				{

					$sql4= "insert into trans_special_trip_entry values(null,'$reqgivenby','$det','$pickup','$departure','$vechile','$driver','$helper','$date1')";

					//echo $sql4;

					execute($sql4)or die(mysql_error());

					if($sql4)

						{

							//echo "RECORD ENTERED SUCCESFULLY";

							?>

        					<SCRIPT LANGUAGE ="JavaScript">

            				alert("RECORD ENTERED SUCCESFULLY");

        					</script>

        					<?php

						}

				}

		}

?>

<form name="frm"  action="specialtripentry.php" method="post">

<div align=center>



<Table class='forumline' align=center width = '40%'>

<tr><td Class="head" align=center colspan=4>Special Trip Entry Form</td></tr>

<tr><td >vehicle Name</td>



<td><select name="vechile">

<option value="-1">Select Vehicle</option>

<?php

$sql="select * from trans_vechile_master ";

$rs=execute($sql);

for($i=0;$i<rowcount($rs);$i++)

{

	$r=fetcharray($rs,$i);

	if($r["id"]==$vechile)

		{

			echo "<option value=$r[id] selected> $r[vechile_mod_no]</option>";

		}

	else

		{

			echo "<option value=$r[id] > $r[vechile_mod_no]</option>";

		}

}

?>



</select></tr>

<tr><td >Date</td>



<!--

	<td><input type=text name=fday size=2 maxlength=2><input type=text name=fmonth size=2 maxlength=2><input type=text name=fyear size=4 maxlength=4></td></tr>

    -->

    <td class="CBody"  ><input type="text" readonly size=15 name="adate" value="<?php echo $adate?>">

	 <a href="javascript:showCal('Calendar1')"><img src="calendar.jpg"></a></td>

    <tr><td >Requistion given by</td>

	<td><input type=text name="reqgivenby" ></td></tr>

<tr><td >Trip Details</td>

	<td><textarea name="det" cols=18></textarea></td></tr>

<tr><td >Pick up time</td>

	<td><input type=text name="pickup"></td></tr>

<tr><td >Departure Time</td>

	<td><input type=text name="departure"></td>

<tr><td >Name of the driver</td>

	<td><input type=text name="driver"></td></tr>

<tr><td >Name of the cleaner</td>

	<td><input type=text name="helper"></td></tr>

<br>

<tr><td colspan='2' align=center><input class='bgbutton' type=submit name="add" value='Add Trip Details' ></td></tr>

</table>

</div>

</form>

</body>

</html>