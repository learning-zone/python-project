<?php

$msg=$_REQUEST['msg'];

if($_GET['msg']!='')

{

	?>

    <script language="javascript">

	alert("<?=$msg?>");

    </script>

    <?php

}

?>
<?php
session_start();

require("../db.php");



	  	$rs123=execute("select id from trans_drop_time");

	 	while($r=fetcharray($rs123))

	 	{

			$sql_alter="alter table  trans_point_details add column drop_time".$r[0]." varchar(20)";

			execute($sql_alter);

			

	 	}


if($_POST)



{



	$route =$_POST['route'];

	$route1 =$_POST['route1'];



	$point = $_POST['point'];



	$p_time = $_POST['p_time'];



    $d_time = $_POST['d_time'];

	

	$drop_time = $_POST['drop_time'];



	$adddet = $_POST['adddet'];



	$moddet = $_POST['moddet'];



	$id = $_POST['id'];



}







if($_REQUEST)



{



	$act = $_REQUEST['act'];



}

?>
<HTML>
<HEAD>
<script language='javascript'>



function Delete_onclick()

{

	//alert('hello');

	var answer = confirm("Are you sure to delete record ???")

	if (answer)

	{

		<?

		while(list(,$value) = each($mid))

	{

	   //echo "hi";

		echo $sql = "UPDATE `trans_point_details` SET `status`=0 WHERE `id`='$value'";

		//echo "<br>".$sql;

		$result=execute($sql) or die(mysql_error());			

	}

	

	

	?>

		document.frm.submit();

	}



}

 

function deldata()

{

	document.form1.action="alterpoint.php?Types=Del";

	document.form1.submit();

}

function Modify_onclick()

{

	

	document.frm.action="pointDetails_edt.php?Type=Mod";

	document.frm.submit();

	return true;

}

function OpenWind2(k2)



{



	var finalVar ;



	finalVar=k2 ;



	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');



}



function reload()



{



	document.frm.action='point_details.php';



	document.frm.submit();



}







function redirect()



{



	document.frm.action='point_details.php';



	document.frm.submit();



}



</script>



</HEAD>



<BODY>



<form method="post" name="frm" action="point_details.php">



<?php



if($adddet)

{



	$sql=execute("select * from trans_point_details where route_id=$route and point_id=$point and status=1");

	if(rowcount($sql)>=1)

	{



		?>



            <script type="text/javascript">



			alert("Already applied..!!")



			</script>



            <?



		//echo "Already applied..!!";



	}

	else

	{

		//print_r($_POST);

		$sql1=execute("insert into trans_point_details(route_id,point_id,pick_t,status) values($route,$point,'$p_time',1)");

		$maxid=fetchrow(execute("select max(id) from trans_point_details where route_id='$route' and point_id='$point' and pick_t='$p_time'"));	

	  	$rs123=execute("select id from trans_drop_time");

	 	while($r=fetcharray($rs123))

	 	{

			$id=$r[0];

			$pontval=$_POST['drop_time'.$id];

			//echo "update trans_point_details set drop_time$r[0]='$pontval' where id='$maxid[0]'";

$sql_upd=execute("update trans_point_details set drop_time$r[0]='$pontval' where id='$maxid[0]'"); 

		}





		?>



            <script type="text/javascript">



			alert("Details inserted...!!")



			</script>



            <?




	}



}

?>

<Table class='forumline' align='center' width='80%'>

<TR><TD class='head' colspan='9' align='center'>Apply  Route Pickup Points</td></tr>

<tr><td class="rowpic" align='center'>Select Route</td>

	<td class='rowpic' align='center'>Select Pickup Point</td>
	<td class='rowpic' align='center'>PickUp Time</td>

   <?php

	 	$sql2="select * from trans_drop_time";

	 	$rs2=execute($sql2);

	 	for($i=0;$i<rowcount($rs2);$i++)

	 	{

	 		$r2=fetchrow($rs2);

	  		if($drop_time==$r2[0])

	 		{

				?>

	 			<td align='center' class='rowpic'><?php echo $r2[1]?></td>

				<?php

	 		}

	 		else

	 		{

				?>

	 			<td align='center' class='rowpic'><?php echo $r2[1]?></td>

				<?php

	 		}

			

	 	}

	 ?>
</td>
</tr>
<tr>

	<td align='center'><select name="route">



	<option value="">---- Select ----</option>



	<?php



	$sql="select * from trans_route_master order by route_code";



	$rs=execute($sql);



	for($i=0;$i<rowcount($rs);$i++)

	{



		$r=fetcharray($rs);



		echo "<option value=$r[id] > $r[route_code] - $r[route_name]</option>";



	}



	?>



	</select>



	</td>



	<td align='center'><select name="point">



	<option value='0'>---- Select ----</option>



	<?php



		$sql3="select * from trans_point_master order by point_name";



		$rs3=execute($sql3);



		for($i=0;$i<rowcount($rs3);$i++)



		{



			$r3=fetcharray($rs3);



			echo "<option value=$r3[id]>  $r3[point_name]</option>";



		}



	?>



	</select></td>



	<td align='center'><input type='text' size='7' name='p_time' value=''></td>

     <?php

	 	$sql2="select * from trans_drop_time";

	 	$rs2=execute($sql2);

	 	for($i=0;$i<rowcount($rs2);$i++)

	 	{

			$r321=fetcharray($rs2);

			

	 		?>

	 			<td align='center'>

                <input type='text' size='7' name='drop_time<?=$r321[id]?>' value=''></td>

				<?php

	 		}

	 ?>

</tr>



<tr>



</table>



<br>



	<div align='center'>



    <input type="submit" class='bgbutton' value="ADD" name="adddet">



	</div>

</form>



<?php

$sql = "SELECT * FROM trans_point_details order by id";

$rs = execute($sql);



$num = rowcount($rs);

if($num)

{



?>



  <form method="post" name="form1">



  <Table class='forumline' align=center width='80%'>



  <tr>

  <td class="head" colspan=9 align='center'>Modify Point Details </td>

  </tr>



  <tr><td class="rowpic">Select</td><td class="rowpic" align='center'>Route</td><td class="rowpic" align='center'>Pickup Point</td>

  <td class="rowpic" align='center'>Pickup Time</td>

    <?php

	 	$sql2="select * from trans_drop_time";

	 	$rs2=execute($sql2);

	 	for($i=0;$i<rowcount($rs2);$i++)

	 	{

	 		$r2=fetchrow($rs2);

	  		if($drop_time==$r2[0])

	 		{

				?>

	 			<td align='center' class='rowpic'><?php echo $r2[1]?></td>

				<?php

	 		}

	 		else

	 		{

				?>

	 			<td align='center' class='rowpic'><?php echo $r2[1]?></td>

				<?php

	 		}

			

	 	}

	 ?>

      

<?php


$fetch_qry=execute("select * from trans_point_details where status='1'");





while($frt=fetcharray($fetch_qry))

{

	?>

    <tr>

	 <?

				

				

				$ss=fetcharray(execute("select id from trans_point_master where id='$frt[point_id]'"));

				$pickpoint1=$ss[0];

				$ss1=fetcharray(execute("select drop_time from trans_drop_time where id='$frt[drop_time]'"));

				$routtid=fetchrow(execute("select id from trans_route_master where id='$frt[route_id]'"));

				$route1=$routtid[0];

			?>

            <td align="center"><input type="checkbox" name="mid[]" Value="<?=$frt[0]?>">

            <td align="center">

          <select name="route1">



	<option value="-1">---- Select ----</option>
	<?php
        
        $rs=execute("select * from trans_route_master order by route_code");
        
        while($r=fetcharray($rs))
        
        {
        
			if($route1==$r[id])
			
			{
			
				echo "<option value='$r[id]' selected>$r[route_name]</option>";
			
			}
			
			else
			
			{
			
				echo "<option value='$r[id]'>$r[route_name]</option>";
			
			}
        
        }
        
        ?>



	</select>

</td>

			<td align="center">

           <select name="pickpoint1">



	<option value="-1">---- Select ----</option>



	<?php

$rs1=execute("select * from trans_point_master order by point_name");

while($r1=fetcharray($rs1))

{

if($pickpoint1==$r1[id])

{

echo "<option value='$r1[id]' selected>$r1[point_name]</option>";

}

else

{

echo "<option value='$r1[id]'>$r1[point_name]</option>";

}

}

?>



	</select></td>

            <td><input type="text" size=10 name="picktime1<?=$frt[0]?>" value="<?=$frt[3]?>"></td>

             

   <?

		       $check=execute("select id from trans_drop_time");

			   $n=rowcount($check);

			   

			

			   for($i=1;$i<=$n;++$i)

			   {

				   $field="drop_time$i";

				   

					   ?>

					  <td><input type="text" size=10 name="droptime1<?=$frt[0]?>" value="<?=$frt[$field]?>"></td>

                      <?php

				   }

				   ?>

    </tr>

    <?

	

}

?>

</table><br>



  <br>

 <div align="center"><input Type="Button" class=bgbutton Value="Delete" onClick="deldata()"></div>

  </form>

  <?

}

?>

</body>
</html>