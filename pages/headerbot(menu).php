<?php
  $sql_theloai = "SELECT id_theloai, Tentheloai FROM tabl_theloai ORDER BY id_theloai ASC";
  $query_theloai = mysqli_query($mysqli, $sql_theloai);
?>
<div class="menu">
    <ul>
        <?php
        while ($row_theloai = mysqli_fetch_array($query_theloai)) {
          ?>
        <li class="option1"><a
                href="index.php?quanly=theloai&id=<?php echo $row_theloai['id_theloai']; ?>"><?php echo $row_theloai['Tentheloai']; ?></a>
        </li>
        <?php
            }
        ?>
    </ul>
</div>