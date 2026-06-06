<?php
session_start();
	include("../adminunlockdb.php");
	if($branch!=0 && $sem!=0 && $a_year!=0)
	{
			$da = substr($a_year,2,4);
			$va = "select cids,head_id from course_m where course_id='$branch'";
			$re = mysql_query($va);
			$ro = mysql_fetch_row($re);

			$abbr=$ro[0];
			
			$var = "select MAX(id) from student_m where academic_year='$a_year'";
			$res = mysql_query($var) or die(mysql_error());
			$row = mysql_fetch_row($res);
			if($row[0]=="")
			{
				$var01 = "CLR"."$da"."$abbr"."0001";	
				$app_num=$var01; 
			}
			else
			{
				$var1 = mysql_query("select student_id from student_m where id='$row[0]'") or die(mysql_error());
				$row1 = mysql_fetch_row($var1);
				
				if($ro[1]==1)
				{
					$vara=substr("$row1[0]",7);
				}
				if($ro[1]==2)
				{
					$vara=substr("$row1[0]",8);
				}
				
				$varb = $vara+1;
				if($varb<10)
				{
					if($ro[1]==1)
					{
						$app_num = "CLR"."$da"."$abbr"."0"."0"."$varb";
					}
					if($ro[1]==2)
					{
						 $app_num = "CLR"."$da"."$abbr"."0"."$varb";
					}

				}
				else if($varb<100)
				{
				  
					if($ro[1]==1)
					{
						 $app_num = "CLR"."$da"."$abbr"."0"."$varb";
					}
					if($ro[1]==2)
					{
						 $app_num = "CLR"."$da"."$abbr"."$varb";
					}
				}
				else
				{
					$app_num = "CLR"."$da"."$abbr"."$varb";
				}
			}
			$papp_num = "PCLR"."$app_num";
				
		echo "$app_num";
	}
?>