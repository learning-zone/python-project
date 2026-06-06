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
$r1=$_POST['radiobutton'];
$year=$_POST['comboyr'];
//$_SESSION['r']=$r;
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
.style4 {font-size: 14px}
.style5 {color: #000000}
.style6 {font-size: 14px; font-weight: bold; color: #000000; }
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
		  
          
          <table width="850" border="1" style="position:absolute; left: 214px; top: 239px; height: 147px;" bgcolor="#FFFFFF" cellspacing="0" bordercolor="#000000">
            <tr >
              <td height="65" colspan="12"><div align="center" class="style5"><span class="style4"><b>BANGALORE SCHOOL</b><br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</span></div>
              <p>&nbsp;</p>
              <div align="center" class="style6">CONSOLIDATED SALARY STATEMENT  FOR THE MONTH <?php echo $m."-".$year;?></div>              <p>&nbsp;</p>
              <p class="style5"><strong>DEPARTMENT</strong>:<b><?php echo $dep[0];?></b></p></td>
            </tr>
            <tr >
              <td width="48"><span class="style5"><strong>SL No: </strong></span></td>
              <td width="49"><span class="style5"><strong>Name:</strong></span></td>
              <td width="48"><span class="style5"><strong>Desig:</strong></span></td>
              <td width="39"><span class="style5"><strong>Gross Salary </strong></span></td>
              <td width="31"><span class="style5"><strong>LOP</strong></span></td>
              <td width="24"><span class="style5"><strong>PF</strong></span></td>
              <td width="24"><span class="style5"><strong>PT</strong></span></td>
              <td width="46"><span class="style5"><strong>Loans</strong></span></td>
              <td width="52"><span class="style5"><strong>Others</strong></span></td>
			  <td width="68"><span class="style5"><strong>Total Ded:</strong></span></td>
              <td width="53"><span class="style5"><strong>Net Salary </strong></span></td>
              <td width="29"><span class="style5"><strong>Signature</strong></span></td>
            </tr>
           
			<?php
			$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;$s8=0;$s9=0;$s10=0;$s11=0;$s12=0;$s13=0;$j=1;
			$qry=mysql_query("select * from emp_details1 where iIdx_institution='$dept'");
			while($r1=mysql_fetch_assoc($qry))
			{
				
			$qry1=mysql_query("select * from emp_salary where vId_emp='$r1[vemp_id]' and vmonth='$month' and iyear='$year'");
			while($r2=mysql_fetch_assoc($qry1))
			{
		
			$qry3=mysql_query("select vjob from emp_job where iId_job='$r1[iemp_designation]'");
			$d=mysql_fetch_row($qry3);
			$s1=$s1+$r1[femp_bpay];$s2=$s2+$r2[fda];$s3=$s3+$r2[fhra];$s4=$s4+$r2[fcca];$s5=$s5+$r2[fotherear];$s6=$s6+$r2[fgrosssal];$s7=$s7+$r2[flop];$s8=$s8+$r2[fpf];$s9=$s9+$r2[fpt];$s10=$s10+$r2[floans];$s11=$s11+$r2[fotherded];$s12=$s12+$r2[ftotded];$s13=$s13+$r2[fnetsal];
			
              echo " <tr ><td><font color=black>$j</td>
              <td><font color=black>$r1[vemp_name]</td>
              <td><font color=black>$d[0]</td>
          	  <td><font color=black>$r2[fgrosssal]</td>
              <td><font color=black>$r2[flop]</td>
              <td><font color=black>$r2[fpf]</td>
              <td><font color=black>$r2[fpt]</td>
              <td><font color=black>$r2[floans]</td>
              <td><font color=black>$r2[fotherded]</td>
           
              <td><font color=black>$r2[ftotded]</td>
              <td><font color=black>$r2[fnetsal]</td>  </tr";
			
			  }
			  $j=$j+1;
			  }
			  ?>
          
            <tr>
              <td colspan="3"><span class="style5"></span></td>
              <td><span class="style5"><strong><b><?php echo $s6;?></strong></span></td>
               <td><span class="style5"><strong><b><?php echo $s7;?></strong></span></td>
              <td><span class="style5"><strong><b><?php echo $s8;?></strong></span></td>
        <td><span class="style5"><strong><b><?php echo $s9;?></strong></span></td>
         <td><span class="style5"><strong><b><?php echo $s10;?></strong></span></td>
              <td><span class="style5"><strong><b><?php echo $s11;?></strong></span></td>
              <td><span class="style5"><strong><b><?php echo $s12;?></strong></span></td>
           <td><span class="style5"><strong><b><?php echo $s13;?></strong></span></td>
            <td><span class="style5"></span></td>
            </tr>
          </table>
		    <form id="form1" method="post" action="viewconsalvoucher.php">
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
              <td width="151"><strong>YEAR <select name="comboyr">
                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                        <?php
		for($i=2005;$i<2038;$i++)
		{
		?>
                        <option value="<?php echo $i; ?>" <?php if($y==$i){?>selected="selected"<?php }?>><?php echo $i; ?></option>
                        <?php
		}
		?>
                  </select></strong></td>
              <td width="303"><input type="submit" name="Submit" value="View" />
              <input name="button" type='button' onclick='javascript:window.location.href=&quot;exportconsalvoucher.php&quot;' value='Export' /></td>
            </tr>
          </table>
        
          </form>
		    <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p align="center" class="style3"> </p>
          <p> </p>
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
