<?php
 include '../itsupportdb.php';

 $query = "SELECT COUNT(complaintypeid) AS complaindesc FROM complaintypedescription WHERE complaindesc= '".$_POST['complaindesc']."'";
 $data = $conn->query($query);
 foreach($data as $var){
    $count = $var['complaindesc'];
 }
 echo $count;
?>