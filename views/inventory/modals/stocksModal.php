<div class="modal fade" id="addStocksModal" tabindex="-1" aria-labelledby="addStocksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content primarycard myborder-radius">
            <div class="modal-header">
                <h5 class="modal-title myprimary-color" id="addStocksModalLabel">Add Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="/add_stock" action="/add_stock " name="add_stock">
                        <div class="row ">
                            <i class="bi bi-folder-plus myprimary-color display-1 text-center" style="font-size: 200px;"></i>
                            <div class="col-lg-6 col-md-6">
                                <label for="category" class=" mytertiary-color">Category</label>
                                <select name="stock_category" id="stock_category" class="form-select" required>
                                    <option value="" selected disabled>Select option</option>
                                    <option value="1">Sand</option>
                                    <option value="2">Gravel</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 ">
                                <label for="contact" class=" mytertiary-color">Quantity</label>
                                <input type="number" name="stock_quantity" class="form-control" id="stock_quantity" required>
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary myborder-radius" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn my-btn myborder-radius" id="addNewStock">Submit</button>
            </div>
        </div>
    </div>
</div>