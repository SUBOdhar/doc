<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP3 File Uploader</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            transition: transform 0.3s ease-in-out;
        }

        form:hover {
            transform: scale(1.02);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>MP3 File Uploader</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="mp3File">Select MP3 file:</label>
        <input type="file" name="mp3File" id="mp3File" accept=".mp3">
        <br>
        <input type="submit" value="Upload">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the file was uploaded without errors
        if ($_FILES['mp3File']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../audio/';
            $uploadFile = $uploadDir . basename($_FILES['mp3File']['name']);
            $fileType = pathinfo($uploadFile, PATHINFO_EXTENSION);

            // Check if the file is an MP3 file
            if ($fileType === 'mp3') {
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES['mp3File']['tmp_name'], $uploadFile)) {
                    echo '<div class="success">File uploaded successfully.</div>';
                } else {
                    echo '<div class="error">Error uploading file.</div>';
                }
            } else {
                echo '<div class="error">Invalid file type. Please upload an MP3 file.</div>';
            }
        } else {
            echo '<div class="error">Error during file upload.</div>';
        }
    }
    ?>
</body>
</html>