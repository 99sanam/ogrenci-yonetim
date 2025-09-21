<?php
include 'db_connection.php';

// إنشاء جدول الطلاب
// $sql_students = "CREATE TABLE IF NOT EXISTS students (
//     id INT NOT NULL AUTO_INCREMENT,
//     name VARCHAR(255) NOT NULL,
//     age INT NOT NULL,
//     gender ENUM('Male', 'Female') NOT NULL,
//     department VARCHAR(255) NOT NULL,
//     registration_date DATE NOT NULL,
//     mobile_number VARCHAR(15), -- رقم الموبايل
//     address TEXT, -- العنوان
//     PRIMARY KEY (id)
// )";
// if ($conn->query($sql_students) === TRUE) {
//     echo "Tablo 'students' başarıyla oluşturuldu veya zaten mevcut.";
// } else {
//     echo "Tablo oluşturulurken hata oluştu: " . $conn->error;
// }
// $sql_alter = "ALTER TABLE students 
// ADD COLUMN mobile_number VARCHAR(15),
// ADD COLUMN address TEXT";


// if ($conn->query($sql_alter) === TRUE) {
// echo "Yeni sütunlar başarıyla eklendi.";
// } else {
// echo "Sütun ekleme sırasında hata oluştu: " . $conn->error;
// }


// $sql_users = "CREATE TABLE IF NOT EXISTS users (
//     id INT NOT NULL AUTO_INCREMENT,
//     username VARCHAR(255) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     PRIMARY KEY (id)
// )";

// if ($conn->query($sql_users) === TRUE) {
//     echo "Tablo 'users' başarıyla oluşturuldu.";
// } else {
//     echo "Tablo oluşturulurken hata oluştu: " . $conn->error;
// }
// أغلق الاتصال بقاعدة البيانات
$conn->close();
?>
