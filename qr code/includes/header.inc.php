<?php

session_start();

define("HOME", "/php-projects/qr code");

$filename = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

$gridClass = ($filename == 'index') ? "grid-cols-[200px_1fr_1fr]" : "grid-cols-[200px_1fr]";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR code generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
                colors: {
                    softBlue: '#4E81EC',
                    customRed: '#e63946',
                }
            }
        }
        }
    </script>

    <style>
        .dropdown.active .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <div class="grid <?= $gridClass ?>">
        <nav class="z-10 flex flex-col justify-between sticky top-0 left-0 h-screen bg-softBlue text-white">
            <div class="flex flex-col gap-5">
                <div class="self-center mt-2">
                    <img width="60" src="<?=HOME . '/files/qr-code.png'?>" alt="">
                </div>
                <ul class="flex flex-col">
                    <a href="<?=HOME;?>" class="p-5 hover:bg-blue-600 transition duration-300 ease-in-out"><li><i class="fa-solid fa-qrcode"></i> Generate</li></a>
                    <a href="<?=HOME;?>/files.php" class="p-5 hover:bg-blue-600 transition duration-300 ease-in-out"><li><i class="fa-solid fa-folder"></i> Files</li></a>
                </ul>
            </div>
            
            <div class="p-5">

                <div class="flex flex-col gap-2 items-start">

                    <div class="dropdown relative" data-dropdown>
                        <button data-dropdown-button><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                        <div class="dropdown-menu shadow-lg bg-white rounded-md p-5 absolute bottom-6 left-0 z-10 hidden">
                            <form class="text-black w-40 flex flex-col gap-3" action="" method="post">
                                <div>
                                    <label for="email">Email</label>
                                    <input id="email" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="email" placeholder="Email...">
                                </div>

                                <div>
                                    <label for="password">Password</label>
                                    <input id="password" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="password" placeholder="Password...">
                                </div>

                                <button class="bg-softBlue text-white font-bold py-2 px-6 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 ease-in-out" type="submit">Login</button>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown relative" data-dropdown>
                        <button data-dropdown-button><i class="fa-solid fa-user-plus"></i> Register</button>
                        <div class="dropdown-menu shadow-lg bg-white rounded-md p-5 absolute bottom-6 left-0 z-10 hidden">
                            <form class="text-black w-48 flex flex-col gap-3" action="" method="post">
                                <div>
                                    <label for="name">Name</label>
                                    <input id="name" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="text" placeholder="Name...">
                                </div>

                                <div>
                                    <label for="email">Email</label>
                                    <input id="email" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="email" placeholder="Email...">
                                </div>

                                <div>
                                    <label for="password">Password</label>
                                    <input id="password" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="password" placeholder="Password...">
                                </div>

                                <div>
                                    <label for="password_confirmation">Password</label>
                                    <input id="password_confirmation" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="password" placeholder="Confirm password...">
                                </div>

                                <button class="bg-softBlue text-white font-bold py-2 px-6 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 ease-in-out" type="submit">Register</button>
                            </form>
                        </div>
                    </div>
                </div>


                <?php if(isset($_SESSION['user_id'])): ?>
                <button><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                <?php endif; ?>
            </div>
        </nav>