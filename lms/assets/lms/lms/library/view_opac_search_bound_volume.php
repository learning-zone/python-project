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

$_NUMREC_ = 15; // Number of result per page;
if(empty($SeekPos))
	{
        $SeekPos = 0;
	}
$sql="select distinct(a.id) from lib_bound_media_det a,lib_bound_acc_det b where b.mode='A' and a.id=b.master_id ";
if($acc_no =="")
{
	if($title !="")
	{
		$sql.=" and (a.title like '%".$title."%')";
	}


	if($month!="")
	{
			$sql.=" and( a.month = '".$month."')";
	}
	if($year!="")
	{
			$sql.=" and( a.year = '".$year."')";
	}

	if($keywords !="")
	{
		$sql.=" and (a.key_word1 like '%".$keywords."%' or a.key_word2 like '%".$keywords."%' or a.key_word3 like '%".$keywords."%' or a.key_word4 like '%".$keywords."%' or a.key_word5 like '%".$keywords."%')";
	}
}
else
{

 $sql.=" and  b.acc_no=".$acc_no."";

}
//$sql.=")";

$rs = execute($sql) or die("No Media Found");
$row=rowcount($rs);
$countRS=rowcount($rs);
?>
</head>
<BODY>

<h2 align="center"><b><font color="#000099" size="5">Advance OPAC Search Results</font></b></h2>
<form name="frm" action="view_opac_search_bound_volume.php">

<table  align="left" class='forumline' width="100%" >
<?php

if ($row >= 0 )
{
	?>
	<tr>
	<td align="center"  class="head">Sl no.</td>
	<td align="center"  class="head">Title</td>
	<td align="center"  class="head">Month</td>
	<td align="center"  class="head">Year</td>
	<td align="center"  class="head">Date of Acquiring </td>
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
				<a href="../library/advance_opac_search_bound_volume.php?media=True" ><b><font face="Times New Roman" size="5" color="#8572D3">Go Back</font></b></a>
				</div>
				</td></tr>
		</table>
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
		  $sql_qry="select a.*,b.bound_type,b.register from lib_bound_media_det a,lib_bound_acc_det b where b.mode='A' and a.id=b.master_id and a.id=$r[id] ";

		  $rs_sql=execute($sql_qry);
		  $r_sql=fetcharray($rs_sql);

		echo "<tr>";
		$temp_val=strval($i)+1;
		echo "<td > $temp_val </td>";
		echo "<td align='left'  >";
		echo "<a href='view_bound_volume_details.php?id=$r[id]&title=$title&month=$month&year=$year&keywords=$keywords&acc_no=$acc_no&val=$val&SeekPos=$SeekPos'>$r_sql[title]</a>";
		echo"</td>";


		echo "<td > $r_sql[month]</td>";
		echo "<td > $r_sql[year]</td>";
		echo "<td > $r_sql[date_of_acquiring]</td>";
		$sql1="select count(*) from lib_bound_acc_det where mode='A' and master_id=$r[id]";

		$rs1=execute($sql1);
		$r1=fetcharray($rs1,0);

		echo "<td > $r1[0]</td>";

		$sql = "SELECT count(a.id) as out  FROM lib_circulation_m a,lib_bound_media_det b WHERE " ;
		$sql .= " b.mode='A' and a.acc_id=b.acc_no and a.status=0 and  b.id=".$r["id"];

		$rs2 = execute($sql);
		if($rs2)
		{
			$row= rowcount($rs2);
			if($row!=0)
			{
				$r2 = fetcharray($rs2,0);
				$out = $r2["out"];
			}
			else
			{
				$out=0;
			}
		}
		else
		{
			$out=0;
		}



		echo "<td > $out</td>";
		echo "</tr>";
	}

}

?>
<!--</table>-->

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

    <input type="hidden" name="attrib" value="<?=$attrib?>">
    <input type="hidden" name="title" value="<?=$title?>">
	    <input type="hidden" name="keywords" value="<?=$keywords?>">
<input type="hidden" name="acc_no" value="<?=$acc_no?>">
<input type="hidden" name="month" value="<?=$month?>">
    <input type="hidden" name="year" value="<?=$year?>">
    <input type="hidden" name="issue" value="<?=$issue?>">
    <input type="hidden" name="volume" value="<?=$volume?>">

    <input type="hidden" name="media_type" value="<?=$media_type?>">




    <input type="hidden" name="SeekPos">
       <tr>
       	<td colspan="8">
       	<table align="center">
        	<tr>
        	<td >
             <a href="Javascript:first()"><img src="../images/firstbtn.gif" border="0"   alt="First">                   </a>
            </td>
            <td >
                <a href="Javascript:prev()"><img src="../images/previousbtn.gif" border="0"   alt="Previous">  </a>
            </td>
            <td >
                <a href="Javascript:next()">
                <img src="../images/nextbtn.gif" border="0"
                alt="Next" onMouseOver="Javascript:status='Next Page';">  </a>
            </td>
            <td >
                <a href="Javascript:last()">
                <img src="../images/lastbtn.gif" border="0"
                alt="Last" onMouseOver="Javascript:status='Last Page';"> </a>
            </td>
       </tr>


       </td>
       </tr>
       <tr>
       <td colspan="8" align="center">

	   <b>
	   Page <?= ($SeekPos / $_NUMREC_) +1?> of <?=(int) $PAGES?>
	   </b>

		</td>
		</tr>
</table>
    <input type="hidden" name="id" value="<?=$id?>">
<br>
<table align='right'>
<tr><td>
<div align='right'>
<a href="library/advance_opac_search_bound_volume.php?media=True" ><b><font face="Times New Roman" size="5" color="#8572D3">Go Back</font></b></a>
</div>
</td>
</tr>
</table>
</form>
</Body>
</HTML>