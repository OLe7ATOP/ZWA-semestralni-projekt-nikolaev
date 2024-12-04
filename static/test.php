
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

<form action="test-page.php" method="post" enctype="multipart/form-data">
    <label class="custom-file-upload">
        <input type="file" name="photo" id="fileInput" onchange="updateFileName(this)" required>
        <span>Выбрать фотографию</span>
    </label>
    <input type="hidden" name="photo_name" id="photoName"> <!-- Скрытое поле -->
    <button type="submit">Загрузить</button>
</form>
<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : "";
        document.getElementById("photoName").value = fileName; // Устанавливаем имя в скрытое поле
        input.nextElementSibling.textContent = fileName || "Выбрать фотографию"; // Обновляем текст кнопки
    }

</script>
</body>
</html>
