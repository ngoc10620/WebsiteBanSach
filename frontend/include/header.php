<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title;?> | Nhã Nam</title>
        <link rel="shortcut icon" href="../favicon.ico" />
        <script src="https://kit.fontawesome.com/8a10bf3a37.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script language="javascript" src="./js/javascript.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="./js/jquery.carouFredSel-6.2.1-packed.js"></script>
        <script>
            $(document).ready(function() {
                $("#foo").carouFredSel({
                    items: 6,
					height: 'auto',
					prev: '#prev1',
					next: '#next1',
					auto: false,
                    scroll : {
                        items           : 1,
                        effect          : "easeOutBounce",
                        duration        : 1000,                         
                        pauseOnHover    : true
                    }  
                });
                $("#foo2").carouFredSel({
                    items: 6,
					height: 'auto',
					prev: '#prev2',
					next: '#next2',
					auto: false,
                    scroll : {
                        items           : 1,
                        effect          : "easeOutBounce",
                        duration        : 1000,                         
                        pauseOnHover    : true
                    }  
                });
            });
        </script>
    </head>
    <body>

        <header>
            <div class="clearfix">
                <div class="topbar hidden-mobile">
                    <div class="wrapper">
                        <div class="clearfix">
                        <?php if(!isset($_SESSION['username'])){ ?>
                            <ul class="topnav">
                                <li><a href="news.php?MaTinTuc=1">Giới thiệu</a></li>
                            </ul>
                            <ul class="topprofile">
                                <li><a href="signin.php">Đăng ký</a></li>
                                <li><a href="login.php">Đăng nhập</a></li>
                            </ul>
                            <?php }else{ ?>
                            <ul class="topnav">
                                <li><a href="news.php?MaTinTuc=1">Giới thiệu</a></li>
                                <li><a href="order.php">Kiểm tra đơn hàng</a></li>
                            </ul>
                            <ul class="topprofile">
                                <li><a href="EditInfo.php"><?php echo $_SESSION['username']; ?></a></li>
                                <li><a href="logout.php">Thoát</a></li>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="wrapper wrap">
                    <div class="logo">
                        <a href="index.php"></a>
                    </div>
                    <?php if(isset($_SESSION['username'])){ ?>
                    <a data-fancybox data-type="ajax" data-src="ajax-cart.php" href="javascript:;" class="cart" id="cart"></a>
                            <?php } ?>
                    <div class="search">
                        <form id="search" action="search.php" method="get" novalidate="novalidate">
                            <input type="text" name="txtsearch" placeholder="Tìm kiếm sách..." class="text" value="<?php echo isset($search) ? $search : ''; ?>">
                            <button type="submit" name="btnsearch" onclick="check();"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
            </div>
</header>
