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
include "./check_date.php";
include "./check_rooms.php";

include "themes/header.php" ;

?>

<tr><td valign=top>

<?
  include "themes/menu.php";
?>
</td>
<td valign=top>


<?

if( check_client_max_booking() ) {
	header("Location: ../group_booking.html");
	exit;
}


$start_date = make_date( $start_year, $start_month, $start_day );
$end_date = make_date( $end_year, $end_month, $end_day );

if( check_date_interval( $start_date, $end_date) ) {
	 print "Sorry but there's not enough rooms available."; 
	 exit;
}

/////////////////////////////////////////////////////////////////////////////

$summ = get_summ( $start_date, $end_date, $singles, $doubles, $twins, $triples, $executives, $RType6, $RType7, $RType8 , $RType9, $RType10, $exec_guest_number);

if( $summ != -1 ) {
	print TEXT_RESERVATION_IS_POSSIBLE.$currency.$summ."( ".$currency_euro.to_euro($summ)." )" ;
} else {
?>		<? print TEXT_SORRY_THERE_NO_FREE ?>		<form>
			<input type="button" value="Back" onClick="document.location='index.php';">
		</form>	
<?		exit;
}
?>


<form action="rooms_insert.php" method=post>
<h3><? print TEXT_GUESTS_NAME ?></h3>
<textarea name="special_requests" rows="6" cols="35"></textarea>
	<input type=hidden name="act" value="add">
	<input type=hidden name="singles" value="<?echo $singles;?>">
	<input type=hidden name="twins" value="<?echo $twins;?>">
	<input type=hidden name="doubles" value="<?echo $doubles;?>">
	<input type=hidden name="triples" value="<?echo $triples;?>">
	<input type=hidden name="executives" value="<?echo $executives;?>">
	<input type=hidden name="start_date" value="<?echo $start_date;?>">
	<input type=hidden name="end_date" value="<?echo $end_date;?>">
	<input type=hidden name="type" value="<?echo $type;?>">
	<input type=hidden name="id" value="<?echo $id;?>">
	<input type=hidden name="total_cost" value="<?echo $summ;?>">	
	<input type=submit value="<? print TEXT_CONFIRM_MAKE_BOOKING ?>">
</form>
</td><tr></table>
</td></tr>
<?  include "themes/footer.php"; ?>


