<div class="modal fade" id="addSandsModal" tabindex="-1" aria-labelledby="addSandsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="addSandsModalLabel">Add New Product Types</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="/store_products" action="/store_products " name="add_sand">
                        <div class="row ">
                            <i class="bi bi-folder-plus myprimary-color display-1 text-center" style="font-size: 200px;"></i>
                            <div class="col-lg-6 col-md-6">
                                <label for="category" class=" mytertiary-color">Category</label>
                                <input type="text" name="category" class="form-control" id="category" value="Sand" autocomplete="off" disabled>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 ">
                                <label for="contact" class=" mytertiary-color">Types</label>
                                <input type="text" name="types" class="form-control" id="types" autocomplete="off" required>
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn my-btn myborder-radius" id="addNewSand">Submit</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Customer Modal -->
<div class="modal fade" id="editSandsModal" tabindex="-1" aria-labelledby="editSandsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="editSandsModalLabel">Edit Sand Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="editSandsForm">
                        <div class="row ">
                            <i class="bi bi-pencil-square myprimary-color display-1 text-center" style="font-size: 200px;"></i>
                            <div class="col-lg-6 col-md-6">
                                <label for="fullname" class=" mytertiary-color">Category</label>
                                <input type="text" name="editSands" class="form-control" id="editSands" value="Sand" disabled>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 ">
                                <label for="contact" class=" mytertiary-color">Types</label>
                                <input type="text" name="editTypes" id="editTypes" class="form-control" required>
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn my-btn myborder-radius" id="saveEditedSands">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Customer Modal -->
<div class="modal fade" id="deleteSandsModal" tabindex="-1" aria-labelledby="deleteSandsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="deleteSandsModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p class="mysecondary-color">Are you sure you want to delete this product?</p>
                <p class=" text-danger mb-0">NOTE: This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger myborder-radius" id="confirmDeleteSand">Delete</button>
            </div>
        </div>
    </div>
</div>