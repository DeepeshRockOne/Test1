<?php $title = "Login"; ?>
<?php $pageHeading = "Login"; ?>
<?php require_once("header.php"); ?>
<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
    <?php header("location: dashboard.php"); ?>
<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<div class="container mt-3">
    <div class="row">
        <!-- <h2>Login</h2> -->
        <form id="login_form" method="post">
            <div class="mb-3">
                <label class="login_errors_label"></label>
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="mb-3 mt-3">
                <a href="registration.php">Click Here For Register</a>
            </div>
        </form>
    </div>
</div>

<?php require_once("footer.php"); ?>
<script type="text/javascript">
    <?php require_once("custom.js"); ?>
</script>