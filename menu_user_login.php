<?php 
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            background: url('image/bg3.jpeg') no-repeat center center fixed;
            background-size: cover;
        }
        .menu-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            background-color: white;
            overflow: hidden;
            position: relative;
        }
        .menu-card:hover {
            transform: scale(1.02);
        }
        .menu-image {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            transition: 0.3s;
        }
        .unavailable {
            opacity: 0.5;
            filter: grayscale(100%);
        }
        .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 20px;
            border-radius: 15px;
        }
        .menu-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .price {
            color: #28a745;
            font-size: 1.2rem;
            font-weight: 600;
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
            color : white;
        }
        nav ul li:hover > a {
            text-decoration: underline;
            color: white;
        }
        h2 {
            margin: 30px 0 20px;
            color: #f8f9fa;
            text-align: center;
            font-weight: bold;
        }
        .filter-btn {
            margin: 0 5px 20px;
        }
        h2 {
        margin: 0 0 20px;
        color: #ffffff;
        text-align: center;
        font-weight: bold;
        font-size: 2.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        letter-spacing: 1px;
        }

        .tombol {
        text-align: center;
        margin-bottom: 30px;
        }

        .filter-btn {
        margin: 10px 5px;
        border-radius: 50px;
        padding: 8px 20px;
        font-size: 1rem;
        font-weight: bold;
        transition: all 0.3s ease;
        }

        .filter-btn:hover {
        background-color: #ffc107;
        color: #212529;
        transform: scale(1.05);
        
        }
        .filter-btn.active {
        background-color: #ffc107;
        color: #212529;
        }
        footer {
            color: green;
            position: relative;
            bottom: 0;
            width: 100%;
            content: center;
            border-radius: 10px;
        }
        .pesan {
            text-align: center;
            margin: 20px 0;
        }

        
    </style>
</head>
<body>

<div class="container">
    <nav>
        <ul>
            <li><a href="dash_user.php">DASHBOARD</a></li>
            <li><a href="menu_user.php">MENU</a></li>
            <li><a href="reservation.php">RESERVATION</a></li>
            <li><a href="login.php">LOGIN</a></li>
        </ul>
    </nav>
</div>

<div class="container py-5">
    <div class="tombol">
        <h2>Menu Tersedia</h2>
        <button class="btn btn-outline-light filter-btn" onclick="filterMenu('all')">Semua</button>
        <button class="btn btn-outline-light filter-btn" onclick="filterMenu('Makanan')">Makanan</button>
        <button class="btn btn-outline-light filter-btn" onclick="filterMenu('Minuman')">Minuman</button>
    </div>

    <div class="row" id="menu-tersedia">
        <?php
        $menuTersedia = mysqli_query($conn, "SELECT * FROM tb_menu WHERE status = 'Tersedia'");
        while ($row = mysqli_fetch_assoc($menuTersedia)) {
        ?>
        <div class="col-md-4 mb-4 menu-item" data-jenis="<?= $row['jenis']; ?>">
            <div class="card menu-card">
                <img src="image/<?= $row['foto']; ?>" class="card-img-top menu-image" alt="<?= $row['menu']; ?>">
                <div class="card-body text-center">
                    <h5 class="menu-title"><?= $row['menu']; ?></h5>
                    <p class="price">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></p>
                    <p class="text-muted"><?= $row['jenis']; ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php
        $menuTidakTersedia = mysqli_query($conn, "SELECT * FROM tb_menu WHERE status = 'Tidak Tersedia'");
        while ($row = mysqli_fetch_assoc($menuTidakTersedia)) {
        ?>
        <div class="col-md-4 mb-4 menu-item" data-jenis="<?= $row['jenis']; ?>">
            <div class="card menu-card">
                <div class="position-relative">
                    <img src="image/<?= $row['foto']; ?>" class="card-img-top menu-image unavailable" alt="<?= $row['menu']; ?>">
                    <div class="overlay">Tidak Tersedia</div>
                </div>
                <div class="card-body text-center">
                    <h5 class="menu-title"><?= $row['menu']; ?></h5>
                    <p class="price">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></p>
                    <p class="text-muted"><?= $row['jenis']; ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<footer>
    <div class="pesan">
        <button class="btn btn-warning btn-lg rounded-pill" data-bs-toggle="modal" data-bs-target="#reservationModal">
            Pesan Sekarang
        </button>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function filterMenu(category) {
    const menuItems = document.querySelectorAll('.menu-item');
    const buttons = document.querySelectorAll('.filter-btn');

    buttons.forEach(btn => btn.classList.remove('active'));

    event.target.classList.add('active');

    menuItems.forEach(item => {
        if (category === 'all') {
            item.style.display = 'block';
        } else {
            if (item.getAttribute('data-jenis') === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        }
    });
}
</script>

</body>
</html>
