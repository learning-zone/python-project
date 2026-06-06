<?php
session_start();
include("../db.php");
if($_POST)
{
	$name=$_POST['name'];
	$description=$_POST['description'];
	$color=$_POST['color'];
	$id=$_POST['id'];
}
if($_GET)
{
	$name=$_REQUEST['name'];
	$description=$_REQUEST['description'];
	$color=$_REQUEST['color'];
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
		
		document.myForm.action="house_m_edt.php?Type=Add";
		document.myForm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.myForm.action="house_m_edt.php?Type=Mod";
		document.myForm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		document.myForm.action="house_m_edt.php?Type=Del";
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
<form name="myForm" method="POST" action="house_m_edt.php" onSubmit="return(validate());">
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='47%'>
<tr>
    <td align='center' class='head' colspan='3'>ADD MASTER FORM</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Name :</td>
	<td><input type="text" name="name" value="<?=$name?>" size="50"/></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Desciption</td>
	<td><textarea name="description" cols="36" rows="2" tabindex="1" maxlength="255" ><?=$description?></textarea></td> 
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Color</td>
	<td><select name='color'>
		<?php
			$sql=execute("SELECT * FROM `house_m_color` where status=1 ORDER BY id");
				while($r=fetcharray($sql))
				{
					if($color_code==$r[id])
					echo "<option value='$r[id]' style='background-color:$r[color_code];' selected>$r[color_name]</option>";
					else
					echo "<option value='$r[id]' style='background-color:$r[color_code];' >$r[color_name]</option>";
				}
				
		?>
		</select></td>
</tr>

</table>
<p align="center"><input type="submit"  value=" Add " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>

<?php
		
	   $result=execute("SELECT * FROM house_m WHERE status=1 ORDER BY id");
		
	   if(rowcount($result)>0)
       {
	   ?>
	   
	  <table class='forumline' align='center' width='95%'>
		<tr height='22' >
		    <td Class="head" align='center'>Select</td>
			<td Class="head" align='center'>Name</td>
			<td Class="head" align='center'>Desciption</td>
			<td Class="head" align='center'>Color</td>
			
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
					//echo "id ".$row[id];
					$color=$row[color];
					
				$color_name=fetcharray(execute("SELECT color_name FROM `house_m_color` WHERE `id`='$row[color]'"));
				
			 ?>
	         
            <td class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$row[id]?>" size="10"></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>name" value="<?=$row[name]?>" size=50></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>description" value="<?=$row[description]?>" size=100></td>
			<td class="CBody" align='center' ><select name="<?=$row[id]?>color">
		<?php
			$sql=execute("SELECT * FROM `house_m_color` where status=1 ORDER BY id");
				while($r=fetcharray($sql))
				{
					if($color==$r[id])
					echo "<option value='$r[id]' style='background-color:$r[color_code];' selected>$r[color_name]</option>";
					else
					echo "<option value='$r[id]' style='background-color:$r[color_code];' >$r[color_name]</option>";
				}
				
		?>
		</select></td>

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