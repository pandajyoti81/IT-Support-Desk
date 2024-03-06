<?php
 include '../itsupportdb.php';

 $query = "SELECT COUNT(itteamid) AS team FROM itteam WHERE username= '".$_POST['username']."'";
 $data = $conn->query($query);
 foreach($data as $var){
    $count = $var['team'];
 }
 echo $count;
?>