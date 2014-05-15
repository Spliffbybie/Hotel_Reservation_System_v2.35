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
		!preg_match( "/^\d{4}$/", $start_year )		||
		!preg_match( "/^\d{1,2}$/", $start_month )	||
		!preg_match( "/^\d{1,2}$/", $start_day )	||
		!preg_match( "/^\d{4}$/", $end_year )		||
		!preg_match( "/^\d{1,2}$/", $end_month )		||
		!preg_match( "/^\d{1,2}$/", $end_day )		||
		$start_year < 2001 							||
		$start_month < 1	|| $start_month > 12	||
		$start_day < 1		|| $start_day > 31		||
		$end_year < 2001 							||
		$end_month < 1		|| $end_month > 12		||
		$end_day < 1		|| $end_day > 31			
	) { 
//print		!preg_match( "/^\d{4}$/", $start_year );
//print		!preg_match( "/^\d{1,2}$/", $start_month );
//print		!preg_match( "/^\d{1,2}$/", $start_day );
//print		!preg_match( "/^\d{4}$/", $end_year );
//print		!preg_match( "/^\d{1,2}$/", $end_month );
//print		!preg_match( "/^\d{1,2}$/", $end_day );
//print		"<br>$start_year-$start_month-$start_day<br>";
//print		"$end_year-$end_month-$end_day";		

		header("Location: reservations.php?error=2");
		//echo "Invalid date<br>Please report this bug to author.\n";
		exit;
	}
?>