<?php
include_once( '../path.php' ); 


class Database extends Exception {
	
		// Setting up variables
	private $host = 'localhost';
	private $username = 'redlumieno';
	private $db = 'redlumieno';
	private $password = 'hOxNX11TYUu3gAno';
	private $dbn;
	
		// Defining constructor
	public function __construct() {
		$this->connect();
	}
	
		// Database connection
	public function connect() {
		
		try {
				//Crearing database source name 
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
			
				//Creating object in PDO
			$this->dbn = new PDO($dsn, $this->username, $this->password);
			$this->dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->dbn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			
			return true;
		} catch( PDOException $e ) {
			echo '<br><div class="alert alert-danger" >ERROR: ' . $e->getMessage() . '</div><br>';
		}
		
	}
	
	public function execute_query( $sql, $array = NULL ) {
		
		try {
			$stmnt = $this->dbn->prepare($sql);
			$istrue  = $stmnt->execute($array);
			
			if( $istrue ) {
				return true;
			} else {
				return false;
			}
		}  catch (PDOException $e) {
			echo '<br><div class="alert alert-danger" >ERROR: ' . $e->getMessage() . '</div><br>';
		}
		
	}
	
	public function display( $sql, $array = NULL ) {
		
		try {
			$stmnt = $this->dbn->prepare($sql);
			$stmnt->execute( $array );

			return $istrue = $stmnt->fetchAll();
		}  catch (PDOException $e) {
			echo '<br><div class="alert alert-danger" >ERROR: ' . $e->getMessage() . '</div><br>';
		}
	}
	

	
	

}	

























	// Authenticate user login
function auth_login() {

	if( ! isset( $_SESSION[SYSTEM_NAME.'userid'] ) ) {  

		if( ROOT.dirname($_SERVER['SCRIPT_NAME']) == PATH_ADMIN ) {
			header('Location: ' . PATH . 'lumieno/login'  );
		} else if( ROOT.dirname($_SERVER['SCRIPT_NAME']) == PATH_CUSTOMER) {
			header('Location: ' . PATH . 'customer/login' );
		} else if( ROOT.dirname($_SERVER['SCRIPT_NAME']) == PATH_DISTRIBUTOR ) {
			header('Location: ' . PATH . 'distributor/login' );
		} else  {

			header('Location: ' . PATH . '/');
		}
		
		exit();

	}


	
	
	$flag = true;
	if( $_SESSION[SYSTEM_NAME.'type'] == encrypt('admin') && ROOT.dirname($_SERVER['SCRIPT_NAME']) != PATH_ADMIN ) {
		$flag = false; 
	}
	if( $_SESSION[SYSTEM_NAME.'type'] == encrypt('customer') && ROOT.dirname($_SERVER['SCRIPT_NAME']) != PATH_CUSTOMER ) {
		$flag = false;
	} 
	if( $_SESSION[SYSTEM_NAME.'type'] == encrypt('distributor') && ROOT.dirname($_SERVER['SCRIPT_NAME']) != PATH_DISTRIBUTOR ) {
		$flag = false;
	} 



	if( !$flag ) {

		
		echo 'You have no permission to view this page';
		exit();
	}
}

	// get logged user type
function user_type() {
	return $_SESSION['type'];
}















	// insert in to 
function insertInToTable ($table, $xarray, $a ) {

	$query = "INSERT INTO ".$table." ( ";
	$bzo = 0;
	foreach($xarray as $k=>$value) { 
		if ( $bzo != 0 ) {
			$query = $query.", ";
		}
		$query = $query." `".$k."`";
		$bzo++;
	}
	$query = $query." ) VALUES ( ";
	$bzo = 0;
	foreach($xarray as $k=>$value) { 
		if ( $bzo != 0 ) {
			$query = $query.", ";
		}
		$query = $query." :update_item_".$bzo ;
		$xarray[':update_item_'.$bzo] = $xarray[$k];
		unset($xarray[$k]); 
		$bzo++;
	}
	$query = $query." ) "; 
	if ($a->execute_query($query, $xarray)){	
		return 1;
	} else {
		return 0;	
	}
}

	// select from
function selectFromTable ($columns, $table, $where, $a ) {
	$query = "SELECT ".$columns."  FROM ".$table." WHERE " . $where ; 
	$result = $a->display($query); 
	if ($result ){	
		$ouch = 0;
		$reto = null;
		foreach ($result[0] as $key => $value) {
			if(trim($key) == trim($columns)){
				$reto = $value;
				$ouch++;
			}
		}
		if($ouch == 1 && $reto != null)
			return $reto;
		else
			return $result ;
	} else {
		return null;	
	}
}


	// update table 
function updateTable ($table, $xarray, $where, $a ) {

	$query = "UPDATE ".$table." SET ";
	$bzo = 0;
	foreach($xarray as $k=>$value) { 
		if ( $bzo != 0 ) {
			$query = $query.", ";
		}
		$query = $query . " `".$k."` = :update_item_".$bzo ;
		$xarray[':update_item_'.$bzo] = $xarray[$k];
		unset($xarray[$k]); 
		$bzo++;
	}
	$query = $query." WHERE " . $where; 
		//echo "$query";
	if ($a->execute_query($query, $xarray)){	
		return 1;
	} else {
		return 0;	
	}
}

function encrypt($pure_string, $encryption_key = "25c6c7ff35b9979b151f2136cd13b0ff") {
	if ($encryption_key == "25c6c7ff35b9979b151f2136cd13b0ff") {
		return strtr(base64_encode($pure_string), '+/=', '-_,');
	}
	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
	return $encrypted_string;
}

	/**
	 * Returns decrypted original string
	 */
	function decrypt($encrypted_string, $encryption_key = "25c6c7ff35b9979b151f2136cd13b0ff") {
		if ($encryption_key == "25c6c7ff35b9979b151f2136cd13b0ff") {
			return base64_decode(strtr($encrypted_string, '-_,', '+/='));
		}

		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
		return $decrypted_string;
	}





	?>