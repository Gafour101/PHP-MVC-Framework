<div  class="card primarycard p-4 ">
    <div class=" justify-content-between flex d-flex flex-row">
        <h4 class="  myprimary-color mb-3 mt-1"><b>Add Sales</b></h4>
        <div class="flex-column"><button type="button" id="add_customer_btn" class="btn my-btn mt-1 myprimary-color myborder-radius btn-sm  float-end"><b><i class="bi bi-person-lines-fill "></i></b></button></div>
    </div>

    <div id="sales_message" class="alert alert-success myprimary-bg myborder-radius" style="display: none;"></div>
    <i class="bi bi-receipt-cutoff text-center display-1 myprimary-color"></i>
    <!-- ============================ ADD EXISTING CUSTOMER SALE ============================ -->
    <form id="add_sale" action="/add_sale" name="add_sale">
        <!-- ================== FIRST ROW ================== -->
        <div class="row">
            <div id="customer-container" class="col-lg-6 col-md-6 mb-3">
                <label for="customer" class=" mytext-color fs-6">Customer</label>
                <select type="number" name="customer" id="customer" class="form-select myborder-radius" required>
                    <option value="" selected disabled>Select Customer</option>
                    <?php foreach ($customers as $customer) : ?>
                        <option value="<?php echo $customer->id; ?>"><?php echo $customer->fullname; ?></option>
                    <?php endforeach; ?>
                </select>
            </div> <!-- END OF 1st COLUMN -->
            
            <div class="col-lg-6 col-md-6 mb-3">
                <label for="receipt" class=" mytext-color fs-6">Remarks</label>
                <input type="text" name="remarks" id="remarks" class="form-control myborder-radius" required >
            </div> <!-- END OF 3RD COLUMN -->
        </div> <!-- END OF 1st ROW -->

        <!-- ================== SECOND ROW ================== -->
        <div class="row">
            <div class="col-lg-4 col-md-4 mb-3">
                <label for="quantity" class=" mytext-color fs-6">Qty. cu. m.</label>
                <input type="number" name="quantity" step="0.01" id="quantity" class="form-control myborder-radius" required aria-describedby="quantityHelpBlock">
            </div> <!-- END OF 1st COLUMN -->

            <div class="col-lg-4 col-md-4 mb-3">
                <label for="category" class=" mytext-color fs-6">Sand or Gravel</label>
                <select type="text" name="category" id="category" class="form-select myborder-radius" required>
                    <option value="" selected disabled>Select Option</option>
                    <option value="Sand">Sand</option>
                    <option value="Gravel">Gravel</option>
                    
                </select>
            </div> <!-- END OF 2nd COLUMN -->

            <div class="col-lg-4 col-md-4 mb-3">
                <label for="types" class=" mytext-color fs-6">Type</label>
                <select type="text" name="types" id="types" class="form-select myborder-radius" required>
                    
                </select>
                
            </div> <!-- END OF 3rd COLUMN -->
        </div> <!-- END OF 2nd ROW -->

        <div class="row">
            <div class="col-lg-6 col-md-6 mb-3">
                <label for="receipt" class=" mytext-color fs-6">Receipt</label>
                <input type="text" name="receipt" id="receipt" class="form-control myborder-radius" required>
            </div> <!-- END OF 2nd COLUMN -->

            <div class="col-lg-6 col-md-6 mb-3">
                <label for="amount" class=" mytext-color fs-6">Amount</label>
                <input type="number " step="0.01" name="amount" id="amount" class="form-control myborder-radius" required>
            </div> <!-- END OF 2nd COLUMN -->

        </div>
            <input type="submit" value="Submit" class="btn my-btn  p-2 fs-5 fw-semibold myborder-radius w-100 mt-2">
    </form> <!-- END OF FORM -->


    <form id="new_customer_sale" action="/new_customer_sale" name="add_sale">
        <!-- ================== FIRST ROW ================== -->
        <div class="row">
            <div id="customer-container" class="col-lg-6 col-md-6 mb-3">
                <label for="new_customer" id="new_customer_label" class=" mytext-color fs-6">Customer</label>
                <input type="text" name="new_customer" id="new_customer" class="form-control myborder-radius">
            </div> <!-- END OF 1st COLUMN -->

            <div class="col-lg-6 col-md-6 mb-3">
                <label for="remarks" id="new_remarks_label" class=" mytext-color fs-6">Remarks</label>
                <input type="text" name="remarks" id="remarks" class="form-control myborder-radius" required>
            </div> <!-- END OF 3RD COLUMN -->
        </div> <!-- END OF 1st ROW -->

        <div class="row">
            <div class="col-lg-7 col-md-5 mb-3">
                <label for="address" id="new_contact_label" class=" mytext-color fs-6">Address</label>
                <input type="text" name="new_address" id="new_address" class="form-control myborder-radius" required>
            </div> <!-- END OF 1st COLUMN -->

            <div class="col-lg-5 col-md-3 mb-3">
                <label for="contact" id="new_contact_label" class=" mytext-color fs-6">Contact</label>
                <input type="text" name="new_contact" id="new_contact" class="form-control myborder-radius" required>
            </div> <!-- END OF 2nd COLUMN -->
        </div>

        <!-- ================== SECOND ROW ================== -->
        <div class="row">
            <div class="col-lg-4 col-md-4 mb-3">
                <label for="quantity" id="new_quantity_label" class=" mytext-color fs-6">Qty. cu. m.</label>
                <input type="number" step="0.01" name="quantity" id="quantity" class="form-control myborder-radius" required>
            </div> <!-- END OF 1st COLUMN -->

            <div class="col-lg-4 col-md-4 mb-3">
                <label for="new_category" id="new_category_label" class=" mytext-color fs-6">Sand or Gravel</label>
                <select type="text" name="category" id="new_category" class="form-select myborder-radius" required>
                    <option value="" selected disabled>Select Option</option>
                    <option value="Sand">Sand</option>
                    <option value="Gravel">Gravel</option>
                    
                </select>
            </div> <!-- END OF 2nd COLUMN -->

            <div class="col-lg-4 col-md-4 mb-3">
                <label for="types" id="new_types_label" class=" mytext-color fs-6">Type</label>
                <select type="text" name="types" id="new_types" class="form-select myborder-radius" required>
                    
                </select>
                
            </div> <!-- END OF 3rd COLUMN -->
        </div> <!-- END OF 2nd ROW -->

        <div class="row">
            <div class="col-lg-6 col-md-6 mb-3">
                <label for="receipt" class=" mytext-color fs-6">Receipt</label>
                <input type="text" name="receipt" id="receipt" class="form-control myborder-radius">
            </div> <!-- END OF 2nd COLUMN -->

            <div class="col-lg-6 col-md-6 mb-3">
                <label for="amount" class=" mytext-color fs-6">Amount</label>
                <input type="number " step="0.01" name="amount" id="amount" class="form-control myborder-radius">
            </div> <!-- END OF 2nd COLUMN -->

        </div>
            <input type="submit" value="Submit" id="new_submit_btn" class="btn my-btn  p-2 fs-5 fw-semibold myborder-radius w-100 mt-2">
    </form> <!-- END OF NEW CUSTOMER FORM -->
</div> <!-- END OF CARD -->

<div class="card primarycard p-4 mt-3">

    <div class=" justify-content-between mb-3 d-flex flex-row">
        <div class="flex-column"><h2 class="  myprimary-color mt-2"><b></i>Stocks</b></h2></div>
        <!-- <div class="flex-column"><button type="button" class="btn h-75 myprimary-color primary-btn myborder-radius mt-2 float-end"><b><i class="bi bi-plus-lg fs-5"></i></b></button></div> -->
    </div>
    <table class=" table-hover mt-2 mb-4 myborder-radius table-responsive">
        <thead class=" text-center myprimary-color mb-3">
            <tr>
                <th class="myprimary-color fs-5">#</th>
                <th class="myprimary-color fs-5">Category</th>
                <th class=" myprimary-color fs-5">Available</th>
            </tr>
        </thead>
        <tbody class=" text-center">
            <tr>
                <td class="mytertiary-color fs-5">1</td>
                <td><div class="fs-5 mytertiary-color flex-column">Sand</div></td>
                <td><div class="fs-5 mysecondary-color flex-column" id="sand_stock">23</div></td>
            </tr>
            <tr>
                <td class="mytertiary-color fs-5">2</td>
                <td><div class="fs-5 mytertiary-color flex-column">Gravel</div></td>
                <td><div class="fs-5 mysecondary-color flex-column" id="gravel_stock">23</div></td>
            </tr>
        </tbody>
    </table>
</div><!-- END OF CARD -->

<script>
    document.getElementById("category").addEventListener("change", function() {
        var selectedProduct = this.value;
        console.log("Selected Product:", selectedProduct);

        var typesSelect = document.getElementById("types");
        typesSelect.innerHTML = '<option value="" selected disabled>Select Option</option>';
        
        var productTypes = <?php echo isset($productTypes) ? json_encode($productTypes) : '{}'; ?>;
        console.log("Product Types:", productTypes);

        var selectedProductTypes = productTypes[selectedProduct] || [];
        console.log("Selected Product Types:", selectedProductTypes);

        for (var i = 0; i < selectedProductTypes.length; i++) {
            var option = document.createElement("option");
            option.value = selectedProductTypes[i];
            option.text = selectedProductTypes[i];
            typesSelect.appendChild(option);
        }
        typesSelect.disabled = false;
    });

    document.getElementById("new_category").addEventListener("change", function() {
        var selectedProduct = this.value;
        console.log("Selected Product:", selectedProduct);

        var typesSelect = document.getElementById("new_types");
        typesSelect.innerHTML = '<option value="" selected disabled>Select Option</option>';
        
        var productTypes = <?php echo isset($productTypes) ? json_encode($productTypes) : '{}'; ?>;
        console.log("Product Types:", productTypes);

        var selectedProductTypes = productTypes[selectedProduct] || [];
        console.log("Selected Product Types:", selectedProductTypes);

        for (var i = 0; i < selectedProductTypes.length; i++) {
            var option = document.createElement("option");
            option.value = selectedProductTypes[i];
            option.text = selectedProductTypes[i];
            typesSelect.appendChild(option);
        }
        typesSelect.disabled = false;
    });
</script>
