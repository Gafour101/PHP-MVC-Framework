<?php 
/** @var $this \gaf\phpmvc\View */
  use gaf\phpmvc\Application; 
  
$this->title = 'Inventory';
?>

<!-- ============== TITLE START ============== -->
  <div class=" d-flex flex flex-row justify-content-between">
    <div class="mysecondary-color flex-column"><h1>Inventory</h1></div>
    <?php include 'inventory/modals/stocksModal.php'; ?>
    <div class="flex-column"><button type="button" id="add-stock" class="btn primary-btn p-2  add-stock myprimary-color myborder-radius btn-sm  mt-1 float-end"><i class="bi bi-plus fw-bold"></i> Add Stocks</button></div>
  </div>
  
<!-- ============== TITLE END   ============== -->
  
    <?php include 'inventory/pills.php'; ?>

<div class="row">
  <?php include 'customer/modals/messageModal.php' ?>
    <div class="col-lg-6 col-md-6 col-xl-6 p-2">
      
      <?php include 'inventory/modals/sandsModal.php'; ?>
      <?php include 'inventory/sands.php'; ?>
    </div>
    <div class="col-lg-6 col-md-6 col-xl-6 p-2">
      <?php include 'inventory/modals/gravelsModal.php'; ?>
      <?php include 'inventory/gravels.php'; ?>
    </div>

</div>

<script src="DataTables/jquery-3.7.0.min.js"></script>
<script src="DataTables/datatables.min.js"></script>
<script src="DataTables/Responsive-2.5.0/js/dataTables.responsive.min.js"></script>
<script src="DataTables/Buttons-2.4.1/js/dataTables.buttons.min.js"></script>
<script src="DataTables/Buttons-2.4.1/js/buttons.html5.min.js"></script>
<script src="DataTables/JSZip-3.10.1/jszip.min.js"></script>
<script src="DataTables/pdfmake-0.2.7/pdfmake.js"></script>
<script src="DataTables/pdfmake-0.2.7/vfs_fonts.js"></script>
<script src="js/inventory.js"></script>
