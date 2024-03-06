<?php
session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';

$conn->beginTransaction();

$query = "UPDATE userdetails set deptid=?,username=?,userip=?,systemname=?,mobile=?,emailid=? where userid=?";
// var_dump($query);
// exit;
$res = $conn->prepare($query);
$data = array($_POST['deptname'], $_POST['empname'], $_POST['esia'], $_POST['sysname'], $_POST['empmob'], $_POST['empemail'], $_POST['userid']);
$status = $res->execute($data);

if ($status == true) {
    $conn->commit();
    $_SESSION['sm'] = 'Record updated successfully';
    session_write_close();
    header('Location: userdetails.php');
} else {
    $conn->rollback();
    $_SESSION['wm'] = 'Failed to update the record';
    session_write_close();
    header('Location: addnewuser.php');
}
?>
