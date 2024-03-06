<?php
session_start();
if (!isset($_SESSION['itid'])) {
    header("location:../file/ITteamlogin.php");
    exit();
}
include '../itsupportdb.php';

$query = "SELECT password FROM itteam WHERE itteamid =" . $_SESSION['itid'];
$data = $conn->query($query);
foreach ($data as $var) {
    $oldpwd = $var['password'];
} 
//  var_dump($oldpwd);
// exit;

if ($oldpwd == $_POST['opass']) {
    $conn->beginTransaction();
    $query = "UPDATE itteam SET password=? where itteamid=?";
    $res = $conn->prepare($query);
    
    $data = array($_POST['npass'],$_SESSION['itid']);
    $success = $res->execute($data);
    // var_dump($data);
    //  exit;


    if ($success == true) {
        $conn->commit();
        $_SESSION['sm'] = 'Record Updated Successfully';
        session_write_close();
        header('Location: changepassworditteam.php');
    } else {
        $conn->rollBack();
        $_SESSION['em'] = 'Failed to Update the password';
        session_write_close();
        header('Location: changepassworditteam.php');
    }
} else {
    $_SESSION['em'] = 'The old password you have entered is incorrect';
    session_write_close();
    header('Location: changepassworditteam.php');
}
