<?php
 include '../itsupportdb.php';

 $query = "SELECT COUNT(itteamid) AS mobile FROM itteam WHERE mobile= '".$_POST['mobile']."'";
 $data = $conn->query($query);
 foreach($data as $var){
    $count = $var['mobile'];
 }
 echo $count;
?>