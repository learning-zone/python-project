<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$tp=$_SESSION['type'];
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
include("../db.php");
$qry2=execute("select * from ac_institution");
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
if($tp=='a')
{
$ins=$_POST['comboin'];
}
$_SESSION['ins']=$ins;
$dt1 = isset($_REQUEST["date51"]) ? $_REQUEST["date51"] : "";
$dt2 = isset($_REQUEST["date52"]) ? $_REQUEST["date52"] : "";
$_SESSION['bdt11']=$dt1;
$_SESSION['bdt12']=$dt2;
$dtd1=date('d-m-Y',strtotime( $dt1));
  $dtd2=date('d-m-Y',strtotime( $dt2));
$qry1=execute("select * from ac_ledger where iIdx_grp=3");
$qry2=execute("select * from ac_ledger where iIdx_grp=5");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
	<link href="calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar.js"></script>
<script language="javascript" src="calendar1.js"></script>
<script language="javascript">
function validate()
{
if(document.form1.comboin.value=="select")
{
window.alert("Select Institution");
return false;
}
}
</script>
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
</head>

<body>
  <div id="wrapper">
    
    <div id="header">
     
      <div id="cart">
        
           
              <p align="left">&nbsp;</p>
              <p align="left">Welcome <?php echo $name."   "?>, <a href="logout.php">Logout</a></p>
      </div>
	  <div id="logo">
      <h1 >Account Management</h1>
     </div>
    </div>
    <div id="body">
      <?php
	if($tp=='u')
	{
	include("usermenu.php");
	  }
	  else
	  {
	 include("adminmenu.html");
	  }
	  ?>
      <div id="seasonal">
        <div class="inner">
          <form id="form1" name="form1" method="post" action="exportbalancesheet.php" onsubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 210px; top: 130px; width: 715px; height: 170px;"  id="tb1">
              <tr id="th">
                <td colspan="3"><div align="center" class="style3 style5"><strong>BALANCE SHEET </strong></div></td>
              </tr>
              <tr id="td1">
                <td width="360" height="51"><center><b><?php echo $ins."<br>".$dtd1." To "."$dtd2";?></b></center></td>
                        <td width="360" colspan="2"><center><b><?php echo $ins."<br>".$dtd1." To "."$dtd2";?></b></center></td>
              </tr>
              <tr id="th1">
                <td height="17"><span class="style7">LIABILITIES</span></td>
                        <td colspan="2"><span class="style7">ASSETS</span></td>
              </tr>
              <tr id="td1">
                <td><?php
			  $sum=0;
	        $qry4=execute("select * from ac_allgroup where iparentid=2");
			while($r9=mysql_fetch_assoc($qry4))
			{
			$dd=$r9[iIdx_grp];
			echo "<b>$r9[vgroupname]<br></b>";?>
                  <?php
			   $qry5=execute("select * from ac_ledger where vins=\"$ins\" and iIdx_group=\"$dd\" and date between \"$dt1\" and \"$dt2\"");
			   while($b9=mysql_fetch_assoc($qry5))
			  {
			   if($b9[fopbal]==0.00){ $b9[fopbal]=0.00;}
			    $bal=number_format($b9[fopbal],2);
			   $sum=$sum+ $b9[fopbal];
			   $s1=number_format($sum,2);
			?>
                  <?php echo "$b9[vledger]<div align=right>$bal</div>";
				?>
                  <?php
			  }
			}
							echo"<div align=right>----------------------------------------------</div>";

			echo "<div align=right><b>TOTAL:</b>$s1</div>";
			  ?></td>
                        <td colspan="2"><?php
			  $sum=0;
	        $qry4=execute("select * from ac_allgroup where iparentid=1");
			while($r9=mysql_fetch_assoc($qry4))
			{
			$dd=$r9[iIdx_grp];
			echo "<b>$r9[vgroupname]<br></b>";?>
                          <?php
			   $qry5=execute("select * from ac_ledger where vins=\"$ins\" and iIdx_group=\"$dd\" and date between \"$dt1\" and \"$dt2\"");
			   while($b9=mysql_fetch_assoc($qry5))
			  {
			   if($b9[fopbal]==0){ $b9[fopbal]=0.00;}
			   $bal=number_format($b9[fopbal],2);
			   $sum=$sum+ $b9[fopbal];
			   $s1=number_format($sum,2);
			?>
                          <?php echo "$b9[vledger]<div align=right>$bal</div>";
				?>
                          <?php
			  }
			}
						echo"<div align=right>----------------------------------------------</div>";

			echo "<div align=right><b>TOTAL:</b>$s1</div>";
			  ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><div align="right"><?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;exportbalancesheet.php&quot;' value='Export' /><?php */?></div>&nbsp;</td>
              </tr>
            </table>
          </form>	
            <h2>&nbsp;</h2>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
  
          <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p>
			  
                    
        </div>
      </div>
        
      <div class="clear"> </div>
        <div id="seas">
          
          <div class="clear"> </div>
        </div>
    </div><div id="copyright">
      <p>All rights reserved</p>
    </div>
  </div>
</body>
</html>
