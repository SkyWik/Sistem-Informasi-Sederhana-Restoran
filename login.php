<?php
session_start();
$conn = new mysqli("localhost", "root", "", "restoran");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username != "" && $password != "") {
        $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $data['level'];

            if ($data['level'] == "admin") {
                $redirect = "dashboard.php";
            } elseif ($data['level'] == "kasir") {
                $redirect = "dash_kasir.php";
            } elseif ($data['level'] == "user") {
                $redirect = "dash_user.php";
            } else {
                $redirect = "login.php"; // fallback kalau level tidak dikenali
            }

            echo "<script>alert('Selamat Datang $username');document.location.href='$redirect';</script>";
        } else {
            $message = "❌ Username atau password salah!";
        }

        $stmt->close();
    } else {
        $message = "❗ Harap isi semua field.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - FOODIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('image/bg.log.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .login-box {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgb(46, 112, 255);
            border-color: rgb(46, 112, 255);
        }
        .register {
            text-align: center;
            margin-top: 15px;
        }
        .register a {
            text-decoration: none;
            color: rgb(46, 112, 255);
        }
        .register a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-warning text-center"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="register">
        Don't have an account? <a href="register.php">Create One</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
