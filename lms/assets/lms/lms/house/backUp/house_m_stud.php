<?php
session_start();
include("../db.php");
$stud_id=$_POST['stud_id'];
$house_id=$_POST['house_id'];
$academic_yr=$_POST['academic_yr'];
$user=$_POST['user'];
$Submit=$_POST['Submit'];


//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);

if($_POST['Submit'])
{
	 
	  //$date_inserted=CURDATE();
      
      $sql="INSERT INTO `house_m_stud` (`stud_id`, `house_id`, `academic_yr`, `user`, `status`) VALUES ('$stud_id', '$house_id', '$academic_yr', '$user', '1')";
	  //echo $sql;
	  mysql_query($sql) or die(mysql_error());
	  if($sql)
	  {
	  		echo "Records Inserted Successfully";
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
<form name="myForm" method="POST" action="house_m_stud.php" onSubmit="return(validate());">
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='47%'>
<tr>
    <td align='center' class='head' colspan='3'>ADD MASTER FORM</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;House ID</td>
	<td><select name='house_id'>
		<?php
			$sql=mysql_query("SELECT * FROM `house_m` where status=1 order by id");
				while($r=mysql_fetch_array($sql))
				{
					if($house_id==$r[id])
					echo "<option value='$r[id]' selected>$r[id]</option>";
					else
					echo "<option value='$r[id]' >$r[id]</option>";
				}
				
		?>
		</select></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Student ID :</td>
	<td><input type="text" name="stud_id" value="<?=$stud_id?>" size="50"/></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Academic Year</td>
	<td><input type="text" name="academic_yr" value="<?=$academic_yr?>" size="50"/></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;User</td>
	<td><input type="text" name="user" value="<?=$user?>" size="50"/></td>
</tr>

</table>
<p align="center"><input name="Submit" type="submit" value=" Submit "  class="bgbutton"/></form></p>

<?php
		
	   $result=mysql_query("SELECT * FROM house_m_stud ORDER BY id");
		
	   if(mysql_num_rows($result)>0)
       {
	   ?>
	   
	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
		<tr height='25'>
		    <td align='center' class='head' colspan='5'><font size="4"><b>MASTER FORM</b></font></td>
		</tr>
		<tr height='25' >
			<td Class="rowpic" align='center' width="10%">Sl No</td>
			<td Class="rowpic" align='center' width="20%">Student ID</td>
			<td Class="rowpic" align='center' width="20%">House ID</td>
			<td Class="rowpic" align='center' width="20%">Academic Year</td>
			<td Class="rowpic" align='center' width="20%">User</td>
			
	   </tr>
       <?
	   	    $i=0;
            $rowclass=1;
            $sno=1; 
           while($row=mysql_fetch_array($result))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
					if($i%2)
					echo   "<tr class='clsname'>";
					else
					echo   "<tr>";
					
			 ?>
	         

			<td align='center' ><?=$sno?></td>
			<td align='center' ><?=$row[stud_id]?></td>
			<td align='center' ><?=$row[house_id]?></td>
			<td align='center' ><?=$row[academic_yr]?></td>
			<td align='center' ><?=$row[user]?></td>

	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   }

 ?>
 </table>

 </body>
 </html>