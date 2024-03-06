<?php
session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';

    $conn->beginTransaction();

    date_default_timezone_set('Asia/Kolkata');

    $query = "INSERT INTO usercomplain (deptid , userid, complaintypeid, complaindescid , itteamid, emailid, complaindt, complaintime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    // var_dump($query);
    // exit;

    $res = $conn->prepare($query);

    // Ensure the field names here correspond to the form field names
    $data = array($_POST['deptname'], $_POST['empname'], $_POST['comptype'], $_POST['compdesc'], $_POST['fct'], $_POST['empemail'], date('Y-m-d'), date('H:i:sa'));

    $status = $res->execute($data);
    //  var_dump($status);
    //  exit;

    if ($status == true) {
        $conn->commit();
        $_SESSION['sm'] = "Record Inserted Successfully";
        session_write_close();
        header('Location: usercomplaindetails.php');
    } else {
        $conn->rollBack();
        $_SESSION['em'] = "Failed To Insert";
        session_write_close();
        header('Location: addnewcomplain.php');
    }

?>
