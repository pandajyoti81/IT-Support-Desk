<?php  
    
    session_start();
    if (!isset($_SESSION['aid'])){
        header("location:../file/Adminlogin.php");
        exit();
    }
    include '../itsupportdb.php';

    try {

    $conn->beginTransaction();

    $query = "DELETE FROM itteam WHERE itteamid=?";

    $res = $conn->prepare($query);
    $data = array($_GET['id']);
    $status = $res->execute($data);

    if ($status == true) {
        $conn->commit();
        $_SESSION['sm'] = 'Record deleted succesfully';
        session_write_close();
        header('Location: itteamdetails.php');
    } else {
        $conn->rollback();
        $_SESSION['em'] = 'Unable to delete the record due to existing references. Please make sure there are no dependent records associated.';
        session_write_close();
        header('Location: itteamdetails.php');
    }

} catch (PDOException $e) {
    $_SESSION['em'] = "Unable to delete the record due to existing references. Please make sure there are no dependent records associated.";
    session_write_close();
    header('location: itteamdetails.php');
    exit;
}
?>