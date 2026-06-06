/*
   Deluxe Menu Data File
   Created by Deluxe Tuner v3.15
   http://deluxe-menu.com
*/


// -- Deluxe Tuner Style Names
var tstylesNames=[];
var tXPStylesNames=[];
// -- End of Deluxe Tuner Style Names

//--- Common
var tlevelDX=20;
var texpanded=0;
var texpandItemClick=1;
var tcloseExpanded=1;
var tcloseExpandedXP=1;
var ttoggleMode=0;
var tnoWrap=1;
var titemTarget="_self";
var titemCursor="pointer";
var statusString="link";
var tblankImage="deluxe-tree.files/blank image filename";
var tpathPrefix_img="";
var tpathPrefix_link="";

//--- Dimensions
var tmenuWidth="180px";
var tmenuHeight="auto";

//--- Positioning
var tabsolute=0;
var tleft="0px";
var ttop="0px";

//--- Font
var tfontStyle="normal 11px Trebuchet MS, verdana, Arial";
var tfontColor=["#0000FF","#00FF40"];
var tfontDecoration=["none","none"];
var tfontColorDisabled="#ACACAC";
var tpressedFontColor="#AA0000";

//--- Appearance
var tmenuBackColor="#C0C0C0";
var tmenuBackImage="";
var tmenuBorderColor="#804000";
var tmenuBorderWidth=1;
var tmenuBorderStyle="solid";

//--- Item Appearance
var titemAlign="left";
var titemHeight=30;
var titemBackColor=["#FFFF80","#4792E6"];
var titemBackImage=["",""];

//--- Icons & Buttons
var ticonWidth=16;
var ticonHeight=16;
var ticonAlign="left";
var texpandBtn=["","",""];
var texpandBtnW=9;
var texpandBtnH=9;
var texpandBtnAlign="left";

//--- Lines
var tpoints=0;
var tpointsImage="";
var tpointsVImage="";
var tpointsCImage="";
var tpointsBImage="";

//--- Floatable Menu
var tfloatable=0;
var tfloatIterations=6;
var tfloatableX=1;
var tfloatableY=1;

//--- Movable Menu
var tmoveable=0;
var tmoveHeight=12;
var tmoveColor="#AA0000";
var tmoveImage="";

//--- XP-Style
var tXPStyle=0;
var tXPIterations=5;
var tXPBorderWidth=1;
var tXPBorderColor="#AFAFAF";
var tXPAlign="left";
var tXPTitleBackColor="#265BCC";
var tXPTitleBackImg="";
var tXPTitleLeft="";
var tXPTitleLeftWidth=4;
var tXPIconWidth=30;
var tXPIconHeight=32;
var tXPMenuSpace=10;
var tXPExpandBtn=["","","",""];
var tXPBtnWidth=25;
var tXPBtnHeight=25;
var tXPFilter=1;

//--- Advanced
var tdynamic=0;
var tajax=0;

//--- State Saving
var tsaveState=0;
var tsavePrefix="menu1";

var tstyles = [
];
var tXPStyles = [
];

var tmenuItems = [

    ["Product Sale","", "", "", "", "", "", "", "", "", ],
        ["|Add Customer","", "", "", "", "", "", "", "", "", ],
    ["Product Enquiry","", "", "", "", "", "", "", "", "", ],
        ["|Add Customer","", "", "", "", "", "", "", "", "", ],
    ["Potential Customet","", "", "", "", "", "", "", "", "", ],
        ["|Add customer","", "", "", "", "", "", "", "", "", ],
    ["Reports","", "", "", "", "", "", "", "", "", ],
        ["|Sales Reports","", "", "", "", "", "", "", "", "", ],
        ["|Enquiry Reports","", "", "", "", "", "", "", "", "", ],
        ["|Potential Customer Reports","", "", "", "", "", "", "", "", "", ],
];

dtree_init();