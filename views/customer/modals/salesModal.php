<!-- View Customer Modal -->
<div class="modal fade" id="viewSalesModal" tabindex="-1" aria-labelledby="viewSalesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content myborder-radius primarycard">
            <div class="modal-header myborder-radius">
                <h5 class="modal-title myprimary-color" id="viewSalesModalLabel">Sale Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div id="salesDetails">
                    <h5 class=" mysecondary-color m-2">Customer Details</h5>
                    <div class="text-center">
                        <i class="bi bi-person-circle myprimary-color display-3 mb-3" style="font-size: 100px;"></i>
                        <h4 id="salesFullname" class="myprimary-color mb-0 mt-3"></h4>
                        <p class=" mytertiary-color mt-0"> Customer's Name</p>
                    </div>
                    
                    <div class=" m-3 text-center">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="contact" class=" mytertiary-color">Contact Number</label>
                                <div id="salesContact" class="myprimary-color"></div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="contact" class=" mytertiary-color">Complete Address</label>
                                <div id="salesAddress" class="myprimary-color"></div>
                            </div>
                        </div>
                    </div>
                    <hr class=" mysecondary-color ">
                    <h5 class=" mysecondary-color m-2 mb-3">Order Details</h5>
                    <div class="row text-center">
                        <i class="bi bi-receipt-cutoff myprimary-color display-3 mb-3" style="font-size: 100px;"></i>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="category" class=" mytertiary-color">Category</label>
                            <div id="salesCategory" class="myprimary-color"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="types" class=" mytertiary-color">Types</label>
                            <div id="salesTypes" class="myprimary-color"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="types" class=" mytertiary-color">Quantity</label>
                            <div id="salesQuantity" class="myprimary-color"></div>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="receipt" class=" mytertiary-color">Receipt</label>
                            <div id="salesReceipt" class="myprimary-color"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="remarks" class=" mytertiary-color">Remarks</label>
                            <div id="salesRemarks" class="myprimary-color"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <label for="date" class=" mytertiary-color">Date & Time</label>
                            <div id="salesDate" class="myprimary-color"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Customer Modal -->
<div class="modal fade" id="editSalesModal" tabindex="-1" aria-labelledby="editSalesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="editSalesModalLabel">Edit Sale Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="text-center mb-3">
                        <i class="bi bi-receipt-cutoff myprimary-color display-3 mb-3 " style="font-size: 100px;"></i>  
                    </div>
                    
                    <form id="editSalesForm">
                        
                        <div class="row mb-3">

                            <div class="col-lg-4 col-md-4">
                                <label for="editSalesCategory" class=" mytertiary-color">Category</label>
                                <select name="editSalesCategory" id="editSalesCategory" class="form-select" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="Sand">Sand</option>
                                    <option value="Gravel">Gravel</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 ">
                                <label for="editSalesTypes" class=" mytertiary-color">Types</label>
                                <select name="editSalesTypes" id="editSalesTypes" class="form-select" required>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 ">
                                <label for="editSalesQuantity" class=" mytertiary-color">Quantity</label>
                                <input type="text" name="editSalesQuantity" class="form-control" id="editSalesQuantity" required>
                            </div>

                        </div>

                        <div class="row mb-3">
                            
                            
                            <div class="col-lg-4 col-md-4 ">
                                <label for="editSalesQuantity" class=" mytertiary-color">Receipt</label>
                                <input type="text" name="editSalesReceipt" class="form-control" id="editSalesReceipt" required>
                            </div>

                            <div class="col-lg-8 col-md-8 ">
                                <label for="editSalesQuantity" class=" mytertiary-color">Remarks</label>
                                <input type="text" name="editSalesRemarks" class="form-control" id="editSalesRemarks" required>
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn my-btn myborder-radius" id="saveEditedSales">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Customer Modal -->
<div class="modal fade" id="deleteSalesModal" tabindex="-1" aria-labelledby="deleteSalesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="deleteSalesModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p class="mysecondary-color">Are you sure you want to delete this sale? <br></p>
                <p class=" text-danger mb-0">NOTE: This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger myborder-radius" id="confirmDeleteSales">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("editSalesCategory").addEventListener("change", function() {
        var selectedProduct = this.value;
        console.log("Selected Product:", selectedProduct);

        var typesSelect = document.getElementById("editSalesTypes");
        typesSelect.innerHTML = '<option value="" selected disabled>Select</option>';
        
        var productTypes = <?php echo isset($productTypes) ? json_encode($productTypes) : '{}'; ?>;
        var selectedProductTypes = productTypes[selectedProduct] || [];

        for (var i = 0; i < selectedProductTypes.length; i++) {
            var option = document.createElement("option");
            option.value = selectedProductTypes[i];
            option.text = selectedProductTypes[i];
            typesSelect.appendChild(option);
        }
        
    });

    
</script>