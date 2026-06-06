<html>
<head><?php
session_start();
require("../db.php");
$Type=$_REQUEST['Type'];
$level=$_REQUEST['level'];
$level=$_POST['level'];
$new_elective=$_REQUEST['new_elective'];
$new_elective=$_POST['new_elective'];
$Course=$_POST['Course'];
$sem=$_POST['sem'];
$Sel=$_POST['Sel'];
$NewSub=$_POST['NewSub'];
$NewMarks=$_POST['NewMarks'];
$Newcode=$_POST['Newcode'];
$NewType=$_POST['NewType'];
$elective=$_POST['elective'];
$sub_year=$_POST['sub_year'];
$NewtMarks=$_POST['NewtMarks'];
$Newpre=$_POST['Newpre'];
$sname=$_POST['sname'];

$grades=$_REQUEST['grades'];
$subj=$_REQUEST['subj'];
$class_section=$_REQUEST['class_section'];
$sem=$_REQUEST['sem'];
$subnames1=fetcharray(execute("select head_id from course_year where year_id='$grades' and status=1"));


if(trim($Type) == "Add")
{
	if($NewSub == "")
	{
		die("<b>Data could not be updated since course name is *NOT* mentioned<b>");
	}
	if($NewMarks == "")
	{
		$NewMarks = 0;
	}
	$sql23="select * from subject_m where course_id=$subnames1[0] and subject_name='$NewSub' and sub_type=$NewType and total_marks=$NewMarks and course_year_id=$grades and subject_code='$Newcode'";
	$rs23=execute($sql23);
	$rn=rowcount($rs23);
	if($rn==0)
	{
		if($subnames1[0]>0)
		{		 
			$elective= $new_elective;
			if($elective == "on")
			{
				$elective='Y';
			}
			else
			{
				$elective='N';
			}
			$sqlstr1="Insert Into subject_m(course_id,subject_name,sub_type,";
			$sqlstr1.="total_marks,course_year_id,subject_code,elective,sys_year,max_mark,sub_pre) Values ";
			$sqlstr1.="($subnames1[0],'$NewSub',$NewType,$NewMarks,$grades,'$Newcode','$elective', '$sub_year','$NewtMarks','$Newpre')";
			
			execute($sqlstr1) or die(mysql_error());
			
			$c=execute("show tables like 'marks_".$subnames1[0]."_".$grades."'");
			$nc=rowcount($c);
			if($nc==0)
			{
				$var = "CREATE TABLE marks_".$subnames1[0]."_".$grades." (id int(11) NOT NULL auto_increment,
  studid int(20) default NULL,
  secid int(2) default NULL,
  bid int(2) default NULL,
  subid int(3) NOT NULL default '0',
  assmk1 int(11) default NULL,
  ba1 int(3) NOT NULL default '0',
  assmk2 int(11) default NULL,
  ba2 int(3) NOT NULL default '0',
  assmk3 int(11) default NULL,
  ba3 int(3) NOT NULL default '0',
  assmk4 int(11) default NULL,
  ba4 int(3) NOT NULL default '0',
  assmk5 int(11) default NULL,
  ba5 int(3) NOT NULL default '0',
  assmk6 int(11) default NULL,
  ba6 int(3) NOT NULL default '0',
  assmk7 int(11) default NULL,
  ba7 int(3) NOT NULL default '0',
  assmk8 int(11) default NULL,
  ba8 int(3) NOT NULL default '0',
  assmk9 int(11) default NULL,
  ba9 int(3) NOT NULL default '0',
  assmk10 int(11) default NULL,
  ba10 int(3) NOT NULL default '0',
  accyr int(4) default NULL,
  UNIQUE KEY id (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
				$cr=execute($var) or die(mysql_error());
				execute($nsql);
			}
			$c1=execute("show tables like 'att_".$subnames1[0]."_".$grades."'");
			$nc1=rowcount($c1);
			if($nc1==0)
			{
				$marksqur="CREATE TABLE att_".$subnames1[0]."_".$grades." (
				  id bigint(20) NOT NULL auto_increment,
  att_date date NOT NULL,
  stu_id bigint(20) NOT NULL,
  sec int(1) NOT NULL,
  mor int(1) NOT NULL,
  after int(1) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
				$cr=execute($marksqur) or die(mysql_error());
				
			}
		}
		else
		{		 
			 if($new_ele==1 || $new_ele==2)
			  {
					$flag=1;
					$elective='Y';
			  }	
			  else
			  {
					//$flag=2;
					$elective='N';
			  }
			$sqlstr1="Insert Into subject_m(course_id,subject_name,sub_type,";
			$sqlstr1.="total_marks,course_year_id,subject_code,elective,cycle,sys_year,max_mark) Values ";
			$sqlstr1.="($subnames1[0],'$NewSub','$NewType','$NewMarks','$grades','$Newcode','$elective','$new_ele','$sub_year','$NewtMarks')";
			execute($sqlstr1) or die(mysql_error());
			
			$table = "marks_".$subnames1[0]."_".$grades;	
			$c=execute("show tables like '$table'");
			$r = rowcount($c);
			if($r==0)
			{
				$var = "CREATE TABLE $table (id int(11) NOT NULL auto_increment,
  studid int(20) default NULL,
  secid int(2) default NULL,
  bid int(2) default NULL,
  subid int(3) NOT NULL default '0',
  assmk1 int(11) default NULL,
  ba1 int(3) NOT NULL default '0',
  assmk2 int(11) default NULL,
  ba2 int(3) NOT NULL default '0',
  assmk3 int(11) default NULL,
  ba3 int(3) NOT NULL default '0',
  assmk4 int(11) default NULL,
  ba4 int(3) NOT NULL default '0',
  assmk5 int(11) default NULL,
  ba5 int(3) NOT NULL default '0',
  assmk6 int(11) default NULL,
  ba6 int(3) NOT NULL default '0',
  assmk7 int(11) default NULL,
  ba7 int(3) NOT NULL default '0',
  assmk8 int(11) default NULL,
  ba8 int(3) NOT NULL default '0',
  assmk9 int(11) default NULL,
  ba9 int(3) NOT NULL default '0',
  assmk10 int(11) default NULL,
  ba10 int(3) NOT NULL default '0',
  accyr int(4) default NULL,
  UNIQUE KEY id (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
				$res=execute($var) or die(mysql_error());
			}
		}
	}
	?>
		<Script language="JavaScript">
		window.opener.location.href='class_create.php?id=1&sem='+"<?=$grades?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
		
        </Script>
		
		<?php		
}
elseif(trim($Type) == "Mod")
{
		while( list(,$Value) = each($Sel) )
		{
			$sql=execute("select * from subject_m where subject_id=$Value");
			$r2=fetcharray($sql);
			$old_sub_name=$r2[subject_name];
			$SubName = $_POST[$Value.'subName'];
			$sub_year =$_POST[$Value.'sub_year1'];
			$SubCode = $_POST[$Value.'subcode'];
			$MarksField = $Value ."Marks";
			$Marks =$_POST[$Value.'Marks'];
			$s_pre =$_POST[$Value.'pre'];
			$tMarks =$_POST[$Value.'tMarks'];
			$SubType = $_POST[$Value.'SubType'];
			$level = $_POST[$Value.'level'];

			if($Marks == "")			
			{
				$Marks=0;
			}
			
			if($subnames1[0]>0)
			{
				$elective =$_POST[$Value.'elective'];

				if($elective == "on")
				{
					$elective='Y';
				}
				else
				{
					$elective='N';
				}

				$sqlstr="Update subject_m Set sys_year='$sub_year' , subject_name='" . $SubName ;
				$sqlstr .= "',sub_type=" . $SubType . ",elective='".$elective."',total_marks=" . $Marks.",max_mark='" . $tMarks."'";
				$sqlstr .= ",subject_code='" . $SubCode."',sub_pre='" . $s_pre."'";
				$sqlstr .= " Where Subject_id=" . $Value;
				
				execute($sqlstr) or die(mysql_error());
				$sql19="select * from subject_m  Where Subject_id=" . $Value;
				//echo $sql19;
				$rs19=execute($sql19);
				$r19=fetcharray($rs19);
				$subId=$r19[0];			

			}
		    
			if($subnames1[0]==0)
			{

				$ele =$_POST[$Value.'new_ele'];

				$sqlstr="Update subject_m Set sys_year='$sub_year' , subject_name='$SubName',sub_type='$SubType',";
				$sqlstr.="cycle='$ele',total_marks='$Marks',subject_code='$SubCode' , sys_year='$sub_year',max_mark='$tMarks'";
				$sqlstr.="Where Subject_id='$Value'";
				execute($sqlstr) or die(mysql_error()."1");

			}
			$msg="SUBJECT MODIFIED SUCCESSFULLY";	
			?>
		<Script language="JavaScript">
		window.opener.location.href='class_create.php?id=1&sem='+"<?=$grades?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
		
        </Script>
		
		<?php	
		}
		
}
elseif(trim($Type) == "Del")
{
	while(list(,$Value) = each($Sel))
	{
		$sqlstr = "update ";
		$sqlstr.= "subject_m set status=0 WHERE course_id= $subnames1[0]";
		$sqlstr .= " and course_year_id = $grades and subject_id=" .$Value;
		$sqlstr="UPDATE subject_m SET status=0 Where subject_id=" . $Value;
		execute($sqlstr) or die(error_description());
	}
	$msg="SUBJECT DELETED SUCCESSFULLY";
	?>
		<Script language="JavaScript">
        alert("Updated Sucessfully!");
		window.opener.location.href='class_create.php?id=1&sem='+"<?=$grades?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
		
        </Script>
		
		<?php
}
elseif(trim($Type) == "Act")
{
	if(is_array($sname))
	{
		while( list(,$Value) = each($sname) )
		{
			$sqlstr = "update ";
			$sqlstr.= "subject_m set status=1 WHERE course_id= $subnames1[0]";
			$sqlstr .= " and course_year_id = $grades and subject_id=" .$Value;
			execute($sqlstr) or die(mysql_error());
		}
	}
	
}
?>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="add_sub.php?ctype=$ctype&Course=$subnames1[0]&CYear=$CYear&Msg=$msg&sem=$grades";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
  <input type="hidden" name="grades" value="<?=$grades?>" >
  <input type="hidden" name="msg" value="<?=$msg?>" >
     </form>
     </body>
     </html>