<?php


// define variables and set to empty values
$email = $password = $repeatPassword = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["email"])) {
        $email = $_POST['email'];
    }

    if (!empty($_POST["password"])) {
        $password = $_POST['password'];
    }
    if (!empty($_POST['repeatPassword']) && ($_POST[$repeatPassword] == $_POST['password'])){
        $repeatPassword = $password;
    }else{
        $passwordError = "Password Doesn't match";

    }
}

echo "Hello $email your password is $password";

//function test_input($data) {
//    $data = trim($data);
//    $data = stripslashes($data);
//    $data = htmlspecialchars($data);
//    return $data;
//}

