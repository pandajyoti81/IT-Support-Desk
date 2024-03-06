<?php
 include '../itsupportdb.php';

 $query = "SELECT COUNT(complainid) AS complain FROM complaintype WHERE complaintype= '".$_POST['complaintype']."'";
 $data = $conn->query($query);
 foreach($data as $var){
    $count = $var['complain'];
 }
 echo $count;
?>