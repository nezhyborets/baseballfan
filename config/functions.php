<?php
    function imagesFolder() {
        return $_SERVER['DOCUMENT_ROOT'].'/'.IMAGES_FOLDER_NAME.'/';
    }
	
	function thumbnail($orig_img_name) 
	{
			if ($orig_img_name) {
				$orig_img_path = ($_SERVER['DOCUMENT_ROOT'].'/images/news_images/'.$orig_img_name);
				$output_img_name = ('THUMB'.$orig_img_name);
				$output_img_path = ($_SERVER['DOCUMENT_ROOT'].'/images/temp_news_images/'.$output_img_name);
				$image = imagecreatefromjpeg($orig_img_path);
				list($width,$height) = getimagesize ($orig_img_path);
				
				$max_height = 250;
				$proportion = $height/$max_height;
				$max_width = $width/$proportion;
				
				$image_new = imagecreatetruecolor($max_width,$max_height);
							
				imagecopyresampled ($image_new, $image, 0, 0, 0, 0, $max_width, $max_height, $width, $height);
				imagejpeg($image_new,$output_img_path,100);
				return $output_img_name;
			}
	}

    function thumbnailImageToDir($originImageDir, $originImageName, $outputImageDir) {
        $orig_img_path = ($originImageDir.$originImageName);
        $output_img_name = ('THUMB'.$originImageName);
        $output_img_path = ($outputImageDir.$output_img_name);
        $image = imagecreatefromjpeg($orig_img_path);
        list($width,$height) = getimagesize ($orig_img_path);

        $max_height = 250;
        $proportion = $height/$max_height;
        $max_width = $width/$proportion;

        $image_new = imagecreatetruecolor($max_width,$max_height);

        imagecopyresampled ($image_new, $image, 0, 0, 0, 0, $max_width, $max_height, $width, $height);
        imagejpeg($image_new,$output_img_path,100);
        return $output_img_name;
    }
	
	function image_upload($fileName,$tempFile,$dirInsideImagesDir,$targetImageName)
	{
		if(is_uploaded_file($tempFile))
		{
			$new_image_tmpname = $tempFile;

            $dir = $_SERVER['DOCUMENT_ROOT'].'/'.IMAGES_FOLDER_NAME.'/'.$dirInsideImagesDir;

            if (!is_dir($dir)) {
                mkdir($dir);
            }

            if (!pathinfo($targetImageName, PATHINFO_EXTENSION)) {
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $targetImageName .= '.'.$ext;
            }

			$fileMoved = move_uploaded_file ($new_image_tmpname,$dir.'/'.$targetImageName);

            if ($fileMoved) {
                return $targetImageName;
            }
		} else {
			echo 'Файл не загружен';
		}

        return false;
	}

    function deleteFileAtPath($path) {
        if (file_exists($path)) {
            unlink($path);
            return true;
        }

        return false;
    }

	
	function comment_save($news_id,$username,$comment_text)
	{
		 $query = "INSERT INTO tbl_news_comments (news_id,
		                                          comment_username,
												  comment_text,
												  comment_date,
												  comment_time)
										  VALUES ('$news_id',
										          '$username',
												  '$comment_text',
												  CURDATE(),
												  CURTIME())";
	     $query_result = mysql_query($query) or die (mysql_error());
	}
?>