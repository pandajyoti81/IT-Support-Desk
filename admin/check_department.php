<?php
 include '../itsupportdb.php';

 $query = "SELECT COUNT(deptid) AS department FROM departmentdetails WHERE department= '".$_POST['department']."'";
 
 $data = $conn->query($query);

 foreach($data as $var){

    $count = $var['department'];
 }
 echo $count;
?>