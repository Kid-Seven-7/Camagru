<?php

if (!file_exists("upload"))
{
    mkdir("upload");
}
$upload_dir = "upload/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . "enock".mktime(). ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?>