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
                         
	$date = getdate( time() );
	print "<table >\n";
	for( $q = 0; $q < $calendar_month_number;  $date = getdate(  mktime( 0,0,0, $date['mon']+1, 1, $date['year'])),$q++ ) {
		$lastday = getdate(  mktime( 0,0,0, $date['mon']+1, 0, $date['year']));
?>		
<tr>
	<td align=right>
		<font face="Goudy Old Style, Conneticut Gothic, Times New Roman" size=3 color=#cc9900><B><?echo $date['month'];?>, <?echo $date['year'];?></B></FONT>
		<table bgcolor="#CC9900">
			<tr><td><font color=black size=2><? print TEXT_SU  ?></font></td> <td><font color=black size=2><? print TEXT_MO ?></font></td> <td><font color=black size=2><? print TEXT_TU ?></font></td> <td><font color=black size=2><? print TEXT_WE ?></font></td> <td><font color=black size=2><? print TEXT_TH ?></font></td> <td><font color=black size=2><? print TEXT_FR ?></font></td> <td><font color=black size=2><? print TEXT_SA ?></font></td> </tr>
<?
	for( $i=1; $i<=$lastday['mday']; $i++ ) {
		$curday = getdate( mktime( 0,0,0, $date['mon'], $i, $date['year']));
		if( $i == 1){ 
			print "<tr align='right'>\n";
			for( $j=0; $j<$curday['wday']; $j++ ) print "		<td></td>\n" ;
		}
		if( $curday['wday'] == 0 ) print "</tr>\n<tr align='right'>\n";
?>
	<td><font size=2><a href="javascript:cal_action(<?echo $i;?>, <?echo $curday['mon'];?>, <?echo $curday['year'];?> );" style="text-decoration:none"><?echo ($curday['wday']?"<font color=white>$i</font>":"<font color=red>$i</font>");?></a></td>

<?}?>
		</tr>
	</table>
	</td></tr>
<? } ?>

</table>