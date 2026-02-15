<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>دخول | كارما</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { display:flex; align-items:center; justify-content:center; height:100vh; }
        .login-box { width: 100%; max-width: 400px; text-align: center; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1 style="color:var(--primary); font-size:3rem; margin-bottom:0;">كارما</h1>
        <p style="margin-bottom:30px;">نظام التعليم الذكي المتكيف</p>
        <div class="glass-card">
            <form method="POST">
                <input type="text" name="user" placeholder="البريد أو اسم المستخدم" required>
                <input type="password" name="pass" placeholder="كلمة المرور" required>
                <button type="submit" name="login" class="btn-main" style="width:100%;">دخول</button>
            </form>
            <p><a href="register.php" style="text-decoration:none; color:var(--primary);">ليس لديك حساب؟ سجل هنا</a></p>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['login'])){
    $u = $conn->real_escape_string($_POST['user']);
    $p = $_POST['pass'];
    
    // فحص المعلمين
    $res = $conn->query("SELECT * FROM users WHERE email='$u'");
    if($user = $res->fetch_assoc()){
        if(password_verify($p, $user['password'])){
            $_SESSION['user_id'] = $user['id']; $_SESSION['role'] = $user['role']; $_SESSION['full_name'] = $user['full_name'];
            header("Location: dashboard.php");
        }
    } else {
        // فحص الطلاب
        $res = $conn->query("SELECT * FROM students WHERE username='$u'");
        if($st = $res->fetch_assoc()){
            if(password_verify($p, $st['password'])){
                $_SESSION['student_id'] = $st['id']; $_SESSION['disability'] = $st['disability_type']; $_SESSION['student_name'] = $st['student_name'];
                header("Location: student_area.php");
            }
        }
    }
}
?>