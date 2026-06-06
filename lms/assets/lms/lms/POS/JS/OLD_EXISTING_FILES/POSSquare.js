document.write('<STYLE type="text/css">');
document.write('#menuspan32 { position:absolute; width:750px; }');
document.write('#menutable32 { border-width: 0px; border-color: #797996; border-style:solid}');
document.write('td.menucell32 { padding:2px; padding-left:4px; padding-right:4px; background-image: url(sm3.gif); border:1px inset #110011; text-align:LEFT; }');
document.write('#submenutable32 { background: #E0B3BE; border-width: 0px; border-color: #808080; border-style:inset}');
document.write('td.topcell32 {text-decoration:none; color:#211E1C; font-weight: 400; font-family: Verdana; font-size: 13px; font-style:normal; text-align:CENTER; }');
document.write('a.topitem32 {text-decoration:none; color:#211E1C; font-weight: 400; font-family: Verdana; font-size: 13px; font-style:normal; } ');
document.write('a.topitem32:hover {text-decoration:none; color:#825147; font-weight: 400; font-family: Verdana; font-size: 13px; font-style:normal;}');
document.write('a.subitem32 {text-decoration:none; color:#4C3933; font-weight: 400; font-family: Verdana; font-size: 13px; font-style:normal; } ');
document.write('a.subitem32:hover {text-decoration:none; color:#7C312A; font-weight: 400; font-family: Verdana; font-size: 13px; font-style:normal; }');
document.write('P.MN32 {margin:0px; color:#211E1C; font-weight: 400; font-family: Verdana; font-size:13px; font-style:normal;  }');
document.write('P.SMN32 {text-decoration:none; color:#4C3933; font-weight: 400; font-family: Verdana; font-size:13px; font-style:normal; margin:0px; }');
document.write('#submenu32_0 { position:absolute; left:0px; top:21px; visibility:hidden; }');
document.write('#submenu32_1 { position:absolute; left:300px; top:21px; visibility:hidden; }');
document.write('#submenu32_2 { position:absolute; left:450px; top:21px; visibility:hidden; }');
document.write('#submenu32_3 { position:absolute; left:600px; top:21px; visibility:hidden; }');
document.write('</style>');
var thisbrowser32
var hidetimer32 = null;
if(document.layers){ thisbrowser32='NN4'; }
if(document.all){ thisbrowser32='IE'; }
if(!document.all && document.getElementById){ thisbrowser32='NN6'; }
function showmenu32(menuname)
{
if(thisbrowser32=='NN4') document.layers[menuname].visibility = 'visible';
if(thisbrowser32=='IE') document.all[menuname].style.visibility = 'visible';
if(thisbrowser32=='NN6') document.getElementById(menuname).style.visibility = 'visible';
if(hidetimer32) clearTimeout(hidetimer32);}
function timermenu32()
{
if(hidetimer32) clearTimeout(hidetimer32);hidetimer32 = setTimeout("hideall32();",1000);
}
function hidemenu32(menuname)
{
if(thisbrowser32=='NN4') document.layers[menuname].visibility = 'hidden';
if(thisbrowser32=='IE') document.all[menuname].style.visibility = 'hidden';
if(thisbrowser32=='NN6') document.getElementById(menuname).style.visibility = 'hidden';
}
function hilite32(menuitem) 
{
if(typeof(currentpage32)!='undefined' && menuitem==currentpage32) return;
if(thisbrowser32=='IE') document.all[menuitem].style.backgroundColor = '#D6A6A6';
if(thisbrowser32=='NN6') document.getElementById(menuitem).style.backgroundColor = '#D6A6A6';
if(hidetimer32) clearTimeout(hidetimer32);}
function unhilite32(menuitem) 
{
if(typeof(currentpage32)!='undefined' && menuitem==currentpage32) return;
if(thisbrowser32=='IE') document.all[menuitem].style.backgroundColor = '#C1C1C1';
if(thisbrowser32=='NN6') document.getElementById(menuitem).style. backgroundColor = '#C1C1C1';
if(hidetimer32) clearTimeout(hidetimer32);hidetimer32 = setTimeout("hideall32();",1000);
}
function hideall32()
{
hidemenu32('submenu32_0');
hidemenu32('submenu32_1');
hidemenu32('submenu32_2');
hidemenu32('submenu32_3');
}
function openmenu32(menuname)
{
showmenu32(menuname);
if(menuname!='submenu32_0') hidemenu32('submenu32_0');
if(menuname!='submenu32_1') hidemenu32('submenu32_1');
if(menuname!='submenu32_2') hidemenu32('submenu32_2');
if(menuname!='submenu32_3') hidemenu32('submenu32_3');
}
document.write('<table width=750 cellspacing=0 border=0 cellpadding=0>');
document.write('<tr><td align=left valign=top>');
document.write('<span id="menuspan32">');
document.write('<table width=750 id="menutable32" cellspacing=0 cellpadding=2 >');
document.write('<tr>');
document.write('<td align=center background="l2.gif">&nbsp;</td>');
document.write('<td class="topcell32" align="CENTER" width=150 height=20 background="b2.gif" onMouseOver="openmenu32(\'submenu32_0\')" onMouseOut="timermenu32();">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="#" target="_self" title="" class="topitem32">Products/Services</a>');
document.write('</td></tr></table>');
document.write('</td>');
document.write('<td align=center background="s2.gif">&nbsp;</td>');
document.write('<td class="topcell32" align="CENTER" width=150 height=20 background="b2.gif" onMouseOver="hideall32()">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="generateReceipt.php" target="_self" title="" class="topitem32">Receipts</a>');
document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('<td align=center background="s2.gif">&nbsp;</td>');
document.write('<td class="topcell32" align="CENTER" width=150 height=20 background="b2.gif" onMouseOver="openmenu32(\'submenu32_1\')" onMouseOut="timermenu32();">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="#" target="_self" title="" class="topitem32">Settings</a>');
document.write('</td></tr></table>');
document.write('</td>');
document.write('<td align=center background="s2.gif">&nbsp;</td>');
document.write('<td class="topcell32" align="CENTER" width=150 height=20 background="b2.gif" onMouseOver="openmenu32(\'submenu32_2\')" onMouseOut="timermenu32();">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="#" target="_self" title="" class="topitem32">Inventory</a>');
document.write('</td></tr></table>');
document.write('</td>');
document.write('<td align=center background="s2.gif">&nbsp;</td>');
document.write('<td class="topcell32" align="CENTER" width=150 height=20 background="b2.gif" onMouseOver="openmenu32(\'submenu32_3\')" onMouseOut="timermenu32();">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="#" target="_self" title="" class="topitem32">Staff</a>');
document.write('</td></tr></table>');
document.write('</td>');
document.write('<td align=center background="r2.gif">&nbsp;</td>');
document.write('</tr>');
document.write('</table><p>');
document.write('<div id="submenu32_0">');
document.write('<table id="submenutable32" width=150 cellspacing=0>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_0_0" onMouseOver="hilite32(\'s32_0_0\')" onMouseOut="unhilite32(\'s32_0_0\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="addProducts.php" target="_self" title="" class="subitem32" >Add New</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_0_1" onMouseOver="hilite32(\'s32_0_1\')" onMouseOut="unhilite32(\'s32_0_1\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="editProducts.php" target="_self" title="" class="subitem32" >Edit/Delete</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_0_2" onMouseOver="hilite32(\'s32_0_2\')" onMouseOut="unhilite32(\'s32_0_2\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="addInventory.php" target="_self" title="" class="subitem32" >Add Inventory</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('</table></div>');
document.write('<div id="submenu32_1">');
document.write('<table id="submenutable32" width=150 cellspacing=0>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_1_0" onMouseOver="hilite32(\'s32_1_0\')" onMouseOut="unhilite32(\'s32_1_0\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="settings.php" target="_self" title="" class="subitem32" >Service Tax</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('</table></div>');
document.write('<div id="submenu32_2">');
document.write('<table id="submenutable32" width=150 cellspacing=0>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_2_0" onMouseOver="hilite32(\'s32_2_0\')" onMouseOut="unhilite32(\'s32_2_0\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="inventoryReports.php" target="_self" title="" class="subitem32" >Products/Services Report</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('</table></div>');
document.write('<div id="submenu32_3">');
document.write('<table id="submenutable32" width=150 cellspacing=0>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_3_0" onMouseOver="hilite32(\'s32_3_0\')" onMouseOut="unhilite32(\'s32_3_0\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="addStaff.php" target="_self" title="" class="subitem32" >Add</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_3_1" onMouseOver="hilite32(\'s32_3_1\')" onMouseOut="unhilite32(\'s32_3_1\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="editStaff.php" target="_self" title="" class="subitem32" >Edit</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_3_2" onMouseOver="hilite32(\'s32_3_2\')" onMouseOut="unhilite32(\'s32_3_2\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="deleteStaff.php" target="_self" title="" class="subitem32" >Delete</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell32" height=20 id="s32_3_3" onMouseOver="hilite32(\'s32_3_3\')" onMouseOut="unhilite32(\'s32_3_3\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="staffReports.php" target="_self" title="" class="subitem32" >Reports</a>')
;document.write('</td><td><p class="SMN32">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('</table></div>');
document.write('</span></td></tr></table>');
