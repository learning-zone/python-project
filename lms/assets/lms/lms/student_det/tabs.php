<?php
session_start();
include("../db1.php");
$p=$_GET['p'];

$adate=$_POST['adate'];

?>
<!DOCTYPE html>
<head>
<style type="text/css">
<!--
	#tabcontent
	{
		min-height: 400px;
		
	}
-->
</style>
</head>
<body>
<div id="tabcontent">
<table class='forumline'  align='center' width='98%'>
 <tr>
<?
if($p==1)
{
     	 
   $sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `field_name` FROM `student_m_field` WHERE status=1 AND `tab_id`=1 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
					
					if($rf['field_type']=='DATE'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td ><input type="text" name="adate" value="<?php echo $adate ?>" readonly>&nbsp;&nbsp;
					  <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>  
                        <?
					}elseif($rf['field_name']=='course_admitted'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td ><select name="branch" onChange="reload(this.value)">
                        <option value="0">---- Select ----</option>
                        <?php
							  $sql="select course_id,coursename from course_m";
							  $rs=execute($sql) or die(error_description());
                
                                for($i=0;$i<rowcount($rs);$i++)
                                {
                                    $r=fetcharray($rs);             
                                    if($mod2[course_admitted]==$r[course_id])
                                    {
                                        ?>
                                        <option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
                                        <?php                
                                    }
                                }
                            ?>
                        </select></td>  
                        <?
					}elseif($rf['field_name']=='course_yearsem'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                       <td><div id="txtHint9" class="inline"><select name="sem">
                       <option value='0'>------- Select ------</option>
                       <?php
   
          $rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
        
                        while($r=fetcharray($rs))
                        {
                            if($mod2[course_yearsem]==$r[year_id])
                            {
                                echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
                            }
                            else
                            {
                                echo "<option value='$r[year_id]'>$r[year_name]</option>";
                            }
                        }
                    ?>
                   </select>
                </div>
                </td> 
                  <?
					}elseif($rf['field_name']=='academic_year'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td><select name="a_year" id="a_year" >
   						 <option value='0'>Select Year</option>
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
                  <?
					}
					else{
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td><input type="text" name="" value="" size="20"></td> 
                        <?
				
					}
		
					if($i%2==0){
						?>
                          </tr>
                        <?
					}
			
           	    ++$i;
            }
			
	?>
  <td></td><td></td></tr><tr></tr></table>

 <table class=forumline  align=center width="98%" >
 <tr> 
    <?
   			   
	}
elseif($p==2)
{
		   	
$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `field_name` FROM `student_m_field` WHERE status=1 AND `tab_id`=2 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
					
					
					if($rf['field_name']=='dob'){
						?>
                        <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td ><input type="text" name="bdate" value="<?=$bdate?>">&nbsp;&nbsp;
					  <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>  
                        <?
					
					}else{
						?>
                        <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td><input type="text" name="" value="" size="20"></td> 
                        <?
					}
			
					if($i%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$i;
            }
 ?>
  <td colspan="3"></td><td></td></tr><tr><td colspan="4"></td></tr></table>
 <table class=forumline  align=center width="98%" >
 <tr> 
    <?
   			   
	}
elseif($p==3)
{
			 
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE status=1 AND `tab_id`=3 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
				?>
                 <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                 <td><input type="text" name="" value="" size="20"></td>                      
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$i;
            }
 ?>
  <td></td><td></td></tr><tr><td colspan="4"></td></tr></table>
 <table class=forumline  align=center width="98%" >
 <tr> 
    <?
   			   
	}
elseif($p==4)
{
			 
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE status=1 AND `tab_id`=4 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
				?>
                 <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                 <td><input type="text" name="" value="" size="20"></td>                      
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$i;
            }
	 ?>
  <td colspan="3"></td><td></td></tr><tr><td colspan="4"></td></tr></table>
 <table class=forumline  align=center width="98%" >
 <tr> 
    <?
   			   
	}
elseif($p==5)
{
			
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE status=1 AND `tab_id`=5 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {

					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
				?>
                 <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                 <td><input type="text" name="" value="" size="20"></td>                      
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$i;
            }
	 ?>
  <td colspan="3"></td><td></td></tr><tr><td colspan="4"></td></tr></table>
 <table class=forumline  align=center width="98%" >
 <tr> 
    <?
   			   
	}
elseif($p==6)
{
			  
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE status=1 AND `tab_id`=6 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
				?>
                 <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                 <td><input type="text" name="" value="" size="20"></td>                      
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$i;
            }
   			   
	}
elseif($p==7)
{
			  
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE status=1 AND `tab_id`=7 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
				?>
                 <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                 <td><input type="text" name="" value="" size="20"></td>                      
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$i;
            }
   			   
	}
	
else
{
			  
   $sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE status=1 AND `tab_id`=$p ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
				?>
                 <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                 <td><input type="text" name="" value="" size="20"></td>                      
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$i;
                }  			   
	}
?>
</table>
</div>
</body>
</html>