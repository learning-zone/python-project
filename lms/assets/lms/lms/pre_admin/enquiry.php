<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
require_once("../db.php");

 $passport_type=$_POST['passport_type'];
 $enquiry=$_POST['enquiry'];
 $state=$_POST['state'];
 $sem=$_POST['sem'];

$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
?>
    <script language="javascript">
	alert("<?=$msg?>");
    </script>
<?php
}
if($_GET['Types'] == "Disapprove")
{
    $val=$_GET['val']; 
	
	$action=fetcharray(execute("SELECT `action` FROM `student_m_online` WHERE `id`='$val'"));
	$action=$action[0];
	if($action =="Disapprove")
	{
    
		$sql="UPDATE `student_m_online` SET `action`='Approve' WHERE `id`= $val";
		$result=execute($sql);  
		  if($result) 
		  {
		  
			  ?>
				  <script type="text/javascript">
					  alert("Approved");
				  </script>
			  <?
	  
		  }
	}
	else
	{
		$sql="UPDATE `student_m_online` SET `action`='Disapprove' WHERE `id`= $val";
		$result=execute($sql);  
		  if($result) 
		  {
		  
			  ?>
				  <script type="text/javascript">
					  alert("Disapproved");
				  </script>
			  <?
	  
		  }
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<script language="javascript">
    function reloadFirst()
	{
		
		document.frmFirst.action="enquiry.php";
		document.frmFirst.submit();
		//return true;
	}
	function reloadMe()
	{
			
		document.frm.action="enquiry.php";
		document.frm.submit();
		//return true;
	}
	function adds_onclick()
	{
		alert('hi');
		document.frm.action="enquiry_exec.php";
		document.frm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="enquiry.php?Type=Mod";
		document.frm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="enquiry.php?Type=Del";
		    document.frm.submit();
		}
		
		return true;
	}
	function dea(dea)
    {
		
		document.approve.action="enquiry.php?Types=Disapprove&val="+dea;
		document.approve.submit();
    }
</script>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<title>ENQUIRY</title>
</head>
<body><BR>
<FORM NAME="frmFirst"  ACTION="" METHOD="post">
	<table align='center' class=forumline width='40%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>ENQUIRY</td>
			</tr>
			<tr height="25">
				<td colspan="2" nowrap align="right">Select Enquiry&nbsp;&nbsp;</td>
				<td><select name="enquiry" onChange="reloadFirst()">
                 <option value="">-------  Select   -------</option>
                 <?
				 if($enquiry=='online_enquiry')
					 $first="selected";
				 if($enquiry=='manual_enquiry')
					 $second="selected";
		
				 ?> 
          		 <option value="online_enquiry" <?=$first?>>&nbsp;&nbsp;Online Enquiry</option>
                 <option value="manual_enquiry" <?=$second?>>&nbsp;&nbsp;Walk-in Enquiry</option>
               
                            
              </select></td>
			</tr>
	</table>
</FORM><BR><BR>
        
<?
if($enquiry=='online_enquiry')
{
	 //echo "Online Enquiry"; 	
	 $result=execute("SELECT * FROM `student_m_online` WHERE `status`='1' AND `enquiry_type`='Online' ORDER BY id");
		
	   if(rowcount($result)>0)
       {
	   ?>
    <div style="overflow-y:hidden;overflow-x:scroll;"> 
	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width="90%">
      <tr>
		<td class="head" align="center" colspan="20">ONLINE ENQUIRY DETAILS</td>
	  </tr>
	  <tr height='25' >
		    <td Class="row3" align='center' nowrap>&nbsp;Sl No&nbsp;</td>
			<td Class="row3" align='center' nowrap>Student's Name&nbsp;&nbsp;</td>
			<td Class="row3" align='center' nowrap>Date of Birth&nbsp;&nbsp;</td>                                      
            <td Class="row3" align='center' nowrap>Present School&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>Present grade&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>Grade&nbsp;&nbsp;</td>	
            <td Class="row3" align='center' nowrap>Parent's Name&nbsp;&nbsp;</td>	
            <td Class="row3" align='center' nowrap>Parent's Designation&nbsp;&nbsp;</td>	
            <td Class="row3" align='center' nowrap>Parent's Organisation&nbsp;&nbsp;</td>	
            <td Class="row3" align='center' nowrap>Parent's Occupation&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>Official Address&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>City&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>State&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>Pincode&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>Residence&nbsp;&nbsp;</td>	
            <td Class="row3" align='center' nowrap>Office&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>Mobile&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>Email&nbsp;&nbsp;</td>
            <td Class="row3" align='center' nowrap>Academic Year</td>		
            		
	   </tr>
       <?php
	      $i=0;
		  $rowclass=1;
		  $sno=1;
		  while($row=fetcharray($result))
		  {
				if($sno<10)
				{
					$sno="0".$sno;
				}
					if($i%2)
						echo "<tr class='clsname'>";
					else
						echo "<tr>";
			        						
			?>
                    <td align='center' nowrap><?=$sno?></td>
                    <td align='center' nowrap><?=$row['first_name']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['dob']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['per_school_name']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['per_grade']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['course_yearsem']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['parent_desig']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['parent_org']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['parent_occupation']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['foadd']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['place_of_birth']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['state']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['per_pincode']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['residence']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['office']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['sms_mobile']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['f_email']?>&nbsp;&nbsp;</td>
                    <td align='center' nowrap><?=$row['academic_year']?></td>
            
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   }																			

 ?>
 </tr>
 </table>
<?			
}
if($enquiry=='manual_enquiry')
{
?>	
<form  name="frm" action="enquiry_exec.php" method="post">	
   <table class=forumline  align=center width="70%" >
	<tr>
         <td class="head" align="center" colspan="5">STUDENT ENQUIRY FORM</td>
     </tr>						
     <tr>
         <td align="left" nowrap nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student's Name<font color="#FF0000"> * </font></td>
         <td><input type="text" name="fname" value="<?=$fname?>" size="60" required></td>
      </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of  Birth </td>
         <td><input type="text" name="adate" value="<?=$dob?>" size="60">
         <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
      </tr>
      <tr>
       <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Residential Address (Permanent) <font color="#FF0000"> * </font> </td>
        <td><textarea  style="width: 323px; height: 80px;" name="per_addr" required><?=$per_addr?></textarea></td>
      </tr>
      <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nationality</td>
        <td><select name="nat">
        <option value="">-------  Select   -------</option>
          <?php
		  	  // $nat=$mod2['nationality'];
			   $res = execute("select * from nationality");
			   while($row = fetcharray($res))
			   {
				   if($nat==$row[id])
					{
						echo "<option value='$row[id]' selected>$row[nation]</option>";
					}
					else
					{
						echo "<option value='$row[id]'>$row[nation]</option>";
					}
			   }
			?>
        </select></td>
      </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of Present School <font color="#FF0000"> * </font></td>
         <td><input type="text" name="per_school_name" value="<?=$per_school_name?>" size="60" required></td>
      </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current grade  </td>
         <td><input type="text" name="per_grade" value="<?=$per_grade?>" size="60" ></td>
      </tr>
      <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grade to join </td>
         <td><select name="a_year" >
             <option value=''>----  Select Year  ----</option>
             <?
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
						<?

					 }
			 ?>
           </select></td>		
        </tr>
       <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of the Parents <font color="#FF0000"> * </font></td>
         <td><input type="text" name="f_name" value="<?=$f_name?>" size="60" required ></td>
      </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Occupation of the Working Parent </td>
         <td><textarea  style="width: 323px; height: 80px;" name="foccup"><?=$foccup?></textarea></td>
      </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Designation of Parent </td>
         <td><input type="text" name="parent_desig" value="<?=$parent_desig?>" size="60"></td>
      </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of the Organization</td>
         <td><input type="text" name="parent_org" value="<?=$parent_org?>" size="60"></td>
      </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Official Address </td>
         <td><textarea  style="width: 323px; height: 80px;" name="foadd"><?=$foadd?></textarea></td>
      </tr>
      <tr>
          <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grade for which your child is applying <font color="#FF0000"> * </font> </td>
        <!--<td><input type="text" name="branch" value="<?=$branch?>" size="60"></td>-->	
        <td><select name='sem' required>
                <option value=''>---  Select  ---</option>
					<?php
					$sqlSem=execute("SELECT * FROM `course_year` where status=1 order by year_id");
						while($r=fetcharray($sqlSem))
						{
							if($sem==$r['year_id'])
							{?>
							  <option value="<?=$r['year_id']?>" selected><?=$r['year_name']?></option>
                              <? }
							else
							{?>
							  <option value="<?=$r['year_id']?>" ><?=$r['year_name']?></option>
                             <?
						}   }
					?>
		    </select>
		</td>
       </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City </td>
         <td><input type="text" name="place" value="<?=$place?>" size="60"></td>
      </tr>
      <tr>
         <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;State</td>
         <td><select name='state'>
                <option value='' >---  Select State  ---</option>
					<?php
					$sqlState=execute("SELECT * FROM `student_m_state` where status=1 order by id");
						while($r=fetcharray($sqlState))
						{
							if($state==$r['state'])
							echo "<option value='$r[state]' selected>$r[state]</option>";
							else
							echo "<option value='$r[state]' >$r[state]</option>";
						}
					?>
				</select>
           </td>  		
      </tr>
      <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pincode </td>
         <td><input type="text" name="per_pin" value="<?=$per_pin?>" size="60"></td>
      </tr>
               <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Residence </td>
         <td><input type="text" name="residence" value="<?=$residence?>" size="60"></td>
      </tr>
      <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Office </td>
         <td><input type="text" name="office" value="<?=$office?>" size="60"></td>
      </tr>
      <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile (F) <font color="#FF0000"> * </font></td>
         <td><input type="text" name="fmb" value="<?=$fmb?>" size="60" required ></td>
      </tr>
       <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile (M)</td>
         <td><input type="text" name="mnum" value="<?=$mnum?>" size="60"></td>
      </tr>
      <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email (F) <font color="#FF0000"> * </font> </td>
         <td><input type="text" name="femail" value="<?=$femail?>" size="60" required></td>
      </tr
      ><tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email (M)</td>
         <td><input type="text" name="memail" value="<?=$memail?>" size="60"></td>
      </tr>
        <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From where did you hear about the school </td>
        <td><textarea  style="width: 323px; height: 80px;" name="hear_school"><?=$hear_school?></textarea></td>
      </tr>
      <tr>
        <td align="left" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Passsport Type </td>
         <td><select name="passport_type" >
             <option value=''>--------  Select  --------</option>
             <?
				  $first="";
				  $second="";
				  if($passport_type=='Indian Passport')
				  {
					  $first="selected";
				  }
				  if($passport_type=='Non Indian Passport')
				  {
					  $second="selected";
				  }
				  ?>
			  <option value="Indian Passport" <?=$first?>>&nbsp;&nbsp;Indian Passport</option>
			  <option value="Non Indian Passport" <?=$second?>>&nbsp;&nbsp;Non Indian Passport</option>
           </select></td>
      </tr>
</table>
 <br/>
        <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="submit" value="Save" class='bgbutton'></p> 
  </form>
<?  
  //echo "Online Enquiry"; 	
	 $result=execute("SELECT * FROM `student_m_online` WHERE `status`='1' AND `enquiry_type`='Walk-in' ORDER BY id DESC");
		
	   if(rowcount($result)>0)
       {
	   ?>
    <!--<div style="overflow-y:hidden;overflow-x:scroll;">--> 
    <form name="approve"  ACTION="enquiry.php" METHOD="post">
    <input type="hidden" name="enquiry" value="<?=$enquiry?>">
	<table border="1" class=forumline align=center cellspacing=0 cellpadding=0 width="98%">
      <tr>
		<td class="head" align="center" colspan="20">WALK-IN ENQUIRY DETAILS</td>
	  </tr>
	  <tr height='25' >
		    <td Class="row3" align='center' nowrap>Sl No</td>
            <td Class="row3" align='center' nowrap>Reg. No.</td>
			<td Class="row3" align='center' nowrap>Student's Name</td>
			<td Class="row3" align='center' nowrap>Date of Birth</td> 
            <td Class="row3" align='center' nowrap>Academic Year</td>                                     
            <td Class="row3" align='center' nowrap>Grade</td>	
            <td Class="row3" align='center' nowrap>Parent's Name</td>	
            <td Class="row3" align='center' nowrap>Mobile</td>
            <td Class="row3" align='center' nowrap>Email</td>
            <td Class="row3" align='center' nowrap>Action</td>
            		
            		
	   </tr>
       <?php
	      $i=0;
		  $rowclass=1;
		  $sno=1;
		  while($row=fetcharray($result))
		  {
				if($sno<10)
				{
					$sno="0".$sno;
				}
					if($i%2)
						echo "<tr class='clsname'>";
					else
						echo "<tr>";
			        						
			?>
                    <td align='center' nowrap><?=$sno?></td>
                    <td align='center' nowrap><?=$row['id']?></td>
                    <td align='left' nowrap>&nbsp;<?=$row['first_name']?></td>
                    <td align='center' nowrap> <? print( date("d-M-Y", strtotime($row['dob'])) ); ?></td>
                    <?
						if($row['academic_year']!='')
						{
							$year=substr($row['academic_year'],2,4);
							$year=$year + 1;
						}
					
					?>
                    <td align='center' nowrap><?=$row['academic_year']?>-<?=$year?></td>
                    <?
					
					$grade=fetcharray(execute("SELECT `year_name` FROM `course_year` WHERE `year_id`='$row[course_yearsem]'"));
					?>
                    <td align='left' nowrap><?=$grade[0]?></td>
                    <td align='left' nowrap>&nbsp;<?=$row['parent_name']?></td>
                    <td align='center' nowrap><?=$row['sms_mobile']?></td>
                    <td align='left' nowrap>&nbsp;<?=$row['f_email']?></td>
                    <td align='center' title="Click here to change Status" ><a onclick="dea(<?=$row['id']?>)"><u><font color="#0033FF"><?=$row['action']?></u></font></a></td></td>
              
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   }																			

 ?>
 </tr>
 </table> 
 <form>     
<?			
}
?>
</body>
</html>
