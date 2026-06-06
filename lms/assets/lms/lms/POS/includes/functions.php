<?php

function encryptPassword( $pass,$salt=false,$saltLength=4 ) {
		if ( $salt === false ) {
			$res = '';
			for( $i=0;$i<$saltLength;$i++ ) {
				$res .= pack( 's',mt_rand() );
			}
			$salt = substr( base64_encode( $res ),0,$saltLength );
		}
		return $salt . sha1( $salt . $pass );
}
	
function checkPassword( $pass,$hash,$saltLength=4 ) {
		if ( encryptPassword( $pass,substr( $hash,0,$saltLength ) ) === $hash ) {
			return true;
		}
		return false;
}

?>