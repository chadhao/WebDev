<?php
  $value = is_numeric( $_GET[ 'number' ] ) ? (intval( $_GET[ 'number' ] ) == $_GET[ 'number' ] ? intval( $_GET[ 'number' ] ) : $_GET[ 'number' ] ) : $_GET[ 'number' ];
  echo 'Input: ' . $value;
  echo is_int( $value ) ? ( $value % 2 == 0 ? '<p>Input is even</p>' : '<p>Input is odd</p>' ) : '<p>Input is not an integer</p>';
?>
