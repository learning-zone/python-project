<?php

	$d=getdate();



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

	session_start();

	require("../db.php");

$type = $_POST['type'];

$routename = $_POST['routename'];

$s1 = $_POST['s1'];



if($_POST['Coradmit'])

{

	

	$courseyr = $_POST['courseyr'];

	$Coradmit = $_POST['Coradmit'];

}

else

{

	$Coradmit=$_SESSION['branch'];

	$courseyr=$_SESSION['sem'];

}



?>

<html>

<head>

<script language="javascript">

function reload()

{

	document.frmp.action='passengermaster.php';

	document.frmp.submit();

}

</script>

</head>

<body >

<?php

$s1="";

$s2="";

if($type==1)

	$s1="selected";

elseif($type==2)

	$s2="selected";

echo "<form action=FetchStudDetails.php method=post name='frmp'>";

echo "<Table class='forumline' align=center width='90%'><tr><td Class='head' align=center colspan=4>Apply Students to Route</td></tr>";

echo "<tr><td>&nbsp;&nbsp;Passenger Type</td>";

echo "<td><select name=type onChange='reload()'>";

echo "<option value=''>-- select --</option>";

echo "<option value='1' $s1>Student</option>";

echo "<option value='2' $s2>Staff</option>";

echo "</select></td>";



echo "<td>&nbsp;&nbsp;Select Route</td>";

echo "<td><select name='routename' onChange=\"reload()\">";

echo "<option value=''>-- Select --</option>";

$qry="select * from trans_route_master order by id";

$rs = execute($qry);

while($row=fetcharray($rs))

{

	if($routename==$row[id])

	{

		echo "<option value='$row[id]' selected>$row[route_code] - $row[route_name]</option>";

	}

	else

	{

		echo "<option value='$row[id]'>$row[route_code] - $row[route_name]</option>";

	}

}

echo "</select></td></tr>";

if($type!='' && $routename!='')

{

	if($type==1)

	{

		?>

		<tr><td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

		<td><SELECT name="Coradmit"  onChange='reload()'>

		<OPTION value="">---- Select ----</option>

		<?php

		$rs = execute("SELECT course_id,coursename FROM course_m order by course_id");

		$num = rowcount($rs);

		for($i=0;$i<$num;$i++)

		{

			$r = fetcharray($rs);

			if($Coradmit==$r[0])

				echo "<option value='$r[0]' selected>$r[1]</option>";

			else

				echo "<option value='$r[0]'>$r[1]</option>";

		}

		?>

		</SELECT></td>

		<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>

		<td>

        <SELECT name="courseyr">

		<OPTION selected value="">Select</option>

		<?php

		$r = execute("SELECT * FROM course_year where head_id='$Coradmit' ");

		$num = rowcount($r);

		for($i=0;$i<$num;$i++)

		{

		$rsy = fetcharray($r);

		?>

		<option  value="<?=$rsy[0]?>"><?=$rsy[1]?></OPtion>

		<?php

		}

		echo "</SELECT></td></tr>";

		?>

		<tr height='30'>

	<td>&nbsp;&nbsp;Student Name</td>

		<td colspan="3" id="auto">

        <input type="text" name="searchField" id="searchField"  ></td></tr>

        

        <?php

	}

	echo "</table><br>";

	echo "<div align=center><input class='bgbutton' type='submit' name='studmoddel' value=Submit>";

	echo "</div>";

}

?>

</body>

</html>