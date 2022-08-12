
<?php
 
$sql = 'SELECT * FROM danhmuc';
 
$result = mysqli_query($conn, $sql);
 
$danhmuc = array();
 
while ($row = mysqli_fetch_assoc($result)){
    $danhmuc[] = $row;
}
function showDanhmuc($danhmuc, $parent_MaDM = 0,$stt = 0)
{
    $chuyenmuc = array();
    foreach ($danhmuc as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_MaDM'] == $parent_MaDM)
        {
            $chuyenmuc[] = $item;
            unset($danhmuc[$key]);
        }
    }
     
    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($chuyenmuc)
    {
        if ($stt == 0){
            echo '<ul class="submenu">';
        }
        else if ($stt >= 1){
        echo '<ul class="submenu2">';
        }
        foreach ($chuyenmuc as $key => $item)
        {
            // Hiển thị tiêu đề chuyên mục
            echo '<li><a href="listbook.php?MaDM='.$item['MaDM'].'">'.$item['TenDM'];
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showDanhmuc($danhmuc, $item['MaDM'],++$stt);
            echo '</a></li>';
        }
        echo '</ul>';
    }
}
?>
<div id="mainnav">
    <div class="wrapper">
        <ul class="menu clearfix">
            <li>
                <a href="listbook2.php?id=1">Danh mục sách</a>
                    <?php showDanhmuc($danhmuc); ?>
            </li>
            <li><a href="listbook2.php?id=1">Sách mới xuất bản</a></li>
            <li><a href="listbook2.php?id=2">Sách bán chạy</a></li>
            <li><a href="news.php?MaTinTuc=8">Thông báo</a></li>
            <li class="show-mobile"><a href="#">Giới thiệu</a></li>
            <li class="show-mobile"><a href="#">Kiểm tra đơn hàng</a></li>
            <li class="show-mobile"><a href="#">Đăng ký</a></li>
            <li class="show-mobile"><a href="#">Đăng nhập</a></li>
        </ul>
    </div>
</div>