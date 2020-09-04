<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_processing {

	function process($path,$orientation = 'landscape' , $tinggi = '1024' , $lebar = '768' )
	{               
		$this->CI =& get_instance();

			$property_id = 1; // for our little example here

			define("_IMAGE_PATH",$path);

			if ($orientation == 'landscape') {
				define("_IMAGE_WIDTH",$lebar);
				define("_IMAGE_HEIGHT",$tinggi);
				define("_IMAGE_THUMB_WIDTH","600");
				define("_IMAGE_THUMB_HEIGHT","400");
			} else {
				define("_IMAGE_WIDTH",$lebar);
				define("_IMAGE_HEIGHT",$tinggi);
				define("_IMAGE_THUMB_WIDTH","600");
				define("_IMAGE_THUMB_HEIGHT","400");				
			}



			 // grab the path to the temporary file (image) that the user uploaded
			$photo = $_FILES['userfile']['tmp_name'];

			// check if it exists
			if(is_uploaded_file($photo)){

				//the real image file name
				$real_name = strtolower($_FILES['userfile']['name']);

				// image type based on image file name extension:
				if(strstr($real_name,".png")){
					$image_type = "png";
				}else if(strstr($real_name,".jpg")){
					$image_type = "jpg";
				}else if(strstr($real_name,".gif")){
					$image_type = "gif";
				}else{
					die("Unsupported image type");
				}

				// find the next image name we are going to save
				$namafile = pathinfo($_FILES['userfile']['name'], PATHINFO_FILENAME);
				$x="";
				while(true){
					$image_name = _IMAGE_PATH."/".$namafile."${x}.jpg";
					if(!is_file($image_name))break;
					$x=$x+1;
				}

				// start processing the main bigger image:
				$max_width = _IMAGE_WIDTH; 
				$max_height = _IMAGE_HEIGHT;
				
				$size = getimagesize($photo);
				$width = $size[0];
				$height = $size[1];
				$x_ratio = $max_width / $width;
				$y_ratio = $max_height / $height;
				if(($width <= $max_width)&&($height <= $max_height)){
					$tn_width = $width;
					$tn_height = $height;
				}else{
					if(($x_ratio * $height) < $max_height){
						$tn_height = $max_height;
						$tn_width = $max_width;
					}else{
						$tn_width = $max_width;
						$tn_height = $max_height;
					}
				}
				switch($image_type){
					case "png": $src=imagecreatefrompng($photo); break;
					case "jpg": $src=imagecreatefromjpeg($photo); break;
					case "gif": $src=imagecreatefromgif($photo); break;
				}

				// destination resized image:
				$dst = imagecreatetruecolor($tn_width, $tn_height);
				// resize original image onto $dst
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
				// write the final jpeg image..
				imagejpeg($dst, $image_name, 100) or die("Error: your photo has not been saved. Please contact the administrator");
				// time to clean up
				imagedestroy($src);
				imagedestroy($dst);

				// and now we do it alll again for the thumbnail:
				$max_width = _IMAGE_THUMB_WIDTH; $max_height = _IMAGE_THUMB_HEIGHT;
				$size = GetImageSize($photo);
				$width = $size[0];
				$height = $size[1];
				$x_ratio = $max_width / $width;
				$y_ratio = $max_height / $height;
				if(($width <= $max_width)&&($height <= $max_height)){
					$tn_width = $width;
					$tn_height = $height;
				}else{
					if(($x_ratio * $height) < $max_height){
						$tn_height = $max_height;
						$tn_width = $max_width;
					}else{
						$tn_width = $max_width;
						$tn_height = $max_height;
					}
				}
				switch($image_type){
					case "png": $src=imagecreatefrompng($photo); break;
					case "jpg": $src=imagecreatefromjpeg($photo); break;
					case "gif": $src=imagecreatefromgif($photo); break;
				}
				$dst = imagecreatetruecolor($tn_width, $tn_height);
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
				$thumbfile = $image_name . ".thumb.jpg";
				if(file_exists($thumbfile))unlink($thumbfile);
				imagejpeg($dst, $thumbfile, 100) or die("Error: your photo thumb has not been saved.
					Please contact the administrator");
				imagedestroy($src);
				imagedestroy($dst);

				return $image_name;
			}else{
				return '';
			}
		}
}


		/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */