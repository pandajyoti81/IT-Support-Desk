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
    <title>Admin/Manage complain</title>
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

                <span class='btn btn-primary'>Manage Complain/Add Complain</span>


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
                            <h6 class="mb-4">ADD NEW COMPLAIN</h6>
                            <form action="insert_usercomplain.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">DEPARTMENT</label>
                                    <select class="form-select mb-3" id="deptname" name="deptname" aria-label="Default    select example">
                                        <option value="">select department</option>
                                        <?php
                                        $dept_query = "SELECT deptid,department,deptstatus FROM departmentdetails WHERE deptstatus = 'Active'";

                                        $res = $conn->query($dept_query);
                                        foreach ($res as $dept) { ?>
                                            <option value="<?php echo $dept['deptid'] ?>"><?php echo $dept['department'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger" id="em"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">EMPLOYEE NAME</label>
                                    <select class="form-select mb-3" id="empname" name="empname" aria-label="Default select example">
                                        <option value="">select employee name</option>
                                    </select>
                                    <span class="text-danger" id="em1"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">EMAIL ID</label>
                                    <select class="form-select mb-3" id="empemail" name="empemail" aria-label="Default select example">
                                        <option value="">select email id</option>
                                    </select>
                                    <span class="text-danger" id="em2"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">COMPLAIN TYPE</label>
                                    <select class="form-select mb-3" id="comptype" name="comptype" aria-label="Default select example">
                                        <option value="">select complain type</option>
                                        <?php
                                        $complain_query = "SELECT complainid,complaintype,complainstatus FROM complaintype WHERE complainstatus = 'Active'";

                                        $res = $conn->query($complain_query);
                                        foreach ($res as $comp) { ?>
                                            <option value="<?php echo $comp['complainid'] ?>"><?php echo $comp['complaintype'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger" id="em3"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">COMPLAIN DESCRIPTION</label>
                                    <select class="form-select mb-3" id="compdesc" name="compdesc" aria-label="Default select example">
                                        <option value="">select complain description</option>
                                    </select>
                                    <span class="text-danger" id="em4"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">FORWARD COMPLAIN TO</label>
                                    <select class="form-select mb-3" id="fct" name="fct" aria-label="Default select example">
                                        <option value="">select employee name</option>
                                        <?php
                                        $fwd_query = "SELECT itteamid,username,password,name,mobile,emailid,status FROM itteam WHERE status = 'Active'";

                                        $res = $conn->query($fwd_query);
                                        foreach ($res as $fwdcomp) { ?>
                                            <option value="<?php echo $fwdcomp['itteamid'] ?>"> <?php echo $fwdcomp['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger" id="em5"></span>
                                </div>
                                <button type="submit" class="btn btn-primary" id="save" name="save">Save</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
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


            <!-- Back to Top
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div> -->

            <!-- JavaScript ../assets/Libraries -->
            <?php include "partial/scriptfile.php" ?>
            <!-- validation -->
            <script>
                $(document).ready(function() {
                    $('#save').click(function() {
                        let name = $('#deptname').val().trim()
                        if ($('#deptname').val().trim() == '') {
                            $('#em').html('Select Department');
                            $('#deptname').focus();
                            return false;
                        }
                        let name1 = $('#empname').val().trim()
                        if ($('#empname').val().trim() == '') {
                            $('#em1').html('Select Employee Name');
                            $('#empname').focus();
                            return false;
                        }
                        let name2 = $('#empemail').val().trim()
                        if ($('#empemail').val().trim() == '') {
                            $('#em2').html('Select Email');
                            $('#empemail').focus();
                            return false;
                        }
                        let name3 = $('#comptype').val().trim()
                        if ($('#comptype').val().trim() == '') {
                            $('#em3').html('Select Complain Type');
                            $('#comptype').focus();
                            return false;
                        }
                        let name4 = $('#compdesc').val().trim()
                        if ($('#compdesc').val().trim() == '') {
                            $('#em4').html('Select Complain Description');
                            $('#compdesc').focus();
                            return false;
                        }
                        let name5 = $('#fct').val().trim()
                        if ($('#fct').val().trim() == '') {
                            $('#em5').html('Whom You Want To Forward');
                            $('#fct').focus();
                            return false;
                        }
                    })

                    $('#dept').change(function() {
                        $('#em').hide();
                    })
                    $('#empname').change(function() {
                        $('#em1').hide();
                    })
                    $('#empemail').change(function() {
                        $('#em2').hide();
                    })
                    $('#comptype').change(function() {
                        $('#em3').hide();
                    })
                    $('#compdesc').change(function() {
                        $('#em4').hide();
                    })
                    $('#fct').change(function() {
                        $('#em5').hide();
                    })

                })
            </script>

            <script>
                $(document).ready(function() {

                    $('#deptname').change(function() {
                        // alert('hi');
                        var name = $("#deptname").val();
                        // console.log(name);

                        $.ajax({
                            url: 'fetch_employee.php',
                            data: {
                                'department': name
                            },
                            type: 'POST',
                            success: function(res) {
                                if (res) {
                                    $("#empname").empty().append(res);
                                }
                            },
                        });
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('#empname').change(function() {
                        var name = $("#empname").val();

                        $.ajax({
                            url: 'fetch_email.php',
                            data: {
                                'username': name
                            },
                            type: 'POST',
                            success: function(res) {
                                if (res) {
                                    $("#empemail").empty().append(res);
                                }
                            },
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#comptype').change(function() {
                        var name = $("#comptype").val();

                        $.ajax({
                            url: 'fetch_description.php',
                            data: {
                                'complaintype': name
                            },
                            type: 'POST',
                            success: function(res) {
                                if (res) {
                                    $("#compdesc").empty().append(res);
                                }
                            },
                        });
                    });
                });
            </script>
</body>

</html>