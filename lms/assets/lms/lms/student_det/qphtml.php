<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<form name="frm">
<input name="ClassId" id="ClassId" type="hidden" value="<?php echo $ClassName; ?>"/>
<table border="0" width="80%"><tr><td align='center'><b><?php echo collegename(); ?>
MES Road, Jalahalli, Bangalore - 560038</b></td></tr>
<tr><td align='center'><b>Chapterwise Questions</b></td></tr></table>
<table border="1" id="hor-minimalist-b" summary="Class List" width="100%" background="skyblue">

<tr><td colspan='3'><table width='80%' cellpadding=0 cellspacing=0 border="0" summary="Class List">
<?php

	$str=mysql_query("select Id,CatName,marks,Description from tblcategory group by Id");
   while($catname=mysql_fetch_array($str))
   {
       $query="SELECT a.* FROM tblquestionbank_".$ClassId." a,tbllesson b,tblsubject c,tblcategory s where a.LessonId =".$LessonId." and a.IsActive='Y' and a.LessonId=b.Id and b.SubjectID=".$SubjectId." and b.SubjectId=c.Id and c.ClassId=".$ClassId." and  a.CategoryId='$catname[Id]' and a.CategoryId=s.Id order by a.CategoryId,a.Id ";
	   $result=mysql_query($query);
		$sno=1;
		if(mysql_num_rows($result)>0)
		{
		?>
		<tr><td colspan="2" align='left'><b><?php echo $catname[Description];?></b></td></tr><tr>	
		<?
		}
		for($i=0;$i<mysql_num_rows($result);$i++)
		{
		$row=mysql_fetch_array($result);
		if($row['Rate']==1)
		$sts="Easy";
		elseif($row['Rate']==2)
		$sts="Moderate";
		elseif($row['Rate']==3)
		$sts="Difficult";
		?>
		
		<td align='center'><b><?php echo $sno;?>.</b></td><td>
		<?
		echo stripslashes(urldecode($row['Question']));
		?>
		</td></tr>
		<?php
			$sno++;
		}
	echo "";
}
	echo "</table></td></tr>";
 mysql_close();?>
 </table>
</form>
</body>
</html>
