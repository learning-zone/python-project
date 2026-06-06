<?php
session_start();
require_once("../db.php");
$msg=$_REQUEST['msg'];
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
	function adds_onclick()
	{
		document.frm.action="appointment_exec.php?Type=Add";
		document.frm.submit();
		//return true;
	}
	function Modify_onclick()
	{
		
		document.frm.action="institution_edt.php?Type=Mod";
		document.frm.submit();
		return true;
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="institution_edt.php?Type=Del";
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
var newWin = window.open (URL, title, 'toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>APPOINTMENT</title>
</head>
<body>

<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<br/>
	<table align='center' class=forumline width='50%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>APPOINTMENT</td>
			</tr>
			<tr height="25">
				<td colspan="2" nowrap align="left">&nbsp;&nbsp;&nbsp;&nbsp;Student Name</td>
				<td width="76%"><INPUT TYPE="text"  NAME="student_name" value="<?=$student_name?>" size="60"></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="left">&nbsp;&nbsp;&nbsp;&nbsp;Date of Birth</td>
				<td><INPUT TYPE="text"  NAME="adate" value="<?=$dob?>" size="60">
                <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
			</tr>
			<tr height="25">
				<td colspan="2" nowrap align="left">&nbsp;&nbsp;&nbsp;&nbsp;Parent Name</td>
				<td><INPUT TYPE="text"  NAME="parent_name" value="<?=$parent_name?>" size="60"></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="left">&nbsp;&nbsp;&nbsp;&nbsp;Mobile No.</td>
				<td><INPUT TYPE="text"  NAME="mobile" value="<?=$mobile?>" size="60"></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="left">&nbsp;&nbsp;&nbsp;&nbsp;Email ID</td>
				<td><INPUT TYPE="text"  NAME="email" value="<?=$email?>" size="60"></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="left">&nbsp;&nbsp;&nbsp;&nbsp;Description</td>
                <td><textarea  style="width: 323px; height: 80px;" name="description"><?=$description?></textarea></td>
			</tr>
	</table>
        <br/>
        <p align="center"><input type="button"  value="Save" LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>
<?
		
	   $sql="SELECT * FROM `student_m_appointment` WHERE `status`=1 ORDER BY id";
	   		
		$result=execute($sql) or die(mysql_error());

if(rowcount($result)>0)
{
   ?>
      <input type="hidden" name="id" value="<?=$id?>">
      <br>
	  <table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
      <tr>
		<td class="head" align="center" colspan="8">APPOINTMENT DETAILS</td>
	  </tr>
	  <tr height='22' >
		    <td Class="row3" align='left'>Sl No</td>
			<td Class="row3" align='left'>Student Name</td>
			<td Class="row3" align='left'>Date of Birth</td>
            <td Class="row3" align='left'>Parent Name</td>
            <td Class="row3" align='left'>Mobile No.</td>
            <td Class="row3" align='left'>Email</td>
            <td Class="row3" align='left'>Appointment Date</td>
            <td Class="row3" align='left'>Fix Appointment</td>
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
						echo "	<tr class='clsname' > ";
					else
						echo "	<tr > ";
			        
						
			?>
                    <td align='center' ><?=$sno?></td>
                    <td align='center' ><?=$row['student_name']?></td>
                <?
					  $adated=$row['dob'];
					  $dateArrayd=explode('-',$adated);
					  $acq_yyd=$dateArrayd[0];
					  $acq_mmd=$dateArrayd[1];
					  $acq_ddd=$dateArrayd[2];
					  $dob="$acq_ddd-$acq_mmd-$acq_yyd";
				?>
                    <td align='center' ><?=$dob?></td>
                    <td align='center' ><?=$row['parent_name']?></td>
                    <td align='center' ><?=$row['mobile']?></td>
                    <td align='center' ><?=$row['email']?></td>
                <?
					 $newdate=$row['app_date'];
					 $newd = (explode(" ",$newdate)); 
					 $newd1 =  $newd[0];
					 $time=date("g:i a", strtotime($newd[1])) ;
					 
					 $app_dateN=$newd1;
					 $date=explode('-',$app_dateN);
					 $app_dateN="$date[2]-$date[1]-$date[0]";
					 $app_date="$app_dateN $time";
				?>
                    <td align='center' >&nbsp;<?=$app_date?></td>
                    <td align='center' >
                    <input type="button"  value="Fix Appointment" onclick ="javascript:OpenWind2('appointment_date.php?id=<?=$row[id]?>', 'OpenWind2',700,450)" class="bgbutton"/></td>                
             <?
		
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   }				
 
?>
 </table>
</form>
 </body>
 </html>
