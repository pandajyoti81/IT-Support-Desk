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
    <title>Admin/Edit_Complain_Description</title>
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

                <span class='btn btn-primary'>Manage Users / Edit Complain Description</span>


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
            if (isset($_SESSION['sm'])) { ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> <?php echo $_SESSION['sm'];
                                                unset($_SESSION['sm']); ?>
                </div>
            <?php }

            if (isset($_SESSION['em'])) { ?>
                <div class="alert alert-danger">
                    <strong>Failed!</strong> <?php echo $_SESSION['em'];
                                                unset($_SESSION['em']); ?>
                </div>
            <?php } ?>
                            <h6 class="mb-4">EDIT COMPLAIN DESCRIPTION</h6>
                            <?php
                            $user_query = "SELECT complaindescid,complaintypeid,complaindesc FROM complaintypedescription WHERE complaindescid=" . $_GET['id'];
                            $res1 = $conn->query($user_query);
                            foreach($res1 as $user){ }
                                ?>
                            <form action="update_complaindescription.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">COMPLAIN TYPE</label>
                                    <select class="form-select mb-3" id="ct" name="comptype" aria-label="Default select example">
                                        <!-- <option value="">select</option> -->
                                        <?php
                                        $comp_query = " SELECT complainid,complaintype,complainstatus FROM complaintype WHERE complainstatus = 'Active'";
                                        $res = $conn->query($comp_query);
                                        foreach($res as $comp){ ?>
                                        <option value="<?php echo $comp['complainid'] ?>" <?php echo ($user['complaintypeid'] == $comp['complainid']) ? 'selected' :'' ?>><?php 
                                        echo $comp['complaintype'] ?></option>
                                        <?php } ?>
                                        
                                    </select>
                                    <span class="text-danger" id="em"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">COMPLAIN DESCRIPTION</label>
                                    <input type="text" class="form-control" id="compdesc" name="compdesc"aria-describedby="emailHelp" value="<?php echo $user['complaindesc']?>">
                                    <span class="text-danger" id="em1"></span>
                                </div>
                                <input type="hidden" name="complainid" value="<?php echo $_GET['id'] ?>"/>

                                <button type="submit" id="update" class="btn btn-primary">Update</button>
                                <a href="complaindescription.php" type="reset" class="btn btn-primary">Cancel</a>
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
                        let name = $('#ct').val().trim()
                        if ($('#ct').val().trim() == '') {
                            $('#em').html('Please Select Complain Type');
                            $('#ct').focus();
                            return false;
                        }

                        let name1 = $('#cd').val().trim();
                        if ($('#cd').val().trim() == '') {
                            $('#em1').html('Please Enter Complain Description');
                            $('#cd').focus();
                            return false;
                        }
                    })

                    $('#ct').change(function() {
                        $('#em').hide();
                    })

                    $('#cd').keydown(function() {
                        $('#em1').hide();
                    })
                })
            </script>
</body>

</html>