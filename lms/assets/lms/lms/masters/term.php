<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$msg=$_REQUEST['msg'];
if($_POST)
{
	
   $id=$_POST['id'];
   $term=$_POST['term'];
   $a_year=$_POST['a_year'];
   $end_date=$_POST['end_date'];
   $start_date=$_POST['start_date'];

}
if($_GET)
{
   $a_year=$_REQUEST['a_year'];
}

if($msg)
{
?>
    <script language="javascript">
	alert("<?=$msg?>");
    </script>
<?php
}
?>
<html>
<head>
<script language="javascript">
  function reloadMe()
  {
	  document.frm.action="term.php";
	  document.frm.submit();  
  }
  function adds_onclick()
  {
	  document.frm.action="term_edt.php?Type=Add";
	  document.frm.submit();
	  
  }
  function Modify_onclick()
  {
	  
	  document.frm.action="term_edt.php?Type=Mod";
	  document.frm.submit();
	  
  }
  function Delete_onclick()
  {
	  
	  var answer = confirm("Are you sure to delete record ?")
	  if (answer)
	  {
		  document.frm.action="term_edt.php?Type=Del";
		  document.frm.submit();
	  }
	  
  }
</script>
<script language="javascript">
  function selectMe()
  {
	  var i = document.frm.length;
	  for(j=0;j<i;j++)
	  {
		  if(document.frm[j].Sel != "CheckBox")
		  {
			  flag = document.frm[j].checked;
			  document.frm[j].checked = !flag;
		  }
	  }
  }
</script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<title>ADD TERM AND YEAR</title>
</head>
<body>

<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<br/>
	<table align='center' class="forumline" width='90%' >
			<tr height="25">
				<td Class='head' align="center" colspan="5">ADD TERM</td>
			</tr>
			<tr height="25">
            	<td Class='row3'>Term Name</td>
				<td Class='row3'>Academic Year </td>
                <td Class='row3'>Start Date</td>
                <td Class='row3'>End Date</td>
			</tr>
			<tr height="25">
                <td align="center"><INPUT TYPE="text"  NAME="term" value="<?=$term?>" size="20"></td>
				<td align="center"><select name="a_year" onchange='reloadMe()' >
                <option value='0'>-- Academic Year --</option>
                <?php
				   $MyYear=date('Y')-5;
				   $CurrentYr=date("Y")+5;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					{
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}
						?>
						<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php

					 }
				 ?>
              </select> 
			   </td>
                <td align="center">
                 <select name="f_day" onchange='reload()'>
				 <?php
                    for($i=1;$i<=31;$i++)
                    {
                        if($i<10)
                            $i="0".$i;
                        $sel='';
                        if($f_day==$i)
                            $sel='selected'; 
                        echo "<option value='$i' $sel >$i</option>";
                    }
                    ?>
    			</select>
    			<select name="f_month" onchange='reload()'>
      		  <?php
				for($i=1;$i<=12;$i++)
				{
					if($i<10)
						$i="0".$i;
					$sel='';
					if($f_month==$i)
						$sel='selected';
					echo "<option value='$i' $sel >$i</option>";
				} 
				?>
   			 </select>
   			 <select name="f_year" id="f_year" onchange='reload()'>
      		<?php

				$d=date('Y')-4;

				$dd=date('Y')+3;

				for($i=$d;$i<=$dd;$i++)

                    {

	                  $sel='';

	                  if($f_year==$i)

						$sel='selected';

	                  echo "<option value=$i $sel >$i</option>";

                    }

				?>
 		   </select>
              </td>
       <td align="center">
         <select name="t_day" onchange='reload()'>
     	 <?php

				for($i=1;$i<=31;$i++)

				{

	                if($i<10)

						$i="0".$i;

					$sel='';

					if($t_day==$i)

						$sel='selected'; 

					echo "<option value='$i' $sel >$i</option>";

			    }

				?>

    </select>
    <select name="t_month" onchange='reload()'>
      <?php

				for($i=1;$i<=12;$i++)

				{

					if($i<10)

						$i="0".$i;

					$sel='';

					if($t_month==$i)

						$sel='selected';

					echo "<option value='$i' $sel >$i</option>";

				}

				?>

    </select>
    <select name="t_year" onchange='reload()'>
      <?php

				$d=date('Y')-1;

				$dd=date('Y')+3;

				for($i=$d;$i<=$dd;$i++)

                    {

	                  $sel='';

	                  if($t_year==$i)

						$sel='selected';

	                  echo "<option value=$i $sel >$i</option>";

                    }

				?>

    </select>
         </td>
	</tr>
</table>      
   <p align="center"><input type="button"  value="Add" LANGUAGE=javascript onClick="adds_onclick()" class='bgbutton'></p>
<?php
		
	   $result=execute("SELECT * FROM `academic_term` WHERE `status`= 1 AND `a_year` = '$a_year' ORDER BY id");

	   if(rowcount($result)>0)
       {
	   ?>
	   
	  <table class='forumline' align='center' width='90%'>
		<tr height='22' >
		  <!--  <td Class="head" align='center' title="Click to select all" width="70px">Select All</td>-->
            <td width="7%" align="center" class="head" nowrap><div class="head" id="checkAll" 
	onClick="selectMe()" Title="Click to select all" >All</div></font></td>
    
			<td Class="head" align='center'>Terms Name</td>
			<td Class="head" align='center'>Academic Year</td>
			<td Class="head" align='center'>Start Date</td>
            <td Class="head" align='center'>End Date</td>
			
	   </tr>
       <?
	   	    $i=0;
            $rowclass=1;
            $sno=1; 
           while($row=fetcharray($result))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
				
					echo   "<tr>";
					//echo "id ".$row[id];
				  	$newd=$row['start_date'];
			    	$dateArray=explode('-',$newd);
					$f_day=$dateArray[2];
					$f_month=$dateArray[1];
					$f_year=$dateArray[0];
					
					$newd1=$row['end_date'];
			    	$dateArray1=explode('-',$newd1);
					$t_day=$dateArray1[2];
					$t_month=$dateArray1[1];
					$t_year=$dateArray1[0];	
					
			 ?>
	         
            <td class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$row[id]?>" size="10"></td>
			<td class="CBody" align='center' ><Input Type="Text" Name="<?=$row[id]?>term" value="<?=$row[term]?>" size=20></td>
            <td class="CBody" align='center' ><select name="<?=$row[id]?>a_year" onchange='reload()'>
               <option value='0'>-- Academic Year --</option>
                <?php
					$a_year=$row['a_year'];
				   $MyYear=date('Y')-5;
				   $CurrentYr=date("Y")+5;
				   for($i=$MyYear;$i<$CurrentYr;$i++)
					{
						$Fyear=$i;
						$Tyear=$i+1;
						$Tyear=substr($Tyear,2);
						$sele="";
						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}
						?>
						<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php

					 }
				 ?>
              </select> </td>
        <td class="CBody" align='center' ><select name="<?=$row[id]?>f_day" onchange='reload()'>
				 <?php
                    for($i=1;$i<=31;$i++)
                    {
                        if($i<10)
                            $i="0".$i;
                        $sel='';
                        if($f_day==$i)
                            $sel='selected'; 
                        echo "<option value='$i' $sel >$i</option>";
                    }
                    ?>
    			</select>
    			<select name="<?=$row[id]?>f_month" onchange='reload()'>
      		  <?php
				for($i=1;$i<=12;$i++)
				{
					if($i<10)
						$i="0".$i;
					$sel='';
					if($f_month==$i)
						$sel='selected';
					echo "<option value='$i' $sel >$i</option>";
				} 
				?>
   			 </select>
   			 <select name="<?=$row[id]?>f_year" onchange='reload()'>
      		<?php

				$d=date('Y')-4;

				$dd=date('Y')+3;

				for($i=$d;$i<=$dd;$i++)

                    {

	                  $sel='';

	                  if($f_year==$i)

						$sel='selected';

	                  echo "<option value=$i $sel >$i</option>";

                    }

				?>
 		   </select></td>
        <td class="CBody" align='center' ><select name="<?=$row[id]?>t_day" onchange='reload()'>
     	 <?php

				for($i=1;$i<=31;$i++)
				{
	                if($i<10)
						$i="0".$i;
					$sel='';

					if($t_day==$i)

						$sel='selected'; 

					echo "<option value='$i' $sel >$i</option>";

			    }

				?>

    </select>
    <select name="<?=$row[id]?>t_month" onchange='reload()'>
      <?php

				for($i=1;$i<=12;$i++)
				{
					if($i<10)
						$i="0".$i;
					$sel='';

					if($t_month==$i)

						$sel='selected';

					echo "<option value='$i' $sel >$i</option>";

				}

				?>

    </select>
    <select name="<?=$row[id]?>t_year" onchange='reload()'>
      <?php

				$d=date('Y')-1;
				$dd=date('Y')+3;

				for($i=$d;$i<=$dd;$i++)
                {
	                 $sel='';
	                  if($t_year==$i)
						$sel='selected';

	                  echo "<option value=$i $sel >$i</option>";

                  }

				?>
   			 </select></td>
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
	 

 ?>
 </table>
 	<p align="center">
		<Input type="submit" Name="Modify" value="Modify" LANGUAGE=javascript onClick="return Modify_onclick()" class='bgbutton'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Input type="submit" Name="Delete" value="Delete" LANGUAGE=javascript onClick="return Delete_onclick()" class='bgbutton'> </p>
   <?
    }
?>
</form>

 </body>
 </html>
