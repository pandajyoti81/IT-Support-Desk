<?php

session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';

try {
    $conn->beginTransaction();

    if (isset($_POST['multidelete'])) {
        if (isset($_POST["deptcheckbox"]) && is_array($_POST["deptcheckbox"])) {
            foreach ($_POST['deptcheckbox'] as $checkbox) {
                $query = "DELETE FROM departmentdetails WHERE deptid=?";
                $res = $conn->prepare($query);
                $data = array($checkbox);
                $status = $res->execute($data);
                
                if (!$status) {
                    $conn->rollback();
                    $_SESSION['wm'] = "Failed to delete the record because it's associated with other records.";
                    session_write_close();
                    header('Location: department.php');
                    exit;
                }
            }
        } else {
            $_SESSION['wm'] = 'No checkbox selected for delete';
            session_write_close();
            header('Location: department.php');
            exit;
        }
    }
    
    $conn->commit();
    $_SESSION['sm'] = "Record(s) deleted successfully";
    session_write_close();
    header('Location: department.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['wm'] = "Unable to delete the record due to existing references. Please make sure there are no dependent records associated.";
    session_write_close();
    header('Location: department.php');
    exit;
}
?>
