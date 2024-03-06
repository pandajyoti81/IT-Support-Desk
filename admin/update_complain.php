<?php
    
    session_start();
    if (!isset($_SESSION['aid'])){
        header("location:../file/Adminlogin.php");
        exit();
    }
    include '../itsupportdb.php';

    $conn->beginTransaction();

    $query = "UPDATE complaintype SET complaintype=?,complainstatus=? WHERE complainid=?";
    $res = $conn->prepare($query);
    $data = array($_POST['comptype'], $_POST['sts'], $_POST['complainid']);
    $status = $res->execute($data);
    // var_dump($data);
    // exit;
    if($status == true){
        $conn->commit();
        $_SESSION['sm'] = 'Record Updated Successfully';
        session_write_close();
        header('Location: complaintypedetails.php');
    } else {
        $conn->rollBack();
        $_SESSION['em'] = 'Failed to Update The Record';
        session_write_close();
        header('Location: editcomplaintype.php');
    }
?>
