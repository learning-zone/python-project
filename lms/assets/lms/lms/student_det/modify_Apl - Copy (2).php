<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$a_year=$_SESSION['AcademicYear'];

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

if($_GET['val']!='')
{
	$p=$_REQUEST['val'];	
}
else
{
	$p=$_POST['val'];
}

/*if($_POST['branch']!='')
{
	$p=1;

}*/

 	if($branch!=0 && $sem!=0 && $a_year!=0)
	{

			$new=substr($a_year,-2);

			$siddet=fetcharray(execute("SELECT student_id FROM `course_year` where year_id='$sem'"));

			$da=$siddet[0];	

			$res = execute("SELECT max(RIGHT(`admission_id`,4)) FROM `student_m` ");

			$row = fetchrow($res);

			$varb = $da.$new.($row[0]+1);

			$app_num = $varb;

			$papp_num = $app_num."P";

	}
	
if($_POST['one'] == "NEXT")
{
	
			$dateArray=explode('/',$adate);
			$acq_yy=$dateArray[2];
			$acq_mm=$dateArray[1];
			$acq_dd=$dateArray[0];
			$admission_date="$acq_yy-$acq_mm-$acq_dd";
			
			$parent_username="$appl_num"."P";
			$parent_password="$appl_num"."P";
					
	$sqlOne="UPDATE `student_m` SET `admission_id`='$appl_num', `admission_date`='$admission_date', `student_id`='$appl_num', `course_admitted`='$branch', `course_yearsem`='$sem', `academic_year`='$a_year', `admission_type`='$fee_type', `username`='$appl_num', `password`='$appl_num', `parent_username`='$parent_username', `parent_password`='$parent_password' WHERE id=$StudID";
	
	//echo "<br>".$sqlOne;
	$resultOne=execute($sqlOne) or die(mysql_error());
	
	if($resultOne)
	{
		echo "<META http-equiv='refresh' content='0;URL=modify_Apl.php?val=2&StudID=$StudID'>";
	}
}
if($_POST['two'] == "NEXT")
{
	
	$dob="$b_year-$b_month-$b_day";
			
	$sqlTwo="UPDATE `student_m` SET `first_name`='$first_name', `last_name`='$last_name', `dob`='$dob', `age`='$age',";
	$sqlTwo.=" `gender`='$gender', `place_of_birth`='$place_of_birth', `birth_disct`='$birth_disct', `State`='$State',";
	$sqlTwo.=" `nationality`='$nationality', `blood_group`='$blood_group', `img_source`='$img_source', `img_source_s`='$img_source_s',";
	$sqlTwo.=" `mother_tongue`='$mother_tongue' WHERE id=$StudID";
	
	//echo "<br>".$sqlTwo;
	
	$resultTwo=execute($sqlTwo) or die(mysql_error());
	
	$branch=fetcharray(execute("SELECT course_admitted FROM `student_m` where id='$StudID'"));
	$branch=$branch[0];	
		
	if( basename( $_FILES['uploadedfile']['name'])!='')
	{
		$directory = "img.$branch";			
		if (file_exists("../student_images/$directory") == false)
			$dir_created= mkdir("../student_images/$directory",0777);		
		$target_path = basename($_FILES['uploadedfile']['name']);
		$var1 = explode(".",$target_path);
		$var3 = time().".".$var1[1];
		$target_path = "../student_images/$directory/".$var3;
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			$nop=execute("UPDATE student_m SET img_source='$target_path' WHERE id='$StudID'");
		}
	}
	
	if($resultTwo)
	{
		echo "<META http-equiv='refresh' content='0;URL=modify_Apl.php?val=3&StudID=$StudID'>";
	}
}
if($_POST['three'] == "NEXT")
{
		
	$sqlThree="UPDATE `student_m` SET `msgphone`='$msgphone', `usn`='$usn', `rgmailid`='$rgmailid' WHERE id='$StudID'";
	
	//echo "<br>".$sqlThree;
	
	$resultThree=execute($sqlThree) or die(mysql_error());
	

	if($resultThree)
	{
		echo "<META http-equiv='refresh' content='0;URL=modify_Apl.php?val=4&StudID=$StudID'>";
	}
}
if($_POST['four'] == "NEXT")
{
			
 $sqlFour="UPDATE `student_m` SET `parent_name`='$parent_name', `parent_occupation`='$parent_occupation', `sms_mobile`='$sms_mobile',";   $sqlFour.=" `f_email`='$f_email', `f_quali`='$f_quali', `foadd`='$foadd', `m_name`='$m_name', `m_occ`='$m_occ', `mnum`='$mnum',";
 $sqlFour.=" `m_email`='$m_email', `m_quali`='$m_quali', `moadd`='$moadd', `g_name`='$g_name', `g_occ`='$g_occ', `g_num`='$g_num',";
 $sqlFour.=" `g_mail`='$g_mail', `g_quali`='$g_quali', `goadd`='$goadd' WHERE id='$StudID'";
	
	//echo "<br>".$sqlFour;
	
	$resultFour=execute($sqlFour) or die(mysql_error());
	

	if($resultFour)
	{
		echo "<META http-equiv='refresh' content='0;URL=modify_Apl.php?val=5&StudID=$StudID'>";
	}
}
if($_POST['five'] == "NEXT")
{
			
 $sqlFive="UPDATE `student_m` SET `per_address`='$per_address', `per_city`='$per_city', `per_state`='$per_state',";
 $sqlFive.="`per_country`='$per_country', `per_pincode`='$per_pincode', `per_phone`='$per_phone', `cor_address`='$cor_address',";
 $sqlFive.=" `cor_city`='$cor_city', `cor_state`='$cor_state', `cor_country`='$cor_country', `cor_pincode`='$cor_pincode',";
 $sqlFive.=" `cor_phone`='$cor_phone' WHERE id='$StudID'";
	
    //echo "<br>".$sqlFive;
	
	$resultFive=execute($sqlFive) or die(mysql_error());
	

	if($resultFive)
	{
		echo "<META http-equiv='refresh' content='0;URL=modify_Apl.php?val=6&StudID=$StudID'>";
	}
}
if($_POST['six'] == "NEXT")
{
	
	$id=fetcharray(execute("SELECT MAX(id) FROM `student_m` LIMIT 1"));
			
 $sqlSix="UPDATE `student_m` SET `remarks`='$remarks' WHERE id='$StudID'";
	
	//echo "<br>".$sqlSix;
	
	$resultSix=execute($sqlSix) or die(mysql_error());
	
	if(is_array($sel))
	{

		 while( list(,$value)=each($sel))

		 {

			 $ce= $value;

			 $var12="insert into certificate_det(new_id,stud_id,cert_id,status) values ('$photoid','$appl_num','$ce','true')";

			 execute($var12) or die(mysql_error()."a2");

		 }

	}
	

	if($resultSix)
	{
		echo "<META http-equiv='refresh' content='0;URL=modify_Apl.php?val=7&StudID=$StudID'>";
	}
}
if($_POST['seven'] == "END")
{
		
 $sqlSeven="UPDATE `student_m` SET `username`='$username', `password`='$password', `parent_username`='$parent_username', `parent_password`='$parent_password' WHERE id='$StudID'";
	
	//echo "<br>".$sqlSeven;
	
	$resultSeven=execute($sqlSeven) or die(mysql_error());
	

	if($resultSeven)
	{
		echo "<META http-equiv='refresh' content='0;URL=modify_Apl.php?val=1&StudID=$StudID'>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
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
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script language='javascript'>
 function reloadMe(str)
 {	 
	 document.frm.action="modify_Apl.php?val="+str;
	 document.frm.submit();
 }
 function reload()
 {
	document.frm.action='modify_Apl.php';
	document.frm.submit();
 }
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
		$(function() {
			
			var indicator = $('#indicator'),
					indicatorHalfWidth = indicator.width()/2,
					lis = $('#tabs').children('li');
					
			$("#tabs").tabs("#content section", {
				effect: 'fade',
				fadeOutSpeed: 0,
				fadeInSpeed: 400,
				onBeforeClick: function(event, index) {
					var li = lis.eq(index),
					    newPos = li.position().left + (li.width()/2) - indicatorHalfWidth;
					indicator.stop(true).animate({ left: newPos }, 600, 'easeInOutExpo');

				}
			});	

		});

	</script>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>MODIFY STUDENT DETAILS</title>
</head>
<body>
<form name="frm" action="" method="post" ENCTYPE="multipart/form-data">
<input type="hidden" name="StudID" value="<?=$StudID?>"/>

<table class="forumline" align=center width="98%" style="border-bottom:none;" >
<tr><td>
	<nav>		
		<ul id="tabs">
       <?
	  
   		      $sqlT="SELECT `tab_name`, `description` FROM `student_m_tab` WHERE status='1' ORDER BY `id`";
			  $resultT=execute($sqlT) or die();
                $i=1;
			    while($rt=fetcharray($resultT))
                {
					   
					?>
                <li><a href="<?=$i?>" title="<?=$rt['description']?>" onClick="reloadMe(<?=$i?>);"><?=$rt['tab_name']?></a></li>
                    <?
           			     ++$i;
                }
		 
		 $StudID='900016';
		 $details=fetcharray(execute("SELECT * FROM `student_m` WHERE id='$StudID' LIMIT 1"));
   			
      ?>
     </ul>
   </nav>
      </td>
            <td align="right"><img height='150' width='170'  src=<?=$details[img_source]?> /></td>
     </tr>
    </table>

<span id="indicator"></span>

  <div id="content">	
	<section>
  		
 <table class='forumline'  align='center' width="98%" style="border-bottom:none;">
 <tr>
<?PHP
/*echo "Value of PSSSS :".$p;*/
	

if($p==1)
{
     	 
   $sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `field_name` FROM `student_m_field` WHERE status=1 AND `tab_id`=1 ORDER BY `order`";
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
					
					if($rf['field_type']=='DATE'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td ><input type="text" name="adate" value="<?=$details['dob']?>" readonly>&nbsp;&nbsp;
					  <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>  
                        <?
					}elseif($rf['field_name']=='admission_id'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td title="It's ReadOnly">
                      <input type="text" name="appl_num" value="<?=$details['admission_id']?>"  size="20"  readonly></td>  
                        <?
					}elseif($rf['field_name']=='course_admitted'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                     <td><select name="branch" id="branch" onchange='reload()' required>
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
                       <td><select name="sem" id="sem" onchange='reload()' required>
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
                        <td><select name="a_year" id="a_year" onchange='reload()' required>
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
                      <td><select name="fee_type">
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
                      <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20"></td> 
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
  <tr><td colspan="4"><div style="height:150px;"></div></td></tr></table>
<!-- <input type="hidden" name="val" value="2"/>--><BR><BR>
  <div align='CENTER'><input type="submit" value="NEXT" name="one" class='bgbutton' style="width:60px; height:22px"></div>
 </section><section>
 <table class=forumline  align=center width="98%" >
 <tr> 
    <?		   
 }
elseif($p==2)
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
					    <td nowrap><select name="b_day" onchange='reload()'>
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
                  	  <select name="b_month" onchange='reload()'>
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
                    <select name="b_year" onchange='reload()'>
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
          <input type="text" name="adm_num"  value="<?=$details['student_id']?>" size="20"  placeholder="Auto-generated" readonly></td>  
                        <?
					
					}elseif($rf['field_name']=='age'){
						?>
                        <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td title="It's ReadOnly">
                        <input type="text" name="age" value="<?=$details['age']?>" size="15" placeholder="Auto-generated" readonly></td>  
                        <?
					
					}elseif($rf['field_name']=='gender'){
						?>
                        <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td><select name="gender">
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
                      <td><select name="nationality">
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
                      <td><select name="blood_group">
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
                      <td><input type='FILE' name='uploadedfile' value="" size='20' ></td>
                        <?
					
					}elseif($rf['field_name']=='img_source_s'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                       <td><input type="email" name="img_source_s" value="<?=$details['img_source_s']?>" size="30"></td> 
                    <?	
					}elseif($rf['field_name']=='mother_tongue'){
						?>
                      <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                      <td ><select name="mother_tongue">
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
					else{
						?>
                        <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rf['display_name']?><?=$f?></td>
                        <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20"></td> 
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
  <tr><td colspan="4"><div style="height:20px;"></div></td></tr></table>
  <input type="hidden" name="val" value="2"/><BR><BR>
   <div align='center'><input type="submit" value="NEXT" name="two" class='bgbutton' style="width:60px; height:22px"></div>
  </section><section>
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
                 <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20"></td>                      
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
  <input type="hidden" name="val" value="4"/><BR><BR>
   <div align='center'><input type="submit" value="NEXT" name="three" class='bgbutton' style="width:60px; height:22px"></div>
  </section><section>
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
                 <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20"></td>                      
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
  <input type="hidden" name="val" value="5"/><BR><BR>
   <div align='center'><input type="submit" value="NEXT" name="four" class='bgbutton' style="width:60px; height:22px"></div>
  </section><section>
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
                 <td><input type="text" name="<?=$rf['field_name']?>" value="<?=$details[$rf['field_name']]?>" size="20"></td>                      
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
    <input type="hidden" name="val" value="6"/><BR><BR>
   <div align='center'><input type="submit" value="NEXT" name="five" class='bgbutton' style="width:60px; height:22px"></div>
 </section><section>
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
			<td colspan="8"><textarea rows="5" cols="100" name='remarks'><?=$details['remarks']?></textarea></td>
		</tr>
        <tr>
			<td colspan="8"><div style="height:100px;"></div></td>
		</tr>
    </table>
    <input type="hidden" name="val" value="7"/><BR><BR>
   <div align='center'><input type="submit" value="NEXT" name="six" class='bgbutton' style="width:60px; height:22px"></div>
  </section><section>
 <table class=forumline  align=center width="98%" >
 <tr> 
 <?	   
 }
elseif($p==7)
{
	?>		  
	<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Student Username</td>   
		<td><input type='text' name='username'  value="<?=$details['username']?>" size='20' ></td>
		<td>Student Password</td>
		<td><input type="text" name='password'  value="<?=$details['password']?>" size='20' ></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Parent Username</td>
		<td><input type='text' name='parent_username'  value="<?=$details['parent_username']?>" size='20' ></td>
		<td>Parent Password</td>
		<td><input type="text" name='parent_password'  value="<?=$details['parent_password']?>" size='20' ></td>
	</tr>
    <tr>
		<td colspan="5"><div style="height:150px;"></div></td>
	</tr>
  </table>
    <input type="hidden" name="val" value="1"/><BR><BR>
   <div align='center'><input type="submit" value="END" name="seven" class='bgbutton' style="width:60px; height:22px"></div>
  </section><section>
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
                 <td><input type="text" name="" value="" size="20"></td>                      
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
</section>       		
</div>    
</form>
</body>
</html>
