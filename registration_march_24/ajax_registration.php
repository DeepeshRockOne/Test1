<?php
    require_once("config.php");
    header('Content-Type: application/json');

    if(isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $response_array = array();
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $full_name = $first_name . " " . $last_name;
        $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $hobby = implode(",", $_POST['hobby']);
        
        $image_name = time() . "_" . $_FILES['image']['name'];
        $image_path = 'images/registration_images/' . $image_name;

        $image_file_type = explode('.', $_FILES['image']['name']);
        $image_file_type = strtolower(end($image_file_type));
        $temp_image_name = $_FILES['image']['tmp_name'];

        $allowed_image_file_types = array("jpg", "jpeg", "png");
        if (!in_array($image_file_type, $allowed_image_file_types)) {
            $response_array['status'] = "error";
            $response_array['message'] = "JPG, JPEG, PNG file types are allowed";

            echo json_encode($response_array); exit;
        }

        $select_sql = "SELECT email FROM registration WHERE email = '".$email."'";
        $select_result = mysqli_query($conn, $select_sql);

        if(mysqli_num_rows($select_result) > 0) {
            $response_array['status'] = "error";
            $response_array['message'] = "Entered email already registered";

            echo json_encode($response_array); exit;
        } else {
            move_uploaded_file($temp_image_name, $image_path);

            $insert_sql = "INSERT INTO registration (name, mobile_number, address, country, email, password, gender, hobby, image) VALUES ('".$full_name."', '".$mobile_number."', '".$address."', '".$country."', '".$email."', '".$password."', '".$gender."', '".$hobby."', '".$image_name."')";

            $insert_result = mysqli_query($conn, $insert_sql);

            if ($insert_result) {
                $response_array['status'] = "success";
                
                echo json_encode($response_array); exit;
            } else {
                $response_array['status'] = "error";
                $response_array['message'] = "Error while insertion";

                echo json_encode($response_array); exit;
            }
        }
    }

    if(isset($_POST['edit_register']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $response_array = array();
        $edit_id = $_POST['hidden_edit_id'];

        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $full_name = $first_name . " " . $last_name;
        $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $hobby = implode(",", $_POST['hobby']);

        if ($_FILES['image']['name'] != '') {
            $image_name = time() . "_" . $_FILES['image']['name'];
            $image_path = "images/registration_images/" . $image_name;

            $temp_image_name = $_FILES['image']['tmp_name'];
            $image_file_type = explode(".", $_FILES['image']['name']);
            $image_file_type = strtolower(end($image_file_type));

            $allowed_image_file_types = array("jpg", "jpeg", "png");
            if (!in_array($image_file_type, $allowed_image_file_types)) {
                $response_array['status'] = "error";
                $response_array['message'] = "JPG, JPEG, PNG file types are allowed";

                echo json_encode($response_array); exit;
            }

            $select_sql = "SELECT image FROM registration WHERE id = $edit_id";
            $select_result = mysqli_query($conn, $select_sql);

            if (mysqli_num_rows($select_result) > 0) {
                $image = mysqli_fetch_assoc($select_result);
                if (file_exists("images/registration_images/".$image['image'])) {
                    unlink("images/registration_images/".$image['image']);
                }
            }

            move_uploaded_file($temp_image_name, $image_path);

            $edit_sql = "UPDATE registration SET name = '".$full_name."', mobile_number = '".$mobile_number."', address = '".$address."', country = '".$country."', gender = '".$gender."', hobby = '".$hobby."', image = '".$image_name."' WHERE id = $edit_id";
        } else {
            $edit_sql = "UPDATE registration SET name = '".$full_name."', mobile_number = '".$mobile_number."', address = '".$address."', country = '".$country."', gender = '".$gender."', hobby = '".$hobby."' WHERE id = $edit_id";
        }

        $edit_result = mysqli_query($conn, $edit_sql);

        if ($edit_result) {
            $response_array['status'] = "success";

            echo json_encode($response_array); exit;
        } else {
            $response_array['status'] = "error";
            $response_array['message'] = "Error while update record";

            echo json_encode($response_array); exit;
        }
    }

    if (isset($_POST['register_delete']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $response_array = array();
        $delete_id = $_POST['deleteid'];

        $select_sql = "SELECT * FROM registration WHERE id = '".$delete_id."'";
        $select_result = mysqli_query($conn, $select_sql);

        if (mysqli_num_rows($select_result) == 1) {
            $row = mysqli_fetch_assoc($select_result);
            if (file_exists('images/registration_images/'.$row['image'])) {
                unlink('images/registration_images/'.$row['image']);
            }

            $delete_sql = "DELETE FROM registration WHERE id = $delete_id";
            $delete_result = mysqli_query($conn, $delete_sql);

            if ($delete_result) {
                $response_array['status'] = "delete_success";

                echo json_encode($response_array); exit;
            } else {
                $response_array['status'] = "error";
                $response_array['message'] = "Error in delete record";

                echo json_encode($response_array); exit;
            }
        } else {
            $response_array['status'] = "error";
            $response_array['message'] = "Requested record not present for delete";

            echo json_encode($response_array); exit;
        }
    }

    if (isset($_POST['login_request']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $select_sql = "SELECT * FROM registration WHERE email = '".$email."'";
        $select_result = mysqli_query($conn, $select_sql);

        if (mysqli_num_rows($select_result) == 1) {
            $row = mysqli_fetch_assoc($select_result);
            if ($row['password'] == md5($password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];

                $response_array['status'] = "login_success";

                echo json_encode($response_array); exit;
            } else {
                $response_array['status'] = "error";
                $response_array['message'] = "Invalid password";

                echo json_encode($response_array); exit;
            }
        } else {
            $response_array['status'] = "error";
            $response_array['message'] = "Entered email not registered";

            echo json_encode($response_array); exit;
        }
    }
?>