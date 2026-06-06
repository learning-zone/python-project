<?php
session_start();
include("db1.php");
$per00=$_SESSION['per00'];

$user=$_SESSION['user'];

$_DATABASE_=$_SESSION['_DATABASE_'];
$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
$PHP_SELF=$_SERVER['PHP_SELF'];

$LinkName=$_GET['LinkName'];


//print_r($_SESSION);

?>
<html>
<head>
<script src="/imp/renew/Code/jquery/1.10.2/jquery.min.js"></script>
<style>
    body {

        background: #FFF;
        background-repeat: repeat-x, y;
        border-bottom-left-radius: 13px;
        border-bottom-right-radius: 13px;
        border-top-left-radius: 13px;
        border-top-right-radius: 13px;
        border-bottom: 1px solid #000;
        font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
        color: #000;
    }
    .highlight {

        border-bottom: 1px solid #ffffff;
        font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
        font-size: 14px;
        background: #CDBAE9;
        padding-left: 5%;
        min-height: 25px;
    }
</style>
</head>
<body class="samplebody">
<?php
if($per00==1)
{
	if($user=='' || $module=='')
	{
		header("Location:../index.php");
	}
	else
	{
		$date = getdate();
		$qry="SELECT linkname FROM links WHERE linkpath='$PHP_SELF'";
		$temprs = execute($qry);
		if(rowcount($temprs)==0)
		{
			$ln="Home";
		}
		else
		{
			$temprow = fetcharray($temprs);
			$ln = $temprow[0];
		}
		$today = getdate();
		$month = $today['mon'];
		$day = $today['mday'];
		$year = $today['year'];
		$ndate= date(" d-m-Y",mktime(0,0,0,$month,$day-7,$year));
		$last_date=explode('-',$ndate);
		$day=trim($last_date[0]);
		$month=trim($last_date[1]);
		$year=trim($last_date[2]);
		$qry="INSERT INTO log (username,address,accessdate,urladdress,linkname,trans_date) ";
		$qry.=" VALUES('$user','$REMOTE_ADDR','$date[year]-$date[mon]-$date[mday] $date[hours]:$date[minutes]:$date[seconds]',";
		$qry.=" '$PHP_SELF','$ln','$date[year]-$date[mon]-$date[mday]')";
		execute($qry) or die(mysql_error());
		$qry = "SELECT * FROM usermenu WHERE username = '$user' AND module='$module' ORDER BY id";
		$rs = execute($qry);
		
		if(rowcount($rs) == 0) /*User Menu Not Found */
		{
			echo "No rights..";
		}
		else
		{
			if($module=='Main')
			{
				$qry = "SELECT access  FROM usermenu WHERE username='$user' AND module='$module' ";
			}
			else
			{
				$qry = "SELECT access FROM usermenu WHERE username='$user' AND linkpath='$PHP_SELF' ";
			}
			$rs1 = execute($qry);
			$row1 = fetcharray($rs1);
			if($row1[access] == 'No' && $module!='Main')
			{
				if($module!='Main')
				{
					echo "No Rights";
				}
			}
			else /*If access is there Display the Full Menu for the User */
			{
				if($module!='Main')
				{
					$diname=fetchrow(execute("SELECT Display_name FROM links WHERE linkname='$module' AND module='Main'"));
                
					?>
					<div class="smenu" align="center"><?=$diname[0]?></div>
                    <?
				}
				else
				{
					echo "<div width='100%'>";
				}
				/* Show the Sub Modules in the Given Module */
				$qry = "SELECT * FROM submodules WHERE module='$module' ORDER BY id";
				$rs2 = execute($qry);
				if(rowcount($rs2) == 0)
				{
					echo "No access for Sub Module";
				}
				else
				{
					while($row2 = fetcharray($rs2))
					{
						$showhdr = 0;
			
			if($module!='Main')
			{
				$qry = "SELECT * FROM usermenu  WHERE username='$user' AND module='$module' AND submodule='$row2[submodule]' AND access='Yes' ORDER BY id";
			}
			else
			{
				$qry = "SELECT * FROM usermenu a,modules b WHERE a.username='$user' AND a.module='$module' AND a.submodule='$row2[submodule]' AND a.access='Yes' AND a.linkname=b.module ORDER BY b.id";

			}
			$rs3 = execute($qry);
						while($row3 = fetcharray($rs3))
						{
							if($showhdr==0)
							{
								if($module!='Main')
								{
									?>
									<div class="submodule"><?=$row2[submodule]?></div>
									
                                    <?
									$showhdr=1;
								}
							}
							if($module=='Main')
							{
									
								$diname=fetchrow(execute("SELECT Display_name FROM links WHERE linkname='$row3[linkname]'"));
							
								?>
                                
								<a href=<?=$row3[linkpath].$row3[parameter]?> title='<?=$row3[linkname]?>' target='contents' class='topictitle3'>
								<div class="menu"><?=$diname[0]?></div></a>

								<?
							}
							else
							{
								
								
								$diname=fetchrow(execute("SELECT Display_name FROM links WHERE id='$row3[id]'"));
								$Display_name=$diname[0];
																
								?>
							    
							    <!--<span id="container" >
					
                                <a href="../test.php?linkpath=<?=$row3[linkpath]?><?=$row3[parameter]?>&linkname=<?=$row3[linkname]?>&Display_name=<?=$Display_name?>&linkID=<?=$row3[id]?>" title='<?=$row3[linkname]?>' class="topictitle3" >								
                                <div id="follow" data-id="<?=$row3[id]?>" class="Divsubmenu" ><?=$diname[0]?></div></div></a></span>-->
                                
                                
                                 <span id="container" >
                    
                                <a href="../test.php?linkpath=<?=$row3[linkpath]?><?=$row3[parameter]?>&linkname=<?=$row3[linkname]?>&Display_name=<?=$Display_name?>&linkID=<?=$row3[id]?>" title='<?=$row3[linkname]?>' class="topictitle3" >                             
                                <div id="follow" data-id="<?=$row3[id]?>" class="Divsubmenu" ><?=$diname[0]?></div></div></a></span>
																
								<?php
								echo "</div>";
							}
						}
					}
				}
			}
			if($module!='Main')
			{
				echo "</div>";
			}
			else
			{
				
			}
		}		
	}
?>
</div>
<?	
}
else
{
	if($user=='' || $module=='')
	{

		header("Location:../index.php");

	}
	else
	{
		$date = getdate();
		$qry="select linkname from links where linkpath='$PHP_SELF'";
		$temprs = execute($qry);
		
		if(rowcount($temprs)==0)
		{
			$ln="Home";
		}
		else
		{
			$temprow = fetcharray($temprs);
			$ln = $temprow[0];



		}

		$today = getdate();

		$month = $today['mon'];

		$day = $today['mday'];

		$year = $today['year'];

		$ndate= date(" d-m-Y",mktime(0,0,0,$month,$day-7,$year));

		$last_date=explode('-',$ndate);

		$day=trim($last_date[0]);

		$month=trim($last_date[1]);

		$year=trim($last_date[2]);

		$qry="insert into log (username,address,accessdate,urladdress,linkname,trans_date) ";

		$qry.=" values('$user','$REMOTE_ADDR','$date[year]-$date[mon]-$date[mday] $date[hours]:$date[minutes]:$date[seconds]',";

		$qry.=" '$PHP_SELF','$ln','$date[year]-$date[mon]-$date[mday]')";

		execute($qry);
	
	  $sqlnew="select count(a.id) from  mail_logs a, mail_student_view b where b.student_id='".$_SESSION['student_id']."' and a.id=b.mailid  and a.viewed=0";

	$countid=fetchrow(execute($sqlnew));

		?>

	<div class="menu" >User Accounts</div>

	<a class='topictitle3' href="../renew/AdminTask/par_chpswd.php" title="Manage Password(P)" ><div class="Divsubmenu" >Change Password</div></a>
    <a class='topictitle3' href="../renew/mail_msg/maillogstudent.php" title="Manage Password(P)" ><div class="Divsubmenu" >Mail Inbox</div></a>

	  <div class="menu" >Student</div>
  	  <a class='topictitle3' href="../renew/student_det/view_stud.php" title="View Details" ><div class="Divsubmenu" >Student Details</div></a>
      <a class='topictitle3' href="../renew/studatt/det_att_rep_stud.php" title="Detailed Student Attendance" ><div class="Divsubmenu" >Attendance</div></a>
	  <a class='topictitle3' href="../renew/TimeTable/vwtt.php" title="View Time Table" ><div class="Divsubmenu" >Time Table</div></a>
      <a class='topictitle3' href="../renew/health_management/student_medical.php" title="Medical details" ><div class="Divsubmenu" >Medical details</div></a>

  	<div class="menu">School Events</div>
	<a class='topictitle3' href="../renew/Calendar/scannouncementRep.php" title="School Announcement" ><div class="Divsubmenu" >School Announcement</div></a>

    <a class='topictitle3' href="../renew/PhotoGallery/schoolGalleryView.php" title="School" ><div class="Divsubmenu" >Photo Gallery</div></a>
	<a class='topictitle3' href="../renew/test.php?linkpath=/renew/Calendar/Lunch_Calendar_rep.php&amp;linkname=Lunch%20Calendar" title="Lunch Calendar" ><div class="Divsubmenu">Lunch Calendar</div></a>

	<div class="menu">Class Room</div>
    
    <?php
	//CAS code(start)
	$stuidsvat=fetcharray(execute("select id from student_m where student_id='$user'"));

$studentnmaes=fetcharray(execute("select * from `student_m` where id='$stuidsvat[0]'"));

	$subeidvat2=execute(" select subject_id, subject_name, elective, sub_type from subject_m  where course_year_id='$sem' and status=1 and sub_type=7 and status=1");
 while($subeidvat=fetcharray($subeidvat2))
 {
	$flag1=1;
	if($subeidvat[2]=='Y')
	{
		$studentstatus=fetcharray(execute("select id from student_course where stu_id='$stuidsvat[0]' and acc_year='$academicYear' and sub='$subeidvat[0]'"));
		if(!$studentstatus)
		$flag1=0;
	}
	$flag=1;
	
	if($flag1)
	{
		$subnnmae=$subeidvat[0];
	}
  }
	//CAS code(end)

if($subnnmae)
{
?> 
  <a class='topictitle3' href="../renew/casform/casform.php" title="CAS" ><div class="Divsubmenu" >CAS</div></a>     
 
 <?php
}
 ?>
  <a class='topictitle3' href="../renew/Assessment/StudentReportCard.php" title="Progress Report" ><div class="Divsubmenu" >Progress Report</div></a>
  <a class='topictitle3' href="../renew/Assessment/reportCard.php" title="Report Card" ><div class="Divsubmenu" >Report Card</div></a>

<?php

	}

}

?>
</div>
<script type="text/javascript">
(function( $ ) {
  $( "#container div" ).click( function() {
    
        $("#container div").removeClass('highlight');
        $( this ).addClass("highlight");
   
 });
})( jQuery );
</script>
</body>
</html>