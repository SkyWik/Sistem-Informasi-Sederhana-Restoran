<?php 
include 'config/koneksi.php';

// Simpan menu baru
if (isset($_POST['simpan'])) {
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = "image/";
    $nama_file = $_FILES['foto']['name'];

    move_uploaded_file($tmp, "$folder/$nama_file");

    $a = mysqli_query($conn, "INSERT INTO tb_menu VALUES(
        null,
        '$_POST[menu]',
        '$_POST[jenis]',
        '$_POST[harga]',
        '$_POST[status]',
        '$nama_file',
        '$_POST[kategori]'
    )");

    echo "<script>alert('Berhasil Tersimpan');document.location.href='?menu=menu'</script>";
}

// Hapus menu
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM tb_menu WHERE kd_menu = '$_GET[id]'");
    echo "<script>alert('Berhasil Dihapus');document.location.href='?menu=menu'</script>";
}

// Ambil data untuk edit
if (isset($_GET['edit'])) {
    $edit = "SELECT * FROM tb_menu WHERE kd_menu = '$_GET[id]'";
    $take = mysqli_query($conn, $edit);
    $ambil = mysqli_fetch_array($take);
}

// Update data menu
if (isset($_POST['update'])) {
    $menu = $_POST['menu'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $kategori = $_POST['kategori'];
    $tmp = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];

    if (!empty($nama_file)) {
        move_uploaded_file($tmp, "$folder/$nama_file");
        $foto = ", foto = '$nama_file'";
    } else {
        $foto = ""; // tidak update foto kalau kosong
    }

    mysqli_query($conn, "UPDATE tb_menu SET 
        jenis = '$jenis',
        harga = '$harga',
        status = '$status'
        $foto,
        kd_kategori = '$kategori'
        WHERE menu = '$menu'
    ");

    echo "<script>alert('Berhasil Diubah');document.location.href='?menu=menu'</script>";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Menu</title>
    <style>
        body {
            
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
            background-color: gray;
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
        .button {
            background-color: rgb(10,101,146);
            border: none;
            color: white;
            width: 90px;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
            
        }
        .button:hover {
            background-color: #0a7dac;
        }
        table {
            border-collapse: collapse;
            margin-top: 30px;
            background-color: #f4f4f4;
            border: 1.5px solid black;
        }
        table tr {
            text-align: center;
        }
        th, td {
            padding: 10px 20px;
            border: 1.5px solid black;
            color: black;
        }
        th {
            background: #bdbdbd;
        }
        input[type="text"], select, input[type="file"] {
            width: 80%;
            padding: 12px;
            border: 1.5px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }
        .tabel {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        h1 {
            color: black;
            text-align: center;
            font-family: sans-serif;
            padding: 20px;
            border-radius: 10px;
            background-color: white;
            width: 30%;
            height: auto;
            margin: 0 auto;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<nav>
    <ul>
        <li><a href="dashboard.php">DASHBOARD</a></li>
        <li><a href="menu.php">MENU</a></li>
        <li><a href="kategori.php">KATEGORI</a></li>
        <li><a href="laporan.php">LAPORAN</a></li>
        <li><a href="user.php">KELOLA USER</a></li>
        <li><a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a></li>
    </ul>
</nav>

<h1>Kelola Menu</h1>

<center>
    <form method="post" enctype="multipart/form-data">
        <table align="center">
            <tr>
                <td>Menu</td>
                <td><input type="text" name="menu" value="<?= @$ambil[1]; ?>"></td>
            </tr>
            <tr>
                <td>Jenis</td>
                <td>
                    <select name="jenis">
                        <option>Makanan</option>
                        <option>Minuman</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="text" name="harga" value="<?= @$ambil[3]; ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option>Tersedia</option>
                        <option>Tidak Tersedia</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><input type="file" name="foto"></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>
                    <select name="kategori">
                        <?php 
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
                        while ($row = mysqli_fetch_array($kategori)) {
                        ?>
                        <option value="<?= $row[0]; ?>"><?= $row[1]; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
        </table>
        <br>
          <input type="submit" name="simpan" value="Simpan" class="button" style="margin-right:10px;">
          <input type="submit" name="update" value="Update" class="button">
        </br>

        <div style="margin-top:30px;">
            <input type="text" name="tcari" placeholder="Cari" value="<?= @$_POST['tcari']; ?>" style="width:400px;">
            <input type="submit" name="cari" class="button" value="Search">
        </div>
    </form>

    <form method="post">
        <table class="tabel" border="1" align="center">
            <tr>
                <th>Kode Menu</th>
                <th>Menu</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Foto</th>
                <th>Kode Kategori</th>
                <th>Aksi</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tb_menu";
            if (isset($_POST['cari'])) {
                $tcari = $_POST['tcari'];
                $sql = "SELECT * FROM tb_menu WHERE 
                        kd_menu LIKE '$tcari%' OR 
                        menu LIKE '$tcari%' OR 
                        jenis LIKE '$tcari%' OR 
                        harga LIKE '$tcari%' OR 
                        status LIKE '$tcari%'";
            }
            $qry = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($qry)) {
            ?>
            <tr>
                <td><?= $row[0]; ?></td>
                <td><?= $row[1]; ?></td>
                <td><?= $row[2]; ?></td>
                <td>Rp.<?= number_format($row[3],2,',','.'); ?></td>
                <td><?= $row[4]; ?></td>
                <td><img src="image/<?= $row[5]; ?>" style="width:90px; height:50px;"></td>
                <td><?= $row[6]; ?></td>
                <td>
                    <a href="?menu=menu&edit&id=<?= $row[0]; ?>">Edit</a> | 
                    <a href="?menu=menu&hapus&id=<?= $row[0]; ?>">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </form>
</center>

</body>
</html>
