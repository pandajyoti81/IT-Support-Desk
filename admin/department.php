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
    <title>Admin/Department</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="de scription">

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

                <span class='btn btn-primary'>Manage Users / Department</span>


                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item">
                        <a href="logoutadmin.php" class="nav-link">
                            <i class="fa fa-lock"></i><span class="d-none d-lg-inline-flex">Log Out</span>
                        </a>
                    </div>

                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Message -->
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


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">CREATE DEPARTMENT</h6>
                            <form action="insert_dept.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">DEPARTMENT NAME</label>
                                    <input type="text" class="form-control" id="deptname" name="deptname" aria-describedby="emailHelp">

                                    <span class="text-danger" id="em"></span>
                                </div>

                                <button type="submit" class="btn btn-primary" id="save" name="save">Save</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                                
                            </form>
                        </div>
                    </div>
                </div>


                <!-- table code -->
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                    <form action="multidept_delete.php" method="post" id="deleteform">
                        <div class="row">
                            <div class="col-6"> <h6 class="mb-4">DEPARTMENT DETAILS</h6></div>
                            <div class="col-6">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure to delete the record ?');" name="multidelete" style="margin-left: 405px;">DELETE</button>  
                            </div>
                        </div>
                                             
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><input type="checkbox" id="selectallcheckbox"></th>
                                        <th scope="col">Sl no.</th>
                                        <th scope="col">Dept. Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $query = "SELECT deptid,department,deptstatus FROM `departmentdetails`  ORDER BY deptid DESC";

                                    $res = $conn->query($query);
                                    $sl = 1;
                                    foreach ($res as $var) { ?>
                                        <tr>
                                        <td><input type="checkbox" class="deptcheckbox" name="deptcheckbox[]" value="<?php echo $var['deptid'] ?>"> </td>
                                        
                                            <th scope="row"><?php echo $sl++ ?></th>
                                            <td><?php echo $var['department'] ?></td>
                                            <td>
                                                <?php
                                                if ($var['deptstatus'] == 'Active') { ?>
                                                    <span class="btn btn-success">Active</span>
                                                <?php } else { ?>
                                                    <span class="btn btn-danger">Inactive</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="editdepartment.php?id=<?php echo $var['deptid'] ?>"><i class="fa-solid fa-pencil"></i>
                                                    <a href="delete_department.php?id=<?php echo $var['deptid'] ?>" onclick="return confirm('Are You sure to Delete?')">
                                                        <i class="fa-solid fa-trash-can"></i>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                            <!-- <button type="submit" onclick="return confirm('Are you sure to delete the record ?');" class="btn btn-primary" name="multidelete">DELETE</button> -->
                            </form>
                        </div>
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

    <!-- Validation -->
    <script>
        $(document).ready(function() {
            $('#save').click(function() {
                var name = $('#deptname').val().trim();
                if ($('#deptname').val().trim() == '') {
                    $('#em').html('Please Enter Department');
                    $('#deptname').focus();
                    return false;
                }
            })

            $('#deptname').keydown(function() {
                $('#em').hide();
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#selectallcheckbox').change(function() {
                $('.deptcheckbox').prop('checked', $(this).prop('checked'));
            });

            $('#selectedbtn').click(function () {
                let checkbox = $('.deptcheckbox:checked');
                if (checbox.length > 0) {
                    $('#deleteform').submit();
                } else {
                    alert("please select at least one row to delete");
                }
                });
            });
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