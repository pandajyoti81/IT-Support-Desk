<?php
 include '../itsupportdb.php';

 $query = "SELECT COUNT(userid) AS email FROM userdetails WHERE emailid= '".$_POST['emailid']."'";
 $data = $conn->query($query);
 foreach($data as $var){
    $count = $var['email'];
 }
 echo $count;
?>