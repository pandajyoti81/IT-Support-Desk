<?php
    session_start();
    if (!isset($_SESSION['aid'])){
        header("location:../file/Adminlogin.php");
        exit();
    }
    include '../itsupportdb.php';

    $conn->beginTransaction();

    $query = "INSERT INTO complaintypedescription (complaintypeid,complaindesc) VALUES (?,?)";
    // var_dump($data);
    // exit;
    $res = $conn->prepare($query);
    $data = array($_POST['comptype'],$_POST['compdesc']);
    $status = $res->execute($data);

    if($status == true){
        $conn->commit();
        $_SESSION['sm'] = 'Record inserted successfully';
        session_write_close();
        header('Location: complaindescription.php');
    } else {
        $conn->rollBack();
        $_SESSION['wm'] = 'Failed to insert the record';
        session_write_close();
        header('Location: complaindescription.php');
    }
?>
