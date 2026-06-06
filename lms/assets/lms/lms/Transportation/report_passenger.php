<?php

	session_start();	

	require("../db.php");

	$adate=$_POST['adate'];

	$bus=$_POST['bus'];

	if(!$adate)

	{

		$adate=date("d/m/Y");

		$sysdate=date("Y-m-d");

	}

	else

	{

		$r=explode('/',$adate);

		$sysdate="$r[2]-$r[1]-$r[0]";

	}

?>

<html>

<head>

  <script language="javascript" src="cal2.js"></script>

  <script language="javascript" src="cal_conf2.js"></script>

 <script language="javascript" >

 function reload()

{



	document.frm.action='report_passenger.php';



	document.frm.submit();



	



}

</script>

</head>

<body >

<form  method="post" name="frm" action="">

<table width="80%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="2" align="center" class="head">Detailed Bus Report</td>

  </tr>

   <tr>

		<td nowrap>&nbsp;&nbsp;Date &nbsp;<input type="text" readonly name="adate" value="<?php echo $adate?>" onFocus="reload()" >&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>

        </td>

		<td nowrap>

        &nbsp;&nbsp;Bus &nbsp;<select name='bus'  OnChange='reload()'>

        		<option value=''>-- Select --</option>

				<?php

                $rs=execute("SELECT controllerip FROM  rfid_bus_check where att_date='$sysdate' group by controllerip");

			while($r=fetcharray($rs))

			{

				$disname=fetchrow(execute("select registration_no from trans_vechile_master where vechile_mod_no='$r[controllerip]'"));

				if($bus==$r[controllerip])

				{

					echo "<option value='$r[controllerip]' selected>$disname[0]</option>";

				}

				else

				{

					echo "<option value='$r[controllerip]'>$disname[0]</option>";

				}

			}



                ?>  

		</select>

        

        </td>

		</tr>

</table>

<br><br>

<table align="center" border="1" width="80%">        

    <tr>

    <td align="center" class="head" nowrap="nowrap">Sl No</td>

    <td align="center" class="head" nowrap="nowrap">Code</td>

    <td align="center" class="head" nowrap="nowrap">Name</td>

    <td align="center" class="head" nowrap="nowrap">Home Pick-up</td>

    <td align="center" class="head" nowrap="nowrap">School Drop</td>

    <td align="center" class="head" nowrap="nowrap">School Pick-up</td>

    <td align="center" class="head" nowrap="nowrap">Home Drop</td>

    </tr>

<?php

  $i=1;



$sql=execute("SELECT b.user, a.rfidno, b.user_type FROM  rfid_bus_check a, rfid_enrolment_user b where a.rfidno=b.rfid and a.controllerip='$bus' and  a.att_date='$sysdate'  and b.status=1 group by b.rfid order by b.user_type, a.readerno");

while($r=fetcharray($sql))

{

	  $staffif=trim($r[1]);

	  $stfname[0]='';

	  if($r[2]==1)

	  {

	  	$stfname=fetchrow(execute("select first_name, last_name, student_id, course_yearsem from student_m where id='$r[0]'"));

		$rs_sql=fetchrow(execute("select year_name from course_year where year_id=$stfname[3]"));

		$cat=$rs_sql[0];

	  }

	  if($r[2]==2)

	  {

	  	$stfname=fetchrow(execute("select f_name, s_name, slno,type_id from staff_det where id='$r[0]'"));

		$rs_sql=fetchrow(execute("select * from staff_des where d_id=$stfname[3]"));

		$cat=$rs_sql[0];

	  }

		if($stfname[0])

		{

			?>

			<tr  bgcolor='<?=$bgcolor?>'>

			<td width="5%" align='center'>&nbsp;<?=$i?></td>

			<td width="10%" align="center"><?=$stfname[2]?></td>

			<td width="25%"><?=$stfname[0]?> <?=$stfname[1]?></td>

            

			<?php

			echo "<td align='center'>";

			$sql7=execute("select att_time  from rfid_bus_check where  controllerip='$bus' and att_date='$sysdate' and rfidno='$r[1]' and att_time<'11:50:00' order by att_time limit 1");

			while($r1=fetcharray($sql7))

			{

				echo "$r1[att_time]";

			}

			echo '</td>';

			

			echo "<td align='center'>";

			$sql7=execute("select att_time  from rfid_bus_check where  controllerip='$bus' and att_date='$sysdate' and rfidno='$r[1]' and att_time<'11:50:00' order by att_time limit 1, 1");

			while($r1=fetcharray($sql7))

			{

				echo "$r1[att_time]";

			}

			echo '</td>';

			

					echo "<td align='center'>";

			$sql7=execute("select att_time  from rfid_bus_check where  controllerip='$bus' and att_date='$sysdate' and rfidno='$r[1]' and att_time>'11:50:00' order by att_time limit 1");

			while($r1=fetcharray($sql7))

			{

				echo "$r1[att_time]";

			}

			echo '</td>';

			

			echo "<td align='center'>";

			$sql7=execute("select att_time  from rfid_bus_check where  controllerip='$bus' and att_date='$sysdate' and rfidno='$r[1]' and att_time>'11:50:00' order by att_time limit 1, 1");

			while($r1=fetcharray($sql7))

			{

				echo "$r1[att_time]";

			}

			echo '</td>';

			

			echo "</tr>";

			$i++;

		}

}



  

  ?>  

</table> 

<br>



</form>

</body>

</html>

