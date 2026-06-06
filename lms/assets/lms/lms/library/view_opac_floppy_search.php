<HTML>
<HEAD>
<TITLE>Search Page.</TITLE>
<?php
session_start();
require("../db.php");
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
$sql="select distinct(a.id) from lib_floppy_det a,lib_floppy_acc_det b where b.mode='A' and a.id=b.master_id and b.media_type=$media_type ";
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
	if($source_acc_no !="")
	{
		$sql.=" and a.source_acc_no='$source_acc_no'";
	}
	/*if($volume!="")
	{
			$sql.=" and( a.volume = '".$volume."')";
	}
	if($issue!="")
	{
			$sql.=" and( a.issue ='".$issue."')";
	}
	if($month!="")
	{
			$sql.=" and( a.month = '".$month."')";
	}
	if($year!="")
	{
			$sql.=" and( a.year = '".$year."')";
	}

	if($source !="")
		{
			$sql.=" and( a.source like '%".$source."%')";
	}*/
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
</head>
<BODY>

<h2 align="center"><b><font color="#000099" size="5">Advance OPAC Search Results</font></b></h2>
<form name="frm" action="view_opac_floppy_search.php">

<table  align="left" class='forumline' width="100%" colspan='8'>
<?php
if ($row >= 0 )
{
	?>
	<tr>
	<td align="center"  class="head">Sl no.</td>
	<td align="center"  class="head">Accession Number</td>
	<td align="center"  class="head">Title</td>
	<td align="center"  class="head">Author</td>
	<td align="center"  class="head">Call ID</td>
	<td align="center"  class="head">Rack</td>
	<td align="center"  class="head">Copies</td>
	<td align="center"  class="head">Copies Out</td>
	</tr>
	<?php
		if($row==0)
		{
		?>
		</table>
				<br><br>
				<table align='right'>
				<tr>
				<td>
				<bR>
				<div align='right'>

				<a href="../library/advance_opac_search_floppy.php?media=True&media_type=<?=$media_type?>" ><b><font face="Times New Roman" size="5" color="#8572D3">Go Back</font></b></a>
				</div>
				</td></tr>
		</table>


		<?
		die("No Media Found");
		}
	  data_seek($rs,$SeekPos); //Move the data pointer to the next position.

	  if( ($SeekPos + $_NUMREC_) > $countRS){

	        $MAX = $countRS;

	  }else{

	        $MAX = $SeekPos + $_NUMREC_ ;

	  }

	  if( ($SeekPos + $_NUMREC_) >= $countRS){

	        $NEXT = $SeekPos;

	  }else{

	        $NEXT  = $SeekPos + $_NUMREC_ ;

	  }

	  if( ($SeekPos - $_NUMREC_)  > 0){

	        $PREV = $SeekPos - $_NUMREC_;

	  }else{

	        $PREV = 0;

	  }

	  $PAGES = $countRS / $_NUMREC_;

	  if($countRS % $_NUMREC_){

	        $PAGES++;

	  }


	  $LAST = ((int) $PAGES - 1) * $_NUMREC_;

	    for($i=$SeekPos;$i<$MAX;$i++)
	    {
	          $r = fetcharray($rs);
			  if($acc_no==0)
		      {
		        $sql_qry="select a.*,b.* from lib_floppy_det a,lib_floppy_acc_det b where b.mode='A' and a.id=b.master_id and b.media_type=$media_type and a.id=$r[id] ";
			  }
			  else
			  {
				$sql_qry="select a.*,b.* from lib_floppy_det a,lib_floppy_acc_det b where b.mode='A' and a.id=b.master_id and b.media_type=$media_type and a.id=$r[id] and b.acc_no='$acc_no'";
			  }
		     $rs_sql=execute($sql_qry);
		     $r_sql=fetcharray($rs_sql);

		echo "<tr>";
		$temp_val=strval($i)+1;
		echo "<td align='center'>$temp_val</td>";
		echo "<td align='center'>$r_sql[acc_no]</td>";
		echo "<td align='left'><a href='view_floppy_details.php?id=$r[id]&media_type=$media_type&val=$val&title=$title&keywords=$keywords&author=$author&source_acc_no=$source_acc_no&volume=$volume&issue=$issue&month=$month&year=$year&subject=$subject&source=$source&acc_no=$acc_no&SeekPos=$SeekPos'>$r_sql[title]</a>";
		echo"</td>";


		echo "<td>$r_sql[author]</td>";
		echo "<td align='center'>$r_sql[call_no]</td>";
		echo "<td align='center'>$r_sql[rack]</td>";
		$sql1="select count(*) from lib_floppy_acc_det where mode='A' and master_id=$r[id]";

		$rs1=execute($sql1);
		$r1=fetcharray($rs1,0);

		echo "<td align='center'>$r1[0]</td>";

		 $Rsql="select count(*) from lib_reference_media_trans a,lib_floppy_acc_det b WHERE " ;
		 $Rsql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media_type' and a.status=0 and b.master_id='$r[id]'";
         $Rrs=execute($Rsql);
		 $Rrow=fetcharray($Rrs);
		 
		 $Isql="select count(*) from lib_circulation_m a,lib_floppy_acc_det b WHERE " ;
		 $Isql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media_type' and a.status=0 and b.master_id='$r[id]'";
         $Irs=execute($Isql);
		 $Irow=fetcharray($Irs);
         
		 $out=$Rrow[0]+$Irow[0];
         echo "<td align='center'> $out</td>";
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
<input type="hidden" name="attrib" value="<?=$attrib?>">
<input type="hidden" name="title" value="<?=$title?>">
<input type="hidden" name="keywords" value="<?=$keywords?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="author" value="<?=$author?>">
<input type="hidden" name="acc_no" value="<?=$acc_no?>">
<input type="hidden" name="month" value="<?=$month?>">
<input type="hidden" name="year" value="<?=$year?>">
<input type="hidden" name="issue" value="<?=$issue?>">
<input type="hidden" name="volume" value="<?=$volume?>">
<input type="hidden" name="source_acc_no" value="<?=$source_acc_no?>">
<input type="hidden" name="media_type" value="<?=$media_type?>">
<input type="hidden" name="source" value="<?=$source?>">
<input type="hidden" name="SeekPos">
      
<tr>
   <td colspan="8">
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
  <td colspan="8" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
</tr>
</table>
    <input type="hidden" name="id" value="<?=$id?>">
<br>
<table align='right'>
<tr><td>
<div align='right'>

<a href="../library/advance_opac_search_floppy.php?media=True&media_type=<?=$media_type?>" ><b><font face="Times New Roman" size="5" color="#8572D3">Go Back</font></b></a>
</div>
</td>
</tr>
</table>
</form>
</Body>
</HTML>