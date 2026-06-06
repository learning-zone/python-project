<?php

session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "<pre>";*/

if($_POST)
{
	$isbn=$_POST['isbn'];
	$year=$_POST['year'];
	$rack=$_POST['rack'];	
	
	$price=$_POST['price'];
	$title=$_POST['title'];
	$media=$_POST['media'];
	$accNo=$_POST['accNo'];
	
	$author=$_POST['author'];
	$copies=$_POST['copies'];
	$acc_to=$_POST['acc_to'];
	$acq_dd=$_POST['acq_dd'];
	$acq_mm=$_POST['acq_mm'];
	$acq_yy=$_POST['acq_yy'];
	
	$bill_no=$_POST['bill_no'];
	$subject=$_POST['subject'];
	$edition=$_POST['edition'];
	$remarks=$_POST['remarks'];
	$bill_dd=$_POST['bill_dd'];
	$bill_mm=$_POST['bill_mm'];
	$bill_yy=$_POST['bill_yy'];
	$library=$_POST['library'];
	$book_no=$_POST['book_no'];
	
	$subtitle=$_POST['subtitle'];	
	$supplier=$_POST['supplier'];
	$class_no=$_POST['class_no'];
	$acc_from=$_POST['acc_from'];
	$register=$_POST['register'];
	
	$key_word1=$_POST['key_word1'];
	$key_word2=$_POST['key_word2'];
	$key_word3=$_POST['key_word3'];
	$key_word4=$_POST['key_word4'];
	$key_word5=$_POST['key_word5'];
	$book_type=$_POST['book_type'];
	$publisher=$_POST['publisher'];
	
	$price_type=$_POST['price_type'];
	$no_of_pages=$_POST['no_of_pages'];
	$pyment_type=$_POST['pyment_type'];
	
	$purchase_type=$_POST['purchase_type'];
	$classific_num=$_POST['classific_num'];
	$author_details=$_POST['author_details'];
	$payment_details=$_POST['payment_details'];
	$publication_place=$_POST['publication_place'];
}


if($library=='')
{	
	$library=1;
}

if($media == '' or $media == 0)
{
	$media=1;
}
$bill_date = $bill_yy."-".$bill_mm."-".$bill_dd;
$acq_date = $acq_yy."-".$acq_mm."-".$acq_dd;
//echo $sql;
//die();
	$sql="INSERT INTO lib_book_details(classification_no,title,subtitle,book_no,author,author_details,publisher,publication_place,edition,year,";
	$sql.="rack,purchase_type,supplier,no_of_pages,pyment_type,payment_details,";
	$sql.="bill_no,bill_date,date_of_acquiring,price_type,price,isbn,subject,";
	$sql.="key_word1,key_word2,key_word3,key_word4,key_word5,remarks)";
	$sql.=" values ('$classific_num','$title','$subtitle','$book_no', '$author','$author_details', '$publisher', '$publication_place',";
	$sql.="'$rack','$purchase_type','$supplier','$no_of_pages','$pyment_type','$payment_details', '$edition', '$year',";
	$sql.="'$bill_no','$bill_date', '$acq_date', '$price_type', '$price','$isbn',";
	$sql.="'$subject','$key_word1','$key_word2', '$key_word3', '$key_word4', '$key_word5','$remarks') ";
	
	
	$resultDetails=execute($sql) or die("Please enter proper data ...!<br>(avoide characters like \",' while adding the book)<br><a href=../library/addMediaDet.php?media=$media><u>Back</u></a>");
	$master_id=fetchInsertId();

	$varlen=strlen($class_no);
	for($i=0;$i<$varlen;$i++)
	{
			if($class_no[$i]=='0')
			{
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='1')
			{
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='2')
			{
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='3')
			{
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='4')
			{
				
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='5')
			{
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='6')
			{
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='7')
			{
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='8')
			{
				$varnum.= $class_no[$i];
			}
			elseif($class_no[$i]=='9')
			{
				$varnum.= $class_no[$i];
			}
			else
			{
				$varstr.=$class_no[$i];
			}
		
		}
		$num= strlen($varnum);

			if($library==1 and $register==1) //PYP LIBRARY BOOK
			{
				$acc_from=explode('P',$acc_from);
				$acc_from=$acc_from[1];
			}
			
			if($library==1 and $register==3)  //PYP TEXT BOOK
			{
				$acc_from=explode('PT',$acc_from);
				$acc_from=$acc_from[1];
			}

			if($library==2 and $register==2) //MYP LIBRARY BOOK
			{
				$acc_from=explode('M',$acc_from);
				$acc_from=$acc_from[1];
			}
			
			if($library==2 and $register==4) //MYP TEXT BOOK
			{
				$acc_from=explode('MT',$acc_from);
				$acc_from=$acc_from[1];
			}
			
		for($i=0;$i<$copies;$i++)// for number of book
		{	
			//code for generating accession numbers
			$vra[$i]=0;
			$vra[$i]=$acc_from + $i;
			
			//echo '<BR>New :'.$vra[$i];
            $var = strlen($vra[$i]);
			if($var==1)
			{
				$var2[$i] = $vra[$i];
			}
			if($var==2)
			{
				$var2[$i] = $vra[$i];
			}
			if($var==3)
			{
				$var2[$i] = $vra[$i];
			}
			if($var==4)
			{
				$var2[$i] = $vra[$i];
			}
			if($var==5)
			{
				$var2[$i] = $vra[$i];
			}


			if($i==0)
			{
				$www = $class_no;
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
					default:
						$www = $varstr.$varnum;
				}
			}
				
			$sql="INSERT into lib_acc_details(master_id,media_type,acc_no,book_status,book_type,";
			$sql.="library,register,flag,mode,call_no)";
			$sql.=" values ('$master_id','$media','$var2[$i]','1','$book_type','$library','$register','0','A','$www')" ;
			
			//echo "<BR>".$sql;
			$result=execute($sql) or die(mysql_error());
			echo " <br> Accession No $var2[$i] ===$wwwEntered Successfully ";
}
			echo "<p><a href=../library/addMediaDet.php?media=$media>ADD More Media</a></p>";
?>