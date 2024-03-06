<?php
session_start();
if (!isset($_SESSION['itid'])) {
    header("location:../file/ITteamlogin.php");
    exit();
}
include '../itsupportdb.php';

$conn->beginTransaction();

$query = "UPDATE itteam set name=?,username=?,mobile=?,emailid=? where itteamid=?";
// var_dump($query);
// exit;
$res = $conn->prepare($query);
$data = array($_POST['empname'], $_POST['uname'], $_POST['empmob'], $_POST['empemail'], $_SESSION['itid']);
$status = $res->execute($data);

if ($status == true) {
$conn->commit();
$_SESSION['sm'] = 'Profile updated successfully';
session_write_close();
header('Location: editprofileitteam.php');
} else {
$conn->rollback();
$_SESSION['em'] = 'Failed to update your Profile';
session_write_close();
header('Location: editprofileitteam.php');
}
?>

