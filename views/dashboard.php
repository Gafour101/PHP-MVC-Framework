<?php 
/** @var $this \gaf\phpmvc\View */

  use gaf\phpmvc\Application; 
  // echo '<pre>';
  // var_dump($title);
  // echo '</pre>';
  // exit;

$this->title = 'Dashboard';
?>

<div class="mydashboard">
  
  <!-- ============== TITLE START ============== -->
  <div class="mysecondary-color"><h1>Dashboard</h1></div>
  <!-- ============== TITLE END   ============== -->

  <!-- ============== PILL START ============== -->
  <?php include 'customer/pills.php' ?>
  <!-- ============== PILL END   ============== -->

  <!-- ============== SALES START ============== -->
  <div class="row">
    <!-- ============== TRANSACTIONS START ============== -->
    <?php if (Application::$app->session->getFlash('success')): ?>
        <div class="m-lg-2 mt-0 my-fs-6 p-3 myalert myalert-success">
            <?php echo Application::$app->session->getFlash('success'); ?>
        </div>
      <?php endif; ?>
      <div id="add_sales_link"></div>
    <div class="col-lg-8 col-md-8 col-xl-8 p-2">
      <?php include 'customer/transactions.php' ?>
    </div>
    
    <!-- ============== TRANSACTIONS END ============== -->
    <div  class="col-lg-4 col-md-4 col-xl-4 p-2">
      <?php include 'customer/modals/messageModal.php' ?>
      <?php include 'customer/form.php' ?>
    </div>
    <div class="col-lg-12 col-md-12 col-xl-12 p-2">
      <?php include 'customer/sales.php' ?>
    </div>
  </div>
  <!-- ============== SALES END   ============== -->
  
</div>

<script src="DataTables/jquery-3.7.0.min.js"></script>
<script src="DataTables/datatables.min.js"></script>
<script src="DataTables/Responsive-2.5.0/js/dataTables.responsive.min.js"></script>
<script src="DataTables/Buttons-2.4.1/js/dataTables.buttons.min.js"></script>
<script src="DataTables/Buttons-2.4.1/js/buttons.html5.min.js"></script>
<script src="DataTables/JSZip-3.10.1/jszip.min.js"></script>
<script src="DataTables/pdfmake-0.2.7/pdfmake.js"></script>
<script src="DataTables/pdfmake-0.2.7/vfs_fonts.js"></script>
<script src="js/app.js"></script>
