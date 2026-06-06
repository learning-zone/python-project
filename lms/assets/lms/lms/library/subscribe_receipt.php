<?php
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
session_start();
require_once("../db.php");
if($_POST)
{
    $jmsub=$_POST['jmsub'];
		
}
if($_GET)
{

}
if($msg!='')
{
	?>
    	<script language="JavaScript">
		    alert('<?=$msg?>');
		</script>
    <?
}
?>
<html>
<head>
<Script language="JavaScript">
function frmsubmit()
{
	document.frm.submit();
}
function reloadMe()
{
	document.frm.action="subscribe_receipt.php";
	document.frm.submit();
}
</script>
<script language="javascript">
function OpenWind2(URL,title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank,titlebar=no,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
</head>
<body>
<div>
<?php
if($jmsub==1)
{
	$sel1="selected";
	$sel2="";
	$sel3="";
}
else if($jmsub==2)
{
	$sel1="";
	$sel2="selected";
	$sel3="";
}
else if($jmsub==3)
{
	$sel1="";
	$sel2="";
	$sel3="selected";
}
?>
<form method="POST" name="frm" action="subscribe_receipt.php">
<table class='forumline' align='center' width="47%" border="1">
<tr>
   <br/><td class='head' colspan='2' align='center'>Subscription Receipt Details</td>
</tr>
<tr>
   <td align="right">Subscription Type&nbsp;&nbsp;&nbsp;</td>
   <td><select name='jmsub' onchange='frmsubmit()'>
   <?php
     echo "<option value=0>--Select Subscrition Type--</option>";
     echo "<option value=1 $sel1>Journals Subscription</option>";
     echo "<option value=2 $sel2>Magazine Subscription</option>";
     echo "<option value=3 $sel3>News Paper Subscription</option>";
  ?>
</select></td>
</tr>
</table>
<?php
if($jmsub!='')
{
	if($jmsub==1)
	{
		$title='Journals Subscription';
	}
	if($jmsub==2)
	{
		$title='Magazine Subscription';
	}
	if($jmsub==3)
	{
		$title='News Paper Subscription';
	}
	
	  $sql="SELECT * FROM `lib_magazine_subscription` WHERE `ssp_type` ='$jmsub' AND `stts` = 1 ORDER BY id";
	   
		$result=execute($sql) or die(mysql_error());
		if(rowcount($result)==0)
		{
			die('<center>No Records Found !</center>');			  
		}
   if(rowcount($result)>0)
   {
   ?>
      <input type="hidden" name="id" value="<?=$id?>"><BR>
	  <table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
      <tr>
		<td class="head" align="center" colspan="9"><?=$title?> Details</td>
	  </tr>
	  <tr height='22' >
		    <td Class="row3">Sl No</td>
			<td Class="row3">ID</td>
			<td Class="row3">Title</td>
            <td Class="row3">Language</td>
            <td Class="row3">Periodicity</td>
            <td Class="row3">No of Copies</td>
            <td Class="row3">Subscription Date</td>
            <td Class="row3">Due Date</td>	
            <td Class="row3">Amount(per month)</td>	
	   </tr>
       <?php
	      $i=0;
		  $rowclass=1;
		  $sno=1;
		  while($row=fetcharray($result))
		  {
				if($sno<10)
				{
					$sno="0".$sno;
				}
					if($i%2)
						echo "<tr class='clsname'>";
					else
						echo "<tr >";
			        
				    
			    	$dateArray=explode('-',$row['subscription_date']);
					$acq_yy=$dateArray[0];
					$acq_mm=$dateArray[1];
					$acq_dd=$dateArray[2];
					$subscription_date="$acq_dd-$acq_mm-$acq_yy";
					
					$dateArray1=explode('-',$row['due_date']);
					$acq_yy1=$dateArray1[0];
					$acq_mm1=$dateArray1[1];
					$acq_dd1=$dateArray1[2];
					$due_date="$acq_dd1-$acq_mm1-$acq_yy1";
				
			 $template=fetcharray(execute("SELECT `mail_subject` FROM `mail_det` WHERE `id`='$row[mail_det_id]'"));	
			?>
                    <td align='center'><?=$sno?></td>
                    
                    <td align='center' title="Click to generate receipt" >
 <a href="javascript:void(0);" onClick ="OpenWind2('subscribe_receipt1.php?mID=<?=$row[id]?>&jmsub=<?=$jmsub?>&Type=Print', 'OpenWind2',1000,800)"><?=$row[id]?></a>
                    </td>
                    
                    <td align='left'>&nbsp;<?=$row['title']?></td>
                    <td align='left'>&nbsp;<?=$row['language']?></td>
                    <td align='center'><?=$row['periodicity']?></td>    
                    <td align='center'><?=$row['copies']?></td>
                    <td align='center'><?=$subscription_date?></td>
                    <td align='center'><?=$due_date?></td>
                    <td align='center'><?=$row['amountMonth']?></td>
             <?
		
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   }				
 } 
?>
 </table>
</form>
</BODY>
</HTML>