<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "restoran");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO tb_reservation (name, email, telephone, date, time, guests, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $name, $email, $telephone, $date, $time, $guests, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Reservation berhasil dikirim!'); window.location='reservation.php';</script>";
    } else {
        echo "<script>alert('Gagal mengirim reservation.');</script>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <style>
        body {
            background: url('image/bg3.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
        .form-container {
            background-color: white;
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input, textarea, select {
            width: 95%;
            padding: 10px;
            margin: 6px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        label {
            font-weight: bold;
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
            <li><a href="logout.php" onclick="return confirm('Yakin logout?')">Logout</a></li>
        </ul>
    </nav>
</div>
<div class="form-container">
    <h2>Reservation</h2>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="telephone">Telephone:</label>
        <input type="text" id="telephone" name="telephone" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>

        <label for="guests">Number of Guests:</label>
        <input type="number" id="guests" name="guests" min="1" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="3"></textarea>

        <button type="submit" name="send">Send Reservation</button>
    </form>
</div>

</body>
</html>
