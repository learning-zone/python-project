<?php
session_start();
include("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$name=$_POST['name'];
	$description=$_POST['description'];
	$color_code=$_POST['color_code'];
	$Update=$_POST['Update'];
}
if($_REQUEST)
{
    $id=$_REQUEST['id'];
	$name=$_REQUEST['name'];
	$description=$_REQUEST['description'];
	$color_code=$_REQUEST['color_code'];
	$Update=$_REQUEST['Update'];
}

//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);

if($_POST['Update'])
{
	 
	  //$date_inserted=CURDATE();
      
      $sql="UPDATE `house_m` SET `name` = '$name', `description` = '$description', `color` = '$color_code' WHERE `id` = '$id'";
	  //echo $sql;
	  mysql_query($sql) or die(mysql_error());
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

	   $result=mysql_query("SELECT * FROM `house_m` WHERE `id`= '$id' AND `status`= '1'");
	  
	   if(mysql_num_rows($result)>0)
       {

           while($row=mysql_fetch_array($result))
           {
				
				
					 $name=$row['name'];
					 $description=$row['description'];
					 $color_code=$row['color'];
               
			 
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
<form name="myForm" method="POST" action="house_m_update.php" onSubmit="return(validate());">
<input type="hidden" name="id" value="<?=$id?>"/>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='47%'>
<tr>
    <td align='center' class='head' colspan='3'>ADD MASTER FORM</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Name :</td>
	<td><input type="text" name="name" value="<?=$name?>" size="50"/></td>
</tr>
<tr>
	<td nowrap="nowrap">&nbsp;&nbsp;&nbsp;Desciption :</td>
	<td><textarea name="description" cols="36" rows="2" tabindex="1" maxlength="255" ><?=$description?></textarea></td> 
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Color :</td>
	<td><select name='color_code'>
		<?php
			$sql=mysql_query("SELECT * FROM `house_m_color` where status=1 order by id");
				while($r=mysql_fetch_array($sql))
				{
					if($color_code==$r[color_code])
					echo "<option value='$r[color_code]' style='background-color:$r[color_code];' selected>$r[color_name]</option>";
					else
					echo "<option value='$r[color_code]' style='background-color:$r[color_code];' >$r[color_name]</option>";
				}
				
		?>
		</select></td>
</tr>

</table>
<p align="center"><input name="Update" type="submit" value=" Update "  class="bgbutton"/></form></p>

 </body>
 </html>