<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        $content = 'pages/home.php';
        break;
    case 'data':
        $content = 'pages/data.php';
        break;
    default:
        $content = 'pages/home.php';
        break;
}

date_default_timezone_set('Asia/Jakarta');
$currentDate = date('l, d F Y');
$currentTime = date('H:i:s');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayCodeACM IoT Part-01</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- DataTables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>

    <!-- Custom -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <header>
        <h3>PlayCodeACM IoT Part-01</h3>
        <nav>
            <ul>
                <li><a href="index.php?page=home" class="<?php echo $page == 'home' ? 'active' : ''; ?>">Home</a></li>
                <li><a href="index.php?page=data" class="<?php echo $page == 'data' ? 'active' : ''; ?>">Data</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="title">
            <h2>Monitoring Your Room With IoT</h2>
            
        </div>
        <div class="content">
            <?php include $content; ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 playcodeacm. All rights reserved.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        function updateTime() {
            const currentTimeElement = document.getElementById('currentTime');
            const now = new Date();

            // Mengambil waktu saat ini
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            // Menyusun string waktu
            const timeString = `${hours}:${minutes}:${seconds}`;

            // Memperbarui elemen waktu di halaman
            currentTimeElement.textContent = timeString;
        }

        // Memperbarui waktu setiap detik
        setInterval(updateTime, 1000);
    </script>


</body>

</html>