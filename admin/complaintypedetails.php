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
    <title>Admin/Complain Type</title>
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

                <span class='btn btn-primary'>Manage Users / Complain Type</span>


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
                            <h6 class="mb-4">ADD COMPLAIN TYPE</h6>
                            <form action="insert_complaintypedetails.php" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">COMPLAIN TYPE</label>
                                    <input type="text" class="form-control" id="comptype" name="comptype" aria-describedby="emailHelp">
                                    <span class="text-danger" id="em"></span>
                                </div>
                                <button type="submit" class="btn btn-primary" id="save">Save</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- table code -->
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="mb-4">COMPLAIN TYPE DETAILS</h6>
                            </div>
                            <div class="col-6">
                                <form action="multicomplaintype_delete.php" method="post" id="deleteform">
                                        <div class="col-4">
                                            <button type="submit" onclick="return confirm('Are you sure to delete the record ?')" class="btn btn-primary" name="multicomplaintype" style="margin-left: 400px;">DELETE</button>
                                        </div>
                               
                            </div>
                        </div>
                         <div class="table-responsive">
                            <table class="table">  
                                <thead>
                                    <tr>
                                        <th scope="col"><input type="checkbox" id="selectallcheckbox" name="selectallcheckbox"></th>
                                        <th scope="col">Sl no.</th>
                                        <th scope="col">Complain type</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT complainid,complaintype,complainstatus FROM complaintype ORDER BY complainid ASC";
                                    $data = $conn->query($query);
                                    $slno = 0;
                                    foreach ($data as $var) {
                                        $slno++;
                                    ?>
                                        <tr>
                                        <td><input type="checkbox" class="complaintypecheckbox" name="complaintypecheckbox[]" value="<?php echo $var['complainid'] ?>"> </td>
                                            <td>
                                                <?php
                                                echo $slno;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $var['complaintype']
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($var['complainstatus'] == 'Active') { ?>
                                                    <span class="text-success">Active</span>
                                                <?php } else { ?>
                                                    <span class="text-danger">Inactive</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="editcomplaintype.php?id=<?php echo $var['complainid'] ?>">
                                                    <i class="fa-solid fa-pencil"></i>
                                                    <a href="delete_complaindetails.php?id=<?php echo $var['complainid'] ?>" onclick="return confirm('Are you sure want to delete the record?')">
                                                        <i class="fa-solid fa-trash"></i>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- <button type="submit" onclick="return confirm('Are you sure to delete the record ?')" class="btn btn-primary" name="multicomplaintype">DELETE</button>   -->
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
                $('#save').click(function() {
                    var name = $('#comptype').val().trim();
                    if ($('#comptype').val().trim() == '') {
                        $('#em').html('Please Enter Complain Type');
                        $('#comptype').focus();
                        return false;
                    }
                })

                $('#comptype').keydown(function() {
                    $('#em').hide();
                })
            })
        </script>
        <script>
            $(document).ready(function() {
                $('#selectallcheckbox').change(function() {
                    $('.complaintypecheckbox').prop('checked', $(this).prop('checked'));
                });

                $('#selectedbtn').click(function() {
                    let checkbox = $('.complaintypecheckbox:checked');
                    if (checkbox.length > 0) {
                        $('#deleteform').submit();
                    } else {
                        alert("please select at least one row to delete");
                    }
                });
            });
        </script>
        <script>
        $(document).ready(function() {
            $('#comptype').change(function() {
                let name = $("#comptype").val();
                $.ajax({
                    url:'check_complaintype.php',
                    data: {'complaintype': name},
                    type: 'POST',
                    success: function(res) {
                        if(res > 0) {
                            alert('complaintype already exist');
                            $("#comptype").focus();
                            $("#comptype").val('');
                            return false;


                        }
                    }
                })
            })
        })

    </script>
</body>

</html>