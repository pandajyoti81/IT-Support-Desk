<?php
    session_start();
    if (!isset($_SESSION['aid'])){
        header("location:../file/Adminlogin.php");
        exit();
    }
    include '../itsupportdb.php';

    $conn->beginTransaction();

    $query = "UPDATE complaintypedescription set complaintypeid=?,complaindesc=? WHERE complaindescid=?";
    $res = $conn->prepare($query);
    $data = array($_POST['comptype'], $_POST['compdesc'], $_POST['complainid']);
    $status = $res->execute($data);
    // var_dump($data);
    // exit;
    if($status == true){
        $conn->commit();
        $_SESSION['sm'] = 'Record Updated Successfully';
        session_write_close();
        header('Location: complaindescription.php');
    } else {
        $conn->rollBack();
        $_SESSION['em'] = 'Failed to Update The Record';
        session_write_close();
        header('Location: editcomplaindescription.php');
    }
?>