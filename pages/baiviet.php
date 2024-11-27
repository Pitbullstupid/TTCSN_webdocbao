<?php
include '../admincp/config/config.php'; // Kết nối cơ sở dữ liệu

// Bắt đầu session để kiểm tra đăng nhập
session_start();

// Kiểm tra và lấy ID bài viết từ URL
if (isset($_GET['id'])) {
    $id_baiviet = $_GET['id'];
} else {
    echo "Không tìm thấy bài viết.";
    exit;
}

// Truy vấn chi tiết bài viết
$sql_baiviet = "SELECT * FROM tabl_baiviet
                INNER JOIN tabl_theloai
                ON tabl_baiviet.id_theloai = tabl_theloai.id_theloai
                WHERE id_baiviet = '" . $id_baiviet . "'";
$query_baiviet = mysqli_query($mysqli, $sql_baiviet);

if ($query_baiviet && mysqli_num_rows($query_baiviet) > 0) {
    $row_baiviet = mysqli_fetch_array($query_baiviet);
} else {
    echo "Bài viết không tồn tại.";
    exit;
}

// Truy vấn bình luận
$sql_binhluan = "SELECT b.id_binhluan, b.noidung, b.ngaytao, u.email, u.avatar 
                 FROM tabl_binhluan b 
                 JOIN users u ON b.id_user = u.id
                 WHERE b.id_baiviet = '" . $id_baiviet . "' ORDER BY b.ngaytao DESC";
$query_binhluan = mysqli_query($mysqli, $sql_binhluan);

// Kiểm tra lỗi truy vấn
if (!$query_binhluan) {
    die("Lỗi truy vấn: " . mysqli_error($mysqli));
}

// Xử lý thêm bình luận
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_binhluan'])) {
    if (isset($_SESSION['user_id'])) {  // Kiểm tra $_SESSION['user_id'] thay vì $_SESSION['user']
        $id_user = $_SESSION['user_id']; // Lấy ID người dùng từ session
        $noidung = mysqli_real_escape_string($mysqli, $_POST['noidung']);

        // Thêm bình luận vào cơ sở dữ liệu
        $sql_insert_binhluan = "INSERT INTO tabl_binhluan (id_baiviet, id_user, noidung) 
                                VALUES ('$id_baiviet', '$id_user', '$noidung')";
        if (mysqli_query($mysqli, $sql_insert_binhluan)) {
            header("Location: baiviet.php?id=" . $id_baiviet); // Tải lại trang để hiển thị bình luận mới
            exit();
        } else {
            echo "<script>alert('Có lỗi xảy ra khi thêm bình luận.');</script>";
        }
    } else {
        echo "<script>alert('Bạn cần đăng nhập để bình luận.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row_baiviet['Tenbaiviet']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/baiviet.css?v=1">
</head>

<body>
    <?php include '../pages/headertop.php'; ?>

    <div class="social-share">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-square-twitter"></i></a>
        <a href="#"><i class="fa-regular fa-bookmark"></i></a>
    </div>
    <div class="container">
        <!-- Hiển thị thể loại -->
        <p>
            <a href="index.php?quanly=theloai&id=<?php echo $row_baiviet['id_theloai']; ?>">
                <?php echo $row_baiviet['Tentheloai']; ?>
            </a>
        </p>

        <!-- Hiển thị tiêu đề bài viết -->
        <h1><?php echo $row_baiviet['Tenbaiviet']; ?></h1>

        <!-- Hiển thị tóm tắt -->
        <div class="summary">
            <p><?php echo $row_baiviet['Tomtat']; ?></p>
        </div>

        <!-- Hiển thị hình ảnh -->
        <div class="image">
            <img src="../admincp/module/quanlybaiviet/upload/<?php echo $row_baiviet['Hinhanh']; ?>"
                alt="<?php echo $row_baiviet['Tenbaiviet']; ?>" style="max-width: 100%; height: auto;">
        </div>

        <!-- Hiển thị nội dung bài viết -->
        <div class="content">
            <p><?php echo nl2br($row_baiviet['Noidung']); ?></p>
        </div>

        <!-- Phần bình luận -->
        <div class="comments-section">
            <h2>Bình luận:</h2>
            <?php while ($row_binhluan = mysqli_fetch_array($query_binhluan)) { ?>
            <div class="comment">
                <div class="comment-user">
                    <img src="../pages/img/<?php echo $row_binhluan['avatar']; ?>" alt="Avatar" class="avatar">
                    <span><?php echo $row_binhluan['email']; ?></span>
                </div>
                <p><?php echo nl2br($row_binhluan['noidung']); ?></p>
                <small>Ngày: <?php echo $row_binhluan['ngaytao']; ?></small>
            </div>
            <?php } ?>

            <!-- Form thêm bình luận -->
            <?php if (isset($_SESSION['user_id'])) { ?>
            <form method="POST">
                <textarea name="noidung" required placeholder="Nhập bình luận của bạn..." rows="4"
                    style="resize: none;"></textarea>
                <button type="submit" name="submit_binhluan">Gửi bình luận</button>
            </form>
            <?php } else { ?>
            <p>Để bình luận, bạn cần <a href="Dangnhap.php">đăng nhập</a>.</p>
            <?php } ?>
        </div>
    </div>

    <script src="../js/Dangnhap.js"></script>
    <script src="../js/timeandweather.js"></script>
</body>

</html>