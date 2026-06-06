<?php
require_once("../db.php");
$title=$_POST['title'];
$id=$_REQUEST['id'];
$author=$_POST['author'];
$college=$_POST['college'];
$keywords=$_POST['keywords'];
$course=$_POST['course'];
$acc_no=$_POST['acc_no'];
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
$sql="select distinct(a.id) from lib_project_report_det a,lib_proj_acc_det b where  b.mode='A' and a.id=b.master_id ";
if($acc_no =="")
{
	if($title !="")
	{
		$sql.=" and a.title like '%$title%'";
	}
	if($author !="")
	{
		$sql.=" and a.author='$author'";
	}
	if($college !="")
	{
		$sql.=" and a.college='$college'";
	}
	if($course !="")
	{
			$sql.=" and a.course='$course'";
	}
	if($keywords !="")
	{
		$sql.=" and a.key_word1='$keywords' or a.key_word2='$keywords' or a.key_word3='$keywords' or a.key_word4='$keywords' or a.key_word5='$keywords'";
	}
}
else
{
	$sql.=" and  b.acc_no='$acc_no'";
}
$rs = execute($sql) or die("No Media Found");
$row=rowcount($rs);
$countRS=rowcount($rs);
?>
<HTML>
<HEAD></HEAD>
<BODY>
<h4 align="center">Advance OPAC Search Results for Project Report</h4>
<form name="frm" action="view_opac_project_search.php">
<table  align="left" class='forumline' width="100%" >
<?php
if ($row >= 0 )
{
	?>
	<tr>
	<td align="center"  class="head">Sl no.</td>
	<td align="left"    class="head">Aceession No</td>
	<td align="left"    class="head">&nbsp;&nbsp;&nbsp;Title</td>
	<td align="center"  class="head">Author</td>
	<td align="center"  class="head">Call ID</td>
	<!--<td align="center"  class="head">College</td>-->
	<td align="center"  class="head">Guide Name</td>
	<!--<td align="center"  class="head">Course</td>-->
	<td align="center"  class="head">Class</td>
	<td align="center"  class="head">Copies</td>
	<td align="center"  class="head">Copies Out</td>
	</tr>
	<?php
		if($row==0)
		{
		?>
				</table>
				<br><br>
			    <p align="center"><a href="../library/advance_opac_search_project.php?media=True" >Back</a></p>
				
		<?php
			die("No Media Found");
		}
	  //data_seek($rs,$SeekPos); //Move the data pointer to the next position.
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
			 if($acc_no==0)
		     {
			   $sql_qry="select a.*,b.* from lib_project_report_det a,lib_proj_acc_det b where  b.mode='A' and a.id=b.master_id and a.id=$r[id] and b.media_type='5'";
			 }
			else
			{
				$sql_qry="select a.*,b.* from lib_project_report_det a,lib_proj_acc_det b where  b.mode='A' and a.id=b.master_id and a.id=$r[id] and b.media_type='5' and b.acc_no='$acc_no'";
			}

			$rs_sql=execute($sql_qry);
			$r_sql=fetcharray($rs_sql);
			echo "<tr>";
			$temp_val=strval($i)+1;
			echo "<td align='center'> $temp_val </td>";
			echo "<td align='left'>&nbsp;&nbsp;$r_sql[acc_no]</td>";
			echo "<td align='left'><a href='view_proj_rep_det.php?id=$r[id]&title=$title&author=$author&college=$college&course=$course&subject=$subject&keywords=$keywords&acc_no=$acc_no&val=$val&SeekPos=$SeekPos'>$r_sql[title]</a></td>";
			echo "<td align='center'> $r_sql[author]</td>";
			echo "<td align='center'> $r_sql[class_no]</td>";
			//echo "<td align='center'> $r_sql[college]</td>";
			echo "<td align='center'> $r_sql[guide_name]</td>";
			//echo "<td align='center'> $r_sql[course]</td>";
			echo "<td align='center'> $r_sql[class_name]</td>";
			$sql1="select count(*) from lib_proj_acc_det where mode='A' and master_id=$r[id]";
			$rs1=execute($sql1);
			$r1=fetcharray($rs1);
			echo "<td align='center'> $r1[0]</td>";

			$Rsql="select count(*) from lib_reference_media_trans a,lib_proj_acc_det b WHERE " ;
		    $Rsql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type=5 and a.status=0 and b.master_id='$r[id]'";
            $Rrs=execute($Rsql);
		    $Rrow=fetcharray($Rrs);
		 
		    $Isql="select count(*) from lib_circulation_m a,lib_proj_acc_det b WHERE " ;
		    $Isql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type=5 and a.status=0 and b.master_id='$r[id]'";
            $Irs=execute($Isql);
		    $Irow=fetcharray($Irs);
	    
		    $out=$Rrow[0]+$Irow[0];

			echo "<td align='center'>$out</td>";
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
           i = "<?=$PREV?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		}
		function next()
		{
		   var i;
           i = "<?=$NEXT?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		}
		function last()
		{
		   var i;
           i = "<?=$LAST?>";
		   document.frm.SeekPos.value = i;
           document.frm.submit();
		  }
</script>
<input type="hidden" name="submit1" value="<?=$submit1?>">
<input type="hidden" name="val" value="<?=$val?>">
<input type="hidden" name="title" value="<?=$title?>">
<input type="hidden" name="keywords" value="<?=$keywords?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="acc_no" value="<?=$acc_no?>">
<input type="hidden" name="college" value="<?=$college?>">
<input type="hidden" name="course" value="<?=$course?>">
<input type="hidden" name="author" value="<?=$author?>">
<input type="hidden" name="attrib" value="<?=$attrib?>">
<input type="hidden" name="SeekPos">
<tr>
   <td colspan="11">
   <table align="center">
   <tr>
     <!-- <td><a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0" alt="First"></a></td>
      <td><a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0" alt="Previous"></a></td>
      <td><a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0" alt="Next"></a></td>
      <td><a href="Javascript:last()"><img src="../images/lastbtn.gif" border="0" alt="Last"></a></td>-->
	  <td title="First"><a href="Javascript:first()"><<</td>
	  <td title="Previous"><a href="Javascript:prev()"><</td>
	  <td title="Next"><a href="Javascript:next()">></td>
	  <td title="Last"><a href="Javascript:last()">>></td>
  </tr>
</td>
</tr>
<tr>
   <td colspan="8" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
</tr>
</table>
    <input type="hidden" name="id" value="<?=$id?>">
	
    <p align="center"><a href="../library/advance_opac_search_project.php?media=True" >Go Back</a></p>

</form>
</Body>
</HTML>