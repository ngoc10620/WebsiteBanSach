<?php 
require_once("./include/connection.php");
ob_start();
header('Content-Type: application/json');
$response = [];
$action = isset($_GET['action']) ? $_GET['action'] : '';
if($action == "delete"){
    $MaCTGH = isset($_POST['MaCTGH']) ? $_POST['MaCTGH'] : '';
    $query_delete = mysqli_query($conn,"DELETE FROM chitietgiohang WHERE MaCTGH = '$MaCTGH'");
    if($query_delete){
        $response['success'] = "Đã xóa sách khỏi giỏ hàng";
    }
    else{
        $response['error'][] = "Lỗi cập nhật";
    }
}
if($action == "update"){
    foreach ($_POST['quantity'] as $MaCTGH => $quantity){
        if($quantity <= 0 || is_nan($quantity)){
            $response['error'] = "Số lượng sách phải là số nguyên dương";
        }
        else{
            $id = $MaCTGH;
            $ctgh = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM chitietgiohang WHERE MaCTGH='$id'"));
            $sach = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$ctgh[MaSach]'"));
            if($quantity > $sach['SoLuongCo']){
                $response['error'] = "Số lượng sách còn ".$sach['SoLuongCo'].". Vui lòng chọn lại";
            }
            else{
                $price = $ctgh['ThanhTien']/$ctgh['SoLuong'];
                $new_price = $quantity * $price;
                $query_add = mysqli_query($conn,"UPDATE chitietgiohang SET SoLuong='$quantity', ThanhTien='$new_price' WHERE MaCTGH='$id'");
                if($query_add){
                    $response['success'] = "Đã cập nhật số lượng sách trong giỏ hàng";
                }
                else{
                    $response['error'][] = "Lỗi cập nhật";
                }
            }
        }
    }
}
echo json_encode($response);
ob_flush();
?>