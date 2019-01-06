<?php
$script_name		= $_SERVER['SCRIPT_NAME'];
$script_keyword		= substr( $script_name , 0 , strpos( $script_name , '.' ) );
$script_keyword		= substr( $script_keyword , strrpos( $script_keyword , '/' ) + 1 );
$interface_uri				= "/{$script_keyword}";
$interface_replaced_uri		= "/api{$interface_uri}.php";
if( strpos( $_SERVER['REQUEST_URI'] , $interface_uri ) === 0 )
{
	$_SERVER['REQUEST_URI']	= substr_replace( $_SERVER['REQUEST_URI']  , $interface_replaced_uri , 0 , strlen( $interface_uri ) );
}
unset( $script_name , $script_keyword , $interface_uri , $interface_replaced_uri );
?>
