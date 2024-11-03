<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

        * {
            box-sizing: border-box;
        }

        nav {
            display: flex;
            justify-content: space-between;
        }

        em {
            font-size: 12px;
            color: red;
        }

        .wrapper {
            text-align: center;
        }

        .separator {
            position: relative;
        }

        .separator::before,
        .separator::after {
            content: '';
            display: block;
            width: 45%;
            height: 1px;
            background-color: white;
            position: absolute;
            top: 12px;
        }

        .separator::before {
            right: 0;
        }

        .separator::after {
            leftt: 0;
        }

        .login-register {
            display: flex;
            justify-content: space-between;
        }

        .input-container {
            width: 200px;
        }

        .google-btn img:hover {
            filter: brightness(0.9);
        }

        .password-message {
            margin: 5px;
            font-size: 15px;
        }

        .popup-form {
            background-color: #202B38;
            border-radius: 1rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, .5);
            padding: 1rem;
            width: fit-content;
            display: none;
        }

        .popup-form.active {
            display: block;
        }

        .popup-form i {
            font-size: 2rem;
            float: right;
            cursor: pointer;
        }

        .popup-form input {
            width: 100%;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
            display: none;
        }

        .overlay.show {
            display: block;
        }

    </style>
</head>
<body>