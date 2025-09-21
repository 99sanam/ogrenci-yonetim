<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost"; // اسم السيرفر (محلي)
$username = "root"; // اسم المستخدم (افتراضي في XAMPP)
$password = ""; // كلمة المرور (افتراضي فارغ في XAMPP)
$database = "ogrenciyonetim"; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $database);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
} else {
    // echo "Bağlantı başarılı!";
}


?>


