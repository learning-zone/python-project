<?php
session_start();
include("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$stud_id=$_POST['stud_id'];
	$house_id=$_POST['house_id'];
	$academic_yr=$_POST['academic_yr'];
	$user=$_POST['user'];
	$Update=$_POST['Update'];
}
if($_REQUEST)
{
	$id=$_REQUEST['id'];
	$stud_id=$_REQUEST['stud_id'];
	$house_id=$_REQUEST['house_id'];
	$academic_yr=$_REQUEST['academic_yr'];
	$user=$_REQUEST['user'];
	$Update=$_REQUEST['Update'];
}


//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);

if($_POST['Update'])
{
	 
	  //$date_inserted=CURDATE();
      
      $sql="UPDATE `house_m_stud` SET `stud_id` ='$stud_id', `house_id` ='$house_id', `academic_yr`= '$academic_yr' , `user`= '$user' WHERE `id` = '$id'";
	  //echo $sql;
	  execute($sql) or die(mysql_error());
	  if($sql)
	  {
	  	?>
			    <head><script type="text/javascript">
				alert("Records Updated Successfully");
				window.opener.location.reload();
				window.close();
				</script></head>
	    <?
	  }
}
	
	
	   $result=execute("SELECT * FROM `house_m_stud` WHERE `id`= '$id' AND `status`= '1'");
	  
	   if(rowcount($result)>0)
       {

           while($row=fetcharray($result))
           {
				
				
					 $stud_id=$row['stud_id'];
					 $house_id=$row['house_id'];
					 $academic_yr=$row['academic_yr'];
					 $user=$row['user'];
               
			 
            }
	   }


?>
<html>
<head>
<script type="text/javascript">
<!--
// Form validation code will come here.
function validate()
{
    
   if( document.myForm.name.value == "" )
   {
		 alert( "Please Enter Name" );
		 document.myForm.name.focus() ;
		 return false;
   }   
   if( document.myForm.color_code.value == "" )
   {
		 alert( "Please Select Color" );
		 document.myForm.color_code.focus() ;
		 return false;
   }
   else
   {
	     return( true );
   }
}
//-->
</script>
<script language="javascript">
function OpenWind2(k2)
{
 var finalVar ;
 finalVar=k2 ;
 window.open(finalVar,'Detailed_report','_blank,align=center,width=800,height=600,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<body>
<form name="myForm" method="POST" action="house_m_stud_update.php" onSubmit="return(validate());">
<input type="hidden" name="id" value="<?=$id?>"/>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='47%'>
<tr>
    <td align='center' class='head' colspan='3'>ADD MASTER FORM</td>
</tr>
<tr>
	<td nowrap="nowrap">&nbsp;&nbsp;&nbsp;Student ID :</td>
	<td><input type="text" name="stud_id" value="<?=$stud_id?>" size="50"/></td>
</tr>
<tr>
	<td nowrap="nowrap">&nbsp;&nbsp;&nbsp;House ID :</td>
	<td><input type="text" name="house_id" value="<?=$house_id?>" size="50"/></td>
</tr>
<tr>
	<td nowrap="nowrap">&nbsp;&nbsp;&nbsp;Academic Year :</td>
	<td><input type="text" name="academic_yr" value="<?=$academic_yr?>" size="50"/></td>
</tr>
<tr>
	<td nowrap="nowrap">&nbsp;&nbsp;&nbsp;User :</td>
	<td><input type="text" name="user" value="<?=$user?>" size="50"/></td>
</tr>

</table>
<p align="center"><input name="Update" type="submit" value=" Update "  class="bgbutton"/></form></p>

 </body>
 </html>