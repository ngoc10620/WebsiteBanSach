<?php session_start();
if (isset($_SESSION['username'])){
    header('Location: index.php');
    unset($_SESSION['username']); // xóa session login
}
?>