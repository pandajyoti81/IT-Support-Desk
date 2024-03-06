<?php
session_start();
if (!isset($_SESSION['aid'])) {
    header("location:../file/Adminlogin.php");
    exit();
}
include '../itsupportdb.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin/Department</title>
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

                <span class='btn btn-primary'>Manage Users / Edit IT Team</span>


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
                            <h6 class="mb-4">EDIT IT TEAM</h6>
                            <form action="update_itteam.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">EMPLOYEE NAME</label>
                                    <?php
                                    $query = "SELECT name,username,mobile,emailid,createdt,status from itteam where itteamid=" . $_GET["id"];
                                    $data = $conn->query($query);
                                    foreach ($data as $var) {
                                    }
                                    ?>
                                    <input type="text" class="form-control" id="empname" name="empname" aria-describedby="emailHelp" value="<?php echo $var['name'] ?>">
                                    <span class="text-danger" id="em"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">USER NAME</label>
                                    <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp" value="<?php echo $var['username'] ?>">
                                    <span class="text-danger" id="em1"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">EMAIL ID</label>
                                    <input type="text" class="form-control" id="empemail" name="empemail" aria-describedby="emailHelp" value="<?php echo $var['emailid'] ?>">
                                    <span class="text-danger" id="em2"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">MOBILE NO.</label>
                                    <input type="text" class="form-control" maxlength="10" id="empmob" name="empmob" onkeypress="return validateNumber(event)" aria-describedby="emailHelp" value="<?php echo $var['mobile'] ?>">
                                    <span class="text-danger" id="em3"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">STATUS</label>
                                    <select class="form-select mb-3" name="status" id="ss" aria-label="Default select example">
                                        <option value="">select status</option>
                                        <option value="Active" <?php echo ($var['status'] == 'Active') ? 'selected' : '' ?>>Active</option>
                                        <option value="Inactive" <?php echo ($var['status'] == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <span class="text-danger" id="em4"></span>
                                </div>
                                <input type="hidden" name="itteamid" value="<?php echo $_GET['id']; ?>" />

                                <button type="submit" id="update" class="btn btn-primary">Update</button>
                                <a href="itteamdetails.php" type="reset" class="btn btn-primary">Cancel</a>
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
                        let name = $('#empname').val().trim()
                        if ($('#empname').val().trim() == '') {
                            $('#em').html('Please Enter Employee Name');
                            $('#empname').focus();
                            return false;
                        }
                        let name1 = $('#uname').val().trim()
                        if ($('#uname').val().trim() == '') {
                            $('#em1').html('Please Enter System Name');
                            $('#uname').focus();
                            return false;
                        }

                        let email = $('#empemail').val().trim();
                        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (emailPattern.test(email) == false) {
                            $('#em2').html('Please enter a valid email address').show();
                            return false;
                        }

                        let mobilenum = $('#empmob').val().trim();
                        let indianmobilenum = /^\d{10}$/;
                        if (indianmobilenum.test(mobilenum) == false) {
                            $('#em3').html('Please Enter Valid Mob Num').show();
                            return false;
                        }

                        let name2 = $('#ss').val().trim()
                        if ($('#ss').val().trim() == '') {
                            $('#em4').html('Please Select Status');
                            $('#ss').focus();
                            return false;
                        }

                    })

                    $('#empname').keydown(function() {
                        $('#em').hide();
                    })

                    $('#uname').keydown(function() {
                        $('#em1').hide();
                    })

                    $('#empemail').on('input', function() {
                        $('#em2').hide();
                    })

                    $('#empmob').on('input', function() {
                        $('#em3').hide();

                    })

                    $('#ss').change(function() {
                        $('#em4').hide();
                    })

                })
            </script>
            <script>
                function validateNumber(event) {
                    let ac = event.which || event.keyCode;
                    if (!((ac == 127 || ac == 8) || (ac >= 48 && ac <= 57))) {
                        return false;
                    } else {
                        return true;
                    }
                }
            </script>
            <script>
        $(document).ready(function() {
            $('#uname').change(function() {
                let name = $("#uname").val();
                $.ajax({
                    url:'check_itteamuser.php',
                    data: {'username': name},
                    type: 'POST',
                    success: function(res) {
                        if(res > 0) {
                            alert('Username already exist');
                            $("#uname").focus();
                            $("#uname").val('');
                            return false;


                        }
                    }
                })
            })
        })

    </script>
            <script>
        $(document).ready(function() {
            $('#empmob').change(function() {
                let name = $("#empmob").val();
                $.ajax({
                    url:'check_itteammob.php',
                    data: {'mobile': name},
                    type: 'POST',
                    success: function(res) {
                        if(res > 0) {
                            alert('mobile num already exist');
                            $("#empmob").focus();
                            $("#empmob").val('');
                            return false;


                        }
                    }
                })
            })
        })

    </script>
    <script>
        $(document).ready(function() {
            $('#empemail').change(function() {
                let name = $("#empemail").val();
                $.ajax({
                    url:'check_itteamemail.php',
                    data: {'emailid': name},
                    type: 'POST',
                    success: function(res) {
                        if(res > 0) {
                            alert('email already exist');
                            $("#empemail").focus();
                            $("#empemail").val('');
                            return false;


                        }
                    }
                })
            })
        })

    </script>
</body>

</html>