<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="content-type" />
	<script type="text/javascript" src="../ckeditor.js"></script>
	<script src="sample.js" type="text/javascript"></script>
	<link href="sample.css" rel="stylesheet" type="text/css" />
</head>
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
  <link href="../../../mistStyle.css" rel="stylesheet" type="text/css" />
<style >
body.samplebody {
	background-image:url('../../../bgy.png');
	background-repeat:repeat-x,y;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	color:#FFF;
}


</style>

<!--content-->


<?php
session_start();
include("../../../db.php");

	$accyeardet=$_SESSION['AcademicYear'];
	$unit=$_REQUEST['unit'];
	$title_id=$_REQUEST['title_id'];
	$filename=$_REQUEST['filename'];
	$subject=$_REQUEST['subject'];
	$uploadedfile=$_POST['uploadedfile'];
	$filetype=$_POST['filetype'];
	$priority=$_POST['priority'];
	$title=$_POST['title'];
	$type=$_POST['type'];
	$description1=$_POST['description1'];
	$summary=$_POST['summary'];
	$sub_title=$_POST['sub_title'];
	$action=$_REQUEST['action'];
	$id=$_REQUEST['id'];
if(isset($_POST['save']))
{

$sql2=mysql_query("select * from lms_title where id='$title_id'");
while($r=mysql_fetch_array($sql2))
{
	
	
	$target_path = "lmsintroduction/";
	$fext=basename($_FILES['uploadedfile']['name']);
	$fext1=explode(".",$fext);
	$fexn=$newname.".".$fext1[1];
	$target_path = $target_path.$fext;
	
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
	$imagepath = $target_path;
	else
	$imagepath ='';
	
		if($action=='mod')
		{
			
			$sql33="update lms_lesson_master set `description`='$description1',`sub_title`='".addslashes($sub_title)."',`summary`='".addslashes($summary)."',img_source='$imagepath',file_name='".addslashes($filename)."',file_type='$filetype' where id='$id'";
		
			mysql_query($sql33);
		}
		else
		{
			
			$sql33="INSERT INTO `lms_lesson_master` (`title_id`, `sub`, `unit_id`, `acc_year`, `sub_title`, `description`, `file_name`, `file_type`, `img_source`, `status`,`summary`) VALUES ('$title_id', '$subject', '$unit', '$accyeardet', '".addslashes($sub_title)."', '$description1', '".addslashes($filename)."', '$filetype', '$imagepath',1,'".addslashes($summary)."')";
			
			mysql_query($sql33);
			$idval=mysql_fetch_row(mysql_query("select max(id) from lms_lesson_master where acc_year='$accyeardet' and title_id='$title_id' and sub='$subject'  and unit_id='$unit' and status=1"));
			
			$action='mod';
			$id=$idval[0];
			
			
		}

	

	
	?>
<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
<?php
		}
}
?>

<!--content end-->

<body class="samplebody">
&nbsp;&nbsp;&nbsp;&nbsp;
<a href= "output_html.php?unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>&action=add"><input type='button' align='center' class='bgbutton' value='Add New'></a>
<br>
<br>
<form class="new1" action="output_html.php" method="post" ENCTYPE="multipart/form-data">
<?php

echo "
<input type='hidden' name='id' value='$id'>
<input type='hidden' name='title_id' value='$title_id'>
<input type='hidden' name='subject' value='$subject'>
<input type='hidden' name='titlename' value='$title_id'>
<input type='hidden' name='unit' value='$unit'>";


?>

<table align="center" width="90%" border="1" cellspacing="0" cellpadding="5">
<tr>
    <td align="center" class="head" colspan="2"> Lesson Master</td>
</tr> 
 <?php

echo "<input type='hidden' name='action' value='$action'>";
  
if($action=='mod')
{
	
	$Sql67=mysql_query("select * from lms_lesson_master where id='$id'");
	while($rk=mysql_fetch_array($Sql67))
	{
		$description2=$rk['description'];
		$summary=$rk['summary'];
		$sub_title2=$rk['sub_title'];
		$filename2=$rk['file_name'];
		$filetype2=$rk['file_type'];
		$image1[0]=$rk['img_source'];
	}
}
?>
<tr>
	<td align="left">&nbsp;&nbsp;Title</td>
	
   <td>&nbsp;&nbsp;
	<input type='text' name='sub_title' size='50%' value='<?php echo $sub_title2 ?>'/>
</td>
</tr>
<tr>
    <td align="left">&nbsp;&nbsp;Add Content</td>
    <td >

	<!-- This <div> holds alert messages to be display in the sample page. -->
	

	

   
<textarea cols="80" id="description1" name="description1" rows="10" ><?php echo $description2; ?></textarea>
 </td>
</tr>
<tr>
	<td align="left">Summary</td>
	<td><textarea cols="80"  rows="2" id="summary" name="summary"><?php echo $summary;  ?></textarea>
</td></tr>
<tr>
	<td align="left"  rowspan="2">&nbsp;&nbsp;Upload Files</td>
	<td>&nbsp;&nbsp;File Name&nbsp;&nbsp;
	<input type="text" name='filename' size="40%" value="<?php echo $filename2; ?>"/>		  &nbsp;&nbsp;&nbsp;&nbsp;
    File Type&nbsp;&nbsp;
		<select name="filetype">
		<option>Select  </option>
	<?php
	echo $sql3=execute("select id, file_name from lms_file_type");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($filetype2==$r3[0])
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
	?>
</select>
</td>
</tr>
<tr>


<td><input type='FILE' name='uploadedfile' id='uploadedfile' size='15' value=""/></td></tr>

</table>



			<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'description1',
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


/**
* Convert a CSS rgb(R, G, B) color back to #RRGGBB format.
* @param Css style string (can include more than one color
* @return Converted css style.
*/
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
		
		<p>
			<!--<input type="submit" value="Save" class="bgbutton" />&nbsp;&nbsp;&nbsp;&nbsp;      
    <a href="modifymail.php" ><input type="button" name="Modify" value="Modify" class="bgbutton" /></a>-->
 <div align="center">
<input type="submit" name="save" value="Update" class="bgbutton"></div>
<br>
<?
	$s=1;
	
	 $SqlUpdate=mysql_query("select * from lms_lesson_master where acc_year='$accyeardet' and       title_id='$title_id' and sub='$subject'  and unit_id='$unit' and status=1");

	if(mysql_num_rows($SqlUpdate)>0)
	{
?>

  <table border="1" align='center' width='90%' >
  <tr>
    <td class="head" colspan="5" align="center">Modify Lesson Master</td>
    </tr>
     <tr>
    <td class="rowpic" align="center">Sl No.</td>
    <td class="rowpic" align="center">Title</td>
    <td class="rowpic" align="center">Modify</td>
    <td class="rowpic" align="center">Delete</td>
	<td class="rowpic" align="center">File Name</td>
  </tr>

<?php	
while($r=mysql_fetch_array($SqlUpdate))	
{
	?>
    <tr>
    <td align="center" width="10%"><?=$s?> </td>
    <td>&nbsp;&nbsp;&nbsp;<?=$r[sub_title]?> </td>
    <td align="center"><a href= "output_html.php?unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>&action=mod&id=<?=$r[id]?>"><input type='button' align='center' class='bgbutton' value='Modify'></a>
    </td>
    <td align="center"><a href= "output_html1.php?unit=<?=$unit?>&title_id=<?=$title_id?>&subject=<?=$subject?>&id=<?=$r[id]?>&delete=1"><input type='button' align='center' class='bgbutton' value='Delete'></a>
    </td>
    <?
		
		$master4=$r[img_source];
		$img_path=explode("/", $master4);
		$img_path=$img_path[1]; 

	?>
	 <td align="center"><?=$img_path?></td>
    </tr>
    <?php
	$s++;
}
}//IF CONDITION CLOSE
?>

<br />		




<!-- <div align="center">
 <?
    //if($image1[0]!='')
    //{
		?>
		    <iframe src="/sis/renew/lesson_plan/ckeditor/_samples/<?=$image1[0]?>" style="width:900px; height:600px;" frameborder="0"></iframe>
        <?
    //}
?>
</div>-->
</table>
</form>
</body>
</html>
