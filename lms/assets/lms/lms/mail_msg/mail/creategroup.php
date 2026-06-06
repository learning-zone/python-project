<?php
session_start();
include("../db.php");
if($_POST)
{
	$group_name=$_POST['group_name'];
	$description=$_POST['description'];
	$id=$_POST['id'];
}
if($_GET)
{
	$group_name=$_REQUEST['group_name'];
	$description=$_REQUEST['description'];
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
		
		document.myForm.action="mail_group_edt.php?Type=Add";
		document.myForm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.myForm.action="mail_group_edt.php?Type=Mod";
		document.myForm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		document.myForm.action="mail_group_edt.php?Type=Del";
		document.myForm.submit();
		return true;
	}
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
<form name="myForm" method="POST" action="mail_group_edt.php">
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='47%'>
<tr>
    <td align='center' class='head' colspan='3'>MAIL GROUP MASTER FORM</td>
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;Group Name :</td>
	<td><input type="text" name="group_name" value="<?=$group_name?>" size="50"/></td>
</tr>
<tr height="25">
	<td>&nbsp;&nbsp;&nbsp;Desciption</td>
	<td><textarea name="description" cols="36" rows="2" tabindex="1" maxlength="255" ><?=$description?></textarea></td> 
</tr>
</table>
<p align="center"><input type="submit"  value=" Add " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>

<?php
		
	   $result=execute("SELECT * FROM `mail_group` WHERE status=1 ORDER BY id");
		
	   if(rowcount($result)>0)
       {
	   ?>
	   
	  <table class='forumline' align='center' width='95%'>
		<tr height='22' >
		    <td Class="head" align='center'>Select</td>
			<td Class="head" align='center'>Group Name</td>
			<td Class="head" align='center'>Description</td>
			
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
				
			 ?>
	         
            <td class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$row[id]?>" size="10"></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>group_name" value="<?=$row[group_name]?>" size=50></td>
	<td class="CBody" align='center' ><textarea name="<?=$row[id]?>description" cols="36" rows="2" tabindex="1" maxlength="255" ><?=$row[description]?></textarea></td> 
     
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