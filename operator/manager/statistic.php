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
	include "../../auth.php";
	include "../userauth.php";
	if( $PHP_AUTH_USER != 'administrator' ){ 
		header('Location: authfail.html');
	}

include "../../functions.php";
include "themes/header.php";
?>

		<table border=0 BGCOLOR=#c0c0c0>
		<tr><td bgcolor=navy><FONT class=a1 color=#ffffff>&nbsp;<B><? print TEXT_STAT ?></B></FONT></td>
		<tr><td class=WIN>


<?
	$DO_NOT_SHOW_ROOMS=1;include "../rates_common_date.php";?>
	<select name="choice">
		<option value="1">How many rooms have been booked by</option>
		<option value="2">Total money that has come from</option>
		<option value="3">Which is the most popular Credit Card</option>
		<option value="4">How many nights a guest stay in the hotel</option>
	</select>

	<select name="much">
		<option value="any">any</option>
		<option value="particular">particular</option>
	</select>

	<select name="client">
		<option value="general"><? print TEXT_PUBLIC ?></option>
		<option value="corporate"><? print TEXT_CORPORATE ?></option>
		<option value="both">both</option>
	</select>
	<br>
	<select name="corporate">
		<option value="0">Corporate client name</option>
<? 
	$res = mysql_query("SELECT corporate_id, name FROM Corporates");
	while( $row = mysql_fetch_array( $res ) ) {
		echo "<option value=\"".$row['client_id']."\">".$row['name']."</option>";
	}	
?>
	</select><br>
	<input name="name">Client name<br>
	<input name="cc">CC number<br>
	<?include "../rates_common_date_fin.php";?>

<? 
	switch( $choice ) {
		case 1:
			do_how_many_rooms();
			break;
		case 2: 
			do_total_money();
			break;
		case 3: 
			do_credit_card();
			break;
		case 4: 
			do_how_many_nights();
			break;
		default: 
	}
?>




<? include "themes/footer.php" ; ?>



<?
	function do_how_many_rooms() {
		global $client, $much, $name, $corporate;
		switch( $client ) {
			case 'general': 
				if( $much == 'particular' ) 
					$cl_q = "WHERE surname LIKE '$name'";
				else
					$cl_q = "WHERE Bookings.client_id IS NOT NULL";
				break;
			case 'corporate': 
				$cl_q = "WHERE corporate_id";
				$cl_q .= ( $corporate ? "=$corporate" : " IS NOT NULL" );
				break;
		}
		
		$query = "SELECT SUM(singles) AS sn, SUM(twins), SUM(doubles), SUM(triples), SUM(executives), SUM(RType6), SUM(RType7), SUM(RType8), SUM(RType9), SUM(RType10)   FROM Bookings LEFT JOIN Clients USING(client_id)".$cl_q;
		$res = mysql_query( $query ) or die( "$query<br>".mysql_error());
		$row = mysql_fetch_array( $res );
//		echo "$query<br>\n";
		echo "<table border=1><tr><th>", TEXT_SINGLE," </th><th>", TEXT_TWIN, "</th><th>", TEXT_DOUBLE ,"</th><th>", TEXT_TRIPLE, "</th><th>", TEXT_EXECUTIVE, "</th><th>RType6</th><th>RType7</th><th>RType8</th><th>RType9</th><th>RType10</th></tr>\n";
		echo "<tr align=right><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td></tr></table>\n";
	}
	
	function do_total_money() {
		global $client, $much, $name, $corporate;
		switch( $client ) {
			case 'general': 
				if( $much == 'particular' ) 
					$cl_q = "WHERE surname LIKE '$name'";
				else
					$cl_q = "WHERE Bookings.client_id IS NOT NULL";
				break;
			case 'corporate': 
				$cl_q = "WHERE corporate_id";
				$cl_q .= ( $corporate ? "=$corporate" : " IS NOT NULL" );
				break;
		}
		
		$query = "SELECT SUM(total_cost) FROM Bookings LEFT JOIN Clients USING(client_id)".$cl_q;
		$res = mysql_query( $query ) or die( "$query<br>".mysql_error());
		$row = mysql_fetch_row( $res );
		echo "TOTAL IS: ".$row[0]."<br>";
	}
	
	function do_credit_card() {
	}
	
	function do_how_many_nights() {
		global $client, $much, $name, $corporate;
		switch( $client ) {
			case 'general': 
				if( $much == 'particular' ) 
					$cl_q = "WHERE surname LIKE '$name'";
				else
					$cl_q = "WHERE Bookings.client_id IS NOT NULL";
				break;
			case 'corporate': 
				$cl_q = "WHERE corporate_id";
				$cl_q .= ( $corporate ? "=$corporate" : " IS NOT NULL" );
				break;
		}
		
		$query = "SELECT SUM( TO_DAYS( end_date ) - TO_DAYS( start_date ) ) FROM Bookings LEFT JOIN Clients USING(client_id)".$cl_q;
		$res = mysql_query( $query ) or die( "$query<br>".mysql_error());
		$row = mysql_fetch_row( $res );
		echo "TOTAL nights spent amount is: ".$row[0]."<br>";
	}

?>