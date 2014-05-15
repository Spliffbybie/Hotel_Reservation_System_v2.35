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
include "./functions.php"; 	
include "./rooms_functions.php";	


if (!$special) 
{ 
 include "./check_date.php";
}

include "./check_rooms.php";



if( check_client_max_booking() ) {
	header("Location: group_booking.html");
	exit;
}

	
	
	if (!$special)
	{
		$start_date = make_date( $start_year, $start_month, $start_day );
		$end_date = make_date( $end_year, $end_month, $end_day );
	}
	if(check_date_interval( $start_date, $end_date ) ) 
	{	 
		 
		 header("Location: reservations.php?error=1");	
		 exit;
	
	}

	
	
	


/////////////////////////////////////////////////////////////////////////////


if( $spec_id ) {
	$summ = get_special_summ( $start_date, $end_date, $spec_id, $singles, $doubles, $twins, $triples, $executives, $RType6, $RType7, $RType8 , $RType9, $RType10, $exec_guest_number );
	if ($summ==-1)
	{  
		
		header("Location: reservations.php?spec_id=$spec_id");	
		exit;	
	}
	else
	{
	print TEXT_SPECIAL_OFFER1;
	print $spec_id;
	print TEXT_SPECIAL_OFFER2;
	}

} else {
	$summ = get_summ( $start_date, $end_date, $singles, $doubles, $twins, $triples, $executives, $RType6, $RType7, $RType8 , $RType9, $RType10, $exec_guest_number );	
	
}

if( $summ == -1 ) {
header("Location: reservations.php?error=3");	
		exit;
}
include "themes/header.php";
?>

<tr><td valign=top>

<?

  include "themes/menu.php";

?>
</td>

<td>

<?

print TEXT_THE_HOTEL_CAN;
print TEXT_TOTAL_SUM_IS.$currency.$summ."( ".$currency_euro.to_euro($summ)." )<br>" ;
             	

if( $spec_id ) {
	print TEXT_SPECIAL_OFFER1;
	print $spec_id;
	print TEXT_SPECIAL_OFFER2;
}


?>
<form action="rooms_payment_details.php" method=post>
<h3><? print TEXT_YOUR_NAME ?></h3>
<table>
<tr>
	<td><? print TEXT_TITLE ?></td>
	<td>
		<select name="title">
			<option value="<? print TEXT_MR ?>"><? print TEXT_MR ?>
			<option value="<? print TEXT_MS ?>"><? print TEXT_MS ?>
			<option value="<? print TEXT_MS_MR ?>"><? print TEXT_MS_MR ?>
		</select>
	</td>
</tr>
<tr>
	<td><? print TEXT_FIRST_NAME ?>
</td><td><input name="first_name"></td>
</tr>
<tr>
	<td><? print TEXT_SURNAME ?></td><td><input name="surname"></td>
</tr>
</table>

<hr>
<h3><? print TEXT_ADDRESS ?></h3>
<table>
<tr valign="top">
	<td><? print TEXT_STREET_ADDRESS ?></td><td><textarea name="street_addr" cols=35 rows=6></textarea></td>
</tr>
<tr>
	<td><? print TEXT_CITY ?></td><td><input name="city"></td>
</tr>
<tr>
	<td><? print TEXT_STATE_PROVINCE ?></td>
	<td><input name="province"></td>
</tr>
<tr>
	<td><? print TEXT_ZIP_POSTAL_CODE ?></td><td><input name="zip"></td>
</tr>
<tr>
	<td><? print TEXT_COUNTRY  ?></td><td><input name="country"></td>
</tr>
</table>
<hr>

<h3><? print TEXT_CONTACT_INFO ?></h3>
<table>
<tr>
	<td><? print TEXT_TELEPHONE ?></td><td><input name="telephone"></td>
</tr>
<tr>
	<td><? print TEXT_FAX ?></td><td><input name="fax"></td>
</tr>
<tr>
	<td><? print TEXT_EMAIL ?></td><td><input name="email"></td>
</tr>
</table>
<hr>

<!--
<h3><? print TEXT_SPECIAL_REQUESTS  ?></h3>
<table>
<tr valign="top">
	<td><textarea name="special_requests" rows="6" cols="35"></textarea></td>
</tr>
</table>
-->

	<input type=hidden name="act" value="add">
	<input type=hidden name="singles" value="<?echo $singles;?>">	
	<input type=hidden name="twins" value="<?echo $twins;?>">
	<input type=hidden name="doubles" value="<?echo $doubles;?>">
	<input type=hidden name="triples" value="<?echo $triples;?>">
	<input type=hidden name="executives" value="<?echo $executives;?>">
	<input type=hidden name="RType6" value="<?echo $RType6;?>">
	<input type=hidden name="RType7" value="<?echo $RType7;?>">
	<input type=hidden name="RType8" value="<?echo $RType8;?>">
	<input type=hidden name="RType9" value="<?echo $RType9;?>">
	<input type=hidden name="RType10" value="<?echo $RType10;?>">	
	<input type=hidden name="exec_guest_number" value="<?echo $exec_guest_number;?>">
	<input type=hidden name="start_date" value="<?echo $start_date;?>">
	<input type=hidden name="end_date" value="<?echo $end_date;?>">
	<input type=hidden name="spec_id" value="<?echo $spec_id;?>">
	<input type=hidden name="total_cost" value="<?echo $summ;?>">
        <input type=hidden name='number_of_child' value="<? echo $number_of_child;?>">
	<input type=submit value="<? print TEXT_CONTINUE ?>">
</form>

</td></tr>
</td><tr></table>
<? include  "themes/footer.php"; ?>
