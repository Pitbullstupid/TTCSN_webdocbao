<?php
// Kết nối cơ sở dữ liệu
include '../admincp/config/config.php';

// Truy vấn thể loại có bài viết mới nhất
$sql_latest_category = "SELECT DISTINCT tabl_theloai.id_theloai, tabl_theloai.Tentheloai
FROM tabl_theloai
INNER JOIN tabl_baiviet
ON tabl_theloai.id_theloai = tabl_baiviet.id_theloai
ORDER BY tabl_baiviet.id_baiviet DESC
LIMIT 1";
$query_latest_category = mysqli_query($mysqli, $sql_latest_category);
$latest_category = mysqli_fetch_array($query_latest_category);

// Nếu có thể loại mới nhất
if ($latest_category) {
$id_theloai = $latest_category['id_theloai'];
$tentheloai = $latest_category['Tentheloai'];

// Truy vấn bài viết đầu tiên
$sql_first_article = "SELECT * FROM tabl_baiviet
WHERE id_theloai = '$id_theloai'
ORDER BY id_baiviet DESC
LIMIT 1";
$query_first_article = mysqli_query($mysqli, $sql_first_article);
$first_article = mysqli_fetch_array($query_first_article);

// Truy vấn các bài viết còn lại
$sql_other_articles = "SELECT * FROM tabl_baiviet
WHERE id_theloai = '$id_theloai'
AND id_baiviet != '{$first_article['id_baiviet']}'
ORDER BY id_baiviet DESC
LIMIT 3";
$query_other_articles = mysqli_query($mysqli, $sql_other_articles);

// Truy vấn các bài viết thuộc thể loại "Khoa học - Công nghệ"
$sql_scitech_articles = "SELECT * FROM tabl_baiviet
WHERE id_theloai = '$id_theloai'
ORDER BY id_baiviet DESC
LIMIT 5";
$query_scitech_articles = mysqli_query($mysqli, $sql_scitech_articles);
}
?>

<div class="Theloai">Các bài báo mới nhất</div>

<!-- Box 1: Hiển thị bài viết đầu tiên -->
<div class="box1">
    <?php if ($first_article): ?>
    <div class="img">
        <a href="baiviet.php?id=<?php echo $first_article['id_baiviet']; ?>">
            <img src="../admincp/module/quanlybaiviet/upload/<?php echo $first_article['Hinhanh']; ?>" alt="Bài viết">
        </a>
    </div>
    <div class="decribe">
        <div class="title">
            <a href="baiviet.php?id=<?php echo $first_article['id_baiviet']; ?>">
                <h2><?php echo $first_article['Tenbaiviet']; ?></h2>
            </a>
        </div>
        <div class="general">
            <p><?php echo $first_article['Tomtat']; ?></p>
        </div>
        <div class="timeandcategory">
            <div class="category"><a
                    href="index.php?quanly=theloai&id=<?php echo $id_theloai; ?>"><?php echo $tentheloai; ?></a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Phân cách box1 với box2 -->
<div class="phancach"></div>

<!-- Box 2: Hiển thị các bài viết còn lại -->
<div class="box2">
    <?php while ($other_article = mysqli_fetch_array($query_other_articles)): ?>
    <div class="boxcon">
        <div class="title">
            <a
                href="baiviet.php?id=<?php echo $other_article['id_baiviet']; ?>"><?php echo $other_article['Tenbaiviet']; ?></a>
        </div>
        <div class="img">
            <a href="baiviet.php?id=<?php echo $other_article['id_baiviet']; ?>">
                <img src="../admincp/module/quanlybaiviet/upload/<?php echo $other_article['Hinhanh']; ?>"
                    alt="Bài viết">
            </a>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<!-- Box 3: Hiển thị các bài viết thuộc Khoa học - Công nghệ -->
<div class="box3">
    <h1><?php echo $tentheloai; ?></h1>
    <nav class="subcategories">
        <a href="index.php?quanly=theloai&id=<?php echo $id_theloai; ?>"><?php echo $tentheloai; ?></a>
    </nav>
    <div class="news-container">
        <!-- Tin chính -->
        <?php
            if ($first_article): ?>
        <div class="main-news">
            <a href="baiviet.php?id=<?php echo $first_article['id_baiviet']; ?>">
                <img src="../admincp/module/quanlybaiviet/upload/<?php echo $first_article['Hinhanh']; ?>"
                    alt="Bài viết">
            </a>
            <a href="baiviet.php?id=<?php echo $first_article['id_baiviet']; ?>">
                <h2><?php echo $first_article['Tenbaiviet']; ?></h2>
            </a>
            <p><?php echo $first_article['Tomtat']; ?></p>
        </div>
        <?php endif; ?>

        <!-- Tin phụ -->
        <div class="sub-news">
            <?php while ($scitech_article = mysqli_fetch_array($query_scitech_articles)): ?>
            <div class="sub-item">
                <a href="baiviet.php?id=<?php echo $scitech_article['id_baiviet']; ?>">
                    <img src="../admincp/module/quanlybaiviet/upload/<?php echo $scitech_article['Hinhanh']; ?>"
                        alt="Bài viết">
                </a>
                <a href="baiviet.php?id=<?php echo $scitech_article['id_baiviet']; ?>">
                    <h3><?php echo $scitech_article['Tenbaiviet']; ?></h3>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>