<?php
$uploads_dir = "/var/www/html/uploads";
$allowed = array('txt', 'csv');
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//echo 'console.log('.json_encode($_FILES) .')';

//echo "\n";
echo 'console.log('.json_encode($_FILES["fileToUpload"]) .')';
echo "<br>";
if($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK){
	echo "uploading file";
	echo "<br>";
	$tmp_name = $_FILES["fileToUpload"]["tmp_name"];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
	echo $tmp_name;
	echo "<br>";
	$name = basename($_FILES["fileToUpload"]["name"]);
	echo $name;
	echo "<br>";
	echo "$uploads_dir/$name";
	if(move_uploaded_file($tmp_name, "$uploads_dir/$name")){
		echo "success";
		
	}
		
}


?>