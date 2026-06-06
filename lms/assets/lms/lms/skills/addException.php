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
	$token = $_GET['token'];
	$exception = $_GET['exception'];
	$description = $_GET['description'];
}
if($_POST)
{
	$id=$_POST['id'];
	$exception = $_POST['exception'];
	$description = $_POST['description'];
}


if($Type== "add")
{
	 
	 $sqlInsert="INSERT INTO `grade_m_exception`(`exception`, `description`) VALUES('$exception', '$description')";
 	 echo "<br>".$resultInsert;
	 $resultInsert=mysql_query($sqlInsert) or die(mysql_error());
	 if($resultInsert){
		 ?>
         	<script type="text/javascript">
			   window.reload();
			 </script>
         <?
	 }
}
if($Type== "update")
{
	 
	 $sqlUpdate="UPDATE `grade_m_exception` SET `exception`='$exception', `description`='$description' WHERE `id`='$id'";
 	 //echo "<br>".$sqlUpdate;
	 $resultUpdate=mysql_query($sqlUpdate) or die(mysql_error());
	 if($resultUpdate){
		 ?>
         	<script type="text/javascript">
			   window.reload();
			 </script>
         <?
	 }
}
if($Type== "delete")
{
	 
	 $sqlUpdate="UPDATE `grade_m_exception` SET `status`='0' WHERE `id`='$id'";
 	 //echo "<br>".$sqlUpdate;
	 $resultUpdate=mysql_query($sqlUpdate) or die(mysql_error());
	 if($resultUpdate){
		 ?>
         	<script type="text/javascript">
			   window.reload();
			 </script>
         <?
	 }
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
  function RefreshMe(token)
  {
	  document.frm.action="addException.php?token="+token;
	  document.frm.submit();
  }
  function adds_onclick()
  {
	  document.frm.action="addException.php?Type=add";
	  document.frm.submit();
  }
  function update_onclick()
  {
	  document.frm.action="addException.php?Type=update";
	  document.frm.submit();
  }
  function delete_onclick()
  {
	  document.frm.action="addException.php?Type=delete";
	  document.frm.submit();
  }
  function WindowClose()
  {
	  window.close();
  }
</script>
</head>
<title>ADD NEW EVENT</title>
<body>
<form method="post" name="frm">
<!--<div style="overflow-x:hidden;overflow-y:scroll; height:250px">-->
<table align='center' class='forumline' width='90%' border="1">
    <tr>
      <td class="head" align="center">Exception</td>
      <td class="head" align="center">Description</td>
 <tr>
<?
		$result=mysql_query("SELECT * FROM `grade_m_exception` WHERE `status`=1 ORDER BY `id`");
		  $i=0;
		  $rowclass=1;
		  
		while($row=mysql_fetch_array($result))
        {
				if($i%2)
					echo "<tr class='clsname'>";
				else
					echo "<tr>";
     ?>
       
       <td align='left'>&nbsp;&nbsp;<a herf="addException.php?token=<?=$row['id']?>" onClick="RefreshMe('<?=$row['id']?>');" ><?=$row['exception']?></a></td>
       
       <td align='left'>&nbsp;&nbsp;<a herf="addException.php?token=<?=$row['id']?>" onClick="RefreshMe('<?=$row['id']?>');" ><?=$row['description']?>
       <input type="hidden" name="token" value="<?=$row['id']?>"/></a></td>
  </form>
        
     <?
	 	$i++;
		 
		       $rowclass = 1 - $rowclass;
		}
?>
</tr>
</table>
<!--</div>-->
<table align='center' class='forumline' width='90%' border="1">
   <tr>
   	<?
	      $event=mysql_fetch_array(mysql_query("SELECT `exception`, `description` FROM `grade_m_exception` WHERE id='$token' LIMIT 1"));
	?>
       <td><input type="text" name="event" value="<?=$event['exception']?>" size="58"></td>
       <td><input type="text" name="event" value="<?=$event['description']?>" size="70"></td>
   </tr>
</table>
<?
if($token!='')
{
	?>
	<p align="center"><input type="button"  value="Save"  style="width:86px; height:22px" onClick="update_onclick()" class="bgbutton">
	<? 
}else{ 
	?>
	<p align="center"><input type="button"  value="Save"  style="width:86px; height:22px" onClick="adds_onclick()" class="bgbutton">
	<?
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button"  value="Delete"  style="width:86px; height:22px" onClick="delete_onclick()" class="bgbutton"></p>
<input type="hidden" name="id" value="<?=$token?>"/>
 </form>
 </body>
</html>
