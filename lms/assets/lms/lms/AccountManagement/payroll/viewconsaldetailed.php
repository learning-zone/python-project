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
$month=$_POST['combomonth'];
$year=$_POST['comboyr'];
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
		  
          
          <form id="form1" method="post" action="viewconsaldetailed.php">
          <table width="200" border="0" style="position:absolute; left: 214px; top: 151px; width: 850px; height: 31px;"  cellspacing="0" bordercolor="#000000">
            <tr>
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
              <input name="button" type='button' onclick='javascript:window.location.href=&quot;exportconsaldetailed.php&quot;' value='Export' /></td>
            </tr>
          </table>
        
          </form>
		   <table width="30%" border="0" style="position:absolute; width: 855px; left: 206px; top: 204px;">
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table>
		 
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p align="center" class="style3"> </p>
          <p> </p>
          <table width="101%" height="194" border="1" bordercolor="#000000"  bgcolor="#FFFFFF" cellspacing="0">
            <tr>
              <td height="79" colspan="10" id="TH"><div align="center" class="style5"><span class="style4"><b>BANGALORE SCHOOL</b><br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</span></div>
              <p>&nbsp;</p>
              <div align="center" class="style6">CONSOLIDATED SALARY STATEMENT  FOR THE MONTH <?php echo $m."-".$year;?></div>              <p>&nbsp;</p></td>
            </tr>
            
            <tr >
              <td width="16%" id="TH"><span class="style5"><strong>SL NO: </strong></span></td>
              <td width="24%"><span class="style5"><strong>DEPARTMENT</strong></span></td>
              <td width="20%"><span class="style5"><strong>GROSS SALARY </strong></span></td>
              <td width="12%"><span class="style5"><strong>LOP</strong></span></td>
              <td width="14%"><span class="style5"><strong>PF</strong></span></td>
              <td width="14%"><span class="style5"><strong>PT</strong></span></td>
              <td width="14%"><span class="style5"><strong>LOANS</strong></span></td>
              <td width="14%"><span class="style5"><strong>OTHERS</strong></span></td>
              <td width="14%"><span class="style5"><strong>TOT:DEDUCTION</strong></span></td>
              <td width="14%"><span class="style5"><strong>NETSALARY</strong></span></td>
            </tr>
            <?php
			$i=1;$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;$s8=0;
			$qry=mysql_query("select * from ac_institution");
			while($r1=mysql_fetch_assoc($qry))
			{
			$qry1=mysql_query("select sum(fgrosssal),sum(flop),sum(fpf),sum(fpt),sum(floans),sum(fotherded),sum(ftotded),sum(fnetsal) from emp_salary  where vmonth='$month' and iyear='$year' and iIdx_department='$r1[iIdx_institution]'");
			$r5=mysql_fetch_array($qry1);
			
			 	$s1=$s1+$r5[0];$s2=$s2+$r5[1];$s3=$s3+$r5[2];$s4=$s4+$r5[3];$s5=$s5+$r5[4];$s6=$s6+$r5[5];$s7=$s7+$r5[6];$s8=$s8+$r5[7];
			?>
           <tr>
		   <td><span class="style5"><?php echo $i;?></span></td>
              <td><span class="style5"><?php echo $r1[vinstitution];?></span></td>
             <td><span class="style5"><?php echo $r5[0];?></span></td>
			  <td><span class="style5"><?php echo $r5[1];?></span></td>
			   <td><span class="style5"><?php echo $r5[2];?></span></td>
			  
			    <td><span class="style5"><?php echo $r5[3];?></span></td>
			    <td><span class="style5"><?php echo $r5[4];?></span></td>
			    <td><span class="style5"><?php echo $r5[5];?></span></td>
			    <td><span class="style5"><?php echo $r5[6];?></span></td>
			    <td><span class="style5"><?php echo $r5[7];?></span></td>
            </tr>
			<?php
			//}
			$i++;
		
		
			}
			?>
			
            <tr>
              <td colspan="2"><div align="right" class="style5"><strong>TOTAL:</strong></div></td>
              <td><span class="style5"><strong><?php echo $s1;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s2;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s3;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s4;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s5;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s6;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s7;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s8;?></strong></span></td>
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
