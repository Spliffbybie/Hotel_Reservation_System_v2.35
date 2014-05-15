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

///////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

 	function check_date ( $row, $corp_id=0 ) {
		global $singles, $twins, $doubles, $triples, $executives, $RType6,$RType7,$RType8,$RType9,$RType10 ;
		$date = $row['date'];
		$query = "SELECT SUM(singles), SUM(twins), SUM(doubles), SUM(triples), SUM(executives), SUM(RType6), SUM(RType7),  SUM(RType8), SUM(RType9), SUM(RType10)
				FROM Bookings WHERE start_date <= '$date' AND end_date >= '$date' AND corporate_id IS ";
		$query .= ($corp_id?"NOT NULL":"NULL");
		$res2 = mysql_query( $query )
			or die("$query<br>".mysql_error());
		$row2 = mysql_fetch_row( $res2 );
		if( $row['singles'] - $row2[0] < $singles ){ return "singles"; }
		if( $row['twins'] - $row2[1] < $twins ){ return "twins"; }
		if( $row['doubles'] - $row2[2] < $doubles ){ return "doubles"; }		
		if( $row['triples'] - $row2[3] < $triples ){  return "triples"; }
		if( $row['executives'] - $row2[4] < $executives ){ return "executives"; }
		if( $row['RType6'] - $row2[5] < $RType6 ){ return "RType6"; }
		if( $row['RType7'] - $row2[6] < $RType7 ){ return "RType7"; }
		if( $row['RType8'] - $row2[7] < $RType8 ){ return "RType8"; }
		if( $row['RType9'] - $row2[8] < $RType9 ){ return "RType9"; }
		if( $row['RType10'] - $row2[9] < $RType10 ){ return "RType10"; }
			
		return 0;	
	}

	function check_date_interval( $start_date, $end_date, $is_corp=0 ) {
		$query = "SELECT * FROM Rooms WHERE date >= $start_date AND date <= $end_date AND is_corporate=$is_corp";
		$res = mysql_query( $query )
			or die("$query<br>".mysql_error());
		while( $row = mysql_fetch_array( $res ) ) {
			if( $ret = check_date( $row, $is_corp ) )  return $ret;			
		}
		return 0;
	}

	function get_special_summ( $start_date, $end_date, $spec_id, $single, $double, $twin, $triple, $executive, $RType6, $RType7, $RType8 , $RType9, $RType10, $exec_guest_number) {
		$res=mysql_query("SELECT adult FROM Roomtypes");
		$i=1;		
		while( $row = mysql_fetch_array( $res ) ) 
		{
		 $adult[$i]=$row['adult'];		
		 $i++;
		}
		$query2 = "SELECT MAX(date) AS max, MIN(date) AS min FROM Rates WHERE special_desc_id=$spec_id";
		$res2 = mysql_query( $query2 )  or die( "$query2<br>".mysql_error());
		$row2 = mysql_fetch_array( $res2 );
		$query = "SELECT * FROM Rates,Specials 	WHERE Rates.special_desc_id = Specials.special_id AND Rates.special_desc_id=$spec_id";
		$res = mysql_query( $query ) or die( "$query<br>".mysql_error());
		$row = mysql_fetch_array( $res );
		$length = $row['length'];
		$d=mktime();
		$d=date("Y-m-d",$d);
		if ($start_date<$d) return -1;		
		$summ = $singles * $row['singles']*$adult[1] + 
		$doubles * $row['doubles'] * $adult[3]+ $twins * $row['twins'] * $adult[2] + $triples * $row['triples'] * $adult[4]+ 
		$executives * $row['executives'] * $exec_guest_number+ $RType6*$row['RType6']*$adult[6]+$RType7*$row['RType7']*$adult[7]+ 
		$RType8*$row['RType8']*$adult[8]+$RType9*$row['RType9']*$adult[9]+$RType10*$row['RType10']*$adult[10];			

		return  $summ;
	}

	function get_summ( $start_date, $end_date, $singles, $doubles, $twins, $triples, $executives, $RType6, $RType7, $RType8 , $RType9, $RType10, $exec_guest_number, $corp_id = 0 ) {
		$res=mysql_query("SELECT adult FROM Roomtypes");
		$i=1;		
		while( $row = mysql_fetch_array( $res ) ) 
		{
		 $adult[$i]=$row['adult'];		
		 $i++;
		}
		$query = "SELECT (TO_DAYS($end_date) - TO_DAYS($start_date)) AS Q";
		$res2 = mysql_query( $query ) or die( "$query<br>".mysql_error());
		$row2 = mysql_fetch_array( $res2 );
		$days_need = $row2['Q'];
		$query = "SELECT * FROM Rates WHERE special_desc_id = 0 AND  date >= $start_date AND date < $end_date AND corporate_id=$corp_id";
		$res = mysql_query( $query )
			or die( "$query<br>".mysql_error());
		while( $row = mysql_fetch_array( $res ) ) {
			$summ += $singles * $row['singles']*$adult[1] + 
			$twins * $row['twins'] * $adult[2]+$doubles * $row['doubles'] * $adult[3] + $triples * $row['triples'] * $adult[4]+ 
			$executives * $row['executives'] * $exec_guest_number+ $RType6*$row['RType6']*$adult[6]+$RType7*$row['RType7']*$adult[7]+ 
			$RType8*$row['RType8']*$adult[8]+$RType9*$row['RType9']*$adult[9]+$RType10*$row['RType10']*$adult[10];			
			$days++;
		}
		if( $days != $days_need ){  return -1; }
		return $summ;
	}

?>