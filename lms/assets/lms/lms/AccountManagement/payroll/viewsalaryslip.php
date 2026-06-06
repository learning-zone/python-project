<?php
session_start();
include("../connection.php");
$name=$_SESSION['name'];
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
 $or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];

$array=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$id=$_POST['comboid'];
$month=$_POST['combomonth'];
$year=$_POST['comboyr'];
$qry1=mysql_query("select * from emp_salary where vId_emp='$id' and vmonth='$month' and iyear='$year'");
$r2=mysql_fetch_object($qry1);
$qry=mysql_query("select * from emp_details1 where vemp_id='$id'");
$r1=mysql_fetch_object($qry);
$qry3=mysql_query("select vjob from emp_job where iId_job='$r1->iemp_designation'");
$d=mysql_fetch_row($qry3);
$qry31=mysql_query("select vinstitution from ac_institution where iIdx_institution='$r1->iIdx_institution'");
$d1=mysql_fetch_row($qry31);
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
$_SESSION['vid']=$id;$_SESSION['vm']=$month;$_SESSION['vy']=$year;
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
		
		 
		  <center>
		  <form id="form1" method="post" action="viewsalaryslip.php">
          <table border="0" style="position:absolute; left: 210px; top: 142px; width: 850px; height: 31px;">
            <tr>
              <td width="113"><strong>EMPLOYEE ID </strong></td>
              <td width="114"><select name="comboid">
                <option value="0">-SELECT-</option>
                <?php
				  $qryy1=mysql_query("select * from emp_salary");
				  while($rt=mysql_fetch_assoc($qryy1))
				  {?>
                <option value="<?php echo $rt[vId_emp];?>"><?php echo $rt[vId_emp];?></option>
                	  
                <?php
				  }
				  ?>
              </select>                &nbsp;</td>
              <td width="149"><strong>MONTH</strong>                <select name="combomonth">
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
              <td width="182"><strong>YEAR
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
              <td width="96">&nbsp;</td>
              <td width="170"><input type="submit" name="Submit" value="View" />
              <input name="button" type='button' onclick='javascript:window.location.href=&quot;exportsalaryslip.php&quot;' value='Export' /></td>
            </tr>
          </table>
        
          </form>
		   <table width="30%" border="0" style="position:absolute; width: 851px; left: 210px; top: 183px;">
              <tr>
                <td><div align="center" class="style3">SALARY SLIP FOR <?php echo $m."-".$year;?></div></td>
              </tr>
          </table>
		  
          <p>&nbsp;</p>
          <table border="1" style="position:absolute; left: 213px; top: 213px; width: 845px; height: 374px;" bgcolor="#FFFFFF" bordercolor="#000000" cellspacing="0">
            <tr >
              <td colspan="2"><div align="center" class="style5"><span class="style4"><b>BANGALORE SCHOOL</b><br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</span></div></td>
            </tr>
            <tr cellspacing=0 >
              <td width="48%"><span class="style5"><strong>Name          :<?php echo $r1->vemp_name;?><br />
              Dept:<?php echo $d1[0];?></strong></span></td>
              <td width="52%"><span class="style5"><strong>No: Of Days Present:<?php echo $r2->ipresent;?><br />
              Designation:<?php echo $d[0];?></strong></span></td>
            </tr>
            <tr>
              <td><span class="style5"><b>EARNINGS</b></span></td>
              <td><span class="style5"><b>DEDUCTIONS</b></span></td>
            </tr>
            <tr >
              <td><span class="style5"><strong>Basic:<?php echo $r1->femp_bpay;?><br />
              DA:<?php echo $r2->fda;?><br />
              HRA:<?php echo $r2->fhra;?><br />
              CCA:<?php echo $r2->fcca;?><br />
              Others:<?php echo $r2->fotherear;?></strong></span></td>
              <td><span class="style5"><strong>Loss Of Pay:<?php echo $r2->flop;?><br />
              PF:<?php echo $r2->fpf;?><br />
              PT:<?php echo $r2->fpt;?><br />
              Loans:<?php echo $r2->floans;?><br />
              Others:<?php echo $r2->fotherded;?></strong></span></td>
            </tr>
            <tr >
              <td><span class="style5"><b>TOTAL:<?php echo $r2->fgrosssal;?></b></span></td>
              <td><span class="style5"><b>TOTAL:<?php echo $r2->ftotded;?></b></span></td>
            </tr>
            <tr >
              <td><span class="style5">Employees Signature:</span></td>
              <td><span class="style5"><b>NET PAY:<?php echo $r2->fnetsal;?></b></span></td>
            </tr>
          </table>
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
