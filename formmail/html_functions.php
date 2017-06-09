<? 
function HTMLRedirect( $url, $msg='' ) {
	if (trim( $msg )) {
		if (strpos( $url, '?' )) {
			$url .= "&mosmsg=$msg";
		} else {
			$url .= "?mosmsg=$msg";
		}
	}

	if (headers_sent()) {
		echo "<script>document.location.href='$url';</script>\n";
	} else {
		header( "Location: $url" );
		//header ("Refresh: 0 url=$url");
	}
	exit();
}

?>