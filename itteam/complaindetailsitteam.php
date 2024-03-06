<?php
session_start();
if (!isset($_SESSION['itid'])) {
    header("location:../file/ITteamlogin.php");
    exit();
}
include '../itsupportdb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IT_Team / Manage</title>
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

                <span class='btn btn-primary'>Manage / Complain Details</span>


                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item">
                        <a href="logoutitteam.php" class="nav-link">
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
                        <div class="table-responsive">
                        <form action="multicomplain_delete.php" method="post" id="deleteform">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No.</th>
                                        <th scope="col">Department Name</th>
                                        <th scope="col">Employee Name</th>
                                        <th scope="col">Complain Type</th>
                                        <th scope="col">Desc.</th>
                                        <th scope="col">Comp. Date</th>
                                        <th scope="col">Comp. Time</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Res. Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col"><input type="checkbox" id="selectallcheckbox"></th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT usercomplain.usercomplainid,departmentdetails.department,userdetails.username,complaintype.complaintype,complaintypedescription.complaindesc,itteam.name,userdetails.emailid,usercomplain.complaindt,usercomplain.complaintime,usercomplain.resolvedt,usercomplain.resolvetime,usercomplain.complainstatus FROM usercomplain INNER JOIN departmentdetails ON departmentdetails.deptid = usercomplain.deptid INNER JOIN userdetails ON userdetails.userid = usercomplain.userid INNER JOIN complaintype ON usercomplain.complaintypeid = complaintype.complainid INNER JOIN complaintypedescription ON usercomplain.complaindescid  = complaintypedescription.complaindescid INNER JOIN itteam ON usercomplain.itteamid = itteam.itteamid WHERE usercomplain.itteamid=" . $_SESSION['itid'];
                                    $data = $conn->query($query);
                                    $slno = 0;
                                    foreach ($data as $var) {
                                        $slno++;
                                    ?>
                                        <tr class="<?php echo ($var['complainstatus'] == 'Resolve') ? 'table-success' : 'table-danger'; ?>">
                                        
                                            <td>
                                                <?php
                                                echo $slno;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $var['department'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $var['username'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $var['complaintype'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $var['complaindesc'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                               echo date("d-m-Y", strtotime($var['complaindt']));
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $var['complaintime'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($var['complainstatus'] == 'Resolve') { ?>
                                                    <span class="text-success">Resolve</span>
                                                <?php } else { ?>
                                                    <span class="text-danger">Pending</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo ($var['complainstatus'] == 'Resolve') ? date("d-m-Y", strtotime($var['resolvedt'])) : '';
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo ($var['complainstatus'] == 'Resolve') ? $var['resolvetime'] : '';
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($var['complainstatus'] != 'Resolve') {
                                                ?>
                                                   <input type="checkbox" class="itcomplaincheckbox" name="itcomplaincheckbox[]" value="<?php echo $var['usercomplainid'] ?>">
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($var['complainstatus'] == 'Resolve') { ?>
                                                <?php } else{ ?>
                                                    <a href="updatecomplaindetails.php?id=<?= $var['usercomplainid'] ?>" type="submit" class="btn btn-primary">Resolve</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <button type="submit" onclick="return confirm('Are you sure to resolve the record?')" name="multicomplain" class="btn btn-primary">RESOLVE</button>
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
                $('#selectallcheckbox').change(function() {
                    $('.itcomplaincheckbox').prop('checked', $(this).prop('checked'));
                });

                $('#selectedbtn').click(function() {
                    let checkbox = $('.itcomplaincheckbox:checked');
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