<?php
session_start();
require_once("../db.php");
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
$msg=$_REQUEST['msg'];
if($_POST)
{
	$Sel=$_POST['Sel'];
	$process_name = $_POST['process_name']; 
    $process_description = $_POST['process_description']; 
}
if($_GET)
{
	$Sel=$_GET['Sel'];
	$Type=$_GET['Type'];
	$process_name = $_GET['process_name']; 
    $process_description = $_GET['process_description']; 
}
if(trim($Type) == "Mod")
{
   
	for($i=0;$i<sizeof($Sel);$i++)
	{
      $val=$Sel[$i];
      $process_name=$_POST[$val.'process_name'];
      $process_description=$_POST[$val.'process_description'];

      
	 	 $sql="UPDATE `tasks_process` SET `process_name` = '".addslashes($process_name)."', `process_description` = '".addslashes($process_description)."'   WHERE `id` = '$val'";
	
	 	 $result=execute($sql) or die("<p align=center>Unable to Update Record</p>");

	}
	 
			$msg="Records Updated Successfully";
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=addSubject_edt.php?msg=$msg&title=$title'>";
	 	
}
if(trim($Type) == "Del")
{
       
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  
		  $sql="UPDATE `tasks_process` SET `status` = '0' WHERE `id` = '$val'";	 
		  $result=execute($sql) or die("<p align=center>Unable to Delete Record</p>");
  
	  }
	  
			//$msg="Records Deleted Successfully";
			//echo "<META HTTP-EQUIV='Refresh' Content='0; URL=addSubject_edit.php?msg=$msg&category=$category'>";
	?>
     <script language="javascript">
	   alert("Record Deleted Successfully");
	   window.opener.location.reload();
	  // window.close();
	  </script>
    <?	 	
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
<script language="javascript">
	function Modify_onclick()
	{
		
		document.frm.action="addSubject_edt.php?Type=Mod";
		document.frm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="addSubject_edt.php?Type=Del";
			document.frm.submit();
		}
	  return true;
	}
</script>
</head>
<body>
<?php

        $result=execute("SELECT * FROM tasks_process  WHERE  status='1'");
	
        $rowCount=rowcount($result);
	   ?>
	 <FORM id="frm" NAME="frm" ACTION="" METHOD="post">  
	  <table class='forumline' align='center' width='90%'>
      	<tr height='22' >
		    <td width="21%" align='center' Class="row3">Select</td>
			<td width="33%" align='left' Class="row3">Process Name</td>	
	   </tr>
       <?
	   	    $i=0;$sno=1; 
           while($row=fetcharray($result))
           {
		   			if($sno<10){
						$sno='0'.$sno;
					}
				
					echo   "<tr>";
			 ?>
	         
            <td class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$row[id]?>" size="10"></td>
            <td class="CBody" align='left'><Input Type="Text" Name="<?=$row[id]?>process_name" value="<?=$row[process_name]?>" size=40></td>
         
	         <?php
			   ++$i;
		       ++$sno;
		       
            }
	 
	   
 ?>
 </tr>
 </table>
 <?php

        if($rowCount < 1){
            
            echo "<p align=center>No Record Found !</p>";
        }
?>
<p align="center"><Input type="submit" Name="Modify" value="Modify" onClick="return Modify_onclick()" class='bgbutton'>
    &nbsp;&nbsp;&nbsp;&nbsp;
 	<Input type="submit" Name="Delete" value="Delete" onClick="return Delete_onclick()" class='bgbutton'>
 </p>
</FORM>

</body>
</html>
 	