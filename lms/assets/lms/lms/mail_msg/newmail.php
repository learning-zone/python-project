<?php
  session_start();
  require_once '../db.php';
	//echo "<pre>";
	//print_r($_GET);
	//print_r($_POST);
	//echo "</pre>";
	//print_r($_SESSION);
$user=$_SESSION['user'];
if($_POST)
{
	$curtype=$_POST['curtype'];
	$branch=$_POST['branch'];
	$teacher=$_POST['teacher'];
	$subject=$_POST['subject'];
	$groupname=$_POST['groupname'];
}

$one="";
$two="";
$three="";
?>   
<!DOCTYPE HTML>
<html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script>
function reloadme()
{
  document.frm.action="newmail.php";
  document.frm.submit();
}
</script>
</head>
<body>
<form Name="frm" action="newmail.php" method="post">     
<table class='forumline' align='center' border="0" width="90%">
<tr>
	<td Class="head" align='center' colspan="14">MAILING SETUP</td>
</tr>
<tr>
	<td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;Person Type<br>
    <select name="person_type">
         <option value="">-------  Select   -------</option>
         <?
             if($person_type=='student'){
                 $one="selected";$two='';$three='';
			 }elseif($person_type=='admisson'){
                 $one="";$two='selected';$three='';
			 }elseif($person_type=='staff'){
                 $one="";$two='';$three='selected';
			 }

         ?> 
         <option value="student" <?=$one?>>Student</option>
         <option value="admission" <?=$two?>>Admisson</option>
         <option value="staff" <?=$three?>>Staff</option>                 
      </select><BR>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By<br>
      <select name="by">
         <option value="">-------  Select   -------</option>
         <?
             if($by=='status'){
                 $four="selected";$five='';$six='';$seven='';$eight='';
			 }elseif($by=='class'){
                 $four='';$five="selected";$six='';$seven='';$eight='';
			 }elseif($by=='homeroom'){
                 $four='';$five='';$six="selected";$seven='';$eight='';
			 }elseif($by=='activity'){
                 $four='';$five='';$six='';$seven="selected";$eight='';
			 }elseif($by=='family'){
                 $four='';$five='';$six='';$seven='';$eight="selected";
			 }

         ?>
         <option value="status" <?=$four?>>Status</option>
         <option value="class" <?=$five?>>Class</option>
         <option value="homeroom" <?=$six?>>Homeroom</option>  
         <option value="activity" <?=$seven?>>Activity</option> 
         <option value="family" <?=$eight?>>Family</option>                 
      </select>
      
      
    </td>
    <td align="left" colspan="4" rowspan="2"><select name="student_type" multiple style="height:125px;">
    <option value="">------------  Select   ------------</option>
         <?
             if($person_type=='student'){
                 $one="selected";$two='';$three='';
			 }elseif($person_type=='admisson'){
                 $one="";$two='selected';$three='';
			 }elseif($person_type=='staff'){
                 $one="";$two='';$three='selected';
			 }

         ?> 
         <option value="student" <?=$one?>>Enrolled</option>
         <option value="admission" <?=$two?>>Graduate</option>
         <option value="staff" <?=$three?>>Pre-Enrolled</option>
         <option value="staff" <?=$three?>>Withdrawn</option>
         <option value="staff" <?=$three?>>Dual-Enrolled</option>
         <option value="staff" <?=$three?>>Inactive</option>
         <option value="staff" <?=$three?>>All</option>                 
      </select>
      <BR><BR>
      <select name="advance_filter" multiple style="height:125px;">
        <option value="">-------  Advance Filter   -------</option>
         <!--<option value="student" <?=$one?>>Enrolled</option>  -->           
      </select>
    </td>
    <td align="left" colspan="4" >
    <select name="student_name" multiple style="height:240px;">
        <option value="">-------  Student Name   -------</option>
         <!--<option value="student" <?=$one?>>Enrolled</option>  -->           
      </select></td>  
    <td align="left" colspan="4" >
    <select name="selected_student" multiple style="height:240px;">
        <option value="">-------  Select Student  -------</option>
         <!--<option value="student" <?=$one?>>Enrolled</option>  -->           
      </select></td>
    <td align="left" valign="top" nowrap>
    <fieldset style="border: groove; border-width:1px; width: 100px; height:190px; align:left;">
		<legend>Send To</legend>
        <input type="checkbox" name="student">Student<BR>
        <input type="checkbox" name="student">Custody<BR>
        <input type="checkbox" name="student">Correspondance<BR>
        <input type="checkbox" name="student">Grandparent<BR>
        <input type="checkbox" name="student">Emergency Contact<BR>
        <input type="checkbox" name="student">Financial Resposibility<BR>
        <input type="checkbox" name="student">Pick Up<BR>
        <input type="checkbox" name="student">Staff<BR>
        <input type="checkbox" name="student">Carbon Self<BR>    
	</fieldset><BR>
     <select name="selected_student" multiple style="height:40px; width:160px;">       
         <option value="student" <?=$one?>>------  Admin  ------</option>
			<?
			$qry="SELECT a.StaffID,b.f_name,b.s_name FROM staff_rights a,staff_det b WHERE a.StaffID=b.slno  group by b.slno";
					
					$sqlF=execute($qry);
				while($rr=fetcharray($sqlF))
				{
					if($newFac==$rr[0])
						echo "<option value='$rr[0]' selected>$rr[1]</option>";
					else
						echo "<option value='$rr[0]'>$rr[1]</option>";
				}
			?>
		</select>       

    </td>   
</tr>
<tr>
	<td colspan="14">&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
	<td colspan="14">&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
	<td colspan="14">&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
	<td align="left" colspan="14">
<!------------------------------------------------------------------------------------------------------------------------------>


<!--

Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.

For licensing, see LICENSE.html or http://ckeditor.com/license

-->
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<!--<script type="text/javascript" src="../ckeditor.js"></script>-->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="sample.js" type="text/javascript"></script>
<link href="sample.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function showUser(str)
{
if (str=="")
{

  document.getElementById("txtHint").innerHTML="";

  return;

} 

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();
}

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;

    }

  }

xmlhttp.open("GET","getuser.php?q="+str,true);

xmlhttp.send();

}

</script>

<link href="http://focusedu.net/virtual.php" rel="contents" type="text/css" />
<p>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subject</strong> &nbsp;&nbsp;&nbsp;&nbsp;
<input type="text"  id="subject" name="subject" size="100" maxlength="70" max="70" />
<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<textarea cols="80" id="editor1" name="editor1" rows="10" ><?php echo $mail_boday; ?></textarea>
<script type="text/javascript">

			//<![CDATA[
CKEDITOR.replace( 'editor1',
{

						/*

						 * Style sheet for the contents

						 */

						contentsCss : '',



						/*

						 * Simple HTML5 doctype

						 */

						docType : '<!DOCTYPE HTML>',



						/*

						 * Core styles.

						 */

						coreStyles_bold	: { element : 'b' },

						coreStyles_italic	: { element : 'i' },

						coreStyles_underline	: { element : 'u'},

						coreStyles_strike	: { element : 'strike' },



						/*

						 * Font face

						 */

						// Define the way font elements will be applied to the document. The "font"

						// element will be used.

						font_style :

						{

								element		: 'font',

								attributes		: { 'face' : '#(family)' }

						},



						/*

						 * Font sizes.

						 */

						fontSize_sizes : 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',

						fontSize_style :

							{

								element		: 'font',

								attributes	: { 'size' : '#(size)' }

							} ,



						/*

						 * Font colors.

						 */

						colorButton_enableMore : true,



						colorButton_foreStyle :

							{

								element : 'font',

								attributes : { 'color' : '#(color)' }

							},



						colorButton_backStyle :

							{

								element : 'font',

								styles	: { 'background-color' : '#(color)' }

							},



						/*

						 * Styles combo.

						 */

						stylesSet :

								[

									{ name : 'Computer Code', element : 'code' },

									{ name : 'Keyboard Phrase', element : 'kbd' },

									{ name : 'Sample Text', element : 'samp' },

									{ name : 'Variable', element : 'var' },



									{ name : 'Deleted Text', element : 'del' },

									{ name : 'Inserted Text', element : 'ins' },



									{ name : 'Cited Work', element : 'cite' },

									{ name : 'Inline Quotation', element : 'q' }

								],



						on : { 'instanceReady' : configureHtmlOutput }

					});



/*

 * Adjust the behavior of the dataProcessor to avoid styles

 * and make it look like FCKeditor HTML output.

 */

function configureHtmlOutput( ev )

{

	var editor = ev.editor,

		dataProcessor = editor.dataProcessor,

		htmlFilter = dataProcessor && dataProcessor.htmlFilter;



	// Out self closing tags the HTML4 way, like <br>.

	dataProcessor.writer.selfClosingEnd = '>';



	// Make output formatting behave similar to FCKeditor

	var dtd = CKEDITOR.dtd;

	for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) )

	{

		dataProcessor.writer.setRules( e,

			{

				indent : true,

				breakBeforeOpen : true,

				breakAfterOpen : false,

				breakBeforeClose : !dtd[ e ][ '#' ],

				breakAfterClose : true

			});

	}



	// Output properties as attributes, not styles.

	htmlFilter.addRules(

		{

			elements :

			{

				$ : function( element )

				{

					// Output dimensions of images as width and height

					if ( element.name == 'img' )

					{

						var style = element.attributes.style;



						if ( style )

						{

							// Get the width from the style.

							var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style ),

								width = match && match[1];



							// Get the height from the style.

							match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );

							var height = match && match[1];



							if ( width )

							{

								element.attributes.style = element.attributes.style.replace( /(?:^|\s)width\s*:\s*(\d+)px;?/i , '' );

								element.attributes.width = width;

							}



							if ( height )

							{

								element.attributes.style = element.attributes.style.replace( /(?:^|\s)height\s*:\s*(\d+)px;?/i , '' );

								element.attributes.height = height;

							}

						}

					}



					// Output alignment of paragraphs using align

					if ( element.name == 'p' )

					{

						style = element.attributes.style;



						if ( style )

						{

							// Get the align from the style.

							match = /(?:^|\s)text-align\s*:\s*(\w*);/i.exec( style );

							var align = match && match[1];



							if ( align )

							{

								element.attributes.style = element.attributes.style.replace( /(?:^|\s)text-align\s*:\s*(\w*);?/i , '' );

								element.attributes.align = align;

							}

						}

					}



					if ( !element.attributes.style )

						delete element.attributes.style;



					return element;

				}

			},



			attributes :

				{

					style : function( value, element )

					{

						// Return #RGB for background and border colors

						return convertRGBToHex( value );

					}

				}

		} );

}


function convertRGBToHex( cssStyle )

{

	return cssStyle.replace( /(?:rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\))/gi, function( match, red, green, blue )

		{

			red = parseInt( red, 10 ).toString( 16 );

			green = parseInt( green, 10 ).toString( 16 );

			blue = parseInt( blue, 10 ).toString( 16 );

			var color = [red, green, blue] ;



			// Add padding zeros if the hex value is less than 0x10.

			for ( var i = 0 ; i < color.length ; i++ )

				color[i] = String( '0' + color[i] ).slice( -2 ) ;



			return '#' + color.join( '' ) ;

		 });

}

			//]]>
</script>


</td>
</tr>
</table>
<p align="center"><input type="submit" value="Send Mail" class="bgbutton" /></p>
</form>
</body>
</html>