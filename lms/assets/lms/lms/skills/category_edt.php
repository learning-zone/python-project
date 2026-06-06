<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_GET)
{
	$Type = $_GET['Type'];
	$subject = $_REQUEST['subject'];
	$category = $_REQUEST['category'];
}
if($_POST)
{
	
	$term1 = $_POST['term1'];
	$term2 = $_POST['term2'];
	$term3 = $_POST['term3'];
	$term4 = $_POST['term4'];
	$term5 = $_POST['term5'];
	$term6 = $_POST['term6'];
	$title = $_POST['title'];
	$weight=$_POST['weight'];
	$subject = $_POST['subject'];
	$category = $_POST['category'];
	$description = $_POST['description'];

}


if($Type== "Update")
{
	 
	 $sqlUpdate="UPDATE `grade_category` SET `title` = '$title', `description` = '$description', `weight` = '$weight'";
	 $sqlUpdate .= " WHERE `id`= $category";
	
	 $resultUpdate=execute($sqlUpdate);
	 if($resultUpdate){
		 ?>
         	<script type="text/javascript">
			   alert('Records Updated');
			   window.opener.location.href='setupcat.php?category='+"<?=$category?>"+'&subject='+"<?=$subject?>";
			   window.close();
			 </script>
         <?
	 }
}
if($_POST['deled'])
{
	 
	 /* FIRST IT WILL CHECK ALL THE ASSIGNMENT RELATED TO THIS CATEGORY */	 
	 $chk=rowcount(execute("SELECT id FROM grade_assessment WHERE category_id='$category' AND status='1'"));
	 if($chk < 1)
	 {
	 
		 $sqlDelete="UPDATE `grade_category` SET `status` = '0' WHERE `id`= $category";
		 //echo "<br>".$sqlDelete;
			
		 $resultDelete=execute($sqlDelete);
		 if($resultDelete){
			 ?>
				<script type="text/javascript">
				   alert('Deleted Successfully');
				    window.opener.location.href='setupcat.php?tedrt=1&category='+"<?=$category?>"+'&subject='+"<?=$subject?>";				
				   window.close();
				 </script>
			 <?
		 }
	 }
	 else
	 {
		  ?>
			  <script type="text/javascript">
				 alert('First delete all the Assignments');
				 window.close();
			   </script>
		   <? 	
	 }
}
if($subject=='' or $category=='')
{
	?>
    	<script type="text/javascript">
		   alert('Please select Class and Category');
		   window.close();
		</script>
    <?
	
}
$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
?>
    <script language="javascript">
		alert("<?=$msg?>");
		window.close();
    </script>
<?
}
?>
<html>
<head>
<Script language="JavaScript">
  function RefreshMe()
  {
	  document.frm.action="category_edt.php";
	  document.frm.submit();
  }
  function adds_onclick()
  {
	  document.frm.action="category_edt.php?Type=Update";
	  document.frm.submit();
  }
  function WindowClose()
  {
	  window.close();
  }
</script>
</head>
<title>Edit Category</title>
<body>
<form method="post" name="frm">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="category" value="<?=$category?>">
 <?php
		
   $result=execute("SELECT * FROM `grade_category` WHERE `status`='1' AND `subject`='$subject' AND  `id`='$category'  ORDER BY id");
		
   while($row=fetcharray($result))
   {
?>
<table align='center' class='forumline' width='90%'>
<tr>
	<td width="50%">
    <table width="100%">
<tr>
	<td>&nbsp;&nbsp;Title</td>
    <td><input type="text" name="title" value="<?=$row['title']?>" size="30"></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Description</td>
    <td ><textarea rows="4" cols="30" name="description"><?=$row['description']?></textarea></td>
</tr>
<?
	$cal_method=fetcharray(execute("SELECT `cal_method` FROM `grade_setup` WHERE `subject`='$subject' AND `status`='1'"));
if($cal_method['cal_method']==2)
{?>
<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Weight&nbsp;</td>
    <td><input type="text" name="weight" value="<?=$row['weight']?>" placeholder="0" size="10"></td>
</tr>
<?
}
?>
<tr>
	<td align="center"><BR><BR><BR><BR><BR><BR></td>
</tr>
<tr>
	<td align="left"></td>
</tr>
</table>
</td>
<td width="50%">
<table width="100%">
<tr>
	 <td align="right"><!--<fieldset style="border: groove; border-width:1px; width: 200px; align:left;">
			<legend>Terms</legend>
            <?
				$t1='';
				$t2='';
				$t3='';
				$t4='';
				$t5='';
				$t6='';
				$term=$row['term'];
				$termArray=explode(',',$term);
				$t1=$termArray[0];
				$t2=$termArray[1];
				$t3=$termArray[2];
				$t4=$termArray[3];
				$t5=$termArray[4];
				$t6=$termArray[5];

			if($t1!='' and $t1!=' ')
			$aa='checked'; 
			
			if($t2!='' and $t2!=' ')
			$bb='checked'; 
			
			if($t3!='' and $t3!=' ')
			$cc='checked'; 
			
			if($t4!='' and $t4!=' ')
			$dd='checked'; 
			
			if($t5!='' and $t5!=' ')
			$ee='checked';
			
			if($t6!='' and $t6!=' ')
			$ff='checked';
						
				
			?>
        	<p align="left"><input type="checkbox" name="term1" value="t1" <?=$aa?> >T1</p>
            <p align="left"><input type="checkbox" name="term2" value="t2" <?=$bb?> >T2</p>
            <p align="left"><input type="checkbox" name="term3" value="t3" <?=$cc?> >T3</p>
            <p align="left"><input type="checkbox" name="term4" value="t4" <?=$dd?> >T4</p>
            <p align="left"><input type="checkbox" name="term5" value="t5" <?=$ee?> >T5</p>
            <p align="left"><input type="checkbox" name="term6" value="t6" <?=$ff?> >T6</p>
            
            <p align="left"></p>
            
            <p align="left">Select the terms in this category applies</p>
        </fieldset> -->  
    </td>
</tr>
</table>
</td>
</tr>
</table>
<?

   }
?>
<p align="center"><input type="button"  value="Save"  style="width:86px;" onClick="adds_onclick()" class="bgbutton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<input type="button"  value="Exit"  style="width:86px;" onClick="WindowClose()" class="bgbutton"></p>
<br>
 <div align="center">
    <input type="submit" name="deled" value="Delete" class="bgbutton" style="width:86px;"></div>	
 </form>
 </body>
</html>
