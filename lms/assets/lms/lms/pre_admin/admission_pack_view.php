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
	
	$action=fetcharray(execute("SELECT `action` FROM `student_m_adminpack` WHERE `id`='$val'"));
	$action=$action[0];
	if($action =="Disapprove")
	{
    
		$sql="UPDATE `student_m_adminpack` SET `action`='Approve' WHERE `id`= $val";
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
		alert('hi');
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
		
		document.frm.action="admission_pack_view.php?Types=Disapprove&val="+dea;
		document.frm.submit();
    }
</script>
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<title>ADMISSION PACK RECEIVE</title>
</head>
<body>
<?
	 $result=execute("SELECT * FROM `student_m_adminpack` WHERE `status`='1' ORDER BY `inserted_date` DESC");
		
	if(rowcount($result)>0)
    {
	  ?>
<FORM NAME="frm"  ACTION="admission_pack_view.php" METHOD="post">
<input type="hidden" name="reg_code" value="<?=$reg_code?>">
	<br/>
	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width="90%">
      <tr>
		<td class="head" align="center" colspan="20">ADMISSION PACK RECEIVED</td>
	  </tr>
	  <tr height='25' >
		    <td Class="row3" align='center' nowrap>Sl No</td>
			<td Class="row3" align='center' nowrap>Registration Code</td>
			<td Class="row3" align='center' nowrap>Application Pack No.</td>                                      
            <td Class="row3" align='center' nowrap>Consignment No.</td>
            <td Class="row3" align='center' nowrap>Courier Details</td>
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
			        						
			?>
                    <td align='center' nowrap><?=$sno?></td>
                    <td align='center' nowrap><?=$row['reg_code']?></td>
                    <td align='center' nowrap><?=$row['app_no']?></td>
                    <td align='center' nowrap><?=$row['consignment']?></td>
                    <?
						if($row['courier']=='')
						{
							$service="Manual Handover";
								
						}
						else
						{
							$service=$row['courier'];
						}
					?>
                    <td align='center' nowrap><?=$service?></td>
                    <?
						    $send_date=$row['send_date'];
							$date=explode('-',$send_date);
							$send_date="$date[2]-$date[1]-$date[0]";
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
