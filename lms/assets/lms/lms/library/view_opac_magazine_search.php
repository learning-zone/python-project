<?php
require_once("../db.php");
$media=$_REQUEST['media'];
$id=$_REQUEST['id'];
$media_type=$_REQUEST['media_type'];
$type=$_REQUEST['type'];
$type1=$_REQUEST['type1'];
$val=$_POST['val'];
$title=$_POST['title'];
$subject=$_POST['subject'];
$keywords=$_POST['keywords'];
$volume=$_POST['volume'];
$issue=$_POST['issue'];
$articles=$_POST['articles'];
$month=$_POST['month'];
$year=$_POST['year'];
$acc_no=$_POST['acc_no'];
$attrib=$_POST['attrib'];
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
if($type1=="M")
{
$sql="select distinct(a.id) from lib_magazine a,lib_magazine_subscription b where a.magazine_sub_no=b.id and a.magazine_no like 'M%'";
}
else if($type1=="J")
{
$sql="select distinct(a.id) from lib_magazine a,lib_magazine_subscription b where a.magazine_sub_no=b.id and a.magazine_no like 'J%' ";
}
if($acc_no =="")
{
	if($title !="")
	{
		$sql.=" and a.title like '%$title%'";
	}

	if($subject !="")
	{
		$sql.=" and a.subject='$subject'";
	}
	if($keywords !="")
	{
	$sql= " and a.keywords='$keywords'";
	}
	if($volume !="")
	{
		$sql.=" and a.volume='$volume'";
	}
	if($issue !="")
	{
		$sql.=" and a.issue='$issue'";
	}
	if($month !="")
	{
		$sql.=" and a.month='$month'";
	}
	if($year !="")
	{
		$sql.=" and a.year='$subject'";
	}
	if($articles !="")
	{
		$sql.=" and a.articles1='$articles' or a.articles2='$articles'";
	}
}
else
{
 $sql.=" and  a.magazine_no='$acc_no'";
}
$rs = execute($sql) or die("No Media Found");
$row=rowcount($rs);
$countRS=rowcount($rs);
?>

<?
if($type1=="M")
	{
		?>
		<h4 align="center">OPAC Search for Magazine</h4>
		<?
	}
if($type1=="J")
{
	?>
	<h4 align="center">OPAC Search for Journal</h4>
	<?
}
?>
</h2>
<HTML>
<HEAD></HEAD>
<BODY>
<form name="frm" action="view_opac_magazine_search.php">

<table  align="left" class='forumline' width="100%" >
<?php

if ($row >= 0 )
{
	?>
	<tr>
	<td align="center"  class="head">Sl no.</td>
	<td align="center"  class="head">Magazine No.</td>
	<td align="center"  class="head">Title</td>
	<td align="center"  class="head">Rack</td>
	<td align="center"  class="head">Subject</td>
	<td align="center"  class="head">Articles</td>
	<td align="center"  class="head">Magazine Date</td>
	<td align="center"  class="head">Status</td>

	</tr>
<?php
		if($row==0)
		{
		?>
						</table>
						<br><br>
						<p align="center"><a href="../library/advance_opac_search_magazine.php?media=True" >Go Back</a></p>
				
		<?
		die("No Media Found");
		}
	  //data_seek($rs,$SeekPos); //Move the data pointer to the next position.
	   mysql_data_seek($rs,$SeekPos); 

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
		  if($type1=="M")
			{
		      $sql_qry="select a.*,b.* from lib_magazine a,lib_magazine_subscription b where a.magazine_sub_no=b.id and a.id=$r[id] and a.magazine_no like 'M%'";
			}
		  elseif($type1=="J")
			{
		      $sql_qry="select a.*,b.* from lib_magazine a,lib_magazine_subscription b where a.magazine_sub_no=b.id and a.id=$r[id] and a.magazine_no like 'J%'";
			}
		  }
		  if($acc_no!=0)
		  {
			  if($type1=="M")
			{
		      $sql_qry="select a.*,b.* from lib_magazine a,lib_magazine_subscription b where a.magazine_sub_no=b.id and a.id=$r[id] and a.magazine_no like 'M%' and a.magazine_no='$acc_no'";
			}
		  elseif($type1=="J")
			{
		      $sql_qry="select a.*,b.* from lib_magazine a,lib_magazine_subscription b where a.magazine_sub_no=b.id and a.id=$r[id] and a.magazine_no like 'J%' and a.magazine_no='$acc_no'";
			}
		  }
		  $rs_sql=execute($sql_qry);
		  $r_sql=fetcharray($rs_sql);

		echo "<tr>";
		$temp_val=strval($i)+1;
		echo "<td align='center'>$temp_val</td>";
		echo "<td align='center'>$r_sql[magazine_no]</td>";
		echo "<td align='left'>$r_sql[title]</td>";


		echo "<td align='center'>$r_sql[rack]</td>";
		echo "<td align='left'>$r_sql[subject]</td>";
		echo "<td align='center'>$r_sql[articles1]<br>$r_sql[articles2]</td>";
		if($r_sql[magazine_date] !='00-00-0000')
		{
			$mag_date=explode("-",$r_sql[magazine_date]);
			echo "<td align='center'> $mag_date[2]-$mag_date[1]-$mag_date[0]</td>";
		}
		else
		{
		echo "<td > ---</td>";
		}
		if($r_sql[flag]==1)
			$qq="Issued";
		else
			$qq="Avialable";
		echo "<td align='center'>$qq</td>";
		echo "</tr>";
	}

}

?>

      <script language="JavaScript">
         function first(){

           var i;
           i = 0;

           document.frm.SeekPos.value = i;
           document.frm.submit();


         }

         function prev(){

           var i;
           i = "<?=$PREV?>";

           document.frm.SeekPos.value = i;
           document.frm.submit();


         }

         function next(){

           var i;
           i = "<?=$NEXT?>";

           document.frm.SeekPos.value = i;
           document.frm.submit();


         }



         function last(){

           var i;
           i = "<?=$LAST?>";

           document.frm.SeekPos.value = i;
           document.frm.submit();



         }
</script>

  <!--<table width="100%" border="1" cellspacing="0" cellpadding="0" >-->

  <input type="hidden" name="submit1" value="<?=$submit1?>">
    <input type="hidden" name="val" value="<?=$val?>">
    <input type="hidden" name="title" value="<?=$title?>">
    <input type="hidden" name="keywords" value="<?=$keywords?>">
    <input type="hidden" name="subject" value="<?=$subject?>">
    <input type="hidden" name="month" value="<?=$month?>">
    <input type="hidden" name="year" value="<?=$year?>">
    <input type="hidden" name="issue" value="<?=$issue?>">
    <input type="hidden" name="volume" value="<?=$volume?>">
  
    <input type="hidden" name="type1" value="<?=$type1?>">			
    <input type="hidden" name="attrib" value="<?=$attrib?>">
    <input type="hidden" name="SeekPos">
       <tr>
       	<td colspan="8">
       	<table align="center">
        	<tr>
        	<!--<td >
             <a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First">                   </a>
            </td>
            <td >
                <a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous">  </a>
            </td>
            <td >
                <a href="Javascript:next()"><img src="../images/nextbtn.gif" border="0"
                alt="Next" onMouseOver="Javascript:status='Next Page';">  </a>
            </td>
            <td >
                <a href="Javascript:last()">
                <img src="../images/lastbtn.gif" border="0"
                alt="Last" onMouseOver="Javascript:status='Last Page';"> </a>
            </td>-->
			     <td title="First"><a href="Javascript:first()"><<</td>
	             <td title="Previous"><a href="Javascript:prev()"><</td>
	             <td title="Next"><a href="Javascript:next()">></td>
	             <td title="Last"><a href="Javascript:last()">>></td>
       </tr>


       </td>
       </tr>
       <tr>
       <td colspan="8" align="center">

	   
	   Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?>
	   

		</td>
		</tr>
</table>
    <input type="hidden" name="id" value="<?=$id?>">

<p align="center"><a href="../library/advance_opac_search_magazine.php?media=True&type=M" >Go Back</a></p>
</form>
</Body>
</HTML>


