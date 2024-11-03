<?php
    $this->title = 'Profile';
?>

<!-- ============== TITLE START ============== -->
  <div class="mysecondary-color my-fs-6 fw-bold"><h1>Profile</h1></div>
  <!-- ============== TITLE END   ============== -->

  <div class="container">
    <?php include 'customer/modals/messageModal.php' ?>
    <div class="row m-5">
        <div class="col-lg-6 col-md-6 col-xl-6 mb3">
            <div class="card primarycard h-100 p-4">
                <h4 class="  myprimary-color mb-3 mt-1"><b>User Info</b></h4>
                <div class="text-center mb-4">

                    <i class="bi bi-person-circle display-1 myprimary-color" style="font-size: 120px;"></i>
                </div>
                <form id="/update_user" action="/update_user">
                    <div class="row" class="mb-3">
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="firstname" class=" mytext-color">First Name</label>
                            <input type="text" name="id" id="id" class="form-control" hidden required>
                            <input type="text" name="firstname" id="firstname" class="form-control" required>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="lastname" class=" mytext-color">Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" required>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="email" class=" mytext-color">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <button type="button" class="btn my-btn float-lg-end  p-2 fs-5 fw-bold myborder-radius" id="update_profile">Update</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xl-6 mb3">
            <div class="card primarycard h-100 p-4">
                <h4 class="  myprimary-color mb-3 mt-1"><b>Change Password</b></h4>
                <div class="text-center mb-4">
                    <i class="bi bi-person-gear display-1  myprimary-color" style="font-size: 120px;"></i>
                </div>
                <form id="updatePassForm" action="/update_password">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="old_password" class=" mytext-color">Old Password</label>
                            <input type="password" name="old_password" id="old_password" class="form-control" required>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="new_password" class=" mytext-color">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="confirm_new_password" class=" mytext-color">New Password</label>
                            <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" required>
                        </div>
                        
                    </div>
                    <button type="button" class="btn my-btn float-lg-end  p-2 fs-5 fw-bold myborder-radius" id="update_password">Update</button>
                </form>
            </div>
        </div>
        
    </div> <!-- END OF CARD -->



  </div>
  <script src="DataTables/jquery-3.7.0.min.js"></script>
<script src="DataTables/datatables.min.js"></script>
<script src="DataTables/Responsive-2.5.0/js/dataTables.responsive.min.js"></script>
<script src="DataTables/Buttons-2.4.1/js/dataTables.buttons.min.js"></script>
<script src="DataTables/Buttons-2.4.1/js/buttons.html5.min.js"></script>
<script src="DataTables/JSZip-3.10.1/jszip.min.js"></script>
<script src="DataTables/pdfmake-0.2.7/pdfmake.js"></script>
<script src="DataTables/pdfmake-0.2.7/vfs_fonts.js"></script>
<script src="js/user.js"></script>