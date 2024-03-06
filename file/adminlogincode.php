<?php
include '../itsupportdb.php';
session_start();

$query = "SELECT adminid FROM adminlogin WHERE username= '" . $_POST['admin'] . "' and password= '" . $_POST['password'] . "'";
$data = $conn->query($query);
// var_dump($data);
// exit;
$adid = 0;
foreach ($data as $var) {
    $adid = $var['adminid'];
   
}
if ($adid > 0) {
    $_SESSION['aid'] = $adid;
    header('location: ../admin/dashboard.php');
} else {
    $_SESSION['em'] = 'The username or password you have entered is incorrect';
    session_write_close();
    header('location: Adminlogin.php');
}
