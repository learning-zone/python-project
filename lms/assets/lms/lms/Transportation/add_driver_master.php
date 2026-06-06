<?php

session_start();

require("../db.php");



$Types = $_POST['Types'];



$drivername = $_POST['drivername'];

$perdet = $_POST['perdet'];

$djday = $_POST['djday'];

$djmnth = $_POST['djmnth'];

$djyear = $_POST['djyear'];

$add = $_POST['add'];

$years = $_POST['years'];

$licdet = $_POST['licdet'];

$redet = $_POST['redet'];

$adate = $_POST['adate'];

$bdate = $_POST['bdate'];



$mid = $_POST['mid'];

$DName = $_POST['DName'];

$dpdet = $_POST['dpdet'];

$jday = $_POST['jday'];

$jmnth = $_POST['jmnth'];

$jyear = $_POST['jyear'];

$add = $_POST['add'];

$exp = $_POST['exp'];

$ldet = $_POST['ldet'];

$redet = $_POST['redet'];

$date31 = $_POST['date31'];



?>

<html>

<head>

<script language="javascript" src="cal2.js"></script>

<script language="javascript" src="cal_conf2.js"></script>

<script language="javascript">

function EditClick(loop)

{

	document.form1.action="alterdrivermaster.php?Types=Mod";

	document.form1.submit();

}



function DeleteClick()

{

	document.form1.action="alterdrivermaster.php?Types=Del";

	document.form1.submit();

}

function validate()

{	

	if(document.frm.drivername.value=="" || document.frm.perdet.value=="" || document.frm.add.value=="" || document.frm.years.value=="" || document.frm.licdet.value=="" || document.frm.redet.value=="")

	{

	alert("Please Fill Blank Fields");

	return false;

	}

}

</script>

</head>

<body>
<form name="frm" action="adddriver.php" method="post" onSubmit="return validate()">

<br>

<Table class='forumline' align=center width="90%">

<tr><td Class="head" colspan='10' align="center"> Add Driver Details</font></td></tr>

<tr><td class="rowpic" align="center">Driver Name</td>

<td class="rowpic"  align="center">Phone-Number</td>

<td class="rowpic"  align="center">Date Of Join</td>

<td class="rowpic"  align="center">Address</td>

<td class="rowpic"  align="center">Experience(in years)</td>

<td class="rowpic"  align="center">Licence Details</td>

<td class="rowpic"  align="center">Renewal Details</td><td rowspan='2'></td></tr>

<td class="CBody"  align="center"><input type="text" size=20 name="drivername"></td>

<td class="CBody"  align="center"><input type="text" size=20 name="perdet"></td>

<td class="CBody"  align="center" nowrap><input type="text" readonly size=15 name="adate" value="<?php echo $adate?>">

	 <a href="javascript:showCal('Calendar1')"><img src="calendar.jpg"></a></td>

<td class="CBody"  align="center"><input type="text" size=25 name="add"></td>

<td class="CBody"  align="center"><input type="text" size=10 name="years"></td>

<td class="CBody"  align="center"><input type="text" size=27 name="licdet"></td>

<td class="CBody"  align="center"><input type="text" size=18 name="redet"></td>

</tr>

</table>

<br>

<div align="center">

<input type="Submit" value="ADD" class='bgbutton'>

</div>
</form>
<?php

$sql = "SELECT * FROM trans_driver_master ";

$rs = execute($sql);

$num = rowcount($rs);

if($num==0)
{
	echo "<div align='center'>NO DATA FOUND</div>";
}

if($num){

?>

<form method="post" id="form1" name="form1">

<Table class='forumline' align=center width="90%">

<tr><td Class="head" align="center" colspan='10'> Driver Details </td></tr>

<tr><td Class="row3" colspan='10' align='center'><font > Modify Driver Details</font></td></tr>

<tr><td class="rowpic">Select</td><td class="rowpic"><b>Driver Name</b></td><td class="rowpic"><b>Personal Details</b></td><td class="rowpic"><b>Date Of Join</b></td><td class="rowpic"><b>Address </b></td><td class="rowpic"><b>Experience(in years)</b></td><td class="rowpic"><b>Licence Details</b></td><td class="rowpic"><b>Renewal Details</b></td></tr>

<?php

	for($i=0;$i<$num;$i++)

	{

		if($i%2)

		echo " <tr > ";

		else

		echo "<tr class='clsname'> ";

		$r = fetcharray($rs,$i);

?>

  <td class="CBody" align="center"><input type="checkbox" name="mid[]" Value="<?=$r["id"]?>">

  </td><td class="CBody" align="center"><input type="text" size=20 name="DName[<?=$r[id]?>]" value="<?=$r[driver_name]?>">

  </td>

   <td class="CBody" align="center"><input type="text" size=20 name="dpdet[<?=$r[id]?>]" value="<?=$r[personal_details]?>">

   </td>

   <?php

   $dj=explode("-",$r[date_of_join]);

   //$date31 = $r[date_of_join]

   ?>
   <td class="CBody"  align="center" nowrap><input type="text" readonly size=15 name="bdate" value="<?php echo $r["date_of_join"]?>">

	 <a href="javascript:showCal('Calendar2')"><img src="calendar.jpg"></a></td>

   <td class="CBody" align="center">

   <input type="text" size=25 name="add[<?=$r[id]?>]" value="<?=$r[address]?>">

   </td>

   <td class="CBody" align="center">

   <input type="text" size=10 name="exp[<?=$r[id]?>]" value="<?=$r[experiance_yrs]?>">

   </td>

   <td class="CBody" align="center">

   <input type="text" size=27 name="ldet[<?=$r[id]?>]" value="<?=$r[licence_det]?>">

   </td>

    <td class="CBody" align="center">

    <input type="text" size=18 name="redet[<?=$r[id]?>]" value="<?=$r[reneval_det]?>">

    </td>

   </tr>

<?php

}

?>

</table>
<br>
<div align="center">
<input Type="Button" Value="Modify" class='bgbutton' onClick="EditClick(<?=$num?>)">
</div>
  <br><br>
  </form>
<?php

}

?>
</body>
</html>

