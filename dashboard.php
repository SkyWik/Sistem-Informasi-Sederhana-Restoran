<?php
session_start();
include 'config/koneksi.php';

// Cek session login
if (empty($_SESSION['level'])) {
    header("Location: index.php");
    exit;
} elseif ($_SESSION['level'] == "kasir") {
    header("Location: dash_kasir.php");
    exit;
}

// === PROSES USER ===
if (isset($_POST['simpan_user'])) {
    mysqli_query($conn, "INSERT INTO tb_user VALUES(null, '$_POST[nama]', '$_POST[nohp]', '$_POST[username]', '$_POST[password]', '$_POST[level]')");
    echo "<script>alert('User Tersimpan');location.href='dashboard.php#user';</script>";
}
if (isset($_POST['update_user'])) {
    mysqli_query($conn, "UPDATE tb_user SET nama='$_POST[nama]', no_hp='$_POST[nohp]', username='$_POST[username]', password='$_POST[password]', level='$_POST[level]' WHERE kd_user='$_GET[id]'");
    echo "<script>alert('User Diupdate');location.href='dashboard.php#user';</script>";
}
if (isset($_GET['hapus_user'])) {
    mysqli_query($conn, "DELETE FROM tb_user WHERE kd_user='$_GET[id]'");
    echo "<script>alert('User Dihapus');location.href='dashboard.php#user';</script>";
}
if (isset($_GET['edit_user'])) {
    $edit_user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_user WHERE kd_user='$_GET[id]'"));
}

// === PROSES KATEGORI ===
if (isset($_POST['simpan_kategori'])) {
    mysqli_query($conn, "INSERT INTO tb_kategori VALUES(null, '$_POST[kategori]')");
    echo "<script>alert('Kategori Tersimpan');location.href='dashboard.php#kategori';</script>";
}
if (isset($_POST['update_kategori'])) {
    mysqli_query($conn, "UPDATE tb_kategori SET kategori='$_POST[kategori]' WHERE id_kategori='$_GET[id]'");
    echo "<script>alert('Kategori Diupdate');location.href='dashboard.php#kategori';</script>";
}
if (isset($_GET['hapus_kategori'])) {
    mysqli_query($conn, "DELETE FROM tb_kategori WHERE id_kategori='$_GET[id]'");
    echo "<script>alert('Kategori Dihapus');location.href='dashboard.php#kategori';</script>";
}
if (isset($_GET['edit_kategori'])) {
    $edit_kategori = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_kategori WHERE id_kategori='$_GET[id]'"));
}

// === PROSES MENU ===
if (isset($_POST['simpan_menu'])) {
    mysqli_query($conn, "INSERT INTO tb_menu VALUES(null, '$_POST[nama_menu]', '$_POST[harga]', '$_POST[kategori]')");
    echo "<script>alert('Menu Tersimpan');location.href='dashboard.php#menu';</script>";
}
if (isset($_POST['update_menu'])) {
    mysqli_query($conn, "UPDATE tb_menu SET nama_menu='$_POST[nama_menu]', harga='$_POST[harga]', id_kategori='$_POST[kategori]' WHERE id_menu='$_GET[id]'");
    echo "<script>alert('Menu Diupdate');location.href='dashboard.php#menu';</script>";
}
if (isset($_GET['hapus_menu'])) {
    mysqli_query($conn, "DELETE FROM tb_menu WHERE id_menu='$_GET[id]'");
    echo "<script>alert('Menu Dihapus');location.href='dashboard.php#menu';</script>";
}
if (isset($_GET['edit_menu'])) {
    $edit_menu = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_menu WHERE id_menu='$_GET[id]'"));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f7;
    color: #333;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    
}

/* Navbar Styling */
nav {
    background-color: #2c3e50;
    padding: 10px 0;
    color: white;
    font-size: 18px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

nav ul {
    display: flex;
    justify-content: center;
    list-style: none;
}

nav ul li {
    margin: 0 20px;
}

nav ul li a {
    color: white;
    font-weight: 500;
    padding: 5px 10px;
    transition: background-color 0.3s;
    
}

nav ul li a:hover {
    background-color: #27ae60;
    border-radius: 5px;
    color: white;
    text-decoration: underline;
}

/* Container and Box Styles */
#dashboard {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
}

.box {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    text-align: center;

}

/* Dashboard Card Layout */
.box1 {
    display: block;
    text-align: center;
}

.card {
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 10px;
    margin: 10px;
    width: 20%;
    text-align: center;
    justify-content: flex;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    display: inline-block;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card h3 {
    font-size: 24px;
    color: #2c3e50;
}

.card p {
    font-size: 36px;
    color: #27ae60;
    font-weight: bold;
}

/* Form and Input Styles */
input[type="text"], input[type="password"], select {
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    font-size: 16px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #27ae60;
    color: white;
    padding: 15px 25px;
    border-radius: 5px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #2ecc71;
}

select {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
h2, p {
    text-align: center;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid black;

}

th {
    background-color: #2c3e50;
    color: white;
    text-align: center;
}

tr:hover {
    background-color: #f4f4f4;
}

/* Hover effect for actions (Edit & Delete) */
a {
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    color: #2980b9;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .box1 {
        flex-direction: column;
        gap: 20px;
    }

    .card {
        width: 100%;
    }

    table {
        font-size: 14px;
    }

    nav ul {
        flex-direction: column;
    }

    nav ul li {
        margin-bottom: 10px;
    }
}

    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="logout.php" onclick="return confirm('Yakin logout?')">Logout</a></li>
    </ul>
</nav>

<div id="dashboard" class="box">
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Ini adalah dashboard admin restoran.</p>

    <?php
    // Ambil data total pesanan
    $total_pesanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_pesanan"))['total'];

    // Ambil data total reservasi
    $total_reservasi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_reservation"))['total'];

    // Ambil data total menu
    $total_menu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_menu"))['total'];
    ?>

    <div class="box1">
        <h2>Welcome to the Dashboard</h2>
        <br>
        <div class="card">
            <h3>Total Reservation</h3>
            <p><?php echo $total_reservasi; ?></p>
        </div>
        <div class="card">
            <h3>Total Menu</h3>
            <p><?php echo $total_menu; ?></p>
        </div>
        <div class="card">
            <h3>Total Booking</h3>
            <p><?php echo $total_pesanan; ?></p>
        </div>
    </div>



    <div id="menu" class="box">
        <h2>Kelola Menu</h2>
        <form method="post">
            <input type="text" name="nama_menu" placeholder="Nama Menu" required value="<?php echo @$edit_menu['nama_menu']; ?>">
            <input type="text" name="harga" placeholder="Harga" required value="<?php echo @$edit_menu['harga']; ?>">
            <select name="kategori" required>
                <option value="">- Pilih Kategori -</option>
                <?php
                $kat = mysqli_query($conn, "SELECT * FROM tb_kategori");
                while ($k = mysqli_fetch_array($kat)) {
                    $sel = @$edit_menu['id_kategori'] == $k['id_kategori'] ? 'selected' : '';
                    echo "<option value='$k[id_kategori]' $sel>$k[kategori]</option>";
                }
                ?>
            </select><br>
            <?php if (isset($_GET['edit_menu'])) { ?>
                <input type="submit" name="update_menu" value="Update Menu">
            <?php } else { ?>
                <input type="submit" name="simpan_menu" value="Tambah Menu">
            <?php } ?>
        </form>

        <table>
            <tr><th>ID</th><th>Nama Menu</th><th>Harga</th><th>Kategori</th><th colspan="2">Aksi</th></tr>
            <?php
            $menu = mysqli_query($conn, "SELECT tb_menu.*, tb_kategori.kategori FROM tb_menu LEFT JOIN tb_kategori ON tb_menu.kd_kategori = tb_kategori.kd_kategori");
            while ($m = mysqli_fetch_array($menu)) { ?>
            <tr>
                <td><?php echo $m['kd_menu']; ?></td>
                <td><?php echo $m['menu']; ?></td>
                <td><?php echo $m['harga']; ?></td>
                <td><?php echo $m['kategori']; ?></td>
                <td><a href="dashboard.php?edit_menu&id=<?php echo $m['kd_menu']; ?>#menu">Edit</a></td>
                <td><a onclick="return confirm('Yakin?')" href="dashboard.php?hapus_menu&id=<?php echo $m['kd_menu']; ?>#menu">Hapus</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div id="kategori" class="box">
        <h2>Kelola Kategori</h2>
        <form method="post">
            <input type="text" name="kategori" placeholder="Nama Kategori" required value="<?php echo @$edit_kategori['kategori']; ?>"><br>
            <?php if (isset($_GET['edit_kategori'])) { ?>
                <input type="submit" name="update_kategori" value="Update Kategori">
            <?php } else { ?>
                <input type="submit" name="simpan_kategori" value="Tambah Kategori">
            <?php } ?>
        </form>

        <table>
            <tr><th>ID</th><th>Kategori</th><th colspan="2">Aksi</th></tr>
            <?php
            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
            while ($k = mysqli_fetch_array($kategori)) { ?>
            <tr>
                <td><?php echo $k['kd_kategori']; ?></td>
                <td><?php echo $k['kategori']; ?></td>
                <td><a href="dashboard.php?edit_kategori&id=<?php echo $k['kd_kategori']; ?>#kategori">Edit</a></td>
                <td><a onclick="return confirm('Yakin?')" href="dashboard.php?hapus_kategori&id=<?php echo $k['kd_kategori']; ?>#kategori">Hapus</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div id="user" class="box">
        <h2>Kelola User</h2>
        <form method="post">
            <input type="text" name="nama" placeholder="Nama" required value="<?php echo @$edit_user['nama']; ?>">
            <input type="text" name="nohp" placeholder="No HP" required value="<?php echo @$edit_user['no_hp']; ?>">
            <input type="text" name="username" placeholder="Username" required value="<?php echo @$edit_user['username']; ?>">
            <input type="text" name="password" placeholder="Password" required value="<?php echo @$edit_user['password']; ?>">
            <select name="level" required>
                <option value="admin" <?php if(@$edit_user['level']=='admin') echo 'selected'; ?>>Admin</option>
                <option value="kasir" <?php if(@$edit_user['level']=='kasir') echo 'selected'; ?>>Kasir</option>
            </select><br>
            <?php if (isset($_GET['edit_user'])) { ?>
                <input type="submit" name="update_user" value="Update User">
            <?php } else { ?>
                <input type="submit" name="simpan_user" value="Tambah User">
            <?php } ?>
        </form>

        <table>
            <tr><th>ID</th><th>Nama</th><th>No HP</th><th>Username</th><th>Password</th><th>Level</th><th colspan="2">Aksi</th></tr>
            <?php
            $user = mysqli_query($conn, "SELECT * FROM tb_user");
            while ($u = mysqli_fetch_array($user)) { ?>
            <tr>
                <td><?php echo $u['kd_user']; ?></td>
                <td><?php echo $u['nama']; ?></td>
                <td><?php echo $u['no_hp']; ?></td>
                <td><?php echo $u['username']; ?></td>
                <td><?php echo $u['password']; ?></td>
                <td><?php echo $u['level']; ?></td>
                <td><a href="dashboard.php?edit_user&id=<?php echo $u['kd_user']; ?>#user">Edit</a></td>
                <td><a onclick="return confirm('Yakin?')" href="dashboard.php?hapus_user&id=<?php echo $u['kd_user']; ?>#user">Hapus</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>
