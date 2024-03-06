<?php
 include '../itsupportdb.php';

 $query = "SELECT COUNT(itteamid) AS email FROM itteam WHERE emailid= '".$_POST['emailid']."'";
 $data = $conn->query($query);
 foreach($data as $var){
    $count = $var['email'];
 }
 echo $count;
?>