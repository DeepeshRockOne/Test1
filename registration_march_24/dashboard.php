<?php $title = "Dashboard"; ?>
<?php $pageHeading = "Dashboard"; ?>
<?php require_once("config.php"); ?>
<?php require_once("header.php"); ?>

<?php if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) { ?>
    <?php header("Location: login.php"); ?>
<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<?php
    $selectRegisteredRecordsSql = "SELECT * FROM registration ORDER BY id";
    $registeredRecordsResult = mysqli_query($conn, $selectRegisteredRecordsSql);

    $registeredRecords = array();
    if (mysqli_num_rows($registeredRecordsResult) > 0) {
        while($row = mysqli_fetch_assoc($registeredRecordsResult)) {
            $registeredRecords[] = $row;
        }
    }
?>

<div class="container mt-3">
  <table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Country</th>
            <th>Gender</th>
            <th>Hobby</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($registeredRecords) > 0) { ?>
            <?php foreach($registeredRecords as $register) { ?>
                <tr>
                    <td><?php echo $register["id"]; ?></td>
                    <td><?php echo $register["name"]; ?></td>
                    <td><?php echo $register["mobile_number"]; ?></td>
                    <td><?php echo $register["email"]; ?></td>
                    <td><?php echo $register["address"]; ?></td>
                    <td><?php echo $register["country"]; ?></td>
                    <td><?php echo $register["gender"]; ?></td>
                    <td><?php echo $register["hobby"]; ?></td>
                    <td>
                        <img src="images/registration_images/<?php echo $register["image"]; ?>" height="80px" width="80px">
                    </td>
                    <td>
                        <a href="edit_registration.php?edit_id=<?php echo $register["id"]; ?>" class="btn btn-primary">Edit</a>
                        <a href="javascript:void(0)" data-deleteId="<?php echo $register["id"]; ?>" class="btn btn-danger registeration_delete">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="10">There is no registered records</td>
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>

<?php require_once("footer.php"); ?>
<script type="text/javascript">
    <?php require_once("custom.js"); ?>
</script>