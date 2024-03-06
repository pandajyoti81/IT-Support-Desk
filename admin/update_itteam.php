<?php
session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';

$conn->beginTransaction();

$query = "UPDATE itteam set name=?,username=?,mobile=?,emailid=?,createdt=?,status=? where itteamid=?";

$res = $conn->prepare($query);
$data = array($_POST['empname'],$_POST['uname'],$_POST['empmob'],$_POST['empemail'],$createdt,$_POST['status'],$_POST['itteamid']);
// var_dump($query);exit;
$status = $res->execute($data);

if($status == true){
    $conn->commit();
    $_SESSION['sm'] = 'Record updated successfully';
    session_write_close();
    header('Location: itteamdetails.php');
}else{
    $conn->rollback();
    $_SESSION['wm'] = 'Failed to update the record';
    session_write_close();
    header('Location: edititteam.php');
}
?>