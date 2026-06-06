<?php 
$file_type = "vnd.ms-excel";
$file_name= "Categorywise.xls";
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=$file_name");
 
include("../db1.php");
 $k="select id,name from category order by id";
 $kum=mysql_query($k) or die (mysql_error());
 $kum1=mysql_num_rows($kum);
 $cspan=$kum1+40;
?>
<table border=1 width=70%  cellspacing='1' cellpadding='1' class='forumline'>
 <tr>
    <td align="center" colspan='<?=$cspan?>' class='head'><font size=3><b>VIDYAVARDHAKA COLLEGE OF ENGINEERING, MYSORE</b></font></td>
 </tr>
 <tr>
    <td align="center" colspan='<?=$cspan?>' class='head'><font size=3><b>CATEGORY WISE ADMISSION STATISTICS OF I YEAR B.E FOR THE YEAR <?php echo $a_year?>-<?php echo $a_year+1?></b></font></td>
 </tr>

<tr height='30'>
    <td align=center rowspan=2><b>SL. NO</b></td>
	<td align=center rowspan=2 width='20%'><b>COURSE</b></td>
	<?php  
	  //this loop displays the category from the database i.e gm,sc,st etc.. 
	
	 for($j=0;$j<$kum1;$j++)
	 {
		 $ku=mysql_fetch_array($kum);
		 ?>
		 <td colspan=2 align=center><?php echo $ku[name] ?></td>
		<?php
	 }
    ?>
	 <td align=center colspan=3><b>Total Students</b></td>
</tr>
<tr height='30'>
	 <?php
	 // this for loop is for M/girl to display in all category.
	 for($j=0;$j<=$kum1;$j++)
	 {
		 ?>
			<td align=center>M</td>
			<td align=center>F</td>
	     <?
	 }
	 ?>
	    <td align=center>Total</td>

</tr>

<?php
// this loop fetches the various courses from the database..
$nam = "select course_id,coursename from course_m where status=1  order by course_id";
$name = mysql_query($nam) or die(mysql_error());
$name1 = mysql_num_rows($name);
$gdbtotal=0;
$gdftotal=0;
$gdtotal=0;
$k="select id,name from category order by id";
$kum=mysql_query($k) or die (mysql_error());
$kum1=mysql_num_rows($kum);
for($i=0;$i<$kum1;$i++)
{
	$gbtotal[$i]=0;
	$gftotal[$i]=0;
}
for($i=0;$i<$name1;$i++)
{
	$n=mysql_fetch_array($name);
	?>
	  <tr height='30'>
	       <td nowrap align='center'><?php echo $i+1 ?></td> <!-- displays the sl no -->
		   <td nowrap> &nbsp;&nbsp;<?php echo $n[coursename] ?></td>    <!--   displays the name of the courses   -->
			<?php
			$k="select id,name from category order by id";
			$kum=mysql_query($k) or die (mysql_error());
		    $kum1=mysql_num_rows($kum);
		    $mtotal=0;
		    $ftotal=0;
		    for($j=0;$j<$kum1;$j++)
		      {
			    $ku=mysql_fetch_array($kum);
                 //this loop  counts and fetches the no of male students
				$var = "select count(id) as count from student_m where course_admitted='$n[course_id]' and quota_id='$ku[id]' and gender='M' and academic_year='$a_year' and course_yearsem in (1,2) ";
	            $res = mysql_query($var) or die(mysql_error());
	            $num = mysql_num_rows($res);
	            $num1=mysql_fetch_array($res);
			    $mtotal=$mtotal + $num1[count];
			    $num11[$j]=$num1[count];
			    ?>
			    <td align=center><?php echo $num1[count] ?></td>  <!-- for display of number of male students -->
                <?php
					//this loop counts and fetches the number of female students
			    $var = "select count(id) as count from student_m where course_admitted='$n[course_id]' and quota_id='$ku[id]' and gender='F' and academic_year='$a_year' and course_yearsem in (1,2) ";
	            $res = mysql_query($var) or die(mysql_error());
	            $num = mysql_num_rows($res);
			    $num2=mysql_fetch_array($res);
			    $ftotal=$ftotal + $num2[count];
			   $num22[$j]=$num2[count];
			    ?>
			    <td align=center><?php echo $num2[count] ?></td>	<!-- display the no female students	 -->
		        <?
		      }
			 $fmtotal=$mtotal + $ftotal;
			 $gdbtotal=$gdbtotal + $mtotal;
			 $gdftotal=$gdftotal + $ftotal;
			 $gdtotal=$gdtotal + $fmtotal;
		     for($j=0;$j<$kum1;$j++)
	             {
		            $gbtotal[$j]=$gbtotal[$j] + $num11[$j];
		            $gftotal[$j]=$gftotal[$j] + $num22[$j];
	             }
		         ?>
			 <td align=center><?php echo $mtotal ?></td>
			 <td align=center><?php echo $ftotal ?></td>
			 <td align=center><?php echo $fmtotal ?></td>
</tr>
<?php   
  }
?>
<tr height='30'>
    <td colspan=2 align=center>Total</td> 
    <?php
    for($i=0;$i<$kum1;$i++)
      {
      ?>
        <td align=center><?php echo $gbtotal[$i] ?></td>
        <td align=center><?php echo $gftotal[$i] ?></td>
     <?
      }
     ?>
    <td align=center><?php echo $gdbtotal ?></td>
    <td align=center><?php echo $gdftotal ?></td>
    <td align=center><?php echo $gdtotal ?></td>
</tr>
</table>