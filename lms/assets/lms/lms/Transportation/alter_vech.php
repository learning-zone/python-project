<?php
session_start();
include("../db.php");

if($_GET)

{

	$val = $_REQUEST['val'];

	$id = $_REQUEST['id'];

}

if($_POST)

{

	$vechilename = $_POST['vechilename'];
	$reader_id = $_POST['reader_id'];
	$gps = $_POST['gps'];
	$driver_id = $_POST['driver_id'];

	$regstnno = $_POST['regstnno'];

	$yearofmfg= $_POST['yearofmfg'];

	$regdet=  $_POST['regdet'];

	$transtype = $_POST['transtype'];

	$leasedetails =$_POST['leasedetails'];

	$asd = $_POST['asd'];

	$def = $_POST['def'];

	$adate = $_POST['adate'];

	$bdate = $_POST['bdate'];

	$date3 = $_POST['date3'];

	$date4 = $_POST['date4'];

	$Types = $_POST['Types'];

	$id = $_POST['id'];

}

?>

<html>

<head>

<script language="javascript">

function resend()

 { 	

	document.frm.action="vech_mod.php";

	document.frm.submit();

 }



function resend1()

 { 	

	document.frm.action="add_vechile_master.php";

	document.frm.submit();

 }

 </script>

<?php

$Sql="Select * from trans_vechile_master where id='$id'";

$res=execute($Sql);

$Count_Row=rowcount($res);

if ($Count_Row>0) 

{

	$i=0;

	$r=1;

	if($row=fetcharray($res))

	{

		$adate=$row[fittness_date];

		$bdate2=$row[insurance_date];

		$date33=$row[road_tax_date];

		$date44=$row[permit];

		?>

		<script language="javascript" src="cal2.js"></script>

		<script language="javascript" src="cal_conf2.js"></script></head>

		<body>
		<form name='frm' action='mod_vech.php?Types=MOD' method="post">

		<input type='hidden' name='id' value='<?php echo $id; ?>'>

    		<Table class='forumline' align=center width="40%">

		<tr><td Class="head" colspan=7 align='center'>MODIFY VECHILES DETAILS</td></tr>

		<tr><td  colspan=2 align='left'>&nbsp;&nbsp;New vehicle name</td><td class="CBody" colspan=4>

		<input type="text" size=20 name="vechilename" value="<?php echo $row[1]; ?>">

		</td></tr>

		<tr><td  colspan=2 align='left'>&nbsp;&nbsp;Registration No</td><td class="CBody" colspan=4>

		<input type="text" size=20 name="regstnno" value="<?php echo $row[2];?>">

		</td></tr>

		<tr><td  align='left' colspan=2 >&nbsp;&nbsp;Year Of MFG</td><td class="CBody" colspan=4>

		<input type="text" size=20 name="yearofmfg" value="<?php echo $row[3];?>">

		</td></tr>

		<tr><td  align='left' colspan=2>&nbsp;&nbsp;Registration Details</td><td class="CBody" colspan=4>

		<input type="text" size=20 name="regdet" value="<?php echo $row[4];?>">

		</td></tr>

		<tr><td  colspan=2>&nbsp;&nbsp;Trans Type</td><td width="150" colspan=4>

				<select name="transtype" value="">

				<?php

				if($StudGender!=='O')

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

			<input type="text" size=20 name="leasedetails" value="<?php echo $row[6];?>"></td></tr>

		<tr>

			<td colspan=2>&nbsp;&nbsp;Passng Capacity(Sch)</td>

			<td class="CBody" colspan=4>

			<input type="text" size=20 name="asd" value="<?php echo $row[7];?>">

			</td> </tr>

		<tr>

			<td  colspan=2>&nbsp;&nbsp;Passng Capacity(Col)</td>

			<td class="CBody" colspan=4>

			<input type="text" size=20 name="def" value="<?php echo $row[8];?>">

			</td></tr>
 <tr>

	<td  colspan=2>&nbsp;&nbsp;PUC Certificate</td>

	<td class="CBody" colspan=4>

	<textarea rows="3" cols="20" align="right" name='puc_certificate'><?=$row[16]?></textarea> 

	</td></tr>


		<tr>

			<td colspan=2>&nbsp;&nbsp;Fittness certificate Date</td>

			<td>

			<input type="text" readonly name="adate" value="<?php echo $adate;?>">&nbsp;&nbsp;

			 <a href="javascript:showCal('Calendar1')"><img src="calendar.jpg" align="absmiddle" ></a></td></tr>

		<tr>

			<td  colspan=2>&nbsp;&nbsp;Insurance Date</td>

			<td><input type="text" readonly name="bdate" value="<?php echo $bdate2;?>">&nbsp;&nbsp;

			 <a href="javascript:showCal('Calendar2')"><img src="calendar.jpg" align="absmiddle" ></a></td></tr>

		<tr>

		<td  colspan=2>&nbsp;&nbsp;Road Tax Date</td>

		<td><input type="text" readonly name="date3" value="<?php echo $date33;?>">&nbsp;&nbsp;

		 <a href="javascript:showCal('Calendar3')"><img src="calendar.jpg" align="absmiddle" ></a></td>

		</tr>

		<tr><td  colspan=2>&nbsp;&nbsp;Permit</td>

		<td><input type="text" name="date4" readonly value="<?php echo $date44;?>">&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar4')"><img src="calendar.jpg" align="absmiddle" ></a></td>

        </tr>
        <tr>

	<td  colspan=2>&nbsp;&nbsp;Reader ID</td>

	<td class="CBody" colspan=4>

	<input type="text" size=20 name="reader_id" value="<?php echo $row[13];?>">

	</td></tr>
    <tr>

	<td  colspan=2>&nbsp;&nbsp;GPS</td>

	<td class="CBody" colspan=4>

	<input type="text" size=20 name="gps" value="<?php echo $row[14];?>">

	</td></tr>
<tr>
<?php
$sql2=execute("select driver_id from trans_vechile_master where id='$id'");
	 	while($r2=fetcharray($sql2))
		{
			$driver_id=$r2['driver_id'];
	 	}
?>
<td colspan=2>&nbsp;&nbsp;Driver Name</td>
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

        <input type="Submit" value="Add New"  class="bgbutton" onClick="resend1()" >  
        &nbsp;     
		<input type="Submit" value="Modify"  class="bgbutton" >
        &nbsp;
        <input type="Submit" value="Back"  class="bgbutton" onClick="resend()" >
        </div>
		</form>
		<?php
	}
}

?>
</body>
</html>

