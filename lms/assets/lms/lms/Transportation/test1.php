<?php

	session_start();

	include("../db.php");

	$user=$_SESSION['user'];

	$a_year=$_SESSION['AcademicYear'];

	$pasng_id = $_REQUEST['pasng_id'];

	



if($_POST)

{	

	$typ = $_POST['typ'];

	$route1 = $_POST['route1'];

	$point = $_POST['point'];

	$ptype = $_POST['ptype'];

	$routename = $_POST['routename'];

	$sel=$_POST['sel'];

	$pickuppoint = $_POST['pickuppoint'];

	$FMon = $_POST['FMon'];

	$FYear = $_POST['FYear'];

	$mod = $_POST['mod'];

	$del = $_POST['del'];

	$today = date('Y-m-d');

}



if($_POS['del'])

{

		$sql = "update trans_pasng_route_master set sts=1 where id='$pasng_id'";

		execute($sql);

		execute("update trans_transport_rosters set status=1 where user_id='$pasng_id' and user_type='$typ' and accyear='$a_year'");

		?>

        <SCRIPT LANGUAGE ="JavaScript">

			alert("Deleted Sucessfully!");
	
			window.opener.location.href='viewpasngr.php';
	
			window.close();

        </script>

        <?php

}

elseif($_POST['mod'])

{

	$pickup=$_POST['pickup'.$i];

	$drop_time=$_POST['drop_time'];

	for($i=0;$i<7;$i++)

	{	

		

		$sql1=fetchrow(execute("select id from trans_transport_rosters where user_id='$pasng_id' and user_type='$typ' and accyear='$a_year' and day='$i' and status=1"));

		if($sql1[0])

		{

			$sql1="update trans_transport_rosters set route='$routename', pickup_point='$pickuppoint', pickup='$pickup[$i]', `drop`='$drop_time[$i]' where id='$sql1[0]'";

		}

		else

		{

			$sql1="INSERT INTO `trans_transport_rosters` (`user_id`, `user_type`,`accyear`, `route`, `pickup_point`, `date_entered`, `day`, `pickup`, `drop`, `user`) VALUES ('$pasng_id', '$typ', '$a_year', '$routename', '$pickuppoint', '$today', '$i', '$pickup[$i]', '$drop_time[$i]', '$user')";

		}

		execute($sql1);

		

	}

	$sql = "update trans_pasng_route_master set route_id='$routename', source_pt='$pickuppoint', val_mon='$FMon',val_yr='$FYear' where id='$pasng_id' and accyear='$a_year'";

	execute($sql);

	?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Update successfully ");

        </script>

        <?php

}



?>

<HTML>

<HEAD>

<title>Rosters</title>

<script language="javascript">

function reload()

{

	document.frm.action="test1.php";

	document.frm.submit();

}

</script>

 </HEAD>

 <BODY>

 <form name='frm' method='post'>

 <input type='hidden' name='pasng_id' value='<?=$pasng_id?>'>

 <?php

//echo $pasng_id;

//echo $typ;



$res = execute("select * from trans_pasng_route_master where id='$pasng_id'");



$row = fetcharray($res);

$typ=$row['p_type'];

?>

 <input type='hidden' name='typ' value='<?=$row[p_type]?>'>

<?php

if($row[p_type]=='1')

{



	$res1 = execute("select id,usn,first_name,last_name,img_source,student_id from student_m where id='$row[pasng_id]'");



	$row1 = fetcharray($res1);







	$res2 = execute("select id,route_name from trans_route_master order by route_name");



	if($routename=="")



		$routename=$row[route_id];

	$res3 = execute("select a.id,a.point_name from point_master a,point_details b where a.id=b.point_id and b.route_id='$routename'");



	?>



	<TABLE ALIGN='center' CLASS="forumline" width='80%' CELLPADDING="0" CELLSPACING="0" BORDER="0">



 <TBODY>



  <TR height='30'>



   <TD ALIGN="CENTER" CLASS="head" COLSPAN><B>Student Rosters</B>



   </TD>



  </TR><tr><td>



  <table class='forumline' align='center' width='100%' border='0'>



	<tr>



		<td width="25%">



			<table  border='0' align='left' width='100%'  height="100%"> 



			<tr>



				<td align="center">Student Photo</td>



				</tr>



					<tr height="70">



						<td align='center'>



							<img src="<?=$row1[img_source]?>"  height='120'>



					    </td>



					</tr>



			</table>



		 </td>



		 <td>



		 <table border="0" cellspacing='4' cellpadding='0' width='100%'>



	<tr height='30'>



	<?php



		if($row1[usn]=='')



		{



		?>



			<td nowrap>Student Id&nbsp;&nbsp;</td>



			<td><?=$row1[student_id]?></td>



		<?php



		}



		else



		{



			?>



			<td nowrap>USN&nbsp;&nbsp;</td>



			<td><?=$row1[usn]?></td>



			<?php



		}



		?>



	</tr>



	<tr height='30'>



		<td nowrap>Student Name&nbsp;&nbsp;</td>



		<td colspan="3"><?php echo $row1[first_name]." ".$row1[last_name] ?></td>



	</tr>



	<tr height='30'>



		<td nowrap>Route&nbsp;&nbsp;</td>



		<td colspan="3"><select name='routename' onchange='reload()'>



			<?php



				while($row2 = fetcharray($res2))



				{



					if($routename==$row2[id])



					{



						?>



						<option value='<?php echo $row2[id] ?>' selected><?php echo $row2[route_name] ?></option>



						<?php



					}



					else



					{



						?>



						<option value='<?php echo $row2[id] ?>'><?php echo $row2[route_name] ?></option>



						<?php



					}



				}



			?>







			</select>



		</td>



	</tr>



	<tr height='30'>



	   <td nowrap>Pick Up Point&nbsp;&nbsp;</td>



       <td colspan="3"><select name='pickuppoint'>



		    <option value='0'>-- Select --</option>



			<?php



			   while($row3 = fetcharray($res3))



			   {



				   if($row[source_pt]==$row3[id])



				   {



		              ?>



					  <option value='<?php echo $row3[id] ?>' selected><?php echo $row3[point_name] ?></option>



						<?php



					}



					else



					{



						?>



						<option value='<?php echo $row3[id] ?>'><?php echo $row3[point_name] ?></option>



						<?php



					}



				}



			?>







			</select>



		</td>



	</tr>



	<?php 	



	$FMon=$row[val_mon];



	$FYear=$row[val_yr];



	?>



	<tr><td nowrap>Valid Till&nbsp;&nbsp;</td><td colspan="3">



	<select name='FMon'>



	<option value='0'>Month</option>



		<?php	



			for($i=1;$i<=12;$i++)



			{



				if($i == $FMon)



					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";



				else



					echo "<option value='$i'>" . MonthName($i) . "</option>\n";



			}



			echo "</select>";



			echo " / ";



			$FYear=date("Y");



			$maxYr = $FYear+2;



			$d=$FYear-2;



			echo "<select name='FYear'>";



			echo "<option value='0'>YEAR</option>";



			for($i=$d;$i<=$maxYr;$i++)



			{



				if($i == $FYear)



					echo "<option value='$i' selected>$i</option>\n";



				else



					echo "<option value='$i' >$i</option>\n";



			}



			?>



			</select></td></tr>



	</table></td></tr></table>



    </table>



    



	</TR>



	



	<?php



}



else



{



	$res4 = execute("select id,slno,f_name,s_name,img_col from staff_det where id='$row[pasng_id]'") or die(mysql_error());



	$row4 = fetcharray($res4);







	$res2 = execute("select id,route_name from trans_route_master order by route_name");



	if($routename=="")



		$routename=$row[route_id];



	$res3 = execute("select a.id,a.point_name from point_master a,point_details b where a.id=b.point_id and b.route_id='$routename'");



?>



<TABLE ALIGN='center' CLASS="forumline" width='80%' CELLPADDING="0" CELLSPACING="0" BORDER="0">



 <TBODY>



  <TR height='30'>



   <TD ALIGN="CENTER" CLASS="head" COLSPAN><B>Staff Rosters</B>



   </TD>



  </TR><tr><td>



  <table class='forumline' align='center' width='100%' border='0'>



	<tr>



		<td width="25%">



			<table  border='0' align='left' width='100%'  height="100%"> 



			<tr>



				<td align="center">Staff Photo</td></tr>



					<tr height="70">



						<td align='center'>



							<img src="<?=$row4[img_col]?>" height='120'>



					    </td>



					</tr>



			</table>



		 </td>



		 <td>



		 <table border="0" width="100%" cellspacing='4' cellpadding='0' >



	<tr height='30'>



	<td nowrap>Staff ID&nbsp;&nbsp;</td>



			<td><?php echo $row4[slno] ?></td>



	</tr>



	<tr height='30'>



		<td nowrap>Staff Name&nbsp;&nbsp;</td>



		<td><?php echo $row4[f_name]." ".$row4[s_name] ?></td>



	</tr>



	<tr height='30'>



		<td nowrap>Route&nbsp;&nbsp;</td>



		<td><select name='routename' onchange='reload()'>



			<?php



				while($row2 = fetcharray($res2))
				{

					if($routename==$row2[id])
					{



						?>



						<option value='<?php echo $row2[id] ?>' selected><?php echo $row2[route_name] ?></option>



						<?php



					}



					else



					{



						?>



						<option value='<?php echo $row2[id] ?>'><?php echo $row2[route_name] ?></option>



						<?php



					}



				}



			?>







			</select>



		</td>



	</tr>



	<tr height='30'>



	   <td nowrap>Pick Up Point&nbsp;&nbsp;</td>



       <td><select name='pickuppoint'>



	   <option value='0'>-- Select --</option>



		    <?php



			   while($row3 = fetcharray($res3))



			   {



				   if($row[source_pt]==$row3[id])



				   {



		              ?>



					  <option value='<?php echo $row3[id] ?>' selected><?php echo $row3[point_name] ?></option>



						<?php



					}



					else



					{



						?>



						<option value='<?php echo $row3[id] ?>'><?php echo $row3[point_name] ?></option>



						<?php



					}



				}



			?>

			</select>

		</td>

	</tr>

	<?php 	



	$FMon=$row[val_mon];



	$FYear=$row[val_yr];



	?>



	<tr><td nowrap>Valid Till&nbsp;&nbsp;</td><td colspan="3">



	<select name='FMon'>



	<option value='0'>Month</option>



		<?php	



			for($i=1;$i<=12;$i++)



			{



				if($i == $FMon)



					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";



				else



					echo "<option value='$i'>" . MonthName($i) . "</option>\n";



			}



			echo "</select>";



			echo " / ";



			$FYear=date("Y");



			$maxYr = $FYear+2;



			$d=$FYear-2;



			echo "<select name='FYear'>";



			echo "<option value='0'>YEAR</option>";



			for($i=$d;$i<=$maxYr;$i++)



			{



				if($i == $FYear)



					echo "<option value='$i' selected>$i</option>\n";



				else



					echo "<option value='$i' >$i</option>\n";



			}



			?>



			</select></td></tr>



	</table></td></tr></table>



    </table>



    



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



function weekname($mon)



{



	if($mon == 1) return("Monday");



	if($mon == 2) return("Tuesday");



	if($mon == 3) return("Wednesday");



	if($mon == 4) return("Thursday");



	if($mon == 5) return("Friday");



	if($mon == 6) return("Saturday ");



}



?>



<TABLE ALIGN='center' CLASS="forumline" width='80%' CELLPADDING="0" CELLSPACING="0" BORDER="0">



<tr>



<td align='center' width="25%" class="head">Day</td>



<td align="center" width="25%" class="head">Pick Up</td>



<td align="center" width="50%" class="head">Drop</td>



</tr>



<?php



for($i=1;$i<7;$i++)



{



	echo "<tr>



	<td align='center' >";



	echo weekname($i);



	echo "</td>



	<td align='center' >";

	$sql1=fetchrow(execute("select pickup from trans_transport_rosters where user_id='$pasng_id' and user_type='$typ' and accyear='$a_year' and day='$i' and status=1 "));

		

	//echo "weekDay :".$i;

		if($sql1[0])

		$check='checked';

		else

		$check='';

		

	

	//echo "<input type='checkbox' name='pickup".$i."' value='1'></td>";

	?>

	<input type='checkbox' name="pickup[<?=$i?>]" value="1" <?=$check?>></td>

    <?

		echo "<td align='center'  nowrap>";

	 	$rs2=execute("select * from drop_time");

	 	while($r2=fetchrow($rs2))

	 	{	 		

			$sql1=fetchrow(execute("select id from trans_transport_rosters where user_id='$pasng_id' and user_type='$typ' and accyear='$a_year' and day='$i' and status=1 and `drop`='$r2[0]' "));

				  if($sql1[0])

				  {

				  	$check2='checked';

				  }

				  else

				  {

				  	$check2='';

				  }

  ?>&nbsp;&nbsp;





                <input type="radio" name="drop_time[<?=$i?>]" value="<?=$r2[0]?>" <?=$check2?>>



	 			<?=$r2[1]?>



				<?php

	 		 	}

	echo "</td>
	</tr>";		
}
?>
</TABLE>
<br>
	<div ALIGN="CENTER">&nbsp;
	  <INPUT TYPE="submit" VALUE="UPDATE" NAME="mod" CLASS="bgbutton">
    &nbsp;
    <INPUT TYPE="submit" VALUE="DELETE" NAME="del" CLASS="bgbutton"></TD>
	</div>
</form>
</BODY>
</HTML>