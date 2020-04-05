<?php

require_once "vendor/autoload.php";

use mikehaertl\pdftk\Pdf;

if (isset($_POST["submit"])) {

    $oPw = $_POST['ownerPassword'];
    $uPw = $_POST['userPassword'];

    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
    $file_name = $_FILES["fileToUpload"]["name"];

    //! OPTIONAL : Add seconds to file_name to avoid glitch. 
    $file_basename = substr($file_name, 0, strripos($file_name, '.'));
    $file_ext = substr($file_name, strripos($file_name, '.'));
    $file_name = $file_basename . '_' . time() . $file_ext;

    $target_dir = "uploads/" . strtolower(basename($file_name));

    // Check MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $tmp_name);

    if($mime != "application/pdf") 
    {
        die("Unknown/not permitted file type");
    }

    // Move file from tmp to uploads folder
    if(!move_uploaded_file($tmp_name, $target_dir))
    {
        die("File Upload Error");
    }

    // Encrypt the files
    $pdf = new Pdf($target_dir);
    $pdf->setPassword($oPw)          // Set owner password
        ->setUserPassword($uPw)      // Set user password
        ->passwordEncryption(128)   // Set password encryption strength
        ->saveAs($target_dir);    

    // Set browser header to accept file
    if (file_exists($target_dir)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.basename($target_dir).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($target_dir));
        readfile($target_dir);

        //! OPTIONAL : Remove the file from upload folder
        unlink($target_dir);

        exit;
    }

} 


