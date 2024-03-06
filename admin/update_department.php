<?php
session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';

$conn->beginTransaction();

$query = "update departmentdetails set department=?, deptstatus=? where deptid=?";
$res = $conn->prepare($query);
$data = array($_POST['deptname'],$_POST['sts'],$_POST['deptid']);

$status = $res->execute($data);

if($status == true){
    $conn->commit();
    $_SESSION['sm'] = 'Record updated successfully';
    session_write_close();
    header('Location: department.php');
}else{
    $conn->rollback();
    $_SESSION['wm'] = 'Failed to update the record';
    session_write_close();
    header('Location: editdepartment.php');
}
?>