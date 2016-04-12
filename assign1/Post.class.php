<?php

class Post {
    
    public static function validate_status_code( $code ) {
	if ( strlen( $code ) != 5 ) {
	    return 'The status code must be exactly 5 characters!<br>';
	} else if ( substr($code, 0, 1) != 'S' ) {
	    return 'The status code must start with a capital S!<br>';
	} else {
	    for( $i=1; $i<5; $i++ ) {
		if ( ! is_numeric( substr( $code, $i, 1 ) ) ) {
		    return 'The status code must end with four digits!<br>';
		}
	    }
	}
	
	$check_code = DB::select( "status", "*", ("status_code = '".$code."'") );
	if ( ! empty( $check_code ) ) {
	    return 'The status code already exists!<br>';
	}
	return '';
    }
    
    public static function validate_status( $status ) {
	if ( strlen( str_replace( ' ', '', $status ) ) < 1 ) {
	    return 'The status must be at least 1 character!<br>';
	}
	if ( ! preg_match( "/^[a-zA-Z0-9 ,.!?]+$/", $status ) ) {
	    return 'The status can only contain alphanumeric characters including spaces, comma, period, exclamation point and question mark!<br>';
	}
	return '';
    }
    
    public static function validate_keyword( $keyword ) {
	if ( strlen( str_replace( ' ', '', $keyword ) ) < 1 ) {
	    return 'The keyword must be at least 1 character!<br>';
	}
	if ( ! preg_match( "/^[a-zA-Z0-9 ]+$/", $keyword ) ) {
	    return 'The keyword can only contain alphanumeric characters and spaces!<br>';
	}
	return '';
    }
    
    public static function prepare_data( $form_data ) {
	$content = array();
	$content['allow_like'] = 0;
	$content['allow_comment'] = 0;
	$content['allow_share'] = 0;
	foreach ( $form_data as $key => $value ) {
	    if ( $key == 'date' ) {
		$date = DateTime::createFromFormat( 'd/m/Y', $value );
		$content['date_added'] = "'" . $date -> format( 'Y-m-d' ) . "'";
		continue;
	    }
	    if ( $key == 'permission_type' ) {
		foreach ( $value as $p_value) {
		    if ( isset( $content[$p_value] ) ) {
			$content[$p_value] = 1;
		    }
		}
		continue;
	    }
	    $content[$key] = "'" . $value . "'";
	}
	return $content;
    }
    
    public static function get_status( $keyword ) {
	$result = DB::select( "status", "*", "status LIKE '%$keyword%'" );
	return $result;
    }
    
    public static function split_keyword( $keyword ) {
	return preg_split('/\W+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);
    }
    
}