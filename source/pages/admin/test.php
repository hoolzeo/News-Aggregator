<?php
$files = new RecursiveDirectoryIterator($_SERVER['DOCUMENT_ROOT'].'/images/icons/sites/16');
foreach($files as $file){
echo $file;
unlink($file->getRealPath());
}
?>
