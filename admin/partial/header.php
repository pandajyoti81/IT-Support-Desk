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
                <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text"><i class=" me-2"></i>ADMIN</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../assets/img/admin2.jpg" alt="" style="width: 50px; height: 50px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">
                        <?php
                        $cmd1 = "SELECT username FROM adminlogin WHERE adminid=" .$_SESSION['aid'];
                        $data1 = $conn->query($cmd1);
                        foreach($data1 as $var){                  
                    ?>
                    <h6><?php echo $var['username']; ?></h6>
                    <?php } ?>
                        </h6>
                     <span>WELCOME</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">


                    <!-- dashboard -->

                    <div class="nav-item dropdown">
                        <a href="dashboard.php" class="nav-link"><i class="fa-solid fa-gauge"></i></i>Dashboard</a>
                    </div>
                     <!-- Manage Users -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Manage Users</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="department.php" class="dropdown-item">Department Details</a>
                            <a href="userdetails.php" class="dropdown-item">User Details</a>
                            <a href="itteamdetails.php" class="dropdown-item">IT Team</a>
                            <a href="complaintypedetails.php" class="dropdown-item">Complain Type Details</a>
                            <a href="complaindescription.php" class="dropdown-item">Complain Description</a>
                        </div>
                    </div>

                    <!-- Manage complains -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-file me-2"></i>Manage Comp</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="usercomplaindetails.php" class="dropdown-item">User Complain</a>
                            <a href="complainreports.php" class="dropdown-item">Complain Reports</a>
                        </div>
                    </div>

                    <!-- My settings -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-cog me-2"></i>My Settings</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="changepassword.php" class="dropdown-item">Change Password</a>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->