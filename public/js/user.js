$(document).ready(function() {
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

    var userId;

    function displayInfos() {
        var usersId = $("#id");
        var userFirstName = $("#firstname");
        var userLastName = $("#lastname");
        var email = $("#email");

        $.ajax({
            type: "GET",
            url: "/fetch_user", // Replace with the actual URL to fetch stock data from the server
            success: function(response) {
                // Update stock quantities in the HTML elements
                userId = response.id;
                usersId.val(response.id);
                userFirstName.val(response.firstname);
                userLastName.val(response.lastname);
                email.val(response.email);

            },
            error: function(error) {
                console.log(error);
                alert("Error occurred while fetching stock data.");
            },
        });
    }

    $("#update_profile").click(function() {
        // Get the edited values from the input fields
        var editedId = $("#id").val();
        var editedFirstname = $("#firstname").val();
        var editedLastname = $("#lastname").val();
        var editedEmail = $("#email").val();

        editedUser = {
            id: editedId, // The customer ID you fetched earlier
            firstname: editedFirstname,
            lastname: editedLastname,
            email: editedEmail,
        };
        // Send the AJAX request to store the form data
        $.ajax({
            type: "POST",
            url: "/update_user",
            data: editedUser,
            success: function(response) {
                displayInfos();
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

    $("#update_password").click(function() {
        // Get the edited values from the input fields
        var oldPassword = $("#old_password").val();
        var newPassword = $("#new_password").val();
        var confirmPassword = $("#confirm_new_password").val();

        editedUser = {
            id: userId, // The customer ID you fetched earlier
            old_password: oldPassword,
            new_password: newPassword,
            confirm_new_password: confirmPassword,
        };

        // Cache the form element for reuse
        var $form = $("#updatePassForm");
        // Send the AJAX request to store the form data
        $.ajax({
            type: "POST",
            url: "/update_pass",
            data: editedUser,
            success: function(response) {
                displayInfos();
                $form.trigger("reset");
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
    displayInfos();
});