<?php
include 'db_connection.php';

session_start();

$error_message = '';

// Giriş kontrolü
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcıyı veritabanında ara
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Şifre doğrulama
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: ogrenci_goruntule.php");
            exit;
        } else {
            $error_message = "Hatalı şifre!";
        }
    } else {
        $error_message = "Kullanıcı bulunamadı!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
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
            color: #f44336;
        }
        .signup-link {
            text-align: center;
            margin-top: 10px;
        }
        .signup-link a {
            color: #1e90ff;
            text-decoration: none;
            font-weight: bold;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
        .login-image img {
          width: 100%;
          height: auto;
          border-radius: 10px;
          margin-bottom: 20px;
}
    </style>
</head>
<body>
<div class="login-image">
    <img src="./st.png" alt="Student Management">
</div>
    <div class="form-container">
        <h2>Giriş Yap</h2>

        <!-- Hata mesajı -->
        <?php if (!empty($error_message)): ?>
            <div class="message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Giriş formu -->
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>

        <!-- Kayıt Ol bağlantısı -->
        <div class="signup-link">
            Hesabınız yok mu? <a href="sign_up.php">Kayıt Ol</a>
        </div>
    </div>
</body>
</html>
