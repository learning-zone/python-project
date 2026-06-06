<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "<pre>";*/

if($_POST)
{
	$subj=$_POST['subj'];
	$media=$_POST['media'];
	$SeekPos=$_POST['SeekPos'];
	$library=$_POST['library'];
	$register=$_POST['register'];	
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script language="javascript">
function Submit_onClick()
{
	document.frm.action="barCode.php?Type=Submit";
	document.frm.submit();
}
</script>
<script language="javascript">
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}
</script>
<script language="javascript">
function Generate_barCode()
{
	document.frm.action="barCodePrint.php?Type=Print";
	document.frm.submit();
}
</script>
</head>
<body>
<form name="frm" method="POST">
<table class=forumline width="90%" cellspacing="2" cellpadding="2" align='center' border="0">
<tr><td align='center' Class='head' colspan='6'>GENERATE BARCODE</td></tr>
<tr height='30'>
		<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;Select Media</td>
		<td align="left">
        <select name='media'>
        <option value='0'>-- Select Media --</option>
		 <?php
             $sqlM=execute("SELECT * FROM lib_mediatype");
              while($r=fetcharray($sqlM))
              {
                  if($media==$r[id])
                    echo "<option value='$r[id]' selected>$r[name]</option>";
                  else
                    echo "<option value='$r[id]' >$r[name]</option>";
              }
         ?>
        </select>
		</td>
    <td align="center">Library &nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
    <select size="1" name="library" onChange="javascript:document.frm.submit()">
    <option value=''>-- Select Library --</option>
	  <?php
      $sqlL=execute("SELECT * FROM library_name");
          while($r=fetcharray($sqlL))
          {
              if($library==$r[id])
              	echo "<option value='$r[id]' selected>$r[name]</option>";
              else
              	echo "<option value='$r[id]' >$r[name]</option>";
          }
      ?>
    </select>
    </td>
      <td align="center">Register &nbsp;&nbsp;</td>
      <td>
        <select name="register" onChange="javascript:document.frm.submit()">
        <option value=''>-- Select Register --</option>
        <?php
          $sqlR=execute("SELECT * FROM lib_register WHERE library=$library");
          while($r=fetcharray($sqlR))
          {
              if($register==$r[id])
              	echo "<option value='$r[id]' selected>$r[register]</option>";
              else
              	echo "<option value='$r[id]' >$r[register]</option>";
          }
      ?>
        </select>
    </td>
</tr>
<tr>
	<td colspan="6">&nbsp;</td>
</tr>
<!--<tr>
	<td align="center">&nbsp;&nbsp;Accession No</td>
    <td>&nbsp;&nbsp;From</td>
    <td><input type="text" name="" value=""></td>
    <td align="center">To</td>
    <td colspan="2"><input type="text" name="" value=""></td>
 </tr>
<tr>
	<td colspan="6">&nbsp;</td>
</tr>-->
</table>
<p align="center">
<input type='button' name='Search' value='Search' class='bgbutton' onClick="Submit_onClick()">
</p>
<?PHP
if($_REQUEST['Type']=="Submit")
{
	
$_NUMREC_ = 15; 
if(empty($SeekPos))
{
  $SeekPos = 0;
}
if($media==1)
{
	$m='Book';
}
if($media==2)
{
	$m='CD/DVD';
}
if($media==5)
{
	$m='Project Report';
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
<table class=forumline width="98%" cellspacing="2" cellpadding="2" align='center' border="0">
<tr>
	<td align='center' Class='head' colspan='9'>GENERATE BARCODE</td>
</tr>
<?php
if ($row >= 0 )
{
	
	?>
	<tr>
	<td Class="rowpic" align="center" nowrap width="50px">Sl No</td>
	<td class='rowpic' align="left" nowrap >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title</td>
	<td class='rowpic' nowrap>Author</td>
	<td class='rowpic' align="center" nowrap>Edition</td>
	<td class='rowpic' align="center" nowrap>Publisher</td>
	<td class='rowpic' align="center" nowrap>Year</td>
	<td class='rowpic' align="center" nowrap>Library</td>
	<td class='rowpic' align="center" nowrap>Register</td>
	<td class='rowpic' align="center" nowrap><div class="head" id="checkAll" 
	onClick="selectMe()" Title="Click to Select all">All<input type="checkbox"></div></td>
	</tr>
	<?php
		if($row==0)
		{
		?>
		</table>
		<table align='right'>
		<tr>
		<td>
		</td></tr>
		</table>
		<?php
		die("No Media Found");
		}
		
		
		$libraryName=fetcharray(execute("SELECT `name` FROM library_name WHERE id='$library'"));
		$registerName=fetcharray(execute("SELECT `register` FROM lib_register WHERE library='$register'"));
		
		$rowclass=1;
			//data_seek($rs,$SeekPos);
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
				
				$temp_val=strval($i)+1;
			
			if($i%2)
				echo "<tr class='clsname'>";
			else
				echo "<tr>";
				
				if($temp_val<10)
			        $temp_val="0".$temp_val;
					
					
	  $m_id=fetcharray(execute("SELECT `id` FROM `lib_book_details` WHERE `title`='$r[title]' LIMIT 1"));
	  
	  //echo "<BR>".$m_id['id'];
	if($m_id['id']!='')
	{

//echo "<br>SELECT `acc_no` FROM `lib_acc_details` WHERE `master_id`='$m_id[id]' GROUP BY `master_id`";
$accNo=fetcharray(execute("SELECT `acc_no` FROM `lib_acc_details` WHERE `master_id`='$m_id[id]' GROUP BY `master_id`"));	

	}
	//echo "<BR>".$accNo['acc_no'];
	        
			?>
			<tr>	
				<td align='center'><?=$temp_val?></td>
				<td align='left'><?=$r['title']?></td>
                <td align='left'><?=$r['author']?></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;<?=$r['publisher']?></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$r['edition']?></td>
				<td align='center'>&nbsp;&nbsp;<?=$r[year]?></td>
                <td align='center'><?=$libraryName['name']?></td>
                <td align='center'><?=$registerName['register']?></td>
                <td align='center'><input type="checkbox" name="sel[]" value="<?=$r['id']?>"></td>
                <input type="hidden" name="<?=$r['id']?>accNo" value="<?=$r['id']?>">
                
			<?				
		        $rowclass = 1 - $rowclass;
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
			<table align="center">
				<tr>
					<td title="First"><a href="Javascript:first()"> &nbsp; << &nbsp; </td>
					<td title="Previous"><a href="Javascript:prev()">&nbsp; < &nbsp;</td>
					<td title="Next"><a href="Javascript:next()"> &nbsp; > &nbsp; </td>
					<td title="Last"><a href="Javascript:last()"> &nbsp; >> &nbsp;</td>
					
				</tr>
			</table>
		</td>
	 </tr>
	<tr>
		<td colspan="13" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
   </tr>
 </table>
    <input type="hidden" name="id" value="<?=$id?>">
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
<table class=forumline width="90%" cellspacing="2" cellpadding=2 align='center' border=0>
<?php
if ($row >= 0 )
{
	?>
	<tr>
	<td class='head'>Sl No</td>
	<td class='head'>&nbsp;&nbsp;&nbsp;Title</td>
	<td class='head'>Author</td>
	<td class='head' align="center">Copies In</td>
	<td class='head' align="center">Copies Out</td>
	<td class='head' align="center">Key 1</td>
	<td class='head' align="center">Key 2</td>
	<td class='head' align="center">Key 3</td>
	<td class='head' align="center">Key 4</td>
	<td class='head' align="center">Key 5</td>
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
			<table align="center">
				<tr>
					<td title="First"><a href="Javascript:first()"><<</td>
					<td title="Previous"><a href="Javascript:prev()"><</td>
					<td title="Next"><a href="Javascript:next()">></td>
					<td title="Last"><a href="Javascript:last()">>></td>
				</tr>
			</table>
		</td>
	 </tr>
	<tr>
		<td colspan="13" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
   </tr>
</table>
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
<table class=forumline width="100%" cellspacing="2" cellpadding=2 align='center' border=0>
<?php
if ($row >= 0 )
{
	?>
	<tr>
	<td class='head'>Sl No</td>
	<td class='head'>&nbsp;&nbsp;Title</td>
	<td class='head'>Author</td>
	<td class='head' align="center">Copies In</td>
	<td class='head' align="center">Copies Out</td>
	<td class='head' align="center">Key 1</td>
	<td class='head' align="center">Key 2</td>
	<td class='head' align="center">Key 3</td>
	<td class='head' align="center">Key 4</td>
	<td class='head' align="center">Key 5</td>
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
					<td title="First"><a href="Javascript:first()"><<</td>
					<td title="Previous"><a href="Javascript:prev()"><</td>
					<td title="Next"><a href="Javascript:next()">></td>
					<td title="Last"><a href="Javascript:last()">>></td>
				</tr>
			</table>
		</td>
	 </tr>
	<tr>
		<td colspan="13" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
   </tr>
></table>


    <input type="hidden" name="id" value="<?=$id?>">
    <br>
	<?php
	}
?>
<p align='center'><input type="button" class='bgbutton' value="Generate BarCode" onClick="Generate_barCode()" style="height:25px"/></p>
<?
}
?>

</form>
</body>
</html>