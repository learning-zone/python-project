<?php
require_once("../db.php");
$action=$_REQUEST['action'];
$library=$_POST['library'];
$register=$_POST['register'];
$media=$_REQUEST['media'];
$Sel=$_POST['Sel'];
$fr_dd=$_POST['fr_dd'];
$fr_mm=$_POST['fr_mm'];
$fr_yy=$_POST['fr_yy'];
$to_dd=$_POST['to_dd'];
$to_mm=$_POST['to_mm'];
$to_yy=$_POST['to_yy'];

if(isset($Sel))
	{
		while(list(,$value) = each($Sel))
			{
				$bhb=execute("select * from lib_reservation_m where id=".$value) or die(mysql_error());
				$rett=fetcharray($bhb);
				$accnumber=$rett[l_id];
				$sql="DELETE FROM lib_reservation_temp WHERE id=".$value;
				$rs=execute($sql);
				$var_001=execute("select * from lib_reservation_m where l_id=$accnumber");

				if(rowcount($var_001)==0)
					{
						$var_002=execute("select a.master_id,b.id,b.title from lib_acc_details a,lib_book_details b where a.acc_no=$accnumber and a.master_id=b.id");
						$var_022=fetcharray($var_002);
						$dar_001=execute("select * from special_reservation_temp where bok_id=$var_022[master_id] order by id");

						if(rowcount($dar_001)!=0)
							{
								for($r=0;$r<rowcount($dar_001);$r++)
									{
										$bbgh=fetcharray($dar_001);
										if($r==0)
										$mem_id=$bbgh[m_id];
										$did=$bbgh[id];
										break;
									}
								$Tdate = "'".date(Y)."-".date(m)."-".date(d)."'";
								$rs_sql=execute("select due_date  from lib_circulation_m where status=0 and acc_id='$accnumber'");

								if(rowcount($rs_sql) ==0)
									{
										$today = getdate();
										$month = $today['mon'];
										$day = $today['mday'];
										$year = $today['year'];
									}
								else
									{
										$r_sql=fetcharray($rs_sql);
										$today=$r_sql[due_date];
										$temp_date=explode('-',$today);
										$month = $temp_date[1];
										$day = $temp_date[2];
										$year = $temp_date[0];
									}
								$ndate= date(" Y-m-d",mktime(0,0,0,$month,$day+3,$year));
								$sql = "INSERT INTO lib_reservation_m (l_id,m_id,resDate,end_date) VALUES($accnumber,'$mem_id',$Tdate,'$ndate')";
								execute($sql) or die(mysql_error());
								$retVal=1;
								execute("INSERT INTO lib_reservation_temp (l_id,m_id,resDate,end_date) VALUES($accnumber,'$mem_id',$Tdate,'$ndate')")or die(mysql_error());
								execute("delete from special_reservation_temp where id=$did" )or die(mysql_error());
								$rdrrmsg="<br>Book Has Been Reserved To $mem_id Card";

							}
						else
							{
								$rdrrmsg="<br>"."No one has reserverd this media.";
							}
					}
			}
		echo "<center>Reservation Detail is deleted successfully<br> $rdrrmsg</center>";
		}
	else
		echo"<center>Please select the check box...!</center>";
	?>
