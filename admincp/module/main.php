<?php
if (isset($_GET['action'])) {
    $tam = $_GET['action']; 
} else {
    $tam = '';
}

if ($tam == 'quanlybaiviet') {
    include("../admincp/module/quanlybaiviet/thembai.php");
    include("../admincp/module/quanlybaiviet/lietkebaiviet.php");
} elseif ($tam == 'suabai') {
    include("../admincp/module/quanlybaiviet/suabai.php");
} elseif ($tam == 'quanlytheloai') {
    include("../admincp/module/quanlytheloai/them.php");
    include("../admincp/module/quanlytheloai/lietketheloai.php");
} elseif ($tam == 'quanlynguoidung') {
    include("../admincp/module/quanlynguoidung/quanly.php");
} else {
    include("../admincp/module/dashboard.php");
}
?>
