<?php

	session_start();
	require("../db.php");

  if($_POST)
  {
	  $routename = $_POST['routename'];
	  $type = $_POST['type'];
  }

  if($_REQUEST)
  {
	  $routename = $_POST['routename'];
	  $type = $_POST['type'];
  }

	$d=getdate();

?>
<html>
<head>
<script language="javascript">

function reload()

{

	document.frmp.action='bus_card.php';

	document.frmp.submit();

}

</script>

</head>

<body >

<?php

echo "<form action=$PHP_SELF method=post name='frmp'>";

echo "<Table class='forumline' align=center width='50%'><tr><td Class='head' align=center colspan=8>Student Route Details</td></tr>";

echo "<tr>";

echo "<td align='center' nowrap>Select</td>";

echo "<td COLSPAN='6'>";

echo "<select name='routename' onChange=\"reload()\">";

echo "<option value=''>---- Select ----</option>";

$qry="select * from trans_route_master order by id";

$rs = execute($qry);

while($row=fetcharray($rs))

{

	if($routename==$row[id])

	{

		echo "<option value='$row[id]' selected>$row[route_name]</option>";

	}

	else

	{

		echo "<option value='$row[id]'>$row[route_name]</option>";

	}

}

echo "</select></td></tr>";

	

    echo "<tr>";

		echo "<td align='center'>Select type</td>";

		echo "<td COLSPAN=6>";

		echo "<select name='type' onChange='reload()'>";

		echo "<option value='0'>select</option>";

		$qry="select * from type where type!='staff' order by type";

		$rs = execute($qry);

		if($rs)

		{

			if(rowcount($rs)>0)

			{

				while($row=fetcharray($rs))

				{

					if($type==$row[type])

					{

						echo "<option value='$row[type]' selected>$row[type]</option>";

					}

					else

					{

						echo "<option value='$row[type]'>$row[type]</option>";

					}

				}



			}



		}

		echo "</select></td></tr>"; 

		if($type=="student")

		{

		echo "<tr>";

		echo "<td align='left' colspan=1 nowrap>Feescheme</td>";

		echo "<td align='left' colspan=4 nowrap>";

		?>

		   <select name='validity' onChange='reload()'>

			<option value='0' <?php if($validity==0) echo " selected"?>>Select </option>

			<option value='1' <?php if($validity==1) echo " selected"?>> Odd Sem </option>

			<option value='2' <?php if($validity==2) echo " selected"?>> Even Sem </option>

			<option value='3' <?php if($validity==3) echo " selected"?>> 1 Year </option>



		 </select></td></tr>

		<?php 

		

		 

		echo "<tr><td align='left' colspan=1 nowrap>Validity</td>";

		echo "<td align='left' colspan=4 nowrap>";

		echo "<select name='FMon' onChange='reload()'>";

			echo "<option value='0'>MM</option>";

			if($validity==1){

			$jan = '';

			$feb = '';

			if($FMon==1){

				$jan = 'selected';

			}else if($FMon==2){

				$feb = 'selected';

			}

				echo "<option value='1' $jan >Jan</option>";

				echo "<option value='2' $feb >Feb</option>";

				

			} else if($validity==2){

			$jun = '';

			$july ='';

			if($FMon==6){

				$jun = 'selected';

			}else if($FMon==7){

				$july = 'selected';

			}

				echo "<option value='6' $jun>Jun</option>";

				echo "<option value='7' $july>July</option>";

			}else{

			for($i=1;$i<=12;$i++)

			{

				if($i == $FMon)

					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";

				else

					echo "<option value='$i'>" . MonthName($i) . "</option>\n";

			}

			}

			echo "</select>";

			echo " / ";

			$maxYr = $d["year"]+2;

			$d=$d["year"];

			echo "<select name='FYear' onChange='reload()'>";

			echo "<option value='0'>YYYY</option>";

			for($i=$d;$i<=$maxYr;$i++)

			{

				if($i == $FYear)

					echo "<option value='$i' selected>$i</option>\n";

				else

					echo "<option value='$i' >$i</option>\n";

			}?>

			</select></td></tr>

	<?php

		echo "</form>";

		}

	$collage_db=$collagename;

if($type=="student")

{

		?>

		<form method=post action="fetchstuddetails1.php" name="studret" >

		<input type="hidden" name="collage_db" value="<?=$collage_db?>">

		<input type="hidden" name="routename" value="<?=$routename?>">

		<input type="hidden" name="stype" value="<?=$type?>">

		<input type="hidden" name="tripname" value="<?=$tripname?>">

		<input type="hidden" name="FMon" value="<?=$FMon?>">

		<input type="hidden" name="FYear" value="<?=$FYear?>">

		

		</center>

		<tr>

		<tr><td>USN:</td>

		<td ><input type='text' name='student_id' value=""></td>

		

		<td>Branch:</td>

		<td align=left><SELECT name="Coradmit">

		<OPTION selected value="0">--------------ALL COURSE---------------</option>

		<?php

		$rs = execute("SELECT course_id,coursename FROM course_m ");

		$num = rowcount($rs);

		for($i=0;$i<$num;$i++)

		{

			$r = fetcharray($rs);

			?>

			<option value="<?=$r[0]?>"><?=$r[1]?></option>

			<?php

		}

		?>

		</SELECT>

		</td></tr>

		<tr>

		<td>Academic Year</td>

		<TD>

		<SELECT name="acayr">

		<Option Value="0">Select</Option>

		<?php

		$ar = getdate(time());

		for($i=2008;$i<=$ar["year"];$i++)

		{

		?>

		<OPTION  value="<?=$i . "/" . $i+1 ?>"><?= $i . "/" . $i+1 ?></option>

		<?php

		}

		?>

		</SELECT>

		</TD>

		<td>Semester:</td>

		<td><SELECT name="courseyr">

		<OPTION selected value="0">Select</option>

		<?php

		$r = execute("SELECT * FROM course_year  order by year_id");

		$num = rowcount($r);

		for($i=0;$i<$num;$i++)

		{

		$rsy = fetcharray($r,$i);

		?>

		<option  value="<?=$rsy[0]?>"><?=$rsy[1]?></OPtion>

		<?php

		}

		?>

		</SELECT>

		</td></tr>

		<tr><td>Student First Name:</td>

		<td COLSPAN=6><input type='text' name='studFName' value=""></td>

		

		</tr>

	

		

			<center>

       <tr>

	   <td align='center' colspan=6>

		<input class='bgbutton' type="submit" name="studmoddel" value="Search">

		</td>

	   </tr>

	    </center>



	  

      <input type="hidden" name="display" value="<?=$display?>">

	  <input type="hidden" name="stype" value="<?=$type?>">

	  <input type="hidden" name="collage_db" value="<?=$collage_db?>">

	  <input type="hidden" name="routename" value="<?=$routename?>">

	  <input type="hidden" name="tripname" value="<?=$tripname?>">

     </form>

   <?php

}

function MonthName($mon)

{

	if($mon == 1) return("Jan");

	if($mon == 2) return("Feb");

	if($mon == 3) return("Mar");

	if($mon == 4) return("Apr");

	if($mon == 5) return("May");

	if($mon == 6) return("Jun");

	if($mon == 7) return("July");

	if($mon == 8) return("Aug");

	if($mon == 9) return("Sep");

	if($mon == 10) return("Oct");

	if($mon == 11) return("Nov");

	if($mon == 12) return("Dec");

}

?>

</body>

</html>