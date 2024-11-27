<?php
include '../admincp/config/config.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user'])) {
    $email = $_SESSION['user']; // Lấy email người dùng từ session

    // Truy vấn thông tin người dùng từ bảng users
    $sql_user = "
    SELECT 
        u.id, 
        u.email, 
        u.avatar, 
        u.birthdate
    FROM 
        users AS u 
    WHERE 
        u.email = ?";

    $stmt = $mysqli->prepare($sql_user); // Chuẩn bị câu truy vấn
    $stmt->bind_param("s", $email); // Gắn email vào câu truy vấn
    $stmt->execute(); // Thực thi câu truy vấn
    $result = $stmt->get_result(); // Lấy kết quả

    if ($result->num_rows > 0) {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $user = $result->fetch_assoc();
        $userName = $user['email']; // Hoặc sử dụng email nếu không có tên đầy đủ
        $avatar = $user['avatar']; // Lấy avatar của người dùng
    } else {
        $userName = 'User not found';
        $avatar = 'default_avatar.png'; // Nếu không tìm thấy người dùng, sử dụng ảnh mặc định
    }
    $stmt->close();
} else {
    // Nếu người dùng chưa đăng nhập, gán giá trị mặc định
    $userName = 'Guest';
    $avatar = 'default_avatar.png'; // Ảnh mặc định cho người dùng chưa đăng nhập
}
?>

<div class="header-top">
    <div class="logo-time">
        <img src="../img/Logo.png" alt="Logo" class="logo" />
        <span id="date"><?php echo date("d/m/Y"); ?></span>
        <span class="weather" id="weather-info">Loading weather...</span>
    </div>
    <div class="header-right">
        <div class="menutop">
            <a href="index.php">Mới nhất</a>
            <input type="text" placeholder="Tìm kiếm..." class="search" />
        </div>

        <?php if (isset($_SESSION['user'])): ?>
        <div class="avatar" onclick="toggleDropdown()">
            <!-- Hiển thị avatar nếu người dùng đã đăng nhập -->
            <img src="../pages/img/<?php echo $avatar; ?>" alt="Avatar" />
            <ul class="dropdown-menu" id="dropdown">
                <li><a href="#">Thông tin cá nhân</a></li>
                <li><a href="#">Tin đã lưu</a></li>
                <li><a href="#">Lịch sử</a></li>
                <li><a href="#" onclick="logout()">Thoát</a></li>
            </ul>
        </div>
        <?php else: ?>
        <a href="Dangki.php" class="login-btn">Đăng nhập</a>
        <?php endif; ?>
    </div>
</div>