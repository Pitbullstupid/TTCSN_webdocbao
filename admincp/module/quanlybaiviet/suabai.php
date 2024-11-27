<?php
include '../../config/config.php';

//uploadHinhAnh
function uploadHinhAnh($file, $targetDir = 'upload/') {
    $fileName = time() . '_' . $file['name'];
    $targetFile = $targetDir . $fileName;
    // Kiểm tra thư mục và tạo nếu chưa tồn tại
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
    // Kiểm tra lỗi và di chuyển file
    if ($file['error'] === UPLOAD_ERR_OK && move_uploaded_file($file['tmp_name'], $targetFile)) {
        return $fileName; 
    }
    return false; // Thất bại
}

// Kiểm tra ID bài viết
if (isset($_GET['idbaiviet']) && is_numeric($_GET['idbaiviet'])) {
    $idbaiviet = $_GET['idbaiviet'];
    $sql = "SELECT * FROM tabl_baiviet WHERE id_baiviet = '$idbaiviet'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Không tìm thấy bài viết với ID này.";
        exit();
    }
} else {
    echo "ID bài viết không hợp lệ.";
    exit();
}

// Cập nhật thông tin bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenbaiviet = $_POST['ten_baiviet'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $tinhtrang = $_POST['tinhtrang'];
    $idtheloai = $_POST['id_theloai'];

    // Xử lý hình ảnh
    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === UPLOAD_ERR_OK) {
        $hinhanh = uploadHinhAnh($_FILES['hinhanh']);
    } else {
        $hinhanh = $row['Hinhanh'];
    }

    // Kiểm tra và cập nhật dữ liệu
    if (!empty($tenbaiviet) && !empty($tomtat) && !empty($noidung) && !empty($idtheloai)) {
        $sql_update = "
        UPDATE tabl_baiviet 
        SET 
            Tenbaiviet = '$tenbaiviet', 
            Hinhanh = '$hinhanh', 
            Tomtat = '$tomtat', 
            Noidung = '$noidung', 
            Tinhtrang = '$tinhtrang', 
            id_theloai = '$idtheloai' 
        WHERE 
            id_baiviet = '$idbaiviet'";
        
        if (mysqli_query($mysqli, $sql_update)) {
            header("Location: ../../index.php?action=quanlybaiviet");
            exit();
        } else {
            echo "Lỗi khi cập nhật: " . mysqli_error($mysqli);
        }
    } else {
        echo "Vui lòng điền đầy đủ thông tin.";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Bài Viết</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea,
    select,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Sửa Bài Viết</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="ten_baiviet">Tên bài viết:</label>
                <input type="text" name="ten_baiviet" id="ten_baiviet"
                    value="<?php echo htmlspecialchars($row['Tenbaiviet']); ?>" required>
            </div>
            <div class="form-group">
                <label for="hinhanh">Hình ảnh:</label>
                <input type="file" name="hinhanh" id="hinhanh">
                <p>Hình ảnh hiện tại: <?php echo $row['Hinhanh']; ?></p>
            </div>
            <div class="form-group">
                <label for="tomtat">Tóm tắt:</label>
                <textarea name="tomtat" id="tomtat" rows="5"
                    required><?php echo htmlspecialchars($row['Tomtat']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="noidung">Nội dung:</label>
                <textarea name="noidung" id="noidung" rows="10"
                    required><?php echo htmlspecialchars($row['Noidung']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="id_theloai">Thể loại:</label>
                <select name="id_theloai" id="id_theloai" required>
                    <?php
        // Truy vấn danh sách thể loại
        $sql_theloai = "SELECT id_theloai, Tentheloai FROM tabl_theloai ORDER BY id_theloai ASC";
        $query_theloai = mysqli_query($mysqli, $sql_theloai);

        // Hiển thị danh sách thể loại
        while ($row_theloai = mysqli_fetch_array($query_theloai)) {
            $selected = $row['id_theloai'] == $row_theloai['id_theloai'] ? 'selected' : '';
            echo "<option value='{$row_theloai['id_theloai']}' $selected>{$row_theloai['Tentheloai']}</option>";
        }
        ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tinhtrang">Tình trạng:</label>
                <select name="tinhtrang" id="tinhtrang">
                    <option value="1" <?php echo $row['Tinhtrang'] == 1 ? 'selected' : ''; ?>>Hiển thị</option>
                    <option value="0" <?php echo $row['Tinhtrang'] == 0 ? 'selected' : ''; ?>>Ẩn</option>
                </select>
            </div>
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</body>

</html>