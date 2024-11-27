<?php
include '../../config/config.php'; // Kết nối cơ sở dữ liệu

if (isset($_GET['idtheloai']) && is_numeric($_GET['idtheloai'])) {
    $idtheloai = $_GET['idtheloai'];

    // Lấy dữ liệu thể loại
    $sql = "SELECT * FROM tabl_theloai WHERE id_theloai = '$idtheloai'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);

    // Kiểm tra nếu không tìm thấy thể loại
    if (!$row) {
        echo "Không tìm thấy thể loại với ID này.";
        exit();
    }
} else {
    echo "ID thể loại không hợp lệ.";
    exit();
}

// Cập nhật thể loại
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenmoi = $_POST['ten_theloai'];

    if (!empty($tenmoi)) {
        $sql_update = "UPDATE tabl_theloai SET Tentheloai = '$tenmoi' WHERE id_theloai = '$idtheloai'";
        if (mysqli_query($mysqli, $sql_update)) {
            header("Location: ../../index.php?action=quanlytheloai");
            exit();
        } else {
            echo "Lỗi khi cập nhật: " . mysqli_error($mysqli);
        }
    } else {
        echo "Tên thể loại không được để trống.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thể Loại</title>
    <style>
        /* Tổng thể cho body */
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
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
            font-size: 16px;
            white-space: nowrap;
        }

        input[type="text"] {
            flex: 1; /* Chiếm toàn bộ không gian còn lại */
            max-width: 500px; /* Tăng chiều dài tối đa */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            display: block;
            width: 100px;
            margin: 0 auto;
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
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
        <h2>Sửa Thể Loại</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="ten_theloai">Tên thể loại mới:</label>
                <input type="text" name="ten_theloai" id="ten_theloai" 
                    value="<?php echo isset($row['Tentheloai']) ? htmlspecialchars($row['Tentheloai']) : ''; ?>" 
                    required>
            </div>
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</body>
</html>

