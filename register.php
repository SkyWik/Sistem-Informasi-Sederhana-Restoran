<?php
$conn = new mysqli("localhost", "root", "", "restoran");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";

if (isset($_POST['register'])) {
    $nama = trim($_POST['nama']);
    $no_hp = trim($_POST['no_hp']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($nama != "" && $no_hp != "" && $username != "" && $password != "") {
        $cek_user = $conn->prepare("SELECT * FROM tb_user WHERE username = ?");
        $cek_user->bind_param("s", $username);
        $cek_user->execute();
        $result = $cek_user->get_result();

        if ($result->num_rows > 0) {
            $message = "❌ Username sudah terdaftar!";
        } else {
            $stmt = $conn->prepare("INSERT INTO tb_user (nama, no_hp, username, password, level) VALUES (?, ?, ?, ?, 'user')");
            $stmt->bind_param("ssss", $nama, $no_hp, $username, $password);
            if ($stmt->execute()) {
                $message = "✅ Registrasi berhasil. Silakan login.";
            } else {
                $message = "❌ Gagal mendaftar. Coba lagi.";
            }
            $stmt->close();
        }
        $cek_user->close();
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
    <title>Registrasi Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('image/bg.log.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .register-box {
            max-width: 420px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
        }
        .register-box h2 {
            text-align: center;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Register</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info text-center"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" required />
        </div>
        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" class="form-control" name="no_hp" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
        </div>
        <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
    </form>
    <div class="text-center mt-3">
        Sudah punya akun? <a href="index.php">Login di sini</a>
    </div>
</div>

</body>
</html>
