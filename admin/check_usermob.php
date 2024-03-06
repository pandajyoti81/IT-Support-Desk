<?php
 include '../itsupportdb.php';

 $query = "SELECT COUNT(userid) AS mobile FROM userdetails WHERE mobile= '".$_POST['mobile']."'";
 $data = $conn->query($query);
 foreach($data as $var){
    $count = $var['mobile'];
 }
 echo $count;
?>