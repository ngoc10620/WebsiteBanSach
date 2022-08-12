<?php
require_once("./include/connection.php");
ob_start();
header('Content-Type: application/json');
$response = [];
if(!isset($_SESSION['username'])){
    $response['error'] = "Bạn chưa đăng nhập. Hãy đăng nhập để thêm sản phẩm vào giỏ hàng!";
}
else{
    foreach ($_POST['quantity'] as $MaSach => $quantity){
        if($quantity != 0){
            $id = $MaSach;
            $user = $_SESSION['username'];
            $gh = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM giohang gh INNER JOIN taikhoan tk ON gh.MaTK = tk.MaTK WHERE tk.TenDangNhap='$user'"));
            $magh = $gh['MaGioHang'];
            $query = mysqli_query($conn,"SELECT * FROM chitietgiohang ct INNER JOIN giohang gh ON ct.MaGioHang = gh.MaGioHang WHERE gh.MaGioHang='$magh'");
            // $row = mysqli_fetch_assoc($query);
            if(mysqli_num_rows($query) == 0){
                // $gh = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM giohang gh INNER JOIN taikhoan tk ON gh.MaTK = tk.MaTK WHERE tk.TenDangNhap='$user'"));
                // $magh = $gh['MaGioHang'];
                $sach = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$id'"));
                $price = $sach['Gia'] * $quantity;
                $query_add = mysqli_query($conn,"INSERT INTO chitietgiohang(SoLuong,ThanhTien,MaSach,MaGioHang) VALUES ('$quantity','$price','$id','$magh')");
                if($query_add){
                    $response['success'] = "Đã thêm sách vào giỏ hàng";

                }
                else{
                    $response['error'][] = "Lỗi cập nhật";
                }
            }
            else{
                while($row = mysqli_fetch_assoc($query)){
                    if($row['MaSach'] == $id){
                        $sach = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$id'"));
                        $price = $sach['Gia'];
                        $old_quantity = $row['SoLuong'];
                        $new_quantity = $old_quantity + $quantity;
                        $new_price = $new_quantity * $price;
                        $query_add = mysqli_query($conn,"UPDATE chitietgiohang SET SoLuong='$new_quantity', ThanhTien='$new_price' WHERE MaSach='$id'");
                        if($query_add){
                            $response['success'] = "Đã tăng số lượng sách trong giỏ hàng";
                        }
                        else{
                            $response['error'][] = "Lỗi cập nhật";
                        }
                        break;
                    }
                }
                if($response == []){
                    // $gh = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM giohang gh INNER JOIN taikhoan tk ON gh.MaTK = tk.MaTK WHERE tk.TenDangNhap='$user'"));
                    // $magh = $gh['MaGioHang'];
                    $sach = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$id'"));
                    $price = $sach['Gia'];
                    $total = $price * $quantity;
                    $query_add = mysqli_query($conn,"INSERT INTO chitietgiohang(SoLuong,ThanhTien,MaSach,MaGioHang) VALUES ('$quantity','$total','$id','$magh')");
                    if($query_add){
                        $response['success'] = "Đã thêm sách vào giỏ hàng";
                    }
                    else{
                        $response['error'][] = "Lỗi cập nhật";
                    }
                }
            }
        }
    }
}
echo json_encode($response);
ob_flush();
?>