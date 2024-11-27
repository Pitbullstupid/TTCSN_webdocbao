<style type="text/css">
/* CSS cho bảng liệt kê thể loại */
.styled-table {
    border-collapse: collapse;
    width: 80%;
    margin: 20px auto;
    font-size: 16px;
    font-family: Arial, sans-serif;
    color: #333;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}

.styled-table th {
    font-weight: bold;
    background-color: #f4f4f4;
}

.styled-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.styled-table tr:hover {
    background-color: #f1f1f1;
}

.styled-table a {
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.styled-table a:hover {
    background-color: #f0f0f0;
}

.styled-table a.xoa {
    color: #FF0000;
}

.styled-table a.sua {
    color: #007BFF;
}

img {
    width: 150px;
}
</style>
<?php 
$sql_lietke_baiviet = "
SELECT 
    bv.id_baiviet, 
    bv.Tenbaiviet, 
    bv.Hinhanh, 
    bv.Tomtat, 
    bv.Noidung, 
    bv.Tinhtrang, 
    tl.Tentheloai 
FROM 
    tabl_baiviet AS bv 
JOIN 
    tabl_theloai AS tl 
ON 
    bv.id_theloai = tl.id_theloai 
ORDER BY 
    bv.id_baiviet ASC"; 
$query_lietke_baiviet = mysqli_query($mysqli, $sql_lietke_baiviet); 
?>

<p style="text-align: center; font-size: 18px; font-weight: bold; margin-top: 20px;">Liệt kê bài viết</p>

<table class="styled-table">
    <tr>
        <th>Id bài viết</th>
        <th>Tên bài </th>
        <th>Hình ảnh</th>
        <th>Tóm tắt</th>
        <th>Nội dung</th>
        <th>Tình trạng</th>
        <th>Thể loại</th>
    </tr>

    <?php 
    while ($row = mysqli_fetch_array($query_lietke_baiviet)) {
    ?>
    <tr>
        <td><?php echo $row['id_baiviet']; ?></td>
        <td><?php echo $row['Tenbaiviet']; ?></td>
        <td><img src="../admincp/module/quanlybaiviet/upload/<?php echo $row['Hinhanh']; ?> "></td>
        <td><?php echo $row['Tomtat']; ?></td>
        <td><?php echo $row['Noidung']; ?></td>
        <td>
            <?php
          if($row['Tinhtrang'] ==1){
            echo "Hiển thị";
          }else{
            echo "Ẩn";
          }
          ?>
        </td>
        <td><?php echo $row['Tentheloai']; ?></td>
        <td>
            <a href="module/quanlybaiviet/xuly.php?action=delete&idbaiviet=<?php echo $row['id_baiviet']; ?>"
                style="color: #FF0000; text-decoration: none;">Xoá</a>
            <a href="module/quanlybaiviet/suabai.php?idbaiviet=<?php echo $row['id_baiviet']; ?>"
                style="color: #0000FF; text-decoration: none;">Sửa</a>
        </td>
    </tr>
    <?php } ?>
</table>