<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="addCustomerModalLabel">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="add_customer" action="/add_customer " name="add_customer">
                        <div class="row ">
                            <i class="bi bi-person-add myprimary-color display-1 text-center" style="font-size: 200px;"></i>
                            <div class="col-lg-4 col-md-4">
                                <label for="fullname" class=" mytertiary-color">Customer's Name</label>
                                <input type="text" name="addCustomerFullname" class="form-control" id="addCustomerFullname" autocomplete="off" required>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 ">
                                <label for="contact" class=" mytertiary-color">Contact Number</label>
                                <input type="text" name="addCustomerContact" class="form-control" id="addCustomerContact" autocomplete="off" required>
                            </div>

                            <div class="col-lg-4 col-md-4 ">
                                <label for="address" class=" mytertiary-color">Complete Address</label>
                                <input type="text" name="addCustomerAddress" class="form-control" id="addCustomerAddress" autocomplete="off" required>
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn my-btn myborder-radius" id="addNewCustomer">Submit</button>
            </div>
        </div>
    </div>
</div>



<!-- View Customer Modal -->
<div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-labelledby="viewCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content myborder-radius primarycard">
            <div class="modal-header myborder-radius">
                <h5 class="modal-title myprimary-color" id="viewCustomerModalLabel">View Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="customerDetails">
                    <div class="text-center">
                        <i class="bi bi-person-circle myprimary-color display-1" style="font-size: 200px;"></i>
                        <h4 id="customerFullname" class="myprimary-color"></h4>
                    </div>
                    
                    <div class=" m-3 text-center">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="contact" class=" mytertiary-color">Contact Number</label>
                                <div id="customerContact" class="myprimary-color"></div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="contact" class=" mytertiary-color">Complete Address</label>
                                <div id="customerAddress" class="myprimary-color"></div>
                            </div>
                        </div>
                        
                        <div id="update_customer_status" class="alert alert-success myprimary-bg myborder-radius" style="display: none;"></div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="editCustomerModalLabel">Edit Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="editCustomerForm">
                        <div class="row ">
                            <i class="bi bi-person-gear myprimary-color display-1 text-center" style="font-size: 200px;"></i>
                            
                            <div class="col-lg-4 col-md-4">
                                <label for="fullname" class=" mytertiary-color">Customer's Name</label>
                                <input type="text" name="editFullname" class="form-control" id="editCustomerFullname">
                            </div>
                            
                            <div class="col-lg-4 col-md-4 ">
                                <label for="contact" class=" mytertiary-color">Contact Number</label>
                                <input type="text" name="editContact" class="form-control" id="editCustomerContact">
                            </div>

                            <div class="col-lg-4 col-md-4 ">
                                <label for="address" class=" mytertiary-color">Complete Address</label>
                                <input type="text" name="editAddress" class="form-control" id="editCustomerAddress">
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn my-btn myborder-radius" id="saveEditedCustomer">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Customer Modal -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="deleteCustomerModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p class="mysecondary-color">Are you sure you want to delete this customer? <br> Deleting this customer will also delete all of their orders.</p>
                <p class=" text-danger mb-0">NOTE: This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger myborder-radius" id="confirmDeleteCustomer">Delete</button>
            </div>
        </div>
    </div>
</div>