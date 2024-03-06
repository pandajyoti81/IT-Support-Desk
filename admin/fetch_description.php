<option value=""> select complain description</option>
<?php
    include '../itsupportdb.php';
    $query = "SELECT * FROM complaintypedescription WHERE complaintypeid = '".$_POST['complaintype']."'";
    $data = $conn->query($query);
    // var_dump($query );exit;
    foreach($data as $compdesc){?>
    <option value="<?php echo $compdesc['complaindescid'] ?>"><?php echo $compdesc['complaindesc']?></option>
     <?php }
?>
