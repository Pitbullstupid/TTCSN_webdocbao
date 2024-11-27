<?php
// Kiểm tra và lấy ID thể loại từ URL
if (isset($_GET['id'])) {
    $id_theloai = $_GET['id'];
} else {
    $id_theloai = 0;
}

// Truy vấn bài viết đầu tiên
$sql_bai_dau = "SELECT * FROM tabl_theloai, tabl_baiviet 
                WHERE tabl_baiviet.id_theloai = tabl_theloai.id_theloai 
                AND tabl_baiviet.id_theloai = '" . $id_theloai . "' 
                ORDER BY tabl_baiviet.id_baiviet DESC 
                LIMIT 1";
$query_bai_dau = mysqli_query($mysqli, $sql_bai_dau);
// Hiển thị bài viết đầu tiên trong `box1`
  
// Hiển thị bài viết đầu tiên
if ($query_bai_dau && mysqli_num_rows($query_bai_dau) > 0) {
    $row_bai_dau = mysqli_fetch_array($query_bai_dau);
    echo '<div class="Theloai">' . $row_bai_dau['Tentheloai'] . '</div>';
    ?>
<!-- Hiển thị bài viết đầu tiên -->
<div class="box1">
    <div class="img">
        <a href="">
            <img src="../admincp/module/quanlybaiviet/upload/<?php echo $row_bai_dau['Hinhanh']; ?>" alt="Ảnh bài viết"
                style="width: 680px; height: 408px;">
        </a>
    </div>
    <div class="decribe">
        <div class="title">
            <a href="baiviet.php?id=<?php echo $row_bai_dau['id_baiviet']; ?>">
                <h2><?php echo $row_bai_dau['Tenbaiviet']; ?></h2>
            </a>
        </div>
        <div class="general">
            <p><?php echo $row_bai_dau['Tomtat']; ?></p>
        </div>
    </div>
</div>
<?php
} else {
    echo '<div class="Theloai">Không có bài viết đầu tiên</div>';
}

// Truy vấn các bài viết còn lại
$sql_bai_con = "SELECT * FROM tabl_theloai, tabl_baiviet 
                WHERE tabl_baiviet.id_theloai = tabl_theloai.id_theloai 
                AND tabl_baiviet.id_theloai = '" . $id_theloai . "' 
                AND tabl_baiviet.id_baiviet != '" . $row_bai_dau['id_baiviet'] . "' 
                ORDER BY tabl_baiviet.id_baiviet DESC 
                LIMIT 3"; // Giới hạn hiển thị 3 bài viết còn lại
$query_bai_con = mysqli_query($mysqli, $sql_bai_con);

// Hiển thị các bài viết còn lại
if ($query_bai_con && mysqli_num_rows($query_bai_con) > 0) {
    ?>
<div class="phancach"></div>
<div class="box2">
    <?php
        $count = 1;
        while ($row_bai_con = mysqli_fetch_array($query_bai_con)) {
            ?>
    <div class="boxcon<?php echo $count; ?>">
        <?php if ($count < 3) { ?>
        <div class="title">
            <a href="baiviet.php?id=<?php echo $row_bai_con['id_baiviet']; ?>">
                <?php echo $row_bai_con['Tenbaiviet']; ?>
            </a>
        </div>
        <div class="img">
            <a href="">
                <img src="../admincp/module/quanlybaiviet/upload/<?php echo $row_bai_con['Hinhanh']; ?>"
                    alt="Ảnh bài viết">
            </a>
        </div>
        <?php } else { ?>
        <div class="category">
            <a href="index.php?quanly=theloai&id=<?php echo $row_bai_con['id_theloai']; ?>">
                <?php echo $row_bai_con['Tentheloai']; ?>
            </a>
        </div>
        <div class="title">
            <a href="baiviet.php?id=<?php echo $row_bai_con['id_baiviet']; ?>">
                <?php echo $row_bai_con['Tenbaiviet']; ?>
            </a>
        </div>
        <div class="general">
            <p><?php echo $row_bai_con['Tomtat']; ?></p>
        </div>
        <?php } ?>
    </div>
    <?php
            $count++;
        }
        ?>
</div>
<?php
} else {
    echo '<div class="Theloai">Không có bài viết khác</div>';
}
?>

<?php
// Truy vấn bài viết chính (Tin chính)
$sql_main_news = "SELECT * FROM tabl_theloai, tabl_baiviet 
                  WHERE tabl_baiviet.id_theloai = tabl_theloai.id_theloai 
                  AND tabl_baiviet.id_theloai = '" . $id_theloai . "' 
                  ORDER BY tabl_baiviet.id_baiviet DESC 
                  LIMIT 1";
$query_main_news = mysqli_query($mysqli, $sql_main_news);
$row_main_news = mysqli_fetch_array($query_main_news);

// Truy vấn bài viết phụ (Tin phụ)
$sql_sub_news = "SELECT * FROM tabl_theloai, tabl_baiviet 
                 WHERE tabl_baiviet.id_theloai = tabl_theloai.id_theloai 
                 AND tabl_baiviet.id_theloai = '" . $id_theloai . "' 
                 AND tabl_baiviet.id_baiviet != '" . $row_main_news['id_baiviet'] . "' 
                 ORDER BY tabl_baiviet.id_baiviet DESC 
                 LIMIT 4";
$query_sub_news = mysqli_query($mysqli, $sql_sub_news);
?>

<!-- Hiển thị box3 -->
<div class="box3">
    <h1><?php echo $row_main_news['Tentheloai']; ?></h1>
    <nav class="subcategories">
        <a href="index.php?quanly=theloai&id=<?php echo $id_theloai; ?>">
            <?php echo $row_main_news['Tentheloai']; ?>
        </a>
    </nav>
    <div class="news-container">
        <!-- Tin chính -->
        <div class="main-news">
            <a href="baiviet.php?id=<?php echo $row_main_news['id_baiviet']; ?>">
                <img src="../admincp/module/quanlybaiviet/upload/<?php echo $row_main_news['Hinhanh']; ?>"
                    alt="Ảnh tin chính" />
            </a>
            <a href="baiviet.php?id=<?php echo $row_main_news['id_baiviet']; ?>">
                <h2><?php echo $row_main_news['Tenbaiviet']; ?></h2>
            </a>
            <a href="baiviet.php?id=<?php echo $row_main_news['id_baiviet']; ?>">
                <p><?php echo $row_main_news['Tomtat']; ?></p>
            </a>
        </div>
        <!-- Tin phụ -->
        <div class="sub-news">
            <?php
            while ($row_sub_news = mysqli_fetch_array($query_sub_news)) {
                ?>
            <div class="sub-item">
                <a href="baiviet.php?id=<?php echo $row_sub_news['id_baiviet']; ?>">
                    <img src="../admincp/module/quanlybaiviet/upload/<?php echo $row_sub_news['Hinhanh']; ?>"
                        alt="Ảnh tin phụ" />
                </a>
                <a href="baiviet.php?id=<?php echo $row_sub_news['id_baiviet']; ?>">
                    <h3><?php echo $row_sub_news['Tenbaiviet']; ?></h3>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>