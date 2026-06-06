<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Test page</title>
    </head>
    <body style="font-family: arial; color: #ffffff;">
        <table cellspacing="0" cellpadding="0" style="width:100%;height:100%;font-size:14px;">
            <tr>
                <td colspan="2" style="background-color: green; padding:10px;">
                    This is some header. We don't want to print this - we'll manage the header from the template
                </td>
            </tr>
            <tr>
                <td style="width:200px;height:100%;background-color:#123456;padding:10px;" valign="top">
                    Let's assume this is some left side menu<br /><br />
                    We don't want to print this.<br /><br />
                    We'll print only the content<br /><br />
                    
                    <!--
                        notice how we are calling the print.php script!
                        we're not passing any parameters
                        
                        you'll need to make all the settings in the print.php script
                    -->
                    
                    <a href="../print.php" target="_blank" style="color:#ffffff"><strong>printer friednly version</strong></a>
                    
                </td>
                <td style="background-color: #aabbcc;padding:10px; color: black;" valign="top">
                    <!-- PRINT: start -->
                    <p>
                    Lorem ipsum dolor sit amet consectetuer natoque convallis et eget ac. Nibh nunc faucibus penatibus
                    sem ut cursus purus Vestibulum nibh justo. Nibh nulla a auctor Nulla leo at eu velit condimentum vitae.
                    Fringilla gravida id tortor vitae Sed gravida Quisque elit consequat Nam. Consectetuer condimentum nisl
                    Vestibulum libero sollicitudin Ut at.
                    </p>
                    <p>
                    Enim massa mus tellus orci habitasse urna et Proin risus quam. Phasellus eleifend nonummy Proin et tempus
                    lacus Phasellus Pellentesque ligula egestas. Convallis ut porta elit mollis id orci laoreet Aenean ut dolor.
                    Ligula pretium nulla a elit et nibh id ut hac tellus. Suscipit habitasse urna ultrices ac platea vitae Nam
                    Sed senectus ut. Dapibus Curabitur id consectetuer consequat purus augue.
                    </p>
                    <br /><br />
                    <a href="www.someurl.com">this</a> is a link
                    <!-- PRINT: stop -->
                    <br /><br />
                    <i>notice how it'll appear in the printer friendly version and also note that this text will not be in the
                    printer friendly version of the page but the following paragraph will be in it</i>
                    <!-- PRINT: start -->
                    <p>
                    Lacus tincidunt lobortis tellus et id lacinia Quisque dui sagittis Sed. Hac et consequat Aliquam non sit
                    Praesent risus magna Sed Aenean. Tincidunt magnis ante Suspendisse Nam quam ligula urna fringilla at rhoncus.
                    Consequat in lacinia in Integer netus odio eget Curabitur habitasse sed. Condimentum laoreet dictumst Nam
                    Mauris hac euismod Aenean convallis est consequat. Semper auctor mattis Donec Nam at Maecenas sed dui
                    habitant Praesent.
                    </p>
                    <!-- PRINT: stop -->
                    <p>
                    <i><strong>read the manual for more info!</strong></i>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="background-color:#dedede;padding:10px;color:black">
                    <p>
                    This is the footer. We don't want to print this either - we'll print the footer from the template
                    </p>
                </td>
            </tr>
        </table>
    </body>
</html>
