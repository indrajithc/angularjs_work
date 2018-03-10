<?php


include_once( 'functions.php' ); 
 

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

 
if( isset($_POST['action']) &&  IS_AJAX  ) {
 
	switch( $_POST['action'] ) {



		case 'move-image':

		$fname = $_POST['fname'];
		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];

 


		$flag = move_image($fname, $name, $dataX,$dataY,$dataWidth,$dataHeight, $dataRotate,$dataScaleX,$dataScaleY	  );	

		echo json_encode(array('success'=>$flag));	


		break;

		case 'remove-image':

		$name = $_POST['name']; 
		$flag = remove_image_detaild(  $name , true );	

		echo json_encode(array('success'=>$flag));	

		break;





		case 'get-image':

		$name = $_POST['name']; 
		$flag = get_image(  $name  );	

		echo json_encode(array('success'=>$flag));	

		break;



		case 'move-image-basic':

		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];




		$flag = move_image_basic( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY  )
		;	

		echo json_encode(array('success'=>$flag));	


		break;



		case 'move-image-profile':

		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];

		$id = $_POST['id'];
		$type = $_POST['type'];




		$flag = move_image_profile( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY , $id , $type );	

		echo json_encode(array('success'=>$flag));	


		break;




		case 'move-image-category':

		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];




		$flag = move_image_category( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY  );	

		echo json_encode(array('success'=>$flag));	


		break;



		case 'get-Image':
			$flag = get_admin_Image();	

			echo json_encode(array('success'=>$flag));	

		break;

		
		case 'update-admin':
		 
			$name = $_POST['name']; 
			$email = $_POST['email']; 
			$mobile = $_POST['mobile']; 
			$landline = $_POST['landline']; 
			$address = $_POST['address']; 
			$website = $_POST['website']; 
			$description = $_POST['description']; 
			$image = $_POST['image'];  


			$flag = update_admin( $name, $email, $mobile, $landline, $address, $website, $description, $image );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;




		case 'get-admin':
			$flag = get_admin_details();	

			echo json_encode(array('success'=>$flag));	

		break; 

		case 'update-login':

			$username = $_POST['username']; 
			$password = $_POST['password']; 
			$newpassword = $_POST['newpassword']; 
			$repassword = $_POST['repassword']; 
			$flag = update_login($username, $password, $newpassword, $repassword );	

			echo json_encode(array('success'=>$flag));	

		break;


		
		case 'get-loginlog':
			$flag = get_loginlog();	

			echo json_encode(array('success'=>$flag));	

		break; 
 
		case 'customer-login':

			$email = $_POST['email']; 
			$password = $_POST['password']; 

			$flag = user_login($email, $password , 2);	

			echo json_encode(array('success'=>$flag));	

		break; 
 
		case 'distributor-login':

			$email = $_POST['email']; 
			$password = $_POST['password']; 

			$flag = user_login($email, $password , 1);	

			echo json_encode(array('success'=>$flag));	

		break; 

		
		case 'get-site-basic':
			$flag = get_site_basic();	

			echo json_encode(array('success'=>$flag));	

		break; 
 
		
		case 'update-basic':
			$address = $_POST['address'];
			$email = $_POST['email'];
			$number = $_POST['mobile'];
			$landline = $_POST['landline'];
			$description1 = $_POST['description1'];
			$description2 = $_POST['description2'];
			$description3 = $_POST['description3'];
			$description4 = $_POST['description4'];
			$features1H = $_POST['features1H'];
			$features1M = $_POST['features1M'];
			$features2H = $_POST['features2H'];
			$features2M = $_POST['features2M'];
			$features3H = $_POST['features3H'];
			$features3M = $_POST['features3M'];
			$aboutH = $_POST['aboutH'];
			$aboutM = $_POST['aboutM'];
			$aboutHH = $_POST['aboutHH'];
			$aboutMM = $_POST['aboutMM'];
			$vision = $_POST['vision'];
			$mission = $_POST['mission'];
			$team = $_POST['team'];
			$map = $_POST['map'];
			$mapMsg = $_POST['mapMsg'];
			$image = $_POST['image']; 
 

			$flag = update_basic(	$address , $email, $number, $landline, $description1, $description2, $description3, $description4, $features1H, $features1M, $features2H, $features2M , $features3H , $features3M, $aboutH , $aboutM, $aboutHH, $aboutMM, $vision, $mission, $team, $map, $mapMsg,$image );	

			echo json_encode(array('success'=>$flag));	

		break; 



		
		case 'get-basic':
			$flag = get_basic();	

			echo json_encode(array('success'=>$flag));	

		break;  
		  
		  case 'subscribe-email':

		  	$email = $_POST['email'];  

		  	$flag = subscribe_email($email);	

		  	echo json_encode(array('success'=>$flag));	

		  break; 

 
		  case 'add-email':

		  	$name = $_POST['name'];  
		  	$email = $_POST['email'];  
		  	$telephone = $_POST['telephone'];  
		  	$message = $_POST['message'];   

		  	$flag = add_email($name , $email, $telephone, $message  );	

		  	echo json_encode(array('success'=>$flag));	

		  break; 



		
		case 'get-emails':
			$flag = get_emails();	

			echo json_encode(array('success'=>$flag));	

		break;  
 
		  case 'add-category':

		  	$name = $_POST['name'];  
		  	$description = $_POST['description'];  
		  	$image = $_POST['image'];   

		  	$flag = add_category($name , $description, $image );	

		  	echo json_encode(array('success'=>$flag));	

		  break; 


		
		case 'get-category':
			$flag = get_category();	

			echo json_encode(array('success'=>$flag));	

		break;  
 


		case 'get-cat-Image':
			$flag = get_cat_Image();	

			echo json_encode(array('success'=>$flag));	

		break;
 
		  case 'edit-category':

		  	$name = $_POST['name'];  
		  	$description = $_POST['description'];  
		  	$image = $_POST['image'];   
		  	$delete = $_POST['delete'];   

		  	$flag = edit_category($name , $description, $image, $delete  );	

		  	echo json_encode(array('success'=>$flag));	

		  break; 

		  case 'add-product':

		  	$category = $_POST['category'];  
		  	$name = $_POST['name'];  
		  	$oldPrice = $_POST['oldPrice'];  
		  	$newPrice = $_POST['newPrice'];  
		  	$count = $_POST['count'];  
		  	$new = $_POST['new'];  
		  	$rating = $_POST['rating'];   
		  	$description = $_POST['description'];  
		  	$images = $_POST['images'];  

		  	$flag = add_product( $category , $name, $oldPrice , $newPrice, $count, $new, $rating, $description, $images );	

		  	echo json_encode(array('success'=>$flag));	

		  break; 


		
		case 'get-product':
			$flag = get_product();	

			echo json_encode(array('success'=>$flag));	

		break;  
 
		
		case 'get-product-details':

		  	$product = $_POST['product']; 
		  	
			$flag = get_product_details($product);	

			echo json_encode(array('success'=>$flag));	

		break;  
  


		  case 'update-product':

		  	$category = $_POST['category'];  
		  	$name = $_POST['name'];  
		  	$oldPrice = $_POST['oldPrice'];  
		  	$newPrice = $_POST['newPrice'];  
		  	$count = $_POST['count'];  
		  	$new = $_POST['new'];  
		  	$rating = $_POST['rating'];   
		  	$description = $_POST['description'];  
		  	$images = $_POST['images'];  
		  	$delete = $_POST['delete'];  

		  	$flag = update_product( $category , $name, $oldPrice , $newPrice, $count, $new, $rating, $description, $images, $delete  );	

		  	echo json_encode(array('success'=>$flag));	

		  break; 
 

		  case 'add-specification':

		  	$product = $_POST['product'];  
		  	$name = $_POST['name'];  
		  	$value = $_POST['value'];   

		  	$flag = add_specification( $product , $name, $value   );	

		  	echo json_encode(array('success'=>$flag));	

		  break;  


		  case 'get-product-specification':

		  	$product = $_POST['product'];   

		  	$flag = get_product_specification( $product );	

		  	echo json_encode(array('success'=>$flag));	

		  break;  

		  case 'remove-specification':

		 	 $product = $_POST['product'];  
			  $name = $_POST['name'];  
		 	 $value = $_POST['value'];   

		  	$flag = remove_specification(  $product , $name, $value  );	

		  	echo json_encode(array('success'=>$flag));	

		  break; 



		case 'move-image-team':

		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];




		$flag = move_image_team( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY  );	

		echo json_encode(array('success'=>$flag));	


		break;




		
		case 'add-team':
		 
			$name = $_POST['name']; 
			$position = $_POST['position']; 
			$email = $_POST['email']; 
			$mobile = $_POST['mobile']; 
			$landline = $_POST['landline']; 
			$address = $_POST['address']; 
			$website = $_POST['website']; 
			$description = $_POST['description']; 
			$image = $_POST['image'];  


			$flag = add_team( $name, $email, $position , $mobile, $landline, $address, $website, $description, $image );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;


		
		case 'get-team':
			$flag = get_team();	

			echo json_encode(array('success'=>$flag));	

		break;  

		
		case 'get-team-one':
			$member = $_POST['member'];  

			$flag = get_team_one($member);	
			echo json_encode(array('success'=>$flag));	

		break;  
		
 
		
		case 'update-team':
		 
			$name = $_POST['name']; 
			$position = $_POST['position']; 
			$email = $_POST['email']; 
			$mobile = $_POST['mobile']; 
			$landline = $_POST['landline']; 
			$address = $_POST['address']; 
			$website = $_POST['website']; 
			$description = $_POST['description']; 
			$image = $_POST['image'];  
			$delete = $_POST['delete'];  


			$flag = update_team( $name, $email, $position , $mobile, $landline, $address, $website, $description, $image, $delete );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;

/*				  action: '',
				  : $scope.link.name, 
				  : $scope.link.url ,
				  : $scope.link.icon */


		
		case 'add-link':
			$name = $_POST['name'];  
			$url = $_POST['url'];  
			$icon = $_POST['icon'];  
			$user = $_POST['user'];  

			$flag = add_link($name, $url, $icon, $user);	
			echo json_encode(array('success'=>$flag));	

		break;  
		
 


		
		case 'get-link':
			$user = $_POST['user'];  

			$flag = get_link($user);	
			echo json_encode(array('success'=>$flag));	

		break;  
		
 
		
		case 'update-link':
			$name = $_POST['name'];   
			$user = $_POST['user'];  

			$flag = update_link($name, $user);	
			echo json_encode(array('success'=>$flag));	

		break;  
		



		case 'get-team-basic':
			$flag =  get_team_basic();	

			echo json_encode(array('success'=>$flag));	

		break;  

		

		case 'move-image-look':

		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];




		$flag = move_image_look( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY  )
		;	

		echo json_encode(array('success'=>$flag));	


		break;




		case 'update-look':

		$name = $_POST['name'];

		$product1 = $_POST['product1'];
		$product2 = $_POST['product2'];
		$product3 = $_POST['product3'];
 
		$description1 = $_POST['description1'];
		$description2 = $_POST['description2'];
		$description3 = $_POST['description3'];
		$description4 = $_POST['description4'];
		$description5 = $_POST['description5'];
		$description6 = $_POST['description6'];
		$description7 = $_POST['description7'];
		$description8 = $_POST['description8'];
		$description9 = $_POST['description9'];
		$description10 = $_POST['description10'];
		$description11 = $_POST['description11'];
		$description12 = $_POST['description12'];
		$description13 = $_POST['description13'];
		$description14 = $_POST['description14'];

		$image1 = $_POST['image1'];
		$image2 = $_POST['image2'];
		$image3 = $_POST['image3'];







		$flag = update_look( $product1, $product2, $product3, $description1, $description2, $description3, $description4, $description5, $description6, $description7, $description8, $description9, $description10, $description11, $description12, $description13, $description14, $image1, $image2, $image3  );	

		echo json_encode(array('success'=>$flag));	


		break;


		case 'get-look':
			$flag =  get_look();	

			echo json_encode(array('success'=>$flag));	

		break;  


		
		case 'get-link-0': 
			$flag = get_link(null);	
			echo json_encode(array('success'=>$flag));	

		break;  
		

		
		case 'get-product-0':
			$flag = get_product_0();	

			echo json_encode(array('success'=>$flag));	

		break;  

 
		
		case 'get-product-1':

		  	$product = $_POST['product']; 
		  	
			$flag = get_product_1($product);	

			echo json_encode(array('success'=>$flag));	

		break;  
  

		
		case 'check-login':
			$flag = check_login();	

			echo json_encode(array('success'=>$flag));	

		break;  

		// ================================

		
		case 'set-first':
		 
			$browserName = $_POST['browserName']; 
			$fullVersion = $_POST['fullVersion']; 
			$majorVersion = $_POST['majorVersion']; 
			$appName = $_POST['appName']; 
			$userAgent = $_POST['userAgent']; 
			$OSName = $_POST['OSName'];  
			$flag = set_first($browserName, $fullVersion, $majorVersion, $appName, $userAgent, $OSName );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;

		
		case 'set-last':
		 
			$browserName = $_POST['browserName']; 
			$fullVersion = $_POST['fullVersion']; 
			$majorVersion = $_POST['majorVersion']; 
			$appName = $_POST['appName']; 
			$userAgent = $_POST['userAgent']; 
			$OSName = $_POST['OSName'];  
			$key = $_POST['key'];  
			$flag = set_last($browserName, $fullVersion, $majorVersion, $appName, $userAgent, $OSName, $key );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;
// =========================



		case 'get-views':
			$flag = get_views();	

			echo json_encode(array('success'=>$flag));	

		break;  

 
 		case 'move-image-distributor':

		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];

		$id = $_POST['id'];
		$type = $_POST['type'];




		$flag = move_image_distributor( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY , $id , $type );	

		echo json_encode(array('success'=>$flag));	


		break;
 
	
		case 'add-distributor':
		 
			$name = $_POST['name']; 
			$password = $_POST['password']; 
			$dob = $_POST['dob']; 
			$email = $_POST['email']; 
			$mobile = $_POST['mobile']; 
			$landline = $_POST['landline']; 
			$address = $_POST['address']; 
			$pin = $_POST['pin']; 
			$description = $_POST['description']; 
			$image = $_POST['image'];  


			$flag = add_distributor( $name, $email, $password, $dob , $mobile, $landline, $address, $pin, $description, $image );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;


		
		case 'get-distributor':
			$flag = get_distributor();	

			echo json_encode(array('success'=>$flag));	

		break;  

		
		case 'get-distributor-one':
			$member = $_POST['member'];  

			$flag = get_distributor_one($member);	
			echo json_encode(array('success'=>$flag));	

		break;  
		
 
		
		case 'update-distributor':
		 
			$name = $_POST['name']; 
			$dob = $_POST['dob']; 
			$email = $_POST['email']; 
			$mobile = $_POST['mobile']; 
			$landline = $_POST['landline']; 
			$address = $_POST['address']; 
			$pin = $_POST['pin']; 
			$description = $_POST['description']; 
			$image = $_POST['image'];  
			$delete = $_POST['delete'];  


			$flag = update_distributor( $name, $email, $dob , $mobile, $landline, $address, $pin, $description, $image, $delete );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;

 
		
		case 'exit': 

			$flag = exitMe();	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;
 


	
		case 'add-customer':
		 
			$name = $_POST['name']; 
			$password = $_POST['password'];  
			$email = $_POST['email']; 
			$mobile = $_POST['mobile'];  
			$address = $_POST['address']; 
			$pin = $_POST['pin'];  


			$flag = add_customer( $name, $email, $password, $mobile,  $address, $pin  );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;



		case 'confirm-customer':
		 
			$key = $_POST['key']; 


			$flag = confirm_customer( $key  );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;
 

		case 'new-password':
		 
			$type = $_POST['type']; 
			$email = $_POST['email']; 


			$flag = new_password( $type, $email  );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;



		case 'confirm-new-password':
		 
			$key = $_POST['key']; 


			$flag = confirm_new_password( $key  );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;

		case 'new-pass-success':
		 
			$key = $_POST['key']; 
			$password = $_POST['password']; 


			$flag = confirm_new_password_last( $key, $password  );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;
  

		case 'check-User': 

			$flag = check_User( 'customer');	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;


		case 'move-image-custo':

		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];



 

		$name = $_POST['name'];

		$dataX = $_POST['dataX'];
		$dataY = $_POST['dataY'];
		$dataWidth = $_POST['dataWidth'];
		$dataHeight = $_POST['dataHeight'];
		$dataRotate = $_POST['dataRotate']; 
		$dataScaleX = $_POST['dataScaleX'];
		$dataScaleY = $_POST['dataScaleY'];

		$id = $_POST['id'];
		$type = $_POST['type'];




		$flag = move_image_custo( $name, $dataX, $dataY, $dataWidth, $dataHeight,   $dataRotate, $dataScaleX, $dataScaleY , $id , $type );	

		echo json_encode(array('success'=>$flag));	


		break;

 

	case 'update-customer':
		 
			$name = $_POST['name']; 
			$oldEmail = $_POST['oldEmail'];  
			$email = $_POST['email']; 
			$mobile = $_POST['mobile'];  
			$address = $_POST['address']; 
			$landline = $_POST['landline']; 
			$dob = $_POST['dob'];  
			$pin = $_POST['pin'];  


			$flag = update_customer( $name, $oldEmail, $email, $landline, $mobile,  $address, $pin, $dob  );	
		
				 echo json_encode(array('success'=>$flag));	
		
		break;

 
		
		case 'cart-product':

		  	$product = $_POST['product']; 
		  	$count = $_POST['count']; 
		  	
			$flag = cart_product($product, $count);	

			echo json_encode(array('success'=>$flag));	

		break;  
  
		
		case 'get-cart': 
			$flag = get_cart();	

			echo json_encode(array('success'=>$flag));	

		break;  
   

		case 'remove-cart': 
		  	$cart = $_POST['cart']; 

			$flag = remove_cart( $cart );	

			echo json_encode(array('success'=>$flag));	

		break;  
   

		case 'cart-count': 
		  	$id = $_POST['id']; 
		  	$count = $_POST['count']; 

			$flag = cart_count( $id, $count  );	

			echo json_encode(array('success'=>$flag));	

		break;  




		case 'cash-on-delivery':  
		  	$type = $_POST['type']; 
		  	$total = $_POST['total']; 

			$flag = cash_on_delivery( $total, $type );	

			echo json_encode(array('success'=>$flag));	

		break; 



		case 'get-success-cart':   
			$flag = get_success_cart(   );	

			echo json_encode(array('success'=>$flag));	

		break; 

 
		case 'add-complaint':  
		  	$key = $_POST['key']; 
		  	$product = $_POST['product']; 
		  	$subject = $_POST['subject']; 
		  	$complaint = $_POST['complaint'];  

			$flag = add_complaint( $key, $product, $subject, $complaint);	

			echo json_encode(array('success'=>$flag));	

		break; 



		case 'get-complaint':   
			$flag = get_complaint();	

			echo json_encode(array('success'=>$flag));	

		break; 



		case 'get-instructions':   
			$flag = get_instructions();	

			echo json_encode(array('success'=>$flag));	

		break; 
 

 
		case 'add-instructions':  
		  	$type = $_POST['type']; 
		  	$description = $_POST['description']; 


			$flag = add_instructions( $type, $description );	

			echo json_encode(array('success'=>$flag));	

		break; 

 
		case 'get-instructions-admin':   

			$flag = get_instructionsAdmin( );	

			echo json_encode(array('success'=>$flag));	

		break; 



		case 'remove-instructions':   
		  	$description = $_POST['description']; 


			$flag = remove_instructions( $description );	

			echo json_encode(array('success'=>$flag));	

		break; 


		case 'get-customers':   

			$flag = get_customers( );	

			echo json_encode(array('success'=>$flag));	

		break; 
		
		case 'get-customer-one':
			$member = $_POST['member'];  

			$flag = get_customer_one($member);	
			echo json_encode(array('success'=>$flag));	

		break;  
		
		
		case 'get-loginlog-cu':
			$flag = get_loginlog_cu();	

			echo json_encode(array('success'=>$flag));	

		break;  
		
		case 'change-login':
			$email = $_POST['email'];  
			$login = $_POST['login'];   

			$flag = change_login($email, $login, 'customer');	

			echo json_encode(array('success'=>$flag));	

		break; 



		
		case 'get-buy': 
		  	$product = $_POST['product']; 
			$flag = get_buy( $product );	

			echo json_encode(array('success'=>$flag));	

		break;  
		 

		
		case 'buy-product':

		  	$product = $_POST['product']; 
		  	$count = $_POST['count']; 
		  	
			$flag = buy_product($product, $count);	

			echo json_encode(array('success'=>$flag));	

		break;  

		
		case 'get-carts':

		  	$limit = $_POST['limit']; 
			$flag = get_carts($limit);	

			echo json_encode(array('success'=>$flag));	

		break; 


		case 'get-all-cart':   
			$flag = get_all_cart(   );	

			echo json_encode(array('success'=>$flag));	

		break; 






	}




}
 

?>