
<?php

// Путь к файлу JSON
$jsonFile = 'database.json';
$uploadDir = 'uploads/';

// Создаем директорию, если её нет
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Проверяем загрузку файла
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $file = $_FILES['photo'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        // Генерация уникального имени файла
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $uniqueName = uniqid('photo_', true) . '.' . $fileExtension;

        // Перемещение файла в папку
        $filePath = $uploadDir . $uniqueName;
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Читаем текущий JSON
            $jsonData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

            // Добавляем новую запись
            $newEntry = [
                'original_name' => $file['name'], // Оригинальное имя
                'saved_name' => $uniqueName,     // Уникальное имя
                'path' => $filePath,             // Путь к файлу
                'uploaded_at' => date('Y-m-d H:i:s'), // Дата загрузки
            ];
            $jsonData[] = $newEntry;

            // Сохраняем данные обратно в JSON
            file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            echo "Фотография успешно загружена!";
        } else {
            echo "Ошибка сохранения файла.";
        }
    } else {
        echo "Ошибка загрузки файла: " . $file['error'];
    }
}


?>
