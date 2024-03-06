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
    <title>Admin/Manage_users</title>
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

                <span class='btn btn-primary'>Manage Users / Edit Department</span>


                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item">
                        <a href="logoutadmin.php" class="nav-link">
                            <i class="fa fa-lock"></i><span class="d-none d-lg-inline-flex">Log Out</span>
                        </a>
                    </div>

                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Fetching department data w.r.t id -->
            <?php 
             $query = "SELECT deptid,department,deptstatus FROM `departmentdetails` WHERE deptid = '".$_GET['id']."' ";
             
             $res = $conn->query($query);

             foreach($res as $var){
              $dept= $var['department'];
              $status = $var['deptstatus'];
             }
            //  var_dump($dept);exit;
            ?>
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">EDIT DEPARTMENT</h6>
                            <form action="update_department.php" method="post" >
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">DEPARTMENT NAME</label>
                                    <input type="text" class="form-control" id="deptname" name="deptname" aria-describedby="emailHelp" value="<?php echo $dept ?>">
                                    <span class="text-danger" id="em"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">STATUS</label>
                                    <select class="form-select mb-3" id="sts" name="sts" aria-label="Default select example">
                                        <option value="">select status</option>
                                        <option value="Active" <?php echo( $status == 'Active') ? 'selected' : '' ?>>Active</option>
                                        <option value="Inactive" <?php echo( $status == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <span class="text-danger" id="emm"></span>
                                </div>
                                <input type="hidden" name="deptid" value="<?php echo $_GET['id'] ?>"/>
                               
                                <button type="submit" id="update1" class="btn btn-primary">Update</button>
                                <a href="department.php" class="btn btn-primary">Cancel</a>
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
            <!-- <a href="editdepartment.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div> -->

        <!-- JavaScript ../assets/Libraries -->
        <?php include "partial/scriptfile.php" ?>
        <!-- validation -->
        <script>
            $(document).ready(function() {
                $('#update1').click(function() {
                    let name1 = $('#deptname').val().trim()
                    if ($('#deptname').val().trim() == '') {
                        $('#em').html('Please Select Dept');
                        $('#deptname').focus();
                        return false;
                    }

                    let name2 = $('#sts').val().trim()
                    if ($('#sts').val().trim() == '') {
                        $('#emm').html('Please Select Status');
                        $('#sts').focus();
                        return false;
                    }

                })

                $('#deptname').keydown(function() {
                    $('#em').hide();
                })
                
                $('#sts').change(function() {
                    $('#emm').hide();
            })
            })
        </script>
        <script>
        $(document).ready(function() {
            $('#deptname').change(function() {
                let name = $("#deptname").val();
                $.ajax({
                    url:'check_department.php',
                    data: {'department': name},
                    type: 'POST',
                    success: function(res) {
                        if(res > 0) {
                            alert('Department name already exist');
                            $("#deptname").focus();
                            $("#deptname").val('');
                            return false;


                        }
                    }
                })
            })
        })

    </script>
</body>

</html>