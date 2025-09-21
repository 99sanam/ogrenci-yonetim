<?php
include 'db_connection.php'; // Veritabanı bağlantısını dahil et

// Form gönderimi kontrolü
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name']; // Öğrenci adı
    $age = $_POST['age']; // Öğrenci yaşı
    $gender = $_POST['gender']; // Öğrenci cinsiyeti
    $department = $_POST['department']; // Öğrenci bölümü
    $registration_date = $_POST['registration_date']; // Kayıt tarihi
    $mobile_number = $_POST['mobile_number']; // Telefon numarası
    $address = $_POST['address']; // Adres

    // Verileri tabloya ekle
    $sql = "INSERT INTO students (name, age, gender, department, registration_date, mobile_number, address) 
            VALUES ('$name', $age, '$gender', '$department', '$registration_date', '$mobile_number', '$address')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Öğrenci başarıyla eklendi!"; // Başarı mesajı
    } else {
        $error_message = "Hata: " . $conn->error; // Hata mesajı
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Ekle</title>
    <style>
        /* Sayfa genel stilleri */
        body {
            font-family: Arial, sans-serif;
            background-color: #0f0f2d; /* Arka plan rengi: koyu mavi-siyah */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form kapsayıcısı stili */
        .form-container {
            background-color: #1a1a40; /* Kutu arka plan rengi: koyu mavi */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); /* Gölge efekti */
            width: 100%;
            max-width: 400px;
        }

        /* Başlık stili */
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #4a90e2; /* Başlık rengi: açık mavi */
        }

        /* Form elemanları stili */
        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Giriş alanları ve seçim kutuları */
        .form-container input,
        .form-container select {
            background-color: #ffffff; /* Beyaz arka plan */
            color: #000000; /* Siyah yazı rengi */
        }

        /* Gönder düğmesi */
        .form-container button {
            background-color: #4a90e2; /* Açık mavi düğme rengi */
            color: white; /* Beyaz yazı rengi */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Hover efekti */
        }

        /* Hover efekti */
        .form-container button:hover {
            background-color: #3567a6; /* Daha koyu mavi */
        }

        /* Mesaj stili */
        .message {
            text-align: center;
            margin-bottom: 15px;
        }

        /* Başarı mesajı */
        .success {
            color: #4caf50; /* Yeşil renk */
        }

        /* Hata mesajı */
        .error {
            color: #f44336; /* Kırmızı renk */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Öğrenci Ekle</h2>

        <!-- Başarı veya hata mesajları -->
        <?php if (isset($success_message)): ?>
            <div class="message success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <div class="message error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Ad Soyad" required>
            <input type="number" name="age" placeholder="Yaş" required>
            <select name="gender" required>
                <option value="" disabled selected>Cinsiyet</option>
                <option value="Male">Erkek</option>
                <option value="Female">Kadın</option>
            </select>
            <input type="text" name="department" placeholder="Bölüm" required>
            <input type="date" name="registration_date" required>
            <input type="text" name="mobile_number" placeholder="Telefon Numarası" required>
            <textarea name="address" placeholder="Adres" rows="3" required></textarea>
            <button type="submit">Ekle</button>
        </form>
    </div>
</body>
</html>
