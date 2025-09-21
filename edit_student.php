<?php
// Veritabanı bağlantısını dahil et
include 'db_connection.php';

$student = null;

// Eğer ID gönderilmişse öğrenciyi getir
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['get_student'])) {
    $id = $_POST['id'];

    if (!empty($id)) {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
        } else {
            echo "<div class='error-message'>Geçersiz öğrenci ID.</div>";
        }
    } else {
        echo "<div class='error-message'>Lütfen bir öğrenci ID girin.</div>";
    }
}

// Eğer güncelleme formu gönderilmişse
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_student'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $registration_date = $_POST['registration_date'];

    $sql = "UPDATE students SET name = ?, age = ?, gender = ?, department = ?, registration_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssi", $name, $age, $gender, $department, $registration_date, $id);

    if ($stmt->execute()) {
        echo "<div class='success-message'>Başarıyla güncellendi!</div>";
        $student = null; // Formu temizle
    } else {
        echo "<div class='error-message'>Bir hata oluştu: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Düzenle</title>
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
            flex-direction: column;
        }
        .form-container {
            background-color: #112240;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container input,
        .form-container select {
            background-color: #233554;
            color: #ffffff;
        }
        .form-container button {
            background-color: #4caf50;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
        .success-message {
            color: #4caf50;
            text-align: center;
            margin-bottom: 15px;
        }
        .error-message {
            color: #f44336;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- ID ile Öğrenci Getirme -->
    <div class="form-container">
        <h2>Öğrenci Bul</h2>
        <form method="POST">
            <input type="number" name="id" placeholder="Öğrenci ID" required>
            <button type="submit" name="get_student">Öğrenciyi Getir</button>
        </form>
    </div>

    <!-- Öğrenci Bilgilerini Düzenleme -->
    <?php if ($student): ?>
    <div class="form-container">
        <h2>Öğrenci Bilgilerini Düzenle</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            <input type="text" name="name" value="<?php echo $student['name']; ?>" placeholder="Adı" required>
            <input type="number" name="age" value="<?php echo $student['age']; ?>" placeholder="Yaş" required>
            <select name="gender" required>
                <option value="Male" <?php if ($student['gender'] == 'Male') echo 'selected'; ?>>Erkek</option>
                <option value="Female" <?php if ($student['gender'] == 'Female') echo 'selected'; ?>>Kadın</option>
            </select>
            <input type="text" name="department" value="<?php echo $student['department']; ?>" placeholder="Bölüm" required>
            <input type="date" name="registration_date" value="<?php echo $student['registration_date']; ?>" required>
            <button type="submit" name="update_student">Güncelle</button>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>
