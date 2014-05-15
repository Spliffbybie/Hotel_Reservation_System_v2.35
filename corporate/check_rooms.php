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
		preg_match( "/\D/", $singles )		||
		preg_match( "/\D/", $doubles )		||
		preg_match( "/\D/", $twins )		||
		preg_match( "/\D/", $triples )		||
		preg_match( "/\D/", $executives )	||
		preg_match( "/\D/", $RType6 )		||
		preg_match( "/\D/", $RType7 )		||	
		preg_match( "/\D/", $RType8 )		||
		preg_match( "/\D/", $RType9 )		||
		preg_match( "/\D/", $RType10 )		
	) { 
	
		header("Location: $HTTP_REFERER");
		exit;
	}
if ($singles+$doubles+$twins+$triples+$executives+$RType6+$RType8+$RType7+$RType9+$RType10<=0)
	{ 
	
		header("Location: index.php?error=4");
		exit;
	}
	
                      
?>
