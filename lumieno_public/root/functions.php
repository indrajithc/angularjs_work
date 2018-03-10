<?php

include_once( 'connection.php' );
session_start();

try { 
	global $a;
	$a = new Database();

} catch (Exception $e) {

}

try {
	date_default_timezone_set("Asia/Kolkata");
} catch (Exception $e) {

}


try {
	
	if(!isset($_SESSION[ SYSTEM_NAME.'ikey']))
	  $_SESSION[ SYSTEM_NAME.'ikey'] = getIkry();

} catch (Exception $e) {
	
}




function get_client_ip() {
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
  
 
function move_image($sourcePath, $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY) {	 
	global $a;
	$message = array( NULL, NULL);


	$retro = array('success' => 0 );


	$sourcePath =   '../uploads/';
	$targetPath =   '../images/products/';
	$ret = 0;
// if(rename($sourcePath,$targetPath)) {
// 	$ret = 1;
// } else {
// 	$sourcePath =   '../products/images/'. $name;
// 	$targetPath =   '../products/images/'. $name; 
// 	if(rename($sourcePath,$targetPath))
// 		$ret = 1;
// 	else
// 		$ret = 0;
// }

	if (!file_exists($sourcePath.$name))
		if (file_exists($targetPath.$name)){
			$sourcePath = $targetPath;
		}


		try {
			//$vb = remove_image(  $name ) ; 
		} catch (Exception $e) {

		}



		$ret = crop ($dataX, $dataY, $dataWidth, $dataHeight, $dataWidth, $dataHeight, $name,  $sourcePath , $targetPath );

		if ($ret == 0)			
			return $retro;

		// $movie_success = selectFromTable ('id', 'product', ' name = "'.$pname . '"  '   , $a );

		// if ($movie_success <1)			
		// 	return $retro;

 

  $result = 1;
		if( $result == 1) {

			$message [0] = 1;
			$message [1] = 'image successfully Updated'; 

		} else {
			$message [0] = 4;
			$message [1] = 'Something is wrong, ensure values are correct ! '; 
		}		



		$retro ['success'] = 1;

		$retro ['type'] = 0;
		$retro ['message'] = $message;


		return $retro;
	}


/////////////////////////
function move_image_basic( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY  ){	 
	global $a;
	$message = array( NULL, NULL);


	$retro = array('success' => 0 );


	$sourcePath =   '../uploads/';
	$targetPath =   '../images/home/';
	$ret = 0;



	if (!file_exists($sourcePath.$name))
		if (file_exists($targetPath.$name)){
			$sourcePath = $targetPath;
		}


		$ret = crop ($dataX, $dataY, $dataWidth, $dataHeight, $dataWidth, $dataHeight, $name,  $sourcePath , $targetPath );

		if ($ret == 0)			
			return $retro;


	$retro = array('success' => 90 );

		try {
			$delete = selectFromTable ( "  aboutimage ", 'basic ', ' id=1 ' , $a );
			if (file_exists($targetPath .$delete)) {
			unlink($targetPath . $delete); 
			} 
		} catch (Exception $e) {

		}



		$array = array(  "aboutimage"		 => $name ,
			"client" 		=> get_client_ip()
			);




$result  = updateTable ('basic', $array, ' id = 1 ', $a ); 
		$result = 1;
		if( $result == 1) {

			$message [0] = 1;
			$message [1] = 'image successfully Updated'; 

		} else {
			$message [0] = 4;
			$message [1] = 'Something is wrong, ensure values are correct ! '; 
		}		



		$retro ['success'] = 1;

		$retro ['type'] = 0;
		$retro ['message'] = $message;


		return $retro;
	}


////////////////////////////////////

function remove_image_detaild(  $name , $delete= false ) {
	global $a;
	$array = array(  
		"delete_status" 		=> 1 
		);


	$result  = updateTable ('image', $array, " name ='" . $name . "'  ", $a ); 
	// $result = 1;
	$src = '../images/products/'. $name; 

	try {
		if($delete)
			if (file_exists($src)) {
				unlink($src); 
			} 


		} catch (Exception $e) {

		}

		return $result;




	}

/////////////////////////////////////
			function get_image(  $name ) {
				global $a;
				$message = array( NULL, NULL);

				$retro = array('success' => 0 ); 

				$cat_success = selectFromTable ( "type, description0, description1, description2, description3, description4 , description5", 'image ', ' name = "'.$name . '" AND delete_status = 0 ' , $a );



				if( $cat_success) {


					$retro ['success'] = 1;
					$retro ['type'] = 1;
					$retro ['data'] = $cat_success;
				} else {
					$message [0] = 3;
					$message [1] = 'Something is wrong, ensure values are correct ! '; 


					$retro ['success'] = 1;

					$retro ['type'] = 0;
					$retro ['message'] = $message;
				}




				return $retro;
			}


 
function move_image_profile( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY , $id , $type) {	 
	global $a;
	$message = array( NULL, NULL);


	$retro = array('success' => 0 );


	$sourcePath =   '../uploads/';
	$targetPath =   '../lumieno/media/images/';
	$ret = 0;



	if (!file_exists($sourcePath.$name))
		if (file_exists($targetPath.$name)){
			$sourcePath = $targetPath;
		}


		$ret = crop ($dataX, $dataY, $dataWidth, $dataHeight, $dataWidth, $dataHeight, $name,  $sourcePath , $targetPath );

		if ($ret == 0)			
			return $retro;



// 		try {
// 			$delete = selectFromTable ( "  image ", 'profile ', ' id= ' . $id . ' AND type=' .$type , $a );
// 			if (file_exists($targetPath .$delete)) {
// //unlink($targetPath . $delete); 
// 			} 
// 		} catch (Exception $e) {

// 		}

  
		$result = 1;
		if( $result == 1) {

			$message [0] = 1;
			$message [1] = 'image successfully Updated'; 

		} else {
			$message [0] = 4;
			$message [1] = 'Something is wrong, ensure values are correct ! '; 
		}		



		$retro ['success'] = 1;

		$retro ['type'] = 0;
		$retro ['message'] = $message;


		return $retro;
	}


function get_admin_Image() {

	$xarray = array();

	$dirname = "../lumieno/media/images/";
	$images = glob($dirname."*.{jpg,png,gif}", GLOB_BRACE);
	$uo = 0;
	foreach($images as $image) {
		$xarray[$uo] = basename($image);
		$uo++;
	} 
	return $xarray;
}

function update_admin( $name, $email, $mobile, $landline, $address, $website, $description, $image ) {

	global $a;
	$mreturn  = 0;

	$retro = array('success' => 0 );
 
					
					$array = array(  "name"		 => $name ,
									 "email"	=> $email ,
									 "mobile" 		=> $mobile ,
									 "landline" 		=> $landline ,
									 "address" 		=> $address ,
									 "website" 		=> $website ,
									 "description" 		=> $description ,
									 "image" 		=> $image ,
									 "client" 		=> get_client_ip(), 
									 "date0" 		=> date("Y-m-d H:i:s")
									);


					$result  = updateTable ('lumieno', $array, " id != 0", $a ); 
					if( $result == 1) {
						$retro ['success'] = 1;

					} 
	return $retro;


}

function get_admin_details() {	

	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable ('name, email, mobile, landline, address, website, description, image ', 'lumieno', " id != 0 ORDER BY date LIMIT 1" , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;

	} 

	return $retro;
}

function update_login($username, $password, $newpassword, $repassword ) {

	global $a;
	$mreturn  = 0;

	$retro = array('success' => 0 );

	if( $newpassword != $repassword){
		return $retro;
	}

	$cat_success = selectFromTable (' id ', 'lumieno', " id != 0 AND password = '" . md5($password) . "'" , $a );
	
	if(!$cat_success)
		return array('success' => -1 );

					
					$array = array(  "username"		 => md5($username) ,
									 "password"	=> md5($newpassword) ,
									 "client" 		=> get_client_ip(), 
									 "date0" 		=> date("Y-m-d H:i:s")
									);


					$result  = updateTable ('lumieno', $array, " id != 0", $a ); 
					if( $result == 1) {
						$retro ['success'] = 1;

					} 
	return $retro;

}

function get_loginlog() {

	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable ('client, browser, DATE_FORMAT(ftime, "%d-%M-%Y  %r") AS time, attempt, success ', 'loginlog', " delete_status =0 AND type= 1 ORDER BY date DESC LIMIT 30 " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;

	} 

	return $retro;
}
 

function user_login($email, $password , $type) {
  
	global $a;


	$whew =  " client = '" . get_client_ip() 
	        ."' AND  ikey = '" . $_SESSION[ SYSTEM_NAME.'ikey']
	        ."'  ORDER BY date DESC LIMIT 1 ";

	      $countl0gin = 0;
	      try {
	      $countl0gin = selectFromTable (' attempt ', ' loginlog ', $whew  , $a );
	      	
	      } catch (Exception $e) {}
	      $countl0gin = 1 + $countl0gin ;
	 


	  $user0 = 0;

	 if ($type ==  1) {
	 	$user0 = 'distributor';
	 } else if ($type == 2) {
	 	$user0 = 'customer';
	 } else {
	 	return -1;
	 }
	 $type += 10;
	 	$query = 'select * from ' . $user0 . ' where email = :username and password = :password AND delete_status =0 AND login = 1';
	    
	    $params = array(
	      ':username' =>  $email,
	      ':password' =>  md5($password)
	    ); 
	     $user = $a->display( $query, $params );
	 
	    if( $user ) {
	      if($user[0]['email'] == $email &&   md5($password) == $user[0]['password']) {
	 
	      $_SESSION[SYSTEM_NAME.'userid'] = encrypt($email);
	      $_SESSION[SYSTEM_NAME.'type'] = encrypt($user0);

	  

	      $array = array(  "type"    => $type ,
	               "client"     => get_client_ip(),
	               "ftime"  => date("Y-m-d H:i:s") ,
	               "ltime"  => NULL ,
	               "browser"    => getBrowser(),
	               "os"    => getOS(),
	               "ikey"    => $_SESSION[ SYSTEM_NAME.'ikey'],
	               "success"    => 1,
	               "attempt"    => $countl0gin,
	               "username"    => $email,
	               "date"    => date("Y-m-d H:i:s")
	              );
	      $result  = insertInToTable ('loginlog', $array, $a );






return 1;



	 
	      $true_log = false;
	      exit();
	    } else { 


	          $array = array(  "type"    => $type,
	               "client"     => get_client_ip(),
	               "ftime"  => date("Y-m-d H:i:s") ,
	               "ltime"  => date("Y-m-d H:i:s") , 
	               "browser"    => getBrowser(),
	               "os"    => getOS(),
	               "ikey"    => $_SESSION[ SYSTEM_NAME.'ikey'],
	               "success"    => 0,
	               "attempt"    => $countl0gin,
	               "username"    => $eamil,
	               "password"    => $password,
	               "date"    => date("Y-m-d H:i:s")
	              );
	      $result  = insertInToTable ('loginlog', $array, $a );

	      	return 0;

	    }
	 }else {  

	            $array = array(  "type"    => $type ,
	               "client"     => get_client_ip(),
	               "ftime"  => date("Y-m-d H:i:s") ,
	               "ltime"  => date("Y-m-d H:i:s") , 
	               "browser"    => getBrowser(),
	               "os"    => getOS(),
	               "ikey"    => $_SESSION[ SYSTEM_NAME.'ikey'],
	               "success"    => 0,
	               "attempt"    => $countl0gin,
	               "username"    => $email,
	               "password"    => $password,
	               "date"    => date("Y-m-d H:i:s")
	              ); 
	      $result  = insertInToTable ('loginlog', $array, $a );


	      return 0;
	    
	    }






}




function get_site_basic() {

	$retro = array('success' => 0 );
 	
	global $a; 

	$cat_success = selectFromTable (' * ', 'lumieno', " delete_status =0 AND id= 1 ORDER BY date DESC LIMIT 1 " , $a );
		if( $cat_success ) {
			$admin = $cat_success[0];
		$retro ['success'] = 1;

		$retro ['adminName'] = $admin['name'];
		$retro ['adminEmail'] = $admin['email'];
		$retro ['adminMobile'] = $admin['mobile'];
		$retro ['adminLandline'] = $admin['landline'];
		$retro ['adminAddress'] = $admin['address'];
		$retro ['adminWebsite'] = $admin['website'];
		$retro ['adminImage'] = 'lumieno/media/images/'.$admin['image'];

	}


	$cat_success = selectFromTable (' * ', 'basic', "  id= 1 ORDER BY date DESC LIMIT 1 " , $a );
		if( $cat_success ) {
			$basic = $cat_success[0];
 

		$retro ['basicAddress'] = $basic['address'];
		$retro ['basicEmail'] = $basic['email'];
		$retro ['basicMobile'] = $basic['mobile'];
		$retro ['basicLandline'] = $basic['landline'];
		$retro ['basicDescription1'] = $basic['description1'];
		$retro ['basicDescription2'] = $basic['description2'];
		$retro ['basicDescription3'] = $basic['description3'];
		$retro ['basicDescription4'] = $basic['description4'];
		$retro ['basicFeatures1H'] = $basic['features1H'];
		$retro ['basicFeatures1M'] = $basic['features1M'];
		$retro ['basicFeatures2H'] = $basic['features2H'];
		$retro ['basicFeatures2M'] = $basic['features2M'];
		$retro ['basicFeatures3H'] = $basic['features3H'];
		$retro ['basicFeatures3M'] = $basic['features3M'];
		$retro ['basicAboutH'] = $basic['aboutH'];
		$retro ['basicAboutM'] = $basic['aboutM'];
		$retro ['basicAboutHH'] = $basic['aboutHH'];
		$retro ['basicAboutMM'] = $basic['aboutMM'];
		$retro ['basicVision'] = $basic['vision'];
		$retro ['basicMission'] = $basic['mission']; 
		$retro ['basicDescriptionteam'] = $basic['descriptionteam'];
		$retro ['basicMap'] = $basic['map'];
		$retro ['basicMapmsg'] = $basic['mapmsg'];		
		$retro ['basicAboutImage'] = 'images/home/'.$basic['aboutimage'];

	}


 	$retro['adminname'] = "sdfsf";

	return $retro;
}

function update_basic(	$address , $email, $number, $landline, $description1, $description2, $description3, $description4, $features1H, $features1M, $features2H, $features2M , $features3H , $features3M, $aboutH , $aboutM, $aboutHH, $aboutMM, $vision, $mission, $team, $map, $mapMsg,$image ) {



	global $a;
	$mreturn  = 0;

	$retro = array('success' => 0 );

					$array = array(  "address"		 => $address ,
									 "email"	=> $email ,
									 "mobile"	=> $number ,
									 "landline"	=> $landline ,
									 "description1"	=> $description1 ,
									 "description2"	=> $description2 ,
									 "description3"	=> $description3 ,
									 "description4"	=> $description4 ,
									 "features1H"	=> $features1H ,
									 "features1M"	=> $features1M ,
									 "features2H"	=> $features2H ,
									 "features2M"	=> $features2M ,
									 "features3H"	=> $features3H ,
									 "features3M"	=> $features3M ,
									 "aboutH"	=> $aboutH ,
									 "aboutM"	=> $aboutM ,
									 "aboutHH"	=> $aboutHH ,
									 "aboutMM"	=> $aboutMM ,
									 "vision"	=> $vision ,
									 "mission"	=> $mission ,
									 "aboutimage" 		=> $image ,
									 "descriptionteam" 		=> $team ,
									 "map" 		=> $map ,
									 "mapmsg" 		=> $mapMsg , 
									 "client" 		=> get_client_ip(), 
									 "date0" 		=> date("Y-m-d H:i:s")
									);


					$result  = updateTable ('basic', $array, " id != 0", $a ); 
					if( $result == 1) {
						$retro ['success'] = 1;

					} 
	return $retro;

}
 
function get_basic() {

	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable (' `address`, `email`, `mobile`  , `landline`, `description1`, `description2`, `description3`, `description4`, `features1H`, `features1M`, `features2H`, `features2M`, `features3H`, `features3M`, `aboutH`, `aboutM`, `aboutHH`, `aboutMM`, `vision`, `mission`, `aboutimage` AS image, `descriptionteam` AS team, `map`, `mapmsg` AS mapMsg', 'basic', "   id= 1 ORDER BY date DESC LIMIT 1 " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;

	} 

	return $retro;
}
 
function subscribe_email($email) {
 

		global $a; 
	

		$cat_success = selectFromTable ( " email ", ' newsletter ', '  email = "'.$email .'"'  , $a );
		
		if ($cat_success) { 
			return -1;
		} else {
 
			$array = array(  "email"		 => $email , 
							 "client" 		=> get_client_ip()
							);
			$result  = insertInToTable ('newsletter', $array, $a );
			if( $result == 1) {
				return 1;

			} else {
				return 0;
			}	




		}
		
		return 0;
 

}



function add_email($name , $email, $telephone, $message  ) {
	global $a; 
	
	
		$array = array(  "name"		 => $name , 
						"email"		 => $email , 
						"telephone"		 => $telephone ,
						"message"		 => $message , 
						 "client" 		=> get_client_ip()
						);
		$result  = insertInToTable ('mails', $array, $a );
		if( $result == 1) {
			return 1;

		} else {
			return 0;
		}	



	
	
	return 0;


}




function get_emails() {

	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable ('`name`, `email`, `telephone`, `message`, `client`, `date`, DATE_FORMAT( date , "%d-%M-%Y  %r") AS datea  ', 'mails', "   id > 0 ORDER BY date DESC LIMIT 100 " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;
		 

	} 

	return $retro;


}

function add_category($name , $description, $image ) {
	global $a; 

		$cat_success = selectFromTable (' * ', 'category', "   name ='". $name ."' " , $a );
			if( $cat_success ) {
				return -1;

		} 

	
	
		$array = array(  "name"		 => $name , 
						"description"=> $description , 
						"image"		 => $image,
						 "client" 		=> get_client_ip()
						);
		$result  = insertInToTable ('category', $array, $a );
		if( $result == 1) {
			return 1;

		} else {
			return 0;
		}	



	
	
	return 0;

}







/////////////////////////
function move_image_category( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY  ){	 
	global $a;
	$message = array( NULL, NULL);


	$retro = array('success' => 0 );


	$sourcePath =   '../uploads/';
	$targetPath =   '../images/category/';
	$ret = 0;



	if (!file_exists($sourcePath.$name))
		if (file_exists($targetPath.$name)){
			$sourcePath = $targetPath;
		}


		$ret = crop ($dataX, $dataY, $dataWidth, $dataHeight, $dataWidth, $dataHeight, $name,  $sourcePath , $targetPath );

		if ($ret == 0)			
			return $retro;


	$retro = array('success' => 90 );

		try {
			$delete = selectFromTable ( "  aboutimage ", 'basic ', ' id=1 ' , $a );
			if (file_exists($targetPath .$delete)) {
			//unlink($targetPath . $delete); 
			} 
		} catch (Exception $e) {

		}



		$array = array(  "aboutimage"		 => $name ,
			"client" 		=> get_client_ip()
			);




// $result  = updateTable ('basic', $array, ' id = 1 ', $a ); 
		$result = 1;
		if( $result == 1) {

			$message [0] = 1;
			$message [1] = 'image successfully Updated'; 

		} else {
			$message [0] = 4;
			$message [1] = 'Something is wrong, ensure values are correct ! '; 
		}		



		$retro ['success'] = 1;

		$retro ['type'] = 0;
		$retro ['message'] = $message;


		return $retro;
	}





function get_category() {

	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable (' id, `name`, `description`, `image`,  `client`, `date`, DATE_FORMAT( date , "%d-%M-%Y  %r") AS datea , delete_status AS deleted ', 'category', "   id > 0 ORDER BY date DESC LIMIT 100 " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;
		 

	} 

	return $retro;


}


function get_cat_Image() {

	$xarray = array();

	$dirname = "../images/category/";
	$images = glob($dirname."*.{jpg,png,gif}", GLOB_BRACE);
	$uo = 0;
	foreach($images as $image) {
		$xarray[$uo] = basename($image);
		$uo++;
	} 
	return $xarray;
}




function edit_category($name , $description, $image, $delete  ) {
	global $a; 

 
	
		$array = array(  
						"description"=> $description , 
						"image"		 => $image,
						"client" 		=> get_client_ip(),
						"delete_status" => $delete 
						);
		$result  = updateTable ('category', $array, ' name = "'.$name.'"', $a );
		if( $result == 1) {
			return 1;

		} else {
			return 0;
		}	



	
	
	return 0;

}


function add_product( $category , $name, $oldPrice , $newPrice, $count, $new, $rating, $description, $images ) {
if($new == "true")
	$newa = 1;
else  
	$newa = 0;

 $new = $newa;
 


	global $a; 
	$cat_success = selectFromTable (' id ', 'product', " name='" . $name . "' " , $a );
		if( $cat_success > 0 ) {
			return -1;
		}
 
		$dat0 =  date("Y-m-d H:i:s");
		$array = array(  
						"category"=> $category , 
						"name"=> $name , 
						"oldPrice"=> $oldPrice , 
						"newPrice"=> $newPrice , 
						"count"=> $count , 
						"new"=> $new , 
						"rating"=> $rating , 
						"description"=> $description ,  
						"client" 		=> get_client_ip(), 
						"date" => $dat0 
						); 
		$result  = insertInToTable ('product', $array, $a );
		if( $result == 1) {

			$cat_success = selectFromTable (' id ', 'product', " name='" . $name . "' AND date = '" . $dat0 . "' AND delete_status = 0 " , $a );
				if( $cat_success > 0 ) {

					$image = json_decode($images);			  
					 
					foreach( $image as $value ){ 
					  $array = get_object_vars($value);
					  
					  $array = array(  
					  				"product"=> $cat_success , 
					  				"name"=> $array['name'] ,  
					  				"client" 		=> get_client_ip(), 
					  				"date" => $dat0 
					  				);
					  $result  = insertInToTable ('image', $array, $a );

					}

				} 

			return 1;

		} else {
			return 0;
		}	



	
	
	return 0;


}


function get_product() {




	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable ('p.name, c.name AS category, p.oldPrice AS oprice , p.newPrice AS nprice, p.count, p.new, p.rating AS rate, p.delete_status AS deletes ,  DATE_FORMAT( p.date , "%d-%M-%Y  %r") AS date  ', '`product` p LEFT JOIN category c ON c.id = p.category ', "   p.id > 0 ORDER BY p.name ASC " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;
		 

	} 

	return $retro;

}


function get_product_details($product) {




	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable ('p.name, c.name AS category, p.oldPrice AS oprice , p.newPrice AS nprice, p.count, p.new, p.rating AS rate, p.delete_status AS deletes ,  DATE_FORMAT( p.date , "%d-%M-%Y  %r") AS date, p.category AS category_id, p.description , p.client ', '`product` p LEFT JOIN category c ON c.id = p.category ', "   p.name = '".$product."' ORDER BY p.date DESC " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;
		 

	} 

	$cat_success = selectFromTable ('i.name , p.name AS product  ', '`image` i LEFT JOIN product p ON i.product = p.id ', 
		"  i.delete_status = 0 AND p.name = '".$product."' ORDER BY i.date DESC " , $a );
		if( $cat_success ) { 
		$retro ['image'] = $cat_success;
		 

	} 

	return $retro;
}


function update_product( $category , $name, $oldPrice , $newPrice, $count, $new, $rating, $description, $images, $delete  ) {
	if($new == "true")
		$newa = 1;
	else  
		$newa = 0;

	 $new = $newa;
	 
	if($delete == "true")
		$newa = 1;
	else  
		$newa = 0;

	 $delete = $newa;



		global $a; 
		$pro_id = selectFromTable (' id ', 'product', " name='" . $name . "' " , $a );
			if( $pro_id <1 ) {
				return -1;
			}
	 
			$dat0 =  date("Y-m-d H:i:s");
			$array = array(  
							"category"=> $category , 
							"name"=> $name , 
							"oldPrice"=> $oldPrice , 
							"newPrice"=> $newPrice , 
							"count"=> $count , 
							"new"=> $new , 
							"rating"=> $rating , 
							"description"=> $description ,  
							"delete_status"=> $delete ,  
							"client" 		=> get_client_ip(), 
							"date" => $dat0 
							); 
			$result  = updateTable ('product', $array, " id = ".$pro_id, $a );
			if( $result == 1) {

					if( $pro_id > 0 ) {

						$image = json_decode($images);			  
						 
						foreach( $image as $value ){ 
						  $array = get_object_vars($value);

						    $cat_success = selectFromTable (' id ', 'image', " name='" . $array['name'] . "' AND product =" . $pro_id . " " , $a );
						  


						  if($cat_success < 1){
							  
							  $array = array(  
							  				"product"=> $pro_id , 
							  				"name"=> $array['name'] ,  
							  				"client" 		=> get_client_ip(), 
							  				"date" => $dat0 
							  				);
							  $result  = insertInToTable ('image', $array, $a );
						}

						}

					} 

				return 1;

			} else {
				return 0;
			}	



		
		
		return 0;


}




function add_specification( $product , $name, $value   ) {




		global $a; 
		$cat_success = selectFromTable (' id ', 'product', " name='" . $product . "' " , $a );
			if( $cat_success <1 ) {
				return -1;
			}
	 
			$dat0 =  date("Y-m-d H:i:s");
			$array = array(  
							"product"=> $cat_success , 
							"name"=> $name , 
							"value"=> $value ,
							"client" 		=> get_client_ip(), 
							"date" => $dat0 
							); 
			$result  = insertInToTable ('specification', $array, $a );
			if( $result == 1) {

			 
				return 1;

			} else {
				return 0;
			}	



		
		
		return 0;

}


function get_product_specification( $product ) {


	global $a;
	$retro = array('success' => 0 , 'data' => null);
	global $a; 
	$cat_success = selectFromTable (' id ', 'product', " name='" . $product . "' " , $a );
		if( $cat_success <1 ) {
			return -1;
		}

	$cat_success = selectFromTable (' name, value ', 'specification', " product = ".$cat_success." AND delete_status =0 ORDER BY name ASC " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;
		 

	} 

	return $retro;
}


function remove_specification(  $product , $name, $value  ) {



	global $a; 
	$cat_success = selectFromTable (' id ', 'product', " name='" . $product . "' " , $a );
		if( $cat_success <1 ) {
			return -1;
		}
	
		$dat0 =  date("Y-m-d H:i:s");
		$array = array(   
						"delete_status"=> 1 ,
						"client" 		=> get_client_ip(), 
						"date0" => $dat0 
						); 
		$result  = updateTable ('specification', $array, " product =".$cat_success." AND name ='" . $name ."' AND value = '" . $value . "'", $a );
		if( $result == 1) {

		 
			return 1;

		} else {
			return 0;
		}	



	
	
	return 0;


}


/////////////////////////
function move_image_team( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY  ){	 
	global $a;
	$message = array( NULL, NULL);


	$retro = array('success' => 0 );


	$sourcePath =   '../uploads/';
	$targetPath =   '../images/team/';
	$ret = 0;



	if (!file_exists($sourcePath.$name))
		if (file_exists($targetPath.$name)){
			$sourcePath = $targetPath;
		}


		$ret = crop ($dataX, $dataY, $dataWidth, $dataHeight, $dataWidth, $dataHeight, $name,  $sourcePath , $targetPath );

		if ($ret == 0)			
			return $retro;


	$retro = array('success' => 90 );

  
		$result = 1;
		if( $result == 1) {

			$message [0] = 1;
			$message [1] = 'image successfully Updated'; 

		} else {
			$message [0] = 4;
			$message [1] = 'Something is wrong, ensure values are correct ! '; 
		}		



		$retro ['success'] = 1;

		$retro ['type'] = 0;
		$retro ['message'] = $message;


		return $retro;
	}





	function add_team( $name, $email, $position , $mobile, $landline, $address, $website, $description, $image ) {


		global $a;

			$cat_success = selectFromTable (' id ', 'profile', " email='" . $email . "' OR mobile = ".$mobile , $a );
		if( $cat_success >0 ) {
			return -1;
		}
						
						$array = array(  "name"		 => $name ,
										 "type"	=> 3 ,
										 "position"	=> $position ,
										 "email"	=> $email ,
										 "mobile" 		=> $mobile ,
										 "landline" 		=> $landline ,
										 "address" 		=> $address ,
										 "website" 		=> $website ,
										 "description" 		=> $description ,
										 "image" 		=> $image ,
										 "client" 		=> get_client_ip(), 
										 "date0" 		=> date("Y-m-d H:i:s")
										);


						$result  = insertInToTable ('profile', $array, $a ); 
						if( $result == 1) {
							return 1;

						} 
		return 0;
	}


	function get_team() {
		global $a;
		$retro = array('success' => 0 , 'data' => null);

		$cat_success = selectFromTable ('name, type, position, email, mobile, landline, address, website, description, image, delete_status AS deletes, DATE_FORMAT( date , "%d-%M-%Y  %r") AS date ', 'profile', " type=3 ORDER BY name " , $a );
			if( $cat_success ) {
			$retro ['success'] = 1;
			$retro ['data'] = $cat_success;

		} 

		return $retro;
	}



	function get_team_one($member) {

		global $a;
		$retro = array('success' => 0 , 'data' => null);

		$cat_success = selectFromTable ('name, type, position, email, mobile, landline, address, website, description, image, delete_status AS deletes, DATE_FORMAT( date , "%d-%M-%Y  %r") AS date ', 'profile', " type=3 AND email ='". $member ."' ORDER BY name " , $a );
			if( $cat_success ) {
			$retro ['success'] = 1;
			$retro ['data'] = $cat_success;

		} 

		return $retro;
	}



	function update_team( $name, $email, $position , $mobile, $landline, $address, $website, $description, $image, $delete ) {

		global $a;
		 
		if($delete == "true")
			$newa = 1;
		else  
			$newa = 0;

		 $delete = $newa;

 

			$cat_success = selectFromTable (' id ', 'profile', " email='" . $email . "' ", $a );
		if( $cat_success <1 ) {
			return -1;
		}
						
						$array = array(  "name"		 => $name ,
										 "type"	=> 3 ,
										 "position"	=> $position ,
										 "email"	=> $email ,
										 "mobile" 		=> $mobile ,
										 "landline" 		=> $landline ,
										 "address" 		=> $address ,
										 "website" 		=> $website ,
										 "description" 		=> $description ,
										 "image" 		=> $image ,
										 "delete_status" 		=> $delete ,
										 "client" 		=> get_client_ip(), 
										 "date0" 		=> date("Y-m-d H:i:s")
										);


						$result  = updateTable ('profile', $array, ' id = '.$cat_success, $a ); 
						if( $result == 1) {
							return 1;

						} 
		return 0;

	}





	function add_link($name, $url, $icon, $user) {

		global $a; 

		if ($user == null) {
			$user = 0;
		} else {
			$user = $cat_success = selectFromTable (' id ', 'profile', " email='" . $user . "' ", $a );
			if( $user < 1 ) {
					return -1;

			} 
		}


		$cat_success = selectFromTable (' id ', 'link', " user='" . $user . "' AND name = '" . $name ."' AND delete_status = 0 ", $a );
		if( $cat_success >0 ) {
			return -1;
		}

		
		$array = array(  "name"		 => $name , 
						"url"=> $url , 
						"icon"		 => $icon,
						"user"		 => $user,
						 "client" 		=> get_client_ip()
						);
		$result  = insertInToTable ('link', $array, $a );
		if( $result == 1) {
			return 1;

		} else {
			return 0;
		}	



		
		
		return 0;
	}



	function get_link($user) {

		global $a;

		if ($user == null) {
			$user = 0;
		} else {
			$user = $cat_success = selectFromTable (' id ', 'profile', " email='" . $user . "' ", $a );
			if( $user < 1 ) {
					return -1;

			} 
		}

		$retro = array('success' => 0 , 'data' => null);

		$cat_success = selectFromTable ('name, url, icon, DATE_FORMAT( date , "%d-%M-%Y  %r") AS date ', 'link', " delete_status =0 AND  user=".$user , $a );
			if( $cat_success ) {
			$retro ['success'] = 1;
			$retro ['data'] = $cat_success;

		} 

		return $retro;


	}





	function update_link($name, $user) {


		global $a; 

		if ($user == null) {
			$user = 0;
		} else {
			$user = $cat_success = selectFromTable (' id ', 'profile', " email='" . $user . "' ", $a );
			if( $user < 1 ) {
					return -1;

			} 
		}


		$cat_success = selectFromTable (' id ', 'link', " user=" . $user . " AND name = '" . $name ."'   ", $a );
		if( $cat_success <1 ) {
			return -1;
		}

		
		$array = array( "delete_status"		 => 1,
						 "client" 		=> get_client_ip()
						);
		$result  = updateTable ('link', $array, ' user='.$user.' AND name = "'.$name.'" ', $a );
		if( $result == 1) {
			return 1;

		} else {
			return 0;
		}	



		
		
		return 0;

	}


	function get_team_basic() {
		global $a;
		$retro = array('success' => 0 , 'data' => null);
		$dedo = array();

		$cat_success = selectFromTable ('id, name ,mobile, image ', 'profile', " type=3 ORDER BY name " , $a ); 
			if( $cat_success ) {
				$bo = 0 ;
				foreach ($cat_success as $key => $value) { 
					  

					$cat_success = selectFromTable ('name, url, icon ', 'link', " delete_status =0 AND  user=".$value['id'] , $a );
 
					$dedo[$bo] = array( 'name' => $value['name'],
										'mobile' => $value['mobile'],
										'image' => $value['image'],
										 'links' => $cat_success);

					$bo++;
				} 


			$retro ['success'] = 1;
			$retro ['data'] = $dedo;

		} 

		return $retro;
	}


function move_image_look( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY  ){	 
	global $a;
	$message = array( NULL, NULL);


	$retro = array('success' => 0 );


	$sourcePath =   '../uploads/';
	$targetPath =   '../images/look/';
	$ret = 0;



	if (!file_exists($sourcePath.$name))
		if (file_exists($targetPath.$name)){
			$sourcePath = $targetPath;
		}


		$ret = crop ($dataX, $dataY, $dataWidth, $dataHeight, $dataWidth, $dataHeight, $name,  $sourcePath , $targetPath );

		if ($ret == 0)			
			return $retro;
 
		$result = 1;
		if( $result == 1) {

			$message [0] = 1;
			$message [1] = 'image successfully Updated'; 

		} else {
			$message [0] = 4;
			$message [1] = 'Something is wrong, ensure values are correct ! '; 
		}		



		$retro ['success'] = 1;

		$retro ['type'] = 0;
		$retro ['message'] = $message;


		return $retro;
	}



	function update_look( $product1, $product2, $product3, $description1, $description2, $description3, $description4, $description5, $description6, $description7, $description8, $description9, $description10, $description11, $description12, $description13, $description14, $image1, $image2, $image3  ) {


		global $a;
		$mreturn  = 0;

		$retro = array('success' => 0 );
		
						
						$array = array(  "product1"		 => $product1 ,
										 "product2"		 => $product2 ,
										 "product3"		 => $product3 ,

										 "description1"		 => $description1 ,
										 "description2"		 => $description2 ,
										 "description3"		 => $description3 ,
										 "description4"		 => $description4 ,
										 "description5"		 => $description5 ,
										 "description6"		 => $description6 ,
										 "description7"		 => $description7 ,
										 "description8"		 => $description8 ,
										 "description9"		 => $description9 ,
										 "description10"		 => $description10 ,
										 "description11"		 => $description11 ,
										 "description12"		 => $description12,
										 "description13"		 => $description13 ,
										 "description14"		 => $description14,
										 "image1"		 => $image1 ,
										 "image2"		 => $image2 ,
										 "image3"		 => $image3 ,
										 "client" 		=> get_client_ip(), 
										 "date0" 		=> date("Y-m-d H:i:s")
										);


						$result  = updateTable ('look', $array, " id != 0", $a ); 
						if( $result == 1) {
							$retro ['success'] = 1;

						} 
		return $retro;
	}



	function get_look() {

		global $a;
		$retro = array('success' => 0 , 'data' => null);

		$cat_success = selectFromTable ('`product1`, `product2`, `product3`, `description1`, `description2`, `description3`, `description4`, `description5`, `description6`, `description7`, `description8`, `description9`, `description10`, `description11`, `description12`, `description13`, `description14`, `image1`, `image2`, `image3`', 'look', " id>0  LIMIT 1 " , $a );
			if( $cat_success ) {
			$retro ['success'] = 1;
			$retro ['data'] = $cat_success;
			$retro ['products'] = get_product();

		} 

		return $retro;
	}



function get_product_0() {

		global $a;
		$retro = array('success' => 0 , 'data' => null);
		$dedo = array();

		$cat_success = selectFromTable ('* ', 'product', " delete_status = 0 ORDER BY date DESC " , $a ); 

			if( $cat_success ) {
				$bo = 0 ;
				foreach ($cat_success as $key => $value) { 
					   
					$cat_success1 = selectFromTable ('p.name, c.name AS category, p.oldPrice AS oprice , p.newPrice AS nprice, p.count, p.new, p.rating AS rate, p.delete_status AS deletes ,  DATE_FORMAT( p.date , "%d-%M-%Y  %r") AS date, p.category AS category_id, p.description , p.client ', '`product` p LEFT JOIN category c ON c.id = p.category ', "   p.id = ".$value['id'] ." ORDER BY p.date DESC " , $a );
				 

					$cat_success2 = selectFromTable ('i.name , p.name AS product  ', '`image` i LEFT JOIN product p ON i.product = p.id ', 
						"  i.delete_status = 0 AND p.id = ".$value['id'] ." ORDER BY i.date DESC " , $a );
						 
 
					$dedo[$bo] = array( 'name' => $value['name'],
										'product' => $cat_success1[0],
										 'images' => $cat_success2);

					$bo++;
				} 


			$retro ['success'] = 1;
			$retro ['data'] = $dedo;

		} 

		return $retro;

 
}



function get_product_1($product) {




	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable ('p.name, c.name AS category, p.oldPrice AS oprice , p.newPrice AS nprice, p.count, p.new, p.rating AS rate, p.delete_status AS deletes ,  DATE_FORMAT( p.date , "%d-%M-%Y  %r") AS date, p.category AS category_id, p.description , p.client ', '`product` p LEFT JOIN category c ON c.id = p.category ', "   p.name = '".$product."' AND p.delete_status = 0 ORDER BY p.date DESC " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;
		 

	} 

	$cat_success = selectFromTable ('i.name , p.name AS product  ', '`image` i LEFT JOIN product p ON i.product = p.id ', 
		"  i.delete_status = 0 AND p.name = '".$product."' ORDER BY i.date DESC " , $a );
		if( $cat_success ) { 
		$retro ['image'] = $cat_success;
		 

	} 


	$cat_success = selectFromTable (' s.name, s.value ', 'specification s  LEFT JOIN product p ON s.product = p.id ', "  s.delete_status = 0 AND p.name = '".$product."' ORDER BY s.name ASC " , $a );
		if( $cat_success ) {
		$retro ['specification'] = $cat_success;
		 

	} 



	return $retro;
}

// ================================



	function set_first($browserName, $fullVersion, $majorVersion, $appName, $userAgent, $OSName ) {
		global $a;

		$brow =   'Browser name  = '.$browserName.'<br>'
 .'Full version  = '.$fullVersion.'<br>'
 .'Major version = '.$majorVersion.'<br>'
 .'navigator.appName = '.$appName.'<br>'
 .'navigator.userAgent = '.$userAgent.'<br>' ;

 		$key = time();
 		$key = $key + rand(10,10000000);


		$array = array(  
						"client" 		=> get_client_ip(),
						 "ftime"	=> date("Y-m-d H:i:s") ,
						 "browser"	=> $brow, 
						 "os"	=> $OSName , 
						 "ikey"  => $key

						);
		$result  = insertInToTable ('view', $array, $a );
		 return $key;	
	}


	function set_last($browserName, $fullVersion, $majorVersion, $appName, $userAgent, $OSName, $key ) {
		global $a;
		$array = array(   
						 "ltime"	=> date("Y-m-d H:i:s")  
						);


		$result  = updateTable ('view', $array, 

			' client ="'.get_client_ip().'" AND os = "'.$OSName.'"  AND ikey = ' .$key

			, $a ); 

		 return $result;	
	}






//=============================


function check_login() { 
	global $a;
	$retro = array('success' => 0 );

	if (isset( $_SESSION[SYSTEM_NAME.'userid'] )) {
		if (isset(  $_SESSION[SYSTEM_NAME.'type'] )) {
			$username = decrypt( $_SESSION[SYSTEM_NAME.'userid'] );
			$usertype = decrypt( $_SESSION[SYSTEM_NAME.'type'] );
			if ($usertype == 'admin') {
				$usertype = 'lumieno';				  
			} 
			$cat_success = selectFromTable (' name, image, email ', $usertype , "  email = '" . $username . "' AND delete_status = 0  LIMIT 1" , $a );
				if( $cat_success ) {					
					 	$retro ['success'] = 1;
					 	$cat_success[0] ['type'] = $usertype;
						$retro ['data'] = $cat_success[0];

			} else { return  $retro; }

		} else { return  $retro; }
	} else { return  $retro; }

	return  $retro;
}



function get_views() {

	global $a;
	$retro = array('success' => 0 , 'data' => null);
	
	$cat_success = selectFromTable ('*, DATE_FORMAT(ftime, "%d-%M-%Y   %r") AS ffdate , DATE_FORMAT(ltime, "%d-%M-%Y   %r") AS lldate,  TIMEDIFF( ftime, ltime) AS dtime ', 'view', "   id > 0  ORDER BY date DESC LIMIT 500 " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;
		 

	} 

	return $retro;


}





 
function move_image_distributor( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY , $id , $type) {	 
	global $a;
	$message = array( NULL, NULL);


	$retro = array('success' => 0 );


	$sourcePath =   '../uploads/';
	$targetPath =   '../distributor/media/images/';
	$ret = 0;


 

		$ret = crop ($dataX, $dataY, $dataWidth, $dataHeight, $dataWidth, $dataHeight, $name,  $sourcePath , $targetPath );

		if ($ret == 0)			
			return $retro;


 
  
		$result = 1;
		if( $result == 1) {

			$message [0] = 1;
			$message [1] = 'image successfully Updated'; 

		} else {
			$message [0] = 4;
			$message [1] = 'Something is wrong, ensure values are correct ! '; 
		}		



		$retro ['success'] = 1;

		$retro ['type'] = 0;
		$retro ['message'] = $message;


		return $retro;
	}




	function add_distributor( $name, $email, $password, $dob , $mobile, $landline, $address, $pin, $description, $image ) {

        $dob = date("Y-m-d", strtotime($dob) );

		global $a;







			$cat_success = selectFromTable (' id ', 'distributor', " email='" . $email . "' OR mobile = ".$mobile , $a );
		if( $cat_success >0 ) {
			return -1;
		}
						
						$array = array(  "name"		 => $name , 
										 "dob"	=> $dob ,
										 "password"	=> md5($password) ,
										 "email"	=> $email ,
										 "mobile" 		=> $mobile ,
										 "landline" 		=> $landline ,
										 "address" 		=> $address ,
										 "pin" 		=> $pin ,
										 "description" 		=> $description ,
										 "image" 		=> $image ,
										 "client" 		=> get_client_ip(), 
										 "date0" 		=> date("Y-m-d H:i:s")
										);


						$result  = insertInToTable ('distributor', $array, $a ); 


		try {
			$aemail = "admin";
			$aemail = selectFromTable(" email ", "lumieno", " delete_status=0 ", $a); 
			$return_x = reset_password_z($email , $password, $name , $aemail);
		} catch (Exception $e) {
			
		}



						if( $result == 1) {
							return 1;

						} 
		return 0;
	}


	function get_distributor() {
		global $a;
		$retro = array('success' => 0 , 'data' => null);

		$cat_success = selectFromTable ('name, dob, email, mobile, landline, address, pin, description, image, delete_status AS deletes, DATE_FORMAT( date , "%d-%M-%Y  %r") AS date ', 'distributor', "  id>0 ORDER BY name " , $a );
			if( $cat_success ) {
			$retro ['success'] = 1;
			$retro ['data'] = $cat_success;

		} 

		return $retro;
	}



	function get_distributor_one($member) {

		global $a;
		$retro = array('success' => 0 , 'data' => null);

		$cat_success = selectFromTable ('name, dob, email, mobile, landline, address, pin, description, image, delete_status AS deletes, DATE_FORMAT( date , "%d-%M-%Y  %r") AS date ', 'distributor', " id>0 AND email ='". $member ."' ORDER BY name " , $a );
			if( $cat_success ) {
			$retro ['success'] = 1;
			$retro ['data'] = $cat_success;

		} 

		return $retro;
	}



	function update_distributor( $name, $email, $position , $mobile, $landline, $address, $website, $description, $image, $delete ) {
 
		global $a;
		 
		if($delete == "true")
			$newa = 1;
		else  
			$newa = 0;

		 $delete = $newa;

 

			$cat_success = selectFromTable (' id ', 'distributor', " email='" . $email . "' ", $a );
		if( $cat_success <1 ) {
			return -1;
		}
						
						$array = array(  "name"		 => $name , 
										 "dob"	=> $dob ,
										 "email"	=> $email ,
										 "mobile" 		=> $mobile ,
										 "landline" 		=> $landline ,
										 "address" 		=> $address ,
										 "pin" 		=> $pin ,
										 "description" 		=> $description ,
										 "image" 		=> $image ,
										 "delete_status" 		=> $delete ,
										 "client" 		=> get_client_ip(), 
										 "date0" 		=> date("Y-m-d H:i:s")
										);


						$result  = updateTable ('distributor', $array, ' id = '.$cat_success, $a ); 
						if( $result == 1) {
							return 1;

						} 
		return 0;

	}


	function exitMe() {
		global $a;
		try {
			$array = array( 
			         "ltime"  => date("Y-m-d H:i:s")
			        );
			$result  = updateTable ('loginlog', $array, ' ikey = "' . $_SESSION[ SYSTEM_NAME.'ikey'] . '"', $a );

			session_start(); 
			session_destroy();
			return 1;
		} catch (Exception $e) {
			return 0;
		}
	}




	function add_customer( $name, $email, $password, $mobile, $address, $pin ) {


		global $a; 


 
 

		$cat_success = selectFromTable (' id ', 'customer', " email='" . $email . "' ", $a );
		if( $cat_success >0 ) {
			return -1;
		}
		$cat_success = selectFromTable (' id ', 'customer', " mobile = ".$mobile , $a );
		if( $cat_success >0 ) {
			return -2;
		}
						
						$array = array(  "name"		 => $name ,  
										 "password"	=> md5($password) ,
										 "email"	=> $email ,
										 "mobile" 		=> $mobile , 
										 "address" 		=> $address ,
										 "pin" 		=> $pin ,
										 "login" 		=> 0 ,
										 "client" 		=> get_client_ip(), 
										 "date0" 		=> date("Y-m-d H:i:s")
										);


						$result  = insertInToTable ('customer', $array, $a ); 


		try {
			$aemail = "admin";
			$aemail = selectFromTable(" email ", "lumieno", " delete_status=0 ", $a); 
			$return_x = add_customer_confirm($email , $aemail, $name);
			if($return_x != 1)
				return 0;
			return 1;
		} catch (Exception $e) {
			
		}
 

						if( $result == 1) {
							return 1;

						} 
		return 0;
	}


	function add_customer_confirm($user_name , $aemail, $name) {
		global $a;
		$code     = time() .''. rand(100000, 999999);

		$return_x = 0;

		try {

			$statuz_resent = 0;
			$result        = selectFromTable("*", "temp_verification", " email= '".$user_name."' AND user='customer'  AND type=1 AND  `date` > NOW() - INTERVAL 2 HOUR  ORDER BY `temp_verification`.`date` DESC  LIMIT 1", $a);
			foreach ($result as $value) {
				$code = $value['code'];

			}

		} catch (Exception $e) {

		}

 

		$array = array(  "email"    => $user_name ,
		         "type"  => 1 ,
		         "user"  => 'customer' , 
		         "code"    => $code, 
		         "client"     => get_client_ip(),
		         "date0"    => date("Y-m-d H:i:s")
		        );
		$result  = insertInToTable ('temp_verification', $array, $a );




		if ($result ==1) {

			$return_x = reset_password_y($user_name, $code, $name, $aemail);

		} else {
			$return_x = 0;
		}

		if ($return_x == 0 || is_null($return_x)) {
			return $code;
		} else {

			return 1;

		}


	}


	function confirm_customer( $key  ) {
		global $a;
		 $screend  =false;
		 $email = null;
		try {

			$statuz_resent = 0;
			$result        = selectFromTable("*", "temp_verification", " code= '".$key."' AND user='customer'  AND type=1 AND delete_status = 0 ORDER BY `temp_verification`.`date` DESC  LIMIT 1", $a);
			foreach ($result as $value) {
				$email = $value['email'];
				$screend = true;

			}

		} catch (Exception $e) {

		}

		if ($screend ) {
			$array = array(
					         "delete_status"    => 1, 
					         "confirm_client"     => get_client_ip(),
					         "date0"    => date("Y-m-d H:i:s")
					        );
					 $result  = updateTable ('temp_verification', $array, ' code = "' . $key . '"', $a );

			$array = array(
					         "login"    => 1, 
					         "date0"    => date("Y-m-d H:i:s")
					        );
					 $result  = updateTable ('customer', $array, ' email = "' . $email . '"', $a );

return  1;

		} else
		return 0;
		


	}

	function new_password( $type, $email  ) {

		if($type == 'customer')
			$type = "customer";
		else if($type == 'distributor')
			$type = "distributor";
		else
			return 0;

		global $a;

		 $screend  =false;
		try {
 
			$statuz_resent = 0;
			$result   = selectFromTable("*", $type , " email= '".$email."' AND  delete_status = 0 AND login = 1 ORDER BY  date  DESC  LIMIT 1", $a);
			foreach ($result as $value) {
				if($value['email'] == $email)
				$screend = true;

			}

		} catch (Exception $e) {

		}

		if ($screend ) {

			try {  
				$return_x = new_password_confirm($email , $type, $name);
				if($return_x != 1)
					return 2;
				return 1;
			} catch (Exception $e) {
				
			}

			return 1;

		} else
		return -1;
		


	}

	function new_password_confirm($user_name , $type,  $name){


		global $a;
		$code     = time() .''. rand(100000, 999999);

		$return_x = 0;

		try {

			$statuz_resent = 0;
			$result        = selectFromTable("*", "temp_verification", " email= '".$user_name."' AND user='customer'  AND type=2 AND  `date` > NOW() - INTERVAL 4 HOUR  ORDER BY `temp_verification`.`date` DESC  LIMIT 1", $a);
			foreach ($result as $value) {
				$code = $value['code'];

			}

		} catch (Exception $e) {

		}

		

		$array = array(  "email"    => $user_name ,
		         "type"  => 2 ,
		         "user"  =>  $type , 
		         "code"    => $code, 
		         "client"     => get_client_ip(),
		         "date0"    => date("Y-m-d H:i:s")
		        );
		$result  = insertInToTable ('temp_verification', $array, $a );




		if ($result ==1) {

			$return_x = reset_password_x($user_name, $code, $name);
 
		} else {
			$return_x = 0;
		}

		if ($return_x == 0 || is_null($return_x)) {
			return $code;
		} else {

			return 1;

		}


	}



	function confirm_new_password( $key  ) {

				global $a;
				 $screend  =false;
				 $email = null;
				 $type = null;
				try {

					$statuz_resent = 0;
					$result        = selectFromTable("*", "temp_verification", " code= '".$key."' AND type=2 AND delete_status = 0 ORDER BY `temp_verification`.`date` DESC  LIMIT 1", $a);
					foreach ($result as $value) {
						$email = $value['email'];
						$type = $value['user'];
						$screend = true;

					}

				} catch (Exception $e) {

				}

				if ($screend ) {
					return  1;

				} else
				return 0;
				

	}



	function confirm_new_password_last( $key, $password  ) {

				global $a;
				 $screend  =false;
				 $email = null;
				 $type = null;
				try {

					$statuz_resent = 0;
					$result        = selectFromTable("*", "temp_verification", " code= '".$key."'   AND type=2 AND delete_status = 0 ORDER BY `temp_verification`.`date` DESC  LIMIT 1", $a);
					foreach ($result as $value) {
						$email = $value['email'];
						$type = $value['user'];
						$screend = true;

					}

				} catch (Exception $e) {

				}

				if ($screend ) {
					$array = array(
							         "delete_status"    => 1, 
							         "confirm_client"     => get_client_ip(),
							         "date0"    => date("Y-m-d H:i:s")
							        );
							 $result  = updateTable ('temp_verification', $array, ' code = "' . $key . '"', $a );

					$array = array(
									 "password" => md5($password),
							         "login"    => 1, 
							         "date0"    => date("Y-m-d H:i:s")
							        );
							 $result  = updateTable ($type, $array, ' email = "' . $email . '"', $a );

		return  1;

				} else
				return 0;
				

	}


	function check_User( $userd) {
		global $a;
		$retro = array('success' => 0 );

		if (isset( $_SESSION[SYSTEM_NAME.'userid'] )) {
			if (isset(  $_SESSION[SYSTEM_NAME.'type'] )) {
				$username = decrypt( $_SESSION[SYSTEM_NAME.'userid'] );
				$usertype = decrypt( $_SESSION[SYSTEM_NAME.'type'] );
				if ($usertype != $userd) {
					return $retro;			  
				} 
				$cat_success = selectFromTable (' name, image, email, dob, mobile, landline, address, pin ', $usertype , "  email = '" . $username . "' AND delete_status = 0  LIMIT 1" , $a );
					if( $cat_success ) {					
						 	$retro ['success'] = 1;
						 	$cat_success[0] ['type'] = $usertype;
							$retro ['data'] = $cat_success[0];

				} else { return  $retro; }

			} else { return  $retro; }
		} else { return  $retro; }

		return  $retro;
	}




function move_image_custo( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY , $id , $type) {	 
	global $a;
	$message = array( NULL, NULL);


	$retro = array('success' => 0 );


	$sourcePath =   '../uploads/';
	$targetPath =   '../customer/media/images/';
	$ret = 0;


 

		$ret = crop ($dataX, $dataY, $dataWidth, $dataHeight, $dataWidth, $dataHeight, $name,  $sourcePath , $targetPath );

		if ($ret == 0)			
			return $retro;


 
 

				try {
					$delete = selectFromTable ( "  image ", 'customer ', ' email="' . decrypt($_SESSION[SYSTEM_NAME.'userid']) . '" ' , $a );
					if (file_exists($targetPath .$delete)) {
					unlink($targetPath . $delete); 
					} 
				} catch (Exception $e) {

				}



				$array = array(  "image"		 => $name ,
								"client" 		=> get_client_ip()
					);




		$result  = updateTable ('customer', $array, ' email="' . decrypt($_SESSION[SYSTEM_NAME.'userid']) . '" ' , $a ); 

 
		if( $result == 1) {

			$message [0] = 1;
			$message [1] = 'image successfully Updated'; 

		} else {
			$message [0] = 4;
			$message [1] = 'Something is wrong, ensure values are correct ! '; 
		}		



		$retro ['success'] = 1;

		$retro ['type'] = 0;
		$retro ['message'] = $message;


		return $retro;
	}



	function update_customer( $name, $oldEmail, $email, $landline, $mobile,  $address, $pin, $dob  ) {

		if(!is_null($dob))
			  $dob = date("Y-m-d", strtotime($dob) );

		global $a; 		 

		if($oldEmail != $email) {
 
			$cat_success = selectFromTable (' id ', 'customer', " email='" . $email . "' ", $a );
			if( $cat_success >0 ) {
				return -1;
			}
		} 
		$cat_success = selectFromTable (' email ', 'customer', " mobile = ".$mobile , $a );
		if( $cat_success >0 ) {
			if ($cat_success[0]['email'] != $oldEmail) {
				return -2;
			}
		}
						
						$array = array(  "name"		 => $name ,   
										 "email"	=> $email ,
										 "mobile" 		=> $mobile , 
										 "landline" 		=> $landline , 
										 "address" 		=> $address ,
										 "dob" 		=> $dob ,
										 "pin" 		=> $pin , 
										 "client" 		=> get_client_ip(), 
										 "date0" 		=> date("Y-m-d H:i:s")
										);


						$result  = updateTable ('customer', $array, " email='". $oldEmail."'", $a ); 

  

						if( $result == 1) {
							return 1;

						} 
		return 0;
	}



function cart_product($product, $count) {
	global $a; 
		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
			return -1;
	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

	    if (!($user == 'customer')) {
	    	return -2;
	    }
  
	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
	    
	    if($userid <1)
	    	return -1;
 

	    $productid = selectFromTable ('id', 'product', ' name ="'.$product.'" AND delete_status = 0 ' , $a );
	    
	    if($productid <1)
	    	return 0;
 
  $exist = selectFromTable ('id, count', 'cart', 
  	' product =' . $productid .' AND customer ='.$userid.' AND  success = 0 AND delete_status = 0 AND buy = 0 ORDER BY date DESC LIMIT 1 ' ,
  	 $a );
	    $idd =0;
	    $countt = 0;
	    foreach ($exist as $value) {
	    	$idd = $value['id'];
	    	$countt = $value['count'];

	    }
	    

	    if($idd > 0 && $countt>0 ) {
	    	$countt++;
	    	$array = array( 
	    	         "count"    => $countt
	    	        );
	    	$result  = updateTable ('cart',  $array, 'id='.$idd ,$a );

	    } else {
	    	$array = array(  "product"    => $productid , 
	    	         "customer"    => $userid,
	    	         "count"    => $count,
	    	         "ftime"  => date("Y-m-d H:i:s") ,  
	    	         "client"     => get_client_ip(),
	    	         "date"    => date("Y-m-d H:i:s")
	    	        );
	    	$result  = insertInToTable ('cart',  $array, $a );
	    }

	   

	    if ($result) {
	    	return 1;
	    } else {
	    	return 0;
	    }


	  return 0;


}

function get_cart() {

	global $a;
	$retro = array('success' => 0 , 'data' => null);

		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
			return $retro['success'] = -1;
	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

	    if (!($user == 'customer')) {
			return $retro['success'] = -2;
	    }
	 
	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
	    
	    if($userid <1)
			return $retro['success'] = -1;
	
	    $carts = selectFromTable ('*', 'cart', ' customer ='.$userid.' AND success = 0 AND delete_status = 0 AND buy = 0 '  , $a );
	    $u = 0;
	    $prod = array();
	  foreach ($carts as $value) {	  	
	  	$products = array();
	  	$retro['success'] = 1;
	  	$products ['cart'] = $value['id'];
	  	$products ['count'] = $value['count'];

	  	$cat_success = selectFromTable ('name, oldPrice AS oprice , newPrice AS nprice ', '`product` ', " id=".$value['product']." AND delete_status = 0 AND count>0 " , $a );
	  		if( $cat_success ) { 
	  		$products ['product'] = $cat_success[0];

	  		$products ['image'] = 'assets/images/default.png';
	  		$cat_success = selectFromTable ('name ', '`image`  ', 
	  			" delete_status = 0 AND product =" . $value['product']." ORDER BY id LIMIT 1 " , $a );
	  			if( $cat_success ) { 
	  			$products ['image'] = 'images/products/' . $cat_success;
	  			 

	  		} 
	  		$products ['charge'] = 0;
	  		$cat_success = selectFromTable ('  price ', '  `charges` ', 
	  			"   delete_status = 0 AND pin = 0 ORDER BY date DESC LIMIT 1 " , $a );
	  			if( $cat_success ) { 
	  			$products ['charge'] = $cat_success;
	  			 

	  		}  

	  		$cat_success = selectFromTable ('  price ', '  `charges` ch LEFT JOIN customer cu ON cu.pin = ch.pin ', 
	  			"   ch.delete_status = 0 AND cu.delete_status = 0 AND cu.id=".$value['customer'] ." AND ch.product = " . $value['product'] . " LIMIT 1 " , $a );
	  			if( $cat_success > 0 ) { 
	  			$products ['charge'] = $cat_success;
	  			 

	  		} 
	  		 

	  		array_push($prod,$products );
	  	} else {
	  		 
	  	}



 
	  	$u++;
	  }


 	$retro['data'] = $prod;

	return $retro;
}


 function remove_cart( $cart ) {
	
		global $a; 
			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
				return -1;
		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

		    if (!($user == 'customer')) {
		    	return -2;
		    }
	  
		    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
		    
		    if($userid <1)
		    	return -1;
	 
 
	 
 

		    if($cart > 0  ) {

		    	$array = array( 
		    	         "delete_status"    => 1
		    	        );
		    	$result  = updateTable ('cart',  $array, 'id='.$cart ,$a );
		    	if ($result) {
		    		return 1;
		    	} 


		    }  
		   

		  


		  return 0;


 }


 function cart_count( $id, $count  ) {


 	global $a; 
 		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 			return -1;
 	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 	    if (!($user == 'customer')) {
 	    	return -2;
 	    }
 	 
 	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
 	    
 	    if($userid <1)
 	    	return -1;
 	
 	
 	
 	

 	    if($count > 0 && $id >0  ) {
 	    	$count =max(1,$count );
 	    	$count =min($count, 20 );

 
 	    	$ccco = selectFromTable ('p.count', '`cart` c LEFT JOIN product p ON c.product = p.id  ', ' c.id ='.$id.' AND c.delete_status = 0   ' , $a );
 	    	
 	    	$vco = $ccco[0]['count'];
 	    	if($vco  < 1)
 	    		return 0;

 	    	$count =min($count, $vco );
 	    	 

 	    	$array = array( 
 	    	         "count"    => $count
 	    	        );
 	    	$result  = updateTable ('cart',  $array, 'id='.$id ,$a );
 	    	if ($result) {
 	    		return $count;
 	    	} 


 	    }  
 	   

 	  


 	  return 0;

 }




 function cash_on_delivery( $total, $type) {
 	$cart = null;


 	if($type)
		$cart = get_buy( $type );
	else
		$cart = get_cart();


 	$cart = $cart['data'];

 	$idkey = time() .'-'. rand(1000009999, 9999999999);


 	global $a;
 	$retro = array('success' => 0 , 'data' => null);



 	$ttot = 0;
 	foreach ($cart as $value) {

 		$ttot += ($value['product']['nprice'] * $value['count']) + $value['charge'] ;
 	}

 	if($total != $ttot)
 		return $total;


 		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 			return $retro['success'] = -1;
 	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 	    if (!($user == 'customer')) {
 			return $retro['success'] = -2;
 	    }
 	 
 	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
 	    
 	    if($userid <1)
 			return $retro['success'] = -1;

 		$dad = date("Y-m-d H:i:s");
 		$array = array(  "customer"    => $userid , 
 		         "amount"    => $ttot,
 		         "type"    => 1,  
 		         "idkey"    => $idkey,  
 		         "client"     => get_client_ip(),
 		         "date"    => $dad
 		        );
 		$result  = insertInToTable ('payment',  $array, $a );
 	

 		$paymentid = selectFromTable ('id', 'payment', ' customer =' . $userid. ' AND amount =' . $ttot.' AND client="'.get_client_ip().'"  AND type=1 AND date="'.$dad.'" AND delete_status = 0 LIMIT 1 ' , $a );

 		if ($paymentid <1)
 			$retro['success'] = 0;

 		foreach ($cart as $value) {

 			$array = array( 
 			         "success"    => 1,
 			         "payment" => $paymentid
 			        );
 			$result  = updateTable ('cart',  $array, 'id='.$value['cart'] ,$a );

 			if ($result != 1) {
 				$retro['success'] = -3;
 				break;
 			} else {
 				$retro['success'] = 1;
 			}
 		}


 		return $retro;
 }



 function get_success_cart() {
 		global $a;
 		$retro = array('success' => 0 , 'data' => null);

 			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 				return $retro['success'] = -1;
 		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 		    if (!($user == 'customer')) {
 				return $retro['success'] = -2;
 		    }
 		 
 		    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
 		    
 		    if($userid <1)
 				return $retro['success'] = -1;


 			$payeme = selectFromTable ('*, DATE_FORMAT(date, "%d-%M-%Y   %r") AS time', '`payment`  ', ' customer= '.$userid.'  AND  delete_status = 0 ORDER BY date DESC'  , $a );
 			$d = 0;
 			$payo = array();

 		foreach ($payeme as $valueKey) {

 			$pamnt = array();

 			$pamnt['amount'] = $valueKey['amount'];
 			$pamnt['type'] = $valueKey['type'];

 			$pamnt['date'] = $valueKey['time'];
 			$pamnt['key'] = $valueKey['idkey'];
 
 			$pamnt['distributor'] = null;
 			$pamnt['success'] = $valueKey['success']; 
 			$pamnt['customer'] = check_User( 'customer')['data'];

 			if(!is_null($valueKey['distributor'])){

 			$cat_success = selectFromTable ('name, email , mobile, CONCAT("distributor/media/images/",image ) AS image ', '`distributor` ', " id=".$valueKey['distributor']." AND delete_status = 0 " , $a );
 				if( $cat_success ) { 
	 				$pamnt['distributor'] = $cat_success[0];
	 			}


 			}


 			
 			  $carts = selectFromTable ('*, DATE_FORMAT(ltime, "%d-%M-%Y ") AS ltime ', 'cart', ' payment = '.$valueKey['id'].' AND customer ='.$userid.' AND success = 1 AND delete_status = 0  '  , $a );
 			  $u = 0;
 			  $prod = array();

 			foreach ($carts as $value) {	  	
 				$products = array();
 				$retro['success'] = 1;
 				$products ['cart'] = $value['id'];
 				$products ['count'] = $value['count']; 

 				$products ['ltime'] = $value['ltime'];
 				 
 				$products ['expected'] = $value['expected'];




 				$cat_success = selectFromTable ('name, oldPrice AS oprice , newPrice AS nprice ', '`product` ', " id=".$value['product']." AND delete_status = 0 AND count>0 " , $a );
 					if( $cat_success ) { 
 					$products ['product'] = $cat_success[0];

 					$products ['image'] = 'assets/images/default.png';
 					$cat_success = selectFromTable ('name ', '`image`  ', 
 						" delete_status = 0 AND product =" . $value['product']." ORDER BY id LIMIT 1 " , $a );
 						if( $cat_success ) { 
 						$products ['image'] = 'images/products/' . $cat_success;
 						 

 					} 
 					$products ['charge'] = 0;
 					$cat_success = selectFromTable ('  price ', '  `charges` ', 
 						"   delete_status = 0 AND pin = 0 ORDER BY date DESC LIMIT 1 " , $a );
 						if( $cat_success ) { 
 						$products ['charge'] = $cat_success;
 						 

 					}  

 					$cat_success = selectFromTable ('  price ', '  `charges` ch LEFT JOIN customer cu ON cu.pin = ch.pin ', 
 						"   ch.delete_status = 0 AND cu.delete_status = 0 AND cu.id=".$value['customer'] ." AND ch.product = " . $value['product'] . " LIMIT 1 " , $a );
 						if( $cat_success > 0 ) { 
 						$products ['charge'] = $cat_success;
 						 

 					} 
 					 

 					array_push($prod,$products );
 				} else {
 					 
 				} 

 				$u++;
 			}

 			$pamnt['product'] = $prod;
 
 			array_push($payo,$pamnt );


 			$d++;
 		}



 	

 	 	$retro['data'] = $payo;

 		return $retro;
 }


 function add_complaint( $key, $product, $subject, $complaint) {

 	global $a; 


 	$retro = array('success' => 0 , 'data' => null);

 		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 			return $retro['success'] = -1;
 	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 	    if (!($user == 'customer')) {
 			return  -2;
 	    }
 	 
 	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
 	    
 	    if($userid <1)
 			return  -1;


 		$product = selectFromTable ('id', 'product', ' name ="'.$product.'" AND delete_status = 0  ' , $a );
 	    
 	    if($product <1)
 			return -1;

 		$payment = selectFromTable ('id', 'payment', ' idkey ="'.$key.'" AND delete_status = 0  ' , $a );
 	    
 	    if($payment <1)
 			return -1;



 		$cart = selectFromTable ('id', 'cart', ' product='.$product.' AND payment=' .$payment .'  AND customer='.$userid.' AND   delete_status = 0  ' , $a );
 	    
 	    if($cart <1)
 			return -1;




 	
 	$dad = date("Y-m-d H:i:s");
 		$array = array(  "payment"		 => $payment , 
 						"cart"		 => $cart , 
 						"customer"		 => $userid ,
 						"subject"		 => $subject , 
 						"complaint"		 => $complaint , 
 						 "client" 		=> get_client_ip(),
 						 "date" => $dad
 						);
 		$result  = insertInToTable ('complaint', $array, $a );
 		if( $result == 1) {
 			return 1;

 		} else {
 			return 0;
 		}	



 	
 	
 	return 0;

 }


 function get_complaint() {
 	global $a; 

 	$retro = array('success' => 0 , 'data' => null);

 	
 

 		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 			return $retro['success'] = -1;
 	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 	    if (!($user == 'customer')) {
 			return $retro['success'] = -2;
 	    }
 	 
 	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
 	    
 	    if($userid <1)
 			return $retro['success'] = -1;


 

 		$complaint = selectFromTable ('p.name AS product, py.idkey AS idkey ,c.subject, c.complaint, DATE_FORMAT(c.date, "%d-%M-%Y %r") AS date, c.readed  ', '`complaint` c LEFT JOIN cart ca ON c.cart = ca.id LEFT JOIN payment py ON c.payment = py.id LEFT JOIN product p ON ca.product = p.id ', 'c.delete_Status = 0  ORDER BY c.date DESC ' , $a );
 	    
 	    if($complaint ) {
 	    	$retro['success'] = 1;
 	    	$retro['data'] = $complaint;
 	    }

 
 	
 	
 	return $retro;

 }

 function get_instructions(){
 	global $a; 

 	$retro = array('success' => 0 , 'data' => null);

 	
 	

 		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 			return $retro['success'] = -1;
 	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 	    if (!($user == 'customer')) {
 			return $retro['success'] = -2;
 	    }
 	 
 	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
 	    
 	    if($userid <1)
 			return $retro['success'] = -1; 


 		$complaint = selectFromTable (' type, instruction, status ', 'instructions ', 'delete_Status = 0  ORDER BY date DESC ' , $a );
 	    
 	    if($complaint ) {
 	    	$retro['success'] = 1;
 	    	$retro['data'] = $complaint;
 	    }
 	    
 	
 	
 	
 	return $retro;
 }




 function add_instructions( $type, $description ) {
 	global $a; 

 	$retro = array('success' => 0 , 'data' => null);

 	
 	

 		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 			return $retro['success'] = -1;
 	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 	    if (!($user == 'admin')) {
 			return $retro['success'] = -2;
 	    }





 	    $dad = date("Y-m-d H:i:s");
 	    	$array = array(  "type"		 => $type , 
 	    					"instruction"		 => $description ,
 	    					 "client" 		=> get_client_ip(),
 	    					 "date" => $dad
 	    					);
 	    	$result  = insertInToTable ('instructions', $array, $a );
 	    	if( $result == 1) {
 	    		return 1;

 	    	} else {
 	    		return 0;
 	    	}	





 	 
 	    return 0;



 }

 	function get_instructionsAdmin( ){

 		global $a; 

 		$retro = array('success' => 0 , 'data' => null);

 		
 		

 			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 				return $retro['success'] = -1;
 		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 		    if (!($user == 'admin')) {
 				return $retro['success'] = -2;
 		    }




 		    	$complaint = selectFromTable (' type ,instruction AS description   ', ' instructions ', 'delete_Status = 0  ORDER BY date DESC ' , $a );
 		        
 		        if($complaint ) {
 		        	$retro['success'] = 1;
 		        	$retro['data'] = $complaint;
 		        }

 		    
 		    
 		    
 		    return $retro;
 		 



 	}

 	function remove_instructions( $description ) {

 		global $a; 

 		$retro = array('success' => 0 , 'data' => null);

 		
 		

 			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 				return $retro['success'] = -1;
 		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 		    if (!($user == 'admin')) {
 				return $retro['success'] = -2;
 		    }





 		    $dad = date("Y-m-d H:i:s");
 		    	$array = array( 

 		    					"delete_status"		 => 1 ,
 		    					 "client" 		=> get_client_ip(),
 		    					 "date" => $dad
 		    					);
 		    	$result  = updateTable ('instructions', $array, ' instruction = "'.$description.'" ', $a );
 		    	if( $result == 1) {
 		    		return 1;

 		    	} else {
 		    		return 0;
 		    	}	





 		 
 		    return 0;

 	}



 	function get_customers() {

 			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 				return $retro['success'] = -1;
 		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 		    if (!($user == 'admin')) {
 				return $retro['success'] = -2;
 		    }




 		global $a;
 		$retro = array('success' => 0 , 'data' => null);

 		$cat_success = selectFromTable ('name, dob, email, mobile, landline, address, pin, description, image, delete_status AS deletes, DATE_FORMAT( date , "%d-%M-%Y  %r") AS date ', 'customer', "  id>0 ORDER BY name " , $a );
 			if( $cat_success ) {
 			$retro ['success'] = 1;
 			$retro ['data'] = $cat_success;

 		} 

 		return $retro;
 	}




 	function get_customer_one($member) {

 			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 				return $retro['success'] = -1;
 		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 		    if (!($user == 'admin')) {
 				return $retro['success'] = -2;
 		    }




 		global $a;
 		$retro = array('success' => 0 , 'data' => null);

 		$cat_success = selectFromTable ('name, dob, email, mobile, landline, address, pin, description, image, delete_status AS deletes, DATE_FORMAT( date , "%d-%M-%Y  %r") AS date , login', 'customer', " id>0 AND email ='". $member ."' ORDER BY name " , $a );
 			if( $cat_success ) {
 			$retro ['success'] = 1;
 			$retro ['data'] = $cat_success;

 		} 

 		return $retro;
 	}


function get_loginlog_cu() {

 			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 				return $retro['success'] = -1;
 		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 		    if (!($user == 'admin')) {
 				return $retro['success'] = -2;
 		    }




	global $a;
	$retro = array('success' => 0 , 'data' => null);

	$cat_success = selectFromTable ('client, browser, DATE_FORMAT(ftime, "%d-%M-%Y %r") AS time, attempt, success ', 'loginlog', " delete_status =0 AND type= 12 ORDER BY date DESC LIMIT 30 " , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;

	} 

	return $retro;
}
 


function  change_login($emaila, $login, $table) {


 			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 				return $retro['success'] = -1;
 		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 		    if (!($user == 'admin')) {
 				return $retro['success'] = -2;
 		    }



		$fo = 0;
	global $a;
	if($login)
		$fo = 1;

	$retro =  0;
	
					
					$array = array(  "login"		 => $fo ,
									 "client" 		=> get_client_ip(), 
									 "date0" 		=> date("Y-m-d H:i:s")
									);
 
					$result  = updateTable ($table, $array, " email = '" . $emaila . "' ", $a ); 
					if( $result == 1) {
						$retro   = 1;

					} 
	return $retro;



}



function get_buy( $product ) {

	global $a;
	$retro = array('success' => 0 , 'data' => null);

		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
			return $retro['success'] = -1;
	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

	    if (!($user == 'customer')) {
			return $retro['success'] = -2;
	    }
	 
	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
	    
	    if($userid <1)
			return $retro['success'] = -1;



		$productid = selectFromTable ('id', 'product', ' name ="'.$product.'" AND delete_status = 0  ' , $a );
	    
	    if($productid <1)
			return $retro['success'] = -1;




	
	    $carts = selectFromTable ('*', 'cart', ' customer ='.$userid.' AND success = 0 AND delete_status = 0 AND buy = 1 AND product ='.$productid.' ORDER By date DESC  LIMIT 1 '  , $a );
	    $u = 0;
	    $prod = array();
	  foreach ($carts as $value) {	  	
	  	$products = array();
	  	$retro['success'] = 1;
	  	$products ['cart'] = $value['id'];
	  	$products ['count'] = $value['count'];
	  	$products ['buy'] = $value['buy'];

	  	$cat_success = selectFromTable ('name, oldPrice AS oprice , newPrice AS nprice ', '`product` ', " id=".$value['product']." AND delete_status = 0 AND count>0 " , $a );
	  		if( $cat_success ) { 
	  		$products ['product'] = $cat_success[0];

	  		$products ['image'] = 'assets/images/default.png';
	  		$cat_success = selectFromTable ('name ', '`image`  ', 
	  			" delete_status = 0 AND product =" . $value['product']." ORDER BY id LIMIT 1 " , $a );
	  			if( $cat_success ) { 
	  			$products ['image'] = 'images/products/' . $cat_success;
	  			 

	  		} 
	  		$products ['charge'] = 0;
	  		$cat_success = selectFromTable ('  price ', '  `charges` ', 
	  			"   delete_status = 0 AND pin = 0 ORDER BY date DESC LIMIT 1 " , $a );
	  			if( $cat_success ) { 
	  			$products ['charge'] = $cat_success;
	  			 

	  		}  

	  		$cat_success = selectFromTable ('  price ', '  `charges` ch LEFT JOIN customer cu ON cu.pin = ch.pin ', 
	  			"   ch.delete_status = 0 AND cu.delete_status = 0 AND cu.id=".$value['customer'] ." AND ch.product = " . $value['product'] . " LIMIT 1 " , $a );
	  			if( $cat_success > 0 ) { 
	  			$products ['charge'] = $cat_success;
	  			 

	  		} 
	  		 

	  		array_push($prod,$products );
	  	} else {
	  		 
	  	}



 
	  	$u++;
	  }


 	$retro['data'] = $prod;

	return $retro;
}




function buy_product($product, $count) {
	global $a; 
		if(!isset($_SESSION[SYSTEM_NAME.'userid']))
			return -1;
	      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
	      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

	    if (!($user == 'customer')) {
	    	return -2;
	    }
  
	    $userid = selectFromTable ('id', $user, ' email ="'.$email.'" AND delete_status = 0 AND login = 1 ' , $a );
	    
	    if($userid <1)
	    	return -1;
 

	    $productid = selectFromTable ('id', 'product', ' name ="'.$product.'" AND delete_status = 0 ' , $a );
	    
	    if($productid <1)
	    	return 0;
 
  $exist = selectFromTable ('id, count', 'cart', 
  	' product =' . $productid .' AND customer ='.$userid.' AND  success = 0 AND delete_status = 0 AND buy = 1 ORDER BY date DESC LIMIT 1 ' ,
  	 $a );
	    $idd =0;
	    $countt = 0;
	    foreach ($exist as $value) {
	    	$idd = $value['id'];
	    	$countt = $value['count'];

	    }
	    

	    if($idd > 0 && $countt>0 ) {
	    	$countt++;
	    	$array = array( 
	    	         "delete_status"    => 1
	    	        );
	    	$result  = updateTable ('cart',  $array, 'id='.$idd ,$a );

	    	$result  = updateTable ('cart',  $array, ' delete_status = 0 AND buy = 1 AND customer ='.$userid.' ' ,$a );

	    }  
	    	
	    	$array = array(  "product"    => $productid , 
	    	         "customer"    => $userid,
	    	         "count"    => $count,
	    	         "ftime"  => date("Y-m-d H:i:s") ,  
	    	         "buy"  => 1 ,  
	    	         "client"     => get_client_ip(),
	    	         "date"    => date("Y-m-d H:i:s")
	    	        );
	    	$result  = insertInToTable ('cart',  $array, $a );
	    
	   

	    if ($result) {
	    	return 1;
	    } else {
	    	return 0;
	    }


	  return 0;


}




function get_carts($limit) {

	global $a;
	$retro = array('success' => 0 , 'data' => null);


 
	$cat_success = selectFromTable ('c.id, c.product AS productid, p.name AS product, p.delete_status AS productdelete, c.customer AS customerid, u.email AS customeremail, u.name AS customername, u.delete_status AS customerdelete , u.login AS customerlogin , c.count, c.ftime, c.success, c.payment,  c.buy, c.client, c.delete_status, DATE_FORMAT( c.date0, "%d-%M-%Y  %r") AS date ', '  `cart` c LEFT JOIN product p ON p.id = c.product LEFT JOIN customer u ON u.id = c.customer ', "  c.id>0 ORDER BY c.date DESC  LIMIT ".$limit , $a );
		if( $cat_success ) {
		$retro ['success'] = 1;
		$retro ['data'] = $cat_success;
		 

	} 

	return $retro;


}



function check_Customer( $userd) {
	global $a;
	$retro = array('success' => 0 );

	if (isset( $_SESSION[SYSTEM_NAME.'userid'] )) {
		if (isset(  $_SESSION[SYSTEM_NAME.'type'] )) {
			$username = decrypt( $_SESSION[SYSTEM_NAME.'userid'] );
			$usertype = decrypt( $_SESSION[SYSTEM_NAME.'type'] );
			if ($usertype != 'admin') {
				return $retro;			  
			} 
			$cat_success = selectFromTable (' name, image, email, dob, mobile, landline, address, pin ', 'customer' , "  email = '" . $username . "'   LIMIT 1" , $a );
				if( $cat_success ) {					
					 	$retro ['success'] = 1;
					 	$cat_success[0] ['type'] = $usertype;
						$retro ['data'] = $cat_success[0];

			} else { return  $retro; }

		} else { return  $retro; }
	} else { return  $retro; }

	return  $retro;
}


 function get_all_cart() {
 		global $a;
 		$retro = array('success' => 0 , 'data' => null);

 			if(!isset($_SESSION[SYSTEM_NAME.'userid']))
 				return $retro['success'] = -1;
 		      $email = decrypt($_SESSION[SYSTEM_NAME.'userid']);
 		      $user = decrypt($_SESSION[SYSTEM_NAME.'type']);

 		    if (!($user == 'admin')) {
 				return $retro['success'] = -2;
 		    }
 		 
 		    $useane = selectFromTable (' * ', ' customer', ' id > 0' , $a );
 		    
 		    if($useane <1)
 				return $retro['success'] = -1;

 			$usersa = array();

 			foreach ($useane as $vuseralue) {
 				$userid = $vuseralue['id'];

 

 			$payeme = selectFromTable ('*, DATE_FORMAT(date, "%d-%M-%Y   %r") AS time', '`payment`  ', ' customer= '.$userid.'    ORDER BY date DESC'  , $a );
 			$d = 0;
 			$payo = array();

 		foreach ($payeme as $valueKey) {

 			$pamnt = array();

 			$pamnt['amount'] = $valueKey['amount'];
 			$pamnt['type'] = $valueKey['type'];
 			$pamnt['delete_status'] = $valueKey['delete_status'];

 			$pamnt['date'] = $valueKey['time'];
 			$pamnt['key'] = $valueKey['idkey'];
 
 			$pamnt['distributor'] = null;
 			$pamnt['success'] = $valueKey['success']; 
 			$pamnt['customer'] = check_Customer( 'customer')['data'];

 			if(!is_null($valueKey['distributor'])){

 			$cat_success = selectFromTable ('name, email , mobile, CONCAT("distributor/media/images/",image ) AS image ', '`distributor` ', " id=".$valueKey['distributor']." AND delete_status = 0 " , $a );
 				if( $cat_success ) { 
	 				$pamnt['distributor'] = $cat_success[0];
	 			}


 			}


 			
 			  $carts = selectFromTable ('*, DATE_FORMAT(ltime, "%d-%M-%Y ") AS ltime ', 'cart', ' payment = '.$valueKey['id'].' AND customer ='.$userid.' AND success = 1 AND delete_status = 0  '  , $a );
 			  $u = 0;
 			  $prod = array();

 			foreach ($carts as $value) {	  	
 				$products = array();
 				$retro['success'] = 1;
 				$products ['cart'] = $value['id'];
 				$products ['count'] = $value['count']; 

 				$products ['ltime'] = $value['ltime'];
 				 
 				$products ['expected'] = $value['expected'];




 				$cat_success = selectFromTable ('name, oldPrice AS oprice , newPrice AS nprice ', '`product` ', " id=".$value['product']." AND delete_status = 0 AND count>0 " , $a );
 					if( $cat_success ) { 
 					$products ['product'] = $cat_success[0];

 					$products ['image'] = 'assets/images/default.png';
 					$cat_success = selectFromTable ('name ', '`image`  ', 
 						" delete_status = 0 AND product =" . $value['product']." ORDER BY id LIMIT 1 " , $a );
 						if( $cat_success ) { 
 						$products ['image'] = 'images/products/' . $cat_success;
 						 

 					} 
 					$products ['charge'] = 0;
 					$cat_success = selectFromTable ('  price ', '  `charges` ', 
 						"   delete_status = 0 AND pin = 0 ORDER BY date DESC LIMIT 1 " , $a );
 						if( $cat_success ) { 
 						$products ['charge'] = $cat_success;
 						 

 					}  

 					$cat_success = selectFromTable ('  price ', '  `charges` ch LEFT JOIN customer cu ON cu.pin = ch.pin ', 
 						"   ch.delete_status = 0 AND cu.delete_status = 0 AND cu.id=".$value['customer'] ." AND ch.product = " . $value['product'] . " LIMIT 1 " , $a );
 						if( $cat_success > 0 ) { 
 						$products ['charge'] = $cat_success;
 						 

 					} 
 					 

 					array_push($prod,$products );
 				} else {
 					 
 				} 

 				$u++;
 			}

 			$pamnt['product'] = $prod;
 
 			array_push($payo,$pamnt );


 			$d++;
 		}



 		array_push($usersa,$payo );


 	}



 	

 	 	$retro['data'] = $usersa;

 		return $retro;
 }









































/*
 *
 * create a mail for password
 *
 *
 */

function reset_password_x($to, $code, $name) {

	$action_url = PATH."/newpassword"."/".$code;
	$login_url  = PATH;

	$support_url      = "";

	$subject          = "Reset Your ".DISPLAY_NAME." Login Password";
	$operating_system = DISPLAY_NAME;
	$browser_name     = " chrome";
	$Company_Name     = DISPLAY_NAME . " Enterpricers";
	$message          = retun_body($name, SYSTEM_NAME, $action_url, $operating_system, $browser_name, $support_url, $Company_Name);

	$return_me = send_mail($to, $subject, $message);
	return $return_me;
}

/*
 *
 * create a mail for welcome
 *
 *
 */

function reset_password_y($to, $code, $name, $admin_e) {


	$action_url = PATH."/confirm"."/".$code;
	$login_url  = PATH;

	$subject          = "Account Creation Successful ".DISPLAY_NAME."  ,Verify email ";
	$operating_system = DISPLAY_NAME;
	$browser_name     = " chrome";
	$Company_Name     = DISPLAY_NAME . " Enterpricers";
	$message          = retun_body_welcome($name, DISPLAY_NAME, $action_url, $login_url, $to, date("d-m-Y H:i:s"), $admin_e, $operating_system, $Company_Name);
 
	$return_me = send_mail($to, $subject, $message);
	return $return_me;
}


function reset_password_z($to, $action_url, $name, $admin_e) {
 
 
	$subject          = "Account Creation Successful ".DISPLAY_NAME."  , user name and password ";
	$operating_system = DISPLAY_NAME;
	$browser_name     = " chrome";
	$Company_Name     = DISPLAY_NAME . " Enterpricers";
	$message          = retun_first_welcome($name, DISPLAY_NAME, $action_url, PATH, $to, date("d-m-Y H:i:s"), $admin_e, $operating_system, $Company_Name);

	$return_me = send_mail($to, $subject, $message);
	return $return_me;
}

	function crop ($x_, $y_, $w_, $h_, $TARGET_W, $TARGET_H, $photo_url_, $sourcePath,  $sest_utl_p_ ) {

  

		 	 $x_ = floor($x_);
			 $y_   = floor($y_);
			 $w_   = floor($w_);
			 $h_   = floor($h_);

			 $TARGET_W   = floor($TARGET_W);
			 $TARGET_H   = floor($TARGET_H); 


			$url = $_SERVER['REQUEST_URI']; //returns the current URL
			$parts = explode('/',$url);
			$dir = $_SERVER['SERVER_NAME'];
			for ($i = 0; $i < count($parts) - 1; $i++) {
			 $dir .= $parts[$i] . "/";
			} 




		 
			$jpeg_quality = 99;
		 
			$src0 = $photo_url_ ;
			$src =  $sourcePath.$src0; 

			$success =0;

			 try {

		 $allowed_formats = array(
		        "jpg",
		        "png",
		        "gif",
		        "bmp"
		    );
		     
		    list($name, $ext) = explode(".", $photo_url_);
		    if (!in_array($ext, $allowed_formats))
		    {
		        $err = "<strong>Oh snap!</strong>Invalid file formats only use jpg,png,gif";
		        return false;
		    }

		    $background = imagecolorallocate($dimg , 0, 0, 0);


		    if ($ext == "jpg" || $ext == "jpeg")
		    {
		        $img_r = imagecreatefromjpeg($src);
		    }
		    else
		    if ($ext == "png")
		    {
		        $img_r = imagecreatefrompng($src);

		        try { 
		        		$background = imagecolorallocate($img_r , 0, 0, 0);
		        		     imagecolortransparent($img_r, $background);       
		        	        imagealphablending($img_r, false); 
		        	        imagesavealpha($img_r, true); 
		        } catch (Exception $e) { }

		    }
		    else
		    {
		        $img_r = imagecreatefromgif($src);
		    }
		 

		 

		   
				$dst_r = ImageCreateTrueColor( $TARGET_W, $TARGET_H );
 
		        try { 
		        		$background = imagecolorallocate($dst_r , 0, 0, 0);
		        		     imagecolortransparent($dst_r, $background);       
		        	        imagealphablending($dst_r, false); 
		        	        imagesavealpha($dst_r, true); 
		        } catch (Exception $e) { }


				imagecopyresampled($dst_r,$img_r,0,0,$x_,$y_, $TARGET_W,$TARGET_H,$w_,$h_);

				$tmp_name = rand(10,100).$photo_url_;

				

				if ($ext == "jpg" || $ext == "jpeg"){
				    imagejpeg($dst_r,  $sest_utl_p_.$tmp_name ,$jpeg_quality);
				}
				else if ($ext == "png"){
				    imagepng($dst_r,  $sest_utl_p_.$tmp_name);

				}
				else {
				    imagegif($dst_r,  $sest_utl_p_.$tmp_name);
				}
				


 

				 
				try {
					if (file_exists($src)) {
					    unlink($src); 
					  } 

				} catch (Exception $e) {
					
				}


				  if(rename($sest_utl_p_.$tmp_name ,$sest_utl_p_.$photo_url_))
				  				$success = 1;
				  			else
				  				$success = 0;
				  		


			 } catch ( Exception $a) {
			 	
			 }
				if (file_exists($sest_utl_p_.$photo_url_)) {
					$success = 1;
				  } 

			 
				 return $success;
		 
	}











	function removeImages () {

		$cat_success = selectFromTable ('*', 'link', ' id = '.$name . '' , $a );
		



	}



/*
 *
 * basic mail send
 *
 *
 */

function send_mail($to, $subject, $message) {
 
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

	// More headers
	$headers .= 'From: <webmaster@lumieno.com>'."\r\n";

	if (mail($to, $subject, $message, $headers)) {
		return 1;
	} else {
		return 0;
	}

}



























function retun_body($user_name, $system_name, $action_url, $operating_system, $browser_name, $support_url, $Company_Name) {
	$avorll = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Set up a new password for '.$system_name.'</title> </head>
		<body style="-webkit-text-size-adjust: none; box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; height: 100%; line-height: 1.4; margin: 0; width: 100% !important;" bgcolor="#F2F4F6"><style type="text/css">
			body {
				width: 100% !important;
				height: 100%;
				margin: 0;
				line-height: 1.4;
				background-color: #F2F4F6;
				color: #74787E;
				-webkit-text-size-adjust: none;

			}
			@media only screen and (max-width: 600px) {
				.email-body_inner {
					width: 100% !important;
				}
				.email-footer {
					width: 100% !important;
				}
			}
			@media only screen and (max-width: 500px) {
				.button {
					width: 100% !important;
				}
			}
		</style>
		<span class="preheader" style="box-sizing: border-box; display: none !important; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">Use this link to reset your password. The link is only valid for 24 hours.</span>
		<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">
			<tr>
				<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
					<table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">
						<tr>
							<td class="email-masthead" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 25px 0;" align="center">
								<a href="https://example.com" class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
									'.$system_name.'
								</a>
							</td>
						</tr>

						<tr>
							<td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#FFFFFF">
								<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">

									<tr>
										<td class="content-cell" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 35px;">
											<h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Hi '.$user_name.',</h1>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">You recently requested to reset your password for your '.$system_name.'account. Use the button below to reset it. <strong style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">This password reset is only valid for the next 2 hours.</strong></p>

											<table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">
												<tr>
													<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">

														<table width="100%" border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<tr>
																<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
																	<table border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
																		<tr>
																			<td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
																				<a href="'.$action_url.'" class="button button--green" target="_blank" style="-webkit-text-size-adjust: none; background: #22BC66; border-color: #22bc66; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; text-decoration: none;">Reset your password</a>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">For security, this request was received from a '.$operating_system.' device using '.$browser_name.'. If you did not request a password reset, please ignore this email or <a href="'.$support_url.'" style="box-sizing: border-box; color: #3869D4; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">contact support</a> if you have questions.</p>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Thanks,
												<br />The '.$system_name.' Team</p>

												<table class="body-sub" style="border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin-top: 25px; padding-top: 25px;">
													<tr>
														<td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<p class="sub" style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="left">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
															<p class="sub" style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="left">'.$action_url.'</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
									<table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
										<tr>
											<td class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 35px;">
												<p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">© 2016 '.$system_name.'. All rights reserved.</p>
												<p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">
													'.$Company_Name.'
													<br />1234 Street Rd.
													<br />Suite 1234
												</p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</body>
		</html>
		';
		return $avorll;
	}

	function retun_body_welcome($user_name, $system_name, $action_url, $login_url, $username, $trial_start_date, $support_email, $Sender_Name, $Company_Name) {
		$avorll = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>Welcome to '.$system_name.', '.$user_name.'!</title>


		</head>
		<body style="-webkit-text-size-adjust: none; box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; height: 100%; line-height: 1.4; margin: 0; width: 100% !important;" bgcolor="#F2F4F6"><style type="text/css">
			body {
				width: 100% !important;
				height: 100%;
				margin: 0;
				line-height: 1.4;
				background-color: #F2F4F6;
				color: #74787E;
				-webkit-text-size-adjust: none;

			}
			@media only screen and (max-width: 600px) {
				.email-body_inner {
					width: 100% !important;
				}
				.email-footer {
					width: 100% !important;
				}
			}
			@media only screen and (max-width: 500px) {
				.button {
					width: 100% !important;
				}
			}
		</style>
		<span class="preheader" style="box-sizing: border-box; display: none !important; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">Thanks for trying out '.$system_name.'. We’ve pulled together some information and resources to help you get started.</span>
		<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">
			<tr>
				<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
					<table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">
						<tr>
							<td class="email-masthead" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 25px 0;" align="center">
								<a href="https://example.com" class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
									'.$system_name.'
								</a>
							</td>
						</tr>

						<tr>
							<td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#FFFFFF">
								<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">

									<tr>
										<td class="content-cell" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 35px;">
											<h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Welcome,'.$user_name.'!</h1>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Thanks for trying '.$system_name.'. We’re thrilled to have you on board.</p>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">To get the most out of '.$system_name.', do this primary next step:</p>

											<table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">
												<tr>
													<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">

														<table width="100%" border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<tr>
																<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
																	<table border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
																		<tr>
																			<td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
																				<a href="'.$action_url.'" class="button button--" target="_blank" style="-webkit-text-size-adjust: none; background: #3869D4; border-color: #3869d4; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; text-decoration: none;">Confirm Your Email</a>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">For reference, here`s your login information:</p>
											<table class="attributes" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 0 21px;">
												<tr>
													<td class="attributes_content" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 16px;" bgcolor="#EDEFF2">
														<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<tr>
																<td class="attributes_item" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 0;"><strong style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">Login Page:</strong> '.$login_url.'</td>
															</tr>
															<tr>
																<td class="attributes_item" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 0;"><strong style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">Username:</strong> '.$username.'</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>

											<table class="attributes" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 0 21px;">
												<tr>
													<td class="attributes_content" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 16px;" bgcolor="#EDEFF2">
														<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<tr>
																<td class="attributes_item" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 0;"><strong style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;"> Start Date:</strong> '.$trial_start_date.'</td>
															</tr>

														</table>
													</td>
												</tr>
											</table>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">If you have any questions, feel free to <a href="mailto:'.$support_email.'" style="box-sizing: border-box; color: #3869D4; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">email our customer success team</a>. (We`re lightning quick at replying.) .</p>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Thanks,
												<br />'.$Sender_Name.' and the '.$system_name.' Team</p>


												<table class="body-sub" style="border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin-top: 25px; padding-top: 25px;">
													<tr>
														<td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<p class="sub" style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="left">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
															<p class="sub" style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="left">'.$action_url.'</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
									<table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
										<tr>
											<td class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 35px;">
												<p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">© 2016 '.$system_name.'. All rights reserved.</p>
												<p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">
													'.$Company_Name.'
													<br />1234 Street Rd.
													<br />Suite 1234
												</p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</body>
		</html>
		';
		return $avorll;
	}

	function retun_first_welcome($user_name, $system_name, $password, $login_url, $username, $trial_start_date, $support_email, $Sender_Name, $Company_Name) {
		$avorll = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>Welcome to '.$system_name.', '.$user_name.'!</title>


		</head>
		<body style="-webkit-text-size-adjust: none; box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; height: 100%; line-height: 1.4; margin: 0; width: 100% !important;" bgcolor="#F2F4F6"><style type="text/css">
			body {
				width: 100% !important;
				height: 100%;
				margin: 0;
				line-height: 1.4;
				background-color: #F2F4F6;
				color: #74787E;
				-webkit-text-size-adjust: none;

			}
			@media only screen and (max-width: 600px) {
				.email-body_inner {
					width: 100% !important;
				}
				.email-footer {
					width: 100% !important;
				}
			}
			@media only screen and (max-width: 500px) {
				.button {
					width: 100% !important;
				}
			}
		</style>
		<span class="preheader" style="box-sizing: border-box; display: none !important; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">Thanks for trying out '.$system_name.'. We’ve pulled together some information and resources to help you get started.</span>
		<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">
			<tr>
				<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
					<table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">
						<tr>
							<td class="email-masthead" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 25px 0;" align="center">
								<a href="https://example.com" class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
									'.$system_name.'
								</a>
							</td>
						</tr>

						<tr>
							<td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#FFFFFF">
								<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">

									<tr>
										<td class="content-cell" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 35px;">
											<h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Welcome,'.$user_name.'!</h1>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Thanks for trying '.$system_name.'. We’re thrilled to have you on board.</p>

											<table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">
												<tr>
													<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">

														<table width="100%" border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<tr>
																<td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
																	<table border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
																		<tr>

																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">For reference, here`s your login information:</p>

											<table class="attributes" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 0 21px;">
												<tr>
													<td class="attributes_content" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 16px;" bgcolor="#EDEFF2">
														<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<tr>
																<td class="attributes_item" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 0;"><strong style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">Login Page:</strong> '.$login_url.'</td>
															</tr>
															<tr>
																<td class="attributes_item" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 0;"><strong style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">Username:</strong> '.$username.'</td>
															</tr>
															<tr>
																<td class="attributes_item" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 0;"><strong style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">Password:</strong> '.$password.' (change password after first login)</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<br/>
											<br/>
											<br/>
											<table class="attributes" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 0 21px;">
												<tr>
													<td class="attributes_content" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 16px;" bgcolor="#EDEFF2">
														<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
															<tr>
																<td class="attributes_item" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 0;"><strong style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;"> Start Date:</strong> '.$trial_start_date.'</td>
															</tr>

														</table>
													</td>
												</tr>
											</table>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">If you have any questions, feel free to <a href="mailto:'.$support_email.'" style="box-sizing: border-box; color: #3869D4; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">email our customer success team</a>. (We`re lightning quick at replying.) .</p>
											<p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Thanks,
												<br />'.$Sender_Name.' and the '.$system_name.' Team</p>


												<table class="body-sub" style="border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin-top: 25px; padding-top: 25px;">
													<tr>
														<td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">

														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;">
									<table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
										<tr>
											<td class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 35px;">
												<p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">© 2016 '.$system_name.'. All rights reserved.</p>
												<p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">
													'.$Company_Name.'
													<br />1234 Street Rd.
													<br />Suite 1234
												</p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</body>
		</html>
		';
		return $avorll;
	}






$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

  

function getOS() { 

    global $user_agent;

    $os_platform    =   "Unknown OS Platform"; 
    try { $os_platform    =  "" . PHP_OS; } catch (Exception $e) { }

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}






function getIkry($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>