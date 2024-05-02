<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ework @yield("title", "")</title>
        <link rel="icon" type="image/x-icon" href="{{asset("ework.ico")}}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="bg-white">
            <div class="flex justify-between py-5 px-8">
                <div>
                    <a href="/">
                        <img src="{{asset("images/ework.png")}}" width="80" alt="">
                    </a>
                </div>
                <nav>
                    <ul class="flex gap-4">
                        @auth
                        <li id="user" class="relative cursor-pointer"><i class="fa-solid fa-user text-orange-500"></i> {{Auth::user()->name}}
                            <ul id="dropdown-menu-user" class="absolute right-0 w-48 bg-white rounded shadow hidden">
                                <a href="/dashboard"><li class="p-4 hover:bg-slate-100"><i class="fa-solid fa-address-card text-orange-500"></i> Dashboard</li></a>
                                <hr>
                                <a href="/manage"><li class="p-4 hover:bg-slate-100"><i class="fa-solid fa-gear text-orange-500"></i> Manage Jobs</li></a>
                            </ul>
                        </li>
                        <a href="/logout">
                            <li><button class=""><i class="fa-solid fa-right-from-bracket text-orange-500"></i> Logout</button></li>
                        </a>
                        @else
                        <a href="/register">
                            <li><button class=""><i class="fa-solid fa-user-plus text-orange-500"></i> Register</button></li>
                        </a>
                        <a href="/login">
                            <li><button class=""><i class="fa-solid fa-right-to-bracket text-orange-500"></i> Login</button></li>
                        </a>
                        @endauth
                    </ul>
                </nav>
            </div>
        </header>

        <div class="flex flex-col items-center bg-slate-50 px-5 py-5">
            @yield('content')
        </div>

        <footer class="text-center p-5">
            <span class="text-orange-500 font-bold">E</span>work &copy; 2024
        </footer>
    </body>
</html>
