<?php
if($_REQUEST['action']=='addMediaDet.php')
{
	header('Location: selectMediaType123.php?action=addMediaDet.php');
}
if($_REQUEST['action']=='viewTotalMedia.php')
{
	header('Location: selectMediaType321.php?action=viewTotalMedia.php');
}
if($_REQUEST['action']=='viewReservationDet.php')
{
header('Location: selectMediaType321.php?action=viewReservationDet.php');
}
if($_REQUEST['action']=='viewPurchaseOrder.php')
{
	header('Location: selectMediaType321.php?action=viewPurchaseOrder.php');
}
if($_REQUEST['action']=='viewPurchase.php')
{
	header('Location: selectMediaType321.php?action=viewPurchase.php');
}
/****************************************************************************/
if($_REQUEST['action']=='viewIssued.php')
{
	header('Location: selectMediaType321.php?action=viewIssued.php');
}
if($_REQUEST['action']=='viewReturns.php')
{
	header('Location: selectMediaType321.php?action=viewReturns.php');
}
if($_REQUEST['action']=='viewDueReport.php')
{
	header('Location: selectMediaType321.php?action=viewDueReport.php');
}
?>