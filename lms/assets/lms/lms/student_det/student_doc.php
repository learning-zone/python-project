<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_GET)
{
	$type=$_GET['type'];
	$student_id=$_GET['student_id'];
}
if($_POST)
{
	$Sel=$_POST['Sel'];
	$type=$_POST['type'];
	$Update=$_POST['Update'];
	//$student_id=$_POST['student_id'];
}
if($_REQUEST['Types'] == "ADD")
{
    $n=sizeof($Sel);
	for($i=0;$i<$n;++$i)
	{
      $val=$Sel[$i];
	  	  
	  $description=$_POST[$val.'description'];
      
	  $sql="UPDATE `student_m_doc` SET `description` = '$description' WHERE `id` = '$val'";
	 	   
	   $result=mysql_query($sql) or die(mysql_error());
	}
	
	if($result)
	{
		 	?>
   		 <script language="javascript">
			alert('Records Updated');
			window.close();
		</script>
    <?
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
<script language='javascript'>
	function reloadMe()
	{
		document.frm.action="student_doc.php";
		document.frm.submit();
	}
	function update()
	{
		document.frm.action="student_doc.php?Types=ADD";
		document.frm.submit();
	}
</script> 
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>IMAGE PREVIEW</title>
</head>
<body>
<form name="frm" method="post" action="student_doc.php">
<?

if($type=="doc_edt")
{
	
	$result=mysql_query("SELECT * FROM `student_m_doc` WHERE `status` = 1 AND `student_id`='$student_id' ORDER BY id DESC");
	$records=rowcount($result);
	
	if($records==0)
	{
		die('<center><blink>No Record Found !!!</blink></center>');
	}

?>
 <table  class='forumline' align='center' width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
		<td colspan="4" class="head" align="center">View Documents</td>
   </tr>
   <tr>
        <td width="10%" align="center" class="rowpic">Sl.No.</td>
        <td align="center" class="rowpic" nowrap="nowrap">Date Added</td>
        <td width="40%" align="center" class="rowpic" nowrap="nowrap">Description</td>
        <td align="center" class="rowpic">Action</td>
  </tr>
  <?
    
	$sno=1;
	while($r=mysql_fetch_array($result))
	{
	?>
		<tr height='25'>
            <input type="hidden" name="Sel[]" value="<?=$r[id]?>">
			<td align='center'><?=$sno?></td>
			<td align='center' nowrap><? print( date("d M Y", strtotime($r[inserted_date])));?></td>
            <td align='center' nowrap >
            <textarea Name="<?=$r[id]?>description" cols="32" rows="1"><?=$r[description]?></textarea></td>
            
            <div id="thumbs">
            <td align='center' nowrap valign="middle">
			<!--<a href="product_image.php?token=<?=$r[id]?>" title="DELETE THIS PICS">-->
            <a href="<?=$r[imagepath]?>" title="Click to Download this">
			
           <!---------------------------------------------------------------------->
           <?
		   
	
			  $image=$r[imagepath];
			  $extension = end(explode('.',$image));
			  //echo "<br>Extension :".$extension;
			  if($extension=="ppt" or $extension=="pptx"){
				  ?>
				  <img height='46' width='70' src="../images/ppt.png"/>
			  	  <?
			  }elseif($extension=="doc" or $extension=="docx"){
				  ?>
			 	 <img height='46' width='70' src="../images/word.png"/>
			      <?
			  }
			  elseif($extension=="xls" or $extension=="xlsx"){
				  ?>
			 	 <img height='46' width='70' src="../images/excel.png"/>
			      <?
			  }
			  elseif($extension=="pdf"){
				  ?>
			 	 <img height='46' width='70' src="../images/pdf.png"/>
			      <?
			  }else{
				  ?>
                 <img height='46' width='70' src="<?=$r[imagepath]?>" />
                  <?
			  }
			  
			?>	           	
			</a></td></div>
		</tr>
   <?
  	$sno++;
	//echo $r['imagepath'];
	
	} //WHILE LOOP
?>
			
<?
}// IF CONDITION

?>
</table>
<p align="center"><input type="button" value="Update" name="Update" class="bgbutton" onClick="update()"></p>
 </form>	
</body>
</html>