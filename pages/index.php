<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css?v=3" />
    <title>Trang chủ</title>
</head>

<body>
    <?php include '../admincp/config/config.php'; ?>
    <!-- header -->
    <header>
        <!-- Header top -->

        <?php
         session_start();
         include 'headertop.php'; 
        ?>
        <!-- Header bottom -->
        <?php include 'headerbot(menu).php'; ?>
    </header>
    <!-- section -->
    <section>
        <!-- Nội dung chính của trang -->
        <?php include 'maincontent.php'; ?>
    </section>
    <!-- footer -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
    <!-- script -->
    <script src="../js/Dangnhap.js?v=1"></script>
    <script src="../js/timeandweather.js"></script>
</body>

</html>