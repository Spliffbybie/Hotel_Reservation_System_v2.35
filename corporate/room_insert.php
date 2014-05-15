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
	include "../rooms_functions.php";
	include "../functions.php";
	include "./userauth.php";
	include "../check_rooms.php";
	include "../check_built_date.php";

	if( check_client_max_booking( $corp_id ) ) {
		header("Location: ../group_booking.html");
		exit;
	}

  mysql_query( "LOCK TABLE Bookings WRITE, Rates WRITE, Rooms WRITE" ) or die("LOCK: ".mysql_error());
	if( check_date_interval( $start_date, $end_date ) ) {
		mysql_query( "UNLOCK TABLES" ) or die( mysql_error() );
		print "SHIT HAPPENS";
		exit;
	}
		$query = "INSERT INTO Bookings
			SET start_date='$start_date', end_date='$end_date', corporate_id='$corp_id',
			singles='$singles', twins='$twins', doubles='$doubles',
			triples='$triples', executives='$executives', RType6='$RType6', RType7='$RType7', RType8='$RType8', RType9='$RType9', RType10='$RType10', special_id='$spec_id',
			client_id='$client_id', special_requests='$special_requests',"			
			.($executives?"exec_guest_number='$exec_guest_number',":"")
	 		."booking_time=NOW(), total_cost='$total_cost', childs='$number_of_child'";

	mysql_query( $query )
		or die("$query<br>".mysql_error());

	$booking_id = mysql_insert_id();
	mysql_query("UNLOCK TABLES") or die("UNLOCK: ".mysql_error());                               
	
	$message = join('', file('../client_email_header.txt') );
	$message .= "\nDate: ".local_date($start_date)." - ".local_date($end_date)."\n";
	if($id[1]=='on')   {  $message .="Single:".$singles.", "; } 
	if($id[2]=='on')   {  $message .="Twin: ".$twins.", "; } 
	if($id[3]=='on')   {  $message .="Doubles: ".$doubles.", ";}
	if($id[4]=='on')   {  $message .="Triples: ".$triples.", ";}
	if($id[5]=='on')   {  $message .="Executives: ".$executives."Guest: ".$exec_guest_number.", ";}
	if($id[6]=='on')   {  $message .="Rtype6: ".$RType6.", ";}	
	if($id[7]=='on')   {  $message .="Rtype7: ".$RType7.", ";}
	if($id[8]=='on')   {  $message .="Rtype8: ".$RType8.", ";}
	if($id[9]=='on')   {  $message .="Rtype9: ".$RType9.", ";}
   	if($id[10]=='on')  {  $message .="Rtype10: ".$RType10.", ";}	
	$message .= "---------------\n";
	$message .= TEXT_TOTAL_COST_CURRENCY;
	$message .= join('', file('../client_email_footer.txt') );
	mail_client( $corp_email, $mail_client_subject, $message, $mail_client_from, $mail_client_reply_to, $mail_client_x_mailer );
	mail_client( $mail_admin_address, "New booking: $booking_id", "", $mail_client_from, $mail_client_reply_to, $mail_client_x_mailer );
        header("Location: index.php");
?>
