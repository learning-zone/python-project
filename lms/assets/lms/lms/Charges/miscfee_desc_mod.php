<?php
session_start();
require_once("../db.php");
/*
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
*/
$msg=$_REQUEST['msg'];
if($_GET)
{	
   $MID = $_GET['MID'];
   $m_id = $_GET['m_id'];
   $Type = $_GET['Type'];
}
if($_POST)
{	
   $id = $_POST['id'];
   $name = $_POST['name'];
   $m_id = $_POST['m_id'];  
   $class = $_POST['class'];
   $a_year = $_POST['a_year'];

}
if($Type == "UPDATE")
{ 
      
	  $sql="UPDATE `fee_misc_m_desc` SET  `class` = '$class', `academic_yr` = '$a_year' WHERE `id` = '$id'";
	  //echo "<br>".$sql;
	   $resultSql=execute($sql);
	 
	 	//TO FETCH THE POST VALUE DYNAMICALLY	
		$i = 0;	
		$result=execute("SELECT * FROM `fee_misc_head` WHERE `m_id` = '$m_id' AND `status`=1");
		while($row=fetcharray($result))
		{
			 $fieldname1=$row['subgroup'];
			 $fieldname[]=$row['subgroup'];
			 $postvalue[]=$_POST[$fieldname1];
			 
			  $sqlUpdate="UPDATE `fee_misc_m_desc` SET `$fieldname[$i]` = '$postvalue[$i]'  WHERE `id` = '$id'";
			  //echo "<br>".$sqlUpdate; 
			  $resultUpdate = execute($sqlUpdate);
		     
		   $i++;
		}
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 
	if($result) 
	{
			?>
			   <script type="text/javascript">
				 alert("Records Updated");				
				  window.opener.location.reload();
				  window.close();
				</script>
				
            <?
	}
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
	function reloadMe()
	{
		document.frm.action="miscfee_desc_mod.php";
		document.frm.submit();
		
	}
</script>
<script language="javascript">
	function update_onclick()
	{
		document.frm.action="miscfee_desc_mod.php?Type=UPDATE";
		document.frm.submit();
		
	}
</script>
<title>MODIFY MISCELLANEOUS FEE STRUCTURE</title>
</head>
<body>
<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
<?
	
	$result=execute("SELECT * FROM `fee_misc_m_desc` WHERE `m_id` = '$m_id' AND `status` = 1  AND `id` = '$MID'");
		 
   		while($rs=fetcharray($result))
	    {
			  $m_id = $rs['m_id'];
			  $class = $rs['class'];
			  $a_year = $rs['a_year'];
?>
	<table align='center' class=forumline width='70%' >
			<tr height="25">
				<td align='center' Class='head' colspan=5>MODIFY MISCELLANEOUS FEE STRUCTURE</td>
			</tr>
			<tr height="25">
				<td nowrap align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Group Name</td>
                <td><select name='m_id' disabled>
                <option value=''>-------  Select   -------</option>
					<?php
					$sql=execute("SELECT * FROM `fee_misc_m` WHERE `status` = 1 ORDER BY `id`");
						while($row=fetcharray($sql))
						{
							if($m_id==$row['id'])
							echo "<option value='$row[id]' selected>$row[name]</option>";
							else
							echo "<option value='$row[id]' >$row[name]</option>";
						}
					?>
				</select></td>
             </tr>
             <tr>
                <td nowrap align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Class</td>
                <td><select name='class'>
                <option value='0'>--- Apply for all ---</option>
					<?php
					$sql=execute("SELECT * FROM `course_year` WHERE `status` = 1 ORDER BY `year_id`");
						while($row=fetcharray($sql))
						{
							if($class==$row['year_id'])
							echo "<option value='$row[year_id]' selected>$row[year_name]</option>";
							else
							echo "<option value='$row[year_id]' >$row[year_name]</option>";
						}
					?>
				</select></td>
           </tr>
           <tr>
                <td nowrap align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Academic Year</td>
                <td><select name="a_year" >
                <option value='0'>-- Academic Year --</option>
                <?php 	
				   $MyYear=date('Y')-1;
				   $CurrentYr=date("Y")+2;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					 {

						$Fyear=$i;

						$Tyear=$i+1;

						$Tyear=substr($Tyear,2);

						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}

						else
						{

							if($i==$a_year)

							$sele="selected";

						}
						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
				<?
					 }
				?>

              </select></td>
             </tr>

 <!------------------------------------------------------------------------------------------------------------------------------>
 <?
	  $resultDisplay=execute("SELECT * FROM `fee_misc_head` WHERE `m_id` = '$m_id' AND status=1");
		
	   if(rowcount($resultDisplay)>0)
       {
	   ?>


      <tr height="25">
      <?
	       while($r=fetcharray($resultDisplay))
           {
		   			$string=$r['subgroup'];
			        $name = str_replace('_', ' ', $string);  //TO REPLACE "-" WITH SPACE
		?>
          <td nowrap align="left">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <?=$name?></td>
           <td nowrap align="left"><input type="text" name="<?=$r['subgroup']?>" value="<?=$rs[$string]?>" size="18"></td></tr>
        <?
		   }
		?>       
	</table>
   <?
	}
?>

 <input type="hidden" name="id" value="<?=$rs[id]?>">
 <input type="hidden" name="m_id" value="<?=$m_id?>">
<p align="center"><input type="button"  value="UPDATE" LANGUAGE=javascript onClick="update_onclick()" class='bgbutton'></p>
<?
}
?>    	

</form>
 </body>
 </html>
