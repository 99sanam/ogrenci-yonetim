<?php
include 'db_connection.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // تشفير كلمة المرور

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        $success_message = "Kullanıcı başarıyla oluşturuldu!";
        header("Location: login.php"); // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
        exit;
    } else {
        $error_message = "Hata oluştu: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0a192f;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #112240;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 400px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1e90ff;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #233554;
            color: #ffffff;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #1e90ff;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
        }
        .success {
            color: #4caf50;
        }
        .error {
            color: #f44336;
        }
        .sign-image img {
          width: 100%;
          height: auto;
          border-radius: 10px;
          margin-bottom: 20px;
        }


    </style>
</head>
<body>
<div class="sign-image">
    <img src="./st2.png" alt="Student Management">
</div>


    <div class="form-container">
        <h2>Kayıt Ol</h2>
        <?php if (!empty($success_message)): ?>
            <div class="message success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <div class="message error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Kayıt Ol</button>
        </form>
    </div>
</body>
</html>
