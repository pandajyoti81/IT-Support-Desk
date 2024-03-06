<option value=""> select email id</option>
<?php
    include '../itsupportdb.php';
    $query = "SELECT * FROM userdetails WHERE userid = '".$_POST['username']."'";
    $data = $conn->query($query);
    
    foreach($data as $email){?>
    <option value="<?php echo $email['emailid'] ?>"><?php echo $email['emailid']?></option>
     <?php }
?>
