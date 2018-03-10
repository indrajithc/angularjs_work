<?php
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

var_dump($_POST);
 

if(  IS_AJAX  ) {
	 $x_ = $_POST['dataX']; 
	 $y_   = $_POST['dataY']; 
	 $w_   = $_POST['dataWidth']; 
	 $h_   = $_POST['dataHeight']; 
	 $r_   = $_POST['dataRotate']; 
	 

	 $sx_   = $_POST['dataScaleX']; 
	 $sy_   = $_POST['dataScaleY']; 

	 $TARGET_W   = $_POST['newW']; 
	 $TARGET_H   = $_POST['newH']; 


	 $photo_url_   = $_POST['name']; 
	 $sest_utl_p_  = $_POST['fname']; 


 	 $x_ = floor($x_);
	 $y_   = floor($y_);
	 $w_   = floor($w_);
	 $h_   = floor($h_);
	 $r_   = floor($r_);

	 $TARGET_W   = floor($TARGET_W);
	 $TARGET_H   = floor($TARGET_H); 


	$url = $_SERVER['REQUEST_URI']; //returns the current URL
	$parts = explode('/',$url);
	$dir = $_SERVER['SERVER_NAME'];
	for ($i = 0; $i < count($parts) - 1; $i++) {
	 $dir .= $parts[$i] . "/";
	} 




 
	$jpeg_quality = 90;
 
	$src0 = $photo_url_ ;
	$src =  'uploads/'.$src0; 

	$success =0;
	$messages =null;

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

    if ($ext == "jpg" || $ext == "jpeg")
    {
        $img_r = imagecreatefromjpeg($src);
    }
    else
    if ($ext == "png")
    {
        $img_r = imagecreatefrompng($src);
    }
    else
    {
        $img_r = imagecreatefromgif($src);
    }
 

 





    		$size = getimagesize($src);
          $size_w = $size[0]; // natural width
          $size_h = $size[1]; // natural height
     
          $src_img_w = $size_w;
          $src_img_h = $size_h;
      
     
          // Rotate the source image
          if (is_numeric($r_) && $r_ != 0) {
            // PHP's degrees is opposite to CSS's degrees
            $new_img = imagerotate( $img_r, -$r_, imagecolorallocatealpha($img_r, 0, 0, 0, 127) );
     
            imagedestroy($img_r);
            $img_r = $new_img;
     
            $deg = abs($r_) % 180;
            $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;
     
            $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
            $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);
     
            // Fix rotated image miss 1px issue when degrees < 0
            $src_img_w -= 1;
            $src_img_h -= 1;
          }
     
          $tmp_img_w = $w_;
          $tmp_img_h = $h_;
          $dst_img_w = $TARGET_W;
          $dst_img_h = $TARGET_H;
     
          $src_x = $x_;
          $src_y = $y_;
     
          if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
            $src_x = $src_w = $dst_x = $dst_w = 0;
          } else if ($src_x <= 0) {
            $dst_x = -$src_x;
            $src_x = 0;
            $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
          } else if ($src_x <= $src_img_w) {
            $dst_x = 0;
            $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
          }
     
          if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
            $src_y = $src_h = $dst_y = $dst_h = 0;
          } else if ($src_y <= 0) {
            $dst_y = -$src_y;
            $src_y = 0;
            $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
          } else if ($src_y <= $src_img_h) {
            $dst_y = 0;
            $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
          }
     
          // Scale to destination position and size
          $ratio = $tmp_img_w / $dst_img_w;
          $dst_x /= $ratio;
          $dst_y /= $ratio;
          $dst_w /= $ratio;
          $dst_h /= $ratio;
     
          $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);
     
          // Add transparent background to destination image
          imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
          imagesavealpha($dst_img, true);
     
          $result = imagecopyresampled($dst_img, $img_r, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
     
     var_dump($dst_r);
          if ($result) {
            if (!imagejpeg($dst_img,  $sest_utl_p_.$photo_url_ ,$jpeg_quality)) {
              $messages  = "Failed to save the cropped image file";
            }
          } else {
             $messages  = "Failed to crop the image file";
          }
     
           
          if (file_exists($src)) {
              unlink($src); 
            } 


 

	 } catch ( Exception $a) {
	 	
	 }
		if (file_exists($sest_utl_p_.$photo_url_)) {
			$success = 1;
		  } 

	 
		echo json_encode(array('success'=> $success,
								 'name' =>  $photo_url_, 
								'path'  => $sest_utl_p_ ,
								'folder'=>basename($sest_utl_p_),
								'full' => $dir.$sest_utl_p_.$photo_url_ ,
								'message' => $messages 
					 			));

 

	exit;
}

 
?>














 