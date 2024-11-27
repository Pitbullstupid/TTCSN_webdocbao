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

.styled-table th, .styled-table td {
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

</style>
<?php 
$sql_lietke_theloai = "SELECT * FROM tabl_theloai ORDER BY id_theloai ASC"; 
$query_lietke_theloai = mysqli_query($mysqli, $sql_lietke_theloai); 
?>

<p style="text-align: center; font-size: 18px; font-weight: bold; margin-top: 20px;">Liệt kê thể loại</p>

<table class="styled-table">
    <tr>
        <th>Id</th>
        <th>Tên thể loại</th>
        <th>Quản lý</th>
    </tr>

    <?php 
    while ($row = mysqli_fetch_array($query_lietke_theloai)) {
    ?>
    <tr>
        <td><?php echo $row['id_theloai']; ?></td>
        <td><?php echo $row['Tentheloai']; ?></td>
        <td>
            <a href="module/quanlytheloai/xuly.php?action=delete&idtheloai=<?php echo $row['id_theloai']; ?>" style="color: #FF0000; text-decoration: none;">Xoá</a>
            <a href="module/quanlytheloai/sua.php?idtheloai=<?php echo $row['id_theloai']; ?>" style="color: #0000FF; text-decoration: none;">Sửa</a>
        </td>
    </tr>
    <?php } ?>
</table>
