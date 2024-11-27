<section>
    <div>
        <div class="content">
            <?php
            // Xử lý tham số 'quanly' và 'id' để quyết định trang cần include
            if(isset($_GET['quanly']) && $_GET['quanly'] == 'theloai' && isset($_GET['id'])) {
                $id_theloai = $_GET['id'];
                // Bao gồm các trang theo id thể loại
                switch ($id_theloai) {
                    case 11:
                        include("../pages/category/thoisu.php");
                        break;
                    case 12:
                        include("../pages/category/gocnhin.php");
                        break;
                    case 13:
                        include("../pages/category/thegioi.php");
                        break;
                    case 14:
                        include("../pages/category/kinhdoanh.php");
                        break;
                    case 15:
                        include("../pages/category/batdongsan.php");
                        break;
                    case 16:
                        include("../pages/category/khoahoc.php");
                        break;
                    case 17:
                        include("../pages/category/giaitri.php");
                        break;
                    case 18:
                        include("../pages/category/thethao.php");
                        break;
                    case 19:
                        include("../pages/category/phapluat.php");
                        break;
                    case 20:
                        include("../pages/category/giaoduc.php");
                        break;
                    case 21:
                        include("../pages/category/suckhoe.php");
                        break;
                    case 22:
                        include("../pages/category/doisong.php");
                        break;
                    default:
                        include("../pages/category/index.php");
                        break;
                }
            } else {
                include("../pages/category/index.php");
            }
            ?>
        </div>
    </div>
</section>