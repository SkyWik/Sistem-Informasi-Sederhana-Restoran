<?php
session_start();
if (empty($_SESSION['level'])) {
    header("Location: index.php");
    exit;
} elseif ($_SESSION['level'] == "kasir") {
    header("Location: dash_kasir.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body {
            background: url('image/bg3.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        .container {
            width: 100%;
            text-align: center;
        }
        nav {
            width: 100%;
            height: 50px;
			font-size: 20px;
			margin-top: 10px;
			font-family: 'Big Shoulders Text', cursive;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            position: relative;
        }
        nav ul li a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
			color : white
        }
        nav ul li:hover {
            list-style: none;
        }
        nav ul li:hover > a {
			text-decoration: underline;
        }
        .halaman {
            margin: 30px auto;
            padding: 30px;
            background-color: #f4f4f4;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1, h2 {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <nav>
        <ul>
            <li><a href="dash_user.php">DASHBOARD</a></li>
            <li><a href="menu_user.php">MENU</a></li>
            <li><a href="reservation.php">RESERVASI</a></li>
            <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a></li>
        </ul>
    </nav>
</div>

<div class="halaman">
    <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <h2>Dashboard Admin</h2>
    <p>Ini adalah halaman dashboard admin restoran.</p>
</div>

</body>
</html>
