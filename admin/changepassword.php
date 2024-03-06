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
    <title>Admin/ My Settings</title>
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

                <span class='btn btn-primary'>My settings / Change Password</span>


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

                            if (isset($_SESSION['wm'])) { ?>
                                <div class="alert alert-danger">
                                    <strong>Failed!</strong> <?php echo $_SESSION['wm'];
                                                                unset($_SESSION['wm']); ?>
                                </div>
                            <?php } ?>
                            <h6 class="mb-4">CHANGE PASSWORD</h6>
                            <form action="update_adminpassword.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">OLD PASSWORD</label>
                                    <input type="password" class="form-control" id="opass" name="opass" aria-describedby="emailHelp">
                                    <span class="text-danger" id="em1"></span>
                                    <input type="checkbox" id="showpassword1" name="showpassword1"> show password
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">NEW PASSWORD</label>
                                    <input type="password" class="form-control" id="npass" name="npass" aria-describedby="emailHelp">
                                    <span class="text-danger" id="em2"></span>
                                    <input type="checkbox" id="showpassword2" name="showpassword2"> show password
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">CONFIRM PASSWORD</label>
                                    <input type="password" class="form-control" id="cpass" name="cpass" aria-describedby="emailHelp">
                                    <span class="text-danger" id="em3"></span>
                                    <input type="checkbox" id="showpassword3" name="showpassword3"> show password

                                    <div style="margin-top: 7px;" id="checkpasswordmatch" name="checkpasswordmatch"></div>
                                </div>
                                <button type="submit" id="update" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-primary">Cancel</button>
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


            <!-- Back to Top -->
            <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div> -->

            <!-- JavaScript ../assets/Libraries -->
            <?php include "partial/scriptfile.php" ?>
            <!-- validation -->
            <script>
                $(document).ready(function() {
                    $('#update').click(function() {
                        let opassword = $('#opass').val().trim();
                        if ($('#opass').val().trim() == '') {
                            $('#em1').html('Enter Old Password');
                            $('#opass').focus();
                            return false;
                        }
                        let npassword = $('#npass').val().trim();
                        if ($('#npass').val().trim() == '') {
                            $('#em2').html('Enter New Password');
                            $('#npass').focus();
                            return false;
                        }
                        let passwordRegex = /^(?=.*[A-Z])(?=.*\d)\w{5}$/;
                        if (!passwordRegex.test(npassword)) {
                            alert('Password should be min 5 characters with at least 1 digit and 1 uppercase letter');
                            return false;
                        }
                        
                        let cpassword = $('#cpass').val().trim();
                        if ($('#cpass').val().trim() == '') {
                            $('#em3').html('Please Confirm New Password');
                            $('#cpass').focus();
                            return false;
                        }
                        let passwordRegex1 = /^(?=.*[A-Z])(?=.*\d)\w{5}$/;
                        if (!passwordRegex.test(cpassword)) {
                            alert('confirm password should be same as new password');
                            return false;
                        }

                        if (npassword !== cpassword) {
                            $('#checkpasswordmatch').html('Passwords do not match!').css('color', 'red');
                            return false;
                        } else {
                            $('#checkpasswordmatch').html('Passwords match!').css('color', 'green');
                            return true;
                        }

                    })

                    $('#opass').keydown('input', function() {
                        $('#em1').hide();
                    })
                    $('#npass').keydown('input', function() {
                        $('#em2').hide();
                    })
                    $('#cpass').keydown('input', function() {
                        $('#em3').hide();
                    })
                    $("#npass").keydown('input', function() {
                        $('cpass').hide();
                    })

                })
            </script>
            <script>
            $(document).ready(function() {
                $("#showpassword1").click(function() {
                    let passwordfield = $("#opass");
                    let passwordfieldtype = passwordfield.attr("type");

                    if (passwordfieldtype === "password") {
                        passwordfield.attr("type", "text");
                    } else {
                        passwordfield.attr("type", "password");
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#showpassword2").click(function() {
                    let passwordfield = $("#npass");
                    let passwordfieldtype = passwordfield.attr("type");

                    if (passwordfieldtype === "password") {
                        passwordfield.attr("type", "text");
                    } else {
                        passwordfield.attr("type", "password");
                    }

                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#showpassword3").click(function() {
                    let passwordfield = $("#cpass");
                    let passwordfieldtype = passwordfield.attr("type");

                    if (passwordfieldtype === "password") {
                        passwordfield.attr("type", "text");
                    } else {
                        passwordfield.attr("type", "password");
                    }

                });
            });
        </script>
</body>

</html>