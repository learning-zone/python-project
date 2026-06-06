<?php
require_once('../db.php');
$staff_category=$_REQUEST['staff_category'];
$staff_id=$_REQUEST['staff_id'];

$staff_category=$_POST['staff_category'];
$contract_num=$_POST['contract_num'];
$contract_prd=$_POST['contract_prd'];
$enum=$_POST['enum'];
$e_name=$_POST['e_name'];
$e_address=$_POST['e_address'];
$FrDay1  = $_POST['FrDay1'];
$FrMon1  = $_POST['FrMon1'];
$FrYear1  = $_POST['FrYear1'];
$LaDay1  = $_POST['LaDay1'];
$LaMon1  = $_POST['LaMon1'];
$LaYear1  = $_POST['LaYear1'];

$flag  = $_POST['flag'];
//print_r($_POST);

if($_POST['jodadd'])
{
	$end_contract=$LaYear1."-".$LaMon1."-".$LaDay1;
	$start_contract=$FrYear1."-".$FrMon1."-".$FrDay1;
	//echo "select staff_id FROM `staff_additional_info_1` where staff_id='$staff_id'";
	$quer3=fetchrow(execute("select staff_id FROM `staff_additional_info_1` where staff_id='$staff_id'"));
	if($quer3[0])
	{
		
		$query=execute("UPDATE `staff_additional_info_1` SET `start_contract`='$start_contract',`end_contract`='$end_contract',`contract_num`='$contract_num',`contract_prd`='$contract_prd' WHERE staff_id='$staff_id'");
	}
	else
	{
	
		$query=execute("INSERT INTO `staff_additional_info_1`(`start_contract`,`end_contract`, `contract_prd`,`contract_num`,`staff_id`) VALUES('$start_contract', '$end_contract', '$contract_prd', '$contract_num','$staff_id')");
		

	}
}

if($_POST['ModifyjobDet'])	{
	while( list(,$Value) = each($cid))	{
		//$CPost = "post" . $Value;
		//$postj = $$CPost;
		$contract_num = $_POST["contract_num" . $Value];

		//$Ccity = "city" . $Value;
		//$cityj = $$Ccity;
		$contract_prd = $_POST["contract_prd" . $Value];

		//$CLaDay = "LaDay" . $Value;
		//$LaDayj = $$CLaDay;
		$LaDayj = $_POST["LaDay1" . $Value];

		//$CLaMon = "LaMon" . $Value;
		//$LaMonj = $$CLaMon;
		$LaMonj = $_POST["LaMon1" . $Value];

		//$CLaYear = "LaYear" . $Value;
		//$LaYearj = $$CLaYear;
		$LaYearj = $_POST["LaYear1" . $Value];

		//$CFrDay = "FrDay" . $Value;
		//$FrDayj = $$CFrDay;
		$FrDayj = $_POST["FrDay1" . $Value];

		//$CFrMon = "FrMon" . $Value;
		//$FrMonj = $$CFrMon;
		$FrMonj = $_POST["FrMon1" . $Value];

		//$CFrYear = "FrYear" . $Value;
		//$FrYearj = $$CFrYear;
		$FrYearj = $_POST["FrYear1" . $Value];

		$end_contract=$LaYearj."-".$LaMonj."-".$LaDayj;
		$start_contract=$FrYearj."-".$FrMonj."-".$FrDayj;
		
		//$Cexp_type="exp_type".$Value;
		//$exp_typej=$$Cexp_type;
	
		
		$sqlstr = "Update staff_additional_info_1 set contract_num='$contract_num',contract_prd='$contract_prd',";
		$sqlstr.="end_contract='$end_contract',start_contract='$start_contract' where staff_id=$Value";
		execute($sqlstr) or die(mysql_error());
		$flag=1;
	}
}
if($_POST['Submit'])
{
//print_r($_POST);
	$e_num=$_POST['e_num'];
	$staff_category=$_POST['staff_category'];
	$e_name=$_POST['e_name'];
	$e_address=$_POST['e_address'];
	$uploadedfile=$_POST['uploadedfile'];
	$staff_category=$_POST['staff_category'];
	$s_staff_id=$_POST['s_staff_id'];
	$s_name=$_POST['s_name'];
	$vendor_name=$_POST['vendor_name'];
	$s_mb=$_POST['s_mb'];
	$s_add=$_POST['s_add'];
	$contract_prd=$_POST['contract_prd'];
	$passport_no=$_POST['passport_no'];
	$country=$_POST['country'];
	$permit_no=$_POST['permit_no'];
	$country1=$_POST['country1'];
	$visa_no=$_POST['visa_no'];
	$place_of_issue=$_POST['place_of_issue'];
	$renewal_time=$_POST['renewal_time'];
	$owner_name=$_POST['owner_name'];
	$contact_no=$_POST['contact_no'];
	$owner_address=$_POST['owner_address'];
	$account_no=$_POST['account_no'];
	$bank_name=$_POST['bank_name'];
	$IFCA_code=$_POST['IFCA_code'];
	$owner_address=$_POST['owner_address'];
	$contract_prd=$_POST['contract_prd'];
	$yrs_of_exp=$_POST['yrs_of_exp'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$date3=$_POST['date3'];
	$date4=$_POST['date4'];
	$date5=$_POST['date5'];
	$date6=$_POST['date6'];
	$date7=$_POST['date7'];
	$date8=$_POST['date8'];
	$date9=$_POST['date9'];
	$date10=$_POST['date10'];
	$date11=$_POST['date11'];
	$date12=$_POST['date12'];
	$date13=$_POST['date13'];
		
	$date1 = date('Y-m-d', $adate);
	$from = (explode(" ",$adate));	
	$from_date = (explode("/",$from[0]));	
	$fromdate = $from_date[2]."-".$from_date[1]."-".$from_date[0];	
	
	$date2 = date('Y-m-d', $bdate);	
	$to = (explode(" ",$bdate));	
	$to_date = (explode("/",$to[0]));	
	$start_contract = $to_date[2]."-".$to_date[1]."-".$to_date[0];
	
	$datea = date('Y-m-d', $date3);
	$from1 = (explode(" ",$date3));	
	$from_date1 = (explode("/",$from1[0]));	
	$todate = $from_date1[2]."-".$from_date1[1]."-".$from_date1[0];	
	
	$dateb = date('Y-m-d', $date4);
	$from2 = (explode(" ",$date4));	
	$from_date2 = (explode("/",$from1[0]));	
	$end_contract = $from_date2[2]."-".$from_date2[1]."-".$from_date2[0];	
	
	$datec = date('Y-m-d', $date5);
	$from3 = (explode(" ",$date5));	
	$from_date3 = (explode("/",$from3[0]));	
	$DOI_1 = $from_date3[2]."-".$from_date3[1]."-".$from_date3[0];	
	
	$dated = date('Y-m-d', $date6);
	$from4 = (explode(" ",$date6));	
	$from_date4 = (explode("/",$from4[0]));	
	$DOE_1 = $from_date4[2]."-".$from_date4[1]."-".$from_date4[0];
		
	$datee = date('Y-m-d', $date7);
	$from5 = (explode(" ",$date7));	
	$from_date5 = (explode("/",$from5[0]));	
	$DOI_2 = $from_date5[2]."-".$from_date5[1]."-".$from_date5[0];	
	
	$datef = date('Y-m-d', $date8);
	$from6 = (explode(" ",$date8));	
	$from_date6 = (explode("/",$from6[0]));	
	$DOE_2 = $from_date6[2]."-".$from_date6[1]."-".$from_date6[0];	
	
	$dateg = date('Y-m-d', $date9);
	$from7 = (explode(" ",$date9));	
	$from_date7 = (explode("/",$from7[0]));	
	$DOI_3 = $from_date7[2]."-".$from_date7[1]."-".$from_date7[0];	
	
	$dateh = date('Y-m-d', $date10);
	$from8 = (explode(" ",$date10));	
	$from_date8 = (explode("/",$from8[0]));	
	$DOE_3 = $from_date8[2]."-".$from_date8[1]."-".$from_date8[0];	
	
	$datei = date('Y-m-d', $date11);
	$from9 = (explode(" ",$date11));	
	$from_date9 = (explode("/",$from9[0]));	
	$Ag_St_Date = $from_date9[2]."-".$from_date9[1]."-".$from_date9[0];	
	
	$datej = date('Y-m-d', $date12);
	$from10 = (explode(" ",$date12));	
	$from_date10 = (explode("/",$from10[0]));	
	$Ag_En_Date = $from_date10[2]."-".$from_date10[1]."-".$from_date10[0];
	
	$datek = date('Y-m-d', $date13);
	$from11 = (explode(" ",$date13));	
	$from_date11 = (explode("/",$from11[0]));	
	$MBIS_start_date = $from_date11[2]."-".$from_date11[1]."-".$from_date11[0];	
	$newname=date("ymdHis");
	$target_path = "files/";
	$fext=basename($_FILES['uploadedfile']['name']);
	$fext1=explode(".",$fext);
	$fexn=$newname.".".$fext1[1];
	$target_path = $target_path.$fext;
	//print_r($_POST);
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
	$imagepath = $target_path;
	else
	$imagepath ='';
	
	$quer3=fetchrow(execute("select staff_id FROM `staff_additional_info` where staff_id='$staff_id'"));
if($quer3[0])
{
	
	$query="UPDATE `staff_additional_info` SET `s_staff_id`='$s_staff_id',`s_name`='$s_name',`s_add`='$s_add',`s_mb`='$s_mb',`staff_id`='$staff_id',`staff_category`='$staff_category',`fromdate`='$fromdate', `todate`='$todate',`start_contract`='$start_contract',

`end_contract`='$end_contract',`DOI_1`='$DOI_1',`DOE_1`='$DOE_1',

`DOI_2`='$DOI_2',`DOE_2`='$DOE_2',`DOI_3`='$DOI_3',`DOE_3`='$DOE_3',

`Ag_St_Date`='$Ag_St_Date',`Ag_En_Date`='$Ag_En_Date',`contract_prd`='$contract_prd',`passport_no`='$passport_no',`country`='$country',`permit_no`='$permit_no',`visa_no`='$visa_no',`place_of_issue`='$place_of_issue',`renewal_time`='$renewal_time',`owner_name`='$owner_name',`contact_no`='$contact_no',`owner_address`='$owner_address',`account_no`='$account_no',`bank_name`='$bank_name',`IFCA_code`='$IFCA_code',`uploadedfile`='$uploadedfile',`MBIS_start_date`='$MBIS_start_date',`vendor_name`='$vendor_name',`yrs_of_exp`='$yrs_of_exp',`e_name`='$e_name',`e_num`='$e_num',`e_address`='$e_address' WHERE staff_id='$staff_id'";



}

else

{ 

	$query="INSERT INTO `staff_additional_info`(`s_staff_id`, `s_name`, `s_add`, `s_mb`, `staff_id`, `staff_category`, `fromdate`, `todate`, `start_contract`,  `end_contract`,`DOI_1`, `DOE_1`, `DOI_2`, `DOE_2`, `DOI_3`, `DOE_3`, `Ag_St_Date`, `Ag_En_Date`, `contract_prd`, `passport_no`, `country`, `permit_no`, `visa_no`, `place_of_issue`, `renewal_time`, `owner_name`, `contact_no`, `owner_address`, `account_no`, `bank_name`, `IFCA_code`,`uploadedfile`,`MBIS_start_date`,`vendor_name`,`yrs_of_exp`,`country1`,`e_name`,`e_num`,`e_address`) VALUES('$s_staff_id', '$s_name', '$s_add', '$s_mb', '$staff_id', '$staff_category', '$fromdate', '$todate', '$start_contract',  '$end_contract','$DOI_1', '$DOE_1', '$DOI_2', '$DOE_2', '$DOI_3', '$DOE_3', '$Ag_St_Date', '$Ag_En_Date', '$contract_prd', '$passport_no', '$country', '$permit_no', '$visa_no', '$place_of_issue', '$renewal_time','$owner_name', '$contact_no', '$owner_address','$account_no', '$bank_name','$IFCA_code','$imagepath','$MBIS_start_date','$vendor_name','$yrs_of_exp','$country1','$e_name','$e_num','$e_address')";
	 
	

}
   $result=execute($query);
	if($result) 
	{

		?>

        <script language="javascript">

		alert("Updated Sucessfully");

        </script>

        <?php
	}
}

//data fetching 
$quer=execute("select * FROM `staff_additional_info` where staff_id='$staff_id'");

	while($row5=fetcharray($quer))
	{

		$fromdate=$row5['fromdate'];
		$dateArray=explode('-',$fromdate);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$fromdate="$acq_yy-$acq_mm-$acq_dd";
		else
		$fromdate="";
		$s_staff_id=$row5['s_staff_id'];
		$s_name=$row5['s_name'];
		$s_add=$row5['s_add'];
		$todate=$row5['todate'];
		$dateArray=explode('-',$todate);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$todate="$acq_yy-$acq_mm-$acq_dd";
		else
		$todate="";
		$start_contract=$row5['start_contract'];
		$dateArray=explode('-',$start_contract);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$start_contract="$acq_yy-$acq_mm-$acq_dd";
		else
		$start_contract="";		
		$s_mb=$row5['s_mb'];
		$staff_category=$row5['staff_category'];
		$contract_prd=$row5['contract_prd'];	
	    $passport_no=$row5['passport_no'];
		$country=$row5['country'];
		$country1=$row5['country1'];
		$permit_no=$row5['permit_no'];
		$visa_no=$row5['visa_no'];
		$place_of_issue=$row5['place_of_issue'];
		$vendor_name=$row5['vendor_name'];
		$renewal_time=$row5['renewal_time'];		
		$end_contract=$row5['end_contract'];
		$yrs_of_exp=$row5['yrs_of_exp'];
		$dateArray=explode('-',$end_contract);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$end_contract="$acq_yy-$acq_mm-$acq_dd";
		else
		$end_contract="";		
		$DOI_1=$row5['DOI_1'];
		$dateArray=explode('-',$DOI_1);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$DOI_1="$acq_yy-$acq_mm-$acq_dd";
		else
		$DOI_1="";		
		$contact_no=$row5['contact_no'];
		$uploadedfile=$row5['uploadedfile'];	
	    $owner_name=$row5['owner_name'];	
	    $owner_address=$row5['owner_address'];		
		$account_no=$row5['account_no'];	
		$DOE_1=$row5['DOE_1'];
		$dateArray=explode('-',$DOE_1);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		$e_num=$row5['e_num'];
		$e_name=$row5['e_name'];
		$e_address=$row5['e_address'];
		if($acq_yy!='0000')
		$DOE_1="$acq_yy-$acq_mm-$acq_dd";
		else
		$DOE_1="";		
		$bank_name=$row5['bank_name'];
		$IFCA_code=$row5['IFCA_code'];
		$DOI_2=$row5['DOI_2'];
		$dateArray=explode('-',$DOI_2);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$DOI_2="$acq_yy-$acq_mm-$acq_dd";
		else
		$DOI_2="";		
		$DOE_2=$row5['DOE_2'];
		$dateArray=explode('-',$DOE_2);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$DOE_2="$acq_yy-$acq_mm-$acq_dd";
		else
		$DOE_2="";	
		$DOI_3=$row5['DOI_3'];
		$dateArray=explode('-',$DOI_3);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
	    $acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$DOI_3="$acq_yy-$acq_mm-$acq_dd";
		else
		$DOI_3="";
		$DOE_3=$row5['DOE_3'];
		$dateArray=explode('-',$DOE_3);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$DOE_3="$acq_yy-$acq_mm-$acq_dd";
		else
		$DOE_3="";	
		$Ag_St_Date=$row5['Ag_St_Date'];
		$dateArray=explode('-',$Ag_St_Date);
		$acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$Ag_St_Date="$acq_yy-$acq_mm-$acq_dd";
		else
		$Ag_St_Date="";	
		$Ag_En_Date=$row5['Ag_En_Date'];
		$dateArray=explode('-',$Ag_En_Date);
	    $acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$Ag_En_Date="$acq_yy-$acq_mm-$acq_dd";
		else
		$Ag_En_Date="";
		$MBIS_start_date=$row5['MBIS_start_date'];
		$dateArray=explode('-',$MBIS_start_date);
	    $acq_yy=$dateArray[2];
		$acq_mm=$dateArray[1];
		$acq_dd=$dateArray[0];
		if($acq_yy!='0000')
		$MBIS_start_date="$acq_yy-$acq_mm-$acq_dd";
		else
		$MBIS_start_date="";
		
	}
	//
?>
<html>
<head>
  <script language="JavaScript">

function reloadMe()
{

		document.frm.action="staff_additional_info.php";
		document.frm.submit();


}
	</script>
    <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
</head>
<body>
<table border="1" cellpadding="0" cellspacing="0" width="1000" align="center">
<form  name="frm" method="POST" ENCTYPE='multipart/form-data'>
<input type="hidden" name="staff_id" value="<?=$staff_id?>">
<tr><td align="center" colspan="10" class="submenu">Additional Information</td></tr>
<tr class="submenu">
     <tr><td class="submenu" colspan="6">&nbsp;Emergency Information</td></tr> 
					       <tr> <td colspan="6">&nbsp;Person to be contacted in an emergency</td></td></tr>
                            <tr>
                             <td colspan="4">&nbsp;Name :</td>
					        <td>					        
					       <input type="text" name="e_name" size="20" value="<?=$e_name?>" >
				                </td><td></td>
				                </tr>
                                <tr>
                                <td colspan="4">&nbsp;Ph No :</td>
					        <td>					        
					       <input type="text" name="e_num" size="20" value="<?=$e_num?>" >
				                </td>
                                <td></td>
</tr>
                 <tr align="left">
                        <td colspan="4">&nbsp;Address :</td>
                        <td>
                               
                       <textarea rows="4" cols="30" name='e_address'><?=$e_address?></textarea> 
                            </td>
                            <td></td>
                            </tr>
                              <tr><td class="submenu" colspan="6">&nbsp;Staff Category</td></tr> 
<tr><td>&nbsp;&nbsp;Staff Category</td>

<td colspan="6">&nbsp;&nbsp;

<select name="staff_category" onChange="reloadMe()">
      <option value=0>--Select--</option>
<?php

       $qqq=execute("select id,category from staff_category where status='1' order by category");
            while($myq=fetcharray($qqq))
            {
				if($staff_category==$myq[id])
				{
				echo "<option value='$myq[id]' selected>$myq[category]</option>";
				}
				else
				{
				echo "<option value='$myq[id]'>$myq[category]</option>";
				}
            }
            ?>
        </select></td></tr>
        <?
if($staff_category=='10')
{
?>  
  
	<tr>
	<td align="left" nowrap>&nbsp;&nbsp;Support Staff Id</td>
  <td align="left">&nbsp;&nbsp;<input type="text" name="s_staff_id" size="20" value="<?=$s_staff_id?>" ></td>
  <td>&nbsp;&nbsp;Name</td>
	<td align='center'><input type="text" name="s_name" value="<?php echo $s_name?>" ></td>
    <td>&nbsp;&nbsp;Address</td>
  <td align='center'><input type="text" name="s_add" value="<?php echo $s_add ?>"></td>	
  	</tr>
    <tr>
     <td>&nbsp;&nbsp;Mobile Number</td>
   <td align='center'><input type="text" name="s_mb" value="<?php echo $s_mb?>"></td>
    <td>&nbsp;&nbsp;Vendor name</td>
   <td align='center'><input type="text" name="vendor_name" value="<?php echo $vendor_name?>"></td>      
   <td width="50">MBIS start date</td>     
	<td align="left" colspan=""><a href="javascript:showCal('Calendar13')"><img src="../images/calendar.jpg" align="absmiddle" ></a><input type="text" name="date13" value="<?php if($date13==""){ $date13=date("d/m/Y"); } echo $MBIS_start_date?>" readonly>&nbsp;&nbsp;

		</td>
<tr><td>&nbsp;&nbsp;Years of experience</td>
<td align='center'><input type="text" name="yrs_of_exp" value="<?php echo $yrs_of_exp?>"></td><td></td><td></td><td></td><td></td>
   
</tr>
<?
}
?>
        
  
         <?
if($staff_category=='9')
{
?>  
<tr><td colspan="6" class="submenu">&nbsp;&nbsp;Expat Form</td></tr>
<tr>
      <td width="110"> &nbsp;&nbsp;Passport No.</td>
      <td width="100">&nbsp;&nbsp;
      <input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td> 
	  <td width="130" title="Format :dd-mm-yyyy"> Date of Issue </td>
	  <td align="left" colspan=""><input type="text" size= 15 name="date5" value="<?php if($date5==""){ $date5=date("d/m/Y"); } echo $DOI_1?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar5')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
	  <div id="debug"></div>
      <td width="160" title="Format :dd-mm-yyyy"> Date of Expiration </td>
	  <td align="left" colspan=""><input type="text" size= 15 name="date6" value="<?php if($date6==""){ $date6=date("d/m/Y"); } echo $DOE_1?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar6')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
	  <div id="debug"></div>
</tr>
<tr>
      <td width="110">&nbsp;&nbsp;Country</td>
      <td width="100">&nbsp;&nbsp;
      <input type="text" name="country" id="country" size="15" maxlength="50" value="<?=$country?>" />  </td> 
	  
	
	<td width="130" title="Format :dd-mm-yyyy"> Scan Copy Upload</td>
	 <td align='center' nowrap><input type='FILE' name='uploadedfile' value='$uploadedfile' size='15' ></td><td></td><td></td>

  
      </tr>
      <tr><td colspan="6" class="submenu">&nbsp;&nbsp;Residence Permit</td></tr>
<tr>
     
	  <td width="130" title="Format :dd-mm-yyyy">&nbsp;&nbsp; Date of Issue </td>
	  <td align="left" colspan="">&nbsp;&nbsp;<a href="javascript:showCal('Calendar7')"><img src="../images/calendar.jpg" align="absmiddle" ></a><input type="text" size= 15 name="date7" value="<?php if($date7==""){ $date7=date("d/m/Y"); } echo $DOI_2?>" readonly>&nbsp;&nbsp;

		</td>
	  <td width="110">Permit Number</td>
      <td width="100">
      <input type="text" name="permit_no" id="permit_no" size="15" maxlength="50" value="<?=$permit_no?>" />  </td>
      <td width="160" title="Format :dd-mm-yyyy"> Date of Expiration </td>
	  <td align="left" colspan=""><input type="text" size= 15 name="date8" value="<?php if($date8==""){ $date8=date("d/m/Y"); } echo $DOE_2?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar8')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
	  <div id="debug"></div>
</tr>
<tr>
      <td width="110">&nbsp;&nbsp;Country</td>
      <td width="100">&nbsp;&nbsp;
      <input type="text" name="country1" id="country1" size="15" maxlength="50" value="<?=$country1?>" />  </td> <td></td><td></td><td></td><td></td>
      <tr><td colspan="6" class="submenu">&nbsp;&nbsp;Visa</td></tr>
<tr>
      <td width="110"> &nbsp;&nbsp; Visa number</td>
      <td width="100">&nbsp;&nbsp;
      <input type="text" name="visa_no" id="visa_no" size="15" maxlength="50" value="<?=$visa_no?>" />  </td> 
	  <td width="130" title="Format :dd-mm-yyyy"> Date of Issue </td>
	  <td align="left" colspan=""><input type="text" size= 15 name="date9" value="<?php if($date9==""){ $date9=date("d/m/Y"); } echo $DOI_3?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar9')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
	  <div id="debug"></div>
      <td width="160" title="Format :dd-mm-yyyy"> Date of Expiration </td>
	  <td align="left" colspan=""><input type="text" size= 15 name="date10" value="<?php if($date10==""){ $date10=date("d/m/Y"); } echo $DOE_3?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar10')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
	  <div id="debug"></div>
</tr>
<tr>
      <td width="110">&nbsp;&nbsp;Place of issue</td>
      <td width="100">&nbsp;&nbsp;
      <input type="text" name="place_of_issue" id="place_of_issue" size="15" maxlength="50" value="<?=$place_of_issue?>" />  </td> 
     <td width="110">Renewal Time</td>
      <td width="100">
      <input type="text" name="renewal_time" id="renewal_time" size="15" maxlength="50" value="<?=$renewal_time?>" />  </td>
        </td> <td></td>
        <tr><td colspan="6" class="submenu">&nbsp;&nbsp;Property Details</td></tr>
     <tr> 
<td width="50">&nbsp;&nbsp;HouseOwner Name  </td>

    <td width="50">&nbsp;&nbsp;<input name="owner_name" type="text" size="15" maxlength="55" value="<?=$owner_name?>" /></td>
   <td width="50">Contact number</td>
    <td width="50"><input name="contact_no" type="text" size="15" maxlength="22" value="<?=$contact_no?>" /></td>



    <td width="50">HouseOwner Address  </td>

    <td width="50"><input name="owner_address" type="text" size="15" maxlength="255" value="<?=$owner_address?>" /></td>
  </tr>
<tr>   
    <td width="50">&nbsp;&nbsp;Agreement start date </td>     
	 <td align="left" colspan="">&nbsp;&nbsp;<a href="javascript:showCal('Calendar11')"><img src="../images/calendar.jpg" align="absmiddle" ></a><input type="text" size= 15 name="date11" value="<?php if($date11==""){ $date11=date("d/m/Y"); } echo $Ag_St_Date?>" readonly>&nbsp;&nbsp;
</td>
<td width="50">Agreement end date </td>     
	 <td align="left" colspan=""><input type="text" size= 15 name="date12" value="<?php if($date12==""){ $date12=date("d/m/Y"); } echo $Ag_En_Date?>" readonly>&nbsp;&nbsp;
<a href="javascript:showCal('Calendar12')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td><td></td><td></td>
<tr><td colspan="6" class="submenu">&nbsp;&nbsp;Owner Bank Details</td></tr>
<tr>
      <td width="110"> &nbsp;&nbsp;Account No.</td>
      <td width="100">&nbsp;&nbsp;
      <input type="text" name="account_no" id="account_no" size="15" maxlength="50" value="<?=$account_no?>" />  </td>
      <td width="110"> Bank Name</td>
      <td width="100">
      <input type="text" name="bank_name" id="bank_name" size="15" maxlength="50" value="<?=$bank_name?>" />  </td>
      <td width="110"> IFCA code</td>
      <td width="100">
      <input type="text" name="IFCA_code" id="IFCA_code" size="15" maxlength="50" value="<?=$IFCA_code?>" />  </td></tr>
    
    <?
}
?>
<table border="1" cellpadding="0" cellspacing="0" width="1000" align="center">
<tr><td class="submenu" colspan="6">&nbsp;&nbsp;Contract Information</td></tr>   
<?php
$rsql="select * FROM `staff_additional_info_1` where staff_id='$staff_id'";
//echo $rsql;
$rrs=execute($rsql);
$rnum=rowcount($rrs);
if($rnum>=1)
{
	echo "<tr>";
		echo "<td class='rowpic' nowrap>Select&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<td class='rowpic'>Contract Number</td>";
		echo "<td class='rowpic'>Contract Period</td>";
		echo "<td class='rowpic'>Start Date Of Contract</td>";
		echo "<td class='rowpic'>End Date Of Contract</td>";
			echo "</tr>";
	while($prow=fetcharray($rrs))
	{
		echo "<tr>";
		echo "<td nowrap>&nbsp;&nbsp;<input type=checkbox name='cid[]' value=$prow[0] checked>&nbsp;&nbsp;&nbsp;&nbsp;";
		
		
		echo "<td><input type=text name='contract_num$prow[0]' value='$prow[1]' width='100%'></td>";
		
		
		echo "<td><input type=text name='contract_prd$prow[0]' value='$prow[2]' width='100%'></td>";
		
		echo "<td>";
		$yr1 = explode("-",$prow[3]);
		$MyDay1=$yr1[2];
		//Day
		echo "<select name='FrDay1$prow[0]'>";
		echo "<option></option>";
		for($i=1;$i<=31;$i++){
		if($i == $MyDay1)
			echo "<option value='$i'selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
		}
		echo "</select>";
		$MyMonth1=$yr1[1];
		//Month
		echo "<select name='FrMon1$prow[0]'>";
		echo "<option></option>";
		for($i=1;$i<=12;$i++)
		{
			if($i == $MyMonth1)
				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
			else
				echo "<option value='$i'>" . MonthName($i) . "</option>\n";
		}
		echo "</select>";
		//Year
		$maxYr1 =2010;
		$MyYear1=$yr1[0];
		echo "<select name='FrYear1$prow[0]'>";
		echo "<option></option>";
		for($i=1990;$i<=$maxYr1;$i++)
		{
			if($i == $MyYear1)
				echo "<option value='$i' selected >$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
			echo "</td>";
			//end from date
			// to date
			echo "<td nowrap>";
			$yr1 = explode("-",$prow[4]);
			$MyDay1=$yr1[2];
			//Day
			echo "<select name='LaDay1$prow[0]'>";
			echo "<option></option>";
			for($i=1;$i<=31;$i++){
			if($i == $MyDay1)
				echo "<option value='$i'selected>$i</option>\n";
			else
				echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			$MyMonth1=$yr1[1];
			//Month
			echo "<select name='LaMon1$prow[0]'>";
			echo "<option></option>";
			for($i=1;$i<=12;$i++)	{
				if($i == $MyMonth1)
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
					echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
				echo "</select>";
			//Year
			$maxYr1 =2010;
			$MyYear1=$yr1[0];
			echo "<select name='LaYear1$prow[0]'>";
			echo "<option></option>";
			for($i=1990;$i<=$maxYr1;$i++)	{
				if($i == $MyYear1)
					echo "<option value='$i' selected >$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
			echo "</td>";
			echo "<td></td>";
			//end to date
	echo "</tr>";
}
$flag=1;?>
<input type=hidden value=<?=$flag?> name=<?=$flag?>>
<tr><td><input type=submit name='ModifyjobDet' value='Modify' class='bgbutton'></td>
<td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<?php
}?>
<tr>
	<td class='rowpic'>Contract Number</td>
	<td class='rowpic'>Contract Period</td>
	<td class='rowpic'>Start Date Of Contract</td>
	<td class='rowpic'>End Date Of Contract</td>
    <td class='rowpic'></td>
    <td class='rowpic'></td>
	

</tr>
<tr>
	<td><select name="contract_num" onchange='reloadMe()'>

      <?php

				echo "<option value='0'>00</option>";

				for($i=1;$i<=20;$i++)

				{

					if($i<10)

						$i="0".$i;

					$sel='';

					if($contract_num==$i)

						$sel='selected';

					echo "<option value='$i' $sel >$i</option>";

				}

				?>

    </select></td>	
	<td><input type=text name='contract_prd' onKeyDown="return checkit(event)" width="100%"></td>
	
	<td nowrap>
	<?php
	//from date
	$d1=getdate();
	
	$MyDay1=$d1["mday"];
	//Day
	echo "<select name='FrDay1'>";
	echo "<option></option>";
	for($i=1;$i<=31;$i++)
	{
	if($i == $MyDay1)
		echo "<option value='$i' >$i</option>\n";
	else
		echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	$MyMonth1=$d1["mon"];
	//Month
	echo "<select name='FrMon1'>";
	echo "<option></option>";
	for($i=1;$i<=12;$i++)
	{
		if($i == $MyMonth1)
			echo "<option value='$i' >" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	//Year
	$maxYr1 =$d1["year"]+1;
	$MyYear1=$d1["year"];
	echo "<select name='FrYear1'>";
	echo "<option></option>";
	for($i=1990;$i<=$maxYr1;$i++)
	{
		if($i == $MyYear1)
			echo "<option value='$i' >$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	echo "</td>";
//end from date
//to date
?>
<td nowrap>
<?php
$d1=getdate();
$MyDay1=$d1["mday"];
//Day
echo "<select name='LaDay1'>";
echo "<option></option>";
for($i=1;$i<=31;$i++){
if($i == $MyDay1)
	echo "<option value='$i' >$i</option>\n";
else
	echo "<option value='$i'>$i</option>\n";
}
	echo "</select>";

	$MyMonth1=$d1["mon"];
	//Month
	echo "<select name='LaMon1'>";
	echo "<option></option>";
	for($i=1;$i<=12;$i++)
	{
		if($i == $MyMonth1)
			echo "<option value='$i' >" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	//Year
	$maxYr1 =$d1["year"]+1;
	$MyYear1=$d1["year"];
	echo "<select name='LaYear1'>";
	echo "<option></option>";
	for($i=1940;$i<=$maxYr1;$i++)
	{
		if($i == $MyYear1)
			echo "<option value='$i' >$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
echo "</td>";
echo "<td></td>";
//end to date
?>
</tr>
<tr>
<?php
$flag=1;
?>
	<input type=hidden name=flag value=<?=$flag?>>
	<td align='left' colspan='7'><input type="submit" name="jodadd" value="Add" class="bgbutton"></td>
</tr>
</table>

<?php
function MonthName($mon){
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




<div align="center">
 <input name="Submit" type="submit" width="30" height="8" class="bgbutton" value=" Update " /> 
 </div>
 </form>
 </table>
</body>
</html>





