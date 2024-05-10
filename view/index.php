<?php
require_once 'database.php';
require_once '../model/contact_model.php';

Contact::setKoneksi($conn);
$contacts = Contact::select(); // Mengambil data kontak

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="admin.php"><img src="img/akun.png" alt="account Icon">Admin</a></li>
            <li><a href="index.php"><img src="img/home.png" alt="home Icon"> Dashboard</a></li>
            <li><a href="contact_crud_page/tambah_data.php"><img src="img/tambah.png" alt="Add Account Icon"> Add Data</a></li>
            <li><a href="logout.php"><img src="img/logout.png" alt="Logout Icon"> Logout</a></li>
        </ul>
    </div>
    <div class="main">
        <h2>List Contact</h2>
        <table>
            <thead>
                <tr>
                    <th>No ID</th>
                    <th>No HP</th>
                    <th>Owner</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact['No_ID']; ?></td>
                        <td><?= $contact['No_HP']; ?></td>
                        <td><?= $contact['Pemilik']; ?></td>
                        <td>
                        <a href="update.php?id=<?= htmlspecialchars($contact['No_ID']); ?>">Edit</a> 
                        <a href="delete.php?id=<?= htmlspecialchars($contact['No_ID']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</html>
