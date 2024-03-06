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

                <span class='btn btn-primary'>Manage Users / IT Team Details</span>


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


                <!-- table code -->
                <div class="col-12">
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
                        <div class="row">
                            <div class="col-6">
                                <h6 class="mb-4">IT TEAM DETAILS</h6>
                            </div>
                            <div class="col-6">
                                <form action="multiitteam_delete.php" method="post" id="deleteform">
                                    <div class="row">
                                        <div class="col-8">
                                            <a href="additteam.php" type="submit" class="btn btn-primary" id="save" style="margin-left: 175px;">ADD IT TEAM</a>
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" onclick="return confirm('Are you sure to delete the record ?')" class="btn btn-primary" name="multiitteamdelete" style="margin-left: 40px;">DELETE</button>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        
                        
                            <div class="table-responsive">
                                <table class="table">
                                
                                <form action="additteam.php" method="get">
                                    <thead>
                                        <tr>
                                            <th scope="col"><input type="checkbox" id="selectallcheckbox"></th>
                                            <th scope="col">Sl No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Mob no.</th>
                                            <th scope="col">Email Id</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT itteam.itteamid,itteam.name,itteam.username,itteam.password,itteam.mobile,itteam.emailid,itteam.status FROM itteam ";
                                        $data = $conn->query($query);
                                        $slno = 0;
                                        foreach ($data as $var) { 
                                        $slno++;
                                        ?>
                                            <tr>
                                            <td><input type="checkbox" class="itteamcheckbox" name="itteamcheckbox[]" value="<?php echo $var['itteamid'] ?>"> </td> 
                                                <td>
                                                    <?php
                                                    echo $slno;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $var['name']
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $var['username']
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $var['password']
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
                                                    <?php
                                                    if ($var['status'] == 'Active') { ?>
                                                        <span class="text-success">Active</span>
                                                    <?php } else { ?>
                                                        <span class="text-danger">Inactive</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="edititteam.php?id=<?php echo $var['itteamid'] ?>"><i class="fa-solid fa-pencil"></i>
                                                        <a href="delete_itteam.php?id=<?php echo $var['itteamid'] ?>" onclick="return confirm('Are You sure to Delete?')"><i class="fa-solid fa-trash-can"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!-- <button type="submit" onclick="return confirm('Are you sure to delete the record ?');" class="btn btn-primary" name="multiitteamdelete">DELETE</button> -->
                                </form>
                                <!-- <a href="additteam.php" class="btn btn-primary" id="save">ADD IT TEAM</a> -->
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
                    $('.itteamcheckbox').prop('checked', $(this).prop('checked'));
                });

                $('#selectedbtn').click(function() {
                    let checkbox = $('.itteamcheckbox:checked');
                    if (checkbox.length > 0) {
                        $('#deleteform').submit();
                    } else {
                        alert("please select at least one row to delete");
                    }
                });
            });
        </script>
        
</body>

</html>