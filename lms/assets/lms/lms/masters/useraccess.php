<?php 
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/


$username=$_POST['username'];
$modulename=$_POST['modulename'];
$submodulename=$_POST['submodulename'];

?>
<html>
<head>
<script language="javascript">
function reload()
{
	document.tempfrm.action="useraccess.php";
	document.tempfrm.submit();
}
</script>
</head>
<title>USER RIGHTS</title>
<body class='bodyline' >
<?php
if($_POST['grant1'])
{

	$qry="select * from links where module='$modulename' and submodule='$submodulename'";

	$rs = execute($qry);

	while($row=fetcharray($rs))
	{

		$tid=$row[id];

		$temp = $_POST['rightsE'.$tid];

		if($temp == 'on')
		{
			$acc = 'E';
		}
		else
		{
			$acc = 'V';
		}
		$qry = "select * from usermenu where username='$username' and id=$row[id]";
		$rs1 = execute($qry);
		$num = rowcount($rs1);	

	if($num>0)
	{
			if($acc == 'E')
			{
				$qry1="update usermenu set rights='$acc' WHERE username='$username' AND id=$row[id]";	
				//echo "<br>".$qry1;
				$rss = execute($qry1);
	
			  }
			  else
			  {
				  $qry1="update usermenu set rights='$acc' WHERE username='$username' AND id=$row[id]";	
				  //echo "<br>".$qry1;
				  $rss = execute($qry1);
			  }

      }
}
  echo "Updated Successfully";

}
?>

<form action="useraccess.php" method='post' name='tempfrm'>

<table align=center class='forumline' width = '40%'>

<tr><td class='head' align='center' colspan=2>User Rights</td></tr>

<tr>

<td align='left' >&nbsp;&nbsp;User Name</td>

<TD WIDTH=45% ALIGN=LEFT>
<?
		$query = "SELECT username FROM users WHERE Activated='On'  ORDER BY username";

		$rs = execute($query) or die("QUERY $query " . error_description());
		?>
        <select name='username' onChange='reload1()'>
	   <OPTION VALUE='0'>------------ Select ------------</OPTION>
	  <?
	   while($trow=fetcharray($rs))
	   {
			 if($username==$trow[username])
			 {
	
				 echo "<option value='$trow[username]' selected>$trow[username]</option>";
	
			 }
			 else
			 {
				 echo "<option value='$trow[username]'>$trow[username]</option>";
			 }
		}
?>
	</select></TD>

<tr>
    <td align='LEFT'>&nbsp;&nbsp;Select Module</td><td>
    <?
    $qry="SELECT * FROM modules ORDER BY module";
    ?>
    <select name="modulename" onChange="reload()">
    <option value=''>------------ Select ------------</option>
		<?
        $rs = execute($qry);
        while($row=fetcharray($rs))
        {
        
            $sqlst="select Display_name FROM links WHERE linkname='".$row['module']."' AND module='Main'";
        
            $diname=fetchrow(execute($sqlst));
        
            if($diname[0]=='')
        
            $diname[0]='Main';
        
            if($modulename==$row[module])
            {
                echo "<option value='$row[module]' selected>$diname[0]</option>";
            }
            else
            {
                echo "<option value='$row[module]'>$diname[0]</option>";
            }
        }
        ?>	
    
    </select></td>
</tr>

<tr>
	<td align='LEFT'>&nbsp;&nbsp;Select Sub Module</td>
	<td><select name="submodulename" onChange="reload()">
	    <option value=''>------------ Select ------------</option>
        <?

			$qry="SELECT * FROM submodules WHERE module='$modulename' ORDER BY submodule";
			
			$rs = execute($qry);

			while($row=fetcharray($rs))
			{
				if($submodulename==$row[submodule])
				{
					echo "<option value='$row[submodule]' selected>$row[submodule]</option>";
				}
				else
				{
					echo "<option value='$row[submodule]'>$row[submodule]</option>";
				}
			}
		?>
		</select></td></tr>

<tr><td colspan=2>

</table>

<br>

<table align=center class='forumline'  width = '40%'>
<tr>
	<td align='center' class="head" colspan="4">ASSIGN RIGHTS</td>
</tr>
 <tr>
		<td nowrap class='rowpic'>Sub Menu Items</td>
		<td nowrap class='rowpic'>Edit</td>
        <td nowrap class='rowpic'>View</td>
 </tr>
<?PHP

$qry="SELECT * FROM links WHERE module='$modulename' and submodule='$submodulename' ";

$rs = execute($qry);

$x=0;

while($row=fetcharray($rs))
{

	if($x%2)
		echo "<tr>";
	else
		echo "<tr class='clsname'>";

	$x = $x + 1;


	$sqlst="SELECT Display_name FROM links WHERE linkname='".$row[2]."' AND module='$modulename'";

		$diname=fetchrow(execute($sqlst));
?>
    
	<td nowrap>&nbsp;&nbsp;<?=$diname[0]?></td>
	<td nowrap>
	 <?
        $qryE="SELECT `id`, `rights` FROM usermenu WHERE username='$username' AND id='$row[id]'";
        $rsE = execute($qryE);
    
        $check_boxE="";
    
        if(rowcount($rsE) > 0)
        {
            $rowE = fetcharray($rsE);
            if($rowE[rights]=='E')
                $check_boxE="checked";			
        }

       ?>

	<input type="checkbox" name="rightsE<?=$rowE[id]?>" <?=$check_boxE?>>
	</td>
    	<td nowrap>
		 <?
            $qryV="SELECT `id`, `rights` FROM usermenu WHERE username='$username' AND id=$row[id]";
            $rsV = execute($qryV);
        
            $check_boxV="";
        
            if(rowcount($rsV) > 0)
            {
                $rowV = fetcharray($rsV);
                if($rowV[rights]=='V' or $rowV[rights]=='E')
                    $check_boxV="checked";
            }
           ?>
	<input type="checkbox" name="rightsV<?=$rowV[id]?>" <?=$check_boxV?>>
	</td>
</tr>
<?
}
?>
</table>
</td></tr>
<br>
<div align=center><input type='submit' name='grant1' value='Update' class='bgbutton'></div>
</form>
</body>
</html>