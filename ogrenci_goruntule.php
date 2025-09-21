<?php
include 'db_connection.php'; // Veritabanı bağlantısını dahil et

// Toplam öğrenci sayısını al
$count_sql = "SELECT COUNT(*) AS total_students FROM students";
$count_result = $conn->query($count_sql);
$total_students = 0;

if ($count_result && $count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_students = $count_row['total_students'];
}

// Silme işlemi
$success_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $success_message = "Öğrenci başarıyla silindi.";
        // Öğrenci sayısını güncelle
        $total_students--;
    } else {
        $success_message = "Öğrenci silinirken bir hata oluştu.";
    }
}

// Öğrenci listesini çek
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Listesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0a192f;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #112240;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #112240;
        }
        .delete-btn {
            background-color: #f44336;
            color: #ffffff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .success-message {
            color: #4caf50;
            text-align: center;
            margin: 15px 0;
        }
        h1 {
            text-align: center;
            color: #4caf50;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
    </style>
    <script>
        // Mesajı gizleme
        function hideMessage() {
            const messageElement = document.getElementById("success-message");
            if (messageElement) {
                setTimeout(() => {
                    messageElement.style.display = "none";
                }, 3000); // 3 saniye sonra gizle
            }
        }
    </script>
</head>
<body onload="hideMessage()">
    <h1>Öğrenci Listesi</h1>

    <!-- Öğrenci Sayısı -->
    <div style="text-align: center; margin-bottom: 20px;">
        <h2 style="color: #1e90ff;">Toplam Öğrenci Sayısı: <?php echo $total_students; ?></h2>
    </div>

    <?php if (!empty($success_message)): ?>
        <div id="success-message" class="success-message">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Adı</th>
                <th>Yaşı</th>
                <th>Cinsiyeti</th>
                <th>Bölümü</th>
                <th>Telefon Numarası</th>
                <th>Adres</th>
                <th>Kayıt Tarihi</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['mobile_number']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['registration_date']; ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="delete-btn">Sil</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
