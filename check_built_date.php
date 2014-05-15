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


	if( 
		!preg_match( "/^\d{8}$/", $start_date )		||
		!preg_match( "/^\d{8}$/", $end_date )		||
		($start_date[0].$start_date[1].$start_date[2].$start_date[3]) < 2001 ||
		($start_date[4].$start_date[5]) < 1	|| ($start_date[4].$start_date[5]) > 12	||
		($start_date[6].$start_date[7]) < 1	|| ($start_date[6].$start_date[7]) > 31	||
		($end_date[0].$end_date[1].$end_date[2].$end_date[3]) < 2001 ||
		($end_date[4].$end_date[5]) < 1	|| ($end_date[4].$end_date[5]) > 12	||
		($end_date[6].$end_date[7]) < 1	|| ($end_date[6].$end_date[7]) > 31	
	) { 
//print		!preg_match( "/^\d{8}$/", $start_date )."=";
//print		!preg_match( "/^\d{8}$/", $end_date )."="		;
//print		(($start_date[0].$start_date[1].$start_date[2].$start_date[3]) < 2001) ."=";
//print		(($start_date[4].$start_date[5]) < 1)."="	. (($start_date[4].$start_date[5]) > 12)."="	;
//print		(($start_date[6].$start_date[7]) < 1)."="	. (($start_date[6].$start_date[7]) > 31)."="	;
//print		(($end_date[0].$end_date[1].$end_date[2].$end_date[3]) < 2001)."=" ;
//print		(($end_date[4].$end_date[5]) < 1)."="	. (($end_date[4].$end_date[5]) > 12)."="	;
//print		(($end_date[6].$end_date[7]) < 1)."="	. (($end_date[6].$end_date[7]) > 31)."+"	;
//print "<br>$start_date-$end_date";

		header("Location: $HTTP_REFERER");
		exit;
	}
?>
