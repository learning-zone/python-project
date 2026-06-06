<?php
session_start();
include("db.php");
$per00=$_SESSION['per00'];

$user=$_SESSION['user'];

$_DATABASE_=$_SESSION['_DATABASE_'];
$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
$PHP_SELF=$_SERVER['PHP_SELF'];

$LinkName=$_GET['LinkName'];

/*print_r($_GET);
echo "<br>";
print_r($_POST);*/

//echo "LINK NAME :".$LinkName;

?>
<html>
<head>
<script language='javascript'>
function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function openWindow(url)
{
	myWin = window.open(url,"nCt", "left=850,top=10,width=500,height=300,status=no,toolbar=no,menubar=no,scrollbars=no");
}
function closeIt()
{
	if (!myWin.closed)
	myWin.self.close()
}
</script>
<script>
function CallAjax(str)
{
	location.href="?LinkName="+str;
}
</script>
</head>
<body class="samplebody">
<?php
if($per00==1)
{
	if($user=='' || $module=='')
	{
		header("Location:../index.php");
	}
	else
	{
		$date = getdate();
		$qry="select linkname from links where linkpath='$PHP_SELF'";
		$temprs = execute($qry);
		if(rowcount($temprs)==0)
		{
			$ln="Home";
		}
		else
		{
			$temprow = fetcharray($temprs);
			$ln = $temprow[0];
		}
		$today = getdate();
		$month = $today['mon'];
		$day = $today['mday'];
		$year = $today['year'];
		$ndate= date(" d-m-Y",mktime(0,0,0,$month,$day-7,$year));
		$last_date=explode('-',$ndate);
		$day=trim($last_date[0]);
		$month=trim($last_date[1]);
		$year=trim($last_date[2]);
		$qry="insert into log (username,address,accessdate,urladdress,linkname,trans_date) ";
		$qry.=" values('$user','$REMOTE_ADDR','$date[year]-$date[mon]-$date[mday] $date[hours]:$date[minutes]:$date[seconds]',";
		$qry.=" '$PHP_SELF','$ln','$date[year]-$date[mon]-$date[mday]')";
		execute($qry) or die(mysql_error()."error1");
		$qry = "select * from usermenu where username = '$user' and module='$module'  order by id";
		$rs = execute($qry);
		
		if(rowcount($rs) == 0) /*User Menu Not Found */
		{
			echo "No rights..";
		}
		else
		{
			if($module=='Main')
			{
				$qry = "select access  from usermenu where username='$user' and module='$module' ";
			}
			else
			{
				$qry = "select access from usermenu where username='$user' and linkpath='$PHP_SELF' ";
			}
			$rs1 = execute($qry);
			$row1 = fetcharray($rs1);
			if($row1[access] == 'No' && $module!='Main')
			{
				if($module!='Main')
				{
					echo "No Rights";
				}
			}
			else /*If access is there Display the Full Menu for the User */
			{
				if($module!='Main')
				{
					$diname=fetchrow(execute("select Display_name from links where linkname='$module' and module='Main'"));
                
					echo "<table width='100%' cellpadding='0' cellspacing='0'>";
					echo "<tr height='24'>";
					echo "<td class='head' align='center' colspan='2' nowrap>"; 
					echo "<font size='3'>$diname[0]</font>"; //MENU DISPLAY
					echo "</td>";
					echo "</tr>";
				}
				else
				{
					echo "<center><table WIDTH='100%'>";
				}
				/* Show the Sub Modules in the Given Module */
				$qry = "select * from submodules where module='$module' order by id";
				$rs2 = execute($qry);
				if(rowcount($rs2) == 0)
				{
					echo "No access for Sub Module";
				}
				else
				{
					while($row2 = fetcharray($rs2))
					{
						$showhdr = 0;
			
			if($module!='Main')
			{
				$qry = "select * from usermenu  where username='$user' and module='$module' and submodule='$row2[submodule]' and access='Yes' order by id";
			}
			else
			{
				$qry = "select * from usermenu a,modules b where a.username='$user' and a.module='$module' and a.submodule='$row2[submodule]' and a.access='Yes' and a.linkname=b.module order by b.id";

			}
			$rs3 = execute($qry);
						while($row3 = fetcharray($rs3))
						{
							if($showhdr==0)
							{
								if($module!='Main')
								{
									echo "<tr height='24'>";
									echo "<td class='cat123' valign='center' colspan='2' nowrap><DIV>&nbsp;$row2[submodule]</div></td>";
									echo "</tr>";
									$showhdr=1;
								}
							}
							if($module=='Main')
							{
									
								$diname=fetchrow(execute("select Display_name from links where linkname='$row3[linkname]'"));
							
								
								echo "<tr height='24'>";
								echo "<td VALIGN=center WIDTH='100%' class='head' nowrap><div>&nbsp;";?><?php echo "
								<a href=$row3[linkpath]$row3[parameter] title='$row3[linkname]' target='contents' class='topictitle1'>
								<font color='#000000'>$diname[0]</font></a>&nbsp;&nbsp;</div></td>";
								echo "</tr>";
							}
							else
							{
								
								echo "<tr height='24'>";
								$diname=fetchrow(execute("select Display_name from links where id='$row3[id]'"));
								$Display_name=$diname[0];
								
								if($row3[id]==$LinkName){
								?>
								<td class="active" colspan="2">&nbsp;
								<a href="../test.php?linkpath=<?=$row3[linkpath]?><?=$row3[parameter]?>&linkname=<?=$row3[linkname]?>&Display_name=<?=$Display_name?>&linkID=<?=$row3[id]?>" title='<?=$row3[linkname]?>' class='topictitle' onClick="CallAjax('<?=$row3[id]?>')"><?=$diname[0]?></a></td>
								<?php
								}else{
									?>
                                <td class="submenu" colspan="2">&nbsp;
								<a href="../test.php?linkpath=<?=$row3[linkpath]?><?=$row3[parameter]?>&linkname=<?=$row3[linkname]?>&Display_name=<?=$Display_name?>&linkID=<?=$row3[id]?>" title='<?=$row3[linkname]?>' class='topictitle' onClick="CallAjax('<?=$row3[id]?>')"><?=$diname[0]?></a></td>
                                    <?
								}
								echo "</tr>";
							}
						}
					}
				}
			}
			if($module!='Main')
			{
				echo "</table>";
			}
			else
			{
				echo "</table></center>";
				echo "</td>";
				echo " </tr>";
				echo " </table>";
				echo " <div align='center'>";
				echo " <hr align='center' width='65%'>";
				echo " <h6 align='center'></h6>";
				echo " </div>";
			}
		}		
	}	
}
?>