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
.style4 {
	font-size: 14px;
	color: #FFFFFF;
}
.style5 {color: #000000}
.style7 {color: #000000; font-weight: bold; }
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
		  
          
          <table width="850" border="0" style="position:absolute; left: 214px; top: 239px; height: 147px;" cellspacing="1" id="tb1">
            <tr id="th">
              <td height="65" colspan="10"><div align="center" class="style5"><span class="style4"><b>BANGALORE SCHOOL</b><br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</span></div>
              <p><strong>DEPARTMENT</strong>:<b><?php echo $dep[0];?></b></p>              </td>
            </tr>
            <tr id="th1">
              <td width="48"><span class="style5"><strong>SL No: </strong></span></td>
              <td width="49"><span class="style7">ID</span></td>
              <td width="49"><span class="style5"><strong>Name</strong></span></td>
              <td width="48"><span class="style5"><strong>Desig:</strong></span></td>
              <td width="39"><span class="style5"><strong>Date Joined  </strong></span></td>
              <td width="31"><span class="style5"><strong>Basic Pay </strong></span></td>
              <td width="24"><span class="style5"><strong>Contact Number </strong></span></td>
              <td width="24"><span class="style5"><strong>Email</strong></span></td>
              <td width="46"><span class="style5"><strong>A/c No: </strong></span></td>
              <td width="29"><span class="style5"><strong>Edit</strong></span></td>
            </tr>
           
			<?php
			$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;$s8=0;$s9=0;$s10=0;$s11=0;$s12=0;$s13=0;$j=1;
			$qry=mysql_query("select * from emp_details1 where iIdx_institution='$dept'");
			while($r1=mysql_fetch_assoc($qry))
			{
			$dt11=date('d-m-Y',strtotime($r1[demp_jdate]));
			$qry3=mysql_query("select vjob from emp_job where iId_job='$r1[iemp_designation]'");
			$d=mysql_fetch_row($qry3);	
              echo " <tr id=td1><td><font color=black>$j</td>
			  <td><font color=black>$r1[vemp_id]</td>
              <td><font color=black>$r1[vemp_name]</td>
              <td><font color=black>$d[0]</td>
          	  <td><font color=black>$dt11</td>
              <td><font color=black>$r1[femp_bpay]</td>
              <td><font color=black>$r1[iemp_cno]</td>
              <td><font color=black>$r1[vemp_email]</td>
              <td><font color=black>$r1[vaccount]</td>
             
              <td><font color=black><a href='editemp.php?id1=$r1[iId_emp]&dp1=$dept' id=new><font size=2>Edit</font></a></td>  </tr>";
			  $j=$j+1;
			  }
			
			
			  ?>
          
            
          </table>
		    <form id="form1" method="post" action="viewemp.php">
          <table width="200" border="0" style="position:absolute; left: 214px; top: 151px; width: 850px; height: 31px;">
            <tr>
              <td width="151"><strong>DEPARTMENT</strong></td>
              <td width="170"><select name="combodep">
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
              <td width="515"><input type="submit" name="Submit" value="View" /></td>
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
