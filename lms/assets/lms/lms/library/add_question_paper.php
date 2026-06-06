<?php
session_start();
require_once("../db.php");


$mm=$_POST['mm'];
$yy=$_POST['yy'];
$sem=$_POST['sem'];
$reg=$_POST['reg'];
$ID = $_POST['ID'];
$subj=$_POST['subj'];
$Act = $_POST['Act'];
$number=$_POST['number'];
$scheme=$_POST['scheme'];
$branch=$_POST['branch'];
$noupld=$_POST['noupld'];
$remark=$_POST['remark'];
$upldname=$_POST['upldname'];
$lib_name=$_POST['lib_name'];

?>
<html>
	<head>
	<script language='javascript'>
	  function reload()
	  {
	     document.form.action="";
	     document.form.submit();
	  }
	function valid()
	{
		if(document.form.reg.value=='0')
		{
			alert("Please Select Register");
			return false;
		}
		else if(document.form.branch.value=='-1')
		{
			alert("Please Select Program");
			return false;
		}
		else if(document.form.sem.value=='0')
		{
			alert("Please Select Semister");
			return false;
		}
		else if(document.form.subj.value=='0')
		{
			alert("Please Select Subject");
			return false;
		}
		else if(document.form.uploadedfile1.value=="")
		{
			alert("Please Upload Question Paper");
			return false;
		}
		else
		{
			document.form.action='add_question_paper.php';
			document.form.submit();
		}
	}
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'ques','height=600,width=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
	</script>
</head>
<?php
if(isset($Act))
{
	$var ="select id from lib_question_paper_det where course='$branch' and sem='$sem'";
	$var.=" and subject='$subj' and year='$yy' and month='$mm' and scheme='$scheme'";
	$res = execute($var);
	$num = rowcount($res);
	//echo "insert into lib_question_paper_det(question_paper_no,course,sem,subject,month,year,scheme,remarks,library,register,flag,noupld) VALUES ('$number','$branch','$sem','$subj','$mm','$yy','$scheme','$remark','1','$reg','0','$noupld')";
    if($num==0)
	{
		$var1 = "insert into lib_question_paper_det(question_paper_no,course,sem,subject,month,year,scheme,remarks,library,";
		$var1.=" register,flag,noupld)"; 
		$var1.=" VALUES ('$number','$branch','$sem','$subj','$mm','$yy','$scheme','".addslashes($remark)."','1','$reg','0','$noupld')";
		$res1 = execute($var1);
		
		$id=fetchInsertId($res1);
		$directory = "Q".$branch.$sem;	
		if (file_exists("../library/question_paper/$directory") == false)
		$dir_created= mkdir("../library/question_paper/$directory",0777) ;		
		
		for($i=1;$i<=$noupld;$i++)
		{
			$target_path = "../library/question_paper/$directory/";
			$upldname="uploadedfile".$i;
			$target_path = $target_path . basename($_FILES[$upldname]['name']);
			
			$msg = explode("/",$target_path);
			$msg1 = explode(".",$msg[4]);
			$msg3 = $id."_".$i.".".$msg1[1];
			
			$target_path = "../library/question_paper/$directory/".$msg3;
			
			move_uploaded_file($_FILES[$upldname]['tmp_name'], $target_path);
			if($fls=="")
				$fls=$i.".".$msg1[1];
			else
				$fls=$fls.":".$i.".".$msg1[1];
		}
		$nop=execute("update lib_question_paper_det set upldfiles='$fls' where id='$id'");
	}
	else
	{
	?>
		<script language='javascript'>
		alert("The Details Already Exist");
		</script>
	<?php
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
<table border='0' align='center' width='80%' class='forumline' cellspacing=2>
  <tr >
	<br/><td class='head' colspan=4 align='center'>Add Question Paper</td>
  </tr>
  <?php
  /*
  <tr>
    <td>Library</td>
	<?php
		$lib_name=fetcharray(execute("select name from library_name"));
	 ?>
    <td><?php echo $lib_name[name]?></td>
    <td>Register</td>
	<td><select name='reg'>
        <option value='0'>Register</option>
    <?php
			$var3 = "select id,register from lib_register";
			$res3 = execute($var3) or die(mysql_error());
			$num3 = rowcount($res3);
			for($i=1;$i<=$num3;$i++)
			{
				$row3 = fetcharray($res3);
				if($row3[id]==$reg)
				{
				  echo "<option value='$row3[id]' selected>$row3[register]</option>";
				}
				else
				{
				  echo "<option value='$row3[id]' >$row3[register]</option>";
				}
			}
			?>
			</td>	
	</tr>
	*/
	$library=1;
$Register=1;
	?>
	<tr>
		<?php
			$var4 = "select max(id) from lib_question_paper_det";
			$res4 = execute($var4);
			$row4 = fetchrow($res4);
			$num4 = $row4[0] + 1;
			
			$mag = strlen($num4);
			switch($mag)
			{
				case 1:
				$magazin = 'Q00000'.$num4;
				break;
				case 2:
				$magazin = 'Q0000'.$num4;
				break;
				case 3:
				$magazin = 'Q000'.$num4;
				break;
				case 4:
				$magazin = 'Q00'.$num4;
				break;
				case 5:
				$magazin = 'Q0'.$num4;
				break;
				default:
				$magazin ='Q'.$num4;
				break;
			}
		?>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;Accesion Number</td>
        <td><input type='text' name='number' value='<?php echo $magazin?>' readonly></td>
		<td width="23%" >Scheme</td>
	<td width="22%"><select name='scheme'>
	<?php
	if($sch== "New")
	{
		$sj="selected";
		$sk="";
	}
	if($sch== "Old")
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
		<td width="18%">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?>*</td>
		<td width="37%"><?php if($branch=='0') { $s="selected"; } else { $s=""; } ?>
		<select name="branch" onchange='reload()'>
		<option value='-1'>Select</option>
			<?php
				$sql="select course_id,coursename from course_m where status=1 order by head_id,course_id";
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
		
		<td > <?php echo $_SESSION['semname']; ?> </td>
		<td><select name="sem" onchange='reload()'>
		<option value='0'>Select</option>
		<?php
			$rs=execute("SELECT year_name,year_id FROM course_year where year_id < 3");
			while($r=fetcharray($rs))
			{
				if($sem==$r[year_id])
				{
					echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
				}
				else
				{
					echo "<option value='$r[year_id]'>$r[year_name]</option>";
				}
			}
	
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Subject</td>
		<td><select name='subj' onchange='reload()'>
		    <option value='0'>Select Subject</option>
			<?php
				if($sem >2)
				{
					$res5=execute("select subject_id,subject_name,subject_code from subject_m where course_id=$branch and course_year_id=$sem and status=1 order by subject_id");
				}
				else
				{
					$res5=execute("select subject_id,subject_name,subject_code from subject_m where course_year_id=$sem and status=1 order by subject_id");
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
			<td><?php echo $code ?>
	</tr>
	<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;Month-Year</td>
	<td nowrap><?php
	$c_date=getdate();
	$MyMonth=$c_date["mon"];
	echo "<select name='mm'>";
	if ($mm=='')
	{
		$mm=$MyMonth;
	}
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
	$maxYr =$c_date["year"];
	$MyYear=$c_date["year"];
	$st=$c_date["year"]-5;
	echo "<select name='yy'>";
	if ($yy=='') 
	{
		$yy=$MyYear;
	}
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
	?></td>
	<td nowrap>No of Files</td>
	<td><input type="text" name="noupld" value="<?=$noupld?>" size="3" onchange='reload()'>
	</td></tr>
	<?php
	if($noupld>0)
	{
		?>
		<tr>
		<td rowspan='2'>&nbsp;&nbsp;&nbsp;&nbsp;Remarks</td>
		<td rowspan='2'>
			<textarea rows='2' cols='41' name='remark' value='<?php echo $remark?>'></textarea>
		</td>
		<td align='center' colspan='2'>Upload Question Paper</td></tr>
		<tr><td colspan='2'><table align='center'>
		<?php
		for($i=1;$i<=$noupld;$i++)
		{
			echo "<tr><td nowrap>File - $i</td>";
			$upldname="uploadedfile".$i;
			echo "<td><INPUT TYPE='FILE' NAME='$upldname' value='' SIZE='25'></td></tr>";
		}
		?>
	</table></td></tr>
	<tr height='70'>
		<td colspan='4' align='center'><input type="submit"  name="Act" value="save" class='bgbutton' onclick='return valid()'></td>
	</tr>
	<?php
	}
	?>
</table>
<br>
<table border='0' align='center' width='80%' class='forumline' cellspacing=2 colspan='5'>
<tr >
	<td class='head' colspan='6' align='center'>Manage Question Paper</td>
</tr>
<tr>
<td align='center' width='5%' class="row3" nowrap>Sl No</td>
   <td align='center' width='20%' class="row3" nowrap>Accession No</td>
   <td align='center' width='20%' class="row3" nowrap>Month - Year</td>
   <td align='center' width='10%' class="row3" >Scheme</td>
    <td align='center' width='10%' class="row3" nowrap>No of Files</td>
   <td align='center' class="row3">Action</td>
</tr>
  <?php
  $sel="select * from lib_question_paper_det where ";
  $sel.=" course='$branch' and sem='$sem' and subject='$subj' and flag='0'";
  $sel1=execute($sel);
  $sno=1;
  for($i=0;$i<rowcount($sel1);$i++)
	{
      $sel2=fetcharray($sel1);
	  if($sno<10)
		  $sno="0".$sno;
  ?>
  <tr height='25'><td align='center'><?php echo $sno ?></td>
  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sel2[question_paper_no]?></td>
  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo MonthName($sel2[month])?> - <?php echo $sel2[year]?></td>
  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sel2[scheme]?></td>
  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sel2[noupld]?></td>
  <td align='center'><?php echo "<a href=javascript:OpenWind('mod_qdet.php?ID=$sel2[id]')>"; ?>
  Modify / Delete / View</a></td>
 </tr>
  <?php
	  $sno++;
	}
  ?>
</table>
</form>
</head>
</html>