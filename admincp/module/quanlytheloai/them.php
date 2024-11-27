   <style>
    .styled-table {
      border-collapse: collapse;
      width: 50%;
      margin: 20px auto;
      font-size: 16px;
      font-family: Arial, sans-serif;
      color: #333;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
    }

    .styled-table td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: left;
    }

    .styled-table tr:first-child td {
      font-weight: bold;
      background-color: #f4f4f4;
    }

    .input-text {
      width: calc(100% - 20px);
      padding: 8px 10px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: border-color 0.3s;
    }

    .input-text:focus {
      border-color: #007BFF;
      outline: none;
    }

    .btn-submit {
      padding: 10px 20px;
      font-size: 14px;
      font-weight: bold;
      color: #fff;
      background-color: #007BFF;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-submit:hover {
      background-color: #0056b3;
    }
  </style>
  <p style="text-align: center; font-size: 18px; font-weight: bold; margin-top: 20px;">Thêm Thể Loại</p>
  <form method="POST" action="module/quanlytheloai/xuly.php">
    <table class="styled-table">
      <tr>
        <td>Tên thể loại</td>
        <td><input type="text" name="tentheloai" class="input-text"></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;">
          <input type="submit" name="themtheloai" value="Thêm" class="btn-submit">
        </td>
      </tr>
    </table>
  </form>