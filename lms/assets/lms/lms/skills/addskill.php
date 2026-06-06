<html>

<head>

<?php

session_start();

include("../db.php");

if($_REQUEST['course'])

{

	$course=$_REQUEST['course'];

	$sem=$_REQUEST['sem'];

	$examid=$_REQUEST['examid'];

	$studentid=$_REQUEST['studentid'];

	$class_section_id=$_REQUEST['class_section_id'];

	$stundetname=$_REQUEST['stundetname'];

	$student_id=$_REQUEST['student_id'];	

}

else

{

	$course=$_POST['course'];

	$sem=$_POST['sem'];

	$examid=$_POST['examid'];

	$studentid=$_POST['studentid'];

	$class_section_id=$_POST['class_section_id'];

	$stundetname=$_POST['stundetname'];

	$student_id=$_POST['student_id'];

	

}

$accyeardet=$_SESSION['AcademicYear'];





$rs_ec=execute("select * from exam_m where id='$examid'");

while($r1=fetcharray($rs_ec))

{

	$subid=explode(',',$r1['sub_id']);

	$mmks=explode(',',$r1['max_mark']);

	$accyear=$r1['accyear'];

	$exam_count=$r1['exam_count'];

	$examname=$r1['descr'];

}



if(isset($_POST['save']))

{

	$skillid=$_POST['subarr'];

	$sub_id=$_POST['sub_id'];

	for($j=0;$j<sizeof($sub_id);$j++)

	{

		$newid=$sub_id[$j];

		$desc1=$_POST['desc_'.$newid];

		

		$Sql66=execute(" select id from skill_grade_desc where student_id='$studentid' and acc_year='$accyeardet' and sub='$newid' and exam_id='$examid'");

		if(rowcount($Sql66)>0)

		{

			$sql33="update skill_grade_desc set `desc1`='".addslashes($desc1)."' where student_id='$studentid' and acc_year='$accyeardet' and sub='$newid' and exam_id='$examid'";

			execute($sql33);

		}

		else

		{

			execute("INSERT INTO skill_grade_desc (`class`, `sec`, `student_id`, `acc_year`, `desc1`, `exam_id`, `sub`) VALUES ( '$sem', '$class_section_id', '$studentid', '$accyeardet', '$desc1', '$examid', '$newid')");

		}

	}

		

	for($j=0;$j<sizeof($skillid);$j++)

	{

		$idin=$skillid[$j];

		$eval1=$_POST['eval1_'.$idin];

		$eval2=$_POST['eval2_'.$idin];

		

		$Sql6=execute(" select id from skill_grade where student_id='$studentid' and skill='$idin' and acc_year='$accyeardet'");

		if(rowcount($Sql6)>0)

		{

			execute("update skill_grade set eval1='$eval1', eval2='$eval2' where student_id='$studentid' and skill='$idin' and acc_year='$accyeardet'");

		}

		else

		{

			execute("INSERT INTO skill_grade (id, divi, class, sec, student_id, skill, acc_year, eval1, eval2) VALUES (NULL, '$course', '$sem', '$class_section_id', '$studentid', '$idin', '$accyeardet', '$eval1', '$eval2')");

		}

	}

	?>

		<Script language="JavaScript">

		alert("Updated successfully");

		</Script>

		<?php

}

?>



<script language='javascript'>

function valid(emark,mrk,varname)

{

	if(isNaN(emark))

	{

		if(emark!='N')

		{

			alert("Enter Number only  or 'N'");

			document.getElementsByName(varname)[0].value='';

		}

	}

	else

	{

		if(emark>mrk)

		{

			alert("Scored Mark cannot be greater than max mark");

			document.getElementsByName(varname)[0].value='';

		}

	}

}



function valid1()

{

	var mmarks= parseInt(document.getElementsByName("cc")[0].value);

	var obt_mark = parseInt(document.getElementsByName("ca")[0].value);

	if(isNaN(mmarks))

	{

		alert("Enter number only.");

		document.getElementsByName("cc")[0].value='';

	}

	if(isNaN(obt_mark))

	{

		alert("Enter number only.");

		document.getElementsByName("ca")[0].value='';

	}

	else

	{

		if(obt_mark>mmarks)

		{

			alert("Attended class cannot be greater than conducted class");

			document.getElementsByName("ca")[0].value='';

		}

	}

}

</script>

</head>

<body>

<form name="frm" action="" method="post">

<?php

echo "

<input type='hidden' name='course' value='$course'>

<input type='hidden' name='sem' value='$sem'>

<input type='hidden' name='examid' value='$examid'>

<input type='hidden' name='studentid' value='$studentid'>

<input type='hidden' name='stundetname' value='$stundetname'>

<input type='hidden' name='student_id' value='$student_id'>

<input type='hidden' name='class_section_id' value='$class_section_id'>";



?>

<table align="center" width="70%" border="1" cellspacing="0" cellpadding="0">

<tr>

    <td align="center" class="head" colspan="5" > ADD MARKS </td>

</tr> 



   

  <?php

  echo '

  <tr height="25">

    <td align="center" colspan="5"  class="row2" >Name : '.$stundetname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Id : '.$student_id.' </td>

  </tr>';



$examsub=fetchrow(execute("select sub_id from exam_m where id='$examid'"));

$examidsub1=explode(',',$examsub[0]);
for($g=0;$g<sizeof($examidsub1);$g++)

{

	$flag=1;

	echo "<input type='hidden' name='sub_id[]' value='$examidsub1[$g]'>";

	

	$subjectname=fetchrow(execute("SELECT subject_name FROM subject_m where subject_id='$examidsub1[$g]'"));

	$newid=$examidsub1[$g];

			$Sql67=execute(" select * from skill_grade_desc where student_id='$studentid' and acc_year='$accyeardet'  and sub='$newid' and exam_id='$examid'");

			while($rk=fetcharray($Sql67))

			{

				$desc11=$rk['desc1'];

	

			}

	$sql1=execute("SELECT a.subject_id , a.subject_name,a.elective FROM subject_m a, master_skills b where a.course_id='$course' and  a.course_year_id='$sem' and b.exam_id='$examid' and b.sub=a.subject_id and a.subject_id='$examidsub1[$g]'  group by b.sub ");
	while($r2=fetcharray($sql1))
	{
        $flag1=1;
	if($r2[2]=='Y')
	{
		
		$studentstatus=fetchrow(execute("select id from student_course where stu_id='$studentid' and acc_year='$accyeardet' and sub='$r2[0]'"));
		if(!$studentstatus)
		$flag1=0;
	}
		$flag2=1;
		
	if($flag1)
	{

		$flag=0;
	
        echo " <tr>

		<td nowrap width='75%' colspan='2' class='row2'><strong>  $r2[1] </strong></td>

		<td nowrap align='center' class='row2'> Max Level </td>

		<td nowrap align='center' class='row2'> Scored</td>

		</tr> ";

	   $k=1;

	   $totmax=0;

	   $totmak=0;

	   $grade=0;

		$sql2=execute("SELECT id , skill,mark FROM master_skills where class='$sem' and sub='$examidsub1[$g]' and exam_id='$examid' order by posi");

		while($r3=fetcharray($sql2))

		{
				echo "<tr>

						<td nowrap width='3%' align='center' valign='top'> $k</td>

						<td  valign='top'>  $r3[1]";

							

						  $k++;

						 

			$sql5=execute("SELECT eval1, eval2,	eval3 FROM skill_grade where  student_id='$studentid' and	skill='$r3[0]' and acc_year='$accyeardet'");

			while($r5=fetcharray($sql5))

			{

				$eval1=$r5[0];

				$eval2=$r5[1];

				$totmax=$totmax+$r3[2];

				if($eval2!='N')

				$totmak=$totmak+$eval2;
			}

			echo "</td><input type='hidden' name='subarr[]' value='$r3[0]'>

							<td nowrap align='center'>$r3[2] </td>

							

							<td nowrap align='center'> <input type='text' name='eval2_$r3[0]' value='$eval2' size='3' onchange='valid(this.value,$r3[2],this.name)' > </td>
						  </tr>";

						  

		$eval2='';

		}

				echo "<td nowrap align='center'></td>

									<td nowrap align='right'><strong>&nbsp;</strong></td>

									

									<td nowrap align='center'>MAX = $totmax</td>

									<td nowrap align='center'>$totmak</td>

									

								  </tr>";

		$yearpoint=execute("SELECT tot_point FROM `exam_grade_point` where`acc_year`='$accyeardet' and `sem`='$sem' and exam_id='$examid' and subject_id='$newid' and (('$totmak' between from_point and to_point) or (from_point='$totmak' or to_point='$totmak'))");

		$yearpoint1=fetchrow($yearpoint);	

	

	echo "</td><input type='hidden' name='subarr[]' value='$r3[0]'>

	

									<td nowrap align='center'></td>

									<td nowrap align='right'></strong></td>

									

									<td nowrap align='center'><strong>GRADE<strong></td>

									<td nowrap align='center'>$yearpoint1[0]</td>

									</tr>";

								  echo"<br>";
			}
	}
						
							$flagk=1;
							$elsectiveid=fetchrow(execute("SELECT elective FROM subject_m where subject_id='$examidsub1[$g]'"));
							if($elsectiveid[0]=='Y')
							{							
								$studentstatus=fetchrow(execute("select id from student_course where stu_id='$studentid' and acc_year='$accyeardet' and sub='$examidsub1[$g]'"));
								if(!$studentstatus)
								{
									$flagk=0;
								}
							}
							if($flagk)
							{	
								echo "<tr>
								<td align='center' class='row2' colspan='5'> <div align='center'>$examname COMMENTS</div></td>
								</tr>";
								echo "<tr >
								<td align='center' colspan='5' >";
								echo "<b> <div align='center'>$subjectname[0]</div></b>";
								echo "<textarea name='desc_".$examidsub1[$g]."' rows='5' cols='80'>$desc11</textarea></td>
								</tr>";			  
							}							
		 					
		 				$desc11='';
							
				
		}
?>

	</table>

    <br>

 <div align="center">

<input type="submit" name="save" value="Save" class="bgbutton"></div></form>

</body>

</html>

