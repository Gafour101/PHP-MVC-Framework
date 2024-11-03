$(document).ready(function() {
    var functionsCalled = false; // Initialize the flag

    // Callback functions

    var addCustomerContainer = $("#new_customer_sale");
    var addCustomerButton = $("#add_customer_btn");
    var add_saleContainer = $("#add_sale");

    addCustomerContainer.hide();

    $(addCustomerButton).click(function() {
        if (add_saleContainer.is(":visible")) {
            add_saleContainer.hide();
            addCustomerContainer.show();
        } else {
            addCustomerContainer.hide();
            add_saleContainer.show();
        }
    });

    function displayAllData() {
        if (!functionsCalled) {
            displayInfos();
            displaySales();
            displayCustomers();
            displayStocks();
            functionsCalled = true; // Set the flag to true
        }
    }

    var customersTableBody = $("#customersTable tbody");
    var customersdataTable;
    var customers_count = 1;

    function displayCustomers() {
        $.ajax({
            type: "GET",
            url: "/customers",
            success: function(response) {
                // Clear the existing table rows
                customersTableBody.empty();

                // Create an array to store the data for each row
                var customersData = [];

                // Iterate through the customers data and add to the array
                $.each(response.customers, function(index, customer) {
                    var viewButton =
                        "<button class='btn my-btn myborder-radius btn-sm mr-1 view-customer' data-customer-id='" +
                        customer.id +
                        "'><i class='bi bi-eye-fill'></i></button>";
                    var editButton =
                        "<button class='btn btn-primary myborder-radius btn-sm mr-1 edit-customer' data-customer-id='" +
                        customer.id +
                        "'><i class='bi bi-pencil'></i></button>";
                    var deleteButton =
                        "<button class='btn btn-danger myborder-radius btn-sm delete-customer' data-customer-id='" +
                        customer.id +
                        "'><i class='bi bi-trash'></i></button>";

                    // Construct the actions column HTML
                    var actionsColumn =
                        "<td>" + viewButton + editButton + deleteButton + "</td>";

                    // Construct the row data array
                    var rowData = [
                        customers_count,
                        customer.fullname,
                        customer.contact,
                        customer.address,
                        actionsColumn,
                    ];

                    customersData.push(rowData);
                    customers_count = customers_count + 1;
                });

                // Check if the DataTable instance already exists
                if (customersdataTable) {
                    // If it exists, clear and redraw the table with the new data
                    customersdataTable.clear().rows.add(customersData).draw();
                } else {
                    // Otherwise, initialize DataTable on the customers table
                    customersdataTable = $("#customersTable").DataTable({
                        order: [
                            [0, "asc"]
                        ],
                        dom: "Bfrtip", // Add buttons to the DOM
                        buttons: ["csv", "excel", "pdf", "print"],
                        searching: true, // Enable search functionality
                        responsive: true,
                        data: customersData, // Set initial data
                        columns: [
                            { title: "#" },
                            { title: "Fullname" },
                            { title: "Contact" },
                            { title: "Address" },
                            { title: "Actions" },
                        ],
                    });
                }
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching customer data.");
            },
        });
    }

    var salesTableBody = $("#salesTodayTable tbody");
    var dataTable;
    var sales_count = 1;
    // Function to fetch and display the sales data from the server
    function displaySales() {
        $.ajax({
            type: "GET",
            url: "/sales_today",
            success: function(response) {
                // Clear the existing table rows
                salesTableBody.empty();

                // Create an array to store the data for each row
                var salesData = [];

                // Iterate through the sales data and add to the array
                $.each(response.sales, function(index, sale) {
                    var viewButton =
                        "<button class='btn my-btn myborder-radius btn-sm mr-1 view-sale' data-sale-id='" +
                        sale.id +
                        "'><i class='bi bi-eye-fill'></i></button>";
                    var editButton =
                        "<button class='btn btn-primary myborder-radius btn-sm mr-1 edit-sale' data-sale-id='" +
                        sale.id +
                        "'><i class='bi bi-pencil'></i></button>";
                    var deleteButton =
                        "<button class='btn btn-danger myborder-radius btn-sm delete-sale' data-sale-id='" +
                        sale.id +
                        "'><i class='bi bi-trash'></i></button>";

                    // Construct the actions column HTML
                    var actionsColumn =
                        "<td>" + viewButton + editButton + deleteButton + "</td>";

                    // Construct the row data array
                    var rowData = [
                        sales_count,
                        sale.fullname,
                        sale.category,
                        sale.types,
                        sale.quantity,
                        sale.receipt,
                        sale.remarks,
                        sale.amount,
                        formatDateTime(sale.sale_date),
                        actionsColumn,
                    ];

                    salesData.push(rowData);
                    sales_count = sales_count + 1;
                });

                // Check if the DataTable instance already exists
                if (dataTable) {
                    // If it exists, clear and redraw the table with the new data
                    dataTable.clear().rows.add(salesData).draw();
                } else {
                    // Otherwise, initialize DataTable on the sales table
                    dataTable = $("#salesTodayTable").DataTable({
                        order: [
                            [0, "asc"]
                        ],
                        dom: "Bfrtip", // Add buttons to the DOM
                        buttons: ["csv", "excel", "pdf", "print"],
                        searching: true, // Enable search functionality
                        responsive: true,
                        data: salesData, // Set initial data
                        columns: [
                            { title: "#" },
                            { title: "Customer" },
                            { title: "Category" },
                            { title: "Types" },
                            { title: "Quantity" },
                            { title: "Receipt" },
                            { title: "Remarks" },
                            { title: "Amount" },
                            { title: "Sale Date" },
                            { title: "Actions" },
                        ],
                    });
                }
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching sales data.");
            },
        });
    }

    function formatDateTime(dateTime) {
        const options = {
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "numeric",
            minute: "numeric",
            hour12: true,
        };
        return new Date(dateTime).toLocaleString("en-US", options);
    }

    $("#new_customer_sale").submit(function(event) {
        event.preventDefault();

        // Get the data-url attribute from the form element
        var url = $(this).attr("action");
        var salesMessage = $("#sales_message");

        // Cache the form element for reuse
        var $form = $(this);

        // Send the AJAX request to store the form data
        $.ajax({
            type: "POST",
            url: url,
            data: $form.serialize(), // Serialize the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                // Reset the form after successful submission
                $form.trigger("reset");

                sales_count = 1;
                customers_count = 1;
                displaySales();
                displayInfos();
                displayCustomers();
                // Show the success modal
                $("#successMessage").text(response.message);
                $("#successModal").modal("show");
                setInterval(function() {
                    $("#successModal").modal("hide");
                }, 2000);
            },
            error: function(response) {
                console.log(response);
                // Display an error message on the page (you can customize this part as needed)
                alert(response.error);
            },
        });
    });

    $("#add_sale").submit(function(event) {
        event.preventDefault();

        // Get the data-url attribute from the form element
        var url = $(this).attr("action");
        // Cache the form element for reuse
        var $form = $(this);

        // Send the AJAX request to store the form data
        $.ajax({
            type: "POST",
            url: url,
            data: $form.serialize(), // Serialize the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                //console.log(response);

                // Reset the form after successful submission
                $form.trigger("reset");
                sales_count = 1;
                displaySales();
                displayInfos();
                // Show the success modal
                $("#successMessage").text(response.message);
                $("#successModal").modal("show");
                setInterval(function() {
                    $("#successModal").modal("hide");
                }, 2000);
            },
            error: function(error) {
                console.log(error);
                // Display an error message on the page (you can customize this part as needed)
                alert("Error occurred while saving sales data.");
            },
        });
    });

    function displayInfos() {
        var totalSales = $("#total_sales");
        var totalCustomers = $("#total_customers");
        var totalSands = $("#total_sands");
        var totalGravels = $("#total_gravels");

        $.ajax({
            type: "GET",
            url: "/sales_info", // Replace with the actual URL to fetch stock data from the server
            success: function(response) {
                // Update stock quantities in the HTML elements
                totalSales.text(response.totalSales);
                totalCustomers.text(response.totalCustomers);
                totalSands.text(response.totalSands);
                totalGravels.text(response.totalGravels);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching stock data.");
            },
        });
    }

    function displayStocks() {
        var sandStock = $("#sand_stock");
        var gravelStock = $("#gravel_stock");

        $.ajax({
            type: "GET",
            url: "/stocks_info", // Replace with the actual URL to fetch stock data from the server
            success: function(response) {
                // Update stock quantities in the HTML elements
                sandStock.text(response.sands);
                gravelStock.text(response.gravels);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching stock data.");
            },
        });
    }

    // ===================== STORE new stocks ===================== //
    $("#add_stock").submit(function(event) {
        event.preventDefault();

        // Get the data-url attribute from the form element
        var url = $(this).attr("action");
        var statusMessage = $("#status_message");
        // Cache the form element for reuse
        var $form = $(this);

        // Send the AJAX request to store the form data
        $.ajax({
            type: "POST",
            url: url,
            data: $form.serialize(), // Serialize the form data
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                //console.log(response);
                displayStocks();
                // Reset the form after successful submission
                $form.trigger("reset");
                // Display a success message on the page (you can customize this part as needed)

                // Show the success modal
                $("#successMessage").text(response.message);
                $("#successModal").modal("show");
                setInterval(function() {
                    $("#successModal").modal("hide");
                }, 2000);
            },
            error: function(error) {
                console.log(error);
                // Display an error message on the page (you can customize this part as needed)
                alert("Error occurred while saving sales data.");
            },
        });
    });
    // ===================== STORE new stocks ===================== //

    // ===================== View customer details ===================== //
    $(document).on("click", ".view-customer", function() {
        var customerId = $(this).attr("data-customer-id");

        // Fetch customer details from the server using AJAX
        $.ajax({
            type: "GET",
            url: "/customer_details", // Replace with the actual URL
            data: { id: customerId },
            success: function(response) {
                // Update the modal content using JavaScript
                $("#customerFullname").text(response.customer[0].fullname);
                $("#customerContact").text(response.customer[0].contact);
                $("#customerAddress").text(response.customer[0].address);
                $("#viewCustomerModal").modal("show");
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching customer details.");
            },
        });
    });
    // ===================== View customer details ===================== //

    // ===================== Add customer details ===================== //
    $(document).on("click", ".add-customer", function() {
        $("#addCustomerModal").modal("show");

        $("#addNewCustomer").click(function() {
            // Get the edited values from the input fields
            var addFullname = $("#addCustomerFullname").val();
            var addContact = $("#addCustomerContact").val();
            var addAddress = $("#addCustomerAddress").val();
            // Prepare the data to send to the server
            var addData = {
                fullname: addFullname,
                contact: addContact,
                address: addAddress,
            };

            $.ajax({
                type: "POST",
                url: "/add_customer",
                data: addData, // Serialize the form data
                success: function(response) {
                    $("#addCustomerModal").modal("hide");
                    customers_count = 1;
                    displayCustomers();
                    // Show the success modal
                    $("#successMessage").text(response.message);
                    $("#successModal").modal("show");
                    setInterval(function() {
                        $("#successModal").modal("hide");
                    }, 2000);
                },
                error: function(response) {
                    console.log(response);
                    // Display an error message on the page (you can customize this part as needed)
                    alert(response.error);
                },
            });
        });
        // Send the AJAX request to store the form data

    });
    // ===================== Add customer details ===================== //

    // ===================== FETCH to EDIT customer details ===================== //
    var editedCustomerId;

    // Edit customer details
    $(document).on("click", ".edit-customer", function() {
        editedCustomerId = $(this).attr("data-customer-id");

        // Fetch customer details from the server using AJAX
        $.ajax({
            type: "GET",
            url: "/edit_customer_details", // Replace with the actual URL
            data: { id: editedCustomerId },
            success: function(response) {
                // Update the modal content using JavaScript
                $("#editCustomerFullname").val(response.customer[0].fullname);
                $("#editCustomerContact").val(response.customer[0].contact);
                $("#editCustomerAddress").val(response.customer[0].address);
                $("#editCustomerModal").modal("show");

            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching customer details.");
            },
        });
    });
    // ===================== FETCH to EDIT customer details ===================== //

    // ===================== UPDATE customer details ===================== //
    $("#saveEditedCustomer").click(function() {
        // Get the edited values from the input fields
        var editedFullname = $("#editCustomerFullname").val();
        var editedContact = $("#editCustomerContact").val();
        var editedAddress = $("#editCustomerAddress").val();
        var statusMessage = $("#update_customer_status");

        // Prepare the data to send to the server
        var editedData = {
            id: editedCustomerId, // The customer ID you fetched earlier
            fullname: editedFullname,
            contact: editedContact,
            address: editedAddress,
        };

        // Fetch customer details from the server using AJAX
        $.ajax({
            type: "POST",
            url: "/update_customer_details", // Replace with the actual URL
            data: editedData,
            success: function(response) {
                // Show the success message
                customers_count = 1;
                displayCustomers();
                $("#editCustomerModal").modal("hide");
                // Show the success modal
                $("#successMessage").text(response.message);
                $("#successModal").modal("show");
                setInterval(function() {
                    $("#successModal").modal("hide");
                }, 2000);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching customer details.");
            },
        });
    });
    // ===================== UPDATE customer details ===================== //

    // ===================== DELETE customer details ===================== //
    var customerToDelete;
    $(document).on("click", ".delete-customer", function() {
        customerToDelete = $(this).attr("data-customer-id");
        $("#deleteCustomerModal").modal("show");
    });

    $("#confirmDeleteCustomer").click(function() {
        // Send AJAX request to delete the customer
        $.ajax({
            type: "POST",
            url: "/delete_customer",
            data: { id: customerToDelete },
            success: function(response) {
                // Refresh the customers table after successful deletion
                customers_count = 1;
                sales_count = 1;
                displayCustomers();
                displaySales();
                displayInfos()
                    // Show the success modal
                $("#successMessage").text(response.message);
                $("#successModal").modal("show");
                setInterval(function() {
                    $("#successModal").modal("hide");
                }, 2000);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while deleting the customer.");
            },
        });
        $("#deleteCustomerModal").modal("hide");
    });
    // ===================== DELETE customer details ===================== //

    // ===================== View sales details ===================== //
    $(document).on("click", ".view-sale", function() {
        var saleId = $(this).attr("data-sale-id");

        // Fetch sale details from the server using AJAX
        $.ajax({
            type: "GET",
            url: "/sales_details", // Replace with the actual URL
            data: { id: saleId },
            success: function(response) {
                var saleData = response.sales[0];
                // Update the modal content using JavaScript

                $("#salesFullname").text(saleData.fullname);
                $("#salesContact").text(saleData.contact);
                $("#salesAddress").text(saleData.address);
                $("#salesCategory").text(saleData.category);
                $("#salesTypes").text(saleData.types);
                $("#salesQuantity").text(saleData.quantity);
                $("#salesReceipt").text(saleData.receipt);
                $("#salesRemarks").text(saleData.remarks);
                $("#salesDate").text(formatDateTime(saleData.sale_date));

                $("#viewSalesModal").modal("show");
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching sale details.");
            },
        });
    });
    // ===================== View sales details ===================== //

    // ===================== FETCH Sales to EDIT details ===================== //
    var editedSalesId;

    // Edit customer details
    $(document).on("click", ".edit-sale", function() {
        editedSalesId = $(this).attr("data-sale-id");

        // Fetch customer details from the server using AJAX
        $.ajax({
            type: "GET",
            url: "/edit_sales_details", // Replace with the actual URL
            data: { id: editedSalesId },
            success: function(response) {
                // Update the modal content using JavaScript
                var selectedCategory = response.sales[0].category;
                var selectedType = response.sales[0].types;

                $("#editSalesCustomer").val(response.sales[0].fullname);
                $("#editSalesQuantity").val(response.sales[0].quantity);
                $("#editSalesReceipt").val(response.sales[0].receipt);
                $("#editSalesRemarks").val(response.sales[0].remarks);
                $("#editSalesModal").modal("show");
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching customer details.");
            },
        });
    });
    // ===================== FETCH Sales to EDIT details ===================== //

    // ===================== UPDATE customer details ===================== //
    $("#saveEditedSales").click(function() {
        // Get the edited values from the input fields
        var editedCategory = $("#editSalesCategory").val();
        var editedTypes = $("#editSalesTypes").val();
        var editedQuantity = $("#editSalesQuantity").val();
        var editedReceipt = $("#editSalesReceipt").val();
        var editedRemarks = $("#editSalesRemarks").val();

        // Prepare the data to send to the server
        var editedData = {
            id: editedSalesId, // The customer ID you fetched earlier
            category: editedCategory,
            types: editedTypes,
            quantity: editedQuantity,
            receipt: editedReceipt,
            remarks: editedRemarks,
        };

        // Fetch customer details from the server using AJAX
        $.ajax({
            type: "POST",
            url: "/update_sales_details", // Replace with the actual URL
            data: editedData,
            success: function(response) {
                // Show the success message
                sales_count = 1;
                displaySales();
                $("#editSalesModal").modal("hide");
                // Show the success modal
                $("#successMessage").text(response.message);
                $("#successModal").modal("show");
                setInterval(function() {
                    $("#successModal").modal("hide");
                }, 2000);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching customer details.");
            },
        });
    });
    // ===================== UPDATE sales details ===================== //

    // ===================== DELETE sales details ===================== //
    var salesToDelete;
    $(document).on("click", ".delete-sale", function() {
        salesToDelete = $(this).attr("data-sale-id");
        $("#deleteSalesModal").modal("show");
    });

    $("#confirmDeleteSales").click(function() {
        // Send AJAX request to delete the customer
        $.ajax({
            type: "POST",
            url: "/delete_sales",
            data: { id: salesToDelete },
            success: function(response) {
                // Refresh the customers table after successful deletion
                sales_count = 1;
                displaySales();
                $("#deleteSalesModal").modal("hide");
                $("#successMessage").text(response.message);
                $("#successModal").modal("show");
                setInterval(function() {
                    $("#successModal").modal("hide");
                }, 2000);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while deleting the customer.");
            },
        });
    });
    // ===================== DELETE sales details ===================== //

    // ===================== Callback functions ===================== //
    displayAllData();
    // ===================== Callback functions ===================== //
});