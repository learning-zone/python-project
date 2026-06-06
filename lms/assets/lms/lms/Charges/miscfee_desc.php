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
if($_POST)
{	
   $name=$_POST['name'];
   $m_id=$_POST['m_id']; 
   //$m_id1=$_POST['m_id1'];  
   $class=$_POST['class'];
   $a_year=$_POST['a_year'];
   $amount=$_POST['amount'];
}
if($_GET)
{	
   $m_id=$_REQUEST['m_id']; 
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
		document.frm.action="miscfee_desc.php";
		document.frm.submit();
		//alert('hi');
	}
	function adds_onclick()
	{
		document.frm.action="miscfee_desc_edt.php?Type=Add";
		document.frm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="miscfee_desc_edt.php?Type=Mod";
		document.frm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="miscfee_desc_edt.php?Type=Del";
		    document.frm.submit();
		}
		
		return true;
	}
</script>
<script language="javascript">
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>MISCELLANEOUS FEE STRUCTURE</title>
</head>
<body>
<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<table align='center' class='forumline' width='70%' >
		<tr height="25">
				<td align='center' Class='head' colspan=5>MISCELLANEOUS FEE STRUCTURE</td>
			</tr>
			<tr height="25">
				<td  nowrap align="center" class="row3">Group Name</td>
                <td nowrap align="center" class="row3">Class</td>
                <td nowrap align="center" class="row3">Academic Year</td>
             </tr>
             <tr>
				<td align="center"><select name='m_id' onChange="reloadMe()">
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
				<td align="center"><select name='class'>
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
                <td align="center"><select name="a_year" >
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
				<?php
					 }
						   ?>

              </select></td>
			</tr>
	</table><br>
 <!------------------------------------------------------------------------------------------------------------------------------>
 <?
	  $result=execute("SELECT * FROM `fee_misc_head` WHERE `m_id` = '".$_POST[m_id]."' AND status=1");
		
	   if(rowcount($result)>0)
       {
	   ?>

    <table align='center' class=forumline width='70%' >
      <tr height="25">
          <td align='center' Class='head' colspan=5>&nbsp;</td>
      </tr>
      <tr height="25">
      <?
	       while($row=fetcharray($result))
           {
		   			$string=$row['subgroup'];
			        $name = str_replace('_', ' ', $string);  //TO REPLACE "-" WITH SPACE
					$nameNew = preg_replace('/([1-9][0-9]*)/', ' ', $name); // TO HIDE NUMBERS IN WORD
		?>
          <td nowrap align="left">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <?=$nameNew?></td>
           <td nowrap align="left"><input type="text" name="<?=$row['subgroup']?>" value="" size="30"></td></tr>
        <?
		   }
		?>
       
	</table>
   <?
	}
?>
 <!------------------------------------------------------------------------------------------------------------------------------>
<p align="center">
   <input type="button"  value="ADD" LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton' style="width:60px; height:20px"></p>
 <BR>
 </FORM>
	
<?php

	   $fieldName=execute("SELECT * FROM `fee_misc_head` WHERE `m_id` = '".$_POST[m_id]."' AND `status` = 1");
		 
   		if(rowcount($fieldName)>0)
		{
   ?>
  <div style="overflow-y:hidden;overflow-x:scroll;">	   
	  <table class='forumline' align='center' width='98%'>
      	<tr><td Class="head" align='center' colspan="25">MISCELLANEOUS FEE STRUCTURE DETAILS</td></tr>
		<tr height='22'>
		    <td align='center' class="row3">Sl No.</td>
			<td align='center' class="row3">Fee Title</td>
            <td align='center' class="row3">Class</td>
            <td align='center' class="row3">Academic Year</td>
        <?     
			 while($rowField=fetcharray($fieldName))
			 {	
					$string=$rowField['subgroup'];
					$subgroup = str_replace('_', ' ', $string);	
					$subgroupNew = preg_replace('/([1-9][0-9]*)/', ' ', $subgroup); // TO HIDE NUMBERS IN WORD
									
		?>
             <td Class="row3" align="center"><?=$subgroupNew?></td>
	    <?
			 }
	    ?>
        	 <td align="center" Class="row3" >Action</td>  		
	   </tr>
<?
	  $resultDisp=execute("SELECT * FROM `fee_misc_m_desc` WHERE `status` = 1  AND `m_id` = '".$_POST[m_id]."' ORDER BY id");
		 $numRow=rowcount($resultDisp);
		 

	   	    $i=0;
            $rowclass=1;
            $sno=1; 
			$k=0;
           while($rowDisp=fetcharray($resultDisp))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
					echo  "<tr>";
			 
			 $feeTitle=fetcharray(execute("SELECT `name` FROM `fee_misc_m` WHERE id='$rowDisp[m_id]' LIMIT 1"));
 
			 $class=fetcharray(execute("SELECT `year_name` FROM `course_year` WHERE year_id='$rowDisp[class]' LIMIT 1"));	
			
			 ?>	         
            <td align='center'><?=$sno?></td>
			<td align='center'><?=$feeTitle[0]?></td>
            <?
				if($class[0]!='')
				{
			?>
            <td align='center'><?=$class[0]?></td>
            <?
				}else{   $class='Applied for all';
			?>
            <td align='center'><?=$class?></td>
            <?  }  ?>
            <td align='center'><?=$rowDisp['academic_yr']?></td>
       <?
	 //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	 $resultCol=execute("SELECT `subgroup` FROM `fee_misc_head` WHERE `status` = 1  AND `m_id` = '".$_POST[m_id]."' ORDER BY id");
	   
	   while($rowCol=fetcharray($resultCol))
       {
		   ?>
           	     <td align='center'><?=$rowDisp[$rowCol['subgroup']]?></td>			
           <?
	   }
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	   ?>                  
                  
              <td align='center'><input type="button"  value="Edit" href="javascript:void(0);" onClick ="OpenWind2('miscfee_desc_mod.php?MID=<?=$rowDisp['id']?>&m_id=<?=$m_id?>&Type=Mod', 'OpenWind2',1000,700)" class="bgbutton" style="width:60px; height:20px"></td></tr>
          	
                <?
									
					 $sno++;
						  
			 }
						         												 
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
       }
	  	
	   		 //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	  ?>
     <!-- <td align='center'><input type="button"  value="Edit" href="javascript:void(0);" onClick ="OpenWind2('miscfee_desc_mod.php?MID=<?=$row[id]?>&m_id=<?=$m_id?>&Type=Mod', 'OpenWind2',1000,700)" class="bgbutton" style="width:60px; height:20px"></td>--> 

 </table>
  </div>

<input type="hidden" name="m_id1" value="<?=$m_id?>">

</body>
</html>
