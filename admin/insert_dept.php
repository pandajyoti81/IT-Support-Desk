<?php
session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';

if (isset($_POST['save'])) {

    $conn->beginTransaction();

    $query = "INSERT INTO departmentdetails (department) VALUES (?)";

    $res = $conn->prepare($query);

    $data = array($_POST['deptname']);

    $status = $res->execute($data);

    if ($status == true) {
        $conn->commit();
        $_SESSION['sm'] = "Record Inserted Successfully";
        session_write_close();
        header('location: department.php');
    } else {
        $conn->rollBack();
        $_SESSION['em'] = "Record failed to Insert";
        session_write_close();
        header('location: department.php');
    }
    
} else {

    $_SESSION['em'] = "failed to submit form";
    session_write_close();
    header('location: department.php');
}
?>
