<?php 
include 'config.php'; 
if(!isset($_SESSION['student_id'])) header("Location: index.php"); 
$type = $_SESSION['disability']; 
$s_name = $_SESSION['student_name']; 
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>رحلتي التعليمية | كارما</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo $type; ?>">
    <div class="container">
        <header style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <h1 style="color:var(--primary);">كارما الذكية</h1>
            <a href="logout.php" class="btn-main" style="background:#ff4d6d;">خروج</a>
        </header>

        <div class="glass-card" style="background: linear-gradient(135deg, #4361ee, #4cc9f0); color:white;">
            <h2>أهلاً بك يا <?php echo $s_name; ?> ✨</h2>
            <p>أنت اليوم بطل في رحلة تعلم جديدة!</p>
        </div>

        <div class="glass-card">
            <?php if($type == 'adhd'): ?>
                <div style="text-align:center; margin-bottom:20px;">
                    <span id="timer" style="font-size:1.5rem; background:var(--adhd-color); color:white; padding:10px 20px; border-radius:30px; font-weight:bold;">15:00</span>
                </div>
                <h2 style="color:var(--adhd-color);">درس اليوم: البرمجة الممتعة</h2>
                <div class="lesson-step">1️⃣ البرمجة هي لغة نتحدث بها مع الآلات.</div>
                <div class="lesson-step">2️⃣ نحن نعطي أوامر والكمبيوتر ينفذها فوراً.</div>
                <div class="lesson-step">3️⃣ كل برنامج هو عبارة عن مجموعة خطوات بسيطة.</div>

            <?php elseif($type == 'dyslexia'): ?>
                <h2 style="color:var(--dys-color);">موضوع اليوم: الفضاء والنجوم</h2>
                <div style="margin-bottom:20px;">
                    <button class="btn-main" onclick="readText()">🔊 استمع للشرح الآن</button>
                </div>
                <div class="lesson-content" id="lesson-text">
                    الـكـون واسـع جـداً ويـحـتـوي عـلـى مـلايـيـن الـمـجـرات. نـحـن نـعـيـش فـي كـوكـب الأرض الـذي يـدور حـول الـشـمـس.
                </div>

            <?php elseif($type == 'deaf'): ?>
                <h2 style="color:var(--deaf-color);">تعلم لغة الإشارة (كلمات أساسية)</h2>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:20px;">
                    <div class="glass-card" style="text-align:center;">
                        <span style="font-size:4rem;">👋</span><br><b>مرحباً</b>
                    </div>
                    <div class="glass-card" style="text-align:center;">
                        <span style="font-size:4rem;">🙏</span><br><b>شكراً</b>
                    </div>
                    <div class="glass-card" style="text-align:center;">
                        <span style="font-size:4rem;">👍</span><br><b>نعم / نعم</b>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function readText() {
            let msg = new SpeechSynthesisUtterance(document.getElementById('lesson-text').innerText);
            msg.lang = 'ar-SA';
            window.speechSynthesis.speak(msg);
        }

        if(document.getElementById('timer')) {
            let sec = 900;
            setInterval(() => {
                let m = Math.floor(sec/60); let s = sec%60;
                document.getElementById('timer').innerHTML = `${m}:${s<10?'0':''}${s}`;
                if(sec > 0) sec--;
            }, 1000);
        }
    </script>
</body>
</html>