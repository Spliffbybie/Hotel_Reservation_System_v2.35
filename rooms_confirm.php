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
	include "themes/header.php";
?>
<tr><td valign=top>

<?

  include "themes/menu.php";

?>

</td>

<td>

<?
$res = mysql_query("SELECT * FROM Roomtypes");
		$i=1;
		while( $row = mysql_fetch_array( $res ) ) 
		{
                 $id[$i]=$row['flag']; 
		 $i++;  
		}


?>
<table border=0 cellpadding=7>
<tr valign="top"><th align="right"><? print TEXT_ARRIVAL_DATE ?></th><td><?echo local_date($start_date);?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_DEPARTURE_DATE ?></th><td><?echo local_date($end_date);?></td></tr>

<tr valign="top"><th align="right"><? print TEXT_ROOMS ?></th><td>
  <table>
	
   <? if($id[1]=='on')   { ?> <tr valign="top"><td><? print TEXT_SINGLE ?></td><td> <?echo $singles;?></td></tr> <? } ?>
   <? if($id[2]=='on')   { ?> <tr valign="top"><td><? print TEXT_TWIN ?></td><td> <?echo $twins;?></td></tr> <? } ?>
   <? if($id[3]=='on')   { ?> <tr valign="top"><td><? print TEXT_DOUBLE ?></td><td> <?echo $doubles;?></td></tr><? } ?>
   <? if($id[4]=='on')   { ?> <tr valign="top"><td><? print TEXT_TRIPLE ?></td><td> <?echo $triples;?></td></tr><? } ?>
   <? if($id[5]=='on')   { ?> <tr valign="top"><td><? print TEXT_EXECUTIVE ?></td><td> <?echo $executives;?></td></tr><? } ?>
   <? if($id[6]=='on')   { ?> <tr valign="top"><td><? print RType6 ?></td><td> <?echo $RType6;?></td></tr><? } ?>	
   <? if($id[7]=='on')   { ?> <tr valign="top"><td><? print RType7 ?></td><td> <?echo $RType7;?></td></tr><? } ?>
   <? if($id[8]=='on')   { ?> <tr valign="top"><td><? print RType8 ?></td><td> <?echo $RType8;?></td></tr><? } ?>
   <? if($id[9]=='on')   { ?> <tr valign="top"><td><? print RType9 ?></td><td> <?echo $RType9;?></td></tr><? } ?>
   <? if($id[10]=='on')   { ?> <tr valign="top"><td><? print RType10 ?></td><td> <?echo $RType10;?></td></tr><? } ?>	
   
  </table>
 </td>
</tr>
<tr valign="top"><th align="right"><? print TEXT_TOTAL_COST ?></th><td><? print $currency.$total_cost."( $currency_euro".to_euro($total_cost)." )";?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_NAME ?></th><td><?echo $title;?> <?echo $first_name;?> <?echo $surname;?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_COMPANY ?></th><td><?echo $company;?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_ADDRESS ?></th><td>
    <?echo $street_addr;?><br>
    <?echo $city;?><br>
    <?echo $province;?><br>
    <?echo $zip;?> <?echo $country;?>
  </td>
</tr>
<tr valign="top"><th align="right"><? print TEXT_TEL ?></th><td><?echo $telephone;?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_FAX ?></th><td><?echo $fax;?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_EMAIL ?></th><td><a href="mailto:<?echo $email;?>"><?echo $email;?></a></td></td>
<tr valign="top"><th align="right"><? print TEXT_CHILD ?></td><td> <?echo $number_of_child;?></td></tr>	
<tr valign="top"><th align="right"><? print TEXT_CONFIRM_TYPE ?></th><td><?echo $confirm_type;?></td></tr>
<tr valign="top"><th align="right"><? print TEXT_SPECIAL_REQUESTS ?></th><td><?echo $special_requests;?></td></tr>
</table>


<form action="rooms_insert.php" method="post">
	<input type=hidden name="cc" value="<?echo $cc;?>">
	<input type=hidden name="cc_other" value="<?echo $cc_other;?>">
	<input type=hidden name="name_on_card" value="<?echo $name_on_card;?>">
	<input type=hidden name="card_number" value="<?echo $card_number;?>">
	<input type=hidden name="expire_month" value="<?echo $expire_month;?>">
	<input type=hidden name="expire_year" value="<?echo $expire_year;?>">
	<input type=hidden name="additional_comments" value="<?echo $additional_comments;?>">
	<input type=hidden name="confirm_type" value="<?echo $confirm_type;?>">
	<input type=hidden name="act" value="add">
	<input type=hidden name="num" value="<?echo $k;?>">		
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
	<input type=hidden name="title" value="<?echo $title;?>">
	<input type=hidden name="first_name" value="<?echo $first_name;?>">
	<input type=hidden name="surname" value="<?echo $surname;?>">
	<input type=hidden name="street_addr" value="<?echo $street_addr;?>">
	<input type=hidden name="city" value="<?echo $city;?>">
	<input type=hidden name="province" value="<?echo $province;?>">
	<input type=hidden name="zip" value="<?echo $zip;?>">
	<input type=hidden name="country" value="<?echo $country;?>">
	<input type=hidden name="telephone" value="<?echo $telephone;?>">
	<input type=hidden name="fax" value="<?echo $fax;?>">
	<input type=hidden name="email" value="<?echo $email;?>">
	<input type=hidden name="total_cost" value="<?echo $total_cost;?>">
	<input type=hidden name="special_requests" value="<?echo $special_requests;?>">
	<input type=hidden name="spec_id" value="<?echo $spec_id;?>">
        <input type=hidden name='number_of_child' value="<? echo $number_of_child;?>">
	<input type=submit value="<? print TEXT_CONFIRM_MAKE_BOOKING ?>">
</form>

</td></tr>
</td><tr></table>
<? include  "themes/footer.php"; ?>
