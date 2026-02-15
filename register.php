<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب | كارما</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-card">
        <h2 style="text-align:center; color:var(--primary);">ابدأ مع كارما</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="الاسم الكامل" required>
            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
            <input type="password" name="pass" placeholder="كلمة المرور" required>
            <select name="role">
                <option value="parent">ولي أمر</option>
                <option value="teacher">مدرس / معلم</option>
            </select>
            <button type="submit" name="reg" class="btn-main">إنشاء حساب ودخول مباشر</button>
        </form>
        <p style="text-align:center;">لديك حساب بالفعل؟ <a href="index.php">دخول</a></p>
    </div>
</body>
</html>

<?php
if(isset($_POST['reg'])){
    $n = $conn->real_escape_string($_POST['name']); 
    $e = $conn->real_escape_string($_POST['email']); 
    $p = password_hash($_POST['pass'], PASSWORD_DEFAULT); 
    $r = $_POST['role'];
    
    $sql = "INSERT INTO users (full_name, email, password, role) VALUES ('$n', '$e', '$p', '$r')";
    
    if($conn->query($sql)) {
        // تسجيل الدخول آلياً
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['role'] = $r;
        $_SESSION['full_name'] = $n;
        
        echo "<script>location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('خطأ في التسجيل، ربما الإيميل مستخدم مسبقاً');</script>";
    }
}
?>