<?php
    header('Content-Type: application/json');
    require_once("../template/connection.php");
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $month = isset($_POST['month']) ? $_POST['month'] : '';
    $sql = "SELECT * FROM donhang WHERE TinhTrang='completed' AND YEAR(NgayLap)='$year' AND MONTH(NgayLap)='$month' ORDER BY DAY(NgayLap) ASC";
    $query = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($query);
    if($num > 0){
        $i = 1;
        while($result = mysqli_fetch_assoc($query)){
            $data[] = array(
                'stt' => $i,
                'id' => $result['MaDH'],
                'date' => date('d-m-Y',strtotime($result['NgayLap'])),
                'total' => $result['TongTien']
            );
            $i++;
        };
    }
    else{
        $data = array();
    }
    echo json_encode($data);
?>