<?php
// Set the upload directory relative to the current script location
$uploadDir = __DIR__ . '/../audio/';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded without errors
    if ($_FILES['mp3File']['error'] === UPLOAD_ERR_OK) {
        $uploadFile = $uploadDir . basename($_FILES['mp3File']['name']);
        $fileType = pathinfo($uploadFile, PATHINFO_EXTENSION);

        // Check if the file is an MP3 file
        if ($fileType === 'mp3') {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES['mp3File']['tmp_name'], $uploadFile)) {
                echo 'File uploaded successfully.';
            } else {
                echo 'Error uploading file.';
            }
        } else {
            echo 'Invalid file type. Please upload an MP3 file.';
        }
    } else {
        echo 'Error during file upload.';
    }
}
?>