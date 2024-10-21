<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أكاديمية الوادي الجديد للتدريب والتطوير</title>
    <meta name="description" content="أكاديمية الوادي الجديد للتدريب والتطوير تقدم دورات متميزة في مختلف المجالات.">
    <meta name="keywords" content="أكاديمية, تدريب, تطوير, تعليم, علا عبدالهادي, دورات">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #e3f2fd, #bbdefb);
            color: #333;
        }

        header {
            background-color: #0d47a1;
            color: white;
            text-align: center;
            padding: 2em 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #1976d2;
            padding: 1em 0;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
            white-space: nowrap;
        }

        nav a:hover {
            background-color: #1565c0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .content {
            padding: 20px;
            text-align: center;
            display: none;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            margin: 20px 0;
            transition: all 0.3s;
        }

        .content.active {
            display: block;
        }

        footer {
            background-color: #0d47a1;
            color: white;
            text-align: center;
            padding: 1em 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: #e3f2fd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-container input,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background-color: #0d47a1;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #1565c0;
        }

        .message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <header>
        <h1>أكاديمية الوادي الجديد للتدريب والتطوير 🎓</h1>
        <p>بقيادة علا عبدالهادي 🌟</p>
    </header>

    <nav>
        <a href="#" onclick="showContent('home')">الرئيسية 🏠</a>
        <a href="#" onclick="showContent('registration')">تسجيل جديد 📝</a>
        <a href="#" onclick="showContent('login')">تسجيل دخول 🔑</a>
    </nav>

    <div class="container">
        <div class="content active" id="home">
            <h2>الرئيسية</h2>
            <p>أهلاً وسهلاً بيكم في أكاديمية الوادي الجديد، هنا هتلاقوا أفضل المحتويات التدريبية والتطويرية 💪✨.</p>
        </div>

        <div class="content" id="registration">
            <h2>تسجيل جديد</h2>
            <div class="form-container">
                <form id="registrationForm" action="register.php" method="POST">
                    <input type="text" name="name" placeholder="الاسم الكامل" required>
                    <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                    <input type="text" name="phone" placeholder="رقم الهاتف" required>
                    <button type="submit">تسجيل</button>
                </form>
                <div class="message" id="regMessage"></div>
            </div>
        </div>

        <div class="content" id="login">
            <h2>تسجيل دخول</h2>
            <div class="form-container">
                <form id="loginForm" action="login.php" method="POST">
                    <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                    <input type="text" name="phone" placeholder="رقم الهاتف" required>
                    <button type="submit">تسجيل دخول</button>
                </form>
                <div class="message" id="loginMessage"></div>
            </div>
        </div>
    </div>

    <footer>
        <p>جميع الحقوق محفوظة &copy; 2024 أكاديمية الوادي الجديد ✨</p>
    </footer>

    <script>
        function showContent(section) {
            const sections = ['home', 'registration', 'login'];
            sections.forEach(sec => {
                const element = document.getElementById(sec);
                element.classList.remove('active');
            });
            const activeSection = document.getElementById(section);
            activeSection.classList.add('active');
        }
    </script>

    <?php
    // تسجيل جديد
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // صياغة البيانات في سلسلة نصية
        $data = "$name, $email, $phone\n";

        // حفظ البيانات في ملف
        file_put_contents('users.txt', $data, FILE_APPEND);

        echo "<script>document.getElementById('regMessage').innerText = 'تم التسجيل بنجاح!';</script>";
    }

    // تسجيل دخول
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $lines = file('users.txt');
        $found = false;

        foreach ($lines as $line) {
            list($name, $savedEmail, $savedPhone) = explode(',', trim($line));
            if ($savedEmail === $email && $savedPhone === $phone) {
                $found = true;
                echo "<script>document.getElementById('loginMessage').innerText = 'مرحبًا بك، $name!';</script>";
                break;
            }
        }

        if (!$found) {
            echo "<script>document.getElementById('loginMessage').innerText = 'البريد الإلكتروني أو رقم الهاتف غير صحيح!';</script>";
        }
    }
    ?>

</body>

</html>