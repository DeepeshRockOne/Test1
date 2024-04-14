<?php $title = "Registration"; ?>
<?php $pageHeading = "Registration"; ?>
<?php require_once("header.php"); ?>
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
    <?php header("location: dashboard.php"); ?>
<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<div class="container mt-3">
    <div class="row">
        <!-- <h2>Registration</h2> -->
        <form id="registration_form" method="post" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <div class="row">
                    <div class="col">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" placeholder="Enter first name" name="first_name">
                    </div>
                    <div class="col">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" class="form-control" id="mobile_number" placeholder="Enter mobile number" name="mobile_number">
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" name="confirm_password">
            </div>
            <div class="mb-3">
                <label for="address">Address:</label>
                <textarea class="form-control" row="3" id="address" name="address"></textarea>
            </div>
            <div class="mb-3">
                <label for="country">Country:</label>
                <select class="form-select" id="country" name="country">
                    <option value="">---Select Country---</option>
                    <option value="Japan">Japan</option>
                    <option value="India">India</option>
                    <option value="China">China</option>
                    <option value="Turkey">Turkey</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="gender">Gender:</label>
                <input type="radio" class="form-check-input" id="gender" name="gender" value="Male">Male
                <input type="radio" class="form-check-input" name="gender" value="Female">Female
                <input type="radio" class="form-check-input" name="gender" value="Other">Other
            </div>
            <div class="mb-3">
                <label for="hobby">Hobby:</label>
                <input type="checkbox" class="form-check-input" id="hobby" name="hobby[]" value="Cricket">Cricket
                <input type="checkbox" class="form-check-input" name="hobby[]" value="Hockey">Hockey
                <input type="checkbox" class="form-check-input" name="hobby[]" value="Woolly ball">Woolly ball
            </div>
            <div class="mb-3">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" onchange="previewImage();">
                <div class="mb-3 mt-3">
                    <img src="images/registration_images/preview_image.jpg" class="rounded" id="preview_image" alt="default_preview_image" height="200" width="200">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <div class="mb-3 mt-3">
                <a href="login.php">Click Here For Login</a>
            </div>
        </form>
    </div>
</div>

<?php require_once("footer.php"); ?>
<script type="text/javascript">
    <?php require_once("custom.js"); ?>
</script>