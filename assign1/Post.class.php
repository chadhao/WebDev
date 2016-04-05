<?php

class Post {
    
    public static function validate_status_code( $code ) {
	if ( strlen( $code ) != 5 ) {
	    return 'The status code must be exactly 5 characters!';
	} else if ( substr($code, 0, 1) != 'S' ) {
	    return 'The status code must start with an uppercase letter S!';
	} else {
	    for( $i=1; $i<5; $i++ ) {
		if ( ! is_numeric( substr( $code, $i, 1 ) ) ) {
		    return 'The status code must end with four digits!';
		}
	    }
	}
	if ( ! empty( DB::select( 'status', '*', ('status_code = '.$code) ) ) ) {
	    return 'The status code already exists!';
	}
	return '';
    }
    
}