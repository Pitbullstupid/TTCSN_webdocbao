<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/adminstyle.css" />
    <title>Admin</title>
</head>

<body>
    <h2 style="text-align: center; margin: 20px;">Welcome to Admin</h2>
    <?php include '../admincp/config/config.php'; ?>
    <header>
        <?php include '../admincp/module/header.php'; ?>
    </header>
    <!-- menu -->
    <?php include '../admincp/module/menu.php'; ?>
    <section>
        <?php include '../admincp/module/main.php'; ?>
    </section>
    <footer>
        <?php include '../admincp/module/footer.php'; ?>
    </footer>
</body>

</html>