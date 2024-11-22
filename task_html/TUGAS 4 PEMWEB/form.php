<!--
    Nama    : BILLY
    NIM     : 122140004
    Kelas   : Pemrograman Web - RA
    Tugas   : 4
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM PENDAFTARAN</title>
    <style>
        body, h1, h2, p {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        body {
            background: linear-gradient(to bottom, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: hidden;
        }

        nav {
            background-color: #1b3a4b;
            padding: 1rem;
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        nav a {
            color: #f9f9f9;
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

        form {
            background-color: #1e293b;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            margin-bottom:50px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #f0f0f0;
        }

        form input, form select, form button {
            width: 100%;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #364f6b;
            font-size: 1rem;
            color: #000;
            background-color: #fff;
            box-sizing: border-box;
        }

        form input:focus, form select:focus {
            border-color: #20c997;
            outline: none;
            box-shadow: 0 0 10px rgba(32, 201, 151, 0.5);
        }

        form button {
            background-color: #20c997;
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        form button:hover {
            background-color: #17a589;
            transform: scale(1.03);
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

        h1 {
            text-align: center;
            color: #fff;
        }

        ::placeholder {
            color: #a9a9a9;
            font-style: italic;
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
        <a href="form.php" class="active">FORM PENDAFTARAN</a>
        <span style="color: white; margin: 0 10px;">|</span>
        <a href="result.php">HASIL PENDAFTARAN</a>
    </nav>

    <div class="animated-line1"></div>
    <h1>FORM PENDAFTARAN LOMBA CERITA PENDEK</h1>
    <div class="animated-line2"></div>

    <form action="process.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" required minlength="3" placeholder="Masukkan nama lengkap Anda">

        <label for="email">Alamat Email</label>
        <input type="email" id="email" name="email" required placeholder="Masukkan alamat email Anda">

        <label for="title">Judul Cerita</label>
        <input type="text" id="title" name="title" required minlength="5" placeholder="Masukkan judul cerita Anda">

        <label for="category">Kategori</label>
        <select id="category" name="category" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="fiksi">Fiksi</option>
            <option value="non-fiksi">Non-Fiksi</option>
            <option value="horor">Horor</option>
            <option value="fantasi">Fantasi</option>
        </select>

        <label for="file">Upload Cerita Pendek (File .txt)</label>
        <input type="file" id="file" name="file" accept=".txt" required placeholder="Pilih file .txt untuk diunggah">

        <button type="submit">Daftar</button>
    </form>
    
    <script>
        function validateForm() {
            const name = document.getElementById("name").value;
            const title = document.getElementById("title").value;
            const category = document.getElementById("category").value;
            const file = document.getElementById("file").files[0];
            
            if (name.length < 3) {
                alert("Nama harus terdiri dari minimal 3 karakter.");
                return false;
            }

            if (title.length < 5) {
                alert("Judul cerita pendek harus minimal 5 karakter.");
                return false;
            }

            if (!category) {
                alert("Pilih kategori cerita pendek.");
                return false;
            }

            if (file) {
                const allowedSize = 2 * 1024 * 1024;
                if (file.size > allowedSize) {
                    alert("Ukuran file tidak boleh lebih dari 2MB.");
                    return false;
                }
                const allowedType = ["text/plain"];
                if (!allowedType.includes(file.type)) {
                    alert("File yang diunggah harus berupa file teks (.txt).");
                    return false;
                }
            }
            return true;
        }
    </script>
</body>
</html>
