<?php
session_start();
if (!isset($_SESSION['aid'])){
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin/Edit_Complain_Type</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?php include "partial/linkfile.php" ?>

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <?php include "partial/header.php" ?>


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>&nbsp;

                <span class='btn btn-primary'>Manage Users / Edit Complain Type</span>


                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item">
                        <a href="logoutadmin.php" class="nav-link">
                            <i class="fa fa-lock"></i><span class="d-none d-lg-inline-flex">Log Out</span>
                        </a>
                    </div>

                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                        <?php
                        if(isset($_SESSION['sm'])){
                            ?>
                            <div class="alert alert-success">
                            <strong>Success!</strong>
                            <?php
                               echo $_SESSION['sm'];
                               unset($_SESSION['sm']);
                            ?>
                            </div>
                            <?php } ?>
                            <?php
                              if(isset($_SESSION['em'])){
                            ?>
                            <div class="alert alert-warning">
                            <strong>Warning!</strong>
                            <?php
                               echo $_SESSION['em'];
                               unset($_SESSION['em']);
                            ?>
                            </div>
                            <?php } ?>
                            <h6 class="mb-4">EDIT COMPLAIN TYPE</h6>
                           
                            <form action="update_complain.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">COMPLAIN TYPE</label>
                                    <?php
                                        $query = "SELECT complainid,complaintype,complainstatus FROM complaintype WHERE complainid=" . $_GET['id'];
                                        $data = $conn->query($query);
                                        foreach($data as $var){}
                                    ?>
                                    <input type="text" class="form-control" id="comptype" name="comptype" aria-describedby="emailHelp"
                                    value="<?php echo $var['complaintype'] ?>">
                                    <span class="text-danger" id="em"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">STATUS</label>
                                    <select class="form-select mb-3" id="status" name="sts" aria-label="Default select example">
                                        <option value="">select status</option>
                                        <option value="Active" <?php echo( $var['complainstatus'] == 'Active') ? 'selected' : '' ?>>Active</option>
                                        <option value="Inactive" <?php echo( $var['complainstatus'] == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <span class="text-danger" id="em1"></span>
                                    <input type="hidden" name="complainid" value="<?php echo $_GET['id']; ?>"/>
                                </div>
                                <button type="submit" id="update" class="btn btn-primary">Update</button>
                                <a href="complaintypedetails.php" type="reset" class="btn btn-primary">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Form End -->


                <!-- Footer Start -->
                <?php include "partial/footer.php" ?>
                <!-- Footer End -->
            </div>
            <!-- Content End -->

        <!-- JavaScript ../assets/Libraries -->
        <?php include "partial/scriptfile.php" ?>
        <!-- validation -->
        <script>
            $(document).ready(function() {
                $('#update').click(function() {
                    let name = $('#comptype').val().trim()
                    if ($('#comptype').val().trim() == '') {
                        $('#em').html('Please Enter Complain Type');
                        $('#comptype').focus();
                        return false;
                    }
                    let name1 = $('#status').val().trim()
                    if ($('#status').val().trim() == '') {
                        $('#em1').html('Please Select Status');
                        $('#status').focus();
                        return false;
                    }
                })

                $('#comptype').keydown(function() {
                    $('#em').hide();
                })

                $('#status').change(function() {
                    $('#em1').hide();
                })
            })
        </script>
        <script>
        $(document).ready(function() {
            $('#comptype').change(function() {
                let name = $("#comptype").val();
                $.ajax({
                    url:'check_complaintype.php',
                    data: {'complaintype': name},
                    type: 'POST',
                    success: function(res) {
                        if(res > 0) {
                            alert('complaintype already exist');
                            $("#comptype").focus();
                            $("#comptype").val('');
                            return false;


                        }
                    }
                })
            })
        })

    </script>
</body>

</html>