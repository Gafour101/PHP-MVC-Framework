$(document).ready(function() {
    // add customer details
    $(document).on("click", ".add-stock", function() {
        $("#addStocksModal").modal("show");
    });

    $("#addNewStock").click(function() {
        // Get the edited values from the input fields
        var stockCategory = $("#stock_category").val();
        var addQuantity = $("#stock_quantity").val();

        // Prepare the data to send to the server
        var addStockData = {
            category: stockCategory,
            quantity: addQuantity,
        };

        $.ajax({
            type: "POST",
            url: "/add_stock",
            data: addStockData, // Serialize the form data
            success: function(response) {
                // Show the success message
                displayInfos();
                $("#addStocksModal").modal("hide");
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
    // ===================== Add Stocks to EDIT details ===================== //

    var sandsTableBody = $("#sandsTable tbody");
    var sandsdataTable;
    var sands_count = 1;

    function displayInfos() {
        var totalStocks = $("#total_stock");
        var totalSand = $("#total_sand");
        var totalGravel = $("#total_gravel");

        $.ajax({
            type: "GET",
            url: "/stocks", // Replace with the actual URL to fetch stock data from the server
            success: function(response) {
                // Update stock quantities in the HTML elements
                totalStocks.text(response.stock);
                totalSand.text(response.sand);
                totalGravel.text(response.gravel);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching stock data.");
            },
        });
    }

    function displaySands() {
        $.ajax({
            type: "GET",
            url: "/sands",
            success: function(response) {
                // Clear the existing table rows
                sandsTableBody.empty();

                // Create an array to store the data for each row
                var sandsData = [];

                // Iterate through the customers data and add to the array
                $.each(response.sands, function(index, sand) {
                    var editButton =
                        "<button class='btn btn-primary myborder-radius btn-sm mr-1 edit-sand' data-sand-id='" +
                        sand.id +
                        "'><i class='bi bi-pencil'></i></button>";
                    var deleteButton =
                        "<button class='btn btn-danger myborder-radius btn-sm delete-sand' data-sand-id='" +
                        sand.id +
                        "'><i class='bi bi-trash'></i></button>";

                    // Construct the actions column HTML
                    var actionsColumn = "<td>" + editButton + deleteButton + "</td>";

                    // Construct the row data array
                    var rowData = [sands_count, sand.types, actionsColumn];

                    sandsData.push(rowData);
                    sands_count = sands_count + 1;
                });

                // Check if the DataTable instance already exists
                if (sandsdataTable) {
                    // If it exists, clear and redraw the table with the new data
                    sandsdataTable.clear().rows.add(sandsData).draw();
                } else {
                    // Otherwise, initialize DataTable on the customers table
                    sandsdataTable = $("#sandsTable").DataTable({
                        order: [
                            [0, "asc"]
                        ],
                        dom: "Bfrtip", // Add buttons to the DOM
                        buttons: ["csv", "excel", "pdf", "print"],
                        searching: true, // Enable search functionality
                        responsive: true,
                        data: sandsData, // Set initial data
                        columns: [{ title: "#" }, { title: "Types" }, { title: "Actions" }],
                    });
                }
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching Sands data.");
            },
        });
    }
    var gravelsTableBody = $("#gravelsTable tbody");
    var gravelsdataTable;
    var gravels_count = 1;

    function displayGravels() {
        $.ajax({
            type: "GET",
            url: "/gravels",
            success: function(response) {
                // Clear the existing table rows
                gravelsTableBody.empty();

                // Create an array to store the data for each row
                var gravelsData = [];

                // Iterate through the customers data and add to the array
                $.each(response.gravels, function(index, gravel) {
                    var editButton =
                        "<button class='btn btn-primary myborder-radius btn-sm mr-1 edit-gravel' data-gravel-id='" +
                        gravel.id +
                        "'><i class='bi bi-pencil'></i></button>";
                    var deleteButton =
                        "<button class='btn btn-danger myborder-radius btn-sm delete-gravel' data-gravel-id='" +
                        gravel.id +
                        "'><i class='bi bi-trash'></i></button>";

                    // Construct the actions column HTML
                    var actionsColumn = "<td>" + editButton + deleteButton + "</td>";

                    // Construct the row data array
                    var rowData = [gravels_count, gravel.types, actionsColumn];

                    gravelsData.push(rowData);
                    gravels_count = gravels_count + 1;
                });

                // Check if the DataTable instance already exists
                if (gravelsdataTable) {
                    // If it exists, clear and redraw the table with the new data
                    gravelsdataTable.clear().rows.add(gravelsData).draw();
                } else {
                    // Otherwise, initialize DataTable on the customers table
                    gravelsdataTable = $("#gravelsTable").DataTable({
                        order: [
                            [0, "asc"]
                        ],
                        dom: "Bfrtip", // Add buttons to the DOM
                        buttons: ["csv", "excel", "pdf", "print"],
                        searching: true, // Enable search functionality
                        responsive: true,
                        data: gravelsData, // Set initial data
                        columns: [{ title: "#" }, { title: "Types" }, { title: "Actions" }],
                    });
                }
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching gravels data.");
            },
        });
    }
    displayInfos();
    displaySands();
    displayGravels();

    // ===================== FETCH Sand to EDIT details ===================== //
    var editedSandId;

    // Edit customer details
    $(document).on("click", ".edit-sand", function() {
        editedSandId = $(this).attr("data-sand-id");
        $("#editSandsModal").modal("show");

        $.ajax({
            type: "GET",
            url: "/find_product",
            data: { id: editedSandId },
            success: function(response) {
                $("#editTypes").val(response.product.types);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching types details.");
            },
        });
    });
    // ===================== FETCH Sales to EDIT details ===================== //

    // ===================== FETCH Sand to EDIT details ===================== //
    var editedGravelId;

    // Edit customer details
    $(document).on("click", ".edit-gravel", function() {
        editedGravelId = $(this).attr("data-gravel-id");
        $("#editGravelsModal").modal("show");

        $.ajax({
            type: "GET",
            url: "/find_product",
            data: { id: editedGravelId },
            success: function(response) {
                $("#editGravelTypes").val(response.product.types);
            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching types details.");
            },
        });
    });
    // ===================== FETCH Sales to EDIT details ===================== //

    // ===================== UPDATE customer details ===================== //
    $("#saveEditedSands").click(function() {
        // Get the edited values from the input fields
        var editedSand = $("#editSands").val();
        var editedTypes = $("#editTypes").val();
        // Prepare the data to send to the server
        var editedData = {
            id: editedSandId, // The customer ID you fetched earlier
            category: editedSand,
            types: editedTypes,
        };

        // Fetch customer details from the server using AJAX
        $.ajax({
            type: "POST",
            url: "/update_products", // Replace with the actual URL
            data: editedData,
            success: function(response) {
                // Show the success message
                sands_count = 1;
                displaySands();

                $("#editSandsModal").modal("hide");
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

    // ===================== UPDATE customer details ===================== //
    $("#saveEditedGravels").click(function() {
        // Get the edited values from the input fields
        var editedGravel = $("#editGravels").val();
        var editedGravelTypes = $("#editGravelTypes").val();
        // Prepare the data to send to the server
        var editedData = {
            id: editedGravelId, // The customer ID you fetched earlier
            category: editedGravel,
            types: editedGravelTypes,
        };

        // Fetch customer details from the server using AJAX
        $.ajax({
            type: "POST",
            url: "/update_products", // Replace with the actual URL
            data: editedData,
            success: function(response) {
                // Show the success message
                gravels_count = 1;
                displayGravels();
                $("#editGravelsModal").modal("hide");

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

    // ===================== Add Sand to EDIT details ===================== //

    // add customer details
    $(document).on("click", ".add-sand", function() {
        $("#addSandsModal").modal("show");
    });

    $("#addNewSand").click(function() {
        // Get the edited values from the input fields
        var addSand = $("#category").val();
        var addTypes = $("#types").val();
        // Prepare the data to send to the server
        var addData = {
            category: addSand,
            types: addTypes,
        };

        $.ajax({
            type: "POST",
            url: "/store_products",
            data: addData, // Serialize the form data
            success: function(response) {
                // Show the success message
                sands_count = 1;
                displaySands();
                $("#addSandsModal").modal("hide");

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
    // ===================== Add Sales to EDIT details ===================== //

    // ===================== Add Sand to EDIT details ===================== //
    var editedSandId;

    // add customer details
    $(document).on("click", ".add-gravel", function() {
        $("#addGravelsModal").modal("show");
    });

    $("#addNewGravel").click(function() {
        // Get the edited values from the input fields
        var addGravel = $("#gravelcategory").val();
        var addGravelTypes = $("#graveltypes").val();
        // Prepare the data to send to the server
        var addData = {
            category: addGravel,
            types: addGravelTypes,
        };

        $.ajax({
            type: "POST",
            url: "/store_products",
            data: addData, // Serialize the form data
            success: function(response) {
                // Show the success message
                gravels_count = 1;
                displayGravels();
                $("#addGravelsModal").modal("hide");

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
    // ===================== Add Sales to EDIT details ===================== //

    // ===================== DELETE customer details ===================== //
    var sandToDelete;
    $(document).on("click", ".delete-sand", function() {
        sandToDelete = $(this).attr("data-sand-id");
        $("#deleteSandsModal").modal("show");
    });

    $("#confirmDeleteSand").click(function() {
        // Send AJAX request to delete the customer
        $.ajax({
            type: "POST",
            url: "/delete_products",
            data: { id: sandToDelete },
            success: function(response) {
                // Refresh the customers table after successful deletion
                sands_count = 1;
                displaySands();
                $("#deleteSandsModal").modal("hide");

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
    // ===================== DELETE customer details ===================== //

    // ===================== DELETE customer details ===================== //
    var gravelToDelete;
    $(document).on("click", ".delete-gravel", function() {
        gravelToDelete = $(this).attr("data-gravel-id");
        $("#deleteGravelsModal").modal("show");
    });

    $("#confirmDeleteGravel").click(function() {
        // Send AJAX request to delete the customer
        $.ajax({
            type: "POST",
            url: "/delete_products",
            data: { id: gravelToDelete },
            success: function(response) {
                // Refresh the customers table after successful deletion
                gravels_count = 1;
                displayGravels();
                $("#deleteGravelsModal").modal("hide");

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
    // ===================== DELETE customer details ===================== //
});