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
    <title>IT_Team / Dashboard</title>
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

                <span class='btn btn-primary'>DASHBOARD</span>


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
                <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-file fa-3x text-primary"></i>
                            <div class="ms-3">
                            <a href="complaindetailsitteam.php" class="mb-2">COMPLAINTS</a>
                            <br>
                            <br>
                                <?php
                                 $count1 = "SELECT count(*) as complaints FROM usercomplain WHERE itteamid=" . $_SESSION['itid'];
                                 $data1 =  $conn->query($count1);
                                 foreach($data1 as $var){
                                ?>
                                <h6><?php echo $var['complaints']; ?></h6>
                                <?php } ?>
                                <!-- <h6 class="mb-0">4</h6> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-square-check fa-3x text-primary"></i>
                            <div class="ms-3">
                            <a href="complaindetailsitteam.php" class="mb-2">RESOLVED</a>
                            <br>
                            <br>
                                <?php
                                 $count2 = "SELECT count(*) as resolved FROM usercomplain WHERE itteamid='" . $_SESSION['itid']."' AND complainstatus = 'Resolve'";
                                 $data2 =  $conn->query($count2);
                                 foreach($data2 as $var){
                                ?>
                                <h6><?php echo $var['resolved']; ?></h6>
                                <?php } ?>
                                <!-- <h6 class="mb-0">4</h6> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-hourglass-half fa-3x text-primary"></i>
                            <div class="ms-3">
                            <a href="complaindetailsitteam.php" class="mb-2">PENDING</a>
                            <br>
                            <br>
                                <?php
                                 $count3 = "SELECT count(*) as pending FROM usercomplain WHERE itteamid='" . $_SESSION['itid']."' AND complainstatus = 'Pending'";
                                 $data3 =  $conn->query($count3);
                                 foreach($data3 as $var){
                                ?>
                                <h6><?php echo $var['pending']; ?></h6>
                                <?php } ?>
                                <!-- <h6 class="mb-0">4</h6> -->
                            </div>
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
</body>

</html>