<?php 
include 'config.php'; 
if(!isset($_SESSION['user_id'])) header("Location: index.php");
$uid = $_SESSION['user_id'];
$name = $_SESSION['full_name'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>لوحة القيادة | كارما</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="glass-card" style="display:flex; justify-content:space-between; align-items:center;">
            <h3>أهلاً <?php echo $name; ?> 👋 (<?php echo $role == 'teacher' ? 'معلم' : 'ولي أمر'; ?>)</h3>
            <a href="logout.php" style="color:red; text-decoration:none;">خروج</a>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 2fr; gap:20px;">
            <div class="glass-card">
                <h4>➕ إضافة طالب جديد</h4>
                <form method="POST">
                    <input type="text" name="s_name" placeholder="اسم الطالب" required>
                    <input type="text" name="s_user" placeholder="اسم المستخدم" required>
                    <input type="password" name="s_pass" placeholder="كلمة المرور" required>
                    <select name="type">
                        <option value="adhd">تشتت انتباه ADHD</option>
                        <option value="dyslexia">عسر قراءة Dyslexia</option>
                        <option value="deaf">صم وبكم</option>
                        <option value="normal">حالة عامة</option>
                    </select>
                    <button type="submit" name="add" class="btn-main" style="width:100%;">حفظ وإضافة</button>
                </form>
            </div>

            <div class="glass-card">
                <h4>👥 الطلاب التابعين لك</h4>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
                    <?php
                    $res = $conn->query("SELECT * FROM students WHERE added_by='$uid'");
                    while($row = $res->fetch_assoc()): ?>
                        <div class="glass-card" style="background:#f0f4ff; margin:0;">
                            <strong><?php echo $row['student_name']; ?></strong><br>
                            <small>نوع التكيف: <?php echo strtoupper($row['disability_type']); ?></small>
                            <div style="height:5px; background:#ddd; margin-top:10px; border-radius:5px;">
                                <div style="width:70%; height:100%; background:var(--primary); border-radius:5px;"></div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['add'])){
    $sn = $_POST['s_name']; $su = $_POST['s_user'];
    $sp = password_hash($_POST['s_pass'], PASSWORD_DEFAULT);
    $dt = $_POST['type'];
    $conn->query("INSERT INTO students (student_name, username, password, disability_type, added_by) VALUES ('$sn', '$su', '$sp', '$dt', '$uid')");
    echo "<script>window.location.href='dashboard.php';</script>";
}
?>