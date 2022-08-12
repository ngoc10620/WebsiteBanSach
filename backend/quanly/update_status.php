<?php
    include '../template/connection.php';
    $MaDH = $_POST['id'];
    $status = $_POST['status'];
    $query_update = mysqli_query($conn,"UPDATE donhang SET TinhTrang = '$status' WHERE MaDH = '$MaDH'");
    if($query_update){
        if($status = 'canceled'){
            $query_ctdh = mysqli_query($conn,"SELECT * FROM chitietdonhang WHERE MaDH = '$MaDH'");
            while($row_ctdh = mysqli_fetch_assoc($query_ctdh)){
                $row_sach = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM sach WHERE MaSach='$row_ctdh[MaSach]'"));
                $new_tonkho = $row_sach['SoLuongCo'] + $row_ctdh['SoLuong'];
                $new_ban = $row_sach['SoLuongBan'] - $row_ctdh['SoLuong'];
                $query_update_tonkho = mysqli_query($conn,"UPDATE sach SET SoLuongCo = '$new_tonkho', SoLuongBan = '$new_ban' WHERE MaSach='$row_ctdh[MaSach]'");
            }
        }
    }
    header('Location: donhang.php');
?>