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
	$category=$_POST['category']; 
}
if($_GET)
{
	$Sel=$_REQUEST['Sel'];
	$Type=$_REQUEST['Type'];
	$category=$_REQUEST['category'];
}
if(trim($Type) == "Mod")
{
   
	for($i=0;$i<sizeof($Sel);$i++)
	{
      $val=$Sel[$i];
      $category=$_POST[$val.'category'];

      
	 	 $sql="UPDATE `order_category` SET `category` = '$category'  WHERE `id` = '$val'";
	
	 	 $result=execute($sql);

	}
	 
			$msg="Records Updated Successfully";
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=category_edt.php?msg=$msg&category=$category'>";
	 	
}
if(trim($Type) == "Del")
{
       
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  
		  $sql="UPDATE `order_category` SET `status` = '0' WHERE `id` = '$val'";	 
		  $result=execute($sql);
  
	  }
	  
			//$msg="Records Deleted Successfully";
			//echo "<META HTTP-EQUIV='Refresh' Content='0; URL=category_edt.php?msg=$msg&category=$category'>";
	?>
     <script language="javascript">
	   alert("Record Deleted Successfully");
	   window.opener.location.reload();
	   window.close();
	  </script>
    <?	 	
}
?>
<html>
<head>
<script language="javascript">
	function Modify_onclick()
	{
		
		document.frm.action="category_edt.php?Type=Mod";
		document.frm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="category_edt.php?Type=Del";
			document.frm.submit();
		}
	  return true;
	}
</script>
</head>
<body>
<?
if(isset($category))
{
   $result=execute("SELECT * FROM order_category  WHERE  status='1'");
		
	   if(rowcount($result)>0)
       {
	   ?>
	 <FORM id="frm" NAME="frm" ACTION="" METHOD="post">  
	  <table class='forumline' align='center' width='90%'>
      <tr>
      	  <td align='center' Class="head" colspan="3">CATEGORY TABLE</td>
       </tr>
		<tr height='22' >
		    <td width="21%" align='center' Class="row3">Select</td>
			<td width="33%" align='left' Class="row3">Product Category</td>	
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
            <td class="CBody" align='left'><Input Type="Text" Name="<?=$row[id]?>category" value="<?=$row[category]?>" size=40></td>
         
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	 
	   
 ?>
 </tr>
 </table>
<table align="center" border="0">
 <tr>
 	<td><Input type="submit" Name="Modify" value="Modify" onClick="return Modify_onclick()" class='bgbutton'></td>
    &nbsp;&nbsp;&nbsp;&nbsp;
 	<td><Input type="submit" Name="Delete" value="Delete" onClick="return Delete_onclick()" class='bgbutton'></td>
 </tr>
 </table>
  <?
 }
}
?>
</FORM>
</body>
</html>
 	