<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {

            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        .container {
            width: 100%;
            text-align: center;
            margin-bottom: 100px;
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
            background: url('image/bg3.jpeg') no-repeat center center fixed;
            background-size: cover;
            height: 650px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
        }
        .intro{
            margin: 30px auto;
            padding: 30px;
            background-color: #f4f4f4;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            color:rgb(0, 0, 0);
        }
        .intro a{
            background-color: rgb(17, 168, 17);
            border: none;
            color: white;
            width: 90px;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            padding: 5px 10px;
        }
        .intro a:hover {
            background-color:rgb(85, 201, 62);
            box-shadow: 0 0 10px rgb(97, 255, 76);
        }
        h1, h2 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="halaman">
<div class="container">
    <nav>
        <ul>
            <li><a href="index.php">DASHBOARD</a></li>
            <li><a href="menu_user_login.php">MENU</a></li>
            <li><a href="reservation_login.php">RESERVATION</a></li>
            <li><a href="login.php">LOGIN</a></li>
        </ul>
    </nav>
</div>
    <div class="intro">
    <h1>Selamat Datang</h1>
    <h2>Dashboard Admin</h2>
    <p>Ini adalah halaman dashboard admin restoran.</p>
    <a href="menu_user.php">MENU</a></li>
    </div>
</div>

<div class="perkenalan">
    <p>Ikan pais</p>
</div>

</body>
</html>
