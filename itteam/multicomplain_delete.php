<?php

session_start();
if (!isset($_SESSION['itid'])) {
    header("location:../file/ITteamlogin.php");
    exit();
}

include '../itsupportdb.php';
date_default_timezone_set('Asia/kolkata');
$conn->beginTransaction();

$errors = [];

if (isset($_POST['multicomplain'])) {
    if (isset($_POST["itcomplaincheckbox"]) && is_array($_POST["itcomplaincheckbox"])) {

        foreach ($_POST["itcomplaincheckbox"] as $itteam) {
            $query = "UPDATE usercomplain SET complainstatus =?,resolvedt=?,resolvetime=? WHERE usercomplainid=?";
            $res = $conn->prepare($query);
            $data = array("Resolve",date('Y-m-d'),date('H:i:sa'),$itteam);
            $status = $res->execute($data);

            if (!$status) {
                $errors[] = "Failed to delete the record with ITteamId: $itteam";
            }
        }

        if (!empty($errors)) {
            $conn->rollback();
            $_SESSION['em'] = implode('<br>', $errors);
            session_write_close();
            header('Location: complaindetailsitteam.php');
            exit;
        }
    } else {
        $_SESSION['em'] = 'No checkbox selected for delete';
        session_write_close();
        header('Location: complaindetailsitteam.php');
        exit;
    }
}

$conn->commit();
$_SESSION['sm'] = 'Record(s) update successfully';
session_write_close();
header('Location: complaindetailsitteam.php');
?>