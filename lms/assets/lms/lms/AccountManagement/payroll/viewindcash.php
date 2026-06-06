<?php
session_start();
include("../connection.php");
//$r1=$_SESSION['r'];
$name=$_SESSION['name'];
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
 $or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
$array=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$dept=$_POST['combodep'];
$month=$_POST['combomonth'];
$year=$_POST['comboyr'];
$r1=$_POST['radiobutton'];
if($month==1)
{
$m="JANUARY";
}
if($month==2)
{
$m="FEBRUARY";
}
if($month==3)
{
$m="MARCH";
}
if($month==4)
{
$m="APRIL";
}
if($month==5)
{
$m="MAY";
}
if($month==6)
{
$m="JUNE";
}
if($month==7)
{
$m="JULY";
}
if($month==8)
{
$m="AUGUST";
}
if($month==9)
{
$m="SEPTEMBER";
}
if($month==10)
{
$m="OCTOBER";
}
if($month==11)
{
$m="NOVEMBER";
}
if($month==12)
{
$m="DECEMBER";
}
//$_SESSION['r']=$r;
$q=mysql_query("select vinstitution from ac_institution where iIdx_institution='$dept'");
$dep=mysql_fetch_row($q);
$_SESSION['ddpt']=$dept;$_SESSION['vm']=$month;$_SESSION['vy']=$year;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
    <style type="text/css">
<!--
.style2 {color: #CC6600}
.style3 {
	font-size: 14px;
	font-weight: bold;
}
.style6 {color: #000000; font-weight: bold; }
.style7 {color: #000000}
-->
    </style>
</head>

<body>
  <div id="wrapper">
    
    <div id="header">
     
      <div id="cart">
        
           
              <p align="left">&nbsp;</p>
              <p align="left">Welcome <?php echo $name."   "?>, <a href="logout.php">Logout</a></p>
      </div>
	  <div id="logo">
      <h1 class="style2">Account Management</h1>
     </div>
    </div>
    <div id="body">
	<?php
	if($type=='u')
	{
	include("pusermenu.php");
	  }
	  else
	  {
	 include("padminmenu.html");
	  }
	  ?>
      <div id="seasonal">
        <div class="inner">
          <h2>&nbsp;</h2>
		  
          
          <form id="form1" method="post" action="viewindcash.php">
          <table width="200" border="0" style="position:absolute; left: 214px; top: 151px; width: 850px; height: 31px;">
            <tr>
              <td width="94"><strong>DEPARTMENT</strong></td>
              <td width="126"><select name="combodep">
                <option value="0">-SELECT-</option>
                <?php
				  $qryy1=mysql_query("select * from ac_institution");
				  while($rt=mysql_fetch_assoc($qryy1))
				  {?>
                <option value="<?php echo $rt[iIdx_institution];?>"><?php echo $rt[vinstitution];?></option>
                ;
				  
                <?php
				  }
				  ?>
              </select>                &nbsp;</td>
              <td width="150"><strong>MONTH</strong>                <select name="combomonth">
                 <option value="select">-SELECT-</option>
                  <?php
				  for($i=0;$i<12;$i++)
		 			{
		 
					?>
                  <option value="<?php echo $i+1;?>"><?php echo $array[$i];?></option>
                  <?php
					}
					?>
              </select>
                <label></label></td>
              <td width="106"><strong>YEAR
                  <select name="comboyr">
                    <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                    <?php
		for($i=2005;$i<2038;$i++)
		{
		?>
                    <option value="<?php echo $i; ?>" <?php if($y==$i){?>selected="selected"<?php }?>><?php echo $i; ?></option>
                    <?php
		}
		?>
                  </select>
              </strong></td>
              <td width="352"><input type="submit" name="Submit" value="View" />
              <input name="button" type='button' onclick='javascript:window.location.href=&quot;exportcashstatement.php&quot;' value='Export' /></td>
            </tr>
          </table>
        
          </form>
		   <table width="30%" border="0" style="position:absolute; width: 855px; left: 206px; top: 204px;">
             
          </table>
		 
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p align="center" class="style3"> </p>
          <p> </p>
          <table width="101%" height="103" border="1" bordercolor="#000000" bgcolor="#FFFFFF" cellspacing="0">
		   <tr >
              <td height="65" colspan="17"><div align="center" class="style5"><span class="style4"><span class="style7"><strong>BANGALORE SCHOOL<br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</strong></span></span></div>
              <p class="style6">&nbsp;</p>
              <div align="center" class="style6">INDIVIDUAL CASH STATEMENT FOR THE MONTH <?php echo $m."-".$year;?></div>              <p class="style6">&nbsp;</p>
              <p class="style7 style5"><strong>DEPARTMENT:<?php echo $dep[0];?></strong></p></td>
            </tr>
            <tr>
              <td width="28%" id="TH"><span class="style6">A/C NO: </span></td>
              <td width="38%"><span class="style6">NAME</span></td>
              <td width="34%"><span class="style6">AMOUNT</span></td>
            </tr>
            <?php
			$s1=0;
			$qry1=mysql_query("select * from emp_salary where  vmonth='$month' and iyear='$year'  and iIdx_department='$dept' and ptype='cash'");
			while($r2=mysql_fetch_assoc($qry1))
			{
			$qry=mysql_query("select * from emp_details1 where vemp_id='$r2[vId_emp]'");
			$r1=mysql_fetch_object($qry);
			?>
            <tr 
			>
              <td height="26"><span class="style6"><?php echo $r1->vaccount;?></span></td>
              <td><span class="style6"><?php echo $r1->vemp_name;?></span></td>
              <td><span class="style6"><?php echo $r2[fnetsal];?></span></td>
            </tr>
			<?php
			$s1=$s1+$r2[fnetsal];
			}
			
			?>
            <tr>
              <td>&nbsp;</td>
              <td><div align="right" class="style6">TOTAL:</div></td>
              <td><span class="style6"><b><?php echo $s1;?></span></td>
            </tr>
          </table>
          <p>
            <label></label>
          </p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		    <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		    <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		    <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		    <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		    <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		    <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		  
          <p>&nbsp;</p><p>&nbsp;</p>
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
    </div>
    <div id="copyright">
      <p></p>
    </div>
  </div>
</body>
</html>
