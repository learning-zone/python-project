<?php
require_once("../db.php");
$course = $_POST['course'];
$sem = $_POST['sem'];
$subject = $_POST['subject'];
$scheme = $_POST['scheme'];
$month = $_POST['month'];
$year = $_POST['year'];
$acc_no = $_POST['acc_no'];
$ID = $_POST['ID'];
if($_POST)
{
	$SeekPos=$_POST['SeekPos'];
}
if($_GET)
{
	$SeekPos=$_GET['SeekPos'];
}
$_NUMREC_ = 15; 
if(empty($SeekPos))
{
        $SeekPos = 0;
}
$sql="select distinct(id) from lib_question_paper_det where id is not null";
if($acc_no =="")
{
	if($course!=0)
	{
		$sql.=" and course='$course' ";
	}
	if($sem!=0)
	{
		$sql.=" and sem='$sem' ";
	}
	if($subject!=0)
	{
		$sql.=" and subject='$subject' ";
	}
    if($scheme !='all')
    {
	    $sql.=" and scheme='$scheme' ";
    }
	if($month !="")
	{
	    $sql.=" and month='$month' ";
	}
	if($year !="")
	{
		$sql.=" and year='$year' ";
	}
}
else
{
 $sql.=" and  question_paper_no='$acc_no'";
}
//echo $sql;
$rs = execute($sql) or die("No Media Found");
$row=rowcount($rs);
$countRS=rowcount($rs);
?>
<HTML>
<HEAD>
<script language='javascript'>
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'ques','height=600,width=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<BODY>
<h4 align="center">Advance OPAC Search for Question Paper</h4>
<?php
if($course>0)
{
	$rs_sql=execute("select * from course_m where course_id=$course");
	$r_sql=fetcharray($rs_sql);
	$course_name=$r_sql[1];
}
else
	$course_name="First Year";
mysql_free_result($rs_sql);
if($sem>0)
{
	$rs_sql=execute("select * from course_year where year_id=$sem");
	$r_sql=fetcharray($rs_sql);
	$sem_name=$r_sql[1];
}
else
	$sem_name="All Semesters";
mysql_free_result($rs_sql);
if($subject>0)
{
	$rs_sql=execute("select subject_name,subject_code from subject_m where subject_id=$subject");
	$r_sql=fetcharray($rs_sql);
	$sub_name=$r_sql[0]." (".$r_sql[1]." )";
}
else
	$sub_name="All Subjects";
mysql_free_result($rs_sql);
?>
<div class='block' align='center'><?php echo $course_name?> - <?php echo $sem_name?> - <?php echo $sub_name?></div>
<form name="frm" action="view_opac_questionpaper_search.php">
<table  align="center" class='forumline'  width="70%" colspan='6'>
<?php
if ($row >= 0 )
{
	?>
	<tr>
		<td align="center"  class="head">Sl no.</td>
		<td align="center"  class="head" nowrap>Q.Paper Code</td>
		<td align="center"  class="head">Month-Year</td>
		<td align="center"  class="head">Scheme</td>
		<td align="center"  class="head" nowrap>No.of Pages</td>
		<td align="center"  class="head">Action</td>
	</tr>
	<?php
		if($row==0)
		{
		?>
			</table>
			<br><br>
			<p align="center"><a href="../library/advance_opac_search_questionpaper.php?media=True" >Go Back</a></p>						
		<?php
			die("No Media Found");
		}
	    // data_seek($rs,$SeekPos); //Move the data pointer to the next position.
		mysql_data_seek($rs,$SeekPos); 

	  if( ($SeekPos + $_NUMREC_) > $countRS)
		 {
			$MAX = $countRS;
		 }
	else
		{
			$MAX = $SeekPos + $_NUMREC_ ;
		}

	  if( ($SeekPos + $_NUMREC_) >= $countRS)
		{
			$NEXT = $SeekPos;
		}
	else
		{
			$NEXT  = $SeekPos + $_NUMREC_ ;
		}

	  if( ($SeekPos - $_NUMREC_)  > 0)
		{
			$PREV = $SeekPos - $_NUMREC_;
		}
	else
		{
			$PREV = 0;
		}

	  $PAGES = $countRS / $_NUMREC_;
	  if($countRS % $_NUMREC_)
	  {
		  $PAGES++;
	 }
		$LAST = ((int) $PAGES - 1) * $_NUMREC_;
		for($i=$SeekPos;$i<$MAX;$i++)
	    {
	          $r = fetcharray($rs);
			  $sql_qry="select * from lib_question_paper_det where id='$r[id]'";
			  $rs_qry=execute($sql_qry);
			  $r_qry=fetcharray($rs_qry);
	     	  echo "<tr height='20'>";
			  $temp_val=strval($i)+1;
			  if($temp_val<10)
					$temp_val="0".$temp_val;
			  echo "<td align='center'>$temp_val </td>";
			  echo "<td align='center'>$r_qry[question_paper_no]</td>";
			  echo "<td align='center'>".MonthName($r_qry[month])." - $r_qry[year]</td>";
			  echo "<td align='center'>$r_qry[scheme]</td>";
			  echo "<td align='center'>$r_qry[noupld]</td>";
			  echo "<td align='center'><a href=javascript:OpenWind('view_qdet.php?ID=$r[id]')>Download</a></td>";
		echo "</tr>";
	}

}

?>

      <script language="JavaScript">
         function first()
		 {
		   var i;
           i = 0;
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		}
		function prev()
		{

           var i;
           i = "<?php echo $PREV?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		}

        function next()
		{

           var i;
           i = "<?php echo $NEXT?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		}
		function last()
		{

           var i;
           i = "<?php echo $LAST?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		}
</script>
    <input type="hidden" name="submit1" value="<?php echo $submit1?>">
    <input type="hidden" name="course" value="<?php echo $course?>">
    <input type="hidden" name="sem" value="<?php echo $sem?>">
    <input type="hidden" name="subject" value="<?php echo $subject?>">
    <input type="hidden" name="month" value="<?php echo $month?>">
    <input type="hidden" name="year" value="<?php echo $year?>">
    <input type="hidden" name="scheme" value="<?php echo $scheme?>">
    <input type="hidden" name="acc_no" value="<?php echo $acc_no?>">
    <input type="hidden" name="SeekPos">
       <tr>
       	<td colspan="6">
       	<table align="center">
        <tr>
           <td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0" alt="First"></a></td>
           <td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0" alt="Previous"></a></td>
           <td><a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next"></a></td>
           <td><a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last"></a></td>
       </tr>
	   </td>
       </tr>
       <tr>
        <td colspan="5" align="center">Page <?php echo  ($SeekPos / $_NUMREC_) +1?> of <?php echo (int) $PAGES?></td>
	 </tr>
	</table>
    <input type="hidden" name="id" value="<?php echo $id?>">
<br>
<table align='right'>
<tr><td>
<div align='right'>
<a href="../library/advance_opac_search_questionpaper.php?media=True" >Go Back</a>
</div>
</td>
</tr>
</table>
</form>
<?php
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
</Body>
</HTML>