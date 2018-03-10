<?php


define( 'SYSTEM_NAME', 'lumieno' ); 
define( 'DISPLAY_NAME', 'Lumieno' );
define( 'SYSTEM_ROOT', '/future/lumieno_public' );

define("ENCRYPTION_KEY", "!@1#Y$%^g&k*");
	// encrypt/decrypt($encrypted, ENCRYPTION_KEY);


function siteURL()
{
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http"; 
	return $protocol;
} 

$SPROTOCOL = siteURL();




define( 'ROOT',  $SPROTOCOL. ':' . '//' . $_SERVER['SERVER_NAME'] .':' . $_SERVER['SERVER_PORT']  ); 
define( 'DIRECTORY',  SYSTEM_ROOT . '/'); 
define( 'PATH', $SPROTOCOL. '://' . $_SERVER['SERVER_NAME'] .':' . $_SERVER['SERVER_PORT']  . DIRECTORY ); 



define( 'DIRECTORY_ADMIN', DIRECTORY . 'lumieno/' );
define( 'DIRECTORY_CUSTOMER', DIRECTORY . 'customer/' );
define( 'DIRECTORY_DISTRIBUTOR', DIRECTORY . 'distributor/' );


define( 'PATH_ADMIN', PATH . 'lumieno' );
define( 'PATH_CUSTOMER', PATH . 'customer' );
define( 'PATH_DISTRIBUTOR', PATH . 'distributor' );







?>