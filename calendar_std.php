<script language="JavaScript">
	 var switcher = 1;
	function cal_action( day, month, year ) {
		if( switcher == 1 ){
			document.f1.start_year.value = year;
			document.f1.start_month.value = month;
			document.f1.start_day.value = day;
		}else{
			document.f1.end_year.value = year;
			document.f1.end_month.value = month;
			document.f1.end_day.value = day;
		}
		switcher = -switcher;
	}
</script>
