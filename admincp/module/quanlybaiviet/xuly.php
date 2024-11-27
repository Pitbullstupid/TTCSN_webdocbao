<?php
include '../../config/config.php';

//xoa
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['idbaiviet']) && is_numeric($_GET['idbaiviet'])) {
    $idbaiviet = $_GET['idbaiviet'];
    $sql_xoa = "DELETE FROM tabl_baiviet WHERE id_baiviet = '$idbaiviet'";

    if (mysqli_query($mysqli, $sql_xoa)) {
        header("Location:../../index.php?action=quanlybaiviet");
        exit();
    } else {
        echo "Lỗi khi xóa bài viết: " . mysqli_error($mysqli);
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}

//them
        $tenbaiviet = $_POST['tenbaiviet'];
        //hinhanh
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh = time().'_'.$hinhanh;
        //
        $tomtat = $_POST['tomtat'];
        $noidung = $_POST['noidung'];
        $idtheloai = $_POST['idtheloai'];
        $tinhtrang = $_POST['tinhtrang'];


if (isset($_POST['thembaiviet'])) {
        $sql_them = "INSERT INTO tabl_baiviet(Tenbaiviet, Hinhanh, Tomtat,  Noidung, Tinhtrang, id_theloai) VALUE('".$tenbaiviet."', '".$hinhanh."', '".$tomtat."','".$noidung."', '".$tinhtrang."','".$idtheloai."')";
        mysqli_query($mysqli, $sql_them);
        move_uploaded_file($hinhanh_tmp, 'upload/'.$hinhanh);
        header('Location:../../index.php?action=quanlybaiviet');
    }elseif (isset($_GET['idbaiviet'])) {
        $id = $_GET['idbaiviet'];
      if (isset($id) && is_numeric($id)) {
        $sql_xoa = "DELETE FROM tabl_baiviet WHERE id_baiviet = '".$id."'";
        if (mysqli_query($mysqli, $sql_xoa)) {
            header('Location: ../../index.php?action=quanlybaiviet');
        } else {
            echo "Có lỗi khi xóa thể loại: " . mysqli_error($mysqli);
        }
    } else {
        echo "ID thể loại không hợp lệ!";
    }
}
?>