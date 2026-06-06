<?php
session_start();
require_once("../db.php");


/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_GET)
{
    $flag = $_GET['flag'];
}
if($_POST)
{
	$sel=$_POST['sel'];
	$tmid=$_POST['tmid'];
	$media=$_POST['media'];
	$flag = $_POST['flag'];
	$idate=$_POST['idate'];
	$accno=$_POST['accno'];
	$medtyp=$_POST['medtyp'];
	$issued=$_POST['issued'];
	$library=$_POST['library'];
	$barcode= $_POST['barcode'];
	$register=$_POST['register'];
	$eligible=$_POST['eligible'];
	$n_due_date=$_POST['n_due_date'];
}
$mno = $tmid;
/*$mediaN=$media;
$media=$medtyp;*/



if($barcode)
{
	$tempacc=fetchrow(execute("SELECT acc_no FROM lib_rfid WHERE rfid='$barcode'"));
	$accno=$tempacc[0];
}

////////////////////////////////////////////////////////////////////////////////////////////////
$var=preg_split("/(\d+)/", "$accno", -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE); //PHP split string into string AND integer

	if($var[0]=='P' and $media==1) //PYP LIBRARY BOOK
	{
		$library=1;
		$register=1;
		$accno=$var[1];	
	}
	elseif($var[0]=='PT' and $media==6) //PYP TEXT BOOK
	{
		$library=1;
		$register=3;
		$accno=$var[1];
	}
	elseif(($var[0]=='M' and $media==1) || ($var[0]=='M' and $media==2)) //MYP LIBRARY BOOK  OR  //MYP LIBRARY CD/DVD
	{	
		$library=2;
		$register=2;
		$accno=$var[1];
	}
	elseif($var[0]=='MT' and $media==6) //MYP TEXT BOOK
	{
		$library=2;
		$register=4;
		$accno=$var[1];	
	}else{
			?>
			<script type="text/javascript">
                alert("Please enter the valid Accession Number...");
				window.opener.location.href="lib.php?tmid=<?=$tmid?>&media=<?=$media?>medtyp=<?=$medtyp?>";
            </script>    
            <?
	}
	
///////////////////////////////////////////////////////////////////////////////////////////////

//echo "<br>SELECT id FROM lib_circulation_m WHERE acc_id='$accno' AND library='$library' AND register='$register' AND status=0 AND media_type='$media'";

$abc=rowcount(execute("SELECT id FROM lib_circulation_m WHERE acc_id='$accno' AND library='$library' AND register='$register' AND status=0 AND media_type='$media'"));	
if($abc==0)
{
	if($media==1 || $media==6)
	{
		$sel = "SELECT mode,book_status FROM lib_acc_details WHERE library='$library' AND register='$register' AND acc_no='$accno'";		
	}
	if($media==2 || $media==4)
		$sel = "SELECT mode,cd_status FROM lib_cd_acc_det WHERE library='$library' AND acc_no='$accno'";
	if($media==5)
		$sel = "SELECT mode,book_status FROM lib_proj_acc_det WHERE library='$library' AND acc_no='$accno'";
	//	echo $sel;
	$res1 = execute($sel);
	$num1 = rowcount($res1);
	if($num1==0)
	{
		$accno="";
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=1'>";
		//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=1");
	}
	else
	{
		$qf=fetcharray($res1);
		if($qf[1]!=1)
		{
			$accno="";
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=3'>";
			//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=3");
		}
		else
		{
			if($qf[0]=='M')
			{
				$accno="";
				echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=4'>";
				//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=4");
			}
			elseif($qf[0]=='D')
			{
				$accno="";
				echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=5'>";
				//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=5");
			}
			else
			{
				$chdt=date("Y-m-d");
			//	echo "SELECT id FROM lib_reservation_temp WHERE m_id != '$mno' AND accno='$accno' AND end_date>='$chdt' AND l_id='$library' AND media_type='$media' AND stts=0 ";
				$p=execute("SELECT id FROM lib_reservation_temp WHERE m_id != '$mno' AND accno='$accno' AND end_date>='$chdt' AND l_id='$library' AND media_type='$media' AND stts=0 ");
				
				if(rowcount($p)>0)
				{
					$accno="";
				echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=11'>";
					//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=11");
				}
				else
				{
					//echo "SELECT s_id,type FROM lib_membership_m WHERE m_no='$mno'";
					$q=fetcharray(execute("SELECT s_id,type FROM lib_membership_m WHERE m_no='$mno'"));
					$m_id=$q[type];
					if($q[type]==1)
					{
						$q1=fetcharray(execute("SELECT course_admitted FROM student_m WHERE id='$q[s_id]'"));
						$q2=execute("SELECT issues,dys FROM cir_parameter WHERE member='$q[type]' AND course='$q1[0]' AND media='$media'");
						if(rowcount($q2)==0)
							$q2=execute("SELECT issues,dys FROM cir_parameter WHERE member='$q[type]' AND course='0' AND media='$media'");
						$q3=fetcharray($q2);
						$miss=$q3[0];
						$dys=$q3[1];
					}
					else
					{
						$q1=fetcharray(execute("SELECT subj FROM staff_det WHERE id='$q[s_id]'"));
						$q2=execute("SELECT issues,dys FROM cir_parameter WHERE member='$q[type]' AND department='$q1[0]' AND media='$media'");
						if(rowcount($q2)==0)
							$q2=execute("SELECT issues,dys FROM cir_parameter WHERE member='$q[type]' AND department='0' AND media='$media'");
						$q3=fetcharray($q2);
						$miss=$q3[0];
						$dys=$q3[1];
					}
					$q4=fetcharray(execute("SELECT count(id) FROM lib_circulation_m WHERE cno='$mno' AND media_type='$media' AND status='0'"));
					if($q4[0]<$miss)
					{						
						$d=explode("-",$idate);
						$MyDay=$d[0];
						$MyMonth=$d[1];
						$MyYear=$d[2];
						$i_dt=$d[2]."-".$d[1]."-".$d[0];
						$ddate= date(" Y-m-d",mktime(0,0,0,$MyMonth,$MyDay+$dys,$MyYear));

					$var1 = "INSERT INTO lib_circulation_m (m_id,acc_id,library,register,issue_date,due_date,cno,media_type,name,status)";
						$var1.="  VALUES ('$m_id','$accno','$library','$register','$i_dt','$ddate','$mno','$media','$user','0')";
						//echo $var1;
						$res = execute($var1) or die(mysql_error());

						$var1 = "UPDATE lib_reservation_temp SET stts=1 WHERE m_id = '$mno' AND accno='$accno' AND l_id='$library' AND media_type='$media' AND stts=0";
						//echo $var1;
						$res = execute($var1) or die(mysql_error());

						if($media==1)
						{
						$var3="UPDATE lib_acc_details SET flag=1 WHERE acc_no='$accno' AND library='$library' AND register='$register'";
							$res3=execute($var3) or die(mysql_error());
						}
						if($media==2 || $media==4)
						{
							$var4="UPDATE lib_cd_acc_det SET flag=1 WHERE acc_no='accno' AND media_type='$media' AND library='$library'";
							$res4=execute($var4) or die(mysql_error());
						}
						if($media==5)
						{
								$var6="UPDATE lib_proj_acc_det SET flag=1 WHERE acc_no='$acc_no' AND library='$library'";
								$res6=execute($var6) or die(mysql_error());
						}
						$accno="";
				echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=6'>";
						//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=6");

					}
					else
					{
						$accno="";
				echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=7'>";
						//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=7");
					}
				}
			}
		}		
	}
}
else
{
	$accno="";
    echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=2'>";
	//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&media=$media&flag=2");
}
    //echo "<p>Flag value :$flag</p>";
?>
