<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="dashboarditteam.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text"><i class=" me-2"></i>IT TEAM</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <!-- <img class="rounded-circle" src="../assets/img/user.jpg" alt="" style="width: 40px; height: 40px;"> -->
                        <!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
                    </div>
                    <div class="ms-3">
                        <!-- <h6 class="mb-0">Jhon Doe</h6> -->
                        <span>
                        <?php
                        $cmd1 = "SELECT username FROM itteam WHERE itteamid= ".$_SESSION['itid'];
                        $data1 = $conn->query($cmd1);
                        foreach($data1 as $var){                  
                    ?>
                    <h6><?php echo $var['username']; ?></h6>
                    <?php } ?>
                        </span>
                    </div>
                </div>
                <div class="navbar-nav w-100">


                    <!-- dashboard -->

                    <div class="nav-item dropdown">
                        <a href="dashboarditteam.php" class="nav-link"><i class="fa-solid fa-gauge"></i></i>Dashboard</a>
                    </div>
                     <!-- Manage Users -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Manage</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="complaindetailsitteam.php" class="dropdown-item">COMPLAIN DETAILS</a>
                            <a href="editprofileitteam.php" class="dropdown-item">EDIT PROFILE</a>
                            <a href="changepassworditteam.php" class="dropdown-item">CHANGE PASSWORD</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->