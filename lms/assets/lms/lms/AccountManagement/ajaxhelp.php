<?php
include("../db.php");
$q=$_GET["q"];
if($q==1)
{
echo "<table><tr><td><b>Grouping of accounts is done for the purpose of classifying and identifying ledger accounts according to their nature.Primary groups are created in the master group page.There are 4 pre defined main groups such as liability,asset,income and expense.<br><br>
To create a group Click on master settings menu.Click on the submenu groups.Select the master 
group and enter the group name.Click on view button to view all the groups created.</b>
</td></tr>";
}
if($q==2)
{
echo "<table><tr><td><b>A ledger is the actual account head to which you identify a transaction.All the accounting voucher entries are passed using ledgers.<br><br>
To create a new ledger click on master settings.Click on the submenu ledgers.All the ledgers are classified into groups.The group field displays all the groups created.The user can enter the ledger name and select the group from the group field.Select whether it is debited or credited.In the field opening balance enter opening balance of the account if any.Click on view button to view all the ledgers created.You can edit the ledger by clicking on the edit link.
<b></td></tr>";
}
if($q==3)
{
echo "<table><tr><td><b>A voucher is a source of document containing the details of financial transaction.<br>To create a new voucher type click on master settings.Click on the submenu voucher types.Enter the voucher name.To view all voucher types created click on view button.	</b></td></tr>";
}

if($q==4)
{
echo "<table><tr><td><b>After creating ledgers and groups click on the menu transaction.Select the voucher type.Now  you can enter the transation.Select the date and select the accounts involved from the list.Select the option cash or cheque/DD.If it is cheque/DD you must enter cheque/DD number and cheque/DD date.Then enter the amount and narration and save it.</b></td></tr>";
}
if($q==5)
{
echo "<table><tr><td><b>Click on Day book in report menu.Select the bank name  and dates.Day book displays the entries made on a selected date. </b></td></tr>";
}
if($q==6)
{
echo "<table><tr><td><b>Click on Bank book in report menu.Bank related transactions between the selected dates will be displayed.Also you can export and print bank book.</b></td></tr>";
}
if($q==7)
{
echo "<table><tr><td><b>Click on Cash book in report menu.Cash book displays the cash details between the selected dates.Also you can export and print cash book.</b></td></tr>";
}
if($q==8)
{
echo "<table><tr><td><b>Click on Ledger Book in report menu.Select the ledger name and dates.It will display the transactions related to the  selected  ledger between the selected dates.Also you can export and print ledger book.</b></td></tr>";
}
if($q==9)
{
echo "<table><tr><td><b>Click on trial balance in report menu.The groupwise trial balance between the selected dates will be displayed.Also you can export and print trial balance.	</b></td></tr>";
}
if($q==10)
{
echo "<table><tr><td><b>Click on profit & loss in final accounts menu.Select dates.It will display the profit and loss account of that particular institution.You can export and print profit & loss account.</b></td></tr>";
}
if($q==11)
{
echo "<table><tr><td><b>Click on balance sheet in final accounts.Select dates.It will display the balance sheet of that particular institution.You can export and print balance sheet. </b></td></tr>";
}
if($q==12)
{
echo "<table><tr><td><b>Click on Change password menu.Enter Old password.Then enter the new password.Enter the new password again for confirmation.Click on submit button.Now you will get a new password if your old password is correct.</b></td></tr>";
}
if($q==13)
{
echo "<table><tr><td><b>Click on Users menu.Here you can create a new user.To view all users created,click on view button.Here you can enable or diable users.</b></td></tr>";
}
if($q==14)
{
echo "<table><tr><td><b>Click on organization in master settings menu a sub menu organization will appear.Here you can create a new organization.After creating a new organization you can create institution under that particular organization by clicking on institution.</b></td></tr>";
}

?>

