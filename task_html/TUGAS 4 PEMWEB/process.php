<!--
    Nama    : BILLY
    NIM     : 122140004
    Kelas   : Pemrograman Web - RA
    Tugas   : 4
-->

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    
    if (empty($_POST['name']) || strlen($_POST['name']) < 3) {
        $errors[] = "Nama harus diisi dan minimal 3 karakter.";
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }
    if (empty($_POST['title']) || strlen($_POST['title']) < 5) {
        $errors[] = "Judul cerita pendek harus diisi dan minimal 5 karakter.";
    }
    if (empty($_POST['category'])) {
        $errors[] = "Kategori cerita pendek harus dipilih.";
    }
    
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file = $_FILES['file'];
        if ($file['size'] > 2 * 1024 * 1024) {
            $errors[] = "Ukuran file tidak boleh lebih dari 2MB.";
        }
        if (pathinfo($file['name'], PATHINFO_EXTENSION) !== 'txt') {
            $errors[] = "File harus berupa teks (.txt).";
        }
    } else {
        $errors[] = "File wajib diunggah.";
    }

    if (!empty($errors)) {
        echo "<div style='background-color:#ffdddd; padding:10px; border-left:5px solid #f44336; margin-bottom:20px;'>";
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "</div>";
        exit;
    }

    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $uploadedFilePath = $uploadDir . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFilePath);

    $fileContent = file_get_contents($uploadedFilePath);

    session_start();
    $_SESSION['data'] = $_POST;
    $_SESSION['file'] = $uploadedFilePath;

    $logFile = 'registrations.log';
    $browserInfo = $_SERVER['HTTP_USER_AGENT'];
    $logEntry = json_encode([
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'title' => $_POST['title'],
        'category' => $_POST['category'],
        'file_name' => $_FILES['file']['name'],
        'file_content' => $fileContent,
        'browser' => $browserInfo
    ]);
    file_put_contents($logFile, $logEntry . PHP_EOL, FILE_APPEND);

    header("Location: result.php");
    exit;
}
?>
