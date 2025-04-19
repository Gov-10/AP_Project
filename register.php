<?php
   include("database.php");
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $phone_number = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO patients(name, age, gender, location, phone_number, email, password) VALUES ('$name', '$age', '$gender', '$location', '$phone_number', '$email', '$hash')";
    mysqli_query($conn, $sql);
    echo "<script>alert('Thanks for reaching us out!');</script>";
}
?>