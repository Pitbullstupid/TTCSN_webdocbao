  <style type="text/css">
/* Tổng thể cho body */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Tiêu đề */
p {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    margin-top: 20px;
    color: #333;
}

/* Bảng */
.styled-table {
    border-collapse: collapse;
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    font-size: 16px;
    font-family: Arial, sans-serif;
}

.styled-table td,
.styled-table th {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

.styled-table td:first-child {
    font-weight: bold;
    text-align: right;
    width: 30%;
    color: #555;
}

.styled-table td:last-child {
    text-align: left;
}

.styled-table input[type="text"],
.styled-table textarea,
.styled-table select,
.styled-table input[type="file"] {
    width: 95%;
    padding: 8px 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.styled-table textarea {
    resize: none;
    height: 100px;
}

.styled-table select {
    cursor: pointer;
}

/* Nút Thêm bài viết */
.btn-submit {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #0056b3;
}

/* Căn chỉnh nút ở giữa */
.styled-table tr:last-child td {
    text-align: center;
    padding-top: 20px;
}
  </style>
  <p style="text-align: center; font-size: 18px; font-weight: bold; margin-top: 20px;">Thêm bài viết</p>
  <form method="POST" action="module/quanlybaiviet/xuly.php" enctype="multipart/form-data">
      <table class="styled-table">
          <tr>
              <td>Tên bài viết</td>
              <td><input type="text" name="tenbaiviet"></td>
          </tr>
          <tr>
              <td>Hình ảnh</td>
              <td><input type="file" name="hinhanh"></td>
          </tr>
          <tr>
              <td>Tóm tắt</td>
              <td><textarea rows="10" name="tomtat" style="resize: none;"></textarea></td>
          </tr>
          <tr>
              <td>Nội dung</td>
              <td><textarea rows="10" name="noidung" style="resize: none;"></textarea></td>
          </tr>
          <tr>
              <td>Thể loại</td>
              <td>
                  <select name="idtheloai">
                      <?php
                         $sql_theloai = "SELECT id_theloai, Tentheloai FROM tabl_theloai ORDER BY id_theloai ASC";
                         $query_theloai = mysqli_query($mysqli, $sql_theloai);
                         while ($row_theloai = mysqli_fetch_array($query_theloai)) {
                        ?>
                      <option value="<?php echo $row_theloai['id_theloai']; ?>">
                          <?php echo $row_theloai['Tentheloai']; ?>
                      </option>
                      <?php
                         }
                        ?>
                  </select>
              </td>
          </tr>

          <tr>
              <td>Tình trạng</td>
              <td><select name="tinhtrang">
                      <option value="1">Hiển thị</option>
                      <option value="0">Ẩn</option>
                  </select></td>
          </tr>
          <tr>
              <td colspan="2" style="text-align: center;">
                  <input type="submit" name="thembaiviet" value="Thêm bài viết" class="btn-submit">
              </td>
          </tr>
      </table>
  </form>