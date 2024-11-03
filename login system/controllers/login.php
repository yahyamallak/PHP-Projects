<?php


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    if(empty($email)) {
        $errors["email"] = "This field is required";
    }

    if (empty($password)) {
        $errors["password"] = "This field is required";
    }

    if($errors) {
        $_SESSION["errors"]["login"] = $errors;
        $_SESSION["olds"]["login"]["email"] = $email;
        header("Location: /");
        exit;
    }

    
    if($auth->login($email, $password)) {
        header("Location: /dashboard");
        exit;
    } else {
        $_SESSION["olds"]["login"]["email"] = $email;
        $_SESSION["errors"]["login"]["all"] = "Email or password incorrect";
        header("Location: /");
        exit;
    }
}