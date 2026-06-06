<?php
$course = $_POST['course'];
$sem = $_POST['sem'];
$subject = $_POST['subject'];
$scheme = $_POST['scheme'];
$month = $_POST['month'];
$year = $_POST['year'];
$acc_no = $_POST['acc_no'];
if($media=='False')
{
	header("Location:advance_opac_search.php");
}
?>
<?php
     require_once("../db.php");
?>  
<html>
<head>
<script language="javascript">
function frm_search()
{

	if((document.frm.subject.value !="0")||(document.frm.course.value !="0")||(document.frm.sem.value !="0")||(document.frm.scheme.value !="0")|| (document.frm.month.value !="")||(document.frm.year.value !="")||(document.frm.acc_no.value !=""))
	{
		document.frm.action="view_opac_questionpaper_search.php";
		document.frm.submit();
	}
	else
	{
		alert ("Enter the search criteria");
	}
}
function frm_submit()
{
    document.frm.action="advance_opac_search_questionpaper.php";
	document.frm.submit();
}
</script>
</head>
<body>
<form name="frm" method="POST" action="view_opac_questionpaper_search.php" style="background-image: url('../images/Mouse1.gif')">
<center>
  <table class='forumline' width="60%" colspan='4'><br/>
  <tr><td align='center' Class='head' colspan='4'>OPAC Search for Question Paper</td></tr>
  
    <?php
    $college='mistlib';
    ?>
   <tr>
      <td>&nbsp;&nbsp;&nbsp;Course</td>
      <td><select name='course' onChange="frm_submit()">
		  <option value='0'>-- First Year --</option>
		<?
		$rs_sql=execute("select * from course_m");
		if(rowcount($rs_sql)>0)
		{
			for($j=0;$j < rowcount($rs_sql);$j++)
			{
				$r_sql=fetcharray($rs_sql,$j);
				$sel='';

				if($r_sql[0]==$course)
				{
					$sel='selected';
				}
				echo "<option value='$r_sql[0]' $sel> $r_sql[1]</option>";
			}
		}
		echo "</select>";
		?>
        </td>
        <td>Year/Sem</td>
        <td><select name='sem' onChange="frm_submit()">
		<option value='0'>-- Year/Sem --</option>
		<?php
		if($course>0)
			$rs_sql=execute("select a.* from course_year a,course_m b where b.course_id='$course' and a.head_id=b.head_id and a.year_id not in (1,2) order by year_id");
		else
			$rs_sql=execute("select * from course_year where year_id in (1,2) order by year_id");
		if(rowcount($rs_sql)>0)
		{
			for($j=0;$j < rowcount($rs_sql);$j++)
			{
				$r_sql=fetcharray($rs_sql,$j);
				$sel='';

				if($r_sql[0]==$sem)
				{
					$sel='selected';
				}
				echo "<option value='$r_sql[0]' $sel> $r_sql[1]</option>";
			}
		}
		echo "</select>";
		?>
        </td>
        </tr>
        <tr>
        <td>&nbsp;&nbsp;&nbsp;Subject</td>
        <td><select name='subject' onChange="frm_submit()">
	  <option value='0'>-- Subject --</option>
	 	<?php
//		echo "select * from subject_m where course_year_id='$sem' and status=1 order by subject_id";
		$rs_sql=execute("select * from subject_m where course_year_id='$sem' and status=1 order by subject_id");
		if(rowcount($rs_sql)>0)
		{
			for($j=0;$j<rowcount($rs_sql);$j++)
			{
				$r_sql=fetcharray($rs_sql,$j);
				$sel='';
				if($r_sql[0]==$subject)
				{
					$sel='selected';
					$subject_code=$r_sql[6];
				}
				echo "<option value='$r_sql[0]' $sel> $r_sql[2]</option>";
			}
		}
		echo "</select>";
		?>
        </td>
        <td>Subject Code</td>
        <td><?php echo $subject_code?></td>
            </tr>
            	<tr>
	      <td>&nbsp;&nbsp;&nbsp;Scheme</td>
		  <td><select name='scheme'>

		<?php
		$sel1="";
		$sel2="";
		$sel3="";
		if($scheme=='new')
		{
			$sel1='selected';
		}
		elseif($scheme=='old')
		{
			$sel2='selected';
		}
		elseif($scheme=='all')
		{
			$sel3='selected';
		}
		?>
		<option value='all' <?php echo $sel1?> >All</option>
		<option value='new' <?php echo $sel1?> >New Scheme</option>
		<option value='old' <?php echo $sel2?> >Old Scheme</option>
		</select></td>
		<td>Month&nbsp;<input type="text" name="month"  value="<?php echo $month?>" size="2" maxlength="2"></td>
		<td>Year&nbsp;<input type="text" name="year"  value="<?php echo $year?>" size="4" maxlength="4"></td>
    </tr>
	<!-- <tr>
	<td colspan='4'align='center'></td>
	</tr> -->
	<tr>
	  <td colspan='4' align='left'>&nbsp;&nbsp;&nbsp;Accession No.
	  <input type="text" name="acc_no" value="<?=$acc_no?>"></td>
	  </tr>
	  <tr>
       
    </tr>
	</table>
    <br>
    <div align='center'><input type="button" name="search" value="Search" class='bgbutton' onClick="frm_search()"></div>
    <br>
  </center>
   <p align="center">
   Note: In order to make search accurate and faster please key as many keywords as posible.
  </p>
<p align="left">&nbsp;</p>
</form>
<!--<table align='right'>
<tr><td>
<div align='right'>
<a href="advance_opac_search.php" >Home</a>
<div>
</td>
</tr>
</table>-->
</body>
</html>