<?php
session_start();
include '../itsupportdb.php';

$query = "SELECT itteamid FROM itteam WHERE username= '" . $_POST['username'] . "' and password= '" . $_POST['pwd'] . "'";
// var_dump($query);
// exit;
$data = $conn->query($query);
$itid = 0;
foreach ($data as $var) {
    $itid = $var['itteamid'];
}


if ($itid > 0) {
    $_SESSION['itid'] = $itid;
    header('location: ../itteam/dashboarditteam.php');
} else {
    $_SESSION['em'] = 'The username or password you have entered is incorrect';
    session_write_close();
    header('location: ITteamlogin.php');
}
