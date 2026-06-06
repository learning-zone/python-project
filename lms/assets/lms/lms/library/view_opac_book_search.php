<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_GET)
{
	$media=$_REQUEST['media'];
	$title=$_REQUEST['title'];
	$author=$_REQUEST['author'];
	$classno=$_REQUEST['classno'];
	$publisher=$_REQUEST['publisher'];
	$subject=$_REQUEST['subject'];
	$acc_no=$_REQUEST['acc_no'];
	$SeekPos=$_GET['SeekPos'];
}
if($_POST)
{
	$media=$_POST['media'];
	$title=$_POST['title'];
	$author=$_POST['author'];
	$classno=$_POST['classno'];
	$publisher=$_POST['publisher'];
	$subject=$_POST['subject'];
	$acc_no=$_POST['acc_no'];
	$SeekPos=$_POST['SeekPos'];
}
//++++++++++++++++++++++++++++++++++++++++++++++
if($acc_no!='')
{
	$var=preg_split("/(\d+)/", $acc_no, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE); //split string into string and integer
	
	if($var[0]=='P') //PYP LIBRARY BOOK
	{
		$library=1;
		$register=1;
		$acc_no=$var[1];	
	}
	elseif($var[0]=='PT') //PYP TEXT BOOK
	{
		$library=1;
		$register=3;
		$acc_no=$var[1];
	}
	elseif($var[0]=='M') //MYP LIBRARY BOOK
	{	
		$library=2;
		$register=2;
		$acc_no=$var[1];
	}
	elseif($var[0]=='MT') //MYP TEXT BOOK
	{
		$library=2;
		$register=4;
		$acc_no=$var[1];	
	}else{
			die("<center><font color=#FF0000><blink>No Match Found...!!!</blink></font></center>");
	}
}
//++++++++++++++++++++++++++++++++++++++++++++++++

$_NUMREC_ = 15;

if(empty($SeekPos))
{
        $SeekPos = 0;
}
$sql="select distinct(a.id) from lib_book_details a,lib_acc_details b where b.mode='A' and a.id=b.master_id ";
if($acc_no=="")
{
	if($title !="")
	{
		$sql.=" and a.title like '%$title%'";
	}
	if($call!="")
	{
		$sql.=" and a.class_no='$call'";
	}
	if($author !="")
	{
		$sql.=" and a.author like '%$author%'";
	}
	if($publisher !="")
	{
		$sql.=" and a.publisher like '%$publisher%'";
	}
	if($subject!=0)
	{
		$sql.=" and a.subject='$subject'";
	}
	if($classno!="")
	{
		$sql.=" and a.class_no='$classno'";
	}
}
else
{
	 $sql.=" and  b.acc_no=".$acc_no." AND b.library='$library' AND b.register='$register'";
}

//echo "<BR>".$sql;

$rs = execute($sql) or die("<center><blink>No Media Found...!!!</blink></center>");
$row=rowcount($rs);
$countRS=rowcount($rs);
?>
<HTML>
<HEAD>
<TITLE>ADVANCE OPAC SEARCH FOR BOOKS</TITLE>
</HEAD>
<BODY>
<h4 align="center">ADVANCE OPAC SEARCH RESULTS FOR BOOK</h4>
<form name="frm" action="view_opac_book_search.php">
<table  align="left"  width="100%" class='forumline'>
<?php
if ($row >= 0 )
{
	?>
<tr>
	<td align="center"  class="head">Sl No.</td>
	<td align="center"  class="head">Accession No</td>
	<td align="left"  class="head">&nbsp;&nbsp;&nbsp;Title</td>
	<td align="left"  class="head">Author</td>
	<td align="center"  class="head">Media Type</td>
	<td align="center"  class="head">Call ID</td>
	<td align="center"  class="head">Publisher</td>
	<td align="center"  class="head">Copies</td>
	<td align="center"  class="head">Copies Out</td>
</tr>
	<?php
		if($row==0)
		{
			die("<tr height='40'><td colspan='9' align='center'>No Match Found</td></tr></table>");
		}
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
				if($acc_no==0)
				{
					$sql_qry="select a.*,b.* from lib_book_details a,lib_acc_details b where b.mode='A' and a.id=b.master_id and a.id=$r[id] ";		
				}
				else
				{
					$sql_qry="select a.*,b.* from lib_book_details a,lib_acc_details b where b.mode='A' and a.id=b.master_id and a.id=$r[id] and b.acc_no='$acc_no'";
					
				}		
				$rs_sql=execute($sql_qry);
				$r_sql=fetcharray($rs_sql);
				$rfv=execute("select * from lib_mediatype where id=$r_sql[media_type]");
				$rfvv=fetcharray($rfv);
				$library=$r_sql[library];
				$register=$r_sql[register];
				
				if($library==1 and $register==1){
					$dispAcc='P';
				}elseif($library==1 and $register==3){
					$dispAcc='PT';
				}elseif($library==2 and $register==2){
					$dispAcc='M';
				}elseif($library==2 and $register==4){
					$dispAcc='MT';
				}
				
	            echo "<tr>";
				$temp_val=strval($i)+1;
				echo "<td align='center'>$temp_val</td>";
				echo "<td align='center'>$dispAcc$r_sql[acc_no]</td>";
				echo "<td align='left'><a href='viewMedia.php?id=$r[id]&val=$val&title=$title&keywords$keywords&subject=$subject&acc_no=$acc_no&publisher=$publisher&author=$author&attrib=$attrib&SeekPos=$SeekPos'>$r_sql[title]</a>";
				echo"</td>";

				echo "<td>$r_sql[author]</td>";
				echo "<td align='center'>$rfvv[name]</td>";
				echo "<td align='center'>$r_sql[call_no]</td>";
				echo "<td align='center'>$r_sql[publisher]</td>";
				$sql1="select count(*) from lib_acc_details where mode='A' and master_id=$r[id]";
				$rs1=execute($sql1);
				$r1=fetcharray($rs1,0);

				echo "<td align='center'>$r1[0]</td>";
				$Rsql="select count(*) from lib_reference_media_trans a,lib_acc_details b WHERE " ;
				$Rsql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type=1 and a.status=0 and b.master_id='$r[id]'";
				$Rrs=execute($Rsql);
				$Rrow=fetcharray($Rrs);
		 
				$Isql="select count(*) from lib_circulation_m a,lib_acc_details b WHERE " ;
				$Isql.=" b.mode='A' and a.acc_id=b.acc_no and a.media_type=1 and a.status=0 and b.master_id='$r[id]'";
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
			//alert("first");
			var i;
            i = 0;
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function prev()
		{
			//alert("prev");
			var i;
            i = "<?=$PREV?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
    function next()
		{
			//alert("next");
		    var i;
            i = "<?=$NEXT?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function last()
		{
            //alert("last");
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
    <input type="hidden" name="SeekPos">
    <tr>
		<td colspan="9">
			<table align="center">
				<tr>
	                <td title="Previous"><a href="Javascript:prev()"><</td>
	                <td title="Next"><a href="Javascript:next()">></td>
	                <td title="Last"><a href="Javascript:last()">>></td>
				</tr>
			</table>
		</td>
	 </tr>
	<tr>
		<td colspan="9" align="center">Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?></td>
   </tr>
   <tr>
		<td colspan="9" align="center">For more details of particular book click on title.</td>
   </tr>
</table>
<input type="hidden" name="id" value="<?=$id?>">
</td></tr></table>
</form>
</Body>
</HTML>