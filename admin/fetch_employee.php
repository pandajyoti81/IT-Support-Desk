<option value=""> select employee name</option>
<?php
    include '../itsupportdb.php';
    $query = "SELECT * FROM userdetails WHERE deptid = '".$_POST['department']."'";
    $data = $conn->query($query);
    // var_dump($query);
    // exit;
    foreach($data as $user){?>
    <option value="<?php echo $user['userid'] ?>"><?php echo $user['username']?></option>
     <?php }
?>
