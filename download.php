

<?php
 // version basica:
// $file = $_GET['file'];
// header("Content-disposition: attachment; filename=$file");
// header("Content-type: application/octet-stream");
// readfile($file);

if (!isset($_GET['file']) || empty($_GET['file'])) {
 exit();
}
//$root = "";
$file = $_GET['file'];
//$path = $root.$file;
$type = '';
 
if (is_file($file)) {
	 $size = filesize($file);
	 if (function_exists('mime_content_type')) {
	 	$type = mime_content_type($file);
	 } 
	 else if (function_exists('finfo_file')) {
		 $info = finfo_open(FILEINFO_MIME);
		 $type = finfo_file($info, $file);
		 finfo_close($info);
	 }
	 if ($type == '') {
	 	$type = "application/force-download";
	 }
	 // Definir headers
	 header("Content-Type: $type");
	 header("Content-Disposition: attachment; filename=$file");
	 header("Content-Transfer-Encoding: binary");
	 header("Content-Length: " . $size);
	 // Descargar archivo
	 readfile($file);
} 
else {
 die("El archivo no existe.");
}
 
?>