<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user = $_SESSION['user'];
$a_year = $_SESSION['AcademicYear'];
if($_GET)
{
	$Type=$_REQUEST['Type'];
	$subject=$_REQUEST['subject'];	
}
if($_POST)
{
	
	$term=$_POST['term'];
	$subject=$_POST['subject1'];
	$grade_type = $_POST['grade_type'];
}

if($Type=="Add")
{
	$sql="UPDATE `grade_setup` SET `grade_type`='$grade_type' WHERE `subject`='$subject' AND `term`='$term'";
	//echo "<br>".$sql;
	$result=execute($sql) or die(mysql_error());
	
	  if($result)
	  {
		  $msg="Records Added";
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=load_grade.php?msg=$msg'>";
	  }
	  else
	  {		   
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=load_grade.php'>";
	  } 
}
$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
?>
    <script type="text/javascript">
		alert("<?=$msg?>");
		window.opener.location.reload();
		window.close();
    </script>
<?
}
if($subject=='')
{
	?>
    	<script type="text/javascript">
		   alert('Please select class first');
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
	  document.frm.action="load_grade.php";
	  document.frm.submit();
  }
  function WindowClose()
  {
	  window.close();
  }
  function adds_onclick()
  {
	  document.frm.action="load_grade.php?Type=Add";
	  document.frm.submit();
  }
</script>
</head>
<title>LOAD GRADES</title>
<body>
<form method="post" name="frm">
<input type="hidden" name="subject1" value="<?=$subject?>">
<table align='center' class='forumline' width='90%' >
<tr>
      <td align="right">
      <fieldset style="border: groove; border-width:1px; width: 100px; height:100px; align:left;">
		<legend>Term</legend><BR>
        <select name="term">
          <option value="">--- Select ---</option>
          <?php
          $sql=execute("SELECT `id`, `term` FROM `academic_term` WHERE `a_year`='$a_year' AND `status`=1  ORDER BY `id`");
		          //$term=$rermDate[0];
          while($r2=fetcharray($sql))
          {
              if($term==$r2[id])
                  echo "<option value=$r2[id] selected>$r2[term]</option>";
              else
                  echo "<option value=$r2[id]>$r2[term]</option>";
          }
      ?>
           </select></fieldset></td>

	</td>
      	<td><fieldset style="border: groove; border-width:1px; width: 100px; height:100px; align:left;">
			<legend>Grade Type</legend>
            <?
				$first='';$second='';
			
				if($val=='number'){
					$first='checked';
				}
				if($val=='alphabet'){
					$second='checked';
				}
			?>
        	<p align="left"><input type="radio" name="grade_type" value="number" required <?=$first?>>&nbsp;Number</p>
            <p align="left"><input type="radio" name="grade_type" value="alphabet" required <?=$second?>>&nbsp;Letter</p>         
        </fieldset>
    </td>
</tr>
</table>

<p align="center"><input type="button"  value="Save"  style="width:86px; height:22px" onClick="adds_onclick()" class="bgbutton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<input type="button"  value="Exit"  style="width:86px; height:22px" onClick="WindowClose()" class="bgbutton"></p>
 </form>
 </body>
</html>
