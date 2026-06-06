<?php

session_start();

include("../db.php");



?>

<html>

<head>

<SCRIPT LANGUAGE="JavaScript">

function reload()

{

	document.frm.action='Attendance.php';

	document.frm.submit();

	

}

function reload1()

{

	document.frm.action='Attendance.php?save=1';

	document.frm.submit();

	

}

function reload2()

{

	document.frm.action='Attendance.php?save=2';

	document.frm.submit();

	

}

</script>

</head>

<body font-size="10" class='bodyline'>

<?php

if(!$_POST)

{

	$a_year=$_SESSION['AcademicYear'];

	$branch=$_SESSION['branch'];

}

else

{

	$a_year=$_POST['a_year'];

	$f_day=$_POST['f_day'];

	$f_month=$_POST['f_month'];

	$f_year=$_POST['f_year'];

	$t_day=$_POST['t_day'];

	$t_month=$_POST['t_month'];

	$t_year=$_POST['t_year'];

	$branch=$_POST['branch'];

}

$AcademicYear=$a_year;





if($_GET['save']==2)

{

	$fromdate="$f_year-$f_month-$f_day";

	$todate="$t_year-$t_month-$t_day";

	$sql_id=fetchrow(execute("select id from academic_year where `acc_year`='$a_year' and `class_div`='$branch' and status=1"));

	if($sql_id[0]=='')

	{	

	execute("INSERT INTO `academic_year` (`id`, `acc_year`, `from_date`, `to_date`, `class_div`, `status`) VALUES (NULL, '$a_year', '$fromdate', '$todate', '$branch', '1')");

	}

	else

	{

		execute("UPDATE `academic_year` SET `from_date` = '$fromdate', `to_date` = '$todate' WHERE `academic_year`.`id` = '$sql_id[0]' ");

	}

	?>

    <script language="javascript">

	alert(' Academic Year Updated successfully'); 

    </script>

	<?php

}



if($_GET['save']==1)

{



		$idarray=$_POST['idarray'];

		for($i=0;$i<sizeof($idarray);$i++)

		{

			$classid=$idarray[$i];

			$type=$_POST['ty'.$classid];

			$sql_id=fetchrow(execute("select id from attendance where `acc_year`='$a_year' and `class_id`='$classid' and status=1"));

			if($sql_id[0]=='')

			{

				execute("INSERT INTO `attendance` (`id`, `class_id`, `type`, `acc_year`, `status`) VALUES (NULL, '$classid', '$type', '$AcademicYear', '1')");

			}

			else

			{

				execute("UPDATE `attendance` SET `type` = '$type' where id='$sql_id[0]' ");

			}

		}

	

	

	?>

    <script language="javascript">

	alert('Attendance Setup Updated successfully'); 

    </script>

	<?php

}

?>



<form Name="frm" action="" method="POST">

<?php

if(!$_POST and !$_GET['save']==1 and !$_GET['save']==1)

{

	$sql=execute("select `from_date`, `to_date` from academic_year where `acc_year`='$a_year' and `class_div`='$branch' and status=1");

	while($r=fetcharray($sql))

	{

		

		$frmdate=$r['from_date'];

		$tomdate=$r['to_date'];

		$frmdate1=explode('-',$frmdate);

		$tomdate1=explode('-',$tomdate);

		$f_day=$frmdate1[2];

		$f_month=$frmdate1[1];

		$f_year=$frmdate1[0];

		$t_day=$tomdate1[2];

		$t_month=$tomdate1[1];

		$t_year=$tomdate1[0];

	

	}

}

?>

<br>

<table width="80%" class='forumline' align='center' border="1">

    <tr height="25">

    <td colspan="2" align="center" class="head" nowrap>&nbsp;&nbsp;

    Academic Year 

    </td>

    </tr>

    <tr>

    <td>&nbsp;&nbsp;Academic Year 

    </td>

    <td>

<select title='Select Academic Year' name="a_year" id="a_year" onchange='reload()' <?php echo $selop; ?> >

                <option value='0'>--Academic Year--</option>

                <?php

				   $MyYear=date('Y')-1;

				   $CurrentYr=date("Y")+2;

				   for($i=$MyYear;$i<$CurrentYr;$i++)

					 {

						$Fyear=$i;

						$Tyear=$i+1;

						$Tyear=substr($Tyear,2);

						$sele="";

						if($a_year=='')

						{

							if($i==date('Y'))

							$sele="selected";

						}

						else

						{

							if($i==$a_year)

							$sele="selected";

						}



						?>

					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>

						<?php

					 }

						   ?>

              </select>

              </td>

              </tr>

              	<tr height='30'>

		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

		<td><select name="branch" onChange="reload()">

			<option value="0">----------Select--------</option>

				<?php

					$sql="select course_id,coursename from course_m";

					$rs=execute($sql) or die(error_description());

					for($i=0;$i<rowcount($rs);$i++)

					{

					  $r=fetcharray($rs);



						if($branch==$r[course_id])

						{

							?>

							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>

							<?php

						}

						else

						{

							?>

							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>

							<?php

						}

					}

				?>

			</select>

			</td>

</tr>

              <tr>

              <td>&nbsp;&nbsp;From Date</td>

              <td>

              <select name="f_day" onchange='reload()'>

      <?php

				for($i=1;$i<=31;$i++)

				{

	                if($i<10)

						$i="0".$i;

					$sel='';

					if($f_day==$i)

						$sel='selected'; 

					echo "<option value='$i' $sel >$i</option>";

			    }

				?>

    </select>

    <select name="f_month" onchange='reload()'>

      <?php

				for($i=1;$i<=12;$i++)

				{

					if($i<10)

						$i="0".$i;

					$sel='';

					if($f_month==$i)

						$sel='selected';

					echo "<option value='$i' $sel >$i</option>";

				} 

				?>

    </select>

    <select name="f_year" id="f_year" onchange='reload()'>

      <?php

				$d=date('Y')-1;

				$dd=date('Y')+3;

				for($i=$dd;$i>=$d;$i--)

                    {

	                  $sel='';

	                  if($f_year==$i)

						$sel='selected';

	                  echo "<option value=$i $sel >$i</option>";

                    }

				?>

    </select>

              </td>

              </tr>

              <tr>

              <td>&nbsp;&nbsp;To Date</td>

              <td>

              <select name="t_day" onchange='reload()'>

      <?php

				for($i=1;$i<=31;$i++)

				{

	                if($i<10)

						$i="0".$i;

					$sel='';

					if($t_day==$i)

						$sel='selected'; 

					echo "<option value='$i' $sel >$i</option>";

			    }

				?>

    </select>

    <select name="t_month" onchange='reload()'>

      <?php

				for($i=1;$i<=12;$i++)

				{

					if($i<10)

						$i="0".$i;

					$sel='';

					if($t_month==$i)

						$sel='selected';

					echo "<option value='$i' $sel >$i</option>";

				}

				?>

    </select>

    <select name="t_year" onchange='reload()'>

      <?php

				$d=date('Y')-1;

				$dd=date('Y')+3;

				for($i=$dd;$i>=$d;$i--)

                    {

	                  $sel='';

	                  if($t_year==$i)

						$sel='selected';

	                  echo "<option value=$i $sel >$i</option>";

                    }

				?>

    </select>

              </td>

              </tr>              

              </table>

              <br>

<div align="center">

<input type="button" name="Update" value="Update" onClick="reload2()" class="bgbutton">

</div>

              <br>

<?php

$sql_id=fetchrow(execute("select id from academic_year where `acc_year`='$a_year' and `class_div`='$branch' and status=1"));

if($sql_id[0]!='')

{

$sql =execute("SELECT * FROM course_year where status=1 and head_id='$branch' ORDER BY head_id,year_id");

}

else

die();

?>			  

<table width="80%" class='forumline' align='center' border="1" >

    <tr height="25">

    <td colspan="3" align="center" class="head" width="5%" nowrap>

    Attendance Setup

    </td>

    </tr>

    <tr height="25">

    <td align="center" class="row3" width="5%" nowrap>

    SL No

    </td>

    <td align="center" class="row3" width="30%" nowrap>

    <?php echo $_SESSION['semname']; ?>

    </td>

    <td align="center" class="row3" nowrap>

    Type

    </td>

    </tr>

    <?php

	$i=1;

	while($r=fetcharray($sql))

	{

		?>

        <input type="hidden" name="idarray[]" value="<?=$r[0]?>">

		<tr height="25">

		<td align="center"  nowrap>

		<?php

		echo $i;

		?>

		</td>

		<td align="center"  nowrap>

		<?php

		echo $r[1];

		$year_id=$r['year_id'];

		$check=fetchrow(execute("select type from attendance where class_id='$year_id' and acc_year='$a_year' and status=1 "));

		if($check[0]==3)

		{

			$checked3='checked';

			$checked2='';

			$checked1='';

		}

		elseif($check[0]==2)

		{

			$checked2='checked';

			$checked3='';

			$checked1='';

		}

		else

		{

			$checked1='checked';

			$checked2='';

			$checked3='';

		}

		?>

		</td>

		<td align="center" nowrap >&nbsp;&nbsp;&nbsp;

        <input type="radio" name="ty<?=$r[0]?>" value="1" <?=$checked1?>>

        &nbsp;&nbsp;&nbsp;Day Wise&nbsp;&nbsp;&nbsp;&nbsp;

        <input type="radio" name="ty<?=$r[0]?>" value="2" <?=$checked2?> >        &nbsp;&nbsp;

		Morring & After Noon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		<input type="radio" name="ty<?=$r[0]?>" value="3" <?=$checked3?>  >		&nbsp;&nbsp;&nbsp;

		Period Wise&nbsp;&nbsp;&nbsp;

		

		<?php

		?>

		</td>

		</tr>

		<?php

	$i++;

	}

	?>

</table>

<br>

<div align="center">

<input type="button" name="Update" value="Update" onClick="reload1()" class="bgbutton">

</div>

</form>

</body>

</html>



