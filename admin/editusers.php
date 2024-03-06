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

                <span class='btn btn-primary'>Manage Users / Edit Users</span>


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
                            <h6 class="mb-4">EDIT USER</h6>
                            <?php
                            $user_query = "SELECT userid,deptid,username,userip,systemname,mobile,emailid,usercreatedt FROM userdetails WHERE userid=" . $_GET['id'];
                            $res = $conn->query($user_query);
                            foreach ($res as $user) {
                            ?>
                                <form action="update_userdetails.php" method="post">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">DEPARTMENT</label>
                                        <select class="form-select mb-3" id="deptna" name="deptname" aria-label="Default select example">
                                            <!-- <option value="">select department</option> -->
                                            <?php
                                            $dept_query = "SELECT deptid,department,deptstatus FROM departmentdetails WHERE deptstatus = 'Active'";
                                            $res = $conn->query($dept_query);
                                            foreach ($res as $dept) {
                                            ?>
                                                <option value="<?php echo $dept['deptid'] ?>"><?php echo $dept['department'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger" id="emmm"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">EMPLOYEE NAME</label>
                                        <input type="text" class="form-control" id="empname" name="empname" aria-describedby="emailHelp" value="<?php echo $user['username'] ?>">
                                        <span class="text-danger" id="em1"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">EMPLOYEE SYSTEM IP ADDRESS</label>
                                        <input type="text" class="form-control" id="esia" name="esia" aria-describedby="emailHelp" value="<?php echo $user['userip'] ?>">
                                        <span class="text-danger" id="em2"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">SYSTEM NAME</label>
                                        <input type="text" class="form-control" id="sysname" name="sysname" aria-describedby="emailHelp" value="<?php echo $user['systemname'] ?>">
                                        <span class="text-danger" id="em3"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">MOBILE NO.</label>
                                        <input type="text" maxlength="10" class="form-control" id="empmob" name="empmob" onkeypress="return validateNumber(event)" aria-describedby="emailHelp" value="<?php echo $user['mobile'] ?>">
                                        <span class="text-danger" id="em4"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">EMAIL ID</label>
                                        <input type="text" class="form-control" id="empemail" name="empemail" aria-describedby="emailHelp" value="<?php echo $user['emailid'] ?>">
                                        <span class="text-danger" id="em5"></span>
                                    </div>
                                    <input type="hidden" name="userid" value="<?php echo $_GET['id']; ?>" />

                                    <button type="save" id="update" name="update" class="btn btn-primary"> Update </button>
                                    <a href="userdetails.php" type="reset" class="btn btn-primary">Cancel</a>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Form End -->


                <!-- Footer Start -->
                <?php include "partial/footer.php" ?>
                <!-- Footer End -->
            </div>
            <!-- Content End -->


            <!-- Back to Top
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div> -->

            <!-- JavaScript ../assets/Libraries -->
            <?php include "partial/scriptfile.php" ?>
            <!-- validation -->
            <script>
                $(document).ready(function() {
                    $('#update').click(function() {
                        let name1 = $('#deptna').val().trim()
                        if ($('#deptna').val().trim() == '') {
                            $('#emmm').html('Please Select Dept.');
                            $('#deptna').focus();
                            return false;
                        }


                        let name2 = $('#empname').val().trim()
                        if ($('#empname').val().trim() == '') {
                            $('#em1').html('Please Enter Employee Name');
                            $('#empname').focus();
                            return false;
                        }

                        let ipAddress = $("#esia").val();
                        let isValidIPv4 = validateIPv4(ipAddress);
                        let isValidIPv6 = validateIPv6(ipAddress);

                        if (!isValidIPv4 && !isValidIPv6) {
                            $("#em2").text("Invalid IP address");
                            return false;
                        } else {
                            $("#em2").text("");
                        }

                        let name3 = $('#sysname').val().trim()
                        if ($('#sysname').val().trim() == '') {
                            $('#em3').html('Please Enter System Name');
                            $('#sysname').focus();
                            return false;
                        }

                        let mobilenum = $('#empmob').val().trim(); // Trim any leading/trailing spaces
                        console.log(mobilenum);

                        // Adjusted regex pattern for Indian mobile numbers (10 digits without any spaces or special characters)
                        let indianmobilenum = /^\d{10}$/;

                        if (indianmobilenum.test(mobilenum) == false) {
                            // Valid mobile number, return true (allow form submission)
                            //return true;
                            $('#em4').html('Please Enter Valid Mob Num').show();
                            return false; // Prevent form submission
                        }

                        let email = $('#empemail').val().trim();
                        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (emailPattern.test(email) == false) {
                            $('#em5').html('Please enter a valid email address').show();
                            return false;
                        }

                    })

                    function validateIPv4(ipAddress) {
                        let ipv4Regex = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
                        return ipv4Regex.test(ipAddress);
                    }

                    function validateIPv6(ipAddress) {
                        let ipv6Regex = /^([0-9a-fA-F]{1,4}:){7}[0-9a-fA-F]{1,4}$/;
                        return ipv6Regex.test(ipAddress);
                    }

                    $('#deptna').change(function() {
                        $('#emmm').hide();
                    })

                    $('#empname').keydown(function() {
                        $('#em1').hide();

                    })

                    $('#esia').keydown(function() {
                        $('#em2').hide();

                    })

                    $('#sysname').keydown(function() {
                        $('#em3').hide();
                    })

                    $('#empmob').on('input', function() {
                        $('#em4').hide();
                    })

                    $('#empemail').on('input', function() {
                        $('#em5').hide();
                    })

                })
                // validation end
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
                        $('#empmob').change(function() {
                            let name = $("#empmob").val();
                            $.ajax({
                                url: 'check_usermob.php',
                                data: {
                                    'mobile': name
                                },
                                type: 'POST',
                                success: function(res) {
                                    if (res > 0) {
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
                                url: 'check_useremail.php',
                                data: {
                                    'emailid': name
                                },
                                type: 'POST',
                                success: function(res) {
                                    if (res > 0) {
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