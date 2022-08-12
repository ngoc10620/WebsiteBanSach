<?php
    header('Content-Type: application/json');
    require_once("../template/connection.php");
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $sql = "SELECT MONTH(NgayLap) AS month, SUM(TongTien) AS total FROM donhang WHERE TinhTrang='completed' AND YEAR(NgayLap)='$year' GROUP BY MONTH(NgayLap) ORDER BY MONTH(NgayLap) ASC";
    $query = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($query);
    if($num > 0){
        while($result = mysqli_fetch_assoc($query)){
            $data[] = array(
                'month' => $result['month'],
                'total' => $result['total']
            );
        };
    }
    else{
        $data = array();
    }
    echo json_encode($data);
?>