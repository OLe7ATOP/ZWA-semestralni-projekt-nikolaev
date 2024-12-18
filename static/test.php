
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .custom-file-upload:hover {
            background-color: #0056b3;
        }

        .custom-file-upload span {
            display: inline-block;
        }

    </style>
    <script src="scripts.js"></script>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Choose a file:</label>
    <input type="file" id="file" name="file" onchange="displayFileName()" accept="image/*">
    <p id="file-name"></p> <!-- Здесь будет отображаться имя файла -->
    <input type="submit" value="Upload">
</form>

<button onclick="deletetraining()">CLICK HERE</button>
</body>
</html>
