<?php
    session_start();
    if (!isset($_SESSION['itid'])) {
        header("location:../file/ITteamlogin.php");
        exit();
    }
    include '../itsupportdb.php';

    date_default_timezone_set( 'Asia/kolkata');
    $conn->beginTransaction();

    $query = "UPDATE usercomplain SET complainstatus=?,resolvedt=?,resolvetime=? WHERE usercomplainid=?";
    // var_dump($query);
    // exit;
    $res = $conn->prepare($query);
    $data = array("Resolve",date("Y-m-d"),date('H:i:sa'),$_GET['id']);
    $status = $res->execute($data);

    if ($status == true) {
        $conn->commit();
        $_SESSION['sm'] = 'Record updated successfully';
        session_write_close();
        header('Location: complaindetailsitteam.php');
    } else {
        $conn->rollback();
        $_SESSION['em'] = 'Failed to update your Record';
        session_write_close();
        header('Location: complaindetailsitteam.php');
    }
?>