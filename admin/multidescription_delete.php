<?php

session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';

$conn->beginTransaction();

if(isset($_POST['multidesc'])) {
    if (isset($_POST["desccheckbox"]) && is_array($_POST["desccheckbox"])){

        foreach($_POST['desccheckbox']as $checkbox) {

            $query = "DELETE FROM complaintypedescription WHERE complaindescid=?";

            $res = $conn->prepare($query);
            $data = array($checkbox);
            $status = $res->execute($data);

        if ($status) {
            $conn->commit();
            $_SESSION['sm'] = 'Record(s) deleted successfully';
            session_write_close();
            header('Location: complaindescription.php');
        }

        }
    } else {
        $_SESSION['wm'] = 'No checkbox selected for delete';
        session_write_close();
        header('Location: complaindescription.php');
        exit;
    }

    $conn->rollback();
    $_SESSION['wm'] = "Failed to delete the record because its associated with other record.";
    session_write_close();
    header('Location: complaindescription.php');
    exit;
}
?>