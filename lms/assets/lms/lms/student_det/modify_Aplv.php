<?php
session_start();

$user=$_SESSION['user'];
$a_year=$_SESSION['AcademicYear'];

require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/



if (isset($_REQUEST['tab'])) {
		$tab = $_REQUEST['tab'];
	} else {
		$tab = 2;
	}
$p=$tab;



if($_GET)
{
	$un=$_REQUEST['un'];
	$flag=$_REQUEST['flag'];
	$token=$_REQUEST['token'];
	$fname=$_REQUEST['fname'];
	$StudID=$_REQUEST['StudID'];
	$app_nu=$_REQUEST['app_nu'];
	$StudID=$_REQUEST['StudID'];
	$studfname=$_REQUEST['studfname'];

}

if($_POST)
{
	$sel=$_POST['sel'];
	$sem=$_POST['sem'];
	$age=$_POST['age'];
	$dob=$_POST['dob'];
	$usn=$_POST['usn'];
	$mnum=$_POST['mnum'];
	$save=$_POST['save'];	
	$goadd=$_POST['goadd'];
	$g_num=$_POST['g_num'];
	$g_occ=$_POST['g_occ'];
	$State=$_POST['State'];
	$b_day=$_POST['b_day'];
	$adate=$_POST['adate'];
	$foadd=$_POST['foadd'];
	$m_occ=$_POST['m_occ'];
	$moadd=$_POST['moadd'];	
	$StudID=$_POST['StudID'];
	$g_mail=$_POST['g_mail'];
	$g_name=$_POST['g_name'];
	$m_name=$_POST['m_name'];
	$b_year=$_POST['b_year'];
	$a_year=$_POST['a_year'];
	$module=$_POST['module'];
	$branch=$_POST['branch'];
	$gender=$_POST['gender'];
	$g_quali=$_POST['g_quali'];
	$m_quali=$_POST['m_quali'];
	$m_email=$_POST['m_email'];
	$f_quali=$_POST['f_quali'];
	$f_email=$_POST['f_email'];
	$b_month=$_POST['b_month'];
	$remarks=$_POST['remarks'];
	$password=$_POST['password'];
	$username=$_POST['username'];
	$appl_num=$_POST['appl_num'];
	$fee_type=$_POST['fee_type'];
	$msgphone=$_POST['msgphone'];
	$rgmailid=$_POST['rgmailid'];
	$per_city=$_POST['per_city'];
	$cor_city=$_POST['cor_city'];
	$cor_phone=$_POST['cor_phone'];
	$per_state=$_POST['per_state'];
	$submodule=$_POST['submodule'];
	$last_name=$_POST['last_name'];
	$per_phone=$_POST['per_phone'];
	$cor_state=$_POST['cor_state'];
	$first_name=$_POST['first_name'];
    $img_source=$_POST['img_source'];
	$sms_mobile=$_POST['sms_mobile'];
	$cor_pincode=$_POST['cor_pincode'];
    $blood_group=$_POST['blood_group'];
	$birth_disct=$_POST['birth_disct'];
	$nationality=$_POST['nationality'];
	$parent_name=$_POST['parent_name'];
	$per_address=$_POST['per_address'];
	$per_country=$_POST['per_country'];
	$per_pincode=$_POST['per_pincode'];
	$cor_address=$_POST['cor_address'];
	$cor_country=$_POST['cor_country'];
	$uploadedfile=$_POST['uploadedfile'];
	$img_source_s=$_POST['img_source_s'];
	$mother_tongue=$_POST['mother_tongue'];
	$place_of_birth=$_POST['place_of_birth'];
	$parent_password=$_POST['parent_password'];
	$parent_username=$_POST['parent_username'];
	$parent_occupation=$_POST['parent_occupation'];

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<style type="text/css">
<!--
body
{
    font: 14px "Helvetica Neue", Helvetica, Arial, sans-serif;	
	margin: 20px 25px;
	
}
td
{
	padding:5px;
	
}
-->
</style>
<script language='javascript'>
 function reloadMe(str)
 {	 
	 document.frm.action="modify_Aplv.php?tab="+str;
	 document.frm.submit();
	 //alert('Tab'+ str);
 }
 function reload()
 {
	document.frm.action='modify_Aplv.php';
	document.frm.submit();
 }
</script>
<title>MODIFY STUDENT DETAILS</title>
</head>
<body>
<form name="frm" action="" method="post" ENCTYPE="multipart/form-data">
<input type="hidden" name="StudID" value="<?=$StudID?>"/>
<p>&nbsp;</p>
<table class="forumline" align=center width="98%" style="border-bottom:none;" >
<tr><td>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
   <ul class="tabHead">
    <?
	  
   		      $sqlT="SELECT `id`, `tab_name`, `description` FROM `student_m_tab` WHERE status='1' ORDER BY `id`";
			  $resultT=execute($sqlT) or die();
                $i=2;
			    while($rt=fetcharray($resultT))
                {
					
					   if($rt['id']==$p){
						   ?><li class="currentBtn"><?
					   }
					   else{
						   ?><li><?
						}
				?>
                 <a href="modify_Aplv.php?tab=<?=$i?>" title="<?=$rt['description']?>"><?=$rt['tab_name']?></a></li>
                <?
           			     ++$i;
                }
		 
		 
		
		 $details=fetcharray(execute("SELECT * FROM `student_m` WHERE id='$StudID' LIMIT 1"));
		 
		 //echo "<br>SELECT * FROM `student_m` WHERE id='$StudID' LIMIT 1";  			
      ?>        
 </ul>
</div>	
</div>	
</td>
            <!--<td align="right"><img height='150' width='170'  src=<?=$details[img_source]?> /></td>-->
            <td align="right"><img height='150' width='170'  src=""/></td>
     </tr>
    </table>
<table class='forumline'  align='center' width="98%" style="border-bottom:none;">
 <tr>
<?PHP
if($p==2)
{
			   	
$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `field_name` FROM `student_m_field` WHERE status=1 AND `tab_id`=2 ORDER BY `order`";
			 
			  $resultF=execute($sqlF) or die();
                $k=1;
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
					    <td nowrap><select name="b_day" onchange='reload()' disabled>
					  <?php
					  	    
							$newd=$details['dob'];
							$dateArray=explode('-',$newd);
							$b_day=$dateArray[2];
							$b_month=$dateArray[1];
							$b_year=$dateArray[0];
									
                        echo "<option value='0'>00</option>";
                        for($i=1;$i<=31;$i++)
                        {
                
                              if($i<10)
                                  $i="0".$i;
                   
                              $sel='';
                    
                              if($b_day==$i)
                    
                                  $sel='selected'; 
                    
                              echo "<option value='$i' $sel >$i</option>";
                
                        }
                        ?>
                  	  </select>
                  	  <select name="b_month" onchange='reload()' disabled>
                     <?php
                            echo "<option value='0'>00</option>";
                                for($i=1;$i<=12;$i++)
                                {
                
                                    if($i<10)
                
                                        $i="0".$i;
                
                                    $sel='';
                
                                    if($b_month==$i)
                
                                        $sel='selected';
                
                                    echo "<option value='$i' $sel >$i</option>";
                
                                }
                
                    ?>
                    </select>
                    <select name="b_year" onchange='reload()' disabled>
                      <?php
                
                                echo "<option value=0 >0000</option>";
                
                                $d=date('Y')-50;
                
                                $dd=date('Y');
                
                                for($i=$dd;$i>=$d;$i--)
                                {
                
                                      $sel='';
                
                                      if($b_year==$i)
                
                                        $sel='selected';
                
                                      echo "<option value=$i $sel >$i</option>";
                
                                 }
                
                                ?>
                
                    </select></td>
                
                    <?php
                
                    $d=date("d");
                
                    $m=date("m");
                
                    $y=date("Y");
                
                    if($b_month<$m)
                    {
                        $age_yr=$y-$b_year;
                    }
                    else
                    {
                        if($b_month==$m)
                        {
                            if($b_day<=$d)
                            {
                                $age_yr=$y-$b_year;
                            }
                            else
                            {
                                $age_yr=($y-$b_year)-1;
                            }
                        }
                        else
                        {
                            $age_yr=($y-$b_year)-1;
                        }
                    }
                				
					}elseif($rf['field_name']=='student_id'){
						?>
                        <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td title="It's ReadOnly">
          <input type="text" name="adm_num"  value="<?=$details['student_id']?>" size="20"  placeholder="Auto-generated" disabled></td>  
                        <?
					
					}elseif($rf['field_name']=='age'){
						?>
                        <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td title="It's ReadOnly">
                        <input type="text" name="age" value="<?=$details['age']?>" size="15" placeholder="Auto-generated" disabled></td>  
                        <?
					
					}elseif($rf['field_name']=='gender'){
						?>
                        <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td><select name="gender" disabled>
						 <?php
						 	$gender=$details['gender'];
                           if($gender== "M")
                           {
                              $one="selected";
                              $two="";
                            }    
                            if($gender== "F")
                            {
                              $two="selected";
                              $one="";
                            }
                           ?>
                          <option value="M" <?=$one?>>Male</option>
                          <option value="F" <?=$two?>>Female</option>
                      </select></td>
                        <?
					
					}elseif($rf['field_name']=='nationality'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td><select name="nationality" disabled>
                      <option value='0'>---- Select ----</option>
                          <?php
                               $res = execute("SELECT * FROM nationality");
								 $rel=$details['nationality'];
                               while($row = fetcharray($res))
                               {
                                  
								   if($rel==$row[id])
                                    {
                                        echo "<option value='$row[id]' selected>$row[nation]</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='$row[id]'>$row[nation]</option>";
                                    }
                               }
                            ?>
                        </select> </td> 
                        <?
					
					}elseif($rf['field_name']=='blood_group'){
						
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td><select name="blood_group" disabled>
                      <option value='NA'>---- Select ----</option>
                        <?php
								
								$b_group=$details['blood_group'];
                              if($b_group=="A+ve")
                              {
                                   $m="selected"; $n=""; $o=""; $p=""; $r=""; $s=""; $t=""; $u="";
                               }
                               if($b_group=="B+ve")
                               {
                                   $m="";$n="selected";$o=""; $p=""; $r=""; $s="";$t="";$u="";
                               }
                               if($b_group=="A-ve")
                               {
                                   $m=""; $n=""; $o="selected"; $p=""; $r=""; $s=""; $t=""; $u="";
            
                               }
                                if($b_group=="B-ve")
                                {
                                    $m=""; $n="";$o="";$p="selected";$r=""; $s=""; $t="";$u="";
            
                                }
                                if($b_group=="O+ve")
                                {
                                     $m="";$n="";$o="";$p=""; $r="selected"; $s=""; $t="";$u="";
            
                                }
                                if($b_group=="O-ve")
                                {
                                     $m="";$n="";$o=""; $p="";$r=""; $s="selected";$t="";$u="";
                                }
                                if($b_group=="AB+ve")
                                {
                                     $m=""; $n="";$o="";$p="";$r="";$s=""; $t="selected"; $u="";
            
                                 }
                                if($b_group=="AB-ve")
                                {
                                     $m="";$n=""; $o=""; $p=""; $r=""; $s="";$t=""; $u="selected";
            
                                }
                            ?>
            
                              <option value="A+ve" <?=$m?>>A Rh Positive</option>
                    
                              <option value="B+ve" <?=$n?>>B Rh Positive</option>
                    
                              <option value="A-ve" <?=$o?>>A Rh Negative</option>
                    
                              <option value="B-ve" <?=$p?>>B Rh Negative</option>
                    
                              <option value="O+ve" <?=$r?>>O Rh Positive</option>
                    
                              <option value="O-ve" <?=$s?>>O Rh Negative</option>
                    
                              <option value="AB+ve" <?=$t?>>AB Rh Positive</option>
                    
                              <option value="AB-ve" <?=$u?>>AB Rh Negative</option>
                
                        </select> </td>

                        <?
					
					}elseif($rf['field_name']=='img_source'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td><input type='FILE' name='uploadedfile' value="" size='20' disabled></td>
                        <?
					
					}elseif($rf['field_name']=='img_source_s'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                       <td><input type="email" name="img_source_s" value="<?=$details['img_source_s']?>" size="30" disabled></td> 
                    <?	
					}elseif($rf['field_name']=='mother_tongue'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td ><select name="mother_tongue" disabled>
                      <option value='0'>---- Select ----</option>
					  <?php
							$qq="SELECT id,lang FROM language";
			
							$mother=$details['mother_tongue'];
					       
						    $qqq=execute($qq) or die(error_description());
							for($i=0;$i<rowcount($qqq);$i++)
							{
								$myq=fetcharray($qqq);
                                if($mother==$myq[id])
								{
									?>
	  							<option value="<?=$myq[id]?>" selected><?=$myq[lang]?></option>
	  								<?php
								 }
						    	 else
								 {
									?>
	  							<option value="<?=$myq[id]?>"><?=$myq[lang]?></option>
	 						 <?php
						      }
						}
					?>
	  				</select></td>
                    <?	
					}
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	              elseif($rf['field_type']=='DATE'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td ><input type="text" name="adate" value="<?=$details['dob']?>" disabled>&nbsp;&nbsp;
					  <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>  
                        <?
					}elseif($rf['field_name']=='admission_id'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td title="It's ReadOnly">
                      <input type="text" name="appl_num" value="<?=$details['admission_id']?>"  size="20"  disabled></td>  
                        <?
					}elseif($rf['field_name']=='course_admitted'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                     <td><select name="branch" id="branch" onchange='reload()' disabled>
                		<option value='0'>------- Select ------</option>
                	    <?php
                               $sql="select course_id,coursename from course_m";
							         $branch=$details['course_admitted'];
               
			                    $rs=execute($sql) or die(error_description());
                

                                for($i=0;$i<rowcount($rs);$i++)
                                {
                
                                  $r=fetcharray($rs);
								  
                                    if($branch==$r[course_id])
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
                        </select>
                        </td>
 
                        <?
					}elseif($rf['field_name']=='course_yearsem'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                       <td><select name="sem" id="sem" onchange='reload()' disabled>
                        <option value='0'>------- Select ------</option>
                        <?php
            
      $rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
            
                            $sem=$details['course_yearsem'];
							
						    while($r=fetcharray($rs))
                            {
                                if($sem==$r[year_id])
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
				 </td>
                  <?
					}elseif($rf['field_name']=='academic_year'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td><select name="a_year" id="a_year" onchange='reload()' disabled>
   						 <option value='0'>Select Year</option>
   						 <?php
						   $a_year=$details['academic_year'];
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
								<option value="<?=$i?>" <?=$sele?>><?=$Fyear?> - <?=$Tyear?></option>
								<?php
							 }
			 	 ?>
             	 </select></td>
                  <?
					}elseif($rf['field_name']=='admission_type'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td><select name="fee_type" disabled>
                      <option value='0'>---- Select ----</option>
					  <?php
							$qq="SELECT id,name FROM admission";
							
					        $qqq=execute($qq) or die(error_description());

							for($i=0;$i<rowcount($qqq);$i++)
							{
								$myq=fetcharray($qqq);
								
                                if($details['admission_type']==$myq[id])

								{
									?>
									<option value="<?=$myq[id]?>" selected><?=$myq[name]?></option>
									<?php
							     }
								 else
								 {
									?>
									<option value="<?php echo $myq[id]?>"><?=$myq[name]?></option>
									<?php
						          }
						      }
						 ?>
              		</select></td>
                  <?
					}else{
						?>
                  <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                  <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20" disabled></td> 
                        <?
					}
			
					if($k%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$k;
            }
 ?>
 <td colspan="4"></td>
  <tr><td colspan="4"><div style="height:20px;"></div></td></tr></table>

 <table class=forumline  align=center width="98%" style="border-bottom:none;">
 <tr> 
    <?
   			   
	}
elseif($p==3)
{
			 
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `field_name` FROM `student_m_field` WHERE status=1 AND `tab_id`=3 ORDER BY `order`";
			  $resultF=execute($sqlF) or die();
                $k=1;
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
                 <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20" disabled></td>                      
                <?
					if($k%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$k;
            }
 ?>
 
  <td></td><td></td></tr><tr><td colspan="4"><div style="height:150px;"></div></td></tr></table> 

   <table class=forumline  align=center width="98%" >
 <tr> 
    <?
   			   
	}
elseif($p==4)
{
			 
$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `field_name` FROM `student_m_field` WHERE status=1 AND `tab_id`=4 ORDER BY `order`";
			  $resultF=execute($sqlF) or die();
                $k=1;
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
                 <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20" disabled></td>                      
                <?
					if($k%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$k;
            }
	 ?>
  <td colspan="3"></td><td></td></tr><tr><td colspan="4"></td></tr></table>

 <table class=forumline  align=center width="98%" >
 <tr> 
    <?
   			   
	}
elseif($p==5)
{
			
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `field_name` FROM `student_m_field` WHERE status=1 AND `tab_id`=5 ORDER BY `order`";
			  $resultF=execute($sqlF) or die();
                $k=1;
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
                 <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20" disabled></td>                      
                <?
					if($k%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$k;
            }
	 ?>
  <td colspan="3"></td><td></td></tr><tr><td colspan="4"><div style="height:50px;"></div></td></tr></table>

 <table class=forumline  align=center width="98%" >
 <tr> 
    <?
   			   
	}
elseif($p==6)
{

      /*$sql=execute("select * from certificate_m where status=1 order by id") or die(error_description());
		$count=0;
		
		for($i=0;$i<rowcount($sql);$i++)
		{
		
			$sel=$_POST['sel'];
			$r1=fetcharray($sql);
			$count=$count+1;
		
			if($sel[$i])
				$check='checked';
			else
				$check='';
			?>
		
				<td>&nbsp;<input type="checkbox" name="sel[]" value="<?=$r1["id"]?>"  <?=$check?>></td>
                <td><?=$r1["name"]?></td>
				<?
                if($count==4)
                {
                    echo "</tr>";
                    $count=0;
                }
		}*/
		?>
        <tr>
			<td colspan="8">&nbsp;</td>
		</tr>
		<tr>
			<td align='RIGHT'>Remarks</td>
			<td colspan="8"><textarea rows="5" cols="100" name='remarks' disabled><?=$details['remarks']?></textarea></td>
		</tr>
        <tr>
			<td colspan="8"><div style="height:100px;"></div></td>
		</tr>
    </table>

 <table class=forumline  align=center width="98%" >
 <tr> 
 <?	   
 }
elseif($p==7)
{
	?>		  
	<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Student Username</td>   
		<td><input type='text' name='username'  value="<?=$details['username']?>" size='20' disabled ></td>
		<td>Student Password</td>
		<td><input type="text" name='password'  value="<?=$details['password']?>" size='20' disabled ></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Parent Username</td>
		<td><input type='text' name='parent_username'  value="<?=$details['parent_username']?>" size='20' disabled></td>
		<td>Parent Password</td>
		<td><input type="text" name='parent_password'  value="<?=$details['parent_password']?>" size='20' disabled ></td>
	</tr>
    <tr>
		<td colspan="5"><div style="height:150px;"></div></td>
	</tr>
  </table>
 <table class=forumline align=center width="98%" >
 <tr>
   <?			   
}	
else
{
			  
  $sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE status=1 AND `tab_id`=$p ORDER BY `order`";
			  $resultF=execute($sqlF) or die();
                $k=1;
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
                 <td><input type="text" name="" value="" size="20" disabled></td>                      
                <?
					if($k%2==0){
						?>
                           </tr>
                        <?
					}
           			     ++$k;
                }  			   
	}
?>
 
</table>
</form>	
</body>
</html>