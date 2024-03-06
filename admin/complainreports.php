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
    <title>Admin / Manage Complain</title>
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

                <span class='btn btn-primary'>Manage Complain / Complain Reports</span>


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
                            <h6 class="mb-4">QUICK SEARCH</h6>
                            <form action="complainreports.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">FROM DATE</label>
                                    <input type="date" class="form-control" id="fromdate" name="from_date" aria-describedby="emailHelp">
                                    <span class="text-danger" id="em1"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">TO DATE</label>
                                    <input type="date" class="form-control" id="todate" name="to_date" aria-describedby="emailHelp">
                                    <span class="text-danger" id="em2"></span>
                                </div>

                                <button type="submit" class="btn btn-primary" id="save">Search</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                            </form>
                        </div>
                    </div>

                </div>


                <!-- table code -->
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">COMPLAIN DETAILS</h6>
                        <div class="table-responsive">
                            <?php
                            if (isset($_POST['from_date']) && isset($_POST['to_date'])) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl No.</th>
                                            <th scope="col">Dept. Name</th>
                                            <th scope="col">Emp. Name</th>
                                            <th scope="col">Complain Type</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Comp. Date</th>
                                            <th scope="col">Comp. Time</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Resolve Date</th>
                                            <th scope="col">Resolve Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT usercomplain.usercomplainid,departmentdetails.department,userdetails.username,complaintype.complaintype,complaintypedescription.complaindesc,itteam.name,userdetails.emailid,usercomplain.complaindt,usercomplain.complaintime,usercomplain.resolvedt,usercomplain.resolvetime,usercomplain.complainstatus FROM usercomplain INNER JOIN departmentdetails ON departmentdetails.deptid = usercomplain.deptid INNER JOIN userdetails ON userdetails.userid = usercomplain.userid INNER JOIN complaintype ON usercomplain.complaintypeid = complaintype.complainid INNER JOIN complaintypedescription ON usercomplain.complaindescid = complaintypedescription.complaindescid INNER JOIN itteam ON usercomplain.itteamid = itteam.itteamid WHERE complaindt BETWEEN '" . $_POST['from_date'] . "' AND '" . $_POST['to_date'] . "'";
                                        $data = $conn->query($query);
                                        $slno = 0;
                                        foreach ($data as $var) {
                                            $slno++;
                                        ?>
                                            <tr class="<?php echo ($var['complainstatus'] == 'Resolve') ? 'table-success' :
                                                            'table-danger'; ?>">
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
                                                    echo $var['complaintype']
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $var['complaindesc']
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                   echo date("d-m-Y", strtotime($var['complaindt']));
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $var['complaintime']
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
                                                    echo ($var['complainstatus'] == 'Resolve') ? date("d-m-Y", strtotime($var['resolvedt']))  : '';
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $var['resolvetime']
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <p class="text-danger text-bold text-center">Enter From Date & To Date to search for complains</p>
                            <?php } ?>
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
                    let name1 = $('#fromdate').val().trim()
                    if ($('#fromdate').val().trim() == '') {
                        $('#em1').html('Please Select Date');
                        $('#fromdate').focus();
                        return false;
                    }


                    let name2 = $('#todate').val().trim()
                    if ($('#todate').val().trim() == '') {
                        $('#em2').html('Please Select Date');
                        $('#todate').focus();
                        return false;
                    }
                })
            })
            $('#fromdate').change(function() {
                $('#em1').hide();
            })

            $('#todate').keydown(function() {
                $('#em2').hide();

            })
        </script>
</body>

</html>