<?php
	$addr=$_POST['addr'];
$studfname=$_POST['studfname'];
$branch=$_POST['branch'];
$un=$_POST['un'];
$sem=$_POST['sem'];
$file_type = "vnd.ms-excel";
$file_name= "Address_Print.xsl";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
?>
<html>
<body>
<?php

    $sql.="select first_name,last_name,student_id,usn,parent_name, ";
	if($addr==0)
	{
		$sql.=" cor_address as addr,cor_state as state,cor_country as country ,cor_pincode as pin ,cor_phone as phone";
	}
	if($addr==1)
	{
		$sql.=" per_address as addr,per_state as state,per_country as country,per_pincode as pin,per_phone as phone";
	}
	if($addr==2)
	{
		$sql.=" loc_address as addr,loc_state as state,loc_country as country,loc_pincode as pin ,loc_phone as phone";
	}

	$sql.=" from student_m where id is not null and archive='N'";

	if($app_no!='')
	{
	 $sql.=" and admission_id='$app_no'";
	}
	if($branch!=0)
	{
	$sql.=" and course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql.=" and course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql.=" and first_name='$studfname'";
	}
	if($a_year!=0)
	{
		$sql.=" and academic_year='$a_year'";
	}
	if($un!=0 or $un!='')
	{
       $sql.=" and student_id='$un'";
    }
	$sql.=" order by first_name";
	$rs=execute($sql) or die(mysql_error());
	$num = rowcount($rs);
	if($num==0)
	{
		echo "<font color=brown><b>No Records Found !!</b></font>";
		die();
	}
?>


<form name='frm' method=POST>
<input type='hidden' name="un" value="<?=$un?>">
<input type="hidden" name="studfname" value="<?=$studfname?>">
<input type="hidden" name="a_year" value="<?=$a_year?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="branch" value="<?=$branch?>">
<input type="hidden" name="app_no" value="<?=$app_no?>">
<table border="0" width='90%' align='center' class='forumline'>
 <tr>
  <td align='center' class='head'>Student's Address</td>
 </tr>
</table>

<table border="0" width='90%' align='center' class='forumline'>
<tr>
  <?php 
	$count=0;
	for($i=0;$i<$num;$i++)
	{
		$r1=mysql_fetch_array($rs);
		$name = $r1[first_name] . " " .  $r1[last_name];
		$temp = str_replace(",","<br>",$r1[addr]);
		$count=$count+1;
		?>
			<td>
				<table border="0" width='90%' align='center' align='top'>
				<?php
				if($r1[usn] != "")
				{
					?>
					<tr>
						<td><b><?php echo $name ?>-(<?php echo $r1[usn] ?>)</b></td>
					</tr>
					<?php
				}
				if($r1[usn] == "")
				{
					?>
					<tr>
						<td><b><?php echo $name ?>-(<?php echo $r1[student_id] ?>)</b></td>
					</tr>
					<?php
				}
				?>
					<tr>
						<td><b><?php echo $r1[parent_name] ?></b></td>
					</tr>
					<tr>
						<td><b><?php echo $temp ?></b></td>
					</tr>
					<tr>
						<td><b><?php echo $r1[state] ?>- <?php echo $r1[pin] ?></b></td>
					</tr>
					<tr>
						<td><b><?php echo $r1[country] ?></b></td>
					</tr>
					<tr>
						<td><b>Ph No-<?php echo $r1[phone] ?></b></td>
					</tr>
				</table>
			</td>
		<?
		if($count==3)
		{
			echo "</tr>";
			$count=0;
		}
	}
	if($count >1)
	echo "<td colspan=2></td></tr>";
?>
</table>
</body>
</html>