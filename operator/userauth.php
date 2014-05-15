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

	function authenticate() {                                                     
		Header("WWW-Authenticate: Basic realm=\"Hotel Administration Zone(Login: administrator pass: administrator)\"");
		Header("HTTP/1.0 401 Unauthorized");                                       
		echo "Maybe next time...\n";                                               
		exit;                                                                      
	}                                                                            
	if(!isset($PHP_AUTH_USER) ) {                                                  
		authenticate();                                                             
	}                                                                               
	$user=$PHP_AUTH_USER;
	$res = mysql_query("SELECT * FROM Operators WHERE username='$PHP_AUTH_USER'")
		or die("SELECT: ".mysql_error() );
	$row = mysql_fetch_array( $res );
	if( $PHP_AUTH_PW != $row['password'] || $PHP_AUTH_USER == '') {
		authenticate();
	}
	$operator_id = $row['operator_id'];
	$is_can_delete = $row['can_delete'];

?>