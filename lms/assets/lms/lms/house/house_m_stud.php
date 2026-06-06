<?php
session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];

if($_POST)
{
	$stud_id=$_POST['stud_id'];
	$house_id=$_POST['house_id'];
	$academic_yr=$_POST['academic_yr'];
	$user=$_POST['user'];
	$id=$_POST['id'];
}
if($_GET)
{
	$stud_id=$_REQUEST['stud_id'];
	$house_id=$_REQUEST['house_id'];
	$user=$_REQUEST['user'];	
	$id=$_REQUEST['id'];
	$msg=$_REQUEST['msg'];
}


//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);

if($msg)
{
	?>
		  <head><script type="text/javascript">
		      alert('<?=$msg?>');
		  </script></head>
	<?
}

?>
<html>
<head>
<script language="javascript">
	function adds_onclick()
	{
		
		document.myForm.action="house_m_stud_edt.php?Type=Add";
		document.myForm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.myForm.action="house_m_stud_edt.php?Type=Mod";
		document.myForm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		document.myForm.action="house_m_stud_edt.php?Type=Del";
		document.myForm.submit();
		return true;
	}
</script>
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
<form name="myForm" method="POST" action="house_m_stud_edt.php" onSubmit="return(validate());">
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='47%'>
<tr>
    <td align='center' class='head' colspan='3'>ADD MASTER FORM</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;House ID</td>
	<td><select name='house_id'>
		<?php
			$sql=execute("SELECT * FROM `house_m` where status=1 order by id");
				while($r=fetcharray($sql))
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
<p align="center"><input type="submit"  value=" Add " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>

<?php
		
	   $result=execute("SELECT * FROM house_m_stud  WHERE status=1 ORDER BY id");
		
	   if(rowcount($result)>0)
       {
	   ?>
	   
	 <table class='forumline' align='center' width='95%'>
		<tr height='22'>
			<td Class="head" align='center' width="10%">Sl No</td>
			<td Class="head" align='center' width="20%">Student ID</td>
			<td Class="head" align='center' width="20%">House ID</td>
			<td Class="head" align='center' width="30%">Academic Year</td>
			<td Class="head" align='center' width="20%">User</td>
			
	   </tr>
       <?
	   	    $i=0;
            $rowclass=1;
            $sno=1; 
           while($row=fetcharray($result))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
				
					echo   "<tr>";
					
			 ?>
	         
            <td class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$row[id]?>" size="10"></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>stud_id" value="<?=$row[stud_id]?>" size=20></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>house_id" value="<?=$row[house_id]?>" size=20></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>academic_yr" value="<?=$row[academic_yr]?>" size=30></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>user" value="<?=$row[user]?>" size=20></td>
			
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   }

 ?>
 </table>
  	<p align="center">
		<Input type="submit" Name="Modify" value="Modify" LANGUAGE=javascript onClick="return Modify_onclick()" class='bgbutton'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Input type="submit" Name="Delete" value="Delete" LANGUAGE=javascript onClick="return Delete_onclick()" class='bgbutton'> </p>
</form>
 </body>
 </html>