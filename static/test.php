
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
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Choose a file:</label>
    <input type="file" id="file" name="file" onchange="displayFileName()" accept="image/*">
    <p id="file-name"></p> <!-- Здесь будет отображаться имя файла -->
    <input type="submit" value="Upload">
</form>
<script>
    // Функция для отображения имени файла, когда пользователь выбирает файл
    function displayFileName() {
        const fileInput = document.getElementById('file');
        const fileName = fileInput.files[0]?.name; // Получаем имя первого выбранного файла
        const fileNameDisplay = document.getElementById('file-name');

        // Если файл выбран, показываем его имя
        if (fileName) {
            fileNameDisplay.textContent = "Selected file: " + fileName;
        } else {
            fileNameDisplay.textContent = "No file selected";
        }
    }
</script>

</body>
</html>
