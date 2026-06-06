<?php

session_start();

require("../db.php");



$vechilename = $_POST['vechilename'];

$regstnno = $_POST['regstnno'];

$yearofmfg= $_POST['yearofmfg'];

$regdet=  $_POST['regdet'];

$transtype = $_POST['transtype'];

$leasedetails =$_POST['leasedetails'];

$asd = $_POST['asd'];

$def = $_POST['def'];
$puc_certificate = $_POST['puc_certificate'];
$reader_id = $_POST['reader_id'];
$gps = $_POST['gps'];
$driver_id = $_POST['driver_id'];


$adate = $_POST['adate'];

$bdate = $_POST['bdate'];

$date3 = $_POST['date3'];

$date4 = $_POST['date4'];

$Types = $_POST['Types'];

?>

<html>

<head>

<script language="javascript" src="cal2.js"></script>

<script language="javascript" src="cal_conf2.js"></script>

<script language="javascript">

function reload()

 {

 	document.frm.flag.value=1;

	document.frm.action="add_vechile_master.php";

	document.frm.submit();

 }

 

 

function redirect()

 {

 	

	document.frm.action="vech_mod.php";

	document.frm.submit();

 }

 



</script>



</head>

<?php

$sysdate=date("d/m/Y");

print "<input type=hidden name=sysdate value='$sysdate'><input type=hidden name=flag1 value='0'>";

$adate=$sysdate;

$bdate=$sysdate;

$date3=$sysdate;

$date4=$sysdate;

?>

<body>





<!-- <form Name="frm" action="addvechile.php?Types=Add" method="Post"> -->

<form Name="frm" action="addvechile.php?Types=Add" method="Post">

<Table class='forumline' align=center width="45%">

<tr><td Class="head" colspan=7 align='center'> Add vehicle Details</td></tr>

<tr><td  colspan=2 align='left'>&nbsp;&nbsp;New vehicle name</td><td class="CBody" colspan=4>

<input type="text" size=20 name="vechilename">

</td></tr>

<tr><td  colspan=2 align='left'>&nbsp;&nbsp;Registration No</td><td class="CBody" colspan=4>

<input type="text" size=20 name="regstnno">

</td></tr>

<tr><td  align='left' colspan=2 >&nbsp;&nbsp;Year Of MFG</td><td class="CBody" colspan=4>

<input type="text" size=20 name="yearofmfg">

</td></tr>

<tr><td  align='left' colspan=2>&nbsp;&nbsp;Registration Details</td><td class="CBody" colspan=4>

<input type="text" size=20 name="regdet">

</td></tr>

<tr><td colspan=2>&nbsp;&nbsp;Trans Type</td><td width="218" colspan=4>

        <select name="transtype">

        <?php

        if($StudGender=='O')

        {

        	$sel1="selected";

        	$sel2="";

        }

        else

        {

        $sel2="selected";

        	$sel1="";



        }

        ?>

          <option value="O" <?=$sel1?>>Owner</Option>

          <option value="L" <?=$sel2?>>Lease</option>

        </select>

      </td></tr>

<tr>

	<td  colspan=2>&nbsp;&nbsp;Lease Details</td>

	<td class="CBody" colspan=4>

	<input type="text" size=20 name="leasedetails"></td></tr>

<tr>

	<td  colspan=2>&nbsp;&nbsp;Passng Capacity(Sch)</td>

	<td class="CBody" colspan=4>

	<input type="text" size=20 name="asd">

	</td> </tr>

<tr>

	<td  colspan=2>&nbsp;&nbsp;Passng Capacity(Col)</td>

	<td class="CBody" colspan=4>

	<input type="text" size=20 name="def">

	</td></tr>

 <tr>

	<td  colspan=2>&nbsp;&nbsp;PUC Certificate</td>

	<td class="CBody" colspan=4>

	<textarea rows="3" cols="17" align="right" name='puc_certificate'></textarea> 

	</td></tr>

<tr>

	<td  colspan=2>&nbsp;&nbsp;Fittness certificate Date</td>

	<td><input type="text" readonly name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;

	 <a href="javascript:showCal('Calendar1')"><img src="calendar.jpg" align="absmiddle" ></a></td></tr>

<tr>

	<td  colspan=2>&nbsp;&nbsp;Insurance Date</td>

	<td><input type="text" readonly name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;

	 <a href="javascript:showCal('Calendar2')"><img src="calendar.jpg" align="absmiddle" ></a></td></tr>

<tr>

<td colspan=2>&nbsp;&nbsp;Road Tax Date</td>

<td><input type="text" readonly name="date3" value="<?php echo $date3?>">&nbsp;&nbsp;

 <a href="javascript:showCal('Calendar3')"><img src="calendar.jpg" align="absmiddle" ></a></td>

</tr>

<tr><td  colspan=2>&nbsp;&nbsp;Permit</td>

<td><input type="text" name="date4" readonly value="<?php echo $date4?>">&nbsp;&nbsp;

 <a href="javascript:showCal('Calendar4')"><img src="calendar.jpg" align="absmiddle" ></a></td>

</tr>
<tr>

	<td  colspan=2>&nbsp;&nbsp;Reader ID</td>

	<td class="CBody" colspan=4>

	<input type="text" size=20 name="reader_id">

	</td></tr>
    <tr>

	<td  colspan=2>&nbsp;&nbsp;GPS</td>

	<td class="CBody" colspan=4>

	<input type="text" size=20 name="gps">

	</td></tr>
    <tr><td colspan=2>&nbsp;&nbsp;Driver Name</td>
    <td><SELECT name="driver_id">

		<OPTION value="">---- Select ----</option>

		<?php

		$rs = execute("SELECT * FROM trans_driver_master order by driver_name");

		$num = rowcount($rs);

		for($i=0;$i<$num;$i++)

		{

			$r = fetcharray($rs);

			if($driver_id==$r[0])

				echo "<option value='$r[0]' selected>$r[1]</option>";

			else

				echo "<option value='$r[0]'>$r[1]</option>";

		}

		?>

		</SELECT>

	</td>
    
    </tr>


</Table>

<br>

<div align='center'>

<input type="Submit" value="ADD"  class="bgbutton" >

&nbsp;

<input type="Submit" value="MODIFY"  class="bgbutton" onClick="redirect()">



</div>



</form>



</body>

</html>