<?php
session_start();
require("core.php");
include("../db1.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "<pre>";*/

if($_POST)
{
	$Type="";
	$media=$_POST['media'];
	$acc_to=$_POST['acc_to'];
	$SeekPos=$_POST['SeekPos'];
	$library=$_POST['library'];
	$acc_from=$_POST['acc_from'];
}


/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxXXXXXXXXxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/

if($acc_to!='' && $acc_from!='')
{
	$var_t=preg_split("/(\d+)/", $acc_to, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE); //split string into string and integer
	$var_f=preg_split("/(\d+)/", $acc_from, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE); 
	
	
	if($var_t[0]=='P' && $var_f[0]=='P') //PYP LIBRARY BOOK
	{
		$library=1;
		$register=1;
		$acc_to=$var_t[1];
		$acc_from=$var_f[1];	
	}
	elseif($var_t[0]=='PT' && $var_f[0]=='PT') //PYP TEXT BOOK
	{
		$library=1;
		$register=3;
		$acc_to=$var_t[1];
		$acc_from=$var_f[1];
	}
	elseif($var_t[0]=='M' && $var_f[0]=='M') //MYP LIBRARY BOOK
	{	
		$library=2;
		$register=2;
		$acc_to=$var_t[1];
		$acc_from=$var_f[1];
	}
	elseif($var_t[0]=='MT' && $var_f[0]=='MT') //MYP TEXT BOOK
	{
		$library=2;
		$register=4;
		$acc_to=$var_t[1];	
		$acc_from=$var_f[1];
	}else{
			die("<center><font color=#FF0000><blink>No Match Found...!!!</blink></font></center>");
	}
 }

/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
  if($library==1 and $register==1){ //PYP LIBRARY BOOK
	  $acc_label='P';
  }
  if($library==1 and $register==3){  //PYP TEXT BOOK  
	  $acc_label='PT';
  }
  if($library==2 and $register==2){ //MYP LIBRARY BOOK  
	  $acc_label='M';
  }
  if($library==2 and $register==4){ //MYP TEXT BOOK 
	  $acc_label='MT';
  }
?>
<html>
<head>
<script language="JavaScript">
function prn()
{
	prn1.style.display = "none";
	prn2.style.display = "none";
	window.print(this.form);
	prn1.style.display = "";
	prn2.style.display = "";
}
</script>
<title>LIBRARY_BARCODE_<?=date("d-M-Y")?>_<?=date("H:i:s")?></title>
</head>

<?php

$_NUMREC_ = 48; 
if(empty($SeekPos))
{
        $SeekPos = 0;
}
?>
<form name='frm' method='POST'>
<?
	if($var_t[0]=='MT' && $var_f[0]=='MT')
	{
		?>
  <table border='0' align='center' cellspacing='0' cellpadding='30' width='100%'>
<?php

if($media==1)
{
	$sel = "SELECT a.acc_no,a.call_no,a.register,a.master_id,b.author FROM lib_acc_details a,lib_book_details b where a.acc_no between $acc_from AND $acc_to AND a.library='$library' AND a.mode='A' AND a.master_id=b.id GROUP BY acc_no";
}
if($media==2 || $media==4)
{
	$sel = "SELECT a.acc_no,a.call_no,a.register,a.master_id,b.author FROM lib_cd_acc_det a,lib_cd_det b where a.acc_no between $acc_from AND $acc_to AND a.library='$library' AND a.mode='A' AND a.master_id=b.id ";
}
if($media==3)
{
	$sel = "SELECT a.acc_no,a.call_no,a.register,a.master_id FROM lib_floppy_acc_det a,lib_floppy_det b where a.acc_no between $acc_from AND $acc_to AND a.library='$library' AND a.mode='A' AND a.master_id=b.id";
}
if($media==5)
{
	$sel = "SELECT acc_no,call_no,register FROM lib_proj_acc_det where acc_no between $acc_from AND $acc_to AND library='$library' AND mode='A'";
}
$res1 = @execute($sel);
$num1 = rowcount($res1);
if($num1==0)
{
	echo "No records Found";
}
else
{
	  mysql_data_seek($res1,$SeekPos);

	  if( ($SeekPos + $_NUMREC_) > $num1)
	  {
		  $MAX = $num1;
	  }
	  else
	  {
		  $MAX = $SeekPos + $_NUMREC_ ;
	  }
		
	  if( ($SeekPos + $_NUMREC_) >= $num1)
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
	 $PAGES = $num1 / $_NUMREC_;
	 if($num1 % $_NUMREC_)
	 {
		  $PAGES++;
	 }
	 $LAST = ((int) $PAGES - 1) * $_NUMREC_;
	$count=0;
		echo "<tr>";
	for($i=$SeekPos;$i<$MAX;$i++)
	{

		$count = $count + 1;
		
		$row1 = fetcharray($res1);
		$reg = execute("SELECT register FROM lib_register where id='$row1[register]'");
		$reg_row = fetcharray($reg);
		$acc_no = $row1[acc_no];
		
		$url="$acc_label$acc_no";
		/////////////////////////////////////////
		if(!$_SESSION['p_text']){
			$_SESSION['p_text']=$url;
		}
		/////////////////////////////////////////
		$dest = "wrapper.php?p_text=$url";	
		
/*		$p_textEnc = strtoupper(rawurlencode($acc_no));

		$dest = "wrapper.php?p_bcType=1&p_text=$p_textEnc" . 
				"&p_xDim=1&p_w2n=3&p_charGap=2&p_invert=N&p_charHeight=30" .
				"&p_type=1&p_label=Y&p_rotAngle=0&p_checkDigit=N";*/

		$author = substr("$row1[author]",0,3);
		$classification_no = $row1[classification_no];
		
	
		?>	
			<td align='center'>
				SAMPLE - Bangalore<BR>
                    <?=$acc_label.$acc_no?><BR>
				<img style="width: 75.0000mm;" SRC='<?=$dest?>' border="0"><BR>
                    <div align="center" title="<?=$row1[author]?>"><?=$classification_no?>&nbsp;&nbsp;<?=$author?></div>
					
			</td>
		<?php
			if($count==4)
			{
				echo "</tr>";
				$count=0;
			}
	}
	?>
		</table>
    <?
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
  <input type="hidden" name="SeekPos">
  <input type="hidden" name="library" value='<?php echo $library ?>'>		
  <input type="hidden" name="acc_from" value='<?php echo $var_f[0].$acc_from ?>'>		
 <input type="hidden" name="acc_to" value='<?php echo $var_t[0].$acc_to ?>'>			
  <input type="hidden" name="media" value='<?php echo $media ?>'>
  </form>
<div id='prn1'>
<table align="center">
		<tr>
            <td title="First"><a href="Javascript:first()"> &nbsp; << &nbsp; </td>
            <td title="Previous"><a href="Javascript:prev()">&nbsp; < &nbsp;</td>
            <td title="Next"><a href="Javascript:next()"> &nbsp; > &nbsp; </td>
            <td title="Last"><a href="Javascript:last()"> &nbsp; >> &nbsp;</td>
		</tr>
</table>

</div>
<div align="right">
		Page <?php echo ($SeekPos / $_NUMREC_)+1?> of <?php echo (int) $PAGES?></div>
<br>	

<div id="prn2" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="prn()" style="width:70px; height:22px"></div>
		
		
		<?
	}
	else
	{

?>
<table border='0' align='center' cellspacing='0' cellpadding='30' width='100%'>
<?php

if($media==1)
{
	$sel = "SELECT a.acc_no,a.call_no,a.register,a.master_id,b.author FROM lib_acc_details a,lib_book_details b where a.acc_no between $acc_from AND $acc_to AND a.library='$library' AND a.mode='A' AND a.master_id=b.id GROUP BY acc_no";
}
if($media==2 || $media==4)
{
	$sel = "SELECT a.acc_no,a.call_no,a.register,a.master_id,b.author FROM lib_cd_acc_det a,lib_cd_det b where a.acc_no between $acc_from AND $acc_to AND a.library='$library' AND a.mode='A' AND a.master_id=b.id ";
}
if($media==3)
{
	$sel = "SELECT a.acc_no,a.call_no,a.register,a.master_id FROM lib_floppy_acc_det a,lib_floppy_det b where a.acc_no between $acc_from AND $acc_to AND a.library='$library' AND a.mode='A' AND a.master_id=b.id";
}
if($media==5)
{
	$sel = "SELECT acc_no,call_no,register FROM lib_proj_acc_det where acc_no between $acc_from AND $acc_to AND library='$library' AND mode='A'";
}
$res1 = @execute($sel);
$num1 = rowcount($res1);
if($num1==0)
{
	echo "No records Found";
}
else
{
	  mysql_data_seek($res1,$SeekPos) or die(mysql_error());

	  if( ($SeekPos + $_NUMREC_) > $num1)
	  {
		  $MAX = $num1;
	  }
	  else
	  {
		  $MAX = $SeekPos + $_NUMREC_ ;
	  }
		
	  if( ($SeekPos + $_NUMREC_) >= $num1)
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
	 $PAGES = $num1 / $_NUMREC_;
	 if($num1 % $_NUMREC_)
	 {
		  $PAGES++;
	 }
	 $LAST = ((int) $PAGES - 1) * $_NUMREC_;
	$count=0;
		echo "<tr>";
	for($i=$SeekPos;$i<$MAX;$i++)
	{

		$count = $count + 1;
		
		$row1 = fetcharray($res1);
		$reg = execute("SELECT register FROM lib_register where id='$row1[register]'");
		$reg_row = fetcharray($reg);
		$acc_no = $row1[acc_no];
		
		$url="$acc_label$acc_no";
		/////////////////////////////////////////
		if(!$_SESSION['p_text']){
			$_SESSION['p_text']=$url;
		}
		/////////////////////////////////////////
		$dest = "wrapper.php?p_text=$url";	
		
/*		$p_textEnc = strtoupper(rawurlencode($acc_no));

		$dest = "wrapper.php?p_bcType=1&p_text=$p_textEnc" . 
				"&p_xDim=1&p_w2n=3&p_charGap=2&p_invert=N&p_charHeight=30" .
				"&p_type=1&p_label=Y&p_rotAngle=0&p_checkDigit=N";*/

		$author = substr("$row1[author]",0,3);
		$classification_no = $row1[classification_no];
		
	
		?>	
			<td align='center'>
				SAMPLE - Bangalore<BR>
                    <?=$acc_label.$acc_no?><BR>
				<img style="width: 75.0000mm;" SRC='<?=$dest?>' border="0"><BR>
                    <div align="center" title="<?=$row1[author]?>"><?=$classification_no?>&nbsp;&nbsp;<?=$author?></div>
					
			</td>
		<?php
			if($count==4)
			{
				echo "</tr>";
				$count=0;
			}
	}
	?>
		</table>
    <?
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
  <input type="hidden" name="SeekPos">
  <input type="hidden" name="library" value='<?php echo $library ?>'>		
  <input type="hidden" name="acc_from" value='<?php echo $var_f[0].$acc_from ?>'>		
 <input type="hidden" name="acc_to" value='<?php echo $var_t[0].$acc_to ?>'>			
  <input type="hidden" name="media" value='<?php echo $media ?>'>
  </form>
<div id='prn1'>
<table align="center">
		<tr>
            <td title="First"><a href="Javascript:first()"> &nbsp; << &nbsp; </td>
            <td title="Previous"><a href="Javascript:prev()">&nbsp; < &nbsp;</td>
            <td title="Next"><a href="Javascript:next()"> &nbsp; > &nbsp; </td>
            <td title="Last"><a href="Javascript:last()"> &nbsp; >> &nbsp;</td>
		</tr>
</table>

</div>
<div align="right">
		Page <?php echo ($SeekPos / $_NUMREC_)+1?> of <?php echo (int) $PAGES?></div>
<br>	

<div id="prn2" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="prn()" style="width:70px; height:22px"></div>
<?
 }
?>