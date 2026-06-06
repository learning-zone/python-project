<?php
include("../db.php");
if($Action == "Add")
{
	$abab = execute("select * from lib_temp1 where acc_no='$accno' and library='$library' and cardno='$crdno'") or die(mysql_error());
	$abcp=rowcount($abab);
	if($abcp>0)
	{
		
		header("Location:lib.php?rollno=$rollno&library=$library&media=$media&flag=4");
	}
	else
	{	
		$abc=rowcount(execute("select * from lib_circulation_m where acc_id='$accno' and library='$library' and status=0"));
		
		if($abc==0)
		{
			if($media==1)
			{
				$sel = "select a.title,a.author,b.call_no,b.acc_no,b.media_type from lib_book_details a,lib_acc_details b where b.acc_no='$accno' and b.library='$library' and a.id=b.master_id and b.mode='A'";
			}
			if($media==2 || $media==4)
			{
				$sel = "select a.title,a.author,b.call_no,b.acc_no,b.media_type from lib_cd_det a,lib_cd_acc_det b where b.acc_no='$accno'";
				$sel.= " and a.id=b.master_id and b.mode='A' and b.media_type=$media and b.library='$library'";
			}
			if($media==3)
			{
				$sel = "select a.title,a.author,b.call_no,b.acc_no,b.media_type from lib_floppy_det a,lib_floppy_acc_det b where b.acc_no='$accno' and a.id=b.master_id and b.mode='A' and b.library='$library'";
			}
			if($media==5)
			{
				$sel = "select a.title,a.author,b.call_no,b.acc_no,b.media_type from lib_project_report_det a,lib_proj_acc_det b";
				$sel.= " where b.acc_no='$accno' and a.id=b.master_id and b.mode='A' and b.library='$library'";
			}
			$res1 = execute($sel);
			$num1 = rowcount($res1);
			$sel1=fetcharray($res1);
			if($num1==0)
			{
				header("Location:lib.php?rollno=$rollno&library=$library&media=$media&flag=2");
			}
			if($num1!=0)
			{
				$ser=fetcharray(execute("select * from cir_parameter where member='$m_id' and media=$sel1[media_type]"));
				$ser1=$ser[issues];

				$tbl=fetcharray(execute("select count(*) from lib_temp1 where cardno='$crdno'"));
				$tbl1=$tbl[0];

				$eql=fetcharray(execute("select count(*) from lib_circulation_m where cno='$crdno' and status=0"));
				$eql1=$eql[0];
				$plus=$eql1 + $tbl1;
				
				if($plus<$ser1)
				{
					$add="insert into lib_temp1(cardno,acc_no,library,media,title,author,call_no,i_date,due_day,d_date) values('$crdno','$sel1[acc_no]','$library','$sel1[media_type]','$sel1[title]','$sel1[author]','$sel1[call_no]','$ndate','$days','$udate')";
					$add1=execute($add);
					header("Location:lib.php?rollno=$rollno&name=$name&library=$library&media=$media");
				}
				else
				{
					header("Location:lib.php?rollno=$rollno&name=$name&library=$library&media=$media&flag=1&count=$ser1");
				}
			}
		}
		else
		{
			header("Location:lib.php?rollno=$rollno&library=$library&media=$media&flag=3");
		}
	}
}

if($Action == "Remove")
{
	while( list(,$Value) = each($id) )
	{
		$rem = execute("delete from lib_temp1 where id=$Value");
	}
	header("Location:lib.php?rollno=$rollno&name=$name&library=$library&media=$media");
}
if($Action == "Clear")
{
	$clr= execute("delete from lib_temp1 where cardno='$crdno'");
	header("Location:lib.php?library=$library&media=$media");
}
?>