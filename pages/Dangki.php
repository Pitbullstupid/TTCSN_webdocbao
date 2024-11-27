<?php
include '../admincp/config/config.php'; 

if (isset($_POST['dangki'])) {
    // Lấy dữ liệu từ form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    
    // Hình ảnh
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanh = time().'_'.$hinhanh; // Đặt tên hình ảnh để tránh trùng lặp
    $target_dir = "../pages/img/"; // Đường dẫn tới thư mục img trong thư mục pages
    $target_file = $target_dir . $hinhanh;

    // Kiểm tra thông tin người dùng
    if ($email && $password && $birthdate) {
        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $sql_check = "SELECT * FROM users WHERE email = ?";
        $stmt_check = $mysqli->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            // Email đã tồn tại
            echo "<script>alert('Email đã được đăng ký. Vui lòng chọn email khác.');</script>";
        } else {
            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Thêm người dùng vào cơ sở dữ liệu
            $sql = "INSERT INTO users (email, password, birthdate, avatar) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssss", $email, $hashedPassword, $birthdate, $hinhanh);
            
            // Di chuyển ảnh vào thư mục 'img'
            if (move_uploaded_file($hinhanh_tmp, $target_file)) {
                // Kiểm tra việc thêm người dùng thành công
                if ($stmt->execute()) {
                    echo "<script>alert('Đăng ký thành công!');</script>";
                    header("Location: dangnhap.php");
                    exit();
                } else {
                    echo "<script>alert('Đăng ký thất bại.');</script>";
                }
            } else {
                echo "<script>alert('Không thể tải ảnh lên.');</script>";
            }

            $stmt->close();
        }

        $stmt_check->close();
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="../css/dangki.css">
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <h1>Đăng Ký Tài Khoản</h1>

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required />

        <label for="birthdate">Ngày Sinh</label>
        <input type="date" id="birthdate" name="birthdate" placeholder="dd/mm/yyyy" required />

        <label for="avatar">Ảnh đại diện</label>
        <input type="file" id="avatar" name="hinhanh" accept="image/*" required />

        <div class="buttons">
            <button type="submit" name="dangki" class="register-btn">Đăng Ký</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='../pages/index.php'">Hủy</button>
        </div>

        <div class="login-link">
            Bạn đã có tài khoản? <a href="../pages/Dangnhap.php">Đăng nhập</a>
        </div>
    </form>
</body>

</html>