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
                <!-- Navbar Content -->
            </nav>
            <!-- Navbar End -->

            <?php if (isset($_SESSION['sm'])) { ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> <?php echo $_SESSION['sm'];
                                                unset($_SESSION['sm']); ?>
                </div>
            <?php } ?>

            <?php if (isset($_SESSION['em'])) { ?>
                <div class="alert alert-danger">
                    <strong>Failed!</strong> <?php echo $_SESSION['em'];
                                                unset($_SESSION['em']); ?>
                </div>
            <?php } ?>

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="mb-4">USER DETAILS</h6>
                            </div>
                            <div class="col-6">
                                <form action="multiuser_delete.php" method="post" id="deleteform">
                                    <div class="row">
                                        <div class="col-8">
                                            <a href="addnewuser.php" type="submit" class="btn btn-primary" id="save" style="margin-left: 175px;">ADD NEW USER</a>
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" onclick="return confirm('Are you sure to delete the record ?')" class="btn btn-primary" name="multiuserdelete" style="margin-left: 40px;">DELETE</button>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <!-- Table Headers -->
                                <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" id="selectallcheckbox"></th>
                                    <th scope="col">Sl No.</th>
                                    <th scope="col">Department Name</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">IP Address</th>
                                    <th scope="col">System Name</th>
                                    <th scope="col">MOB. No.</th>
                                    <th scope="col">Email Id</th>
                                    <th scope="col">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT userdetails.userid,departmentdetails.department,userdetails.username,userdetails.userip,userdetails.systemname,userdetails.mobile,userdetails.emailid,userdetails.status FROM userdetails INNER JOIN departmentdetails ON departmentdetails.deptid = userdetails.deptid WHERE userdetails.status = 'Active'";
                                    $data = $conn->query($query);
                                    $slno = 0;
                                    foreach ($data as $var) {
                                        $slno++;
                                    ?>
                                        <tr>
                                        <td><input type="checkbox" class="usercheckbox" name="usercheckbox[]" value="<?php echo $var['userid']; ?>"></td>
                                        <td>
                                            <?php
                                            echo $slno;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $var['department']
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $var['username']
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $var['userip']
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $var['systemname']
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $var['mobile']
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $var['emailid']
                                            ?>
                                        </td>
                                        <td>
                                            <a href="editusers.php?id=<?php echo $var['userid'] ?>"><i class="fa-solid fa-pencil"></i>
                                                <a href="delete_userdetails.php?id=<?php echo $var['userid'] ?>" onclick="return confirm('Are You sure to Delete?')"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="table-responsive">
                                <!-- Other Content -->
                            </div>
                        </div>
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

        <!-- Validation -->
        <script>
            $(document).ready(function() {
                $('#selectallcheckbox').change(function() {
                    $('.usercheckbox').prop('checked', $(this).prop('checked'));
                });

                $('#selectedbtn').click(function() {
                    let checkbox = $('.usercheckbox:checked');
                    if (checkbox.length > 0) {
                        $('#deleteform').submit();
                    } else {
                        alert("please select at least one row to delete");
                    }
                });
            });
        </script>
    </div>
    <!-- Content End -->
</body>

</html>
