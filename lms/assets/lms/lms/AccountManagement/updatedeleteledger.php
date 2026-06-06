<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
include("../db.php");
session_start();
$id=$_REQUEST['i'];
//echo $id;
$qry1=execute("Select * from ac_ledger where iIdx_ledger=\"$id\"");
$ob1=mysql_fetch_object($qry1);
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
	font-size: 13px;
	font-weight: bold;
}
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
          <div align="center">
            <form id="form1" name="form1" method="post" action="editledgeraction.php">
              
              <div align="center">
                <table width="200" border="0" cellspacing="2" >
                  <tr>
                    <th colspan="2" scope="row"><div align="left"><a href="index.html"></a>
                      </div>
            <p class="style1 style17 style3"><u>UPDATE LEDGER </u></p></th>
          </tr>
                  <tr>
                    <th colspan="2" scope="row"><div align="center"><?php echo $msg;?>&nbsp;</div></th>
          </tr>
                 
                  <tr>
                    <th scope="row"><span class="style20">Ledger</span></th>
            <td><label>
              <input type="text" name="txtledger" value="<?php echo $ob1->vledger?>" readonly="true"/>
              </label></td>
          </tr>
                  <tr>
                    <th height="34" scope="row"><span class="style20">Group Type </span></th>
					
	        <?php
	  $qry3=execute("Select * from ac_allgroup where iIdx_grp=\"$ob1->iIdx_group\"");
      $ob=mysql_fetch_object($qry3);
	  ?>
                    <td><input type="textbox" name="combogp" value="<?php echo $ob->vgroupname;?>" readonly="true"/></td>
          </tr>
                  <tr>
                    <th scope="row"><span class="style20">Code </span></th>
            <td><label>
              <input type="text" name="txtlcode" value="<?php echo $ob1->vcode?>"/>
              </label></td>
          </tr>
                  <tr>
                    <th height="26" scope="row"><span class="style20">Description</span></th>
            <td><label>
              <textarea name="txtldesc"><?php echo $ob1->vdescription?></textarea>
              </label></td>
          </tr>
                  <tr>
                    <th height="26" scope="row"><span class="style20">Contact Person </span></th>
            <td><label>
              <input type="text" name="txtlcontact" value="<?php echo $ob1->vcontactperson?>"/>
              </label></td>
          </tr>
                  <tr>
                    <th height="26" scope="row"><span class="style20">Designation</span></th>
            <td><label>
              <input type="text" name="txtldesig" value="<?php echo $ob1->vdesignation?>"/>
              </label></td>
          </tr>
                  <tr>
                    <th height="26" scope="row"><span class="style20">Mobile</span></th>
            <td><label>
              <input type="text" name="txtlmobile" value="<?php echo $ob1->imobile?>"/>
              </label></td>
          </tr>
                  <tr>
                    <th height="26" scope="row"><span class="style20">Debit/Credit</span></th>
	        <?php
				 if($ob1->itype==0)
				 {
				 $a="By";
				 }
				 else
				 {
				 $a="To";
				 }
	 ?>
                    <td><input type="text" name="combodc" value="<?php echo $ob1->itype;?>" readonly="true"   />     &nbsp;</td>
          </tr>
                  <tr>
                    <th scope="row">&nbsp;</th>
            <td><input type="submit" name="b1" value="Update" /><input type="submit" name="b1" value="Delete" /><input type="submit" name="b1" value="Exit" /><input type="hidden" name="id" value="<?php echo $id;?>" />&nbsp;</td>
          </tr>
                </table>
              </div>
            </form> 
          </div>
           
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
