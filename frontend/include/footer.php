
        <footer>
            <div class="wrapper">
                <div class="footermenu clearfix">
                    <div class="col">
                        <ul>
                            <li><a href="news.php?MaTinTuc=1">Giới thiệu</a></li>
                            <li><a href="news.php?MaTinTuc=2">Chính sách bảo mật</a></li>
                            <li><a href="news.php?MaTinTuc=3">Chính sách vận chuyển</a></li>
                            <li><a href="news.php?MaTinTuc=4">Hình thức thanh toán</a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul>
                            <li><a href="news.php?MaTinTuc=5">Quy định đổi, trả và hủy đơn hàng</a></li>
                            <li><a href="news.php?MaTinTuc=6">Hướng dẫn đặt hàng</a></li>
                            <li><a href="news.php?MaTinTuc=7">Liên hệ</a></li>
                            <li><a href="news.php?MaTinTuc=8">Thông báo</a></li>
                        </ul>
                    </div>
                    <div class="socialbtn">
                        <ul>
                            <li><a href="https://www.facebook.com/nhanampublishing"><i class="fa-brands fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/nhanambooks/"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="https://t.me/nhanambook"><i class="fa-brands fa-telegram"></i></a></li>
                            <li><a href="https://www.youtube.com/user/NhanamVideoChannel"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="wrapper">
                    <p>
                        &copy; 2014 - Bản quyền của Công Ty Cổ Phần Văn Hoá và Truyền Thông Nhã Nam - 
                        <a href="http://nhanam.com.vn/">nhanam.com.vn</a> <br>
                        Địa chỉ: 59 Đỗ Quang, phường Trung Hoà, quận Cầu Giấy, Hà Nội <br>
                        Giấy ĐKKD số 0101603420 do Sở KH&ĐT TP Hà Nội cấp ngày 21 tháng 1 năm 2005 sửa đổi lần 5 ngày 20/3/2013
                    </p>
                </div>
            </div>
        </footer>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="./js/bootstrap.bundle.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            $(".add").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: './addCart.php',
                    data: $(this).serializeArray(),
                    success: function (response) {
                        if(response.success){
                            $("#cart").fancybox().trigger('click');
                        }
                        else{
                            alert(response.error);
                        }
                    }
                });
            });
            
            // $(".updateCart").change(function(event){
            //     event.preventDefault();
            //     $.ajax({
            //         type: 'POST',
            //         url: './updateCart.php?action=update',
            //         data: 
            //     })
            // })
        </script>
    </body>
</html>