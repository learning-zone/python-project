<?php
session_start();
require_once("../db.php");

if($_POST)
{
	$dd=$_POST['dd'];
	$mm=$_POST['mm'];
	$yy=$_POST['yy'];
	$act=$_POST['act'];
	$issn=$_POST['issn'];
	$year=$_POST['year'];
	$rack=$_POST['rack'];
	$jmsub=$_POST['jmsub'];
	$month=$_POST['month'];
	$idttl=$_POST['idttl'];
	$issue=$_POST['issue'];
	$price=$_POST['price'];
	$volume=$_POST['volume'];
	$l_name=$_POST['l_name'];
	$r_name=$_POST['r_name'];
	$source=$_POST['source'];
	$library=$_POST['library'];
	$remarks=$_POST['remarks'];
	$keywords=$_POST['keywords'];
	$register1=$_POST['register1'];
	$articles1=$_POST['articles1'];
	$articles2=$_POST['articles2'];
	$no_of_pages=$_POST['no_of_pages'];
	$magazine_no=$_POST['magazine_no'];
	$magazine_sub_no=$_POST['magazine_sub_no'];
	$du_dd=$_POST['du_dd'];
	$du_dd=$_POST['du_dd'];
	$du_mm=$_POST['du_mm'];
	$du_yy=$_POST['du_yy'];
	$su_dd=$_POST['su_dd'];
	$su_mm=$_POST['su_mm'];
	$su_yy=$_POST['su_yy'];
}
if($_GET)
{

	$act=$_GET['act'];
	$msg=$_GET['msg'];
	$idttl=$_GET['idttl'];
	$jmsub=$_GET['jmsub'];
    $register1=$_GET['register1'];
}

if($msg!='')
{
	?>
    	<script language="JavaScript">
		    alert('<?=$msg?>');
		</script>
    <?
}
?>
<html>
<head>
<Script language="JavaScript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;

function addnew()
{
	document.frm.action="new_magazines1.php?jmsub=$jmsub&actn=1";
	document.frm.submit();
}
function modnew()
{
	document.frm.action="new_magazines1.php?jmsub=$jmsub&actn=2";
	document.frm.submit();
}
function delnew()
{
	document.frm.action="new_magazines1.php?jmsub=$jmsub&actn=3";
	document.frm.submit();
}
function frmsubmit()
{
	document.frm.submit();
}
</script>
</head>
<body>
<?php
if($jmsub==1)
{
	$sel1="selected";
	$sel2="";
}
elseif($jmsub==2)
{
	$sel1="";
	$sel2="selected";
}
if($act==1)
{
	$sel3="selected";
	$sel4="";
}
elseif($act==2)
{
	$sel3="";
	$sel4="selected";
}
?>
<form method="POST" name="frm" action="new_magazines.php">
<table class='forumline' align='center' width="47%" border="1">
  <tr>
    <br/><td class='head' colspan='2' align='center'>Magazine/Journal Details</td>
  </tr>
  <tr>
    <td align="right">Select Media Type&nbsp;&nbsp;&nbsp;</td>
    <td><select name='jmsub' onchange='frmsubmit()'>
	<option value='0'>--Select Media Type--</option>
	<option value='1' <?php echo $sel1 ?>>Journals Subscription</option>
	<option value='2' <?php echo $sel2 ?>>Magazine Subscription</option>
	</select></td>
  </tr>
  <tr> 
    <td align="right">Select Action&nbsp;&nbsp;&nbsp;</td>
    <td><select name='act' onchange='frmsubmit()'>
	<option value='0'>--Select Action Type--&nbsp;&nbsp;&nbsp;</option>
	<option value='1' <?php echo $sel3 ?>>Add</option>
	<option value='2' <?php echo $sel4 ?>>Modify/Inactive</option>
	</select></td>
  </tr>
</table>
<br>
<?php
if($act==1)
{
	if($jmsub==1)
	{
		$ttle='Add Journal Details';
	}
	elseif($jmsub==2)
	{
		$ttle='Add Magazine Details';
	}
?>
<table border='0' align='center'class='forumline' width="80%">
	<tr>
	  <td class='head' colspan='4' align='center'><?php echo $ttle?></td>
    </tr>
	<tr>
		<td align="right" nowrap>Magazine/Journal Subsciption No.&nbsp;&nbsp;</td>
		<td>	
		<select name="magazine_sub_no" onchange='frmsubmit()'>
		
		<option value='0'>Select Subscription No</option>
		
		<?php
		
		$rsql23=execute("select distinct(title),id from lib_magazine_subscription where title!='' and ssp_type='$jmsub' and stts=1") or die(mysql_error());
		$ddd=rowcount($rsql23);
		
		for($fd=0;$fd< $ddd;$fd++)
			{
				$rrs3=fetcharray($rsql23,$fd);
				$sel="";
				if($rrs3[id]==$magazine_sub_no)
				{
					$sel="selected";
				}
		?>
		
		<option value="<?php echo $rrs3[id]?>"<?php echo $sel?>><?php echo $rrs3[id]."-".$rrs3[title]?></option>
	
		<?php
			}
		?>
		</select></td>
		<?php
		if($magazine_sub_no<>'')
			{
			    $rsql24=execute("select * from lib_magazine_subscription where id='$magazine_sub_no' and ssp_type='$jmsub'");
				if(rowcount($rsql24)>0)
					{		
						$rs1 = fetcharray($rsql24);
						$sql="select max(id) from lib_magazine";
						$rs=execute($sql);
						$newid = fetcharray($rs);
						$magazin=$newid[0]+1;
						if($jmsub==1)
							$magazine_no="J-$magazin";
						else
							$magazine_no="M-$magazin";
						$library=$rs1[library];
						$register1=$rs1[register];
						$lsql=execute("select name from library_name where id='$rs1[library]' ");
						$l_name=fetcharray($lsql);
						$rsql=execute("select register from lib_register where id='$rs1[register]' ");
						$r_name=fetcharray($rsql);
		?>
		<td width="18%">Accession No:</td>
		<td width="21%"><?php echo $magazine_no?>
		<input type="hidden" name="library" value="<?php echo $library?>">
	    <input type="hidden" name="register1" value="<?php echo $register1?>">
      <input type="hidden" name="magazine_no" value="<?php echo $magazine_no?>"></td>
	</tr>
	<tr>
		<td width="120" align="left" height="22">&nbsp;&nbsp;&nbsp;Library</td>
		<td><input type=text name='l_name' value="<?php echo $l_name[name]?>" size='35' readonly></td>
		<td width="120" align="left" height="22">Register</td>
		<td><input type=text name='r_name' value="<?php echo $r_name[register]?>" readonly></td>
	</tr>	

	<tr>
		<td width="18%">&nbsp;&nbsp;&nbsp;Title</td>
		<td width='31%' colspan='3'><input type=text name='title' value="<?php echo $rs1[title]?>" size='30' readonly></td>
	</tr>
	<tr>
		<td width="22%">&nbsp;&nbsp;&nbsp;Source</td>
		<td width="30%">
		<input type="text" name="source" value="<?php echo $rs1[source]?>" readonly></td>
		<td width="2%">Language</td>
		<td width="22%">
		<input type="text" name="language" value="<?php echo $rs1[language]?>" readonly></td>
	</tr>
	<tr>
		<td width="21%">&nbsp;&nbsp;&nbsp;Subject</td>
		<td width="31%"><input type="text" name="subject" value="<?php echo $rs1[subject]?>"></td>
		<td width="17%">Magazine Date</td>
		<td width="22%">
		<?php
		if($dd=="")
			$dd=date("d");
		echo "<select name='dd'>";
		for($i=1;$i<=31;$i++)
		{
			if($i<='9')
			{
				$i='0'.$i;
			}
			if($i==$dd)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i'>$i</option>\n";
		}
		echo "</select>";
		if($mm=="")
			$mm=date("m");
		echo "<select name='mm'>";
		for($i=1;$i<=12;$i++)
		{
			if($i<='9')
			{
				$i='0'.$i;
			}
			if($i==$mm)
				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
			else
				echo "<option value='$i'>" . MonthName($i) . "</option>\n";
		}
		echo "</select>";
		if($yy=="")
			$yy=date("Y");
		$maxYr =$yy+1;
		$st=$yy-4;
		echo "<select name='yy'>";
		for($i=$st;$i<=$maxYr;$i++)
		{
			if($i==$yy)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
		?>
		</td>
	</tr>
	<tr>
		<td width="18%">&nbsp;&nbsp;&nbsp;Month-Year</td>
		<td width="31%">
		<?php
		if($month=="")
			$month=date("m");
		echo "<select name='month'>";
		for($i=1;$i<=12;$i++)
		{
			if($i<='9')
			{
				$i='0'.$i;
			}
			if($i==$month)
				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
			else
				echo "<option value='$i'>" . MonthName($i) . "</option>\n";
		}
		echo "</select>";
		if($year=="")
			$year=date("Y");
		$maxYr =$year+1;
		$st=$year-4;
		echo "<select name='year'>";
		for($i=$st;$i<=$maxYr;$i++)
		{
			if($i==$year)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
		?>
		</td>
		<td width="19%">Issue No.</td>
		<td width="22%">
		<input type="text" name="issue" value="<?php echo $issue?>" size="8" ></td>
	</tr>
    <tr>
	  <td width="17%">&nbsp;&nbsp;&nbsp;Subscription Date</td>
	  <td width="22%">
	<?php
		if($du_dd=="")
			$du_dd=date("d");
	//Day
	echo "<select name='du_dd'>";
	for($i=1;$i<=31;$i++)
	{
		if($i<='9')
		{
			$i='0'.$i;
		}
		if($i==$du_dd)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	if($du_mm=="")
			$du_mm=date("m");
	echo "<select name='du_mm'>";
	for($i=1;$i<=12;$i++)
	{
		if($i<='9')
		{
			$i='0'.$i;
		}
		if($i==$du_mm)
			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	if($du_yy=="")
			$du_yy=date("Y");
	$maxYr =$du_yy+1;
	$st=$du_yy-4;
	echo "<select name='du_yy'>";
	for($i=$st;$i<=$maxYr;$i++)
	{
		if($i==$du_yy)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	</td>

	<td width="17%">Due Date</td>
	<td width="22%">
	<?php
	if($su_dd=="")
			$su_dd=date("d");
	//Day
	echo "<select name='su_dd'>";
	for($i=1;$i<=31;$i++)
	{
		if($i<='9')
		{
			$i='0'.$i;
		}
		if($i==$su_dd)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	if($su_mm=="")
			$su_mm=date("m");
	//Month
	echo "<select name='su_mm'>";
	for($i=1;$i<=12;$i++)
	{
		if($i<='9')
		{
			$i='0'.$i;
		}
		if($i==$su_mm)
			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	//Year
	if($su_yy=="")
			$su_yy=date("Y");
	$maxYr =$su_yy+1;
	$st=$su_yy-4;
	echo "<select name='su_yy'>";
	for($i=$st;$i<=$maxYr;$i++)
	{
		if($i==$su_yy)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	?>
	  </td>
    </tr>
	<tr>
		<td width="21%">&nbsp;&nbsp;&nbsp;ISSN</td>
		<td width="31%">
		<input type="text" name="issn" value="<?php echo $issn?>" size="8" ></td>
		<td width="2%">Volume No.</td>
		<td width="22%">
		<input type="text" name="volume" value="<?php echo $volume?>" size="8"></td>
	</tr>
	<tr>
		<td width="17%">&nbsp;&nbsp;&nbsp;No Of Pages</td>
		<td width="30%">
		<input type="text" name="no_of_pages" value="<?php echo $no_of_pages?>" size="4" ></td>
		<td width="17%">Rack</td>
		<td width="30%"><input type="text" name="rack" value="<?php echo $rack?>"></td>
	</tr>
	<tr>
		<td width="17%">&nbsp;&nbsp;&nbsp;Price</td>
		<td width="22%">
		<input type="text" name="price" value="<?php echo $price?>" ></td>
		<td width="17%">Keywords</td>
		<td width="22%">
		<input type="text" name="keywords" value="<?php echo $keywords?>"></td>
	</tr>	
	<tr>
		<td width="13%">&nbsp;&nbsp;&nbsp;Articles 1</td>
		<td width="21%">
		<input type="text" name="articles1" value="<?php echo $articles1?>" size="20"></td>
		<td width="21%">Articles 2</td>
		<td width="31%">
		<input type="text" name="articles2" value="<?php echo $articles2?>" ></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;Remarks</td>
		<td colspan='3'>
		<textarea name='remarks' rows=3 cols=55><?php echo $remarks?></textarea></td>
	</tr>
	<tr>
		
	</tr>
</table>
<br>
<div align='center'>
		<input type="button" name="add" value=" ADD " onClick="addnew()" class='bgbutton'></div>
<?php
		}
	}
}
if($act==2)
{
	if($jmsub==1)
	{
		$ttle='Modify/Inactive Journal Details';
	}
	elseif($jmsub==2)
	{
		$ttle='Modify/Inactive Magazine Details';
	}
?>
  <table align='center' class='forumline' width="80%">
		<tr>
			<td class='head' colspan='4' align='center'><?php echo $ttle?></td>
		</tr>
		<tr>
			<td colspan='4' align="center">Select ID/Title&nbsp;&nbsp;
			<select name='idttl' onchange='frmsubmit()'>
			<option value=''>---Select--</option>
			<?php
			if($jmsub==1)
				$chset='J';
			else
				$chset='M';
			
			$sql="select id,title from lib_magazine where ssp_type='$jmsub' and stts=1 order by id";
			$rs=execute($sql);
			while($rs1=fetcharray($rs))
				{
					$idttl1=$chset."-".$rs1[id]."-".$rs1[title];
					$newid=$rs1[id];
					if($idttl==$newid)
						{
							echo "<option value=$newid selected>$idttl1</option>";
						}
					else
						{
							echo "<option value=$newid>$idttl1</option>";
						}
				}
			?>
			</select></td>
		</tr>
		<?php
		if($idttl!='')
			{
				$sql1=execute("select * from lib_magazine where ssp_type='$jmsub' and id=$idttl");
				if(rowcount($sql1)>0)
					{
						$rs3=fetcharray($sql1);
						$library=$rs3[library];
						$register1=$rs3[register];
						$lsql=execute("select name from library_name where id='$rs3[library]' ");
						$l_name=fetcharray($lsql);
						$rsql=execute("select register from lib_register where id='$rs3[register]' ");
						$r_name=fetcharray($rsql);
		?>
		<tr>
			<td width="18%">Magazine/journal sub No:</td>
			<td width="21%" colspan="3"> <?php echo $rs3[magazine_sub_no]?>
			<input type="hidden" name="newid" value="<?php echo $rs3[id]?>"></td>
		</tr>	
		<tr>
			<td width="18%">&nbsp;&nbsp;&nbsp;Library</td>
			<td width='31%'><input type=text name='l_name' value="<?php echo $l_name[name]?>" readonly></td>
			<td width="18%">Register</td>
			<td width='31%'><input type=text name='l_name' value="<?php echo $r_name[register]?>" readonly></td>
		</tr>
		<tr>
			<td width="18%">&nbsp;&nbsp;&nbsp;Title</td>
			<td width='31%' colspan=3><input type=text name='title' value="<?php echo $rs3[title]?>" size='30' readonly></td>
		</tr>
		<tr>
			<td width="22%">&nbsp;&nbsp;&nbsp;Source</td>
			<td width="30%">
			<input type="text" name="source" value="<?php echo $rs3[source]?>" readonly></td>
			<td width="2%">Language</td>
			<td width="22%">
			<input type="text" name="language" value="<?php echo $rs3[language]?>" readonly></td>
		</tr>
		<tr>
			<td width="21%">&nbsp;&nbsp;&nbsp;Subject</td>
			<td width="31%"><input type="text" name="subject" value="<?php echo $rs3[subject]?>"></td>
			<td width="17%">Magazine Date</td>
			<td width="22%">
			<?php
			$c_date=explode("-",$rs3[magazine_date]);		
			echo "<select name='dd'>";
			for($i=1;$i<=31;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[2])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			echo "<select name='mm'>";
			for($i=1;$i<=12;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[1])
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
					echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
			echo "</select>";		
			$maxYr =$c_date[0]+2;
			$st=$c_date[0]-4;
			echo "<select name='yy'>";
			for($i=$st;$i<=$maxYr;$i++)
			{
				if($i==$c_date[0])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
			?>
			</td>
		</tr>
		<tr>
			<td width="18%">&nbsp;&nbsp;&nbsp;Month-Year</td>
			<td width="31%">
			<?php
			echo "<select name='month'>";
			for($i=1;$i<=12;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$rs3[month])
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
					echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
			echo "</select>";
			$maxYr =$rs3[year]+2;
			$st=$rs3[year]-4;
			echo "<select name='year'>";
			for($i=$st;$i<=$maxYr;$i++)
			{
				if($i==$rs3[year])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
			?>
			</td>
			<td width="19%">Issue No.</td>
			<td width="22%">
			<input type="text" name="issue" value="<?php echo $rs3[issue]?>" size="8" ></td>
		</tr>
       <tr>
			  <td>&nbsp;&nbsp;&nbsp;Subscription Date</td>
			  <td>
	<?php
	
			$c_date=explode("-",$rs3[subscription_date]);
	
			echo "<select name='du_dd'>";
			for($i=1;$i<=31;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[2])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			//$MyMonth=$c_date[1];
			//Month
			echo "<select name='du_mm'>";
			for($i=1;$i<=12;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[1])
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
					echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
			echo "</select>";
			//Year
			$maxYr =$c_date[0]+2;
			//$MyYear=$c_date[0];
			$st=$c_date[0]-4;
			echo "<select name='du_yy'>";
			for($i=$st;$i<=$maxYr;$i++)
			{
				if($i==$c_date[0])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
	?>
			</td>

			<td width="17%">Due Date</td>
			<td width="22%">
	<?php
	
			$c_date=explode("-",$rs3[due_date]);
			//$MyDay=$c_date["mday"];
			//Day
			echo "<select name='su_dd'>";
			for($i=1;$i<=31;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[2])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			//$MyMonth=$c_date["mon"];
			//Month
			echo "<select name='su_mm'>";
			for($i=1;$i<=12;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$c_date[1])
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
					echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
			echo "</select>";
			//Year
			$maxYr =$c_date[0]+2;
			//$MyYear=$c_date["year"];
			$st=$c_date[0]-4;
			echo "<select name='su_yy'>";
			for($i=$st;$i<=$maxYr;$i++)
			{
				if($i==$c_date[0])
					echo "<option value='$i' selected>$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
	?>
			</td>
	    </tr>
		<tr>
			<td width="17%">&nbsp;&nbsp;&nbsp;No Of Pages</td>
			<td width="30%">
			<input type="text" name="no_of_pages" value="<?php echo $rs3[no_of_pages]?>" size="4" ></td>
			<td width="17%">Rack</td>
			<td width="30%"><input type="text" name="rack" value="<?php echo $rs3[rack]?>"></td>
		</tr>
		<tr>
			<td width="17%">&nbsp;&nbsp;&nbsp;Price</td>
			<td width="22%">
			<input type="text" name="price" value="<?php echo $rs3[amount]?>" ></td>
			<td width="17%">Keywords</td>
			<td width="22%">
			<input type="text" name="keywords" value="<?php echo $rs3[keywords]?>"></td>
		</tr>	
		<tr>
			<td width="13%">&nbsp;&nbsp;&nbsp;Articles 1</td>
			<td width="21%">
			<input type="text" name="articles1" value="<?php echo $rs3[articles1]?>" size="20"></td>
			<td width="21%">Articles 2</td>
			<td width="31%">
			<input type="text" name="articles2" value="<?php echo $rs3[articles2]?>" ></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;Remarks</td>
			<td colspan='3'>
			<textarea name='remarks' rows=3 cols=55><?php echo $rs3[remarks]?></textarea></td>
		</tr>
		<tr>			
		</tr>
	</table>
    <br>
    <p align="center"><input type="button" name="mod" value=" MODIFY " onClick="modnew()" class='bgbutton'>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="del" value=" INACTIVE " onClick="delnew()" class='bgbutton'></p>
<?php
		}
	}
}
function MonthName($mon)
{
	if($mon == 1) return("Jan");
	if($mon == 2) return("Feb");
	if($mon == 3) return("Mar");
	if($mon == 4) return("Apr");
	if($mon == 5) return("May");
	if($mon == 6) return("Jun");
	if($mon == 7) return("Jul");
	if($mon == 8) return("Aug");
	if($mon == 9) return("Sep");
	if($mon == 10) return("Oct");
	if($mon == 11) return("Nov");
	if($mon == 12) return("Dec");
}
?>
</form>
</BODY>
</html>