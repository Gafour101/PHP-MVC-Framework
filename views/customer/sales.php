
<?php include 'modals/salesModal.php'; ?>
<div id="sales" class="card primarycard h-100 p-4">
    <div class=" justify-content-between d-flex flex-row mt-1 mb-3">
        <div class="flex-column"><h2 class=" myprimary-color"><b>Sales Transaction</b></h2></div>
        
        <div class="flex-column">
            <a href="#add_sales_link" class="btn my-btn mt-1 myprimary-color myborder-radius btn-sm  float-end"><b><i class="bi bi-plus-lg"></i></b></a>
        </div>
    </div>
    
    <div class="row mt-2">
        <div class=" myprimary-color transaction-content mt-2">
            <table id="salesTodayTable" class=" mysecondary-color display nowrap w-100 text-center">
                <thead>
                    <tr>
                        <th class=" text-center myprimary-color"> #</th>
                        <th class=" text-center myprimary-color">Name</th>
                        <th class=" text-center myprimary-color">Category</th>
                        <th class=" text-center myprimary-color">Types</th>
                        <th class=" text-center myprimary-color">Quantity</th>
                        <th class=" text-center myprimary-color">Receipt</th>
                        <th class=" text-center myprimary-color">Remarks</th>
                        <th class=" text-center myprimary-color">Amount</th>
                        <th class=" text-center myprimary-color">Date & Time</th>
                        <th class=" text-center myprimary-color">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div> <!-- END OF ROW -->
</div> <!-- END OF CARD -->

