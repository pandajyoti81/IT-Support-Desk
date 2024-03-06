<?php
session_start();
include '../itsupportdb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IT Team Login Form</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?php include "partial/linkfile2.php" ?>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">

                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <!-- msg -->
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
                        <h3 class="text-primary"></i>IT Team Login Form</h3>
                        <h6>Login to our site</h6>
                        <!-- <p>Enter your username and password to login</p> -->
                        <form action="itteamlogincode.php" method="post">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="username" placeholder="username" name="username">
                                <label for="floatingInput">username</label>
                                <span class="text-danger" id="em1"></span>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="pwd" placeholder="password" name="pwd">
                                <label for="floatingPassword">Password</label>
                                <span class="text-danger" id="em2"></span>
                                <input type="checkbox" id="showpassword1"> show password
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                            </div>
                            <button type="submit" id="signin" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <?php include "partial/scriptfile2.php" ?>



    <script>
        $(document).ready(function() {
            $('#signin').click(function() {
                let name1 = $('#username').val().trim()
                if ($('#username').val().trim() == '') {
                    $('#em1').html('Please Enter User Name');
                    $('#username').focus();
                    return false;
                }
                let password = $('#pwd').val().trim();
                if ($('#pwd').val().trim() == '') {
                    $('#em2').html('Please Enter Password');
                    $('#pwd').focus();
                    return false;
                }
            })
        })


        $('#username').keydown(function() {
            $('#em1').hide();
        })

        $('#pwd').keydown(function() {
            $('#em2').hide();
        })
    </script>



    <script>
        $(document).ready(function() {
            $("#showpassword1").click(function() {
                let passwordfield = $("#pwd");
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