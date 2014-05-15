<?
	if( !session_is_registered( 'lang' ) ) {
		$lang = parse_accept_language();
		session_register( 'lang' );
	} elseif( !empty( $HTTP_POST_VARS['lang'] ) ) {
		$lang = $HTTP_POST_VARS['lang'];
	}
	include( "$hrs_root/languages/$lang.php" );

	function parse_accept_language() 
		{		
		global $HTTP_ACCEPT_LANGUAGE, $hrs_root;
		   $languages = split( ",", $HTTP_ACCEPT_LANGUAGE );
		   foreach( $languages as $language ) 
		     {
			list( $l, $q_ ) = split( ";", $language );
			if( empty( $q_ ) ) {
				$q = 1;
			} else {
				list( $foo, $q ) = split( "=", $q_ );				
			}
			list( $l, $foo ) = split( "-", $l ); // hide dialects
			if( file_exists( "$hrs_root/languages/$l.php" ) ) {
				$lang[$q] = $l;
			}
		     }
		   if( sizeof( $lang ) > 0 ) 
 		     {  			
			ksort( $lang );
			return $lang[sizeof( $lang )];
		     }		   	
		   return "en";
		   	
	}

	function language_selector() {
		global $lang, $hrs_root;
?>
	<form method=post name=language>
	<font >
	

		<FONT style="FONT-SIZE: 10pt; FONT-FAMILY: "MS Sans Serif", Geneva, sans-serif;"><B><?  echo  TEXT_LANGUAGE_SELECT  ?></font>
		<select name=lang onChange='document.language.submit();'>
<?
		$dir = opendir( "$hrs_root/languages" );
		while( $file = readdir( $dir ) ) {
			if( is_file( "$hrs_root/languages/$file" ) ) {
				$l = substr( $file, 0, -4 );
?>              
			<option value='<? echo $l; ?>'<? if( $l == $lang ) echo " selected"; ?>><? echo $l; ?></option>
<?              
			}
		}
		closedir( $dir );
?>
		</select>
  


<?	}
?>
