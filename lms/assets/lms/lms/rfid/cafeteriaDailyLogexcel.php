<?php

$file_type = "vnd.ms-excel";

$file_name= "DailyReportforCafeteria_".$_POST['adate'].".xls";

header("Content-Type: application/$file_type");

header("Content-Disposition: attachment; filename=$file_name");

session_start();

include("../db.php");

$today = date('Y-m-d');

$thisyear = date('Y');

$thismonth = date('m');

$thisday = date('d');

$adate=$_POST['adate'];

$sysdate=date("Y-m-d");

if($adate!='')

{

	$d = explode('/', $adate);

	$sysdate="$d[2]-$d[1]-$d[0]";

}

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MySchool</title>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>

<script language="javascript" src="../js/cal2.js"></script>

<script language="javascript" src="../js/cal_conf2.js"></script>

<script language="javascript" type="text/javascript"></script>

<script language='javascript'>

	function RefreshMe(val)

	{

		document.frm.action="master_lesson_plan.php";

		document.frm.submit();

	}

</script>

</head>

<body>

<form method="post" name="frm" action="">

<?php 

if($adate=="")
{
	$adate=date("d/m/Y");
 }

?><table cellspacing="3" cellpadding="0" border="1" align="center" width="100%">
  <tr>
    <td align="center" >Sl No</td>

    <td align="center" >Code</td>

    <td align="center" >Name</td>

    <td align="center" >Category</td>

    

    <td align="center" >Meal Type</td>

 	<td align="center" >Break Fast</td>

    <td align="center" >Time</td>

    

    <td align="center" >Meal Type</td>

 	<td align="center" >Lunch</td>

    <td align="center" >Time</td>

    

    <td align="center" >Meal Type</td>

 	<td align="center" >Snack/Tea</td>

    <td align="center" >Time</td>



    <td align="center" >Meal Type</td>

 	<td align="center" >Dinner</td>

    <td align="center" >Time</td>

   </tr>

  <?php

  $i=1;

  $sql=execute("SELECT b.user, a.rfidno, b.user_type FROM rfid_cafeteria_check a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$sysdate'  and b.status=1 group by b.rfid order by b.user_type, a.readerno");

  while($r=fetcharray($sql))

  {

	  $staffif=trim($r[1]);

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

		<td>&nbsp;<?=$i?></td>

		<td><?=$stfname[2]?></td>

		<td><?=$stfname[0]?> <?=$stfname[1]?></td>

		

		<td><?=$cat?></td>

<?php

 $intime=fetchrow(execute("SELECT att_time, readerno FROM `rfid_cafeteria_check` where `rfidno`='$r[1]' and `att_date`='$sysdate' and (att_time>'07:00:00' and att_time<'10:30:00')  ORDER BY `id` limit 1"));

if($intime[1]==3)

$CommonMenu='Veg';

else

$CommonMenu='Common Menu';

?>

        <td align="center"  nowrap="nowrap"><?=$CommonMenu?></td>

        <td align="center"  nowrap="nowrap">--</td>

        <td align="center"  nowrap="nowrap"><?=$intime[0]?></td>

<?php

 $intime=fetchrow(execute("SELECT `att_time`, readerno FROM `rfid_cafeteria_check` where `rfidno`='$r[1]' and `att_date`='$sysdate' and (att_time>'11:30:00' and att_time<'14:30:00')  ORDER BY `id` limit 1"));

?>        

        <td align="center"  nowrap="nowrap"><?=$CommonMenu?></td>

        <td align="center"  nowrap="nowrap">--</td>





        <td align="center"  nowrap="nowrap"><?=$intime[0]?></td>

<?php

 $intime=fetchrow(execute("SELECT `att_time`, readerno FROM `rfid_cafeteria_check` where `rfidno`='$r[1]' and `att_date`='$sysdate' and (att_time>'15:00:00' and att_time<'17:00:00')  ORDER BY `id` limit 1"));

?>          

        <td align="center"  nowrap="nowrap"><?=$CommonMenu?></td>

        <td align="center"  nowrap="nowrap">--</td>

      <td align="center"  nowrap="nowrap"><?=$intime[0]?></td>

<?php

 $intime=fetchrow(execute("SELECT `att_time`, readerno FROM `rfid_cafeteria_check` where `rfidno`='$r[1]' and `att_date`='$sysdate' and (att_time>'19:00:00' and att_time<'22:30:00')  ORDER BY `id` limit 1"));



?>        

        <td align="center"  nowrap="nowrap"><?=$CommonMenu?></td>

        <td align="center"  nowrap="nowrap">--</td>

        <td align="center"  nowrap="nowrap"><?=$intime[0]?></td>

	  </tr>

	<?php

		$i++;

	}

}

?>

</table>

</form>

</body>

</html>