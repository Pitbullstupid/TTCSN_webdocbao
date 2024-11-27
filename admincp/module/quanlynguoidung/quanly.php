<section>
    <div>
        <div class="content">
            <?php
            // Xử lý tham số 'quanly' và 'id' để quyết định trang cần include
            if(isset($_GET['quanly']) && $_GET['quanly'] == 'theloai' && isset($_GET['id'])) {
                $id_theloai = $_GET['id'];
                // Bao gồm các trang theo id thể loại
                switch ($id_theloai) {
                    case 1:
                        include("../pages/category/thegioi.php");
                        break;
                    case 2:
                        include("../pages/category/kinhdoanh.php");
                        break;
                    case 3:
                        include("../pages/category/batdongsan.php");
                        break;
                    case 4:
                        include("../pages/category/khoahoctrongnuoc.php");
                        break;
                    case 5:
                        include("../pages/category/tintuc.php");
                        break;
                    case 6:
                        include("../pages/category/giaitri.php");
                        break;
                    case 7:
                        include("../pages/category/thethao.php");
                        break;
                    case 8:
                        include("../pages/category/phapluat.php");
                        break;
                    case 9:
                        include("../pages/category/giaoduc.php");
                        break;
                    case 10:
                        include("../pages/category/suckhoe.php");
                        break;
                    case 11:
                        include("../pages/category/doisong.php");
                        break;
                    default:
                        include("../pages/category/index.php");
                        break;
                }
            } else {
                include("../pages/category/index.php"); // Mặc định nếu không có thể loại
            }
            ?>
        </div>
    </div>
</section>