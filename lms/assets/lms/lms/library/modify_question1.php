<html>
<?php
	include("../db.php");
	?>
<head>
	<script language='javascript'>
	  function reload()
	  {
	     document.form.action="";
	     document.form.submit();
	  }
	</script>
</head>
<?php
if(isset($modify))
  {
     $directory = "Q".$branch.$sem;			
     if (file_exists("../question_paper/$directory") == false)
     $dir_created= mkdir("../question_paper/$directory",0777);		

     $target_path = "../question_paper/$directory/";

     $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
     $msg = explode("/",$target_path);
     $msg1 = explode(".",$msg[3]);	
	
     $msg3 = $ID.".".$msg1[1];
     $target_path = "../question_paper/$directory/".$msg3;

     move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);

     $var="update lib_question_paper_det set question_paper_no='$number',course='$branch',sem='$sem',subject='$subj',month='$mm',";
     $var.=" year='$yy',scheme='$scheme',remarks='$remark',library='$library',register='$reg'";

     if($_FILES['uploadedfile']['tmp_name'] != null)
       {
         $var.= " ,upload_question_paper='$target_path'";
       }
     $var.="  where id='$ID'";
     $var1=execute($var) or die(mysql_error());
  }

if(isset($delete))
  {
	  $del=execute("delete from lib_question_paper_det where id='$ID'");
  }
  
$que=execute("select * from lib_question_paper_det where id='$ID'");
$que1=fetcharray($que);

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
<input type="hidden" name="ID" value="<?php echo $ID ?>">
<table border='0' align='center' width='80%' class='forumline' cellspacing='2'>
  <tr >
	<td class='head' colspan=4 align='center'>Add Question Paper Details</td>
  </tr>
  <tr>
    <td>Library</td>
    <td><select name='library' >
		<option value='0'> Select Library</option>
          <?php
	       $var2 = "select id,name from library_name";
	       $res2 = execute($var2) or die(mysql_error());
	       $num2 = rowcount($res2);
	       for($i=1;$i<=$num2;$i++)
	          {
		       $row2 = fetcharray($res2);
		       if($row2[id]==$que1[library])
		         {
		           echo "<option value='$row2[id]' selected>$row2[name]</option>";
				 }
		       else
		         {
		           echo "<option value='$row2[id]' >$row2[name]</option>";
		         }
	          }
          ?>
   </td>
   <td>Register</td>
   <td><select name='reg' >
       <option value='0'> Register</option>
      <?php
		   $var3 = "select id,register from lib_register where library='$row2[id]'";
		   $res3 = execute($var3) or die(mysql_error());
		   $num3 = rowcount($res3);
		   for($i=1;$i<=$num3;$i++)
			  {
			   $row3 = fetcharray($res3);
			   if($row3[id]==$que1[register])
				 {
				   ?>
				   <option value='$row3[id]' selected><?php echo $row3[register] ?></option>
				   <?php
				 }
			   else
				 {
				   ?>
				   <option value='$row3[id]' ><?php echo $row3[register] ?></option>
				   <?php
				 }
			 }
		  ?>
		</td>	
	</tr>
	<tr>
		<td>Qustion Paper Id</td>
		<td><font color="red" face='Lucida Sans'><?php echo $que1[id] ?></font>
		<td>Qustion Paper Number</td>
		<td><input type='text' name='number' value='<?php echo $que1[question_paper_no] ?>'>
	</tr>
	<tr height="25">
		<td width="20%">Branch<font color='red'>*</font></td>
		<td width="35%">
		<select name="branch" >
		<option value="0">Select Branch</option>
			<?php
				$sql="select course_id,coursename from course_m where status=1 and head_id=1";
				$rs=execute($sql) or die(error_description());
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r=fetcharray($rs);

					if($que1[course]==$r[course_id])
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
		
		<td > Semister </td>
        <td><select name="sem" >
			<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Sem</option>
			<?php
				$rs=execute("SELECT year_name,year_id FROM course_year where status=1 and head_id=1");
				while($r=fetcharray($rs))
				{
					if($que1[sem]==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
				}
		
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Subject</td>
		<td><select name='subj' >
		    <option value='0'>select Subject</option>
			<?php
				if($sem >2)
				{
					$res5=execute("select subject_id,subject_name,subject_code from subject_m where course_id=$que1[course] and course_year_id=$que1[sem] and status=1 order by subject_id");
				}
				else
				{
					$res5=execute("select subject_id,subject_name,subject_code from subject_m where course_year_id=$que1[sem] and status=1 order by subject_id");
				}
				for($i=1;$i<=rowcount($res5);$i++)
				{
					$row5=fetcharray($res5);
					if($que1[subject]==$row5[subject_id])
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
	<td >Month-Year</td>
	<td >
	<?php
	   $c_date=getdate();
	   $MyMonth=$c_date["mon"];
	   echo "<select name='mm'>";
	   for($i=1;$i<=12;$i++)
	      {
	        $sel='';
	        if($i == $que1[month])
		    $sel='selected';
		    echo "<option value='$i' $sel>" . MonthName($i) ."</option>";
	      }
	   echo "</select>";
	   $maxYr =$c_date["year"]+1;
	   $MyYear=$c_date["year"];
	   $st=$c_date["year"]-4;
	   echo "<select name='yy'>";
	   for($i=$st;$i<=$maxYr;$i++)
	      {
		    $sel='';
	        if($i==$que1[year])
	        $sel='selected';
	        echo "<option value=$i $sel>$i</option>";
          }
	   echo "</select>";
   ?>
  </td>
  <td >Scheme</td>
  <td ><select name='scheme'>
	   <?php
          if($que1[scheme]== "New")
            {
	          $sj="selected";
	          $sk="";
            }
          if($que1[scheme]== "Old")
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

<tr>
	<td>Remark</td>
	<td>
		<textarea rows='2' cols='41' name='remark'><?php echo $que1[remarks]?></textarea>
	</td>
	<td>Upload Question Paper</td>
		 <td><INPUT TYPE='FILE' NAME='uploadedfile' value='<?php echo $que1[upload_question_paper] ?>' SIZE='15'>
	</td>
</tr>
<tr height='70'>
	<td colspan='2' align='center'><input type="submit" value="modify" name="modify" class='bgbutton'></td>
	<td colspan='2' align='center'><input type="submit" value="delete" name="delete" class='bgbutton'></td>
</tr>
</table>
</form>
</head>
</html>