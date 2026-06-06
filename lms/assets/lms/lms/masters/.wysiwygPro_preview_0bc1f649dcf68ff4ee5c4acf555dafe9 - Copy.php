<?php
if ($_GET['randomId'] != "0JT8x72kWWxQwDfcGbOYQB5FmV7kAelwiUJzhWZWJYTqZA17XUKroNQBmKmg0G6_") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
