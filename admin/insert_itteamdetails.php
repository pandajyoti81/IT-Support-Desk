<?php
   session_start();
   if (!isset($_SESSION['aid'])){
      header("location:../file/Adminlogin.php");
      exit();
  }
   include '../itsupportdb.php';

 if (isset($_POST['save'])) {

    $conn->beginTransaction();

    $query = "INSERT INTO itteam (name,username,mobile,emailid,Password) VALUES (?,?,?,?,?)";
    // var_dump($query);
    // exit;
    $res = $conn->prepare($query);

    $data = array($_POST['empname'],$_POST['uname'],$_POST['empmob'],$_POST['empemail'],$_POST['password']);

    $status = $res->execute($data);

    if ($status == true) {
        $conn->commit();
        $_SESSION['sm'] = "Record Inserted Successfully";
        session_write_close();
        header('location: itteamdetails.php');
    } else {
        $conn->rollBack();
        $_SESSION['em'] = "Failed To Insert";
        session_write_close();
        header('location: itteamdetails.php');
    }

 } else {

    $_SESSION['em'] = "failed to submit form";
    session_write_close();
    header('location: itteamdetails.php');
 }
?>
