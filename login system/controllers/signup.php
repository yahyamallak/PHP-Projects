<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors["signup"] = [];
    $olds["signup"] = [];

    $name = $olds["signup"]["name"] = $_POST["name"];
    $email = $olds["signup"]["email"] = $_POST["email"];
    $password = $olds["signup"]["password"] = $_POST["password"];
    $confirm_password = $olds["signup"]["confirm_password"] = $_POST["confirm_password"];


    if(empty($name)) {
        $errors["signup"]["name"] = "This field is required";
    }

    if (empty($email)) {
        $errors["signup"]["email"] = "This field is required";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["signup"]["email"] = "This email is not valid";
    }

    if (empty($password)) {
        $errors["signup"]["password"] = "This field is required";
    } else if(strlen($password) < 8) {
        $errors["signup"]["password"] = "Password should contain at least 8 characters";
    } else if (!preg_match('#[a-zA-Z0-9]+[^\w\s]+#', $password)) {
        $errors["signup"]["password"] = "Password should contain letters, numbers and special characters";
    }

    if (empty($confirm_password)) {
        $errors["signup"]["confirm_password"] = "This field is required";
    } else if($password != $confirm_password) {
        $errors["signup"]["confirm_password"] = "Passwords don't match";
    }




    if (!empty($errors["signup"])) {
        $_SESSION["errors"] = $errors;
        $_SESSION["olds"] = $olds;
        header("Location: /");
        exit;
    }


    if($auth->register($name, $password, $email)) {

        header("Location: /dashboard ");
        exit;

    } else {
        echo "We couldn't register you. try again";
    }

} else {

    echo "Access denied";
}

