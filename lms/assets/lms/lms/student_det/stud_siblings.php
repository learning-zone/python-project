<?php
session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];

if(!$_POST and !$_GET)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$stuid=$_REQUEST['stuid'];

}
elseif(!$_POST and $_GET)
{
	$sem=$_REQUEST['sem'];
	$branch=$_REQUEST['branch'];
	$studfname=$_REQUEST['searchField'];
	$class_section_id=$_REQUEST['class_section_id'];
	$stuid=$_REQUEST['stuid'];
}
else
{

	$sem=$_POST['sem'];
	$branch=$_POST['branch'];
	$app_no=$_POST['app_no'];
	$family=$_POST['family'];
	$family_code=$_POST['family_code'];
	$relation=$_POST['relation'];
	//$studfname=$_POST['studfname'];	
	$studfname=$_POST['searchField'];
	$class_section_id=$_POST['class_section_id'];
	$studids=$_POST['studids'];
	$student_id=$_POST['student_id'];
	$stuid=$_POST['stuid'];
	$family_names=$_POST['family_names'];
}
//print_r($_POST);
//print_r($_GET);

$randval = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);


?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="autocomplete.css" type="text/css" media="screen">
<script src="jquery.js" type="text/javascript"></script>
<script src="dimensions.js" type="text/javascript"></script>
<script src="autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
	    setAutoComplete("searchField", "results", "autocomplete.php?part=");
	});
</script>
<script LANGUAGE="JavaScript">
function reload(str)

{

var url="../sessionbranchfile.php";

url=url+"?q="+str;

url=url+"&sid="+Math.random();



if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET",url,true);

xmlhttp.send();

}
</script>
<script type="text/javascript">
function ReloadMe()
{
    document.frm.action="stud_siblings.php";
	document.frm.submit();
}
</script>
<title>Apply Sibling</title>
</head>
<body>
<?

$styd=1;
$fmcode2=mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$stuid' and `status`=1");
$fmcode76=mysql_fetch_array(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$stuid' and `status`=1"));
if(mysql_num_rows($fmcode2)>0)
{
$styd=0;
$ecoleids=$fmcode76[0];
$lnupdte=strlen($ecoleids);
}
if($styd)
{
$ecoleids="CR".$stuid.$randval;
$lnupdte=strlen($ecoleids);
}


if($_POST['save'])
{	
	if($lnupdte>2)
	{
		$updtval="update `stud_sibling` set status='0' where `family_code`='$ecoleids' and stud!='$stuid'";
		mysql_query($updtval);
		
		$studids=$_POST['studids'];
		for($j=0;$j<sizeof($studids);$j++)
		{
			$coacid=$studids[$j];
			$Sql66=mysql_query("select id from stud_sibling where family_code='$ecoleids' and stud='$coacid'");
			if(mysql_num_rows($Sql66)>0)
			{
				$sql33="update `stud_sibling` set status='1',family_name='$family_names' where stud='$coacid' and `family_code`='$ecoleids'";
				mysql_query($sql33);
			}
			else
			{
			mysql_query("insert into stud_sibling (`family_name`, `family_code`, `relation`, `stud`, `status`) values('$family_names', '$family_code' ,'$relation', '$coacid','1')");
			}
		}
		
		//this for first insert
	//$studsgg=mysql_query("select id from stud_sibling where family_code='$ecoleids' and stud='$stuid'");
//			if(mysql_num_rows($studsgg)<=0)
//			{
//	mysql_query("insert into stud_sibling (`family_name`, `family_code`, `relation`, `stud`, `status`) values('$family_names', '$family_code' ,'$relation', '$stuid','1')");
//			}
			$studsts=sizeof($studids);			
			if($studsts)
			{	
			
				$newstud=mysql_query("select id from stud_sibling where family_code='$ecoleids' and stud='$stuid'");
				if(mysql_num_rows($newstud)>0)
				{
					$studsgg="update `stud_sibling` set status='1',family_name='$family_names' where stud='$stuid' and `family_code`='$ecoleids'";
					mysql_query($studsgg);
				}
				else
				{
				mysql_query("insert into stud_sibling (`family_name`, `family_code`, `relation`, `stud`, `status`) values('$family_names', '$family_code' ,'$relation', '$stuid','1')");
				}
			}
			else
			{			
				$stafvat="update `stud_sibling` set status='0' where stud='$stuid' and status=1";
				mysql_query($stafvat);
			}			
	}
	
	?>
	<SCRIPT LANGUAGE="JavaScript">
	alert("Updated Successfully");
	</SCRIPT>
	<?php
	echo "<META HTTP-EQUIV='Refresh' Content='0;URL=familys.php?stuid=$stuid'>";
}
?>

<?php
$rs = execute("SELECT * FROM student_m limit 1");

$num = rowcount($rs);

if($num > 0)

{

	?>

	<form method='post' action="stud_siblings.php" name="frm" >

<input type="hidden" name="stuid" value="<?=$stuid?>"/>
<input type="hidden" name="branch" value="<?=$branch?>"/>
<input type="hidden" name="sem" value="<?=$sem?>"/>
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>"/>
<input type="hidden" name="app_no" value="<?=$app_no?>"/>

    <table class='forumline' align='center' width="90%" ><tr><td Class="Head" colspan='7' align='center'>Search Student Details</td></tr>

    

	<tr height='30'>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

		<td><select name="branch" onChange="reload(this.value)">

			<option value="0">---------------Select---------------</option>

				<?php

					$sql="select course_id,coursename from course_m";

					$rs=execute($sql) or die(error_description());

					for($i=0;$i<rowcount($rs);$i++)

					{

					  $r=mysql_fetch_array($rs);



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

			<td> <?php echo $_SESSION['semname']; ?></td>

		<td><div id="txtHint9" class="inline">

        <select name="sem">

			<option value='0'>----------Select---------</option>

			<?php

				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");

				while($r=fetcharray($rs))

				{

					if($sem==$r[year_id])

					{

						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";

					}

					else

					{

						echo "<option value='$r[year_id]'>$r[year_name]</option>";

					}

				}

			?>

			</select></div>



		</td>

	</tr>

	<tr>

	<td>&nbsp;&nbsp;&nbsp;&nbsp;Section</td><td><select name='class_section_id'>

<?

$rs_section=execute("select * from class_section");

echo "<option value=''>--Select--</option>";



for($i=0;$i<rowcount($rs_section);$i++)

{

	$r_section=fetcharray($rs_section,$i);

	if($class_section_id==$r_section[id])

	{

		echo "<option value='$r_section[id]' selected>$r_section[section_name]</option>";

	}

	else

	{

		echo "<option value='$r_section[id]'>$r_section[section_name]</option>";

		

	}

}

?>

</select>

</td>

	<td>Student Id</td>

		<td><input type="text"  name='app_no' value="" ></td></tr>

	<!--<tr height='30'>

		

		<td>&nbsp;&nbsp;&nbsp;&nbsp;Student Name</td>
		<td colspan="3" id="auto">
        <input type="text" name="searchField" id="searchField" value="<?=$studfname?>" onChange="get(this.value)" autocomplete="off"></td></tr>-->
	</table><br>

	<div align=center>

	<input type="submit" class='bgbutton' value="Search" name="studdet">

	</div>
<br>
	

	<?php

}

else

{

	?>

	<td>No studentid Record </td>

	<?php

}

?>

<?php

if(!$_POST['studdet'] and ! $_REQUEST)

die();

	$sql="select id,student_id,usn,first_name,last_name,admission_id from student_m where id is not null and archive='N' and academic_year='$academic_year' and id!='$stuid'";

	if($app_no!='')
	{

	 	$sql.=" and student_id='$app_no'";

	}

	if($sem!=0)

	{

		$sql.=" and course_yearsem=$sem";

	}

	if($class_section_id!='')
	{

		$sql.=" and class_section_id=$class_section_id  ";

	}

	if($studfname!='')
	{

	 	$sql.=" and first_name like '$studfname%'";

	}

 $sql.=" order by first_name";

		$rs=execute($sql) or die(mysql_error());



	if(rowcount($rs)==0)

	{

		echo "<font><b>No Records Found !!</b></font>";

		die();

	}



?>
</form>
	<form method='post' action="stud_siblings.php" name="frm1" >
<input type="hidden" name="stuid" value="<?=$stuid?>"/>
<input type="hidden" name="branch" value="<?=$branch?>"/>
<input type="hidden" name="sem" value="<?=$sem?>"/>
<input type="hidden" name="class_section_id" value="<?=$class_section_id?>"/>
<input type="hidden" name="app_no" value="<?=$app_no?>"/>

<?

$fmnamess=mysql_fetch_array(mysql_query("SELECT family_name,relation FROM `stud_sibling` where stud='$stuid' and `status`=1"));
?>
<table border='1' align=center cellspacing='0' cellpadding='3' width='60%'>
<tr>
<td align='center' class='head' colspan='5'>Family</td>
<!--<td align='center' class='head' ><input type="submit" class='bgbutton' value="View" name="studdet"></td>
--></tr>
<tr>
<td  align='left' width="10%" nowrap>&nbsp;Family Name</td>
<td  align='left' width="35%">&nbsp;<input size="40" type='text' name='family_names' value='<?=$fmnamess[0]?>' ></td>
<!--<td  align='left' width="10%" nowrap>&nbsp;Relation</td>
<td  align='center' width="30%">&nbsp;<input size="30" type='text' name='relation' value='<?=$fmnamess[1]?>'></td>-->
<td  align='left' width="10%" nowrap>&nbsp;Family Code</td>
<td  align='center' nowrap width="10%">
<?
$stys=1;
$fmcod=mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$stuid' and `status`=1");
$fmcodes=mysql_fetch_array(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$stuid' and `status`=1"));
if(mysql_num_rows($fmcod)>0)
{
	$stys=0;
?>
<input size="13" type='text' name='family_code' value='<?=$fmcodes[0]?>' readonly>
<?
}
if($stys)
{
?>
<input size="13" type='text' name='family_code' value='<?=$ecoleids?>' readonly>
<?
}
?>
</td></tr>
</table>
<br>
<div align="center">
<input type="submit" name="save" value="Save"  class='bgbutton'>
</div>
<br>



<?
/*$fmcode=mysql_fetch_row(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$stuid' and `status`=1"));	
	$stcodess=mysql_query("SELECT a.stud,b.id,b.first_name,b.last_name,b.student_id,b.admission_id FROM stud_sibling a,student_m b where a.family_code='$fmcode[0]' and a.status=1 and a.stud=b.id");
	while($stcds=mysql_fetch_array($stcodess))
	{
		if($stcds[1])
		$check11='checked';
		else
		$check11='';*/
	?>
   <!-- <input type="hidden" name="studids[]" value="<?=$stcds[0]?>" <?=$check11?>>-->						
    <?
	//}
?>

<div style="max-height:300px; overflow-y:auto" align="center">

<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>

<tr>
  <td align='center' class='head' colspan='5'><font size="4"><b>Add/Remove Sibling</b></font></td>

</tr>

<tr height='25' >

<td Class="rowpic" align='center'>Sl No</td>

<td Class="rowpic" align='center'>Student ID</td>

<td Class="rowpic" align='center'>Admission No</td>

<td Class="rowpic" align='center'>Student Name</td>
<td Class="rowpic" align='center'>Sel</td></tr>

<?
$gs='A';
$fmcode=mysql_fetch_row(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$stuid' and `status`=1"));	
	$stcodess=mysql_query("SELECT a.stud,b.id,b.first_name,b.last_name,b.student_id,b.admission_id FROM stud_sibling a,student_m b where a.family_code='$fmcode[0]' and a.status=1 and a.stud=b.id and a.stud!='$stuid'");
	while($stcds=mysql_fetch_array($stcodess))
	{
			if($stcds[0])
			$check11='checked';
			else
			$check11='';
			
			?>
            <tr> 
			<td  align='center' ><b><?=$gs?></b></td>
			<td align="center">&nbsp;&nbsp;
			<b><?=$stcds[student_id]?></b></td>
	
			<TD align="center"><b><?=$stcds['admission_id']?></b></TD>
	
			<td>&nbsp;&nbsp;<b><?=$stcds[first_name]?>&nbsp;<?=$stcds[last_name]?></b></td>
			<td align="center"><input type="checkbox" name="studids[]" value="<?=$stcds[0]?>" <?=$check11?>></td>
			</tr>						
    <?
	$gs++;
	}
?>


<?php

  $rowclass=1;

  $sno=1;

	for($i=0;$i<rowcount($rs);$i++)

	{

		$r=fetcharray($rs);

		if($sno<10)

			//$sno="0".$sno;

			
$fmcodevat=mysql_fetch_row(mysql_query("SELECT family_code FROM `stud_sibling` where `stud`='$stuid' and `status`=1"));
	
	$stcode=mysql_fetch_row(mysql_query("SELECT stud FROM `stud_sibling` where `family_code`='$fmcodevat[0]' and `status`=1 and stud='$r[id]'"));
	
		if(!$stcode[0])
		{
			if($i%2)
	
			echo "	<tr class='clsname' > ";
	
			else
	
			echo "	<tr > ";
		?>
		<td   align='center' ><?=$sno?></td>
		<td align="center">&nbsp;&nbsp;
       <?=$r[student_id]?></td>

        <TD align="center"><?=$r['admission_id']?></TD>

		<td>&nbsp;&nbsp;<?=$r[first_name]?>&nbsp;<?=$r[last_name]?></td>
        <td align="center"><input type="checkbox" name="studids[]" value="<?=$r[id]?>"></td>
        </tr>

		<?php

		$sno++;
}
		$rowclass = 1 - $rowclass;

	}

?>
</table>
</div>

</form>
</body>
</html>