<?php
$servername = "localhost";
$username = "root";
$password = "4550";
$dbname = "my_Db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$firstName = $lastName = $email = $gender = $photo = $password = $conPass = $number = "";
$firstNameError = $lastNameError = $emailError = $genderError = $photoError = $passError = $numError = "";
function input_test($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {

    $firstName = input_test($_POST['firstName']);
    $lastName = input_test($_POST['lastName']);
    $email = input_test($_POST['email']);
    $gender = $_POST['gender'];
    $password = input_test($_POST['password']);
    $conPass = input_test($_POST['conPassword']);
    $number = input_test($_POST['number']);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
        $firstNameError = "Only letters allowed in first name";
        echo $firstNameError . "<br>";
    } else {
        echo "First Name: " . $firstName . "<br>";
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
        $lastNameError = "Only letters allowed in last name";
        echo $lastNameError . "<br>";
    } else {
        echo "Last Name: " . $lastName . "<br>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
        echo $emailError . "<br>";
    } else {
        echo "Email: " . $email . "<br>";
    }

    if (strlen($password) < 6) {
        $passError = "Password must be at least 6 characters";
        echo $passError . "<br>";
    } elseif ($password !== $conPass) {
        $passError = "Passwords do not match";
        echo $passError . "<br>";
    } else {
        echo "Password: " . $password . "<br>";
    }
    if (!preg_match("/^[0-9]{11}$/", $number)) {
        $numError = "Enter a valid 11-digit phone number";
        echo $numError . "<br>";
    } else {
        echo "Phone Number: " . $number . "<br>";
    }
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        $file_temp = $file['tmp_name'];
        $file_size = $file['size'];

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allow_ext = ['png', 'jpg', 'jpeg'];

        if ($file_size < 5000000) {
            if (in_array($file_ext, $allow_ext)) {
                $new_file_name = uniqid() . '.' . $file_ext;
                $file_upload = "image/" . $new_file_name;
                if (!is_dir("image")) {
                    mkdir("image", 0777, true);
                }

                if (move_uploaded_file($file_temp, $file_upload)) {
                    echo "<img src='" . $file_upload . "' width='150' alt='Uploaded Image'><br>";
                } else {
                    echo "File upload failed<br>";
                }
            } else {
                echo "Only png, jpg, jpeg files allowed<br>";
            }
        } else {
            echo "File must be less than 5MB<br>";
        }
    }
    if (
        empty($firstNameError) && empty($lastNameError) && empty($emailError)
        && empty($passError) && empty($numError)
    ) {
        $sql_insert = "INSERT INTO employs (firstname, lastname, email, phone, gender, image, password)
                       VALUES ('$firstName', '$lastName', '$email', '$number', '$gender', '$file_upload', '$password')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<br>✅ Data Inserted Successfully!";
        } else {
            echo "<br> Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>
