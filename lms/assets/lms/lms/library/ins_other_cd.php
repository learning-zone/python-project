<HTML>
<HEAD>
<?php
require("../db.php");
$media=$_POST['media'];
$library=$_POST['library'];
$register=$_POST['register'];
$acc_from=$_POST['acc_from'];
$copies=$_POST['copies'];
$acc_to=$_POST['acc_to'];
$title=$_POST['title'];
$rack=$_POST['rack'];
$class_no=$_POST['class_no'];
$call_no=$_POST['call_no'];
$price=$_POST['price'];
$source=$_POST['source'];
$volume=$_POST['volume'];
$issue=$_POST['issue'];
$acq_yy=$_POST['acq_yy'];
$acq_mm=$_POST['acq_mm'];
$acq_dd=$_POST['acq_dd'];
$pub_yy=$_POST['pub_yy'];
$pub_mm=$_POST['pub_mm'];
$pub_dd=$_POST['pub_dd'];
$key_word1=$_POST['key_word1'];
$key_word2=$_POST['key_word2'];
$key_word3=$_POST['key_word3'];
$key_word4=$_POST['key_word4'];
$key_word5=$_POST['key_word5'];
$remarks=$_POST['remarks'];
$cd_type=$_POST['cd_type'];
$accNo=$_POST['accNo'];
if(($acq_dd !="00")||($acq_mm !="00")||($acq_yy !="0000"))
{
	if(!checkdate($acq_mm,$acq_dd,$acq_yy))
	{
		echo "<font color=royalblue;><b>Invalid Acquiring Date.</b> </font>";
		die("</td></tr></table>");
	}
}
$acq_date = "$acq_yy-$acq_mm-$acq_dd";

if(($pub_dd !="00")||($pub_mm !="00")||($pub_yy !="0000"))
{
	if(!checkdate($pub_mm,$pub_dd,$pub_yy))
	{
		echo "<font color=royalblue;><b>Invalid Publication  Date.</b> </font>";
		die("</td></tr></table>");
	}
}
$publication_date = "$pub_yy-$pub_mm-$pub_dd";

?>

</HEAD>
<BODY>
<form>
<?
	$sql="insert into lib_cd_det(title,class_no,rack,date_of_acquiring,key_word1,key_word2,key_word3,key_word4,key_word5,	publication_date,price,volume,issue,source,remarks)";
	$sql.=" values ('$title','$class_no','$rack','$acq_date','$key_word1','$key_word2', '$key_word3', '$key_word4', '$key_word5','$publication_date','$price','$volume','$issue','$source','$remarks') ";
	execute($sql) or die(mysql_error());
	$master_id=fetchInsertId();
    
	$varlen=strlen($call_no);
	for($i=0;$i<$varlen;$i++)
	{
			if($call_no[$i]=='0')
			{
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='1')
			{
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='2')
			{
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='3')
			{
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='4')
			{
				
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='5')
			{
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='6')
			{
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='7')
			{
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='8')
			{
				$varnum.= $call_no[$i];
			}
			elseif($call_no[$i]=='9')
			{
				$varnum.= $call_no[$i];
			}
			else
			{
				$varstr.=$call_no[$i];
			}		
		}
		$num= strlen($varnum);
	
		for($i=0;$i<$copies;$i++)// for number of book
		{	
			//code for generating accession numbers
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
                   	
			if($i==0)
			{
				$www = $call_no;
			}
			else
			{
				$varnum = $varnum + 1;
				$len = $num - strlen($varnum);
				switch($len)
				{
					case 1:
						$www = $varstr."0".$varnum;
					break;
					case 2:
						$www = $varstr."00".$varnum;
					break;
					case 3:
						$www = $varstr."000".$varnum;
					break;
					case 4:
						$www = $varstr."0000".$varnum;
					break;
					case 5:
						$www = $varstr."00000".$varnum;
					break;
				}
			}

		$sql="insert  into lib_cd_acc_det(master_id,media_type,acc_no,mode,cd_status,cd_type,library,register,flag,call_no)";
		$sql.=" values ('$master_id','$media','$var2[$i]','A','1','$cd_type','$library','$register','0','$www')" ;
		execute($sql) or die(mysql_error());
		echo " <br> Accession No <b>$var2[$i] </b>Entered Successfully <br>";
	}
echo "<a href=../library/add_other_cd.php?media=$media><b>Go Back</b></a></div></td>";
?>
</form>
</BODY>
</HTML>