<?php
	$images = "photos/p4.jpg";
	$new_images = "resize/new_p4.jpg";
	$width=600; //*** Fix Width & Heigh (Autu caculate) ***//
	$size=GetimageSize($images);
	$height=round($width*$size[1]/$size[0]);
	$images_orig = ImageCreateFromJPEG($images);
	$photoX = ImagesX($images_orig);
	$photoY = ImagesY($images_orig);
	$images_fin = ImageCreateTrueColor($width, $height);
	ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
	ImageJPEG($images_fin,$new_images);
	ImageDestroy($images_orig);
	ImageDestroy($images_fin);
?> 
	<b>Original Size</b><br>
	<img src="<?php echo $images;?>">
	<hr>
	<b>New Resize</b><br>
	<img src="<?php echo $new_images;?>"