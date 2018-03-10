 <?php


if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key']) == 0) {
	$_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s'));

	$_SESSION['user_file_ext'] = "";
}

 
$upload_dir         = "../uploads";// The directory for the images to be saved in
$upload_path        = $upload_dir."/";// The path to where the image will be saved
$large_image_prefix = "resize_";// The prefix name to large image
$thumb_image_prefix = "thumbnail_";// The prefix name to the thumb image
$large_image_name   = $large_image_prefix.$_SESSION['random_key'];// New name of the large image (append the timestamp to the filename)
$thumb_image_name   = $thumb_image_prefix.$_SESSION['random_key'];// New name of the thumbnail image (append the timestamp to the filename)
$max_file           = "18";// Maximum file size in MB
$max_width          = "1080";// Max width allowed for the large image
$thumb_width        = "100";// Width of thumbnail image
$thumb_height       = "100";// Height of thumbnail image
// Only one of these image types should be allowed for upload
$allowed_image_types = array('image/pjpeg' => "jpg", 'image/jpeg' => "jpg", 'image/jpg' => "jpg", 'image/png' => "png", 'image/x-png' => "png", 'image/gif' => "gif");
$allowed_image_ext   = array_unique($allowed_image_types);// do not change this
$image_ext           = "";// initialise variable, do not change this.
foreach ($allowed_image_ext as $mime_type => $ext) {
	$image_ext .= strtoupper($ext)." ";
}

function resizeImage($image, $width, $height, $scale) {

	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType                                  = image_type_to_mime_type($imageType);
	$newImageWidth                              = ceil($width*$scale);
	$newImageHeight                             = ceil($height*$scale); 

	$newImage = @imagecreatetruecolor($newImageWidth, $newImageHeight) or die('Cannot Initialize new GD image stream');
	switch ($imageType) {
		case "image/gif":
			$source = imagecreatefromgif($image);
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source = imagecreatefromjpeg($image);
			break;
		case "image/png":
		case "image/x-png":
			$source = imagecreatefrompng($image);
			try { 
					$background = imagecolorallocate($newImage , 0, 0, 0);
					     imagecolortransparent($newImage, $background);       
				        imagealphablending($newImage, false); 
				        imagesavealpha($newImage, true); 
			} catch (Exception $e) { }

			break;
	}

			try {        
				        imagealphablending($newImage, false); 
				        imagesavealpha($newImage, true); 
			} catch (Exception $e) { }

  

	imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);

	switch ($imageType) {
		case "image/gif":
			imagegif($newImage, $image);
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			imagejpeg($newImage, $image, 90);
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage, $image);
			break;
	}






	chmod($image, 0777);
	return $image;
}



function getHeight($image) {
	$size   = getimagesize($image);
	$height = $size[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$size  = getimagesize($image);
	$width = $size[0];
	return $width;
}

//Image Locations
$large_image_location = $upload_path.$large_image_name.$_SESSION['user_file_ext'];
$thumb_image_location = $upload_path.$thumb_image_name.$_SESSION['user_file_ext'];

//Create the upload directory with the right permissions if it doesn't exist
if (!is_dir($upload_dir)) {
	mkdir($upload_dir, 0777);
	chmod($upload_dir, 0777);
}

//Check to see if any images with the same name already exist

if (file_exists($large_image_location)) {

	if (file_exists($thumb_image_location)) {
		$thumb_photo_exists = "<img src=\"".$upload_path.$thumb_image_name.$_SESSION['user_file_ext']."\" alt=\"Thumbnail Image\"/>";
	} else {
		$thumb_photo_exists = "";
	}
	$large_photo_exists = "<img src=\"".$upload_path.$large_image_name.$_SESSION['user_file_ext']."\" alt=\"Large Image\"/>";
} else {

	$large_photo_exists = "";
	$thumb_photo_exists = "";

}

if (isset($_POST["upload"])) {
 

	$xarray = array();
	$ui = 0;
 
foreach($_FILES['image']['name'] as $key=>$val){ 

	$userfile_name = $_FILES['image']['name'][$key];
	$userfile_tmp  = $_FILES['image']['tmp_name'][$key];
	$userfile_size = $_FILES['image']['size'][$key];
	$userfile_type = $_FILES['image']['type'][$key];
	$filename      = basename($_FILES['image']['name'][$key]);

	$file_ext      = strtolower(substr($filename, strrpos($filename, '.')+1));
	$filename = pathinfo($_FILES['image']['name'][$key], PATHINFO_FILENAME);

	$large_image_name   = $large_image_prefix.$filename.$_SESSION['random_key']; 
	$thumb_image_name   = $thumb_image_prefix.$filename.$_SESSION['random_key'] ; 
	$large_image_location = $upload_path.$large_image_name ;
	$thumb_image_location = $upload_path.$thumb_image_name ;

	$large_image_name_for = $large_image_name;

 

	//Only process if the file is a JPG, PNG or GIF and below the allowed limit
	if ((!empty($_FILES["image"]["name"])) && ($_FILES['image']['error'][$key] == 0)) {

		foreach ($allowed_image_types as $mime_type => $ext) {
			//loop through the specified image types and if they match the extension then break out
			//everything is ok so go and check file size
			if ($file_ext == $ext && $userfile_type == $mime_type) {
				$error = "";
				break;
			} else {
				$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
			}
		}
		//check if the file size is above the allowed limit
		if ($userfile_size > ($max_file*1048576)) {
			$error .= "Images must be under ".$max_file."MB in size";
		}

	} else {
		$error = "Select an image for upload";
	}
	//Everything is ok, so we can upload the image.
	if (strlen($error) == 0) {


		if (isset($_FILES['image']['name'])) {
			//this file could now has an unknown file extension (we hope it's one of the ones set above!)
			$large_image_location = $large_image_location.".".$file_ext;
			$thumb_image_location = $thumb_image_location.".".$file_ext;

			$large_image_name_for = $large_image_name_for.".".$file_ext;

			//put the file ext in the session so we know what file to look for once its uploaded
			$_SESSION['user_file_ext'] = ".".$file_ext;

			move_uploaded_file($userfile_tmp, $large_image_location);
			chmod($large_image_location, 0777);

			$width  = getWidth($large_image_location);
			$height = getHeight($large_image_location);
			//Scale the image if it is greater than the width set above

			if ($width > $max_width) {
				$scale = $max_width/$width;

				$uploaded = resizeImage($large_image_location, $width, $height, $scale);
			} else {
				$scale    = 1;
				$uploaded = resizeImage($large_image_location, $width, $height, $scale);
			}

			//Delete the thumbnail file so the user can create a new one
			if (file_exists($thumb_image_location)) {
				unlink($thumb_image_location);
			}
		}
		//Refresh the page to show the new uploaded image
		$xarray [$ui] = array('name' => $large_image_name_for,'path' =>substr($large_image_location,3)  );

		//echo $thumb_image_location;

		$ui++;
	}


}


 echo json_encode(array('success'=>1,'data'=>$xarray));	


} 
?>