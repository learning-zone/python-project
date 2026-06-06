<?php
	session_start();
	include("../db1.php");
	
	$adate = $_POST['adate']; 
	$bdate = $_POST['bdate'];
	
	

?>
<html>
<head>

<script language="javascript" src="../POS/JSScripts/cal2.js"></script>
<script language="javascript" src="../POS/JSScripts/cal_conf2.js"></script>
<script language="javascript">
function OpenWind2(k2)
{

 var finalVar ;

 finalVar=k2 ;

 window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}
</script>
</head>
<body>

<form name="frm" method="post">
<table width="50%" align="center">
<tr>
	<td colspan="2" class="head" align="center">Select Date Range
	</td>
</tr>
<tr><br>
	<td width="30%" align="right">
	Select From Date *
	</td>
	<td>&nbsp;&nbsp;<input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;
	<a href="javascript:showCal('Calendar1')"><img src="../POS/images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
	<td width="30%" align="right">
	Select To Date *
	  </td>
		 <td>&nbsp;&nbsp;<input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;
		  <a href="javascript:showCal('Calendar2')"><img src="../POS/images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
	  </td>
	</tr>
	
</table>
<br>
<div align="center">
<input type="submit" name="search" value="Search" class="bgbutton"/>
</div>
<br>
<table align="center" width="80%" border="1" cellpadding="0" cellspacing="0">

<tr>
			<td vAlign="top" align="center"  height="30" colspan=8 class=head>
			 Medical Room Visit Record
			 </td>
		</tr>
  <tr  class="submenu">
   
    <td colspan="2" align="center">&nbsp;No. of <br>students visit <br>the Clinic</td>
   <!-- <td colspan="2" align="center">&nbsp;Students Sent home</td>-->
   <!-- <td colspan="2" align="center">&nbsp;Students taken to the Hospital</td>-->
   <!-- <td colspan="2" align="center">No of staff use the clinic</td>-->
   <!--  <td align="center">Total</td>-->
    
  </tr>
  
  
  <tr>
  <?
   /* if($_POST['search'])
	{*/
		$adate1 = explode('/',$adate);
		$adate=$adate1[2]."-".$adate1[1]."-".$adate1[0];
		$bdate1 = explode('/',$bdate);
		$bdate=$bdate1[2]."-".$bdate1[1]."-".$bdate1[0];
	
	$query=execute("select COUNT(a.id),a.*,b.gender, DATE_FORMAT(a.d_date, '%M') from doc_detail a,student_m b where a.stud_id=b.student_id and b.gender='F' and YEAR(a.d_date) = YEAR(CURDATE()) AND MONTH(a.d_date) = MONTH(CURDATE())");
	 while($ddf9=fetchrow($query))
		       {
	?>
    <!--<td align="center">&nbsp; <?=$thismonth = date('F');?></td>-->
    <?
			   }
			   ?>
   
    <td align="center">&nbsp;Girls</td>
    <td align="center">&nbsp;Boys</td>
   <!-- <td align="center">&nbsp;Girls</td>
    <td align="center">&nbsp;Boys</td>
    <td align="center">&nbsp;Teaching</td>
    <td align="center">&nbsp;Non-Teaching</td>-->
     
   
  </tr>
  <tr>
   <!-- <td>&nbsp;</td>-->
    <?php	
	$c_1=fetcharray(execute("select count(id),sex from doc_detail where sex='Female'  and stud_id!='' and d_date BETWEEN  '$adate' AND  '$bdate'"));
	
	 $c_2=fetcharray(execute("select count(id),sex from accident_report where sex='Female' and stud_id!='' and d_date BETWEEN  '$adate' AND  '$bdate'")); 
			
		  $frst=$c_1[0]+$c_2[0]; 		
		
		?>
		
         <td align='center'>&nbsp;<a href="javascript:OpenWind2('clinicvisit_gals.php?adate=<?=$adate?>&bdate=<?=$bdate?>')" >
           <?=$c_1[0]+$c_2[0]?>
         </a>&nbsp;</td>
   
    
     <?php	
	$d_1=fetcharray(execute("select count(id),sex from doc_detail where sex='Male' and stud_id!='' and d_date BETWEEN  '$adate' AND  '$bdate'"));
	
	 $d_2=fetcharray(execute("select count(id),sex from accident_report where sex='Male' and stud_id!='' and d_date BETWEEN  '$adate' AND  '$bdate'")); 
			
		  $secnd=$d_1[0]+$d_2[0]; 		
		
		?>
		
         <td align='center'>&nbsp;<a href="javascript:OpenWind2('clinicvisit_boys.php?adate=<?=$adate?>&bdate=<?=$bdate?>')" >
           <?=$d_1[0]+$d_2[0]?>
         </a>&nbsp;</td>
    
     <?
	 
    $df2=fetcharray(execute("select count(a.id),a.sex from doc_detail a,accident_report b where a.sex='Female' and a.d_date BETWEEN '$adate' AND '$bdate' and a.type='yes' or b.type='yes'"));
	
			
			
		         $thd=$df2[0]; 
		?>
		
        
    <!--<td align="center">&nbsp;<a href="javascript:OpenWind2('home_list_gals.php?adate=<?=$adate?>&bdate=<?=$bdate?>')" >
      <?=$thd?>
    </a></td>-->
   
    <?
    $df4=fetcharray(execute("select count(a.id),a.sex from doc_detail a,accident_report b where a.sex='Male' and a.d_date BETWEEN '$adate' AND '$bdate' and a.type='yes' or b.type='yes'"));
	 		
			 $frth=$df4[0]; 
		        
		?>
		
        
   <!-- <td align="center">&nbsp;<a href="javascript:OpenWind2('home_list_boys.php?adate=<?=$adate?>&bdate=<?=$bdate?>')" ><?=$frth?>

</a></td>-->
    
     <?
	/* 
	 $sql_t=execute("select * from staff_group where name like 'Teaching%' and status=1");
$fs=fetcharray($sql_t);
	 
	 
    $df4=execute("select count(id),group_id,des_id,sex from doc_staff where group_id=1");
	 while($ddf4=fetchrow($df4))
		       {		
			 $fifth=$ddf4[0]; */
		        
		?>
		
        
   <!-- <td align="center">&nbsp;<a href="javascript:OpenWind2('home_list_boys.php?adate=<?=$adate?>&bdate=<?=$bdate?>')" ><?=$ddf4[0]?>

</a></td>-->
    <?
  //  }
	?>

    <!--<td>&nbsp; <?
	 
	/* $sql_t=execute("select * from staff_group where name like 'Teaching%' and status=1");
$fs=fetcharray($sql_t);
	 
	 
    $df4=execute("select count(id),group_id,des_id,sex from doc_staff where group_id!=1");
	 while($ddf4=fetchrow($df4))
		       {		
			 $fifth=$ddf4[0]; */
		        
		?>
		
        
    
    <?
   // }
	?></td>-->
   
    <!-- <td align="center">&nbsp;-->
     <?php
    //$total123=$frst+$scnd+$thd+$frth+$fif+$sixth;
	//$total123=$frst+$scnd;
	// echo $total123;
	 ?>
 <?php
	//}
	?>
     
     
     <!--</td>-->
 
  
    
  </tr>


</table>
</form>
</body>
</head>
<br>
</html>

