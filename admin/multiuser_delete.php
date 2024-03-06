<?php

session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';

try {
    $conn->beginTransaction();

    if (isset($_POST['multiuserdelete'])) {
        if (isset($_POST["usercheckbox"]) && is_array($_POST["usercheckbox"])) {
            foreach ($_POST['usercheckbox'] as $checkbox) {
                $query = "DELETE FROM userdetails WHERE userid=?";
                $res = $conn->prepare($query);
                $data = array($checkbox);
                $status = $res->execute($data);
                
                if (!$status) {
                    $conn->rollback();
                    $_SESSION['em'] = "Failed to delete the record because it's associated with other records.";
                    session_write_close();
                    header('Location: userdetails.php');
                    exit;
                }
            }
        } else {
            $_SESSION['em'] = 'No checkbox selected for delete';
            session_write_close();
            header('Location: userdetails.php');
            exit;
        }
    }
    
    $conn->commit();
    $_SESSION['sm'] = "Record(s) deleted successfully";
    session_write_close();
    header('Location: userdetails.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['em'] = "Unable to delete the record due to existing references. Please make sure there are no dependent records associated.";
    session_write_close();
    header('Location: userdetails.php');
    exit;
}
?>
