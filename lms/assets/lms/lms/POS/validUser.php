<?php



// Breadcrumb

include("./Breadcrumb.php");
$trail = new Breadcrumb();
$trail->add('Home', validUser, 0);


// END of Breadcrumb

//echo 'ORG ID is : '.$_SESSION['orgID'];
//echo 'OUTLET ID is : '.$_SESSION['outletID'];
//echo 'USER ID is : '.$_SESSION['userID'];

//$html =<<<HTML

if($_SESSION['userID'] == null)
{
	header('Location: login.php');
}

require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection

$error = array(); //define $error to prevent error later in script
$message = '';

$orgID = $_SESSION['orgID'];
$outletID = $_SESSION['outletID'];
$userID = $_SESSION['userID'];
$userFullName = $_SESSION['userName'];
$privID = $_SESSION['privID'];
$orgTypeID = $_SESSION['orgTypeID'];

?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
-->
<html>
<head>
	<link href="newStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include "header.php"; ?>
<table width="100%" border="0" cellpadding=0 cellspacing=0>
  	<tr height="15">
  		<td colspan="2" height="15">
  			<?php include "topMenu.php"; ?>
  			<!--<script SRC="JS/myCRM_Top_Menu.js"></script>-->
  		</td>
  	</tr>
    <tr>
        <td width="20%" height="400" border="1" valign="top"><!-- Left hand navigation bar-->
  			<?php include "leftNavigation.php"; ?>
        <td width="80%" height="400" valign="top"><!-- Center of the page -->
			<table width="100%" align="left" valign="top">
				<tr>
					<td valign="top" align="left">
						<?php
							//Sample CSS
							echo "
							<style>
							#breadcrumb ul li{
							   list-style-image: none;
							   display:inline;
							   padding: 0 3px 0 0;
							   margin: 3px 0 0 0;
							}
							#breadcrumb ul{
							   margin:0;padding:0;
							   list-style-type: none;
							   padding-left: 1em;
							}
							</style>
							";

							//Now output the navigation.
							$trail->output();
						?>
					</td>
				</tr>
				<tr>
					<td align="left">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td width="50%">
						<div width="50%">
							<fieldset>
								<legend><font style="font:normal 14px verdana"><b>Today's Enquiries</b></font> </legend>
									<table>
										<tr><td>&nbsp;</td></tr>
								<?php
								//$todaysDate = CURDATE();
								$date = date("Y-m-d", time() + 45000);
								//$date = date("Y-m-d");
								// If the Outlet User/Outlet Admin Logs-in, then run this query
								/**$enquiryStatementForOutlets = "SELECT ENQUIRY.VISIT_ID FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}' AND ENQUIRY.OUTLET_ID = '{$outletID}' AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
									$enquiryStatementForOutlets = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}' AND ENQUIRY.OUTLET_ID = '{$outletID}' AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
								**/
								$enquiryStatementForOutlets = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_VISIT_INFO VISIT WHERE ORG_ID='{$orgID}' AND OUTLET_ID = '{$outletID}' AND ENQUIRY_FLAG='YES' AND DATE_OF_ENTRY='{$date}' ";

								/** If the Super Admin Logs-in, then run this query
									$enquiryStatementForSuperAdmin = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}'  AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
								**/
								$enquiryStatementForSuperAdmin = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_VISIT_INFO VISIT WHERE VISIT.ORG_ID='{$orgID}' AND VISIT.ENQUIRY_FLAG='YES' AND DATE_OF_ENTRY='{$date}' ";
								$query;
								//print $enquiryStatementForSuperAdmin;

								if($privID === '2' || $privID === '3'){

									$query = mysql_query($enquiryStatementForOutlets, $con);

									if(( mysql_num_rows( $query ) >= 1 )) {
											while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
												print "<tr>";
												print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Enquiries :</b></td> \n";
												print "<td><font style='font:normal 14px verdana'><b>".$row["ENQUIRY"] . "</b></font></td> \n";
												print "</tr>";
												print "<tr>";
												print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Amount :</b></td> \n";
												print "<td><font style='font:normal 14px verdana'><b>".$row["AMOUNT"] . "</b></font></td> \n";
												print "</tr>";
											}
											mysql_free_result($query);
									}
									else
									{
										print "<tr>";
										print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Enquiries Found </b></td> \n";
										print "</tr>";
									}
								}
								elseif($privID === '1'){
									$query = mysql_query($enquiryStatementForSuperAdmin, $con);
									if(( mysql_num_rows( $query ) >= 1 )) {
										while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
											print "<tr>";
											print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Enquiries (For all outlets) :</b></td> \n";
											print "<td><font style='font:normal 14px verdana'><b>".$row["ENQUIRY"] . "</b></font></td> \n";
											print "</tr>";
											print "<tr>";
											print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Amount (For all outlets) :</b></td> \n";
											print "<td><font style='font:normal 14px verdana'><b>".$row["AMOUNT"] . "</b></font></td> \n";
											print "</tr>";
										}
										mysql_free_result($query);
									}
									else
									{
										print "<tr>";
										print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Enquiries Found </b></td> \n";
										print "</tr>";
									}
								}
								?>
									</table>
							</fieldset>
						</div>
					</td>
<?php
					// SQL CODE FOR SELECTING BIRTHDAYS
					//SELECT * FROM `_CUSTOMER_INFO` WHERE MONTH(`DOB`)=MONTH(NOW()) AND DAYOFMONTH(`DOB`)=DAYOFMONTH(NOW());

					if(!is_null($orgTypeID) && $orgTypeID == 24){
?>
					<td width="50%">
						<div width="50%">
							<fieldset>
								<legend><font style="font:normal 14px verdana"><b>Today's Follow-Ups</b></font> </legend>
									<table>
										<tr><td>&nbsp;</td></tr>
										<?php
											//$todaysDate = CURDATE();
											// If the Outlet User/Outlet Admin Logs-in, then run this query

											$followUpsForOutlets = "SELECT COUNT(*) FOLLOWUPS FROM _CUSTOMER_FOLLOWUP WHERE ORG_ID='{$orgID}' AND OUTLET_ID = '{$outletID}' AND NEXT_FOLLOWUP_DATE='{$date}'  AND STATUS_OF_DEAL='1' AND FOLLOWUP_TRACKING_STATUS  IS NULL ";
											$followUpsForOutletUsers = "SELECT COUNT(*) FOLLOWUPS FROM _CUSTOMER_FOLLOWUP WHERE ORG_ID='{$orgID}' AND FOLLOWUP_PERSON = '{$userID}' AND NEXT_FOLLOWUP_DATE='{$date}'  AND STATUS_OF_DEAL='1' AND FOLLOWUP_TRACKING_STATUS  IS NULL ";
											$followUpsForSuperAdmin = "SELECT COUNT(*) FOLLOWUPS FROM _CUSTOMER_FOLLOWUP WHERE ORG_ID='{$orgID}' AND NEXT_FOLLOWUP_DATE='{$date}'  AND STATUS_OF_DEAL='1' AND FOLLOWUP_TRACKING_STATUS  IS NULL ";
											$query;
											//print $followUpsForSuperAdmin;

											if($privID === '3'){

												$query = mysql_query($followUpsForOutletUsers, $con);

												if(( mysql_num_rows( $query ) >= 1 )) {
														while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
															print "<tr>";
															print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Follow-Ups :</b></td> \n";
															print "<td><font style='font:normal 14px verdana'><b>".$row["FOLLOWUPS"] . "</b></font></td> \n";
															print "</tr>";


														}
														mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Follow-Ups Found </b></td> \n";
													print "</tr>";
												}
											}
											elseif($privID === '2'){

												$query = mysql_query($followUpsForOutlets, $con);

												if(( mysql_num_rows( $query ) >= 1 )) {
														while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
															print "<tr>";
															print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Follow-Ups :</b></td> \n";
															print "<td><font style='font:normal 14px verdana'><b>".$row["FOLLOWUPS"] . "</b></font></td> \n";
															print "</tr>";


														}
														mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Follow-Ups Found </b></td> \n";
													print "</tr>";
												}
											}
											elseif($privID === '1'){
												$query = mysql_query($followUpsForSuperAdmin, $con);
												if(( mysql_num_rows( $query ) >= 1 )) {
													while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
														print "<tr>";
														print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Follow-Ups (For all outlets) :</b></td> \n";
														print "<td><font style='font:normal 14px verdana'><b>".$row["FOLLOWUPS"] . "</b></font></td> \n";
														print "</tr>";


													}
													mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Follow-Ups Found </b></td> \n";
													print "</tr>";
												}
											}
										?>
									</table>
							</fieldset>
						</div>
					</td>
<?php
					}
					else
					{
?>
					<td width="50%">&nbsp;
						<div width="50%">
							<fieldset>
								<legend><font style="font:normal 14px verdana"><b>Today's Birthdays</b></font> </legend>
									<table>
										<tr><td>&nbsp;</td></tr>
										<?php
											//$todaysDate = CURDATE();
											// If the Outlet User/Outlet Admin Logs-in, then run this query

											$birthdaysForOutlets = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE DAY(DOB) = DAY('{$date}') AND MONTH(DOB) = MONTH('{$date}') AND ORG_ID='{$orgID}' AND OUTLET_ID='{$outletID}'";
											$birthdaysForOutletUsers = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE DAY(DOB) = DAY('{$date}') AND MONTH(DOB) = MONTH('{$date}') AND ORG_ID='{$orgID}' AND OUTLET_ID='{$outletID}'";
											$birthdaysForSuperAdmin = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE DAY(DOB) = DAY('{$date}') AND MONTH(DOB) = MONTH('{$date}') AND ORG_ID='{$orgID}' ";
											$query;
											//print $birthdaysForSuperAdmin;

											if($privID === '3'){

												$query = mysql_query($birthdaysForOutletUsers, $con);

												if(( mysql_num_rows( $query ) >= 1 )) {
														while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
															print "<tr>";
															print "<td align='right'><font style='font:normal 14px verdana'> <b><a href='birthdaysForThisMonth.php?birthday=TODAY'>Birthdays :</a></b></td> \n";
															print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=TODAY'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
															print "</tr>";
														}
														mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
											elseif($privID === '2'){

												$query = mysql_query($birthdaysForOutlets, $con);

												if(( mysql_num_rows( $query ) >= 1 )) {
														while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
															print "<tr>";
															print "<td align='right'><font style='font:normal 14px verdana'> <b><a href='birthdaysForThisMonth.php?birthday=TODAY'>Birthdays :</a></b></td> \n";
															print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=TODAY'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
															print "</tr>";


														}
														mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
											elseif($privID === '1'){
												$query = mysql_query($birthdaysForSuperAdmin, $con);
												if(( mysql_num_rows( $query ) >= 1 )) {
													while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
														print "<tr>";
														print "<td align='right'><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=TODAY'>Birthdays  :</a></b></td> \n";
														print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=TODAY'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
														print "</tr>";


													}
													mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
										?>
									</table>
							</fieldset>
						</div>
					</td>
<?php
					}

?>
				</tr>
				<tr>
					<td colspan="2" align="left">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td width="50%">
						<div width="50%">
							<fieldset>
								<legend><font style="font:normal 14px verdana"><b>Last 7 day's Enquiries</b></font> </legend>
									<table>
										<tr><td>&nbsp;</td></tr>
								<?php
								//$todaysDate = CURDATE();
								// If the Outlet User/Outlet Admin Logs-in, then run this query
								/**$enquiryStatementForOutlets = "SELECT ENQUIRY.VISIT_ID FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}' AND ENQUIRY.OUTLET_ID = '{$outletID}' AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
									$enquiryStatementForOutlets = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}' AND ENQUIRY.OUTLET_ID = '{$outletID}' AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
								**/
								$enquiryStatementForOutlets = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_VISIT_INFO VISIT WHERE ORG_ID='{$orgID}' AND OUTLET_ID = '{$outletID}' AND ENQUIRY_FLAG='YES' AND DATE_OF_ENTRY BETWEEN DATE_SUB( '{$date}'  ,INTERVAL 7 DAY) AND '{$date}' ";

								/** If the Super Admin Logs-in, then run this query
									$enquiryStatementForSuperAdmin = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}'  AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
								**/
								$enquiryStatementForSuperAdmin = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_VISIT_INFO VISIT WHERE VISIT.ORG_ID='{$orgID}' AND VISIT.ENQUIRY_FLAG='YES' AND DATE_OF_ENTRY BETWEEN DATE_SUB( '{$date}'  ,INTERVAL 7 DAY) AND '{$date}' ";
								$query;

								if($privID === '2' || $privID === '3'){

									$query = mysql_query($enquiryStatementForOutlets, $con);

									if(( mysql_num_rows( $query ) >= 1 )) {
											while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
												print "<tr>";
												print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Enquiries :</b></td> \n";
												print "<td><font style='font:normal 14px verdana'><b>".$row["ENQUIRY"] . "</b></font></td> \n";
												print "</tr>";
												print "<tr>";
												print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Amount :</b></td> \n";
												print "<td><font style='font:normal 14px verdana'><b>".$row["AMOUNT"] . "</b></font></td> \n";
												print "</tr>";
											}
											mysql_free_result($query);
									}
									else
									{
										print "<tr>";
										print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Enquiries Found </b></td> \n";
										print "</tr>";
									}
								}
								elseif($privID === '1'){
									$query = mysql_query($enquiryStatementForSuperAdmin, $con);
									if(( mysql_num_rows( $query ) >= 1 )) {
										while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
											print "<tr>";
											print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Enquiries (For all outlets) :</b></td> \n";
											print "<td><font style='font:normal 14px verdana'><b>".$row["ENQUIRY"] . "</b></font></td> \n";
											print "</tr>";
											print "<tr>";
											print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Amount (For all outlets) :</b></td> \n";
											print "<td><font style='font:normal 14px verdana'><b>".$row["AMOUNT"] . "</b></font></td> \n";
											print "</tr>";
										}
										mysql_free_result($query);
									}
									else
									{
										print "<tr>";
										print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Enquiries Found </b></td> \n";
										print "</tr>";
									}
								}
								?>
									</table>
							</fieldset>
						</div>
					</td>
<?php
					if($orgTypeID != 24){
?>
					<td width="50%">&nbsp;
						<div width="50%">
							<fieldset>
								<legend><font style="font:normal 14px verdana"><b>This Month's Birthdays</b></font> </legend>
									<table>
										<tr><td>&nbsp;</td></tr>
										<?php
											//$todaysDate = CURDATE();
											// If the Outlet User/Outlet Admin Logs-in, then run this query

											$birthdaysForOutlets = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE MONTH(DOB) = MOD(MONTH('{$date}'), 12) AND ORG_ID='{$orgID}' AND OUTLET_ID='{$outletID}'";
											$birthdaysForOutletUsers = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE MONTH(DOB) = MOD(MONTH('{$date}'), 12) AND ORG_ID='{$orgID}' AND OUTLET_ID='{$outletID}'";
											$birthdaysForSuperAdmin = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE MONTH(DOB) = MONTH('{$date}') AND ORG_ID='{$orgID}' ";
											$query;
											//print $birthdaysForSuperAdmin;

											if($privID === '3'){

												$query = mysql_query($birthdaysForOutletUsers, $con);

												if(( mysql_num_rows( $query ) >= 1 )) {
														while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
															print "<tr>";
															print "<td align='right'><font style='font:normal 14px verdana'> <b><a href='birthdaysForThisMonth.php?birthday=MONTH'>Birthdays :</a></b></td> \n";
															print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=MONTH'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
															print "</tr>";
														}
														mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
											elseif($privID === '2'){

												$query = mysql_query($birthdaysForOutlets, $con);

												if(( mysql_num_rows( $query ) >= 1 )) {
														while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
															print "<tr>";
															print "<td align='right'><font style='font:normal 14px verdana'> <b><a href='birthdaysForThisMonth.php?birthday=MONTH'>Birthdays :</a></b></td> \n";
															print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=MONTH'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
															print "</tr>";


														}
														mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
											elseif($privID === '1'){
												$query = mysql_query($birthdaysForSuperAdmin, $con);
												if(( mysql_num_rows( $query ) >= 1 )) {
													while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
														print "<tr>";
														print "<td align='right'><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=MONTH'>Birthdays  :</a></b></td> \n";
														print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=MONTH'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
														print "</tr>";


													}
													mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
										?>
									</table>
							</fieldset>
						</div>
					</td>
				<?
				}
				else
				{
				?>
				<td width="50%"> &nbsp;</td>
				<?
				}

				?>
				</tr>
				<tr>
					<td colspan="2" align="left">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td width="50%">
						<div width="50%">
							<fieldset>
								<legend><font style="font:normal 14px verdana"><b>Last 1 Month's Enquiries</b></font> </legend>
									<table>
										<tr><td>&nbsp;</td></tr>
								<?php
								//$todaysDate = CURDATE();
								// If the Outlet User/Outlet Admin Logs-in, then run this query
								/**$enquiryStatementForOutlets = "SELECT ENQUIRY.VISIT_ID FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}' AND ENQUIRY.OUTLET_ID = '{$outletID}' AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
									$enquiryStatementForOutlets = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}' AND ENQUIRY.OUTLET_ID = '{$outletID}' AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
								**/
								$enquiryStatementForOutlets = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_VISIT_INFO VISIT WHERE ORG_ID='{$orgID}' AND OUTLET_ID = '{$outletID}' AND ENQUIRY_FLAG='YES' AND DATE_OF_ENTRY BETWEEN DATE_SUB( '{$date}'  ,INTERVAL 1 MONTH) AND '{$date}' ";

								/** If the Super Admin Logs-in, then run this query
									$enquiryStatementForSuperAdmin = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}'  AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
								**/
								$enquiryStatementForSuperAdmin = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_VISIT_INFO VISIT WHERE VISIT.ORG_ID='{$orgID}' AND VISIT.ENQUIRY_FLAG='YES' AND DATE_OF_ENTRY BETWEEN DATE_SUB( '{$date}'  ,INTERVAL 1 MONTH) AND '{$date}' ";
								$query;

								if($privID === '2' || $privID === '3'){

									$query = mysql_query($enquiryStatementForOutlets, $con);

									if(( mysql_num_rows( $query ) >= 1 )) {
											while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
												print "<tr>";
												print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Enquiries :</b></td> \n";
												print "<td><font style='font:normal 14px verdana'><b>".$row["ENQUIRY"] . "</b></font></td> \n";
												print "</tr>";
												print "<tr>";
												print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Amount :</b></td> \n";
												print "<td><font style='font:normal 14px verdana'><b>".$row["AMOUNT"] . "</b></font></td> \n";
												print "</tr>";
											}
											mysql_free_result($query);
									}
									else
									{
										print "<tr>";
										print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Enquiries Found </b></td> \n";
										print "</tr>";
									}
								}
								elseif($privID === '1'){
									$query = mysql_query($enquiryStatementForSuperAdmin, $con);
									if(( mysql_num_rows( $query ) >= 1 )) {
										while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
											print "<tr>";
											print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Enquiries (For all outlets) :</b></td> \n";
											print "<td><font style='font:normal 14px verdana'><b>".$row["ENQUIRY"] . "</b></font></td> \n";
											print "</tr>";
											print "<tr>";
											print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Amount (For all outlets) :</b></td> \n";
											print "<td><font style='font:normal 14px verdana'><b>".$row["AMOUNT"] . "</b></font></td> \n";
											print "</tr>";
										}
										mysql_free_result($query);
									}
									else
									{
										print "<tr>";
										print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Enquiries Found </b></td> \n";
										print "</tr>";
									}
								}
								?>
									</table>
							</fieldset>
						</div>
					</td>
<?php
					if($orgTypeID != 24){
?>
					<td width="50%">&nbsp;
						<div width="50%">
							<fieldset>
								<legend><font style="font:normal 14px verdana"><b>Next Month's Birthdays</b></font> </legend>
									<table>
										<tr><td>&nbsp;</td></tr>
										<?php
											//$todaysDate = CURDATE();
											// If the Outlet User/Outlet Admin Logs-in, then run this query

											$birthdaysForOutlets = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE MONTH(DOB) = MOD(MONTH('{$date}'), 12) + 1 AND ORG_ID='{$orgID}' AND OUTLET_ID='{$outletID}'";
											$birthdaysForOutletUsers = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE MONTH(DOB) = MOD(MONTH('{$date}'), 12) + 1 AND ORG_ID='{$orgID}' AND OUTLET_ID='{$outletID}'";
											$birthdaysForSuperAdmin = "SELECT COUNT(*) BIRTHDAYS FROM _CUSTOMER_INFO WHERE MONTH(DOB) = MONTH('{$date}') + 1 AND ORG_ID='{$orgID}' ";
											$query;
											//print $birthdaysForSuperAdmin;

											if($privID === '3'){

												$query = mysql_query($birthdaysForOutletUsers, $con);

												if(( mysql_num_rows( $query ) >= 1 )) {
														while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
															print "<tr>";
															print "<td align='right'><font style='font:normal 14px verdana'> <b><a href='birthdaysForThisMonth.php?birthday=NEXT'>Birthdays :</a></b></td> \n";
															print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=NEXT'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
															print "</tr>";
														}
														mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
											elseif($privID === '2'){

												$query = mysql_query($birthdaysForOutlets, $con);

												if(( mysql_num_rows( $query ) >= 1 )) {
														while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
															print "<tr>";
															print "<td align='right'><font style='font:normal 14px verdana'> <b><a href='birthdaysForThisMonth.php?birthday=NEXT'>Birthdays :</a></b></td> \n";
															print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=NEXT'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
															print "</tr>";


														}
														mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
											elseif($privID === '1'){
												$query = mysql_query($birthdaysForSuperAdmin, $con);
												if(( mysql_num_rows( $query ) >= 1 )) {
													while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
														print "<tr>";
														print "<td align='right'><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=NEXT'>Birthdays  :</a></b></td> \n";
														print "<td><font style='font:normal 14px verdana'><b><a href='birthdaysForThisMonth.php?birthday=NEXT'>".$row['BIRTHDAYS'] . "</a></b></font></td> \n";
														print "</tr>";


													}
													mysql_free_result($query);
												}
												else
												{
													print "<tr>";
													print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Birthdays Found </b></td> \n";
													print "</tr>";
												}
											}
										?>
									</table>
							</fieldset>
						</div>
					</td>
				<?
				}
				else
				{
				?>
				<td width="50%"> &nbsp;</td>
				<?
				}

				?>
				</tr>
				</tr>
				<tr>
					<td colspan="2" align="left">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td width="50%">
						<div width="50%">
							<fieldset>
								<legend><font style="font:normal 14px verdana"><b>Total Enquiries</b></font> </legend>
									<table>
										<tr><td>&nbsp;</td></tr>
								<?php

								// If the Outlet User/Outlet Admin Logs-in, then run this query
								/**$enquiryStatementForOutlets = "SELECT ENQUIRY.VISIT_ID FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}' AND ENQUIRY.OUTLET_ID = '{$outletID}' AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
									$enquiryStatementForOutlets = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}' AND ENQUIRY.OUTLET_ID = '{$outletID}' AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
								**/
								$enquiryStatementForOutlets = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_VISIT_INFO VISIT WHERE ORG_ID='{$orgID}' AND OUTLET_ID = '{$outletID}' AND ENQUIRY_FLAG='YES'";

								/** If the Super Admin Logs-in, then run this query
									$enquiryStatementForSuperAdmin = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_ENQUIRY_DETAIL_INFO ENQUIRY, _CUSTOMER_VISIT_INFO VISIT WHERE ENQUIRY.ORG_ID='{$orgID}'  AND ENQUIRY.CUSTOMER_ID = VISIT.CUSTOMER_ID AND ENQUIRY.VISIT_ID = VISIT.VISIT_ID ORDER BY DATE_OF_ENTRY ASC";
								**/
								$enquiryStatementForSuperAdmin = "SELECT COUNT(*) ENQUIRY, SUM(AMOUNT_ENQUIRED) AMOUNT FROM _CUSTOMER_VISIT_INFO VISIT WHERE VISIT.ORG_ID='{$orgID}' AND VISIT.ENQUIRY_FLAG='YES'";
								//print $enquiryStatementForSuperAdmin;
								$query;

								if($privID === '2' || $privID === '3'){

									$query = mysql_query($enquiryStatementForOutlets, $con);

									if(( mysql_num_rows( $query ) >= 1 )) {
											while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
												print "<tr>";
												print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Enquiries :</b></td> \n";
												print "<td><font style='font:normal 14px verdana'><b>".$row["ENQUIRY"] . "</b></font></td> \n";
												print "</tr>";
												print "<tr>";
												print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Amount :</b></td> \n";
												print "<td><font style='font:normal 14px verdana'><b>".$row["AMOUNT"] . "</b></font></td> \n";
												print "</tr>";
											}
											mysql_free_result($query);
									}
									else
									{
										print "<tr>";
										print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Enquiries Found </b></td> \n";
										print "</tr>";
									}
								}
								elseif($privID === '1'){
									$query = mysql_query($enquiryStatementForSuperAdmin, $con);
									if(( mysql_num_rows( $query ) >= 1 )) {
										while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
											print "<tr>";
											print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Enquiries (For all outlets) :</b></td> \n";
											print "<td><font style='font:normal 14px verdana'><b>".$row["ENQUIRY"] . "</b></font></td> \n";
											print "</tr>";
											print "<tr>";
											print "<td align='right'><font style='font:normal 14px verdana'> <b>Total Amount (For all outlets) :</b></td> \n";
											print "<td><font style='font:normal 14px verdana'><b>".$row["AMOUNT"] . "</b></font></td> \n";
											print "</tr>";
										}
										mysql_free_result($query);
									}
									else
									{
										print "<tr>";
										print "<td colspan='2'><font style='font:normal 14px verdana'> <b> No Enquiries Found </b></td> \n";
										print "</tr>";
									}
								}
								?>
									</table>
							</fieldset>
						</div>
					</td>
					<td width="50%">&nbsp;</td>
				</tr>
			</table>
        </td>
    </tr>
  </table>

  </body>
</html>
<?php

//HTML;

//echo $html;
?>