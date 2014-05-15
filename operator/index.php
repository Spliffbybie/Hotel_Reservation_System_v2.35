<?
//
// RICS <info@rics.ru>
// Created on: <06-Nov-2001 15:28:37 bf>
//
// This source file is part of HRS software.
// Copyright (C) 1999-2001 RICS systems.
//
// This program is licence software; 
//  The licensee may modify or change this software program
// to suit licensee's needs, at licensee's own risk.
// The licensee may modify the source code for licensee's own use.
// However, the modified source code must not be resold or distributed. 

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  License for more details.
// RICS Ltd.,St.Chernigovskaya 8., Saint-Petersburg, Russia.tel./fax:
// +7 812 298 3611 E-mail: russia@rics.ru
//

	include "../auth.php";
	include "./userauth.php";

?>
<!-- header //-->
<html>
<head>
  
<title>Rics Hotel Reservation System </title>

<META content="text/html; charset=windows-1251" http-equiv=Content-Type>
<META content="Hotel Reservation System." name=description>
<META  content="hotels, reservation system" name=keywords>

</head>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0033)http://www.adlen.ru/bmv/faq.phtml -->
<HTML><HEAD><TITLE>Hote reservation system - Administration Panel </TITLE>
<META content="MSHTML 5.50.4522.1800" name=GENERATOR>
<META content="" name=Author>
<META content="" name=Keywords>
<META content="" name=Description>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<LINK href="themes/style.css" type=text/css rel=StyleSheet>
<LINK href="themes/top.css" type=text/css rel=StyleSheet>
<LINK href="themes/menu.css" type=text/css rel=StyleSheet>


</HEAD>
<BODY aLink=#660066 link=#000000 bgColor=#009999>
<TABLE cellSpacing=1 cellPadding=0 width="100%" bgColor=#c0c0c0 border=1>
  <TBODY>
  <TR>
    <TD vAlign=top colSpan=4>
	<!--таблица горизонтальных строк по всей ширине----------------------------------------------------------------------->
      <TABLE cellSpacing=0 cellPadding=0 width="100%" bgColor=#c0c0c0 border=0>
	<!--синяя шапка окна-------------------------------------------------------------------------------------------------->
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" bgColor=#c0c0c0  border=0>
              <TBODY>
              <TR bgColor=navy>
                <TD width=16>&nbsp;</TD>
                <TD><FONT class=a1 color=#ffffff>&nbsp;<B>Hotel - Administration Panel </B></FONT></TD>
                <TD width=48><A href="javascript:window.close();"><IMG height=14 src="themes/sysmenu.jpg" width=48                   border=0></A></TD>
              </TR></TBODY></TABLE>
	   </TD></TR>
	   <!--строка серого верхнего меню--------------------------------------------------------------------------------------->
        <TR>
          <TD align=center>
            <TABLE cellSpacing=0 cellPadding=0 bgColor=#c0c0c0 border=0  width=815 align=center>
              <!-- список пунктов верхнего меню --> <TBODY> 
              <TR> 
                <TD height=5 colspan=9></TD>
              </TR>
              <TR>
		<TD width="80" align=center valign=top>&nbsp;<a href=manager/index.php  class=top><? print TEXT_MANAGER_SECTION ?></a>&nbsp;</TD>
		<TD width="100"align=center valign=top>&nbsp;<a href=corporates.php  class=top><? print TEXT_CORPORATE_PARTNERS ?></a>&nbsp;</TD>                
	        <TD width="80" align=center valign=top>&nbsp;<a href=reservations.php class=top ><? print TEXT_CHECK_RESERVATION ?></a>&nbsp;</TD>
                <TD width="80" align=center valign=top>&nbsp;<a href=availability.php?is_corp=0 class=top ><? print TEXT_SET_AVAILABILITY ?></a>&nbsp;</TD>
                <TD width="80" align=center valign=top>&nbsp;<a href=rates_public.php  class=top><? print TEXT_SET_RATES ?></a>&nbsp;</TD>
                <TD width="80" align=center valign=top>&nbsp;<a href=rates_special.php  class=top><? print TEXT_ADD_SPECIAL_OFFER ?></a>&nbsp;</TD>
                <TD width="80" align=center valign=top>&nbsp;<a href=occupancy.php  class=top><? print TEXT_MAX_OCCUPANCY  ?></a>&nbsp;</TD>
		<TD width="90" align=center valign=top>&nbsp;<a href=inventory.php  class=top><? print TEXT_ROOM_INVENTORY ?></a>&nbsp;</TD>
                <TD width="60" align=center valign=top>&nbsp;<a href=query.php class=top><? print TEXT_OTCHET ?></a></TD>
		<TD width="50" align=center valign=top>&nbsp;<a href=https://www.safeweb.com/o/_:http://www.hrs.ricssoft.co.uk/faqadmin.htm  class=top>F.A.Q</a>.</TD>
                <TD width="50" align=center valign=top>&nbsp;<a href=logout.php  class=top><? print TEXT_LOGOUT ?></a></TD>


              </TR>
              </TBODY> 
            </TABLE>
          </TD></TR>
        <TR>
          <TD  style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px"  border=1 cellpadding="0" cellspacing="0">
            <HR>
          </TD></TR>
        <TR>
          <TD>
            <TABLE cellSpacing=5 borderColorDark=gray cellPadding=2 width="100%"  bgColor=#c0c0c0 borderColorLight=silver border=0>
              <TBODY>
              <TR>
                <TD  
                style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
                bgColor=#ffe0ad cellpadding="0" cellspacing="0" width=200>



<TABLE cellSpacing=5 width=200>
  <TBODY>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" ><a href="manager/index.php" class=menu><? print TEXT_MANAGER_SECTION ?></a></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" ><a href="reservations.php" class=menu><? print TEXT_CHECK_RESERVATION ?></a> </TD>
  </TR>
  <TR>
    <TD  noWrap><b><? print TEXT_SET_RATES ?></b></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" ><a href="rates_public.php" class=menu>&nbsp;&nbsp;&nbsp;<? print TEXT_PUBLIC ?></a></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" ><a href="rates_corporate.php" class=menu>&nbsp;&nbsp;&nbsp;<? print TEXT_PARTNERS ?></a></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" ><a href="corporate.php" class=menu><? print TEXT_CORPORATE_PARTNERS ?></a></TD>
  </TR>
  <TR>
    <TD ><b><? print TEXT_SET_AVAILABILITY ?></b></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" ><a href="availability.php?is_corp=0" class=menu>&nbsp;&nbsp;&nbsp;<? print TEXT_PUBLIC ?> 
      </a></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" noWrap><a href="availability.php?is_corp=1" class=menu>&nbsp;&nbsp;&nbsp;<? print TEXT_PARTNERS ?></a></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" noWrap><a href="rates_special.php" class=menu><? print TEXT_ADD_SPECIAL_OFFER ?></a> </TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" noWrap><a href="inventory.php" class=menu><? print TEXT_ROOM_INVENTORY ?></a></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" ><a href="occupancy.php" class=menu><? print TEXT_MAX_OCCUPANCY  ?></a></TD>
  </TR>
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" noWrap><a href="query.php" class=menu><? print TEXT_OTCHET ?></a></TD>
  </TR>	
  <TR>
    <TD onmouseover="this.style.backgroundColor='maroon'" 
    onmouseout="this.style.backgroundColor='FFE0AD'" noWrap><a href="logout.php" class=menu><? print TEXT_LOGOUT ?></a></TD>
  </TR>
  </TR></TBODY></TABLE>
                           
                 
  </TD>
  <TD   style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
               width="100%" bgColor=#FFE0AD border="0" cellpadding="0" 
                cellspacing="0" align=center>
		


   </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>


   <TR valign=bottom>
   <TD class=a1 noWrap bgColor=#c0c0c0 height=16><B>Operator Name : <? print $user ?> </B></TD>
   <TD class=a1 width=200 bgColor=#c0c0c0 height=16 align=center><a href=mailto:hotel@rics.ru><B>Support</B></A></TD>	  
   <TD valign=bottom align=right><? language_selector(); ?></TD>	
   <TD class=a1 align=right valign=bottom  bgColor=#c0c0c0 ><IMG height=16 src="themes/resizer.jpg" width=16></TD>  
   
</TR></TBODY></TABLE>

<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><font size=-1><a href=https://www.safeweb.com/o/_:http://www.hrs.ricssoft.co.uk/  class="glow">&#169; 2001 RICS</a></td>     	
  </tr>
</table>
</td></tr></table>
<!-- footer_eof //-->
<br>
</body>
</html>


