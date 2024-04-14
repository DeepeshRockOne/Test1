<?php
    if (isset($_GET['edit_id']) && $_GET['edit_id'] != '') {
        require_once("config.php");
        $edit_id = $_GET['edit_id'];

        $select_sql = "SELECT * FROM registration WHERE id = $edit_id";
        $select_result = mysqli_query($conn, $select_sql);

        if (mysqli_num_rows($select_result) == 1) {
            $row = mysqli_fetch_assoc($select_result);
            
            $full_name_array = explode(" ", $row["name"]);
            $first_name = $full_name_array[0];
            $last_name = $full_name_array[1];

            $hobby = explode(",", $row["hobby"]);
        } else {
            echo "Requested record not available for edit<br>";
            ?>
                <a href="dashboard.php">Go back to Dashboard</a>
            <?php
            exit;
        }
    } else {
        echo "Edit id is required<br>";
        ?>
            <a href="dashboard.php">Go back to Dashboard</a>
        <?php
        exit;
    }

    $title = "Edit Registration";
    $pageHeading = "Edit Registration";
    require_once("header.php");

    if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
    }
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<div class="container mt-3">
    <div class="row">
        <!-- <h2>Edit Registration</h2> -->
        <form id="edit_registration_form" method="post" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <div class="row">
                    <div class="col">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" placeholder="Enter first name" name="first_name" value="<?php if(isset($first_name)) { echo $first_name; } ?>">
                    </div>
                    <div class="col">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name" value="<?php if(isset($last_name)) { echo $last_name; } ?>">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" class="form-control" id="mobile_number" placeholder="Enter mobile number" name="mobile_number" value="<?php if(isset($row["mobile_number"])) { echo $row["mobile_number"]; } ?>">
            </div>
            <div class="mb-3">
                <label for="address">Address:</label>
                <textarea class="form-control" row="3" id="address" name="address"><?php if(isset($row["address"])) { echo $row["address"]; } ?></textarea>
            </div>
            <div class="mb-3">
                <label for="country">Country:</label>
                <select class="form-select" id="country" name="country">
                    <option value="">---Select---</option>
                    <option value="Japan" <?php if(isset($row["country"]) && $row["country"] == "Japan") { echo "selected"; } ?>>Japan</option>
                    <option value="India" <?php if(isset($row["country"]) && $row["country"] == "India") { echo "selected"; } ?>>India</option>
                    <option value="China" <?php if(isset($row["country"]) && $row["country"] == "China") { echo "selected"; } ?>>China</option>
                    <option value="Turkey" <?php if(isset($row["country"]) && $row["country"] == "Turkey") { echo "selected"; } ?>>Turkey</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="gender">Gender:</label>
                <input type="radio" class="form-check-input" id="gender" name="gender" value="Male" <?php if(isset($row["gender"]) && $row["gender"] == "Male") { echo "checked"; } ?>>Male
                <input type="radio" class="form-check-input" name="gender" value="Female" <?php if(isset($row["gender"]) && $row["gender"] == "Female") { echo "checked"; } ?>>Female
                <input type="radio" class="form-check-input" name="gender" value="Other" <?php if(isset($row["gender"]) && $row["gender"] == "Other") { echo "checked"; } ?>>Other
            </div>
            <div class="mb-3">
                <label for="hobby">Hobby:</label>
                <input type="checkbox" class="form-check-input" id="hobby" name="hobby[]" value="Cricket" <?php if(isset($hobby) && in_array("Cricket", $hobby)) { echo "checked"; } ?>>Cricket
                <input type="checkbox" class="form-check-input" name="hobby[]" value="Hockey" <?php if(isset($hobby) && in_array("Hockey", $hobby)) { echo "checked"; } ?>>Hockey
                <input type="checkbox" class="form-check-input" name="hobby[]" value="Woolly ball" <?php if(isset($hobby) && in_array("Woolly ball", $hobby)) { echo "checked"; } ?>>Woolly ball
            </div>
            <div class="mb-3">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" onchange="previewImage();">
                <div class="mb-3 mt-3">
                    <img src="images/registration_images/<?php echo $row["image"]; ?>" class="rounded" id="preview_image" alt="default_preview_image" height="200" width="200">
                </div>
            </div>
            <input type="hidden" name="hidden_edit_id" value="<?php if(isset($row["id"])) { echo $row["id"]; } ?>">
            <button type="submit" class="btn btn-primary">Save</button>
            <div class="mb-3 mt-3">
                <a href="dashboard.php">Click Here For Dashboard</a>
            </div>
        </form>
    </div>
</div>

<?php require_once("footer.php"); ?>
<script type="text/javascript">
    <?php require_once("custom.js"); ?>
</script>