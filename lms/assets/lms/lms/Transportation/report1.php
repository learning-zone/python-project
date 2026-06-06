<html>

<head>

<script language="Javascript">

function prn()

{

	pr1.style.display="none";	

	print(this.form);

}

</script>

</head>

<?php

	session_start();

	require("../db.php");

	$routename = $_POST['routename'];

	$pasng_id = $_REQUEST['pasng_id'];

$typ = $_REQUEST['typ'];

?>

<body>

<form name='frm' method='post' action='report1.php'>

<input type='hidden' name='typ' value='<?php echo $typ?>'>

<?php

$id=1;

$route = execute("select route_name from trans_route_master where id='$routename'");

$route_r = fetcharray($route);



if($typ=="student")

{

	echo "<Table class='forumline' align='center' width='90%' border='1'>";

	echo "<tr>";

	echo "<td class='head' colspan='6' align='center'>Route : $route_r[route_name]</td>";

	echo "</tr>";

	$sql="select a.*,b.*,c.*,d.* from student_m a,trans_route_master b,trans_point_master c,trans_pasng_route_master d";

	$sql.=" where a.id=d.pasng_id and b.id=d.route_id and d.source_pt=c.id and b.id='$routename' and d.sts=0";



	$rs=execute($sql);

	if(rowcount($rs)==0)

	{

		echo "Student Data Not Found";

		//die();

	}

	?>

	<center>

	<tr>

		<td class="rowpic" align='center'>Id</td>

		<td class="rowpic" align='center'>Student Id</td>

		<td class="rowpic" align='center'>Student Name</td>

		<td class="rowpic" align='center'>PickUp Point</td></tr>

	<?php

	for($i=0;$i<rowcount($rs);$i++)

	{

		if($i%2)

		echo "<tr> ";

		else

		echo "<tr class='clsname'> ";

		$r=fetcharray($rs);

		$rou=execute("select route_name from trans_route_master where id=$routename");

		$sr=fetcharray($rou);



		$rou1=execute("select point_name from trans_point_master where id=$r[source_pt]");

		$sr1=fetcharray($rou1);


		echo "<td align='center'>$id</td>";

		echo "<td>&nbsp;&nbsp;$r[student_id]</td>";

		echo "<td>&nbsp;&nbsp;$r[first_name] $r[last_name]</td>";

		echo "<td>&nbsp;&nbsp;$sr1[0]</td>";

		echo "</tr>";

		$id++;

	}

 }

elseif($typ=="staff")

{

	$sql="select a.*,b.*,c.*,d.* from staff_det a,trans_route_master b,trans_point_master c,trans_pasng_route_master d";

	$sql.=" where a.id=d.pasng_id and b.id=d.route_id and d.source_pt=c.id and b.id=$routename and d.sts=0";



	$rs=execute($sql);

	$rowclass=1;

	if(rowcount($rs)==0)

	{

		echo "Staff Data Not Found";

		die();

	}

	?>

	<center>

	<table  class='forumline' align='center' width='90%' border="1">

	<tr>

		<td class='head' colspan='9' align='center'>Route : <?php echo $route_r[route_name]?></td>

	</tr>

	<tr>

		<td Class="rowpic" align='center'>Id</td>

		<td class="rowpic" align='center'>Staff Id</td>

		<td class="rowpic" align='center'>Staff Name</td>

		<td class="rowpic" align='center'>PickUp Point</td>

	</tr>

	<?php

	$id=1;

	for($i=0;$i<rowcount($rs);$i++)

	{

		if($i%2)

		echo "<tr> ";

		else

		echo "<tr class='clsname'> ";

		$r=fetcharray($rs);

		$rou=execute("select route_name from trans_route_master where id=$routename");

		$sr=fetcharray($rou);



		$rou1=execute("select point_name from trans_point_master where id=$r[source_pt]");

		$sr1=fetcharray($rou1);

		



		/* echo "<tr class='row<?php echo $rowclass ?>'>"; */

		echo "<td align='center'>$id</td>";

		echo "<td>&nbsp;&nbsp;$r[slno]</td>";

		echo "<td>&nbsp;&nbsp;$r[f_name] $r[s_name]</td>";

		echo "<td>&nbsp;&nbsp;$sr1[0]</td>";

		echo "</tr>";

		$id++;

	}

}

elseif($typ!="staff" && $typ!="student")

{

	if($routename!='')

	{

		$rtbn="select * from trans_pasng_route_master where route_id=$routename and sts=0";

	}

	else

	{

		$rtbn="select * from trans_pasng_route_master where sts=0";

	}

	$rs=execute($rtbn);

if(rowcount($rs)==0)

{

	echo "Staff Data Not Found";

	die();

}

?>

<center>

<table border=1 class='forumline' align='center' width='90%' cellpadding=2 cellspacing=2>

<tr>

		<td class='head' colspan='9' align='center'> Staff And Students Details of Route : <?php echo $route_r[route_name]?></td>

	</tr>

<tr>

	<td Class="rowpic" align='center'>Sl no</td>

	<td class="rowpic" align='center'>Passenger Id</td>

	<td class="rowpic" align='center'>Passenger Name</td>

	<td class="rowpic" align='center'>PickUp Point</td>

	<td class="rowpic" align='center'>Passenger Type</td></tr>

<?php

for($i=0;$i<rowcount($rs);$i++)

{

	if($i%2)

	echo "<tr> ";

	else

	echo "<tr class='clsname'> ";

	$r=fetcharray($rs);



	$rou1=execute("select point_name from trans_point_master where id=$r[source_pt]");

	$sr1=fetcharray($rou1);

	

	if($r[p_type]=='staff')

	{

		$wcbn=fetcharray(execute("Select slno as s_id,f_name as f_names from staff_det where id='$r[pasng_id]'"));

	}

	else

	{

		$wcbn=fetcharray(execute("Select student_id as s_id,first_name as f_names,usn from student_m where id='$r[pasng_id]'"));

	}

	if($wcbn[usn]!="")

	{

		$p_id=$wcbn[usn];

	}

	else

	{

		$p_id=$wcbn[s_id];

	}

	/* echo "<tr class='row<?php echo $rowclass ?>'>"; */

	echo "<td align='center'>$id</td>";

	echo "<td>&nbsp;&nbsp;$p_id</td>";

	echo "<td>&nbsp;&nbsp;$wcbn[1]</td>";

	//echo "<td>$sr[0]</td>";

	echo "<td>&nbsp;&nbsp;$sr1[0]</td>";

	echo "<td>&nbsp;&nbsp;$r[p_type]</td>";

	echo "</tr>";

	$id++;

}

}

?>

</table><br><br>

</center>

<div id='pr1' align='center'><INPUT TYPE="button" NAME="print" class='bgbutton' VALUE="PRINT THE REPORT" OnClick="prn()"></div>

</html>

