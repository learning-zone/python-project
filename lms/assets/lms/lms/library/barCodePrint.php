<?php
session_start();
require_once("../db1.php");

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "<pre>";
if($_POST)
{
	$sel=$_POST['sel'];
	$media=$_POST['media'];
	$library=$_POST['library'];
	$register=$_POST['register'];	
}
?>
<!DOCTYPE html>
<html>
<head>
<script language="JavaScript">
  function Print_barCode()
  {
	 prn.style.display="none";
	 window.print();
  }
</script>
<title>PRINT BARCODE</title>
</head>
<body>
<?


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

if($_REQUEST['Type']=="Print")
{   

	?>
 <table border="1" cellpadding="0" cellspacing="0" align="center">
    <tr>
    <?
	$n=sizeof($sel);		
	for($i=1;$i < $n;++$i)
	{			
		$val=$sel[$i];		
		$accNo=$_POST[$val.'accNo'];
		
		$url="MBIS LIB $acc_label$accNo";
		/////////////////////////////////////////
		if($_SESSION['p_text']==''){
			$_SESSION['p_text']=$url;
		}
		/////////////////////////////////////////
		$dest = "wrapper.php?p_text=$url";	
	    						
		?>
        	<td align="center">
             <BR><IMG SRC="<?php echo $dest;?>"><BR>*** <?=$url?> ***</td>          
         <?
		 		if($i%2==0)
				{
					?>
						</tr>
					<?
				}
		
	}
	?>
    </tr>
  </table>
    <?
}
?>
<p id="prn" align='center'><input type="button" class='bgbutton' value="Print" onClick="Print_barCode()" style="height:25px"/></p>
</body>
</html>

