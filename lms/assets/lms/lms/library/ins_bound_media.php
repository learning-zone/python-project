<HTML>
<HEAD>
<?php
	require("../db.php");

	if(($acq_dd !="00")||($acq_mm !="00")||($acq_yy !="0000"))
		{
			if(!checkdate($acq_mm,$acq_dd,$acq_yy))
				{
					echo "<font color=royalblue;><b>Invalid Acquiring Date.</b> </font>";
					die("</td></tr></table>");
				}
		}
	$acq_date = "$acq_yy-$acq_mm-$acq_dd";

?>

</HEAD>
<BODY>
<form>
<?
/*
if($media < 10)
{
	$media1="0".$media;
}
if($acc_no < 10)
{
	$j="0000".intval($acc_no);
}
elseif($acc_no <100)
{
	$j="000".intval($acc_no);
}
elseif($acc_no <1000)
{
	$j="00".intval($acc_no);
}
elseif($acc_no <10000)
{
	$j="0".intval($acc_no);
}
else
{
	$j=$acc_no;
}


$acc_no=$register.$media1.$j;

$rs_sql=execute("select acc_no from lib_bound_media_det where acc_no='$acc_no'");
if(rowcount($rs_sql)>0)
{
	echo "<br>Accession No.<font color='red'><b>$acc_no</b></font> already exits<br>";
	die();
}
*/
	$sql="insert into lib_bound_media_det(class_no,acc_no,title,month,";
	$sql.="year,periodicity,";
	$sql.="key_word1,key_word2,key_word3,key_word4,key_word5,remarks,date_of_acquiring)";
	$sql.=" values ('$class_no','$acc_no','$title','$month',";
	$sql.="'$year','$periodicity', ";
	$sql.="'$key_word1','$key_word2', '$key_word3', '$key_word4', '$key_word5','$remarks','$acq_date') ";
	echo "$sql.<br>";
//execute($sql) or die(mysql_error());
	$flag1=1;
	$master_id=fetchInsertId();
/*if($mode=="on")
{
	$bound_mode="D";
}
else
{
	$bound_mode="A";
}

while(list(,$mag_acc_id)=each($mag_id))
{

	$mag_acc_no='mag_acc_no'.$mag_acc_id;
	$mag_acc_no=$$mag_acc_no;

	$volume='volume'.$mag_acc_id;
	$volume=$$volume;

	$issue='issue'.$mag_acc_id;
	$issue=$$issue;



	$sql1="select mag_acc_no from lib_bound_acc_det where mag_acc_no='". $mag_acc_no ."'";

	$rs1=execute($sql1);
	if(rowcount($rs1)==0)
	{  */

		
		for($i=0;$i<$copies;$i++)
			{	
				$vra[$i]=0;
				$vra[$i]=$acc_from+$i;
				$var = strlen($vra[$i]);
				if($var==1)
					{
						$var2[$i] = '00000'.$vra[$i];
					}
				if($var==2)
					{
						$var2[$i] = '0000'.$vra[$i];
					}
				if($var==3)
					{
						$var2[$i] = '000'.$vra[$i];
					}
				if($var==4)
					{
						$var2[$i] = '00'.$vra[$i];
					}
				if($var==5)
					{
						$var2[$i] = '0'.$vra[$i];
					}

				$sql="insert into lib_bound_acc_det(master_id,mag_acc_no,volume,issue,mode,bound_status,bound_type,";
				$sql.="library,register,flag)";
				$sql.=" values ('$master_id','$var2[$i]','$volume','$issue','$bound_mode', '1', '$bound_type','$library' ,$register', '0')" ;
				echo "$sql.<br>";
					//execute($sql) or die(mysql_error());
					//execute("update lib_magazine set bound='Y' where magazine_no='$mag_acc_no'");
			/*
					$flag2=1;
				}
				else
				{
					echo "<br>Magazine Accession No.<font color='red'><b>$mag_acc_no</b></font> already exits<br>";
				}
			}
			if($flag1==1 && $flag2==0)
			{
				execute("delete from lib_bound_media_det where id=$master_id");
				echo "<a href=../library/add_bound_media.php?media=$media><b>Go Back</b></a></div></td>";
			}
			else if($flag==1)
			{
				echo "<font color='blue' size=4> Data Saved Successfully.</font>";
			}*/

		}
?>
</form>
</BODY>
</HTML>
