<?php
session_start();
require_once("../db.php");

$msg=$_REQUEST['msg'];
if($_POST)
{
	
   $id=$_POST['id'];
   $name=$_POST['name'];
   $description=$_POST['description'];
}

if($msg)
{
?>
   <script language="javascript">
	alert("<?=$msg?>");
   </script>
<?php
}
?>
<html>
<head>
<script language="javascript">
	function adds_onclick()
	{
		document.frm.action="miscfee_edt.php?Type=Add";
		document.frm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="miscfee_edt.php?Type=Mod";
		document.frm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="miscfee_edt.php?Type=Del";
		    document.frm.submit();
		}
		
		return true;
	}
</script>
</script>
<title>MISCELLANEOUS FEE GROUP</title>
</head>
<body>
<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<br/>
	<table align='center' class=forumline width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>MISCELLANEOUS FEE GROUP</td>
			</tr>
            <tr height="25">
				<td class="row3">Name</td>
                <td class="row3">Description</td>
			</tr>
			<tr height="25">	
			   <td align="center"><INPUT TYPE="text"  NAME="name" value="<?=$name?>" size="50"></td>
               <td align="center"><textarea  style="width: 300px; height: 40px;" name="description"><?=$description?></textarea></td>
			</tr>
	</table>
        <br/>
        <p align="center"><input type="button"  value="&nbsp;&nbsp; Add &nbsp;&nbsp; " LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>
	
<?php
		
	   $result=execute("SELECT * FROM `fee_misc_m` WHERE status=1 ORDER BY id");
		
	   if(rowcount($result)>0)
       {
	   ?>
	   
	  <table class='forumline' align='center' width='90%'>
		<tr height='22' >
		    <td Class="head" align='center'>Select</td>
			<td Class="head" align='center'>Name</td>
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
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>name" value="<?=$row[name]?>" size=50></td>
   <td align='left'><textarea  style="width: 300px; height: 40px;" Name="<?=$row[id]?>description"><?=$row[description]?></textarea></td>

	
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	 

 ?>
 </table>
 	<p align="center">
		<Input type="submit" Name="Modify" value="MODIFY" LANGUAGE=javascript onClick="return Modify_onclick()" class='bgbutton'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Input type="submit" Name="Delete" value="DELETE" LANGUAGE=javascript onClick="return Delete_onclick()" class='bgbutton'> </p>
   <?
    }
?>
</form>

 </body>
 </html>
