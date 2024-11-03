<?php include 'modals/customerModals.php'; ?>

<div class="card primarycard h-100 p-4">
    <div class=" justify-content-between d-flex flex-row mt-1 mb-3">
        <div class="flex-column"><h2 class=" myprimary-color"><b>Customers</b></h2></div>
        <div class="flex-column"><button type="button" id="add-customer" class="btn my-btn mt-1 add-customer myprimary-color myborder-radius btn-sm  float-end"><b><i class="bi bi-person-plus-fill fw-bold"></i></b></button></div>
    </div>
    
    <div class="row mt-2">
        <div class=" myprimary-color transaction-content mt-2">
            <table id="customersTable" class=" mysecondary-color display nowrap w-100 text-center">
                <thead>
                    <tr>
                        <th class=" text-center myprimary-color">#</th>
                        <th class=" text-center myprimary-color">Name</th>
                        <th class=" text-center myprimary-color">Contact</th>
                        <th class=" text-center myprimary-color">Address</th>
                        <th class=" text-center myprimary-color">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div> <!-- END OF ROW -->
</div> <!-- END OF CARD -->


