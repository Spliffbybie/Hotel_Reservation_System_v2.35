<? include "auth.php";

 include "themes/header.php"; 

?>
<tr><td valign=top>

<?

  include "themes/menu.php";

?>

</td>

<td>


<form action="rooms_confirm.php" method="post">
<table>
<tr><td colspan=2 align=center><? print TEXT_CONFIRMATION_OF_BOOKING ?></td></tr><tr><td colspan=2>
	<table width=100% cellpadding="6">
		<tr align="center"><td>Visa</td><td>MasterCard</td><td>&nbsp;</td></tr>
		<tr align=center>
			<td><input type=radio name="cc" value="Visa" CHECKED></td>
			<td><input type=radio name="cc" value="MasterCard"></td>
			<td>
				<select name="cc_other">
					<option value=""><? print TEXT_OTHER ?></option>
					<option value="Amex"><? print TEXT_AMEX ?></option>
					<option value="Diners"><? print TEXT_DINERS ?></option>
					<option value="Laser"><? print TEXT_LASER ?></option>
				</select>
			</td>
		</tr>
	</table>
</td></tr><tr><td><? print TEXT_NAME_ON_CARD_2 ?></td><td>	<input name="name_on_card">
</td></tr><tr><td><? print TEXT_CARD_NUMBER_2 ?></td><td>	<input name="card_number">
</td></tr><tr><td>
<? print TEXT_EXPIRES ?></td><td>
<select name="expire_month">
  <option value="January"><? print TEXT_JANUARY ?>
  <option value="February"><? print TEXT_FEBRUARY ?>
  <option value="March"><? print TEXT_MARCH ?>
  <option value="April"><? print TEXT_APRIL ?>
  <option value="May"><? print TEXT_MAY ?>
  <option value="June"><? print TEXT_JUNE ?>
  <option value="July"><? print TEXT_JULY ?>
  <option value="August"><? print TEXT_AUGUST ?>
  <option value="September"><? print TEXT_SEPTEMBER ?>
  <option value="October"><? print TEXT_OCTOBER ?>
  <option value="November"><? print TEXT_NOVEMBER ?>
  <option value="December"><? print TEXT_DECEMBER ?>
</select>
<select name="expire_year">
<option value="2001">2001
<option value="2002">2002
<option value="2003">2003
<option value="2004">2004
<option value="2005">2005
<option value="2006">2006
<option value="2007">2007
<option value="2008">2008
<option value="2009">2009
<option value="2010">2010

</select>
</td></tr>
<!--
<tr>
	<td><? print TEXT_ADDITIONAL_COMMENTS ?></td>
	<td><textarea name="additional_comments" cols="35" rows="6"></textarea></td>
</tr>
<tr><td colspan=2>

	<table width="100%" cellpadding="6">
		<tr align=center><td colspan="3"><? print TEXT_HOW_WOULD_YOU ?>		</td></tr>
		<tr align=center><td><? print TEXT_EMAIL ?></td><td><? print TEXT_TELEPHONE ?></td><td><? print TEXT_FAX ?>/td></tr>

		<tr align=center>
			<td><input type=radio name="confirm_type" value="email" CHECKED></td>
			<td><input type=radio name="confirm_type" value="telephone"></td>
			<td><input type=radio name="confirm_type" value="fax"></td>
		</tr>
	</table>
</td></tr>
-->
</table>
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
	<input type=hidden name="special_requests" value="<?echo $special_requests;?>">
	<input type=hidden name="spec_id" value="<?echo $spec_id;?>">
	<input type=hidden name="total_cost" value="<?echo $total_cost;?>">
	<input type=hidden name='number_of_child' value="<? echo $number_of_child;?>">
	<input type=submit value="<? print TEXT_CONTINUE ?>">
</form>

</td></tr>
</td><tr></table>
<? include  "themes/footer.php"; ?>

