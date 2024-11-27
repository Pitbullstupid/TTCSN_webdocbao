<?php
session_start(); // Bắt đầu session
include '../admincp/config/config.php'; // Kết nối cơ sở dữ liệu

// Xử lý khi người dùng gửi form đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra nếu người dùng đã nhập đầy đủ email và mật khẩu
    if ($email && $password) {
        // Truy vấn thông tin người dùng từ cơ sở dữ liệu
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Nếu tìm thấy người dùng, kiểm tra mật khẩu
            $user = $result->fetch_assoc();
            
            // Kiểm tra mật khẩu người dùng nhập vào với mật khẩu đã mã hóa trong cơ sở dữ liệu
            if (password_verify($password, $user['password'])) {
                // Lưu thông tin người dùng vào session
                $_SESSION['user'] = $user['email'];  // Lưu email người dùng vào session
                $_SESSION['user_id'] = $user['id'];  // Lưu ID người dùng vào session
                $_SESSION['avatar'] = $user['avatar']; // Lưu avatar người dùng vào session
                
                // Chuyển hướng về trang chủ sau khi đăng nhập thành công
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Mật khẩu không đúng!');</script>"; // Thông báo mật khẩu không đúng
            }
        } else {
            echo "<script>alert('Email không tồn tại!');</script>"; // Thông báo nếu email không tồn tại
        }
        $stmt->close();
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>"; // Thông báo nếu thiếu email hoặc mật khẩu
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="../css/dangnhap.css">
</head>

<body>
    <form method="POST">
        <h2>Đăng Nhập</h2>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Nhập email" required /><br />

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required /><br />

        <div class="buttons">
            <button type="submit">Đăng nhập</button>
        </div>

        <div class="register-link">
            Bạn chưa có tài khoản? <a href="dangki.php">Đăng ký ngay</a>
        </div>
    </form>
</body>

</html>