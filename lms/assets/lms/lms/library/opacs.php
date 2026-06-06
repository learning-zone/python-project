<?php
session_start();
require_once("../db5.php");

//echo "<pre>";
//print_r($_POST);

if($_GET)
{
	$media=$_REQUEST['media'];
	$action=$_REQUEST['action'];
}
if($_POST)
{
	$subj=$_POST['subj'];
	$media=$_POST['media'];
	$SeekPos=$_POST['SeekPos'];
	$searchtext=$_POST['searchtext'];
}

$_NUMREC_ = 15; 
if(empty($SeekPos))
{
  $SeekPos = 0;
}
//echo $media;
if($media==1) {
	$m='Book';
}
if($media==2){
	$m='CD/DVD';
}
if($media==5){
	$m='Project Report';
}
if($media==6){
	$m='Text Book';
}

if($media==1)
{
	$qry="select distinct(a.title),a.id, a.author,a.publisher,a.edition,a.year,a.subject,a.key_word1,a.key_word2,a.key_word3,a.key_word4,a.key_word5 from lib_book_details a,lib_acc_details b where b.mode='A' and a.id=b.master_id";

	if($subj==1)
	{
		$qry.= " and a.title like '%$searchtext%'";
	}
	if($subj==2)
	{
		$qry.= " and a.title='$searchtext'";
	}
	if($subj==3)
	{
		$qry.= " and a.title like '$searchtext%'";
	}
	if($subj==4 || $action=='textsearch')
	{
		$qry.= " and (a.title like '%$searchtext%' || a.author like '%$searchtext%' || a.edition='%$searchtext%' || a.publisher='%$searchtext%' || a.subject='%$searchtext' || a.isbn like '%$searchtext%' || a.key_word1 ='%$searchtext') order by a.title ";
	}
	if($subj==5)
	{
		$qry.= " and a.author like '%$searchtext%'";
	}
	if($subj==6)
	{
		$qry.= " and a.subject='$searchtext'";
	}
	if($subj==7)
	{
		$qry.= " and a.isbn like '$searchtext%'";
	}
	if($subj==8)
	{
		$qry.= " and  a.key_word1 ='$searchtext'";
	}
	if($subj==9)
	{
		$qry.= " and  b.acc_no ='$searchtext' ";
	}
	
	$rs = execute($qry) or die("No Media Found");
	$row=rowcount($rs);
    $countRS=rowcount($rs);

?>
<html>
<head></head>
<body>

<form name="frm" method="POST">

<!--<a href="opac.php?action=basicsearch">Back</a>-->

<table class=forumline width="98%" cellspacing="0" cellpadding="0" align='center' border=1>
<tr>
	<td align='center' class='head' colspan='9'>Book OPAC Search</td>
</tr>

<?php
if ($row >= 0 )
{
	?>
	<tr height="30">
	<td class='row3' align="center" nowrap>Sl No</td>
	<td class='row3'>Acc No</td>
	<td class='row3'>Title</td>
	<td class='row3'>Author</td>
	<td class='row3' align="center" nowrap>Edition</td>
	<td class='row3' align="center" nowrap>Publisher</td>
	<td class='row3' align="center" nowrap>Year</td>
	<td class='row3' align="center" nowrap>Copies In</td>
	<td class='row3' align="center" nowrap>Copies Out</td>
	<td class='row3' align="center" nowrap>Key 1</td>
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
		</td></tr>
		</table>
		<?php
		die("No Media Found");
		}
			
			 data_seek($rs,$SeekPos); 
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
				
				
				echo "<tr>";
				$temp_val=strval($i)+1;
				echo "<td align='center'>$temp_val</td>";
                
                echo "<td align='center'></td>";
				//echo "<td align='left'><a href='viewMedia.php?id=$r[id]&val=$val&title=$title&keywords=$keywords&subject=$subject&acc_no=$acc_no&publisher=$publisher&author=$author&attrib=$attrib&SeekPos=$SeekPos&subj=$subj&media=$media&searchtext=$searchtext&action=$action'>$r[title]</a>";
				echo "<td align='left'><a href='viewMedia.php?id=$r[id]&SeekPos=$SeekPos&subj=$subj&media=$media&searchtext=$searchtext&action=$action'>$r[title]</a>";

				echo"</td>";
                echo "<td align='left'>$r[author]";
				echo"</td>";
		
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r[publisher]</td>";
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$r[edition]</td>";
				echo "<td align='left'>&nbsp;&nbsp;$r[year]";
				echo"</td>";
			
				$sql1="select count(*) from lib_acc_details where mode='A' and master_id=$r[id]";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1,0);

				echo "<td align='center'>$r1[0]</td>";
				$Rsql="select count(*) from lib_reference_media_trans a,lib_acc_details b WHERE " ;
				$Rsql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media' and a.status=0 and b.master_id='$r[id]'";
				$Rrs=execute($Rsql);
				$Rrow=fetcharray($Rrs);
		 
				$Isql="select count(*) from lib_circulation_m a,lib_acc_details b WHERE " ;
				$Isql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media' and a.status=0 and b.master_id='$r[id]'";
				$Irs=execute($Isql);
				$Irow=fetcharray($Irs);
	    
				$out=$Rrow[0]+$Irow[0];
				echo "<td align='center'>$out</td>";
				echo "<td align='center'>$r[key_word1]</td>";
				echo "</tr>";
			}
	}
?>
<script language="JavaScript">
	function first()
		{
			//alert("first");
			var i;
            i = 0;
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function prev()
		{
			//alert('<?=$PREV?>');
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
           // alert('<?=$LAST?>');
			var i;
            i = "<?=$LAST?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}

		function genexcel()
		{
			document.frm.action="GenerateEXCELFile.php";
			document.frm.submit();
		}
</script>
	<input type="hidden" name="submit1" value="<?=$submit1?>">
    <input type="hidden" name="val" value="<?=$val?>">
	<input type="hidden" name="title" value="<?=$title?>">
    <input type="hidden" name="keywords" value="<?=$keywords?>">
    <input type="hidden" name="subject" value="<?=$subject?>">
    <input type="hidden" name="acc_no" value="<?=$acc_no?>">
    <input type="hidden" name="publisher" value="<?=$publisher?>">
    <input type="hidden" name="author" value="<?=$author?>">
    <input type="hidden" name="attrib" value="<?=$attrib?>">
	<input type="hidden" name="media" value="<?=$media?>">
	<input type="hidden" name="subj" value="<?=$subj?>">
	<input type="hidden" name="searchtext" value="<?=$searchtext?>">
	<input type="hidden" name="SeekPos">
    <tr>
		<td colspan="13">
			<table align="center" border="0">
				<tr>
					<td title="First"><a href="Javascript:first()"><img src="../images/first.png" height="30"></a></td>
					<td title="Previous"><a href="Javascript:prev()"><img src="../images/previous.png" height="30"></a></td>
					<td title="Next"><a href="Javascript:next()"><img src="../images/next.png" height="30"></a></td>
					<td title="Last"><a href="Javascript:last()"><img src="../images/last.png" height="30"></a></td>
					
				</tr>
			</table>
		</td>
	 </tr>
	<tr>
		<td colspan="13" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
   </tr>
   <tr>
		<td colspan="13" align="center">For more details of particular book click on title.</td>
   </tr></table>
      
		<!--<p align="center"><input type="button" name="excel" value="Generate Excel" onClick="genexcel()"></p>-->
 
    <input type="hidden" name="id" value="<?=$id?>">
    <br>
<?php
}
if($media==2)
{
			$qry="select distinct(a.id),a.title,a.author,a.key_word1,a.key_word2,a.key_word3,a.key_word4,a.key_word5 from lib_cd_det a,lib_cd_acc_det b where b.mode='A' and a.id=b.master_id";
			if($subj==1)
			{
				$qry.= " and a.title like '$searchtext%'";
			}
			if($subj==2)
			{
				$qry.= " and a.author like '$searchtext%'";
			}
			if($subj==4)
			{
				$qry.= " and (a.key_word1 like '$searchtext%' or a.key_word2 like '$searchtext%' or a.key_word3 like '$searchtext%' or a.key_word4 like '$searchtext%' or a.key_word5 like '$searchtext%')";
			}
			if($subj==5)
			{
				$qry.= " and a.title like '%$searchtext%'";
			}
			if($subj==6)
			{
				$qry.= " and a.title='$searchtext'";
			}
			if($subj==7)
			{
				$qry.= " and a.title like '$searchtext%'";
			}
			if($subj==12)
			{
				$qry.= " and b.acc_no like '$searchtext%'";
			}
			$rs = execute($qry) or die("No Media Found");
			$row=rowcount($rs);
			$countRS=rowcount($rs);
?>
<body>
<h5 align="center"><?php echo $m?> OPAC Search</h5>
<form name="frm" method="POST">
<table class=forumline width="98%" cellspacing="2" cellpadding=2 align='center' border=0>
<?php
if ($row >= 0 )
{
	?>
	<tr height="30">
	<td class='row3'>Sl No</td>
	<td class='row3'>Acc No</td>
	<td class='row3'>Title</td>
	<td class='row3'>Author</td>
	<td class='row3' align="center">Copies In</td>
	<td class='row3' align="center">Copies Out</td>
	<td class='row3' align="center">Key 1</td>
	<td class='row3' align="center">Key 2</td>
	<td class='row3' align="center">Key 3</td>
	<td class='row3' align="center">Key 4</td>
	<td class='row3' align="center">Key 5</td>
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
		</td></tr>
		</table>
		<?php
		die("No Media Found");
		}
	  data_seek($rs,$SeekPos);

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
				
				if($i%2)
					echo "<tr class='clsname'>";
				else
					echo "<tr>";
				$temp_val=strval($i)+1;
				echo "<td align='center'>$temp_val</td>";
                echo "<td align='center'></td>";
				echo "<td align='left'><a href='view_cd_details.php?id=$r[id]&val=$val&title=$title&keywords$keywords&subject=$subject&acc_no=$acc_no&publisher=$publisher&author=$author&attrib=$attrib&SeekPos=$SeekPos'>$r[title]</a>";
				echo"</td>";
                echo "<td align='left'><a href='view_cd_details.php?id=$r[id]&val=$val&title=$title&keywords$keywords&subject=$subject&acc_no=$acc_no&publisher=$publisher&author=$author&attrib=$attrib&SeekPos=$SeekPos'>$r[author]</a>";
				echo"</td>";

			
				$sql1="select count(*) from lib_cd_acc_det where mode='A' and master_id=$r[id]";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1,0);

				echo "<td align='center'>$r1[0]</td>";
				$Rsql="select count(*) from lib_reference_media_trans a,lib_cd_acc_det b WHERE " ;
				$Rsql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media' and a.status=0 and b.master_id='$r[id]'";
				$Rrs=execute($Rsql);
				$Rrow=fetcharray($Rrs);
		 
				$Isql="select count(*) from lib_circulation_m a,lib_cd_acc_det b WHERE " ;
				$Isql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media' and a.status=0 and b.master_id='$r[id]'";
				$Irs=execute($Isql);
				$Irow=fetcharray($Irs);
	    
				$out=$Rrow[0]+$Irow[0];
				echo "<td align='center'>$out</td>";
				echo "<td align='center'>$r[key_word1]</td>";
				echo "<td align='center'>$r[key_word2]</td>";
				echo "<td align='center'>$r[key_word3]</td>";
				echo "<td align='center'>$r[key_word4]</td>";
				echo "<td align='center'>$r[key_word5]</td>";
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
    <input type="hidden" name="publisher" value="<?=$publisher?>">
    <input type="hidden" name="author" value="<?=$author?>">
    <input type="hidden" name="attrib" value="<?=$attrib?>">
	<input type="hidden" name="media" value="<?=$media?>">
	<input type="hidden" name="subj" value="<?=$subj?>">
	<input type="hidden" name="searchtext" value="<?=$searchtext?>">
	<input type="hidden" name="SeekPos">
    <tr>
		<td colspan="13">
			<table align="center" border="0">
				<tr>
					<td title="First"><a href="Javascript:first()"><img src="../images/first.png" height="30"></a></td>
					<td title="Previous"><a href="Javascript:prev()"><img src="../images/previous.png" height="30"></a></td>
					<td title="Next"><a href="Javascript:next()"><img src="../images/next.png" height="30"></a></td>
					<td title="Last"><a href="Javascript:last()"><img src="../images/last.png" height="30"></a></td>
				</tr>
			</table>
		</td>
	 </tr>
	<tr>
		<td colspan="13" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
   </tr>
   <tr>
		<td colspan="13" align="center">For more details of particular book click on title.</td>
   </tr></table>
      
		<!--<p><input type="button" name="excel" value="Generate Excel" onClick="genexcel()"></p>-->
 

    <input type="hidden" name="id" value="<?=$id?>">
    <br>
<?php
}
//if($media==3)
//echo "<p>MEDIA : $subj</p>";
if($media==5)
{
			 $qry="select distinct(a.id),a.title,a.author,a.key_word1,a.key_word2,a.key_word3,a.key_word4,a.key_word5 from lib_project_report_det a,lib_proj_acc_det b where b.mode='A' and a.id=b.master_id";
			if($subj==1)
			{
				$qry.= " and a.title like '$searchtext%'";
			}
			if($subj==2)
			{
				$qry.= " and a.author like '$searchtext%'";
			}
			if($subj==4)
			{
				$qry.= " and (a.key_word1 like '$searchtext%' or a.key_word2 like '$searchtext%' or a.key_word3 like '$searchtext%' or a.key_word4 like '$searchtext%' or a.key_word5 like '$searchtext%')";
			}
			if($subj==5)
			{
				$qry.= " and a.title like '%$searchtext%'";
			}
			if($subj==6)
			{
				$qry.= " and a.title='$searchtext'";
			}
			if($subj==7)
			{
				$qry.= " and a.title like '$searchtext%'";
			}
			if($subj==12)
			{
				$qry.= " and b.acc_no like '$searchtext%'";
			}
			$rs = execute($qry) or die("No Media Found");
			$row=rowcount($rs);
			$countRS=rowcount($rs);
?>
<body>
<h5 align="center"><?php echo $m?> OPAC Search</h5>
<form name="frm" method="POST">
<table class=forumline width="98%" cellspacing="2" cellpadding=2 align='center' border=0>
<?php
if ($row >= 0 )
{
	?>
	<tr height="30">
	<td class='row3'>Sl No</td>
	<td class='row3'>Acc No</td>
	<td class='row3'>Title</td>
	<td class='row3'>Author</td>
	<td class='row3' align="center">Copies In</td>
	<td class='row3' align="center">Copies Out</td>
	<td class='row3' align="center">Key 1</td>
	<td class='row3' align="center">Key 2</td>
	<td class='row3' align="center">Key 3</td>
	<td class='row3' align="center">Key 4</td>
	<td class='row3' align="center">Key 5</td>
	</tr>
	<?php
		if($row==0)
		{
		?>
		</table>
		<br><br>
		<table align='right'>
		<tr><td>
		</td></tr>
		</table>
		<?php
		die("No Media Found..");
		}
	  data_seek($rs,$SeekPos);

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
				
				echo "<tr>";
				$temp_val=strval($i)+1;
				echo "<td align='center'>$temp_val</td>";
                echo "<td align='center'></td>";
				echo "<td align='left'><a href='view_proj_rep_det.php?id=$r[id]&val=$val&title=$title&keywords$keywords&subject=$subject&acc_no=$acc_no&publisher=$publisher&author=$author&attrib=$attrib&SeekPos=$SeekPos'>$r[title]</a>";
				echo"</td>";
				echo "<td align='left'><a href='view_proj_rep_det.php?id=$r[id]&val=$val&title=$title&keywords$keywords&subject=$subject&acc_no=$acc_no&publisher=$publisher&author=$author&attrib=$attrib&SeekPos=$SeekPos'>$r[author]</a>";
				echo"</td>";

				$sql1="select count(*) from lib_proj_acc_det where mode='A' and master_id=$r[id]";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1,0);

				echo "<td align='center'>$r1[0]</td>";
				$Rsql="select count(*) from lib_reference_media_trans a,lib_proj_acc_det b WHERE " ;
				$Rsql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media' and a.status=0 and b.master_id='$r[id]'";
				$Rrs=execute($Rsql);
				$Rrow=fetcharray($Rrs);
		 
				$Isql="select count(*) from lib_circulation_m a,lib_proj_acc_det b WHERE " ;
				$Isql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media' and a.status=0 and b.master_id='$r[id]'";
				$Irs=execute($Isql);
				$Irow=fetcharray($Irs);
	    
				$out=$Rrow[0]+$Irow[0];
				echo "<td align='center'>$out</td>";
				echo "<td align='center'>$r[key_word1]</td>";
				echo "<td align='center'>$r[key_word2]</td>";
				echo "<td align='center'>$r[key_word3]</td>";
				echo "<td align='center'>$r[key_word4]</td>";
				echo "<td align='center'>$r[key_word5]</td>";
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
    <input type="hidden" name="publisher" value="<?=$publisher?>">
    <input type="hidden" name="author" value="<?=$author?>">
    <input type="hidden" name="attrib" value="<?=$attrib?>">
	<input type="hidden" name="media" value="<?=$media?>">
	<input type="hidden" name="subj" value="<?=$subj?>">
	<input type="hidden" name="searchtext" value="<?=$searchtext?>">
	<input type="hidden" name="SeekPos">
    <tr>
		<td colspan="13">
			<table align="center">
				<tr>
					<td title="First"><a href="Javascript:first()"><img src="../images/first.png" height="30"></a></td>
					<td title="Previous"><a href="Javascript:prev()"><img src="../images/previous.png" height="30"></a></td>
					<td title="Next"><a href="Javascript:next()"><img src="../images/next.png" height="30"></a></td>
					<td title="Last"><a href="Javascript:last()"><img src="../images/last.png" height="30"></a></td>
				</tr>
			</table>
		</td>
	 </tr>
	<tr>
		<td colspan="13" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
   </tr>
   <tr>
		<td colspan="13" align="center">For more details of particular book click on title.</td>
   </tr></table>
    
		<!--<p><input type="button" name="excel" value="Generate Excel" onClick="genexcel()"></p>-->
   

    <input type="hidden" name="id" value="<?=$id?>">
    <br>
	<?php
	}
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%		 TEXT BOOK DETAILS 		%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

if($media==6)
{
	$qry="select distinct(a.title),a.id, a.author,a.publisher,a.edition,a.year,a.subject,a.key_word1,a.key_word2,a.key_word3,a.key_word4,a.key_word5 from lib_book_details a,lib_acc_details b where b.mode='A' and a.id=b.master_id and (( b.library = 1 and b.register = 3 ) or ( b.library = 2 and b.register = 4 ))";

	if($subj==1)
	{
		$qry.= " and a.title like '%$searchtext%'";
	}
	if($subj==2)
	{
		$qry.= " and a.title='$searchtext'";
	}
	if($subj==3)
	{
		$qry.= " and a.title like '$searchtext%'";
	}
	if($subj==4 || $action=='textsearch')
	{
		$qry.= " and (a.title like '%$searchtext%' || a.author like '%$searchtext%' || a.edition='%$searchtext%' || a.publisher='%$searchtext%' || a.subject='%$searchtext' || a.isbn like '%$searchtext%' || a.key_word1 ='%$searchtext') order by a.title ";
	}
	if($subj==5)
	{
		$qry.= " and a.author like '%$searchtext%'";
	}
	if($subj==6)
	{
		$qry.= " and a.subject='$searchtext'";
	}
	if($subj==7)
	{
		$qry.= " and a.isbn like '$searchtext%'";
	}
	if($subj==8)
	{
		$qry.= " and  a.key_word1 ='$searchtext'";
	}
	if($subj==9)
	{
		$qry.= " and  b.acc_no ='$searchtext' ";
	}
	
	$rs = execute($qry) or die("No Media Found");
	$row=rowcount($rs);
    $countRS=rowcount($rs);

?>
<html>
<head></head>
<body>

<form name="frm" method="POST">

<!--<a href="opac.php?action=basicsearch">Back</a>-->

<table class=forumline width="98%" cellspacing="0" cellpadding="0" align='center' border=1>
<tr>
	<td align='center' class='head' colspan='9'>Book OPAC Search</td>
</tr>

<?php
if ($row >= 0 )
{
	?>
	<tr height="30">
	<td class='row3' align="center" nowrap>Sl No</td>
	<td class='row3'>Acc No</td>
	<td class='row3'>Title</td>
	<td class='row3'>Author</td>
	<td class='row3' align="center" nowrap>Edition</td>
	<td class='row3' align="center" nowrap>Publisher</td>
	<td class='row3' align="center" nowrap>Year</td>
	<td class='row3' align="center" nowrap>Copies In</td>
	<td class='row3' align="center" nowrap>Copies Out</td>
	<td class='row3' align="center" nowrap>Key 1</td>
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
		</td></tr>
		</table>
		<?php
		die("No Media Found");
		}
			
			 data_seek($rs,$SeekPos); 
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
				
				
				echo "<tr>";
				$temp_val=strval($i)+1;
				echo "<td align='center'>$temp_val</td>";
                echo "<td align='center'></td>";
				//echo "<td align='left'><a href='viewMedia.php?id=$r[id]&val=$val&title=$title&keywords=$keywords&subject=$subject&acc_no=$acc_no&publisher=$publisher&author=$author&attrib=$attrib&SeekPos=$SeekPos&subj=$subj&media=$media&searchtext=$searchtext&action=$action'>$r[title]</a>";
				echo "<td align='left'><a href='viewMedia.php?id=$r[id]&SeekPos=$SeekPos&subj=$subj&media=$media&searchtext=$searchtext&action=$action'>$r[title]</a>";

				echo"</td>";
                echo "<td align='left'>$r[author]";
				echo"</td>";
		
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$r[publisher]</td>";
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$r[edition]</td>";
				echo "<td align='left'>&nbsp;&nbsp;$r[year]";
				echo"</td>";
			
				$sql1="select count(*) from lib_acc_details where mode='A' and master_id=$r[id]";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1,0);

				echo "<td align='center'>$r1[0]</td>";
				$Rsql="select count(*) from lib_reference_media_trans a,lib_acc_details b WHERE " ;
				$Rsql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media' and a.status=0 and b.master_id='$r[id]'";
				$Rrs=execute($Rsql);
				$Rrow=fetcharray($Rrs);
		 
				$Isql="select count(*) from lib_circulation_m a,lib_acc_details b WHERE " ;
				$Isql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type='$media' and a.status=0 and b.master_id='$r[id]'";
				$Irs=execute($Isql);
				$Irow=fetcharray($Irs);
	    
				$out=$Rrow[0]+$Irow[0];
				echo "<td align='center'>$out</td>";
				echo "<td align='center'>$r[key_word1]</td>";
				echo "</tr>";
			}
	}
?>
<script language="JavaScript">
	function first()
		{
			//alert("first");
			var i;
            i = 0;
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function prev()
		{
			//alert('<?=$PREV?>');
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
           // alert('<?=$LAST?>');
			var i;
            i = "<?=$LAST?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}

		function genexcel()
		{
			document.frm.action="GenerateEXCELFile.php";
			document.frm.submit();
		}
</script>
	<input type="hidden" name="submit1" value="<?=$submit1?>">
    <input type="hidden" name="val" value="<?=$val?>">
	<input type="hidden" name="title" value="<?=$title?>">
    <input type="hidden" name="keywords" value="<?=$keywords?>">
    <input type="hidden" name="subject" value="<?=$subject?>">
    <input type="hidden" name="acc_no" value="<?=$acc_no?>">
    <input type="hidden" name="publisher" value="<?=$publisher?>">
    <input type="hidden" name="author" value="<?=$author?>">
    <input type="hidden" name="attrib" value="<?=$attrib?>">
	<input type="hidden" name="media" value="<?=$media?>">
	<input type="hidden" name="subj" value="<?=$subj?>">
	<input type="hidden" name="searchtext" value="<?=$searchtext?>">
	<input type="hidden" name="SeekPos">
    <tr>
		<td colspan="13">
			<table align="center" border="0">
				<tr>
					<td title="First"><a href="Javascript:first()"><img src="../images/first.png" height="30"></a></td>
					<td title="Previous"><a href="Javascript:prev()"><img src="../images/previous.png" height="30"></a></td>
					<td title="Next"><a href="Javascript:next()"><img src="../images/next.png" height="30"></a></td>
					<td title="Last"><a href="Javascript:last()"><img src="../images/last.png" height="30"></a></td>
					
				</tr>
			</table>
		</td>
	 </tr>
	<tr>
		<td colspan="13" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
   </tr>
   <tr>
		<td colspan="13" align="center">For more details of particular book click on title.</td>
   </tr></table>
      
		<!--<p align="center"><input type="button" name="excel" value="Generate Excel" onClick="genexcel()"></p>-->
 
    <input type="hidden" name="id" value="<?=$id?>">
    <br>
<?php
}

?>

 </form>
</Body>
</HTML>