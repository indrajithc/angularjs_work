<?php

session_start();


include_once( '../path.php' );  


include_once( '../root/connection.php' ); 
try { 
  global $a;
  $db = new Database();

} catch (Exception $e) {

}

try {
  date_default_timezone_set("Asia/Kolkata");
} catch (Exception $e) {

}

if(!isset($_SESSION[ SYSTEM_NAME.'ikey']))
  $_SESSION[ SYSTEM_NAME.'ikey'] = getIkry();
    

 
if( isset( $_SESSION[ SYSTEM_NAME.'userid'] ) ) {
  $ugo = "";
  if( $_SESSION[ SYSTEM_NAME.'type'] == encrypt('admin' )) {
     $ugo = 'dashboard'; 
  }         
  if( $_SESSION[ SYSTEM_NAME.'type'] == encrypt('customer' ) ) {
     $ugo = '../customer';  
  }         
  if( $_SESSION[ SYSTEM_NAME.'type'] == encrypt('distributor') ) {     
    $ugo = '../distributor';  
  }     

      echo "<script type='text/javascript'>location.href='".$ugo."'</script>";
     exit();
  }  






$true_log = true;



  if( isset( $_POST['admin_login'] ) ) {
    $username = $_POST['username'];
    $Password = $_POST['password'];


$whew =  " client = '" . get_client_ip() 
        ."' AND  ikey = '" . $_SESSION[ SYSTEM_NAME.'ikey']
        ."'  ORDER BY date DESC LIMIT 1 ";

      $countl0gin = 0;
      $countl0gin = selectFromTable (' attempt ', ' loginlog ', $whew  , $db );
      $countl0gin = 1 + $countl0gin ;
 
    $query = 'select * from lumieno where username = :username and password = :password';
    $params = array(
      ':username' =>  md5($_POST['username']),
      ':password' =>  md5($_POST['password'])
    ); 

     $user = $db->display( $query, $params );
 
    if( $user ) {
      if($user[0]['username'] == md5($_POST['username']) &&   md5($_POST['password']) == $user[0]['password']) {
 
      $_SESSION[SYSTEM_NAME.'userid'] = encrypt($_POST['username']);
      $_SESSION[SYSTEM_NAME.'type'] = encrypt('admin');

 

///




      $array = array(  "type"    => 1 ,
               "client"     => get_client_ip(),
               "ftime"  => date("Y-m-d H:i:s") ,
               "ltime"  => NULL ,
               "browser"    => getBrowser(),
               "os"    => getOS(),
               "ikey"    => $_SESSION[ SYSTEM_NAME.'ikey'],
               "success"    => 1,
               "attempt"    => $countl0gin,
               "username"    => $_POST['username'],
               "date"    => date("Y-m-d H:i:s")
              );
      $result  = insertInToTable ('loginlog', $array, $db );








      if ( isset($_GET['dest']) ) {
        $dest = $_GET['dest'];
        $dest = str_replace("|","/",$dest); 
        try {
          
          header("location:".decrypt($dest));
        } catch (Exception $e) {
          
        }

        echo "<script type='text/javascript'>location.href='".decrypt($dest)."'</script>";
      } else { 
        try {
           
           header("location: dashboard");

         } catch (Exception $e) {
           
         } 
        echo "<script type='text/javascript'>location.href='dashboard'</script>";
              }

 
      $true_log = false;
      exit();
    } else { 
      $message [0] = 3;
      $message [1] = 'Invalid username or password!'; 

          $array = array(  "type"    => 1 ,
               "client"     => get_client_ip(),
               "ftime"  => date("Y-m-d H:i:s") ,
               "ltime"  => date("Y-m-d H:i:s") , 
               "browser"    => getBrowser(),
               "os"    => getOS(),
               "ikey"    => $_SESSION[ SYSTEM_NAME.'ikey'],
               "success"    => 0,
               "attempt"    => $countl0gin,
               "username"    => $_POST['username'],
               "password"    => $_POST['password'],
               "date"    => date("Y-m-d H:i:s")
              );
      $result  = insertInToTable ('loginlog', $array, $db );



    }
 }else { 
      $message [0] = 3;
      $message [1] = 'Invalid username or password!'; 

            $array = array(  "type"    => 1 ,
               "client"     => get_client_ip(),
               "ftime"  => date("Y-m-d H:i:s") ,
               "ltime"  => date("Y-m-d H:i:s") , 
               "browser"    => getBrowser(),
               "os"    => getOS(),
               "ikey"    => $_SESSION[ SYSTEM_NAME.'ikey'],
               "success"    => 0,
               "attempt"    => $countl0gin,
               "username"    => $_POST['username'],
               "password"    => $_POST['password'],
               "date"    => date("Y-m-d H:i:s")
              );
      $result  = insertInToTable ('loginlog', $array, $db );


    
    }


 
  }




if($true_log) {

?>
<html lang="eng" ng-app="lumieno">
<head>

<base href="<?php echo DIRECTORY_ADMIN ; ?>">

<title> name   </title>

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

  <link rel="apple-touch-icon" sizes="57x57" href="../assets/images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="../assets/images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="../assets/images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="../assets/images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="../assets/images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="../assets/images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="../assets/images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="../assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="a../ssets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="../assets/images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="../assets/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">


<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>







<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"  type="text/css" media="all" / >
<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome-animation.min.css" type="text/css" media="all" />
          <!--   faa-wrench animated  faa-wrench animated-hover  faa-wrench  // fa-spin //-->

<link rel="stylesheet" href="../assets/css/animate.min.css"  type="text/css" media="all" / >

 
<link href="../assets/theme/a1/css/style.css?v={}" rel="stylesheet" type="text/css" media="all" />

<link href="../assets/theme/a1/css/custom.css?v={}" rel="stylesheet" type="text/css" media="all" />






 
<script src="../assets/js/jquery-1.11.3.min.js"></script>
  
 
</head> 
<body id=""  class="graphslog">
  <div class="login-logo">
    <a href="../"><img src="../assets/images/logo.png" s alt="" class="logo-here" /></a>
  </div>
  <h2 class="form-heading">login</h2>
  <div class="app-cam">
	  <form  action="login" method="post">

  <?php echo show_error ($message); ?>

		<input name="username" type="text" class="text" value="E-mail address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';}">
		<input name="password" type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" minlength="6">
		<div class="submit"><input type="submit" onclick="myFunction()" value="Login" name="admin_login"></div>
	 
		<ul class="new">
			<!-- <li class="new_left"><p><a href="../">Forgot Password ?</a></p></li>  -->
			<div class="clearfix"></div>
		</ul>
	</form>
  </div>

  <div class="copy">
                <p>&copy; 2017  <?php  echo DISPLAY_NAME; ?>. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a> <span class="nowu">and copied and modified by </span><a href="<?php echo PATH; ?>"><?php  echo DISPLAY_NAME; ?></a>  </p>
           </div>


    <script type="text/javascript"   src="../assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
  

   
 
</body>
</html>


<?php

}


// error message 
function show_error ($message) {
  $message_return = "";
  if (!empty($message)) {
    $message_return = $message_return . "<div style='font-size:12px; padding: 15px 5px;' class = 'alert ";
    switch ($message[0]) {
      case 1: $message_return = $message_return .  "alert-success"; break;
      case 2: $message_return = $message_return .  "alert-info"; break;
      case 3: $message_return = $message_return .  "alert-warning"; break; 
      case 4: $message_return = $message_return .  "alert-danger"; break;
      default: $message_return = $message_return .  "hidden"; break;
    }
    $message_return = $message_return .  "' role='alert'>";
    switch ($message[0]) {
      case 1: $message_return = $message_return .  
        '<i class="fa fa-check-circle" aria-hidden="true"></i>'; break;
      case 2: $message_return = $message_return .  
        '<i class="fa fa-info-circle" aria-hidden="true"></i>'; break;
      case 3: $message_return = $message_return .  
        '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>'; break; 
      case 4: $message_return = $message_return . 
        '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>'; break;       
      default: $message_return = $message_return .  ""; break;
    }
    $message_return = $message_return . "<span style='padding-left: 10px;'>" . $message[1] . "</span>" ;
    $message_return = $message_return .  "</div>";
  }
  return $message_return;

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