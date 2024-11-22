<!--
    Nama    : BILLY
    NIM     : 122140004
    Kelas   : Pemrograman Web - RA
    Tugas   : 4
-->

<?php
session_start();
$data = $_SESSION['data'] ?? null;
$file = $_SESSION['file'] ?? null;

if (!$data || !$file) {
    echo "<p style='color:red; text-align:center;'>Data tidak tersedia. Silakan lengkapi form terlebih dahulu.</p>";
    exit;
}

$fileContent = file_exists($file) ? file_get_contents($file) : "File tidak ditemukan.";
$browserInfo = $_SERVER['HTTP_USER_AGENT'];

$logFile = 'registrations.log';
$registrationLogs = file_exists($logFile) ? file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HASIL PENDAFTARAN</title>
    <style>
        body, h1, h2, p {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
        }

        body {
            overflow-x: hidden;
            background: linear-gradient(to bottom, #16222a, #3a6073);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav {
            background-color: #1f3b4d;
            padding: 1rem;
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            margin: 0 15px;
            font-size: 1.1rem;
        }

        nav a:hover {
            color: #FFC107;
        }

        nav span {
            color: #ffffff;
            font-size: 1.1rem;
        }

        h1, h2 {
            text-align: center;
            color: #fff;
        }

        h2 {
            font-size: 1.5rem;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            background-color: #1e2a38;
            color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            table-layout: fixed;
        }

        table th, table td {
            border: 1px solid #4a5e6a;
            padding: 10px;
            text-align: center;
            font-size: 1rem;
            word-wrap: break-word;
            vertical-align: middle;
        }

        table th {
            background-color: #273747;
            color: #a7d8de;
            font-weight: bold;
            text-align: center;
        }

        table tr:nth-child(even) {
            background-color: #24313d;
        }

        table tr:hover {
            background-color: #1b252f;
        }

        p {
            text-align: center;
            font-size: 1rem;
            color: #ffffff;
            margin-bottom: 100px;
        }

        table:last-of-type {
            margin-bottom: 75px;
        }

        .animated-line1 {
            width: 0;
            height: 4px;
            background: linear-gradient(to right, #a8ff78, #78ffd6);
            margin-top: 50px;
            margin-bottom: 25px;
            animation: lineAnimation 2s ease-in-out forwards;
            border-radius: 50px;
        }

        @keyframes lineAnimation {
            0% {
                width: 0;
            }
            100% {
                width: 70%;
            }
        }

        .animated-line2 {
            width: 0;
            height: 4px;
            background: linear-gradient(to right, #a8ff78, #78ffd6);
            margin-top: 25px;
            margin-bottom: 50px;
            animation: lineAnimation 2s ease-in-out forwards;
            border-radius: 50px;
        }

        @keyframes lineAnimation {
            0% {
                width: 0;
            }
            100% {
                width: 70%;
            }
        }

        nav a.active {
            color: #FFC107;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav>
        <a href="form.php">FORM PENDAFTARAN</a>
        <span style="color: white; margin: 0 10px;">|</span>
        <a href="result.php" class="active">HASIL PENDAFTARAN</a>
    </nav>

    <div class="animated-line1"></div>
    <h1>HASIL PENDAFTARAN</h1>
    <div class="animated-line2"></div>

    <table>
        <tr><th>Field</th><th>Value</th></tr>
        <tr>
            <td>Nama Lengkap</td>
            <td><?= htmlspecialchars($data['name']) ?></td>
        </tr>
        <tr>
            <td>Alamat Email</td>
            <td><?= htmlspecialchars($data['email']) ?></td>
        </tr>
        <tr>
            <td>Judul Cerita</td>
            <td><?= htmlspecialchars($data['title']) ?></td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td><?= htmlspecialchars($data['category']) ?></td>
        </tr>
    </table>
    
    <div class="animated-line1"></div>
    <h2 class="section-spacing">DETAIL FILE CERITA PENDEK</h2>
    <div class="animated-line2"></div>

    <table>
        <tr>
            <th>Nama File</th>
            <th>Isi File</th>
        </tr>
        <tr>
            <td><?= htmlspecialchars(basename($file)) ?></td>
            <td><?= nl2br(htmlspecialchars($fileContent)) ?></td>
        </tr>
    </table>
    
    <div class="animated-line1"></div>
    <h2 class="section-spacing">DETAIL INFORMASI BROWSER</h2>
    <div class="animated-line2"></div>

    <p><?= htmlspecialchars($browserInfo) ?></p>

    <div class="animated-line1"></div>
    <h2 class="section-spacing">REKAPITULASI HASIL PENDAFTARAN</h2>
    <div class="animated-line2"></div>

    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Judul Cerita Pendek</th>
            <th>Kategori Cerita Pendek</th>
            <th>Nama File</th>
            <th>Isi File</th>
            <th>Browser</th>
        </tr>
        <?php foreach ($registrationLogs as $log): ?>
            <?php $entry = json_decode($log, true); ?>
            <tr>
                <td><?= htmlspecialchars($entry['name'] ?? "Tidak Diketahui") ?></td>
                <td><?= htmlspecialchars($entry['email'] ?? "Tidak Diketahui") ?></td>
                <td><?= htmlspecialchars($entry['title'] ?? "Tidak Diketahui") ?></td>
                <td><?= htmlspecialchars($entry['category'] ?? "Tidak Diketahui") ?></td>
                <td><?= htmlspecialchars($entry['file_name'] ?? "Tidak Diketahui") ?></td>
                <td><?= nl2br(htmlspecialchars($entry['file_content'] ?? "Tidak Ada Isi")) ?></td>
                <td><?= htmlspecialchars($entry['browser'] ?? "Tidak Diketahui") ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
