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
	include "./auth.php";
	include "./rooms_functions.php";
	include "./functions.php";
	include "./check_rooms.php";
	include "./check_built_date.php";
	$res = mysql_query("SELECT * FROM Roomtypes");
		$i=1;
		while( $row = mysql_fetch_array( $res ) ) 
		{
                 $id[$i]=$row['flag']; 
		 $i++;  
		}


	if( ! $spec_id ) $spec_id=0;
	if( check_client_max_booking() ) {
		header("Location: group_booking.html");
		exit;
	}
	$res2=mysql_query( "SELECT * from Settings where name='links_at_end_of_booking'" );
	$row = mysql_fetch_array( $res2 );
	$loc=$row['text'];
	mysql_query( "LOCK TABLE Bookings WRITE, Rates WRITE, Rooms WRITE, Clients WRITE, Specials WRITE" )
		or die( "LOCK: ".mysql_query() );

	if( check_date_interval( $start_date, $end_date ) ) {
		mysql_query("UNLOCK TABLES") or die("UNLOCK: ".mysql_error());
		print "can't reserve";
		exit;
	}
	$cc_info = TEXT_TYPE.($cc_other ? $cc_other : $cc )."<br>\n"
		.TEXT_NAME_ON_CARD
		.TEXT_CARD_NUMBER
		.EXPIRY_DATE;

	$query = "INSERT INTO Clients SET
			cc_info='$cc_info',
			confirm_type='$confirm_type',
			title='$title',
			first_name='$first_name',
			surname='$surname',
			street_addr='$street_addr',
			city='$city',
			province='$province',
			zip='$zip',
			country='$country',
			phone='$telephone',
			fax='$fax',
			email='$email',
			additional_comments='$additional_comments',
			ip='$REMOTE_ADDR'";
	mysql_query( $query )
		or die("$query:<br>".mysql_error());

	$client_id = mysql_insert_id();
	$query = "INSERT INTO Bookings
			SET start_date='$start_date', end_date='$end_date',
			singles='$singles', twins='$twins', doubles='$doubles',
			triples='$triples', executives='$executives', RType6='$RType6', RType7='$RType7', RType8='$RType8', RType9='$RType9', RType10='$RType10', special_id='$spec_id',
			client_id='$client_id', special_requests='$special_requests',"			
			.($executives?"exec_guest_number='$exec_guest_number',":"")
	 		."booking_time=NOW(), total_cost='$total_cost', childs='$number_of_child'";
	mysql_query( $query )or die("$query<br>".mysql_error());
	$booking_id = mysql_insert_id();
	mysql_query("UNLOCK TABLES") or die("UNLOCK: ".mysql_error());

	$message = join('', file('./client_email_header.txt') );
	$message .= "\nDate: ".local_date($start_date)." - ".local_date($end_date)."\n\n";
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
	$message .= "Total cost: $currency $total_cost\n";
	$message .= join('', file('./client_email_footer.txt') );
	mail_client( "$email", "$mail_client_subject", "$message", "$mail_client_from", "$mail_client_reply_to", "$mail_client_x_mailer" );
	mail_client( "$mail_admin_address", "New booking: $booking_id", "$message", "$mail_client_from", "$mail_client_reply_to", "$mail_client_x_mailer" );
	header("Location:$loc");
?>
