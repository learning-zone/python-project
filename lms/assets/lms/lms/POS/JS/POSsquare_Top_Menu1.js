document.write('<STYLE type="text/css">');
document.write('#menuspan8 { position:absolute; width:700px; }');
document.write('#menutable8 { border-width: 0px; border-color: #797996; border-style:solid}');
document.write('td.menucell8 { padding:2px; padding-left:4px; padding-right:4px; background:#C1C1C1; border:1px inset #110011; text-align:LEFT; }');
document.write('#submenutable8 { background: #E0B3BE; border-width: 0px; border-color: #808080; border-style:inset}');
document.write('td.topcell8 {text-decoration:none; color:#211E1C; font-weight: 700; font-family: Verdana; font-size: 12px; font-style:normal; text-align:CENTER; }');
document.write('a.topitem8 {text-decoration:none; color:#211E1C; font-weight: 700; font-family: Verdana; font-size: 12px; font-style:normal; } ');
document.write('a.topitem8:hover {text-decoration:none; color:#825147; font-weight: 700; font-family: Verdana; font-size: 12px; font-style:normal;}');
document.write('a.subitem8 {text-decoration:none; color:#4C3933; font-weight: 700; font-family: Verdana; font-size: 12px; font-style:normal; } ');
document.write('a.subitem8:hover {text-decoration:none; color:#7C312A; font-weight: 700; font-family: Verdana; font-size: 12px; font-style:normal; }');
document.write('P.MN8 {margin:0px; color:#211E1C; font-weight: 700; font-family: Verdana; font-size:12px; font-style:normal;  }');
document.write('P.SMN8 {text-decoration:none; color:#4C3933; font-weight: 700; font-family: Verdana; font-size:12px; font-style:normal; margin:0px; }');
document.write('#submenu8_0 { position:absolute; left:0px; top:22px; visibility:hidden; }');
document.write('#submenu8_1 { position:absolute; left:280px; top:22px; visibility:hidden; }');
document.write('#submenu8_2 { position:absolute; left:420px; top:22px; visibility:hidden; }');
document.write('#submenu8_3 { position:absolute; left:560px; top:22px; visibility:hidden; }');
document.write('</style>');
var thisbrowser8
var hidetimer8 = null;
if(document.layers){ thisbrowser8='NN4'; }
if(document.all){ thisbrowser8='IE'; }
if(!document.all && document.getElementById){ thisbrowser8='NN6'; }
function showmenu8(menuname)
{
if(thisbrowser8=='NN4') document.layers[menuname].visibility = 'visible';
if(thisbrowser8=='IE') document.all[menuname].style.visibility = 'visible';
if(thisbrowser8=='NN6') document.getElementById(menuname).style.visibility = 'visible';
if(hidetimer8) clearTimeout(hidetimer8);}
function timermenu8()
{
if(hidetimer8) clearTimeout(hidetimer8);hidetimer8 = setTimeout("hideall8();",1000);
}
function hidemenu8(menuname)
{
if(thisbrowser8=='NN4') document.layers[menuname].visibility = 'hidden';
if(thisbrowser8=='IE') document.all[menuname].style.visibility = 'hidden';
if(thisbrowser8=='NN6') document.getElementById(menuname).style.visibility = 'hidden';
}
function hilite8(menuitem) 
{
if(typeof(currentpage8)!='undefined' && menuitem==currentpage8) return;
if(thisbrowser8=='IE') document.all[menuitem].style.backgroundColor = '#D6A6A6';
if(thisbrowser8=='NN6') document.getElementById(menuitem).style.backgroundColor = '#D6A6A6';
if(hidetimer8) clearTimeout(hidetimer8);}
function unhilite8(menuitem) 
{
if(typeof(currentpage8)!='undefined' && menuitem==currentpage8) return;
if(thisbrowser8=='IE') document.all[menuitem].style.backgroundColor = '#C1C1C1';
if(thisbrowser8=='NN6') document.getElementById(menuitem).style. backgroundColor = '#C1C1C1';
if(hidetimer8) clearTimeout(hidetimer8);hidetimer8 = setTimeout("hideall8();",1000);
}
function hideall8()
{
hidemenu8('submenu8_0');
hidemenu8('submenu8_1');
hidemenu8('submenu8_2');
hidemenu8('submenu8_3');
}
function openmenu8(menuname)
{
showmenu8(menuname);
if(menuname!='submenu8_0') hidemenu8('submenu8_0');
if(menuname!='submenu8_1') hidemenu8('submenu8_1');
if(menuname!='submenu8_2') hidemenu8('submenu8_2');
if(menuname!='submenu8_3') hidemenu8('submenu8_3');
}
document.write('<table width=700 cellspacing=0 border=0 cellpadding=0>');
document.write('<tr><td align=left valign=top>');
document.write('<span id="menuspan8">');
document.write('<table width=700 id="menutable8" cellspacing=0 cellpadding=2 >');
document.write('<tr>');
document.write('<td align=center background="l1.gif">&nbsp;</td>');
document.write('<td class="topcell8" align="CENTER" width=140 height=20 background="b1.gif" onMouseOver="openmenu8(\'submenu8_0\')" onMouseOut="timermenu8();">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="#" target="_self" title="" class="topitem8">Products/Services</a>');
document.write('</td><td><p class="SMN8"><font face="webdings" color=#0C0B0A></font></p></td></tr></table>');
document.write('</td>');
document.write('<td align=center background="s1.gif">&nbsp;</td>');
document.write('<td class="topcell8" align="CENTER" width=140 height=20 background="b1.gif" onMouseOver="hideall8()">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="generateReceipt.php" target="_self" title="" class="topitem8">Receipts</a>');
document.write('</td><td><p class="SMN8">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('<td align=center background="s1.gif">&nbsp;</td>');
document.write('<td class="topcell8" align="CENTER" width=140 height=20 background="b1.gif" onMouseOver="openmenu8(\'submenu8_1\')" onMouseOut="timermenu8();">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="#" target="_self" title="" class="topitem8">Settings</a>');
document.write('</td><td><p class="SMN8"><font face="webdings" color=#0C0B0A></font></p></td></tr></table>');
document.write('</td>');
document.write('<td align=center background="s1.gif">&nbsp;</td>');
document.write('<td class="topcell8" align="CENTER" width=140 height=20 background="b1.gif" onMouseOver="openmenu8(\'submenu8_2\')" onMouseOut="timermenu8();">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="#" target="_self" title="" class="topitem8">Inventory</a>');
document.write('</td><td><p class="SMN8"><font face="webdings" color=#0C0B0A></font></p></td></tr></table>');
document.write('</td>');
document.write('<td align=center background="s1.gif">&nbsp;</td>');
document.write('<td class="topcell8" align="CENTER" width=140 height=20 background="b1.gif" onMouseOver="openmenu8(\'submenu8_3\')" onMouseOut="timermenu8();">')
document.write('<table cellspacing=0 cellpadding=0 border=0><tr><td>');
document.write('<a href="#" target="_self" title="" class="topitem8">Staff</a>');
document.write('</td><td><p class="SMN8"><font face="webdings" color=#0C0B0A></font></p></td></tr></table>');
document.write('</td>');
document.write('<td align=center background="r1.gif">&nbsp;</td>');
document.write('</tr>');
document.write('</table><p>');
document.write('<div id="submenu8_0">');
document.write('<table id="submenutable8" width=150 cellspacing=0>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell8" height=20 id="s8_0_0" onMouseOver="hilite8(\'s8_0_0\')" onMouseOut="unhilite8(\'s8_0_0\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="addProducts.php" target="_self" title="" class="subitem8" >Add New</a>')
;document.write('</td><td><p class="SMN8">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell8" height=20 id="s8_0_1" onMouseOver="hilite8(\'s8_0_1\')" onMouseOut="unhilite8(\'s8_0_1\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="editProducts.php" target="_self" title="" class="subitem8" >Edit/Delete</a>')
;document.write('</td><td><p class="SMN8">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell8" height=20 id="s8_0_2" onMouseOver="hilite8(\'s8_0_2\')" onMouseOut="unhilite8(\'s8_0_2\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="addInventory.php" target="_self" title="" class="subitem8" >Add Inventory</a>')
;document.write('</td><td><p class="SMN8">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('</table></div>');
document.write('<div id="submenu8_1">');
document.write('<table id="submenutable8" width=150 cellspacing=0>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell8" height=20 id="s8_1_0" onMouseOver="hilite8(\'s8_1_0\')" onMouseOut="unhilite8(\'s8_1_0\')">');

document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell8" height=20 id="s8_1_1" onMouseOver="hilite8(\'s8_1_1\')" onMouseOut="unhilite8(\'s8_1_1\')">');

document.write('</td>');
document.write('</tr>');
document.write('</table></div>');
document.write('<div id="submenu8_2">');
document.write('<table id="submenutable8" width=150 cellspacing=0>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell8" height=20 id="s8_2_0" onMouseOver="hilite8(\'s8_2_0\')" onMouseOut="unhilite8(\'s8_2_0\')">');

document.write('</td>');
document.write('</tr>');
document.write('</table></div>');
document.write('<div id="submenu8_3">');
document.write('<table id="submenutable8" width=150 cellspacing=0>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell8" height=20 id="s8_3_0" onMouseOver="hilite8(\'s8_3_0\')" onMouseOut="unhilite8(\'s8_3_0\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="addStaff.php" target="_self" title="" class="subitem8" >Add</a>')
;document.write('</td><td><p class="SMN8">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('<tr>');
document.write('<td align="LEFT" class="menucell8" height=20 id="s8_3_2" onMouseOver="hilite8(\'s8_3_2\')" onMouseOut="unhilite8(\'s8_3_2\')">');
document.write('<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td width="90%" align="LEFT">');
document.write('<a href="staffReports.php" target="_self" title="" class="subitem8" >Reports</a>')
;document.write('</td><td><p class="SMN8">&nbsp;</p></td></tr></table>');
document.write('</td>');
document.write('</tr>');
document.write('</table></div>');
document.write('</span></td></tr></table>jjjj');
