<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
require_once("../db.php");

 
 $sem=$_POST['sem'];
 $state=$_POST['state'];
 $app_no=$_POST['app_no'];
 $enquiry=$_POST['enquiry'];
 $reg_code=$_POST['reg_code'];
 $passport_type=$_POST['passport_type'];

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
	
	$action=fetcharray(execute("SELECT `action` FROM `student_m_adminpack` WHERE `id`='$val'"));
	$action=$action[0];
	if($action =="Disapprove")
	{
    
		$sql="UPDATE `student_m_adminpack` SET `action`='Approve', `receive_date`=CURDATE() WHERE `id`= $val";
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
		$sql="UPDATE `student_m_adminpack` SET `action`='Disapprove' WHERE `id`= $val";
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
	function reloadMe()
	{
			
		document.frm.action="admission_pack.php";
		document.frm.submit();
		//return true;
	}
	function adds_onclick()
	{
		//alert('hi');
		document.frm.action="admission_pack_exec.php";
		document.frm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="admission_pack.php?Type=Mod";
		document.frm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="admission_pack.php?Type=Del";
		    document.frm.submit();
		}
		
		return true;
	}
	function dea(dea)
    {
		
		document.frm.action="admission_pack.php?Types=Disapprove&val="+dea;
		document.frm.submit();
    }
</script>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<title>ADMISSION PACK</title>
</head>
<body>
<FORM NAME="frm"  ACTION="admission_pack_exec.php" METHOD="post">
<input type="hidden" name="reg_code" value="<?=$reg_code?>">
	<br/>
	<table align='center' class=forumline width='60%' >
      <tr height="25">
          <td align='center' Class='head' colspan=3>ADMISSION PACK</td>
      </tr>
      <tr>
         <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration Code </td>
         <td><select name='reg_code' onChange="reloadMe()">
            <option value='' >----  Select  ----</option>
			<?php		
            $sqlReg=execute("SELECT id FROM `student_m_online` WHERE status=1 AND action='Approve' AND `adminpack`='N' ORDER BY id");
                while($r=fetcharray($sqlReg))
                {
                    if($reg_code==$r['id'])
                   		 echo "<option value='$r[id]' selected>$r[id]</option>";
                    else
                    	 echo "<option value='$r[id]' >$r[id]</option>";
                }
            ?>
            </select></td>
      </tr>
      <?
	  	 $name=fetcharray(execute("SELECT `first_name`, `parent_name`, `course_yearsem` FROM `student_m_online` WHERE
		 `id`='$reg_code' AND `status`=1"));
		 	  
		 $grade=fetcharray(execute("SELECT `year_name` FROM `course_year` WHERE `year_id`='$name[2]' AND `status`=1"));
			  
	  ?>
      <tr>
         <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student's Name </td>
         <td title="It's ReadOnly"><input type="text" name="stud_name" value="<?=$name[0]?>" size="40" readonly></td>
      </tr>
      <tr>
         <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grade </td>
         <td title="It's ReadOnly"><input type="text" name="grade" value="<?=$grade[0]?>" size="40" readonly></td>
      </tr>
       <tr>
         <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parent's Name </td>
         <td title="It's ReadOnly"><input type="text" name="parent_name" value="<?=$name[1]?>" size="40" readonly></td>
      </tr>
      <tr>
         <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Application Pack Number <font color="#FF0000"> * </font></td>
         <td><input type="text" name="app_no" value="<?=$app_no?>" size="40" required></td>
      </tr>
		<?php
			 	 $first='';
			  	 $second='';
			  if($enquiry=='manual_handover')
			  $first="selected";
			  if($enquiry=='courier_service')
			  $second="selected";       
        ?> 
      <tr height="25">
          <td  nowrap align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Type</td>
          <td><select name="enquiry" onChange="reloadMe()">
           <option value="">-------  Select   -------</option>
           
           <option value="manual_handover" <?=$first?>>Manual Handover</option>
           <option value="courier_service" <?=$second?>>Courier Service</option>
                      
        </select></td>
      </tr>
      <?
	  if($enquiry=='manual_handover')
      {	
		?>
       <tr>
          <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Handover Date </td>
          <td><input type="text" name="adate" value="<?=$handover_date?>" size="40">
          <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
       </tr>
     	 <?
	  	}
	  	if($enquiry=='courier_service')
      	{	
		 ?>
       <tr>
          <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Courier Service </td>
          <td><select name="courier">
                  <option selected="selected" value=''>----  Select ----</option>
                  <option value="Professional">Professional</option>
                  <option value="DTDC">DTDC</option>
                  <option value="Blue Dart">Blue Dart</option>
                  <option value="First Flight">First Flight</option>
		</select></td>
       </tr>
       <tr>
          <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consignment No.</td>
          <td><input type="text" name="consignment" value="<?=$consignment?>" size="40"></td>
       </tr>
       <tr>
          <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Sent </td>
          <td><input type="text" name="bdate" value="<?=$send_date?>" size="40">
          <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
       </tr>
      <?
	  }
	 ?>     
	</table>
    <br/>
        <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="Save" class='bgbutton' onChange="adds_onclick()"></p>

<?
	 $result=execute("SELECT * FROM `student_m_adminpack` WHERE `status`='1' ORDER BY `inserted_date` DESC");
		
	if(rowcount($result)>0)
    {
	  ?>
	<br/>
	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width="98%">
      <tr>
		<td class="head" align="center" colspan="20">ADMISSION PACK DETAILS</td>
	  </tr>
	  <tr height='25' >
		    <td Class="row3" align='center' nowrap>Sl No</td>
            <td Class="row3" align='center' nowrap>Student's Name</td>
			<td Class="row3" align='center' nowrap>Registration Code</td>
			<td Class="row3" align='center' nowrap>Application Pack No.</td>                                      
            <td Class="row3" align='center' nowrap>Consignment No.</td>
            <td Class="row3" align='center' nowrap>Courier Details</td>
            <td Class="row3" align='center' nowrap>Handover Date</td>
            <td Class="row3" align='center' nowrap>Date Sent</td>
            <td Class="row3" align='center' nowrap>Date Received</td>	
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
			
			$Student_name=fetcharray(execute("SELECT `first_name` FROM `student_m_online` WHERE `id`='$row[reg_code]'"));
			        						
			?>
                    <td align='center' nowrap><?=$sno?></td>
                    <td align='left' nowrap>&nbsp;<?=$Student_name[0]?></td>
                    <td align='center' nowrap><?=$row['reg_code']?></td>
                    <td align='center' nowrap><?=$row['app_no']?></td>
                    <?
						if($row['courier']!='')
						{
							$consignment=$row['consignment'];
								
						}
						else
						{
							$consignment='--';	
						}
					?>
                    <td align='center' nowrap><?=$consignment?></td>
                    <?
						if($row['courier']=='')
						{
							$service="In Person";
								
						}
						else
						{
							$service=$row['courier'];
						}
					?>
                    <td align='center' nowrap><?=$service?></td>
                    <?
					    if($row['enquiry']=='manual_handover')
						{
						    $handover_date=$row['handover_date'];
							$date2=explode('-',$handover_date);
							$handover_date="$date2[2]-$date2[1]-$date2[0]";
						}
						else 
						{
							$handover_date='--';	
						}   
					?>
                    <td align='center' nowrap><?=$handover_date?></td>
                    <?
					    if($row['send_date']=='')
						{
						    $send_date='--';
						}
						else if($row['send_date']=='0000-00-00') 
						{
							$send_date='--';	
						}
						else
						{
							$send_date=$row['send_date'];
							$date=explode('-',$send_date);
							$send_date="$date[2]-$date[1]-$date[0]";
						}
				
					?>
                    <td align='center' nowrap><?=$send_date?></td> 
                    <?
							$receive_date=$row['receive_date'];
							$date2=explode('-',$receive_date);
							$receive_date="$date2[2]-$date2[1]-$date2[0]";
					?>
                    <td align='center' nowrap><?=$receive_date?></td>
                    <td align='center' title="Click here to change Status" ><a  onclick="dea(<?=$row['id']?>)"><u><font color="#0033FF"><?=$row['action']?></u></font></a></td>                  
                   
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
		  }
	
	  }
 ?>
 </tr>
 </table>
 </FORM>
</body>
 </html>
