<?php
session_start();
include("../db.php");
if($_POST)
{
	$subject=$_POST['subject'];
	$description=$_POST['description'];
	$merit=$_POST['merit'];
	$demerit=$_POST['demerit'];
	$id=$_POST['id'];
}
if($_GET)
{
	$subject=$_REQUEST['subject'];
	$description=$_REQUEST['description'];
	$merit=$_REQUEST['merit'];
	$demerit=$_REQUEST['demerit'];
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
		
		document.myForm.action="stud_behaviour_update.php?Type=Add";
		document.myForm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.myForm.action="stud_behaviour_update.php?Type=Mod";
		document.myForm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		document.myForm.action="stud_behaviour_update.php?Type=Del";
		document.myForm.submit();
		return true;
	}
</script>
<script type="text/javascript">
function validate()
{
 
   if( document.myForm.merit.value != "" && document.myForm.demerit.value != "" )
   {
     alert( "Please Select Either Merit or Demerit Field" );
     document.myForm.merit.focus() ;
	 document.myForm.demerit.focus() ;
     return false;
   }

   return( true );
}
</script>
<title>STUDENT BEHAVIOUR</title>
</head>
<body>
<form name="myForm" method='POST' action="stud_behaviour_update.php">
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='47%'>
<tr>
    <td align='center' class='head' colspan='3'>BEHAVIOUR FORM</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Topic</td>
	<td><input type="text" name="subject" value="<?=$subject?>" size="50"/></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Desciption</td>
	<td><textarea name="description" cols="36" rows="2" tabindex="1" maxlength="255" ><?=$description?></textarea></td> 
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Merit</td>
	<td><input type="text" name="merit" value="<?=$merit?>" size="50"  title="Select Either Merit or Demerit"></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;&nbsp;Demerit</td>
	<td><input type="text" name="demerit" value="<?=$demerit?>" size="50"  title="Select Either Merit or Demerit"></td>
</tr>
</table>
<p align="center"><input type="submit"  value=" Add " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>

<?php
		
	   $result=execute("SELECT * FROM `student_behaviour_m` WHERE status=1 ORDER BY id");
		
	   if(rowcount($result)>0)
       {
	   ?>
	   
	<table class='forumline' align='center' width='95%'>
		<tr height='22' >
			<td Class="head" align='center'>Select</td>
			<td Class="head" align='center'>Topic</td>
			<td Class="head" align='center'>Desciption</td>
			<td Class="head" align='center'>Merit</td>
			<td Class="head" align='center'>Demerit</td>
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
	         
		<!-- 	
		<td align='center' title="Click here to Edit or Delete" ><center><a href="javascript:OpenWind2('stud_behaviour_update.php?id=<?=$row[id]?>')"><?=$sno?></a></td>
		<td align='center' ><?=$row[subject]?></td>
		<td align='center' ><?=$row[description]?></td>
		<td align='center' ><?=$row[merit]?></td>
		<td align='center' ><?=$row[demerit]?></td>
		-->
			<td class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$row[id]?>" size="5"></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>subject" value="<?=$row[subject]?>" size=30></td>
 <td class="CBody" align='center' ><textarea Name="<?=$row[id]?>description" cols="50" rows="1" tabindex="1" maxlength="255" ><?=$row[description]?></textarea></td> 
			<td class="CBody" align='center' title="Select Either Merit or Demerit" ><Input Type="Text" Name="<?=$row[id]?>merit" value="<?=$row[merit]?>" size=25></td>
			<td class="CBody" align='center' title="Select Either Merit or Demerit" ><Input Type="Text" Name="<?=$row[id]?>demerit" value="<?=$row[demerit]?>" size=25></td>
			 
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   

 ?>
 </table>
  	<p align="center">
		<Input type="submit" Name="Modify" value="Modify" LANGUAGE=javascript onClick="return Modify_onclick()" class='bgbutton'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Input type="submit" Name="Delete" value="Delete" LANGUAGE=javascript onClick="return Delete_onclick()" class='bgbutton'> </p>
<?
 }
?>
 </form>
 </body>
 </html>