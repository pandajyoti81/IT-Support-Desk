<?php  
    
    session_start();
    if (!isset($_SESSION['aid'])){
        header("location:../file/Adminlogin.php");
        exit();
    }
    include '../itsupportdb.php';

    try {

    $conn->beginTransaction();

    $query = "DELETE FROM departmentdetails WHERE deptid=?";

    $res = $conn->prepare($query);
    $data = array($_GET['id']);
    $status = $res->execute($data);

    if ($status == true) {
        $conn->commit();
        $_SESSION['sm'] = 'Record Deleted Succesfully';
        session_write_close();
        header('Location: department.php');
    // } else {
    //     $conn->rollback();
    //     $_SESSION['wm'] = 'Unable to delete the record due to existing references. Please make sure there are no dependent records associated.';
    //     session_write_close();
    //     header('Location: department.php');
    }

} catch (PDOException $e) {
    $_SESSION['wm'] = "Unable to delete the record due to existing references. Please make sure there are no dependent records associated.";
    session_write_close();
    header('location: department.php');
    exit;
}
?>