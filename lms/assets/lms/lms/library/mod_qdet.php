<?php

session_start();
require_once("../db.php");
if($_REQUEST)
{
	$ID = $_REQUEST['ID'];
}
if($_POST)
{  
    //print_r($_GET);
    //print_r($_POST);
	$del = $_POST['del'];
	$mod = $_POST['mod'];
	$ID = $_POST['ID'];
	$reg = $_POST['reg'];
	$mm = $_POST['mm'];
	$yy = $_POST['yy'];
	$scheme = $_POST['scheme'];
	$subj = $_POST['subj'];
	$noupld = $_POST['noupld'];
	$upldname = $_POST['upldname'];
	$remark = $_POST['remark'];
}
?>
<html>
<head>
<script language='javascript'>
function reload()
{
 document.form.action="mod_qdet.php";
 document.form.submit();
}
function validate()
{
	if(confirm("Are you sure you want to delete ?"))
		return true;
	else
		return false;
}
</script>
</head>
<?php
if(isset($del))
{
	$sql=execute("update lib_question_paper_det set flag=1 where id='$ID'");
	die("<font color='brown' size='3'><b><center>Deleted Successfully..!!</center></b></font>");
}
if(isset($mod))
{
	$qed=fetcharray(execute("select upldfiles,course,sem from lib_question_paper_det where id='$ID'"));
	$upf=explode(":",$qed[0]);
	$var1 = "update lib_question_paper_det set subject='$subj',month='$mm',year='$yy',scheme='$scheme',remarks='".addslashes($remark)."',";
	$var1.="register='$reg',noupld='$noupld' where id='$ID'"; 
	$res1 = execute($var1);	
	for($i=1;$i<=$noupld;$i++)
	{
		$directory = "Q".$qed[1].$qed[2];
		$target_path = "../library/question_paper/$directory/";
		$upldname="uploadedfile".$i;
		if(basename($_FILES[$upldname]['name'])=="")
		{
			$k=$i-1;
			if($fls=="")
				$fls=$upf[$k];
			else
				$fls=$fls.":".$upf[$k];
		}
		else
		{
			$target_path = $target_path . basename($_FILES[$upldname]['name']);
		
			$msg = explode("/",$target_path);
			$msg1 = explode(".",$msg[4]);
			$msg3 = $ID."_".$i.".".$msg1[2];
			
			$target_path = "../library/question_paper/$directory/".$msg3;
			
			move_uploaded_file($_FILES[$upldname]['tmp_name'], $target_path);
			if($fls=="")
				$fls=$i.".".$msg1[1];
			else
			$fls=$fls.":".$i.".".$msg1[1];
		}
		$nop=execute("update lib_question_paper_det set upldfiles='$fls' where id='$ID'");
	}
}
function MonthName($mon)
{
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}
?>
<body>
<form name='form' method='post'  ENCTYPE="multipart/form-data">
<input type="hidden" name="ID" value="<?=$ID?>">
  <?php
  $qdett=execute("select * from lib_question_paper_det where id='$ID' and flag='0'");
	if(rowcount($qdett)>0)
		$qdet=fetcharray($qdett);
	else
		die("<font color='brown' size='3'><b>No relavent data ..!!</b></font>");
	$lib_name=fetcharray(execute("select name from library_name"));
	 ?>
	 <table border='0' align='center' width='95%' class='forumline' cellspacing=2>
	 <tr >
	<td class='head' colspan=4 align='center'>Modify Question Paper Details</td>
  </tr>
       <tr>
       		<td nowrap>&nbsp;&nbsp;&nbsp;Accesion No:</td>
            <td><?php echo $qdet[question_paper_no] ?></td>
			<td >Scheme</td>
	<td>
    <select name='scheme'>
	<?php
	if($scheme=="")
		$scheme=$qdet[scheme];
	if($scheme== "New")
	{
		$sj="selected";
		$sk="";
	}
	else
	{
		$sk="selected";
		$sj="";
	}
	?>
	<option value="New" <?php echo $sj?>>New Scheme</option>
	<option value="Old" <?php echo $sk?>>Old Scheme</option>
    </select>
	</td>
	</tr>
	<tr height="25">
		<td width="20%">&nbsp;&nbsp;&nbsp;Program</td>
		<td width="35%" nowrap>
		<?php
		if($qdet[course]=='0')
		{ 
			echo "First Year";
		}
		else
		{
			$cname=fetcharray(execute("select coursename from course_m where course_id='$qdet[course]'"));
			echo $cname[0];
			
		}
		?>
		</td>
		<td> Semester </td>
		<td>
		<?php
			$rs=fetcharray(execute("SELECT year_name FROM course_year where year_id='$qdet[sem]' "));
			echo $rs[0];
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Subject</td>
		<td><select name='subj' onchange='reload()'>
			<?php
			if($subj=="")
				$subj=$qdet[subject];
				if($qdet[sem] >2)
				{
					$res5=execute("select subject_id,subject_name,subject_code from subject_m where course_id='$qdet[course]' and course_year_id='$qdet[sem]' and status=1 order by subject_id");
				}
				else
				{
					$res5=execute("select subject_id,subject_name,subject_code from subject_m where course_year_id='$qdet[sem]' and status=1 order by subject_id");
				}
				for($i=1;$i<=rowcount($res5);$i++)
				{
					$row5=fetcharray($res5);
					if($subj==$row5[subject_id])
					{
						echo "<option value='$row5[subject_id]' selected>$row5[subject_name]</option>";
						$code = $row5[subject_code];
					}
					else
					{
						echo "<option value='$row5[subject_id]'>$row5[subject_name]</option>";
					}
				}
			?>
			</select>
			</td>
			<td>Subject Code</td>
			<td><font color="red"><?php echo $code ?></font>
	</tr>
	<tr>
	<td>&nbsp;&nbsp;&nbsp;Month-Year</td>
	<td nowrap>
	<?php
	$MyMonth=$qdet[month];
	echo "<select name='mm'>";
	if ($mm=='')
		$mm=$MyMonth;
	for($i=1;$i<=12;$i++)
	{
		if($i == $mm)
		{
			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
		}
		else
		{
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
		}
	}
	echo "</select>";
	$maxYr =$qdet[year]+2;
	$MyYear=$qdet[year];;
	$st=$qdet[year]-3;
	echo "<select name='yy'>";
	if ($yy=='') 
		$yy=$MyYear;
	for($i=$st;$i<=$maxYr;$i++)
	{
		if($i == $yy)	
		{
			echo "<option value='$i' selected>$i</option>\n";
		}
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	</td>
	<td nowrap>No of Files</td>
	<?php
	if($noupld=="")
		$noupld=$qdet[noupld];
	?>
	<td><input type="text" name="noupld" value="<?=$noupld?>" size="3" onchange='reload()'>
	</td></tr>
	<?php
	if($noupld>0)
	{
		?>
		<tr>
		<td align='center' colspan='2'>Uploaded Files</td><td align='center' colspan='2'>Upload Question Paper</td></tr>
		<tr><td colspan='2'>
        <table align='center' width='100%'>
		<?php
			$uplds=explode(":",$qdet[upldfiles]);
		for($i=0;$i<$qdet[noupld];$i++)
		{
			$k=$i+1;
			$pth="../library/question_paper/Q".$qdet[course].$qdet[sem]."/".$ID."_".$uplds[$i];
			echo "<tr><td width='48%' align='center' nowrap>File - $k</td>";
			echo "<td><a href='$pth'>$uplds[$i]</a></td></tr>";
		}
		?>
	</table></td>		
		<td colspan='2'><table align='center'>
		<?php
		for($i=1;$i<=$noupld;$i++)
		{
			echo "<tr><td nowrap>File - $i</td>";
			$upldname="uploadedfile".$i;
			echo "<td><INPUT TYPE='FILE' NAME='upldname' value='' SIZE='25'></td></tr>";
		}
		?>
	</table></td></tr><tr>
	<td>&nbsp;&nbsp;&nbsp;Remarks</td>
	<?php
			if($remark=="")
				$remark=$qdet[remarks];
		?>
		<td colspan='3'>
			<textarea rows='2' cols='70' name='remark'><?php echo stripslashes($remark)?></textarea>
		</td>
	<tr height='70'>
		<td colspan='4' align='center'><input type="submit"  name="mod" value="Modify" class='bgbutton'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  name="del" value="Delete" class='bgbutton' onclick='return validate()'></td>
	</tr>
	<?php
	}
	?>
</table>
</form>
</head>
</html>