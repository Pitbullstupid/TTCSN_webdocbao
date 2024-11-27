<?php
include '../../config/config.php';

// Hàm xóa thể loại

// Kiểm tra xem hành động có hợp lệ và ID có được truyền hay không
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['idtheloai']) && is_numeric($_GET['idtheloai'])) {
    $idtheloai = $_GET['idtheloai'];

    // Câu lệnh SQL để xóa thể loại
    $sql_xoa = "DELETE FROM tabl_theloai WHERE id_theloai = '$idtheloai'";

    if (mysqli_query($mysqli, $sql_xoa)) {
        // Nếu xóa thành công, chuyển hướng về trang quản lý thể loại với thông báo thành công
        header("Location:../../index.php?action=quanlytheloai");
        exit();
    } else {
        // Nếu xảy ra lỗi, hiển thị chi tiết lỗi
        echo "Lỗi khi xóa thể loại: " . mysqli_error($mysqli);
    }
} else {
    // Nếu ID hoặc action không hợp lệ, hiển thị thông báo lỗi
    echo "Yêu cầu không hợp lệ.";
}



if (isset($_POST['themtheloai'])) {
    if (isset($_POST['tentheloai']) && !empty($_POST['tentheloai'])) {
        $tentheloai = $_POST['tentheloai'];
        $sql_them = "INSERT INTO tabl_theloai(Tentheloai) VALUE('".$tentheloai."')";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?action=quanlytheloai');
    } elseif (isset($_GET['idtheloai'])) {
        $id = $_GET['idtheloai'];
      if (isset($id) && is_numeric($id)) {
        $sql_xoa = "DELETE FROM tabl_theloai WHERE id_theloai = '".$id."'";
        if (mysqli_query($mysqli, $sql_xoa)) {
            header('Location: ../../index.php?action=quanlytheloai');
        } else {
            echo "Có lỗi khi xóa thể loại: " . mysqli_error($mysqli);
        }
    } else {
        echo "ID thể loại không hợp lệ!";
    }
}
}
?>

