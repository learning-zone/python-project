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
$q=mysql_query("select vinstitution from ac_institution where iIdx_institution='dept'");
$dep=mysql_fetch_row($q);
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
.style4 {color: #000000}
.style5 {color: #000000; font-size: 14px; }
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
		  
          
          <form id="form1" method="post" action="viewconsal.php">
          <table width="200" border="0" style="position:absolute; left: 214px; top: 151px; width: 850px; height: 31px;">
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
              <input name="button" type='button' onclick='javascript:window.location.href=&quot;exportconsalalldep.php&quot;' value='Export' /></td>
            </tr>
          </table>
        
          </form>
		   <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p align="center" class="style3"> </p>
          <p> </p>
          <table width="101%" height="103" border="1" bgcolor="#FFFFFF" cellspacing="0" bordercolor="#000000">
		  <tr>
              <td height="79" colspan="10" ><div align="center" class="style5"><strong>BANGALORE SCHOOL<br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</strong></div>
              <p class="style5">&nbsp;</p>
              <div align="center" class="style5"><strong>CONSOLIDATED SALARY STATEMENT  FOR THE MONTH <?php echo $m."-".$year;?></strong></div>              <p class="style4">&nbsp;</p></td>
            </tr>
            <tr>
              <td width="16%" ><span class="style4"><strong>SL NO: </strong></span></td>
              <td width="24%"><span class="style4"><strong>DEPARTMENT</strong></span></td>
              <td width="20%"><span class="style4"><strong>DIRECTLY TO SB A/C </strong></span></td>
              <td width="12%"><span class="style4"><strong>BY CHEQUE </strong></span></td>
              <td width="14%"><span class="style4"><strong>BY CASH </strong></span></td>
              <td width="14%"><span class="style4"><strong>TOTAL</strong></span></td>
            </tr>
            <?php
			$i=1;$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;
			$qry=mysql_query("select * from ac_institution");
			while($r1=mysql_fetch_assoc($qry))
			{
			$qry1=mysql_query("select sum(fnetsal) from emp_salary  where vmonth='$month' and iyear='$year' and ptype='sb' and iIdx_department='$r1[iIdx_institution]'");
			$r5=mysql_fetch_row($qry1);
			$qry2=mysql_query("select sum(fnetsal) from emp_salary  where vmonth='$month' and iyear='$year' and ptype='cheque' and iIdx_department='$r1[iIdx_institution]'");
			$r6=mysql_fetch_row($qry2);
			$qry3=mysql_query("select sum(fnetsal) from emp_salary  where vmonth='$month' and iyear='$year' and ptype='cash' and iIdx_department='$r1[iIdx_institution]'");
			$r7=mysql_fetch_row($qry3);
			 	$s1=$r5[0]+$r6[0]+$r7[0];
			?>
           <tr >
		   <td><span class="style4"><strong><?php echo $i;?></strong></span></td>
              <td><span class="style4"><strong><?php echo $r1[vinstitution];?></strong></span></td>
             <td><span class="style4"><strong><?php echo $r5[0];?></strong></span></td>
			  <td><span class="style4"><strong><?php echo $r6[0];?></strong></span></td>
			   <td><span class="style4"><strong><?php echo $r7[0];?></strong></span></td>
			  
			    <td><span class="style4"><strong><?php echo $s1;?></strong></span></td>
            </tr>
			<?php
			//}
			$i++;
		$s2=$s2+$r5[0];	$s3=$s3+$r6[0];	$s4=$s4+$r7[0];	$s5=$s5+$s1;
		
			}
			?>
			
            <tr >
              <td colspan="2"><div align="right" class="style4"><strong>TOTAL:</strong></div></td>
              <td><span class="style4"><strong><?php echo $s2;?></strong></span></td>
              <td><span class="style4"><strong><?php echo $s3;?></strong></span></td>
              <td><span class="style4"><strong><?php echo $s4;?></strong></span></td>
              <td><span class="style4"><strong><?php echo $s5;?></strong></span></td>
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
