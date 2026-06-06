<?php
session_start();
require("../db.php");


/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$typ = $_POST['typ'];
$ptype = $_POST['ptype'];
$point = $_POST['point'];
$route1 = $_POST['route1'];
$pasng_id = $_POST['pasng_id'];
$staffname = $_POST['staffname'];
$stundetname = $_POST['stundetname'];


//$s1 = $_POST['s1'];
if($stundetname){
	
	$Array=explode(' ',$stundetname);
	$first_name=$Array[0];
	
	$studentID=fetcharray(execute("SELECT `id` FROM `student_m` WHERE `first_name` LIKE '%$first_name%' GROUP BY id"));
	$studentID[]=$studentID[0];
	 
}
if($staffname){
	$Array=explode(' ',$staffname);
	$f_name=$Array[0];

	$staffID=fetcharray(execute("SELECT `id` FROM `staff_det` WHERE `f_name` LIKE '%$f_name%' GROUP BY id"));
	$staffID[]=$staffID[0];
}



?>

<html>

<head>

<script language="javascript">

function reload()

{

	document.forms[0].submit();

}

function OpenWind(k)

{

	var finalVar;

	finalVar=k;

	window.open(finalVar,'Stud','height=700,width=1000,status=no,toolbar=no,scrollbars=yes,menubar=no,location=no');

}



</script>

</head>

<body>

<?php

function weekname($mon)

{

	if($mon == 1) return("Mon");

	if($mon == 2) return("Tue");

	if($mon == 3) return("Wed");

	if($mon == 4) return("Thu");

	if($mon == 5) return("Fri");

	if($mon == 6) return("Sat");

}

$s1="";

$s2="";

if($typ==1)

	$s1="selected";

elseif($typ==2)

	$s2="selected";

?>	

<form name='frm1' method='post'>

<table width='80%' border="1" class='forumline' align='center'  cellspacing="5">

<tr><td colspan='2' class='head' align="center">Rosters Details</td></tr>



<tr>
    <td align='LEFT' width="30%">&nbsp;&nbsp;User Type</td>
    
    <td><select name='typ' ONCHANGE='reload()'>
    
    <option value=''>-- All --</option>

    <option value='1' <?=$s1?>>Student</option>
    
    <option value='2' <?=$s2?>>Staff</option>
    
    </select></td>
</tr>

<tr>

<td align='LEFT' width="30%">&nbsp;&nbsp;Bus Route</td>

<td><select name='route1' ONCHANGE='reload()'>

<option value='0'>Select Route</option>

<?php

$qry="select * from route_master order by route_code";

$rs = execute($qry);

if(rowcount($rs)>0)

{

	while($row=fetcharray($rs))

	{

		if($route1==$row[id])

		{

			echo "<option value='$row[id]' selected>$row[route_code] $row[route_name]</option>";

			$route_name = $row[route_name];

		}

		else

		{

			echo "<option value='$row[id]'>$row[route_code] $row[route_name]</option>";

		}

	}

}

?>

</select></td>

</tr>

<?php

if($point=='0')

	$ss="selected";

?>

<tr>

<td align='LEFT' width="30%">&nbsp;&nbsp;Pick Up Point</td>

<td><select name='point' ONCHANGE='reload()'>

<option value='-1'>-- Select --</option>

<?php

echo "<option value='0' $ss>All</option>";



$qry1="select * from trans_point_details a,trans_point_master b where a.point_id=b.id and a.route_id=$route1";

$rs1 = execute($qry1);

if(rowcount($rs1)>0)
{

	while($row1=fetcharray($rs1))
	{

		if($point==$row1[id])
		{
			echo "<option value='$row1[id]' selected>$row1[point_name]</option>";
		}
		else
		{
			echo "<option value='$row1[id]'>$row1[point_name]</option>";
		}

	}

}

?>

</select></td></tr>

</table><div align="center">OR</div>

<table width='80%' border="1" class='forumline' align='center' cellspacing="5">

<tr>

<td align='LEFT' width="30%">&nbsp;&nbsp;Student Name</td>

<td><input type="text" name="stundetname" value="">&nbsp;&nbsp;<input type="submit" name="studentsearch" value="Search" class="bgbutton"></td>

<tr>

<tr>

<td align='LEFT' width="30%">&nbsp;&nbsp;Staff Name</td>

<td><input type="text" name="staffname" value="">&nbsp;&nbsp;<input type="submit" name="staffsearch" value="Search" class="bgbutton"></td>

<tr>

</table><br>

<?php

if($route1>0 && $point!='-1')
{
		
	if($typ=='0' or $typ=='')

		$var=" select a.id,a.p_type,a.pasng_id,a.source_pt,b.point_name from trans_pasng_route_master a,trans_point_master b where a.route_id='$route1'";

	else

		$var=" select a.id,a.p_type,a.pasng_id,a.source_pt,b.point_name from trans_pasng_route_master a,trans_point_master b where a.route_id='$route1' and a.p_type='$typ'";

	if($point!='0')
	{
		$var.=" and a.source_pt='$point'";
	}
	$var.=" and a.source_pt=b.id and a.sts=1";
	
	if(!$typ)
		$var.=" order by a.p_type desc, a.source_pt";
	else
		$var.=" order by a.pasng_id desc, a.source_pt";

		//echo $var;

	$res = execute($var);

	$num = rowcount($res);

	if($num>0)
	{	
		if($typ=='')
			$gn="Staff/Student";
		else
			$gn=ucfirst($typ);

		?>

		<table border='1' class='forumline' align='center' width='80%' cellspacing=2 cellpadding=2>

		<tr>

		  <td align='center' class='head' colspan='7'><?=$gn?><?php echo $route_name ?> Rosters Details</td>

		</tr>

		<tr height='25'>

		<td Class="rowpic" align='center' nowrap width=''>Sl No</td>

		<td Class="rowpic" align='center' width='' nowrap>ID</td>

		<td Class="rowpic" align='center' width='' nowrap>Name</td>

		<td Class="rowpic" align='center' width='' nowrap>Desg/Grade</td>

		<td Class="rowpic" align='center' width='' nowrap>Type</td>

		<td Class="rowpic" align='center' width='' nowrap>Pick Up Point</td>

		

    <?php

	echo "<td Class='rowpic' align='center' width='5%'>Action</td></tr>";

 		$sno=1;

		for($t=1;$t<=$num;$t++)

		{

			$row_t = fetcharray($res);

			//if($row_t[p_type]=="staff")

			if($row_t[p_type]=="2")

			{

				
				$qry1 = "select slno as s_id, f_name as f_names, s_name as s_snames from staff_det where id='$row_t[pasng_id]'";

				$type="Staff";

			}

			else

			{

				$qry1 = "select student_id as s_id ,usn, first_name as f_names , last_name as s_snames from student_m where id='$row_t[pasng_id]'";

				$type="Student";

			}

			//echo $qry1."<br>"; 

			$abc = execute($qry1);

			$r = fetcharray($abc);	

			if($r[usn]!="")

				$t_id=$r[usn];

			else

				$t_id=$r[s_id];

			if($sno<10)

				$sno="0".$sno;

			if($sno%2)

			echo "<tr > ";

			else

			echo "<tr class='clsname'> ";

			

			echo "<td align='center'>$sno</td>";

			echo "<td>&nbsp;&nbsp;&nbsp;$t_id</td>";

			echo "<td>&nbsp;&nbsp;&nbsp;$r[f_names] $r[s_snames]</td>";

			echo "<td align='center'></td>";

			echo "<td align='center'>$type</td>";

			echo "<td>&nbsp;&nbsp;&nbsp;$row_t[point_name]</td>";

			?>

			<td nowrap>

            <A HREF="javascript:OpenWind('test1.php?pasng_id=<?php echo $row_t[id]?>');">Rosters</A>

      </td>

			<?php

			echo "</tr>";

			$sno++;

		}
		
		

	}
	
	else
			die("<center>No Record Found ...!!!</center>");
	
	

}
if(($typ=='' and $route1==0 and $point==-1) and ($studentID || ($staffID)))
{
	
	?>
   <table border='1' class='forumline' align='center' width='80%' cellspacing=2 cellpadding=2>
	 <tr>
		  <td align='center' class='head' colspan='7'><?=$gn?><?php echo $route_name ?> Rosters Details</td>
		</tr>
		<tr height='25'>
            <td Class="rowpic" align='center' nowrap width=''>Sl No</td>
    
            <td Class="rowpic" align='center' width='' nowrap>ID</td>
    
            <td Class="rowpic" align='center' width='' nowrap>Name</td>
    
            <td Class="rowpic" align='center' width='' nowrap>Desg/Grade</td>
    
            <td Class="rowpic" align='center' width='' nowrap>Type</td>
    
            <td Class="rowpic" align='center' width='' nowrap>Pick Up Point</td>
            
            <td Class='rowpic' align='center' width='5%'>Action</td></tr>
    <?
	
	$sno=1;
if(is_array($studentID))
{
	for($i=0;$i<sizeof($studentID);++$i)
	{
			
		$p_type=1;
		//echo "<br>Type :".$p_type;
	
	$det=fetcharray(execute("SELECT a.id,a.p_type,a.source_pt,b.point_name FROM trans_pasng_route_master a,trans_point_master b WHERE a.pasng_id='$studentID[$i]'"));
	
	$studDet=fetcharray(execute("SELECT `first_name`,`last_name`,`student_id` FROM `student_m` WHERE id='$studentID[$i]'"));
	
	$rootDet=fetcharray(execute("SELECT b.point_name FROM trans_point_details a,trans_point_master b,trans_pasng_route_master c WHERE a.point_id=b.id AND a.route_id=c.route_id AND pasng_id='$studentID[$i]'"));
	
	
			if($sno<10)
				$sno="0".$sno;

			if($sno%2)
				echo "<tr> ";
			else
				echo "<tr class='clsname'> ";

			

			echo "<td align='center'>$sno</td>";

			echo "<td align='center'>$studDet[student_id]</td>";

			echo "<td>&nbsp;&nbsp;&nbsp;$studDet[first_name] $studDet[last_name]</td>";

			echo "<td align='center'></td>";

			echo "<td align='center'>Student</td>";

			echo "<td>&nbsp;&nbsp;&nbsp;$rootDet[point_name]</td>";

			?>

			<td nowrap>

            <A HREF="javascript:OpenWind('test1.php?pasng_id=<?php echo $row_t[id]?>');">Rosters</A>

      </td>

			<?php

			echo "</tr>";

			$sno++;
			
	}
}
elseif(is_array($staffID))
{			
	for($i=0;$i<sizeof($staffID);++$i)
	{
			
		$p_type=2;
		
		//echo "<br>Type :".$p_type;
	
	$det=fetcharray(execute("SELECT a.id,a.p_type,a.source_pt,b.point_name FROM trans_pasng_route_master a,trans_point_master b WHERE a.pasng_id='$staffID[$i]'"));
	
	
	$staffDet=fetcharray(execute("SELECT `f_name`,`s_name`,`slno` FROM `staff_det` WHERE id='$staffID[$i]'"));
	
	
	$rootDet=fetcharray(execute("SELECT b.point_name FROM trans_point_details a,trans_point_master b,trans_pasng_route_master c WHERE a.point_id=b.id AND a.route_id=c.route_id AND pasng_id='$staffID[$i]'"));
	
	
	
			if($sno<10)

				$sno="0".$sno;

			if($sno%2)
				echo "<tr> ";
			else
				echo "<tr class='clsname'> ";
			

			echo "<td align='center'>$sno</td>";

			echo "<td align='center'>$staffDet[slno]</td>";

			echo "<td>&nbsp;&nbsp;&nbsp;$staffDet[f_name] $staffDet[s_name]</td>";

			echo "<td align='center'></td>";

			echo "<td align='center'>Staff</td>";

			echo "<td>&nbsp;&nbsp;&nbsp;$rootDet[point_name]</td>";

			?>

			<td nowrap>

            <A HREF="javascript:OpenWind('test1.php?pasng_id=<?php echo $row_t[id]?>');">Rosters</A>

      </td>

			<?php

			echo "</tr>";

			$sno++;
	

		
	}
}

}

?>
</tr>
</table>
<input type='hidden' name='ptype' value='<?php echo $row_t[p_type]?>'>
</form>

</body>

</html>

