<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
$academic_year=$_SESSION['AcademicYear'];
$a_year=$_SESSION['AcademicYear'];
$per00=$_SESSION['per00'];
$sem=$_SESSION['sem'];
$staff_id=fetchrow(execute("select srid from users  where username='$user'"));
$staff_did=fetchrow(execute("select S_ID from users  where username='$user'"));

$subject_right=$staff_did[0];
$class_right=$staff_id[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script language="javascript">
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=700,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function showdetails(str)
{
	
	var xmlhttp;
	if (str=="")
	  {
	  document.getElementById("txtHint").innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","announce.php?q="+str,true);
	xmlhttp.send();
	
}
</script>
</head>

<body >

<br><br>
<table width="960" align="center" border="1" cellpadding="5" cellspacing="15">
    <tr>
    	<td align="center" class="head" colspan="2">
        	Class Announcement
        </td>
    </tr>
    <tr>
   	    <td width="480">
<?php
if($per00==1)
{
?>
                <div style="height:454px; overflow:auto;">
                    <table border="0" width="480" cellpadding="0" cellspacing="0">
                    <?php
//code starts 
$sql1=execute("SELECT *  FROM `announcement_class` where grade!=0 order by fromdate desc");
while($r1=fetcharray($sql1))
{
	$sql2=execute("SELECT * FROM `announcement_class` where id='$r1[id]'");
	while($r2=fetcharray($sql2))
	{
		
		$qur=rowcount(execute(" select id FROM `staff_rights` where year_id='$r2[grade]' and class_section_id='$r2[section_id]' and StaffID='$subject_right'"));
		$qur1=rowcount(execute(" select id FROM `class_teacher`  where grade='$r2[grade]' and sect='$r2[section_id]' and teacher='$class_right'"));
		
		if($qur>0 or $qur1>0)
		{
			
			
			$fd=explode('-',$r2[fromdate]);
			$td=explode('-',$r2[todate]);

			$coursname=fetchrow(execute("select year_name from course_year where year_id='$r2[grade]'"));
			$kvl=$r2[id];
			$class_section=fetchrow(execute("select s_name from class_section where id='$r2[section_id]'"));
			
			if($r2['type']==1)
			{
				if($i%2)
				echo "	<tr height='14' class='clsname' > ";
				else
				echo "	<tr height='14'> ";
				?>
				
						<td align='justify' 
	 style="width:100%; background-color:"
	 onMouseover="this.style.backgroundColor='#CCCCCC';"
	 onMouseout="this.style.backgroundColor='';">
						<?php
						echo "<a onclick='showdetails($kvl)' >
						&nbsp;&nbsp;$fd[2]-$fd[1]-$fd[0] ( $coursname[0] - $class_section[0] )
						&nbsp;&nbsp;$r2[title]
						</a>
						</td>
					</tr>";
			}
			else
			{
				if($i%2)
				echo "	<tr height='14' class='clsname' > ";
				else
				echo "	<tr height='14'> ";
	?>
				<td align='justify' bgcolor=""  style="width:100%; background-color:"
	 onMouseover="this.style.backgroundColor='#CCCCCC';"
	 onMouseout="this.style.backgroundColor='';"><a onclick="showdetails(<?=$kvl?>)">
				<?php echo "&nbsp;&nbsp;$fd[2]-$fd[1]-$fd[0] - $td[2]-$td[1]-$td[0] ( $coursname[0] ) 
						&nbsp;&nbsp;$r2[title]
						</a></td>
						
					</tr>";
				
			}
		}
	}
	$i++;
}
echo " <tr>
			<td >&nbsp;</td>
		</tr>	";
		
//code ends
?>		
                    </table>  
                </div>
<?php
}
else
{

?>
                <div style="height:454px; overflow:auto;">
                    <table border="0" width="480" cellpadding="0" cellspacing="0">
                    <?php
//code starts 
$class_section=fetchrow(execute("select class_section_id from student_m where admission_id='$user'"));

$sql1=execute("SELECT *  FROM `announcement_class` where grade='$sem' and section_id='$class_section[0]'  order by fromdate desc");
while($r1=fetcharray($sql1))
{
	$sql2=execute("SELECT * FROM `announcement_class` where id='$r1[id]'");
	while($r2=fetcharray($sql2))
	{
		
		
			$fd=explode('-',$r2[fromdate]);
			$td=explode('-',$r2[todate]);

			$kvl=$r2[id];
			if($r2['type']==1)
			{
				
				
				
				if($i%2)
				echo "	<tr height='14' class='clsname' > ";
				else
				echo "	<tr height='14'> ";
				?>
				
						<td align='justify' 
	 style="width:100%; background-color:"
	 onMouseover="this.style.backgroundColor='#CCCCCC';"
	 onMouseout="this.style.backgroundColor='';">
						<?php
						echo "<a onclick='showdetails($kvl)' >
						&nbsp;&nbsp;$fd[2]-$fd[1]-$fd[0]
						&nbsp;&nbsp;$r2[title]
						</a>
						</td>
					</tr>";
			}
			else
			{
				if($i%2)
				echo "	<tr height='14' class='clsname' > ";
				else
				echo "	<tr height='14'> ";
	?>
				<td align='justify' bgcolor=""  style="width:100%; background-color:"
	 onMouseover="this.style.backgroundColor='#CCCCCC';"
	 onMouseout="this.style.backgroundColor='';"><a onclick="showdetails(<?=$kvl?>)">
				<?php echo "&nbsp;&nbsp;$fd[2]-$fd[1]-$fd[0] - $td[2]-$td[1]-$td[0]
						&nbsp;&nbsp;$r2[title]
						</a></td>
						
					</tr>";
				
			}
		
	}
	$i++;
}
echo " <tr>
			<td >&nbsp;</td>
		</tr>	";
		
//code ends
?>		
                    </table>  
                </div>

<?php
}
?>
        </td>
 
        <td  width="480" align="justify" valign="top"><br>
              <div id="txtHint" ></div>
        </td>
    </tr>
</table>



</body></html>