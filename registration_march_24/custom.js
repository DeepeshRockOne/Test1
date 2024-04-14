$(document).ready(function(){
    $("#registration_form").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            mobile_number: {
                required: true,
                rangelength: [10, 12],
                number: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            address: {
                required: true
            },
            country: {
                required: true
            },
            gender: {
                required: true
            },
            'hobby[]': {
                required: true
            },
            image: {
                required: true
            }
        },
        messages: {
            first_name: 'Please enter first name',
            last_name: 'Please enter last name',
            mobile_number: {
                required: 'Please enter mobile number',
                rangelength: 'Mobile number should be 10 digit number'
            },
            email: {
                required: 'Please enter email',
                email: 'Please enter a valid email address'
            },
            password: {
                required: 'Please enter password',
                minlength: 'Password must be 8 characters long'
            },
            confirm_password: {
                required: 'Please enter confirm password',
                equalTo: 'Confirm password do not match with password'
            },
            address: 'Please enter address',
            country: 'Please select country',
            gender: 'Please select gender',
            'hobby[]': 'Please select at least 1 hobby',
            image: 'Please select image'
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            formData.append("register", "register");

            $.ajax({
                url:'ajax_registration.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                datatype: 'json',
                success: function(response) {
                    if (response.status == "success") {
                        window.location = "dashboard.php";
                    } else if (response.status == "error") {
                        console.log('Error message ' + response.message);
                    }
                },
                error: function(error) {
                    console.log('Error: '+error);
                }
            });
        }
    });

    $("#edit_registration_form").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            mobile_number: {
                required: true,
                rangelength: [10, 12],
                number: true
            },
            address: {
                required: true
            },
            country: {
                required: true
            },
            gender: {
                required: true
            },
            'hobby[]': {
                required: true
            }
        },
        messages: {
            first_name: 'Please enter first name',
            last_name: 'Please enter last name',
            mobile_number: {
                required: 'Please enter mobile number',
                rangelength: 'Mobile number should be 10 digit number'
            },
            address: 'Please enter address',
            country: 'Please select country',
            gender: 'Please select gender',
            'hobby[]': 'Please select at least 1 hobby'
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            formData.append("edit_register", "edit_register");

            $.ajax({
                url:'ajax_registration.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                datatype: 'json',
                success: function(response) {
                    if (response.status == "success") {
                        window.location = "dashboard.php";
                    } else if (response.status == "error") {
                        console.log('Error message ' + response.message);
                    }
                },
                error: function(error) {
                    console.log('Error: '+error);
                }
            });
        }
    });

    $("#login_form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: 'Please enter email',
                email: 'Please enter a valida email address'
            },
            password: 'Please enter password'
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            formData.append("login_request", "login_request");

            $.ajax({
                url:'ajax_registration.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                datatype: 'json',
                success: function(response) {
                    if (response.status == "login_success") {
                        if ($(".login_error").length > 0) {
                            $(".login_error").remove();
                        }
                        window.location = "dashboard.php";
                    } else if (response.status == "error") {
                        if ($(".login_error").length > 0) {
                            $(".login_error").remove();
                        }
                        $(".login_errors_label").html("<span style='color: red;'>"+response.message+"</span>");
                    }
                },
                error: function(error) {
                    console.log('Error: '+JSON.stringify(error));
                }
            });
        }
    });
});

$(".registeration_delete").on("click", function(e){
    if (confirm("Delete selected row?")) {
        var deleteid = $(this).data("deleteid");
        console.log('deleteid '+deleteid);
        $.ajax({
            url:'ajax_registration.php',
            type: 'POST',
            data: {'register_delete': 'register_delete', 'deleteid': deleteid},
            datatype: 'json',
            success: function(response) {
                if(response.status == "delete_success") {
                    window.location = "dashboard.php";
                } else if (response.status == "error") {
                    console.log('Error message '+response.message);
                }
            },
            error: function(error) {
                console.log('Error: '+error);
            }
        })
    } else {
        e.preventDefault();
    }
});

function previewImage() {
    var file = $("#image").get(0).files[0];

    if(file && /image\//i.test(file.type)) {
        var reader = new FileReader();

        reader.onload = function() {
            $("#preview_image").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    } else {
        $("#preview_image").attr("src", "images/registration_images/preview_image.jpg");
    }
}