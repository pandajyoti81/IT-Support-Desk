<?php

session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';


$query = "SELECT password FROM adminlogin";
$data = $conn->query($query);
foreach ($data as $var) {
    $oldpwd = $var['password'];
}

if ($oldpwd == $_POST['opass']) {
    $conn->beginTransaction();
    $query = "UPDATE adminlogin SET password=? where adminid=?";
    $res = $conn->prepare($query);

    $data = array($_POST['npass'], 1);
    $success = $res->execute($data);
    //  var_dump($success);
    //  exit;

    if ($success == true) {
        $conn->commit();
        $_SESSION['sm'] = 'Record Updated Successfully';
        session_write_close();
        header('Location: changepassword.php');
    } else {
        $conn->rollBack();
        $_SESSION['wm'] = 'Failed to Update the password';
        session_write_close();
        header('Location: changepassword.php');
    }
} else {
    $_SESSION['wm'] = 'The old password you have entered is incorrect';
    session_write_close();
    header('Location: changepassword.php');
}
