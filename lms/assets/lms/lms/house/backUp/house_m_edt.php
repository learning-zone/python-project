<?php
session_start();
include("../db.php");
$name=$_POST['name'];
$description=$_POST['description'];
$color_code=$_POST['color_code'];
$Submit=$_POST['Submit'];


//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);
?>
<html>
<head>
<script language="javascript">
function OpenWind2(k2)
{
 var finalVar ;
 finalVar=k2 ;
 window.open(finalVar,'Detailed_report','_blank,align=center,width=800,height=600,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<body>
<?PHP

		
	   $result=mysql_query("SELECT * FROM house_m ORDER BY id");
		
	   if(mysql_num_rows($result)>0)
       {
	   ?>
	   
	<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
		<tr height='25'>
		    <td align='center' class='head' colspan='4'><font size="4"><b>MASTER FORM</b></font></td>
		</tr>
		<tr height='25' >
			<td Class="rowpic" align='center' width="10%">Sl No</td>
			<td Class="rowpic" align='center' width="40%">Name</td>
			<td Class="rowpic" align='center' width="40%">Desciption</td>
			<td Class="rowpic" align='center' width="10%">Color</td>
			
	   </tr>
       <?
	   	    $i=0;
            $rowclass=1;
            $sno=1; 
           while($row=mysql_fetch_array($result))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
					if($i%2)
					echo   "<tr class='clsname'>";
					else
					echo   "<tr>";
					
				$color_name=mysql_fetch_array(mysql_query("SELECT color_name FROM `house_m_color` WHERE `id`='$row[id]'"));
			 ?>
	         
		 	
	        <td align='center' ><a href="javascript:OpenWind2('house_m_update.php?id=<?=$row[id]?>')"><?=$sno?></a></td>
			<td align='center' ><?=$row[name]?></td>
			<td align='center' ><?=$row[description]?></td>
			<td align='center' ><?=$color_name[0]?></td>
			
			 
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	   }

 ?>
 </table>

 </body>
 </html>