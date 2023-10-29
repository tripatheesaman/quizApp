<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        .welcome-body {
            background: url('https://images.unsplash.com/photo-1492892132812-a00a8b245c45?auto=format&fit=crop&q=80&w=1770&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="welcome-body grid place-content-center min-h-screen text-white">

    <h1 class="font-mono text-7xl">Welcome to the Quiz App.</h1>
    <h2 class="font-serif text-2xl m-3 "><a class="underline font-extrabold hover:text-green-700" href="{{url('/')}}/login">Login</a> or <a class="underline font-extrabold hover:text-green-700" href="{{url('/')}}/register">Register</a> to get started!</h2>

</body>

</html>