<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailExists = false;

    foreach ($existingData as $user) {
        if (isset($user["mail"]) && $user["mail"] === $mail) {
            $emailExists = true;
            break;
        }
    }

    if ($emailExists) {
        $_SESSION['message'] = "Email already exists";
        $_SESSION['message_type'] = "error";
        header("Location: registration.php");
        exit();
    }

    $existingData[] = $data;
    $saveResult = file_put_contents($filepath, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    if ($saveResult === false) {
        $_SESSION['message'] = "Failed to save data";
        $_SESSION['message_type'] = "error";
        header("Location: registration.php");
        exit();
    }

    $_SESSION['message'] = "Registration successful";
    $_SESSION['message_type'] = "success";
    header("Location: registration.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        .message-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
            position: relative;
            border-radius: 5px;
        }
        .message-box.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .message-box.error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        .message-box button {
            position: absolute;
            top: 5px;
            right: 10px;
            background: transparent;
            border: none;
            color: inherit;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['message'])) {
    $message = htmlspecialchars($_SESSION['message']);
    $messageType = $_SESSION['message_type'] ?? 'info';
    $messageClass = $messageType === 'success' ? 'success' : 'error';

    echo "
        <div class='message-box $messageClass'>
            <span>$message</span>
            <button onclick='closeMessage(this)'>&times;</button>
        </div>";

    // Удаляем сообщение после его отображения
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<form method="POST" action="">
    <label for="fname">First Name:</label>
    <input type="text" name="fname" id="fname" required><br>
    <label for="sname">Second Name:</label>
    <input type="text" name="sname" id="sname" required><br>
    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" required><br>
    <label for="gender">Gender:</label>
    <select name="gender" id="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br>
    <label for="mail">Email:</label>
    <input type="email" name="mail" id="mail" required><br>
    <label for="pass01">Password:</label>
    <input type="password" name="pass01" id="pass01" required><br>
    <label for="pass02">Confirm Password:</label>
    <input type="password" name="pass02" id="pass02" required><br>
    <button type="submit">Register</button>
</form>

<script>
    function closeMessage(button) {
        const messageBox = button.parentElement; // Находим родителя кнопки
        messageBox.style.display = 'none'; // Скрываем сообщение
    }
</script>
</body>
</html>
